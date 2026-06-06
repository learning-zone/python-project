<?php

session_start();

include("../db.php");

?>

<HTML>

<HEAD>

<script language='javascript'>

function selectMe()

{

		i = document.frm.length;

		for(j=0;j<i;j++)

		{

			if(document.frm[j].Sel != "CheckBox")

			{

				flag = document.frm[j].checked;

				document.frm[j].checked = !flag;

			}

			if(document.frm[j].SelectAll == "CheckBox")

			{

				flag = document.frm[j].checked;

				document.frm[j].checked = !flag;



			}

		}

	}





function valbutton(thisform) 

{

	

	

		document.frm.action='bus_card1.php';

		document.frm.submit();

	}



</script>

</HEAD>

<BODY>

<form method="POST" name='frm' >

<input type="hidden" name="FMon" value="<?=$FMon?>">

<input type="hidden" name="FYear" value="<?=$FYear?>">



<?php

//--------------------------------------------------------------------------

	function GetCourseName($id){

		$sql = "SELECT course_abbr FROM course_m where course_id=$id";

		$rs = execute($sql);

		$num = rowcount($rs);

		if($num){

			$ar = fetcharray($rs);

			return($ar[0]);

		}else{

			return("Unknown Course $id");

		}

	}



	function GetCourseYear($id)

	{

		$sql = "SELECT year_name FROM course_year WHERE year_id=$id";

		$rs = execute($sql);

		$num = rowcount($rs);

		if($num)

		{

			$ar = fetcharray($rs);

			return($ar[0]);

		}

		else

		{

			return("Unknown Year $id");

		}

	}

//------------------------------------------------------------------

	$sqlstr = "select sm.id, sm.student_id, sm.usn, sm.first_name, sm.last_name, sm.course_admitted, sm.academic_year, sm.course_yearsem, prm.route_id from student_m sm ";

	$sqlstr.=" inner join trans_pasng_route_master prm on sm.id = prm.pasng_id and prm.route_id='$routename' and sm.id is not null "; 

	if($Coradmit != 0)

	{

		$sqlstr.=" and sm.course_admitted='$Coradmit'"; 

	}

	if($acayr != 0)

	{

		$sqlstr.=" and sm.academic_year='$acayr'"; 

	}

	if($courseyr != 0)

	{

		$sqlstr.=" and sm.course_yearsem='$courseyr'";

	}

	if($studFName != "")

	{

		$sqlstr.=" and sm.first_name Like '$studFName%'";

	}

	if($student_id!="")

	{

		$sqlstr.=" and sm.student_id='$student_id'";

	}

	if($aplno!="")

	{

		$sqlstr.=" and sm.student_id='$aplno'";

	}

 

    $rs = execute($sqlstr) or die(mysql_error());

	$num = rowcount($rs);

	if($num == 0)

	{

		die("<b>Match Not Found<b><br><hr>");

	}



?>

	<Table class='forumline' align=center width='100%'> 

	  <tr>

			<td Class="head" width='15%'><input type="checkbox" name="SelectAll" OnClick="selectMe()"></td>

			<td Class="head" width='15%' align="center">USN</td>

			<td Class="head" width='33%'>Student Name</td>

			<td Class="head" width='10%'>Branch</td>

			<td Class="head" width='10%'>Sem</td>

		

			

	</tr>

<?php

	for($i=0;$i<$num;$i++)

	{

		$r = fetcharray($rs);

		if($r[usn]!="")

		{

			$stud_id = $r[usn];

		}

		else

		{

			$stud_id = $r[student_id];

		}

		$aray=execute("select * from trans_pasng_route_master where pasng_id='$r[student_id]'");

		$raw=rowcount($aray);

		if(rowcount($aray)==0)

		{

			?>

			<tr>

				<td><input type=checkbox name=mid[] id='mid' value=<?=$r[id]?>></td>

				<TD><?=$r["student_id"]?></TD>

				<TD><?php echo $r[first_name] . $r[last_name] ?></TD>

				<TD><?php echo 	GetCourseName($r["course_admitted"]);?></td>

				<TD Class="StudBody"><?php echo GetCourseYear($r["course_yearsem"]); ?></td>

 </TR>

				<?php

		}

}

echo "</table>";

?>

<Input Type="Hidden" Name="collage_db" Value="<?=$collage_db?>">

<Input Type="Hidden" Name="staff_type" Value="<?=$stype?>">

<input type="hidden" name="routename" value="<?=$routename?>">

<input type="hidden" name="tripname" value="<?=$tripname?>">

<input type="hidden" name="FMon" value="<?=$FMon?>">

<input type="hidden" name="FYear" value="<?=$FYear?>">

<center>

<input type='submit' name='SaveMe()' value='Genrate Buss Pass' onClick="valbutton(frm);return false;" class='bgbutton'> 

</center>

</form>

</BODY>

</HTML>