<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'specijalizacija' => 'required|string|max:255',
            'user_id' => 'required|integer', 
        ]);
    
        $doctor = Doctor::create($validatedData);
        
    
        return response()->json(['message' => 'Doktor je uspesno kreiran', 'data' => $doctor], 201);
    }
    
    public function index()
    {
        $doctors = Doctor::all();
        return response()->json($doctors);
    }

    public function delete($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return response()->json(['message' => 'Doctor je uspesno izbrisan'], 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'specijalizacija' => 'required|string|max:255',
            'user_id' => 'required|integer',
        ]);
    
        $doctor = Doctor::findOrFail($id);
        $doctor->update($validatedData);
    
        return response()->json(['message' => 'Uspesna izmena doktora', 'data' => $doctor], 200);
    }
    
    public function vratiLekara()
    {
        return Doctor::vratiLekara();
    }
}