<!DOCTYPE html>
<html>
  <head>
    <title>Geo Location</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
	
	
	
	window.addressX;
	
	
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
	  
	  /* Was Variant1, works with SSL ONLY-------------------
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;
		
		

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
					
          navigator.geolocation.getCurrentPosition(function(position) {	
			
              var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
			
           
			
			  // Mine------------------------------------------------
			  
			lat = position.coords.latitude;
			lon = position.coords.longitude;
			//
			
			
			//run ajax to get Address from lat, lon , UNDER CONSTRACTION
			//if lan if found, i.e match digitals, run this function to get address
			if( !isNaN(lat) ){ //if number
				alert('coord found');
			    ajaxGetAddressbyCoords(); // temp disabled
				//alert ("Address Main " + window.addressX);
			} else { 
				window.addressX = 'address tracking failed due to API KEY';
			}
			
			//sends ajax request to ajax_php_script/record_data.php to record ip, date, lat, lon using RecordTxt::RecordAnyInput(array( "lat: " .$_POST['cityLat'], "lon: ".$_POST['cityLon'], $gmapLink  ),  '../recordText/geolocation.txt');
			myAjaxRequest();
			
			// End mine-------------------------------------------------
			
			
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
		  
		  
        } else {
          // Browser doesn't support Geolocation
		  lat = 'lat not detected'; // to recodt txt if lat not found
		  lon = 'lon not detected';
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed. <br> Engage permission on device.<br> Or use Google Chrome below v.50 <br> Best regards. ' :
                              'Error: Your browser <br> doesn\'t support geolocation.');
        infoWindow.open(map);
		
		
      }
	  
	  
	  
	  //mine-------------------------
	  
	  
	  //sends ajax request to ajax_php_script/record_data.php to record ip, date, lat, lon using RecordTxt::RecordAnyInput(array( "lat: " .$_POST['cityLat'], "lon: ".$_POST['cityLon'], $gmapLink  ),  '../recordText/geolocation.txt');
	  function myAjaxRequest() 
	  {	 
	     //alert(" - " + lat + " - " + lon  );
        // send  data  to  PHP handler  ************ 
        $.ajax({
            url: 'ajax_php_script/record_data.php',
            type: 'POST',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
			//passing the city
            data: { 
			    cityLat:lat,
				cityLon:lon,
				address: "<span style='color:red;'>" + window.addressX + "</span>",
				//cityLon:window.lon,
				
			},
            success: function(data) {
                // do something;
                //$("#weatherResult").stop().fadeOut("slow",function(){ $(this).html(data) }).fadeIn(2000);
			    //alert(data.city.name);
				//getAjaxAnswer(data);
            },  //end success
			error: function (error) {
				//$("#weatherResult").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> NO CITY FOUND</h4>")}).fadeIn(2000);
            }	
        });
	  }
                                               
       //  END AJAXed  part 
	  //mine------------------------------------------------------------------
	  //myAjaxRequest();
	  
	  
	  
	  // gets an address by lat, lon
	  //----------------------------------------------------------
	 
	  function ajaxGetAddressbyCoords(){
		  var geocodeURL = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + ',' + lon;
		  $.ajax({
            url: geocodeURL,
            type: 'POST',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
			//passing the data
            data: { 
			
			},
			async: false, // the core Error was here, it was sync and did not wait for value to return
            success: function(data) {
				alert("ajaxGetAddressbyCoords status is " + data.status);
				if (data.status=="OK"){
				    //alert(JSON.stringify(data, null, 4));
                    //alert (data.results[1].formatted_address);
				    window.addressX = data.results[1].formatted_address; //get the JSON address
					alert('success ' + addressX);
				} else {
					window.addressX = "API Query Limit, n/a(ajaxGetAddressbyCoords)"; 
					alert('not defined in ajaxGetAddressbyCoords');
				}
				
				
				
            },  //end success
			error: function (error) {
				alert('ajaxError');
            }	
			
        });
		//alert("return " + window.addressX);
		 return window.addressX; 
	  }
	  // end ajaxGetAddressbyCoords()----------------------------------------
	  
	  */  // END Was Variant1, works with SSL ONLY -------------------
	  
	  
	  
	  
	  
	  
	  
	  
	  //****************************************************************************************************************************************
	  
	  
	  
	  
	  
	  
	  
	  
	  //Variant 2, fix to avoid obligatory SSL
	  // **************************************************************************************
      // **************************************************************************************
      //                                                                                     **
	  var latX;
	  var lonX;
	  
	  var map, infoWindow;
	 
	  //if tryAPIGeolocation success
	  var apiGeolocationSuccess = function(position) {
          alert("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
      };
      
	  //runs if Rejected by Chrome as no SSL
      var tryAPIGeolocation = function() {
          jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDCa1LUe1vOczX1hO_iGYgyo8p_jYuGOPU", function(success) {
          apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
		  recenterMap(success.location.lat, success.location.lng , 'SSL Fail');//mine, recenter the map if coords are found, 
		                                                                       //SslStatus arg appears if Chrome rejects because of No SSL and fired in {tryAPIGeolocation}
		  //alert("Chrome SSL reject");
          })
          .fail(function(err) {
              alert("API Geolocation error! \n\n"+err);
          });
      };

	  
	  
	  
	  //if tryGeolocation() success
      var browserGeolocationSuccess = function(position) {
		  latX =  position.coords.latitude; //mine
		  lonX =  position.coords.longitude;
          alert("Core Performance successful!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
		  recenterMap(latX,lonX, null);//mine, recenter the map if coords are found
      };

	  
	  
	  
	  //if tryGeolocation() fails
      var browserGeolocationFail = function(error) {
		  alert('GPS is OFF');  // will fire if GPS is off at cell or if Chrome
		  
          switch (error.code) {
              case error.TIMEOUT:
                  alert("Browser GL error !\n\nTimeout.");
                  break;
              case error.PERMISSION_DENIED:
                  if(error.message.indexOf("Only secure origins are allowed") == 0) {
                      tryAPIGeolocation();
					  alert('!SSL permission denied');
					  //infoWindow.setContent("Only secure origins are allowed");
					  //infoWindow.open(map);
                      
                  }
                  break;
              case error.POSITION_UNAVAILABLE:
                   alert("Browser geolocation error !\n\nPosition unavailable.");
                   break;
			  //mine-------------------------
			  case error.UNKNOWN_ERROR:
                  alert("An unknown error occurred.");
                  break;
           }
        };

      var tryGeolocation = function() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(
                  browserGeolocationSuccess,
                  browserGeolocationFail,
                  {maximumAge: 50000, timeout: 20000, enableHighAccuracy: true}); //maximumAge: 50000 (50 sec of location cache)
         }		 
		 
      };

      tryGeolocation();
	  
	  
	  // **                                                                                  **
      // **************************************************************************************
      // ************************************************************************************** 
	  //END Variant 2, fix to avoid obligatory  SSL-----------------------------------------
	  
	   
	   
	   
	   //addon from 1st variant
	   // function which loads Google maps with specified  coords, using src="https://maps.googleapis.com/maps/api/js?callback=initMap">
	    /*var*/ map, infoWindow; // made infoWindow global to be seen in function {receneter()}
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;
		
		

  
      } // END initMap()-----------------------------------------------

   
   
   
   
   
   
   
   
      //mine function in case of success, recenter map to found coords
	  function recenterMap(myLat, myLon, SslStatus){  //SslStatus arg appears if Chrome rejects because of No SSL and fires {tryAPIGeolocation}, otherwise call with null
		  //alert(latX);
		    var pos = { //adding coords to object
              lat: myLat,
              lng: myLon
            };
			//infoWindow = new google.maps.InfoWindow; // Mega fix
		    infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos); 
			
			//run my record ajax
			//if lan if found, i.e match digitals, run this function to get address
			if (!isNaN(myLat) ){ //if number
				alert('coord found ' + myLat);
				if (SslStatus){
					b = SslStatus;
					//alert( b + ' Reject detected');
					ajaxGetAddressbyCoords(myLat, myLon, SslStatus); //SslStatus arg appears if Chrome rejects because of No SSL and fires {tryAPIGeolocation}
				} else {
			        ajaxGetAddressbyCoords(myLat, myLon, null); // arguements should be as in recenterMap(myLat, myLon) arg, null as we set no SslStatus(no reject by Google)
				}
				//alert ("Address Main " + window.addressX);
			} else { 
				 addressX = 'address tracking failed due to API KEY';
			}
			
			//sends ajax request to ajax_php_script/record_data.php to record ip, date, lat, lon using RecordTxt::RecordAnyInput(array( "lat: " .$_POST['cityLat'], "lon: ".$_POST['cityLon'], $gmapLink  ),  '../recordText/geolocation.txt');
			myAjaxRequest(myLat, myLon); // arguements should be as recenterMap(myLat, myLon) arg
			//END run my record ajax
	  
	  }
	  //END mine function in case of success, recenter map to found coords
	  
	 
	 
	 
	 
	 //describe the function myAjaxRequest + ajaxGetAddressbyCoords
	 
	 
	  //sends ajax request to ajax_php_script/record_data.php to record ip, date, lat, lon using RecordTxt::RecordAnyInput(array( "lat: " .$_POST['cityLat'], "lon: ".$_POST['cityLon'], $gmapLink  ),  '../recordText/geolocation.txt');
	  function myAjaxRequest(x, y) 
	  {	 
	     //alert('addr' + addressX);
	     //alert("myAjaxRequest " + x );
        // send  data  to  PHP handler  ************ 
        $.ajax({
            url: 'ajax_php_script/record_data.php',
            type: 'POST',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
			//passing the city
            data: { 
			    cityLat:x,
				cityLon:y,
				address: "<span style='color:red;'>" + window.addressX + "</span>",
				//cityLon:window.lon,
				
			},
            success: function(data) {
                // do something;
                //$("#weatherResult").stop().fadeOut("slow",function(){ $(this).html(data) }).fadeIn(2000);
			    //alert(data.city.name);
				//getAjaxAnswer(data);
            },  //end success
			error: function (error) {
				//$("#weatherResult").stop().fadeOut("slow",function(){ $(this).html("<h4 style='color:red;padding:3em;'>ERROR!!! <br> NO CITY FOUND</h4>")}).fadeIn(2000);
            }	
        });
	  }
                                               
       //  END AJAXed  part 
	  //mine------------------------------------------------------------------
	  //myAjaxRequest();
	  
	  
	  
	  // gets an address by lat, lon
	  //----------------------------------------------------------
	 
	  function ajaxGetAddressbyCoords(myLat1, myLon1, ssl_status){  //ssl_status arg appears if Chrome rejects because of No SSL and fires {tryAPIGeolocation}
		  var geocodeURL = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + myLat1 + ',' + myLon1;
		  $.ajax({
            url: geocodeURL,
            type: 'POST',
			dataType: 'JSON', // without this it returned string(that can be alerted), now it returns object
			//passing the data
            data: { 
			
			},
			async: false, // the core Error was here, it was sync and did not wait for value to return
            success: function(data) {
				alert("ajaxGetAddressbyCoords status is " + data.status);
				if (data.status=="OK"){
				    //alert(JSON.stringify(data, null, 4));
                    //alert (data.results[1].formatted_address);
					if (ssl_status){ //if 3rd arg is not null
						addressX = "<b><< " +ssl_status + " >> </b> : " + data.results[1].formatted_address;
					} else {
				        addressX = data.results[1].formatted_address; //get the JSON address
					}
					alert('success ' + addressX);
				} else {
					addressX = "API Query Limit, n/a(ajaxGetAddressbyCoords)"; 
					alert('not defined in ajaxGetAddressbyCoords -> API Query Limit');
				}
				
				
				
            },  //end success
			error: function (error) {
				alert('ajaxError');
            }	
			
        });
		//alert("return " + window.addressX);
		 return window.addressX; 
	  }
	  // end ajaxGetAddressbyCoords()----------------------------------------
	  
	  

	   //END adds from 1st variant---------------------------------------------------
	  
	  
	  
	  
	 
    </script>
	
	
	<!-- Must src from 1st variant, to load googe maps-->
    <script async defer
	src="https://maps.googleapis.com/maps/api/js?callback=initMap">
    //src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>
	
  </body>
</html>
