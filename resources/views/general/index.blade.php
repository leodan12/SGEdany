
<!DOCTYPE html>
<html lang="en">
   @include('base.title')
    <body class="sb-nav-fixed">
        @include('base.header')
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('base.aside')
            </div>
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid px-4">  
                    <h2>INICIO</h2>
                    
                    <div class="row">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Avisos</li>
                    </ol>
                            @if($alerta=='SI')
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-danger text-white mb-4">
                                        <div class="card-body"><strong>PLANILLAS</strong></div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <p class="card-text">Aún no se ha generado la planilla del mes actual.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div> 
                        <div class="row">
                        <h1>"Nuestro trabajo, siempre el mejor"</h1>
                        <h3>RESWORK E.I.R.L.</h3>
                    </div>  
                </div>  
                </main>
                
            </div>
        </div>
        @include('base.scripts')
        
    </body>
</html>
