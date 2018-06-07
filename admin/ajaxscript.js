// used in  display.php
//http://www.codechewing.com/library/output-contents-of-textfile-javascript-ajax/    Phh part is  not  required, as  it  takes  just txt and  no SQL NEED????????



//http://example2.esy.es/tr/ipTrack.txt








//AJAX  requesting- WORKSSSS
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// ** 
//  START    WORKING XMLHttpRequest !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
window.onload = function() {
 // var ul = document.getElementsByTagName('ul')[0];
 
  function readTextfile() {
    var xhr = new XMLHttpRequest();
 
    xhr.onreadystatechange = function() {
      if(xhr.readyState === 4) {
        if(xhr.status == 200) {
          showContents(xhr.responseText, xhr);
        }
      }
    }
 
    xhr.open('GET', '../recordText/geolocation.txt', true);
    xhr.send();
  }
 
  function showContents(responseText) {
   // var li = document.createElement('li');
    //var date = new Date();
    //li.innerHTML = date + ': ' + responseText;
    //ul.appendChild(li);
//mine
      var  div =document.getElementById("displayDiv");  
//start   splitting  MINE
responseText = responseText.split("\n").reverse().join("</br>");     //responseText=responseText.split("").reverse().join("");
// END   splitting  MINE
       div.innerHTML=responseText;
  }
 
  readTextfile();
  setInterval(readTextfile, 10 * 60 * 1000  );     //10 * 60 * 1000 =10min   //50000
 
}
// END // WORKING XMLHttpRequest !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************













//NOT IN USE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// ** 
//This  is  script  ONLY for  ajax  count  number  messages-NOT USED!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
/*$(document).ready(function(){
//  Repeats  every 100 sec*******************
setInterval(function()
  {
      $.post('example2.esy.es/tr/ajaxphprequest.php?getFile', {}, function(feed) 
 //feed  can have  any  name????    //http://example2.esy.es/tr/ajaxphprequest.php?getFile //?getFile parameter  u  create  yourself,it does not  exist  in real
      {
          var html = '';
          for(i = 0; i < feed.length; i++)
          {
              html = html + feed[i];  
         }
          $('#displayDiv').html(html);
      },'json');
  }, 3000000);    //60000   1  minute
// End  Repeats------------------------
 }); */
// MOT IN USE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!11
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************