<!-- banner-bottom -->
	<div class="wex-background-color">
	
		<div class="container wex-container">
            <div class="row">
				<div class="col-md-4 col-md-offset-4">
					<p class="wex-button"><a class="btn btn-lg btn-red" href="reuquest_an_item.php" role="button">Request an item &raquo;</a></p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
				</div>
				
				<div class="col-md-4 pull-right">
				  <select class="form-control sort-selector pull-right" id="requests-sort">
					<option value="time">Most Recent</option>
					<option value="views">Most Viewed</option>
					<option value="lowest-points">Lowest Points</option>
					<option value="highest-points">Highest Points</option>
				  </select>
				</div>
			</div>
			<div id="requests-items">

			</div>
			<div class="row">
				<div class="col-lg-4">
				</div>
				<div class="col-lg-4 items-pagination">
					<ul class="pagination-sm" id="requests-pagination">

					</ul>
				</div>
				<div class="col-lg-4 requests-itemnumber">
					<label for="number-items" class="control-label">Items per page: </label> 
					<select class="form-control sort-selector pull-right" id="number-items">
						<option value="3">3 items</option>
						<option value="12">12 items</option>
						<option value="24">24 items</option>
						<option value="48">48 items</option>
						<option value="96">96 items</option>
					</select>
				</div>
			</div>
			<script src="js/jquery.twbsPagination.js" type="text/javascript"></script>
			<script>
				// pagination
				var $pagination = $('#requests-pagination');
				var defaultOpts = {
					totalPages: 35,
					visiblePages: 4,
					onPageClick: function (event, page) {
						//$('#page-content').text('Page ' + page);
					}
				};
				$pagination.twbsPagination(defaultOpts);
			</script>
			
		</div>
	</div>
<!-- //banner-bottom -->