<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Display authenticated user settings.
     *
     * @return Response
     */
    public function show()
    {
        if (!Auth::check()) return redirect('/login');

        return view('pages.settings', ['user' => Auth::user()]);
    }

    /**
     * Updates the information of a user.
     *
     * @param  Request request containing the new state
     * @return Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'nullable|string|max:30',
            'email' => 'required|unique:users,email,'.$user->id.'|email|max:255',
            'username' => 'required|string|unique:users,username,'.$user->id.'|max:15',
            'birthdate' => 'nullable|date'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = strtolower($request->input('username'));
        $user->birthdate = $request->input('birthdate');
        $user->save();

        return response(200);
    }

    /**
     * Updates the user's password.
     *
     * @param  Request request containing the new state
     * @return Response
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => [
                    'password' => ['Current password doesn\'t match.']
                ]
            ]);
        }

        $request->validate([
            'new_password' => 'required|string|min:6|confirmed'
        ]);

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response(200);
    }
}
