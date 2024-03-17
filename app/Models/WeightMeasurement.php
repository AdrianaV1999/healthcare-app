<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 

class WeightMeasurement extends Model
{
    protected $fillable = ['weight', 'height', 'bmi', 'user_id'];

    public static function getWeightMeasurementsForCurrentUser()
    { $user = Auth::user();
            $weightMeasurements = WeightMeasurement::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            
            return response()->json($weightMeasurements , 200);
     }
}
