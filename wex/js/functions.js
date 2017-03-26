function populateCategory(category_id, callback) {
	var categories_html = "";
	
	$.get("ajax_responses.php", {mode:7}, function(categories){
		$.each(categories, function(i, category) {
			categories_html += "<OPTION value=\"" + category.id + "\">" + category.name + "</OPTION>\n";
		});
		
		category_id.empty();
		category_id.html(categories_html);
	} , "json"
	);
	callback();
}

function populateSubcategory(category_id, subcategory_id) {
	var subcategories_html = "<OPTION value=\"\">None</OPTION>";
	//var category = category_id.val();
	
	
	$.get("ajax_responses.php", {mode:8, category: category_id}, function(subcategories){
		$.each(subcategories, function(i, subcategory) {
			subcategories_html += "<OPTION value=\"" + subcategory.id + "\">" + subcategory.name + "</OPTION>\n";
		});
		
		subcategory_id.empty();
		subcategory_id.html(subcategories_html);
	} , "json"
	);
}



function populateOffersHome(order) {
	
	var offers_html = "";
	var counter = 0;
	$.get("ajax_responses.php", {mode:1, order: order}, function(offers){

			$.each(offers, function(i, offer) {
				if ((counter % 3) == 0) {
					if (counter == 0) {
						offers_html += "<div class=\"item active\">\n";
					} else {
						offers_html += "<div class=\"item\">\n";
					}
					offers_html += "<div class=\"row\">\n";
				}
				
				offers_html += "<div class=\"col-md-4\">\n";
				offers_html += "<ul id=\"box\" class=\"clearfix\">\n";
				offers_html += "<li>";
				offers_html += "<a href=\"item_page.php?id=" + offer.id + "&type=offers\" ><img src=\"images/" + offer.image + "\"></a>\n";
				//offers_html += "<div class=\"carousel-caption\"><p class=\"caption-title pull-left\">" + offer.name + "</p><p class=\"caption-points\">" + offer.points + " points</p></div>\n";
				offers_html += "<h4>" + offer.name + "</h4>";

				offers_html += "<p>" + offer.points+ " points</p>";
				offers_html += "</li>\n"; 
				offers_html += "</ul>\n";
				offers_html += "</div>\n";
				
				if ((counter % 3) == 2) {
					offers_html += "</div>\n</div>\n";

				}
				counter++;
				
			});
			while (counter % 3 != 0) {
				offers_html += "<div class=\"col-md-4\"></div>\n";
				if ((counter % 3) == 2) {
						offers_html += "</div>\n</div>\n";
				}
				counter++;
				
			}
				
				//offers_html += "<div><img data-u=\"image\" src=\"img/" + offer.image + "\" /></div>";

			$("#offers-slides").empty();
			$("#offers-slides").html(offers_html);
		}, "json"
	);

}

function populateRequestsHome(order) {
	
	var requests_html = "";
	var counter = 0;
	$.get("ajax_responses.php", {mode:2, order: order}, function(requests){

			$.each(requests, function(i, request) {
				if ((counter % 3) == 0) {
					if (counter == 0) {
						requests_html += "<div class=\"item active\">\n";
					} else {
						requests_html += "<div class=\"item\">\n";
					}
					requests_html += "<div class=\"row\">\n";
				}
				/*
				requests_html += "<div class=\"col-md-4\">\n";
				requests_html += "<a href=\"details.php\" class=\"thumbnail\"><img src=\"images/" + request.image + "\"></a>\n";
				//requests_html += "<div class=\"carousel-caption\"><p class=\"caption-title pull-left\">" + request.name + "</p><p class=\"caption-points\">" + request.points + " points</p></div>\n";
				requests_html += "</div>\n";
				*/
				
				requests_html += "<div class=\"col-md-4\">\n";
				requests_html += "<ul id=\"box\" class=\"clearfix\">\n";
                requests_html += "<li>";
				requests_html += "<a href=\"item_page.php?id=" + request.id + "&type=requests\"><img src=\"images/" + request.image + "\"></a>\n";
				//requests_html += "<div class=\"carousel-caption\"><p class=\"caption-title pull-left\">" + offer.name + "</p><p class=\"caption-points\">" + offer.points + " points</p></div>\n";
				requests_html += "<h4>" + request.name + "</h4>";
				//requests_html += "<p class=\"home-offers-points\">" + offer.points+ " points</p>";
				requests_html += "<p>" + request.desc+ "</p>";
				requests_html += "</li>\n";
				requests_html += "</ul>\n";
				requests_html += "</div>\n";				
				
				
				if ((counter % 3) == 2) {
					requests_html += "</div>\n</div>\n";

				}
				counter++;
				
			});
			while (counter % 3 != 0) {
				requests_html += "<div class=\"col-md-4\"></div>\n";
				if ((counter % 3) == 2) {
						requests_html += "</div>\n</div>\n";
				}
				counter++;
				
			}
				
				//offers_html += "<div><img data-u=\"image\" src=\"img/" + offer.image + "\" /></div>";

			$("#requests-slides").empty();
			$("#requests-slides").html(requests_html);
		}, "json"
	);

}

