<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ime',
        'prezime',
        'specijalizacija',
        'user_id',
    ];

    public static function vratiLekara()
    {
        $user = Auth::user();
        $doctor = Doctor::where('user_id', $user->id)
                        ->latest() 
                        ->first(); 
    
        return response()->json($doctor, 200);
    }
}