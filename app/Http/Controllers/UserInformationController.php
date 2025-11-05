<?php

namespace App\Http\Controllers;

use App\Models\UserInformation;
use Illuminate\Http\Request;

class UserInformationController extends Controller
{
    /**
     * Display all user information records.
     */
    public function index()
    {
        $informations = UserInformation::all();
        return view('user_information.index', compact('informations'));
    }

    /**
     * Show the form for creating new user information.
     */
    public function create()
    {
        return view('user_information.create');
    }

    /**
     * Store a newly created user information record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service'   => 'required|string|max:255',
            'date'      => 'required|date',
            'time'      => 'required',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:20',
            'age'       => 'required|integer|min:0',
            'gender'    => 'required|string|max:10',
            'symptom'   => 'nullable|string',
        ]);

        UserInformation::create($request->all());

        return redirect()->route('user_information.index')
                         ->with('success', 'User information added successfully!');
    }

    /**
     * Display a single user information record.
     */
    public function show($id)
    {
        $information = UserInformation::findOrFail($id);
        return view('user_information.show', compact('information'));
    }

    /**
     * Show the form for editing an existing record.
     */
    public function edit($id)
    {
        $information = UserInformation::findOrFail($id);
        return view('user_information.edit', compact('information'));
    }

    /**
     * Update an existing user information record.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'service'   => 'required|string|max:255',
            'date'      => 'required|date',
            'time'      => 'required',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:20',
            'age'       => 'required|integer|min:0',
            'gender'    => 'required|string|max:10',
            'symptom'   => 'nullable|string',
        ]);

        $information = UserInformation::findOrFail($id);
        $information->update($request->all());

        return redirect()->route('user_information.index')
                         ->with('success', 'User information updated successfully!');
    }

    /**
     * Delete a user information record.
     */
    public function destroy($id)
    {
        $information = UserInformation::findOrFail($id);
        $information->delete();

        return redirect()->route('user_information.index')
                         ->with('success', 'User information deleted successfully!');
    }
}