function login(user, pass, click_button, callback) {
	//alert(user + " " + pass + " " + click_button);
	$.post("login.php", {user:user, pass: pass, submit: click_button}, function(response){
			//alert(response);
			callback(response);
		}, "text"
	);
}

function signup(name, user, pass, click_button, callback) {
	$.post("signup.php", {name:name, user:user, pass: pass, submit: click_button}, function(response){
			callback(response);
		}, "text"
	);
}

function populateItemsProfile(order, numitems, offset, callback) {
	
	var item_type = "";
	$(".btn-group > button.btn").each(function(){
		if ($(this).hasClass('active')) {
			item_type = $(this).attr('id');
		}				
	});
	
	if (item_type.localeCompare("my-offers") == 0) {
		$("#profile-items").empty();
		populateOffersProfile(order, numitems, offset, function(totalPages) {
			callback(totalPages);
		});
		
	} else if (item_type.localeCompare("my-requests") == 0) {
		$("#profile-items").empty();
		populateRequestsProfile(order, numitems, offset, function(totalPages) {
			callback(totalPages);
		});
		
	} else if (item_type.localeCompare("my-history") == 0) {
		$("#profile-items").empty();
		/*
		$("#graph-body").load("html_heat_month.html", function(){
			pop_graph_heat_month(counter_id, begin_id, end_id, channel_id, vehicle_id);
		});*/
	}
}

function populateOffersProfile(order, numitems, offset, callback) {
	var offers_html = "";
	var counter = 0;

	$.get("ajax_responses.php", {mode:5, order: order, numitems: numitems, offset: offset}, function(offers){
			var totalpages = offers.pages;
			$.each(offers.items, function(i, offer) {
				if ((counter % 3) == 0) {
					offers_html += "<div class=\"row\">\n";
				}
				
				offers_html += "<div class=\"col-md-4\">\n";
				offers_html += "<div id=\"box\" class=\"burst-circle teal offers-item\">\n";
				offers_html += "<a href=\"item_page.php?id=" + offer.id + "&type=offers\"><img class=\"img-responsive offers-items-image centered\" src=\"images/" + offer.image + "\"></a>\n";
				offers_html += "</div>\n";
				offers_html += "<h4>" + offer.name + "</h4>";

				offers_html += "<p class=\"home-offers-points\">" + offer.points+ " points</p>";
				offers_html += "<p>" + offer.desc+ "</p>";
				offers_html += "</div>\n";
				
				if ((counter % 3) == 2) {
					offers_html += "</div>\n</div>\n";

				}
				counter++;
				
			});
			while (counter % 3 != 0) {
				offers_html += "<div class=\"col-md-4\"></div>\n";
				if ((counter % 3) == 2) {
						offers_html += "</div>\n</div>\n";
				}
				counter++;
				
			}
				
				//offers_html += "<div><img data-u=\"image\" src=\"img/" + offer.image + "\" /></div>";

			$("#profile-items").empty();
			$("#profile-items").html(offers_html);
			callback(totalpages);
		}, "json"
	);
}

