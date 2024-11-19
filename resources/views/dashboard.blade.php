@extends('layouts.app')
@section('title','dashboard')


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
                            <h1>  All users
                                    {{-- <a class="btn btn-info float-right" href="javascript:void(0)" id="createUser">Add New User
                                    </a> --}}
                            </h1>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>SN.</th>
                                    <th>Name</th>
                                    <th>Email</th>
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



<div class="modal fade" id="ajaxModelexa" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="userForm" name="userForm" class="form-horizontal">
                   <input type="hidden" name="id" id="id" >
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" required>
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="email" name="email"  value="" required>
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="savedata" value="create">Save User
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('users.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex' , className: 'center-text' },
              {data: 'name', name: 'name' , className: 'center-text' },
              {data: 'email', name: 'email' , className: 'center-text' },
              {data: 'action', name: 'action', orderable: false, searchable: false , className: 'center-text' },
          ]
      });
       
    //   $('#createUser').click(function () {
    //       $('#savedata').val("create-post");
    //       $('#id').val('');
    //       $('#postForm').trigger("reset");
    //       $('#modelHeading').html("Create New User");
    //       $('#ajaxModelexa').modal('show');
    //   });
      
    //   $('body').on('click', '.editPost', function () {
    //     var id = $(this).data('id');
    //     $.get("{{ route('users.index') }}" +'/' + id +'/edit', function (data) {
    //         $('#modelHeading').html("Edit Post");
    //         $('#savedata').val("edit-user");
    //         $('#ajaxModelexa').modal('show');
    //         $('#id').val(data.id);
    //         $('#title').val(data.title);
    //         $('#description').val(data.description);
    //     })
    //  });
        
    $('body').on('click','.editUser',function(){
            var id = $(this).data('id');
            $.get("{{  route('users.index') }}"+'/'+id+'/edit',function(data){
                $('#modelHeading').html('Edit User');
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
            alert('An error occurred while updating the user'); // Show error message
            $('#savedata').html('Save User'); // Reset button text in case of error
        }
    });
});

   
    //   $('body').on('click', '.deletePost', function () {
       
    //       var id = $(this).data("id");
    //       confirm("Are You sure want to delete this Post!");
        
    //       $.ajax({
    //           type: "DELETE",
    //           url: "{{ route('users.store') }}"+'/'+id,
    //           success: function (data) {
    //               table.draw();
    //           },
    //           error: function (data) {
    //               console.log('Error:', data);
    //           }
    //       });
    //   });
       

    $('body').on('click','.deleteUser',function(){
        var id = $(this).data('id');
        // alert(id);
        $.ajax({
            type: "DELETE",
            url:"{{ route('users.store') }}"+'/'+id,
            success:function(data){
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }

        })
    })


    });
  </script>
@endsection

