<?php

class RecordTxt {


// 
// So  far   ,  a  working  version   ,  takes  as  an  argument   array + variable ; 
// How it records:
//it gets values, which are recorded by default(ip, date, browser)
// arguments which passed in method are proccessed by foreach
// By default, file_put_contents rewrites the whole file, we can use file_put_contents($filename, "\n" . $itemSubj, FILE_APPEND), but FILE_APPENDFILE_APPEND will add new line in the end.
//To add a new line in the beginning of file, and to avoid the use of reverse() of txt.file if we used {FILE_APPEND}, we 1stle construct $content with all data and then add to $content all the rest of existed file{ file_get_contents($filename)}
// By  file_put_contents(), we erase the old content and put a new one.
//To use hidden div, available on arrow click, we add {<span class='imgClick'>&#9660;</span> <p class='info' style='display:none;'>} before foreach, and "</p>" after it.


// Universal function records  to  txt date,ip, UsAgent and  as  many $_GET/S_POST inputs u place (called in function as  an array)=>//RecordAnyInput(array('item1', 'item2', 'item3'), 'recodText/FilenameText.txt');
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **

    public static function RecordAnyInput($idArray, $filename){
        date_default_timezone_set("Europe/Kiev");
        $date = date("d.m.y.H:i");  //get date  and  User Agent and browser;
        $uAgent = $_SERVER['HTTP_USER_AGENT'];//$browser = get_browser(); //$browser not  working;
 
        $ip = $_SERVER['REMOTE_ADDR'];
                       //getting IP (profound)
                        /* if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                             $ip = $_SERVER['HTTP_CLIENT_IP'];
                         } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                             $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                         } else {
                             $ip = $_SERVER['REMOTE_ADDR'];
                         }*/
                       // END  getting  IP(profound)
					   
	
	
	
        //new add, adds  in the beginning, no need to use reverse------------------	---------------
	   //$file = file_get_contents($filename);
	
        $content = "\n \n \n \n \n --------------------------------------------------\n \n \n " . $date . "  -  IP: " . $ip . "\n" ; // adds the existed content to the end
	    $content = $content . "\n<span class='imgClick'>&#9660;</span> <p class='info' style='display:none;'>"; //start of hidden content
		
	    foreach ($idArray  as $itemSubj) {
            //echo $itemSubj."</br>";
            $content = $content  . $itemSubj . "\n" ; // adds the existed content to the end;	 
        } //end  foreach;
		
	    $content = $content . $uAgent . "</p>";
	    $content = $content . "\n --------------------------------------------------\n \n " . file_get_contents($filename);
        file_put_contents($filename, $content);  
       //new add, adds  in the beginning, no need to use reverse---------------------------------------

	   
	   
	   



// OLD version, which was formed by reverse			   
/*
     file_put_contents($filename, "\n \n \n \n-----------------------\n" . $date . " - " . $ip . "\n" . $uAgent,FILE_APPEND); //save  date,ip and  UsAgent;
	 
	 // adding an arrow to show hide content
	 file_put_contents($filename, "\n <span class='imgClick'>&#9660;</span> "."<p class='info' style='display:none;'>", FILE_APPEND);
     foreach ($idArray  as $itemSubj) {
         
         //echo $itemSubj."</br>";//commment  in production
         file_put_contents($filename, "\n" . $itemSubj , FILE_APPEND);//save each array item  provided  ob calling  function;
		 
     }//end  foreach;
	 
	 file_put_contents($filename, "\n </p> \n \n \n \n", FILE_APPEND);
	 
	 */
}
//--------

// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************


//Calling   function with  arguments(array  and  var.);
//RecordAnyInput(array('item1', 'item2', 'item3'), 'recodText/FilenameText.txt');












} // end  Class
























?>
