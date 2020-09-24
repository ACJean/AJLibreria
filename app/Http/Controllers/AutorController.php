<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Libro;

class AutorController extends Controller
{
    public function index()
    {
        return view('autor.lista');
    }

    public function list()
    {
        $autores = Autor::all();
        return $autores;
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
                Autor::create(['aut_nombres' => $input['autNombres'], 'aut_apellidos' => $input['autApellidos']]);
                $mensaje = "El registro fue creado con éxito.";
            } else {
                //Editar registro
                Autor::find($input['hiddenId'])->update(['aut_nombres' => $input['autNombres'], 'aut_apellidos' => $input['autApellidos']]);
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
            Autor::find($input['aut_id'])->delete();
            $mensaje = "El registro fue eliminado con éxito.";
        } catch (\Exception $e) {
            $success = false;
            $mensaje = "El registro no se pudo eliminar.";
        }
        return response()->json(compact("mensaje", "success"));
    }

    public function autores($id)
    {
        $autores = Libro::find($id)->autores()->wherePivot('aul_estado_registro', '=' ,1)->get();
        return $autores;
    }
}
