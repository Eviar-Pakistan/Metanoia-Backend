<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $departments = Department::all();
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $departments
                ], 200);
            }
            
            return view('departments.index', compact('departments'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch departments: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to fetch departments: ' . $e->getMessage());
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
                'message' => 'Ready to create department'
            ]);
        }
        
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Department store request received', [
                'name' => $request->input('name'),
                'request_method' => $request->method(),
            ]);

            $request->validate([
                'name' => 'required|string|max:255|unique:departments,name'
            ]);

            $department = Department::create([
                'name' => $request->name
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Department created successfully',
                    'data' => $department
                ], 201);
            }

            return redirect()->route('departments.index')->with('success', 'Department created successfully');

        } catch (\Exception $e) {
            Log::error('Department creation error', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create department: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to create department: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $department = Department::findOrFail($id);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $department
                ], 200);
            }
            
            return view('departments.show', compact('department'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Department not found'
                ], 404);
            }
            
            return redirect()->route('departments.index')->with('error', 'Department not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $department = Department::findOrFail($id);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $department
                ], 200);
            }
            
            return view('departments.edit', compact('department'));
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Department not found'
                ], 404);
            }
            
            return redirect()->route('departments.index')->with('error', 'Department not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            Log::info('Department update request received', [
                'id' => $id,
                'name' => $request->input('name'),
                'request_method' => $request->method(),
            ]);

            $department = Department::findOrFail($id);
            
            $request->validate([
                'name' => 'required|string|max:255|unique:departments,name,' . $department->id
            ]);

            $department->update([
                'name' => $request->name
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Department updated successfully',
                    'data' => $department
                ], 200);
            }

            return redirect()->route('departments.index')->with('success', 'Department updated successfully');

        } catch (\Exception $e) {
            Log::error('Department update error', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update department: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to update department: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->delete();

            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Department deleted successfully'
                ], 200);
            }

            return redirect()->route('departments.index')->with('success', 'Department deleted successfully');

        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to delete department: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('departments.index')->with('error', 'Failed to delete department: ' . $e->getMessage());
        }
    }

    /**
     * Get all departments for API requests
     */
    public function getAllDepartments()
    {
        try {
            $departments = Department::all();
            
            return response()->json([
                'status' => 'success',
                'data' => $departments,
                'message' => 'Departments fetched successfully'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch departments: ' . $e->getMessage()
            ], 500);
        }
    }
}
