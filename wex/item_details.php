
 	<!-- Item_detail
    ================================================== -->
<div class="wex-background-color">
<div class="wex-container">

	<div class="row featurette">
        <div class="col-md-6 col-md-push-6">
          <h3 class="featurette-heading" id="item-title"></h3>
          <h4>Description:</h4>
		  <div id="item-description">
		  </div>
	 	  <h4>Pick up address:</h4>
			<div id="item-address"></div>
	      <h4>Points: <div id="item-points"></div></h4>
	      <a class="btn btn-success" href="checkout.php"> MAKE AN EXCHANGE </a>
        </div>
       
	    <div class="col-md-6 col-md-pull-6">
			<ul class="nav nav-tabs">
				<li class="active"> <a href="#item_image">Item image</a></li>
				<li><a href="#location">Location</a></li>
			</ul>

			<div class="tab-content">
				<div id="item_image" class="tab-pane fade in active item-details-tab">
					<img id="item-images" class="featurette-image img-responsive center-block item-details-images" src="images/2.jpg" alt="Generic placeholder image">
				</div>
				<div id="location" class="tab-pane fade">
					<div id="googleMap" style="width:600px;height:450px;"></div>

				</div>
				<script>


						// currently not working because of asynchronous load
						//var myLat = $("#lat").val();
						//var myLong = $("#long").val();
						var myLat = 55.953251;
						var myLong = -3.188267;
					function myMap() {
						var mapProp= {
							center:new google.maps.LatLng(55.953251,-3.188267),
							zoom:12,
						};
						var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
					}
				
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd4WukgpsGzNkldRUTnWAyD7tC_c0R3b4&callback=myMap"></script>
			</div>
       
        </div>
 	</div>
       
	<br>

<!--progress bar-->
<div class="row featurette layout">
	<div class="col-md-6">
		<p>Feedback:</p>
		<div class="progress">
		  <div class="progress-bar progress-bar-success" role="progressbar" style="width:40%">
			40% Positive
		  </div>
		  <div class="progress-bar progress-bar-warning" role="progressbar" style="width:30%">
			30% Nutral
		  </div>
		  <div class="progress-bar progress-bar-danger" role="progressbar" style="width:30%">
			30% Negative
		  </div>
		</div>
	</div>
</div>


</div>
    
</div><!-- /.Item_detail-->
