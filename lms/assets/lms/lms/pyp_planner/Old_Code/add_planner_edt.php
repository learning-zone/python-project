<?php
echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";
session_start();
include("../db.php");

if($_POST['Nenq_sn']!='' and $_POST['Nenq_sub_sn']!='')
{
	$enq_sn=$_POST['Nenq_sn'];
	$enq_sub_sn=$_POST['Nenq_sub_sn'];
}
else
{
	$enq_sn=$_POST['enq_sn'];
	$enq_sub_sn=$_POST['enq_sub_sn'];
}
if($_POST)
{
	
	$id=$_POST['id'];
	$Sel=$_POST['Sel'];
	$grade=$_POST['grade'];
    $title=$_POST['title'];
	$adate=$_POST['adate'];
	$bdate=$_POST['bdate'];
	$Submit=$_POST['Submit'];
	$enq_des=$_POST['enq_des'];
	$enquiry=$_POST['enquiry'];
	$enq_sub=$_POST['enq_sub'];
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
	
	  	        
     $sqlInsert="INSERT INTO `pyp_add_planner`(`school_division`, `grade`, `group_name`, `title`, `enquiry`, `enq_sn`, `enq_sub`, `enq_sub_sn`, `enq_des`, `inserted_date`) VALUES ('$school_division', '$grade', '$group_name', '".addslashes($title)."', '".addslashes($enquiry)."', '".addslashes($enq_sn)."', '".addslashes($enq_sub)."', '".addslashes($enq_sub_sn)."' , '".addslashes($enq_des)."', CURDATE())";
	 
	 // echo $sqlInsert;
	
	 $resultInst=mysql_query($sqlInsert) or die(mysql_error());
   
	 echo "<META HTTP-EQUIV='Refresh' Content='1; URL=add_planner.php?msg=Records Added Successfully'>";
	
}
if($Submit == "Update")
{
     
	   
	$sqlUpdate="UPDATE `pyp_add_planner` SET `school_division` = '$school_division', `grade` = '$grade', `title` ='".addslashes($title)."',    `enquiry`='".addslashes($enquiry)."', `enq_sn`='".addslashes($enq_sn)."', `enq_sub`='".addslashes($enq_sub)."', `enq_sub_sn`='".addslashes($enq_sub_sn)."', `enq_des`='".addslashes($enq_des)."'  WHERE `id` = '$id'";
	 
	  echo $sqlUpdate;
	  $resultUpdate=mysql_query($sqlUpdate) or die(mysql_error());
	 
	  $msg="Records Updated Successfully";
	  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=add_planner_edt.php?msg=$msg'>";
	  	
}
if(trim($Type) == "Del")
{
      //echo "Inside Del";
      for($i=0;$i<sizeof($Sel);$i++)
	  {
	      $val=$Sel[$i];
		  $id=$_POST[$val.'id'];
		  
		  $sqlDel="UPDATE `pyp_planner` SET `status` = '0' WHERE `id` = '$val'";
		  //echo $sql;
		  $resultDel=mysql_query($sqlDel) or die(mysql_error());
	  }

		echo "<META HTTP-EQUIV='Refresh' Content='1; URL=add_planner.php?msg=Records Deleted Successfully'>";
	 	
}
if($Type=="group_edt")
{
   $result=mysql_query("SELECT * FROM `pyp_add_planner` WHERE `status`=1 AND `id`=$id");
   	
    while($row=mysql_fetch_array($result))
    {	
		$grade=$row[grade];
		$school_division=$row[school_division];
		$Nenq_sn=$row[enq_sn];
		$Nenq_sub_sn=$row[enq_sub_sn];
		$title=$row[title];
	?>
	<br/>
<html>
<head>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="Editor/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<!-- /TinyMCE -->
</head>
<body>
    <FORM id="frm" NAME="frm" ACTION="add_planner_edt.php" METHOD="post">
    <input type="hidden" name="id" value="<?=$id?>">
	<table align='center' class=forumline width='90%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>EDIT PLANNER DESCRIPTION</td>
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
				<td colspan="2" nowrap align="right">Title&nbsp;&nbsp;</td>
				<td><select name="title">
                <option value='' >----  Select ----</option>
                <?php
                    $sqlTitle=mysql_query("SELECT * FROM `pyp_planner` WHERE `school_division`='$school_division'
					AND `grade`='$grade' AND `status`=1");
                        while($r=mysql_fetch_array($sqlTitle))
                        {
                            if($title==$r['id'])
                                echo "<option value='$r[id]' selected>$r[title]</option>";
                            else
                                echo "<option value='$r[id]'>$r[title]</option>";
                        }
            
                ?> </select></td>
            </tr>
          <tr height="25">
				<td colspan="2" nowrap align="right">Enquiry Short-Name&nbsp;&nbsp;</td>
				<td><INPUT TYPE="text"  NAME="enq_sn" value="<?=$row[enq_sn]?>" size="60"></td>
	       </tr>
     	  <tr height="25">
				<td colspan="2" nowrap align="right">Sub Enquiry Short-Name&nbsp;&nbsp;</td>
				<td><INPUT TYPE="text"  NAME="enq_sub_sn" value="<?=$row[enq_sub_sn]?>" size="60"></td>
	       </tr>
	</table>
     <br><br>
    	<table align='center' class=forumline width='90%' >
			<tr height="25">
				<td align='center' Class='head' colspan=3>ADD PLANNER DETAIL</td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="right">Enquiry&nbsp;&nbsp;</td>
				<td><textarea name="enquiry" cols="120" rows="4"><?=$row[enquiry]?></textarea><br></td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="right">Sub - Enquiry&nbsp;&nbsp;</td>
				<td><textarea name="enq_sub" cols="120" rows="4"><?=$row[enq_sub]?></textarea><br></td>
			</tr>
            <tr height="25">
				<td colspan="2" nowrap align="right">Enquiry Description&nbsp;&nbsp;</td>
				<td><textarea name="enq_des" cols="120" rows="4"><?=$row[enq_des]?></textarea><br></td>
			</tr>

	</table>
         <p align="center"><input name="Submit" type="submit" value="Update"  class="bgbutton"/></p>
        <?
  }
}
?>
