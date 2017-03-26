<!DOCTYPE html>
<html lang="en">
<?php include "functions.php"; ?>
<?php include "header.php"; ?>


  <body>
    <?php include "navbar.php"; ?>
	<input type="hidden" id="item_id" value="<?php echo $_GET['id']; ?>">
	<input type="hidden" id="item_type" value="<?php echo $_GET['type']; ?>">
	<input type="hidden" id="lat" value="">
	<input type="hidden" id="long" value="">	

	<script>
		$(document).ready(function(){
    		$(".nav-tabs a").click(function(){
        		$(this).tab('show');
    		});
			
			populateItemDetails($("#item_id").val(), $("#item_type").val());
	
		});
		
		
	</script>
   

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="banner-bottom">

      <?php include "item_details.php"; ?>

    </div><!-- /.banner-bottom -->
    <!-- /END THE FEATURETTES -->
    
    <?php include "footer.php"; ?>
    
    
  </body>
</html>
