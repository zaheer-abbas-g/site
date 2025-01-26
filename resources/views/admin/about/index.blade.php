@extends('admin.layout.app')

@section('title','about')
@section('content')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>About Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createbrand"
                                data-toggle="modal" data-target="#exampleModalForm" id="createAbout"> Create About</a>
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
                                        <th>Title</th>
                                        <th>Short Description</th>
                                        <th>Long Description</th>
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
										<form class="form-pill" id="aboutForm">
											<div class="form-group  mb-4">
												<label for="exampleTitle" class="ml-3">Title</label>
												<input type="text" class="form-control" name="title"  id="title" aria-describedby="titleHelp" placeholder="Enter title">
												<small id="title_error" class="form-text text-danger ms-2 ml-3"></small>
											</div>
                                            
                                            <div class="form-group mb-4">
												<label for="short_description" class="ml-3">Short Description	</label>
												<input type="text" class="form-control" id="short_description"  name="short_description" aria-describedby="short_description" placeholder="Enter short description">
												<small id="short_description_error" class="form-text text-danger ms-2 ml-3"></small>
											</div>
										 
                                            <div class="form-group mb-4">
												<label for="long_description" class="ml-3">Long Description	</label>
                                                     <textarea name="long_description" id="long_description" cols="20" rows="5" class="form-control"  aria-describedby="long_description" ></textarea>
												<small id="long_description_error" class="form-text text-danger ms-2 ml-3"></small>
											</div>

                                            <div class="form-group mb-4">
												<input type="hidden" class="form-control" id="hidden_id"  name="hidden_id" aria-describedby="hidden_id">
											</div>

										</form>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-danger btn-pill " data-dismiss="modal">Close</button>
                                        <button class="button btn btn-success btn-pill"   id="submitAbout">
                                            <span class="ladda-label">Save</span>
                                        </button>
                                        <button class="button btn btn-primary btn-pill"   id="updateAbout">
                                            <span class="ladda-label">Update</span>
                                        </button>
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

                                getAboutData();
                        ///////////////// Inser About Data /////////////////////////
                                $('#submitAbout').on('click',function(e){
                                    e.preventDefault();
                                    $('#submitAbout').html('Saving...');
                                    var formData = $('#aboutForm').serialize();
                                    $.ajax({
                                        url:"{{ url('admin-about') }}",
                                        type:'POST',
                                        data:formData,
                                        dataType:'JSON',
                                        success:function(response){
                                            console.log(response);

                                            $('#title_error').html('');
                                            $('#short_description_error').html('');
                                            $('#long_description_error').html('');
                                            $('#exampleModalForm').modal('hide');
                                            $('#submitAbout').html('Save');
                                            Swal.fire({
                                                position: "top-end",
                                                icon: "success",
                                                title: response.message,
                                                showConfirmButton: false,
                                                timer: 1500
                                            });

                                            $('#aboutForm')[0].reset();

                                            /////// call index function //////////
                                            getAboutData();

                                        },
                                            error:function(xhr){
                                                var errors = JSON.parse(xhr.responseText);
                                                console.log(errors);
                                                if (errors.errors) {
                                                    $('#title_error').html(errors.errors.title[0]);
                                                    $('#short_description_error').html(errors.errors.short_description[0]);
                                                    $('#long_description_error').html(errors.errors.long_description[0]);
                                                    $('#submitAbout').html('Save');
                                                    console.log(errors.errors.title);
                                                }else{
                                                    console.log('unexpected error formate :', errors);
                                                }
                                                
                                            }
                                    })
                                });
                                
                    ///////////////// Clear Errors when re-click on button ///////////////////
                                $('#createAbout').on('click',function(){
                                    $('#title_error').html('');
                                    $('#short_description_error').html('');
                                    $('#long_description_error').html('');
                                    $('#updateAbout').hide();
                                    $('#submitAbout').show();
                                    $('#title').val('');
                                    $('#short_description').val('');
                                    $('#long_description').val('');
                                });

                    ////////////////// Listing About Data ////////////////////
                                function getAboutData(search = null , pagelink=null){

                                    $.ajax({
                                        url : '{{ url("admin-about") }}',
                                        type: 'GET',
                                        data:{
                                            search_data:search,
                                            pagelink : pagelink
                                        },
                                        dataType:'JSON',
                                        success:function(response){
                                            console.log(response);

                                            let Serial_no = (response.current_page - 1) * 5 + 1;
                                            $('#tablerows').html(''); 
                                            var   tablerows = '';
                                            $.each(response.data.data,function(index,items){
                                                   tablerows  =`<tr> 
                                                                    <td>${Serial_no++}</td> 
                                                                    <td>${items.about_title}</td> 
                                                                    <td>${items.about_short_description}</td> 
                                                                    <td>${items.about_long_description}</td> 
                                                                    <td>
                                                                        
                                                                                <a href="javascript:void(0)" data-id=${items.id}  class="edit btn btn-primary btn-sm editService"  
                                                                                id="aboutedit"><i  class="mdi mdi-pencil-box"></i> </a>
                                                                        
                                                                                <a href="javascript:void(0)" data-id="${items.id}"  class="btn btn-danger btn-sm ml-1 deleteService"><i class="mdi mdi-trash-can" aria-hidden="true"></i></a>
                                                                    </td> 
                                                                </tr>`;
                                                                $('#tablerows').append(tablerows);
                                            })

                                                //////////////  Pagination  ////////////
                                                // Use the helper function to generate pagination and showing message
                                                const paginationData = generatePagination(response);
                                                // Update pagination and showing message in the DOM
                                                $('#pagination').html(paginationData.paginationHtml);
                                                $('#showingMessage').text(paginationData.showingMessage);
                                                if (response.data.total === 0) {
                                                    tablerows = `<tr><td colspan="5" class="text-center"><b>No Record Found</b></td></tr>`;
                                                        // $('#errorMessage').html('No Record Found')
                                                        $('#tablerows').append(tablerows);

                                                }
                                        }
                                        ,
                                        error:function(xhr){
                                            console.log(xhr);
                                        }
                                    })
                                }


                                ////////////// Edit About  /////////////
                                $(body).on('click','#aboutedit',function(){
                                    const about_id = $(this).data('id');
                                    $.ajax({
                                        url:"{{ url('admin-about') }}"+'/'+about_id+'/edit',
                                        type:'get',
                                        success:function(response){
                                            console.log(response);
                                            $('#exampleModalForm').modal('show');
                                            $('#exampleModalFormTitle').html('Edit About');
                                            if (response.about_data) {
                                                console.log('found'); 
                                                $('#hidden_id').val(response.about_id);
                                                $('#title').val(response.about_data.about_title);
                                                $('#short_description').val(response.about_data.about_short_description);
                                                $('#long_description').val(response.about_data.about_long_description);
                                                $('#submitAbout').hide();
                                                $('#updateAbout').show();
                                                $('#title_error').html('');
                                                $('#short_description_error').html('');
                                                $('#long_description_error').html('');
                                            }else{
                                                console.log('no data found');
                                            }
                                        },
                                        error:function(xhr){
                                            console.log(xhr);
                                        }
                                    });
                                });

                                  ////////////// Update About  /////////////
                                $('#updateAbout').on('click',function(e){
                                    e.preventDefault();
                                    $(this).html('Updating...');

                                    var about_id = $('#hidden_id').val();
                                    var formData = $('#aboutForm').serialize();

                                    $.ajax({
                                        url: "{{ url('admin-about') }}"+"/"+about_id,
                                        type:'PUT',
                                        data:formData,
                                        dataType:'JSON',
                                        success:function(response){
                                            $('#updateAbout').html('Update');
                                             $('#exampleModalForm').modal('hide');
                                            $('#aboutForm')[0].reset();
                                                getAboutData();
                                        },
                                        error:function(xhr){
                                            console.log(xhr);
                                        }
                                    });
                                });


                ////////////////  Delete About ////////////////
                $(body).on('click','.deleteService',function(){
                    var about_id = $(this).data('id');
                   
                    Swal.fire({
                    title: "Are you sure?",
                    text: "You want to delete this data",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "delete"
                    }).then((result) => {
                    if (result.isConfirmed) {

                    $.ajax({
                        url: '{{ url("admin-about") }}'+"/"+about_id,
                        type: 'delete',
                        dataType: 'JSON',
                        success:function(response){
                            console.log(response);
                            if (response.status == true) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                        }
                        getAboutData();
                        },
                        error :function(error){
                            console.log(error);
                        }
                    });
                }
            });
        });


                ///////////////// Pagination page link /////////////
                $(body).on('click', '.page-link', function () {
                    var pagelink = $(this).data('page'); 
                    getAboutData(null, pagelink);
                });

             
                /////////////// search /////////////
                $('#search').on('input',function(){
                    var search = $(this).val();
                   
                    console.log(search);
                    if (search) {
                        $('#cancelSearch').show();
                    }else{
                        $('#cancelSearch').hide();
                    }
                    getAboutData(search,null);
                });

                
                // Cancel the search when the "X" icon is clicked
                $('#cancelSearch').on('click', function() {
                    $('#search').val('');
                    $(this).hide();

                    getAboutData(null,'');
                });

        })
        </script>
@endsection

          
					