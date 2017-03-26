<!-- banner-bottom -->
	<div class="offer-background-color">
	
		<div class="container offers-container">
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<p class="offers-button"><a class="btn btn-lg btn-red" href="#" role="button">Offer an item &raquo;</a></p>
				</div>
				<div class="col-md-4">
				  <select class="form-control sort-selector pull-right" id="offers-sort">
					<option value="time">Most Recent</option>
					<option value="views">Most Viewed</option>
					<option value="lowest-points">Lowest Points</option>
					<option value="highest-points">Highest Points</option>
				  </select>
				</div>
			</div>
			<div id="offers-items">
<!--
			<div class="banner-bottom-grids">
				<div class="col-md-4 banner-bottom-grid animated wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="500ms">
					 <div id="box" class="burst-circle teal">
						<div class="caption"></div>
						<img src="images/1.jpg" class="img-responsive" />
						<h4>Farmer</h4>
					</div>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse 
						cillum dolore eu fugiat nulla pariatur sint occaecat 
						</p>
				</div>
				<div class="col-md-4 banner-bottom-grid animated wow fadeInUpBig" data-wow-duration="1000ms" data-wow-delay="500ms">
					 <div id="box" class="burst-circle teal">
						<div class="caption"></div>
						<img src="images/2.jpg" class="img-responsive" />
						<h4>Farmer</h4>
					</div>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse 
						cillum dolore eu fugiat nulla pariatur sint occaecat 
						</p>
				</div>
				<div class="col-md-4 banner-bottom-grid animated wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="500ms">
					 <div id="box" class="burst-circle teal">
						<div class="caption"></div>
						<img src="images/3.jpg" class="img-responsive" />
						<h4>Farmer</h4>
					</div>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse 
						cillum dolore eu fugiat nulla pariatur sint occaecat 
						</p>
				</div>
				<div class="col-md-4 banner-bottom-grid animated wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="500ms">
					 <div id="box" class="burst-circle teal">
						<div class="caption"></div>
						<img src="images/1.jpg" class="img-responsive" />
						<h4>Farmer</h4>
					</div>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse 
						cillum dolore eu fugiat nulla pariatur sint occaecat 
						</p>
				</div>
				<div class="col-md-4 banner-bottom-grid animated wow fadeInUpBig" data-wow-duration="1000ms" data-wow-delay="500ms">
					 <div id="box" class="burst-circle teal">
						<div class="caption"></div>
						<img src="images/2.jpg" class="img-responsive" />
						<h4>Farmer</h4>
					</div>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse 
						cillum dolore eu fugiat nulla pariatur sint occaecat 
						</p>
				</div>
				<div class="col-md-4 banner-bottom-grid animated wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="500ms">
					 <div id="box" class="burst-circle teal">
						<div class="caption"></div>
						<img src="images/3.jpg" class="img-responsive" />
						<h4>Farmer</h4>
					</div>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse 
						cillum dolore eu fugiat nulla pariatur sint occaecat 
						</p>
				</div>
				<div class="col-md-4 banner-bottom-grid animated wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="500ms">
					 <div id="box" class="burst-circle teal">
						<div class="caption"></div>
						<img src="images/1.jpg" class="img-responsive" />
						<h4>Farmer</h4>
					</div>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse 
						cillum dolore eu fugiat nulla pariatur sint occaecat 
						</p>
				</div>
				<div class="col-md-4 banner-bottom-grid animated wow fadeInUpBig" data-wow-duration="1000ms" data-wow-delay="500ms">
					 <div id="box" class="burst-circle teal">
						<div class="caption"></div>
						<img src="images/2.jpg" class="img-responsive" />
						<h4>Farmer</h4>
					</div>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse 
						cillum dolore eu fugiat nulla pariatur sint occaecat 
						</p>
				</div>
				<div class="col-md-4 banner-bottom-grid animated wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="500ms">
					 <div id="box" class="burst-circle teal">
						<div class="caption"></div>
						<img src="images/3.jpg" class="img-responsive" />
						<h4>Farmer</h4>
					</div>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse 
						cillum dolore eu fugiat nulla pariatur sint occaecat 
						</p>
				</div>
				<div class="clearfix"> </div>
			</div>
-->	
			</div>
			<div class="row">
				<div class="col-lg-4">
				</div>
				<div class="col-lg-4 profile-items-pagination">
					<ul class="pagination-sm" id="offers-pagination">

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
				// pagination
				var $pagination = $('#offers-pagination');
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