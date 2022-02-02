<?php

namespace App\Http\Controllers;

use App\Models\ObjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MachineController extends Controller
{
    public function index()
    {
        $machines = ObjectModel::with('detail_ownerable')
            ->where('user_id', Auth::id())
            ->where('object_type_id', '3')
            ->where('archival', false)
            ->orderBy('name', 'ASC')
            ->get();
        return view('machines.index', compact('machines'));
    }

    public function show($id, $openSection)
    {
        $machine = ObjectModel::with('detail_ownerable')->where('id', $id)->first();
        if ($machine == null) {
            return back();
        } else if (Auth::id() != $machine->user_id) {
            return back();
        } else {
            return view('machines.show', compact('machine', 'openSection'));
        }
    }
}
