<?php
include("../db.php");
$dt1 = isset($_REQUEST["date31"]) ? $_REQUEST["date31"] : "";
$dt2 = isset($_REQUEST["date32"]) ? $_REQUEST["date32"] : "";
$ins=$_POST['cmbin'];
//echo $dt1;
//echo $dt2;
//$ledger=$_POST['lisled'];
$qq=execute("select * from ac_institution where vinstitution=\"$ins\"");
$b1=mysql_fetch_object($qq);
$qry=execute("select * from ac_voucher where ddate between \"$dt1\" and \"$dt2\" and acc<>\"$ledger\" and iIdx_institution=\"$b1->iIdx_institution\"");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	color: #0066FF;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="637" border="1" style="position:absolute; left: 69px; top: 44px; width: 1120px;" bgcolor="#CCCCCC">
    <tr>
      <td colspan="7"><a href="index.html">Home </a><div align="center"><span class="style1">TRIAL BALANCE </span></div></td>
    </tr>
    <tr>
      <td width="171"><strong>Institution</strong></td>
      <td colspan="6"><?php echo $ins;?>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7"><div align="center">TRIAL BALANCE AS ON <?php echo $dt2;?></div></td>
    </tr>
    <tr>
      <td rowspan="2">&nbsp;</td>
      <td colspan="2"><div align="center"><strong>Opening Balance </strong></div></td>
      <td colspan="2"><div align="center"><strong>Closing Balance </strong></div></td>
    </tr>
    <tr>
      <td width="197"><div align="center"><strong>Dr</strong></div></td>
      <td width="124"><div align="center"><strong>Cr</strong></div></td>
      <td width="157"><div align="center"><strong>Dr</strong></div></td>
      <td width="131"><div align="center"><strong>Cr</strong></div></td>
    </tr>
	<?php
	
	$qry1=execute("select * from ac_allgroup");
	while($row1=mysql_fetch_assoc($qry1))
	{
	$id1=$row1[iIdx_grp];
	?>
    <tr>
      <td><?php echo $row1[vgroupname];?>&nbsp;</td>	
	 
	  <?php
	  $s=0;
	  $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and opdate<\"$dt1\" and vins=\"$ins\"");
	  while($r5=mysql_fetch_assoc($q6))
	  {
	  $a=$r5[Vledger];
	  $q5=execute("select max(opdate) from ac_opbal where opdate<\"$dt1\" and vins=\"$ins\" and vledger=\"$a\" and iId_grp=\"$id1\"");
	  $r6=fetchrow($q5);
	  $d=$r6[0];
	  echo $d;
	  $q1=execute("select fopbal from ac_opbal where iId_grp=\"$id1\" and opdate=\"$d\" and vins=\"$ins\" and vledger=\"$a\"");
	  $r7=fetchrow($q1);
	  $s=$s+$r7[0];
	  $q2=execute("select Dr_Cr from ac_opbal where iId_grp=\"$id1\" and opdate<\"$dt1\" and vins=\"$ins\"");
	  $r2=fetchrow($q2);
	  $r1=fetchrow($q1);
	 echo $r1[0];
	 }
	 ?>
	 <?php
	  if($r2[0]=="Dr"){
	  ?>
      <td><?php echo $s;?>&nbsp;</td><?php }else{?> <td><?php echo "0.00";?>&nbsp;</td><?php }?>
	  
      <?php
	  if($r2[0]=="Cr"){
	  ?>
      <td><?php echo $s;?>&nbsp;</td><?php }else{?><td><?php echo "0.00";?>&nbsp;</td><?php }?>
	  <?php
	  $q3=execute("select sum(fopbal) from ac_ledger where iIdx_group=\"$id1\" and vins=\"$ins\"");
	  $r3=fetchrow($q3);
	  $q4=execute("select itype from ac_ledger where iIdx_group=\"$id1\" and vins=\"$ins\"");
	  $r4=fetchrow($q4);
	  ?>
      <?php
	  if($r4[0]=="Dr"){
	  ?>
      <td><?php echo $r3[0];?>&nbsp;</td><?php }else{?> <td><?php echo "0.00";?>&nbsp;</td><?php }?>
      <?php
	  if($r4[0]=="Cr"){
	  ?>
      <td><?php echo $r3[0];?>&nbsp;</td><?php }else{?> <td><?php echo "0.00";?>&nbsp;</td><?php }?>
    </tr>
	<?php
	
	}
	  ?>
  </table>
</form>
</body>
</html>