@extends('admin.layout.app')

@section('title','skills')
@section('content')


<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>Skill Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createbrand"
                                data-toggle="modal" data-target="#exampleModalForm" id="createSkill"> Create Skill</a>
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
                                        <th>Name</th>
                                        <th>Skill Percentage</th>
                                        <th >Action</th>
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
                        <form class="form-pill" id="FormSkill" >
                       
                            <div class="form-group mb-4">
                                <label for="name" class="ml-3">Skill Name</label>
                                     <input type="text" class="form-control" id="name"  name="name" aria-describedby="skill_name" placeholder="Enter name">
                                    <small id="name_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>

                            <div class="form-group mb-4">
                                <label for="skill_percentage" class="ml-3"> Skill Percentage	</label>
                                <input type="text" class="form-control" id="team_percentage"  name="skill_percentage" aria-describedby="skill_percentage" placeholder="Enter team Percentage">
                                <small id="skill_percentage_error" class="form-text text-danger ms-2 ml-3"></small>
                            </div>
 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-pill " data-dismiss="modal">Close</button>
                        <button class="button btn btn-success btn-pill"   id="submitSkill">
                            <span class="ladda-label">Save</span>
                        </button>
                        <button class="button btn btn-primary btn-pill"   id="updateSkill" style="display: none">
                            <span class="ladda-label">Update</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function(){


        //////////// Create skills ///////////
        $('#createSkill').on('click',function(){
            $('#name_error').text('');
            $('#skill_percentage_error').text('');
           
        });

        ///////////// Store skills //////////
        $('#submitSkill').on('click',function(e){
            e.preventDefault();
            

            $(this).html('Saving...');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });   

            var formData = $('#FormSkill').serialize();
           

            $.ajax({
                url : "{{ url('admin-skill') }}",
                type: "POST",
                data: formData,
                dataType:'JSON',
                success:function(response){
                    console.log(response);

                    if (response.status === true) {
                      
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        
                        $('#exampleModalForm').modal('hide');
                        $('#name_error').text('');
                        $('#skill_percentage_error').text('');
                        $('#FormSkill')[0].reset();
                        $('#submitSkill').html('Save');
                    }else{
                        console.log(" Error ="+response.error+" Message ="+ response.message);
                    }
                    
                   
                },error:function(xhr){
                    var error = JSON.parse(xhr.responseText);
                    if (error.errors) {
                        if (error.errors.name) {
                            $('#name_error').text(error.errors.name[0]);
                        } if (error.errors.skill_percentage) {
                            $('#skill_percentage_error').text(error.errors.skill_percentage[0]);  
                        }
                        $('#submitSkill').html('Save');
                    }else{
                        console.log('Unexpected error format:', error);
                    }
  
                }
            })
        });

    });
</script>

@endsection
