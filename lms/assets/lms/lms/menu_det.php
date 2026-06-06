<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>renew</title>
<style type="text/css">
.menutitle{
cursor:pointer;
margin-bottom: 0px;
padding:3px;
background-color:#C00;
background-color:#ECECFF;
background-image:url(images/glossyback2.png);
color:#FFF;
width:176px;
text-align:left;
font-weight:bold;
font-size:11px;
/*/*/border:1px solid #000000;/* */
}

.submenu{
background-color:#E5EBED;
margin-bottom: 0px;
font-size:12px;
padding:0px;
border:1px solid #000000;

}
.dis
{
	margin-bottom: 0px;
	padding:3px;
	background-color:#C00;
	background-image:url(images/glossyback4.png);
	color:#000000;
	width:176px;
	font-weight:bold;
	font-size:11px;
	border:1px solid #000000;
}
 
</style>

<script type="text/javascript">

/***********************************************
* Switch Menu script- by Martial B of http://getElementById.com/
* Modified by Dynamic Drive for format & NS4/IE4 compatibility
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var persistmenu="yes" //"yes" or "no". Make sure each SPAN content contains an incrementing ID starting at 1 (id="sub1", id="sub2", etc)
var persisttype="sitewide" //enter "sitewide" for menu to persist across site, "local" for this page only

if (document.getElementById){ //DynamicDrive.com change
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}

function SwitchMenu(obj)
{
	if(document.getElementById){
	var el = document.getElementById(obj);
	var ar = document.getElementById("masterdiv").getElementsByTagName("span"); //DynamicDrive.com change
		if(el.style.display != "block"){ //DynamicDrive.com change
			for (var i=0; i<ar.length; i++){
				if (ar[i].className=="submenu") //DynamicDrive.com change
				ar[i].style.display = "none";
			}
			el.style.display = "block";
		}else{
			el.style.display = "none";
		}
	}
}

function get_cookie(Name) { 
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) { 
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function onloadfunction(){
if (persistmenu=="yes"){
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=get_cookie(cookiename)
if (cookievalue!="")
document.getElementById(cookievalue).style.display="block"
}
}

function savemenustate(){
var inc=1, blockid=""
while (document.getElementById("sub"+inc)){
if (document.getElementById("sub"+inc).style.display=="block"){
blockid="sub"+inc
break
}
inc++
}
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=(persisttype=="sitewide")? blockid+";path=/" : blockid
document.cookie=cookiename+"="+cookievalue
}

if (window.addEventListener)
window.addEventListener("load", onloadfunction, false)
else if (window.attachEvent)
window.attachEvent("onload", onloadfunction)
else if (document.getElementById)
window.onload=onloadfunction

if (persistmenu=="yes" && document.getElementById)
window.onunload=savemenustate

</script>
</head>

<body bgcolor="#E5EBED">
<?php
session_start();
include("db.php");
if($per00==1  and $parent!=1)
{
	//to check log 
	$myday=date("Y-m-d");
	$today = getdate();
	$month = $today['mon'];
	$day = $today['mday'];
	$year = $today['year'];
	$ndate= date(" d-m-Y",mktime(0,0,0,$month,$day-7,$year));
	$last_date=explode('-',$ndate);
	$day=trim($last_date[0]);
	$month=trim($last_date[1]);
	$year=trim($last_date[2]);
	$qry="insert into log (username,address,accessdate,urladdress,linkname,trans_date) ";
	$qry.=" values('$user','$REMOTE_ADDR','$date[year]-$date[mon]-$date[mday] $date[hours]:$date[minutes]:$date[seconds]',";
	$qry.=" '$PHP_SELF','$ln','$date[year]-$date[mon]-$date[mday]')";
	mysql_query($qry) or die(mysql_error()."error1");
	//code end 
	 
	$det = mysql_query(" select linkname from usermenu where module='Main' and username='$user' and access='YES' order by id");
	while($row1=mysql_fetch_array($det))
	{
		$main_module_name[]=$row1[linkname];
	}
	echo "<div id='masterdiv'><table cellpadding='0' cellspacing='0' border='0' width='100%' >";
	for($i=0;$i<sizeof($main_module_name);$i++)
	{
?>
		<a class='link' href='content_det.php' target='content'><div class="menutitle" onClick="SwitchMenu('<?=$main_module_name[$i]?>')">
       &nbsp;&nbsp; <?=$main_module_name[$i]?></div></a>
	<span class="submenu" id="<?=$main_module_name[$i]?>">
    <?php
		$module=$main_module_name[$i];
		$_SESSION['module']=$module;
		$det2=mysql_query("select submodule from usermenu where module='$main_module_name[$i]' and username='$user' and access='YES' group by submodule ");
		while($row3=mysql_fetch_array($det2))
		{
			echo "<div class='dis'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='link' href='../renew/submodules/admintask.php?mainmodule=$main_module_name[$i]&submoduledet=$row3[submodule]' target='content'>$row3[submodule]</a></div>";
			//$det1 = mysql_query(" select linkpath, linkname from usermenu where module='$main_module_name[$i]' and submodule='$row3[submodule]' and access='YES' and  username='$user' order by id ");
			while($row2=mysql_fetch_array($det1))
		{
				echo "<div class='dis2'>&nbsp;&nbsp;
				<a class='link' href='$row2[linkpath]' target='content'>$row2[linkname]</a></div>";	
			}
		}
		echo '</span>';
	}
	echo "</div>";
}
//staff code for login ends
//student code for login starts 
if($per00==2 and $parent!=1)
{
	//to check log 
	$myday=date("Y-m-d");
	$today = getdate();
	$month = $today['mon'];
	$day = $today['mday'];
	$year = $today['year'];
	$ndate= date(" d-m-Y",mktime(0,0,0,$month,$day-7,$year));
	$last_date=explode('-',$ndate);
	$day=trim($last_date[0]);
	$month=trim($last_date[1]);
	$year=trim($last_date[2]);
	$qry="insert into log (username,address,accessdate,urladdress,linkname,trans_date) ";
	$qry.=" values('$user','$REMOTE_ADDR','$date[year]-$date[mon]-$date[mday] $date[hours]:$date[minutes]:$date[seconds]',";
	$qry.=" '$PHP_SELF','$ln','$date[year]-$date[mon]-$date[mday]')";
	mysql_query($qry) or die(mysql_error()."error1");
	//code end 
	$det = mysql_query(" select linkname from  studentmenu module='Main' and username='$user' and access='YES' order by id");
	while($row1=mysql_fetch_array($det))
	{
		$main_module_name[]=$row1[linkname];
	}
	echo "<div id='masterdiv'>";
	for($i=0;$i<sizeof($main_module_name);$i++)
	{
		?>
		<div class="menutitle" onClick="SwitchMenu('<?=$main_module_name[$i]?>')"><?=$main_module_name[$i]?></div>
	<span class="submenu" id="<?=$main_module_name[$i]?>">
    <?php
		$module=$main_module_name[$i];
		$_SESSION['module']=$module;
		$det1 = mysql_query(" select linkpath, linkname from  studentmenu where module='$main_module_name[$i]' and access='YES'");
		while($row2=mysql_fetch_array($det1))
		{
		echo "<img src='../images/test.gif' width=10 height=8 alt=arr.jpg border=1>&nbsp;
		<a href='$row2[linkpath]' target='content'>$row2[linkname]</a><br />";	
		}
		echo '</span>';
	}
	echo "</div>";
	
}
//student code for login ends 
//parrents code for login starts 
if($parent==1)
{
	//to check log 
	$myday=date("Y-m-d");
	$today = getdate();
	$month = $today['mon'];
	$day = $today['mday'];
	$year = $today['year'];
	$ndate= date(" d-m-Y",mktime(0,0,0,$month,$day-7,$year));
	$last_date=explode('-',$ndate);
	$day=trim($last_date[0]);
	$month=trim($last_date[1]);
	$year=trim($last_date[2]);
	$qry="insert into log (username,address,accessdate,urladdress,linkname,trans_date) ";
	$qry.=" values('$user','$REMOTE_ADDR','$date[year]-$date[mon]-$date[mday] $date[hours]:$date[minutes]:$date[seconds]',";
	$qry.=" '$PHP_SELF','$ln','$date[year]-$date[mon]-$date[mday]')";
	mysql_query($qry) or die(mysql_error()."error1");
	//code end 
	$det = mysql_query(" select linkname from parentmenu module='Main' and username='$user' and access='YES' order by id");
	while($row1=mysql_fetch_array($det))
	{
		$main_module_name[]=$row1[linkname];
	}
	echo "<div id='masterdiv'>";
	for($i=0;$i<sizeof($main_module_name);$i++)
	{
		?>
		<div class="menutitle" onClick="SwitchMenu('<?=$main_module_name[$i]?>')"><?=$main_module_name[$i]?></div>
	<span class="submenu" id="<?=$main_module_name[$i]?>">
    <?php
		$module=$main_module_name[$i];
		$_SESSION['module']=$module;
		$det1 = mysql_query(" select linkpath, linkname from parentmenu where module='$main_module_name[$i]' and access='YES' ");
		while($row2=mysql_fetch_array($det1))
		{
		echo "<img src='../images/test.gif' width=10 height=8 alt=arr.jpg border=1>&nbsp;
		<a href='$row2[linkpath]' target='content'>$row2[linkname]</a><br />";	
		}
		echo '</span>';
	}
	echo "</div>";
	
}
//parrents code for login ends 
?>
</body>
</html>