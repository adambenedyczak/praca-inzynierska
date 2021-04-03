<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Element;
use App\Models\ObjectModel;
use Illuminate\Http\Request;
use App\Models\ObjectDetailType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateVehicleRequest;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = ObjectModel::with('detail_ownerable')
                                ->where('user_id', Auth::id())
                                ->where('object_type_id','1')
                                ->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function show($id)
    {
        $vehicle = ObjectModel::with('detail_ownerable')->where('id', $id)->first();
        if($vehicle == null){
            return back();
        }else if(Auth::id() != $vehicle->user_id){
            return back();
        }else{
            return view('vehicles.show', compact('vehicle'));
        }        
    }
}
