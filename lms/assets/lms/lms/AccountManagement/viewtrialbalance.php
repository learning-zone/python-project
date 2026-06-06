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
	$yy=execute("select * from ac_voucher where iIdx_organization=\"$or1\"");
	 if($mon>3)
		{
	$qry1=execute("select distinct(Vledger) from ac_opbal where iIdx_organization=\"$or1\" and opdate >= '".$y21."' and opdate <= '".$y32."' ");
	}
	else
	{
	$qry1=execute("select distinct(Vledger) from ac_opbal where iIdx_organization=\"$or1\" and opdate >= '".$y33."' and opdate <= '".$y11."' ");
	}
	while($row1=mysql_fetch_assoc($qry1))
	{
	//$id1=$row1[iIdx_grp];
	$ld=$row1[Vledger];
	?>
	  <tr id="td1">
                <td><b><?php echo $row1[Vledger];?>&nbsp;</b></td>	
	<?php
	 if($mon>3)
				{
				$qw=execute("select max(iIdx_op) from ac_opbal where opdate<=\"$y11\" and iIdx_organization=\"$or1\" and Vledger=\"$ld\"");
	  $r0=fetchrow($qw);
	  }
	  else
	  {
	  $qw=execute("select max(iIdx_op) from ac_opbal where opdate<=\"$y21\" and iIdx_organization=\"$or1\" and Vledger=\"$ld\"");
	  $r0=fetchrow($qw);
	  }
	   $q2=execute("select * from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$ld\" and iIdx_op=\"$r0[0]\"");
	   $rr=mysql_fetch_object($q2);
	   $typ=$rr->Dr_Cr;
	   $q1=execute("select fopbal from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$ld\" and iIdx_op=\"$r0[0]\"");
	  $bal=fetchrow($q1);
	  $b=$bal[0];
	 if($b<0)
	 {
	   $b=$bal[0];
	    $b5=$bal[0]*-1;
	   echo "<td>0.00</td>";
	
	 echo "<td>".number_format($b5)."</td>"; 
	 }
	 if($b>0)
	 {
	   echo "<td>$bal[0]</td>";
	  echo "<td>0.00</td>";
	 }
	 if($b==0)
	 {
	  echo "<td>0.00</td>"; echo "<td>0.00</td>";
	 }
	 /* $amm=$bal[0].$typ;
	   if($typ=="Cr")
	  {
	  $b=$bal[0]*-1;
	  }
	   if($typ=="Dr")
	  {
	  
	  echo "<td>$bal[0]</td>";
	  echo "<td>0.00</td>";}
	   if($typ=="Cr")
	  {
	   echo "<td>0.00</td>";
	
	 echo "<td>$bal[0]</td>"; }
	 
	  if($typ=="")
	  {
	   echo "<td>0.00</td>"; echo "<td>0.00</td>";
	  }*/
	  
	?>
	<!--CLOSING BALANCE-->
	 <?php
	$s=0;$td=0;$tw=0;
	$sq1=execute("select * from ac_voucher where ddate between \"$dt1\" and \"$dt2\" and acc=\"$ld\" and iIdx_organization=\"$or1\" order by(ddate)");
	while($row1=mysql_fetch_assoc($sq1))
	{
	$ids=$row1[vvoucherno];
	$sq2=execute("select * from ac_voucher where ddate between \"$dt1\" and \"$dt2\" and acc<>\"$ld\" and vvoucherno=\"$ids\" and iIdx_organization=\"$or1\" order by(ddate)");
	while($row2=mysql_fetch_assoc($sq2))
	{
	if($row2[Dr_Cr]=="Cr"){$s=$s+$row2[fcredit]+$b;}if($row2[Dr_Cr]=="Dr"){$s=$s-$row2[fdebit]+$b;}
	 $dtd=date('d-m-Y',strtotime( $row2[ddate]));
	 if($row2[Dr_Cr]=="Cr"){$td=$td+$row2[fcredit];}if($row2[Dr_Cr]=="Dr"){$tw=$tw+$row2[fdebit];}
	?>
	
	
	
	
	
	
            
	   <?php
	   $s=$s-$b;
	}
	}
	$tb=$b+$td-$tw;
	//echo $tb;
	if($tb>0) {$aa1=number_format($tb,2);echo "<td>$aa1</td>";echo "<td>0.00</td>";}else { if($tb<0){ $aa1=number_format(($tb*-1),2);echo "<td>0.00</td>";echo "<td>$aa1</td>"; }else{echo "<td>0.00</td>";echo "<td>0.00</td>";}}
	     }
	?>
	 </tr>
	  
	  <?php
	  }
	  else
	  {
	  
	  
	  $yy=execute("select * from ac_voucher where iIdx_institution=\"$dep\"");
	 if($mon>3)
		{
	$qry1=execute("select distinct(Vledger) from ac_opbal where  opdate >= '".$y21."' and opdate <= '".$y32."' and  iIdx_organization=\"$or1\" or vins=\"$dep\"");
	}
	else
	{
	$qry1=execute("select distinct(Vledger) from ac_opbal where  opdate >= '".$y33."' and opdate <= '".$y11."' and  iIdx_organization=\"$or1\" or vins=\"$dep\"");
	}
	while($row1=mysql_fetch_assoc($qry1))
	{
	//$id1=$row1[iIdx_grp];
	$ld=$row1[Vledger];
	?>
	  <tr id="td1">
                <td><b><?php echo $row1[Vledger];?>&nbsp;</b></td>	
	<?php
	 if($mon>3)
				{
				$qw=execute("select max(iIdx_op) from ac_opbal where opdate<=\"$y11\" and iIdx_organization=\"$or1\" and Vledger=\"$ld\"");
	  $r0=fetchrow($qw);
	  }
	  else
	  {
	  $qw=execute("select max(iIdx_op) from ac_opbal where opdate<=\"$y21\" and iIdx_organization=\"$or1\" and Vledger=\"$ld\"");
	  $r0=fetchrow($qw);
	  }
	   $q2=execute("select * from ac_opbal where  iIdx_op=\"$r0[0]\"");
	   $rr=mysql_fetch_object($q2);
	   $typ=$rr->Dr_Cr;
	   $q1=execute("select fopbal from ac_opbal where  iIdx_op=\"$r0[0]\"");
	  $bal=fetchrow($q1);
	  $b=$bal[0];
	 if($b<0)
	 {
	   $b=$bal[0];
	    $b5=$bal[0]*-1;
	   echo "<td>0.00</td>";
	
	 echo "<td>".number_format($b5)."</td>"; 
	 }
	 if($b>0)
	 {
	   echo "<td>$bal[0]</td>";
	  echo "<td>0.00</td>";
	 }
	 if($b==0)
	 {
	  echo "<td>0.00</td>"; echo "<td>0.00</td>";
	 }
	 /* $amm=$bal[0].$typ;
	   if($typ=="Cr")
	  {
	  $b=$bal[0]*-1;
	  }
	   if($typ=="Dr")
	  {
	  
	  echo "<td>$bal[0]</td>";
	  echo "<td>0.00</td>";}
	   if($typ=="Cr")
	  {
	   echo "<td>0.00</td>";
	
	 echo "<td>$bal[0]</td>"; }
	 
	  if($typ=="")
	  {
	   echo "<td>0.00</td>"; echo "<td>0.00</td>";
	  }*/
	  
	?>
	<!--CLOSING BALANCE-->
	 <?php
	$s=0;$td=0;$tw=0;
	$sq1=execute("select * from ac_voucher where ddate between \"$dt1\" and \"$dt2\" and acc=\"$ld\" and iIdx_institution=\"b1->vinstitution\" order by(ddate)");
	while($row1=mysql_fetch_assoc($sq1))
	{
	$ids=$row1[vvoucherno];
	$sq2=execute("select * from ac_voucher where ddate between \"$dt1\" and \"$dt2\" and acc<>\"$ld\" and vvoucherno=\"$ids\" and iIdx_institution=\"b1->vinstitution\" order by(ddate)");
	while($row2=mysql_fetch_assoc($sq2))
	{
	if($row2[Dr_Cr]=="Cr"){$s=$s+$row2[fcredit]+$b;}if($row2[Dr_Cr]=="Dr"){$s=$s-$row2[fdebit]+$b;}
	 $dtd=date('d-m-Y',strtotime( $row2[ddate]));
	 if($row2[Dr_Cr]=="Cr"){$td=$td+$row2[fcredit];}if($row2[Dr_Cr]=="Dr"){$tw=$tw+$row2[fdebit];}
	?>
	
	
	
	
	
	
            
	   <?php
	   $s=$s-$b;
	}
	}
	$tb=$b+$td-$tw;
	//echo $tb;
	if($tb>0) {$aa1=number_format($tb,2);echo "<td>$aa1</td>";echo "<td>0.00</td>";}else { if($tb<0){ $aa1=number_format(($tb*-1),2);echo "<td>0.00</td>";echo "<td>$aa1</td>"; }else{echo "<td>0.00</td>";echo "<td>0.00</td>";}}
	     }
	?>
	 </tr>
	  
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

