<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Listings;

class UserController extends Controller
{
    public function show()
    {
        return view("user.userDetails");
    }

    public function update(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();
        $originalUsername = $user->name;

        // Update the user details using the custom save method
        $this->saveUserDetails(auth()->user(), $request->all());

        Listings::where('name', $originalUsername)->update(['name' => $user->name]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    private function saveUserDetails(User $user, array $data)
    {
        $user->name = $data['username'];
        $user->email = $data['email'];
        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();
    }
}
