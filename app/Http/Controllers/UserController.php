<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\Video;
use App\Models\VideoRunning;
use App\Models\Patient;
use App\Models\Manager;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Users List';
        if ($request->ajax()) {
            $data = User::query();

            return DataTables::of($data)
                ->addColumn('profile_image', function ($row) {
                    $imageUrl = asset('public/'.$row->profile_image);
                    return $imageUrl ? '<img src="'.$imageUrl.'" style="height: 50px; width: auto;">' : 'No Image';
                })
                ->addColumn('role', function ($row) {
                    return Role::find($row->role_id)->name ?? '';
                })
                ->addColumn('name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name ?? '';
                })

                ->addColumn('action', function ($row) {
                    $Button = '<div class="d-flex align-items-center list-action">';
                    // $Button .= '<a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#"><i class="ri-eye-line mr-0"></i></a>';
                    $Button .= '<a href="' .  route('user.edit', ['id' => $row->id]) . '" class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" ><i class="ri-pencil-line mr-0"></i></a>';
                    $Button .= '<button class="badge badge-warning mr-2 delete-user border-0" data-id="' . $row->id . '" data-model="user" data-toggle="modal" data-target="#deleteUserModal"><i class="ri-delete-bin-line mr-0"></i></button>';
                    $Button .= '<a href="' .  route('user.details', ['id' => $row->id]) . '" class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Details" ><i class="bi bi-info-circle mr-0"></i></a>';
                    $Button .= '</div>';
                    return $Button;
                })

                ->rawColumns(['profile_image' , 'action'])
                ->make(true);
        }
        return view('user.index', compact('title'));
    }

    public function video_running(Request $request , $id)
    {
        $title = 'Video Runing Details';
        if ($request->ajax()) {
            $data = VideoRunning::where('user_id', $id);

            return DataTables::of($data)
                ->addColumn('video_display', function ($row) {
                    $video = Video::find($row->video_id);
                    return '<video width="320" height="240" controls>
                                <source src="' . asset('storage/app/public/' . $video->video) . '" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>';
                })
                ->addColumn('username', function ($row) {
                    $user = User::find($row->user_id);
                    return $user->first_name . ' ' . $user->last_name ?? '';
                })
                ->addColumn('status_display', function ($row) {
                    if ($row->is_complete == 1) {
                        return '<span class="badge bg-success">Completed <i class="bi bi-check-circle"></i></span>';
                    } else {
                        return '<span class="badge bg-warning">Running <i class="bi bi-play-circle"></i></span>';
                    }
                })
                ->rawColumns(['video_display','status_display'])
                ->make(true);
        }
        $user_id = $request->id;
        return view('user.details_index', compact('title' , 'user_id'));
    }

    public function create()
    {
        $title = 'User Create';
        $roles = Role::all();
        return view('user.create' , compact('title' , 'roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password',
            'role_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|nullable',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Store the file in the public folder
            $image->move(public_path('assets/user_images'), $filename);

            // Set the relative image path in the meal model
            $user->profile_image = 'assets/user_images/' . $filename;
        }
        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $title = 'User Edit';
        $data = User::find($id);
        $roles = Role::all();
        return view('user.edit', compact('data' , 'title' , 'roles'));
    }


    public function update(Request $request)
    {
        $rules = [
            'id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif|nullable',
            'role_id' => 'required',
        ];

        // Only require password and cpassword if they are provided
        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8';
            $rules['cpassword'] = 'required|same:password';
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user =  User::find($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->role_id = $request->role_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Store the file in the public folder
            $image->move(public_path('assets/user_images'), $filename);

            // Set the relative image path in the meal model
            $user->profile_image = 'assets/user_images/' . $filename;
        }
        $user->update();

        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $User = User::find($request->id);

            if ($User) {

                if ($User->profile_image) {
                    Storage::disk('public')->delete($User->profile_image);
                }
                $User->delete();
                return response()->json(['message' => 'User deleted successfully']);
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }
        }
    }

    /**
     * Get all users for frontend API calls
     */
    public function getAllUsers()
    {
        try {
            $users = User::with(['role', 'subscription'])->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'role_name' => $user->role->name ?? null,
                    'role' => $user->role ? ['name' => $user->role->name] : null,
                    'profile_image' => $user->profile_image,
                    'created_at' => $user->created_at,
                    'status' => 'Active', // Default status since we don't have this field
                    'subscription' => $user->subscription ? [
                        'id' => $user->subscription->id,
                        'name' => $user->subscription->name,
                        'description' => $user->subscription->description ?? '',
                        'created_at' => $user->subscription->created_at,
                        'updated_at' => $user->subscription->updated_at,
                    ] : null
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Users retrieved successfully',
                'data' => $users
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new user for frontend API calls
     */
    public function apiStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'cpassword' => 'required|same:password',
                'role_id' => 'required|exists:roles,id',
                'image' => 'image|mimes:jpeg,png,jpg,gif|nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->password = Hash::make($request->password);
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();

                // Store the file in the public folder
                $image->move(public_path('assets/user_images'), $filename);

                // Set the relative image path
                $user->profile_image = 'assets/user_images/' . $filename;
            }
            
            $user->save();

            // Automatically create Patient or Manager profile based on role
            if ($user->role_id == 5) { // Patient role
                \App\Models\Patient::create([
                    'user_id' => $user->id,
                    'date_of_birth' => null, // Can be updated later
                    'gender' => null, // Can be updated later  
                    'address' => null, // Can be updated later
                    'hospital_id' => null, // Can be assigned later
                    'doctor_id' => null, // Can be assigned later
                ]);
            } elseif ($user->role_id == 4) { // Manager role
                \App\Models\Manager::create([
                    'user_id' => $user->id,
                    'phone_number' => null, // Can be updated later
                    'joining_date' => now(), // Set current date as joining date
                ]);
            }

            // Load the role relationship for the response
            $user->load('role');

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'role_name' => $user->role->name ?? null,
                    'role' => $user->role ? ['name' => $user->role->name] : null,
                    'profile_image' => $user->profile_image,
                    'created_at' => $user->created_at,
                    'status' => 'Active'
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a user for frontend API calls
     */
    public function apiDestroy(Request $request)
    {
        try {
            $userId = $request->input('id');
            
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User ID is required'
                ], 422);
            }

            $user = User::find($userId);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // Delete profile image if exists
            if ($user->profile_image) {
                $imagePath = public_path($user->profile_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Delete associated Patient or Manager profile
            if ($user->role_id == 5) { // Patient role
                $user->patient()->delete();
            } elseif ($user->role_id == 4) { // Manager role  
                $user->manager()->delete();
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update a user for frontend API calls
     */
    public function apiUpdate(Request $request, $id)
    {
        try {
            $user = User::find($id);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'image' => 'image|mimes:jpeg,png,jpg,gif|nullable',
                'role_id' => 'required|exists:roles,id',
            ];

            // Only require password if it's provided
            if ($request->filled('password')) {
                $rules['password'] = 'required|min:8';
                $rules['cpassword'] = 'required|same:password';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Store old role for profile management
            $oldRoleId = $user->role_id;

            // Update user fields
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->role_id = $request->role_id;
            $user->email = $request->email;

            // Update subscription_id if provided
            if ($request->has('subscription_id')) {
                $user->subscription_id = $request->subscription_id;
            }

            // Only update password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            // Handle profile image
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($user->profile_image) {
                    $oldImagePath = public_path($user->profile_image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/user_images'), $filename);
                $user->profile_image = 'assets/user_images/' . $filename;
            }

            $user->save();

            // Handle role changes - create/delete Patient or Manager profiles
            if ($oldRoleId != $user->role_id) {
                // Delete old profile if existed
                if ($oldRoleId == 5) { // Was Patient
                    $user->patient()->delete();
                } elseif ($oldRoleId == 4) { // Was Manager
                    $user->manager()->delete();
                }

                // Create new profile if needed
                if ($user->role_id == 5) { // Now Patient
                    Patient::create([
                        'user_id' => $user->id,
                        'date_of_birth' => null,
                        'gender' => null,
                        'address' => null,
                        'hospital_id' => null,
                        'doctor_id' => null,
                    ]);
                } elseif ($user->role_id == 4) { // Now Manager
                    \App\Models\Manager::create([
                        'user_id' => $user->id,
                        'phone_number' => null,
                        'joining_date' => now(),
                    ]);
                }
            }

            // Load relationships for response
            $user->load('role');

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'role_name' => $user->role->name ?? null,
                    'role' => $user->role ? ['name' => $user->role->name] : null,
                    'profile_image' => $user->profile_image,
                    'created_at' => $user->created_at,
                    'status' => 'Active'
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
