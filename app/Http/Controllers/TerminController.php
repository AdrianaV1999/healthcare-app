<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Termin;
use Illuminate\Http\Request;

class TerminController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'datum' => 'required|date',
            'vreme' => 'required',
            'razlog' => 'required',
            'lekar' => 'required|exists:users,id,role_as,2', 
        ]);

        $appointment = new Termin();
        $appointment->user_id = auth()->user()->id; 
        $appointment->doctor_id = $request->lekar; 
        $appointment->date = $request->datum;
        $appointment->time = $request->vreme;
        $appointment->reason = $request->razlog;
        $appointment->save();

        return response()->json(['message' => 'Termin uspešno zakazan'], 201);
    }


    public function terminiZaLekara($lekar)
{
    $termini = Termin::where('doctor_id', $lekar)
                    ->with('korisnik') 
                    ->get();

    return response()->json($termini);
}
public function prihvatiTermin(Request $request, Termin $termin)
{
    $termin->status = 'Prihvaćen';
    $termin->save();

    return response()->json(['message' => 'Termin je uspešno prihvaćen.']);
}

public function odbijTermin(Request $request, Termin $termin)
{
    $termin->status = 'Odbijen';
    $termin->save();

    return response()->json(['message' => 'Termin je uspešno odbijen.']);
}
public function mojiTermini()
{
    $user = auth()->user(); 
    $termini = $user->termini;

    return response()->json($termini);
}

public function terminiPrihvaceniZaLekara(Request $request, $lekar)
    {
        $termini = Termin::where('doctor_id', $lekar)->where('status', 'Prihvaćen')->get();
        
        return response()->json($termini);
    }
}
