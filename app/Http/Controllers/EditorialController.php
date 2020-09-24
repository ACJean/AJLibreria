<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Editorial;

class EditorialController extends Controller
{
    public function index()
    {
        return view('editorial.lista');
    }

    public function list() {
        $editoriales = Editorial::all();
        return $editoriales;
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $mensaje = "";
        $success = true;
        try {
            DB::beginTransaction();
            if ($input['hiddenId'] == null) {
                //Crear nuevo registro
                Editorial::create(['edi_nombre' => $input['ediNombre']]);
                $mensaje = "El registro fue creado con éxito.";
            } else {
                //Editar registro
                Editorial::find($input['hiddenId'])->update(['edi_nombre' => $input['ediNombre']]);
                $mensaje = "El registro fue modificado con éxito.";
            }
            DB::commit();
        } catch (\Exception $e) {
            $success = false;
            $mensaje = "No se pudo ".($input['hiddenId'] == null ? "crear" : "modificar")." el registro.";
            DB::rollback();
        }
        return response()->json(compact("mensaje", "success"));
    }

    public function delete(Request $request) {
        $input = $request->all();
        $mensaje = "";
        $success = true;
        try {
            Editorial::find($input['edi_id'])->delete();
            $mensaje = "El registro fue eliminado con éxito.";
        } catch (\Exception $e) {
            $success = false;
            $mensaje = "El registro no se pudo eliminar.";
        }
        return response()->json(compact("mensaje", "success"));
    }
    
}
