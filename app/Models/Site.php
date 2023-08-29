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
        'local_latitude_site',
        'local_longitude_site',
    ];

    public function aps(){
        return $this->hasMany(Ap::class);
    }
}
