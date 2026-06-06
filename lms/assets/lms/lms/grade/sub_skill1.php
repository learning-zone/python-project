<?php
session_start();
include("../db.php");

$accyeardet=$_SESSION['AcademicYear'];
$masteexamn=$_REQUEST['masteexamn'];
$sem=$_REQUEST['sem'];
$unit=$_REQUEST['unit'];
$examid=$_REQUEST['examid'];
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
if(($_POST['update']))
{
	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$priority=$_POST['priority'.$cid[$i]];
		$skills=$_POST['skills'.$cid[$i]];
		$sql23="update  pyp_subskills set sub_skill='{$skills}', posi='$priority' where id='$cid[$i]'";
		
		execute($sql23);	
	}
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php		
}
if(($_POST['save']))
{
	if($skills!='' )
	{
		
			$sql44="INSERT INTO  pyp_subskills (acc_year,class, sub, master_skill, sub_skill, posi,unit,examid) VALUES ('$accyeardet', '$sem', '$sub', '$skill2', '{$skills}' , '$priority','$unit','$examid')";
	
			execute($sql44);
			?>
			<Script language="JavaScript">
			alert("Updated successfully");
			</Script>
			<?php	
		
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
<head>
</head>
<body>
<form name="frm" method="post">
<input type="hidden" name="idn" value="<?php echo $idn; ?>">
<table align='center' class='forumline' width='70%' >
<tr>
  <td align='center' class='head'>Lines of Inquiry</td>
		<td align='center' class='head' nowrap>ORDER</td>
	</tr>
	<tr>
      <td align='center' nowrap>
         
           <input type='text' name='skills' value=''  size='60'>
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
$sql3=execute("select id, sub_skill , posi from  pyp_subskills where acc_year='$accyeardet' and class='$sem' and examid='$examid' and unit='$unit'");
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
		 <td align='center' nowrap> 
        <input type='text' name='skills$r6[0]' value='$r6[1]' size='60'>
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