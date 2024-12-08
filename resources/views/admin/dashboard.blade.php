@extends('admin.layout.app')
@section('title', 'dashboard')


<style>
    .center-text {
        text-align: center;
    }
</style>

@section('content')
 
        <div class="col-lg-12">
            <div  id="registermsge" > </div>
             
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>User listing</h2>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered data-table" style="width:100%">
                          
                                <thead>
                                    <tr>
                                        <th>SN.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

 

    <div class="modal fade" id="ajaxModelexa" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modelHeading"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userForm" name="userForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" name="email" value=""
                                    required>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn btn-success btn-pill" id="savedata" value="create">Save User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(function() {
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            
        
            var table = $('.data-table').DataTable({
                serverSide: true,
                responsive: true, // Enable responsiveness
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'center-text'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'center-text'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        className: 'center-text'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'center-text'
                    },
                ]
            });


            $('body').on('click', '.editUser', function() {
                var id = $(this).data('id');
                $.get("{{ route('users.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html('Edit user');
                    $('#savedata').html("update");
                    $('#ajaxModelexa').modal('show');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                });

            })


            $('#savedata').click(function(e) {
                e.preventDefault();
                $(this).html('Updating...');

                var formData = $('#userForm').serialize();
                var id = $('#id').val();

                $.ajax({
                    url: "{{ route('users.update', '') }}/" + id,
                    type: 'PUT',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $('#ajaxModelexa').modal('hide');
                        table.ajax.reload();

                        $('#savedata').html('Save User');
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                        alert(
                            'An error occurred while updating the user'); // Show error message
                        $('#savedata').html('Save User'); // Reset button text in case of error
                    }
                });
            });




            $('body').on('click', '.deleteUser', function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "delete",
                    // showConfirmButton: false
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('users.destroy', ':id') }}".replace(':id',id) ,
                            success: function(data) {

                                Swal.fire({
                                    title: "Deleted!",
                                    text: data.message,
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1000
                                });

                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        })


                    }
                });



            })


            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get("message");
            if (message) {
                $('#registermsge').append(` <div class="alert alert-success text-center  mt-2" id="registermsge" role="alert">${message} </div>`);
            }

            setTimeout(function() {
                    $('#registermsge').hide('');
            }, 2000);

        });
    </script>
@endsection
