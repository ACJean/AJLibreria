<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'tbl_libro';
    protected $primaryKey = 'lib_id';

    protected $fillable = ['lib_isbn', 'lib_titulo', 'lib_anio_publicacion', 'lib_precio', 'lib_edi_id'];
    protected $attributes = ['lib_estado_registro' => 1];

    public $timestamps = true;

    const CREATED_AT = 'lib_fhr';
    const UPDATED_AT = 'lib_fhm';

    public function editorial()
    {
        return $this->belongsTo('App\Models\Editorial', 'lib_edi_id', 'edi_id');
    }

    public function autores() {
        return $this->belongsToMany('App\Models\Autor', 'tbl_autor_libro', 'aul_lib_id', 'aul_aut_id')
        ->withPivot('aul_estado_registro')->withTimestamps('aul_fhr', 'aul_fhm');
    }
}
