<?php
session_start();
include("../db.php");
include("../urlaccess.php");
if($user=='')
{
	header("Location:login.php");
}
else
{
	$p_th=$_SERVER['SCRIPT_NAME'];
	$qry=execute("select * from usermenu where username='$user' and access='Yes' and linkpath='$p_th'");
	if(rowcount($qry)==0)
	{
		header("Location:login.php");
	}
}


?>
<HTML>
<HEAD>
<SCRIPT  LANGUAGE="JavaScript">
<!--
var KEY_LEFT  = 268762961;
var KEY_RIGHT = 268762963;
var KEY_SPC = 32;
function frm_load()
{
	document.AddSubject.action="Sessional_Master.php";
	document.AddSubject.submit();
}
function adds_onclick()
{
	document.AddSubject.action="add_sessional.php?Type=Add";
	document.AddSubject.submit();
	return true;
}
function Modify_onclick()
{
	document.AddSubject.action="add_sessional.php?Type=Mod";
	document.AddSubject.submit();
	return true;
}
function getSubject_onclick()
{
	document.AddSubject.action='Sessional_Master.php';
	document.AddSubject.submit();
}
function Delete_onclick()
{
	document.AddSubject.action="add_sessional.php?Type=Del";
	document.AddSubject.submit();
	return true;
}
function checkInt(e)
{
	var charCode = e.which;
	//status = charCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)  && charCode != KEY_LEFT && charCode != KEY_RIGHT )
	{
		status = "Please make sure entries are numbers only.!!";
		return false
	}
	status = "";
	return true
}
//-->
</SCRIPT>
</HEAD>
<BODY>
<form name="AddSubject" action ="add_sessional.php" method="post">
<Table class='forumline' align=center>
<tr><td colspan=4 align='center' class='head'>Add Sessional Details</td></tr>
<tr><td>Select Course Head</td><td> <Select name="ctype" onChange='frm_load()'>
<option value=0 >-- Select Course Head--</option>
<?php
$sql1 = "SELECT * FROM coursehead";
$rs1 = execute($sql1) or die(error_description());
$num = rowcount($rs1);
for($i=0;$i<$num;$i++)
{
	$r = fetcharray($rs1,$i);
	$sel="";
	if($ctype == $r["id"])
	{
		$sel="selected";
		$cname=$r[cname];
	}
	echo "<Option value='$r[id]' $sel >$r[cname]</Option>";
}
?>
</Select></TD></tr>
<?
if($ctype!='')
{
	?>
	<tr><td><Select name="Course" onChange='frm_load()'>
	<?
	if(strtoupper($cname)=='UG')
	{
		?>
		<option value=0 >-- Select For First Year--</option>
		<?php
	}
	else
	{
		?>
		<option value=0 >-- Select Course--</option>
		<?php
	}
	$sql1 = "SELECT course_id,coursename FROM course_m where status=1 and head_id='$ctype' order by coursename";
	$rs1 = execute($sql1) or die(error_description());
	$num = rowcount($rs1);
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs1,$i);
		$sel="";
		if($Course == $r["course_id"])
		{
			$sel="selected";
		}
		echo "<Option value='$r[course_id]' $sel >$r[coursename]</Option>";
	}
	?>
	</Select></TD>
	<TD><Select name="CYear"><option value="-1">-- Select a Year --</option>
	<?php
	if(strtoupper($cname)=='UG')
	{
		if($Course!=0)
		{
		$sql1 = "SELECT a.* FROM course_year a where a.status=1 and a.year_id > 2 and head_id='$ctype'";
		}
		else
		{
		$sql1 = "SELECT * FROM course_year where status=1 and year_id < 3 and head_id='$ctype'";
		}
	}
	else
	{
		$sql1 = "SELECT * FROM course_year where status=1 and head_id=$ctype";
	}
	$rs1 = execute($sql1) or die(error_description());
	$num = rowcount($rs1);
	for($i=0;$i<$num;$i++)
	{
		$r=fetcharray($rs1,$i);
		$sel="";
		if( $CYear== $r[year_id])
		{
			$sel="selected";
		}
		echo "<Option value='$r[year_id]' $sel >$r[year_name]</Option>";
	}
	?>
	</Select></td></tr>
	<tr>
	<td colspan=2 align=center><Input type="Button" id="getSubject" value="Get Sessionals" class='bgbutton' LANGUAGE=javascript onclick="return getSubject_onclick()"></td></tr>
	</table>
	<br>
	<Table class='forumline' align='center'>
	<?php
	$academic_year=date("Y");
	if($CYear != "")
	{
		if($Course == 0)
		{
		$sql= "SELECT * from sessional_master where Course_Year_ID=$CYear and Academic_Year=$academic_year order by Sl_No ASC";

		}
		else
		{
		$sql= "SELECT * from sessional_master where Course_ID=$Course and Course_Year_ID=$CYear and Academic_Year=$academic_year order by Sl_No ASC";
		}
		//echo "sql=$sql";
		$sub = execute($sql) or die(error_description());
		$num = rowcount($sub);
		if($num  > 0 )
		{
			echo "<TR><TD Class='rowpic'>Sel</TD><TD Class='rowpic'>Sessional Name </TD><TD Class='rowpic'>From Date </TD><TD Class='rowpic'>To Date</TD></TR>";
			for($i1=0;$i1<$num;$i1++)
			{
				$r = fetcharray($sub,$i1);
				echo "<TR>";
				echo "<TD class='row3'><Input Type='checkbox' name='check[]' value='$r[0]'>";
				echo "</TD>";
				echo "<td >";
				echo "<input type='hidden' name='sessional_name$r[0]' value='$r[1]'>";
				echo "$r[Sessional_Name]";
				echo "<td class='row3'>";
				$from_date=explode("-",$r[From_Date]);
				echo "<select name='from_day$r[0]'>";
				for($j=1;$j<=31;$j++)
				{
					if($j < 10)
					{
						$j="0".$j;
					}
					$sel="";
					if($j==$from_date[2])
					{
						$sel="selected";
					}
					echo "<option  value='$j' $sel >$j</option>";

				}
				echo "</select>";
				echo "<select name='from_mon$r[0]'>";
				for($j=1;$j<=12;$j++)
				{
					if($j < 10)
					{
						$j="0".$j;
					}
					$sel="";
					if($j==$from_date[1])
					{
						$sel="selected";
					}
					echo "<option  value='$j' $sel >$j</option>";
				}
				echo "</select>";

				echo "<select name='from_year$r[0]'>";
				$max_date=getdate();
				$dd=$max_date[year]-1;
				for($j=$dd;$j<=$max_date[year]+2;$j++)
				{
					$sel="";
					if($j==$from_date[0])
					{
						$sel="selected";
					}
					echo "<option  value='$j' $sel >$j</option>";
				}
				echo "</select>";
				echo "</td>";

				echo "<td >";
				$to_date=explode("-",$r[To_Date]);
				echo "<select name='to_day$r[0]'>";
				for($j=1;$j<=31;$j++)
				{
					if($j < 10)
					{
						$j="0".$j;
					}
					$sel="";
					if($j==$to_date[2])
					{
						$sel="selected";
					}
					echo "<option  value='$j' $sel >$j</option>";
				}
				echo "</select>";

				echo "<select name='to_mon$r[0]'>";
				for($j=1;$j<=12;$j++)
				{
					if($j < 10)
					{
						$j="0".$j;
					}
					$sel="";
					if($j==$to_date[1])
					{
						$sel="selected";
					}
					echo "<option  value='$j' $sel >$j</option>";
				}
				echo "</select>";

				echo "<select name='to_year$r[0]'>";
				$max_date=getdate();
				$dd=$max_date[year]-1;
				for($j=$dd;$j<=$max_date[year]+2;$j++)
				{
					$sel="";
					if($j==$to_date[0])
					{
						$sel="selected";
					}
					echo "<option  value='$j' $sel >$j</option>";
				}
				echo "</select>";
				echo "</td>";
				echo"</tr>";

			}
			?>
			<tr><td colspan=4 align='center'><Input type="submit" Name="Modify" value="Modify" LANGUAGE=javascript onclick="return Modify_onclick()" class='bgbutton'>
			<Input type="submit" Name="Delete" value="Delete" LANGUAGE=javascript onclick="return Delete_onclick()" class='bgbutton'></td></tr>
			<?php
		}
	 }
	 else
	 {
		//echo "<b>No Data found</b>";
	 }

	echo "</table><br>";
	echo "<table align='center' class='forumline'>";
	echo "<TR><TD Class='rowpic'>Sessional Name </TD><TD Class='rowpic'>From Date </TD><TD Class='rowpic'>To Date</TD></TR>";
	echo "<TR>";
	echo "<td >";
	echo "<select name='sessional_name'>";

	echo "<option value='SL1' >First</option>";
	echo "<option value='SL2' >Second</option>";
	echo "<option value='SL3' >Third</option>";
	echo "<option value='SL4' >Fourth</option>";
	echo "<option value='SL5' >Fifth</option>";
	echo "<option value='SL6' >Sixth</option>";
	echo "<option value='SL7' >Seventh</option>";
	echo "<option value='SL8' >Eighth</option>";
	echo "</select>";
	echo "<td >";
	$from_date=explode('-',date('Y-m-d'));

	echo "<select name='from_day'>";
	for($j=1;$j<=31;$j++)
	{
		if($j < 10)
		{
			$j="0".$j;
		}
		$sel="";
		if($j==$from_date[2])
		{
			$sel="selected";
		}
		echo "<option  value='$j' $sel >$j</option>";
	}
	echo "</select>";

	echo "<select name='from_mon'>";
	for($j=1;$j<=12;$j++)
	{
		if($j < 10)
		{
			$j="0".$j;
		}
		$sel="";
		if($j==$from_date[1])
		{
			$sel="selected";
		}
		echo "<option  value='$j' $sel >$j</option>";
	}
	echo "</select>";

	echo "<select name='from_year'>";
	$max_date=getdate();
	$dd=$max_date[year]-1;
				
	for($j=$dd;$j<=$max_date[year]+2;$j++)
	{
		$sel="";
		if($j==$from_date[0])
		{
			$sel="selected";
		}
		echo "<option  value='$j' $sel >$j</option>";
	}
	echo "</select>";
	echo "</td>";

	echo "<td >";
	$to_date=explode("-",date('Y-m-d'));
	echo "<select name='to_day'>";
	for($j=1;$j<=31;$j++)
	{
		if($j < 10)
		{
			$j="0".$j;
		}
		$sel="";
		if($j==$to_date[2])
		{
			$sel="selected";
		}
		echo "<option  value='$j' $sel >$j</option>";
	}
	echo "</select>";

	echo "<select name='to_mon'>";
	for($j=1;$j<=12;$j++)
	{
		if($j < 10)
		{
			$j="0".$j;
		}
		$sel="";
		if($j==$to_date[1])
		{
			$sel="selected";
		}
		echo "<option  value='$j' $sel >$j</option>";
	}
	echo "</select>";

	echo "<select name='to_year'>";
	$max_date=getdate();
	$dd=$max_date[year]-1;
	for($j=$dd;$j<=$max_date[year]+2;$j++)
	{
		$sel="";
		if($j==$to_date[0])
		{
			$sel="selected";
		}
		echo "<option  value='$j' $sel >$j</option>";
	}
	echo "</select>";
	echo "</td>";
	echo"</tr>";
	?>
	<TR><TD align='center' colspan=4>
	<input type="submit" id="adds" value="Add Sessional" LANGUAGE=javascript onclick="return adds_onclick()" class='bgbutton'>
	</TD></TR>
	<?
}
?>
</Table>
</form>
</BODY>
</HTML>
