<?php

namespace App\Http\Controllers;
use View;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Model\Producto;
use App\Model\Tipo_Prod;
use App\Http\Controllers\ProductoController;

class ProductoController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function registro(){
        $productos = Producto::whereIn('Prod_estado',array('activo','inactivo','almacenado'))->orderBy('codProducto')->get();
        $tipos = Tipo_Prod::where('TP_estado','activo')->get();
        // dd($productos);
        return View::make('producto.registro')->with(['productos'=>$productos, 'tipos'=>$tipos]);

    }

    public function guardar(Request $request){
            try {
                $tipo=Tipo_Prod::findOrFail($request->tipo);
                $codigo=$tipo->TP_codigo;
                // dd($tipo);
                $cant=Producto::where('codProducto','like',$codigo.'%')->count();
    
                if ($cant<100){
                    $codProd=$codigo.'-0'.strval($cant+1);
                }
                if ($cant<10){
                    $codProd=$codigo.'-00'.strval($cant+1);
                }
                
    
                $prod = new Producto;
                $prod->codProducto=$codProd;
                $prod->Prod_nombre=mb_strtoupper($request->nombre, 'UTF-8');
                $prod->idTipoProd=$request->tipo;
                $prod->Prod_descripcion=mb_strtoupper($request->descripcion, 'UTF-8');
                $prod->Prod_precio=$request->precio;
                $prod->Prod_unidMed=$request->unidMed;
                $prod->Stock_minimo=$request->minimo;
                $prod->save();
                return json_encode('success');
            } catch (\Throwable $th) {
                return json_encode('error');
            }
        
    }

    public function verificar($id){
        $prod = Producto::where('Prod_nombre',$id)->first();
        if(is_null($prod)){
            return json_encode('success');
        } else{
            return json_encode('error');
        }
    }

    public function actualizar(Request $request,$id){
        try {
            $registrado = Producto::where('Prod_nombre',$request->nombre)->where('Prod_estado','activo')->first();

            if(is_null($registrado) || $registrado->idProducto == $id){
                $prod = Producto::findOrFail($id);
                if ($prod->idTipoProd == $request->tipo){
                    $prod->Prod_nombre=mb_strtoupper($request->nombre, 'UTF-8');
                    $prod->Prod_descripcion=mb_strtoupper($request->descripcion, 'UTF-8');
                    $prod->Prod_precio=$request->precio;
                    $prod->Prod_unidMed=$request->unidMed;
                    $prod->Stock_minimo=$request->minimo;
                    $prod->save();
                }
                else {
                    $prod->Prod_estado='eliminado';
                    $prod->save();
                    ProductoController::guardar($request);
                }
                return json_encode('success');
            }
            else{
                return json_encode('error-2');
            }
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function eliminar($id){
        try {
            $prod = Producto::findOrFail($id);
            if($prod->Prod_estado=='activo'){
                $prod->Prod_estado='inactivo';
                $prod->save();
            }else{
                $prod->Prod_estado='activo';
                $prod->save();
            }
            
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function buscarLibre(){
        $productos = Producto::where('Prod_estado','activo')->get();
        return json_encode($productos);
    }
    public function inventario(){
        return View::make('producto.inventarioAlmacen');
    }
    public function ProductosInventariados(){
        $productos = Producto::join('kardex','kardex.idProducto','producto.idProducto')->where('krdx_estado','activo')->orderBy('codProducto')->get();
        return json_encode($productos);
    }
    public function PDFinventario(){
        $info=  Producto::join('kardex','kardex.idProducto','producto.idProducto')->where('krdx_estado','activo')->orderBy('codProducto')->get();

        $hoy = Carbon::now();
        $generado=$hoy->format("d-m-Y");

        $nombreDoc='inventario_almacen';
        
        $titulo="INVENTARIO ACTUAL DE ALMACÉN ";
        $colums=['COD. PRODUCTO', 'PRODUCTO','CANT. ACTUAL'];
        $contenido= [];

       foreach ($info as $dato) {

            $fila = [];

            $fila[]=$dato->codProducto;
            $fila[]=$dato->Prod_nombre;
            $fila[]=$dato->Cant_actual;

            $contenido[]=$fila;
       }
      
    
        $pdf = \domPDF::loadView('producto.PDFinventario',compact('generado','nombreDoc','titulo','colums','contenido'));
        return $pdf->stream('reporte_asistencias.pdf');

    }
}
