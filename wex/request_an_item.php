<!DOCTYPE html>
<html lang="en">
	<?php include "functions.php"; ?>
	<?php include "header.php"; ?>

  <body>
    <script>
	  $(document).ready(function(){
		
		
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
			var submit = $("#submit-request").val();
			postRequest(name, start_date, end_date, category, subcategory, description, submit);
		});
		
	  });
	  
	  
	</script>
	<?php include "navbar.php"; ?>
 
    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

	<div class="banner-bottom">
		<?php include "request_an_item_form.php"; ?>
    </div><!-- /.banner-bottom -->
    <!-- /END THE FEATURETTES -->
    
    <?php include "footer.php"; ?>

  </body>
</html>