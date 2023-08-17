<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable = [
        'nom',
        'prenom',
        'denomination',
        'type_client',
        'code_anyx',
        'code_befra',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function emplacements(){
        return $this->hasMany(Emplacement::class);
    }
}
