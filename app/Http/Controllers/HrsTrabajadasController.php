<?php

namespace App\Http\Controllers;
use View;
use Datetime;
use DB;
use Carbon\Carbon;
use domPDF;
use App\Clases\PDF;

use Illuminate\Http\Request;
use App\Model\Horas_Trabajadas;
use App\Model\Colaborador;
use App\Model\Persona;
use App\Model\Cargo;


class HrsTrabajadasController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function registro(){
        $hrs = Horas_Trabajadas::join('colaborador','colaborador.idCol','horas_trabajadas.idCol')->join('persona','persona.idPersona','colaborador.idPersona')
        ->orderBy('Hrs_fecha')->orderBy('per_apellidos')->orderBy('Hra_inicio')->get();
        $colaboradores=Persona::join('colaborador','colaborador.idPersona','persona.idPersona')
        ->join('rol','rol.idRol','persona.idRol')->where('rol.rol_nombre','!=','CLIENTE')->get();
        return View::make('hrsTrabajadas.registro')->with(['hrs'=>$hrs,'colaboradores'=>$colaboradores]);

    }

    public function guardar(Request $request){
        try {
            $hrs = new Horas_Trabajadas;
            $hrs->idCol = $request->dni;
            $hrs->Hrs_fecha = $request->fecha;
            $hrs->Hra_inicio = $request->inicio;
            $hrs->Hra_fin = $request->fin;
    
            $inicio= new Datetime($request->inicio);
            $fin= new Datetime($request->fin);

            $hrsDiff=0;

            if($fin->format('H') <= $inicio->format('H')){
                // dd('fin menor',$fin->format('H'),$inicio->format('H'));
                if(($fin->format('H') < $inicio->format('H') || ($fin->format('H') == $inicio->format('H') && $fin->format('i')<$inicio->format('i')))){
                    $hrsDiff=intval($fin->format('H'))+1;
                    $fin->setTime(23,$fin->format('i'));
                }
            }
            $diferencia=$inicio->diff($fin);
            $horas=$diferencia->h+$hrsDiff;
            $min=$diferencia->i;
            $cant=doubleval($horas+($min/60));

            // dd($request->fin,$request->inicio,$fin,$inicio,$hrsDiff,$diferencia,$horas,$min,$cant);
           
            $hrs->Hrs_cantidad = $cant;
            $hrs->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function editar($id){
        $hrs = Horas_Trabajadas::findOrFail($id);
        return View::make('hrsTrabajadas.edit')->with(['hrs'=>$hrs]);
    }

    public function actualizar(Request $request,$id){
        try {
            $hrs = Horas_Trabajadas::findOrFail($id);
            $hrs->idCol = $request->dni;
            $hrs->Hrs_fecha = $request->fecha;
            $hrs->Hra_inicio = $request->inicio;
            $hrs->Hra_fin = $request->fin;
    
                $inicio= new Datetime($request->inicio);
                $fin= new Datetime($request->fin);
    
                $hrsDiff=0;
    
                if(($fin->format('H') < $inicio->format('H') || ($fin->format('H') == $inicio->format('H') && $fin->format('i')<$inicio->format('i')))){
                    // dd('fin menor',$fin->format('H'),$inicio->format('H'));
                    $hrsDiff=intval($fin->format('H'))+1;
                    $fin->setTime(23,$fin->format('i'));
                }
                $diferencia=$inicio->diff($fin);
                $horas=$diferencia->h+$hrsDiff;
                $min=$diferencia->i;
                $cant=doubleval($horas+($min/60));
    
                // dd($request->fin,$request->inicio,$fin,$inicio,$hrsDiff,$diferencia,$horas,$min,$cant);
           
            $hrs->Hrs_cantidad = $cant;
            $hrs->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            dd($th);
            return json_encode('error');
        }
    }

    public function eliminar($id){
        try {
            $hrs = Horas_Trabajadas::findOrFail($id);
            if($hrs->hrs_estado=='activo'){
                $hrs->hrs_estado='inactivo';
            }
            else{
                $hrs->hrs_estado='activo';
            }
            
            $hrs->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
        
    }
    public function reporteAsistencias(){
        $hoy = new Datetime();
        return View::make('asistencias.reporte')->with(['hoy'=>$hoy->format('Y-m-d')]);
    }
    public function generarReporteAsistencias($inicio,$fin){

        $asistencias = Horas_Trabajadas::where('Hrs_fecha','>=',$inicio)->where('Hrs_fecha','<=',$fin)
            ->where('hrs_estado','activo')->orderBy('Hrs_fecha')
            ->select('Hrs_fecha','idCol')->distinct('Hrs_fecha','idCol')->get();
        $row = [];
        $x=0;

        foreach ($asistencias as $asist) {
            $fecha = new DateTime($asist->Hrs_fecha);
            $row[$x]['fecha'] = $fecha->format('d/m/Y');

            $col = Colaborador::join('persona','persona.idPersona','colaborador.idPersona')->where('idCol',$asist->idCol)->first();
            $row[$x]['colaborador'] =  $col->per_apellidos.' '.$col->per_nombres;

            $cargo = Cargo::findOrFail($col->idCargo);

            $row[$x]["cargo"]=$cargo->Car_nombre;

            $x++;
        }
        return(json_encode($row));
    }
    public function PDFasistenciasTabla($inicio,$fin){
        $info= Horas_Trabajadas::join('colaborador','colaborador.idCol','horas_trabajadas.idCol')
        ->join('persona','persona.idPersona','colaborador.idPersona')->join('cargo','cargo.idCargo','colaborador.idCargo')
        ->where('Hrs_fecha','>=',$inicio)->where('Hrs_fecha','<=',$fin)
        ->where('hrs_estado','activo')->orderBy('Hrs_fecha','asc')->orderBy('persona.per_apellidos','asc')->select('persona.per_nombres','persona.per_apellidos','cargo.Car_nombre','hrs_fecha')
        ->distinct('persona.per_nombres','persona.per_apellidos','cargo.Car_nombre','hrs_fecha')->get();

        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");
        $fini = new Carbon($inicio);
        $ffin = new Carbon($fin);
        $cabF=['Desde: ','Hasta: ','Fecha: '];
        $ini=$fini->isoFormat('DD-MM-YYYY');
        $fin=$ffin->isoFormat('DD-MM-YYYY');

        $nombreDoc='reporte_asistencias';
        
        $titulo="REPORTE DE ASISTENCIAS ";
        $colums=['FECHA', 'COLABORADOR','CARGO'];
        $contenido= [];

       foreach ($info as $dato) {
            $fecha= new Carbon($dato->hrs_fecha);

            $fila = [];

            $fila[]=$fecha->isoFormat('DD-MM-YYYY');
            $fila[]=$dato->per_apellidos.' '.$dato->per_nombres;
            $fila[]=$dato->Car_nombre;

            $contenido[]=$fila;
       }
      
    
        $pdf = \domPDF::loadView('PDF_tabla',compact('cabF','ini','fin','generado','nombreDoc','titulo','colums','contenido'));
        return $pdf->stream('reporte_asistencias.pdf');

    }
    public function PDFasistenciasGrafico($ini,$fin){

        $info = DB::select("select p.per_nombres,p.per_apellidos, COUNT(distinct(ht.Hrs_fecha)) as cantidad FROM horas_trabajadas ht 
        inner join colaborador c on c.idCol=ht.idCol inner join persona p on p.idPersona=c.idPersona
        WHERE ht.Hrs_fecha>='$ini' AND ht.Hrs_fecha<='$fin' GROUP BY p.per_nombres,p.per_apellidos ORDER BY p.per_apellidos");
      

        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");
        $fini = new Carbon($ini);
        $ffin = new Carbon($fin);
        $ini=$fini->isoFormat('DD-MM-YYYY');
        $fin=$ffin->isoFormat('DD-MM-YYYY');
        $cabF=['Desde: ','Hasta: ','Fecha: '];
        
        $nombreDoc='grafico_asistencias';
        
        $titulo="REPORTE GRÁFICO DE ASISTENCIAS ";
        
        $nombres=array();
        $cant=sizeof($info);

        for ($i=0; $i<$cant ; $i++) { 
            $nombres[$i]="Col. ".($i+1).": ".strval($info[$i]->per_apellidos.' '.$info[$i]->per_nombres);
        }

        $posiciones="'Col. 1'";
        for ($i=2; $i<=$cant ; $i++) { 
            $posiciones=$posiciones.",'Col. ".$i."'";
        }

        $datos=strval($info[0]->cantidad);
        for ($i=1; $i<$cant ; $i++) { 
            $datos=$datos.','.strval($info[$i]->cantidad);
        }

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
                    text: 'Nro de Asistencias'
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
                text: 'Asistencias',
                padding: {
                    bottom: 30
                }
            }
            
        }";
        // dd($nombres);
        $pdf = \domPDF::loadView('basePDF',compact('generado','nombreDoc','titulo','cabF','ini','fin','nombres','data','options'));
        return $pdf->stream('ejemplo.pdf');
    }
    
    public function reporteHrsTrabajadas(){
        $hoy = new Datetime();
        return View::make('hrsTrabajadas.reporte')->with(['hoy'=>$hoy->format('Y-m-d')]);
    }
    public function generarReporteHrsTrabajadas($inicio,$fin){
        

        $datos = DB::select("select distinct persona.per_nombres, persona.per_apellidos,Car_nombre, SUM(Hrs_cantidad) as horas from horas_trabajadas 
        inner join colaborador on colaborador.idCol = horas_trabajadas.idCol inner join persona on persona.idPersona = colaborador.idPersona inner join cargo on cargo.idCargo =colaborador.idCargo 
        WHERE horas_trabajadas.Hrs_fecha>='$inicio' AND horas_trabajadas.Hrs_fecha<='$fin' GROUP BY horas_trabajadas.idCol,persona.per_nombres, persona.per_apellidos,Car_nombre");
    
        return(json_encode($datos));
    }
    public function PDFhrsTrabajadasTabla($inicio,$fin){

        $info = DB::select("select distinct persona.per_nombres, persona.per_apellidos,Car_nombre, SUM(Hrs_cantidad) as horas from horas_trabajadas 
        inner join colaborador on colaborador.idCol = horas_trabajadas.idCol inner join persona on persona.idPersona = colaborador.idPersona inner join cargo on cargo.idCargo =colaborador.idCargo 
        WHERE horas_trabajadas.Hrs_fecha>='$inicio' AND horas_trabajadas.Hrs_fecha<='$fin' GROUP BY horas_trabajadas.idCol,persona.per_nombres, persona.per_apellidos,Car_nombre");

        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");
        $fini = new Carbon($inicio);
        $ffin = new Carbon($fin);
        $ini=$fini->isoFormat('DD-MM-YYYY');
        $fin=$ffin->isoFormat('DD-MM-YYYY');
        $cabF=['Desde: ','Hasta: ','Fecha: '];

        $nombreDoc='reporte_hrsTrabajadas';
        
        $titulo="REPORTE DE HORAS TRABAJADAS ";
        $colums=['COLABORADOR', 'CARGO','HORAS'];
        $contenido= [];

       foreach ($info as $dato) {

            $fila = [];

            $fila[]=$dato->per_apellidos.' '.$dato->per_nombres;
            $fila[]=$dato->Car_nombre;
            $fila[]=$dato->horas;

            $contenido[]=$fila;
       }
    
        $pdf = \domPDF::loadView('PDF_tabla',compact('cabF','ini','fin','generado','nombreDoc','titulo','colums','contenido'));
        return $pdf->stream('reporte_hrsTrabajadas.pdf');
    }
    public function PDFhrsTrabajadasGrafico($ini,$fin){

        $info = DB::select("select distinct persona.per_nombres, persona.per_apellidos,Car_nombre, SUM(Hrs_cantidad) as horas from horas_trabajadas 
        inner join colaborador on colaborador.idCol = horas_trabajadas.idCol inner join persona on persona.idPersona = colaborador.idPersona inner join cargo on cargo.idCargo =colaborador.idCargo 
        WHERE horas_trabajadas.Hrs_fecha>='$ini' AND horas_trabajadas.Hrs_fecha<='$fin' GROUP BY horas_trabajadas.idCol,persona.per_nombres, persona.per_apellidos,Car_nombre ORDER BY persona.per_apellidos");
      

        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");
        $fini = new Carbon($ini);
        $ffin = new Carbon($fin);
        $ini=$fini->isoFormat('DD-MM-YYYY');
        $fin=$ffin->isoFormat('DD-MM-YYYY');
        $cabF=['Desde: ','Hasta: ','Fecha: '];

        $nombreDoc='grafico_asistencias';
        
        $titulo="REPORTE GRÁFICO DE HORAS TRABAJADAS ";
        
        $nombres=array();
        $cant=sizeof($info);

        for ($i=0; $i<$cant ; $i++) { 
            $nombres[$i]="Col. ".($i+1).": ".strval($info[$i]->per_apellidos.' '.$info[$i]->per_nombres);
        }

        $posiciones="'Col. 1'";
        for ($i=2; $i<=$cant ; $i++) { 
            $posiciones=$posiciones.",'Col. ".$i."'";
        }

        $datos="'".number_format(($info[0]->horas),2)."'";
        for ($i=1; $i<$cant ; $i++) { 
            $datos=$datos.", '".number_format(($info[$i]->horas),2)."'";
        }
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
