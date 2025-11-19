<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $doctors = Doctor::with(['specialization', 'hospital', 'creator'])->get();
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $doctors
                ], 200);
            }
            
            return view('doctors.index', compact('doctors'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch doctors: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to fetch doctors: ' . $e->getMessage());
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
                'message' => 'Ready to create doctor'
            ]);
        }
        
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Doctor store request received', [
                'fullname' => $request->input('fullname'),
                'request_method' => $request->method(),
                'has_file' => $request->hasFile('profile_image'),
            ]);

            $request->validate([
                'fullname' => 'required|string|max:255',
                'gender' => 'required|in:male,female,other',
                'email' => 'required|email|unique:doctors,email',
                'phone_number' => 'required|string|max:20',
                'experience' => 'required|integer|min:0',
                'specialization_id' => 'required|exists:specializations,id',
                'hospital_id' => 'required|exists:hospitals,id',
                'created_by' => 'required|exists:users,role_id',
                'joining_date' => 'required|date',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            DB::beginTransaction();

            $doctorData = $request->except('profile_image');

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imagePath = $image->store('profile_images', 'public');
                $doctorData['profile_image'] = '/storage/' . $imagePath;
                
                Log::info('Profile image uploaded', ['path' => $doctorData['profile_image']]);
            }

            $doctor = Doctor::create($doctorData);

            // Load relationships for response
            $doctor->load(['specialization', 'hospital', 'creator']);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Doctor created successfully',
                    'data' => $doctor
                ], 201);
            }

            return redirect()->route('doctors.index')->with('success', 'Doctor created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Doctor creation error', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create doctor: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to create doctor: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $doctor = Doctor::with(['specialization', 'hospital', 'creator'])->findOrFail($id);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $doctor
                ], 200);
            }
            
            return view('doctors.show', compact('doctor'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Doctor not found'
                ], 404);
            }
            
            return redirect()->route('doctors.index')->with('error', 'Doctor not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $doctor = Doctor::with(['specialization', 'hospital', 'creator'])->findOrFail($id);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $doctor
                ], 200);
            }
            
            return view('doctors.edit', compact('doctor'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Doctor not found'
                ], 404);
            }
            
            return redirect()->route('doctors.index')->with('error', 'Doctor not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Log::info('Doctor update request received', [
                'id' => $id,
                'fullname' => $request->input('fullname'),
                'request_method' => $request->method(),
                'has_file' => $request->hasFile('profile_image'),
            ]);

            $doctor = Doctor::findOrFail($id);
            
            $request->validate([
                'fullname' => 'required|string|max:255',
                'gender' => 'required|in:male,female,other',
                'email' => 'required|email|unique:doctors,email,' . $doctor->id,
                'phone_number' => 'required|string|max:20',
                'experience' => 'required|integer|min:0',
                'specialization_id' => 'required|exists:specializations,id',
                'hospital_id' => 'required|exists:hospitals,id',
                'created_by' => 'required|exists:users,role_id',
                'joining_date' => 'required|date',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            DB::beginTransaction();

            $doctorData = $request->except('profile_image');

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                // Delete old image if it exists
                if ($doctor->profile_image) {
                    $oldImagePath = str_replace('/storage/', '', $doctor->profile_image);
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                        Log::info('Old profile image deleted', ['path' => $oldImagePath]);
                    }
                }

                $image = $request->file('profile_image');
                $imagePath = $image->store('profile_images', 'public');
                $doctorData['profile_image'] = '/storage/' . $imagePath;
                
                Log::info('New profile image uploaded', ['path' => $doctorData['profile_image']]);
            }

            $doctor->update($doctorData);

            // Load relationships for response
            $doctor->load(['specialization', 'hospital', 'creator']);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Doctor updated successfully',
                    'data' => $doctor
                ], 200);
            }

            return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Doctor update error', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update doctor: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to update doctor: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);

            DB::beginTransaction();

            // Delete profile image if it exists
            if ($doctor->profile_image) {
                $imagePath = str_replace('/storage/', '', $doctor->profile_image);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                    Log::info('Profile image deleted', ['path' => $imagePath]);
                }
            }

            $doctor->delete();

            DB::commit();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Doctor deleted successfully'
                ], 200);
            }

            return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to delete doctor: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('doctors.index')->with('error', 'Failed to delete doctor: ' . $e->getMessage());
        }
    }

    /**
     * Get all doctors for API requests
     */
    public function getAllDoctors()
    {
        try {
            $doctors = Doctor::with(['specialization', 'hospital', 'creator'])->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $doctors,
                'message' => 'Doctors fetched successfully'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch doctors: ' . $e->getMessage()
            ], 500);
        }
    }
}
