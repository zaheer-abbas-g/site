@extends('admin.layout.app')


@section('title','team')
@section('content')
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>Team Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createbrand"
                                data-toggle="modal" data-target="#exampleModalForm" id="createTeam"> Create Team</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">    
                                <tr class="text-center float-right">
                                    <p class="float-right ml-5" style="position: relative;">
                                        Search:
                                        <label style="position: relative;">
                                            <input type="text" class="form-control" id="search" name="search"  placeholder="Search...">
                                            <span id="cancelSearch" style="position: absolute; top: 10px; right: 10px; display: none; cursor: pointer;">
                                                <i class="mdi mdi-close-circle"></i>
                                            </span>
                                        </label>
                                    </p>                                    
                                    
                                 </tr>
                                <thead>     
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Team Description</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Image</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tablerows">
                                    
                                </tbody>

                            </table>  
                        </div>
                            <nav aria-label="Page navigation example" >
                                <ul class="pagination pagination-seperated pagination-seperated-rounded float-left mt-3" id="showingMessage"></ul>
                                <ul class="pagination pagination-seperated pagination-seperated-rounded float-right mt-2" id="pagination">
                                    
                                </ul>
                            </nav>
                     </div>

                     
                </div>

                
    	<!-- Form Modal -->
        <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalFormTitle">Modal Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-pill" id="teamForm" enctype="multipart/form-data">
                       
                            <div class="form-group mb-4">
                                <label for="short_description" class="ml-3">Team Description	</label>
                                <input type="text" class="form-control" id="team_description"  name="team_description" aria-describedby="team_description" placeholder="Enter team description">
                                <small id="team_description_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>
                         
                            <div class="form-group mb-4">
                                <label for="name" class="ml-3">Name</label>
                                     <input type="text" class="form-control" id="name"  name="name" aria-describedby="name_description" placeholder="Enter name">
                                    <small id="name_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="designation" class="ml-3">Designation</label>
                                     <input type="text" class="form-control" id="designation"  name="designation" aria-describedby="designation" placeholder="Enter designation">
                                <small id="designation_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>

                            <div class="form-group mb-2">
                                <label for="image" class="ml-3">image</label>
                                     <input type="file" id="image"  name="image">
                                <small id="image_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>

                            <div class="form-group mb-4 ml-3 position-relative" style="display: inline-block;">
                                    <img src="{{ asset('admin/images/preview.jpg') }}" class="rounded" alt="" width="150" height="150" id="imagePreview" name="imagePreview">
                                    <span id="corssRemove" 
                                    class="position-absolute bg-danger text-white rounded-circle" 
                                    style="top: -5px; right: -5px; width: 24px; height: 24px; cursor: pointer; font-size: 14px; display: none; text-align: center; line-height: 24px;">
                                &times;
                              </span>
                            </div>
                         
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-pill " data-dismiss="modal">Close</button>
                        <button class="button btn btn-success btn-pill"   id="submitAbout">
                            <span class="ladda-label">Save</span>
                        </button>
                        <button class="button btn btn-primary btn-pill"   id="updateAbout" style="display: none">
                            <span class="ladda-label">Update</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
       $(document).ready(function(){
           

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            ///////////////// Create About //////////////////
            $('#createTeam').on('click',function(){
                $('#exampleModalFormTitle').html('Create Team')
                $('#updateAbout').hide()
            });
           
            ///////////////// image  preview //////////////////
            imagePreview('#image','imagePreview','#corssRemove');
          
            $('#submitAbout').on('click',function(e){
                e.preventDefault();
                $('#submitAbout').html('Saving...');

                const  formdata = new FormData($('#teamForm')[0]);
                
                $.ajax({
                    url: '{{ url("admin-team") }}',
                    type: 'POST',
                    data : formdata, 
                    dataType: "JSON",
                    processData:false,
                    contentType:false,
                    success:function(response){
                        console.log(response);
                    $('#submitAbout').html('Save');
                    },
                    error:function(xhr){
                        var error = JSON.parse(xhr.responseText);
                        console.log(error);
                    }
                });
            });
        

        });
    </script>
@endsection
