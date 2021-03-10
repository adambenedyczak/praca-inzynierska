<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\ObjectModel;
use Illuminate\Http\Request;
use App\Models\ObjectDetailType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreObjectRequest;

class ObjectController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        if($id>0 && $id <4){
            if ($request->session()->has('object_category')) {
                $request->session()->forget('object_category');
            }            
            $request->session()->put('object_category', $id);            
            return view('object.create', compact('id'));
        }else{
            return back();
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreObjectRequest $request)
    {
        $object_category = $request->session()->get('object_category');

        $user = Auth::user()->id;
        //dd($request);
        $obiekt = new ObjectModel;
        $obiekt->name = $request->object_name;
        $obiekt->object_type_id = $object_category;
        $obiekt->user_id = $user;
        $obiekt->work_time_unit_id = $request->object_unit;
        $obiekt->save();

        $OBT = new ObjectDetailType;

        foreach($request->addDetails as $detail){
            if($detail['detail_type_id'] != null && $detail['value'] != null){
                $new_detail = new Detail;
                $new_detail->detail_ownerable_type = get_class($obiekt);
                $new_detail->detail_ownerable_id = $obiekt->id;
                $new_detail->detail_typeable_type = get_class($OBT);
                $new_detail->detail_typeable_id = $detail['detail_type_id'];
                $new_detail->value = $detail['value'];
                $new_detail->save();
            }            
        }
        if(isset($request->addOwnDetails)){
            foreach($request->addOwnDetails as $detail){
                if($detail['own_name'] != null && $detail['value'] != null){
                    $new_detail = new Detail;
                    $new_detail->detail_ownerable_type = get_class($obiekt);
                    $new_detail->detail_ownerable_id = $obiekt->id;
                    $new_detail->own_name = $detail['own_name'];
                    $new_detail->value = $detail['value'];
                    $new_detail->save();
                }
            }
        }


        dd($obiekt->id);
        $request->session()->forget('object_category');
    }
}
