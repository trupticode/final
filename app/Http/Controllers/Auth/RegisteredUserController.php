<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        // Check if is_admin field is present and its value is not '0'
        //  if($request->input('is_admin') == 0)
        // {
        //     $is_admin =false;
        // }
        // else{
        //     $is_admin =true;
        // }

         // Determine if the checkbox is checked
        //  $is_admin = $request->has('is_admin');
        //  $is_admin = $request->has('is_admin') ? 1 : 0;
          // Convert boolean to integer
          $is_admin = $request->has('is_admin') ? true : false;
         
         // Use filter_var to cast the input value to a boolean
        //   $is_admin = filter_var($request->input('is_admin'), FILTER_VALIDATE_BOOLEAN);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $is_admin, // Set is_admin based on checkbox selection
        ]);

        // dd($user);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME);
    }
    


}
