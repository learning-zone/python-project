<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$tp=$_SESSION['type'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
include("../db.php");
$msg=$_REQUEST['msg'];
$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		$y11=$yr.'-04-01';
		$y12=$yr.'-03-31';
		$y21=$yr1.'-04-01';
		$y22=$yr1.'-03-31';
		$y31=$yr2.'-04-01';
		$y32=$yr2.'-03-31';
		$yr3=$yr-2;
		$y33=$yr3.'-04-01';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>Account Management</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" charset="utf-8" />
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
          <?php 
		if($tp=='u')
		{
		 if($mon>3)
		{
		$qry1=execute("Select * from ac_ledger where iIdx_organization=\"$or1\" and date between '".$y21."' and '".$y32."'");
		}
		else
		{
		$qry1=execute("Select * from ac_ledger where iIdx_organization=\"$or1\" and date between '".$y33."' and '".$y11."'");
		}
		?>
          <table width="802" border="0">
            <tr><td width="420"> <div align="right"><a href="addledger.php" class="style3 style5" id="new"><strong>Add New</strong></a> </div>
                <?php /*?><input name="button" type='button' onclick='javascript:window.location.href=&quot;addledger.php&quot;' value='Add New' /><?php */?>
              </td></tr></table>
		  <table width="717" height="170" border="0" id="tbl">
		    <tr id="th">
		      <td colspan="13"><font color="#0066FF"><center><?php echo $msg;?></center></font>&nbsp;
		        <div align="center" class="style7 style3"><span style="font-weight:bold;">LEDGERS</span></div></td>
      </tr>
		    <tr id="th1">
		      <td width="91"><span ><strong>DATE&nbsp;</strong></span></td>
        <td width="125"><span ><strong>LEDGER&nbsp;</strong></span></td>
        <td width="111"><span ><strong>GROUP&nbsp;</strong></span></td>            	
              <td width="86"><span ><strong>TYPE&nbsp;</strong></span></td>
			    <td width="135"><span ><strong>&nbsp;OPENING BALANCE </strong></span></td>
			    <td width="170"><strong>CURRENT BALANCE</strong></td>
			    <td width="50"></td>
      </tr>
		    <?php
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  $i=$row[iIdx_ledger];
	  $j=$row[iIdx_group];
	   $dtd=date('d-m-Y',strtotime($row[date]));
	  ?>
		    <tr id="td1">
		      
		      <td><strong><?php echo $dtd; ?></strong></td>
        <td><strong>
          <input type="hidden" name="id" value="<?php echo $row[iIdx_ledger]; ?>" />
          <?php echo $row[vledger]; ?></strong></td>
	    <?php
	  $qry=execute("Select * from ac_allgroup where iIdx_grp=\"$j\"");
      $ob=mysql_fetch_object($qry);
	  ?>
		      <td><strong><?php echo $ob->vgroupname; ?></strong></td>
	     
			 
			     
				<?php /*?><?php
				 if($row[itype]==0)
				 {
				 $a="By";
				 }
				 else
				 {
				 $a="To";
				 }
				 ?><?php */?>
		      <td><strong><?php echo $row[itype];?></strong></td>
				    <td>
					<?php
					 if($mon>3)
				{
				$qw=execute("select max(iIdx_op) from ac_opbal where opdate<=\"$y11\" and iIdx_organization=\"$or1\" and Vledger=\"$row[vledger]\"");
	  $r0=fetchrow($qw);
	  }
	  else
	  {
	  $qw=execute("select max(iIdx_op) from ac_opbal where opdate<=\"$y21\" and iIdx_organization=\"$or1\" and Vledger=\"$row[vledger]\"");
	  $r0=fetchrow($qw);
	  }
	   $q2=execute("select * from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$row[vledger]\" and iIdx_op=\"$r0[0]\"");
	   $rr=mysql_fetch_object($q2);
	   $typ=$rr->Dr_Cr;
	   $q1=execute("select fopbal from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$row[vledger]\" and iIdx_op=\"$r0[0]\"");
	  $bal=fetchrow($q1);
	  $b=$bal[0];
				if($b<0)	
				{
				echo "<b>".($b*-1)."</b>";	
				}
				if($b>0)
				{
				echo "<b>".$b."</b>";	
				}
				if($b==0)
				{
				$b="0.00";
				echo "<b>0.00</b>";	
				}
					
					
					
					
					
					?>
					&nbsp;</td>
	                <td><strong>
	               <?php
					if($rr->iId_grp==20 || $rr->iId_grp==21)
					{
					?>
					
					
	                  <?php if($row[fopbal]<0){ $row[fopbal]="<font color=red>".($row[fopbal])."Cr</font>";}else { $row[fopbal]=$row[fopbal].$typ;}echo $row[fopbal]; ?>
	               
					<?php
					}
					else
					{
					?>
					
	                  <?php if($row[fopbal]<0){ $row[fopbal]=($row[fopbal]*-1)."Cr";}else { $row[fopbal]=$row[fopbal].$typ;}echo $row[fopbal]; ?>
					<?php
					}
					?>
	                </strong></td>
              <td><strong id="new"><b><?php echo "<a href='updatedeleteledger.php?i=$i' id=new><font size=2 color=#0066FF>Edit</font></a>"?></b></strong></td>
      </tr>
		    <?php
		}
		?>
	      </table>
		  <?php } else {
   if($mon>3)
		{
		$qry1=execute("Select * from ac_ledger where date between '".$y21."' and '".$y32."'");
		}
		else
		{
		$qry1=execute("Select * from ac_ledger where date between '".$y33."' and '".$y11."'");
		}
		?>
          
          <table width="802" border="0">
            <tr>
              <td width="420"><div align="right"><a href="addledger.php" class="style3 style5" id="new"><strong>Add New</strong></a> </div>
            <?php /*?><input name="button" type='button' onclick='javascript:window.location.href=&quot;addledger.php&quot;' value='Add New' /><?php */?>
              </td>
      </tr>
          </table>
    <table width="717" height="170" border="1" cellspacing="0" id="tbl">
      <tr id="th">
        <td colspan="13"><font color="#0066FF"><center><?php echo $msg;?></center></font>&nbsp;
          <div align="center" class="style7 style3"><span style="font-weight:bold;">LEDGERS</span></div></td>
      </tr>
      <tr id="th1">
        <td width="71"><span ><strong>DATE&nbsp;</strong></span></td>
	  <td width="142"><strong>ORGANIZATION</strong></td>
        <td width="120"><span ><strong>LEDGER&nbsp;</strong></span></td>
        <td width="87"><span ><strong>GROUP&nbsp;</strong></span></td>            	
              <td width="67"><span ><strong>TYPE&nbsp;</strong></span></td>
			    <td width="121">&nbsp;OPENING BALANCE</td>
			    <td width="118"><strong>CURRENT BALANCE&nbsp;</strong></td>
			    <td width="40"></td>
      </tr>
      <?php
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  $ww=execute("Select iIdx_organization from ac_institution where vinstitution=\"$row[vins]\"");
	  $w=fetchrow($ww);
	 
	  $i=$row[iIdx_ledger];
	  $j=$row[iIdx_group];
	   $dtd=date('d-m-Y',strtotime($row[date]));
	   $bhn=execute("Select vorgname from ac_organization where iIdx_organization=\"$row[iIdx_organization]\"");
	   $bhn1=fetchrow($bhn);
	  ?>
      <tr id="td1">
        
        <td><strong><?php echo $dtd; ?></strong></td>
	    <td><strong><?php echo $bhn1[0]; ?></strong></td>
        <td><strong>
          <input type="hidden" name="id" value="<?php echo $row[iIdx_ledger]; ?>" />
          <?php echo $row[vledger]; ?></strong></td>
	    <?php
	  $qry=execute("Select * from ac_allgroup where iIdx_grp=\"$j\"");
      $ob=mysql_fetch_object($qry);
	  ?>
        <td><strong><?php echo $ob->vgroupname; ?></strong></td>
	     
			 
			     
				<?php /*?><?php
				 if($row[itype]==0)
				 {
				 $a="By";
				 }
				 else
				 {
				 $a="To";
				 }
				 ?><?php */?>
        <td><strong><?php echo $row[itype];?></strong></td>
				    <td>
					<?php
					 if($mon>3)
				{
				$qw=execute("select max(iIdx_op) from ac_opbal where opdate<=\"$y11\" and iIdx_organization=\"$row[iIdx_organization]\" and Vledger=\"$row[vledger]\"");
	  $r0=fetchrow($qw);
	  }
	  else
	  {
	  $qw=execute("select max(iIdx_op) from ac_opbal where opdate<=\"$y21\" and iIdx_organization=\"$row[iIdx_organization]\" and Vledger=\"$row[vledger]\"");
	  $r0=fetchrow($qw);
	  }
	   $q2=execute("select * from ac_opbal where iIdx_organization=\"$row[iIdx_organization]\" and Vledger=\"$row[vledger]\" and iIdx_op=\"$r0[0]\"");
	   $rr=mysql_fetch_object($q2);
	   $typ=$rr->Dr_Cr;
	   $q1=execute("select fopbal from ac_opbal where iIdx_organization=\"$row[iIdx_organization]\" and Vledger=\"$row[vledger]\" and iIdx_op=\"$r0[0]\"");
	  $bal=fetchrow($q1);
	  $b=$bal[0];
				if($b<0)	
				{
				echo "<b>".($b*-1)."</b>";	
				}
				if($b>0)
				{
				echo "<b>".$b."</b>";	
				}
				if($b==0)
				{
				$b=0.00;
				echo "<b>0.00</b>";	
				}
				
					$qq3=execute("select vpath from ac_allgroup where iIdx_grp='$rr->iId_grp'");
					$rr1=fetchrow($qq3);
					
					
					
					
					
					?>
					
					
					
					&nbsp;</td>
	                <td><strong>
					<?php
					if($rr->iId_grp==20 || $rr->iId_grp==21)
					{
					?>
					
					
	                  <?php if($row[fopbal]<0){ $row[fopbal]="<font color=red>".($row[fopbal])."Cr</font>";}else { $row[fopbal]=$row[fopbal].$typ;}echo $row[fopbal]; ?>
	               
					<?php
					}
					else
					{
					?>
					
	                  <?php if($row[fopbal]<0){ $row[fopbal]=($row[fopbal]*-1)."Cr";}else { $row[fopbal]=$row[fopbal].$typ;}echo $row[fopbal]; ?>
					<?php
					}
					?> </strong></td>
            <td><strong><b><?php echo "<a href='updatedeleteledger.php?i=$i' id=new><font size=2 >Edit</a>"?></b></strong></td>
      </tr>
      <?php
	
		}
		?>
      </table>
    <?php
  }
  ?>
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

