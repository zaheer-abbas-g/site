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

    <div class="container mt-5">
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
                                <span class="text-danger" id="new_password_error"></span>
                            </div>
    
                            <!-- Confirm New Password -->
                            <div class="form-group mb-3">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Re-enter your new password" required>
                                <span class="text-danger" id="confirm_password_error"></span>
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



                
      

        $('#updatePasswordForm').on('submit', function (e) {
             
        e.preventDefault();
        $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')
                }
            });

        // Clear previous error messages
        $('#current_password_error, #new_password_error, #confirm_password_error').text('');

        // Serialize form data
        var formData = $(this).serialize();

        // Make AJAX request
        $.ajax({
            url: '{{ url("profile-password-update") }}', // Update URL for password change
            type: 'PUT',
            data: formData,
            success: function (response) {
                if (response.status === true) {
                    $('#flashMessagePassword').html(
                        `<div class="alert alert-success text-center">${response.message}</div>`
                    );
                    $('#updatePasswordForm')[0].reset(); // Clear form inputs
                }
            },
            
            error: function (xhr) {
    // Check if the response is a valid JSON
    try {
        var response_error = JSON.parse(xhr.responseText); // Manually parse JSON if not already parsed
        
        // Check if message exists in the response
        if (response_error.message) {
            console.log(response_error.message); // Log the message if it exists
            $('#current_password_error').text(response_error.message);

        } else {
            console.log('No message field in response.');
        }

        // Handle validation errors if any
        if (response_error.errors) {
            let errors = response_error.errors;

            // Handle specific field errors
            if (errors.current_password) {
                $('#current_password_error').text(errors.current_password[0]);
            }
            if (errors.new_password) {
                $('#new_password_error').text(errors.new_password[0]);
            }
            if (errors.new_password_confirmation) {
                $('#confirm_password_error').text(errors.new_password_confirmation[0]);
            }
        }

    } catch (e) {
        // Handle cases where response is not a valid JSON
        console.error('Error parsing response:', e);
        console.error('Raw response:', xhr.responseText);
    }
}

        });
   
            setTimeout(function(){
                $('#flashMessagePassword').html('');
            },3000);
                
   

        });

    });
 


    </script>

@endsection