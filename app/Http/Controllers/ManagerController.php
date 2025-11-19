<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $managers = Manager::with('user')->get();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $managers
                ], 200);
            }

            return view('managers.index', compact('managers'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch managers: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to fetch managers: ' . $e->getMessage());
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
                'message' => 'Ready to create manager'
            ]);
        }

        return view('managers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Debug authentication
            Log::info('Manager store authentication check', [
                'user_authenticated' => auth('sanctum')->check(),
                'user_id' => auth('sanctum')->id(),
                'has_bearer_token' => $request->bearerToken() ? 'yes' : 'no',
                'authorization_header' => $request->header('Authorization') ? 'present' : 'missing',
            ]);

            // Debug incoming request
            Log::info('Manager store request received', [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'joining_date' => $request->input('joining_date'),
                'has_profile_image' => $request->hasFile('profile_image'),
                'profile_image_size' => $request->hasFile('profile_image') ? $request->file('profile_image')->getSize() : 0,
                'profile_image_name' => $request->hasFile('profile_image') ? $request->file('profile_image')->getClientOriginalName() : 'none',
            ]);

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'phone_number' => 'nullable|string|max:20',
                'joining_date' => 'required|date'
            ]);

            DB::beginTransaction();

            // Create user first
            $userData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 4, // Always set to 4 for Manager role
            ];

            if ($request->hasFile('profile_image')) {
                Log::info('Processing profile image upload');
                $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
                $userData['profile_image'] = $profileImagePath;
                Log::info('Profile image stored at: ' . $profileImagePath);
            } else {
                Log::info('No profile image file found in request');
            }

            Log::info('Creating user with data', $userData);
            $user = User::create($userData);
            Log::info('User created with ID: ' . $user->id . ', profile_image: ' . ($user->profile_image ?? 'null'));

            // Create manager profile
            $managerData = [
                'user_id' => $user->id,
                'phone_number' => $request->phone_number,
                'joining_date' => $request->joining_date
            ];

            $manager = Manager::create($managerData);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Manager created successfully',
                    'data' => $manager->load('user')
                ], 201);
            }

            return redirect()->route('managers.index')->with('success', 'Manager created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Manager creation error', ['error' => $e->getMessage()]);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create manager: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to create manager: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($manager)
    {
        try {
            // Handle both model binding and ID parameter
            if (is_numeric($manager)) {
                $manager = Manager::with('user')->findOrFail($manager);
            } else {
                $manager = $manager->load('user');
            }

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $manager
                ], 200);
            }

            return view('managers.show', compact('manager'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Manager not found'
                ], 404);
            }

            return redirect()->route('managers.index')->with('error', 'Manager not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($manager)
    {
        try {
            // Handle both model binding and ID parameter
            if (is_numeric($manager)) {
                $manager = Manager::with('user')->findOrFail($manager);
            } else {
                $manager = $manager->load('user');
            }

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $manager
                ], 200);
            }

            return view('managers.edit', compact('manager'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Manager not found'
                ], 404);
            }

            return redirect()->route('managers.index')->with('error', 'Manager not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $manager)
    {
        try {
            // Debug incoming request data
            Log::info('Manager update request received', [
                'request_method' => $request->method(),
                'content_type' => $request->header('Content-Type'),
                'all_data' => $request->all(),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'has_profile_image' => $request->hasFile('profile_image'),
                'files_count' => count($request->allFiles()),
            ]);

            // Handle both model binding and ID parameter
            if (is_numeric($manager)) {
                $manager = Manager::with('user')->findOrFail($manager);
            } else {
                $manager = $manager->load('user');
            }

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $manager->user->id,
                'password' => 'nullable|string|min:8',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'phone_number' => 'nullable|string|max:20',
                'joining_date' => 'required|date'
            ]);

            DB::beginTransaction();

            // Update user data
            $userData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('profile_image')) {
                // Delete old profile image if exists
                if ($manager->user->profile_image) {
                    Storage::disk('public')->delete($manager->user->profile_image);
                }

                $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
                $userData['profile_image'] = $profileImagePath;
            }

            $manager->user->update($userData);

            // Update manager data
            $managerData = [
                'phone_number' => $request->phone_number,
                'joining_date' => $request->joining_date
            ];

            $manager->update($managerData);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Manager updated successfully',
                    'data' => $manager->load('user')
                ], 200);
            }

            return redirect()->route('managers.index')->with('success', 'Manager updated successfully');
        } catch (\Exception $e) {
            DB::rollback();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update manager: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to update manager: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($manager)
    {
        try {
            // Handle both model binding and ID parameter
            if (is_numeric($manager)) {
                $manager = Manager::with('user')->findOrFail($manager);
            } else {
                $manager = $manager->load('user');
            }

            DB::beginTransaction();

            // Delete profile image if exists
            if ($manager->user->profile_image) {
                Storage::disk('public')->delete($manager->user->profile_image);
            }

            // Store user reference before deleting manager
            $user = $manager->user;

            // Delete manager record first
            $manager->delete();
            
            // Then delete the associated user
            $user->delete();

            DB::commit();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Manager deleted successfully'
                ], 200);
            }

            return redirect()->route('managers.index')->with('success', 'Manager deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to delete manager: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('managers.index')->with('error', 'Failed to delete manager: ' . $e->getMessage());
        }
    }

    /**
     * Get all managers for API requests
     */
    public function getAllManagers()
    {
        try {
            $managers = Manager::with('user')->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $managers,
                'message' => 'Managers fetched successfully'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch managers: ' . $e->getMessage()
            ], 500);
        }
    }
}
