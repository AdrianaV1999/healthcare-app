<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lek extends Model
{
    use HasFactory;

    protected $table = 'lekovi';


    protected $fillable = ['user_id', 'ime_pacijenta', 'naziv', 'vreme', 'kolicina'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
