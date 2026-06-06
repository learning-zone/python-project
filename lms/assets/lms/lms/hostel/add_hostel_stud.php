<html>
<head>
<script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>
<script language="javascript">

function reload()
{
document.form1.action="add_hostel_stud.php";
document.form1.submit();
}
</script>
<?php
session_start();
require("../db.php");
$studId = $_REQUEST['studId'];
$studFName = $_REQUEST['studFName'];
$c_name = $_REQUEST['c_name'];
$c_year = $_REQUEST['c_year'];

$row = $_POST['row'];

$hname = $_POST['hname'];
$bname = $_POST['bname'];
$rnumber = $_POST['rnumber'];
$bldgrp = $_POST['bldgrp'];
$padd = $_POST['padd'];
$pphone = $_POST['pphone'];
$lgname = $_POST['lgname'];
$lgrelation = $_POST['lgrelation'];
$lgadd = $_POST['lgadd'];
$lgphone = $_POST['lgphone'];

$adate = $_POST['adate'];
$bdate = $_POST['bdate'];

$empname = $_POST['empname'];
$empdept = $_POST['empdept'];
$college = $_POST['college'];

$st_id = $studId;
$st_id = $_POST['st_id'];
?>
</head>
<body>

<FORM METHOD="POST" ENCTYPE="multipart/form-data" ACTION="ins_stud.php" NAME="form1">
<?
$rs=execute("select * from student_m where id='$studId'") or die(mysql_error());
$row=fetcharray($rs);

