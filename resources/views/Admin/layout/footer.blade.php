
  <!-- Main Footer -->
  <footer class="main-footer text-center">
    Copyright &copy; <a href="{{url('/')}}">{{$setting->copyright}}</a>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{url('/')}}/adminlte/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="{{url('/')}}/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{url('/')}}/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Chart Plugin -->
<script src="{{url('/')}}/adminlte/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE App -->
@if(App::getLocale() == 'en')
<script src="{{url('/')}}/adminlte/js/adminlte.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{url('/')}}/adminlte/js/demo.js"></script>
@endif
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{url('/')}}/adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{url('/')}}/adminlte/plugins/raphael/raphael.min.js"></script>
<script src="{{url('/')}}/adminlte/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{url('/')}}/adminlte/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{url('/')}}/adminlte/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="{{url('/')}}/adminlte/js/pages/dashboard2.js"></script>

<!-- DataTables -->
<script src="{{url('/')}}/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{url('/')}}/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="{{url('/')}}/adminlte/js/script.js"></script>
<script type="text/javascript" src="{{url('/')}}/adminlte/js/moment.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/adminlte/js/datatables.min.js"></script>
<script src="{{url('/')}}/adminlte/js/jquery.datetimepicker.full.min.js"></script>
<script src="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.js"></script>
@stack('js')
</body>
</html>
