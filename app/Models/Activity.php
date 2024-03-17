<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 

class Activity extends Model
{
    use HasFactory;

    protected $table = 'aktivnosti';

    protected $fillable = ['user_id', 'steps', 'calories'];

    public static function getPreviousActivities()
    {
        $user = Auth::user();
        $activties = Activity::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json($activties, 200);
    }

}