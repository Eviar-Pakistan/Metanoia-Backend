<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $specializations = Specialization::all();
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $specializations
                ], 200);
            }
            
            return view('specializations.index', compact('specializations'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch specializations: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to fetch specializations: ' . $e->getMessage());
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
                'message' => 'Ready to create specialization'
            ]);
        }
        
        return view('specializations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Specialization store request received', [
                'name' => $request->input('name'),
                'request_method' => $request->method(),
            ]);

            $request->validate([
                'name' => 'required|string|max:255|unique:specializations,name'
            ]);

            $specialization = Specialization::create([
                'name' => $request->name
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Specialization created successfully',
                    'data' => $specialization
                ], 201);
            }

            return redirect()->route('specializations.index')->with('success', 'Specialization created successfully');

        } catch (\Exception $e) {
            Log::error('Specialization creation error', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create specialization: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to create specialization: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $specialization = Specialization::findOrFail($id);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $specialization
                ], 200);
            }
            
            return view('specializations.show', compact('specialization'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Specialization not found'
                ], 404);
            }
            
            return redirect()->route('specializations.index')->with('error', 'Specialization not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $specialization = Specialization::findOrFail($id);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $specialization
                ], 200);
            }
            
            return view('specializations.edit', compact('specialization'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Specialization not found'
                ], 404);
            }
            
            return redirect()->route('specializations.index')->with('error', 'Specialization not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Log::info('Specialization update request received', [
                'id' => $id,
                'name' => $request->input('name'),
                'request_method' => $request->method(),
            ]);

            $specialization = Specialization::findOrFail($id);
            
            $request->validate([
                'name' => 'required|string|max:255|unique:specializations,name,' . $specialization->id
            ]);

            $specialization->update([
                'name' => $request->name
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Specialization updated successfully',
                    'data' => $specialization
                ], 200);
            }

            return redirect()->route('specializations.index')->with('success', 'Specialization updated successfully');

        } catch (\Exception $e) {
            Log::error('Specialization update error', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update specialization: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to update specialization: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $specialization = Specialization::findOrFail($id);
            $specialization->delete();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Specialization deleted successfully'
                ], 200);
            }

            return redirect()->route('specializations.index')->with('success', 'Specialization deleted successfully');

        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to delete specialization: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('specializations.index')->with('error', 'Failed to delete specialization: ' . $e->getMessage());
        }
    }

    /**
     * Get all specializations for API requests
     */
    public function getAllSpecializations()
    {
        try {
            $specializations = Specialization::all();
            
            return response()->json([
                'status' => 'success',
                'data' => $specializations,
                'message' => 'Specializations fetched successfully'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch specializations: ' . $e->getMessage()
            ], 500);
        }
    }
}
