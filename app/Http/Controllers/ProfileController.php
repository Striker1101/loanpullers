<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        return view("user.index", compact("user"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view("user.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max file size: 2MB
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's name and email
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Check if a new profile photo was uploaded
        if ($request->hasFile('profile_photo')) {
            // Store the uploaded profile photo
            $profilePhotoPath = $request->file('profile_photo')->store('profile-photos', 'public');

            // Update the user's profile photo path
            $user->profile_photo_path = $profilePhotoPath;
        }

        // Save the updated user details
        $user->save();

        // Redirect back to the profile page with a success message
        return redirect()->route('user.index')->with('success', 'Profile updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Deleted Succussfully ');
    }
}
