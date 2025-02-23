@extends('admin.layout.app')


@section('title','Client')
@section('content')
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>Client Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createbrand"
                                data-toggle="modal" data-target="#exampleModalForm" id="createSkill"> Create Client</a>
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
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Action</th>
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
                        <form class="form-pill" id="ClientForm" enctype="multipart/form-data">
                            <div class="form-group mb-4">
                                <label for="name" class="ml-3">Name</label>
                                     <input type="text" class="form-control" id="name"  name="name" aria-describedby="name_description" placeholder="Enter name">
                                    <small id="name_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>
                            <div class="form-group mb-2">
                                <label for="image" class="ml-3">image</label>
                                     <input type="file" id="image"  name="image">
                                <small id="image_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>
                            <div class="form-group mb-2">
                                     <input type="hidden" id="id"  name="id">
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
                        <button class="button btn btn-success btn-pill"   id="submitClient">
                            <span class="ladda-label">Save</span>
                        </button>
                        <button class="button btn btn-primary btn-pill"   id="updateClient" style="display: none">
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
            
            getClientData();  
             
            ///////////////// Create About //////////////////
              $('#createSkill').on('click',function(){
                $('#exampleModalFormTitle').html('Create Client')
                $('#updateClient').hide()
                $('#name_error').html('');
                $('#image_error').html('');
                $('#ClientForm')[0].reset();
                $('#submitClient').show();
                $('#corssRemove').hide();
                document.getElementById('imagePreview').src ='/admin/images/preview.jpg';
            });

            ///////////////// image  preview //////////////////
            var base_url = "<?php echo 'http://localhost:8000/'; ?>";
            imagePreview('#image','imagePreview','#corssRemove',base_url);


            ///////////////// Save  Clients //////////////////     
            $('#submitClient').on('click',function(e){
                    e.preventDefault();
                    $('#submitClient').html('Saving...');
                        const  formdata = new FormData($('#ClientForm')[0]);
                        console.log(formdata);
                    $.ajax({
                        url: '{{ url("admin-client") }}',
                        type: 'POST',
                        data : formdata, 
                        dataType: "JSON",
                        processData:false,
                        contentType:false,
                        success:function(response){
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        $('#submitAbout').html('Save');
                        $('#exampleModalForm').modal('hide');
                        $('#ClientForm')[0].reset();
                        $('#tablerows').html('');
                        $('#corssRemove').hide();
                        $('#submitClient').html('Save');
                            getClientData();  
                        },
                        error:function(xhr){
                            var error = JSON.parse(xhr.responseText);
                            $('#name_error').html(error.errors.name ? error.errors.name[0]:'');
                            $('#image_error').html(error.errors.image ? error.errors.image[0]:'');     
                            $('#submitClient').html('Save');
                        }
                    });
            });
            
            ///////////////// Team Index //////////////////
            function getClientData(currentpage){
            $.ajax({
                url: '{{ url("admin-client") }}',
                type: 'GET',
                data: {
                    currentPage : currentpage,
                },
                dataType: 'JSON',
                success:function(response){
                    console.log(response);
                    if (response.success === true) {
                        var clientTeble = '';
                        var base_url = '/admin/upload/client';
                        $SN = 1;
                        $('#tablerows').empty();
                            $.each(response.data,function(index,items){
                                clientTeble = `<tr>
                                                <td class="text-center">${$SN++}</td>
                                                <td class="text-center">${items.client_name}</td>
                                                <td class="text-center"><img src="${base_url+'/'+items.client_logo}" class="rounded mx-auto d-block" width="100" height="100"  alt="no img" /></td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)" class="edit btn btn-primary btn-sm  editClient" data-id=${items.id}>
                                                        <i class="mdi mdi-pencil-box"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm ml-1 deleteClient" data-id=${items.id} >
                                                        <i class="mdi mdi-trash-can" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>`; 
                                $('#tablerows').append(clientTeble);
                                
                            });
                                    /////////////  Pagination  ////////////
                                    const paginationData = generatePagination(response);
                                    $('#pagination').html(paginationData.paginationHtml);
                                    $('#showingMessage').text(paginationData.showingMessage);
                                    
                                    if (response.total === 0) {
                                        tablerows = `<tr><td colspan="6" class="text-center"><b>No Record   Found</b></td></tr>`;
                                        $('#tablerows').append(tablerows);
                                    }
                    }else{
                    console.log('No Record Found');
                    }
                },
                error:function(xhr){
                    var error  = xhr.responseText;
                    console.log(error);
                }
            });
            }

            ///////////////// Pagination page link /////////////
            $(body).on('click', '.page-link', function () {
                var currentpage = $(this).data('page'); 
                getClientData(currentpage);
            });

                    
            /////////////// Edit Team ///////////////////
            $(body).on('click','.editClient',function(){
                $('#submitClient').hide();
                $('#updateClient').show();
                $('#name_error').html('');
                $('#image_error').html('');
                var teamid = $(this).data('id');
                $.ajax({
                    url: '{{ url("admin-client") }}'+'/'+teamid+'/edit',
                    type: 'GET',
                    dataType:'JSON',
                    success:function(response){ 
                        console.log(response);
                        if (response.success == true) {
                            var imageURL  = '{{ asset("admin/upload/client/") }}'+"/"+response.data.client_logo;
                            $('#name').val(response.data.client_name);
                            $('#id').val(response.data.id);
                            $('#imagePreview').attr("src",imageURL); 
                        }else{
                            console.log('No DATA fOUND');
                        }
                    },
                    error:function(xhr,status){
                        var error = xhr.responseText;
                        console.log(error.errors);  
                    }
                });
                    $('#exampleModalForm').modal('show');
                    $('#exampleModalFormTitle').html('Edit Client');
            });


            /////////////// Uodate Team ///////////////////
            $('#updateClient').on('click',function(e){
                    e.preventDefault();
                    $('#updateClient').html('Updating...');
                        var formData = new  FormData($('#ClientForm')[0]);
                        const clientId = $('#id').val();
                    // Add _method for proper RESTful routing
                    formData.append('_method', 'PUT');
                    $.ajax({
                        url:"{{ url('admin-client') }}/"+clientId,
                        type: 'POST' ,
                        data: formData,
                        processData : false,
                        contentType :false,
                        success: function(response){
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#name_error').text('');
                            $('#image_error').text('');
                            $('#updateClient').html('Update');
                            $('#exampleModalForm').modal('hide');
                            $('#ClientForm')[0].reset();
                            getClientData();
                        },
                        error:function(xhr,status){
                            const errors = JSON.parse(xhr.responseText);
                            if (errors.errors) {
                                $('#name_error').text(errors.errors.name ? errors.errors.name[0] : '');
                                $('#image_error').text(errors.errors.image ? errors.errors.image[0] : '');
                            } else {
                                console.log("Unexpected error format:", errors);
                            }
                                $('#updateClient').html('Update');
                        }
                    });
            });

            ///////////// Destroy Team //////////////
            $(body).on('click','.deleteClient',function(){
                var clientid = $(this).data('id');
                $.ajax({
                    url:'{{ url("admin-client") }}'+"/"+clientid,
                    type: 'delete',
                    dataType:'json',
                    success:function(response){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        getClientData();
                    },error:function(xhr){
                        console.log(error);
                    }
                })
            });
    });
</script>
        
@endsection
