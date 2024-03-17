<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SleepHour;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SleepHourController;

class SleepHourController extends Controller
{
   
    public function store(Request $request)
    {
        $request->validate([
            'hours_slept' => 'required|numeric|min:0',
        ]);

        $sleepHour = new SleepHour();
        $sleepHour->user_id = Auth::id();
        $sleepHour->hours_slept = $request->hours_slept;
        $sleepHour->save();

        return response()->json(['message' => 'Podaci o satima spavanja su uspešno sačuvani.'], 200);
    }

    public function index()
{
    $user = auth()->user();
    $sleepHours = SleepHour::where('user_id', $user->id)->get();
    return response()->json($sleepHours, 200);
}

}