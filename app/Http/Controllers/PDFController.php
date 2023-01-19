<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clases\PDFasistencias;
use domPDF;

use Carbon\Carbon;
use DateTime;

use App\Model\Boleta;
use App\Model\Persona;
use App\Model\Colaborador;
use App\Model\Cargo;
use App\Model\Horas_Trabajadas;
use App\Model\Ingreso;

class PDFController extends Controller
{
    public function PDFasistencia($ini,$fin){

        
        // Carbon::setLocale('es');
        // $fini = new Carbon($ini);
        // $ffin = new Carbon($fin);


        // $colaboradores = Colaborador::where('col_estado',1)->get();
        // $cargos = Cargo::where('car_estado',1)->get();

        // $pdf = new PDFasistencias();
        // $pdf->AddPage('P','A4');
        // $pdf->AliasNbPages();
        // $pdf->SetFont('Arial','B',30);
        // $pdf->SetTextColor(16, 179, 51);
        // $pdf->Cell(0,5,utf8_decode('RESPONSABLE WORK E.I.R.L.'),0,1,'C',0);

        // $pdf->Ln(20);

        // $pdf->SetFont('Arial','B',20);
        // $pdf->SetTextColor(16, 26, 179);

        // if($ini == $fin){

        //     $asistencias = Registro::where('reg_fecha',$ini)->get();
        //     $pdf->Cell(0,5,utf8_decode('ASISTENCIAS DEL DIA '.$fini->calendar()),0,1,'C',0);

        // } else {

        //     $asistencias = Registro::where('reg_fecha','>=',$ini)->where('reg_fecha','<=',$fin)->get();
        //     $pdf->Cell(0,5,utf8_decode('ASISTENCIAS DEL DIA '.$fini->format('d/m/Y').' HASTA EL '.$ffin->format('d/m/Y')),0,1,'C',0);
        // }

        // $pdf->Ln(15);
        // $pdf->SetFont('Arial','B',12);
        // $pdf->SetFillColor(0, 0, 0);
        // $pdf->SetTextColor(255, 255, 255);

        // $pdf->Cell(20,10,utf8_decode('Nro.'),1,0,'C',1);
        // $pdf->Cell(45,10,utf8_decode('Registrado el'),1,0,'C',1);
        // $pdf->Cell(75,10,utf8_decode('Colaborador'),1,0,'C',1);
        // $pdf->Cell(50,10,utf8_decode('Cargo'),1,1,'C',1);

        // $pdf->SetFont('Arial','',11);
        // $pdf->SetFillColor(192, 193, 205);
        // $pdf->SetTextColor(0,0,0);

        // $cont = 1 ;
        // $par =0;
        // foreach ($asistencias as $asis) {


        //     if($cont % 2 ==0)
        //         $par=1;
        //     else
        //         $par=0;

        //     $pdf->Cell(20,7,$cont,'TB',0,'C',$par);
        //     $registro = new Carbon($asis->reg_fecha);
        //     $pdf->Cell(45,7,utf8_decode($registro->format('d/m/Y')),'TB',0,'C',$par);


        //     foreach ($colaboradores as $col) {
        //         if ($asis->idColaborador == $col->idColaborador) {
        //             $pdf->Cell(75,7,utf8_decode($col->col_nombres.' '.$col->col_apellidos),'TB',0,'C',$par);

        //             foreach ($cargos as $cargo) {
        //                 if ($col->idCargo == $cargo->idCargo) {
        //                     $pdf->MultiCell(50,7,utf8_decode($cargo->car_nombre),'TB','C',$par);
        //                     break;
        //                 }
        //             }
        //             break;
        //         }
        //     }
        //     $cont++;


        // }

        // $pdf->Output('I','prueba.pdf');
        // exit;



    }

