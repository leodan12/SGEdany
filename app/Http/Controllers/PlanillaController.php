<?php

namespace App\Http\Controllers;
use View;
use Datetime;
use Carbon\Carbon;
use App\Clases\PDF;

use App\Model\Boleta;
use App\Model\Colaborador;
use App\Model\Persona;
use App\Model\Cargo;
use App\Model\Sist_Pension;
use App\Model\Horas_Trabajadas;
use App\Model\Flujo_Dinero;
use App\Model\Adelanto;
use App\Model\Planilla;
use App\Model\Tipo_Planilla;
use App\Model\Montos;

use Illuminate\Http\Request;

class PlanillaController extends Controller
{
    public function inicio(){
        $planillas = Planilla::join('tipo_planilla','tipo_planilla.idTipoPlanilla','planilla.idTipoPlanilla')->get();
        return view('planilla.Pinicio')->with(['planillas'=>$planillas]);
    }
    public function registro(){
        
        //PERIODO
        $hoy =  Carbon::today();
        $periodo = strtoupper(now()->monthName.' - '.now()->year);
        $inicio=now()->firstOfMonth(); 
        $fin=now()->lastOfMonth();
      

        //DATOS
        $registros = Horas_Trabajadas::whereMonth('Hrs_fecha',now())->whereYear('Hrs_fecha',now())
        ->select('idCol','Hrs_fecha','Hrs_cantidad')->get();
        $colaboradores = Colaborador::join('persona','persona.idPersona','colaborador.idPersona')->join('horas_trabajadas','horas_trabajadas.idCol','colaborador.idCol')
        ->whereMonth('Hrs_fecha',now())->whereYear('Hrs_fecha',now())->select('colaborador.*','persona.*')->distinct()->get();
 
        $row= [];
        $cont = 0;
        $totalP=number_format(0.00,2,'.','');
        foreach ($colaboradores as $col){

            //DATOS COLABORADOR
            $row[$cont]["dni"] =$col->per_dni;
            $row[$cont]["nombre"] = $col->per_apellidos.' '.$col->per_nombres;
            $cargo = Colaborador::join('cargo','cargo.idCargo','colaborador.idCargo')
            ->select('cargo.Car_nombre')->where('colaborador.idCol',$col->idCol)->first();
            $row[$cont]["cargo"]=$cargo->Car_nombre;
           //FIN DATOS COLABORADOR

           //DATOS DE LOS INGRESOS
           //SUELDO BÁSICO
           $sueldo = $col->col_sueldo;
           $row[$cont]["sueldo"]=$sueldo;
           //ASIGNACIÓN FAMILIAR
           $asigFam =number_format(00.0,2,'.','');
           
           if($col->col_asigFam == 'SI'){
               $minimo = Montos::where('concepto','MINIMO')->first();
               $asigFam =number_format($minimo->monto*0.1,2,'.');
           }
           $row[$cont]["asigFam"]=$asigFam;

           //OTROS INGRESOS
            $ingresos=Flujo_Dinero::join('tipo_flujo','tipo_flujo.idTipoFlujo','flujo_dinero.idTipoFlujo')->where('TF_nombre','INGRESO')
            ->where('idCol',$col->idCol)->where('Flu_estado','activo')->whereMonth('Flu_fecha',$hoy)->whereYear('Flu_fecha',$hoy)
            ->select('flujo_dinero.*')->get();
            
            $montoIng = number_format(00.0,2,'.','');
            foreach ($ingresos as $ing) {
                $montoIng = $montoIng + $ing->Flu_monto;
            }
            $row[$cont]["otrosI"] =number_format($montoIng,2,'.','');
            
            //TOTAL DE INGRES0S
            $Ting = $sueldo+ $asigFam + $montoIng;
            $row[$cont]["Ting"] = number_format($Ting,2,'.','');

            //DATOS DE LOS EGRESOS DEL COLABORADOR
            //INASISTENCIAS
            $cant_hrs=number_format(00.0,2,'.','');

            foreach ($registros as $reg) {
                if($reg->idCol == $col->idCol){
                    $cant_hrs+=$reg->Hrs_cantidad;
                }
            }
            $montoInasis = $sueldo*(1-($cant_hrs/192));
            if ($montoInasis<0)
            $montoInasis='0.00';
            $row[$cont]["inasistencias"] =number_format($montoInasis,2,'.','');

            //ADELANTO
            $RegAdel = Adelanto::where('idCol',$col->idCol)->whereMonth('Adel_fecha',$hoy)->whereYear('Adel_fecha',$hoy)->first();
            if($RegAdel){
                $adelanto=$RegAdel->Adel_monto;
                $row[$cont]["adelanto"] =number_format($adelanto,2,'.','');
            }else{
                $adelanto=0;
                $row[$cont]["adelanto"] =number_format(0.00,2,'.','');
            }
            

            //OTROS EGRESOS
            $descuentos=Flujo_Dinero::join('tipo_flujo','tipo_flujo.idTipoFlujo','flujo_dinero.idTipoFlujo')->where('TF_nombre','EGRESO')
            ->where('idCol',$col->idCol)->where('Flu_estado','activo')->whereMonth('Flu_fecha',$hoy)->whereYear('Flu_fecha',$hoy)
            ->select('flujo_dinero.*')->get();

            $montoEgre = number_format(00.0,2,'.','');
            foreach ($descuentos as $desc) {
                $montoEgre = $montoEgre + $desc->Flu_monto;
            }
            $row[$cont]["otrosD"] =number_format($montoEgre,2,'.','');

            //TOTAL EGRESOS
            $Tdesc = $montoInasis + $adelanto + $montoEgre;
            $row[$cont]["Tdesc"] = number_format($Tdesc,2,'.','');

            //APORTES DEL TRABAJADOR
            $tipoPension = Sist_Pension::findOrFail($col->idSistPension);
            if ($tipoPension->Pen_nombre == 'ONP'){

                $row[$cont]["onp"] = 'SI';
                $onp=$sueldo*$tipoPension->Porc_obligatorio/100;
                $row[$cont]["Monp"] = number_format($onp,2,'.','');

                $row[$cont]["afp"] = 'NO';
                $row[$cont]["obligatorio"] = '0.00';
                $row[$cont]["comision"] = '0.00';
                $row[$cont]["prima"] = '0.00';

                $descSeg = $onp;

            } else{
                $row[$cont]["onp"] = 'NO';
                $row[$cont]["Monp"] = '0.00';

                $row[$cont]["afp"] = $tipoPension->Pen_nombre;
                $oblig = $sueldo*$tipoPension->Porc_obligatorio/100;
                $row[$cont]["obligatorio"] = number_format($oblig,2,'.','');
                if($col->col_comPension='FLUJO'){
                    $comision=$sueldo*$tipoPension->Porc_comFlujo/100;
                }else{
                    $comision=$sueldo*$tipoPension->Porc_comMixta/100;
                }
                $row[$cont]["comision"] = number_format($comision,2,'.','');
                $prima=$sueldo*$tipoPension->Porc_seguro/100;
                $row[$cont]["prima"] = number_format($prima,2,'.','');
                
                $descSeg =$oblig+$comision+$prima;
            }
            $row[$cont]["TdesEmpleado"]=number_format($descSeg,2,'.','');
            

            //TOTAL REMUNERACION
            $totalRem=$Ting-($Tdesc+$descSeg);
            $row[$cont]["totalRem"] = number_format($totalRem,2,'.','');

            //APORTES EMPLEADOR
            //ESSALUD
            $porcEssalud =Montos::where('concepto','ESSALUD')->first();
            $essalud=$sueldo*$porcEssalud->monto/100;
            $row[$cont]["essalud"]=number_format($essalud,2,'.','');

            //SCTR
            if($col->col_sctr=='SI'){
                $porcSctr =Montos::where('concepto','SCTR')->first();
                $sctr=$sueldo*$porcSctr->monto/100;
            }else{
                $sctr=0.00;
            }
            $row[$cont]["sctr"]=number_format($sctr,2,'.','');

            //TOTAL ACUMULADO DE LA PLANILLA
            $total=$totalRem+$essalud+$sctr;
            $totalP+=number_format($total,2,'.','');

            $cont++;
        }   
        return view('planilla.Pregistro')->with(['periodo'=>$periodo,'row'=>$row,'inicio'=>$inicio,'fin'=>$fin,'totalP'=>$totalP,'tipo'=>'GENERAL','hoy'=>$hoy]);
    }

