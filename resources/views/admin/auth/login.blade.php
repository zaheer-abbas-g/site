<!DOCTYPE html>
<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>login</title>

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
  <script src="{{asset('admin/assets/plugins/nprogress/nprogress.js') }}"></script>
  <style>
    .align-left {
    text-align: left;
    display: block; /* Ensures alignment works properly */
}
  </style>
</head>

</head>
  <body class="bg-light-gray" id="body">
      <div class="container d-flex flex-column justify-content-between vh-100">
      <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
          <div class="card">
            <div class="card-header bg-secondary text-center rounded-pill">
              <i class="mdi mdi-account-circle" style="font-size: 80px; color: #ffffff;"></i> 
             </div>
          
            <div class="card-body p-5">

              <h4 class="text-dark text-center ">Sign In</h4>
           
              <div  id="registermsge" > </div>

              <h4 class="text-dark text-center" style="margin-bottom: 20px;">
                <span class="text-danger" id="login_fail" style="display: inline-block; padding-left: 33px;"></span>
              </h4>
              <form method="POST" action="{{ route('login') }}" id="loginForm" class="form-pill">
                @csrf
                <div class="row">
                  
                  <div class="form-group col-md-12 mb-4">
                    <input type="email"  type="email" name="email"   class="form-control input-lg" id="email" aria-describedby="emailHelp" placeholder="Email">
                    <span class="text-danger" id="email_error" style="padding-left: 15px;"></span>

                  </div>
                 
                  <div class="form-group position-relative col-md-12 ">
                    <input type="password" class="form-control input-lg pr-5" name="password" id="password" placeholder="Password" > 
                  <i 
                      class="mdi mdi-eye position-absolute" 
                      id="passwordToggle" 
                      style="top: 50%; right: 30px; transform: translateY(-100%); cursor: pointer;">
                  </i>
                    <span class="text-danger" id="email_password_error" style="padding-left: 15px;">
                      
                    </span>
                  </div>

                  <div class="col-md-12">
                      <div class="d-flex my-2 justify-content-between">
                        <div class="d-inline-block mr-3">
                          <label class="control text-secondary control-checkbox">Remember me
                            <input type="checkbox" />
                            <div class="control-indicator"></div>
                          </label>
                  
                        </div>
                        <p><a class="text-secondary" href="{{ route('password.request') }}">Forgot Your Password?</a></p>
                      </div>
                      <button type="submit" class="btn btn-lg btn-secondary btn-block mb-4 btn-pill" id="signIn">Sign In</button>
                      <p>Don't have an account yet ?
                        <a class="text-secondary" href="{{ route('register') }}">Sign Up</a>
                      </p>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM" defer></script>
   <script src="{{asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script> 
   <script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{asset('admin/assets/plugins/toaster/toastr.min.js') }}"></script>
   <script src="{{asset('admin/assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
   {{-- <script src="{{asset('admin/assets/plugins/charts/Chart.min.js') }}"></script> --}}
   {{-- <script src="{{asset('admin/assets/plugins/ladda/spin.min.js') }}"></script> --}}
   {{-- <script src="{{asset('admin/assets/plugins/ladda/ladda.min.js') }}"></script> --}}
   {{-- <script src="{{asset('admin/assets/plugins/jquery-mask-input/jquery.mask.min.js') }}"></script> --}}
   {{-- <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js') }}"></script> --}}
   <script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
   {{-- <script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script> --}}
   <script src="{{asset('admin/assets/plugins/daterangepicker/moment.min.js') }}"></script>
   <script src="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
   <script src="{{asset('admin/assets/plugins/jekyllsearch.min.js') }}"></script>
   <script src="{{asset('admin/assets/js/sleek.js') }}"></script>
   <script src="{{asset('admin/assets/js/chart.js') }}"></script>
   <script src="{{asset('admin/assets/js/date-range.js') }}"></script>
   <script src="{{asset('admin/assets/js/map.js') }}"></script>
   <script src="{{asset('admin/assets/js/custom.js') }}"></script> 

   <script>

    
    $(document).ready(function(){
     

   
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      const urlParams = new URLSearchParams(window.location.search);
              const message = urlParams.get("message");

              if (message) {
                  $('#registermsge').append(` <div class="alert alert-success text-center  mt-2" id="registermsge" role="alert">${message} </div>`);
              }

        $('#signIn').on('click',function(e){
          e.preventDefault();


        var formData = new FormData($('#loginForm')[0]);
        console.log(formData);
        $.ajax({
          url:"{{ route('login.store') }}",
          type:"POST",
          data:formData,
          processData: false, 
          contentType: false,
          success:function(response){
            console.log(response);
              if (response.success == true) {
                window.location.href = response.redirect_url;
                  console.log('loign success ');
              } else {
                 console.log('loign failed '+response.message);
                 $('#login_fail').html(response.message)
                 $('#email_error').html('')
                $('#email_password_error').html('')
            }
          },
          error:function(xhr){
              var responseErrors = JSON.parse(xhr.responseText);
              console.log(responseErrors.errors.email); 
              $('#email_error').html(responseErrors.errors.email)
              $('#email_password_error').html(responseErrors.errors.password)
              $('#login_fail').html('');
          }
        })
        });


        /////// Password Toggle //////////
        $('#passwordToggle').on('click',function(){
          var input = document.getElementById('password');
          if (input.type === 'password') {
              input.type = 'text';
          }else{
            input.type = 'password';
          }
        })
    });

  </script>

</body>
</html>