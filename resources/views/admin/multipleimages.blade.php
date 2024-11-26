@extends('layouts.app')


@section('title', 'Multiple Images')

@section('content')

    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Multiple Images Listing
                            <span> <a href="" class="btn btn-info btn-sm float-right crateImages" data-toggle="modal"
                                    data-target="#exampleModalCenter">Create Images</a></span>
                        </h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered data-table">
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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
                            <input type="file" class="form-control-file" id="multipleImages" name="multipleImages[]"
                                multiple>
                        </div>

                        <div class="form-group imagepreivew">

                        </div>

                        <div class="form-group">
                            <img src="{{ asset('admin/images/preview.jpg') }}" id="imagepreivew" name="imagepreivew"
                                class="rounded float-left " alt="no image found"
                                style="width: 100px; height: 100px; object-fit: cover;">
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
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // $('.crateImages').on('click', function() {
            //     $('#imagepreivew').attr('src', '');
            // })

            /////////////////// Uploading Images ////////////////
            $('#Upload').on('click', function(e) {
                e.preventDefault();

                var formData = new FormData($('#multiImagesForm')[0]);
                $('#Upload').html('Uploading...');

                $.ajax({
                    ajax: {
                        url: "{{ url('multipleimages') }}"
                    },
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
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

                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        var error_response = JSON.parse(xhr.responseText());
                        console.log(error_response.errors);
                    }
                })
            })

            ///////////////////// Multiple Images listing /////////////////////////
            var table = $('.data-table').DataTable({
                ajax: {
                    url: "{{ url('multipleimages') }}"
                },
                processing: true,
                serverSide: true,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }

                ]
            });


            ////////////// edit images //////////
            $('body').on('click', '.editiamges', function() {
                var image_id = $(this).data('id');

                $.ajax({
                    url: "{{ url('multipleimages') }}" + '/' + image_id + '/edit',
                    type: 'get',
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response.data.image);
                        var imagePath = "{{ asset('admin/images/multipleImages') }}";
                        var image = imagePath + '/' + response.data.image;
                        $('#imagepreivew').attr('src', image);
                        $('#exampleModalCenter').modal('show');
                        $('#exampleModalLongTitle').html('Edit Image');
                        $('#Upload').html('Update Image');
                    },
                    error: function(xhr) {
                        var error = xhr.responseText();
                        console.log(error.errors);
                    }
                });

            })

        });
    </script>

@endsection
