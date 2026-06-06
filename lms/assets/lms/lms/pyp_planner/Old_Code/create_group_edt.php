<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
session_start();
include("../db.php");
if($_POST)
{
	
	$id=$_POST['id'];
	$Sel=$_POST['Sel'];
    $grade=$_POST['grade'];
	$Submit=$_POST['Submit'];
    $group_name=$_POST['group_name'];
	$school_division=$_POST['school_division'];
	
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

      //echo "Inside ADD";
     $sqlInsert="INSERT INTO `pyp_group`(`school_division`, `grade`, `group_name`, `inserted_date`) VALUES ('$school_division', '$grade', '$group_name', CURDATE())";
	  //echo $sql;
	 $resultInst=mysql_query($sqlInsert) or die(mysql_error());
   
	  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=create_group.php?msg=Records Added Successfully'>";
	
}
if($Submit == "Update")
{
      //echo "Hello";
	  $sqlUpdate="UPDATE `pyp_group` SET `school_division` = '$school_division', `grade` = '$grade', `group_name` = '$group_name' WHERE `id` = '$id'";
	 
	  //echo $sqlUpdate;
	 $resultUpdate=mysql_query($sqlUpdate) or die(mysql_error());
	 
	  $msg="Records Updated Successfully";
	  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=create_group_edt.php?msg=$msg'>";
	  	
}

if(trim($Type) == "Del")
{
      //echo "Inside Del";
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sqlDel="UPDATE `pyp_group` SET `status` = '0' WHERE `id` = '$val'";
		  //echo $sql;
		  $resultDel=mysql_query($sqlDel) or die(mysql_error());
	  }
		  
	  if($result)
	  {
			echo "<META HTTP-EQUIV='Refresh' Content='1; URL=create_group.php?msg=Records Deleted Successfully'>";
	  }	
}
if($Type=="group_edt")
{
   $result=mysql_query("SELECT * FROM `pyp_group` WHERE `status`=1 AND `id`=$id");
		
    while($row=mysql_fetch_array($result))
    {	
		$grade=$row[grade];
		$school_division=$row[school_division];
		
	?>
	<br/>
    <FORM id="frm" NAME="frm" ACTION="create_group_edt.php" METHOD="post">
    <input type="hidden" name="id" value="<?=$id?>">
	<table align='center' class=forumline width='90%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>EDIT GROUP</td>
			</tr>
            <tr>
				<td colspan="2" nowrap align="right"><?php echo $_SESSION['branchname']; ?>&nbsp;&nbsp;</td>
				<td><select name="school_division"  OnChange="ReloadMe();">
				<option value='' >----  Select ----</option>
				<?
                	$sqlCourse=mysql_query("SELECT * FROM `course_m` WHERE status=1");
					while($r=mysql_fetch_array($sqlCourse))
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
				$sqlCYear=mysql_query("SELECT * FROM `course_year` WHERE `status`=1 AND `head_id`='$school_division'");
					while($r=mysql_fetch_array($sqlCYear))
					{
						if($grade==$r['year_id'])
							echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
						else
							echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}
        
            ?> </select></td>
          </tr>
			<tr height="25">
				<td colspan="2" nowrap align="right">Teacher Name&nbsp;&nbsp;</td>
				<td width="76%"><INPUT TYPE="text"  NAME="group_name" value="<?=$row[group_name]?>" size="50"></td>
			</tr>
	</table>
        <br/>
         <p align="center"><input name="Submit" type="submit" value="Update"  class="bgbutton"/></p>
        <?
  }
}
?>