    public function guardar(Request $request){
        
        try {
            $datos = json_decode($request->datos);

            $periodo = $datos->{"periodo"};
            $inicio = $datos->{"inicio"};
            $fin = $datos->{"fin"};
            $registro = $datos->{"registro"};
            $total =$datos->{"total"};

            $detalle=$datos->{"detalle"};
            $tamDet=sizeof($detalle);
            
            $planilla = new Planilla;
            $planilla->Periodo=$periodo;
            $planilla->Plan_inicio=$inicio;
            $planilla->Plan_final=$fin;
            $planilla->Plan_registro=$registro;
            $planilla->idTipoPlanilla=1;
            $planilla->Plan_costo=$total;
            $planilla->save();

            $plan = Planilla::orderBy('idPlanilla','desc')->first();
            for ($i=0; $i < $tamDet; $i++) { 
                $boleta = new Boleta;
                $colaborador = Colaborador::join('persona','persona.idPersona','colaborador.idPersona')
                ->where('per_dni',$detalle[$i][0])->first();
                $boleta->idCol = $colaborador->idCol;
                $boleta->idPlanilla = $plan->idPlanilla;
                $boleta->sueldoBasico =floatval(substr($detalle[$i][3],3));
                $boleta->asigFamiliar =floatval(substr($detalle[$i][4],3));
                $boleta->otrosIngresos =floatval(substr($detalle[$i][5],3));
                $boleta->ingresoBruto =floatval(substr($detalle[$i][6],3));
                $boleta->costoInasist =floatval(substr($detalle[$i][7],3));
                $boleta->costoAdelanto =floatval(substr($detalle[$i][8],3));
                $boleta->otrosEgresos =floatval(substr($detalle[$i][9],3));
                $boleta->egreBruto =floatval(substr($detalle[$i][10],3));
                $boleta->costoONP =floatval(substr($detalle[$i][12],3));
                $boleta->AFPoblig =floatval(substr($detalle[$i][14],3));
                $boleta->AFPcom =floatval(substr($detalle[$i][15],3));
                $boleta->AFPseguro =floatval(substr($detalle[$i][16],3));
                $boleta->totalAporte =floatval(substr($detalle[$i][17],3));
                $boleta->remuneracionNeta =floatval(substr($detalle[$i][18],3));
                $boleta->essalud =floatval(substr($detalle[$i][19],3));
                $boleta->sctr =floatval(substr($detalle[$i][20],3));
                $boleta->save();
            }
            
            return json_encode("success");
        } catch (\Throwable $th) {
            dd($th);
            return json_encode("error");
        }

    }

