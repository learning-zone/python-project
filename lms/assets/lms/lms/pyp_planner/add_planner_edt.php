<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
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
	$Submit=$_POST['Submit'];
	
	$des_1_aa=$_POST['des_1_aa'];
	$des_1_ab=$_POST['des_1_ab'];
	$des_1_b=$_POST['des_1_b'];
	$des_2a=$_POST['des_2a'];
	$des_2b=$_POST['des_2b'];
	$des_3a=$_POST['des_3a'];
	$des_3b=$_POST['des_3b'];
	$des_4a=$_POST['des_4a'];
	$des_4b=$_POST['des_4b'];
	$des_5a=$_POST['des_5a'];
	$des_5b=$_POST['des_5b'];
	$des_6=$_POST['des_6'];
	$des_7=$_POST['des_7'];
	$des_8a=$_POST['des_8a'];
	$des_8b=$_POST['des_8b'];
	$des_9=$_POST['des_9'];
	
    $group_name=$_POST['group_name'];
	$group_title=$_POST['group_title'];
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
		  	        
     $sqlInsert="INSERT INTO `pyp_add_planner`(`school_division`, `grade`, `group_name`, `group_title`, `title`, `des_1_aa`, `des_1_ab`, `des_1_b`, `des_2a`, `des_2b`, `des_3a`, `des_3b`, `des_4a`, `des_4b`, `des_5a`, `des_5b`, `des_6`, `des_7`, `des_8a`, `des_8b`, `des_9`, `inserted_date`) VALUES ('$school_division', '$grade', '$group_name', '".addslashes($group_title)."', '".addslashes($title)."', '".addslashes($des_1_aa)."', '".addslashes($des_1_ab)."', '".addslashes($des_1_b)."', '".addslashes($des_2a)."' , '".addslashes($des_2b)."',
	 '".addslashes($des_3a)."', '".addslashes($des_3b)."', '".addslashes($des_4a)."', '".addslashes($des_4b)."', '".addslashes($des_5a)."', '".addslashes($des_5b)."', '".addslashes($des_6)."', '".addslashes($des_7)."', '".addslashes($des_8a)."', '".addslashes($des_8b)."', '".addslashes($des_9)."', CURDATE())";
	 
	 // echo $sqlInsert;

	 $resultInst=execute($sqlInsert) or die(mysql_error());
	if($resultInst)
	{
	 	$msg='Records Added';
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=add_planner.php?msg=$msg'>";
	}
	else
	{
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=add_planner.php'>";
	}
}
if($Submit == "Update")
{
     
	   
	$sqlUpdate="UPDATE `pyp_add_planner` SET `school_division` = '$school_division', `grade` = '$grade', `title` ='".addslashes($title)."',    `enquiry`='".addslashes($enquiry)."', `enq_sn`='".addslashes($enq_sn)."', `enq_sub`='".addslashes($enq_sub)."', `enq_sub_sn`='".addslashes($enq_sub_sn)."', `enq_des`='".addslashes($enq_des)."'  WHERE `id` = '$id'";
	 
	 // echo $sqlUpdate;
	  $resultUpdate=execute($sqlUpdate) or die(mysql_error());
	 if($resultUpdate)
	 {
	  	$msg="Records Updated";
	  	echo "<META HTTP-EQUIV='Refresh' Content='0;URL=add_planner_edt.php?msg=$msg'>";
	 }
	 else
	 {
		 echo "<META HTTP-EQUIV='Refresh' Content='0;URL=add_planner_edt.php'>";
	 }
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
		  $resultDel=execute($sqlDel) or die(mysql_error());
	  }
	if($resultDel)
	{
		$msg='Records Deleted';
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=add_planner.php?msg=$msg'>";
	}
	else
	{
		echo "<META HTTP-EQUIV='Refresh' Content='0;URL=add_planner.php'>";
	}
}
if($Type=="group_edt")
{
   $result=execute("SELECT * FROM `pyp_add_planner` WHERE `status`=1 AND `id`=$id");
   	
    while($row=fetcharray($result))
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
				<td><select name="title">
                <option value='' >----  Select ----</option>
                <?php
                    $sqlTitle=execute("SELECT * FROM `pyp_planner` WHERE `school_division`='$school_division'
					AND `grade`='$grade' AND `status`=1");
                        while($r=fetcharray($sqlTitle))
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
