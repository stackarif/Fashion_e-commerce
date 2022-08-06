<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Events\CustomerRegisterEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return 1;
        return view('Frontend.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // return $request->date_of_birth;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone' => 'required|string|min:8|max:11',
            'password' => ['required', 'confirmed'],
            'date_of_birth' => ['required', 'before_or_equal:today'],
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'date_of_birth' => $request->date_of_birth
        ]);

        event(new CustomerRegisterEvent($customer));
        //session()->flash('success', 'Complate Your Registration');

        if ( Auth::guard('customer')->login($customer)) {
            $request->session()->regenerate();
            return redirect(RouteServiceProvider::CUSTOMER_HOME);
        } else {
            return back()->withErrors(['email' => 'Something is wrong!!']);
        }
        // Auth::guard('customer')->login($customer);
        // return redirect(RouteServiceProvider::CUSTOMER_HOME);

    }
}
 