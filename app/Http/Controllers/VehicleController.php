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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = ObjectModel::with('detail_ownerable')->where('object_type_id','1')->get();
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
        $vehicle = ObjectModel::with('detail_ownerable')->where('id', $id)->first();
        if(Auth::id() != $vehicle->user_id){
            return back();
        }else{

            $parts = Element::with(
                                'details_ownerable',
                                'elements_typeable', 
                                'element_category',
                                'dates')
                                ->where('object_model_id', $id)
                                ->where('elements_category_id', '1')->get();
            $overviews = Element::with(
                                'details_ownerable',
                                'elements_typeable', 
                                'element_category',
                                'dates')
                                ->where('object_model_id', $id)
                                ->where('elements_category_id', '2')->get();
            $insurances = Element::with(
                                'details_ownerable',
                                'elements_typeable', 
                                'element_category',
                                'dates')
                                ->where('object_model_id', $id)
                                ->where('elements_category_id', '3')->get();
            //dd($vehicle, $parts, $overviews, $insurances);
            return view('vehicles.show', compact('vehicle', 'parts', 'insurances', 'overviews'));
        }        
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

        return redirect()->route('vehicles.index')->with('success', 'Pojazd został usunięty');
    }
}
