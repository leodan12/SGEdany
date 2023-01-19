<?php

namespace App\Http\Controllers;
use Datetime;
use DB;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Model\Horas_Trabajadas;
use App\Model\Planilla;
use App\Model\Boleta;
use App\Model\Persona;
use App\Model\Empresa;
use App\Model\Colaborador;
use App\Model\Cargo;
use App\Model\Cliente;
use App\Model\Presupuesto;

class GraficoController extends Controller
{
    public function AsistGrafico(Request $request){

        $ini = $request->inicio;
        $fin = $request->fin;

        $datos = DB::select("select p.per_nombres,p.per_apellidos, COUNT(distinct(ht.Hrs_fecha)) as cantidad FROM horas_trabajadas ht 
        inner join colaborador c on c.idCol=ht.idCol inner join persona p on p.idPersona=c.idPersona
        WHERE ht.Hrs_fecha>='$ini' AND ht.Hrs_fecha<='$fin' GROUP BY p.per_nombres,p.per_apellidos ORDER BY p.per_apellidos");
    


        $data = [];
        $x = 0;

        foreach ($datos as $dato) {
            $data[$x]['colaborador'] = $dato->per_apellidos.' '.$dato->per_nombres;

            $data[$x]['asistencias'] = $dato->cantidad;

            $x++;
        }
        return json_encode($data);
    }

    public function HorastGrafico(Request $request){

        $inicio = $request->inicio;
        $fin = $request->fin;

        $datos = DB::select("select distinct persona.per_nombres, persona.per_apellidos,Car_nombre, SUM(Hrs_cantidad) as horas from horas_trabajadas 
        inner join colaborador on colaborador.idCol = horas_trabajadas.idCol inner join persona on persona.idPersona = colaborador.idPersona inner join cargo on cargo.idCargo =colaborador.idCargo 
        WHERE horas_trabajadas.Hrs_fecha>='$inicio' AND horas_trabajadas.Hrs_fecha<='$fin' GROUP BY horas_trabajadas.idCol,persona.per_nombres, persona.per_apellidos,Car_nombre ORDER BY persona.per_apellidos");


        $data = [];
        $x = 0;

        foreach ($datos as $dato) {
            $data[$x]['colaborador'] = $dato->per_apellidos.' '.$dato->per_nombres;

            $data[$x]['horas'] = $dato->horas;

            $x++;
        }
        // dd(json_encode($datos));
        return json_encode($data);
    }

    public function BoletasGrafico(Request $request){
        
        $periodo= $request->periodo;
        $planilla = Planilla::where('Periodo',$periodo)->first();
        $datos=Boleta::join('colaborador','colaborador.idCol','boleta.idCol')->join('persona','persona.idPersona','colaborador.idPersona')
        ->join('cargo','cargo.idCargo','colaborador.idCargo')->where('boleta.idPlanilla',$planilla->idPlanilla)
        ->select('per_apellidos','per_nombres','Car_nombre','remuneracionNeta','essalud','sctr')->get();

        return json_encode($datos);
    }

    public function PlanillasGrafico(Request $request){
        $inicio = $request->inicio;
        $fin = $request->fin;
        
        $datos = Planilla::whereYear('Plan_inicio','>=',$inicio)->whereYear('Plan_inicio','<=',$fin)
        ->select('Periodo','Plan_registro','Plan_costo')->orderBy('Plan_registro')->get();

        return json_encode($datos);
    }

    public function PresupuestosGrafico(Request $request){
        $inicio = $request->inicio;
        $fin = $request->fin;

        $datos = Presupuesto::leftjoin('cliente','cliente.idCliente','presupuesto.idCliente')
        ->leftjoin('persona','persona.per_dni','cliente.clie_identificador')->leftjoin('empresa','empresa.RUC','cliente.clie_identificador')
        ->where('pres_estado','activo')->where('fechaRegistro','>=',$inicio)->where('fechaRegistro','<=',$fin)->orderBy('presupuesto.idPresupuesto')->get();

        return json_encode($datos);
    }
}
