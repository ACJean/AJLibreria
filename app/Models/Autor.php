<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'tbl_autor';
    protected $primaryKey = 'aut_id';

    protected $fillable = ['aut_nombres', 'aut_apellidos'];
    protected $attributes = ['aut_estado_registro' => 1];

    public $timestamps = true;

    const CREATED_AT = 'aut_fhr';
    const UPDATED_AT = 'aut_fhm';

    public function libros() {
        return $this->belongsToMany('App\Models\Libro', 'tbl_autor_libro', 'aul_aut_id', 'aul_lib_id')
        ->withPivot('aul_estado_registro')->withTimestamps('aul_fhr', 'aul_fhm');
    }
}
