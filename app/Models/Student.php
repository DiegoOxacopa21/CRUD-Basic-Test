<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    // Para crear registros mediante arrays
    protected $fillable = [
        'codigo',
        'name',
        'surname',
        'age',
        'email'
    ];

    // Esto hereda del Eloquent\Model y ya trae varias funciones basicas Crud
}
