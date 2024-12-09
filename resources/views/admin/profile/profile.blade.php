@extends('admin.layout.app')
@section('title','profile')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center  mb-5">
    <div class="col-md-6">
    <div id="flashMessageContainer"></div> 

    <div class="card">
        <div class="card-header bg-secondary text-white">
            <p class="text-white text-center">Update User Profile </p>             
        </div>
        <div class="card-body">
            <form id="userProfileForm"  class="form-pill">
                @csrf
                @method('PUT') 
                <div class="form-group">
                    <label for="username">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        placeholder="user name" required>
                    <span><small id="username_error" class="text-danger"></small></span>
                </div>

                <div class="form-group">
                    <label for="useremail">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        placeholder="usere mail" required>
                    <span><small id="useremail_error" class="text-danger"></small></span>
                </div>  

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-sm btn-primary" id="userprofilebtn"  value="Save" name="userprofilebtn">
                </div>
            </form>
        </div>   
   </div>
</div>
</div> 


    {{-- user update password --}}

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div id="flashMessagePassword"></div> 
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <p class="text-center">Update Password</p>
                </div>
                <div class="card-body">
                    <form id="updatePasswordForm" class="form-pill">
                        <!-- Current Password -->
                        <div class="form-group mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter your current password" required>
                            <span class="text-danger" id="current_password_error"></span>
                        </div>

                        <!-- New Password -->
                        <div class="form-group mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter your new password" required>
                            <span id="new_password_error"></span>

                        </div>

                        <!-- Confirm New Password -->
                        <div class="form-group mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-enter your new password" required>
                            <span id="confirm_password_error"></span>

                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-sm btn-primary" id="userupdatepasswordbtn"  value="Save" name="userupdatepasswordbtn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 




<script>
    $(document).ready(function(){
        
        $('#userProfileForm').on('submit',function(e){
            e.preventDefault();

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')
                }
            });

        var formData =  $('#userProfileForm').serialize();
           
          
            $.ajax({
                url:'{{ url("profile-update") }}',
                type:'PUT',
                data:formData,
                success:function(response){

                if (response.status == true) {
                        $('#flashMessageContainer').html(
                            `<div class="alert alert-success text-center">${response.message}</div>`
                        );
                    }
                    console.log(response);
                },
                error:function(error_response){
                    var error = JSON.parse(xhr.error_response);
                    console.log(error);
                }
            })

            setTimeout(function(){
                 $('#flashMessageContainer').html('');
            },2000);
          
        });



                
        $('#updatePasswordForm').on('submit',function(e){
            e.preventDefault();

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')
                }
            });

        var formData =  $('#updatePasswordForm').serialize();
          
            $.ajax({
                url:'{{ url("profile-password-update") }}',
                type:'PUT',
                data:formData,
                success:function(response){
                    if (response.status == true) {
                        $('#flashMessagePassword').html(
                            `<div class="alert alert-success text-center">${response.message}</div>`
                        );
                    } if(response.status == false){
                        $('#current_password_error').html(response.message);
                    }

                    console.log(response);
                },
                error:function(xhr){
                    var errorResponse  = JSON.parse(xhr.responseText);
                    $('#current_password_error').html(errorResponse.errors.message);
                }
            })
            setTimeout(function(){
                 $('#flashMessagePassword').html('');
            },3000);
          
        });



        
    });
    </script>

@endsection