<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$dt1 = isset($_REQUEST["date31"]) ? $_REQUEST["date31"] : "";
$dt2 = isset($_REQUEST["date32"]) ? $_REQUEST["date32"] : "";
$tp=$_SESSION['type'];
$org=$_SESSION['org'];
$ordep=$_POST['ordep'];
if($ordep==1)
{
if($tp=='a')
{
$or1=$_POST['cmbin'];

}
else
{
$or1=$_SESSION['ior'];
}
}
if($ordep==2)
{
$dep=$_POST['cmbdep'];
$or1=$_POST['cmbin'];
}
include("../db.php");
$_SESSION['bdt7']=$dt1;
$_SESSION['bdt8']=$dt2;
$dtt=date('d-m-Y',strtotime($dt2));
//echo $dtt;
//echo $dt2;
//$ledger=$_POST['lisled'];
$qq=execute("select * from ac_institution where vinstitution=\"$dep\"");
$b1=mysql_fetch_object($qq);
$qq8=execute("select vorgname from ac_organization where iIdx_organization=\"$or1\"");
$b2=fetchrow($qq8);
$qry=execute("select * from ac_voucher where ddate between \"$dt1\" and \"$dt2\" and acc<>\"$ledger\" and iIdx_institution=\"$b1->iIdx_institution\"");
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
	
	//echo $or1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
	<link href="calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar.js"></script>
<script language="javascript" src="calendar1.js"></script>
<script language="javascript">
function validate()
{
if(document.form1.cmbin.value=="SELECT")
{
window.alert("Select Institution");
return false;
}
}
</script>
<script type="text/javascript" src="scripts/jquery.min.js"></script> 
<script type="text/javascript" src="scripts/jquery.hoveraccordion.min.js"></script> 
	<script>
	$(document).ready(function(){
	$('#identifier').hoverAccordion();
	});
	</script>
</head>

