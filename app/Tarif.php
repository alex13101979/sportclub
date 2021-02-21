<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarifs';
    protected $fillable = ['name'];
}
