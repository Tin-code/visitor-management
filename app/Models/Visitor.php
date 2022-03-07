<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'num_piece',
        'type_piece',
        'image',
    ];

    // public function reception()
    // {
    //     return $this->hasOne(User::class);
    // }
}
