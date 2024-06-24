<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Listings;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    // Fungsi show untuk menampilkan detail user
    public function show()
    {
        return view("user.userDetails");
    }

    // Fungsi update untuk memperbarui detail pengguna
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,name,' . auth()->id(), // Update the unique rule
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'currentPassword' => 'nullable|string|min:8', // Optional: Current password
            'newPassword' => ['nullable', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()], // New password validation
        ]);

        if ($validator->fails()) {
            return redirect()->route('user')->withErrors($validator)->withInput();
        }

        $user = auth()->user();
        $originalUsername = $user->name;

        if ($request->filled('currentPassword') && !Hash::check($request->currentPassword, $user->password)) {
            return redirect()->back()->withErrors(['currentPassword' => 'The current password is incorrect.'])->withInput();
        }

        if ($request->filled('newPassword')) {
            $user->password = Hash::make($request->newPassword);
        }

        $this->saveUserDetails(auth()->user(), $request->all());
        Listings::where('name', $originalUsername)->update(['name' => $user->name]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    // Fungsi saveUserDetails untuk menyimpan detail pengguna
    private function saveUserDetails(User $user, array $data)
    {
        $user->name = $data['username'];
        $user->email = $data['email'];
        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();
    }

    // Fungsi delete untuk menghapus akun pengguna
    public function delete()
    {
        $userId = auth()->id();

        Listings::where('name', auth()->user()->name)->delete();
        User::destroy($userId);

        return redirect()->route('home')->with('success', 'Your account has been deleted successfully.');
    }
}
