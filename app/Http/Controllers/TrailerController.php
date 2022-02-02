<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\ObjectModel;
use Illuminate\Http\Request;
use App\Models\ObjectDetailType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreObjectRequest;

class TrailerController extends Controller
{
    public function index()
    {
        $trailers = ObjectModel::with('detail_ownerable')
            ->where('user_id', Auth::id())
            ->where('object_type_id', '2')
            ->where('archival', false)
            ->orderBy('name', 'ASC')
            ->get();
        return view('trailers.index', compact('trailers'));
    }

    public function show($id, $openSection)
    {
        $trailer = ObjectModel::with('detail_ownerable')->where('id', $id)->first();
        if ($trailer == null) {
            return back();
        } else if (Auth::id() != $trailer->user_id) {
            return back();
        } else {
            return view('trailers.show', compact('trailer', 'openSection'));
        }
    }
}
