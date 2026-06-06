<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if($_POST)
{
	$id=$_POST['id'];
	$Sel=$_POST['Sel'];
	$grade=$_POST['grade'];
    $title=$_POST['title'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$Submit=$_POST['Submit'];
    $group_name=$_POST['group_name'];
	$school_division=$_POST['school_division'];
	$proposed_duration=$_POST['proposed_duration'];
}

if($_GET)
{
	$id=$_GET['id'];
	$msg=$_GET['msg'];
	$Sel=$_GET['Sel'];
    $Type=$_GET['Type'];	
}

if($msg!='')
{
?>
   <script language="javascript">
	  alert('<?=$msg?>');
	  window.opener.location.reload();
	  window.close();
    </script>
<?
}

if(trim($Type) == "Add")
{

	  $dateArray=explode('/',$adate);

	  $acq_yy=$dateArray[2];

	  $acq_mm=$dateArray[1];

	  $acq_dd=$dateArray[0];

	  $date_from="$acq_yy-$acq_mm-$acq_dd";

	  

	  $dateArray1=explode('/',$bdate);

	  $acq_yy1=$dateArray1[2];

	  $acq_mm1=$dateArray1[1];

	  $acq_dd1=$dateArray1[0];

	  $date_to="$acq_yy1-$acq_mm1-$acq_dd1";

	  

	        

     $sqlInsert="INSERT INTO `pyp_planner`(`school_division`, `grade`, `title`, `date_from`, `date_to`, `proposed_duration`) VALUES ('$school_division', '$grade', '".addslashes($title)."', '$date_from', '$date_to', '$proposed_duration')";

	  //echo <br>.$sqlInsert;

	  $resultInst=execute($sqlInsert) or die(mysql_error());

   
	if($resultInst)
	{
		  $msg='Records Added';
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=create_planner.php?msg=$msg'>";
	}
	else
	{
		  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=create_planner.php'>";
	}
	

}

if($Submit == "Update")
{

	  $dateArray=explode('/',$adate);

	  $acq_yy=$dateArray[2];

	  $acq_mm=$dateArray[1];

	  $acq_dd=$dateArray[0];

	  $date_from="$acq_yy-$acq_mm-$acq_dd";

	  

	  $dateArray1=explode('/',$bdate);

	  $acq_yy1=$dateArray1[2];

	  $acq_mm1=$dateArray1[1];

	  $acq_dd1=$dateArray1[0];

	  $date_to="$acq_yy1-$acq_mm1-$acq_dd1";

	   

	  $sqlUpdate="UPDATE `pyp_planner` SET `school_division` = '$school_division', `grade` = '$grade', `title` = '$title', 

	  `date_from`='$date_from', `date_to`='$date_to', `proposed_duration`='$proposed_duration'  WHERE `id` = '$id'";
	 

	  //echo $sqlUpdate;

	 $resultUpdate=execute($sqlUpdate) or die(mysql_error());

	 
    if($resultUpdate)
	{
	   $msg="Records Updated";

	   echo "<META HTTP-EQUIV='Refresh' Content='0;URL=create_planner_edt.php?msg=$msg'>";
	}
	else
	{
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=create_planner_edt.php'>";
	}
	  	

}
if($Type=="group_edt")
{
   $result=execute("SELECT * FROM `pyp_planner` WHERE `status`=1 AND `id`=$id");		
    while($row=fetcharray($result))
    {	
		$grade=$row[grade];
		$school_division=$row[school_division];
	?>
	
<html>
<head>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
</head>
<body>
<FORM id="frm" NAME="frm" ACTION="create_planner_edt.php" METHOD="post">
<input type="hidden" name="id" value="<?=$id?>"><BR>
<table align='center' class=forumline width='90%' >
<tr height="25">
	<td align='center' Class='head' colspan=3>EDIT PLANNER</td>
</tr>
	 <tr>
			<td colspan="2" nowrap align="right"><?php echo $_SESSION['branchname']; ?>&nbsp;&nbsp;</td>
				<td><select name="school_division"  OnChange="ReloadMe();">
				<option value='' >----  Select ----</option>
				<?
                	$sqlCourse=execute("SELECT * FROM `course_m` WHERE status=1");
					while($r=fetcharray($sqlCourse))
					{
						if($school_division==$r['course_id'])
							echo "<option value='$r[course_id]' selected>$r[1]</option>";
						else
							echo "<option value='$r[course_id]'>$r[1]</option>";
					}         
                ?>
			</select></td>
          </tr>
          <tr>
          	<td colspan="2" nowrap align="right"><?php echo $_SESSION['semname']; ?>&nbsp;&nbsp;</td>
      		<td><select name="grade">
            <option value='' >----  Select ----</option>
			<?php
				$sqlCYear=execute("SELECT * FROM `course_year` WHERE `status`=1 AND `head_id`='$school_division'");

					while($r=fetcharray($sqlCYear))
					{
						if($grade==$r['year_id'])
							echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
						else
							echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}

            ?> </select></td>
          </tr>
	      <tr height="25">
				<td colspan="2" nowrap align="right">Title&nbsp;&nbsp;</td>
				<td width="76%"><INPUT TYPE="text"  NAME="title" value="<?=$row[title]?>" size="40"></td>

	      </tr>

            <tr height="25">

				<td colspan="2" nowrap align="right">Duration From&nbsp;&nbsp;</td>

				<td width="76%"><INPUT TYPE="text"  NAME="adate" value="<? echo date("d/m/Y", strtotime($row['date_from']));?>" size="10">

				<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>

				</td>

			</tr>

            <tr height="25">

				<td colspan="2" nowrap align="right">Duration To&nbsp;&nbsp;</td>

			    <td width="76%"><INPUT TYPE="text"  NAME="bdate" value="<? echo date("d/m/Y", strtotime($row['date_to']));?>" size="10">

				<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>

				</td>

			</tr>

            <tr height="25">

				<td colspan="2" nowrap align="right">Proposed Duration&nbsp;&nbsp;</td>

				<td><textarea name="proposed_duration" cols="46" rows="4"><?=$row[proposed_duration]?></textarea><br></td>

			</tr>

	</table>

        <br/>

         <p align="center"><input name="Submit" type="submit" value="Update"  class="bgbutton"/></p>

        <?

  }

}

?>

