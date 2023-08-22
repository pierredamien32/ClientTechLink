<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    use HasFactory;
    protected $table = 'radios';
    protected $fillable = [
        'nom_radio',
        'adresse_radio',
        'signal',
        'passerelle',
        'masque',
        'ap_id',
        'emplacement_id'
    ];

    public function ap(){
        return $this->belongsTo(Ap::class);
    }

    public function emplacement()
    {
        return $this->belongsTo(Emplacement::class);
    }
}
