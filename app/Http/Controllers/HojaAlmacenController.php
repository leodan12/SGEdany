<?php

namespace App\Http\Controllers;
use View;
use Auth;
use Datetime;

use Illuminate\Http\Request;
use App\Model\Cargo;
use App\Model\Area;
use App\Model\Documento;
use App\Model\Producto;
use App\Model\Kardex;
use App\Model\Persona;
use App\Model\Colaborador;
use App\Model\Hoja_Mov;
use App\Model\Hoja_Entrada;
use App\Model\Hoja_Salida;
use App\Model\Movimiento;

class HojaAlmacenController extends Controller
{
    public function registro(){
        $hojas = Hoja_Mov::where('HM_estado','activo')->get();

        $NroHoja=[];
        $tipo=[];
        $x=0;

        foreach ($hojas as $hoja) {
            if(is_null(Hoja_Entrada::where('idHojMov',$hoja->idHojMov)->first())){
                $tipo[$x]='S';
            } else{
                $tipo[$x]='E';
            }
            if($hoja->idHojMov<10){
                $NroHoja[$x]='H/'.$tipo[$x].'  N° 000'.$hoja->idHojMov;
            }else {
                if($hoja->idHojMov<100){
                    $NroHoja[$x]='H/'.$tipo[$x].'  N° 00'.$hoja->idHojMov;
                } else {
                    if($hoja->idHojMov<1000){
                        $NroHoja[$x]='H/'.$tipo[$x].'  N° 0'.$hoja->idHojMov;
                    } else{
                        $NroHoja[$x]='H/'.$tipo[$x].'  N° '.$hoja->idHojMov;
                    }
                }
                
            }  
            $x++;   
        }

        return View::make('hojaAlmacen.inicio')->with(['hojas'=>$hojas, 'tipo'=>$tipo,'Nrohoja'=>$NroHoja]);
        
    }
    public function nuevo(){
      
        $cargos = Cargo::join('area','area.idArea','cargo.idArea')->where('Car_estado',1)->get();
        $areas = Area::where('Are_estado',1)->get();
        $documentos = Documento::where('Dcmto_estado','activo')->get();
        $productos = Producto::where('Prod_estado',3)->orderBy('codProducto')->get();
       
        return View::make('hojaAlmacen.registro')->with(['cargos'=>$cargos, 'areas'=>$areas,'documentos'=>$documentos,'productos'=>$productos]);
    }
    
    public function guardar(Request $request){

       try {
            $datos = json_decode($request->datos);
        
            $dni = $datos->{'dni'};
            $total =$datos->{'total'};
    
            $col = Colaborador::join('persona','persona.idPersona','colaborador.idPersona')
            ->where('per_dni',$dni)->first();
            
            $hoy = new Datetime;
            $hojaMov = new Hoja_Mov;
            $hojaMov->idCol = $col->idCol;
            $hojaMov->HM_registro = $hoy->format('Y-m-d');
            $hojaMov->HM_total = $total;
            $hojaMov->save();
    
            $hoja = Hoja_Mov::orderBy('idHojMov','desc')->first();
    
            $tamDet=sizeof($datos->{'detalle'});
            $detalle = $datos->{'detalle'};
    
        
    
            $tipo = $datos->{'tipo'};
            if ($tipo == 'entrada'){
                $idDoc=$datos->{'idDoc'};
    
                $hojaEntrada = new Hoja_Entrada;
                $hojaEntrada->idHojMov = $hoja->idHojMov;
                $hojaEntrada->idDocumento = $idDoc;
                $hojaEntrada->save();
                $doc = Documento::findOrFail($idDoc);
                $doc->Dcmto_estado='ingresado';
                $doc->save();
    
            } else {
                $descripcion = $datos->{'descripcion'};
    
                $HojaSalida = new Hoja_Salida;
                $HojaSalida->idHojMov = $hoja->idHojMov;
                $HojaSalida->Sal_descripcion = mb_strtoupper($descripcion, 'UTF-8');
                $HojaSalida->save();
    
            }
            
    
            for ($i=0; $i <$tamDet ; $i+=5) { 
    
                if($tipo=='entrada'){
                    $cantidad = intval($detalle[$i+3]);
                }else{
                    $cantidad = intval($detalle[$i+3])*-1;
                }
    
                $prod = Producto::where('codProducto',$detalle[$i])->first();
                $kardex = Kardex::where('idProducto',$prod->idProducto)->first();
                $idKardex= $kardex->idKardex;
                $kardex->Cant_actual=$kardex->Cant_actual+$cantidad;
                $kardex->save();
    
                $mov = new Movimiento;
                $mov->idKardex=$idKardex;
                $mov->idHojMov=$hoja->idHojMov;
                $mov->Mov_cantidad=$detalle[$i+3];
                $mov->Mov_costo=substr($detalle[$i+2],2);
                $mov->save();
            
            }
            return json_encode('success');
       } catch (\Throwable $th) {
           dd($th);
            return json_encode('error');
       }
    }
    
