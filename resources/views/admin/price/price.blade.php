@extends('admin.layout.app')


@section('title','Price')
@section('content')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>Price Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createprice"
                                data-toggle="modal" data-target="#exampleModalForm" id="createPrice"> Create Price</a>
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
                                        <th>name</th>                                
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Features</th>
                                        <th>Status Action</th>
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
                        <form class="form-pill" id="PriceForm">
                           
                            <div class="form-group mb-4">
                                <label for="name" class="ml-3">Name</label>
                                     <input type="text" class="form-control" id="name"  name="name" aria-describedby="name_description" placeholder="Enter name">
                                    <small id="name_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="price" class="ml-3">Price</label>
                                <input 
                                type="text" 
                                class="form-control" 
                                id="Price" 
                                name="Price" 
                                aria-describedby="price"
                              >
                                 <small id="price_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="duration" class="ml-3">Duration</label>
                                     <input type="text" class="form-control" id="duration"  name="duration" aria-describedby="duration" placeholder="Enter duration">
                                    <small id="duration_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="features" class="ml-3">Features</label>
                                    <textarea  cols="50" rows="2" class="form-control" id="features" name="features"></textarea> 
                                <span><small id="features_error" class="text-danger ms-2 ml-3"></small></span>
                            </div>

                            <div class="form-group mb-2">
                                 <input type="hidden" id="id"  name="id">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-danger btn-pill " data-dismiss="modal">Close</button>
                        <button class="button btn btn-success btn-pill"   id="submitPrice">
                            <span class="ladda-label">Save</span>
                        </button>
                        <button class="button btn btn-primary btn-pill"   id="updatePrice" style="display: none">
                            <span class="ladda-label">Update</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
      $(document).ready(function(){

            getPrice();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            }); 


            ///////////////// Create Price //////////////////
            $('#createPrice').on('click',function(){
                $('#exampleModalFormTitle').html('Create Faq')
                $('#updatePrice').hide();
                $('#submitPrice').show();
                $('#name_error').text('');
                $('#price_error').text('');
                $('#duration_error').text('');
                $('#features_error').text('');
                $('#PriceForm')[0].reset();
            });

            
           ///////////// Store Price //////////
           $('#submitPrice').on('click',function(e){
                e.preventDefault();
                $(this).html('Saving...');
                
                $('#name_error').text(' ');
                $('#price_error').text(' ');
                $('#duration_error').text(' ');
                $('#features_error').text(' ');

                var formData = $('#PriceForm').serialize();
                $.ajax({
                    url : "{{ url('admin-price') }}",
                    type: "POST",
                    data: formData,
                    dataType:'JSON',
                    success:function(response){
                        if (response.status === true) {  
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });    
                            $('#exampleModalForm').modal('hide');
                            $('#name_error').text(' ');
                            $('#price_error').text(' ');
                            $('#duration_error').text(' ');
                            $('#features_error').text(' ');
                            $('#PriceForm')[0].reset();
                            $('#submitPrice').html('Save');
                             getPrice();
                        }else{
                            console.log(" Error ="+response.error+" Message ="+ response.message);
                        }
                    },error:function(xhr){
                        var error = JSON.parse(xhr.responseText);
                        if (error.errors) {
                            if (error.errors.name) {
                                $('#name_error').text(error.errors.name[0]);
                            } if (error.errors.Price) {
                                $('#price_error').text(error.errors.Price[0]);  
                            }
                            if (error.errors.duration) {
                                $('#duration_error').text(error.errors.duration[0]);  
                            }
                            if (error.errors.features) {
                                $('#features_error').text(error.errors.features[0]);  
                            }
                            $('#submitPrice').html('Save');
                        }else{
                            console.log('Unexpected error format:', error);
                        }
                    }
                })
           });


              //////////////// Listing of Price //////////////
              function getPrice(currentpage){
                    $.ajax({
                        url:"{{ url('admin-price') }}",
                        type: 'GET',
                        data:{
                            'page' : currentpage
                        },
                        dataType:'JSON',
                        success:function(response){
                            var serial_no = 1;
                            $('#tablerows').empty();
                            let Serial_no = (response.current_page - 1) * 5 + 1;
                            $.each(response.items, function(index,items){
                                // console.log(items);
                                var tablerows = `
                                <tr> 
                                    <td class="text-center"> ${Serial_no++} </td>    
                                    <td class="text-center"> ${items.name} </td>    
                                   <td class="text-center"> ${Math.floor(items.price)}</td> 
                                    <td class="text-center"> ${items.duration} </td>    
                                    <td class="text-center"> ${items.features} </td>    
                                    <td class="text-center">
                                            <a href="javascript:void(0)" data-id='${items.id}' class="editPrice btn btn-sm btn-primary" >  
                                                <i class="mdi mdi-pencil-box"></i>
                                            </a> 
                                            <a href="javascript:void(0)" data-id='${items.id}' class="deletePrice btn btn-sm  ml-1 btn-danger" > 
                                                <i class="mdi mdi-trash-can" aria-hidden="true"></i>
                                            </a> 
                                    </td>    
                                </tr>`;
                                $('#tablerows').append(tablerows);
                            })

                        //////////////// Pagination /////////////
                        var pagination =  generatePagination(response);
                        $('#pagination').html(pagination.paginationHtml);
                        $('#showingMessage').text(pagination.showingMessage);
                        if (response.total === 0) {
                            tablerows = `<tr>
                                    <td colspan="4" class="text-center"><b>No Record Found</b></td>
                                </tr>`;
                                $('#tablerows').append(tablerows);
                        }
                        },
                        error:function(xhr){
                            console.log(xhr);
                        }
                    })
            }

            ///////////////// Pagination page link /////////////
            $(body).on('click', '.page-link', function () {
                var currentpage = $(this).data('page'); 
                getPrice(currentpage);
            });


              //////// Edit Price /////////
              $(body).on('click','.editPrice',function(){
                var priceid = $(this).data('id');
                    $.ajax({
                        url : "{{url('admin-price')}}"+"/"+priceid+"/edit",
                        type: 'get',
                        dataType:"JSON",
                        success:function(response){
                            console.log( response.result.price);
                            if (response.status === 'success') {
                                $('#exampleModalForm').modal('show');
                                $('#name').val(response.result.name);
                                $('#duration').val(response.result.duration);
                                $('#features').val(response.result.features);
                                $('#id').val(response.result.id);
                                $('#Price').val(Math.floor(response.result.price)); 
                            }
                                $('#updatePrice').show();
                                $('#submitPrice').hide();
                                $('#name_error').text('');
                                $('#price_error').text('');
                                $('#duration_error').text('');
                                $('#features_error').text('');
                        },error:function(xhr){
                            var error = JSON.parse(xhr.responseText);
                            console.log(error);
                        }
                    })
            });


            /////////////// Uodate Price ///////////////////
            $('#updatePrice').on('click',function(e){
                   e.preventDefault();
                   $('#updatePrice').html('Updating...');
                   var formData = $('#PriceForm').serialize();
                   formData +='&_method=PUT';
                   const priceid = $('#id').val();
                    $.ajax({
                            url:"{{ url('admin-price') }}/"+priceid,
                            type: 'POST' ,
                            data: formData,
                            success: function(response){
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#name_error').text('');
                                $('#price_error').text('');
                                $('#duration_error').text('');
                                $('#features_error').text('');
                                $('#updatePrice').html('Update');
                                $('#exampleModalForm').modal('hide');
                                $('#PriceForm')[0].reset();
                                getPrice();
                            },
                            error:function(xhr,status){
                                const error = JSON.parse(xhr.responseText);
                                if (error.errors) {
                                    if (error.errors.name) {
                                        $('#name_error').text(error.errors.name[0]);
                                    } 
                                    if (error.errors.Price) {
                                        $('#price_error').text(error.errors.Price[0]);
                                    }
                                    if (error.errors.duration) {
                                        $('#duration_error').text(error.errors.duration[0]);
                                    } 
                                    if (error.errors.features) {
                                        $('#features_error').text(error.errors.features[0]);
                                    } 
                                } else {
                                    console.log("Unexpected error format:", error);
                                }
                                 $('#updatePrice').html('Update');
                            }
                    });
            });
         
            /////////////// Destroy Price //////////////
            $(document).on('click', '.deletePrice', function() {
                var priceid = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete"
                }).then((result) => {
                    if (result.isConfirmed) {  // Only delete if confirmed
                        $.ajax({
                            url: '{{ url("admin-price") }}' + "/" + priceid,
                            type: 'DELETE',
                            dataType: 'json',
                            success: function(response) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                getPrice();
                            },
                            error: function(xhr) {
                                var error = JSON.parse(xhr.responseText);  // Fixed JSON.jquery
                                console.log(error.errors);
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Deletion failed!",
                                    text: error.message || "Something went wrong",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        });
                    } 
                });
            });
      });
</script>
@endsection