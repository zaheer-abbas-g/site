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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h1> All Categories
                            <a class="btn btn-info float-right" href="javascript:void(0)" data-toggle="modal"
                                data-target="#exampleModalCenter" id="createCategory">Add Categories
                            </a>
                        </h1>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>SN.</th>
                                    <th>Category Name</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveCategory">Save</button>
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
                        console.log(error.errors.category_name[0])
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
                    }, {
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
                    success: function(response) {
                        $('#exampleModalCenter').modal('show');
                    }

                })
            })

            ////////////// End Edit Categories //////////////

        });
    </script>

@endsection
