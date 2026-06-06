<?php
session_start();
include("../db.php");
$user=$_SESSION['user'];
$datedet=date("Y-m-d");
$uploadedfile=$_POST['uploadedfile'];
if($_POST['submit'])
{
	$sql1=mysql_query("select course_yearsem from student_m where username='$user' and archive='N'");
	$r=mysql_fetch_row($sql1);
	
	if($_FILES['uploadedfile']['tmp_name'] != null)
	{
		$directory = "img".$r[0];			
		if (file_exists("../student_images/") == false)
			$dir_created= mkdir("../student_images/",0777);		
		$target_path = basename( $_FILES['uploadedfile']['name']);
		$var = explode(".",$target_path);
		$var3 = $user.".".$var[1];
		$target_path = "../student_images/$directory/".$var3;
	
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
		{
			$nop=execute("update student_m set img_source='$target_path' where  username='$user' and archive='N'");
			?>
			<script language='javascript'>
            alert("Profile picture changed ");
            self.opener.location.reload();
            </script>
			<?php
		}
	}
}
	$sql1=mysql_query("select img_source,first_name, last_name from student_m where username='$user' and archive='N'");
	while($r=mysql_fetch_array($sql1))
	{
		echo $studentame=$r[1]." ".$r[2]."<br>";
		$imgpath=$r[0];
	}
?>
<img src="<?=$imgpath?>"/>
<form name='frm' method='post' ENCTYPE='multipart/form-data' action="">

	<input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' >
<input type="submit" name="submit" value="submit" />
</form>