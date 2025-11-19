<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\HandleResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Mail\OtpMail;

class AuthenticateController extends Controller
{
    use HandleResponse;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->fail('Validation failed, email or password incorrect.', $validator->errors()->all(), 422);
        }

        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            // Check if the user has the "staff" role
            if ($user->role_id === 2) {
                $currentDate = date('Y-m-d');
                if (isset($user->subscription_date) && $currentDate > $user->subscription_date) {
                    $user->subscription_date = null;
                    $user->subscription_id = null;
                    $user->save();
                }

                $profile_update = $user->profile_update;
                $token = $user->createToken('MyApp')->plainTextToken;
                $user->update(['remember_token' => $token]);
                return $this->successWithData(['token' => $token, 'profile' => $profile_update], "access token", 200);
            }
        } else {
            // Provide a more specific error message
            if (!$user) {
                return $this->unauthorizedResponse("Email not registered");
            } else {
                return $this->unauthorizedResponse("Incorrect password");
            }
        }

        return $this->badRequestResponse("Invalid credentials");
    }

    public function signup(Request $request)
    {

        if (User::where('email', $request->email)->exists()) {
            return $this->fail('Email already exists', ['email' => 'This email is already registered'], 422);
        //   message,errors,status code
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'min:8'],
        ]);


        if ($validator->fails()) {
            return $this->fail('Validation failed', $validator->errors()->all(), 422);
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 2;
        $user->save();

        Auth::login($user);

        $token = $user->createToken('MyApp')->plainTextToken;

        return $this->successWithData($token, "access token", 200);
    }

    public function updateProfile(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return $this->fail("Invalid credentials", $validator->errors()->all());
        }

        // Check if the email already exists for another user
        $user = Auth::user();
        $emailExists = User::where('email', $request->email)
            ->where('id', '!=', $user->id)
            ->exists();

        if ($emailExists) {
            return $this->fail("The email has already been taken", [], 422);
        }

        // Update user profile
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        return $this->successWithData($user, 'Profile updated successfully', 200);
    }

    public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return $this->fail("Invalid credentials", $validator->errors()->all());
        }

        try {
            DB::beginTransaction();

            $user = User::where('email', $request->email)->firstOrFail();
            $user->otp = random_int(10000, 99999); // More secure random function
            $user->otp_expires_at = now()->addMinutes(10); // OTP expires after 10 minutes
            $user->save();

            Mail::to($user->email)->send(new OtpMail($user));

            DB::commit();
            return $this->successMessage("Successfully sent the OTP.", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->fail($e->getMessage(), [], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->fail("Invalid credentials", $validator->errors()->all());
        }

        $user = User::where('email', $request->email)->firstOrFail();

        if ($user->otp != $request->otp || now()->gt($user->otp_expires_at)) {
            return $this->unauthorizedResponse("Invalid or expired OTP, please request a new one.");
        }

        $user->email_verified_at = now();
        $user->otp = null; // Clear the OTP field after successful verification
        $user->otp_expires_at = null; // Clear OTP expiration time
        $user->save();

        return $this->successMessage("Your account has been successfully verified.", 200);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return $this->fail('Validation failed', $validator->errors()->all());
        }

        $user = User::where('email', $request->email)->first();

        $otp = rand(10000, 99999);
        $user->otp = $otp;
        $user->save();

        Mail::to($user->email)->send(new OtpMail($user));

        return $this->successMessage("OTP sent to your email address", 200);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->fail('Validation failed', $validator->errors()->all());
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp != $request->otp) {
            return $this->fail("Invalid OTP", [], 422);
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->save();

        return $this->successMessage("Password reset successfully", 200);
    }
}
