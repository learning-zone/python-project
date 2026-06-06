<?php
session_start();
include("../db.php");

$accyeardet=$_SESSION['AcademicYear'];
$mastername=$_REQUEST['mastername'];
$class=$_REQUEST['class'];
$sub=$_REQUEST['sub'];
$subject=$_REQUEST['subject'];
if($_REQUEST['master']!='')
$idn=$_REQUEST['master'];
else
$idn=$_POST['idn'];

$priority=$_POST['priority'];
$skills=$_POST['skills'];
$sql2=execute("select * from pypskills where id='$idn'");
while($r=fetcharray($sql2))
{
	$divi=$r['divi'];
	$class=$r['class'];
	$sub=$r['sub'];
	$skill2=$r['id']; 	
}
if(isset($_POST['update']))
{
	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$priority=$_POST['priority'.$cid[$i]];
		$skills=$_POST['skills'.$cid[$i]];
		$sql23="update  pyp_subskills set sub_skill='".addslashes($skills)."', posi='$priority' where id='$cid[$i]'";
		
		execute($sql23);	
	}
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php		
}
if(isset($_POST['save']))
{
	if($skills!='' and $priority!='')
	{
		$sql2=execute("select * from  pyp_subskills where acc_year='$accyeardet' and class='$class' and sub='$sub' and master_skill='$skill1' and 	sub_skill='$skills' and posi='$priority'");
		if(rowcount($sql2)>=1)
		{
			?>
			<Script language="JavaScript">
			alert("Duplicate entry not allowed");
			</Script>
			<?php
		}
		else
		{
			$sql44="INSERT INTO  pyp_subskills (acc_year,class, sub, master_skill, sub_skill, posi) VALUES ('$accyeardet', '$class', '$sub', '".addslashes($skill2)."', '".addslashes($skills)."' , '$priority')";
	
			execute($sql44);
			?>
			<Script language="JavaScript">
			alert("Updated successfully");
			</Script>
			<?php	
		}
	}
	else
	{
			?>
			<Script language="JavaScript">
			alert("Null data");
			</Script>
			<?php
		
	}
}
?>
<html>
<head><title>MASTER SKILLS</title>
</head>
<body>
<form name="frm" method="post">
<input type="hidden" name="idn" value="<?php echo $idn; ?>">
<table align='center' class='forumline' width='70%' >
<tr>
  <td colspan=2 align='center' class='head'>SUB SKILLS For <?php echo $mastername; ?></td></tr>
<tr>
	<tr>
		<td align='center' class='head' nowrap>SUB SKILL</td>
		<td align='center' class='head' nowrap>ORDER</td>
	</tr>
	<tr>
      <td align='center' nowrap>
           <textarea name='skills' rows='3' cols='60' ></textarea>
		</td>
        <td align='center' nowrap>
        <input type='text' name='priority' value='' maxlength="2" size="2" width="2">
		</td>
		
	</tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'>
  <br>
  
  <br>
  <?php
$sql3=execute("select id, sub_skill , posi from  pyp_subskills where acc_year='$accyeardet' and class='$class' and sub='$sub' and master_skill='$skill2'");
if(rowcount($sql3)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='70%' >
<tr>
		<td align='center' class='head' nowrap>Sel
		</td>
		<td align='center' class='head' nowrap>SKILL</td>
		<td align='center' class='head' nowrap>ORDER</td>
		
	</tr>
	<?php
	while($r6=fetcharray($sql3))
	{
	echo "<tr><td align='center'  nowrap><input type='checkbox' name='cid[]' value='$r6[0]'>
		</td>
		 <td align='center' nowrap> <textarea name='skills$r6[0]' rows='3' cols='60' >$r6[1]</textarea>
        
		</td>
        <td align='center' nowrap>
        <input type='text' name='priority$r6[0]' value='$r6[2]' maxlength='2' size='2' width='2'>
		</td>
		
		</tr>";
	}
	?>
	<?php
	?>
	</table>
    <br>
  <div align='center' >
  <input type="submit" name="update" value="UPDATE"  class='bgbutton'>
	<?php
}
?>	
  
</form>
</body>
</html>