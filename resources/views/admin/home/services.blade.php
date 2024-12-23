@extends('admin.layout.app')

@section('title','service')



@section('content')


      
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>Services Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createbrand"
                                data-toggle="modal" data-target="#exampleModalGrid" id="createService"> Create Services</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr> 
                                        <th colspan="5">Service</th> 
                                        <th colspan="5">Feature</th> 
                                    </tr>
                                    <tr>
                                        <th>No</th>
                                        <th>Short Description</th>
                                        <th>title</th>
                                        <th>Icon</th>
                                        <th>Long Description</th>
                                        <th>Description</th>
                                        <th>Icon</th>
                                        <th>title</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tablerows">
                                    
                                </tbody>

                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            		<!-- Grid Modal -->
						<div class="modal fade" id="exampleModalGrid" tabindex="-1" role="dialog" aria-labelledby="exampleModalGrid" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title " id="exampleModalLongTitle" class="createTitle">Create Services</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                                        
                                    <div class="modal-header">
                                        <p class="modal-title " id="exampleModalLongTitle1" >Create Services</p>
                                    </div>
                                
									<div class="modal-body">
										<div class="modal-body">
                                            <form id="serviceForm"  class="form-pill">
                                                @csrf
											<div class="container-fluid">
												
                                                <div class="row">
													<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="formGroupServiceDescriptionInput" class="form-label">Short Description</label>
                                                            <input type="text" class="form-control" id="servicedescription" name="servicedescription"
                                                                placeholder="service description">
                                                            <span><small id="servicedescription_error" class="text-danger"></small></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="formGroupFeatureDescriptionInput" class="form-label">Feature Description</label>
                                                            <input type="text" class="form-control" id="featuredescription" name="featuredescription"
                                                                placeholder="feature description">
                                                            <span><small id="featuredescription_error" class="text-danger"></small></span>
                                                        </div>
                                                    </div>
												</div>

												<div class="row">
													<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="formGroupServiceIconInput" class="form-label">Service Icon</label>
                                                         <textarea  cols="50" rows="2" class="form-control" id="serviceicon" name="serviceicon"></textarea> 
                                                            <span><small id="serviceicon_error" class="text-danger"></small></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="formGroupFeatureIconInput" class="form-label">Feature Icon</label>
                                                            <input type="text" class="form-control" id="featureicon" name="featureicon"
                                                                placeholder="featureicon">
                                                            <span><small id="featureicon_error" class="text-danger"></small></span>
                                                        </div>
                                                    </div>
												</div>

												<div class="row">
													<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="formGroupServiceTitleInput" class="form-label">Service title</label>
                                                            <input type="text" class="form-control" id="servicetitle" name="servicetitle"
                                                                placeholder="service title">
                                                            <span><small id="servicetitle_error" class="text-danger"></small></span>
                                                        </div>                                
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="formGroupFeatureTitleInput" class="form-label">Feature title</label>
                                                            <input type="text" class="form-control" id="featuretitle" name="featuretitle"
                                                                placeholder="feature title">
                                                            <span><small id="featuretitle_error" class="text-danger"></small></span>
                                                        </div>                                
                                                    </div>
												</div>
												
												<div class="row">
													<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="formGroupLongDescriptionInput" class="form-label">Long Description</label>
                                                            <textarea  cols="50" rows="2" class="form-control" id="longdescription" name="longdescription"></textarea> 
                                                            <span><small id="longdescription_error" class="text-danger"></small></span>
                                                        </div>
                                                    </div>      
												</div>
											</div>
                                        </form>

										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary btn-pill" id="saveBtn">Save Changes</button>
										<button type="button" class="btn btn-primary btn-pill" id="updateBtn" style="display: none">Update</button>
									</div>
								</div>
							</div>
						</div>
                


        <script>
                $(document).ready(function(){


                    serviceIndex();

                    //////////// clear error messages /////////////
                    $('#createService').on('click',function(){
                        $('#featuredescription_error').html(' ');
                        $('#featureicon_error').html(' ');
                        $('#featuretitle_error').html(' ');
                        $('#longdescription_error').html(' ');
                        $('#servicedescription_error').html(' ');
                        $('#serviceicon_error').html(' ');
                        $('#servicetitle_error').html(' ');
                    });
                    
                    /////////////// Add Service /////////////
                    $('#saveBtn').on('click',function(e){
                        e.preventDefault();
                        
                        $(this).html('Saving...')
                        
                        
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var formData = $('#serviceForm').serialize();
                        $.ajax({
                            url:"{{ route('admin-service.store') }}",
                            type:'POST',
                            data:formData,
                            success:function(response){
                                $('#saveBtn').html('Save Changes');
                                $('#exampleModalGrid').modal('hide');
                                $('#serviceForm')[0].reset()
                               
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                serviceIndex();
                            },
                            error:function(xhr,status,error){
                               var error_s =  JSON.parse(xhr.responseText);
                                       $('#saveBtn').html('Save Changes');
                                       $('#featuredescription_error').html(error_s.errors.featuredescription[0]);
                                       $('#featureicon_error').html(error_s.errors.featureicon[0]);
                                       $('#featuretitle_error').html(error_s.errors.featuretitle[0]);
                                       $('#longdescription_error').html(error_s.errors.longdescription[0]);
                                       $('#servicedescription_error').html(error_s.errors.servicedescription[0]);
                                       $('#serviceicon_error').html(error_s.errors.serviceicon[0]);
                                       $('#servicetitle_error').html(error_s.errors.servicetitle[0]);         
                                      $('#saveBtn').html('Save Changes')
                            }
                        });
                    })


            ////////////////  show Service //////////////
         
             function serviceIndex(){
                
                $.ajax({
                    url:"{{ route('admin-service.index') }}",
                    type:"get",
                    dataType:"json",
                    success:function(response,status,jqXHR){
                        if (jqXHR.status === 200) {
                            var Serial_no = 1;
                            $.each(response.data, function(index, items) {
                                var table_rows = `<tr>
                                                    <td> ${Serial_no++} </td>   
                                                    <td> ${items.short_description} </td>   
                                                    <td> ${items.service_title} </td>   
                                                    <td> ${items.service_icon} </td>   
                                                    <td> ${items.service_description} </td>   
                                                    <td> ${items.feature_description} </td>   
                                                    <td> ${items.featur_icon} </td>   
                                                    <td> ${items.feature_title} </td>   
                                                    <td> <a href="javascript:void(0);" class="editService" data-id="${items.id}">Edit</a></td>

                                                 </tr>`;

                                $('#tablerows').append(table_rows);
                            });
                        }
                        
                    },
                    error:function(xhr,status,error){
                        alert('fail');
                    }

                });
             }


             /////////////////// edit service ////////////////

            //  $(body).on('click',".editService",  function () {
            //     const serviceId = $(this).data('id');
            //     alert(serviceId);
            // });

            $(body).on('click','.editService',function(){
                var serviceid = $(this).data('id');
                
                $.ajax({
                    url:"{{ route('admin-service.edit',':id') }}".replace(':id',serviceid),
                    type:'GET',
                    dataType:'json',
                    success:function(response,status,jqXHR){
                        if (jqXHR.status === 200) {
                            $('#exampleModalGrid').modal('show');
                            $('#exampleModalLongTitle').text('Edit Service');
                            $('#exampleModalLongTitle1').text('Edit Service');
                            $('#saveBtn').hide();
                            $('#updateBtn').show();
                            $('#servicedescription').val(response.data.short_description);
                            $('#featuredescription').val(response.data.feature_description);
                            $('#serviceicon').val(response.data.service_icon);
                            $('#featureicon').val(response.data.featur_icon);
                            $('#servicetitle').val(response.data.service_title);
                            $('#featuretitle').val(response.data.feature_title);
                            $('#longdescription').val(response.data.service_description);
                        }
                    },
                    error:function(xhr,status,error){
                        console.log("Message = "+xhr.responseText);
                    }
                });
            });

            ///////////////// Update ////////////////
            $('#updateBtn').on('click',function(){
                    $(this).html('Updating...');
                    
            })
        })
        </script>

@endsection
