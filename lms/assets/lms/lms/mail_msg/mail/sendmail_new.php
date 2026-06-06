<html>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
function reload()
{
	document.frm.action='sendmail_new.php';
	document.frm.submit();
	
}
function reload1()
{
	document.frm.action='sendmail1s_new.php';
	document.frm.submit();
	
}
function reload2()
{
	document.frm.action='sendmail1.php';
	document.frm.submit();
	
}
function reload3()
{
	document.frm.action='sendmail1s_newtf.php';
	document.frm.submit();
	
}
function selectMe()
{
	var i = document.frm.length;
	for(j=0;j<i;j++)
	{
		if(document.frm[j].Sel != "CheckBox")
		{
			flag = document.frm[j].checked;
			document.frm[j].checked = !flag;
		}
	}
}	
</SCRIPT>
</HEAD>

<body onBlur="">
<?php 
session_start();
require("../../db.php");
$user=$_SESSION['user'];
if(!$_POST)
{
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	
}
else
{
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
}
$subj=$_POST['subj'];
$type=$_POST['type'];
$group_name=$_POST['group_name'];
$class_section_id=$_POST['class_section_id'];
$Mail_template=$_POST['Mail_template'];
$member_type=$_POST['member_type'];

$type=1; //Bydefault it will select Student Email

//print_r($_POST);
//echo "<br>";
//print_r($_REQUEST);

echo '<form name="frm" action="" method="post" >';	
echo '<br>';

?>	
<table width="47%" align="center" class="forumline" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="head">Send Email</td>
    </tr>
  <tr>
    <td width="30%" nowrap>&nbsp;&nbsp;Group Type</td>
	  <td><select name='group_name'  onChange="reload()">
	  <option value="">------ Select -----</option>
		<?php
			$sql=execute("SELECT id, group_name FROM `mail_group` where status=1 ORDER BY id");
				while($r=fetcharray($sql))
				{
					if($group_name==$r[id])
					echo "<option value='$r[id]'  selected>$r[group_name]</option>";
					else
					echo "<option value='$r[id]' >$r[group_name]</option>";
				}
				
		?>
		</select></td>

  </tr>
  <tr>
  <td height="28">&nbsp;&nbsp;Mail Template</td>
  <td><select name='Mail_template'  onChange="reload()">
<?
$qury=execute("select id, mail_subject  FROM `mail_det` where status=1 and (username='$user' or username='administrator') ORDER BY `mail_date` DESC") or die(mysql_error());
echo "<option value=''>--Select--</option>";
while($r=fetcharray($qury))
{
	if($Mail_template==$r[id])
	echo "<option value='$r[id]' selected>$r[mail_subject]</option>";
	else
	echo "<option value='$r[id]'>$r[mail_subject]</option>";

}
?>
</select>
</td>
</tr>
</table>
<?php

	echo '<br>
			<div align="center">';

		echo '<input type="button" name="open" value="Send Mail"  class="bgbutton" onClick="reload1()">';
	
	?> <a href= "javascript:OpenWind2('ViewTemplate.php?mailid=<?=$Mail_template?>')">
		 <input type="button" name="View Template"  class="bgbutton" value="View Template" ></a></div><br>
	<br>  
	  <table width="90%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
	   <tr>
		<td width="5%" class="head" align="center" nowrap>Sl No.</td>
		<td width="30%" align="center" class="head" nowrap>Member Name</td>
		<td width="30%" align="center" class="head" nowrap>Mail ID</td>
		<td width="10%" align="center" class="head" nowrap>Phone Number</td>
		<td width="5%" align="center" class="head" nowrap><div class="head" id="checkAll" 
	onClick="selectMe()" Title="Click to Select all Students">Select ALL<input type="checkbox"></div></td>
	  </tr>
 <?php
 $i=1;
$k=0; 
 if($Mail_template=='')
		die();
		
	
		
 $sql1=execute("SELECT * FROM `mail_member` WHERE `group_name` = '$group_name' AND status=1");
	  
       while($r1=fetcharray($sql1))
       {
			$stud_id=$r1[stud_id];
			 
			$mail_member_field=fetchrow(execute("select name from mail_member_field where id='$r1[member_type]'"));
			$sql2=execute("SELECT name_field, mail_field, phone, name, table_name, where_id FROM `mail_member_field` where id= '$r1[member_type]' ORDER BY id");
	        while($r2=fetcharray($sql2))
	        {
		        $name=$r2[3];
				$name_field=$r2[0];
				$mail_field=$r2[1];
				$phone=$r2[2];
				$table_name=$r2['table_name'];
				$where_id=$r2['where_id'];
			}
			
		
			
		if($r1['member_type']==4)
		{
        	$sql3="SELECT  qual, cert, $name_field, $mail_field, $phone  FROM staff_det WHERE id = '$stud_id'";
		}
		else
		{
			$sql3="SELECT  first_name, last_name, $name_field, $mail_field, $phone  FROM student_m WHERE id = '$stud_id'";
		}

		   $rs=execute($sql3);
	
	  while($r3=fetcharray($rs))
	  { 
			if($i<10)
			{
				$i='0'.$i;
			}
			else
			    $i;
				
			?>
			<tr>
			<td align='center' nowrap>&nbsp;<?=$i?></td>
			<td nowrap>&nbsp;<?=$r3[2]?>  ( <?=$mail_member_field[0]?> )</td></td>
			<td nowrap>&nbsp;<?=$r3[3]?></td>
			<td nowrap>&nbsp;<?=$r3[4]?></td>
			
		<?
		$i=$i+1;
   		
   ?>
	  <td align="center">
		<input type="checkbox" name="check[]" value="<?=$k?>" checked>
		
		<input type="hidden" name="senderName[]" value="<?=$r3[2]?>" >
		<input type="hidden" name="senderEmail[]" value="<?=$r3[3]?>" >
		</td>
	  </tr><?php
	 $k++;
	 }
}
	  ?>
	  
	</table>

<?php

?>				
</form>	
</body>
</html>