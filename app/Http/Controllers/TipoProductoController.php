<?php

namespace App\Http\Controllers;
use View;

use Illuminate\Http\Request;
use App\Model\Tipo_Prod;

class TipoProductoController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
        $tipos = Tipo_Prod::all();
        return View::make('tipoProducto.registro')->with(['tipos'=>$tipos]);

    }

    public function guardar(Request $request)
    {
        try {
            $tipo = new Tipo_Prod;
            $tipo->TP_nombre = mb_strtoupper($request->nameTipo, 'UTF-8');
            $tipo->TP_codigo = $request->codTipo;
            $tipo->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
    public function buscar($id){
        $tipo = Tipo_Prod::where('TP_nombre',$id)->first();
        return json_encode($tipo);
    }
    public function verificar($id)
    {
        $tipo = Tipo_Prod::where('TP_nombre',$id)->first();
        if(is_null($tipo)){
            return json_encode('success');
        }
        else{
            return json_encode('error');
        }
    }

    public function actualizar(Request $request,$id)
    {
        try {
            $tipo = Tipo_Prod::findOrFail($id);
            $tipo->TP_nombre = mb_strtoupper($request->nameTipo, 'UTF-8');
            $tipo->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id)
    {
        try {
            $tipo = Tipo_Prod::findOrFail($id);
            if($tipo->TP_estado == 'activo'){
                $tipo->TP_estado='inactivo';
            }else{
                $tipo->TP_estado='activo';
            }
            $tipo->save();
            return json_encode($tipo->TP_estado);
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