$r=execute("select archive from h_stud_m where s_id='$row[id]'");
if(rowcount($r)>0)
{
$r1=fetcharray($r);
$ar=$r1[0];
//echo"<font>";
if($ar=='N')
{
	?>
<script language="JavaScript" type="text/javascript">
alert("This Student has been Already Admitted to the  Hostel");
</script>
<?php
echo "<center><a href=doSearch.php><font color = #000000><u>Back</u></font></a></center>";
		    	die();
//die("This Student has been Already Admitted to the  Hostel");
}
else
{
die("Student has been archived from the hostel , in order to make this student as active choose Modify Student Details option");
}
//echo"</font>";
}
?>
			<INPUT TYPE="HIDDEN" NAME="college" 	VALUE="<?=$college?>">
			<INPUT TYPE="HIDDEN" NAME="data_base" 	VALUE="<?=$data_base;?>">
			<INPUT TYPE="HIDDEN" NAME="st_id" 		VALUE="<?=$row[id]?>">
			<INPUT TYPE="HIDDEN" NAME="first_name" 	VALUE="<?=$row[first_name]?>">
			<INPUT TYPE="HIDDEN" NAME="last_name" 	VALUE="<?=$row[last_name]?>">
			<INPUT TYPE="HIDDEN" NAME="c_name" 		VALUE="<?=$c_name?>">
			<INPUT TYPE="HIDDEN" NAME="c_year" 		VALUE="<?=$c_year?>">
			<INPUT TYPE="HIDDEN" NAME="Student_id" 	VALUE="<?=$row[student_id]?>">
			<INPUT TYPE="HIDDEN" NAME="studFName" 	VALUE="<?=$studFName?>">
  <input type="HIDDEN" name="iFlag" 		value="<?=$iFlag?>">
  <input type="hidden" name="studId" value=<?=$studId?>>
  <TABLE ALIGN='center' CLASS="forumline" width='90%' CELLPADDING="0" CELLSPACING="0" >
 <Table width="90%" ALIGN="CENTER">
  <TR height='30'>
   <TD ALIGN="CENTER" CLASS="head" width="90%">Add New Student In Hostel
   </TD>
  </TR>
  </Table>
  
  <table class='forumline' align='center' width='90%'>
	<tr>
		<td width="25%">
			<table   align='left' width='100%'  height="100%"> 
			<tr>
				<td align="center">Student Photo</td></tr>
					<tr height="70">
						<td align='center'>
							<img src="<?php echo $row[img_source]?>" width='110' height='120'>
					    </td>
					</tr>
				</td>
			</tr>
			</table>
		 </td>
		 <td>
		 <table  cellspacing='4' cellpadding='0' >
    <tr height='20'>
		<td>Aplication No</td>
		<td><?php echo $row[student_id] ?></td>
	</tr>
  <TR height='20'>
   <TD>USN</TD>
   <TD><?=$row[usn]?></TD>
  </TR>
  <TR height='20'>
   <TD>Name</TD>
   <TD><?=$row["first_name"]." ".$row["last_name"]?></TD>
  </TR>
  <TR height='20'>
   <TD>Hostel</TD>
	<TD><select size="1" name="hname" onChange="reload()">
	  <option value="0" >Select Hostel</option>
	  <?php
		if($row[gender]=="F")
		   {
			 $hostel_type="G";
		   }
        if($row[gender]=="M")
		   {
			 $hostel_type="B";
		   }
		$sql1 = "SELECT * FROM hostel_m where hostel_type='$hostel_type'";
		$res1 = execute($sql1) or die("QUERY $sql1 " . error_description());
		   if (rowcount($res1) != 0)
				{
				  while ($rw1 = fetcharray($res1))
					{
					  if ($hname == $rw1["id"])
						  echo "<OPTION VALUE='$rw1[id]' SELECTED>$rw1[hostel_name]</OPTION>";
					  else
						  echo "<OPTION VALUE='$rw1[id]'>$rw1[hostel_name]</OPTION>";
					}
							
				}
		?>
	  </select></TD></TR>
								<TR height='20'><TD>Block</TD>
				                    <TD><select size="1" name="bname" onChange="reload()">
				                      <option value="0">Select Block</option>
				                      <?php
						
							$sql2 = "SELECT * FROM h_block WHERE hostel_no='$hname' AND status=1";
							echo "$sql2";
							$res2 = execute($sql2) or die("QUERY $sql2 " . error_description());
							if (rowcount($res2) != 0)
							{
								while ($rw2 = fetcharray($res2))
								{
									if ($bname == $rw2[id])
										echo "<OPTION VALUE='$rw2[id]' SELECTED>$rw2[blockname]</OPTION>";
									else
										echo "<OPTION VALUE='$rw2[id]'>$rw2[blockname]</OPTION>";
								}
								
							}
						
						?>
			                        </select></TD>
			</TR>
			<TR height='20'>
				<TD>Room Number</TD>
				<TD>
					<SELECT NAME="rnumber" SIZE="1" onChange="reload()">
						<OPTION VALUE="0">Select Room</OPTION>
						<?php
						if($hname !="" && $bname !=0)
						{
							$sql3 = "SELECT * FROM h_room_m WHERE h_id=$hname AND bid = $bname";
							$res3 = execute($sql3) or die("QUERY $sql1 " . error_description());
							if (rowcount($res3) != 0)
							{
								while ($rw3 = fetcharray($res3))
								{
									if ($rnumber == $rw3["id"])
										echo "<OPTION VALUE='$rw3[id]' SELECTED>$rw3[room_no]</OPTION>";
									else
										echo "<OPTION VALUE='$rw3[id]'>$rw3[room_no]</OPTION>";
								}
								
							}
						}
						?>
					</SELECT>
				</TD>
			</TR>
			</table>
			</table>
  <table class='forumline' align='center' width='90%' >
    <tr height='20'>
      <td>Blood Group</td>
      <td><input type="TEXT" name="bldgrp" size="28" value=<?=$row[blood_group]?>></td>
    </tr>
    <tr height='20'>
      <td>Permenent Address</td>
      <td><textarea rows="3" name="padd" cols="25" ><?=$row[per_address]?>
  </textarea></td>
    </tr>
    <tr height='20'>
      <td>Phone #</td>
      <td><input type="TEXT" name="pphone" size="28" value=<?=$row[per_phone]?>></td>
    </tr>
    <tr height='20'>
      <td>Name of Local Guardian</td>
      <td><input type="TEXT" name="lgname" size="28"></td>
    </tr>
    <tr height='20'>
      <td>Relationship</td>
      <td><input type="TEXT" name="lgrelation" size="28"></td>
    </tr>
    <tr height='20'>
      <td>Address of LG</td>
      <td><textarea rows="3" name="lgadd" cols="25"></textarea></td>
    </tr>
    <tr height='20'>
      <td>Phone</td>
      <td><input type="TEXT" name="lgphone" size="28"></td>
    </tr>
