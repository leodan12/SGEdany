<?php

namespace App\Http\Controllers;
use View;
use Datetime;
use App\Http\Controllers\DocumentoController;

use Illuminate\Http\Request;
use App\Model\Documento;
use App\Model\Tipo_Dcmnto;
use App\Model\Empresa;
use App\Model\Rol;
use Carbon\Carbon;

class DocumentoController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function registro()
    {
        $docs = Documento::join('empresa','empresa.idEmpresa','documento.idEmpresa')->whereIn('Dcmto_estado',array('activo','ingresado'))->get();
        $tipos= Tipo_Dcmnto::where('TD_estado',1)->get();
        $rol= Rol::where('rol_nombre','PROVEEDOR')->first();
        $empresas=Empresa::where('idRol',$rol->idRol)->get();
        return View::make('documento.registro')->with(['docs'=>$docs,'tipos'=>$tipos,'empresas'=>$empresas]);

    }

    public function guardar(Request $request){
       
        try {
            if($request->hasFile("fileDoc")){
               
                $hoy = new Datetime;
    
                $file = $request->file('fileDoc');
                
                $nro = Documento::where('Dcmto_registro',$hoy)->where('idEmpresa',$request->rucDoc)->count();
                $empresa=Empresa::findOrFail($request->rucDoc);
               
                if ($nro+1<10){
                    //COMPROBANTE-20602163751-XX 10-10-95.pdf
                    $nombre = 'COMPROBANTE-'.$empresa->RUC.'-0'.($nro+1).' '.$hoy->format('d-m-Y').'.'.$file->getClientOriginalExtension();
                }
                else{
                    $nombre = 'COMPROBANTE-'.$empresa->RUC.'-'.($nro+1).' '.$hoy->format('d-m-Y').'.'.$file->getClientOriginalExtension();
                }
                $ruta = "img/comprobantes/";
                
                $file->move($ruta,$nombre); 
            }
            
            $doc = new Documento;
            $doc->idTipoDcmto = $request->tipoDoc;
            $doc->Dcmto_codigo=mb_strtoupper($request->codDoc, 'UTF-8');
            $doc->idEmpresa=$request->rucDoc;
            $doc->Dcmto_precio=$request->precioDoc;
            $doc->Dcmto_emision=$request->emiDoc;
            $doc->Dcmto_archivo=$nombre;
            $doc->Dcmto_registro=$hoy->format('Y-m-d');
            $doc->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            dd($th);
            return json_encode('error');
        }
        // $tipo = new Tipo_Dcmnto;
        // $tipo->TD_nombre = mb_strtoupper($request->nameTipo, 'UTF-8');
        // $tipo->save();
        // return redirect()->route('tipoDoc.register');
    }

    public function actualizar(Request $request,$id){
        $registrado = Documento::findOrFail($id);

        if($registrado->Dcmto_codigo == mb_strtoupper($request->codDoc, 'UTF-8') && $registrado->idEmpresa == $request->rucDoc ){
            $registrado->Dcmto_precio=$request->precioDoc;
            $registrado->Dcmto_emision=$request->emiDoc;
            $registrado->save();
            return json_encode('success');
        }
        else{
            

            $comprobar = Documento::where('idEmpresa',$request->rucDoc)->where('Dcmto_codigo',mb_strtoupper($request->codDoc, 'UTF-8'))->first();
            if (is_null($comprobar)){
                $registrado->Dcmto_codigo= mb_strtoupper($request->codDoc, 'UTF-8');
                $registrado->idEmpresa == $request->rucDoc;
                $registrado->Dcmto_precio=$request->precioDoc;
                $registrado->Dcmto_emision=$request->emiDoc;
                $registrado->save();
                return json_encode('success');
            }
            else
                return json_encode('error-2');

        }
    }

    public function eliminar($id){
        try {
            $doc = Documento::findOrFail($id);
            if($doc->Dcmto_estado=='activo'){
                $doc->Dcmto_estado='inactivo';
            }
            else{
                $doc->Dcmto_estado='activo';
            }
            $doc->save();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }

    public function buscarEmpresa($id){
        $empresa = Empresa::findOrFail($id);
        return json_encode($empresa);
    }

    public function buscarInfoDoc(Request $request){
        // return 1;
        $documento = Documento::findOrFail($request->id);
        
        $datos =Empresa::findOrFail($documento->idEmpresa);
      
        return json_encode($datos);
    }

    public function verificar($id,$cod){
        try {
            $registrado = Documento::where('idEmpresa',$id)->where('Dcmto_codigo',$cod)->first();
            if (is_null($registrado))
                return json_encode('success');
            else
                return json_encode('error');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
