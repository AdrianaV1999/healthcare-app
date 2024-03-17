<?php

namespace App\Http\Controllers;

use App\Models\BloodPressureMeasurement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 

class BloodPressureMeasurementController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'upper_pressure' => 'required|numeric',
            'lower_pressure' => 'required|numeric',
            'pulse' => 'required|numeric',
        ]);

        $measurement = new BloodPressureMeasurement();
        $measurement->user_id =  auth()->id(); 
        $measurement->upper_pressure = $validatedData['upper_pressure'];
        $measurement->lower_pressure = $validatedData['lower_pressure'];
        $measurement->pulse = $validatedData['pulse'];
        $measurement->measurement_date = now(); 

        $measurement->save(); 

        return response()->json(['message' => 'Merenje krvnog pritiska je uspesno sacuvano'], 200);
    }
    public function getPreviousMeasurements()
    {
        return BloodPressureMeasurement::getPreviousMeasurements();
    }

}
