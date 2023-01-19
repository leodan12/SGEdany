<?php

namespace App\Http\Controllers;
use View;
use DateTime;
use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\User;
use App\Model\Persona;
use App\Model\Colaborador;
use App\Model\Cargo;
use App\Model\Planilla;
use App\Model\Rol;
use App\Model\Sexo;
use App\Model\Horas_Trabajadas;

class UserController extends Controller
{
    // public function login(Request $request)
    // {
    //    return View('general.index');
    // }

    public function index(){
        // dd(Auth::check());
        if(Auth::check())
        {
            if(Auth::user()->user_estado == 'activo'){
                $persona = Persona::findOrfail(Auth::user()->idPersona);
                $nivel= Rol::findOrFail($persona->idRol);
                
                if($nivel->rol_nombre=='OPERADOR'){
                    $hoy = Carbon::now();
                    $user = User::findOrFail(Auth::User()->idUser);
                    $colaborador = Colaborador::where('idPersona',$user->idPersona)->first();
            
                    $registro = Horas_Trabajadas::where('idCol',$colaborador->idCol)->orderby('idHrs','desc')->first();
                    
                    if (is_null($registro)){
                        $tipo = 'entrada';
                    }
                    else{
                        if(is_null($registro->Hra_fin)){
                            $tipo = 'salida';
                        }
                        else{
                            $tipo = 'entrada';
                        }
                    }
                    return View::make('usuario.registro')->with(['tipo'=>$tipo]);
                }else{
                    $hoy =  Carbon::today();
                    $planilla = Planilla::whereMonth('Plan_registro',$hoy)->get();
                    $dia = $hoy->isoFormat('D');
                
                    if(sizeof($planilla)==0 && $dia>25){
                        $alerta='SI';
                    } else{
                        $alerta='NO';
                    }
                    
                    return View('general.index')->with(['alerta'=>$alerta]); 
                }
            }
            else{
                return View('auth.login');
            }
        }
        else{
            // return Redirect::to('/login');
            return View('auth.login');
            
        }
    }

    public function logout(){
        Auth::logout();
       Session::flush();
       return Redirect::to('/');
    }

    public function inicio(){

        $users = User::join('persona','persona.idPersona','users.idPersona')->join('rol','rol.idRol','persona.idRol')
        ->select('idUser','login', 'per_nombres','per_apellidos','rol_nombre','user_estado')->get();
        $sexos=Sexo::where('sex_estado','activo')->get(); 
        return View::make('usuario.inicio')->with(['users'=>$users,'sexos'=>$sexos]);
    }
    public function info(){
                                                        
        return View::make('informacion');
    }
    public function reinicioContraseña($id){

        try {
            $user = User::findOrFail($id);
            $user->password = bcrypt($user->login);
            $user->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id){
        try {
            $user = User::findOrFail($id);
            if($user->user_estado == 'activo'){
                $user->user_estado='inactivo';
            }else{
                $user->user_estado='activo';
            }
            $user->save();
            return json_encode($user->user_estado);
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function perfil (){
        return View::make('usuario.perfil');
    }

    public function verificarContraseña(Request $request,$id){
        
        try {
            $user = User::findOrFail($id);
            if(Hash::check($request->contra, $user->password))
                return json_encode('success');
            else 
                return json_encode('error');
            
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
    public function actualizarContraseña(Request $request,$id){
        try {
            $user = User::findOrFail($id);
            $user->password = bcrypt($request->nueva);
            $user->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function registro(){
        $hoy = Carbon::now();

        $user = User::findOrFail(Auth::User()->idUser);
        $colaborador = Colaborador::where('idPersona',$user->idPersona)->first();

        $registro = Horas_Trabajadas::where('idCol',$colaborador->idCol)->orderby('idHrs','desc')->first();
        
        if (is_null($registro)){
            $tipo = 'entrada';
        }
        else{
            if(is_null($registro->Hra_fin)){
                $tipo = 'salida';
            }
            else{
                $tipo = 'entrada';
            }
        }
        return View::make('usuario.registro')->with(['tipo'=>$tipo]);
    }

    public function registroDiario($tipo){
        $hoy = Carbon::now();
        $user = User::findOrFail(Auth::User()->idUser);
        $colaborador = Colaborador::where('idPersona',$user->idPersona)->first();

        if($tipo == 'entrada'){
            try {
                $hrs = new Horas_Trabajadas;
                $hrs->idCol = $colaborador->idCol;
                $hrs->Hrs_fecha = $hoy->format('Y-m-d');
                $hrs->Hra_inicio = $hoy->format('h:i:00');
                $hrs->save();
                return json_encode('success');
            } catch (\Throwable $th) {
                return json_encode('error');
            }
        }
        else{
            try {
                $hrs = Horas_Trabajadas::where('idCol',$colaborador->idCol)->orderby('idHrs','desc')->first();
                $hrs->Hra_fin = $hoy->format('H:i:00');
        
                $inicio= new Datetime($hrs->Hra_inicio);
                $fin= new Datetime($hoy->format('H:i:00'));

                $hrsDiff=0;
                // dd($hoy->format('H'),$inicio->format('H'));
                if(($fin->format('H') < $inicio->format('H') || ($fin->format('H') == $inicio->format('H') && $fin->format('i')<$inicio->format('i')))){
                    
                    $hrsDiff=intval($fin->format('H'))+1;
                    $fin->setTime(23,$fin->format('i'));
                }
                $diferencia=$inicio->diff($fin);
                $horas=$diferencia->h+$hrsDiff;
                $min=$diferencia->i;
                $cant=doubleval($horas+($min/60));
            
                $hrs->Hrs_cantidad = $cant;
                $hrs->save();
                return json_encode('success');
            } catch (\Throwable $th) {
                return json_encode('error');
            }
        }
    }
}
