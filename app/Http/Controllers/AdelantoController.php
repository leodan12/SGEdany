<?php

namespace App\Http\Controllers;
use View;
use Datetime;

use Illuminate\Http\Request;
use App\Model\Adelanto;
use App\Model\Persona;
use App\Model\Colaborador;
use App\Model\Cargo;
use Carbon\Carbon;

class AdelantoController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
        $adelantos = Adelanto::join('colaborador','colaborador.idCol','adelanto.idCol')->join('persona','persona.idPersona','colaborador.idPersona')
        ->orderBy('adelanto.Adel_fecha')->get();
        $colaboradores = Persona::join('colaborador','colaborador.idPersona','persona.idPersona')->where('per_estado','activo')->get();
        $hoy = Carbon::now();
        // dd($hoy->format('d-m-Y'));
        return View::make('adelanto.registro')->with(['adelantos'=>$adelantos,'colaboradores'=>$colaboradores,'hoy'=>$hoy->format('Y-m-d')]);

    }

    public function guardar(Request $request)
    {
        try {
            $hoy = Carbon::now();
            $adelanto = new Adelanto;
            $adelanto->Adel_monto= $request->monto;
            $adelanto->Adel_fecha= $request->fecha;
            $adelanto->Adel_registro= $hoy->format('Y-m-d');
            $adelanto->idCol= $request->dni;
            $adelanto->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function verificar($fecha,$id)
    {
        $anio = date('Y',strtotime($fecha));
        $mes = date('m',strtotime($fecha));
        $nro = Adelanto::whereYear('Adel_fecha',$anio)->whereMonth('Adel_fecha',$mes)->where('idCol',$id)->count();
        if($nro==0){
            return json_encode('success');
        }
        else{
            return json_encode('error');
        }
    }

    public function actualizar(Request $request,$id)
    {
        $registrado = Adelanto::findOrFail($id);
        
        
        if($registrado->Adel_fecha == $request->fecha){
            try {
                $registrado->Adel_monto= $request->monto;
                $registrado->idCol= $request->dni;
                $registrado->save();
                return json_encode('success');
            } catch (\Throwable $th) {
                return json_encode('error');
            }
        }
        else{
            $Rmes = date('m',strtotime($registrado->Adel_fecha));
            $Ranio = date('Y',strtotime($registrado->Adel_fecha));

            $anio = date('Y',strtotime($request->fecha));
            $mes = date('m',strtotime($request->fecha));

            if($mes == $Rmes && $anio==$Ranio){
                try {
                        $registrado->Adel_monto= $request->monto;
                        $registrado->Adel_fecha= $request->fecha;
                        $registrado->idCol= $request->dni;
                        $registrado->save();
                        return json_encode('success');
                    } catch (\Throwable $th) {
                        return json_encode('error');
                    }
            }
            else{
                $nro = Adelanto::whereYear('Adel_fecha',$anio)->whereMonth('Adel_fecha',$mes)->where('idCol',$id)->count();
                if($nro==0){
                    try {
                        $registrado->Adel_monto= $request->monto;
                        $registrado->Adel_fecha= $request->fecha;
                        $registrado->idCol= $request->dni;
                        $registrado->save();
                        return json_encode('success');
                    } catch (\Throwable $th) {
                        return json_encode('error');
                    }
                }
                else{
                    return json_encode('error-2');
                }
            }
        }
    }

    public function eliminar($id)
    {
        try {
            $adelanto = Adelanto::findOrFail($id);
            if($adelanto->adel_estado=='activo'){
                $adelanto->adel_estado='inactivo';
            }
            else{
                $adelanto->adel_estado='activo';
            }
            $adelanto->save();
            return json_encode($adelanto->adel_estado);
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
