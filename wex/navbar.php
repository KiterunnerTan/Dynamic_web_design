<!-- NAVBAR
================================================== -->
	<div class="header">
		<div class="container">
				<nav class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
						<div class="logo">
							<h1><a class="navbar-brand" href="index.php"><label>WE</label>xchange<span>exchange for your need </span></a></h1>
						</div>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					 <ul class="nav navbar-nav">
						<li class="hvr-sweep-to-bottom"><a href="index.php">Home</a></li>
						<li class="hvr-sweep-to-bottom"><a href="offers_page.php" class="scroll">Offer</a></li>
						<li class="hvr-sweep-to-bottom"><a href="requests_page.php" class="scroll">Request</a></li>
					  </ul>
					  
					  
			  <?php 
				if (isset($_SESSION['userid'])) { 
			  ?>
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
                <li id="nav-user-pages" class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li id="nav-user-profile"><a href="profile.php">My Profile</a></li>
                    <li><a href="profile_information.php">Edit My Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">My History</li>
                    <li><a href="#">Offers</a></li>
                    <li><a href="#">Requests</a></li>
                  </ul>
                </li>
			  </ul>
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-envelope"></span></a></li>
				<li><a href="#"><span class="glyphicon glyphicon-bullhorn"></span></a></li>
			  </ul>
			  <?php 
				} else { 
			  ?>
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="#" data-toggle="modal" data-target="#signupModal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				<li><a href="#" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			  </ul>
			  <?php 
				}
			  ?>
			  

					  
					</div><!-- /.navbar-collapse -->
				</nav>
		</div>
	</div>

	



<!-- Modal -->
	<div id="loginModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Login</h4>
		  </div>
		  <div class="modal-body">
		    <div id="login-response">

			</div>
		  
		  <!-- login form start -->
		    <form class="form-horizontal">
			  <div class="form-group">
				<label class="control-label col-sm-2" for="login-email">Email:</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" id="login-email" placeholder="Enter email">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="login-pwd">Password:</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" id="login-pwd" placeholder="Enter password">
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <div class="checkbox">
					<label><input type="checkbox"> Remember me</label>
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="button" class="btn btn-default" id="login-button" value="submit">Login</button>
				</div>
			  </div>
			</form>
		  
			<!--<p>Some text in the modal.</p>-->
			
		  <!-- end login form -->
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
		<script>
		  // event when submit is clicked
		  $("#login-button").click(function() {
			  // submit form
			  login($("#login-email").val(), $("#login-pwd").val(), $("#login-button").val(), function(loginresponse) {
			  
				  if (loginresponse == 0) {
					  location.reload();	// refresh page
				  } else if (loginresponse == 1) {
					  $("#login-response").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Email not found.</div>");
				  } else if (loginresponse == 2) {
					  $("#login-response").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Your password is incorrect.</div>");
				  }
				  
			  });
		  });
		  
		  // event when close button is clicked
		  $("button[data-dismiss='modal']").click(function() {

			$("#login-email").val('');
			$("#login-pwd").val('');
			$("#login-response").empty();
		  });
		</script>

	  </div>
	</div>
	
	<div id="signupModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Sign Up</h4>
		  </div>
		  <div class="modal-body">
		    <div id="signup-response">

			</div>
		  
		  <!-- sign up form start -->
		    <form class="form-horizontal">
			  <div class="form-group">
				<label class="control-label col-sm-2" for="signup-name">Name:</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="signup-name" placeholder="Enter name">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="signup-email">Email:</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" id="signup-email" placeholder="Enter email">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="signup-pwd">Password:</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" id="signup-pwd" placeholder="Enter password">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-sm-2" for="signup-pwd2">Retype Password:</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" id="signup-pwd2" placeholder="Retype password">
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="button" class="btn btn-default" id="signup-button" value="signup">Sign Up</button>
				</div>
			  </div>
			</form>
		  
			<!--<p>Some text in the modal.</p>-->
			
		  <!-- end signup form -->
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
		<script>
		  // event when submit is clicked
		  $("#signup-button").click(function() {
			  if ($("#signup-name").val() !== "" && $("#signup-email").val() !== "" && ($("#signup-pwd").val() === $("#signup-pwd2").val())) {
			  
				  // submit form
				  signup($("#signup-name").val(), $("#signup-email").val(), $("#signup-pwd").val(), $("#signup-button").val(), function(signupresponse) {
				  
					  if (signupresponse == 0) {
						  $("#signup-response").html("<div class=\"alert alert-success\">\n<strong>Success!</strong> You can login now.</div>");
					  } else if (signupresponse == 1) {
						  $("#signup-response").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Email already exist.</div>");
					  } 
					  
				  });
			  } else {
				  $("#signup-response").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Make sure the name and email are not blank and the passwords are equal</div>");
			  }
		  });
		  
		  // event when close button is clicked
		  $("button[data-dismiss='modal']").click(function() {

			$("#signup-email").val('');
			$("#signup-pwd").val('');
			$("#signup-pwd2").val('');
			$("#signup-response").empty();
		  });
		  
		  // event to check both passwords are same
		  $("#signup-pwd2").keyup(function() {

			if ($("#signup-pwd").val() === $("#signup-pwd2").val()) {
				$("#signup-response").empty();
				//alert("hoo");
			} else {
				//alert("wah");
				$("#signup-response").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Passwords are not equal</div>");
			}
		  });
		</script>

	  </div>
	</div>
	
	<!-- Response Modal -->
	<div id="responseModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title" id="responseModalHeader">Modal Header</h4>
		  </div>
		  <div class="modal-body" id="responseModalBody">
			<p>Some text in the modal.</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>

	  </div>
	</div>