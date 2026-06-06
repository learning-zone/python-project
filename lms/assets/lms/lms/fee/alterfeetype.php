<?php
session_start();
require("../db.php");

if(strtoupper($_REQUEST[Types]) == "ADD")
{
	$feename=$_POST['feename'];
	$sql=execute("select fee_id from fee_type where fee_name='".addslashes($feename)."' ");
	if(rowcount($sql)>0)
	{
		$msg="Duplicate Fee Name not allowed ...!!";
		$act=1;
	}
	$refund=$_POST['refund'];
	$ftype=$_POST['ftype'];
	$sql1="insert into fee_type (fee_name,refund,ftype) values ('".addslashes($feename)."',$refund,$ftype)";
	execute($sql1);
	
	$feesql=fetcharray(execute("select max(fee_id) from fee_type"));
	$feeid=$feesql[0];
	execute("alter table fee_dmd add column T1dmd".$feeid." int(10) default 0 ") ;
	execute("alter table fee_dmd add column T2dmd".$feeid." int(10) default 0 ") ;
	execute("alter table fee_dmd add column T3dmd".$feeid." int(10) default 0 ") ;
	execute("alter table fee_payment add column pd".$feeid." int(10) default 0 ") ;
	$msg="Fee details inserted..";
	$act=1;
}
elseif(strtoupper($_REQUEST[Types]) == "MOD")
{
	$fid=$_POST['fid'];
	while(list(,$value) = each($fid))
	{
		$fname=$_POST['fName'.$value];
		
		$refund=$_POST['refund'.$value];
	
		$ftype=$_POST['ftype'.$value];

		$sql=execute("select fee_id from fee_type where fee_name='".addslashes($fname)."' and  refund=$refund and ftype=$ftype");
		if(rowcount($sql)>0)
		{
			$msg="Duplicate Fee details ...!!";
		}
		$sql1="update fee_type set fee_name='".addslashes($fname)."',refund=$refund,ftype=$ftype where fee_id=$value";
		execute($sql1);
		$msg="Fee details updated..";
		$act=2;
	}
}
elseif(strtoupper($_REQUEST[Types]) == "ACT")
{
	$dfname=$_POST['dfname'];
	while(list(,$value) = each($dfname))
	{
		$sql = "UPDATE fee_type set status=1 where fee_id = $value";
		execute($sql);
	}
}
elseif(strtoupper($_REQUEST[Types]) == "DEL")
{
	$fid=$_POST['fid'];
	while(list(,$value) = each($fid))
	{
		$sql = "UPDATE fee_type set status=0 where fee_id = $value";
		execute($sql);
	}
}
header("Location: feetypeadd.php?act=$act&msg=$msg");
?>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="feetypeadd.php?act=<?php echo $act; ?>&msg=<?php echo $msg; ?>";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>