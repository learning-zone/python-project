<?php
session_start();
include("../db.php");
$q=$_GET["q"];
$type=$q;
?>
<html>
<head>
<!----timecode---->
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>
<!---time_end--->
</head>
<body>
<?php
if($type==2)
{
?>
 <input type="text" name="adate" value="<?php echo $adate?>" size="10" style="height:30px" placeholder="dd/mm/yyyy" readonly> &nbsp;
        <a href="javascript:showCal('Calendar1')"><img src="Calendar.gif" align="absmiddle"></a>
<?php
}
else
{
?>
<?php
}
?>
<!----timecode---->
