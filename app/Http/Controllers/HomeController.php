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
use App\Model\Rol;
use App\Model\Planilla;
use App\Model\Horas_Trabajadas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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
}
