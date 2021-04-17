<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ObjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $favs = ObjectModel::where('user_id', Auth::id())->where('favourite', true)->get();
        $user = User::where('id', Auth::id())->first();
        if($user->email_verified_at == null){
            $mustVerify = true;
        }else{
            $mustVerify = false;
        }
        return view('dashboard', compact('favs', 'mustVerify', 'user'));
    }
}
