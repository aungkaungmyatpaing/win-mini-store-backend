<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * redirect to domain link
     *
     * @return void
     */
    public function domain()
    {
        return redirect()->route('login');
    }

    /**
     * redirect to login from
     *
     * @return void
     */
    public function loginForm()
    {
        return Auth::check() ? redirect()->route('dashboard') : view('backend.auth.login');
    }

    /**
     * User Login
     *
     * @return void
     */
    public function userLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        return Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember) ? redirect()->route('dashboard') : back()->with('fail', 'Invalid Credentials');
    }

    /**
     * Logout
     *
     * @param  Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function profileEdit()
    {
        return view('backend.auth.edit');
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Updated Successfully');
    }
}
