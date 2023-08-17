<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routeur extends Model
{
    use HasFactory;
    protected $table = 'routeurs';
    protected $fillable = [
        'nom_routeur',
        'adresse_routeur',
        'marque',
        'modele',
        'passerelle',
        'masque',
        'emplacement_id'
    ];

    public function emplacement()
    {
        return $this->belongsTo(Emplacement::class);
    }
}