function populateRequestsProfile(order, numitems, offset, callback) {
	var requests_html = "";
	var counter = 0;

	$.get("ajax_responses.php", {mode:6, order: order, numitems: numitems, offset: offset}, function(requests){
			var totalpages = requests.pages;
			$.each(requests.items, function(i, request) {
				if ((counter % 3) == 0) {
					requests_html += "<div class=\"row\">\n";
				}
				
				requests_html += "<div class=\"col-md-4\">\n";
				requests_html += "<div id=\"box\" class=\"burst-circle teal offers-item\">\n";
				requests_html += "<a href=\"item_page.php?id=" + request.id + "&type=offers\"><img class=\"img-responsive offers-items-image centered\" src=\"images/" + request.image + "\"></a>\n";
				requests_html += "</div>\n";
				requests_html += "<h4>" + request.name + "</h4>";

				requests_html += "<p>" + request.desc+ "</p>";
				requests_html += "</div>\n";
				
				if ((counter % 3) == 2) {
					requests_html += "</div>\n</div>\n";

				}
				counter++;
				
			});
			while (counter % 3 != 0) {
				requests_html += "<div class=\"col-md-4\"></div>\n";
				if ((counter % 3) == 2) {
						requests_html += "</div>\n</div>\n";
				}
				counter++;
				
			}
				
				//offers_html += "<div><img data-u=\"image\" src=\"img/" + offer.image + "\" /></div>";

			$("#profile-items").empty();
			$("#profile-items").html(requests_html);
			callback(totalpages);
		}, "json"
	);
}

function populateOffers(order, numitems, offset, callback) {
	/* populate items on offers page */ 
	
	
	var offers_html = "";
	var counter = 0;
	
	
	$.get("ajax_responses.php", {mode:3, order: order, numitems: numitems, offset: offset}, function(offers){
			//var $pagination = $("#offers-pagination");
			var totalpages = offers.pages;
			
			$.each(offers.items, function(i, offer) {
				if ((counter % 3) == 0) {
					offers_html += "<div class=\"row\">\n";
				}
				
				offers_html += "<div class=\"col-md-4\">\n";
				offers_html += "<ul id=\"box\" class=\"clearfix\">\n";
				offers_html += "<li>";
				offers_html += "<a href=\"item_page.php?id=" + offer.id + "&type=offers\"><img class=\"img-responsive offers-items-image centered\" src=\"images/" + offer.image + "\"></a>\n";
				offers_html += "<h4>" + offer.name + "</h4>";
				offers_html += "<p>" + offer.points+ " points</p>";
				offers_html += "</li>\n"; 
				offers_html += "</ul>\n";
				offers_html += "</div>\n";
											
				
				if ((counter % 3) == 2) {
					offers_html += "</div>\n";

				}
				counter++;
				
			});
			while (counter % 3 != 0) {
				offers_html += "<div class=\"col-md-4\"></div>\n";
				if ((counter % 3) == 2) {
						offers_html += "</div>\n";
				}
				counter++;
				
			}
				
				//offers_html += "<div><img data-u=\"image\" src=\"img/" + offer.image + "\" /></div>";

			$("#offers-items").empty();
			$("#offers-items").html(offers_html);
			callback(totalpages);
		}, "json"
	);

}

function populateRequests(order, numitems, offset, callback) {
	/* populate items on requests page */ 
	
	
	var requests_html = "";
	var counter = 0;
	
	
	$.get("ajax_responses.php", {mode:4, order: order, numitems: numitems, offset: offset}, function(requests){
			//var $pagination = $("#requests-pagination");
			var totalpages = requests.pages;
			
			$.each(requests.items, function(i, request) {
				if ((counter % 3) == 0) {
					requests_html += "<div class=\"row\">\n";
				}
				
				requests_html += "<div class=\"col-md-4\">\n";
				requests_html += "<ul id=\"box\" class=\"clearfix\">\n";
				requests_html += "<li>";
				requests_html += "<a href=\"item_page.php?id=" + request.id + "&type=requests\"><img src=\"images/" + request.image + "\"></a>\n";
				requests_html += "<h4>" + request.name + "</h4>";
				requests_html += "<p>" + request.desc+ "</p>";
				requests_html += "</li>\n";
				requests_html += "</ul>\n";
				requests_html += "</div>\n";
											
				
				if ((counter % 3) == 2) {
					requests_html += "</div>\n";

				}
				counter++;
				
			});
			while (counter % 3 != 0) {
				requests_html += "<div class=\"col-md-4\"></div>\n";
				if ((counter % 3) == 2) {
						requests_html += "</div>\n";
				}
				counter++;
				
			}
				

			$("#requests-items").empty();
			$("#requests-items").html(requests_html);
			callback(totalpages);
		}, "json"
	);

}

function postOffer(name, price, category, subcategory, description, submit){
	$.post("ajax_responses.php", {mode: 9, name: name, price: price, category: category, subcategory: subcategory, description: description, submit: submit}, function(response){
			//alert(response);
			//callback(response);
			if (response == 0) {
				$("#offer-response").html("<div class=\"alert alert-success\">\n<strong>Success!</strong> Your offer has been recorded.</div>");
				$("#input_item_name").val('');
				$("#input_price").val('');
				$("#input_description").val('');
				
				// populate category back to default
				populateCategory($("#category"), function(){
				populateSubcategory(1, $("#subcategory"));
				
		});
			} else if (response == 1) {
				$("#offer-response").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Your offer cannot be stored. Please check again.</div>");
			}
		}, "text"
	);
}

