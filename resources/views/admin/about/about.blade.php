@extends('admin.layout.app')

@section('title','about')
@section('content')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom d-flex justify-content-between align-items-center">
                        <span>About Listing </span>
                            <a href="javascript:void(0)" class="btn btn-primary btn-pill float-right createbrand"
                                data-toggle="modal" data-target="#exampleModalForm" id="createService"> Create About</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">    
                                <tr class="text-center float-right">
                                    <p class="float-right ml-5" style="position: relative;">
                                        Search:
                                        <label style="position: relative;">
                                            <input type="text" class="form-control" id="search" placeholder="Search...">
                                            <span id="cancelSearch" style="position: absolute; top: 10px; right: 10px; display: none; cursor: pointer;">
                                                <i class="mdi mdi-close-circle"></i>
                                            </span>
                                        </label>
                                    </p>                                    
                                    
                                 </tr>
                                <thead>     
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Short Description</th>
                                        <th>Long Description</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tablerows">
                                    
                                </tbody>

                            </table>  
                        </div>
                    </div>
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
										<form class="form-pill">
											<div class="form-group">
												<label for="exampleTitle">Title</label>
												<input type="text" class="form-control" id="exampleTitle" aria-describedby="titleHelp" placeholder="Enter title">
												<small id="titleHelp" class="form-text text-muted">We'll never share your title with anyone else.</small>
											</div>
                                            
                                            <div class="form-group">
												<label for="short_description">Short Description	</label>
												<input type="text" class="form-control" id="short_description" aria-describedby="short_description" placeholder="Enter short description">
												<small id="short_description_error" class="form-text text-muted"></small>
											</div>
										 
                                            <div class="form-group">
												<label for="long_description">Long Description	</label>
                                                     <textarea name="long_description" id="long_description" cols="20" rows="5" class="form-control"  aria-describedby="long_description" ></textarea>
												<small id="long_description_error" class="form-text text-muted"></small>
											</div>

                                            <div class="form-group">
                                                <button class="ladda-button btn btn-success btn-square btn-ladda" data-style="contract">
                                                    <span class="ladda-label">Submit!</span>
                                                    <span class="ladda-spinner"></span>
                                                </button>
											</div>
                                           
											{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
										</form>
									</div>
									<div class="modal-footer">
                                        <button class="ladda-button btn btn-success btn-square btn-ladda" data-style="contract">
                                            <span class="ladda-label">Submit!</span>
                                            <span class="ladda-spinner"></span>
                                        </button>
										<button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary btn-pill">Save Changes</button>
									</div>
								</div>
							</div>
						</div>

@endsection

            
					