<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'role' => 'user',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    
    }
    public function show()
    {
        $user = Auth::user();
        dd($user);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified encadrant.
     *
     * @param  \App\Models\Encadrant  $encadrant
     * @return \Illuminate\View\View
     */
    public function edit(Encadrant $encadrant)
    {
        $this->authorize('update', $encadrant);

        return view('encadrants.edit', compact('encadrant'));
    }

    /**
     * Update the specified encadrant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Encadrant  $encadrant
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Encadrant $encadrant)
    {
        $this->authorize('update', $encadrant);

        $encadrantData = $request->validate([
            'nom'        => 'required|max:60',
            'prenom' => 'required|max:60',
            'tel'        => 'required|max:2',
            'email'        => 'required|max:60',
            'status'        => 'required|max:60',
        
        ]);
        $encadrant->update($encadrantData);

        return redirect()->route('encadrants.show', $encadrant);
    }
}
