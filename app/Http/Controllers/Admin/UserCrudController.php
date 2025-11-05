<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCrud;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = UserCrud::orderBy('name')->get();
            return view('admin.manage-users', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return view('admin.manage-users', ['users' => collect()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view with empty form/modal; list view handles modal so redirect to index
        return redirect()->route('admin.manage-users');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:user_login,email',
                'password' => 'required|string|min:6',
            ]);

            $data['password'] = Hash::make($data['password']);
            $user = UserCrud::create($data);

            return response()->json([
                'message' => 'User created successfully', 
                'data' => $user
            ], Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = UserCrud::findOrFail($id);
            return response()->json(['data' => $user]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching user: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to fetch user'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // editing handled via AJAX/modal on index page
        return redirect()->route('admin.manage-users');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = UserCrud::findOrFail($id);
            
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:user_login,email,' . $user->id,
            ];

            // Only validate password if it's provided
            if ($request->filled('password')) {
                $rules['password'] = 'string|min:6';
            }

            $data = $request->validate($rules);

            // Hash password if provided
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                // Remove password from data if not provided (keep existing)
                unset($data['password']);
            }

            $user->update($data);
            
            return response()->json([
                'message' => 'User updated successfully', 
                'data' => $user->fresh()
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = UserCrud::findOrFail($id);
            $user->delete();
            
            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to delete user: ' . $e->getMessage()
            ], 500);
        }
    }
}