<!DOCTYPE html>
<html lang="en">
	<?php include "functions.php"; ?>
	<?php include "header.php"; ?>


  <body>
  
  <script>
	  $(document).ready(function(){
		// set active navigation for offers
  		$("#nav-offers").attr({
			"class" : "active"
		});
		
		// populate elements
		
		// populate offers
		populateOffers($("#offers-sort").val(), $("#number-items").val(), 1, function(totalPages) {
			$pagination.twbsPagination('destroy');
			$pagination.twbsPagination($.extend({}, defaultOpts, {
				totalPages: totalPages,
				visiblePages: 4,
				onPageClick: function (event, page) {
					populateOffers($("#offers-sort").val(), $("#number-items").val(), page, function(i) {
							// do nothing for callback
						});
					//$('#page-content').text('Page ' + page);
				}
			}));
		});
		//populateRequestsHome($("#requests-sort").val());

  		// offers sort by
		$("#offers-sort").change(function(){
			populateOffers($("#offers-sort").val(), $("#number-items").val(), 1, function(totalPages) {
				$pagination.twbsPagination('destroy');
				$pagination.twbsPagination($.extend({}, defaultOpts, {
					totalPages: totalPages,
					visiblePages: 4,
					onPageClick: function (event, page) {
						populateOffers($("#offers-sort").val(), $("#number-items").val(), page, function(i) {
							// do nothing for callback
						});
						//$('#page-content').text('Page ' + page);
					}
				}));
			});
		});
		
		$("#number-items").change(function(){
			populateOffers($("#offers-sort").val(), $("#number-items").val(), 1, function(totalPages) {
				$pagination.twbsPagination('destroy');
				$pagination.twbsPagination($.extend({}, defaultOpts, {
					totalPages: totalPages,
					visiblePages: 4,
					onPageClick: function (event, page) {
						populateOffers($("#offers-sort").val(), $("#number-items").val(), page, function(i) {
							// do nothing for callback
						});
						//$('#page-content').text('Page ' + page);
					}
				}));
			});
		});
  		// requests sort by
		/*
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
		*/
		
		// bind events
		
		
	  });
	</script>
  
    <?php include "navbar.php"; ?>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

	<div class="banner-bottom">

      <?php include "offers_list.php"; ?>

    </div><!-- /.banner-bottom -->
    <!-- /END THE FEATURETTES -->
    
    <?php include "footer.php"; ?>
    
    
  </body>
</html>
