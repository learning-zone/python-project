<html>
<head>
<?php
require("../db.php");
?>
</head>
<body>
<?php
/*
Copyright  © 
*/
$student_len=sizeof($sel);
$batch_len=sizeof($batch);
for($i=0;$i<$student_len;$i++)
{
	$student_id=$sel[$i];
	$batch_id=$batch;
	$qry="select * from batch_det where student_id='$student_id' and batch_id=$batch and subject_id=$subj";
	$rs=mysql_query($qry);
	if(rowcount($rs)==0)
	{
		$sql="insert into batch_det (student_id,batch_id,subject_id) values('$student_id',$batch,$subj)";
		mysql_query($sql);
	}
}
?>
<br>
<div align='center'><b>Batch are applied succesfully.</b>
<a href="viewbatchformlist.php?course=<?=$course?>&sem=<?=$sem?>&section=<?=$section?>" > <font color='red'><br><b>Click Here To Go Back.</b></font></a></div>
<!--Message-->
</body>
</html>
