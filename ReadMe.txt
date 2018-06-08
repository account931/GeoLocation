GeoLocation
How it works:

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