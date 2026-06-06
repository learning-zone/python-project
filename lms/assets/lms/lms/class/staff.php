<html>
<head>
<script>
function reloadme()
	{
		document.frm.action="staff.php";
		document.frm.submit();
	}
</script>
</head>
 <?php
	session_start();
	include("../../db.php");
	//print_r($_GET);
	
	$accyear=$_SESSION['AcademicYear'];
	$pfdate=$_REQUEST['pfdate'];
	$ptdate=$_REQUEST['ptdate'];
	
	$manager=$_POST['manager'];
	
	?>
  <?
if($_POST['save'])
{
	$manager=$_POST['manager'];
	
	for($j=0;$j<sizeof($manager);$j++)
	{
		$coacid=$manager[$j];
			
		$Sql66=execute("select `id` from `staff_leave_notify` where `user`='$user' and `f_date`='$pfdate'  and `t_date`='$ptdate' and `status`=1 and notify_id='$coacid'");
		if(rowcount($Sql66)>0)
		{

			$sql33="update `staff_leave_notify` set notify_id='$coacid' where `user`='$user' and `f_date`='$pfdate'  and `t_date`='$ptdate' and `status`=1";
			execute($sql33);
		}
		else
		{
			
			execute("INSERT INTO `staff_leave_notify` (`user`, `notify_id`, `f_date`, `t_date`, `acc_year`, `status`) VALUES ('$user','$coacid','$pfdate','$ptdate','$accyear','1')");
		}
		
	}
	 ?>
         <script language="javascript">
		 alert("Updated Sucessfully");
         </script>
         <?php
}
?>  
<body>
<form Name="frm"  method="post">     
<input type="hidden" name="pfdate" value="<?=$pfdate?>"/>
<input type="hidden" name="ptdate" value="<?=$ptdate?>"/>
<div style="overflow: auto;height:350px; width:350px;" align="center">
  <?php
	if($sem=='0' or $sem=='')
	die();
   $sql123.="select id,student_id,first_name,last_name,admission_id from student_m where id is not null and archive='N' and academic_year='$academic_year' ";
	
	if($sem!=0)
	{
	$sql123.=" and course_yearsem=$sem";
	}
	if($class_section_id!='')
	{
	$sql123.=" and class_section_id=$class_section_id  ";
	}
	
	$sql123.=" order by first_name";
	
	$rs=execute($sql123) or die(mysql_error());
  ?>  <table width="50%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr height="25">
    <td width="10%" class="head">Sl No.</td>
    <td width="40%" align="center" class="head">Name</td>
    <td width="20%" align="center" class="head">Student Id</td>
    <!--<td width="23%" align="center">Action</td>-->
    <td width="7%" align="center" class="head" nowrap><div id="checkAll" onMouseOver="this.style.backgroundColor='blue';
this.style.cursor='hand';this.style.color='white'"
onMouseOut="this.style.backgroundColor='';this.style.cursor='default';this.style.color='black'"
onClick="selectMe()" Title="Click to Select all Students"><b>Select All</b></div></td>

  </tr>
  <?php
  $i=1;
  while($r1=fetcharray($rs))
  { 

$sql5=execute("select id from $tablename where acc_year='$temp_year_detalis' and stu_id='$r1[id]' and sub='$sess' and sub_sec='$class_section'");
  $checkiddet=fetchrow($sql5);
  if($checkiddet[0]!='' or $checkiddet[0]!=0)
  $statuschek='checked';
  else
  $statuschek='';
  echo "<tr>
    <td nowrap>&nbsp;$i</td>
    <td nowrap>&nbsp;$r1[first_name] $r1[last_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>
    ";
	?>
	  <td align="center">
	<input type="checkbox" name="check[]" value="<?php echo $r1[id]; ?>" <?php echo $statuschek; ?> >
    <input type="hidden" name="studentid[]" value="<?php echo $r1[id]; ?>" >
    </td>
  </tr><?php
$i++;  }
  ?>
  
</table>
</div>
<br>
<div align='center'><input type='submit' name='save' value='Submit' class='bgbutton'></div>
<br>
</form>
</BODY>
</HTML>
