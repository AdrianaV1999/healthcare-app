<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nutrition;

class NutritionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'calories' => 'required|numeric|min:0',
        ]);

        $nutrition = new Nutrition();
        $nutrition->user_id = auth()->id(); 
        $nutrition->calories = $request->calories;
        $nutrition->save();

      
        return response()->json(['message' => 'Uspesno uneti podaci'], 201);
    }

    public function index()
    {
        $nutritions = Nutrition::all();
        return response()->json($nutritions);
    }
    public function getNutritionForCurrentUser()
    {
        return Nutrition::getNutritionForCurrentUser();
    }

}