<tr>
		<td>&nbsp;&nbsp;From</td>
		<td nowrap>&nbsp;
		<input type="text" readonly="" name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>    
		
<?    
/*    
      
      <td><select name="jday">
        <?php
	            $j=date('d');
				for($i=1;$i<=31;$i++)
				{
				  $sel='';
				  if($j==$i)
				  $sel='selected'; 
				  echo "<option value='$i' $sel >$i</option>";
			    }
				?>
      </select>
        <select name="jmon">
          <?php
				$j=date('m');
				for($i=1;$i<=12;$i++)
				{
					$sel='';
					if($j==$i)
                    $sel='selected';
					echo "<option value='$i' $sel >$i</option>";
				}
				?>
        </select>
        <select name="jyr">
          <?php
				$j=date('Y');
				$d=$j-10;
				for($i=$d;$i<=$j+1;$i++)
                    {
	                  $sel='';
	                  if($j==$i)
	                  $sel='selected';
	                  echo "<option value=$i $sel >$i</option>";
                    }
				?>
        </select></td>
*/
?>

<?php
/*
    <tr height='20'>
      <td>Leaving Date</td>
      <td><select name="lday">
        <?php
	            $j=date('d');
				for($i=1;$i<=31;$i++)
				{
				  $sel='';
				  if($j==$i)
				  $sel='selected'; 
				  echo "<option value='$i' $sel >$i</option>";
			    }
				?>
      </select>
        <select name="lmon">
          <?php
				$j=date('m');
				for($i=1;$i<=12;$i++)
				{
					$sel='';
					if($j==$i)
                    $sel='selected';
					echo "<option value='$i' $sel >$i</option>";
				}
				?>
        </select>
        <select name="lyr">
          <?php
				$j=date('Y');
				$d=$j-10;
				for($i=$d;$i<=$j+5;$i++)
                    {
	                  $sel='';
	                  if($j==$i)
	                  $sel='selected';
	                  echo "<option value=$i $sel >$i</option>";
                    }
				?>
        </select></td>
    </tr>
*/
?>
<tr>
		<td nowrap>&nbsp;&nbsp;To</td>
		<td nowrap>&nbsp;
		<input type="text" readonly="" name="bdate" value="<?php echo $bdate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
        </td>
		</tr>
		<tr>
		<td nowrap>&nbsp;&nbsp;Description</td>
		<td nowrap>&nbsp;		<textarea name="descr" id="descr" rows="3" cols="20" ><?=$descr?></textarea>
</td>
		</tr>
    <tr height='20'>
      <td colspan="2" align="center">If Any Relative Employed in Same Organisation</td>
    </tr>
    <tr height='20'>
      <td>Name</td>
      <td><input type="TEXT" name="empname" size="28"></td>
    </tr>
    <tr height='20'>
      <td>Department</td>
      <td><input type="TEXT" name="empdept" size="28"></td>
    </tr>
    <tr height='20'>
      <td>Hostel Rent</td>
      <?php
				$sql1 = "SELECT * FROM hostel_m WHERE hostel_type='$hostel_type'";
				$res1 = execute($sql1) or die("QUERY $sql1 " . error_description());
				if (rowcount($res1) != 0)
				{
			 		while ($rw1 = fetcharray($res1))
					{
						if ($hname == $rw1["id"])
						    echo "<TD ><SIZE='25'>$rw1[hostel_rent]</TD>";
						else
							echo "<td></td>";
					}
						mysql_free_result($res1);
				}
				?>
    </tr>
    </table>
   <br>
      <CENTER><input type="submit" value="ADD" name="add" class="bgbutton"></CENTER>
    
  
  </CENTER>

			</FORM>
</BODY>
</HTML>