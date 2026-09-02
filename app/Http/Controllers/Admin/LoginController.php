<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use  App\Models\LoginHistory;

class LoginController extends Controller
{
    public function create()
    {
        return view('admin.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $userdata = [
            'email'     => $request->validated('email'),
            'password'  => $request->validated('password')
        ];
        $remember_me = ($request->has('remember')) ? true : false;

        // dd($remember_me);

        if (Auth::attempt($userdata,$remember_me)) {
            $data = [
                'user_id' => Auth::id(),
                'ip_address' => $request->ip(),
                'browser' => $request->userAgent(),
            ];

            LoginHistory::create($data);
            return $request->has('redirect-url') ? redirect()->to($request->validated('redirect-url')) : redirect()->route('admin.home');
        } else {
            return back()->with([
                'status' => 'failed',
                "message" => "Authentication failed",
            ]);
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('admin.auth.login');
    }
}
