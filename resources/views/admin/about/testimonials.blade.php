@extends('admin.layout.app')


@section('title','testimonials')
@section('content')
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>Testimonials Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createbrand"
                                data-toggle="modal" data-target="#exampleModalForm" id="createTestimonials"> Create Testimonials</a>
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
                                        <th>Designation</th>
                                        <th>Description</th>
                                        <th>Image</th>
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
                        <form class="form-pill" id="testimonialsForm" enctype="multipart/form-data">
                            
                            <div class="form-group mb-4">
                                <label for="name" class="ml-3">Name</label>
                                     <input type="text" class="form-control" id="name"  name="name" aria-describedby="name_description" placeholder="Enter name">
                                    <small id="name_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>
                            <div class="form-group mb-4">
                                <label for="short_description" class="ml-3"> Description	</label>
                                <input type="text" class="form-control" id="long_description"  name="long_description" aria-describedby="long_description" placeholder="Enter team description">
                                <small id="long_description_error" class="form-text text-danger ms-2 ml-3"></small>
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
        
        getTestimonialData();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            ///////////////// Create About //////////////////
            $('#createTestimonials').on('click',function(){
                $('#exampleModalFormTitle').html('Create Team')
                $('#updateAbout').hide()
                $('#name_error').html('');
                $('#designation_error').html('');
                $('#long_description_error').html('');
                $('#image_error').html('');
                $('#testimonialsForm')[0].reset();
                $('#submitAbout').show();
                $('#corssRemove').hide();
                document.getElementById('imagePreview').src ='/admin/images/preview.jpg';
            });

            ///////////////// image  preview //////////////////
            var base_url = "<?php echo 'http://localhost:8000/'; ?>";
            imagePreview('#image','imagePreview','#corssRemove',base_url);
      
            ///////////////// Submit Testimonials //////////////////
            $('#submitAbout').on('click',function(e){
                e.preventDefault();
                $('#submitAbout').html('Saving...');
                const  formdata = new FormData($('#testimonialsForm')[0]);
                $.ajax({
                    url: '{{ url("admin-testimonial") }}',
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
                       $('#testimonialsForm')[0].reset();
                       $('#tablerows').html('');
                       $('#corssRemove').hide();
                       getTestimonialData();  
                    },
                    error:function(xhr){
                        var error = JSON.parse(xhr.responseText);
                        $('#name_error').html(error.errors.name ? error.errors.name[0]: '');
                        $('#designation_error').html(error.errors.designation ? error.errors.designation[0]:'');
                        $('#long_description_error').html(error.errors.long_description ? error.errors.long_description[0] : '');
                        $('#image_error').html(error.errors.image ? error.errors.image[0] :'');
                        $('#submitAbout').html('Save');
                    }
                });
            });

             ///////////////// Testimonials Listing //////////////////
             function getTestimonialData(currentpage){
                $.ajax({
                    url: '{{ url("admin-testimonial") }}',
                    type: 'GET',
                    data: {
                        currentPage : currentpage,
                    },
                    dataType: 'JSON',
                    success:function(response){
                        console.log(response);
                        if (response.success === true) {
                            var teamTeble = '';
                            var base_url = '/admin/upload/testimonials';
                              $SN = 1;
                              $('#tablerows').empty();
                                $.each(response.data,function(index,items){
                                    teamTeble = `<tr>
                                                    <td class="text-center">${$SN++}</td>
                                                    <td class="text-center">${items.name}</td>
                                                    <td class="text-center">${items.designation}</td>
                                                    <td class="text-center">${items.long_description}</td>
                                                    <td class="text-center"><img src="${base_url+'/'+items.image}" class="rounded mx-auto d-block" width="100" height="100"  alt="no img" /></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="edit btn btn-primary btn-sm  editTestimonials" data-id=${items.id}>
                                                            <i class="mdi mdi-pencil-box"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm ml-1 deletetestimonials" data-id=${items.id} >
                                                            <i class="mdi mdi-trash-can" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>`; 
                                    $('#tablerows').append(teamTeble);
                                });

                                ///////////////////// Pagination ///////////////
                                const paginationData = generatePagination(response);
                                // Update pagination and showing message in the DOM
                                $('#pagination').html(paginationData.paginationHtml);
                                $('#showingMessage').text(paginationData.showingMessage);
                                if (response.total === 0) {
                                    tablerows = `<tr><td colspan="6" class="text-center"><b>No Record Found</b></td></tr>`;
                                        // $('#errorMessage').html('No Record Found')
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
                getTestimonialData(currentpage);
            });
            
            /////////////// Edit Testimonials ///////////////////
            $(body).on('click','.editTestimonials',function(){
                    $('#submitAbout').hide();
                    $('#updateAbout').show();
                    $('#name_error').html('');
                    $('#designation_error').html('');
                    $('#team_description_error').html('');
                    $('#image_error').html('');
                var testimonialsid = $(this).data('id');
                $.ajax({
                    url: '{{ url("admin-testimonial") }}'+'/'+testimonialsid+'/edit',
                    type: 'GET',
                    dataType:'JSON',
                    success:function(response){ 
                        if (response.success == true) {
                            var imageURL  = '{{ asset("admin/upload/testimonials/") }}'+"/"+response.data.image;
                            $('#name').val(response.data.name);
                            $('#designation').val(response.data.designation);
                            $('#long_description').val(response.data.long_description);
                            $('#imagePreview').attr("src",imageURL); 
                            $('#id').val(response.data.id);
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
                $('#exampleModalFormTitle').html('Edit Team');
            });

            /////////////// Uodate Testimonials ///////////////////
            $('#updateAbout').on('click',function(e){
                   e.preventDefault();

                   $('#updateAbout').html('Updating...');
                    var formData = new  FormData($('#testimonialsForm')[0]);
                    const teamId = $('#id').val();
                 // Add _method for proper RESTful routing
                    formData.append('_method', 'PUT');
                    $.ajax({
                            url:"{{ url('admin-testimonial') }}/"+teamId,
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
                                $('#designation_error').text('');
                                $('#long_description_error').text('');
                                $('#image_error').text('');
                                $('#updateAbout').html('Update');
                                $('#exampleModalForm').modal('hide');
                                $('#testimonialsForm')[0].reset();
                                getTestimonialData();
                            },
                            error:function(xhr,status){
                                const errors = JSON.parse(xhr.responseText);
                                if (errors.errors) {
                                    $('#name_error').text(errors.errors.name ? errors.errors.name[0] : '');
                                    $('#long_description_error').text(errors.errors.long_description ? errors.errors.long_description[0] : '');
                                    $('#designation_error').text(errors.errors.designation ? errors.errors.designation[0] : '');
                                    $('#image_error').text(errors.errors.image ? errors.errors.image[0] : '');
                                } else {
                                    console.log("Unexpected error format:", errors);
                                }
                                 $('#updateAbout').html('Update');
                            }
                    });
            });

            ///////////// Destroy Team //////////////
            $(body).on('click','.deletetestimonials',function(){
                      var testimonialsid = $(this).data('id');
                      $.ajax({
                          url:'{{ url("admin-testimonial") }}'+"/"+testimonialsid,
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
                              getTestimonialData();
                          },error:function(xhr){
                              console.log(error);
                          }
                      })
            });
    });

</script>


    @endsection
