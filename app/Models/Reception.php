<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visitor_id',
        'motif',
        'date_day',
        'date_coming',
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function visitor()
    {
        return $this->hasMany(Visitor::class);
    }


}
