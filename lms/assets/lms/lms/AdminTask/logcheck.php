<?php
session_start();
include("../db.php");
include("../urlaccess.php");
$butSubmit = $_POST['butSubmit'];
$logDay = $_POST['logDay'];
$logMonth = $_POST['logMonth'];
$logYear = $_POST['logYear'];
$hhFrm = $_POST['hhFrm'];
$ssFrm = $_POST['ssFrm'];
$hhTo = $_POST['hhTo'];
$ssTo = $_POST['ssTo'];
$date3 = $_POST['date3'];

$hhFrm = $_POST['hhFrm'];
$ssFrm = $_POST['ssFrm'];
$hhTo = $_POST['hhTo'];
$ssTo = $_POST['ssTo'];

?>
<html>

<head>
<?php
$sql="select col_name from college";
$rs=execute($sql);
$row=fetcharray($rs);
$colname=$row[col_name];

?>
<title><?=$colname?></title>
<script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
<script language='javascript'>
function validation()
{
	if(document.frm.logDay.value=="")
	{
		alert("Please enter the LogDay");
		return false;
	}
	else if(document.frm.logMonth .value=="")
    {
		alert("Please enter the LogMonth");
		return false;
	}
	else if(document.frm.logYear.value=="")
    {
		alert("Please enter the LogYear");
		return false;
	}
	else if(document.frm.hhFrm .value=="")
    {
		alert("Please enter the Hours");
		return false;
	}
	else if(document.frm.ssFrm .value=="")
    {
		alert("Please enter the sec");
		return false;
	}
	else if(document.frm.hhTo .value=="")
    {
		alert("Please enter the Hours");
		return false;
	}
	else if(document.frm.ssTo .value=="")
    {
		alert("Please enter the Seconds");
		return false;
	}
	
	else if(document.frm.logMonth.value==2 && (document.frm.logDay.value>29))
	{
		alert("INVALID DATE");
		return false;
	}
	else
	{
		return true;
	}
}



</script>
</head>
<body class='bodyline'>
<layer >
<?php
echo "<center>";
//echo "<form name=frm action=$PHP_SELF method=post >";
echo "<form name=frm action=logcheck.php method=post >";
if($logDay=="")
 $logDay=date("d");
if($logMonth=="")
 $logMonth=date("m");
if($logYear=="")
 $logYear=date("Y");
if($hhFrm=="")
	$hhFrm="00";
if($ssFrm=="")
	$ssFrm="01";
if($hhTo=="")
	$hhTo="23";
if($ssTo=="")
	$ssTo="59";
echo "<table  class='forumline'>";
echo "<tr><td colspan='4' align='center' class='head'>View Log Check</td></tr>";
echo "<tr>";
	echo "<td>";
		echo "Log Date";
	echo "</td>";
	?>
	<td nowrap>
		<input type="text" readonly="" name="date3" value="<?php echo $date3?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar3')"><img src="../images/calendar.jpg"  ></a>
        </td>
        <?php
/*
	echo "<td>";
		echo "<input type=text name=logDay value='$logDay' size=2 maxlength=2><b>-</b>";
		echo "<input type=text name=logMonth value='$logMonth' size=2 maxlength=2><b>-</b>";
		echo "<input type=text name=logYear value='$logYear' size=4 maxlength=4>";

	echo "</td>";
*/
	echo "<td colspan=3></td>";
echo "</tr>";
echo "<tr>";
	echo "<td>";
		echo "Time From";
	echo "</td>";
	echo "<td>";
		//echo "<input type=text name=hhFrm value='$hhFrm' size=2 maxlength=2><b>:</b>";
		
        echo "<select name='hhFrm' >";
	for($i=0;$i<=23;$i++){
		if($i == $MyDay)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	
	echo "</select>";
        
        
        //ends here
		//echo "<input type=text name=ssFrm value='$ssFrm' size=2 maxlength=2>";
		echo "<select name='ssFrm' >";
	for($i=0;$i<=59;$i++){
		if($i == $MyDay)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	
	echo "</select>";
		//ends here
	echo "</td>";
	echo "<td>";
		echo "TO";
	echo "</td>";
	echo "<td>";
		//echo "<input type=text name=hhTo value='$hhTo' size=2 maxlength=2><b>:</b>";
		echo "<select name='hhTo' >";
	for($i=0;$i<=23;$i++){
		if($i == $MyDay)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";

		//ends here
		//echo "<input type=text name=ssTo value='$ssTo' size=2 maxlength=2>";
		echo "<select name='ssTo' >";
	for($i=0;$i<=59;$i++)
	{
		if($i == $MyDay)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";

		//end here
	echo "</td>";
echo "</tr>";

echo "</table>";
echo "<Br>";
echo "<input type=submit name=butSubmit value='Show Log' class='bgbutton' onclick='return validation()'>";	
echo "</form>";
echo "</center>";
if(isset($butSubmit))
{       
 
        if($hhTo >= 1 && $hhTo < 12)
	{
	   $hhTo = $hhTo + 12;
	  
	} 

	$tempdate=explode('/',$date3);
	$date3 = $tempdate[2]."-".$tempdate[1]."-".$tempdate[0];
	$date4 = date("Y", strtotime($date3));
	$date5 = date("m", strtotime($date3));
	$date6 = date("d", strtotime($date3));
	/*
 	$qry="select username,address,DATE_FORMAT(accessdate,'%d-%m-%Y %H:%i:%S'),urladdress,linkname from log where time_to_sec(accessdate)>=time_to_sec('$hhFrm:$ssFrm:00') and ";
	$qry.="time_to_sec(accessdate)<=time_to_sec('$hhTo:$ssTo:00') and year(accessdate)=$logYear and month(accessdate)=$logMonth and dayofmonth(accessdate)=$logDay order by username";
	*/
	$qry="select username,address,DATE_FORMAT(accessdate,'%d-%m-%Y %H:%i:%S'),urladdress,linkname from log where time_to_sec(accessdate)>=time_to_sec('$hhFrm:$ssFrm:00') and ";
	$qry.="time_to_sec(accessdate)<=time_to_sec('$hhTo:$ssTo:00') and year(accessdate)=$date4 and month(accessdate)=$date5 and dayofmonth(accessdate)=$date6 order by username";
	
	//echo $qry; 
	$rs = execute($qry);
	if($rs)
	{
		$row=rowcount($rs);

		echo "<table align='center' class='forumline' width='90%' border='1'>";
		echo "<tr><td colspan='5' align='center' class='head'>No. of Links Accessed :-$row</td></tr>";
		echo "<tr>";
			echo "<td class='rowpic' align='center'>User Name</td>";
			echo "<td class='rowpic' align='center'>IP Address</td>";
			echo "<td class='rowpic' align='center'>Date & Time</td>";
			echo "<td class='rowpic' align='center'>Accessed Link</td>";
			echo "</tr>";
			$i=0;
		while($row=fetcharray($rs))
		{
			if($i%2)
			echo "<tr > ";
			else
			echo "<tr class='clsname'> ";
			$i++;
				echo "<td >&nbsp;&nbsp;&nbsp;&nbsp;$row[0]</td>";
				echo "<td align='center'>&nbsp;&nbsp;$row[1]</td>";
				echo "<td align='center'>&nbsp;&nbsp;$row[2]</td>";
				echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$row[4]</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
?>
</layer>
</body>
</html>

