<?php

namespace App\Http\Controllers;
use Datetime;
use Auth;
use View;

use Illuminate\Http\Request;
use App\Model\Registro;
use App\Model\Colaborador;
use App\Model\Cargo;
use Carbon\Carbon;

use Illuminate\Support\Collection;

class RegistroController extends Controller
{
    public function registro()
    {
        $hoy= new Datetime();
        $B_entrada = Registro::where('reg_fecha',$hoy->format('Y-m-d'))->first();

        if ($B_entrada == NULL) {
            return View::make('asistencias.registro')->with(['bandera'=>'1']);
        } else {
            if ($B_entrada->reg_horaSal== NULL) {
                return View::make('asistencias.registro')->with(['bandera'=>'2']);
            } else {
                return View::make('asistencias.registro')->with(['bandera'=>'3']);
            }


        }

    }

    public function RegEntrada()
    {
        $hoy = new Datetime();
        $registro = new Registro;
        $registro->idColaborador = Auth::User()->colaborador->idColaborador;
        $registro->reg_fecha = $hoy->format('Y-m-d');
        $registro->reg_horaEnt = $hoy->format('Y-m-d H:i:s');
        $registro->save();

        return redirect()->route('asistencia.register');
    }

    public function RegSalida(Request $request)
    {
        $hoy = new Datetime();

        $idcol = Auth::User()->colaborador->idColaborador;
        $salida = Registro::where('idColaborador',$idcol)->where('reg_fecha',$hoy->format('Y-m-d'))->first();
        $salida->reg_horaSal = $hoy->format('Y-m-d H:i:s');
        $salida->reg_observ = $request->obsevR;
        $salida->save();

        return redirect()->route('asistencia.register');
    }

    public function asistencias()
    {
        $hoy = new Datetime();
        return View::make('asistencias.reporte')->with(['hoy'=>$hoy->format('Y-m-d')]);
    }

    public function show(Request $request)
    {
        $hoy = new Datetime();

        if ($request->iniB == NULL or $request->finB == NULL) {

            return back()->withErrors(['falta'=>'DATOS FALTANTES'])->withInput();

        } else {

            if ($request->iniB > $request->finB) {

                return back()->withErrors(['error'=>'ERROR EN EL ORDEN DE LAS FECHAS'])->withInput();

            } else if($request->iniB == $request->finB){

                $asistencias = Registro::where('reg_fecha',$request->iniB)
                ->orderBy('reg_fecha')->get();

            } else {

                $asistencias = Registro::where('reg_fecha','>=',$request->iniB)->where('reg_fecha','<=',$request->finB)
                ->orderBy('reg_fecha')->get();

            }
        }


        $row = [];

        $x=0;
        foreach ($asistencias as $asis ) {

            $row[$x]['registrado'] = $asis->reg_fecha;

            $col = Colaborador::where('idColaborador',$asis->idColaborador)->first();
            $row[$x]['colaborador'] =  $col->col_nombres.' '.$col->col_apellidos;

            $cargo = Colaborador::join('cargo','cargo.idCargo','colaborador.idCargo')
            ->select('cargo.car_nombre')->where('colaborador.idColaborador',$col->idColaborador)->first();

            $row[$x]["cargo"]=$cargo->car_nombre;

            $x++;
        }

        return View::make('asistencias.mostrar')->with(['hoy'=>$hoy->format('Y-m-d'),'row'=>$row,'ini'=>$request->iniB,'fin'=>$request->finB]);

    }

    public function gráfico($ini,$fin)
    {

        if($ini == $fin){

            $asistencias = Registro::where('reg_fecha',$ini)->get();

        } else {

            $asistencias = Registro::where('reg_fecha','>=',$ini)->where('reg_fecha','<=',$fin)->get();

        }

        return View::make('asistencias.grafico')->with(["ini"=>$ini,'fin'=>$fin,'asistencias'=>$asistencias]);


    }
    public function PDF()
    {
        
        return View::make('asistencias.pdf');
    }

    public function Horasgráfico($ini,$fin)
    {

        if($ini == $fin){

            $asistencias = Registro::where('reg_fecha',$ini)->get();

        } else {

            $asistencias = Registro::where('reg_fecha','>=',$ini)->where('reg_fecha','<=',$fin)->get();

        }

        // dd($asistencias);<
        return View::make('reportes.HorasTrabajo.grafico')->with(["ini"=>$ini,'fin'=>$fin,'asistencias'=>$asistencias]);


    }


    public function horasTrabajadasInicio()
    {
        $hoy = new Datetime();
        return View::make('reportes.HorasTrabajo.inicio')->with(['hoy'=>$hoy->format('Y-m-d'),'busqueda'=>NULL]);
    }

    public function horasTrabajadasShow(Request $request)
    {
        $hoy = new Datetime();

        if ($request->fini == NULL or $request->ffin == NULL) {

            return back()->withErrors(['falta'=>'DATOS FALTANTES'])->withInput();

        } else {

            if ($request->fini > $request->ffin) {

                return back()->withErrors(['error'=>'ERROR EN EL ORDEN DE LAS FECHAS'])->withInput();

            } else {
                if($request->fini == $request->ffin){

                $asistencias = Registro::where('reg_fecha',$request->fini)->get();

                } else {
                    $asistencias = Registro::where('reg_fecha','>=',$request->fini)->where('reg_fecha','<=',$request->ffin)->get();


                }
            }

            // dd($asistencias);
            $row = [];
            $x = 0;


            $colaboradores = Colaborador::all();

            foreach ($colaboradores as $col) {
                $bandera = 0;
                $Thoras = 0;
                foreach ($asistencias as $asis) {
                    if ($asis->idColaborador == $col->idColaborador){
                        $ini = new DateTime($asis->reg_horaEnt);
                        $fin = new DateTime($asis->reg_horaSal);
                        $hora = $ini->diff($fin);
                        $Thoras = $Thoras + $hora->h;
                        $bandera= 1;
                    }
                }
                if($bandera == 1){
                    $row[$x]['colaborador'] =  $col->col_nombres.' '.$col->col_apellidos;

                    $cargo = Colaborador::join('cargo','cargo.idCargo','colaborador.idCargo')
                    ->select('cargo.car_nombre')->where('colaborador.idColaborador',$col->idColaborador)->first();
                    $row[$x]["cargo"]=$cargo->car_nombre;

                    $row[$x]["horas"] = $Thoras;
                    $x++;
                }
            }

            return View::make('reportes.HorasTrabajo.mostrar')->with(['row'=>$row,'ini'=>$request->fini,'fin'=>$request->ffin]);

        }

    }
}
