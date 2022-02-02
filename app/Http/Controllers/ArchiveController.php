<?php

namespace App\Http\Controllers;

use App\Models\ObjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function index()
    {
        $objects = ObjectModel::with('detail_ownerable')
            ->where('user_id', Auth::id())
            ->where('archival', true)
            ->orderBy('name', 'ASC')
            ->get();
        return view('archive.index', compact('objects'));
    }
}