    public function PDFBoleta($id){
        // OBTENER DATOS

        $pdf = PDF::loadView('boleta.pdf');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
        // Carbon::setLocale('es');
        // $periodo = strtoupper(now()->monthName.' - '.now()->year);

        // $colaborador = Colaborador::where('idColaborador',$id)->first();
        // $cargo = Cargo::where('idCargo',$colaborador->idCargo)->first();
        // $sueldo = $cargo->car_sueldo;
        // $dias = Registro::where('idColaborador',$id)->whereMonth('reg_fecha',1)->count();

        // $horas = 0;

        // $registros = Registro::where('idColaborador',$id)->whereMonth('reg_fecha',1)->get();
        // foreach ($registros as $reg)
        // {
        //     $ini = new DateTime($reg->reg_horaEnt);
        //     $fin =  new DateTime($reg->reg_horaSal);
        //     $hora = $ini->diff($fin);
        //     $horas = $horas + $hora->h;

        // }


        // $ingresos =  Ingreso::where('idColaborador',$id)->whereMonth('ing_fecha',1)->get();
        // $totalI=$sueldo;
        // foreach ($ingresos as $ing)
        // {
        //     $totalI = $totalI + $ing->ing_monto;
        // }
        // $totalI = number_format($totalI, 2, '.', '');

        // $descSeg = Seguro::join('colaborador','colaborador.idSeguro','seguro.idSeguro')
        // ->select('seguro.seg_nombre','seg_tasa')->first();

        // $seguro = number_format($sueldo*$descSeg->seg_tasa, 2, '.', '');
        // $totalD = $seguro;

        // $descuentos = Descuento::where('idColaborador',$id)->whereMonth('desc_fecha',1)->get();
        // foreach ($descuentos as $desc)
        // {
        //     $totalD = $totalD + $desc->desc_monto;
        // }
        // $totalD = number_format($totalD, 2, '.', '');

        // $total = number_format($totalI - $totalD, 2, '.', '');


        // $tipoI = TipoIngreso::all();
        // $tipoD = TipoDescuento::all();

        // $bol = new Boleta();
        // $bol->idColaborador = $id;
        // $bol->bol_fecha = now();
        // $bol->bol_total = $total;
        // $bol->save();

        // // CREACION DEL PDF
        // $pdf = new PDFasistencias();
        // $pdf->AddPage('L','A4');
        // $pdf->AliasNbPages();
        // $pdf->SetFont('Arial','B',13);
        // $pdf->SetTextColor(16, 179, 51);
        // $pdf->Cell(60,5,utf8_decode('RESPONSABLE WORK E.I.R.L.'),0,1,'L',0);
        // $pdf->SetFont('Arial','B',10);
        // $pdf->SetTextColor(0, 0, 0);
        // $pdf->Cell(65,5,utf8_decode('R.U.C.   N° 20602163751'),0,1,'C',0);

        // $pdf->Ln();

        // $pdf->SetFont('Arial','B',16);
        // $pdf->Cell(165,6,utf8_decode('BOLETA DE PAGO'),0,0,'R',0);
        // $pdf->SetFont('Courier','',12);
        // $pdf->Cell(70,6,utf8_decode('D.S. N° 001-98TR'),0,1,'R',0);
        // $pdf->SetFont('Arial','B',14);
        // $pdf->Cell(0,5,utf8_decode($periodo),0,1,'C',0);

        // $pdf->Ln();

        // $pdf->SetFont('Arial','B',11);
        // $pdf->Cell(24);
        // $pdf->Cell(40,7,utf8_decode('DNI:'),'LT',0,'R',0);
        // $pdf->SetFont('Arial','',11);
        // $pdf->Cell(75,7,utf8_decode($colaborador->col_dni),'T',0,'L',0);
        // $pdf->SetFont('Arial','B',11);
        // $pdf->Cell(40,7,utf8_decode('Apellidos y Nombres:'),'T',0,'R',0);
        // $pdf->SetFont('Arial','',11);
        // $pdf->Cell(75,7,utf8_decode($colaborador->col_apellidos.' '.$colaborador->col_nombres),'TR',1,'L',0);

        // $pdf->SetFont('Arial','B',11);
        // $pdf->Cell(24);
        // $pdf->Cell(40,5,utf8_decode('F. Ingreso:'),'L',0,'R',0);
        // $pdf->SetFont('Arial','',11);
        // $pdf->Cell(75,5,utf8_decode(date('d-m-Y',strtotime($colaborador->col_registro))),0,0,'L',0);
        // $pdf->SetFont('Arial','B',11);
        // $pdf->Cell(40,5,utf8_decode('Cargo:'),0,0,'R',0);
        // $pdf->SetFont('Arial','',11);
        // $pdf->Cell(75,5,utf8_decode($cargo->car_nombre),'R',1,'L',0);

        // $pdf->SetFont('Arial','B',11);
        // $pdf->Cell(24);
        // $pdf->Cell(40,7,utf8_decode('Días Trabajados:'),'LB',0,'R',0);
        // $pdf->SetFont('Arial','',11);
        // $pdf->Cell(75,7,utf8_decode($dias),'B',0,'L',0);
        // $pdf->SetFont('Arial','B',11);
        // $pdf->Cell(40,7,utf8_decode('Horas Trabajadas:'),'B',0,'R',0);
        // $pdf->SetFont('Arial','',11);
        // $pdf->Cell(75,7,utf8_decode($horas.' hrs' ),'BR',1,'L',0);

        // $pdf->Ln(7);

        // $pdf->SetFont('Arial','B',10);
        // $pdf->SetFillColor(120, 114, 114);
        // $pdf->Cell(24);
        // $pdf->Cell(90,7,utf8_decode('INGRESOS'),1,0,'C',1);
        // $pdf->Cell(25,7,utf8_decode('IMPORTE'),1,0,'C',1);
        // $pdf->Cell(90,7,utf8_decode('DESCUENTOS Y RETENCIONES'),1,0,'C',1);
        // $pdf->Cell(25,7,utf8_decode('IMPORTE'),1,1,'C',1);


        // $pdf->SetFont('Arial','',10);
        // //dd($pdf->GetX().' '.$pdf->GetY());
        // $pdf->Cell(24);
        // $pdf->Cell(90,5,utf8_decode('SALARIO MENSUAL'),'LR',1,'C',0);


        // foreach($ingresos as $ingreso)
        // {
        //     foreach($tipoI as $ing)
        //     {
        //         if ($ingreso->idTipoIngreso == $ing->idTipoIngreso )
        //         {
        //             $pdf->Cell(24);
        //             $pdf->Cell(90,5,utf8_decode($ing->ing_nombre),'LR',0,'C',0);
        //         }
        //     }
        // }

        // $pdf->SetXY(124.00125,74.00125);
        // $pdf->Cell(25,5,utf8_decode($sueldo),'R',0,'C',0);


        // $pdf->SetXY($pdf->GetX()-25,$pdf->GetY()+5);
        // foreach ($ingresos as $ingreso)
        // {
        //     $pdf->Cell(25,5,utf8_decode($ingreso->ing_monto),'R',0,'C',0);
        //     $pdf->SetXY($pdf->GetX()-25,$pdf->GetY()+5);
        // }

        // $pdf->SetXY($pdf->GetX()+24,$pdf->GetY());

        // if ($ingresos->count()< $descuentos->count())
        // {
        //     $cont=1;

        //     while ($cont <= abs($ingresos->count() - $descuentos->count()))
        //     {
        //         $pdf->Cell(90,5,utf8_decode('----------'),'R',0,'C',0);
        //         $pdf->Cell(25,5,utf8_decode('00.00'),'R',1,'C',0);
        //         $pdf->SetXY($pdf->GetX()-115,$pdf->GetY()+5);
        //         $cont++;
        //     }
        // } else {

        // }




        // $pdf->SetXY(149.00125,74.00125);

        // $pdf->Cell(90,5,utf8_decode('SEGURO TRABAJADOR'),'R',0,'C',0);
        // $pdf->SetXY($pdf->GetX()-90,$pdf->GetY()+7);

        // foreach ($descuentos as $descuento)
        // {
        //     foreach ($tipoD as $desc)
        //     {
        //         if ($descuento->idTipoDesc == $desc->idTipoDesc)
        //         {
        //             $pdf->Cell(90,5,utf8_decode($desc->desc_nombre),'R',0,'C',0);
        //             $pdf->SetXY($pdf->GetX()-90,$pdf->GetY()+7);
        //         }
        //     }
        // }
        // $pdf->SetXY(239.00125,74.00125);

        // $pdf->Cell(25,5,utf8_decode($seguro),'R',0,'C',0);

        // foreach ($descuentos as $descuento)
        // {
        //     $pdf->Cell(25,5,utf8_decode($descuento->desc_monto),'R',1,'C',0);
        // }

        // $pdf->SetXY($pdf->GetX()-90,$pdf->GetY());

        // if ($ingresos->count() > $descuentos->count())
        // {
        //     $cont=1;

        //     while ($cont <= abs($ingresos->count() - $descuentos->count()))
        //     {
        //         $pdf->Cell(90,5,utf8_decode('----------'),'R',0,'C',0);
        //         $pdf->Cell(25,5,utf8_decode('0.00'),'R',1,'C',0);
        //         $pdf->SetXY($pdf->GetX()-115,$pdf->GetY()+5);
        //         $cont++;
        //     }
        // } else {
        //     $pdf->Cell(90,5,utf8_decode(''),'R',0,'C',0);
        //     $pdf->Cell(25,5,utf8_decode(''),0,1,'C',0);
        //     $pdf->SetXY($pdf->GetX()-115,$pdf->GetY()+5);
        // }



        // $pdf->SetFont('Arial','B',10);
        // $pdf->SetXY(10.00125,$pdf->GetY()-5);

        // $pdf->Cell(24);
        // $pdf->Cell(90,7,utf8_decode('TOTAL DE INGRESOS:'),'T',0,'R',0);
        // $pdf->Cell(25,7,utf8_decode($totalI),1,0,'C',0);
        // $pdf->Cell(90,7,utf8_decode('TOTAL DE DESCUENTOS:'),'T',0,'R',0);
        // $pdf->Cell(25,7,utf8_decode($totalD),1,1,'C',0);

        // $pdf->Cell(24);
        // $pdf->Cell(205,7,utf8_decode('TOTAL DE INGRESOS:'),0,0,'R',0);
        // $pdf->SetFillColor(0,0,0);
        // $pdf->SetTextColor(255,255,255);
        // $pdf->Cell(25,7,utf8_decode($total),'LBR',1,'C',1);

        // $pdf->Ln(2);


        // $pdf->Cell(24);
        // $pdf->SetFillColor(120, 114, 114);
        // $pdf->SetTextColor(0,0,0);
        // $pdf->Cell(28,5,utf8_decode('ESSALUD'),1,0,'C',1);

        // $pdf->Cell(28,5,utf8_decode('EPS'),1,0,'C',1);
        // $pdf->Cell(28,5,utf8_decode('SENATI'),1,0,'C',1);
        // $pdf->Cell(31,5,utf8_decode('SEG. VIDA LEY'),1,1,'C',1);

        // $pdf->SetFillColor(255,255,255);
        // $pdf->SetTextColor(0,0,0);
        // $pdf->SetDrawColor(0,0,0);
        // $pdf->Cell(24);
        // $pdf->Cell(28,5,utf8_decode('0.00'),1,0,'C',1);
        // $pdf->Cell(28,5,utf8_decode('0.00'),1,0,'C',1);
        // $pdf->Cell(28,5,utf8_decode('0.00'),1,0,'C',1);
        // $pdf->Cell(31,5,utf8_decode('0.00'),1,1,'C',1);


        // $pdf->Ln(35);
        // $pdf->Cell(52);
        // $pdf->Cell(56,5,utf8_decode('RESPONSABLE WORK E.I.R.L.'),'T',0,'C',1);
        // $pdf->Cell(58,5,utf8_decode(''),0,0,'C',1);
        // $pdf->Cell(56,5,utf8_decode('FIRMA DEL TRABAJADOR'),'T',0,'C',1);

        // $pdf->Output('I','BOLETA.pdf');
        // exit;


    }

