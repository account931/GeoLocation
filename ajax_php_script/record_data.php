<?php

  // Record (with CLASS) all the  input  to  txt;  //;
      include("../Classes/RecordTxt.php");
	  
	  //records lat, lon, gmaps link
	  $address = 'https://www.google.com/maps/@'.$_POST['cityLat'] . ',' .$_POST['cityLon'] . ',20z'; // construct the gmaps url
	  //constructs <a href> with gmaps URL
	  $gmapLink = "<a target= '_blank' href ='https://www.google.com/maps/@".$_POST['cityLat'] . "," .$_POST['cityLon'] . ",20z'>" .$address ."</a>";
	  
      RecordTxt::RecordAnyInput(array( "lat: " .$_POST['cityLat'], "lon: ".$_POST['cityLon'], $gmapLink  ),  '../recordText/geolocation.txt');// Record  to  text;
	  
//End  Record;




//https://maps.googleapis.com/maps/api/geocode/json?latlng=50.2626365,28.6618537


?>
	
	
	
