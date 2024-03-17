<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lek;

class LekoviController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ime_pacijenta' => 'required|string',
            'naziv' => 'required|string',
            'vreme' => 'required|string',
            'kolicina' => 'required|string',
        ]);

        $lek = Lek::create($validatedData);

        return response()->json(['message' => 'Lek je uspesno kreiran', 'lek' => $lek], 201);
    }

    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $lekovi = Lek::where('user_id', $user->id)->get();

        return response()->json($lekovi);
    }

}