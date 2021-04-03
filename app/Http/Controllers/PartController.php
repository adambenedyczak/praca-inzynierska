<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Element;
use App\Models\PartType;
use App\Models\ObjectModel;
use Illuminate\Http\Request;
use App\Models\PartDetailType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePartRequest;

class PartController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $owner)
    {
        $owner = ObjectModel::where('id', $owner)->first();
        $id = 1; //określa rodzaj obiektu (pojazd/przyczepa/maszyna)
        if($owner){
            $parent = $owner->id;
            if($owner->user_id == Auth::id()){       
                return view('parts.create', compact('parent', 'id'));
            }else{
                return back();
            }   
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
    public function store(StorePartRequest $request)
    {
        $part_category = $request->route('id');
        $part_parent = $request->route('owner');
        $user = Auth::user()->id;
        
        
        $part = new PartType;

        $element = new Element;
        $element->name = $request->part_name;
        $element->object_model_id = $part_parent;
        $element->elements_category_id = $part_category;
        $element->elements_typeable_type = get_class($part);
        $element->elements_typeable_id = $request->part_type;                
        $element->save();

        $PDT = new PartDetailType;

        foreach($request->addDetails as $detail){
            if($detail['detail_type_id'] != null && $detail['value'] != null){
                $new_detail = new Detail;
                $new_detail->detail_ownerable_type = get_class($element);
                $new_detail->detail_ownerable_id = $element->id;
                $new_detail->detail_typeable_type = get_class($PDT);
                $new_detail->detail_typeable_id = $detail['detail_type_id'];
                $new_detail->value = $detail['value'];
                $new_detail->save();
            }            
        }
        if(isset($request->addOwnDetails)){
            foreach($request->addOwnDetails as $detail){
                if($detail['own_name'] != null && $detail['value'] != null){
                    $new_detail = new Detail;
                    $new_detail->detail_ownerable_type = get_class($element);
                    $new_detail->detail_ownerable_id = $element->id;
                    $new_detail->own_name = $detail['own_name'];
                    $new_detail->value = $detail['value'];
                    $new_detail->save();
                }
            }
        }
        return redirect()->route('vehicles.show', $part_parent);
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
        //
    }
}
