<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">

function reload()
{
	document.frm.action='subject_group_sub.php';
	document.frm.submit();
	
}
</SCRIPT>
</HEAD>

<body>
<?php 
session_start();
require("../db.php");
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
    <td colspan="2" align="center" class="head">Apply Subject  Group </td>
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
<div align="center"><input class="bgbutton" type="submit" name="open" value="SAVE" ></div><br>
  <?php
  if($branch=='0'or $branch=='')
	die();
	if($sem=='0' or $sem=='')
	die();
   $sql123="select subject_id , subject_name from subject_m where course_year_id='$sem' and status=1";
	$rs=execute($sql123);
  ?>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr height="25">
    <td width="10%" class="head">Sl No.</td>
    <td width="40%" align="center" class="head">Subject Name</td>
    <td width="7%" align="center" class="head" nowrap>Select</td>

  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 
  	$check1=$r1[0];
  	$stcount=fetchrow(execute("select id from `subject_group_det` where `sem`='$sem' and `subject_id`='$check1' and `status`=1 and group_id='$id'"));
	if($stcount[0])
	$statuschek='checked';
	else
	$statuschek='';
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[1] </td>
    ";
	?>
	  <td align="center">
	<input type="checkbox" name="check[]" value="<?=$r1[0];?>" <?php echo $statuschek; ?> >
    </td>
  </tr><?php
$i++;  }
  ?>
  
</table>
				
</form>	
</body>
</html>