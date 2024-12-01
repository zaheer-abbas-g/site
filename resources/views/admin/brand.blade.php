@extends('admin.layout.app')

@section('title', 'brand')


<style>
    .center-text {
        text-align: center;
    }
</style>

@section('content')

      
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>Brand Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createbrand"
                                data-toggle="modal" data-target="#exampleModalCenter"> Create Brand</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Brand Name</th>
                                        <th>Brand Image</th>
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
      
    


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="card card-default">
         
                    <div class="modal-header">
                        <h5 class="modal-title " id="exampleModalLongTitle">Create Brand</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   
                
                <div class="card-body">
             
                    <form id="brandForm" enctype="multipart/form-data" class="form-pill">
                        @csrf

                        <div class="form-group">
                            <label for="formGroupBrandNameInput">Brand Name</label>
                            <input type="text" class="form-control" id="brandname" name="brandname"
                                placeholder="brand name">
                            <span><small id="brandname_error" class="text-danger"></small></span>
                        </div>

                        <div class="form-group">
                            <label for="brandimage">Brand Image</label>
                            <input type="file" class="form-control-file" id="brandimage" name="brandimage">
                            <span><small id="brandimage_error" class="text-danger"></small></span>
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="brandid" name="brandid">
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('admin/images/preview.jpg') }}" id="imagepreivew" name="imagepreivew"
                                class="rounded float-left " alt="no image found"
                                style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                   
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn btn-success btn-pill" id="brandSave">Save</button>
                    <button type="button" class="btn btn-primary btn-pill" id="brandUpdate">Update</button>

                </div>

                </form>
          
        </div>
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


            /////////// Image Preview ////////////////
            $('#brandimage').on('change', function() {
                document.getElementById('imagepreivew').src = window.URL.createObjectURL(this.files[0]);
            });


            ///////////// preview image show after reset form ////////////
            $('.createbrand').on('click', function() {
                var imagePath = "{{ asset('admin/images/preview.jpg') }}";
                $('#imagepreivew').attr('src', imagePath);
                $('#brandForm')[0].reset();
                $('#exampleModalLongTitle').html('create brand');
                $('#brandSave').html('save');
                $('#brandSave').show();
                $('#brandUpdate').hide();
                $('#brandname_error').html('')
                $('#brandimage_error').html('')

            });


            ///////////////// Save Brand /////////////////
            $('#brandSave').on('click', function(e) {
                e.preventDefault();

                $(this).html('Saving...');
                var formData = new FormData($('#brandForm')[0]);

                $.ajax({
                    url: "{{ url('brands') }}",
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        $('#exampleModalCenter').modal('hide');
                        $('#brandSave').html('Save');
                        $('#brandForm')[0].reset();
                        $('#imagepreivew').attr('src', '');
                        $('#brandname_error').html('')
                        $('#brandimage_error').html('')

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
                        var response = JSON.parse(xhr.responseText);
                        $('#brandSave').html('Save');


                        if (response.errors) {
                            if (response.errors.brandname) {
                                $('#brandname_error').html(response.errors.brandname[0]);
                            } else {
                                $('#brandname_error').html('');
                            }
                            if (response.errors.brandimage) {
                                $('#brandimage_error').html(response.errors.brandimage[0]);
                            } else {
                                $('#brandimage_error').html(
                                    ''); // Clear the error if no error exists
                            }
                        } else {
                            // Clear errors if the errors object doesn't exist
                            $('#brandname_error').html('');
                            $('#brandimage_error').html('');
                        }
                    }
                });
            })



            ///////////////// list Brand /////////////////

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('brands') }}", // Correctly placed inside the `ajax` object
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'center-text'
                    },
                    {
                        data: 'brand_name',
                        name: 'brand_name',
                        className: 'center-text'
                    },
                    {
                        data: 'brandimage',
                        name: 'brandimage',
                        className: 'center-text'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'center-text',
                        orderable: false,
                        searchable: false,
                    },
                ]
            });



            //////////// Edit Brand /////////////

            $('body').on('click', '.editbrand', function() {
                var brand_id = $(this).data('id');
                $.ajax({
                    type: 'get',
                    url: "{{ url('brands') }}" + '/' + brand_id + '/edit',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#exampleModalCenter').modal('show');
                        $('#exampleModalLongTitle').html('Edit Brand');
                        $('#brandSave').hide();
                        $('#brandUpdate').show();
                        $('#brandname').val(response.data.brand_name)
                        $('#brandid').val(response.data.id)
                        var baseUrl = "{{ asset('admin/images/brand') }}";
                        var image = baseUrl + '/' + response.data
                            .brand_image; 
                        $('#imagepreivew').attr('src', image);
                        $('#brandname_error').html('')
                        $('#brandimage_error').html('')
                    }
                });
            });

            /////////////// Update Brand ///////////////

            $('#brandUpdate').on('click', function() {

                var brand_id = $('#brandid').val();
                $('#brandUpdate').html('Updating...');

                var formData = new FormData($('#brandForm')[0]);
                formData.append('_method', 'PUT'); // Spoof PUT method for Laravel

                $.ajax({
                    url: "{{ url('brands') }}" + '/' + brand_id,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('#exampleModalCenter').modal('hide');
                        $('#brandUpdate').html('Update');
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
                        var response = JSON.parse(xhr.responseText);
                        $('#brandUpdate').html('Update');
                        if (response.errors) {
                            if (response.errors.brandname) {
                                $('#brandname_error').html(response.errors.brandname[0]);
                            } else {
                                $('#brandname_error').html('');
                            }
                            if (response.errors.brandimage) {
                                $('#brandimage_error').html(response.errors.brandimage[0]);
                            } else {
                                $('#brandimage_error').html(
                                    ''); // Clear the error if no error exists
                            }
                        } else {
                            // Clear errors if the errors object doesn't exist
                            $('#brandname_error').html('');
                            $('#brandimage_error').html('');
                        }
                    }
                });
            });

            //////////////// Delete Brand ///////////

            $('body').on('click', '.deletebrand', function() {
                var brand_id = $(this).data('id');

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
                            url: "{{ url('brands') }}" + '/' + brand_id,
                            type: 'delete',
                            dataType: "json",
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.message,
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });

                                table.ajax.reload();
                            }
                        });
                    }
                })
            });

        });
    </script>
@endsection
