<?php
session_start();
$user=$_SESSION['user'];
if($user)
{
	$per00=$_SESSION['per00'];
	$_DATABASE_=$_SESSION['_DATABASE_'];
	include("renew/db1.php");
	if($per00==1)
	{
		$query  = "UPDATE users SET count='0', Activated='On', disabledate='', login_status='0' WHERE username='$user'";
	}
	else
	{
		$query  = "UPDATE student_m SET count='0' WHERE username='$user'";		
	}
	execute($query);
	session_unset();
}

$par=$_REQUEST['par'];
if($par==2)
	$dismsg='Invalid user name or password';
if($par==4)
	$dismsg='Invalid user name or password';
$type=$_REQUEST['type'];
if($type==2)
{
	$inputvlaue='STUDENT';
	$inputmsg='Student';
	$classname1='bgbutton';
	$classname2='bgbutton';
	$classname3='bgbutton1';
}
elseif($type==3)
{
	$inputvlaue='PARENT';
	$inputmsg='Parent';	
	$classname1='bgbutton';
	$classname2='bgbutton1';
	$classname3='bgbutton';
}
else
{
	$inputvlaue='STAFF';
	$inputmsg='Staff';
	$classname1='bgbutton1';
	$classname2='bgbutton';
	$classname3='bgbutton';

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<TITLE >MySchoolOne</TITLE>
<link rel="icon" href="renew/icon.png" title=": :   Welcome to MySchool   : :">
<style>
* {
/*margin: 0;*/
}
html, body {
	
	background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAADCAIAAADZSiLoAAAAHElEQVQIHWP48+fP9+/f////zwCkgBwQC4ghAACODRqkCkEF0QAAAABJRU5ErkJggg==);
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	margin-top:1px;
	margin-bottom:0px;
	margin-left:0px;
	margin-right:0px;
	color:#000;
	margin-top:1px;
}

.bgbutton {
  display: inline-block;
  padding: 3px 6px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.428571429;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
       -o-user-select: none;
          user-select: none;
		  
}
.bgbutton1 {
  display: inline-block;
  padding: 3px 6px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.428571429;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
       -o-user-select: none;
          user-select: none;
		  
}

.bgbutton:focus {
  outline: thin dotted #333;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
}

.bgbutton:hover,
.bgbutton:focus {
  color: #333333;
  text-decoration: none;
}

.bgbutton:active,
.bgbutton.active {
  background-image: none;
  outline: 0;
  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
          box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}

.bgbutton.disabled,
.bgbutton[disabled],
fieldset[disabled] .bgbutton {
  pointer-events: none;
  cursor: not-allowed;
  opacity: 0.65;
  filter: alpha(opacity=65);
  -webkit-box-shadow: none;
          box-shadow: none;
}

.bgbutton {
  color: #333333;
  background-color: #FFF;
  border-color: #cccccc;
}
.bgbutton1 {
  color: #333333;
  background-color: #DFDFDF;
  border-color: #cccccc;
}

.bgbutton:hover,
.bgbutton:focus,
.bgbutton:active,
.bgbutton.active,
.open .dropdown-toggle.bgbutton {
  color: #333333;
  background-color: #ebebeb;
  border-color: #adadad;
}

.bgbutton:active,
.bgbutton.active,
.open .dropdown-toggle.bgbutton {
  background-image: none;
}

.header
{
	background-color:#3672BA;
	margin-left:0px;
	margin-right:0px;
	margin-top:1px;
	height:60px;
	width:100%;
}
.footer
{
	background-color:#3672BA;
	margin-left:0px;
	margin-right:0px;
	margin-bottom:1px;
	width:100%;
	height: 4em;
}
</style>
<link rel="stylesheet" href="tab.css">
<script src="jquery/1.10.2/jquery.min.js"></script>
<script>
function fadeIn(obj) {
    $(obj).fadeIn(1000);
}
</script>
<script type="text/javascript">
function student()
{
	
	document.getElementById("user_cat").value='STUDENT';
	document.getElementById("Staff").className='bgbutton';
	document.getElementById("Parents").className='bgbutton';
	document.getElementById("Student").className='bgbutton1';
	document.getElementById("mainname").innerHTML="&nbsp;&nbsp;&nbsp;Student Login<BR>&nbsp;";
}
function admin()
{
	
	document.getElementById("Staff").className='bgbutton1';
	document.getElementById("Parents").className='bgbutton';
	document.getElementById("Student").className='bgbutton';
	document.getElementById("user_cat").value='STAFF';
	document.getElementById("mainname").innerHTML="&nbsp;&nbsp;&nbsp;Staff Login<BR>&nbsp;";
}
function parent()
{
	
	document.getElementById("Staff").className='bgbutton';
	document.getElementById("Parents").className='bgbutton1';
	document.getElementById("Student").className='bgbutton';
	document.getElementById("user_cat").value='PARENT';
	document.getElementById("mainname").innerHTML="&nbsp;&nbsp;&nbsp;Parent Login<BR>&nbsp;";
}
function login()
{
	var userId=document.getElementById("user_cat").value;
	var password=document.getElementById("password").value;
	if(userId=='' || password=='')
	{
		alert("Please enter credentials");   
	}
	else
	{
		document.frm.submit();
	}
}
</script>
</head>
<body>
<div class="header"></div>
<form name="frm" method='post' action='renew/login.php'>
 <input type="hidden" name='user_cat' id="user_cat" value='<?=$inputvlaue?>'>
<div style="padding-top:6%;" ></div>
<table align="center" width="75%"  >
<tr>
	<td width="50%" >
    
   <table align="left" border="0" cellpadding="0" cellspacing="0" style="backface-visibility:visible" width="100%">
	<tr>
       
    <td align="left">
  <div id="image">
    <img id="preload" onload="fadeIn(this)" src="logo.jpeg" style="display:none;"  width="400" align="absmiddle" />
</div>
</td>
			<td align="left"><img src="line.png" width="1" height="350" align="absmiddle"></td>
   </tr>

</table>
</td>
<td width="50%" style="padding-left:4%;backface-visibility:visible" >
   <table align="center" border="0" >
     <tr>
     	
        <td align="center"><input type="button" class="<?=$classname1?>"  style="min-width:100px;" onclick="admin()" id='Staff' value="Staff" /></td>
        <td align="center"><input type="button" class="<?=$classname2?>"  style="min-width:100px;" onclick="parent()" id='Parents' value="Parents" /></td>
        <td align="center"><input type="button" class="<?=$classname3?>"  style="min-width:100px;" onclick="student()" id='Student' value="Student" /></td>
  

 <tr>
	<td nowrap colspan="3" >&nbsp;&nbsp;&nbsp;</td>
</tr>

<tr>
	<td nowrap colspan="2" id="mainname">&nbsp;&nbsp;&nbsp;<?=$inputmsg?> Login<font color="#FF0000">&nbsp;&nbsp;&nbsp;&nbsp;<?=$dismsg?></font><BR>&nbsp;</td>
</tr>
<tr>
	<td >&nbsp;&nbsp;&nbsp;Username<BR>&nbsp;</td>
    <td><input type="Text" name="username" id="userId"  style="width:260px; height:25px"  required/><BR>&nbsp;</td>
<tr>
	<td >&nbsp;&nbsp;&nbsp;Password<BR>&nbsp;</td>
    <td> <input type="password" name="password" id="password"  style="width:260px; height:25px" required/><BR>&nbsp;</td>
</tr>
</table>
	<p align="center" style="padding-left:8%">
         <input type="submit" name="" value="Login" class="bgbutton" onclick="login()" style="width:130px; height:30px"/>
      </p>
	</td>
</tr>
</table>
</form>
</body>
</html>