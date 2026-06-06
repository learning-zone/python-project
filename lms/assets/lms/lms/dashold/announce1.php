<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">
#marqueecontainer {
	position: relative;
	width: 390px; /*marquee width */
	height: 210px; /*marquee height */
	background-color: light orange;
	overflow: hidden;
	border: none;
	padding: 2px;
	padding-left: 4px;
}

.scroll_div {
	background-color: light orange;
	border: solid 1px #66CCFF;
	width: 300px;
	width /**/: 280px !important;
}

.vmarquee_content {
	position: absolute;
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
</style>

<script type="text/javascript" language="javascript">
  
 var  delayb4scroll=1000; 
var marqueespeed=1; 
var pauseit=1; 
var tim;

var copyspeed=marqueespeed;
var pausespeed=(pauseit==0)? copyspeed: 0;
var actualheight='';
var acht='';


function scrollmarquee(){
		marqueeheight = document.getElementById("marqueecontainer").offsetHeight;
		actualheight = cross_marquee.offsetHeight;
	 	if (document.getElementById('track').value == "") {
			if (parseInt(cross_marquee.style.top)>(actualheight*(-1)+8)) {
				cross_marquee.style.top=parseInt(cross_marquee.style.top)-copyspeed+"px";
				
			}
			else {
				 cross_marquee.style.top=parseInt(marqueeheight)-8+"px";
			}
		}
	}
	


//press down
function pressdown() {
		document.getElementById('track').value = "yes";
		//marqueeheight=document.getElementById("marqueecontainer").offsetHeight;
		actualheight = cross_marquee.offsetHeight;
		
			if (parseInt(cross_marquee.style.top)<(actualheight-8-(actualheight-acht))) {
				cross_marquee.style.top=parseInt(cross_marquee.style.top)+ 10 +"px";
			   
			  
				tim = setTimeout("pressdown()", 150);
			}
			else {
				//alert(cross_marquee.style.top);
				//alert(actualheight);
				//alert("inside else");
				cross_marquee.style.top=parseInt(marqueeheight)*(-1)-(actualheight-acht)+"px";
				tim = setTimeout("pressdown()", 150);
			}
	}

//press up

function pressup() {
		document.getElementById('track').value = "yes";
		actualheight = cross_marquee.offsetHeight;
		
		
			if (parseInt(cross_marquee.style.top)>(actualheight*(-1)+8)) {
				cross_marquee.style.top=parseInt(cross_marquee.style.top)-10 +"px";
				tim = setTimeout("pressup()", 150);
			}
			else {
				//alert("inside else");
				cross_marquee.style.top=parseInt(marqueeheight)-8+"px";
				tim = setTimeout("pressup()", 150);
				
			}
	}

//on mouse out
function mouse_out() {
		document.getElementById('track').value = "";
		clearTimeout(tim);
		scrollmarquee;
	}
	
//init()
function initializemarquee(){
	cross_marquee=document.getElementById('vmarquee');
	actualheight = cross_marquee.offsetHeight;
	acht=cross_marquee.offsetHeight;
  	cross_marquee.style.top=0;
    marqueeheight = document.getElementById("marqueecontainer").offsetHeight;

		setTimeout('lefttime=setInterval("scrollmarquee()",35)', delayb4scroll);
}

function openNews(linkUrl) {

	var w=window.open(linkUrl, 'glossarypopup', 'scrollbars=yes,menubar=no,height=600,width=810,resizable=yes,toolbar=no,location=no,status=no'); 
	w.focus(); 
	return false;
}

</script>
</head>

<body style="background-image:url(bgy.png)" onload="initializemarquee()" oncontextmenu="return false;">

<?php
session_start();
$per00=$_SESSION['per00'];
include("db1.php");
?>
	   <div style="width:300px" align="center">
      
       <img src="annonce.png" width="300px" height="41"/>
     
     
      </div>
      <div id="marqueecontainer" onmouseover="copyspeed=pausespeed" onmouseout="copyspeed=marqueespeed" 
      style="  width:300px"> 
        <div id="vmarquee" class="vmarquee_content" style=" " align="center">
            
                <?php
                for($i=0;$i<15;$i++)
                {
                ?>
                    <P width="155" align="justify" style="border:thick #FFF; background-color:#DFDFDF" >
                        <font color="#000066">
                        <a href="javascript:void(0);" onclick="openNews(&#39;afterNews.html#Dellflashdrive&#39;);" style="text-decoration: none;"> 
                        Buy Dell flash drive and win a free surprise gift !!! hury up ! offer limited period of time.</a>
                        </font>
                      </P>
                <?php
                }
                ?>
           
        </div>
    </div>
        <input id="track" name="track" type="hidden" value=""></td>

</body>
</html>