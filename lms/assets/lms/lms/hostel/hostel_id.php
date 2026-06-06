<?php
session_start();
require("../db.php");
$hname = $_POST['hname'];
$rname = $_POST['rname'];
$branch = $_POST['branch'];
$sem = $_POST['sem'];
$studfname = $_POST['studfname'];

switch($college)
{
	case -1:
		$sel2 = "";
		$sel1 = "SELECTED";
		$sel3 = "";
		break;
	default:
		$sel1 = "";
		$sel2 = "";
		$sel3 = "";
		break;
}
?>
<HTML>
<HEAD>
<TITLE>Student Search</TITLE>
<SCRIPT LANGUAGE="JavaScript">

function validate()

	{
		document.studret.action="hostel_id1.php";
		document.studret.submit();
	}

function reload()
{
	document.studret.submit();
	return true;
}
</SCRIPT>
</HEAD>
<BODY>
<?php
$rs = execute("SELECT * FROM student_m");
$num = rowcount($rs);
if($num > 0)
{
?>

<CENTER>
<FORM METHOD="POST" NAME="studret">
<INPUT TYPE="HIDDEN" NAME="action1" VALUE="hostel_id1.php">
<TABLE CLASS="forumline" WIDTH='90%'>
<TR><TD ALIGN="CENTER" COLSPAN="7" CLASS="head"><B>Search Student Detials</B></TD></TR>
<tr>
<td><?php echo $_SESSION['branchname'] ?>:</td>
		<td><select name="branch" >
			<option value="0">---------------Select---------------</option>
				<?php
					$sql="select course_id,coursename from course_m";
					$rs=execute($sql) or die(error_description());
					for($i=0;$i<rowcount($rs);$i++)
					{
					  $r=fetcharray($rs);

						if($branch==$r[course_id])
						{
							?>
							<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
							<?php
						}
						else
						{
							?>
							<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
							<?php
						}
					}
				?>
			</select>
			</td>	

	<td><?php echo $_SESSION['semname'] ?>:</td>
		<td><select name="sem">
			<option value='0'>------Select------</option>
			<?php
				$rs=execute("SELECT year_name,year_id FROM course_year");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
					}
				}
			?>
			</select>

		</td>

	</tr>

<TR><td>Student First Name:</td>
		<td colspan="3"><input type='text' name='studfname' value=""></td>
	</TR>
<TR>
     <TD>Select Hostel :</TD>
     <TD colspan="3"><SELECT NAME="hname" SIZE="1">
	 <OPTION VALUE="0"> Select a Hostel </OPTION>
	  <?php
		  $sql = "SELECT * FROM hostel_m";
	      $rs=execute($sql) or die("QUERY $sql " . error_description());
		  $row=rowcount($rs);
		  for($i=0;$i<$row;$i++)
			{
	         $r=fetcharray($rs,$i);
             if($r[id]==$hname)
		      {
	           echo("<OPTION VALUE=$r[id] selected>$r[hostel_name]</OPTION>");
	          }
	        else
	          {
		       echo("<OPTION VALUE=$r[id]>$r[hostel_name]</OPTION>");
		      }
		   }
     ?>
	</SELECT>
	</TD></TR>

<?php

	$sql2="select id,room_no from h_room_m";
	$rs2=execute($sql2);
	$row2=rowcount($rs2);
?>
<tr><td>Select Room :</td>
<td colspan="3"><select name="rname"  onchange="return reload()">
<option value="0"> Select a Room </option>
<?php
    for($i=0;$i<$row2;$i++)
	   {
		   $r2=fetcharray($rs2,$i);
		   if($r2[id]==$rname)
			{
			   echo("<OPTION VALUE=$r2[id] selected>$r2[room_no]</OPTION>");
			   $mnm1=$r2[room_no];
			}
		  else
			{
			  echo("<OPTION VALUE=$r2[id]>$r2[room_no]</OPTION>");
			}
	   }
?>
</select>
</td>
</tr>


	<TR><input type='hidden' name=mnm1 value=<?=$mnm1?>></TR>
	<TR>
    </TBODY>
</TABLE>
<br>
	 <center><input TYPE="BUTTON" NAME="sreps" CLASS="bgbutton" VALUE="Search" onClick="validate()"></center>

</FORM>
</CENTER>
</div>
	<table align=center border=0>
	
	</form>
	<?php
}
else
{
	?>
	<td>No studentid Record</td>
	<?php
}
?>
</BODY>
</HTML>