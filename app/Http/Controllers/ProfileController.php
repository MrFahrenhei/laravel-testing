<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    /**
     * @desc Update profile informations
     * @route PUT /profile
     * @method PUT
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validateData = $request->validate([
            'name' => 'required|string',
            'email'=> 'required|string|email',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if($request->hasFile('avatar')){
            if($user->avatar){
                Storage::delete('public/'. $user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('avatars', 'public');

        }
        $user->save();
        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}
