<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <?php 
                             $persona = App\Model\Persona::findOrfail(Auth::user()->idPersona);
                             $nivel= App\Model\Rol::findOrFail($persona->idRol);
                            ?>
                            @if($nivel->rol_permiso < 4)
                            <div class="sb-sidenav-menu-heading">registros</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRecur" aria-expanded="false" aria-controls="collapseRecur">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                 Recursos Humanos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseRecur" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('colaborador.register')}}">Colaboradores</a>
                                    <a class="nav-link" href="{{route('adelanto.register')}}">Adelantos</a>
                                    <a class="nav-link" href="{{route('hrsTrabajadas.register')}}">Horas Trabajadas</a>
                                    <a class="nav-link" href="{{route('flujoDinero.register')}}">Ingresos y/o Descuentos</a>
                                    <a class="nav-link" href="{{route('jubilacion.register')}}">Jubilaciones</a>
                                </nav>
                            </div>
                            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAlmacen" aria-expanded="false" aria-controls="collapseAlmacen">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                                Almacén
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseAlmacen" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('producto.register')}}">Productos</a>
                                    <a class="nav-link" href="{{route('documento.register')}}">Documentos</a>
                                    <a class="nav-link" href="{{route('kardex.register')}}">Kardex</a>
                                    <a class="nav-link" href="{{route('hojaAlmacen.register')}}">Hojas de Almacén</a>
                                </nav>
                            </div> -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRem" aria-expanded="false" aria-controls="collapseRem">
                                <div class="sb-nav-link-icon"><i class="fas fa-coins"></i></div>
                                Remuneraciones
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseRem" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('planilla.register')}}">Planillas</a>
                                    <a class="nav-link" href="{{route('boleta.register')}}">Boletas</a>
                                </nav>
                            </div>
                            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePresu" aria-expanded="false" aria-controls="collapsePresu">
                                <div class="sb-nav-link-icon"><i class="fas fa
                                3-file-alt"></i></div>
                                Presupuestos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePresu" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('servicio.register')}}">Servicios</a>
                                    <a class="nav-link" href="{{route('presupuesto.register')}}">Presupuestos</a>
                                </nav>
                            </div> -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReprt" aria-expanded="false" aria-controls="collapseReprt">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                                Reportes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseReprt" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('asistencia.reporte')}}">Asistencias</a>
                                    <a class="nav-link" href="{{route('boleta.reporte')}}">Boletas de pago</a>
                                    <a class="nav-link" href="{{route('horast.reporte')}}">Horas Trabajadas</a>
                                    <a class="nav-link" href="{{route('planilla.reporte')}}">Planillas</a>
                                    <!-- <a class="nav-link" href="{{route('presupuesto.reporte')}}">Presupuestos</a>
                                    <a class="nav-link" href="{{route('inventario.reporte')}}">Inventario</a> -->
                                </nav>
                            </div>
                            @endif
                            @if($nivel->rol_permiso == 2 || $nivel->rol_permiso == 1)
                            <div class="sb-sidenav-menu-heading">Mantenedores</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMantCol" aria-expanded="false" aria-controls="collapseMantCol">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                                Colaboradores
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMantCol" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('area.register')}}">Áreas</a>
                                    <a class="nav-link" href="{{route('cargo.register')}}">Cargos</a>
                                    <a class="nav-link" href="{{route('pension.register')}}">Sistema de Pensiones</a>
                                </nav>
                            </div>
                            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMantAlm" aria-expanded="false" aria-controls="collapseMantAlm">
                                <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
                                Almacén
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMantAlm" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('tipoProd.register')}}">Tipo de Productos</a>
                                    <a class="nav-link" href="{{route('ubicacion.register')}}">Ubicación de Kardex</a>
                                    <a class="nav-link" href="{{route('tipoDoc.register')}}">Tipo de documentos</a>
                                    <a class="nav-link" href="{{route('empresa.register')}}">Proveedores</a>
                                </nav>
                            </div> -->
                            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMantPres" aria-expanded="false" aria-controls="collapseMantPres">
                                <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
                                Presupuestos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMantPres" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('cliente.register')}}">Clientes</a>
                                </nav>
                            </div>
                            <div class="collapse" id="collapseMantPres" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('responsable.register')}}">Responsables</a>
                                </nav>
                            </div> -->
                            @endif
                            @if($nivel->rol_permiso == 1)
                                <div class="sb-sidenav-menu-heading">Administración</div>
                                <a class="nav-link" href="{{route('usuario.inicio')}}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Usuarios
                                </a>
                                <a class="nav-link" href="{{route('rol.register')}}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Roles
                                </a>
                            @endif
                            
                        </div>
                    </div>
                </nav>





