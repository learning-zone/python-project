<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">

function reload()
{
	document.frm.action='create_member_group.php';
	document.frm.submit();
	
}
</SCRIPT>
</HEAD>

<body>
<?php 
session_start();
require("../../db.php");
if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];	
}
else
{
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$check=$_REQUEST['check'];
}
	$id=$_REQUEST['id'];

if($_POST['open'])
{
	for($i=0;$i<sizeof($check);$i++)
	{
		$check1=$check[$i];
		$stcount=fetchrow(execute("select id from `subject_group_det` where `sem`='$sem' and `subject_id`='$check1' and `status`=1"));
		if(!$stcount[0])
		{
			execute("INSERT INTO `subject_group_det` ( `group_id`, `sem`, `subject_id`, `status`) VALUES ('$id', '$sem', '$check1', '1')");
		}
		else
		{
			execute("update `subject_group_det` set group_id='$id' where id='$stcount[0]'");
		}
	}
		?>
        <script language="javascript">
        alert("Update Successfully ");
		//window.close();
        </script>
        <?

}

?>
<form name="frm" action="" method="post" >
<input type="hidden" name="id" value="<?=$id?>">
<table width="50%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Add Members To  Group </td>
    </tr>
     
  <tr>
    <td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td>&nbsp;<select name="branch" onChange="reload()">
			<option value="0">------Select-----</option>
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
		
  </tr>
  <tr>
   <td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
		<td>&nbsp;<select name="sem" onChange="reload()">
			<option value='0'>-----Select----</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected> $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'> $r[year_name]</option>";
					}
				}
			?>
			</select>

		</td>
  </tr>
</table>
<br>
    <div align="center">
	    <input class="bgbutton" type="submit" name="open" value="SAVE" >
    </div>
<br>
  <?php
  if($branch=='0'or $branch=='')
	die();
	if($sem=='0' or $sem=='')
	die();
  ?>
  
</table>
				
</form>	
</body>
</html>