<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use View;
use App\Clases\PDF;

use App\Model\Boleta;
use App\Model\Colaborador;
use App\Model\Persona;
use App\Model\Cargo;
use App\Model\Horas_Trabajadas;
use App\Model\Planilla;


class BoletaController extends Controller
{
    public function inicio(){
        $boletas = Boleta::join('planilla','planilla.idPlanilla','boleta.idPlanilla')
        ->join('colaborador','colaborador.idCol','boleta.idCol')->join('persona','persona.idPersona','colaborador.idPersona')
        ->orderBy('idBoleta')->get();

        return View::make('boleta.inicio')->with(['boletas'=>$boletas]);
    }

    public function ver($id){
        Carbon::setLocale('es');
        $boleta = Boleta::findOrFail($id);
        $planilla = Planilla::findOrFail($boleta->idPlanilla);
        $colaborador = Colaborador::join('persona','persona.idPersona','colaborador.idPersona')->join('cargo','cargo.idCargo','colaborador.idCargo')
        ->join('sist_pension','sist_pension.idSistPension','colaborador.idSistPension')->where('idCol',$boleta->idCol)->first();
        $fecha = Carbon::parse($planilla->Plan_inicio);
        $dias = Horas_Trabajadas::where('idCol',$colaborador->idCol)->whereMonth('Hrs_fecha',$fecha)
        ->whereYear('Hrs_fecha',$fecha)->distinct('Hrs_fecha')->count();
        

        $horas = 0;

        $registros = Horas_Trabajadas::where('idCol',$colaborador->idCol)->whereMonth('Hrs_fecha',$fecha)
        ->whereYear('Hrs_fecha',$fecha)->get();
        

       
        foreach ($registros as $reg)
        {
            $horas = $horas + $reg->Hrs_cantidad;
        }
        return View::make('boleta.ver')->with(['periodo'=>$planilla->Periodo, 'colaborador'=>$colaborador,
        "boleta"=>$boleta,'dias'=>$dias,'horas'=>number_format($horas,2,'.','')]);
    }

    public function reporte(){

        $hoy = new Carbon();
        $periodo = $hoy->monthName;
        $numMes = $hoy->month;
        $boletas = Boleta::where('bol_estado',1)->orderBy('bol_fecha','desc')->get();

        $row =[];
        $x = 0;

        foreach ($boletas as $bol) {
            $col = Colaborador::where('idColaborador',$bol->idColaborador)->first();
            $row[$x]['colaborador'] = $col->col_nombres.' '.$col->col_apellidos;

            $row[$x]['fecha'] = $bol->bol_fecha;
            $row[$x]['total'] = $bol->bol_total;

            $x++;
        }

        return View::make('boleta.lista')->with(['row'=>$row,'periodo'=>$periodo,'mes'=>$numMes]);
    }

    public function eliminar($id){

        $boleta = Boleta::findOrFail($id);
        $boleta->bol_estado = 0;
        $boleta->save();

        return redirect()->route('boleta.register');
    }

