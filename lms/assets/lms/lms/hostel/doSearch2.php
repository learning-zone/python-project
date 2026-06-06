<?php
session_start();

require("../db.php");
$hname = $_POST['hname'];
$rname = $_POST['rname'];
$branch = $_POST['branch'];
$sem = $_POST['sem'];
$studfname = $_POST['studfname'];
$_action1 = $_POST['action1'];
$sreps = $_POST['sreps'];
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
	flag = 0
	if(document.studret.hname.selectedIndex != 0 )
	{
		flag =1 ;
	}
	else
	{
		alert("Please Enter the Hostel Name");
	}
	if(flag == 1)
	{
		document.studret.action="doSearch2.php";
		document.studret.submit();
	}
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
<INPUT TYPE="HIDDEN" NAME="action1" VALUE="doSearch2.php">
<TABLE ALIGN="CENTER"  CLASS="forumline" WIDTH='90%'>
<tr><td Class="Head" colspan='7' align='center'>View Students</TD></TR>
<tr height='30'>

<td width="18%"><?php echo $_SESSION['branchname'] ?> </td>
		<td width="39%"><select name="branch" >
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
            
            

	<td width="8%"><?php echo $_SESSION['semname'] ?></td>
		<td width="35%"><select name="sem">
			<option value='0'>------------Select------------</option>
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
    <TR>
		<td>Student Name :</td>
		<td colspan="3"><input type='text' name='studfname' value=""></td>
        
	</TR>
	
<TR>
     <TD>Select Hostel</TD>
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
// echo   $hid = "select id from hostel_m where hostel_name ='hname'";
	$sql2="select id,room_no from h_room_m";
	$rs2=execute($sql2);
	$row2=rowcount($rs2);
?>
<tr>
<td>Select Room</td>
<td colspan="3"><select name="rname"  onchange="return reload()">
<option value="0">------Select------</option>
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

<TR><input type=hidden name=mnm1 value=<?=$mnm1?>></TR>
	


    </TBODY>
</TABLE>
<br>
	 <div><input TYPE="BUTTON" NAME="sreps" CLASS="bgbutton" VALUE="Search" onClick="validate()"></div>
	

</FORM>
</CENTER>
</div>
	
	

	<?php
}
else
{
	?>
	<td>No studentid Record</td>
	<?php
}
?>

<?php
if(isset($_POST['sreps']) or $_REQUEST)
{
	if(hname == 0)
	{
		//echo "inside";
		//die();
	}
	$sql1.="select a.id,a.student_id,a.first_name,a.last_name,a.course_admitted,a.course_yearsem,b.s_id,b.h_id,b.room_no,b.bid from student_m a,h_stud_m b where a.id=b.s_id AND b.archive='N'";
	//echo $sql;
	if($branch!=0)
	{
	$sql1.=" and a.course_admitted=$branch";
	}
	if($sem!=0)
	{
	$sql1.=" and a.course_yearsem=$sem";
	}
	if($studfname!='')
	{
	 $sql1.=" and a.first_name='$studfname'";
	}
    if($hname!=0)
	{
	 $sql1.=" and b.h_id='$hname'";
	}
	if($rname!=0)
	{
	 $sql1.=" and b.room_no='$rname'";
	}
//	echo "$sql";
		$rs=execute($sql1) or die(mysql_error());
		$row=rowcount($rs);
    if($row > 0)
    {
?>
         <form name="frm" method="post">
         <input type="hidden" name="branch" value="<?php echo $branch ?>">
         <input type="hidden" name="sem" value="<?php echo $sem ?>">
         <input type="hidden" name="studfname" value="<?php echo $studfname ?>">
         <input type="hidden" name="hname" value="<?php echo $hname?>">
         <input type="hidden" name="rname" value="<?php echo $rname?>">
	
		 
         <TABLE WIDTH='90%' CELLPADDING='0' CELLSPACING='0' CLASS='forumline' align="center">
         <TR><TD ALIGN='CENTER' CLASS='head' COLSPAN='8'>Student Details</TD></TR>
         <TR height='25'>
         <TD ALIGN='CENTER' CLASS='row2'>Count</TD>
         <TD ALIGN='CENTER' CLASS='row2'>Name</TD>
         <TD ALIGN='CENTER' CLASS='row2'>Course</TD>
         <TD ALIGN='CENTER' CLASS='row2'>Sem</TD>
         <!-- <TD ALIGN='CENTER' CLASS='row2'><B>Hostel</B></TD>
         <TD ALIGN='CENTER' CLASS='row2'><B>Block</B></TD>
         <TD ALIGN='CENTER' CLASS='row2'><B>Room No.</B></TD> -->
		 <TD ALIGN='CENTER' CLASS='row2'>Action</TD>
         </TR>
		 <?php
			 $k = 1;
			 $i=0;
		     while ($row=fetcharray($rs))
	            {
				 $a=execute("select * from student_m where id=$row[id]");
                 $aa=fetcharray($a);
				 $b=execute("select course_id,coursename from course_m where course_id=$aa[course_admitted]");
				 $bb=fetcharray($b);
				 $c=execute("select year_id,year_name from course_year where year_id=$aa[course_yearsem]");
				 $cc=fetcharray($c);
				  if($i%2)
               echo "        <tr class='clsname'> ";
               else
               echo "        <tr > ";
				 ?>
			
			<TD WIDTH='05%' ALIGN='CENTER'><?php echo $k?></TD>
		    <TD WIDTH='25%' ALIGN='CENTER'><?php echo $row[first_name]?>&nbsp;<?php echo $row[last_name]?></TD>
			<TD WIDTH='20%' ALIGN='CENTER'><?php echo $bb[coursename]?></TD>
			<TD WIDTH='15%' ALIGN='CENTER'><?php echo $cc[year_name]?></TD>
			
			<TD WIDTH='10%' ALIGN='CENTER'>
			<A HREF="view_hstud1.php?ID=<?php echo $row[id]?>">View/</A>
			<A HREF="test1.php?ID=<?php echo $row[id]?>">Modify</A></TD>
	        </TR>
		<?php
		$k++;
		$i++;
	}
	echo "</TBODY>";
	echo "</TABLE>";
	}
elseif($row == 0)
{
	echo "<TT>The Student record could not be found..</TT>";
	echo "<br>";
    echo "<a href='doSearch2.php'> <u>Back</u></a>";
}
else
{
	echo "<TT>Please Select Required field for Search..</TT>";
} 
}
?>	
</form>
</BODY>
</HTML>