<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show() {
      $user = User::findOrFail(Auth::id());
      return view('auth.edit', compact('user'));
    }


    public function update(Request $request){

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'min:5','max:100'],
            'password-new' => ['string', 'min:5'],
            'password-confirm' => ['required_with:password-new', 
                                    'same:password-new','string', 'min:5'],
              'password-old' => ['required', 'string', 'min:5'],
        ]);

        $user = User::findOrFail(Auth::id());

        if(Hash::check($request->input('password-old'), $user->password)){
            try {
                $user = User::findOrFail(Auth::id());
                $user->name = $request->input('name');
                if($request->input('password-new') != null){
                    $user->password = 
                        Hash::make($request->input('password-new'));
                }
                $user->save();
                return redirect()->route('profile.show')
                    ->with('success', __('Twoje dane zostały zmienione'));
            } catch(\Illuminate\Database\QueryException $e) {

                \Log::error($e);
                return redirect()->route('profile.show')
                    ->with('warning', __('Zmiany nie zostały wprowadzone'));
            }
        }else{
            return redirect()->route('profile.show')
                    ->with('error', __('Wprowadzone hasło jest niepoprawne'));
        }
    }
}
