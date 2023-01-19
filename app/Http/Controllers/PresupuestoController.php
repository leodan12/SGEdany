<?php

namespace App\Http\Controllers;
use View;
use Datetime;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Model\Servicio;
use App\Model\Presupuesto;
use App\Model\DetPresupuesto;
use App\Model\Cliente;
use App\Model\Persona;
use App\Model\Empresa;
use App\Model\Responsable;


class PresupuestoController extends Controller
{
    public function registro(){
        $presupuestos = Presupuesto::leftjoin('cliente','cliente.idCliente','presupuesto.idCliente')
        ->leftjoin('persona','persona.per_dni','cliente.clie_identificador')->leftjoin('empresa','empresa.RUC','cliente.clie_identificador')
        ->orderBy('presupuesto.idPresupuesto')->get();
        // dd($presupuestos);
        
        
        $tipo=[];
        $x=0;

        foreach ($presupuestos as $presupuesto) {
            if (strlen($presupuesto->clie_identificador)>8){
                $tipo[$x]='empresa';
            }
            else{
                $tipo[$x]='cliente';
            }
            
            $x++;
        }

         return View::make('presupuesto.inicio')->with(['presupuestos'=>$presupuestos,'tipo'=>$tipo]);
        
    }
    public function nuevo(){
      
        $personas = Persona::join('rol','rol.idRol','persona.idRol')->select('persona.*')->where('rol.rol_nombre','Cliente')
        ->where('persona.per_estado','activo')->get();
        $servicios = Servicio::where('serv_estado','activo')->get();
        $empresas = Empresa::join('cliente','cliente.clie_identificador','empresa.RUC')->where('empresa.emp_estado','activo')->get();
        $responsables = Responsable::all();
      
        return View::make('presupuesto.registro')->with(['personas'=>$personas,'servicios'=>$servicios, 'empresas'=>$empresas, 'responsables'=>$responsables]);
    }
    
    public function guardar(Request $request){

       try {
            $hoy = new Datetime;

            $datos = json_decode($request->datos);
        
            $idCliente = $datos->{'idCliente'};
            $idResponsable = $datos->{'idResponsable'};
            $lugar = $datos->{'lugar'};
            $concepto = $datos->{'concepto'};
            $tipo = $datos->{'tipo'};
            $subtotal =$datos->{'subtotal'};
            $admGastos =$datos->{'admGastos'};
            $fechaStr =$datos->{'fecha'};

            $fecha = new Carbon($fechaStr);

            $registrados = Presupuesto::whereYear('fechaRealizacion',$fecha)->count();

            $actual = $registrados+1;
            $codPresupuesto = str_repeat("0",3-strlen(strval($actual))).$actual.'-'.$fecha->format('Y').'-RW';
            
            $presupuesto = new Presupuesto;
            $presupuesto->codPresupuesto = $codPresupuesto;
            $presupuesto->idCliente = $idCliente;
            $presupuesto->idResponsable = $idResponsable;
            $presupuesto->lugar = mb_strtoupper($lugar,'UTF-8');
            $presupuesto->concepto = mb_strtoupper($concepto,'UTF-8');
            $presupuesto->subTotal = floatval($subtotal);
            $presupuesto->gastosAdm = floatval($admGastos);
            $presupuesto->costoTotal = floatval(floatval($subtotal)+floatval($admGastos));
            $presupuesto->fechaRealizacion = $fecha->format('Y-m-d');
            $presupuesto->fechaRegistro=$hoy->format('Y-m-d');
            $presupuesto->save();

            $ultPresupuesto = Presupuesto::orderBy('idPresupuesto','desc')->first();

            $tamDet=sizeof($datos->{'detalle'});
            $detalle = $datos->{'detalle'};

            

            for ($i=0; $i <$tamDet ; $i+=5) { 

                    $detPresupuesto = new DetPresupuesto;
                    $detPresupuesto->idPresupuesto=$ultPresupuesto->idPresupuesto;
                    $servicio = Servicio::where('codServicio',$detalle[$i])->first();
                    $detPresupuesto->idServicio=$servicio->idServicio;
                    $detPresupuesto->cantidad=$detalle[$i+3];
                    $detPresupuesto->costUnid=substr($detalle[$i+2],2);
                    $detPresupuesto->save();
                
                }
                return json_encode('success');
       } catch (\Throwable $th) {
        dd($th);
        return json_encode('error');
       }
    }
    
