<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$a_year=$_SESSION['AcademicYear'];
if($_POST)
{

	$id=$_POST['id'];
	$Sel=$_POST['Sel'];
    $grade=$_POST['grade'];
	$Submit=$_POST['Submit'];
	$group_id=$_POST['group_id'];
	$color_code=$_POST['color_code'];
    $teacher_id=$_POST['teacher_id'];
	$school_division=$_POST['school_division'];
}

if($_GET)
{

	$id=$_REQUEST['id'];
	$msg=$_REQUEST['msg'];
	$Sel=$_REQUEST['Sel'];
    $Type=$_REQUEST['Type'];
	$grade=$_REQUEST['grade'];
	$school_division=$_REQUEST['school_division'];	

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
      
     $sqlInsert="INSERT INTO `pyp_group`(`school_division`, `grade`, `a_year`, `teacher_id`, `group_id`, `color_code`, `inserted_date`) 
	 VALUES ('$school_division', '$grade', '$a_year', '$teacher_id', '$group_id', '$color_code', CURDATE())";

	  //echo "<br>".$sqlInsert;

	 $resultInst=execute($sqlInsert) or die(mysql_error());

   
	if($resultInst)
	{
	 	 $msg='Records Added';
		 echo "<META HTTP-EQUIV='Refresh' Content='0;URL=create_group.php?msg=$msg&school_division=$school_division&grade=$grade'>";
	}
	else
	{
		 echo "<META HTTP-EQUIV='Refresh' Content='0;URL=create_group.php'>";
	}
}

if($Submit == "Update")
{

	  $sqlUpdate="UPDATE `pyp_group` SET `school_division` = '$school_division', `grade` = '$grade', `group_name` = '$group_name' ,`group_title`='$group_title' WHERE `id` = '$id'";

	  //echo $sqlUpdate;

	 $resultUpdate=execute($sqlUpdate) or die(mysql_error());
	 
	if($resultUpdate)
	{
	    $msg="Records Updated";
	  	echo "<META HTTP-EQUIV='Refresh' Content='0;URL=create_group_edt.php?msg=$msg&school_division=$school_division&grade=$grade'>";
	}
	else
	{
		 echo "<META HTTP-EQUIV='Refresh' Content='0;URL=create_group_edt.php'>";
	}
	  	

}

if(trim($Type) == "Del")
{
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sqlDel="UPDATE `pyp_group` SET `status` =0 WHERE `id` = '$val'";

		  //echo <br>.$sqlDel;

		  $resultDel=execute($sqlDel) or die(mysql_error());

	  }

	  if($result)
	  {
    		$msg='Records Deleted';
			echo "<META HTTP-EQUIV='Refresh' Content='0;URL=create_group.php?msg=$msg&school_division=$school_division&grade=$grade'>";
	  }	
	  else
	  {
	   	  echo "<META HTTP-EQUIV='Refresh' Content='0;URL=create_group.php'>";
	  }

}
?>
<html>
<head>
<script language="javascript">
  function ReloadMe()
  {
	  document.frm.action="create_group_edt.php";
	  document.frm.submit();
  }
</script>
<script type="text/javascript" src="jscolor/jscolor.js"></script>
</head>
<?
if($Type=="group_edt")
{

   $result=execute("SELECT * FROM `pyp_group` WHERE `status`=1 AND `id`=$id");

    while($row=fetcharray($result))
    {	
		$grade=$row[grade];
		$group_title=$row[group_title];
		$school_division=$row[school_division];
	?>
    <FORM id="frm" NAME="frm" ACTION="create_group_edt.php" METHOD="post">
    <input type="hidden" name="id" value="<?=$id?>"><br/>
	<table align='center' class=forumline width='90%' >
      <tr height="25">
          <td align='center' Class='head' colspan=3>EDIT GROUP</td>
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
				<td colspan="2" nowrap align="right">Teacher Name&nbsp;&nbsp;</td>
				<td><select name="teacher_id" OnChange="ReloadMe()">
              	<option value=''>----  Select ----</option>
              	<?php
						$teacher_id=$row['teacher_id'];
           $sqlT=execute("SELECT a.username,b.f_name,b.slno FROM usermenu a,staff_det b WHERE a.module='Class' AND a.submodule='PYP Planner' AND a.username=b.email GROUP BY b.f_name");
                      while($rt=fetcharray($sqlT))
                      {
                          if($teacher_id==$rt['slno'])
                              echo "<option value='$rt[slno]' selected>$rt[f_name]</option>";
                          else
                              echo "<option value='$rt[slno]'>$rt[f_name]</option>";
                      }
          
                ?> </select></td>
			</tr>
            <tr>
              <td colspan="2" nowrap align="right">Group Name&nbsp;&nbsp;</td>
              <td><select name="group_id" OnChange="ReloadMe()" required>
              <option value=''>----  Select ----</option>
              <?php
			  			$group_id=$row['group_id'];
                $sqlGroup=execute("SELECT `id`,`group_name` FROM `pyp_group_m` WHERE `status`=1 AND `grade`='$grade' ORDER BY `id`");
                      while($r=fetcharray($sqlGroup))
                      {
                          if($group_id==$r['id'])
                              echo "<option value='$r[id]' selected>$r[group_name]</option>";
                          else
                              echo "<option value='$r[id]'>$r[group_name]</option>";
                      }
          
              ?></select>&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="javascript:void(0);" onClick ="OpenWind2('create_group_m.php?grade=<?=$grade?>', 'OpenWind2',400,300)" 
              title="Click to add new Group"><img src="../images/add.png" align="top" height="15" width="15"></a></td>
          </tr>
          <tr>
			 <td colspan="2" nowrap align="right">Choose Color&nbsp;&nbsp;</td>
       		 <td><input class="color"  name="color_code" value="<?=$row['color_code']?>"></td>
		</tr>
	</table>
    <br/>
    <p align="center"><input name="Submit" type="submit" value="Update"  class="bgbutton"/></p>
   <?
  }
}
?>

