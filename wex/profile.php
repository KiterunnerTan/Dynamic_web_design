<!DOCTYPE html>
<html lang="en">
	<?php include "functions.php"; ?>
	<?php include "header.php"; ?>

  <body>
    <script>
	  $(document).ready(function(){
  		// set active navigation for user
  		$("#nav-user-pages").attr({
			"class" : "active"
		});
		$("#nav-user-profile").attr({
			"class" : "active"
		});
		// populate elements
		
		// populate items
		populateItemsProfile($("#profile-sort").val(), $("#number-items").val(), 1, function(totalPages) {
			$pagination.twbsPagination('destroy');
			$pagination.twbsPagination($.extend({}, defaultOpts, {
				totalPages: totalPages,
				visiblePages: 4,
				onPageClick: function (event, page) {
					populateItemsProfile($("#profile-sort").val(), $("#number-items").val(), page, function(i) {
						// do nothing for callback
					});
					//$('#page-content').text('Page ' + page);
				}
			}));
		});

		$("#profile-sort").change(function(){
			populateItemsProfile($("#profile-sort").val(), $("#number-items").val(), 1, function(totalPages) {
				$pagination.twbsPagination('destroy');
				$pagination.twbsPagination($.extend({}, defaultOpts, {
					totalPages: totalPages,
					visiblePages: 4,
					onPageClick: function (event, page) {
						populateItemsProfile($("#profile-sort").val(), $("#number-items").val(), page, function(i) {
							// do nothing for callback
						});
						//$('#page-content').text('Page ' + page);
					}
				}));
			});
		});
		
		$("#number-items").change(function(){
			populateItemsProfile($("#profile-sort").val(), $("#number-items").val(), 1, function(totalPages) {
				$pagination.twbsPagination('destroy');
				$pagination.twbsPagination($.extend({}, defaultOpts, {
					totalPages: totalPages,
					visiblePages: 4,
					onPageClick: function (event, page) {
						populateItemProfile($("#profile-sort").val(), $("#number-items").val(), page, function(i) {
							// do nothing for callback
						});
						//$('#page-content').text('Page ' + page);
					}
				}));
			});
		});

  		// offers sort by
		/*
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
		*/
		// bind events
		
		
	  });
	</script>
	
	<?php include "navbar.php"; ?>

	<?php include "profile_header.php"; ?>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

	<?php include "profile_items.php"; ?>

	<?php //include "requests_latest.php"; ?>

    </div><!-- /.container -->
      <!-- /END THE FEATURETTES -->


	<?php include "footer.php"; ?>

  </body>
</html>