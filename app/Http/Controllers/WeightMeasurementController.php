<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightMeasurement;

class WeightMeasurementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
        ]);

        $heightInMeters = $request->height / 100;
        $bmi = $request->weight / ($heightInMeters * $heightInMeters);

        $weightMeasurement = new WeightMeasurement();
        $weightMeasurement->weight = $request->weight;
        $weightMeasurement->height = $request->height;
        $weightMeasurement->bmi = $bmi;
        $weightMeasurement->user_id = auth()->id();
        $weightMeasurement->save();

        return response()->json(['message' => 'Podaci su uspešno sačuvani.'], 200);
    }

    public function index()
    {
        $weightMeasurements = WeightMeasurement::all();
        return response()->json($weightMeasurements);
    }
    public function getWeightMeasurementsForCurrentUser()
    {
        return WeightMeasurement::getWeightMeasurementsForCurrentUser();
    }
}