<?php

namespace App\Http\Controllers;
use View;
use Datetime;

use Illuminate\Http\Request;
use App\Model\Ubicacion;

class UbicacionController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function registro() {
        $ubicaciones = Ubicacion::all();
        return View::make('ubicacion.registro')->with(['ubicaciones'=>$ubicaciones]);

    }

    public function guardar(Request $request){
        try {
            if(json_decode(UbicacionController::verificar($request->ubicName))=='success'){
            
                try {
                    $ubicacion = new Ubicacion;
                    $ubicacion->Ubic_nombre = mb_strtoupper($request->ubicName, 'UTF-8');
                    $ubicacion->save();
                    return json_encode('success');
                } catch (\Throwable $th) {
                    
                    return json_encode('error');
                }
            }
            else{
                return json_encode('error');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function verificar($id){
        $ubicacion = Ubicacion::where('Ubic_nombre',$id)->first();
      
        if(is_null($ubicacion)){
            return json_encode('success');
        }
        else{
            return json_encode('error');
        }
    }

    public function actualizar(Request $request,$id){
        $repetido = Ubicacion::where('Ubic_nombre',$request->ubicName)->first();
        if($repetido->idUbicacion == $id){
            try {
                $ubicacion = Ubicacion::findOrFail($id);
                $ubicacion->Ubic_nombre = mb_strtoupper($request->ubicName, 'UTF-8');
                $ubicacion->save();
                return json_encode('success');
            } catch (\Throwable $th) {
                return json_encode('error');
            }
        }
        else{
            return json_encode('error');
        }
        
    }

    public function eliminar($id){
        try {
            $ubicacion = Ubicacion::findOrFail($id);
            if($ubicacion->ubic_estado == 'disponible'){
                $ubicacion->ubic_estado='inactivo';
            }else{
                $ubicacion->ubic_estado='disponible';
            }
            $ubicacion->save();
            return json_encode($ubicacion->ubic_estado);
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
    public function buscar(){
        $ubicaciones = Ubicacion::where('ubic_estado','disponible')->get();
        return json_encode($ubicaciones);
    }
}