    public function PDFhorast($ini,$fin){

        Carbon::setLocale('es');
        $fini = new Carbon($ini);
        $ffin = new Carbon($fin);


        // $colaboradores = Colaborador::where('col_estado',1)->get();
        // $cargos = Cargo::where('car_estado',1)->get();

        $pdf = new PDFasistencias();
        $pdf->AddPage('P','A4');
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial','B',30);
        $pdf->SetTextColor(16, 179, 51);
        $pdf->Cell(0,5,utf8_decode('RESPONSABLE WORK E.I.R.L.'),0,1,'C',0);

        $pdf->Ln(20);

        $pdf->SetFont('Arial','B',20);
        $pdf->SetTextColor(16, 26, 179);

        if($ini == $fin){

            $asistencias = Registro::where('reg_fecha',$ini)->get();
            $colaboradores = Colaborador::join('registro','registro.idColaborador','colaborador.idColaborador')->where('registro.reg_fecha','=',$ini)->select('colaborador.*')->distinct()->get();
            $pdf->Cell(0,5,utf8_decode('HORAS TRABAJADAS DEL DIA '.$fini->calendar()),0,1,'C',0);

        } else {

            $asistencias = Registro::where('reg_fecha','>=',$ini)->where('reg_fecha','<=',$fin)->get();
            $colaboradores = Colaborador::join('registro','registro.idColaborador','colaborador.idColaborador')->where('registro.reg_fecha','>=',$ini)->where('registro.reg_fecha','<=',$fin)
            ->select('colaborador.*')->distinct()->get();
            $pdf->Cell(0,8,utf8_decode('HORAS TRABAJADAS DEL DIA '.$fini->format('d/m/Y')),0,1,'C',0);
            $pdf->Cell(0,8,utf8_decode('HASTA EL '.$ffin->format('d/m/Y')),0,1,'C',0);
        }

        $cargos = collect();
            foreach ($colaboradores as $colaborador) {
                $cargos->push(Cargo::where('idCargo',$colaborador->idCargo)->first());
            }

            $horasT = [];

            foreach ($colaboradores as $col)
            {
                $horas = 0;
                $bandera =0;
                foreach ($asistencias as $asis)
                {
                    if ($col->idColaborador == $asis->idColaborador)
                    {

                        $ini = new DateTime($asis->reg_horaEnt);
                        $fin = new DateTime($asis->reg_horaSal);
                        $hora= $ini->diff($fin);
                        $horas = $horas + $hora->h;
                        $bandera = 1;
                    }

                }
                   if ($bandera ==1)
                   {
                    array_push($horasT,$horas);
                   }
            }

        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);

