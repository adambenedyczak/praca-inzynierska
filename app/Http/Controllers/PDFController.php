<?php

namespace App\Http\Controllers;

use PDF;

use Carbon\Carbon;
use App\Models\Detail;
use App\Models\Element;
use App\Models\ObjectModel;
use Illuminate\Http\Request;
use App\Models\WorkTimeHistory;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function generate($id, $p, $o, $i, $h)
    {

        $object = ObjectModel::with('detail_ownerable', 'work_time_unit')
                            ->where('id', $id)
                            ->first();

        if($object == null){
            return back();
        }else if(Auth::id() != $object->user_id){
            return back();
        }else{
            if($p == 1){
                $parts = Element::with(
                    'detail_ownerable',
                    'elements_typeable',
                    'element_category',
                    'events')
                ->where('object_model_id', $id) 
                ->where('elements_category_id', 1)
                ->orderBy('elements_typeable_id')
                ->orderBy('name')->get();
            }else{
                $parts = null;
            }
            if($o == 1){
                $overviews = Element::with(
                    'detail_ownerable',
                    'elements_typeable', 
                    'element_category',
                    'events')
                ->where('object_model_id', $id) 
                ->where('elements_category_id', 2)
                ->orderBy('elements_typeable_id')
                ->orderBy('name')->get();
            }else{
                $overviews = null;
            }
            if($i == 1){
                $insurances = Element::with(
                    'detail_ownerable',
                    'elements_typeable', 
                    'element_category',
                    'events')
                ->where('object_model_id', $id) 
                ->where('elements_category_id', 3)
                ->orderBy('elements_typeable_id')
                ->orderBy('name')->get();
            }else{
                $insurances = null;
            }       

            $workTimeValue = WorkTimeHistory::where('object_model_id', $id)->orderBy('created_at', 'desc')->first();
            $details = Detail::where('detail_ownerable_type', get_class($object))
                        ->where('detail_ownerable_id', $id)
                        ->whereNull('own_name')
                        ->orderBy('detail_typeable_id')->get();

            $ownDetails = Detail::where('detail_ownerable_type', get_class($object))
                        ->where('detail_ownerable_id', $id)
                        ->whereNotNull('own_name')->get();

            $workTimeHistory = WorkTimeHistory::where('object_model_id', $id)->orderBy('created_at', 'desc')->get();
            
            $currentDate = Carbon::now()->tostring();
            
            $pdf = PDF::loadView('pdf.pdf', compact('object', 'parts', 'overviews', 'insurances', 'h', 'details', 'ownDetails', 'workTimeValue', 'workTimeHistory', 'currentDate'));

            $nazwa = 'Informacje o '. $object->name .'.pdf';
            return $pdf->stream($nazwa);   
        }
    }
}
