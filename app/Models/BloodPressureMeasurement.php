<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BloodPressureMeasurement extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'upper_pressure', 
        'lower_pressure', 
        'pulse', 
    ];

    public static function getPreviousMeasurements()
    {
        $user = Auth::user();
        $measurements = BloodPressureMeasurement::where('user_id', $user->id)
            ->orderBy('measurement_date', 'desc')
            ->get();
        
        return response()->json($measurements, 200);
    }
}
