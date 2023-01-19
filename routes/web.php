<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('general.inicio');
});*/
Route::get('/',['as'=>'index','uses'=>'UserController@index']);
Route::get('/home',['as'=>'home','uses'=>'UserController@index']);

Route::group(['middleware' => 'auth'], function () {
    // Route::post('/incio',['as'=>'user.login','uses'=>'UserController@login']);
    // Route::get('/incio',['as'=>'user.login','uses'=>'HomeController@login']);
    Route::get('/logout',['as'=>'logout','uses'=>'UserController@logout']);

    Route::get('/inicio', 'HomeController@index')->name('home');
    // Route::get('/',['as'=>'user.logout','uses'=>'UserController@logout']);

// RUTAS PARA LOS EGRESOS DEL COLABORADOR
// Route::get('adelanto/registro',['as'=>'adelanto.register','uses'=>'DescuentoController@adelanto']);
// Route::POST('adelanto/guardar',['as'=>'adelanto.guardar','uses'=>'DescuentoController@adelantoG']);

// //RUTAS PARA LOS INGRESOS DEL COLABORADOR
// Route::get('ingreso/registro',['as'=>'ingreso.register','uses'=>'IngresoController@inicio']);
// Route::POST('ingreso/guardar',['as'=>'ingreso.guardar','uses'=>'IngresoController@guardar']);





// // RUTAS PARA EL CONTRATO
// Route::get('/contrato',['as'=>'contrato.inicio','uses'=>'ContratoController@inicio']);
// Route::post('/contrato/nuevo',['as'=>'contrato.registro','uses'=>'ContratoController@registro']);
// Route::get('/contrato/eliminar/{id}/{idc}',['as'=>'contrato.delete','uses'=>'ContratoController@eliminar']);



// // RUTA PARA LA ASISTENCIA
// Route::get('/asistencia/registro',['as'=>'asistencia.register','uses'=>'RegistroController@registro']);
// Route::POST('/asistencia/entrada',['as'=>'entrada.register','uses'=>'RegistroController@RegEntrada']);
// Route::post('/asistencia/salida',['as'=>'salida.register','uses'=>'RegistroController@RegSalida']);
// Route::get('/asistencia/gráfico/{ini}/{fin}',['as'=>'grafico.asistencia','uses'=>'RegistroController@gráfico']);
// Route::get('/Horas_trabajadas/gráfico/{ini}/{fin}',['as'=>'grafico.horast','uses'=>'RegistroController@Horasgráfico']);
// Route::get('/Boletas/gráfico',['as'=>'grafico.boleta','uses'=>'BoletaController@grafico']);


// // RUTA PARA EL ROL
// Route::get('/rol',['as'=>'rol.register','uses'=>'RolController@registro']);

// Route::get('/informacion',['as'=>'user.info','uses'=>'UserController@info']);


// // RUTAS DE REPORTES
// Route::get('/asistencias',['as'=>'asistencia.reporte','uses'=>'RegistroController@asistencias']);
// Route::post('/asistencia/reporte',['as'=>'mostrar.asistencias','uses'=>'RegistroController@show']);
// Route::post('asistencia/pdf',['as'=>'pdf.asistencia','uses'=>'RegistroController@pdf']);

// Route::get('/boletas',['as'=>'boleta.reporte','uses'=>'BoletaController@reporte']);


// Route::post('/horasTrabajadas/reporte',['as'=>'mostrar.horast','uses'=>'RegistroController@horasTrabajadasShow']);

// Route::get('/familiar/listado',['as'=>'familiar.lista','uses'=>'FamiliarController@lista']);
// Route::get('/planilla/listado',['as'=>'planilla.lista','uses'=>'PlanillaController@lista']);


// // descargar pdfs

// Route::get('/descargar/boleta/Colaborador={id}',['as'=>'boleta.descarga','uses'=>'PDFController@PDFBoleta']);




// RUTAS NUEVAS

//RUTAS PARA EL ROL
Route::get('/rol',['as'=>'rol.register','uses'=>'RolController@registro']);
Route::get('/rol',['as'=>'rol.register','uses'=>'RolController@registro']);
Route::post('/rol/actualizar/{id}',['as'=>'rol.update','uses'=>'RolController@actualizar']);
Route::post('/rol/guardar',['as'=>'rol.guardar','uses'=>'RolController@guardar']);
Route::get('/rol/eliminar/{id}',['as'=>'rol.delete','uses'=>'RolController@eliminar']);
Route::get('/rol/verificar/{id}',['as'=>'rol.verif','uses'=>'RolController@verificar']);


// RUTAS PARA EL COLABORADOR
Route::get('/Colaborador/registro',['as'=>'colaborador.register','uses'=>'ColaboradorController@registro']);
Route::get('/Colaborador/listado',['as'=>'colaborador.lista','uses'=>'ColaboradorController@lista']);
Route::get('/Colaborador/editar/{id}',['as'=>'colaborador.edit','uses'=>'ColaboradorController@editar']);
Route::get('/Colaborador/confirmar/{id}',['as'=>'colaborador.confirm','uses'=>'ColaboradorController@confirmar']);
Route::get('/Colaborador/eliminar/{id}',['as'=>'colaborador.delete','uses'=>'ColaboradorController@eliminar']);
Route::get('/colaborador/nuevo',['as'=>'colaborador.registrar','uses'=>'ColaboradorController@nuevo']);

Route::post('/Colaborador/confirm',['as'=>'colaborador.confirmacion','uses'=>'ColaboradorController@confirm']);
Route::post('/Colaborador/actualizar/{id}',['as'=>'colaborador.update','uses'=>'ColaboradorController@actualizar']);
Route::post('/colaborador/guardar',['as'=>'colaborador.guardar','uses'=>'ColaboradorController@guardar']);

// RUTAS PARA EL ÁREA
Route::get('/areas',['as'=>'area.register','uses'=>'AreaController@registro']);
Route::post('/area/actualizar/{id}',['as'=>'area.update','uses'=>'AreaController@actualizar']);
Route::post('/area/guardar',['as'=>'area.guardar','uses'=>'AreaController@guardar']);
Route::get('/area/eliminar/{id}',['as'=>'area.delete','uses'=>'AreaController@eliminar']);
Route::get('/area/verificar/{id}',['as'=>'area.verif','uses'=>'AreaController@verificar']);

// RUTAS PARA EL CARGO
Route::get('/cargo',['as'=>'cargo.register','uses'=>'CargoController@registro']);
Route::post('/cargo/actualizar/{id}',['as'=>'cargo.update','uses'=>'CargoController@actualizar']);
Route::post('/cargo/guardar',['as'=>'cargo.guardar','uses'=>'CargoController@guardar']);
Route::get('/cargo/eliminar/{id}',['as'=>'cargo.delete','uses'=>'CargoController@eliminar']);
Route::get('/cargo/verificar/{id}',['as'=>'cargo.verif','uses'=>'CargoController@verificar']);

// RUTAS PARA EL SISTEMA DE PENSION
Route::get('/pensiones',['as'=>'pension.register','uses'=>'SistPensionController@registro']);
Route::post('/pension/actualizar/{id}',['as'=>'pension.update','uses'=>'SistPensionController@actualizar']);
Route::post('/pension/guardar',['as'=>'pension.guardar','uses'=>'SistPensionController@guardar']);
Route::get('/pension/eliminar/{id}',['as'=>'pension.delete','uses'=>'SistPensionController@eliminar']);

// RUTAS PARA TIPO DE PRODUCTOS
Route::get('/getCodTipoProd/{id}',['as'=>'tipoProd.buscar','uses'=>'TipoProductoController@buscar']);
Route::get('/tipoProductos',['as'=>'tipoProd.register','uses'=>'TipoProductoController@registro']);
Route::post('/tipoProducto/actualizar/{id}',['as'=>'tipoProd.update','uses'=>'TipoProductoController@actualizar']);
Route::post('/tipoProducto/guardar',['as'=>'tipoProd.guardar','uses'=>'TipoProductoController@guardar']);
Route::get('/tipoProducto/eliminar/{id}',['as'=>'tipoProd.delete','uses'=>'TipoProductoController@eliminar']);
Route::get('/tipoProducto/verificar/{id}',['as'=>'tipoProd.verif','uses'=>'TipoProductoController@verificar']);

// RUTAS PARA TIPO DE DOCUMENTOS
Route::get('/tipoDocumentos',['as'=>'tipoDoc.register','uses'=>'TipoDocumentoController@registro']);
Route::post('/tipoDocumento/actualizar/{id}',['as'=>'tipoDoc.update','uses'=>'TipoDocumentoController@actualizar']);
Route::post('/tipoDocumento/guardar',['as'=>'tipoDoc.guardar','uses'=>'TipoDocumentoController@guardar']);
Route::get('/tipoDocumento/eliminar/{id}',['as'=>'tipoDoc.delete','uses'=>'TipoDocumentoController@eliminar']);
Route::get('/tipoDocumento/verificar/{id}',['as'=>'tipoDoc.verif','uses'=>'TipoDocumentoController@verificar']);

// RUTAS PARA DOCUMENTOS
Route::get('/comprobantes',['as'=>'documento.register','uses'=>'DocumentoController@registro']);
Route::get('/getEmpresa/{id}',['as'=>'empresa.buscar','uses'=>'DocumentoController@buscarEmpresa']);
Route::get('/comprobante/verificar/{id}/{cod}',['as'=>'documento.verificar','uses'=>'DocumentoController@verificar']);
Route::post('/comprobante/actualizar/{id}',['as'=>'documento.update','uses'=>'DocumentoController@actualizar']);
Route::post('/comprobante/guardar',['as'=>'documento.guardar','uses'=>'DocumentoController@guardar']);
Route::get('/comprobante/eliminar/{id}',['as'=>'documento.delete','uses'=>'DocumentoController@eliminar']);


// RUTAS PARA PROVEEDOR
Route::get('/proveedores',['as'=>'empresa.register','uses'=>'EmpresaController@registro']);
Route::post('/proveedor/actualizar/{id}',['as'=>'empresa.update','uses'=>'EmpresaController@actualizar']);
Route::post('/proveedor/guardar',['as'=>'empresa.guardar','uses'=>'EmpresaController@guardar']);
Route::get('/proveedor/eliminar/{id}',['as'=>'empresa.delete','uses'=>'EmpresaController@eliminar']);
Route::get('/proveedor/verificar/{id}',['as'=>'empresa.verif','uses'=>'EmpresaController@verificar']);

// RUTAS PARA HORAS TRABAJADAS
Route::get('/horasTrabajadas',['as'=>'hrsTrabajadas.register','uses'=>'HrsTrabajadasController@registro']);
Route::post('/horasTrabajadas/actualizar/{id}',['as'=>'hrsTrabajadas.update','uses'=>'HrsTrabajadasController@actualizar']);
Route::post('/horasTrabajadas/guardar',['as'=>'hrsTrabajadas.guardar','uses'=>'HrsTrabajadasController@guardar']);
Route::get('/horasTrabajadas/eliminar/{id}',['as'=>'hrsTrabajadas.delete','uses'=>'HrsTrabajadasController@eliminar']);

// RUTAS PARA ADELANTOS
Route::get('/adelantos',['as'=>'adelanto.register','uses'=>'AdelantoController@registro']);
Route::get('/adelanto/verificar/{fecha}/{id}',['as'=>'adelanto.verif','uses'=>'AdelantoController@verificar']);
Route::get('/getNombres/{id}',['as'=>'nombre.buscar','uses'=>'ColaboradorController@buscar']);
Route::post('/adelanto/actualizar/{id}',['as'=>'adelanto.update','uses'=>'AdelantoController@actualizar']);
Route::post('/adelanto/guardar',['as'=>'adelanto.guardar','uses'=>'AdelantoController@guardar']);
Route::get('/adelanto/eliminar/{id}',['as'=>'adelanto.delete','uses'=>'AdelantoController@eliminar']);

// RUTAS PARA LA JUBILACION
Route::get('/jubilaciones',['as'=>'jubilacion.register','uses'=>'JubilacionController@registro']);
Route::post('/jubilacion/guardar',['as'=>'jubilacion.guardar','uses'=>'JubilacionController@guardar']);
Route::post('/jubilacion/actualizar/{id}',['as'=>'jubilacion.update','uses'=>'JubilacionController@actualizar']);
Route::get('/jubilacion/eliminar/{id}',['as'=>'jubilacion.delete','uses'=>'JubilacionController@eliminar']);

// RUTAS PARA FLUJOS DE DINERO
Route::get('/movimientosDinero',['as'=>'flujoDinero.register','uses'=>'FlujoDineroController@registro']);
Route::post('/movimientosDinero/actualizar/{id}',['as'=>'flujoDinero.update','uses'=>'FlujoDineroController@actualizar']);
Route::post('/movimientosDinero/guardar',['as'=>'flujoDinero.guardar','uses'=>'FlujoDineroController@guardar']);
Route::get('/movimientosDinero/eliminar/{id}',['as'=>'flujoDinero.delete','uses'=>'FlujoDineroController@eliminar']);

// RUTAS PARA PRODUCTOS
Route::get('/productos',['as'=>'producto.register','uses'=>'ProductoController@registro']);
Route::get('/getProductosLibre',['as'=>'producto.buscar','uses'=>'ProductoController@buscarLibre']);
Route::post('/producto/actualizar/{id}',['as'=>'producto.update','uses'=>'ProductoController@actualizar']);
Route::post('/producto/guardar',['as'=>'producto.guardar','uses'=>'ProductoController@guardar']);
Route::get('/producto/eliminar/{id}',['as'=>'producto.delete','uses'=>'ProductoController@eliminar']);
Route::get('/producto/verificar/{id}',['as'=>'producto.verif','uses'=>'ProductoController@verificar']);

// RUTAS PARA KARDEX
Route::get('/kardex',['as'=>'kardex.register','uses'=>'KardexController@registro']);
Route::post('/getProducto',['as'=>'kardex.buscar','uses'=>'KardexController@buscarProducto']);
Route::post('/kardex/actualizar/{id}',['as'=>'kardex.update','uses'=>'KardexController@actualizar']);
Route::post('/kardex/guardar',['as'=>'kardex.guardar','uses'=>'KardexController@guardar']);
Route::get('/kardex/eliminar/{id}',['as'=>'kardex.delete','uses'=>'KardexController@eliminar']);

//RUTAS PARA HOJAS DE ALMACEN
Route::get('/hojasAlmacen',['as'=>'hojaAlmacen.register','uses'=>'HojaAlmacenController@registro']);
Route::post('/getDocInfo',['as'=>'infoDoc.buscar','uses'=>'DocumentoController@buscarInfoDoc']);
Route::get('/hojaAlmacen/nuevo',['as'=>'hojaAlmacen.nuevo','uses'=>'HojaAlmacenController@nuevo']);
Route::post('/hojaAlmacenSave',['as'=>'hojaAlmacen.guardar','uses'=>'HojaAlmacenController@guardar']);
Route::get('/hojaAlmacen/eliminar/{id}',['as'=>'hojaAlmacen.delete','uses'=>'HojaAlmacenController@eliminar']);
Route::get('/hojaAlmacen/visualizar/{id}',['as'=>'hojaAlmacen.visualizar','uses'=>'HojaAlmacenController@visualizar']);
Route::get('/descargar/hojaAlmacen/nro={id}',['as'=>'hojaAlmacen.descarga','uses'=>'HojaAlmacenController@pdf']);

// RUTAS PARA SERVICIOS
Route::get('/servicios',['as'=>'servicio.register','uses'=>'ServicioController@registro']);
Route::post('/servicio/actualizar/{id}',['as'=>'servicio.update','uses'=>'ServicioController@actualizar']);
Route::post('/servicio/guardar',['as'=>'servicio.guardar','uses'=>'ServicioController@guardar']);
Route::get('/servicio/eliminar/{id}',['as'=>'servicio.delete','uses'=>'ServicioController@eliminar']);
Route::post('/servicio/verificar',['as'=>'ubicacion.verif','uses'=>'ServicioController@verificar']);

//RUTAS PARA PRESUPUESTOS
Route::get('/presupuestos',['as'=>'presupuesto.register','uses'=>'PresupuestoController@registro']);
Route::post('/getCliente',['as'=>'cliente.buscar','uses'=>'ClienteController@buscar']);
Route::post('/getServicio',['as'=>'servicio.buscar','uses'=>'ServicioController@buscar']);
Route::get('/presupuesto/nuevo',['as'=>'presupuesto.registrar','uses'=>'PresupuestoController@nuevo']);
Route::post('/presupuestoSave',['as'=>'presupuesto.guardar','uses'=>'PresupuestoController@guardar']);
Route::get('/presupuesto/eliminar/{id}',['as'=>'presupuesto.delete','uses'=>'PresupuestoController@eliminar']);
Route::get('/presupuesto/visualizar/{id}',['as'=>'presupuesto.visualizar','uses'=>'PresupuestoController@visualizar']);
Route::get('/descargar/presupuesto/nro={id}',['as'=>'presupuesto.descarga','uses'=>'PresupuestoController@pdf']);
Route::post('/imgInforme/guardar',['as'=>'imgInforme.guardar','uses'=>'PresupuestoController@generarInforme']);

// RUTAS PARA TIPO DE CLIENTES
Route::get('/clientes',['as'=>'cliente.register','uses'=>'ClienteController@registro']);
Route::post('/getClienteInfo',['as'=>'cliente.buscar','uses'=>'ClienteController@buscar']);
Route::post('/cliente/actualizar/{id}',['as'=>'cliente.update','uses'=>'ClienteController@actualizar']);
Route::post('/cliente/guardar',['as'=>'cliente.guardar','uses'=>'ClienteController@guardar']);
Route::get('/cliente/eliminar/{id}',['as'=>'cliente.delete','uses'=>'ClienteController@eliminar']);

// RUTAS PARA RESPONSABLES DE PRESUPUESTOS
Route::get('/responsables',['as'=>'responsable.register','uses'=>'ResponsableController@registro']);
Route::post('/responsable/guardar',['as'=>'responsable.guardar','uses'=>'ResponsableController@guardar']);
Route::get('/responsable/eliminar/{id}',['as'=>'responsable.delete','uses'=>'ResponsableController@eliminar']);
Route::post('/responsable/actualizar/{id}',['as'=>'responsable.update','uses'=>'ResponsableController@actualizar']);
Route::get('/getResponsableInfo/{id}',['as'=>'responsableInfo.buscar','uses'=>'ResponsableController@buscar']);
Route::get('/getResponsables/{id}',['as'=>'responsables.buscar','uses'=>'ResponsableController@ResponsablesLista']);






// RUTAS PARA LA UBICACIÓN
Route::get('/ubicaciones',['as'=>'ubicacion.register','uses'=>'UbicacionController@registro']);
Route::get('/getUbicaciones',['as'=>'ubicacion.buscar','uses'=>'UbicacionController@buscar']);
Route::post('/ubicacion/actualizar/{id}',['as'=>'ubicacion.update','uses'=>'UbicacionController@actualizar']);
Route::post('/ubicacion/guardar',['as'=>'ubicacion.guardar','uses'=>'UbicacionController@guardar']);
Route::get('/ubicacion/eliminar/{id}',['as'=>'ubicacion.delete','uses'=>'UbicacionController@eliminar']);
Route::get('/ubicacion/verificar/{id}',['as'=>'ubicacion.verif','uses'=>'UbicacionController@verificar']);

// RUTAS PARA LA PLANILLA
Route::get('/Planillas',['as'=>'planilla.register','uses'=>'PlanillaController@inicio']);
Route::get('/Planilla/registro',['as'=>'planilla.nuevo','uses'=>'PlanillaController@registro']);
Route::post('/planilla/guardar',['as'=>'planilla.guardar','uses'=>'PlanillaController@guardar']);
Route::get('/planilla/ver/{id}',['as'=>'planilla.ver','uses'=>'PlanillaController@ver']);
Route::get('/planilla/descarga/{id}',['as'=>'planilla.descarga','uses'=>'PlanillaController@PDF']);

// RUTA PARA LA BOLETA
Route::get('boletas',['as'=>'boleta.register','uses'=>'BoletaController@inicio']);
Route::get('boleta/{id}',['as'=>'boleta.ver','uses'=>'BoletaController@ver']);
Route::get('/bol/eliminar/{id}',['as'=>'boleta.borrar','uses'=>'BoletaController@eliminar']);
Route::get('/descargar/boleta/{id}',['as'=>'boleta.descarga','uses'=>'BoletaController@pdf']);



// RUTAS PARA EL USUARIO
Route::get('/usuario',['as'=>'usuario.inicio','uses'=>'UserController@inicio']);
Route::get('/usuario/reiniciar/{id}',['as'=>'usuario.reset','uses'=>'UserController@reinicioContraseña']);
Route::get('/usuario/eliminar/{id}',['as'=>'usuario.delete','uses'=>'UserController@eliminar']);
Route::get('/usuario/perfil',['as'=>'usuario.perfil','uses'=>'UserController@perfil']);
Route::get('/usuario/registro',['as'=>'usuario.reg','uses'=>'UserController@registro']);
Route::post('/contraseña/verificar/{id}',['as'=>'password.verify','uses'=>'UserController@verificarContraseña']);
Route::post('/contraseña/actualizar/{id}',['as'=>'password.update','uses'=>'UserController@actualizarContraseña']);
Route::get('/usuario/registrar/{tipo}',['as'=>'usuario.ingreso','uses'=>'UserController@registroDiario']);

// RUTAS PARA LOS REPORTES
    //asistencias
Route::get('/asistencias/reporte',['as'=>'asistencia.reporte','uses'=>'HrsTrabajadasController@reporteAsistencias']);
Route::get('/asistencias/reporte/desde={inicio}/hasta={fin}',['as'=>'asistencia.generar','uses'=>'HrsTrabajadasController@generarReporteAsistencias']);
Route::get('/descargar/asistencias/tabla/{inicio}/{fin}',['as'=>'asistencia.descargaTabla','uses'=>'HrsTrabajadasController@PDFasistenciasTabla']);
Route::get('/descargar/asistencias/grafico/{inicio}/{fin}',['as'=>'asistencia.descargaGrafico','uses'=>'HrsTrabajadasController@PDFasistenciasGrafico']);

    //hrsTrabajadas
Route::get('/horasTrabajadas/reporte',['as'=>'horast.reporte','uses'=>'HrsTrabajadasController@reporteHrsTrabajadas']);
Route::get('/horasTrabajadas/reporte/desde={inicio}/hasta={fin}',['as'=>'horast.generar','uses'=>'HrsTrabajadasController@generarReporteHrsTrabajadas']);
Route::get('/descargar/horasTrabajadas/{inicio}/{fin}',['as'=>'horast.descarga','uses'=>'HrsTrabajadasController@PDFhrsTrabajadasTabla']);
Route::get('/descargar/horasTrabajadas/grafico/{inicio}/{fin}',['as'=>'horast.descargaGrafico','uses'=>'HrsTrabajadasController@PDFhrsTrabajadasGrafico']);

    //boletas
Route::get('/boletas/reporte',['as'=>'boleta.reporte','uses'=>'BoletaController@inicioReporte']);
Route::get('/boletas/reporte/periodo={periodo}',['as'=>'boleta.generar','uses'=>'BoletaController@generarReporteBoletas']);
Route::get('/descargar/boletas/tabla/{periodo}',['as'=>'boleta.descargaT','uses'=>'BoletaController@PDFboletasTabla']);
Route::get('/descargar/boletas/grafico/{periodo}',['as'=>'boleta.descargaG','uses'=>'BoletaController@PDFboletasGrafico']);

    //planilla
Route::get('/planillas/reporte',['as'=>'planilla.reporte','uses'=>'PlanillaController@reportePlanillas']);
Route::get('/planillas/reporte/desde={inicio}/hasta={fin}',['as'=>'boleta.generar','uses'=>'PlanillaController@generarReportePlanillas']);
Route::get('/descargar/planillas/tabla/{inicio}/{fin}',['as'=>'planilla.descargaT','uses'=>'PlanillaController@PDFplanillasTabla']);
Route::get('/descargar/planillas/grafico/{inicio}/{fin}',['as'=>'planilla.descargaG','uses'=>'PlanillaController@PDFplanillasGrafico']);

    //presupuestos
Route::get('/presupuestos/reporte',['as'=>'presupuesto.reporte','uses'=>'PresupuestoController@reportePresupuestos']);
Route::get('/presupuestos/reporte/desde={inicio}/hasta={fin}',['as'=>'horast.generar','uses'=>'PresupuestoController@generarReportePresupuestos']);
Route::get('/descargar/presupuestos/tabla/{inicio}/{fin}',['as'=>'presupuesto.descargaT','uses'=>'PresupuestoController@PDFpresupuestosTabla']);
Route::get('/descargar/presupuestos/grafico/{inicio}/{fin}',['as'=>'presupuesto.descargaG','uses'=>'PresupuestoController@PDFpresupuestosGrafico']);

    //almacen
Route::get('/almacen/reporte',['as'=>'inventario.reporte','uses'=>'ProductoController@inventario']);
Route::get('/getproductosAlmacen',['as'=>'inventario.buscar','uses'=>'ProductoController@ProductosInventariados']);
Route::get('/descargar/inventario',['as'=>'inventario.descarga','uses'=>'ProductoController@PDFinventario']);

// RUTAS GRÁFICOS
    //asistencias
Route::post('/asistencias/grafico',['as'=>'asistencia.grafico','uses'=>'GraficoController@AsistGrafico']); 
Route::post('/HorasTrabajadas/grafico',['as'=>'horast.grafico','uses'=>'GraficoController@HorastGrafico']);
Route::post('/boletas/grafico',['as'=>'boletas.grafico','uses'=>'GraficoController@BoletasGrafico']);
Route::post('/planillas/grafico',['as'=>'boletas.grafico','uses'=>'GraficoController@PlanillasGrafico']);
Route::post('/presupuestos/grafico',['as'=>'presupuesto.grafico','uses'=>'GraficoController@PresupuestosGrafico']);
});


Auth::routes(['register'=>false]);
