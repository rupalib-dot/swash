<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; {{date('Y')}} <a href="{{route('home')}}">Swash</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <!-- <b>Version</b> 3.1.0 -->
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('public/styles/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('public/styles/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/styles/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/styles/admin/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('public/styles/admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('public/styles/admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('public/styles/admin/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('public/styles/admin/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('public/styles/admin/plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/styles/admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/styles/admin/dist/js/pages/dashboard2.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script src="{{asset('public/styles/admin/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS --> 
<script src="{{asset('public/styles/admin/js/dashboard/dash_1.js')}}"></script> 
<script src="{{asset('public/styles/admin/js/form-validation.min.js')}}"></script> 

</body>
</html>