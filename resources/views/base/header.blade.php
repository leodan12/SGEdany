<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!--logo start-->
    <a href="{{route('home')}}" class="logo">SISTEMA DE GESTIÓN <span class="lite"></span></a>
    <!--logo end-->

            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="opciones" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="opciones">
                        <li><a class="dropdown-item" href="{{route('usuario.perfil')}}">Perfil</a></li>
                        <?php $colaborador = App\Model\Colaborador::where('idPersona',Auth::user()->idPersona)->first();
                        ?>
                        @if($colaborador !== null)
                            <li><a class="dropdown-item" href="{{route('usuario.reg')}}">Registro</a></li>
                        @endif
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
          
        </nav>