    public function visualizar($id){

        $presupuesto=Presupuesto::join('cliente','cliente.idCliente','presupuesto.idCliente')
        ->join('responsable','responsable.idResponsable','presupuesto.idResponsable')
        ->leftjoin('empresa','empresa.RUC','cliente.clie_identificador')
        ->findOrFail($id);

        $detalle = DetPresupuesto::join('servicio','servicio.idServicio','det_presupuesto.idServicio')->where('idPresupuesto',$id)->get();

        $subtotal=[];
        $total=0.00;
        $x=0;

        foreach ($detalle as $det) {
            $subtotal[$x]=number_format($det->costUnid*$det->cantidad,2);
            $total+=doubleval($subtotal[$x]);
            $x++;
        }  
        return View::make('presupuesto.visualizar')->with(['presupuesto'=>$presupuesto,'detalle'=>$detalle,'subtotal'=>$subtotal,'total'=>number_format($total,2)]);
    }

    public function eliminar($id){
        $presupuesto = Presupuesto::findOrFail($id);
        $presupuesto->pres_estado='inactivo';
        $presupuesto->save();

        return json_encode('success');
    }

    public function pdf($id){

        $presupuesto=Presupuesto::join('cliente','cliente.idCliente','presupuesto.idCliente')
        ->join('responsable','responsable.idResponsable','presupuesto.idResponsable')
        ->leftjoin('empresa','empresa.RUC','cliente.clie_identificador')
        ->findOrFail($id);

        $detalle = DetPresupuesto::join('servicio','servicio.idServicio','det_presupuesto.idServicio')->where('idPresupuesto',$id)->get();

        $sub=[];
        $total=0.00;
        $x=0;

        foreach ($detalle as $det) {
            $sub[$x]=number_format($det->costUnid*$det->cantidad,2);
            $x++;
        }  

        

        if (strlen($presupuesto->clie_identificador)>8){
            $cliente=$presupuesto->RazonSocial;
            $identificador=$presupuesto->RUC;
            $tipo='empresa';

            $responsable = $presupuesto->res_apellidos.' '.$presupuesto->res_nombres;
            $cargo = $presupuesto->res_cargo;
            $cel = $presupuesto->res_contacto;
            $correo = $presupuesto->res_correo;
            $lugar = $presupuesto->lugar;
            $fechaStr = $presupuesto->fechaRealizacion;
            $f = new Carbon($fechaStr);
            $fecha= $f->format('d/m/Y');
            $servicio = $presupuesto->concepto;
            $subTotal = $presupuesto->subTotal;
            $gastosAdm = $presupuesto->gastosAdm;
            $total+=doubleval($subTotal+$gastosAdm);
        }
        else{
            $cliente=$presupuesto->per_apellidos.' '.$presupuesto->per_nombres;
            $identificador=$presupuesto->per_dni;
            $tipo='cliente';
            $responsable = $presupuesto->res_apellidos.' '.$presupuesto->res_nombres;
            $cargo = $presupuesto->res_cargo;
            $cel = $presupuesto->res_contacto;
            $correo = $presupuesto->res_correo;
            $lugar = $presupuesto->lugar;
            $fechaStr = $presupuesto->fechaRealizacion;
            $f = new Carbon($fechaStr);
            $fecha= $f->format('d/m/Y');
            $servicio = $presupuesto->concepto;
            $subTotal = $presupuesto->subTotal;
            $gastosAdm = $presupuesto->gastosAdm;
            $total+=doubleval($subTotal+$gastosAdm);
        }

        $total = number_format($total,2);

        $nombreDoc='presupuesto';
        
        $titulo="PRESUPUESTO N° ".$presupuesto->codPresupuesto;

        $pdf = \domPDF::loadView('presupuesto.PDF',compact('nombreDoc','titulo', 'tipo','lugar','servicio','fecha', 'cliente','responsable','cargo','correo','cel','identificador', 'detalle','sub','subTotal','gastosAdm','total'));
        return $pdf->stream('presupuesto.pdf');
    }

