<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    protected $table = 'tbl_editorial';
    protected $primaryKey = 'edi_id';

    protected $fillable = ['edi_nombre'];
    protected $attributes = ['edi_estado_registro' => 1];

    public $timestamps = true;

    const CREATED_AT = 'edi_fhr';
    const UPDATED_AT = 'edi_fhm';

    public function libros() {
        return $this->hasMany('App\Models\Libro', 'lib_edi_id', 'edi_id');
    }

}
