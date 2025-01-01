<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PregnantMother;

class LoginController extends Controller

{
    // Show the login form.

    public function ShowLoginForm()
    {
        //return 'Login Page Works!';
      
      return view('pregnancy.login');

    }

    //Handle login submission.
     
    public function LoginSubmission(Request $request)
{
    // Validate the login credentials
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    // Attempt to log in the user
    if (Auth::attempt($request->only('email', 'password'))) {
        // Authentication passed
        session()->flash('message', 'Login successful!');
        session()->flash('message_type', 'success');
        return redirect()->route('pregnancy.recommendations'); // Redirect to dashboard or desired route
    }

    // Authentication failed
    session()->flash('message', 'Invalid credentials. Please try again.');
    session()->flash('message_type', 'error');

    // Redirect back to the login form with input
    return back()->withInput(); // Automatically uses the previous request's input
}
}