    public function pdf($id){

        $boleta = Boleta::findOrFail($id);
     
        $planilla = Planilla::findOrFail($boleta->idPlanilla);
        $colaborador = Colaborador::join('persona','persona.idPersona','colaborador.idPersona')->join('cargo','cargo.idCargo','colaborador.idCargo')
        ->join('sist_pension','sist_pension.idSistPension','colaborador.idSistPension')->where('idCol',$boleta->idCol)->first();
        $fecha = Carbon::parse($planilla->Plan_inicio);
        $dias = Horas_Trabajadas::where('idCol',$colaborador->idCol)->whereMonth('Hrs_fecha',$fecha)
        ->whereYear('Hrs_fecha',$fecha)->distinct('Hrs_fecha')->count();
        

        $horas = 0;

        $registros = Horas_Trabajadas::where('idCol',$colaborador->idCol)->whereMonth('Hrs_fecha',$fecha)
        ->whereYear('Hrs_fecha',$fecha)->get();
        

       
        foreach ($registros as $reg)
        {
            $horas = $horas + $reg->Hrs_cantidad;
        }

        // CREACION DEL PDF
        $pdf = new PDF();
        $pdf->AddPage('L','A4');
        $pdf->SetTitle('boleta','true');
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial','B',13);
        $pdf->SetTextColor(16, 179, 51);
        $pdf->Cell(60,5,utf8_decode('RESPONSABLE WORK E.I.R.L.'),0,1,'L',0);
        $pdf->SetFont('Arial','B',10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(65,5,utf8_decode('R.U.C.   N° 20602163751'),0,1,'C',0);

        $pdf->Ln();

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(165,6,utf8_decode('BOLETA DE PAGO'),0,0,'R',0);
        $pdf->SetFont('Courier','',12);
        $pdf->Cell(70,6,utf8_decode('D.S. N° 001-98TR'),0,1,'R',0);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,5,utf8_decode($planilla->Periodo),0,1,'C',0);

        $pdf->Ln();

        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(24);
        $pdf->Cell(40,7,utf8_decode('DNI:'),'LT',0,'R',0);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(75,7,utf8_decode($colaborador->per_dni),'T',0,'L',0);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(40,7,utf8_decode('Apellidos y Nombres:'),'T',0,'R',0);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(75,7,utf8_decode($colaborador->per_apellidos.' '.$colaborador->per_nombres),'TR',1,'L',0);

        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(24);
        $pdf->Cell(40,5,utf8_decode('F. Ingreso:'),'L',0,'R',0);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(75,5,utf8_decode(date('d-m-Y',strtotime($colaborador->per_registro))),0,0,'L',0);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(40,5,utf8_decode('Cargo:'),0,0,'R',0);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(75,5,utf8_decode($colaborador->Car_nombre),'R',1,'L',0);

        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(24);
        $pdf->Cell(40,7,utf8_decode('Días Trabajados:'),'LB',0,'R',0);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(75,7,utf8_decode($dias),'B',0,'L',0);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(40,7,utf8_decode('Horas Trabajadas:'),'B',0,'R',0);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(75,7,utf8_decode($horas.' hrs' ),'BR',1,'L',0);

        $pdf->Ln(7);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->Cell(24);
        $pdf->Cell(90,7,utf8_decode('INGRESOS'),1,0,'C',1);
        $pdf->Cell(25,7,utf8_decode('IMPORTE'),1,0,'C',1);
        $xe=$pdf->GetX();
        $pdf->Cell(90,7,utf8_decode('DESCUENTOS Y RETENCIONES'),1,0,'C',1);
        $pdf->Cell(25,7,utf8_decode('IMPORTE'),1,1,'C',1);
        $pdf->SetFont('Arial','',10);
        //x=10(derecha) y=74(abajo)
        // dd($pdf->GetX().' '.$pdf->GetY());
        $pdf->Cell(24);
        $pdf->SetTextColor(0, 0, 0);

        $x=$pdf->GetX();
        $y=$pdf->GetY();
        $xi=$x;
        $yi=$y;

        $pdf->Cell(90,7,utf8_decode('SALARIO MENSUAL'),'',0,'C',0);
        $pdf->Cell(25,7,utf8_decode('S/'.$boleta->sueldoBasico),'',1,'C',0);
        
        $ye=$pdf->GetY()-7;
        
        if($boleta->asigFamiliar!='0.00'){
            $yi+=7;
            $pdf->Cell(24);
            $pdf->Cell(90,7,utf8_decode('ASIGNACION FAMILIAR'),'',0,'C',0);
            $pdf->Cell(25,7,utf8_decode('S/'.$boleta->asigFamiliar),'',1,'C',0);
        }
        if($boleta->otrosIngresos!='0.00'){
            $yi+=7;
            $pdf->Cell(24);
            $pdf->Cell(90,7,utf8_decode('OTROS'),'',0,'C',0);
            $pdf->Cell(25,7,utf8_decode('S/'.$boleta->otrosIngresos),'',1,'C',0);
        }
       
        $pdf->SetXY($xe,$ye);
        if($boleta->costoInasist!='0.00'){
            $ye+=7;
            $pdf->Cell(90,7,utf8_decode('INASISTENCIAS'),'',0,'C',0);
            $pdf->Cell(25,7,utf8_decode('S/'.$boleta->costoInasist),'',1,'C',0);
        }
        if($boleta->costoAdelanto!='0.00'){
            $pdf->SetXY($xe,$ye);
            $ye+=7;
            $pdf->Cell(90,7,utf8_decode('ADELANTO'),'',0,'C',0);
            $pdf->Cell(25,7,utf8_decode('S/'.$boleta->costoAdelanto),'',1,'C',0);
        }
        if($boleta->otrosEgresos!='0.00'){
            $pdf->SetXY($xe,$ye);
            $ye+=7;
            $pdf->Cell(90,7,utf8_decode('OTROS'),'',0,'C',0);
            $pdf->Cell(25,7,utf8_decode('S/'.$boleta->otrosEgresos),'',1,'C',0);
        }
        if($boleta->costoONP!='0.00'){
            $pdf->SetXY($xe,$ye);
            $ye+=7;
            $pdf->Cell(90,7,utf8_decode('APORTE ONP'),'',0,'C',0);
            $pdf->Cell(25,7,utf8_decode('S/'.$boleta->costoONP),'',1,'C',0);
        }
        else{
            $pdf->SetXY($xe,$ye);
            $ye+=7;
            $pdf->Cell(90,7,utf8_decode('APORTE OBLIGATORIO AFP'),'',0,'C',0);
            $pdf->Cell(25,7,utf8_decode('S/'.$boleta->AFPoblig),'',1,'C',0);
            $pdf->SetXY($xe,$ye);
            $ye+=7;
            $pdf->Cell(90,7,utf8_decode('COMISIÓN AFP-'.$colaborador->col_comPension),'',0,'C',0);
            $pdf->Cell(25,7,utf8_decode('S/'.$boleta->AFPcom),'',1,'C',0);
            $pdf->SetXY($xe,$ye);
            $ye+=7;
            $pdf->Cell(90,7,utf8_decode('SEGURO AFP-'.$colaborador->col_comPension),'',0,'C',0);
            $pdf->Cell(25,7,utf8_decode('S/'.$boleta->AFPseguro),'',1,'C',0);
        }

        $newY=max($yi,$ye);
        $pdf->SetXY($xi,$newY);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->Cell(90,7,utf8_decode('TOTAL INGRESOS:'),1,0,'C',1);
        $pdf->Cell(25,7,utf8_decode('S/'.$boleta->ingresoBruto),1,0,'C',1);
        $pdf->Cell(90,7,utf8_decode('TOTAL DESCUENTOS:'),1,0,'C',1);
        $descuentoTotal = number_format($boleta->egreBruto+$boleta->totalAporte,2,'.','');
        $pdf->Cell(25,7,utf8_decode($descuentoTotal),1,1,'C',1);
        
        $pdf->Ln(5);


        $pdf->Cell(24);
        $pdf->SetFillColor(120, 114, 114);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(28,5,utf8_decode('ESSALUD'),1,0,'C',1);

        $pdf->Cell(28,5,utf8_decode('SCTR'),1,0,'C',1);
        $pdf->Cell(28,5,utf8_decode('SENATI'),1,1,'C',1);

        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetDrawColor(0,0,0);
        $pdf->Cell(24);
        $pdf->Cell(28,5,utf8_decode('S/'.$boleta->essalud),1,0,'C',1);
        $pdf->Cell(28,5,utf8_decode('S/'.$boleta->sctr),1,0,'C',1);
        $pdf->Cell(28,5,utf8_decode('S/0.00'),1,0,'C',1);


        $pdf->Ln(35);
        $pdf->Cell(52);
        $pdf->Cell(56,5,utf8_decode('RESPONSABLE WORK E.I.R.L.'),'T',0,'C',1);
        $pdf->Cell(58,5,utf8_decode(''),0,0,'C',1);
        $pdf->Cell(56,5,utf8_decode('FIRMA DEL TRABAJADOR'),'T',0,'C',1);   
        $pdf->Output('I','BOLETA.pdf');
        exit;
        
    }
    public function grafico(){
        return View::make('boleta.grafico');
    }