    public function ver($id){
        $planilla = Planilla::findOrFail($id);
        $detalle = Boleta::join('colaborador','colaborador.idCol','boleta.idCol')->join('cargo','cargo.idCargo','colaborador.idCargo')
        ->join('persona','persona.idPersona','colaborador.idPersona')->where('idplanilla',$id)->get();
        $tipo = Tipo_Planilla::findOrFail($planilla->idTipoPlanilla);
        return view('planilla.Pver')->with(['planilla'=>$planilla,'detalle'=>$detalle,'tipo'=>$tipo]);
    }
    public function PDF($id){
        $planilla = Planilla::findOrFail($id);
        $detalle = Boleta::join('colaborador','colaborador.idCol','boleta.idCol')->join('cargo','cargo.idCargo','colaborador.idCargo')
        ->join('persona','persona.idPersona','colaborador.idPersona')->where('idplanilla',$id)->get();
        $tipo = Tipo_Planilla::findOrFail($planilla->idTipoPlanilla);

        $subtotal=[];
        $total=0.00;
        $x=0;

        foreach ($detalle as $det) {
            $subtotal[$x]=number_format($det->Mov_costo*$det->Mov_cantidad,2);
            $total+=$subtotal[$x];
            $x++;
        }

        $total = number_format($total,2);

        $nombreDoc='planilla';
        
        $titulo="PLANILLA ".$planilla->Periodo;

        $pdf = \domPDF::loadView('planilla.PDF',compact('nombreDoc','titulo','planilla','tipo', 'detalle','subtotal','total'));
        $pdf->setPaper('folio', 'landscape');
        $pdf->render();
        return $pdf->stream('hoja_almacen.pdf');

    }
    public function reportePlanillas(){

        $fechas = Planilla::select('Plan_inicio')->distinct('Plan_inicio')->get();
        
        return view('planilla.inicioReporte')->with(['fechas'=>$fechas]);
        
    }
    public function generarReportePlanillas($inicio,$fin){

        $datos = Planilla::whereYear('Plan_inicio','>=',$inicio)->whereYear('Plan_inicio','<=',$fin)
        ->select('Periodo','Plan_registro','Plan_costo')->orderBy('Plan_registro')->get();
        
        return(json_encode($datos));
    }
    public function PDFplanillasTabla($inicio,$fin){

        $info = Planilla::whereYear('Plan_inicio','>=',$inicio)->whereYear('Plan_inicio','<=',$fin)
        ->select('Periodo','Plan_registro','Plan_costo')->get();

        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");
        $fini = new Carbon($inicio);
        $ffin = new Carbon($fin);
        $ini=$fini->isoFormat('YYYY');
        $fin=$ffin->isoFormat('YYYY');
        $cabF=['Desde: ','Hasta: ','Año: '];

        $nombreDoc='reporte_planillas';
        
        $titulo="REPORTE DE HORAS TRABAJADAS ";
        $colums=['PERIODO', 'REGISTRADO EL','TOTAL'];
        $contenido= [];

       foreach ($info as $dato) {
            $registro = new Carbon($dato->Plan_registro);
            $fila = [];

            $fila[]=$dato->Periodo;
            $fila[]=$registro->isoFormat('DD-MM-YYYY');
            $fila[]='S/ '.$dato->Plan_costo;

            $contenido[]=$fila;
       }
    
        $pdf = \domPDF::loadView('PDF_tabla',compact('cabF','ini','fin','generado','nombreDoc','titulo','colums','contenido'));
        return $pdf->stream('reporte_hrsTrabajadas.pdf');
    }
    public function PDFPlanillasGrafico($inicio,$fin){

        $info=Planilla::whereYear('Plan_inicio','>=',$inicio)->whereYear('Plan_inicio','<=',$fin)
        ->select('Periodo','Plan_registro','Plan_costo')->get();

        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");
        $fini = new Carbon($inicio);
        $ffin = new Carbon($fin);
        $ini=$fini->isoFormat('YYYY');
        $fin=$ffin->isoFormat('YYYY');
        $cabF=['Desde: ','Hasta: ','Año: '];
        
        $nombreDoc='grafico_planillas';
        
        $titulo="REPORTE GRÁFICO DE PLANILLAS EMITIDAS";
        
        $nombres=array();
        $cant=sizeof($info);

        for ($i=0; $i<$cant ; $i++) { 
            $nombres[$i]="Per. ".($i+1).":  ".strval($info[$i]->Periodo)."";
        }

        $posiciones="'Per. 1'";
        for ($i=2; $i<=$cant ; $i++) { 
            $posiciones=$posiciones.",'Per. ".$i."'";
        }

        $datos="'".number_format(($info[0]->Plan_costo),2)."'";
        for ($i=1; $i<$cant ; $i++) { 
            $datos=$datos.", '".number_format(($info[$i]->Plan_costo),2)."'";
        }

        // dd($nombres,$posiciones,$datos);
        $r=161;
        $g=20;
        $b=20;
        $random=rand(1,122);

        if($random%2==0)
            $g=$random;
        else
            $b=$random;
    
        
        $data="labels: [".$posiciones."],
        datasets: [{
            data: [".$datos."],
            backgroundColor:'rgba(".$r.",".$g.",".$b.",0.2)',
            borderColor: 'rgba(".$r.",".$g.",".$b.",1)',
            borderWidth: 1
        }]";

        $options="maintainAspectRatio:false,
        responsive:true,
        layout: {
            padding:{
                bottom: 20
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Nro de Horas'
                  }
            }
        },
        plugins: {
            
            datalabels: {
                anchor:'end',
                align: 'end',
                font:{
                    weight: 'bold'
                }
            },
            legend:{
                display: false
            },
            title: {
                display: true,
                text: 'Horas Trabajadas',
                padding: {
                    bottom: 30
                }
            }
            
        }";
        


        // dd($nombres);
        $pdf = \domPDF::loadView('basePDF',compact('generado','nombreDoc','titulo','cabF','ini','fin','nombres','data','options'));
        return $pdf->stream('grafico_asistencias'.$ini.'_'.$fin.'pdf');
    }
}