function postRequest(name, start_date, end_date, category, subcategory, description, submit){
	$.post("ajax_responses.php", {mode: 10, name: name, start_date: start_date, end_date: end_date, category: category, subcategory: subcategory, desc: description, submit: submit}, function(response){
			//alert(response);
			//callback(response);
			if (response == 0) {
				$("#request-response").html("<div class=\"alert alert-success\">\n<strong>Success!</strong> Your request has been recorded.</div>");
				$("#input_item_name").val('');
				$("#start_date").val('');
				$("#end_date").val('');

				$("#input_description").val('');
				
				// populate category back to default
				populateCategory($("#category"), function(){
				populateSubcategory(1, $("#subcategory"));
				
		});
			} else if (response == 1) {
				$("#request-response").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Your request cannot be stored. Please check again.</div>");
			}
		}, "text"
	);
}

function populatePersonalInfo() {
	$.get("ajax_responses.php", {mode: 11}, function(response){
			//alert(response);
			//callback(response);

			$("#email").val(response.email);
			$("#name").val(response.name);
			$("#addr1").val(response.addr1);
			$("#addr2").val(response.addr2);
			$("#addr3").val(response.addr3);
			$("#phone").val(response.phone);
			$("#city").val(response.city);
			$("#postcode").val(response.postcode);
			
			var profile_image = response.image;
			$("#profile-image").attr({"src" : profile_image});

		}, "json"
	);
}

function updatePersonalInfo(name, addr1, addr2, addr3, phone, city, postcode) {
	$.post("ajax_responses.php", {mode: 12, name: name, addr1: addr1, addr2: addr2, addr3: addr3, phone: phone, city: city, postcode: postcode}, function(response){
			//alert(response);
			//callback(response);
			if (response == 0) {
				$("#responseModalHeader").html("Update Personal Information");
				$("#responseModalBody").html("<div class=\"alert alert-success\">\n<strong>Success!</strong> Your personal information has been updated.</div>");
				//$("#input_item_name").val('');
				//$("#start_date").val('');
				//$("#end_date").val('');

				//$("#input_description").val('');
				
				// populate category back to default
				//populateCategory($("#category"), function(){
				//populateSubcategory(1, $("#subcategory"));
				
		
			} else if (response == 1) {
				//$("#request-response").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Your request cannot be stored. Please check again.</div>");
				$("#responseModalHeader").html("Update Personal Information");
				$("#responseModalBody").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Your personal information cannot be updated.</div>");
			}
		}, "text"
	);
}

function updatePassword(old_pwd, new_pwd1) {
	$.post("ajax_responses.php", {mode: 13, old_pwd: old_pwd, new_pwd: new_pwd1}, function(response){
			//alert(response);
			//callback(response);
			if (response == 0) {
				$("#responseModalHeader").html("Update Password");
				$("#responseModalBody").html("<div class=\"alert alert-success\">\n<strong>Success!</strong> Your password has been updated.</div>");
				//$("#input_item_name").val('');
				//$("#start_date").val('');
				//$("#end_date").val('');

				//$("#input_description").val('');
				
				// populate category back to default
				//populateCategory($("#category"), function(){
				//populateSubcategory(1, $("#subcategory"));
				
		
			} else if (response == 1) {
				//$("#request-response").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Your request cannot be stored. Please check again.</div>");
				$("#responseModalHeader").html("Update Password");
				$("#responseModalBody").html("<div class=\"alert alert-danger\">\n<strong>Error!</strong> Your old password is invalid.</div>");
			}
		}, "text"
	);
}

function populateItemDetails(id, type) {
	var blank = "";
	$.get("ajax_responses.php", {mode: 15, id: id, type: type}, function(response){
			//alert(response);
			//callback(response);
			var address = response.addr1 + ", " + response.city + ", " + response.postcode;
			
			$("#item-title").html(response.title);
			$("#item-description").html(response.desc);
			$("#item-points").html(response.points);
			$("#item-address").html(address);
			
			
			$("#lat").val(response.lat);
			$("#long").val(response.long);

			
			var item_image = "images/" + response.image;
			$("#item-images").attr({"src" : item_image});

		}, "json"
	);
	
}