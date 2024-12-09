<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

 <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
  <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{asset('admin/assets/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
  <link href="{{asset('admin/assets/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
  <link href="{{asset('admin/assets/plugins/flag-icons/css/flag-icon.min.css') }}" rel="stylesheet"/>
  <link href="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
  <link href="{{asset('admin/assets/plugins/ladda/ladda.min.css') }}" rel="stylesheet" />
  <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
  <link href="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />


  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="{{ asset('admin/assets/css/sleek.css') }}" /> 

 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

  <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  {{--  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 

  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>--}}

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
      integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
      crossorigin="anonymous" referrerpolicy="no-referrer" /> 

  <!-- FAVICON -->
  <link href="{{asset('admin/assets/img/favicon.png') }}" rel="shortcut icon" />
  <script src="{{asset('admin/assets/plugins/nprogress/nprogress.js') }}"></script>

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>


<body class="header-fixed sidebar-fixed sidebar-dark header-dark" id="body">
    <script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">

              <!--
                ====================================
                     ——— LEFT SIDEBAR INCLUDE ——— 
                ===================================== 
              -->
                  @include('admin.includes.sidebar')
        

            <div class="page-wrapper">
                 
                <!-- 
                =======================
                 ——— Header include ———
                =======================
                -->
                @include('admin.includes.header')

             <div class="content-wrapper">
           
                <!-- 
                =======================
                 ——— Main content ———
                =======================
                -->
                <div class="content">						 
                    @yield('content') 
                </div>


                <!-- 
                =======================
                ——— Footer include ———
                =======================
                -->
               @include('admin.includes.footer')
      </div>
    </div>
    </div>

    

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM" defer></script>
 {{-- <script src="{{asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script> --}}
<script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('admin/assets/plugins/toaster/toastr.min.js') }}"></script>
<script src="{{asset('admin/assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
<script src="{{asset('admin/assets/plugins/charts/Chart.min.js') }}"></script>
<script src="{{asset('admin/assets/plugins/ladda/spin.min.js') }}"></script>
<script src="{{asset('admin/assets/plugins/ladda/ladda.min.js') }}"></script>
<script src="{{asset('admin/assets/plugins/jquery-mask-input/jquery.mask.min.js') }}"></script>
<script src="{{asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
<script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
<script src="{{asset('admin/assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{asset('admin/assets/plugins/jekyllsearch.min.js') }}"></script>
<script src="{{asset('admin/assets/js/sleek.js') }}"></script>
<script src="{{asset('admin/assets/js/chart.js') }}"></script>
<script src="{{asset('admin/assets/js/date-range.js') }}"></script>

<script src="{{asset('admin/assets/js/map.js') }}"></script>
<script src="{{asset('admin/assets/js/custom.js') }}"></script> 



    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>
</html>
