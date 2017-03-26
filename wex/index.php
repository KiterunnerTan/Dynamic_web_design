<!DOCTYPE html>
<html lang="en">
	<?php include "functions.php"; ?>
	<?php include "header.php"; ?>

  <body>
    <script>
	  $(document).ready(function(){
		// set active navigation for home
  		$("#nav-home").attr({
			"class" : "active"
		});

  
		// populate elements
		
		// populate offers
		populateOffersHome($("#offers-sort").val());
		populateRequestsHome($("#requests-sort").val());

  		// offers sort by
		$("#offers-sort").change(function(){
			var offer_sort = $("#offers-sort").val();
			if (offer_sort.localeCompare("time") == 0) {
				$("#offers-home-title").text("What's New > Offers: ");
				//alert("time");
			} else if (offer_sort.localeCompare("views") == 0) {
				$("#offers-home-title").text("What's Popular > Offers: ");
				//alert("view");
			}
			populateOffersHome($("#offers-sort").val());
		});
		
  		// requests sort by
		$("#requests-sort").change(function(){
			var request_sort = $("#requests-sort").val();
			if (request_sort.localeCompare("time") == 0) {
				$("#requests-home-title").text("What's New > Requests: ");
				//alert("time");
			} else if (request_sort.localeCompare("views") == 0) {
				$("#requests-home-title").text("What's Popular > Requests: ");
				//alert("view");
			}
			populateRequestsHome($("#requests-sort").val());
		});		
		
		// bind events
		
		
	  });
	</script>
	
	<?php include "navbar.php"; ?>
	<?php include "carousel.php"; ?>


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
    
    <?php include "introduction.php"; ?>

	<?php include "offers_latest.php"; ?>

	<?php include "requests_latest.php"; ?>
    
    <?php include "about_us.php"; ?>
    <?php include "contact_us.php";?>

    </div><!-- /.container -->
      <!-- /END THE FEATURETTES -->


	<?php include "footer.php"; ?>

  </body>
</html>