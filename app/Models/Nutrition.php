<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; 

class Nutrition extends Model
{
    use HasFactory;

    protected $table = 'nutrition'; 

    protected $fillable = [
        'user_id',
        'calories',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getNutritionForCurrentUser()
    { $user = Auth::user();
            $nutritionLast = Nutrition::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            
            return response()->json($nutritionLast , 200);
     }
}
