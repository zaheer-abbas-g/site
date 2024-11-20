@extends('layouts.app')
@section('title', 'category')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1> All Categories
                        <a class="btn btn-info float-right" href="javascript:void(0)" data-toggle="modal"  data-target="#exampleModalCenter" id="createCategory" >Add Categories
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
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <label for="exampleInputEmail1">Category Name</label>
                <input type="text" class="form-control" id="category_name" name='category_name' aria-describedby="category_name"     placeholder="Enter Category">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveCategory">Save Category</button>
        </div>

         </form>
      </div>
    </div>
  </div>

  <script  type="text/javascript">
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#saveCategory').on('click',function(e){
                e.preventDefault();
                 
                var formData = $('#categoryForm').serialize();

                $.ajax({
                    type:'post',
                    url:"{{ route('categories.store') }}",
                    data:formData,
                    success:function(response){
                        console.log(response);    
                    }
                })
            });
           

        });
  </script>

@endsection