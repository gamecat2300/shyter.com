var d_pane;
var d_api;
var s_pane;

var is_dropped = false;

var user_lat;
var user_long;

var infowindow;

var map;
var map_info;
var geocoder;

var markers = [];
var iterator = 0;

var last_label = "Click Here To Filter";

var venues = [];

var contentString;

var markerCluster = null;

var drawerID = -1;

var currentCategory = 0;


var sfMapstyle = [

	{
    featureType: "all",
    stylers: [
      { saturation: -80 }
    ]
  },{
    featureType: "road.arterial",
    elementType: "geometry",
    stylers: [
      { hue: "#00ffee" },
      { saturation: 50 }
    ]
  },{
    featureType: "poi.business",
    elementType: "labels",
    stylers: [
      { visibility: "off" }
    ]
  },
  {
  		featureType: "water",
  		stylers: [
  			{ hue: "#89cff0" },
  			{ saturation: 90 }
  		]
  	}
];

$(document).ready(function(){

	initialize();

	
	
	d_pane = $('#venue-list').jScrollPane({
		autoReinitialise: true
	});

	//d_api = d_pane.jScrollPane().data().jsp;


	$("#btn-back").bind("click tapstart", function(){
		hideDetails();
		infowindow.close();
	});

	$("#venue-list ul li a").on("click tapstart", function(){
		findMarker($(this).parent().data("vid"), true);
	});

	$(window).bind("resize", function(){
		resizeMe();
	});

	$("#btn-add").bind("click tapstart", function(e){
		gotoSlide(1);
		$('#add-bathroom').lightbox_me({
        	centered: true
        });
    	e.preventDefault();
	});

	


	$("#btn-about").bind("click tapstart", function(e){
		$('#about').lightbox_me({
        	centered: true
        });
		e.preventDefault();
	});


	$("#btn-next-slide1").bind("click tapstart", function(){
		var id = $("input[@name=category_group]:checked").attr('value');
		if(id == 1 || id == 2 || id == 3 || id == 4) {
			gotoSlide(2);
		} else {
			alert("Choose a bathroom type");
		}
	});

	$("#btn-next-slide2").bind("click tapstart", function(){
		gotoSlide(3);
	});

	$("#find-it").bind("click tapstart", function(){
		if($("#name").val() == "") {
			alert("You have to enter a bathroom name");
			$("#name").focus();
		} else {
			getAddressOnMap();
		}
	});

	$("#btn-submit").bind("click tapstart", function(){
		processForm();
	});


	$(".cat-link").bind("click tapstart", function(){
		var id = $(this).data("id");
		$(".cat-link").removeClass("section-selected");
		$(this).addClass("section-selected");
		infowindow.close();
		currentCategory = id;
		getbathrooms(id);
	});


	$("#search-field").keyup(function(e){
	    if($(this).val().length >= 3) {
		    doSearch(currentCategory, $(this).val());
	    } else {
	    	if(e.keyCode == 8 || e.keyCode == 46) {
		    	getbathrooms(currentCategory);
	    	}
	    }
    });


	resizeMe();

	changeBG();
});



function resizeMe() {
	var h;
	if($("body").hasClass("embed")) {
		h = $("#embed-wrap").height();
	} else {
		h = $(window).height();
	}


	$("#main").height(h - $("#header").height() - $("#credits").height() - $("#header-hiring").height() - 8);
	//if($("html").hasClass("lt-ie7")) {
		$("#map_canvas").height($("#main").height());
	//}

	$("#venue-list").height($("#main").height() - $("#dropdown-choices").height() - $("#cluster-explain").height()-7);
}


function initialize() {

	var myOptions = {
		zoom: 16,
  		minZoom: 12,
  		maxZoom: 20,
  		panControl: true,
  		zoomControl: true,
  		zoomControlOptions: {
	    	style: google.maps.ZoomControlStyle.SMALL
	  	},
		mapTypeControl: true,
		scaleControl: false,
		streetViewControl: true,
		overviewMapControl: true,
  		mapTypeId: google.maps.MapTypeId.ROADMAP,
  		styles: sfMapstyle
	};

	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	infowindow = new google.maps.InfoWindow({content: contentString, maxWidth: 350});




	google.maps.event.addListener(infowindow, 'closeclick', function() {
		//close sidebar
		hideDetails();
	});


	 google.maps.event.addListener(map, 'zoom_changed', function() {
    	if(drawerID != -1) {
    		findMarker(drawerID, false);
    	}
  	});


	drop();


	if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

           // myinfoWindow.setPosition(pos);
           // myinfoWindow.setZIndex(5);
           // maxWidth: 100;


		 var marker = new google.maps.Marker({
    		position: pos,
    		map: map,
    		title: 'Your Current Location'
  			});


       //     myinfoWindow.setContent('<div class="yourlocation"><h2>Your Location</h2></div>');
            map.setCenter(pos);
    	
			$("#btn-location").click(function() {
					map.panTo(pos);
			});
          }, function() {
            handleLocationError(true, marker, map.getCenter());
          });
        


        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, marker, map.getCenter());
        }
      

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        marker.setPosition(pos);
        marker.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }

      
}	

