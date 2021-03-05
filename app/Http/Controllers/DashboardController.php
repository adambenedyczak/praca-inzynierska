<?php

namespace App\Http\Controllers;

use App\Models\ObjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $vehicles = ObjectModel::where('user_id', $user_id)
                                ->where('object_type_id', '1')
                                ->get();
        $vehicles_quantity = $vehicles->count();
        $trailers = ObjectModel::where('user_id', $user_id)
                                ->where('object_type_id', '2')
                                ->get();
        $trailers_quantity = $trailers->count();
        $engines = ObjectModel::where('user_id', $user_id)
                                ->where('object_type_id', '3')
                                ->get();
        $engines_quantity = $engines->count();
        return view('dashboard', compact('vehicles', 'trailers', 'engines'));
    }
}
