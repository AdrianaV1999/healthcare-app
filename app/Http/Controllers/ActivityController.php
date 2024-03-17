<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth; 

class ActivityController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'steps' => 'required|integer|min:0',
        'calories' => 'required|numeric|min:0',
    ]);

    try {
        $activity = new Activity();
        $activity->user_id = auth()->id(); 
        $activity->steps = $validatedData['steps'];
        $activity->calories = $validatedData['calories'];
        $activity->save();

        return response()->json(['message' => 'Aktivnost je kreirana uspesno!', 'data' => $activity], 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Greska prilikom kreiranja aktivnosti!', 'error' => $e->getMessage()], 500);
    }
}

    public function index()
    {
    $user = Auth::user(); 
    $activities = Activity::where('user_id', $user->id)->get(); 
    return response()->json($activities);
    }
    public function getPreviousActivities()
    {
        return Activity::getPreviousActivities();
    }
}