    public function reportePresupuestos(){
        $hoy = new Datetime();
        return View::make('presupuesto.reporte')->with(['hoy'=>$hoy->format('Y-m-d')]);
    }
    public function generarReportePresupuestos($inicio,$fin){

        $datos = Presupuesto::leftjoin('cliente','cliente.idCliente','presupuesto.idCliente')
        ->leftjoin('persona','persona.per_dni','cliente.clie_identificador')->leftjoin('empresa','empresa.RUC','cliente.clie_identificador')
        ->where('pres_estado','activo')->where('fechaRegistro','>=',$inicio)->where('fechaRegistro','<=',$fin)->orderBy('presupuesto.idPresupuesto')->get();

        $row = [];
        $x=0;

        foreach ($datos as $dato) {
            
            $row[$x]['cod'] = $dato->codPresupuesto;

            if(is_null($dato->per_dni)){
                $row[$x]['cliente'] = $dato->NombreComercial;
                $row[$x]['identificador'] = $dato->RUC;
            }
            else{
                $row[$x]['cliente'] = $dato->per_apellidos.' '.$dato->per_nombres;
                $row[$x]['identificador'] = $dato->per_dni;
            }

            $row[$x]["total"]=$dato->costoTotal;

            $fecha = new DateTime($dato->fechaRegistro);
            $row[$x]['fecha'] = $fecha->format('d/m/Y');

            $x++;
        }
        return(json_encode($row));
    }

    public function PDFpresupuestosTabla($inicio,$fin){

        $info = Presupuesto::leftjoin('cliente','cliente.idCliente','presupuesto.idCliente')
        ->leftjoin('persona','persona.per_dni','cliente.clie_identificador')->leftjoin('empresa','empresa.RUC','cliente.clie_identificador')
        ->where('pres_estado','activo')->where('fechaRegistro','>=',$inicio)->where('fechaRegistro','<=',$fin)->orderBy('presupuesto.idPresupuesto')->get();

        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");
        $fini = new Carbon($inicio);
        $ffin = new Carbon($fin);
        $ini=$fini->isoFormat('DD-MM-YYYY');
        $fin=$ffin->isoFormat('DD-MM-YYYY');
        $cabF=['Desde: ','Hasta: ','Fecha: '];

        $nombreDoc='reporte_presupuesto';
        
        $titulo="REPORTE DE PRESUPUESTOS GENERADOS ";
        $colums=['NRO. PRESUPUESTO', 'ID CLIENTE','NOMBRE CLIENTE','TOTAL','REGISTRADO EL'];
        $contenido= [];

       foreach ($info as $dato) {

            $fila = [];

            $fila[]=$dato->codPresupuesto;

            if(is_null($dato->per_dni)){
                $fila[]= $dato->RUC;
                $fila[] = $dato->NombreComercial;
                
            }
            else{
                $fila[] = $dato->per_dni;
                $fila[] = $dato->per_apellidos.' '.$dato->per_nombres;
                
            }

            $fila[]=$dato->costoTotal;

            $fecha = new DateTime($dato->fechaRegistro);
            $fila[]= $fecha->format('d/m/Y');

            $contenido[]=$fila;
       }
    
        $pdf = \domPDF::loadView('PDF_tabla',compact('cabF','ini','fin','generado','nombreDoc','titulo','colums','contenido'));
        return $pdf->stream('reporte_presupuestos.pdf');
    }

