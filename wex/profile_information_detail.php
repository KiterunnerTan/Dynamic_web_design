  <link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
 
  <script src="js/fileinput.min.js"></script>
 
<!-- profile_information_detail
    ================================================== -->
    <div class="wex-background-color">
      <!-- Indicators -->
       <div class="container wex-container">
			<div class="row">
				<h1 align="center" class="page-header">Edit Personal Profile</h1>
			</div>
			<div class="row">
				
				<div class="col-lg-3 panel panel-default">
				    <div class="panel-heading">Profile Image</div>
					<div class="panel-body">
						<div class="col-lg-10 col-lg-offset-1 profile-image-container">
							<img id="profile-image" class="profile-image" src="">
						</div>
						<div class="col-lg-8 col-lg-offset-2">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#responseModal" id="update-image">Update image</button>
						</div>
					</div>
					
					
				</div>
				<div class="col-lg-9 panel panel-default">
				    <div class="panel-heading">Personal Information</div>
					<div class="panel-body">
						<form class="form-horizontal">
						  <div class="form-group">
							<label class="control-label col-sm-2" for="email">Email:</label>
							<div class="col-sm-10">
							  <input type="email" class="form-control" id="email" placeholder="Enter email" disabled>
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-sm-2" for="name">Name:</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="name" placeholder="Enter name">
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-sm-2" for="addr1">Address Line 1:</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" id="addr1" placeholder="Enter address">
							</div>
							<label class="control-label col-sm-2" for="phone">Phone:</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" id="phone" placeholder="Enter phone number">
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-sm-2" for="addr2">Address Line 2:</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" id="addr2" placeholder="Enter address line 2">
							</div>
							<label class="control-label col-sm-2" for="city">City/town:</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" id="city" placeholder="Enter city">
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-sm-2" for="addr3">Address Line 3:</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" id="addr3" placeholder="Enter address line 3">
							</div>
							<label class="control-label col-sm-2" for="postcode">Postcode:</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" id="postcode" placeholder="Enter postcode">
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#responseModal" id="update-info">Update</button>
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <div class="checkbox">
								<label><input type="checkbox" data-toggle="collapse" data-target="#password"> Change password</label>
							  </div>
							</div>
						  </div>
						  <div id="password" class="collapse">
						  <div class="form-group" id="old-pwd-group">
							<label class="control-label col-sm-2" for="pwd">Current:</label>
							<div class="col-sm-10">
							  <input type="password" class="form-control" id="old-pwd" placeholder="Enter current password">
							</div>
						  </div>
						  <div class="form-group" id="new-pwd1-group">
							<label class="control-label col-sm-2" for="pwd">New:</label>
							<div class="col-sm-10">
							  <input type="password" class="form-control" id="new-pwd1" placeholder="Enter new password">
							</div>
						  </div>
						  <div class="form-group" id="new-pwd2-group">
							<label class="control-label col-sm-2" for="pwd">Retype New:</label>
							<div class="col-sm-10">
							  <input type="password" class="form-control" id="new-pwd2" placeholder="Enter new password again">
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#responseModal" id="update-password">Change password</button>
							</div>
						  </div>
						  </div>
						</form>
						
					
					</div>				
				</div>				
		
			</div>

       </div>
    </div><!-- /.profile_information_detail-->
