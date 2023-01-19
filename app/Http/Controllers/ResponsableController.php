<?php

namespace App\Http\Controllers;
use View;

use Illuminate\Http\Request;
use App\Model\Empresa;
use App\Model\Cliente;
use App\Model\Responsable;

class ResponsableController extends Controller
{
    public function registro(){
        $clientes = Empresa::join('cliente','cliente.clie_identificador','empresa.RUC')->get();
        $responsables = Responsable::join('cliente','cliente.idCliente','responsable.idCliente')->
        join('empresa','empresa.RUC','cliente.clie_identificador')->get();
       
        return View::make('responsable.registro')->with(['responsables'=>$responsables,'clientes'=>$clientes]);

    }

    public function guardar(Request $request){
        
        try {
          
            $resp = new Responsable;
            $resp->res_nombres=mb_strtoupper($request->nombre, 'UTF-8');
            $resp->res_apellidos=mb_strtoupper($request->apellido, 'UTF-8');
            $resp->res_cargo=mb_strtoupper($request->cargo, 'UTF-8');
            $resp->res_contacto=mb_strtoupper($request->cel, 'UTF-8');
            $resp->res_correo=$request->email;
            $resp->idCliente=$request->razon;
            $resp->save();
            return json_encode('success');
        } catch (\Throwable $th) {
  
            return json_encode('error');
        }
    
    }

    public function actualizar(Request $request,$id){
        try {

            $resp = Responsable::findOrFail($id);
            $resp->res_nombres=mb_strtoupper($request->nombre, 'UTF-8');
            $resp->res_apellidos=mb_strtoupper($request->apellido, 'UTF-8');
            $resp->res_cargo=mb_strtoupper($request->cargo, 'UTF-8');
            $resp->res_contacto=mb_strtoupper($request->cel, 'UTF-8');
            $resp->res_correo=$request->email;
            $resp->idCliente=$request->razon;
            $resp->save();
            return json_encode('success');

        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id){
        try {
            $resp = Responsable::findOrFail($id);
            if($resp->res_estado=='activo'){
                $resp->res_estado='inactivo';
                $resp->save();
            }else{
                $resp->res_estado='activo';
                $resp->save();
            }
            
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function buscar($id){

        $datos = Responsable::findOrFail($id);
        
        return json_encode($datos);
    }

    public function responsablesLista($id){
        $datos = Responsable::where('idCliente',$id)->get();
        return json_encode($datos);
    }
}
