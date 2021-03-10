<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\ObjectModel;
use Illuminate\Http\Request;
use App\Models\ObjectDetailType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateVehicleRequest;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = ObjectModel::with('detail_ownerable')->where('object_type_id','1')->get();
        
        //dd($vehicles);

        /*dd($vehicles[1]->detail_ownerable[2]->own_name, $vehicles[1]->detail_ownerable[2]->value);



        foreach($vehicles[1]->detail_ownerable as $detail){
            dd( $detail->value, $detail->detail_typeable->name);
        }*/

        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = ObjectModel::findOrFail($id);
        $vehicle->delete();

        return back()->with('success', 'Pojazd został usunięty');
    }
}