    public function visualizar($id){

        if (is_null(Hoja_Entrada::where('idHojMov',$id)->first())){
            $hoja = Hoja_Mov::join('hoja_salida','hoja_salida.idHojMov','hoja_mov.idHojMov')
            ->where('hoja_mov.idHojMov',$id)->first();
            $tipo='S';
        } else{
            $hoja = Hoja_Mov::join('hoja_entrada','hoja_entrada.idHojMov','hoja_mov.idHojMov')
            ->join('documento','documento.idDocumento','hoja_entrada.idDocumento')
            ->join('empresa','empresa.idEmpresa','documento.idEmpresa')->where('hoja_mov.idHojMov',$id)->first();
            $tipo='E';
        }

        $detalle = Movimiento::join('kardex','kardex.idKardex','movimiento.idKardex')->join('producto','producto.idProducto','kardex.idProducto')
        ->select('producto.codProducto','producto.Prod_nombre','movimiento.Mov_costo','movimiento.Mov_cantidad')->where('idHojMov',$id)->get();

        $subtotal=[];
        $total=0.00;
        $x=0;

        foreach ($detalle as $det) {
            $subtotal[$x]=number_format($det->Mov_costo*$det->Mov_cantidad,2);
            $total+=$subtotal[$x];
            $x++;
        }

        $colaborador = Colaborador::join('persona','persona.idPersona','colaborador.idPersona')->where('idCol',$hoja->idCol)->first();
        

        if($hoja->idHojMov<10){
            $NroHoja='H/'.$tipo.'  N° 000'.$hoja->idHojMov;
        }else {
            if($hoja->idHojMov<100){
                $NroHoja='H/'.$tipo.'  N° 00'.$hoja->idHojMov;
            } else {
                if($hoja->idHojMov<1000){
                    $NroHoja='H/'.$tipo.'  N° 0'.$hoja->idHojMov;
                } else{
                    $NroHoja='H/'.$tipo.'  N° '.$hoja->idHojMov;
                }
            }
            
        }  
        $x++;   
        return View::make('hojaAlmacen.visualizar')->with(['colaborador'=>$colaborador,'NroHoja'=>$NroHoja,'hoja'=>$hoja, 'tipo'=>$tipo, 'detalle'=>$detalle,'subtotal'=>$subtotal,'total'=>number_format($total,2)]);
    }

    public function eliminar($id){
        try {
            $hoja = Hoja_Mov::findOrFail($id);
            $flag=false;

            if(is_null(Hoja_Salida::where('idHojMov',$hoja->idHojMov)->first())){
                $flag=true;
                $entrada = Hoja_Entrada::where('idHojMov',$hoja->idHojMov)->first();
                $doc = Documento::findOrFail($entrada->idDocumento);
                $doc->Dcmto_estado='activo';
                $doc->save();
            }   

            $movimientos = Movimiento::where('idHojMov',$hoja->idHojMov)->get();

            foreach ($movimientos as $mov) {
                $kardex=Kardex::join('producto','producto.idProducto','kardex.idProducto')->where('kardex.idKardex',$mov->idKardex)->first();
                if($flag){
                    $kardex->Cant_actual-=$mov->Mov_cantidad;
                }
                else{
                    $kardex->Cant_actual+=$mov->Mov_cantidad;
                }
                $kardex->save();
            }
            
            $hoja->HM_estado='inactivo';
            $hoja->save();
            
            return json_encode('success');
        } catch (\Throwable $th) {
            dd($th);
            return json_encode('error');
        }
    }
    public function PDF($id){
        if (is_null(Hoja_Entrada::where('idHojMov',$id)->first())){
            $hoja = Hoja_Mov::join('hoja_salida','hoja_salida.idHojMov','hoja_mov.idHojMov')
            ->where('hoja_mov.idHojMov',$id)->first();
            $tipo='S';
        } else{
            $hoja = Hoja_Mov::join('hoja_entrada','hoja_entrada.idHojMov','hoja_mov.idHojMov')
            ->join('documento','documento.idDocumento','hoja_entrada.idDocumento')
            ->join('empresa','empresa.idEmpresa','documento.idEmpresa')->where('hoja_mov.idHojMov',$id)->first();
            $tipo='E';
        }

        $detalle = Movimiento::join('kardex','kardex.idKardex','movimiento.idKardex')->join('producto','producto.idProducto','kardex.idProducto')
        ->select('producto.codProducto','producto.Prod_nombre','movimiento.Mov_costo','movimiento.Mov_cantidad')->where('idHojMov',$id)->get();

        $subtotal=[];
        $total=0.00;
        $x=0;

        foreach ($detalle as $det) {
            $subtotal[$x]=number_format($det->Mov_costo*$det->Mov_cantidad,2);
            $total+=$subtotal[$x];
            $x++;
        }

        $colaborador = Colaborador::join('persona','persona.idPersona','colaborador.idPersona')->where('idCol',$hoja->idCol)->first();
        

        if($hoja->idHojMov<10){
            $NroHoja='H/'.$tipo.'  N° 000'.$hoja->idHojMov;
        }else {
            if($hoja->idHojMov<100){
                $NroHoja='H/'.$tipo.'  N° 00'.$hoja->idHojMov;
            } else {
                if($hoja->idHojMov<1000){
                    $NroHoja='H/'.$tipo.'  N° 0'.$hoja->idHojMov;
                } else{
                    $NroHoja='H/'.$tipo.'  N° '.$hoja->idHojMov;
                }
            }
            
        }
      
        $total = number_format($total,2);

        $nombreDoc='hoja_almacen';
        
        $titulo="HOJA DE ALMACÉN - ".$NroHoja;

   

        $pdf = \domPDF::loadView('hojaAlmacen.PDF',compact('nombreDoc','titulo','colaborador','NroHoja','hoja', 'tipo', 'detalle','subtotal','total'));
        return $pdf->stream('hoja_almacen.pdf');

    }
}
