<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$dt1 = isset($_REQUEST["date31"]) ? $_REQUEST["date31"] : "";
$dt2 = isset($_REQUEST["date32"]) ? $_REQUEST["date32"] : "";
$tp=$_SESSION['type'];
$org=$_SESSION['org'];
include("../db.php");
$_SESSION['bdt7']=$dt1;
$_SESSION['bdt8']=$dt2;
$ins=$_SESSION['ins'];
if($tp=='a')
{
$ins=$_POST['cmbin'];
}
$_SESSION['ins']=$ins;
$dtt=date('d-m-Y',strtotime($dt2));
//echo $dtt;
//echo $dt2;
//$ledger=$_POST['lisled'];
$qq=execute("select * from ac_institution where vinstitution=\"$ins\"");
$b1=mysql_fetch_object($qq);
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
              <tr id="td1">
                <td width="171"><span class="style7"><strong>DEPARTMENT</strong></span></td>
                <td colspan="6"><?php echo $ins;?>&nbsp;</td>
      </tr>
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
	$yy=execute("select * from ac_voucher where vins=\"$ins\"");
	 if($mon>3)
		{
	$qry1=execute("select distinct(Vledger) from ac_opbal where vins=\"$ins\" and opdate >= '".$y21."' and opdate <= '".$y32."' ");
	}
	else
	{
	$qry1=execute("select distinct(Vledger) from ac_opbal where vins=\"$ins\" and opdate >= '".$y33."' and opdate <= '".$y11."' ");
	}
	while($row1=mysql_fetch_assoc($qry1))
	{
	//$id1=$row1[iIdx_grp];
	$ld=$row1[Vledger];
	?>
              <tr id="td1">
                <td><b><?php echo $row1[Vledger];?>&nbsp;</b></td>	
	   
	  <?php
	  $s=0;
	  //date less than april 1st
	   if($mon>3)
		{
	  $qw=execute("select max(iIdx_op) from ac_opbal where opdate<\"$y11\" and vins=\"$ins\" and Vledger=\"$ld\"");
	  $r0=fetchrow($qw);
	  }
	  else
	  {
	   $qw=execute("select max(iIdx_op) from ac_opbal where opdate<\"$y21\" and vins=\"$ins\" and Vledger=\"$ld\"");
	  $r0=fetchrow($qw);
	  }
	  $q1=execute("select fopbal from ac_opbal where vins=\"$ins\" and Vledger=\"$ld\" and iIdx_op=\"$r0[0]\"");
	  $r7=fetchrow($q1);
	  $s=$r7[0];
	  $q2=execute("select Dr_Cr from ac_opbal where iIdx_op=\"$r0[0]\" and vins=\"$ins\"");
	  $r2=fetchrow($q2);
	  $r1=fetchrow($q1);
	  if($r2[0]=="Dr"){
	  ?>
                <td><?php echo number_format($s,2);?>&nbsp;</td><?php }else{?> <td><?php echo "0.00";?>&nbsp;</td><?php }?>
                
                <?php
	  if($r2[0]=="Cr"){
	  ?>
                <td><?php echo number_format($s,2);?>&nbsp;</td><?php }else{?><td><?php echo "0.00";?>&nbsp;</td><?php }?>
			<!--	closing Balance-->
                <?php
				 $qv=execute("select max(iIdx_op) from ac_opbal where vins=\"$ins\" and vledger=\"$ld\" and opdate >= \"$y11\" and opdate <= \"$dt2\"");
	  			 $ry=fetchrow($qv);
				  $q3=execute("select fopbal from ac_opbal where vins=\"$ins\" and Vledger=\"$ld\" and iIdx_op=\"$ry[0]\"");
	  			$r3=fetchrow($q3);
	  			$rs=rowcount($q3);
				 $q4=execute("select Dr_Cr from ac_opbal where iIdx_op=\"$ry[0]\"");
	 			 $r4=fetchrow($q4);
				 If($r4[0]!="")
				 {
					 if($r3[0]>0)
				     {
				?>
				 		<td><?php echo number_format($r3[0],2);?>&nbsp;</td><td>0.00 </td>
						<?php
					 }
					if($r3[0]<0)	
				     {
				?>
				<td>0.00 </td> <td><?php $bv=($r3[0])*-1;echo number_format($bv,2);?>&nbsp;</td>
				<?php
						}
						if($r3[0]==0)	
				     {
				?>
				<td>0.00 </td> <td>0.00&nbsp;</td>
				<?php
						}
				 }
				 else
				 {
				 $s=0;
	  $qw=execute("select max(iIdx_op) from ac_opbal where opdate<\"$y11\" and vins=\"$ins\" and Vledger=\"$ld\"");
	  $r0=fetchrow($qw);
	  $q1=execute("select fopbal from ac_opbal where vins=\"$ins\" and Vledger=\"$ld\" and iIdx_op=\"$r0[0]\"");
	  $r7=fetchrow($q1);
	  $s=$r7[0];
	  $q2=execute("select Dr_Cr from ac_opbal where iIdx_op=\"$r0[0]\" and vins=\"$ins\"");
	  $r2=fetchrow($q2);
	  $r1=fetchrow($q1);
	  if($r2[0]=="Dr")
	  {
	  ?>
	   <td><?php echo number_format($s,2);?>&nbsp;</td><?php }else{?> <td><?php echo "0.00";?>&nbsp;</td><?php }?>
	  <?php
	  
	  if($r2[0]=="Cr")
	  {
	  ?>
	   <td><?php echo number_format($s,2);?>&nbsp;</td><?php }else{?><td><?php echo "0.00";?>&nbsp;</td><?php }?>
	  <?php
	 
				 }
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

