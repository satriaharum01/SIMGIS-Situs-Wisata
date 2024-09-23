<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }} - @yield('title')</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('/images/Laravel.svg') }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 3.3.7 -->
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('main/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('main/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="{{ asset('main/assets/js/font-awesome.min.js') }}" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="{{ asset('main/assets/css/material_round.css') }}" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('main/assets/css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet" />
  <!-- SweetAlert 2 -->
  <script src="{{ asset('dist/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <link rel="{{ asset('dist/sweetalert2/sweetalert2.min.css') }}">
  <!-- Datatables -->
  <link rel="stylesheet" type="text/css" href="{{ asset('main/assets/dataTables/bootstrap-5-5.1.3/css/bootstrap.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('main/assets/dataTables/dataTables-1.13.1/css/dataTables.bootstrap5.css') }}" />


</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="{{ asset('main/assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">DISBUDPARSU</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="{{ (request()->is('dashboard')) ? 'bg-gradient-primary' : '' }} nav-link text-white " href="{{ url('/dashboard') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Master Data</h6>
        </li>
        <li class="nav-item">
          <a class="{{ (request()->is('nodes')) ? 'bg-gradient-primary' : '' }} nav-link text-white " href="{{ url('/nodes') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Data Nodes</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('situs')) ? 'bg-gradient-primary' : '' }} text-white " href="{{ url('/situs') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Data Situs Wisata</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('graf')) ? 'bg-gradient-primary' : '' }} text-white " href="{{ url('/graf') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Data Graf</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">logout</i>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
            </form>
            <span class="nav-link-text ms-1">Log Out</span>
          </a>
        </li>
        <!--
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/virtual-reality.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Data Sample</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/virtual-reality.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Data Sample</span>
          </a>
        </li>
-->
      </ul>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('page')</li>
          </ol>
        </nav>
      </div>
    </nav>
    @yield('content')
    @include('admin.layout.footer')
  </main>
  <!-- jQuery 3 -->
  <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <!--   Core JS Files   -->
  <script src="{{ asset('main/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('main/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('main/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('main/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('main/assets/js/plugins/chartjs.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="{{ asset('main/assets/js/buttons.js') }}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('main/assets/js/material-dashboard.min.js?v=3.0.4') }}"></script>
  <!-- Datatable -->
  <script type="text/javascript" src="{{ asset('main/assets/dataTables/bootstrap-5-5.1.3/js/bootstrap.bundle.js') }}"></script>
  <script type="text/javascript" src="{{ asset('main/assets/dataTables/dataTables-1.13.1/js/jquery.dataTables.js') }}"></script>
  <script type="text/javascript" src="{{ asset('main/assets/dataTables/dataTables-1.13.1/js/dataTables.bootstrap5.js') }}"></script>
  @yield('graph_script')
  @yield('custom_script')
  <script>
    $("body").on("click", ".btn-hapus", function() {
      var x = jQuery(this).attr("data-id");
      var y = jQuery(this).attr("data-handler");
      var xy = x + '-' + y;
      event.preventDefault()
      Swal.fire({
        title: 'Hapus Data ?',
        text: "Data yang dihapus tidak dapat dikembalikan !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          Swal.fire(
            'Data Dihapus!',
            '',
            'success'
          );
          document.getElementById('delete-form-' + xy).submit();
        }
      });
    })

    $("body").on("click", ".btn-simpan", function() {
      Swal.fire(
        'Data Disimpan!',
        '',
        'success'
      ).then(function() {
        $('#compose-form').submit();
      });
    })
  </script>
</body>

</html>