<?php

namespace App\Http\Controllers;
use View;

use Illuminate\Http\Request;
use App\Model\Tipo_Dcmnto;

class TipoDocumentoController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
        $tipos = Tipo_Dcmnto::all();
        return View::make('tipoDocumento.registro')->with(['tipos'=>$tipos]);

    }

    public function guardar(Request $request)
    {
        try {
            $tipo = new Tipo_Dcmnto;
            $tipo->TD_nombre = mb_strtoupper($request->nameTipo, 'UTF-8');
            $tipo->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            
            return json_encode('error');
        }
    }

    public function verificar($id)
    {
        $tipo = Tipo_Dcmnto::where('TD_nombre',$id)->first();
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
            $tipo = Tipo_Dcmnto::findOrFail($id);
            $tipo->TD_nombre = mb_strtoupper($request->nameTipo, 'UTF-8');
            $tipo->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id)
    {
        try {
            $tipo = Tipo_Dcmnto::findOrFail($id);
            if($tipo->TD_estado == 'activo'){
                $tipo->TD_estado='inactivo';
            }else{
                $tipo->TD_estado='activo';
            }
            $tipo->save();
            return json_encode($tipo->TD_estado);
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
