<?php

session_start();

include("../db.php");

$academic_year=$_SESSION['AcademicYear'];



$type = $_POST['type'];

$routename = $_POST['routename'];

$courseyr = $_POST['courseyr'];

$Coradmit = $_POST['Coradmit'];



$pointname = $_POST['pointname'];

$wdt = $_POST['wdt'];

$wmn = $_POST['wmn'];

$wyr = $_POST['wyr'];



$mid = $_POST['mid'];



$s1 = $_POST['s1'];

$searchField=$_POST['searchField'];

?>
<HTML>

<HEAD>

<script language='javascript'>

function valbutton(thisform) 

{

	

	document.frm.action="updatepangmaster.php";

	document.frm.submit();

}

</script>

</HEAD>

<BODY>

<form method="POST" name='frm' >

<input type="hidden" name="type" value="<?=$type?>">

<input type="hidden" name="routename" value="<?=$routename?>">

<input type='hidden' name='Coradmit' value='<?=$Coradmit?>'>

<input type='hidden' name='courseyr' value='<?=$courseyr?>'>

<input type='hidden' name='searchField' value='<?=$searchField?>'>



<?php

//echo $s1;

//echo $type;

if($type==1)

{

	//$type = 'Student';

	$hdname="Apply Students to Route";

	$stid='Student ID';

	$stname='Student Name';

	

	$sqlstr = "select id,student_id,first_name,last_name,course_admitted,academic_year,course_yearsem from student_m";

	$sqlstr.=" where id is not null and archive='N' and academic_year='$academic_year'"; 

	if($Coradmit != 0)

	{

		$sqlstr.=" and course_admitted='$Coradmit'"; 

	}

	if($courseyr != 0)

	{

		$sqlstr.=" and course_yearsem='$courseyr'";

	}

	if($searchField)

	{

		$sqlstr.=" and ( first_name like '$searchField%' or last_name like '$searchField%' )";

		

	}

	 $sqlstr.=" and id not in (select pasng_id from trans_pasng_route_master where p_type=1 and sts=1 and accyear='$academic_year') order by first_name   ";

	$rs = execute($sqlstr);

	$num = rowcount($rs);

	if($num == 0)

	{

		die("<center>Match Not Found</center>");

	}

}

else

{

	//echo "inside";

	$hdname="Apply Staff to Route";

	$stid='Staff ID';

	$stname='Staff Name';

	$sqlstr = "select id,slno,f_name,s_name from staff_det ";

	$sqlstr.=" where id is not null and id not in (select pasng_id from trans_pasng_route_master  where p_type=2 and sts=1 and accyear='$academic_year') order by f_name"; 

	$rs = execute($sqlstr);

	$num = rowcount($rs);

	if($num == 0)

	{

		die("<center>Match Not Found</center>");

	}

}

?>

<Table class='forumline' align='center' width='80%' border="1"> 

<tr><td colspan='5' class='head' align='center'><?=$hdname?></td></tr>

<tr>

	<td align='center' Class="rowpic" width='5%'>Select</td>

	<td align='center' Class="rowpic"><?=$stid?></td>

	<td align='center' Class="rowpic"><?=$stname?></td>

	<td align='center' Class="rowpic">PickUp Point</td>

	<td align='center' Class="rowpic" nowrap>With Effect From</td>

</tr>

<?php

$dd=date("d");

$mm=date("m");

$yy=date("Y");

$yy1=date("Y")-1;

$yy2=date("Y")+1;

	for($i=0;$i<$num;$i++)

	{

		if($i%2)

		echo "<tr> ";

		else

		echo "<tr class='clsname'> ";

		

		$r = fetcharray($rs);

		?>

		<td align='center'><input type='checkbox' name='mid[]' id='mid' value='<?=$r[id]?>'></td>

		<?php

		if($type==1)

		{

			?>

			<TD>&nbsp;&nbsp;&nbsp;&nbsp;<?=$r["student_id"]?></TD>

            <TD>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $r[first_name]." ".$r[last_name] ?></TD>

			<?php

		}

		else

		{

			?>

			<TD>&nbsp;&nbsp;<?=$r["slno"]?></TD>

            <TD>&nbsp;&nbsp;<?php echo $r[f_name] . $r[s_name] ?></TD>

			<?php

		}

		?>

		<td align='center'>

		<?php  	

		$qry6="select b.* from trans_point_details a,trans_point_master b where a.route_id='$routename' and a.point_id=b.id";

		$rs5 = execute($qry6);

		echo "<select name='pointname$r[id]'>";	        

		echo "<option value=''>Select Pickup Point</option>";

		while($row3=fetcharray($rs5))

		{

			if($pointname==$row3[id])

			{

				echo "<option value='$row3[id]' selected>$row3[point_name]</option>";

			}

			else

			{

				echo "<option value='$row3[id]'>$row3[point_name]</option>";

			}

		}

		echo "</select></td>";

		echo "<td align='center' nowrap>";

		echo "<select name='wdt$r[id]'>";

		for($j=1;$j<=31;$j++)

		{

			if($j<10)

				$j="0".$j;

			if($j==$dd)

				echo "<option value=$j selected>$j</option>";

			else

				echo "<option value=$j>$j</option>";

		}

		echo "</select>";

		echo "<select name='wmn$r[id]'>";

		for($j=1;$j<=12;$j++)

		{

			if($j<10)

				$j="0".$j;

			if($j==$mm)

				echo "<option value=$j selected>$j</option>";

			else

				echo "<option value=$j>$j</option>";

		}

		echo "</select>";

		echo "<select name='wyr$r[id]'>";

		for($j=$yy1;$j<=$yy2;$j++)

		{

			if($j==$yy)

				echo "<option value=$j selected>$j</option>";

			else

				echo "<option value=$j>$j</option>";

		}

		echo "</select></td></tr>";

	}



?></table><br>

<center>

<input type='submit' name='SaveMe()' value='Apply Route' onClick="valbutton(frm);return false;"  class='bgbutton'> 

</center>

</form>

</BODY>

</HTML>