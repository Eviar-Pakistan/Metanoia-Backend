<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $hospitals = Hospital::with(['manager.user', 'department'])->get();
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $hospitals
                ], 200);
            }
            
            return view('hospitals.index', compact('hospitals'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch hospitals: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to fetch hospitals: ' . $e->getMessage());
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
                'message' => 'Ready to create hospital'
            ]);
        }
        
        return view('hospitals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Hospital store request received', [
                'name' => $request->input('name'),
                'request_method' => $request->method(),
            ]);

            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'email' => 'required|email|unique:hospitals,email',
                'license_number' => 'required|string|unique:hospitals,license_number',
                'established_date' => 'required|date',
                'manager_id' => 'nullable|exists:managers,id',
                'department_id' => 'nullable|exists:departments,id',
                'postal_code' => 'required|string|max:10'
            ]);

            $hospital = Hospital::create($request->all());

            // Load relationships for response
            $hospital->load(['manager.user', 'department']);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Hospital created successfully',
                    'data' => $hospital
                ], 201);
            }

            return redirect()->route('hospitals.index')->with('success', 'Hospital created successfully');

        } catch (\Exception $e) {
            Log::error('Hospital creation error', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create hospital: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to create hospital: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $hospital = Hospital::with(['manager.user', 'department'])->findOrFail($id);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $hospital
                ], 200);
            }
            
            return view('hospitals.show', compact('hospital'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Hospital not found'
                ], 404);
            }
            
            return redirect()->route('hospitals.index')->with('error', 'Hospital not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $hospital = Hospital::with(['manager.user', 'department'])->findOrFail($id);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $hospital
                ], 200);
            }
            
            return view('hospitals.edit', compact('hospital'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Hospital not found'
                ], 404);
            }
            
            return redirect()->route('hospitals.index')->with('error', 'Hospital not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Log::info('Hospital update request received', [
                'id' => $id,
                'name' => $request->input('name'),
                'request_method' => $request->method(),
            ]);

            $hospital = Hospital::findOrFail($id);
            
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'email' => 'required|email|unique:hospitals,email,' . $hospital->id,
                'license_number' => 'required|string|unique:hospitals,license_number,' . $hospital->id,
                'established_date' => 'required|date',
                'manager_id' => 'nullable|exists:managers,id',
                'department_id' => 'nullable|exists:departments,id',
                'postal_code' => 'required|string|max:10'
            ]);

            $hospital->update($request->all());

            // Load relationships for response
            $hospital->load(['manager.user', 'department']);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Hospital updated successfully',
                    'data' => $hospital
                ], 200);
            }

            return redirect()->route('hospitals.index')->with('success', 'Hospital updated successfully');

        } catch (\Exception $e) {
            Log::error('Hospital update error', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update hospital: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to update hospital: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $hospital = Hospital::findOrFail($id);
            $hospital->delete();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Hospital deleted successfully'
                ], 200);
            }

            return redirect()->route('hospitals.index')->with('success', 'Hospital deleted successfully');

        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to delete hospital: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('hospitals.index')->with('error', 'Failed to delete hospital: ' . $e->getMessage());
        }
    }

    /**
     * Get all hospitals for API requests
     */
    public function getAllHospitals()
    {
        try {
            $hospitals = Hospital::with(['manager.user', 'department'])->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $hospitals,
                'message' => 'Hospitals fetched successfully'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch hospitals: ' . $e->getMessage()
            ], 500);
        }
    }
}