function drop() {
	var count = 0;
	venues = [];
	iterator = 0;

	$("#venue-list ul li").each(function(index) {
		addMarker($(this));
    });

   markerCluster = new MarkerClusterer(map, markers, {gridSize: 30, maxZoom: 22, averageCenter: true});

   google.maps.event.addListener(markerCluster, "click", function(c) {
	    var currentZoom = map.getZoom();
	    infowindow.close();
	    hideDetails();

	    if(currentZoom >= 18) {
	    	var myLatlng = new google.maps.LatLng(c.getCenter().lat(), c.getCenter().lng());
	    	var m = c.getMarkers();
	        var n = "";

			for (var i = 0; i < m.length; i++ ){
				n += '<li class="'+getCategoryClass($("#v"+m[i].id).data("category"))+'"><a href="#" onclick="openbathroomInfo('+m[i].id+'); return false;">'+$("#v"+m[i].id).data("name")+'</a></li>';
	        }

	     	openMyInfoWindow(myLatlng, m.length, n);
	    }
	});

	google.maps.event.addListener(markerCluster, "clusteringend", function(c) {
		if(drawerID != -1 &&  !infowindow.getMap()) {
    		findMarker(drawerID, false);
    	}
   	});
}


function openbathroomInfo(id) {
	findMarker(id, true);
}


function openMyInfoWindow(ll, m_length, c_list) {
	infowindow.setPosition(ll);
	infowindow.setContent('<div class="maptext-list"><strong>'+m_length+' Bathrooms Here:</strong><div class="infoWindowScroll"><ul>'+c_list+'</ul></div></div>');
	infowindow.open(map);
}

function addMarker(t) {

	var that = t;

	img = getCategory(that.data("category"));

	var mk = new google.maps.Marker({
    	position: new google.maps.LatLng(that.data('lat'),that.data('long')),
      	map: map,
      	icon: img,
      	shadow: 'img/shadow.png',
      	draggable: false,
    	animation: google.maps.Animation.DROP,
    	id: that.data('vid'),
    	content: "<div class='maptext "+getCategoryClass(that.data("category"))+"'><strong>"+that.data('name')+"</strong><br />"+that.data('address')+"</div>"
    });

    google.maps.event.addListener(mk, 'click', function() {
		showInfo(this, true);
	});
	markers.push(mk);
	iterator++;
}

function getCategory(c_id) {
	switch(c_id) {
		case 1:
			return "img/pin_public.png";
		break;
		case 2:
			return "img/pin_op.png";
		break;
		case 3:
			return "img/pin_divebar.png";
		break;
		case 4:
			return "img/pin_colo.png";
		break;
	}
}

function getCategoryClass(c_id) {
	switch(c_id) {
		case 1:
			return "list-coinop";
		break;
		case 2:
			return "list-coinop";
		break;
		case 3:
			return "list-divebar";
		break;
		case 4:
			return "list-secret";
		break;
	}
}


function clearMarkers() {
  if (markers) {
    for (var i = 0; i < markers.length; i++ ) {
      markers[i].setMap(null);
    }
  }

  markers = [];

  markerCluster.clearMarkers();
}

function showInfo(mk, d) {

	map.panTo(mk.position);
   
	infowindow.open(map, mk);
	if(d) {
		showDetails(mk.id);
	};

	var iwOuter = $('.gm-style-iw');

    /* Since this div is in a position prior to .gm-div style-iw.
     * We use jQuery and create a iwBackground variable,
     * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
    */
    var iwBackground = iwOuter.prev();

    // Removes background shadow DIV
    iwBackground.children(':nth-child(2)').css({'display' : 'none'});

    // Removes white background DIV
    iwBackground.children(':nth-child(4)').css({'display' : 'none'});

    // Moves the infowindow 115px to the right.
   

    // Changes the desired tail shadow color.
    iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

    // Reference to the div that groups the close button elements.
    var iwCloseBtn = iwOuter.next();

    // Apply the desired effect to the close button
    iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

    // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
    if($('.iw-content').height() < 140){
      $('.iw-bottom-gradient').css({display: 'none'});
    }

    // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
    iwCloseBtn.mouseout(function(){
      $(this).css({opacity: '1'});
    });

}

