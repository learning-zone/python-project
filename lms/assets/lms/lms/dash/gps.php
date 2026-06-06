<?php
	session_start();
	$per00=$_SESSION['per00'];
	include("../db.php");

	$user=$_SESSION['user'];
	$usernamedet=$_SESSION['usernamedet'];
	$ststemdate=date("Y-m-d");
?>



<!DOCTYPE html>
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
<script type="text/javascript">
function ReloadMe(classid,secid)
{		
	var w=800,h=500;
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open ('student_det/view_studlist_att.php?clid='+classid+'&secid='+secid, 'STUDENT ATTENDANCE', '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

}
function ReloadMe1(classid,secid)
{		
	var w=800,h=500;
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open ('all.php?type='+classid+'&secid='+secid, 'STUDENT ATTENDANCE', '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

}
</script>
<script type="text/javascript" src="Code/Highcharts-3.0.2/js/jquery.min.js"></script>

</head>
<body style="background-image:url(bgy.png)" >
 <table class=""  width="100%"  border="1"  cellpadding="3" cellspacing="10" style="border:1px solid black;">
<?php
$sql=execute("select simNumber from rfid_gpsinfo where timeStamp like timeStamp '$ststemdate%' group by simNumber order by id desc ");
while($r=fetcharray($sql))
{	 
      $placedet=fetchrow(execute("select timeStamp, location from  rfid_gpsinfo where simNumber='$r[0]' order by id desc limit 1"));
	  $t=explode(' ',$placedet[0]);
	  echo "<tr>
      <td style='border:0px solid black;' bgcolor='#EDF5FF'><b>&nbsp;&nbsp;&nbsp;&nbsp;
        $r[0]</b></td>
        <td style='border:0px solid black;' bgcolor='#EDF5FF'>$placedet[1] $t[1]
        </td>
	</tr>  ";
 }
 ?>    
     
      </table>
</body>
</html>