    public function PDFpresupuestosGrafico($ini,$fin){

        $info = Presupuesto::leftjoin('cliente','cliente.idCliente','presupuesto.idCliente')
        ->leftjoin('persona','persona.per_dni','cliente.clie_identificador')->leftjoin('empresa','empresa.RUC','cliente.clie_identificador')
        ->where('pres_estado','activo')->where('fechaRegistro','>=',$ini)->where('fechaRegistro','<=',$fin)->orderBy('presupuesto.idPresupuesto')->get();


        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");
        $fini = new Carbon($ini);
        $ffin = new Carbon($fin);
        $ini=$fini->isoFormat('DD-MM-YYYY');
        $fin=$ffin->isoFormat('DD-MM-YYYY');
        $cabF=['Desde: ','Hasta: ','Fecha: '];

        $nombreDoc='grafico_presupuestos';
        
        
        $nombres=array();
        $titulo="REPORTE GRÁFICO DE PRESUPUESTOS";
        $cant=sizeof($info);

        for ($i=0; $i<$cant ; $i++) { 
            $nombres[$i]="Pres. ".($i+1).": ".strval($info[$i]->codPresupuesto);
        }

        $posiciones="'Pres. 1'";
        for ($i=2; $i<=$cant ; $i++) { 
            $posiciones=$posiciones.",'Pres. ".$i."'";
        }

        $datos="'".number_format(($info[0]->costoTotal),2)."'";
        for ($i=1; $i<$cant ; $i++) { 
            $datos=$datos.", '".number_format(($info[$i]->costoTotal),2)."'";
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
                    text: 'Costo(S/)'
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
                text: 'Presupuestos Generados',
                padding: {
                    bottom: 30
                }
            }
            
        }";
        


        // dd($nombres);
        $pdf = \domPDF::loadView('basePDF',compact('generado','nombreDoc','titulo','cabF','ini','fin','nombres','data','options'));
        return $pdf->stream('grafico_presupuesto'.$ini.'_'.$fin.'pdf');
    }

    public function guardarImgInforme(Request $request){

        $presupuesto = Presupuesto::findOrFail($request->id);

        $ruta = "img/informesPresupuestos/";

        for ($i=0; $i < $request->cantidad; $i++) { 
            $nroImg="img".$i;

            if($request->hasFile($nroImg)){

                $file = $request->file($nroImg);
                $nombre = $presupuesto->codPresupuesto.'-'.$i.'.'.$file->getClientOriginalExtension();;
                
                $file->move($ruta,$nombre);
            }
        }
        
        $presupuesto->pres_estado='informado';
        $presupuesto->save();        
        
    }

    public function generarInforme($id){

        $presupuesto = Presupuesto::findOrFail($request->id);

        $height = 4000;
        $width = 2250;
        $imagenes=[];

        for ($i=0; $i < $request->cantidad ; $i++) { 
            $nroImg="img".$i;

            if($request->hasFile($nroImg)){

                // $tam = getimagesize($request->$nroImg);

                // $ancho = $tam[0];
                // $alto = $tam[1];

                // $image = imagecreatefromjpeg($request->$nroImg);
                
                // if ($ancho > $alto) {
                //     $image = imagescale( $image, $height, $width );
                // }
                // else{
                //     $image = imagescale( $image, $width, $height );
                // }

                $file = $request->file($nroImg);
                $imagenes[$i]=$file;

            }
            else{
                dd("NO");
            }
        }

        $nombreDoc='presupuesto';
        
        $titulo="PRESUPUESTO N° ".$presupuesto->codPresupuesto;

        $pdf = \domPDF::loadView('presupuesto.PDF',compact('nombreDoc','titulo', 'imagenes'));
        return $pdf->stream('presupuesto.pdf');
        
        
        // $imagenes = $datos->{'imagenes'};
        // dd(getimagesize($imagenes[0]));
        
    }
}
