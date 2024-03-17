<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termin extends Model
{
    use HasFactory;

    protected $table = 'appointments';


    protected $fillable = ['datum', 'vreme', 'razlog', 'lekar'];

    public function korisnik()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
