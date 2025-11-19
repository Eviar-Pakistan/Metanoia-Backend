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
}