function showDetails(id) {
	resetEverything();
	
	var contentString = '<div id="iw-container">' +
                    '<div class="iw-title">'+$("#v"+id).data("name")+'</div>' +
                    '<div class="iw-content">' +
                      '<div class="iw-subTitle">Address: '+$("#v"+id).data("address") +'</div>' +
                      '<div class="rateit" data-rateit-value='+$("#v"+id).data("rating") +' data-rateit-ispreset="true" data-rateit-readonly="true"></div>' +
                      '<p>'+ $("#v"+id).data("whysf")+'</p>' +
                      '<div class="iw-subTitle">Hours</div>' +
                      '<p>'+$("#v"+id).data("hours") +'</p>'+
                    '</div>' +
                    '<div class="iw-bottom-gradient"></div>' +
                  '</div>';


    infowindow.setZIndex(20);


    infowindow.setContent(contentString);


	var z = map.getZoom();

	if(z < 14) {
		map.setZoom(17);
	}

	$("#venue-name").html($("#v"+id).data("name"));
	if($("#v"+id).data("venueimg") == "") {
		$("#venue-img").html("");
	} else {
		$("#venue-img").html('<img src="venue_images/'+$("#v"+id).data("venueimg")+'" />').show();
	}

	if($("#v"+id).data("address") != "") {
		$("#venue-address").html($("#v"+id).data("address")).show();
	} else {
		$("#venue-address").html("");
	}


	if($("#v"+id).data("hours") != "") {
		$("#venue-hours").html($("#v"+id).data("hours")).show();
	} else {
		$("#venue-hours").hide();
	}

	if($("#v"+id).data("hiring") != 0) {
		$("#venue-meta-wrap").addClass("venue-hiring-detail");
	} else {
		$("#venue-meta-wrap").removeClass("venue-hiring-detail");
	}


	if($("#v"+id).data("whysf") != "") {
		$("#why-sf-body").html($("#v"+id).data("whysf"));
		$("#why-sf").show();
	} else {
		$("#why-sf").hide();
	}

	if($("#v"+id).data("rating") != "") {
		$("#rating").html($("#v"+id).data("rating"));
		$("#rating").show();
	} else {
		$("#rating").hide();
	}


	if($("#v"+id).data("hiringurl") != "") {
		$("#venue-hiring").html('&raquo; <a href="'+$("#v"+id).data("hiringurl")+'" target="_blank">Check out our bathrooms page</a>').show();
	} else {
		$("#venue-hiring").html("").hide();
	}

	changeBG();

	$("#drawer").animate({"marginLeft": "0px"}, 300, function(){
		findMarker($("#v"+id).data("vid"), false);
	});

	drawerID = $("#v"+id).data("vid");

}

function hideDetails() {
	$("#drawer").animate({"marginLeft": -$("#venue-detail").width()}, 300);
	resetEverything();
	drawerID = -1;
}

function resetEverything() {

	$("#venue-info-header").hide();
	$("#venue-info-area").hide();
	$("#venue-type").html("");

	$("#venue-hiring").hide();
	
}

function findMarker(id, d) {
	if (markers) {
  		for (i in markers) {
    		if(markers[i].id == id) {
    			showInfo(markers[i], d);
    		}
  		}
	}
}

function getbathrooms(c_id) {
	clearMarkers();


	$("#cluster-explain").hide();
	$("#venue-list ul").fadeOut("fast", function(){
		$("#loader").show();


		$("#venue-list ul").load("_php/get_bathrooms.php", {id : c_id}, function(data){
			$("#loader").hide();
			clearMarkers();

		    $("#venue-list").find("ul").html(data);
				$("#venue-list ul li a").on("click tapstart", function(){
					findMarker($(this).parent().data("vid"), true);
				});

		    $("#venue-list ul").fadeIn("fast", function(){
				$("#cluster-explain").show();
				resizeMe();
			});

		    drop();
		});

	});
}


