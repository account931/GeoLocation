<?php

  // Record (with CLASS) all the  input  to  txt;  //;
      include("../Classes/RecordTxt.php");
	  
	  
	  
	  
	  //$address = 'https://www.google.com/maps/@'.$_POST['cityLat'] . ',' .$_POST['cityLon'] . ',18z'; // construct the gmaps link, it has no marker
	  $address = 'https://www.google.com/maps/search/?api=1&query=' . $_POST['cityLat'] . ',' . $_POST['cityLon'];  //link to gmaps with a marker 
	  //constructs <a href> with gmaps URL
	  $gmapLink = "<a target= '_blank' href =' " . $address . " '>" .$address ."</a>";
	  
	  
	  //records lat, lon, gmaps link
      RecordTxt::RecordAnyInput(array( "lat: " .$_POST['cityLat'],   "lon: ".$_POST['cityLon'],   $gmapLink, "address: " . $_POST['address']  ),    '../recordText/geolocation.txt');// Record  to  text;
	  
      //End  Record;




//https://maps.googleapis.com/maps/api/geocode/json?latlng=50.2626365,28.6618537


?>
	
	
	
