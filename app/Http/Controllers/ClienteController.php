<?php

namespace App\Http\Controllers;
use View;
use Datetime;

use Illuminate\Http\Request;
use App\Model\Cliente;
use App\Model\Empresa;
use App\Model\Persona;
use App\Model\Sexo;
use App\Model\Rol;

class ClienteController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function registro()
    {
        $clientes = Cliente::leftjoin('empresa','empresa.RUC','cliente.clie_identificador')
        ->leftjoin('persona','persona.per_dni','cliente.clie_identificador')->orderBy('cliente.idCliente')->get();
        $sexos = Sexo::where('sex_estado','activo')->get();
        // dd($clientes);
        return View::make('cliente.registro')->with(['clientes'=>$clientes, 'sexos'=>$sexos]);
        
    }

    public function guardar(Request $request)
    {
       try {
            $rol=Rol::where('rol_nombre','CLIENTE')->first();
            $hoy = new Datetime();
            
            if (is_null($request->dni)){
                $ident=$request->ruc;
                $clie= new Empresa;
                $clie->RUC=$ident;
                $clie->RazonSocial=mb_strtoupper($request->razon,'UTF-8');
                $clie->NombreComercial=mb_strtoupper($request->nombreE,'UTF-8');
                $clie->Direccion=mb_strtoupper($request->direcE,'UTF-8');
                $clie->Rubro=mb_strtoupper($request->rubro,'UTF-8');
            }
            else{
                $ident=$request->dni;
                $clie = new Persona;
                $clie->per_nombres=mb_strtoupper($request->nombres,'UTF-8');
                $clie->per_apellidos=mb_strtoupper($request->apellidos,'UTF-8');
                $clie->per_nacimiento=$request->nacimiento;
                $clie->per_dni=$ident;
                $clie->per_direccion=mb_strtoupper($request->direcP,'UTF-8');
                $clie->idSexo=$request->sexo;
                $clie->per_cel=$request->celular;
                $clie->per_registro=$hoy->format('Y-m-d');
            }

            $clie->idRol=$rol->idRol;
            $clie->save();

            $cliente=new Cliente;
            $cliente->clie_identificador=$ident;
            $cliente->save();
            return json_encode('success');
       } catch (\Throwable $th) {
           dd($th);
            return json_encode('error');
       }
    }

    public function editar($id)
    {
        $cargo = Cargo::findOrFail($id);
        return View::make('cargo.edit')->with(['cargo'=>$cargo]);
    }

    public function actualizar(Request $request,$id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $ident=strlen($cliente->clie_identificador);
            if ($ident>8){
                $clie=Empresa::where('RUC',$cliente->clie_identificador)->first();
                $clie->RazonSocial=mb_strtoupper($request->razon,'UTF-8');
                $clie->NombreComercial=mb_strtoupper($request->nombreE,'UTF-8');
                $clie->Direccion=mb_strtoupper($request->direcE,'UTF-8');
                $clie->Rubro=mb_strtoupper($request->rubro,'UTF-8');
            }
            else{
                $clie=Persona::where('per_dni',$cliente->clie_identificador)->first();
                $clie->per_nombres=mb_strtoupper($request->nombres,'UTF-8');
                $clie->per_apellidos=mb_strtoupper($request->apellidos,'UTF-8');
                $clie->per_nacimiento=$request->nacimiento;
                $clie->idSexo=$request->sexo;
                $clie->per_cel=$request->celular;
                $clie->per_direccion=mb_strtoupper($request->direcP,'UTF-8');
            }
            $clie->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $ident=strlen($cliente->clie_identificador);
            if($cliente->clie_estado == 'activo'){
                $cliente->clie_estado='inactivo';
                if ($ident>8){
                    $emp=Empresa::where('RUC',$cliente->clie_identificador)->first();
                    $emp->emp_estado='inactivo';
                    $emp->save();
                }
                else{
                    $persona=Persona::where('per_dni',$cliente->clie_identificador)->first();
                    $persona->per_estado='inactivo';
                    $persona->save();
                }
            }else{
                $cliente->clie_estado='activo';
                if ($ident>8){
                    $emp=Empresa::where('RUC',$cliente->clie_identificador)->first();
                    $emp->emp_estado='activo';
                    $emp->save();
                }
                else{
                    $persona=Persona::where('per_dni',$cliente->clie_identificador)->first();
                    $persona->per_estado='activo';
                    $persona->save();
                }
            }
            $cliente->save();
            return json_encode($cliente->clie_estado);
        } catch (\Throwable $th) {
            return json_encode('error');
        }
        return redirect()->route('cliente.register');
    }
   public function buscar(Request $request){
    if($request->tipo == 'empresa'){
        $cliente = Empresa::findOrFail($request->id);
        
    } else{
        $cliente = Persona::join('sexo','sexo.idSexo','persona.idSexo')->findOrFail($request->id);
    }
    return json_encode($cliente);
   }
}
