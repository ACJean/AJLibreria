<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = 'tbl_configuracion';
    protected $primaryKey = 'con_id';

    protected $fillable = ['con_nombre', 'con_descripcion', 'con_valor_texto', 'con_valor_numerico'];
    protected $attributes = ['con_estado_registro' => 1];

    public $timestamps = true;

    const CREATED_AT = 'con_fhr';
    const UPDATED_AT = 'con_fhm';
}
