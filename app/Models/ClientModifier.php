<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientModifier extends Model
{
    use HasFactory;

    protected $table = 'client_modifiers';
     protected $fillable = [
        'user_id', 
        'client_id'
    ];
}
