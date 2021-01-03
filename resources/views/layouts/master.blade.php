<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') - BPJS Ketenagakerjaan</title>

  <link rel="icon" href="{{ asset('img/bpjs2.png') }}">

  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
  <link rel="stylesheet" href="{{ asset("dist/bootstrap/css/bootstrap.min.css") }}">

  {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> --}}
  <link rel="stylesheet" href="{{ asset("dist/fontawesome/css/all.min.css") }}">

  <link rel="stylesheet" href="{{ asset('css/app.css')}}">
  <link rel="stylesheet" href="{{ asset('css/custom.css')}}">

  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('dist/owl.carousel/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/owl.carousel/dist/assets/owl.theme.default.min.css') }}">

  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('dist/datatable/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">

  {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}
  <link rel="stylesheet" href="{{ asset("dist/daterangepicker/daterangepicker.css") }}">
  
  <link rel="stylesheet" href="{{ asset("dist/sweetalert2/dist/sweetalert2.min.css") }}">

  <script src="{{ asset('js/app.js')}}"></script>
</head>

<body>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

        {{-- 
          ||
          ========= Top navbar  
          ||
          --}}

        @include('layouts.topnav')

        {{-- 
          ||
          ========= side navbar  
          ||
          --}}

          @include('layouts.sidenav')


          <div class="main-content" style="overflow: hidden">

            @yield('content')

          </div>

        </div>

        <footer class="main-footer">
          <div class="footer-left">
            Copyright &copy; <span id="year"></span> BPJS Ketenagakerjaan Cabang Bogor 
          </div>
        </footer>
      </div>
    </div>
  </div>

  {{-- custom --}}
  <script src="{{ asset("js/horiscroll.js") }}"></script>

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}
  {{-- <script src="{{ asset("dist/popperjs/dist/umd/popper.min.js") }}"></script> --}}

  {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
  <script src="{{ asset("dist/bootstrap/js/bootstrap.min.js") }}"></script>

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script> --}}
  <script src="{{ asset("dist/nicescroll/jquery.nicescroll.min.js") }}"></script>

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment-with-locales.min.js" integrity="sha512-EATaemfsDRVs6gs1pHbvhc6+rKFGv8+w4Wnxk4LmkC0fzdVoyWb+Xtexfrszd1YuUMBEhucNuorkf8LpFBhj6w==" crossorigin="anonymous"></script> --}}
  <script src="{{ asset("dist/moment/min/moment-with-locales.min.js") }}"></script>

  {{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}
  <script src="{{ asset("dist/datatable/datatable.net/js/jquery.dataTables.min.js") }}"></script>
  <script src="{{ asset("dist/datatable/datatables.net-bs4/js/dataTables.bootstrap4.min.js") }}"></script>

  
  <script src="{{ asset('js/stisla.js') }}"></script>


  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script> --}}
  <script src="{{ asset("dist/chart.js/dist/Chart.min.js") }}"></script>


  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script> --}}
  <script src="{{ asset("dist/owl.carousel/dist/owl.carousel.min.js") }}"></script>


  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chocolat/1.0.1/js/chocolat.min.js"></script> --}}
  <script src="{{ asset("dist/chocolat/dist/js/chocolat.js") }}"></script>

  {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
  <script src="{{ asset("dist/sweetalert2/dist/sweetalert2.min.js") }}"></script>


  @yield('script')

  <!-- Template JS File -->

  <script src="{{ asset('js/scripts.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>


  {{-- Setup default --}}
  <script>

    $(document).ready(function() {

      // year footer
      $('#year').html(new Date().getFullYear());
      
    })

  </script>
  
</body>

</html>