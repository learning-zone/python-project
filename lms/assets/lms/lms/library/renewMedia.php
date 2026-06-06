<?php
require_once("../db.php");
$medtyp=$_POST['medtyp'];
$tmid=$_POST['tmid'];
$library=$_POST['library'];
$media=$_POST['media'];
$eligible=$_POST['eligible'];
$issued=$_POST['issued'];
$sel=$_POST['sel'];
$n_due_date=$_POST['n_due_date'];
$idate=$_POST['idate'];
$accno=$_POST['accno'];
$mno = $_POST['mno'];
$flag = $_POST['flag'];

$curdt=date("Y-m-d");

$q=fetcharray(execute("select s_id,type from lib_membership_m where m_no='$mno'"));
//echo "select s_id,type from lib_membership_m where m_no='$mno'";
//die();
if($q[type]==1)
{
	$q1=fetcharray(execute("select course_admitted from student_m where id='$q[s_id]'"));
	$q2=execute("select renewals,dys from cir_parameter where member='$q[type]' and course='$q1[0]' and media='$media'");
	if(rowcount($q2)==0)
		$q2=execute("select renewals,dys from cir_parameter where member='$q[type]' and course='0' and media='$medtyp'");
		//echo "select renewals,dys from cir_parameter where member='$q[type]' and course='0' and media='$media'";
	$q3=fetcharray($q2);
	$mren=$q3[0];
	$dys=$q3[1];
}
else
{
	$q1=fetcharray(execute("select subj from staff_det where id='$q[s_id]'"));
	$q2=execute("select renewals,dys from cir_parameter where member='$q[type]' and department='$q1[0]' and media='$media'");
	if(rowcount($q2)==0)
		$q2=execute("select renewals,dys from cir_parameter where member='$q[type]' and department='0' and media='$media'");
	$q3=fetcharray($q2);
	$mren=$q3[0];
	$dys=$q3[1];
}

while( list(,$Value) = each($sel) )
{
	//echo "inside <br>";
	//echo "select renews,due_date from lib_circulation_m where id=$Value";
	$qry = fetcharray(execute("select renews,due_date from lib_circulation_m where id='$Value'"));
	$curren=$qry[0];
	
		
	
	//echo " max : ".$mren;
	if($curren<$mren)
	{
		$cren=$curren+1;
		$d=explode("-",$qry[due_date]);
		$MyDay=$d[2];
		$MyMonth=$d[1];
		$MyYear=$d[0];
		$udate= date(" Y-m-d",mktime(0,0,0,$MyMonth,$MyDay+$dys,$MyYear));
		//$var3 = "update lib_circulation_m set due_date='$udate',renews='$cren',ren_date='$curdt' where id=$Value ";
		$var3 = "update lib_circulation_m set due_date='$udate',renews='$cren',issue_date='$curdt' where id=$Value ";
		//echo $var3; 
		//die();
		$res3 = execute($var3) or die(mysql_error());
		?>
	<html>
      <head>
        <script language="javascript">
		alert("Renewed successfully, please return on <?PHP echo $udate?> !!!");
		</script>
        <?php
		
		$flag=10;
		
	}
	else
	{
		?>
        <script language="javascript">
		alert("Crossed Maximum renewals !!!");
		</script>
        <?php
		$flag=9;
		break;
	}
}
 echo "<META HTTP-EQUIV='Refresh' Content='0;URL=lib.php?medtyp=$medtyp&tmid=$tmid&library=$library&media=$media&flag=$flag'>";
//header("Location:lib.php?medtyp=$medtyp&tmid=$tmid&library=$library&media=$media&flag=$flag");
?>
   <!-- <script language="JavaScript">
    function reload1()
    {
		<?php
		$library=1;
		?>
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