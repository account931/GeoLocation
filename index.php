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
	
	//window.lat = 'Z';
	//window.lon = 'y';
	//window.pos;
	
	
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
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
			
           
			
			  // Mine
			  
			lat = position.coords.latitude;
			lon = position.coords.longitude;
			//
			  alert("Inside -> " + lat);
			//alert(position.coords.latitude + " " + position.coords.longitude );
			
			//run ajax to get Address from lat, lon , UNDER CONSTRACTION
			//ajaxGetAddressbyCoords();
			
			//sends ajax request to ajax_php_script/record_data.php to record ip, date, lat, lon using RecordTxt::RecordAnyInput(array( "lat: " .$_POST['cityLat'], "lon: ".$_POST['cityLon'], $gmapLink  ),  '../recordText/geolocation.txt');
			myAjaxRequest();
			
			// End mine
			
			
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
		  
		  
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
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
            success: function(data) {
				alert(JSON.stringify(data, null, 4));
              // alert (data.results.address_components[0].long_name);
            },  //end success
			error: function (error) {
				
            }	
        });
		  
	  }
	  // end ajaxGetAddressbyCoords()----------------------------------------
	  
	  
	  
    </script>
	
	
    <script async defer
	src="https://maps.googleapis.com/maps/api/js?callback=initMap">
    //src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>
	
  </body>
</html>



