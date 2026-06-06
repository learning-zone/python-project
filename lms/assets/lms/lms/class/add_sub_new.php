<HTML>
<HEAD>
<?php
session_start();
require("../db.php");

?>
</HEAD>
<BODY class='bodyline'>
<?php

$NewSub=$_POST['NewSub'];
$Newcode=$_POST['Newcode'];
$new_elective=$_POST['new_elective'];
$elective=$_POST['elective'];
$Newpre=$_POST['Newpre'];
$NewType=$_POST['NewType'];

if($_POST['adds'])
{
	if($new_elective=='')
	{
		$new_elective='N';
	}
			
			execute("INSERT INTO subject_m (`subject_name`,`subject_code`,`elective`, `sub_pre`,`sub_type`,`status`) VALUES ('$NewSub','$Newcode','$new_elective','$Newpre','$NewType','1')");

	 ?>
         <script language="javascript">
		 alert("Inserted Sucessfully");
		 window.opener.location.href='class_create.php?id=1&sem='+"<?=$grades?>"+'&subject='+"<?=$subj?>"+'&section='+"<?=$class_section?>";
         </script>
         <?php
}
?>
<?
if($_POST['Modify'])
{
	
	$Sel=$_POST['Sel'];
	for($j=0;$j<sizeof($Sel);$j++)
	{
		$newid=$Sel[$j];
		$subName1=$_POST[$newid.'subName'];
		$subcode1=$_POST[$newid.'subcode'];
		$SubType1=$_POST[$newid.'SubType'];
		$elective1=$_POST[$newid.'elective'];
		$pre1=$_POST[$newid.'pre'];
		
		if($elective1=='on')
	{
		$elective1='Y';
	}
	else
	{
		$elective1='N';
	}
		
	
	$sql33="update subject_m set `subject_name`='$subName1' ,`subject_code`='$subcode1' , `elective`='$elective1' ,`sub_pre`='$pre1',`sub_type`='$SubType1' where subject_id='$newid'";
			execute($sql33);;
	}
	
	 ?>
         <script language="javascript">
		 alert("Updated Sucessfully");
		 window.opener.location.href='class_create.php?id=1&sem='+"<?=$grades?>"+'&subject='+"<?=$subj?>"+'&section='+"<?=$class_section?>";
         </script>
         <?php
}
?>
<?
if($_POST['Delete'])
{
	
	$Sel=$_POST['Sel'];
	for($j=0;$j<sizeof($Sel);$j++)
	{
		$newid=$Sel[$j];
		$sql33="update subject_m set status='0' where subject_id='$newid'";
		execute($sql33);
		
		execute("UPDATE class_section SET status='0' WHERE sub='$newid'");
	}
	
	 ?>
         <script language="javascript">
		 alert("Deleted Sucessfully");
		 window.opener.location.href='class_create.php?id=1&sem='+"<?=$grades?>"+'&subject='+"<?=$subj?>"+'&section='+"<?=$class_section?>";
         </script>
         <?php
}
?>

<form name="AddSubject" action ="add_sub_new.php" method="post">
<input type="hidden" name="grades" value="<?=$grades?>"/>
<input type="hidden" name="subj" value="<?=$subj?>"/>
<input type="hidden" name="sem" value="<?=$sem?>"/>
<input type="hidden" name="class_section" value="<?=$class_section?>"/>


	
     <table class='forumline' align=center width='100%'>
	<TR>
		<TD class="head" align="center">Course Name</TD>
		<TD class="head" align="center">Course Code</TD>
		<TD class="head" align="center">Course Type</TD>		
		<TD class="head" nowrap  align="center"> Elective </TD>
		<TD Class="head" align="center">Order</TD>
	</TR>
	<TR>
	<TD align="center"><INPUT TYPE="text" name="NewSub" size='35' required></TD>
	<TD align="center"><INPUT TYPE="text" name="Newcode" size="10" required></TD>

	<td align="center">
	<SELECT name="NewType">
	
	<?php
	$sql = "select * from subjecttype";
	$rs = execute($sql);
	$num = rowcount($rs);
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($rs,$i);
		?>
		<OPTION  value="<?=$r["subtype_id"]?>"><?=$r["subtype_name"]?></option>
		<?php
	}
	?>
	</SELECT>
	</td>
  
	<TD align="center"><Input Type="checkbox" name="new_elective"  value="Y"></TD>
	<TD align='center'><Input Type="text"  name="Newpre" size=3 maxlength=3></TD>
	</TR>
