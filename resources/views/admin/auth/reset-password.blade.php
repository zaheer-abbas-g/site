
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Reset Password</title>

  
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
  <!-- FAVICON -->
  <link href="{{asset('admin/assets/img/favicon.png') }}" rel="shortcut icon" />



</head>


  <body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
   

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">
      <div class="page-wrapper">
 
        <div class="content-wrapper">
          <div class="content">						
        
            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                            
                  
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-secondary text-center text-white">
                            <h5 class="mb-0">Reset Your Password</h5>
                          
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}" class="form-pill">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" id="email"  class="form-control form-control" name="email"   autofocus>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <div class="form-group mb-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Enter your email" required>
                                </div> --}}

                           

                                <div class="form-group mb-4">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" id="password" name="password"  class="form-control form-control"  >
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                               
                                                            
                                <div class="form-group mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control"   >
                                </div>

                               
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-secondary btn-pill btn-lg w-100" >
                                        Reset Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>					
      </div>
      </div>
        

     
     
      <script src="{{asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script> 
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
         


      <script>
       $(document).ready(function () {
       
          setTimeout(function () {
             
              $('.falshmessage').fadeOut('fast', function () {
                  $(this).remove();
              });
              }, 500);
          });
        
     
      </script>
  </body>
</html>
