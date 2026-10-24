<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [
        'alerte_id',
        'intitule',
        'detail'
    ];

    public function alerte()
    {
        return $this->belongsTo(Alerte::class);
    }
}
