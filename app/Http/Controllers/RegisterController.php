<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * @desc Show register form
     * @route GET /register
     * @method GET
     * @return View
     */
    public function register(): View
    {
       return view('auth.register');
    }

    /**
     * @desc Store user in database
     * @route POST /register
     * @method POST
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => "required|string|min:8|confirmed"
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);
        return redirect()->route('login')->with('success', 'Account created successfully! Please login.');
    }
}
