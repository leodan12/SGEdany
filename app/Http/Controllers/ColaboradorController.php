<?php

namespace App\Http\Controllers;
use View;

use Illuminate\Http\Request;
use App\Model\Persona;
use App\Model\Colaborador;
use App\Model\Cargo;
use App\Model\Sexo;
use App\Model\Rol;
use App\Model\Sist_Pension;
use App\User;
use Datetime;

class ColaboradorController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
   
        $colaboradores = Persona::join('colaborador','colaborador.idPersona','persona.idPersona')
        ->join('cargo','cargo.idCargo','colaborador.idCargo')->join('rol','rol.idRol','persona.idRol')->get();
        $cargos = Cargo::where('car_estado','activo')->get();
        $sexos=Sexo::where('sex_estado','activo')->get();
        $pensiones=Sist_Pension::where('Pen_estado','activo')->get();
        $roles = Rol::where('rol_estado','activo')->get();
        // dd($colaboradores);
        return View::make('colaborador.registro')->with(['colaboradores'=>$colaboradores,'cargos'=>$cargos,'sexos'=>$sexos,'pensiones'=>$pensiones,'roles'=>$roles]);

    }

    public function nuevo()
    {
      
        $cargos = Cargo::where('car_estado',1)->get();
        $sexos=Sexo::where('sex_estado','activo')->get();
        $pensiones=Sist_Pension::where('Pen_estado',1)->get();
        $roles = Rol::where('rol_estado','activo')->get();
        return View::make('colaborador.datos')->with(['cargos'=>$cargos,'sexos'=>$sexos,'pensiones'=>$pensiones,'roles'=>$roles]);
    }

    public function lista()
    {
        return View('colaborador.lista');
    }

    public function confirm() {
        return View('colaborador.confirm');
    }

    public function guardar(Request $request) {

        $repetido = Persona::where('per_dni',$request->colDNI)->where('per_estado','activo')->first(); 


        if (is_null($repetido)){
            try {
                $hoy = new Datetime();
    
                $persona = new Persona;
                $persona->per_nombres =mb_strtoupper($request->colNombres,'UTF-8');
                $persona->per_apellidos=mb_strtoupper($request->colApell,'UTF-8');
                $persona->per_nacimiento=$request->colNac;
                $persona->per_dni=$request->colDNI;
                $persona->per_direccion=mb_strtoupper($request->colDirec,'UTF-8');
                $persona->idSexo=$request->colSexo;
                $persona->per_cel=$request->colCel;
                $persona->per_registro=$hoy->format('Y-m-d');
                $persona->idRol=$request->colRol;
                $persona->save();
    
                $Persona = Persona::where('per_dni',$request->colDNI)->where('per_estado','activo')->first();
    
    
                // dd($Persona);
                $colaborador = new Colaborador;
                $colaborador->idPersona = $Persona->idPersona;
                $colaborador->idCargo = $request->colCargo;
                $colaborador->col_sueldo = $request->colSueldo;
                $colaborador->idSistPension = $request->colPension;
    
                $pension= Sist_Pension::findOrFail($request->colPension);
    
                if($pension->Pen_nombre != 'ONP')
                    $colaborador->col_comPension = strtoupper($request->colComision);
                else
                    $colaborador->col_comPension = NULL;
                
                if(is_null($request->colAsigFam) ){
                    $colaborador->col_asigFam = 'NO';
                }
                else{
                    $colaborador->col_asigFam = 'SI';
                }
    
                if(is_null($request->colSctr) ){
                    $colaborador->col_sctr = 'NO';
                }
                else{
                    $colaborador->col_sctr = 'SI';
                }
                $colaborador->save();
    
    
    
                $user = new User;
                $user->login = $request->colDNI;;
                $user->password = bcrypt($request->colDNI);
                $user->idPersona =  $persona->idPersona;
                $user->save();
    
                return json_encode('success');
            } catch (\Throwable $th) {
                return json_encode('error');
            }
        }
        else{
            return json_encode('error-2');
        }

    }

    public function editar($id){
        $Colaborador = Colaborador::findOrFail($id);
        return View::make('colaborador.edit')->with(['colaborador'=>$Colaborador]);
    }

    public function buscar($id){
        $persona = Persona::where('per_dni',$id)->first();
        return json_encode($persona);
    }

    public function actualizar(Request $request,$id){

        try {
            $colaborador = Colaborador::findOrFail($id);
            $colaborador->idCargo = $request->colCargo;
            $colaborador->col_sueldo = $request->colSueldo;
            $colaborador->idSistPension = $request->colPension;

            $pension= Sist_Pension::findOrFail($request->colPension);

            if($pension->Pen_nombre != 'ONP')
                $colaborador->col_comPension = strtoupper($request->colComision);
            else
                $colaborador->col_comPension = NULL;

            if($request->colAsigFam =='true' ){
                
                $colaborador->col_asigFam = 'SI';
            }
            else{
                $colaborador->col_asigFam = 'NO';
            }

            if($request->colSctr =='true' ){
                $colaborador->col_sctr = 'SI';
            }
            else{
                $colaborador->col_sctr = 'NO';
            }
        
            $colaborador->save();

            $persona = Persona::where('idPersona',$colaborador->idPersona)->first();

            $persona->per_nombres =mb_strtoupper($request->colNombres,'UTF-8');
            $persona->per_apellidos=mb_strtoupper($request->colApell,'UTF-8');
            $persona->per_nacimiento=$request->colNac;
            $persona->per_direccion=mb_strtoupper($request->colDirec,'UTF-8');
            $persona->idSexo=$request->colSexo;
            $persona->per_cel=$request->colCel;
            $persona->idRol=$request->colRol;
            $persona->save();
        

            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function confirmar(){
        $Colaborador = Colaborador::findOrFail($id);
        return View::make('colaborador.confirm')->with(['colaborador'=>$Colaborador]);
    }

    public function eliminar($id){
       try {
            $colaborador = Colaborador::findOrFail($id);
            $persona = Persona::where('idPersona',$colaborador->idPersona)->first();

            if($persona->per_estado == 'activo'){
                $persona->per_estado='inactivo';
            }else{
                $persona->per_estado='activo';
            }
            $persona->save();
            return json_encode('success');
       } catch (\Throwable $th) {
        return json_encode('error');
       }
    }
}
