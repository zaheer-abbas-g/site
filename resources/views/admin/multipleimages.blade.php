@extends('layouts.app')


@section('title','Multiple Images')

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Multiple Images Listing
                        <span> <a href="" class="btn btn-info btn-sm float-right"  data-toggle="modal" data-target="#exampleModalCenter">Create Images</a></span>
                    </h1>
                </div>
                <div class="card-body">
                    <table class="table table-borded data-table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Image</th>
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
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create Multiple Images</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

        <form enctype="multipart/form-data" id="multiImagesForm">
           
            <div class="modal-body">
                <div class="form-group">
                    <label for="multipleImagesUpload">Upload images</label>
                    <input type="file" class="form-control-file" id="multipleImages" name="multipleImages[]" multiple>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="Upload">Upload</button>
            </div>
        </form>

        </div>
    </div>
</div>

<script type="text/javascript">

        $(document).ready(function(){
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var table = $('.data-table').DataTable();

                /////////////////// Uploading Images ////////////////

                $('#Upload').on('click',function(){
              
                    var formData = new FormData($('#multiImagesForm')[0]);
                    $('#Upload').html('Uploading...');

                    $.ajax({
                        url:  "{{ url('multipleimages') }}",
                        type:'post',
                        data:formData,
                        processData:false,
                        contentType:false,
                        success:function(response){
                            $('#exampleModalCenter').modal('hide');
                            $('#Upload').html('Upload');
                            $('#multiImagesForm')[0].reset();
                            $('#multipleImages').val('');
                            console.log(response);
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Your work has been saved",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error:function(xhr){
                            var error_response = JSON.parse(xhr.responseText());
                            console.log(error_response.errors);
                        }
                    })
                })


        });
</script>

@endsection