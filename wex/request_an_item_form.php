 <!-- Request_an_item_form
    ================================================== -->
    <div class="wex-background-color">
      <!-- Indicators -->
       <div class="wex-container">
             
             <div class="wex-item-title">
               <p class="wex-button">  Request an item </p>
             </div>
            
            <div class="wex-item-form">
				<form class="form-horizontal">
					<div id="request-response">
					</div>
					<div class="form-group">
						<label for="input_item_name" class="control-label col-lg-2">Item name: </label>
						<div class="col-lg-10">
						   <input type="text" id="input_item_name" class="form-control" placeholder="Item name">
						</div>
					</div>
					<div class="form-group">
						<label for="start_date" class="control-label col-lg-2">Start Date: </label>
						<div class="col-lg-4">
						   <input type="text" id="start_date" class="form-control" placeholder="Start date">
						</div>
						<label for="end_date" class="control-label col-lg-2">End Date: </label>
						<div class="col-lg-4">
						   <input type="text" id="end_date" class="form-control" placeholder="End date">
						</div>
					</div>			
					<div class="form-group">
						<label for="input_days" class="control-label col-lg-2">Category: </label>
						<div class="col-lg-4">
							<select class="form-control" id="category">
							</select>
						</div>
						<label for="input_days" class="control-label col-lg-2">Sub Category: </label>
						<div class="col-lg-4">
							<select class="form-control" id="subcategory">
							</select>
						</div>
					</div>	
					<div class="form-group">
						<label for="input_description" class="control-label col-lg-2">Description: </label>
						<div class="col-lg-10">
						   <textarea rows="5" id="input_description" class="form-control" placeholder="Description"></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<div class="wex-item-button col-lg-8 col-lg-offset-2">
							<button type="button" class="btn btn-lg btn-primary" id="submit-request" value="submit">Request</button>
						</div>
					</div>


				</form>

            </div>
            
       </div>
              
    </div><!-- /.Request_an_item_form-->
