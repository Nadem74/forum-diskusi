<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Disku</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  {{-- <link rel="stylesheet" href="{{ asset('user/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> --}}

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::to('assets/dist/css/adminlte.min.css') }}">

   <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
 
  @yield('header')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->

  <!-- Navbar -->
  @include('layout.partials.nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layout.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  style="background:#e8eaf6; ">
    <div class="row mr-0 pl-3">
      <!-- Main content -->
      <div class="col-md-12 mt-5 pt-6">
        {{-- @include('layouts.partials.tweet_modal') --}}
        @yield('content')
      </div>

      <!-- /.content -->
      <!-- Right sidebar -->
      {{-- @include('layout.partials.right_sidebar') --}}
      <!--/. Right sidebar -->
    </div>
    <!-- /row -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ URL::to('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::to('assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ URL::to('assets/dist/js/demo.js') }}"></script> --}}

<!-- DataTables  & Plugins -->
<script src="{{ URL::to('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ URL::to('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ URL::to('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ URL::to('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ URL::to('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

<script src="{{ URL::to('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ URL::to('assets/plugins/jszip/jszip.min.js') }}"></script>

<script src="{{ URL::to('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>

<script src="{{ URL::to('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>

<script src="{{ URL::to('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

<script src="{{ URL::to('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>

<script src="{{ URL::to('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<!-- jQuery -->
{{-- <script src="{{ asset('user/plugins/jquery/jquery.min.js') }}"></script> --}}
<!-- Bootstrap 4 -->
{{-- <script src="{{ asset('user/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
<!-- overlayScrollbars -->
{{-- <script src="{{ asset('user/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
<!-- AdminLTE App -->
{{-- <script src="{{ asset('user/js/adminlte.min.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('user/js/demo.js') }}"></script> --}}
@include('sweetalert::alert')
@yield('footer')
</body>
</html>