function doSearch(c_id, val) {
	clearMarkers();

	//$("#cluster-explain").hide();
	$("#venue-list ul").fadeOut("fast", function(){
		$("#loader").show();


		$("#venue-list ul").load("_php/get_bathrooms.php", {id : c_id, s: val}, function(){
			$("#loader").hide();
			clearMarkers();
		    //$("#venue-list").find("ul").html(data);


		    $("#venue-list ul").fadeIn("fast", function(){
				$("#cluster-explain").show();
				resizeMe();
			});

		    drop();
		});

	});
}

function gotoSlide(n) {
	var slideWidth = 720;

	if($("body").hasClass("embed")) {
		slideWidth = 540;
	}
	switch(n) {
		case 1:
			$("#bathroom-slides").css({marginLeft: 0});
		break;
		case 2:
			$("#bathroom-slides").animate({marginLeft: -slideWidth}, 500);
			initialize_info();
		break;
		case 3:
			$("#bathroom-slides").animate({marginLeft: -slideWidth*2}, 500);
		break;
		case 4:
			$("#bathroom-slides").animate({marginLeft: -slideWidth*3}, 500);
		break;
	}
}


function initialize_info() {
	geocoder = new google.maps.Geocoder();

	var myOptions = {
		center: new google.maps.LatLng(37.771375,-122.417564),
  		zoom: 11,
  		minZoom: 11,
  		panControl: false,
  		zoomControl: false,
		mapTypeControl: false,
		scaleControl: false,
		streetViewControl: false,
		overviewMapControl: false,
  		mapTypeId: google.maps.MapTypeId.ROADMAP,
  		styles: sfMapstyle
	};

	map_info = new google.maps.Map(document.getElementById("map_canvas_info"), myOptions);
}

function getAddressOnMap() {
	var address = $("#street_address").val();
	var city = $("#city option:selected").val();
	if(address == "") {
		alert("You must enter an address");
	} else {
		geocoder.geocode( { 'address': address + " " + city + ", sf"}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map_info.setCenter(results[0].geometry.location);
				map_info.setZoom(18);
				var marker = new google.maps.Marker({
					map: map_info,
					position: results[0].geometry.location,
					animation: google.maps.Animation.DROP
				});

				$("#btn-next-slide2").fadeIn(500);

				user_lat = results[0].geometry.location.lat();
				user_long = results[0].geometry.location.lng();

			} else {
				alert("Sorry, we can't find that address");
			}
		});
	}
}


function processForm() {
	

	if(!$("#terms_conditions").is(":checked")) {
		alert("You must agree to the Terms of Use");
		return false;
	}

	if(!$("#is_hiring").is(":checked")) {
		isHiring = 0;
	} else {
		isHiring = 1;
	}

	gotoSlide(4);

	var ct = $("input[@name=category_group]:checked").attr('value');
	var ratings = $("input[@name=ratings]:checked").attr('value');

	$.ajax({
		type: 'POST',
	  	url: '_php/save_bathroom.php',
	  	data: {
	  		name: $("#name").val(),
			street_address: $("#street_address").val(),
			hours: $("#hours").val(),
			latitude: user_lat,
			longitude: user_long,
			city: $("#city option:selected").val(),
			contact_email: $("#contact_email").val(),
			contact_name: $("#contact_name").val(),
			phone: $("#phone").val(),
			is_hiring: isHiring,
			why_sf: $("textarea#why_sf").val(),
			date: $("#date").val(),
			rating: ratings,
			type: ct
		},
		success: function(data){
			$("#saving").hide();
			$("#results").fadeIn(500);
			setTimeout(function(){$('#add-bathroom').trigger('close');},5000);
		},
	});
}

function isURL(s) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(s);
}

function validateEmail($email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if( !emailReg.test( $email ) ) {
		return false;
	} else {
		return true;
	}
}

function fixUrl(u) {
	if(u.indexOf('/', u.length-1) != -1) {
		u = u.substring(0, u.length-1);
	}

	if(u.length > 25) {
		u = u.substring(0, 25) + "...";
	}

	return u;
}

function changeBG() {
	var aPhotos = ["sidebar1", "sidebar3", "sidebar4", "sidebar5", "sidebar6"];
	var aPhotoNames = ["Credit", "Credit", "Credit", "Credit", "Credit"];

	var compiledString = "";
	var num;

	for(var x = 0; x < aPhotos.length ; x++) {
		compiledString += aPhotos[x] + " ";
	}

	num = Math.floor(Math.random()*aPhotos.length);

	$("#sidebar").removeClass(compiledString);
	$("#sidebar").addClass(aPhotos[num]);
	$("#venue-bg-credits").html("&copy; " + aPhotoNames[num]);
}


/* Tweet Popup */
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");