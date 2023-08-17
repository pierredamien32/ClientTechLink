<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    protected $table = 'sites';
    protected $fillable = [
        'nom_site',
        'local_latitude',
        'local_longitude',
    ];

    public function aps(){
        return $this->hasMany(Ap::class);
    }
}
