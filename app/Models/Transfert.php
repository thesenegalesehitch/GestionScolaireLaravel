<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfert extends Model
{
    protected $fillable = [
        'montant',
        'rib_source',
        'rib_destination',
    ];
}
