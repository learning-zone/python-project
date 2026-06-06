<?php
session_start();
require_once("../db.php");
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
$sel=$_POST['sel'];
$tmid=$_POST['tmid'];
$media=$_POST['media'];
$idate=$_POST['idate'];
$accno=$_POST['accno'];
$flag = $_POST['flag'];
$medtyp=$_POST['medtyp'];
$issued=$_POST['issued'];
$library=$_POST['library'];
$eligible=$_POST['eligible'];
$n_due_date=$_POST['n_due_date'];

$ret_date = date("Y-m-d");

	while( list(,$Value) = each($sel))
	{
		$qry = fetcharray(execute("select * from lib_circulation_m where id=$Value"));
		
		$fineamt = $_POST["fine".$Value];
		$sqlUpdate = "UPDATE lib_circulation_m SET status=1,returned='Yes',ret_to='$user',return_date='$ret_date',fineamt='$fineamt' WHERE id='$Value'";
	
		$resUpdate = execute($sqlUpdate);
		
		$sqlInsert = "insert into lib_circulation_r select * from lib_circulation_m WHERE id='$Value'";	
		$resInsert = execute($sqlInsert);
		
		$sqlDelete = "delete from lib_circulation_m WHERE id='$Value'";
	    $resDelete = execute($sqlDelete);
	   
		if($qry[media_type]==1)
		{
				$var3="update lib_acc_details set flag=0 where acc_no='$qry[acc_id]' and library='$library'";
				$res3=execute($var3) or die(mysql_error());
		}
		if($qry[media_type]==2 || $qry[media_type]==4)
		{
				$var4="update lib_cd_acc_det set flag=0 where acc_no='$qry[acc_id]' and media_type='$qry[media_type]' and library='$library' ";
				$res4=execute($var4) or die(mysql_error());
		}
		if($qry[media_type]==5)
		{
				$var6="update lib_proj_acc_det set flag=0 where acc_no='$qry[acc_id]' and library='$library'";
				$res6=execute($var6) or die(mysql_error());
		}	
	}
     echo "<META HTTP-EQUIV='Refresh' Content='0;URL=lib.php?medtyp=$medtyp&tmid=$tmid&library=$library&media=$media&flag=8'>";
	//header("Location:lib.php?medtyp=$medtyp&tmid=$tmid&library=$library&media=$media&flag=8");

?>
<!--
<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="lib.php?medtyp=<?php echo $medtyp; ?>&tmid=<?php echo $tmid; ?>&library=<?php echo $library; ?>&media=<?php echo $media; ?>&flag=<?php echo $flag; ?>";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>-->