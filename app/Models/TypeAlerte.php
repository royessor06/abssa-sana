<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeAlerte extends Model
{
    protected $fillable=[
        'nom_alerte'
    ];

    public function alertes()
    {
        return $this->hasMany(Alerte::class);
    }
}
