<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function save(Request $request)
    {
        $input = $request->all();
        $mensaje = "";
        $success = true;
        try {
            DB::beginTransaction();
            $configuracion = Configuracion::where('con_nombre', '=', 'DESCUENTO')->first();
            if ($configuracion != null) {
                $configuracion->update(['con_valor_numerico' => $input['descuento']]);
            } else {
                Configuracion::create([
                    'con_nombre' => 'DESCUENTO', 
                    'con_valor_numerico' => $input['descuento']
                    ]);
            }
            $configuracion = Configuracion::where('con_nombre', '=', 'ADICIONAL')->first();
            if ($configuracion != null) {
                $configuracion->update(['con_valor_numerico' => $input['adicional']]);
            } else {
                Configuracion::create([
                    'con_nombre' => 'ADICIONAL', 
                    'con_valor_numerico' => $input['adicional']
                    ]);
            }
            if (!empty($input['descuentoAutor'])) {
                foreach ($input['descuentoAutor'] as $value) {
                    $configuracion = Configuracion::where([['con_nombre', '=', 'DESCUENTO-IND'], ['con_valor_texto', '=', $value['autor']]])->first();
                    if ($configuracion != null) {
                        $configuracion->update(['con_valor_numerico' => $value['descuento']]);
                    } else {
                        Configuracion::create([
                            'con_nombre' => 'DESCUENTO-IND', 
                            'con_valor_texto' => $value['autor'], 
                            'con_valor_numerico' => $value['descuento']
                            ]);
                    }
                }
            }
            $mensaje = "Configuracion guardada exitosamente.";
            DB::commit();
        } catch (\Exception $e) {
            $success = false;
            $mensaje = "No se pudo " . ($input['hiddenId'] == null ? "crear" : "modificar") . " el registro.";
            DB::rollback();
        }
        return response()->json(compact("mensaje", "success"));
    }
}
