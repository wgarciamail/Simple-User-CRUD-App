<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    function login(Request $request) {
        $incomingField = $request->validate(
            [
                "loginname" =>'required|string|',
                "loginpassword"  => 'required'
            ]
        );
        if (auth()->attempt(['name' => $incomingField['loginname'], 'password' => $incomingField['loginpassword']])) {
            $request->session()->regenerate();
        }        
        return redirect('/');

    }
    
    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required','min:3', ':10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required',
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/');
    }
}