<body>
  <div id="wrapper">
    
    <div id="header">
     
      <div id="cart">
        
           
              <p align="left">&nbsp;</p>
              <p align="left">Welcome <?php echo $name."   "?>, <a href="logout.php">Logout</a></p>
      </div>
	  <div id="logo">
      <h1 >Account Management</h1>
     </div>
    </div>
    <div id="body">
      <?php
	if($tp=='u')
	{
	include("usermenu.php");
	  }
	  else
	  {
	 include("adminmenu.html");
	  }
	  ?>
      <div id="seasonal">
        <div class="inner">
          <form id="form1" name="form1" method="post" action="exporttrialbalance.php">
            <table width="637" border="1" style="position:absolute; left: 212px; top: 146px; width: 721px; height: 132px;" id="tbl">
              <tr id="td1">
                <td colspan="7" id="th"><a href="index.html"></a>
                  <div align="center" class="style5"><span class="style1"><strong>TRIAL BALANCE </strong></span></div></td>
      </tr>
	    <?php if($ordep==1)
{?>
 <tr id="td1">
              <td width="171"><strong>ORGANIZATION</strong></td>
        <td colspan="6"><?php echo $b2[0];?>&nbsp;</td>
      </tr>
<?php } else {?> 
              <tr id="td1">
              <td width="171"><strong>DEPARTMENT</strong></td>
        <td colspan="6"><?php echo $dep;?>&nbsp;</td>
      </tr><?php }?>
              <tr id="td1">
                <td colspan="7"><div align="center"><span class="style9"><strong>TRIAL BALANCE AS ON</strong></span> <?php echo $dtt;?></div></td>
      </tr>
              <tr id="td1">
                <td rowspan="2">&nbsp;</td>
        <td colspan="2"><div align="center" class="style7"><strong>Opening Balance </strong></div></td>
        <td colspan="2"><div align="center" class="style7"><strong>Closing Balance </strong></div></td>
      </tr>
              <tr id="td1">
                <td width="197"><div align="center"><strong>Dr</strong></div></td>
        <td width="124"><div align="center"><strong>Cr</strong></div></td>
		
        <td width="157"><div align="center"><strong>Dr</strong></div></td>
        <td width="131"><div align="center"><strong>Cr</strong></div></td>
      </tr>
	  <?php
	  if($ordep==1)
		{
	  ?>
	   <?php
	   $s1=0; $s2=0; $s3=0; $s4=0;
	$yy=execute("select * from ac_voucher where vins=\"$ins\"");
	$qry1=execute("select * from ac_allgroup");
	while($row1=mysql_fetch_assoc($qry1))
	{
	$id1=$row1[iIdx_grp];
	?>
    <tr id="td1">
    
	 
	  <?php
	   echo "<td><b>$row1[vgroupname]&nbsp;</b></td><td></td><td></td><td></td><td></td></tr>";
	  $s=0;$sub1=0;$sub2=0;$sub3=0;$sub4=0;$t1=0;$t2=0; $t3=0;$t4=0; 
	  if($mon>3)
		{
	  $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and  iIdx_organization=\"$or1\" and opdate >= '".$y21."' and opdate <= '".$y32."'");
	  }
	  else
	  {
	   $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and  iIdx_organization=\"$or1\" and opdate >= '".$y33."' and opdate <= '".$y11."'");
	  }
	  while($r5=mysql_fetch_assoc($q6))
	  {
	  $a=$r5[Vledger];
	
	  ?>
	   
	  <?php
	  $q5=execute("select max(iIdx_op) from ac_opbal where opdate<=\"$dt1\" and iIdx_organization=\"$or1\" and Vledger=\"$a\" and iId_grp=\"$id1\"");
	  $r6=fetchrow($q5);
	  $d=$r6[0];
	 
	  //echo $d;
	  $q1=execute("select fopbal from ac_opbal where iId_grp=\"$id1\" and iIdx_op=\"$d\" and iIdx_organization=\"$or1\" and Vledger=\"$a\"");
	  $r7=fetchrow($q1);
	 
	  $s=$s+$r7[0];
	  $q2=execute("select Dr_Cr from ac_opbal where iId_grp=\"$id1\" and opdate<=\"$dt1\" and iIdx_organization=\"$or1\"");
	  $r2=fetchrow($q2);
	  $r1=fetchrow($q1);
	 //echo $r1[0];
	   echo "<tr id=td1><td>$a</td>";
	   
	    if($r7[0]>0){
	  ?>
      <td><?php echo $t1=$r7[0];$r7[0];$sub1=$sub1+$r7[0];?>&nbsp;</td> <td>0.00&nbsp;</td><?php }?>
	  
      <?php
	  if($r7[0]<0){
	 
	  ?>
        <td>0.00&nbsp;</td> <td><?php $sub2=($sub2+$r7[0])*-1;$t2=$r7[0];echo $r7[0]*-1;?>&nbsp;</td><?php }?>
		  <?php
	  if($r7[0]==0){
	 
	  ?>
        <td><?php $sub2=($sub2+$r7[0]);echo $r7[0];$t1=$r7[0];?>&nbsp;</td> <td><?php $sub2=($sub2+$r7[0]);echo $r7[0];$t1=$r7[0];?>&nbsp;</td><?php }?>
		
	 <?php
	  $q3=execute("select sum(fopbal) from ac_ledger where iIdx_group=\"$id1\" and vledger='$a' and iIdx_organization=\"$or1\"");
	  $r3=fetchrow($q3);
	 
	 // echo $r3[0];
	 ?>
	<!--  transaction amount-->
	
	<?php
	$dr="Dr";
	$cr="Cr";
	$dqr=execute("select max(iIdx_op) from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and Dr_Cr='$dr'");
	$dq=fetchrow($dqr);
	//echo $dq[0];
	$ar2=execute("select fopbal from ac_opbal where iIdx_op='$dq[0]'");
	 // echo $r3[0];
	 $ar3=fetchrow($ar2);
	 //echo $ar3[0];
	 $dqr1=execute("select max(iIdx_op) from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and Dr_Cr='$dr'");
	$dq1=fetchrow($dqr1);
	//echo $dq[0];
	$ar21=execute("select fopbal from ac_opbal where iIdx_op='$dq1[0]'");
	 // echo $r3[0];
	 $ar31=fetchrow($ar21);
	 
	 
	?>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!--------------------------------->
	 <?php
	  if($r3[0]>0){
	  ?>
       <td><?php $sub3=$sub3+$r3[0];$t2=$r3[0];echo $r3[0];?>&nbsp;</td> <td>0.00&nbsp;</td><?php }?>
      <?php
	  if($r3[0]<0){
	  ?>
       <td>0.00&nbsp;</td> <td><?php $sub4=($sub4+$r3[0])*-1;$t2=$r3[0];echo $r3[0]*-1;?></td><?php }?>
	   <?php
	   if($r3[0]==0){
	  ?>
       <td><?php $sub4=($sub4+$r3[0]);$t2=$r3[0];echo $r3[0];?></td> <td><?php $sub4=($sub4+$r3[0]);$t2=$r3[0];echo $r3[0];?></td><?php }?>
	 
    </tr>
		
	  <?php
	   
	  }
	 
	  ?>
     
    
	
	  
	  <?php
	  if($sub1!=0 || $sub2!=0 || $sub3!=0 || $sub4!=0)
	  {
	  $sub11=number_format($sub1,2); $sub22=number_format($sub2,2); $sub33=number_format($sub3,2); $sub44=number_format($sub4,2);
	  echo "<tr id=td1><td><div align=right>Subtotal:</div></td><td><b>$sub11</b></td><td><b>$sub22</b></td><td><b>$sub33</b></td><td><b>$sub44</b></td></tr>";
	$s1=$s1+$sub1;$s2=$s2+$sub2;$s3=$s3+$sub3;$s4=$s4+$sub4;
	$s11=number_format($s1,2);$s22=number_format($s2,2);$s33=number_format($s3,2);$s44=number_format($s4,2);
	}
	  }
	 echo "<tr id=td1><td><div align=right><b>Grand Total:<b></div></td><td><b>$s11</b></td><td><b>$s22</b></td><td><b>$s33</b></td><td><b>$s44</b></td></tr>";
	  }
	  if($ordep==2)
	  {
	  ?>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	   <?php
	   $s1=0; $s2=0; $s3=0; $s4=0;
	$yy=execute("select * from ac_voucher where vins=\"$ins\"");
	$qry1=execute("select * from ac_allgroup");
	while($row1=mysql_fetch_assoc($qry1))
	{
	$id1=$row1[iIdx_grp];
	?>
    <tr id="td1">
    
	 
	  <?php
	   echo "<td><b>$row1[vgroupname]&nbsp;</b></td><td></td><td></td><td></td><td></td></tr>";
	  $s=0;$sub1=0;$sub2=0;$sub3=0;$sub4=0; 
	  if($mon>3)
		{
	  $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\"   and opdate >= '".$y21."' and opdate <= '".$y32."'");
	  }
	  else
	  {
	   $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\"   and opdate >= '".$y33."' and opdate <= '".$y11."'");
	  }
	  
	  while($r5=mysql_fetch_assoc($q6))
	  {
	  $a=$r5[Vledger];
	$q98=execute("select count(*) from ac_opbal where iId_grp=\"$id1\" and  vins=\"$dep\"  and Vledger=\"$a\" and opdate >= '".$y33."' and opdate <= '".$y11."'");
	$nm=rowcount($q98);
	  ?>
	   
	  <?php
	 // echo $or1;
	  $q5=execute("select min(iIdx_op) from ac_opbal where opdate<=\"$dt1\" and Vledger=\"$a\" and iId_grp=\"$id1\"");
	  $r6=fetchrow($q5);
	  $d=$r6[0];
	 
	  //echo $d;
	  $q1=execute("select fopbal from ac_opbal where iId_grp=\"$id1\" and iIdx_op=\"$d\"   and Vledger=\"$a\" ");
	  $r7=fetchrow($q1);
	//echo $r7[0];
	  $s=$s+$r7[0];
	  $q2=execute("select Dr_Cr from ac_opbal where iId_grp=\"$id1\" and opdate<=\"$dt1\"  and  vins=\"$dep\"");
	  $r2=fetchrow($q2);
	  $r1=fetchrow($q1);
	// echo $r7[0];
	
	   echo "<tr id=td1><td>$a</td>";
	    if($r7[0]>0){
	  ?>
      <td><?php echo $r7[0];$sub1=$sub1+$r7[0];?>&nbsp;</td> <td>0.00&nbsp;</td><?php }?>
	  
      <?php
	  if($r7[0]<0){
	 
	  ?>
        <td>0.00&nbsp;</td> <td><?php $sub2=($sub2+$r7[0])*-1;echo $r7[0]*-1;?>&nbsp;</td><?php }?>
		 <?php
	  if($r7[0]==0){
	 
	  ?>
        <td><?php $sub2=($sub2+$r7[0]);echo $r7[0];?>&nbsp;</td> <td><?php $sub2=($sub2+$r7[0]);echo $r7[0];?>&nbsp;</td><?php }?>
	 <?php
	  $q3=execute("select max(iIdx_op) from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and vins='$dep'");
	  $r3=fetchrow($q3);
	  if($r3[0]=="")
	  {
	   $ar=execute("select fopbal from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_organization='$or1'");
	 // echo $r3[0];
	 $ar1=fetchrow($ar);
	  }
	  else
	  {
	 $ar=execute("select fopbal from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_op='$r3[0]'");
	 // echo $r3[0];
	 $ar1=fetchrow($ar);
	 }
	 ?>
	 
	 <?php
	  if($ar1[0]>0){
	  ?>
       <td><?php $sub3=$sub3+$ar1[0];echo $ar1[0];?>&nbsp;</td> <td>0.00&nbsp;</td><?php }?>
      <?php
	  if($ar1[0]<0){
	  ?>
       <td>0.00&nbsp;</td> <td><?php $sub4=($sub4+$ar1[0])*-1;echo $ar1[0]*-1;?></td><?php }?>
	   <?php
	  if($ar1[0]==0){
	  ?>
       <td><?php $sub4=($sub4+$ar1[0]);echo $ar1[0];?>&nbsp;</td> <td><?php $sub4=($sub4+$ar1[0]);echo $ar1[0];?></td><?php }?>
	  
    </tr>
	  <?php
	   
	  }
	 
	  ?>
     
    
	
	  
	  <?php
	  if($sub1!=0 || $sub2!=0 || $sub3!=0 || $sub4!=0)
	  {
	  $sub11=number_format($sub1,2); $sub22=number_format($sub2,2); $sub33=number_format($sub3,2); $sub44=number_format($sub4,2);
	  echo "<tr id=td1><td><div align=right>Subtotal:</div></td><td><b>$sub11</b></td><td><b>$sub22</b></td><td><b>$sub33</b></td><td><b>$sub44</b></td></tr>";
	$s1=$s1+$sub1;$s2=$s2+$sub2;$s3=$s3+$sub3;$s4=$s4+$sub4;
	$s11=number_format($s1,2);$s22=number_format($s2,2);$s33=number_format($s3,2);$s44=number_format($s4,2);
	}
	  }
	 echo "<tr id=td1><td><div align=right><b>Grand Total:<b></div></td><td><b>$s11</b></td><td><b>$s22</b></td><td><b>$s33</b></td><td><b>$s44</b></td></tr>";
	  ?>
	  <?php
	  }
	 
	  ?>
	  
            
	  

              <tr>
                <td colspan="9"><div align="right" id="tbl"><?php /*?><input name="button" type='button' onclick='javascript:window.location.href=&quot;exporttrialbalance.php&quot;' value='Export' /><?php */?></div>&nbsp;</td>
        </tr>
            </table>
  </form>	
            <h2>&nbsp;</h2>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
  
          <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
		    <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p> <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p> <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p> <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p>
			   <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p> <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p> <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p> <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p> <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><strong> </strong></p>
            <p></p><br/><br/><br/><br/><br/><br/><br/>
          <p></p>
                    
        </div>
      </div>
        
      <div class="clear"> </div>
        <div id="seas">
          
          <div class="clear"> </div>
        </div>
    </div><div id="copyright">
      <p>All rights reserved</p>
    </div>
  </div>
</body>
</html>

