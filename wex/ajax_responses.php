<?php

/*
	Filename: ajax_responses.php
	Description: A PHP page to response ajax requests. This file has several modes for the query
	
	Mode:
	1 - Return top offers based on sorting (date, most viewed) on home page
	2 - Return top requests based on sorting (date, most viewed) on home page
	3 - Return all active offers on offer page 
	4 - Return all requests on requests page 
	5 - Return all user's offers on profile page
	6 - Return all user's requests on profile page
	7 - Return all categories
	8 - Return all subcategories based on the category selected
	9 - Insert an offer
	10 - Insert a request 
	11 - Return Personal Information
	12 - Update Personal Information
	13 - Update Password
	14 - Upload Profile Picture
	15 - Return Item Details
*/

	include("functions.php");
	
	// initialise connection
	$mysqli = getConnection();
	
	// get mode (see description above)
	if (isset($_GET['mode'])) {
		$mode = $_GET['mode'];			
	} else if (isset($_POST['mode'])) {
		$mode = $_POST['mode'];	
	}
	
	if ($mode == 1) {				// return offers
		
		// get additional parameters
		$order = $_GET['order'];
		
		$stmt =  $mysqli->stmt_init();
	
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.description, tbl1.price * (SELECT multiplier FROM db_points_convert WHERE type = \"d\") AS points, 
					IFNULL((SELECT image FROM db_items_offers_images WHERE isdefault = 1 AND items_offers_id = tbl1.id), 
						(SELECT image FROM db_items_offers_images WHERE items_offers_id = tbl1.id LIMIT 0,1)) 
				FROM db_items_offers AS tbl1 
				WHERE tbl1.active = 1 ";
		if ($order == "time") {
			$sql .= "ORDER BY tbl1.timestamp DESC ";
		} else if ($order == "views") {
			$sql .= "ORDER BY tbl1.views DESC ";
		} else if ($order == "lowest-points") {
			$sql .= "ORDER BY tbl1.price ASC ";
		} else if ($order == "highest-points") {
			$sql .= "ORDER BY tbl1.price DESC ";
		} 
		$sql .= "LIMIT 0,".$home_num_of_offers;

		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->execute();
			
			$stmt->bind_result($offer_id, $offer_name, $offer_desc, $offer_points, $offer_image);
			$stmt->store_result();
			
			// create output array
			$output = array();	
	
			if ($stmt->num_rows) {
	
				// loop through the results
				while ($stmt->fetch()) {
					$offer = array('id' => $offer_id, 'name' => $offer_name, 'desc' => $offer_desc, 'points' => $offer_points, 'image' => $offer_image);
					$output[] = $offer;
				}

			}
			echo json_encode($output);
		}
		$stmt->close();
		
	} else 	if ($mode == 2) {				// return requests
		
		// get additional parameters
		$order = $_GET['order'];
		
		$stmt =  $mysqli->stmt_init();
	
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.description, IF(subcategory IS NOT NULL, 
					(SELECT image FROM db_category_subcategory WHERE db_category_subcategory.id = subcategory),
					(SELECT image FROM db_category WHERE db_category.id = category)) AS image 
				FROM db_items_requests AS tbl1 ";
		if ($order == "time") {
			$sql .= "ORDER BY tbl1.timestamp DESC ";
		} else if ($order == "views") {
			$sql .= "ORDER BY tbl1.views DESC ";
		}
		$sql .= "LIMIT 0,".$home_num_of_requests;

		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->execute();
			
			$stmt->bind_result($request_id, $request_name, $request_desc, $request_image);
			$stmt->store_result();
			
			// create output array
			$output = array(); 
			
			if ($stmt->num_rows) {
				
				// loop through the results
				while ($stmt->fetch()) {
					$request = array('id' => $request_id, 'name' => $request_name, 'desc' => $request_desc, 'image' => $request_image);
					$output[] = $request;
				}
			}
			echo json_encode($output);
		}
		$stmt->close();
	} else if ($mode == 3) {				// return all offers on offer page
		
		// get additional parameters
		$order = $_GET['order'];
		$numitems = $_GET['numitems'];
		$offset = $_GET['offset'] -1;		// to start from 0
		$offset = $offset * $numitems;	
		
		// get total items
		$stmt =  $mysqli->stmt_init();
		
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.description, tbl1.price * (SELECT multiplier FROM db_points_convert WHERE type = \"d\") AS points, 
					IFNULL((SELECT image FROM db_items_offers_images WHERE isdefault = 1 AND items_offers_id = tbl1.id), 
						(SELECT image FROM db_items_offers_images WHERE items_offers_id = tbl1.id LIMIT 0,1)) 
				FROM db_items_offers AS tbl1 
				WHERE tbl1.active = 1 ";
		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->execute();
			
			$stmt->bind_result($offer_id, $offer_name, $offer_desc, $offer_points, $offer_image);
			$stmt->store_result();
		
			if ($stmt->num_rows) {
				$num_pages = ceil($stmt->num_rows/$numitems);
			} else {
				$num_pages = 0;
			}
		}
		$stmt->close();
		
		// get items
		$stmt =  $mysqli->stmt_init();
		
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.description, tbl1.price * (SELECT multiplier FROM db_points_convert WHERE type = \"d\") AS points, 
					IFNULL((SELECT image FROM db_items_offers_images WHERE isdefault = 1 AND items_offers_id = tbl1.id), 
						(SELECT image FROM db_items_offers_images WHERE items_offers_id = tbl1.id LIMIT 0,1)) 
				FROM db_items_offers AS tbl1 
				WHERE tbl1.active = 1 ";
		if ($order == "time") {
			$sql .= "ORDER BY tbl1.timestamp DESC ";
		} else if ($order == "views") {
			$sql .= "ORDER BY tbl1.views DESC ";
		} else if ($order == "lowest-points") {
			$sql .= "ORDER BY tbl1.price ASC ";
		} else if ($order == "highest-points") {
			$sql .= "ORDER BY tbl1.price DESC ";
		} 
		
		$sql .= "LIMIT ".$offset.",".$numitems;

		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->execute();
			
			$stmt->bind_result($offer_id, $offer_name, $offer_desc, $offer_points, $offer_image);
			$stmt->store_result();

			// create items array
			$items = array(); 
				
			if ($stmt->num_rows) {
				
				// loop through the results
				while ($stmt->fetch()) {
					$offer = array('id' => $offer_id, 'name' => $offer_name, 'desc' => $offer_desc, 'points' => $offer_points, 'image' => $offer_image);
					$items[] = $offer;
				}

			}
			$output = array('pages' => $num_pages, 'items' => $items); 
			echo json_encode($output);
		
		}
		$stmt->close();
		
	} else if ($mode == 4) {				// return all requests on requests page
		
		// get additional parameters
		$order = $_GET['order'];
		$numitems = $_GET['numitems'];
		$offset = $_GET['offset'] -1;		// to start from 0
		$offset = $offset * $numitems;	
		
		$stmt =  $mysqli->stmt_init();
	
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.description, IF(subcategory IS NOT NULL, 
					(SELECT image FROM db_category_subcategory WHERE db_category_subcategory.id = subcategory),
					(SELECT image FROM db_category WHERE db_category.id = category)) AS image 
				FROM db_items_requests AS tbl1 ";

		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->execute();
			
			$stmt->bind_result($request_id, $request_name, $request_desc, $request_image);
			$stmt->store_result();
		
			if ($stmt->num_rows) {
				$num_pages = ceil($stmt->num_rows/$numitems);
			} else {
				$num_pages = 0;
			}
		
		}
		$stmt->close();
		
		$stmt =  $mysqli->stmt_init();
	
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.description, IF(subcategory IS NOT NULL, 
					(SELECT image FROM db_category_subcategory WHERE db_category_subcategory.id = subcategory),
					(SELECT image FROM db_category WHERE db_category.id = category)) AS image 
				FROM db_items_requests AS tbl1 ";
		if ($order == "time") {
			$sql .= "ORDER BY tbl1.timestamp DESC ";
		} else if ($order == "views") {
			$sql .= "ORDER BY tbl1.views DESC ";
		}
		$sql .= "LIMIT ".$offset.",".$numitems;

		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->execute();
			
			$stmt->bind_result($request_id, $request_name, $request_desc, $request_image);
			$stmt->store_result();
	
			// create items array
			$items = array();
				
			if ($stmt->num_rows) {

				// loop through the results
				while ($stmt->fetch()) {
					$request = array('id' => $request_id, 'name' => $request_name, 'desc' => $request_desc, 'image' => $request_image);
					$items[] = $request;
				}

			}
			$output = array('pages' => $num_pages, 'items' => $items); 
			echo json_encode($output);
		}
		$stmt->close();
	} else if ($mode == 5) {				// return all user's offers on profile page
		
		// get additional parameters
		$order = $_GET['order'];
		$numitems = $_GET['numitems'];
		$offset = $_GET['offset'] -1;		// to start from 0
		$offset = $offset * $numitems;	
		
		// get total items
		$stmt =  $mysqli->stmt_init();
		
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.description, tbl1.price * (SELECT multiplier FROM db_points_convert WHERE type = \"d\") AS points, 
					IFNULL((SELECT image FROM db_items_offers_images WHERE isdefault = 1 AND items_offers_id = tbl1.id), 
						(SELECT image FROM db_items_offers_images WHERE items_offers_id = tbl1.id LIMIT 0,1)) 
				FROM db_items_offers AS tbl1 
				WHERE tbl1.active = 1 AND tbl1.owner = ?";
				
		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->bind_param("d", $_SESSION['userid']);
			$stmt->execute();
			
			$stmt->bind_result($offer_id, $offer_name, $offer_desc, $offer_points, $offer_image);
			$stmt->store_result();
		
			if ($stmt->num_rows) {
				$num_pages = ceil($stmt->num_rows/$numitems);
			} else {
				$num_pages = 0;
			}
		}
		$stmt->close();

		
		// get items
		$stmt =  $mysqli->stmt_init();
		
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.description, tbl1.price * (SELECT multiplier FROM db_points_convert WHERE type = \"d\") AS points, 
					IFNULL((SELECT image FROM db_items_offers_images WHERE isdefault = 1 AND items_offers_id = tbl1.id), 
						(SELECT image FROM db_items_offers_images WHERE items_offers_id = tbl1.id LIMIT 0,1)) 
				FROM db_items_offers AS tbl1 
				WHERE tbl1.active = 1 and tbl1.owner = ? ";
		if ($order == "time") {
			$sql .= "ORDER BY tbl1.timestamp DESC ";
		} else if ($order == "views") {
			$sql .= "ORDER BY tbl1.views DESC ";
		} else if ($order == "lowest-points") {
			$sql .= "ORDER BY tbl1.price ASC ";
		} else if ($order == "highest-points") {
			$sql .= "ORDER BY tbl1.price DESC ";
		} 
		
		$sql .= "LIMIT ".$offset.",".$numitems;

		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->bind_param("d", $_SESSION['userid']);
			$stmt->execute();
			
			$stmt->bind_result($offer_id, $offer_name, $offer_desc, $offer_points, $offer_image);
			$stmt->store_result();
		
			// create items array
			$items = array();
			
			if ($stmt->num_rows) {
			
				// loop through the results
				while ($stmt->fetch()) {
					$offer = array('id' => $offer_id, 'name' => $offer_name, 'desc' => $offer_desc, 'points' => $offer_points, 'image' => $offer_image);
					$items[] = $offer;
				}

			}
			$output = array('pages' => $num_pages, 'items' => $items); 
			echo json_encode($output);
		}
		$stmt->close();
	} else if ($mode == 6) {				// return all requests on requests page
		
		// get additional parameters
		$order = $_GET['order'];
		$numitems = $_GET['numitems'];
		$offset = $_GET['offset'] -1;		// to start from 0
		$offset = $offset * $numitems;	
		
		$stmt =  $mysqli->stmt_init();
	
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.description, IF(subcategory IS NOT NULL, 
					(SELECT image FROM db_category_subcategory WHERE db_category_subcategory.id = subcategory),
					(SELECT image FROM db_category WHERE db_category.id = category)) AS image 
				FROM db_items_requests AS tbl1 
				WHERE tbl1.owner = ? ";
		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("d", $_SESSION['userid']);
			$stmt->execute();
			
			$stmt->bind_result($request_id, $request_name, $request_desc, $request_image);
			$stmt->store_result();
		
			if ($stmt->num_rows) {
				$num_pages = ceil($stmt->num_rows/$numitems);
			} else {
				$num_pages = 0;
			}
		
		}
		$stmt->close();
		
		$stmt =  $mysqli->stmt_init();
	
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.description, IF(subcategory IS NOT NULL, 
					(SELECT image FROM db_category_subcategory WHERE db_category_subcategory.id = subcategory),
					(SELECT image FROM db_category WHERE db_category.id = category)) AS image 
				FROM db_items_requests AS tbl1 
				WHERE tbl1.owner = ? ";
		if ($order == "time") {
			$sql .= "ORDER BY tbl1.timestamp DESC ";
		} else if ($order == "views") {
			$sql .= "ORDER BY tbl1.views DESC ";
		}
		$sql .= "LIMIT 0,".$home_num_of_requests;

		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("d", $_SESSION['userid']);
			$stmt->execute();
			
			$stmt->bind_result($request_id, $request_name, $request_desc, $request_image);
			$stmt->store_result();
			
			// create items array
			$items = array(); 
			
			if ($stmt->num_rows) {
				// loop through the results
				while ($stmt->fetch()) {
					$request = array('id' => $request_id, 'name' => $request_name, 'desc' => $request_desc, 'image' => $request_image);
					$items[] = $request;
				}
			}
			
			$output = array('pages' => $num_pages, 'items' => $items); 
			echo json_encode($output);
	
		}
		$stmt->close();
	} else if ($mode == 7) {				// return all categories
	
		$stmt =  $mysqli->stmt_init();
	
		$sql  = "SELECT id, name 
				FROM db_category 
				ORDER BY id ASC";
		if ($stmt = $mysqli->prepare($sql)) {

			$stmt->execute();
			
			$stmt->bind_result($category_id, $category_name);
			$stmt->store_result();
			
			// create items array
			$categories = array(); 
			
			if ($stmt->num_rows) {
				// loop through the results
				while ($stmt->fetch()) {
					$category = array('id' => $category_id, 'name' => $category_name);
					$categories[] = $category;
				}
			}
			
			//$output = array('pages' => $num_pages, 'items' => $items); 
			echo json_encode($categories);
	
		}
		$stmt->close();
	} else if ($mode == 8) {				// return all categories
	
		// get additional parameters
		$category = $_GET['category'];
		
		$stmt =  $mysqli->stmt_init();
	
		$sql  = "SELECT id, name 
				FROM db_category_subcategory 
				WHERE category_id = ? 
				ORDER BY id ASC ";
		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->bind_param("d", $category);
			$stmt->execute();
			
			$stmt->bind_result($subcategory_id, $subcategory_name);
			$stmt->store_result();
			
			// create items array
			$subcategories = array(); 
			
			if ($stmt->num_rows) {
				// loop through the results
				while ($stmt->fetch()) {
					$subcategory = array('id' => $subcategory_id, 'name' => $subcategory_name);
					$subcategories[] = $subcategory;
				}
			}
			
			//$output = array('pages' => $num_pages, 'items' => $items); 
			echo json_encode($subcategories);
	
		}
		$stmt->close();
	} else if  ($mode == 9) {
		
	//insert an item
	if(isset($_POST['submit'])){

		/* getConnection() function is in the functions.php that is 'included' at the top */
		$mysqli = getConnection();
		
		// get additional parameters
		$item_name = $_POST['name'];
		$price = $_POST['price'];
		$category = $_POST['category'];
		$sub_category = $_POST['subcategory'];
		$description = $_POST['description'];
		$user_id = $_SESSION['userid'];
		
		/* create a prepared statement */
		$stmt =  $mysqli->stmt_init();

		$sql="INSERT INTO db_items_offers
					   (name, price, category, subcategory, description, owner, views, timestamp) 
					   VALUE(?, ?, ?, ?, ?, ?, 0, NOW()";
		if ($stmt = $mysqli->prepare($sql)){
				
				$stmt->bind_param("sdddss", $item_name, $price, $category, $subcategory, $description, $user_id);
				/* execute query */
				$stmt->execute();
					//$output = array('pages' => $num_pages, 'items' => $items); 
				echo 0;		// self coded means successful
		
			}
			else {
				echo 1;		// self coded, means error
			} 
			$stmt->close();
		}
	} else if ($mode == 10) {				// insert a request
		if(isset($_POST['submit'])){
			// get additional parameters
			$name = $_POST['name'];
			$category = $_POST['category'];
			$subcategory = $_POST['subcategory'];
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];		
			$description = $_POST['desc'];
			$user_id = $_SESSION['userid'];
			
			$stmt =  $mysqli->stmt_init();
		
			$sql = "INSERT INTO db_items_requests 
					(name, category, subcategory, description, start_date, end_date, owner, views, timestamp) 
					VALUES (?, ?, ?, ?, STR_TO_DATE(?, '%m/%d/%Y'), STR_TO_DATE(?, '%m/%d/%Y'), ?, 0, NOW())";

			if ($stmt = $mysqli->prepare($sql)) {
				
				$stmt->bind_param("sddsssd", $name, $category, $subcategory, $description, $start_date, $end_date, $user_id);
				$stmt->execute();
			
				//$output = array('pages' => $num_pages, 'items' => $items); 
				echo 0;		// self coded means successful
		
			}
			else {
				echo 1;		// self coded, means error
			} 
			$stmt->close();
		}
		
	} else if ($mode == 11) {				// return all categories
	
		$stmt =  $mysqli->stmt_init();
		$sql  = "SELECT email, name, addr1, addr2, addr3, phone, city, postcode, image 
				FROM db_user 
				WHERE id = ?";

		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("d", $_SESSION['userid']);
			$stmt->execute();
			
			$stmt->bind_result($email, $name, $addr1, $addr2, $addr3, $phone, $city, $postcode, $image);
			$stmt->store_result();
		
			if ($stmt->num_rows) {
				// loop through the results
				$stmt->fetch();
				$info = array('email' => $email, 'name' => $name, 'addr1' => $addr1, 'addr2' => $addr2, 'addr3' => $addr3, 'phone' => $phone, 'city' => $city, 'postcode' => $postcode, 'image' => $image);
			}

			echo json_encode($info);
		}
		$stmt->close();
	} else if ($mode == 12) {				// update personal info
	
		// get additional parameters
		$name = $_POST['name'];
		$addr1 = $_POST['addr1'];
		$addr2 = $_POST['addr2'];
		$addr3 = $_POST['addr3'];
		$phone = $_POST['phone'];		
		$city = $_POST['city'];
		$postcode = $_POST['postcode'];
		$user_id = $_SESSION['userid'];
		
		$stmt =  $mysqli->stmt_init();
	
		$sql = "UPDATE db_user 
				SET name=?, addr1=?, addr2=?, addr3=?, phone=?, city=?, postcode=? 
				WHERE id=? ";

		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->bind_param("sssssssd", $name, $addr1, $addr2, $addr3, $phone, $city, $postcode, $user_id);
			$stmt->execute();
		
			echo 0;		// self coded means successful
		}
		else {
			echo 1;		// self coded, means error
		} 
		$stmt->close();
		
	} else if ($mode == 13) {				// update password	
		// get additional parameters
		$old_pwd = filter_var($_POST['old_pwd'], FILTER_SANITIZE_STRING);
		$new_pwd = filter_var($_POST['new_pwd'], FILTER_SANITIZE_STRING);
		$user_id = $_SESSION['userid'];
		
		$stmt =  $mysqli->stmt_init();
	
		$sql = "SELECT password 
				FROM db_user 
				WHERE id=? ";

		if ($stmt = $mysqli->prepare($sql)) {

			$stmt->bind_param("d", $user_id);
			$stmt->execute();
			
			/* bind your result columns to variables, e.g. id column = $post_id */
			$stmt->bind_result($pass);
					
			/* store result */
			$stmt->store_result();
		
			if($stmt->num_rows){// are there any results?
				/* fetch the result of the query & loop round the results */
				$stmt->fetch();
					
				if(crypt($old_pwd, $pass) == $pass) {
					$stmt =  $mysqli->stmt_init();

					$sql = "UPDATE db_user 
							SET password = ? 
							WHERE id=? ";
					
					if ($stmt = $mysqli->prepare($sql)) {
						$hashed_pass = better_crypt($new_pwd);
						
						$stmt->bind_param("sd", $hashed_pass, $user_id);
						$stmt->execute();
						
						echo 0;		// self coded means successful
					}
				} else {
					echo 1;		// self coded, means old password is invalid	
				}
				
			} 
		}

		$stmt->close();
		
	} else if ($mode == 14) {
		$output = "";
		if (empty($_FILES['profile-image'])) {
			//echo json_encode(['error'=>'No files found for upload.']); 
			// or you can throw an exception 
			return; // terminate
		}

		// get the files posted
		$images = $_FILES['profile-image'];

		// a flag to see if everything is ok
		$success = null;

		// file paths to store
		//$paths= [];

		// get file names
		$filenames = $images['name'];

		// process files

		$ext = explode('.', basename($filenames));
		$target = "uploads" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
		
		if(move_uploaded_file($images['tmp_name'], $target)) {
			$success = true;
			//$paths[] = $target;
		} else {
			$success = false;
		}
		// check and process based on successful status 
		if ($success === true) {

			// delete old file
			$stmt =  $mysqli->stmt_init();
			$sql  = "SELECT image 
					FROM db_user 
					WHERE id = ?";

			if ($stmt = $mysqli->prepare($sql)) {
				$stmt->bind_param("d", $_SESSION['userid']);
				$stmt->execute();
				
				$stmt->bind_result($image);
				$stmt->store_result();
			
				if ($stmt->num_rows) {
					
					$stmt->fetch();
					if ($image != "") {
						unlink($image);
					}
				}
			}
			
			$stmt =  $mysqli->stmt_init();

			$sql = "UPDATE db_user 
					SET image = ? 
					WHERE id=? ";
			
			if ($stmt = $mysqli->prepare($sql)) {
				
				$stmt->bind_param("sd", $target, $_SESSION['userid']);
				$stmt->execute();

			}
			
			// store a successful response (default at least an empty array). You
			// could return any additional response info you need to the plugin for
			// advanced implementations.
			//$output = [];
			$output;
			// for example you can get the list of files uploaded this way
			// $output = ['uploaded' => $paths];
		} elseif ($success === false) {
			//$output = ['error'=>'Error while uploading images. Contact the system administrator'];
			//$output = ['error'=>'Error while uploading images. Contact the system administrator'];
			// delete any uploaded files
			foreach ($paths as $file) {
				unlink($file);
			}
		} else {
			//$output = ['error'=>'No files were processed.'];
		}

		// return a json encoded response for plugin to process successfully
		echo json_encode($output);
		
	} else if ($mode == 15) {				// return item details
	
		// get additional parameters
		
		$item_id = $_GET['id'];
		$item_type = $_GET['type'];
		
		$stmt =  $mysqli->stmt_init();
		
		if ($item_type == "offers") {
			$sql = "SELECT tbl1.name, tbl1.description, tbl1.price * (SELECT multiplier FROM db_points_convert WHERE type = \"d\") AS points, 
					IFNULL((SELECT image FROM db_items_offers_images WHERE isdefault = 1 AND items_offers_id = tbl1.id), 
						(SELECT image FROM db_items_offers_images WHERE items_offers_id = tbl1.id LIMIT 0,1)), 
					tbl2.addr1, tbl2.addr2, tbl2.addr3, tbl2.city, tbl2.postcode 
				FROM db_items_offers AS tbl1 
				INNER JOIN db_user AS tbl2 
				ON tbl1.owner = tbl2.id 
				WHERE tbl1.id = ? ";
				
		} else if ($item_type == "requests"){
			$sql = "SELECT tbl1.name, tbl1.description, IF(subcategory IS NOT NULL, 
					(SELECT image FROM db_category_subcategory WHERE db_category_subcategory.id = subcategory),
					(SELECT image FROM db_category WHERE db_category.id = category)) AS image,
					tbl2.addr1, tbl2.addr2, tbl2.addr3, tbl2.city, tbl2.postcode 
				FROM db_items_requests AS tbl1
				INNER JOIN db_user AS tbl2 
				ON tbl1.owner = tbl2.id 
				WHERE tbl1.id = ? ";
		}
		

		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param("d", $item_id);
			$stmt->execute();
			
			// set default points, to avoid error when the type is requests
			$points = 0;
			if ($item_type == "offers") {
				$stmt->bind_result($name, $description, $points, $image, $addr1, $addr2, $addr3, $city, $postcode);
			} else if ($item_type == "requests") {
				$stmt->bind_result($name, $description, $image, $addr1, $addr2, $addr3, $city, $postcode);
			}
			$stmt->store_result();
		
			if ($stmt->num_rows) {
				// loop through the results
				$stmt->fetch();
				
				// get latlong
				$latlong = getGeoCode($postcode);
				$latlong = explode(",", $latlong);
				// get user information
				$info = array('title' => $name, 'desc' => $description, 'points' => $points, 'image' => $image, 'addr1' => $addr1, 'addr2' => $addr2, 'addr3' => $addr3, 'city' => $city, 'postcode' => $postcode, 'lat' => $latlong[0], 'long' => $latlong[1]);
			}

			echo json_encode($info);
		}
		$stmt->close();
	}

	
	$mysqli->close();


?>