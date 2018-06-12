GeoLocation
It includes 2 version {index.php, index_prev.php}, admin/index.php is  a restricted view of recorded txt.
1.index.php - it is a new version, that works without SSL certificate, code was taken from StackOverflow + mixed with my version2 (getting  address by coordinates, record text)
2.index_prev.php includes prev version, which worked on SSL only, code was taken from official google map documentation



//-----------------------------------------------------------------------------

How  works Variant 1,(index.php, a new version, that works without SSL certificate, code was taken from StackOverflow + mixed with my version2 (getting  address by coordinates, record text) ):
1.1 Consists of 2 parts, the 1st taken from StackOverflow, it runs function {tryGeolocation()}, if it success - run function {browserGeolocationSuccess()}, which contains function recenterMap(latX,lonX);
recenterMap(latX,lonX) puts found coords to Object pos, pass it to {infoWindow.setPosition(pos)} to change GM coordinates to found,
 then runs {ajaxGetAddressbyCoords(myLat, myLon) to get ajaxed address by coordinates} and then runs {myAjaxRequest(myLat, myLon) to ajax record lat, lon, address to txt}
1.2. OnLoad , by default {function initMap()} loads GM with default coordinates, using src="https://maps.googleapis.com/maps/api/js?callback=initMap">
1.3 If {tryGeolocation()} fails it runs {browserGeolocationFail()}, that finds the error and if it is {error.message.indexOf("Only secure origins are allowed")},
 runs {tryAPIGeolocation()}, which use different methods to get coords, if {tryAPIGeolocation()} success it runs {recenterMap(latX,lonX,'ssl_string')} as well.

1.4 function {recenterMap(latX,lonX, ssl)-> ajaxGetAddressbyCoords(myLat1, myLon1, ssl_status)}, excepts 3 arg, {ssl_status} is used to detect if it was called in {tryAPIGeolocation}, i.e when was rejected by Chrome due to no SSL.
In this case, address is not accurate, and this string is added to address, to show that result is approximate.
If request is not rejected due to no SSL, {tryGeolocation()-> browserGeolocationSuccess()-> recenterMap(latX,lonX, null)-> ajaxGetAddressbyCoords(myLat, myLon, null) + myAjaxRequest(x, y)
 
 
 
 
 
 
 
 

//-----------------------------------------------------------------------------------------------------------------------------------

How  works Variant 2,(index_prev.php, that Includes prev version, which worked on SSL only, code was taken from official google map documentation):

1.1 geolocation/index.php is a landing page to trace user.
   It draws a Gmap with user position using GM API.In general user coordinates can be obtained without GM API with JS Navigator object only:
   if (navigator.geolocation) {			
          navigator.geolocation.getCurrentPosition(function(position) {	
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
1.2 If lat, lon are detected(if there value is numbers), the script runs ajax function {ajaxGetAddressbyCoords()}, which gets the address by coords. It requires GM Api, and thus script has no Api it may fire "Run of free quata".
    Critical important to use async:false in ajax in  {ajaxGetAddressbyCoords()}, otherwise it won't manage to return found address, while the rest of script is running.
1.3 After it, the script fires {myAjaxRequest()}, it sends with ajax data with lat, lon, address to {geolocation/ajax_php_script/record_data.php'}.
    {geolocation/ajax_php_script/record_data.php'} includes {RecordTxt::RecordAnyInput} method, which takes 2 arguments, the 2 nd arg is a text file to record.
    First arg accept an array with unimited elements to record. Apart from this	{RecordTxt::RecordAnyInput} by default always records date, ip, soft.
	In this case, array contain 4 elements[lat, lon, GMaps Url, address]. GMaps Url(a link to Google Maps with marker) is constructed in $gmapLink which contains <a href> + $address(url itself)


2.1 geolocation/admin/index.php is a landing page for admin to view records. Records sored in text file in recordText/geolocation.txt file. Use simple password access, embedded in code.
2.2  Contains two section: 1st just read txt.file by php, the 2nd the same txt file, but updated every x seconds with ajax{ geolocation/admin/ajaxscript.js}