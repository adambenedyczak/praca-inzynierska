<?php

namespace App\Http\Controllers;

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
        return view('dashboard', compact('favs'));
    }
}
