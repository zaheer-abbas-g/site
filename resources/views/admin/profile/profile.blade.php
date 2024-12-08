@extends('admin.layout.app')
@section('title', 'profile')



@section('content')
    
            <div class="row mt-5">
             
                <div class="col-md-2"> </div>
           
                <div class="col-md-6">
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                     @endif
                
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-secondary text-center text-white">
                            <h5 class="mb-0">Profile Information</h5>
                            <p class="mb-0">Update your account's profile information and email address.</p>
                        </div>
                        <div class="card-body">
                            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
                            </form>
                            <form method="post" action="{{ route('profile.update') }}" class="form-pill">
                                @csrf
                                @method('patch')

                                <div class="form-group mb-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control form-control-lg" id="name" value="{{ old('name', $user->name) }}" placeholder="Enter your Name" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" value="{{ old('email', $user->email) }}" name="email" class="form-control form-control-lg" id="email" placeholder="Enter your email" required>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" id="btn" class="btn btn-secondary btn-pill btn-lg w-100">
                                        save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-secondary text-center text-white">
                            <h5 class="mb-0">Update Password</h5>
                            <p class="mb-0">Ensure your account is using a long, random password to stay secure.
                            </p>
                        </div>
                        <div class="card-body">
                                            
                        <form method="post" action="{{ route('password.update') }}" class="form-pill">
                            @csrf
                            @method('put')
                                
                                <div class="form-group mb-4">
                                    <label for="Current Password" class="form-label">Current Password</label>
                                    <input type="text" name="Current Password" class="form-control form-control-lg" id="Current Password"  required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="New Password" class="form-label">New Password
                                    </label>
                                    <input type="text" name="New Password" class="form-control form-control-lg" id="New Password"  required>
                                </div>
                               
                                <div class="form-group mb-4">
                                    <label for="Confirm Password" class="form-label">Confirm Password
                                    </label>
                                    <input type="text" name="Confirm Password" class="form-control form-control-lg" id="Confirm Password"  required>
                                </div>


                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit"  id="btn" class="btn btn-secondary btn-pill btn-lg w-100">
                                        save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-secondary text-center text-white">
                            <h5 class="mb-0">Delete Account</h5>
                            <p class="mb-0">Once your account is deleted, all of its resources and data will be permanently deleted. 
                            </p>
                        </div>
                        <div class="card-body">
                
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6"  class="form-pill">
                            @csrf
                            @method('delete')

                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit"  id="btn" class="btn btn-secondary btn-pill btn-lg w-100">
                                        Delete Acount
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
               $(document).ready(function() {
                
                document.getElementsByClassName('alert-success')[0].style.display = 'none';
  
                $('#btn').on('click',function(){
                        setTimeout(function() {
                            $('.alert-success').fadeOut('slow');
                        }, 1000);
                });   
            });

            </script>
        @endsection