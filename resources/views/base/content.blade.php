<html lang="en">

    @include("base.title")
    <body class="sb-nav-fixed">
        <!--header start-->
        @include('base.header')
        <!-- container section start -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <!--sidebar start-->
                @include('base.aside')
                <!--sidebar end-->
            </div>

            <div id="layoutSidenav_content">
                <main>
                    @yield('contenido')
                </main>
                
            </div>
        </div>

        <!-- container section end -->
        <!-- javascripts -->
        @include('base.scripts')
      <!-- Código de instalación Cliengo para gmail.com  <script type="text/javascript">(function () { var ldk = document.createElement('script'); ldk.type = 'text/javascript'; ldk.async = true; ldk.src = 'https://s.cliengo.com/weboptimizer/63c5799996f540002a8962c6/63c5799b96f540002a8962c9.js?platform=dashboard'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ldk, s); })();</script>  -->

    </body>
</html>