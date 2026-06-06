<?php
session_start();
require("../db.php");
?>
<html>
<head>
<script language="javascript">
function reload()
{
	document.forms[0].submit();
}
</script>
</head>
<body >
<form name=frm>
<?php
if(isset($add))
{
	//echo "<br>Course=>".$course;
	//echo "<br>Section=>".$section;
	//echo "<br>Intake=>".$intake;
	if($course=='-1' || empty($intake))
	{
		echo "<font color=red><b>Please Fill Blank Fields</b></font>";
	}
	else
	{
		
		$sql2="select * from intake where course_id='$course' and course_year_id='$section'";
//		echo "<br>". $sql2;
		$sql6=execute($sql2);
		if(rowcount($sql6)==0)
		{
			//echo ("insert into intake (intake,course_id,course_year_id,status) values ('$intake','$course','$section','1')") ;
			$sql4=execute("insert into intake (intake,course_id,course_year_id,status) values ('$intake','$course','$section','1')") or die(mysql_error());
			
			if($sql4)
			{
				echo "<font color=red><b> RECORD ENTERED SUCCESFULLY</b> </font>";
			}
		}else
		{
			echo "<font color=red><b>Already Entered </b> </font>";
		}
	}
}

if(isset($mod))
{
	//echo "<br>Course=>".$course;
	//echo "<br>Section=>".$section;
	//echo "<br>Intake=>".$intake;
	while(list(,$value)=each($mid))
	{
		$cc='course'.$value;
		$cour=$$cc;
		$sse='sect'.$value;
		$section=$$sse;
		$inta='intake'.$value;
		$intake=$$inta;
		$sql2="select * from intake where course_id='$cour' and course_year_id='$section'";
		//echo "<br>". $sql2;
		$sql6=execute($sql2);
		if(rowcount($sql6)>0)
		{
			//echo ("insert into intake (intake,course_id,course_year_id,status) values ('$intake','$course','$section','1')") ;
			$sql4=execute("update intake set intake='$intake' where course_id='$cour' and course_year_id='$section' and id=$value") or die(mysql_error());
			
		}else
		{
			echo "<font color=red><b>Details Not Entered </b> </font>";
		}
		
	}
	if($sql4)
			{
				echo "<font color=red><b>UPDATED SUCCESFULLY</b> </font>";
			}
}
if($actn=="")
{
	echo "<Table class='forumline' align=center width='40%'>";
	echo "<tr><td Class='head' align=center colspan=2><font size='2'>Manage Section & Intake Details</font></td></tr>";
	echo "<tr><td align='center'>&nbsp;&nbsp;Action&nbsp;&nbsp;</td>";
	echo "<td align='center'><select name='actn' onchange='reload()'>";
	echo "<option value=''>-- Select --</option>";
	echo "<option value=1>ADD</option>";
	echo "<option value=2>MODIFY</option>";
	echo "</select></td></tr>";
	echo "</table>";
}
elseif($actn==1)
{
	echo "<input type='hidden' name='actn' value='$actn'";
	echo "<Table class='forumline' align=center width='40%'><tr><td Class='head' align=center colspan=2><font size='2'>Apply Section & Intake Details</font></td></tr>";
	echo "<tr>";
	echo "<td align='center'><font color='#0A2756'><b>Class</b></font></td>";
	echo "<td >";
	echo "<select name=course>";
		echo "<option value=''>Select Class</option>";
		$rs = execute("SELECT year_id,year_name FROM course_year where status=1 order by head_id,year_id");
		$num = rowcount($rs);
for($i=0;$i<$num;$i++)
{
	$r = fetcharray($rs,$i);
	if($course==$r[0])
		{
		?>
			   <option value="<?php echo $r[0]?>" selected><?php echo $r[1]?></option>
		<?php
		}
		else
		{
		?>
		   <option value="<?php echo $r[0]?>"><?php echo $r[1]?></option>
		<?php
		}


}
	echo "</select></td>";
	echo "</tr>";
	?>

<?php
echo "<tr>";
	echo "<td align='center'><font color='#0A2756'><b>Section</b></font></td>";
	echo "<td>";
	echo "<select name=section>";
		echo "<option value=''>Select Section</option>";
		$qry="SELECT * FROM class_section order by id ";
		$rs = execute($qry);
		if($rs)
		{
			if(rowcount($rs)>0)
			{
				while($row=fetcharray($rs))
				{
					if($section==$row[id])
					{
						echo "<option value='$row[id]' selected>$row[section_name]</option>";
					}
					else
					{
						echo "<option value='$row[id]'>$row[section_name]</option>";
					}
				}

			}

		}
	echo "</select></td>";
	echo "</tr>";
?>

<tr>
<td align='center'><font color="#0A2756"><b>Enter Intake</b></font></td>
<td class='row' bgcolor='#FEE56B'><input type='text' name='intake' size='5'>
</td>
</tr>
	<br>
<tr><td colspan='2' align=center>
<input  type='submit' name='add' class='bgbutton' value='Add' ></td></tr>
<?php
echo "</table>";
}
else
{
	?>
	<input type='hidden' name='actn' value='<?=$actn?>'>
	<table class='forumline' align=center width="70%">
	<tr><td Class="head" colspan=4 align='center'><font size="2">Modify Section & Intake Details</font></td></tr>
	<tr><td class="row3" align='center'>Select</td><td class="row3" align='center'>Class</td>
	<td class="row3" align='center'>Section</td><td class="row3" align='center'>Maximun Intake</td></tr>
	<?php
	$sds=execute("select * from intake order by course_id,course_year_id");
	//echo "<br>".("select *from intake");
	if(rowcount($sds)>0)
	{
	for($ji=0;$ji<rowcount($sds);$ji++)
	{
		$ras = fetcharray($sds,$ji);
		?>
		<tr><td class="CBody" align='center'>
		<input type="checkbox" name="mid[]" Value="<?php echo $ras["id"]?>"></td>
		<?php
		$str1 = "SELECT * FROM course_year where year_id='$ras[course_id]'";
		//echo "<br>".$str1;
		$rs1 = execute($str1);
		$r2 = fetcharray($rs1);
		?>
		<td class="CBody" align='center'><font color="#0A2756"><b><input type=hidden name='course<?php echo $ras[id]?>' value="<?php echo $ras[course_id]?>"><?php echo $r2[year_name]?></b></font></td>
	   <?php
		$str2 = "SELECT * FROM class_section where id='$ras[course_year_id]' ";
		$rs2 = execute($str2);
		$r3 = fetcharray($rs2);
		?>
		<td class="CBody" align='center'><font color="#0A2756"><b><input type=hidden name='sect<?php echo $ras[id]?>'  value="<?php echo $ras[course_year_id]?>"><?php echo $r3[section_name]?></b></font></td>
	   <td class="CBody" align='center'>
	  <input type="text" size=5 name="intake<?php echo $ras[id]?>" value="<?php echo $ras[intake]?>">
	   </tr>
		<?php
	}
	}
	?>
	<br>
	<tr><td colspan='4' align=center>
	<input  type='submit' name='mod' class='bgbutton' value='Modify' ></td></tr>
	</table>  
	<?php
}
echo "</form>";
echo "</body>";
echo "<html>";
