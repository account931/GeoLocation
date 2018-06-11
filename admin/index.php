<?php
session_start();
 
 //checking password
 if(isset($_POST['pass1'])){
   if($_POST['login1']=='11' && $_POST['pass1']=='11') {
	   $_SESSION['auth226691'] = true;
	   //echo 'true';
	   /$loggedURL = 'http://waze.zzz.com.ua/geolocation/admin/index.php';
	   $loggedURL = $_SERVER['DOCUMENT_ROOT'];//$_SERVER['DOCUMENT_ROOT'] ; //. "/admin/index.php";
	   header ("L/ocation: $loggedURL");
	   header("Refresh:0");
    } else { 
	    echo '<p style="color:red;">Failed</p>';
	}
  } // End  if(isset($_POST['pass1']))
	
  //Log OUT
  if(isset($_GET['logout'])){
    session_destroy();
	unset($_SESSION['auth226691']); 
	unset($_GET['logout']);
	//$loggedURL = 'http://waze.zzz.com.ua/geolocation/admin/index.php';
	$loggedURL = $_SERVER['DOCUMENT_ROOT'] . 'admin/index.php?go=true';
	
	header ("Location: $loggedURL"); //$_SERVER['DOCUMENT_ROOT']
	//header ("Location: /admin/index.php?log=true"); //$_SERVER['DOCUMENT_ROOT']
	die;
  }
  

//THIS  SHOWS  ALL  RECORDS ,  normal  &  Ajax//<!--check pass and  set SESSION['X']+unset when logged-->
//<!--uses ajaxscript.js+ ajaxphprequest.php (LAST IS FALSE!!!!)-->
// Session strat should the 1st line at all, causesed ERRORS
?>



<!DOCTYPE html>
  <html>
  <head>
  <title>Admin Section</title>
  <meta charset="utf-8">
  <!--<link rel="stylesheet" type="text/css" href="style.css" />-->

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="ajaxscript.js"></script><!--AJAX script-->

  <!--bootstrap-->
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->


  <script> //click on arrow  down to  see  hissen info (UserAgent, address)  info  //&#9660
      $(document).ready(function(){  
	      //Mega error was here, ajax click part did not JS worked, should have used for new generated click
	      $(document).on("click", '.imgClick', function() {   // this  click  is  used  to   react  to  newly generated cicles;
          //$(".imgClick").click(function(){         
              $(this).next("p").toggle(300); //open  and closes
              // shifting tiangles  with HTML Entity http://www.fileformat.info/info/unicode/char/25b2/index.htm
              if($(this).text()=="\u25BC"){
				  $(this).html("\u25B2"); 
			} else {
				$(this).html("\u25BC");
			}
         });
		 
      });
  </script>


  <style>
   .shadow2R{text-shadow: 2px 2px 4px  black/*#000000*/; }
   .boxedshadow{box-shadow: 0 0 10px rgba(0,0,0,1.5); padding:1.2em;}
   .format{width:60%;}
   .imgClick:hover{cursor:pointer;color:red;}// arrow  down  style
   .imgClick{padding-left:65px;}
   .hiddennn{display:none;}
   #log {word-wrap: break-word;}
  </style>
  </head>


  <body>
    <center>
    <!-- admin part  for  viewing log  for  anyone  having password-->

    <?php
    //session_start(); //1st line above
    //$_SESSION['auth226691']=true;   BUGGG
    if(!isset($_SESSION['auth226691']))
	{ 
    ?>    


        <!------------------------------------------------If not auth226691orized---------------------------------------->
        <div id="login" class="shadow2 ">
        <!--<img scr="http://example2.esy.es/tr/images/accessd.png" alt="access"/>-->
            <p class="imgClick">&#9660;</p> <p style="display:none;font-size:46px;" class="hiddennn">NO ACCESS  GRANTED</p>
            </br></br>
                <form action="" method="post">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login:&nbsp<input type="text" name="login1" required class="resultRu">
                    </br></br>
                    Password:&nbsp<input type="password" name="pass1" required class="resultRu">
                    <br><br>
                    <input type="submit" value="Submit" class="convert">

                </form>
				</br></br>
          </div>
         <!------------------------------------------------END If not auth226691orized---------------------------------------->
		 
    <?php
    } else {   // else  password is  correct
    ?>

    <div id="log" class="boxedshadow format">
        </br>
		<a style="color:red;border:1px solid  red;padding:4px;" href="index.php?logout">Log out</a>
		</br></br></br>
    <!-----------------------------------------------------------------------------------Display log----------------------------------------------------------->
        <?php
        //echo file_get_contents( "ipTrack.txt" ); // get the contents in REVERSE , and echo it out
        //doing  reverse-temporary  disabled,trying  to  ressigned  to AJAX
        $file = file("../recordText/geolocation.txt");
        //$file = array_reverse($file);
        foreach ($file as $f){
            echo $f."<br>";
		}
        //below  works  but  not  making reverse  list*********
       /*foreach (glob( "ipTrack.txt") as $filename) {
           echo nl2br(file_get_contents($filename));
           echo "<br></br>";
        }*/
       // END below  works  but  not  making reverse  list-----------
       ?>
	   
	   
	   
	   
	   
	   
    <!--  for  ajax  htmling-->
    <!-----------------  Logic  of  ajaxing   is located   in  scriptajax.js , USES  REVERSED ARRAY!!!!!----------> 
    </br></br></br></br></br>
    <h1 class="boxedshadow">Ajax Responses</h1>
        <div id ="displayDiv"></div>  
    <!-- END  for  ajax  htmling-->
    <!--<ul></ul>--> <!--  Ajax   Ul  without  PHP  part-->

   <?php
    } //else
   ?>
   <!-- END  Display  comment-->

  </div>






    </center>
  </body>
</html>