    public function inicioReporte(){
        $periodos = Planilla::select('Periodo')->distinct('Periodo')->get();

        // dd($periodos);

        return View::make('boleta.inicioReporte')->with(['periodos'=>$periodos]);
    }
    public function generarReporteBoletas($periodo){

        $planilla = Planilla::where('Periodo',$periodo)->first();
        $datos=Boleta::join('colaborador','colaborador.idCol','boleta.idCol')->join('persona','persona.idPersona','colaborador.idPersona')
        ->join('cargo','cargo.idCargo','colaborador.idCargo')->where('boleta.idPlanilla',$planilla->idPlanilla)
        ->select('per_apellidos','per_nombres','Car_nombre','remuneracionNeta','essalud','sctr')->get();
        
        return(json_encode($datos));
    }
    public function PDFboletasTabla($periodo){

        $planilla = Planilla::where('Periodo',$periodo)->first();
        $info=Boleta::join('colaborador','colaborador.idCol','boleta.idCol')->join('persona','persona.idPersona','colaborador.idPersona')
        ->join('cargo','cargo.idCargo','colaborador.idCargo')->where('boleta.idPlanilla',$planilla->idPlanilla)
        ->select('per_apellidos','per_nombres','Car_nombre','remuneracionNeta','essalud','sctr')->get();

        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");
        $ini=$periodo;
        $fin=$periodo;
        $cabF=['Desde: ','Hasta: ','Periodo: '];

        $nombreDoc='reporte_boletas';
        
        $titulo="REPORTE DE HORAS TRABAJADAS ";
        $colums=['A NOMBRE DE', 'CARGO','TOTAL'];
        $contenido= [];

       foreach ($info as $dato) {
            $total = $dato->remuneracionNeta + $dato->essalud + $dato->sctr;

            $fila = [];

            $fila[]=$dato->per_apellidos.' '.$dato->per_nombres;
            $fila[]=$dato->Car_nombre;
            $fila[]='S/ '.$total;

            $contenido[]=$fila;
       }
      
 
        $pdf = \domPDF::loadView('PDF_tabla',compact('cabF','ini','fin','generado','nombreDoc','titulo','colums','contenido'));
        return $pdf->stream('reporte_boletas.pdf');

    }
    public function PDFboletasGrafico($periodo){

        $planilla = Planilla::where('Periodo',$periodo)->first();
        $info=Boleta::join('colaborador','colaborador.idCol','boleta.idCol')->join('persona','persona.idPersona','colaborador.idPersona')
        ->join('cargo','cargo.idCargo','colaborador.idCargo')->where('boleta.idPlanilla',$planilla->idPlanilla)
        ->select('per_apellidos','per_nombres','Car_nombre','remuneracionNeta','essalud','sctr')->orderBy('persona.per_apellidos')->get();
       

        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");
        $ini=$periodo;
        $fin=$periodo;
        $cabF=['Desde: ','Hasta: ','Periodo: '];


        $nombreDoc='grafico_boleta';
        
        $titulo="REPORTE GRÁFICO DE BOLETAS GENERADAS";
        
        $nombres=array();
        $cant=sizeof($info);

        for ($i=0; $i<$cant ; $i++) { 
            $nombres[$i]="Col. ".($i+1).": ".strval($info[$i]->per_apellidos.' '.$info[$i]->per_nombres);
        }

        $posiciones="'Col. 1'";
        for ($i=2; $i<=$cant ; $i++) { 
            $posiciones=$posiciones.",'Col. ".$i."'";
        }

        $total=number_format(($info[0]->remuneracionNeta+$info[0]->essalud+$info[0]->sctr),2);
        $datos="'".$total."'";
        for ($i=1; $i<$cant ; $i++) { 
            $total = number_format(($info[$i]->remuneracionNeta+$info[$i]->essalud+$info[$i]->sctr),2);
            $datos=$datos.", '".$total."'";
        }

        $r=161;
        $g=2;
        $b=2;
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
                top: 20
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Costo de Boleta (S/)'
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
                text: 'Boletas Generadas',
                padding: {
                    bottom: 30
                }
            }
            
        }";
        


        // dd($nombres);
        $pdf = \domPDF::loadView('basePDF',compact('generado','nombreDoc','titulo','cabF','ini','fin','nombres','data','options'));
        return $pdf->stream('Grafico_Boletas_'.$periodo.'.pdf');
    }
}