</Table><br>
	<div align=center>
	<input type="submit" id="adds" value="Add Course" name="adds" class='bgbutton'>
	</div>
	</form>
<form name="AddSubject" action ="add_sub_new.php" method="post">
	<?php

  
  echo "<Table class='forumline' align='center' width='100%'>";
  
	$sql = "SELECT subject_id,subject_name,sub_type,total_marks,subject_code,elective,sys_year,max_mark,sub_pre FROM  ";
	$sql.= "subject_m WHERE course_id='0'";
	$sql .= " and course_year_id ='0' and status='1' order by sub_pre";
	$sub = execute($sql) ;
	$num = rowcount($sub);
	 
	if($num  > 0 )
	{
		?>
		<TR>
		<TD Class="head">Sel</TD>
		<TD Class="head" align="center">Course Name</TD>
		<TD Class="head" align="center">Course Code</TD>
		<TD Class="head" align="center">Course Type</TD>
		<TD Class="head" align="center">Elective </TD>
		<TD Class="head" align="center">Order</TD></TR>
		<?php
		for($i=0;$i<$num;$i++)
		{
			$r = fetchrow($sub);
			
		echo "	<tr> ";
			?>
			
			<TD class="CBody" align="center"><Input Type="checkbox" name="Sel[]" value="<?=$r[0]?>">
			</TD>
			<td class="CBody" align="center">
			<Input Type="Text" Name="<?=$r[0]?>subName" value="<?=$r[1]?>" size=35></td>
			<td class="CBody" align="center">
			<Input Type="Text" Name="<?=$r[0]?>subcode" value="<?=$r[4]?>" size=10></td>
			<td align="center">
			<Select Name="<?=$r[0]?>SubType">

			<?php
			$sql = "SELECT * FROM subjecttype ORDER BY subtype_id";
			$rsTemp = execute($sql);

			$num1 = rowcount($rsTemp);
			for($j=0; $j<$num1; $j++)
			{
				$rTemp = fetcharray($rsTemp,$j);
				if( $rTemp[0] == $r[2])
				{
					echo "<option value=\"$rTemp[0]\" selected>$rTemp[1]</option>";
				}
				else
				{
					echo "<option value=\"$rTemp[0]\">$rTemp[1]</option>";
				}
			}
			?>
			</SELECT>
			</td>
			<!--<td align="center">
			<Select Name="<?=$r[0]?>level">
			<OPTION value=0 selected>-Select-</option>
			<?php
			$levl = "SELECT * FROM dp_levels ORDER BY id";
			$levl1 = execute($levl);

			$num1 = rowcount($levl1);
			for($j=0; $j<$num1; $j++)
			{
				$levnm = fetcharray($levl1,$j);
				if( $levnm[0] == $r[9])
				{
					echo "<option value=\"$levnm[id]\" selected>$levnm[level_name]</option>";
				}
				else
				{
					echo "<option value=\"$levnm[id]\">$levnm[level_name]</option>";
				}
			}
			?>
			</SELECT>
			</td>-->
			
			<td class="CBody" align="center">
			<?
			$sel="";
			if(  $r[5]=='Y')
			{
				$sel="checked";
			}
			?>
			<Input Type="checkbox" Name="<?=$r[0]?>elective"  <?=$sel?> >
			</td>
			<td class="CBody" align='center'>
			<Input Type="text" name="<?=$r[0]?>pre" size=3 maxlength=3 value="<?=$r[8]?>" onKeyDown="return checkInt(event)">
			</td>
			</tr>
			<?php
		}
		?>
		<tr height='40'><td colspan=8 align=center>
		<Input type="submit" Name="Modify" value="Modify"  class='bgbutton'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Input type="submit" Name="Delete" value="Delete"  class='bgbutton'> </td></tr>
		<?php
	}
		?>
			
</form>
</BODY>
</HTML>