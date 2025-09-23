<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Add this at top

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Successful login → redirect with success message
            return redirect()->intended('/admin')->with('success', 'Login successful!');
        }

        // Failed login → redirect back with error
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }



    public function logout(Request $request)
    {
        $admin = auth()->guard('admin')->user();

        // Log logout activity
        if ($admin) {
            DB::table('admin_logout_activities')->insert([
                'admin_id' => $admin->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Logout
        Auth::guard('admin')->logout();

        // Clear session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to admin login with flash message
        return redirect('admin/login')->with('success', 'You have been logged out successfully.');
    }
}
