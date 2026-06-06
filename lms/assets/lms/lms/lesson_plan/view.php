<?php
session_start();
include("../db.php");

$accyeardet=$_SESSION['AcademicYear'];
$class=$_REQUEST['class'];
$sub=$_REQUEST['sub'];
$imge=$_REQUEST['imge'];
$subject=$_REQUEST['subject'];
$priority=$_POST['priority'];
$title_a=$_POST['title_a'];
$title_b=$_POST['title_b'];
$title_c=$_POST['title_c'];
$lp_no=$_POST['lp_no'];
$imagepath=$_POST['imagepath'];
?>
<html>
<head>
<script>
function goBack()

  {

  window.history.back()

  }

</script>
</head>
<body>
<p><input type="button"  class="bgbutton" value="Back" onClick="goBack()">

</p>

  <?php

$sql3=execute("select titleimage from  lms_stud where id='$imge'");

	while($r6=fetcharray($sql3))
	{
		
				$img=explode('/',$r6[0]);
				$name=$img[1].$img[2];

	?><div align='center'>
	<iframe src="http://docs.google.com/gview?url=http://mbis.myschoolone.com/renew/lesson_plan/menuimage/<?=$name?>&embedded=true" style="width:900px; height:600px;" frameborder="0"></iframe
></div>
   	<?php
}

?>	
</form>
</body>
</html>