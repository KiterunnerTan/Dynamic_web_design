<!DOCTYPE html>
<html lang="en">
<?php include "functions.php"; ?>
<?php include "header.php"; ?>


  <body>
    <script>
	  $(document).ready(function(){
		
		//populate personal information
		populatePersonalInfo();
		
		// bind events
		$("#update-info").click(function() {
			var name = $("#name").val();
			var addr1 = $("#addr1").val();
			var addr2 = $("#addr2").val();
			var addr3 = $("#addr3").val();
			var phone = $("#phone").val();
			var city = $("#city").val();
			var postcode = $("#postcode").val();
			
			updatePersonalInfo(name, addr1, addr2, addr3, phone, city, postcode);
		});
		
		// submit to change password
		$("#update-password").click(function() {
			var old_pwd = $("#old-pwd").val();
			var new_pwd1 = $("#new-pwd1").val();
			var new_pwd2 = $("#new-pwd2").val();
			if (new_pwd1 == new_pwd2) {
				updatePassword(old_pwd, new_pwd1);
			} else {
				$("#responseModalHeader").html("Update Password");
				$("#responseModalBody").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Your new and retype password are not equal.</div>");
			}
		});
		
		// bind the update image button to show upload modal
		$("#update-image").click(function(){
			$("#responseModalHeader").html("Upload Profile Image");
			$("#responseModalBody").html("<input id=\"input-id\" name=\"profile-image\" type=\"file\" class=\"file\" data-preview-file-type=\"text\">");
			// bind the upload image
			$("#input-id").fileinput({
				uploadAsync: false,
				uploadUrl: "ajax_responses.php", // your upload server url
				uploadExtraData: function() {
					return {
						mode: 14
					};
				}
			});
		});
		
		// bind event to refresh information after an image has been uploaded
		$('#responseModal').on('hidden.bs.modal', function (e) {
			populatePersonalInfo();
		})
		
		// event to check both passwords are same
		$("#new-pwd2").keyup(function() {

			if (($("#new-pwd1").val() == $("#new-pwd2").val()) && ($("#new-pwd1").val() != "" && $("#new-pwd2").val() != "")) {
				//$("#signup-response").empty();
				//alert("hoo");
				$("#new-pwd1-group").removeClass("has-error");
				$("#new-pwd2-group").removeClass("has-error");
				$("#new-pwd1-group").addClass("has-success");
				$("#new-pwd2-group").addClass("has-success");
			} else if ($("#new-pwd1").val() != $("#new-pwd2").val()) {
				//alert("wah");
				//$("#signup-response").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Passwords are not equal</div>");
				//alert("hoo");
				$("#new-pwd1-group").removeClass("has-success");
				$("#new-pwd2-group").removeClass("has-success");			
				$("#new-pwd1-group").addClass("has-error");
				$("#new-pwd2-group").addClass("has-error");
				
			} else if ($("#new-pwd1").val() == "" && $("#new-pwd2").val() == "") {
				$("#new-pwd1-group").removeClass("has-error");
				$("#new-pwd2-group").removeClass("has-error");
				$("#new-pwd1-group").removeClass("has-success");
				$("#new-pwd2-group").removeClass("has-success");
			}
		});
		/*
		// datepicker for start date and end date
		$("#start_date").datepicker();
		$("#end_date").datepicker();
		
		// populate category
		populateCategory($("#category"), function(){
			populateSubcategory(1, $("#subcategory"));
		});

		// bind events
		$("#category").change(function (){
			populateSubcategory($("#category").val(), $("#subcategory"));
		});
		
		$("#submit-request").click(function () {
			var name = $("#input_item_name").val();
			var start_date = $("#start_date").val();
			var end_date = $("#end_date").val();
			var category = $("#category").val();
			var subcategory = $("#subcategory").val();
			var description = $("#input_description").val();
			postRequest(name, start_date, end_date, category, subcategory, description);
		});
		*/
	  });
	  
	</script>
    <?php include "navbar.php"; ?>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="banner-bottom">

      <?php include "profile_information_detail.php"; ?>

    </div><!-- /.banner-bottom -->
    <!-- /END THE FEATURETTES -->
    
    <?php include "footer.php"; ?>
    
    
  </body>
</html>
