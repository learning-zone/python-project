<?php

session_start();

require("../db1.php");

?>
<html>
<head>

<script language="JavaScript">

	function printReport()

	{

		prn.style.display="none";

		window.print();

	}

</script>

</head>

<body>

<form name='frm' method='post' action='bus_card1.php'>

<input type="hidden" name="FMon" value="<?=$FMon?>">

<input type="hidden" name="FYear" value="<?=$FYear?>">

<table border="1" width='15%' bordercolor='black' align="center" cellspacing='0' cellpadding='0'>

<?php

function MonthName($mon)

	{

		if($mon == 1) return("Jan");

		if($mon == 2) return("Feb");

		if($mon == 3) return("Mar");

		if($mon == 4) return("Apr");

		if($mon == 5) return("May");

		if($mon == 6) return("Jun");

		if($mon == 7) return("July");

		if($mon == 8) return("Aug");

		if($mon == 9) return("Sep");

		if($mon == 10) return("Oct");

		if($mon == 11) return("Nov");

		if($mon == 12) return("Dec");

	

	}

	$count=1;

while( list(,$Value) = each($mid))

	{

	$r1=fetcharray(execute("select * from student_m where id='$Value' "));

	$name = $r1[f_name] . " " .  $r1[last_name];

	$rt_var = execute("select route_name from trans_route_master where id='$routename'");

	$rt_name = fetchrow($rt_var);

	$r12=execute("select rec_no from trans_pasng_route_master where pasng_id='$Value'");

    $rec=fetchrow($r12);

	?>

		<td><table border="1" width='15%' bordercolor='black' align="center" cellspacing='2' cellpadding='2'>

		<tr>

		<td>

		<table border="0" width='10%' bordercolor='black' cellspacing='0' cellpadding='0' background="../images/bus_image.JPG">

		<tr>

		<td rowspan='6'  align='center' width='50%'><img src='../images/logo.jpg' width='73' height='70'> </td>

		</tr>

		<tr>

		<td align='center' colspan='2'>school name </td>

		</tr>

		<tr>

		<td align='center' colspan='2'>adress and pin

		<br>

          Tel-080 004276200

		  <br>E-mail :admin@gmail.com  </td>

		</tr>

		

		<td align='center' >Website : &nbsp;&nbsp;&nbsp;&nbsp;</td>

		</tr>

		<tr height='15'>

		<td colspan='2' align='center'><img src='../images/hr_line.GIF' width='310' height='5'></td>

		</tr>

		<tr>

		<td colspan='3' align='center'><img src='../images/buspass.GIF' width='125' height='30'></td>

		</tr>

		<tr>

		<td rowspan='2' align='center'>&nbsp;&nbsp;<img src='<?php echo $r1[img_source] ?>' width='75' height='90'>

		</tr>

		<tr>

		<td colspan='3'>

		<table border='0' align='center' width='100%' cellspacing='0' cellpadding='0'>

		<tr>

		<td width='30%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name</td>

		<td>:&nbsp;&nbsp;<?php echo $r1[first_name] ?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USN</td>

		<td>:&nbsp;&nbsp;<?php echo $r1[student_id] ?></td>

		</tr>

		<tr>

		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Receipt No</td>

		<td>:&nbsp;&nbsp;<?php echo $rec[0] ?></td>

		</tr>

		<tr>

		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Route no</td>

		 <td>:&nbsp;&nbsp;&nbsp;<?php echo $rt_name[0] ?></td>

		

		</tr>

		<tr>

		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Valid Till</td>

		<td>:&nbsp;<?php echo strtoupper(MonthName($FMon))?>&nbsp;/&nbsp;<?php echo $FYear  ?></td>

		</tr>

		</table>

		<tr>

		<td colspan='3'>

		<table border='0' align='center' width='100%'>

		<tr>

		<td align='right' colspan='2'><img src='../images/signature.JPG' width='130' height='25'></td>

		</tr>

		<tr>

		<td>Student Sign</td>

		<td align='right'>Director Sign</td></tr></table></table>

		</table></td>

 <?Php 



 if($count%2==0)

 echo "</tr>";

 $count++;

 }

 ?>

 </table><br>	

 <div id="prn" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="printReport()" style='font-weight: bold; background-color: #86BAF9; color: #000080; border-style: solid; border-width: 1'></div>

</form>

</body>

</html>