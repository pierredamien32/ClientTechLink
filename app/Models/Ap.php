<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ap extends Model
{
    use HasFactory;
    protected $table = 'aps';
    protected $fillable = [
        'nom_ap',
        'site_id'
    ];

    public function site(){
        return $this->belongsTo(Site::class);
    }

    public function radios(){
        return $this->hasMany(Radio::class);
    }
}
