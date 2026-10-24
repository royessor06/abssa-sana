<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    protected $fillable=[
        'marqueProduit',
        'nomProduit',
        'photoProduit',
        'distributeur',
        'motif',
        'departement',
        'statut',
        'numeroSuivi',
        'user_id',
        'matrice_id',
        'type_alerte_id'
    ];

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function typeAlerte()
    {
        return $this->belongsTo(TypeAlerte::class);
    }

    public function matrice()
    {
        return $this->belongsTo(Matrice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
