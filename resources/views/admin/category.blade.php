@extends('layouts.app')
@section('title', 'category')


<style>
    .center-text {
        text-align: center;
    }
</style>

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1>All Categories</h1>
                        <a class="btn btn-info" href="javascript:void(0)" data-toggle="modal" 
                           data-target="#exampleModalCenter" id="createCategory">Add Categories</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>SN.</th>
                                    <th>Category Name</th>
                                    <th>Trash</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data rows will go here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="categoryForm" name="categoryForm">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="category_name" name='category_name'
                                aria-describedby="category_name" placeholder="Enter Category">
                            <span><small id="category_name_error" class="text-danger"></small></span>
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name='id' aria-describedby="id">
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveCategory">Save</button>
                        <button type="button" class="btn btn-success" id="updateCategory"
                            style = "display:none">Update</button>

                    </div>

                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            
            // Open Create Category Modal
            $('#createCategory').on('click', function() {
                $('#categoryForm')[0].reset(); // Clear all form fields
                $('#category_name_error').html(''); // Clear error messages
                $('#id').val(''); // Reset hidden ID field
                $('#saveCategory').show(); // Show Save button
                $('#updateCategory').hide(); // Hide Update button
                $('#exampleModalLongTitle').text('Create New Category'); // Update modal title
                $('#exampleModalCenter').modal('show'); // Show the modal
            });
                        
            ////////////// Save Category //////////////
            $('#saveCategory').on('click', function(e) {
                e.preventDefault();

                $('#saveCategory').html('Save Category...');
                var formData = $('#categoryForm').serialize();

                $.ajax({
                    type: 'post',
                    url: "{{ route('categories.store') }}",
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        $('#saveCategory').html('Save');
                        $('#categoryForm')[0].reset();
                        $('#exampleModalCenter').modal('hide');
                       
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        var error = JSON.parse(xhr.responseText);
                        $('#category_name_error').text(error.errors.category_name[0]);
                        $('#saveCategory').html('Save');
                    }
                })
            });
            //////////////End Save Category //////////////


            //////////////List Categories //////////////
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'center-text'
                    },
                    {
                        data: 'category_name',
                        name: 'category name',
                        className: 'center-text'
                    },
                    {
                        data: 'trash',
                        name: 'trash',
                        className: 'center-text'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'center-text'
                    }
                ]
            });
            ////////////// End List Categories //////////////


            ////////////// Edit Categories //////////////
            $('body').on('click', '.editCategory', function() {
                var category_id = $(this).data('id');
                $.ajax({
                    type: 'get',
                    url: "{{ route('categories.index') }}" + '/' + category_id + '/edit',
                    dataType: 'json',
                    success: function(response) {
                        $('#exampleModalCenter').modal('show');
                        $('#saveCategory').hide();
                        $('#updateCategory').show();
                        $('#exampleModalLongTitle').text('Edit Category');
                        $('#category_name').val(response.data.category_name);
                        $('#id').val(response.data.id);
                        $('#category_name_error').html('');
                        console.log(response);
                    },
                    error: function(xhr, status) {
                        var error = xhr.responseText;
                        console.log(error);
                    }
                })
            })

            ////////////// End Edit Categories //////////////


            ////////////// Update  Categories //////////////
            $('#updateCategory').on('click', function(e) {
                e.preventDefault()

                $(this).html('Updating...');
                // alert('ok');
                var formData = $('#categoryForm').serialize();
                var category_id = $('#id').val();
                $.ajax({
                    url: "{{ url('categories') }}" + "/" + category_id,
                    type: 'PUT',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#categoryForm')[0].reset();
                        $('#exampleModalCenter').modal('hide');
                        $('#updateCategory').html('Update');
                        table.ajax.reload();
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr, status, error) {
                        var errors = JSON.parse(xhr.responseText);
                        $('#updateCategory').html('Update');
                        $('#category_name_error').html(errors.errors.category_name);
                        console.log(errors);
                    }
                });
            });
             ////////////// End Update  Categories //////////////


              ////////////// Delete  Category //////////////
          
              $('body').on('click','.deleteCategory',function(){
                    var category_id = $(this).data('id');

                                Swal.fire({
                                title: "Are you sure?",
                                text: "You won't be able to revert this!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "delete"
                                }).then((result) => {
                                if (result.isConfirmed) {
                                $.ajax({
                                    type: 'delete',
                                    url: "{{ url('categories') }}"+'/'+category_id,
                                    dataType:'json',
                                    success:function(response){
                                        $('#exampleModalCenter').modal('hide');
                                     
                                            Swal.fire({
                                                title: "Deleted!",
                                                text: response.message,
                                                showConfirmButton: false,
                                                icon: "success",
                                                timer: 1500
                                            });
                                        table.ajax.reload();
                                    },
                                    error:function(xhr,status,error){
                                        var errors = xhr.responseText;
                                        console.log(errors);
                                              // Display the error to the user
                                            Swal.fire({
                                                title: "Error!",
                                                text: "Failed to delete the category. Please try again.",
                                                icon: "error"
                                            });
                                    } 
                                }); 
                            }
                 });
            });



            ///////////////// Trashed Restore ////////////////

            $('body').on('click','.restore',function(){
                var trashed_id = $(this).data('id');
                $.ajax({
                    url:"{{ url('categories-restore') }}"+'/'+trashed_id,
                    type:'get',
                    dataType:'json',
                    success:function(response){
                        console.log(response);
                        
                        Swal.fire({
                                title: "Restored!",
                                text: response.message,
                                showConfirmButton: false,
                                icon: "success",
                                timer: 1500
                            });

                        table.ajax.reload();
                    },
                    error:function(xhr){
                        var error  = xhr.responseText.errors;
                        console.log(error);
                    }
                });
            });
        });    
                   

            
    </script>

@endsection
