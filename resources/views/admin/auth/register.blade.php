<!DOCTYPE html>
<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Registration</title>

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

  
  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="assets/plugins/nprogress/nprogress.js"></script>
</head>

</head>
  <body class="bg-light-gray" id="body">
          <div class="container d-flex flex-column justify-content-between vh-100">
          <div class="row justify-content-center mt-5">
            <div class="col-xl-5 col-lg-6 col-md-10">
              <div class="card">
                <div class="card-header bg-secondary text-center rounded-pill">
                    <i class="mdi mdi-account-plus"  style="font-size: 80px; color: #ffffff;"></i>
                </div>
                <div class="card-body p-5">
                  <h4 class="text-dark mb-5 text-center">Sign Up</h4>
                  <form action="" id="registerForm" class="form-pill">
                    <div class="row">
                      <div class="form-group col-md-12 mb-4">
                        <input type="text" class="form-control input-lg" id="name" aria-describedby="nameHelp" placeholder="Name">
                        <span class="text-danger" id="name_error" style="padding-left: 15px;"></span>
                      </div>
                      <div class="form-group col-md-12 mb-4">
                        <input type="email" class="form-control input-lg" id="email" aria-describedby="emailHelp" placeholder="Username">
                        <span class="text-danger" id="email_error" style="padding-left: 15px;"></span>
                      </div>
                      <div class="form-group col-md-12 ">
                        <input type="password" class="form-control input-lg" id="password" placeholder="Password">
                        <span class="text-danger" id="password_error" style="padding-left: 15px;"></span>
                      </div>
                      <div class="form-group col-md-12 ">
                        <input type="password" class="form-control input-lg" id="cpassword" placeholder="Confirm Password">
                        <span class="text-danger" id="cpassword_error" style="padding-left: 15px;"></span>
                      </div>
                      <div class="col-md-12">
                        <div class="d-inline-block mr-3">
                          <label class="control control-checkbox">
                            <input type="checkbox" />
                            <div class="control-indicator"></div>
                            I Agree the terms and conditions
                          </label>
                    
                        </div>
                        <button type="submit" class="btn btn-lg btn-secondary btn-block mb-4 btn-pill" id="singup">Sign Up</button>
                        <p>Already have an account?
                          <a class="text-blue" href="{{ route('login') }}">Sign in</a>
                        </p>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
          <div class="copyright pl-0">
            <p class="text-center">&copy; 2018 Copyright Sleek Dashboard Bootstrap Template by
              <a class="text-primary" href="http://www.iamabdus.com/" target="_blank">Abdus</a>.
            </p>
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
      
              $('#singup').on('click',function(e){
                e.preventDefault();
      
      
              var formData = new FormData($('#registerForm')[0]);
              console.log(formData);
              $.ajax({
                url:"{{ route('register.store') }}",
                type:"POST",
                data:formData,
                processData: false, 
                contentType: false,
                success:function(response){
                  console.log(response);
                    if (response.success == true) {
                      window.location.href = response.redirect_url;
                        console.log('Register success ');
                    } else {
                       console.log('loign failed '+response.message);
                       $('#login_fail').html(response.message)
                       $('#email_error').html('')
                     
                  }
                },
                error:function(xhr){
                    var responseErrors = JSON.parse(xhr.responseText);
                    console.log(responseErrors.errors.email); 
                    $('#email_error').html(responseErrors.errors.email)
                    $('#name_error').html(responseErrors.errors.name)
                    $('#password_error').html(responseErrors.errors.password)
                    $('#cpassword_error').html(responseErrors.errors.cpassword)
                }
              })
              });
          });
      
        </script>
</body>
</html>