<?php
session_start();
$user=$_SESSION['user'];
$per00=$_SESSION['per00'];

if($user=='')
{
	header("Location:../index.php");
}
?>
<html>
<head>
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<script language="JavaScript">
	var dt,szStr;
	dt = new Date()
	szStr = dt.getDate() + "-" + (dt.getMonth()+1) + "-" + dt.getYear();
	document.title = "ThoughtFocus KPO";
	window.status = "><><><><><><><   ThoughtFocus KPO  ><><><><><><><";
//	blink();

	function blink(){
		var tm,hr,min,sec,sz;

		tm = new Date()

		hr = tm.getHours();
		min = tm.getMinutes();
		sec = tm.getSeconds();

		if(hr>12){
			 hr -= 12;
			 sz = " PM";
		}else{
			sz  = " AM";
		}


		if(min <=9){
			min = "0" + min;
		}

		if(sec <=9){
			sec = "0" + sec;
		}

		str = hr + ":" + min + ":" + sec + sz;
		window.status = str;
		iFlag = 0;
		setTimeout("blink()",1000);
	}
</script>
<link rel="stylesheet" type="text/css" href="mistStyle.css">

<TITLE > MySchool Implement </TITLE></head>
<link rel="icon" href="favicon.png" title=" MySchool Implement ">

<frameset rows="65,*" cols="*" frameborder="0"> 
 <frameset rows="*" cols="100%">
   <frame name="banner" frameborder="0" border="0" framespacing="0"  scrolling="no" noresize target="contents" src="banner.php">
</frameset>
  <frameset rows="*" cols="210,*">
    <frame name="contents"  framespacing="0"  noresize target="main"  border="0" src="home.php" frameborder="0">
      <frameset rows="*" cols="100%">
    <frame name="main" src="cpg.php"  frameborder="0" framespacing="0" border="0" scrolling="auto">
    </frameset>
  </frameset>

  <noframes>
  <body topmargin="0" leftmargin="0">
  <p>This page uses frames, but your browser doesn't support them.</p>
  </body>
  </noframes>

  </frameset>
</html>