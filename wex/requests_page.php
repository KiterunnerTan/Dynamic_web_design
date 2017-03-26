<!DOCTYPE html>
<html lang="en">
	<?php include "functions.php"; ?>
	<?php include "header.php"; ?>


  <body>
  
  <script>
	  $(document).ready(function(){
		// set active navigation for requests
  		$("#nav-requests").attr({
			"class" : "active"
		});
		
		// populate elements
		
		// populate requests
		populateRequests($("#requests-sort").val(), $("#number-items").val(), 1, function(totalPages) {
			$pagination.twbsPagination('destroy');
			$pagination.twbsPagination($.extend({}, defaultOpts, {
				totalPages: totalPages,
				visiblePages: 4,
				onPageClick: function (event, page) {
					populateRequests($("#requests-sort").val(), $("#number-items").val(), page, function(i) {
							// do nothing for callback
						});
					//$('#page-content').text('Page ' + page);
				}
			}));
		});

		// bind events
  		// requests sort by
		$("#requests-sort").change(function(){
			populateRequests($("#requests-sort").val(), $("#number-items").val(), 1, function(totalPages) {
				$pagination.twbsPagination('destroy');
				$pagination.twbsPagination($.extend({}, defaultOpts, {
					totalPages: totalPages,
					visiblePages: 4,
					onPageClick: function (event, page) {
						populateRequests($("#requests-sort").val(), $("#number-items").val(), page, function(i) {
							// do nothing for callback
						});
						//$('#page-content').text('Page ' + page);
					}
				}));
			});
		});
		
		$("#number-items").change(function(){
			populateRequests($("#requests-sort").val(), $("#number-items").val(), 1, function(totalPages) {
				$pagination.twbsPagination('destroy');
				$pagination.twbsPagination($.extend({}, defaultOpts, {
					totalPages: totalPages,
					visiblePages: 4,
					onPageClick: function (event, page) {
						populateRequests($("#requests-sort").val(), $("#number-items").val(), page, function(i) {
							// do nothing for callback
						});
						//$('#page-content').text('Page ' + page);
					}
				}));
			});
		});
		

		
		
	  });
	</script>
  
    <?php include "navbar.php"; ?>


   

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

	<div class="banner-bottom">

      <?php include "requests_list.php"; ?>

    </div><!-- /.banner-bottom -->
    <!-- /END THE FEATURETTES -->
    
    <?php include "footer.php"; ?>
    
    
  </body>
</html>
