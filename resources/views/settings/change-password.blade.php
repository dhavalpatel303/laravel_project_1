@extends('layouts.app')

@section('style')
	<style type="text/css">
		
	</style>
@endsection

@section('content')
	<!-- /main navbar -->


{{-- code work kro --}}

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-key mr-2"></i> <span class="font-weight-semibold">Change Password</span></h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>

			<div class="header-elements d-none py-0 mb-3 mb-md-0">
				<div class="breadcrumb">
					<a href="#" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				{{-- 	<a href="project-list.php" class="breadcrumb-item"> Project</a> --}}
					<span class="breadcrumb-item active">Change Password</span>
				</div>
			</div>
		</div>
	</div>
	<!-- /page header -->

		<!-- Page content -->
	<div class="page-content pt-0">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
				<div class="card">				    
				    <div class="card-body">		
				    	<div class="col-md-12" id="add-message"></div>		    	
				    	<form method="post" action="" enctype="multipart/form-data">
				 			  
				    		<div class="row">	
				    		<div class="col-md-3">
				    		</div>			    			
				    			<div class="col-md-6">
				    			
				    				<div class="form-group">
						                <label class="d-block font-weight-semibold">Username</label>
						                <input type="text" value="" class="form-control" name="name" placeholder="Enter name">
						            </div>
						           
						            <div class="form-group">
						                <label class="d-block font-weight-semibold">Email</label>
						                <input type="text" value="" readonly class="form-control" name="email" placeholder="Enter email">
						            </div>

						            <div class="form-group">
						                <label class="d-block font-weight-semibold">Password</label>
						                <input type="text" class="form-control" name="password" placeholder="Enter password">
						                  (Leave blank if you are not changing the password)
						            </div>
						            <div class="form-group">
							            <div class="d-flex justify-content-start align-items-center">
							                <button type="submit" class="btn bg-blue">Update</button>
							            </div>
						            </div>
								</div>

						        
					    	</div>			    						    	
					    </form>
				    </div>
				</div>
			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
<!-- /main navbar -->

@endsection
  @section('script')
  <script type="text/javascript">
   
  </script>
@endsection
