<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string',
            'gender' => 'required|string',
            'dateOfBirth' => 'required|date',
            'phoneNumber' => 'required|string',
        ]);

        $profile = new Profile();
        $profile->full_name = $request->fullName;
        $profile->gender = $request->gender;
        $profile->date_of_birth = $request->dateOfBirth;
        $profile->phone_number = $request->phoneNumber;
        $profile->user_id = auth()->id(); 

        $profile->save();

        return response()->json(['message' => 'Podaci profila su uspešno sacuvani'], 200);
    }

    public function getData()
    {
        $user_id = auth()->id();

        $profile = Profile::where('user_id', $user_id)->latest()->first();

        return response()->json($profile);
    }

    public function searchByName(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $name = $request->name;

        $profiles = Profile::where('full_name', 'like', '%' . $name . '%')->get();

        return response()->json($profiles);
    }
   

    public function getAllProfiles()
    {
        $profiles = Profile::all();

        return response()->json($profiles);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullName' => 'sometimes|string',
            'gender' => 'sometimes|string',
            'dateOfBirth' => 'sometimes|date',
            'phoneNumber' => 'sometimes|string',
        ]);

        $profile = Profile::findOrFail($id);

        $profile->full_name = $request->fullName;
        $profile->gender = $request->gender;
        $profile->date_of_birth = $request->dateOfBirth;
        $profile->phone_number = $request->phoneNumber;

        $profile->save();

        return response()->json(['message' => 'Podaci profila su uspešno izmenjeni'], 200);
    }

    public function delete($id)
    {
        $profile = Profile::findOrFail($id);

        $profile->delete();

        return response()->json(['message' => 'Profil je uspešno obrisan'], 200);
    }

 
}