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
                                            <input type="text" class="form-control" id="search" placeholder="Search...">
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
										</form>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-danger btn-pill " data-dismiss="modal">Close</button>
                                        <button class="ladda-button btn btn-success btn-pill btn-square btn-ladda" data-style="contract"  id="submitAbout">
                                            <span class="ladda-label">Submit!</span>
                                            <span class="ladda-spinner"></span>
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

                                $('#submitAbout').on('click',function(e){
                                    e.preventDefault();
                                    var formData = $('#aboutForm').serialize();
                                    $.ajax({
                                        url:"{{ url('admin-about') }}",
                                        type:'POST',
                                        data:formData,
                                        dataType:'JSON',
                                        success:function(response){
                                        console.log(response);
                                        },
                                            error:function(xhr){
                                                var errors = JSON.parse(xhr.responseText);
                                                console.log(errors);
                                                if (errors.errors) {
                                                    $('#title_error').html(errors.errors.title[0]);
                                                    $('#short_description_error').html(errors.errors.short_description[0]);
                                                    $('#long_description_error').html(errors.errors.long_description[0]);
                                                    console.log(errors.errors.title);
                                                }else{
                                                    console.log('unexpected error formate :', errors);
                                                }
                                                
                                            }
                                    })
                                });
                            })
                    </script>
@endsection

          
					