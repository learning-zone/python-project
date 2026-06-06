<?php
session_start();
include("../db.php");
$q=$_GET["q"];
$stuid=$_SESSION['studentsessionid'];
$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$yr3=$yr-2;
		$mon=date('m');
		$dat=date('d');
		$y11=$yr.'-04-01';
		$y12=$yr.'-03-31';
		$y21=$yr1.'-04-01';
		$y22=$yr1.'-03-31';
		$y31=$yr2.'-04-01';
		$y32=$yr2.'-03-31';
		$y33=$yr3.'-04-01';
		if($mon>3)
		{
			
			
$qryy1="select * from ac_ledger where iIdx_organization=\"$q\" and vledger like \"$stuid%\"";
$result = execute($qryy1);
$r=fetchrow(execute("select * from ac_ledger where iIdx_organization=\"$q\" and vledger like \"$stuid%\""));
}
else
{
$qryy1="select * from ac_ledger where iIdx_organization=\"$q\" and vledger like \"$stuid%\"";
$result = execute($qryy1);
$r=fetchrow(execute("select * from ac_ledger where iIdx_organization=\"$q\" and vledger like \"$stuid%\""));
}
if($r<=0)
{
echo "<select name=lisled><option value=0>Empty</option></select>";
}
else
{
 echo "<select name='lisled'><option value='select'>-SELECT-</option>";
while($row = fetcharray($result))
  {
 echo "<option value='".$row['vledger']."'>".$row[vledger]."</option>";
  }
  echo "</select>";
}
?>
