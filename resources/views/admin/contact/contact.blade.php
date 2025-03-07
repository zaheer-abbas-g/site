@extends('admin.layout.app')


@section('title','contact')
@section('content')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>Contact Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createContact"
                                data-toggle="modal" data-target="#exampleModalForm" id="createContact"> Create Contact</a>
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
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
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
                        <form class="form-pill" id="ContactForm">
                           
                            <div class="form-group mb-4">
                                <label for="name" class="ml-3">Name</label>
                                     <input type="text" class="form-control" id="name"  name="name" aria-describedby="name_description" placeholder="Enter name">
                                    <small id="name_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="ml-3">Email</label>
                                <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                aria-describedby="email"
                                placeholder="Enter email"
                              >
                                 <small id="email_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="subject" class="ml-3">Subject</label>
                                     <input type="text" class="form-control" id="subject"  name="subject" aria-describedby="subject" placeholder="Enter subject"  >
                                    <small id="subject_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="message" class="ml-3">Message</label>
                                    <textarea  cols="50" rows="2" class="form-control" id="message" name="message"  placeholder="Enter message"></textarea> 
                                <span><small id="message_error" class="text-danger ms-2 ml-3"></small></span>
                            </div>

                            <div class="form-group mb-2">
                                 <input type="hidden" id="id"  name="id">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-danger btn-pill " data-dismiss="modal">Close</button>
                        <button class="button btn btn-success btn-pill"   id="submitContact">
                            <span class="ladda-label">Save</span>
                        </button>
                        <button class="button btn btn-primary btn-pill"   id="updateContact" style="display: none">
                            <span class="ladda-label">Update</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
</div>


<script>
    $(document).ready(function(){

            getContact();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }




            }); 

            ///////////////// Create Price //////////////////
            $('#createContact').on('click',function(){
                $('#exampleModalFormTitle').html('Create Faq')
                $('#updateContact').hide();
                $('#submitContact').show();
                $('#name_error').text('');
                $('#email_error').text('');
                $('#subject_error').text('');
                $('#message_error').text('');
                $('#ContactForm')[0].reset();
            });
        
            ///////////// Store Contact //////////
            $('#submitContact').on('click',function(e){
                    e.preventDefault();
                    $(this).html('Saving...');
                
                    $('#name_error').text(' ');
                    $('#email_error').text(' ');
                    $('#subject_error').text(' ');
                    $('#message_error').text(' ');

                    var formData = $('#ContactForm').serialize();
                    $.ajax({
                        url : "{{ url('admin-contact') }}",
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
                                $('#email_error').text(' ');
                                $('#subject_error').text(' ');
                                $('#message_error').text(' ');
                                $('#ContactForm')[0].reset();
                                $('#submitContact').html('Save');
                                   getContact();
                            }else{
                                console.log(" Error ="+response.error+" Message ="+ response.message);
                            }
                        },error:function(xhr){
                            var error = JSON.parse(xhr.responseText);
                            if (error.errors) {
                                if (error.errors.name) {
                                    $('#name_error').text(error.errors.name[0]);
                                } if (error.errors.email) {
                                    $('#email_error').text(error.errors.email[0]);  
                                }
                                if (error.errors.subject) {
                                    $('#subject_error').text(error.errors.subject[0]);  
                                }
                                if (error.errors.message) {
                                    $('#message_error').text(error.errors.message[0]);  
                                }
                                $('#submitContact').html('Save');
                            }else{
                                console.log('Unexpected error format:', error);
                            }
                        }
                    })
            });


            //////////////// Listing of Contact //////////////
            function getContact(currentpage){
                $.ajax({
                    url:"{{ url('admin-contact') }}",
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
                                <td class="text-center"> ${items.email} </td>    
                                <td class="text-center"> ${items.subject} </td>    
                                <td class="text-center"> ${items.message} </td>    
                                <td class="text-center">
                                        <a href="javascript:void(0)" data-id='${items.id}' class="editContact btn btn-sm btn-primary" >  
                                            <i class="mdi mdi-pencil-box"></i>
                                        </a> 
                                        <a href="javascript:void(0)" data-id='${items.id}' class="deleteContact btn btn-sm  ml-1 btn-danger" > 
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
                getContact(currentpage);
            });

            //////// Edit Contact /////////
            $(body).on('click','.editContact',function(){
                var contactid = $(this).data('id');
                    $.ajax({
                        url : "{{url('admin-contact')}}"+"/"+contactid+"/edit",
                        type: 'get',
                        dataType:"JSON",
                        success:function(response){
                            console.log( response.result.price);
                            if (response.status === true) {
                                $('#exampleModalForm').modal('show');
                                $('#name').val(response.result.name);
                                $('#email').val(response.result.email);
                                $('#subject').val(response.result.subject); 
                                $('#message').val(response.result.message); 
                                $('#id').val(response.result.id);
                            }
                                $('#updateContact').show();
                                $('#submitContact').hide();
                                $('#name_error').text('');
                                $('#email_error').text('');
                                $('#subject_error').text('');
                                $('#message_error').text('');
                        },error:function(xhr){
                            var error = JSON.parse(xhr.responseText);
                            console.log(error);
                        }
                    })
            });

            
            /////////////// Update Contact ///////////////////
            $('#updateContact').on('click',function(e){
                   e.preventDefault();
                   $('#updateContact').html('Updating...');
                   var formData = $('#ContactForm').serialize();
                   formData +='&_method=PUT';
                   const contactid = $('#id').val();
                    $.ajax({
                            url:"{{ url('admin-contact') }}/"+contactid,
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
                                $('#email_error').text('');
                                $('#subject_error').text('');
                                $('#message_error').text('');
                                $('#updateContact').html('Update');
                                $('#exampleModalForm').modal('hide');
                                $('#ContactForm')[0].reset();
                                getContact();
                            },
                            error:function(xhr,status){
                                const error = JSON.parse(xhr.responseText);
                                if (error.errors) {
                                    if (error.errors.name) {
                                        $('#name_error').text(error.errors.name[0]);
                                    } 
                                    if (error.errors.email) {
                                        $('#email_error').text(error.errors.email[0]);
                                    }
                                    if (error.errors.subject) {
                                        $('#subject_error').text(error.errors.subject[0]);
                                    } 
                                    if (error.errors.message) {
                                        $('#message_error').text(error.errors.message[0]);
                                    } 
                                } else {
                                    console.log("Unexpected error format:", error);
                                }
                                 $('#updateContact').html('Update');
                            }
                    });
            });


            /////////////// Destroy Contact //////////////
            $(document).on('click', '.deleteContact', function() {
                var contactid = $(this).data('id');
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
                            url: '{{ url("admin-contact") }}' + "/" + contactid,
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
                                getContact();
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