@extends('admin.layout.app')


@section('title','faq')
@section('content')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>Faq Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createbrand"
                                data-toggle="modal" data-target="#exampleModalForm" id="createFaq"> Create Faq</a>
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
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
                        <form class="form-pill" id="FaqForm">
                           
                            <div class="form-group">
                                <label for="question" class="form-label">Question</label>
                                    <textarea  cols="50" rows="2" class="form-control" id="question" name="question"></textarea> 
                                <span><small id="question_error" class="text-danger"></small></span>
                            </div>

                            <div class="form-group">
                                <label for="answer" class="form-label">Answer</label>
                                    <textarea  cols="50" rows="2" class="form-control" id="answer" name="answer"></textarea> 
                                <span><small id="answer_error" class="text-danger"></small></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                 <select name="status" id="status" class="form-control" >
                                    <option selected>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span><small id="status_error" class="text-danger"></small></span>
                            </div> 

                            <div class="form-group mb-2">
                                     <input type="hidden" id="id"  name="id">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-pill " data-dismiss="modal">Close</button>
                        <button class="button btn btn-success btn-pill"   id="submitFaq">
                            <span class="ladda-label">Save</span>
                        </button>
                        <button class="button btn btn-primary btn-pill"   id="updateFaq" style="display: none">
                            <span class="ladda-label">Update</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    
    $(document).ready(function(){

        getFaq();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            }); 

            //////////// Create faqs ///////////
            $('#createFaq').on('click',function(){
                $('#question_error').text('');
                $('#answer_error').text('');
                $('#submitfaq').show();
                $('#updatefaq').hide();
            });

           ///////////// Store faqs //////////
           $('#submitFaq').on('click',function(e){
                e.preventDefault();
                $(this).html('Saving...');
                var formData = $('#FaqForm').serialize();
                $.ajax({
                    url : "{{ url('admin-faq') }}",
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
                            $('#question_error').text('');
                            $('#answer_error').text('');
                            $('#FaqForm')[0].reset();
                            $('#submitFaq').html('Save');
                            getFaq();
                        }else{
                            console.log(" Error ="+response.error+" Message ="+ response.message);
                        }
                    },error:function(xhr){
                        var error = JSON.parse(xhr.responseText);
                        if (error.errors) {
                            if (error.errors.question) {
                                $('#question_error').text(error.errors.question[0]);
                            } if (error.errors.answer) {
                                $('#answer_error').text(error.errors.answer[0]);  
                            }
                            $('#submitFaq').html('Save');
                        }else{
                            console.log('Unexpected error format:', error);
                        }
                    }
                })
            });

            //////////////// Listing of team //////////////
            function getFaq(currentpage){
                    $.ajax({
                        url:"{{ url('admin-faq') }}",
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
                                    <td class="text-center"> ${items.question} </td>    
                                    <td class="text-center"> ${items.answer} </td>    
                                    <td class="text-center"> 
                                        ${items.status == 'active' ? `<span class='badge badge-pill badge-success'>${items.status}</span>` : `<span class="badge badge-pill badge-danger">${items.status}</span>`
                                    } 
                                    </td>    
                                    <td class="text-center">
                                            <a href="javascript:void(0)" data-id='${items.id}' class="editfaq btn btn-sm btn-primary" >  
                                                <i class="mdi mdi-pencil-box"></i>
                                            </a> 
                                            <a href="javascript:void(0)" data-id='${items.id}' class="deletefaq btn btn-sm  ml-1 btn-danger" > 
                                                <i class="mdi mdi-trash-can" aria-hidden="true"></i>
                                            </a> 
                                    </td>    
                                    <td class="text-center">    
                                    <form class="status-form" id="statusform-${items.id}" data-id="${items.id}">
                                        <label class="switch switch-text switch-success switch-pill form-control-label">
                                            <input type="checkbox" class="switch-input form-check-input status-toggle" 
                                                value="on" ${items.status === 'active' ? 'checked' : ''}>
                                            <span class="switch-label" data-on="On" data-off="Off"></span>
                                            <span class="switch-handle"></span>
                                        </label>      
                                    </form> 
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
                getFaq(currentpage);
            });
            
            // Status toggle handler
            $(document).on('change', '.status-toggle', function() {
                const form = $(this).closest('.status-form');
                const itemId = form.data('id');
                const status = $(this).prop('checked') ? 'active' : 'inactive';
                $.ajax({
                    url: `/update-status/${itemId}`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _method: 'PATCH',
                        status: status
                    },
                    success: function(response) {
                        getFaq();
                        console.log('Status updated');
                    },
                    error: function() {
                        $(this).prop('checked', !status);
                    }
                });
            });

        });

</script>
@endsection