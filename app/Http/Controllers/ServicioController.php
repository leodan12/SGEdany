<?php

namespace App\Http\Controllers;
use View;

use Illuminate\Http\Request;
use App\Model\Servicio;

class ServicioController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
        $servicios = Servicio::all();
        // dd($productos);
        return View::make('servicio.registro')->with(['servicios'=>$servicios]);

    }

    public function guardar(Request $request)
    {
        try {
            $servicio = new Servicio;
            $servicio->codServicio=$request->codigo;
            $servicio->serv_nombre=mb_strtoupper($request->nombre, 'UTF-8');
            $servicio->serv_detalle=mb_strtoupper($request->detalle, 'UTF-8');
            $servicio->serv_costo=$request->costo;
            $servicio->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('serror');
        }
        return redirect()->route('servicio.register');
    }

    public function verificar(Request $request)
    {
        $reg1 = Servicio::where('codServicio',$request->cod)->first();
        if(is_null($reg1)){
            $reg2 = Servicio::where('serv_nombre',$request->nombre)->first();
            if(is_null($reg2)){
                return json_encode('success');
            }
            else{
                return json_encode('nombre');
            }
        }
        else{
            return json_encode('código');
        }
    }

    public function actualizar(Request $request,$id)
    {
        
        try {
            $servicio = Servicio::findOrFail($id);
            if($servicio->serv_nombre == mb_strtoupper($request->nombre, 'UTF-8')){
                $servicio->serv_detalle=mb_strtoupper($request->detalle, 'UTF-8');
                $servicio->serv_costo=$request->costo;
                $servicio->save();
                return json_encode('success');
            }
            else{
                $registro = Servicio::where('serv_nombre',$request->nombre);
                if(is_null($registro)){
                    $servicio->serv_nombre=mb_strtoupper($request->nombre, 'UTF-8');
                    $servicio->serv_detalle=mb_strtoupper($request->detalle, 'UTF-8');
                    $servicio->serv_costo=$request->costo;
                    $servicio->save();
                    return json_encode('success');
                }
                else{
                    return json_encode('error-2');
                }
            }
        } catch (\Throwable $th) {
            return json_encode('error');
        }

        
    }
    public function buscar(Request $request){
        $datos = Servicio::findOrFail($request->serv);
        return json_encode($datos);
    }
    public function eliminar($id)
    {
       try {
            $servicio = Servicio::findOrFail($id);
            if($servicio->serv_estado=='activo'){
                $servicio->serv_estado='inactivo';
            }
            else{
                $servicio->serv_estado='activo';
            }
            $servicio->save();
            return json_encode('success');
       } catch (\Throwable $th) {
           return json_encode('error');
       }
    }
}
