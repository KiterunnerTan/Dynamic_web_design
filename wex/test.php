<?php

	include("functions.php");
	
		$mysqli = getConnection();
		
		$stmt =  $mysqli->stmt_init();
/*	
		$sql  = "SELECT tbl1.id, tbl1.name, tbl1.price * (SELECT multiplier FROM db_points_convert WHERE type = \"d\") AS points, 
					IFNULL((SELECT image FROM db_items_offers_images WHERE isdefault = 1 AND items_offers_id = tbl1.id), 
						(SELECT image FROM db_items_offers_images WHERE items_offers_id = tbl1.id LIMIT 0,1)) 
				FROM db_items_offers AS tbl1 ";
		if ($order == "time") {
			$sql .= "ORDER BY tbl1.timestamp DESC ";
		} else if ($order == "views") {
			$sql .= "ORDER BY tbl1.views DESC ";
		}
		$sql .= "LIMIT 0,".$num_of_offers;
*/
	
		$sql = "INSERT INTO db_user (email, password, name) VALUES ('admin@admin.com', '".password_hash("admin", PASSWORD_BCRYPT)."', 'Administrator')";
		if ($stmt = $mysqli->prepare($sql)) {
			
			$stmt->execute();
			/*
			$stmt->bind_result($offer_id, $offer_name, $offer_points, $offer_image);
			$stmt->store_result();
		
			if ($stmt->num_rows) {
				
				// create output array
				$output = array(); 
				
				// loop through the results
				while ($stmt->fetch()) {
					$offer = array('id' => $offer_id, 'name' => $offer_name, 'points' => $offer_points, 'image' => $offer_image);
					$output[] = $offer;
				}
				
				echo json_encode($output);
			}
			*/
		}
		$stmt->close();

?>