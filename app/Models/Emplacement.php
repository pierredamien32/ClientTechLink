<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplacement extends Model
{
    use HasFactory;
    protected $table = 'emplacements';
    protected $fillable = [
        'nom_emplacement',
        'local_latitude',
        'local_longitude',
        'client_id'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function routeur()
    {
        return $this->hasOne(Routeur::class);
    }

    public function radio()
    {
        return $this->hasOne(Radio::class);
    }
}
