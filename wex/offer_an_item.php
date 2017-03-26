<!DOCTYPE html>
<html lang="en">
    <?php include "functions.php"; ?>
	<?php include "header.php"; ?>

  <body>
  
  	<script>
	  $(document).ready(function(){
		
		// populate category
		populateCategory($("#category"), function(){
			populateSubcategory(1, $("#subcategory"));
		});

		// bind events
		$("#category").change(function (){
			populateSubcategory($("#category").val(), $("#subcategory"));
		});
		
		$("#submit-offer").click(function () {
			var name = $("#input_item_name").val();
			var start_date = $("#input_price").val();
			var category = $("#category").val();
			var subcategory = $("#subcategory").val();
			var description = $("#input_description").val();
			var submit = $("#submit-offer").val();
			postOffer(name, price, category, subcategory, description, submit);
		});
	  });
	  
	</script>
  
  
	<?php include "navbar.php"; ?>
	
	<div class="banner-bottom">
 	
<!-- Offer_an_item_form------->
<div class="wex-background-color">
	<div class="wex-container">
        <div class="wex-item-title">
            <p style="text-align: center"> Offer an item </p>
         </div>
        <div class="wex-item-form">
            <form action="" method="post">
            	<label for="input_item_name" >Item name:</label>
            	<input type="text" id="input_item_name" class="form-control" name="name" placeholder="Item name">
                <br>
                
				<label for="input_item_price" >Price</label>
               	<input type="text" id="input_price" class="form-control" name="price" placeholder="£">
             	<br>
             	
             	<label for="input_category" >Category</label>
              	<select class="form-control" name="category" id="category">
	  				<option value="Home">Home</option>
	  				<option value="Outdoors">Outdoors</option>
  				</select>
             	<br>
             	
             	<label for="input_sub_category" >Sub-category</label>
               	<select class="form-control" name="subcategory" id="subcategory">
	  				<option value="Bike">Bike</option>
	  				<option value="Pan">Pan</option>
  				</select>
             	<br>
             
             	<label for="input_description" >Description</label>
                <input type="textarea"  style="width:100%;height:100px;" id="input_description" class="form-control" name="description" placeholder="Description">
				
				<!--upload the item's photo-->
			    <div class="image">   
          </div>

          <div class="container-upload-image">
            <div class="panel panel-default">
              <div class="panel-heading"><strong>Upload image for your item</strong></div>
                <div class="panel-body">

                <!-- Standard Form -->
                <h4>Select files from your computer</h4>
                <form action="" method="post" enctype="multipart/form-data" id="js-upload-form">
                  <div class="form-inline">
                   <div class="form-group">
                     <input type="file" name="files[]" id="js-upload-files" multiple>
                   </div>
                    <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload image</button>
                  </div>
                </form>
                </div>
            </div>
            	<br>
            	<div class="wex_item_button">
            		<button class="btn btn-md btn-primary btn-block" type="submit" id="submit-offer" value="submit">Make an offer</button>
            	</div>
            </form>

        </div>
            
    </div>
              
</div><!-- /.Offer_an_item_form-->

 

    </div><!-- /.banner-bottom -->
    <!-- /END THE FEATURETTES -->
    
    <?php include "footer.php"; ?>

  </body>
</html>