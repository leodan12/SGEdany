<?php echo Html::script('js/jquery.js')?>
  <?php echo Html::script('js/bootstrap.min.js')?>
  <!-- nice scroll -->
  <?php echo Html::script('js/jquery.scrollTo.min.js')?>
  <?php echo Html::script('js/jquery.nicescroll.js')?>
  <!--custome script for all page-->
  <?php echo Html::script('js/scripts_2.js')?>
  <?php echo Html::script('js/scripts.js')?>

  <?php echo Html::script('js/jquery-1.12.4.min.js')?>
  
  <?php echo Html::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js')?>
  <?php echo Html::script('https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0')?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

<!-- DATA TABLES -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bulma.min.js" ></script>


<?php echo Html::script('js/traducir/dataTable-spanish.js')?>

<!-- jQuery full calendar -->
<?php echo Html::script('js/fullcalendar.min.js')?>

    @yield('styles')
      <meta name="_token" content="{!! csrf_token() !!}">
      <script type="text/javascript">
          var APP_URL = {!! json_encode(url('/')) !!};
      </script>
