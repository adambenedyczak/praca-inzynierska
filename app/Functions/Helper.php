<?php

namespace App\Functions;

use App\Models\ObjectModel;
use Illuminate\Support\Facades\Auth;

class Helper
{

    public static function vehicles_quantity()
    {
        $user_id = Auth::user()->id;

        $vehicles = ObjectModel::where('user_id', $user_id)
                                ->where('object_type_id', '1')
                                ->count();
        return $vehicles;
    }

    public static function trailers_quantity()
    {
        $user_id = Auth::user()->id;

        $vehicles = ObjectModel::where('user_id', $user_id)
                                ->where('object_type_id', '2')
                                ->count();
        return $vehicles;
    }

    public static function engines_quantity()
    {
        $user_id = Auth::user()->id;

        $vehicles = ObjectModel::where('user_id', $user_id)
                                ->where('object_type_id', '3')
                                ->count();
        return $vehicles;
    }
}
