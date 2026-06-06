<?php
session_start();
$user=$_SESSION['user'];
$per00=$_SESSION['per00'];
$_DATABASE_=$_SESSION['_DATABASE_'];
$module='Main';
$_SESSION['module']=$module;
?>
<HTML>
<HEAD>
<link rel="SHORTCUT ICON" href="/images/claret_logo_mini.gif"/>
<link rel="stylesheet" type="text/css" href="mistStyle.css">
<base TARGET="main">
</HEAD>
<BODY class='homebody'>
<H1></H1>
<!--<BLOCKQUOTE>-->
<?php
include("showmenu.php");
?>
</BODY></HTML>
