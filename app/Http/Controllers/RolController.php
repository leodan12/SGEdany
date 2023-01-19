<?php

namespace App\Http\Controllers;
use View;


use Illuminate\Http\Request;
use App\Model\Rol;

class RolController extends Controller
{
    public function registro(){
        $roles = Rol::orderBy('rol_permiso')->get();
        return View::make('rol.registro')->with(['roles'=>$roles]);
        
    }

    public function verificar($id){
        $rol = Rol::where('rol_nombre',$id)->first();
        if(is_null($rol)){
            return json_encode('success');
        }
        else{
            return json_encode('error');
        }
    }

    public function guardar(Request $request){
        try {
            $rol = new Rol;
            $rol->rol_nombre = mb_strtoupper($request->name, 'UTF-8');
            $rol->rol_permiso = $request->nivel;
            $rol->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function actualizar(Request $request,$id){
      
        try {
            $rol = Rol::findOrFail($id);
            
            if(($rol->rol_nombre != mb_strtoupper($request->name, 'UTF-8'))){

                $registrado = Rol::where('rol_nombre',$request->name)->first();
                if(is_null($registrado)){
                    $rol->rol_nombre = mb_strtoupper($request->name, 'UTF-8');
                    $rol->rol_permiso = $request->nivel;
                    $rol->save();
                    return json_encode('success');
                }
                else{
                    return json_encode('error');
                }
            }
            else{
                    $rol->rol_nombre = mb_strtoupper($request->name, 'UTF-8');
                    $rol->rol_permiso = $request->nivel;
                    $rol->save();
                    return json_encode('success');    
            }
        } catch (\Throwable $th) {
            return json_encode('error-2');
        }
    }

    public function eliminar($id){
        try {
            $rol = Rol::findOrFail($id);
            
            if($rol->rol_estado == 'activo'){
                $rol->rol_estado='inactivo';
            }else{
                $rol->rol_estado='activo';
            }
            $rol->save();
            return json_encode($rol->rol_estado);
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
