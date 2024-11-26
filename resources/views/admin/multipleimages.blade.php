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
                
                
                <div class="modal-body">
                        <form enctype="multipart/form-data" id="multiImagesForm">
                        <div class="form-group">
                            <label for="multipleImagesUpload">Upload images</label>
                            <input type="file" class="form-control-file" id="multipleImages" name="multipleImages[]"
                                multiple>
                                <span><small id="multipleimage_error" class="text-danger"></small></span>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control-file" id="images_id" name="images_id">
                        </div>
                        

                        <div id="imageperviewcontainer"> </div>
                     </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="Upload">Upload</button>
                    <button type="button" class="btn btn-info" id="update" style="display:none">update</button>
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


            $('.crateImages').on('click', function() {
                $('#exampleModalLongTitle').html('Create Images');
                $('#multiImagesForm')[0].reset();
                $('#imageperviewcontainer').empty(); 
                $('#multipleImages').closest('.form-group').show(); 
                $('#update').hide();
                $('#Upload').show();
                $('#multipleimage_error').html('');
            })  


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
                            var error_response = JSON.parse(xhr.responseText);
                            console.log(error_response.errors);  
                            if (error_response.errors) {
                                if (error_response.errors.multipleImages) {
                                    $('#multipleimage_error').html(error_response.errors.multipleImages[0]);
                                } else {
                                    $('#multipleimage_error').html('');
                                }
                            } else {
                                $('#multipleimage_error').html('');
                            }

                            $('#Upload').html('upload');
                        }
                    });
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
                $('#multipleImages').closest('.form-group').hide();

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
                        $('#Upload').hide('');
                        $('#update').show();
                        $('#images_id').val(response.data.id);
                        var imagePreviewHTML = `
                            <div class="form-group">
                                 <input type="file" 
                                    id="multipleImages-${image_id}" name="image"
                                    class=" form-control mt-2" 
                                    accept="image/*">
                                     <span><small id="image_error" class="text-danger"></small></span>
                            </div>
                            <div class="form-group">
                                <img src="${image}" 
                                    id="imagepreivew-${image_id}" 
                                    class="editImageInput rounded float-left" 
                                    alt="Image not found" 
                                    style="width: 100px; height: 100px; object-fit: cover;"> 
                            </div>
                        `;
                        $('#imageperviewcontainer').html(imagePreviewHTML); 

                        $(`#multipleImages-${image_id}`).on('change', function () {
                            var file = this.files[0];
                            if (file) {
                                $(`#imagepreivew-${image_id}`).attr('src', window.URL.createObjectURL(file));   $('#image_error').html('');
                            }
                        });
                    },
                    error: function(xhr) {
                        var error = xhr.responseText();
                        console.log(error.errors);
                    }
                });
            })

            ///////////// Update multiple Images //////////////
            $('#update').on('click',function(e){
                e.preventDefault();
                var images_id = $('#images_id').val();
                var formData = new FormData($('#multiImagesForm')[0]);
                formData.append('_method', 'PUT'); // Spoof PUT method for Laravel
                $('#update').html('Updating...');

                $.ajax({
                    url: "{{ url('multipleimages') }}"+'/'+images_id,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#exampleModalCenter').modal('hide');
                        $('#update').html('update');
                        $('#multiImagesForm')[0].reset();
                        // $('#multipleImages').val('');
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
                            var error_response = JSON.parse(xhr.responseText);
                            console.log(error_response.errors);  
                            if (error_response.errors) {
                                if (error_response.errors.image) {
                                    $('#image_error').html(error_response.errors.image[0]);
                                } else {
                                    $('#image_error').html('');
                                }
                            } else {
                                $('#image_error').html('');
                            }
                            $('#update').html('update');
                        }
                    });
                });    
    
    
            });
    </script>

@endsection
