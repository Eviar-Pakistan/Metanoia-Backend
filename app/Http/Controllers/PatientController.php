<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $patients = Patient::with(['user', 'hospital', 'doctor'])->get();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $patients
                ], 200);
            }

            return view('patients.index', compact('patients'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch patients: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to fetch patients: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ready to create patient'
            ]);
        }

        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Patient store request received', [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'request_method' => $request->method(),
                'has_file' => $request->hasFile('profile_image'),
            ]);

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female,other',
                'address' => 'required|string',
                'hospital_id' => 'required|exists:hospitals,id',
                'doctor_id' => 'required|exists:doctors,id',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'created_by' => 'required|exists:users,role_id',
            ]);

            DB::beginTransaction();

            $userData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 5, // Patient role
            ];

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imagePath = $image->store('profile_images', 'public');
                $userData['profile_image'] = '/storage/' . $imagePath;

                Log::info('Profile image uploaded', ['path' => $userData['profile_image']]);
            }

            // Create user first
            $user = User::create($userData);

            // Create patient profile
            $patient = Patient::create([
                'user_id' => $user->id,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'hospital_id' => $request->hospital_id,
                'doctor_id' => $request->doctor_id,
            ]);

            // Load relationships for response
            $patient->load(['user', 'hospital', 'doctor']);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Patient created successfully',
                    'data' => $patient
                ], 201);
            }

            return redirect()->route('patients.index')->with('success', 'Patient created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Patient creation error', ['error' => $e->getMessage()]);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create patient: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to create patient: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $patient = Patient::with(['user', 'hospital', 'doctor'])->findOrFail($id);

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $patient
                ], 200);
            }

            return view('patients.show', compact('patient'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Patient not found'
                ], 404);
            }

            return redirect()->route('patients.index')->with('error', 'Patient not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $patient = Patient::with(['user', 'hospital', 'doctor'])->findOrFail($id);

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $patient
                ], 200);
            }

            return view('patients.edit', compact('patient'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Patient not found'
                ], 404);
            }

            return redirect()->route('patients.index')->with('error', 'Patient not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Log::info('Patient update request received', [
                'id' => $id,
                'first_name' => $request->input('first_name'),
                'request_method' => $request->method(),
                'has_file' => $request->hasFile('profile_image'),
            ]);

            $patient = Patient::with('user')->findOrFail($id);
            $user = $patient->user;

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female,other',
                'address' => 'required|string',
                'hospital_id' => 'required|exists:hospitals,id',
                'doctor_id' => 'required|exists:doctors,id',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'created_by' => 'required|exists:users,role_id',
            ]);

            DB::beginTransaction();

            $userData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ];

            // Update password only if provided
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                // Delete old image if it exists
                if ($user->profile_image) {
                    $oldImagePath = str_replace('/storage/', '', $user->profile_image);
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                        Log::info('Old profile image deleted', ['path' => $oldImagePath]);
                    }
                }

                $image = $request->file('profile_image');
                $imagePath = $image->store('profile_images', 'public');
                $userData['profile_image'] = '/storage/' . $imagePath;

                Log::info('New profile image uploaded', ['path' => $userData['profile_image']]);
            }

            // Update user data
            $user->update($userData);

            // Update patient data
            $patient->update([
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'hospital_id' => $request->hospital_id,
                'doctor_id' => $request->doctor_id,
            ]);

            // Load relationships for response
            $patient->load(['user', 'hospital', 'doctor']);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Patient updated successfully',
                    'data' => $patient
                ], 200);
            }

            return redirect()->route('patients.index')->with('success', 'Patient updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Patient update error', ['error' => $e->getMessage()]);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update patient: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to update patient: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $patient = Patient::with('user')->findOrFail($id);

            DB::beginTransaction();

            // Delete profile image if it exists
            if ($patient->user->profile_image) {
                $imagePath = str_replace('/storage/', '', $patient->user->profile_image);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                    Log::info('Profile image deleted', ['path' => $imagePath]);
                }
            }

            // Delete patient first (due to foreign key constraint)
            $patient->delete();

            // Delete the associated user (this will cascade delete the patient due to foreign key)
            $patient->user->delete();

            DB::commit();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Patient deleted successfully'
                ], 200);
            }

            return redirect()->route('patients.index')->with('success', 'Patient deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to delete patient: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('patients.index')->with('error', 'Failed to delete patient: ' . $e->getMessage());
        }
    }

    /**
     * Get all patients for API requests
     */
    public function getAllPatients()
    {
        try {
            $patients = Patient::with(['user', 'hospital', 'doctor'])->get();

            return response()->json([
                'status' => 'success',
                'data' => $patients,
                'message' => 'Patients fetched successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch patients: ' . $e->getMessage()
            ], 500);
        }
    }
}