        $pdf->Cell(20,10,utf8_decode('Nro.'),1,0,'C',1);
        $pdf->Cell(75,10,utf8_decode('Colaborador'),1,0,'C',1);
        $pdf->Cell(45,10,utf8_decode('Cargo'),1,0,'C',1);
        $pdf->Cell(50,10,utf8_decode('Horas Trabajadas'),1,1,'C',1);

        $pdf->SetFont('Arial','',11);
        $pdf->SetFillColor(192, 193, 205);
        $pdf->SetTextColor(0,0,0);

        $cont = 1 ;
        $par =0;
        foreach ($colaboradores as $col) {


            if($cont % 2 ==0)
                $par=1;
            else
                $par=0;

            $pdf->Cell(20,7,$cont,'TB',0,'C',$par);
            $pdf->Cell(75,7,utf8_decode($col->col_nombres.' '.$col->col_apellidos),'TB',0,'C',$par);

            foreach ($cargos as $cargo) {
                if ($col->idCargo == $cargo->idCargo) {
                    $pdf->Cell(45,7,utf8_decode($cargo->car_nombre),'TB',0,'C',$par);
                    break;
                }
            }

            $pdf->MultiCell(50,7,$horasT[$cont-1].' hrs','TB','C',$par);
            $cont++;
        }

        $pdf->Output('I','prueba.pdf');
        exit;



    }

}
