<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\LibroVenta;

class LibroController extends Controller
{
    public function index()
    {
        return view('libro.lista');
    }

    public function list()
    {
        $libros = DB::table('tbl_libro')
            ->join('tbl_editorial', 'tbl_editorial.edi_id', 'tbl_libro.lib_edi_id')
            ->select('*')->get();
        return $libros;
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $mensaje = "";
        $success = true;
        try {
            DB::beginTransaction();
            $libro = null;
            if ($input['hiddenId'] == null) {
                //Crear nuevo registro
                $libro = Libro::create([
                    'lib_isbn' => $input['libIsbn'],
                    'lib_titulo' => $input['libTitulo'],
                    'lib_anio_publicacion' => $input['libAnioPublicacion'],
                    'lib_edi_id' => $input['libEdiId']
                ]);
                $mensaje = "El registro fue creado con éxito.";
            } else {
                //Editar registro
                Libro::find($input['hiddenId'])->update([
                    'lib_isbn' => $input['libIsbn'],
                    'lib_titulo' => $input['libTitulo'],
                    'lib_anio_publicacion' => $input['libAnioPublicacion'],
                    'lib_edi_id' => $input['libEdiId']
                ]);
                $mensaje = "El registro fue modificado con éxito.";
            }
            if ($libro == null) {
                $libro = Libro::find($input['hiddenId']);
            }
            if (isset($input['autId'])) {
                $condicional = [];
                foreach ($input['autId'] as $key => $value) {
                    $update = $libro->autores()->updateExistingPivot($value, array('aul_estado_registro' => 1));
                    if (!$update) {
                        $libro->autores()->attach($value, array('aul_estado_registro' => 1));
                    }
                    array_push($condicional, ['tbl_autor_libro.aul_aut_id', '<>', $value]);
                }
                array_push($condicional, ['tbl_libro.lib_id', '=', $libro->lib_id]);
                $libros = DB::table('tbl_autor_libro')
                    ->join('tbl_libro', 'tbl_libro.lib_id', 'tbl_autor_libro.aul_lib_id')
                    ->where($condicional)
                    ->select('*')->get();
                foreach ($libros as $key => $value) {
                    Libro::find($value->aul_lib_id)->autores()->updateExistingPivot($value->aul_aut_id, array('aul_estado_registro' => 0));
                }
            } else {
                $libro->autores()->newPivotStatement()
                    ->where('aul_lib_id', '=', $libro->lib_id)
                    ->update(array('aul_estado_registro' => 0));
            }
            DB::commit();
        } catch (\Exception $e) {
            $success = false;
            $mensaje = "No se pudo " . ($input['hiddenId'] == null ? "crear" : "modificar") . " el registro. [" . $e . "]";
            DB::rollback();
        }
        return response()->json(compact("mensaje", "success"));
    }

    public function venta(Request $request)
    {
        $input = $request->all();
        $mensaje = "";
        $success = true;
        try {
            DB::beginTransaction();
            $id = $input['hiddenIdVenta'];
            if ($id != null) {
                if ($input['chkVenta'] == 'on') {
                    Libro::find($id)->update(['lib_precio' => $input['libPrecio']]);
                    $mensaje = "El libro se ha puesto en venta.";
                } else {
                    Libro::find($id)->update(['lib_precio' => null]);
                    $mensaje = "El libro ya no está a la venta.";
                }
            } else {
                $success = false;
                $mensaje = "No se obtine ningún identificador.";
            }
            DB::commit();
        } catch (\Exception $e) {
            $success = false;
            $mensaje = "No se pudo " . ($input['hiddenId'] == null ? "crear" : "modificar") . " el registro.";
            DB::rollback();
        }
        return response()->json(compact("mensaje", "success"));
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        $mensaje = "";
        $success = true;
        try {
            Libro::find($input['lib_id'])->delete();
            $mensaje = "El registro fue eliminado con éxito.";
        } catch (\Exception $e) {
            $success = false;
            $mensaje = "El registro no se pudo eliminar.";
        }
        return response()->json(compact("mensaje", "success"));
    }
}
