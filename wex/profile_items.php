	<div class="row">
		<div class="col-lg-4">
		</div>
		<div class="col-lg-4 profile-items-selector">
			<div class="btn-group">
			  <button type="button" class="btn btn-primary active" id="my-offers">My Offers</button>
			  <button type="button" class="btn btn-primary" id="my-requests">My Requests</button>
			  <button type="button" class="btn btn-primary" id="my-history">My History</button>
			</div>
		</div>
		<div class="col-md-4">
		  <select class="form-control sort-selector pull-right" id="profile-sort">
			<option value="time">Most Recent</option>
			<option value="views">Most Viewed</option>
			<option value="lowest-points">Lowest Points</option>
			<option value="highest-points">Highest Points</option>
		  </select>
		</div>
	</div>
	<div class="row" id="profile-items">
	</div>
	<div class="row">
		<div class="col-lg-4">
		</div>
		<div class="col-lg-4 items-pagination">
			<ul class="pagination-sm" id="profile-pagination">

			</ul>
		</div>
		<div class="col-lg-4 offers-itemnumber">
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
		// change buttons active state
		$(".btn-group > .btn").click(function(){
			//$(this).addClass("active").siblings().removeClass("active");
			$(".btn-group > .btn").removeClass("active");
			$(this).addClass("active");
			// re-populate graph
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
		
		// pagination
		var $pagination = $('#profile-pagination');
		var defaultOpts = {
			totalPages: 35,
			visiblePages: 4,
			onPageClick: function (event, page) {
				//$('#page-content').text('Page ' + page);
			}
		};
		$pagination.twbsPagination(defaultOpts);
	</script>