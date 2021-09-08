<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'image',
        'user_id'
    ];

    public function user() {
        return $this->hasOne(User::class);
    }
}
