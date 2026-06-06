<?php
	session_start();
	include("../db1.php");
	$username=$_POST['username'];
	$user=$_SESSION['user'];
	$flag=$_POST['flag'];
	$id=$_POST['id'];
	$userid=$_POST['userid'];
	$course=$_POST['course'];
	$subject_type=$_POST['subject_type'];
	$section=$_POST['section'];
	$batch_type=$_POST['batch_type'];
	$sem=$_POST['sem'];
	$StaffName=$_POST['StaffName'];
	$check_id=$_POST['check_id'];
?>

<?php
while( list(,$Value) = each($check_id) )
{
	$MyID=explode("-",$Value);
	$CourseId=$course;
	$SubjectId=$MyID[1];
	$YearId=$MyID[2];
	$SubjectType=$MyID[3];
	$class_section=$MyID[4];
	$batch_id=$MyID[5];
	$major_id=$MyID[6];
	if($major_id=="")
		$major_id=0;

	$query  = "SELECT S_ID FROM users WHERE username='$StaffName' AND id='$userid'";
	$rs = execute($query) or die("QUERY $query ");
	$row = fetcharray($rs);
	$staff_id1 = $row["S_ID"];
	if($CourseId=="")
	{
		$CourseId=0;
	}
	mysql_free_result($rs);

	$sql3="select * from staff_rights where staff_id='$userid' and subject_id='$SubjectId'";
	$sql3.=" and course_id='$CourseId' and year_id='$YearId' and subject_type='$SubjectType' and class_section_id='$class_section' and batch_id='$batch_id' and maj_id='$major_id'";
	$rs3=execute($sql3);
		$sql  = "INSERT INTO staff_rights(staff_id,subject_id,course_id,year_id,subject_type, ";
		$sql .= "class_section_id,batch_id, StaffID,maj_id) VALUES('$userid','$SubjectId','$CourseId', ";
		$sql .= "'$YearId','$SubjectType','$class_section','$batch_id','$staff_id1','$major_id')" ;
		execute($sql);
		
	
}
$tempvalll="AddRightsToStaff.php?flag=$flag&&id=$id&&userid=$userid&&course=$course&&subject_type=$subject_type&&section=$section&&batch_type=$batch_type&&sem=$sem&&StaffName=$StaffName&&check_id=$check_id&&username=$username";

?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1(strdet)
	{
		alert("User rights Updated successfully ");
		document.form1.action=strdet;
		document.form1.submit();
	}
</script>
</head>
<?php
$tempvall="reload1('$tempvalll')";
echo '<body onLoad='."$tempvall".' >';
 
 ?>
 <form name="form1" method="post">
     </form>
     </body>
     </html>
