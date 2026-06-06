<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$tp=$_SESSION['type'];
$org=$_SESSION['org'];

require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
include("../db.php");
$qry2=execute("select * from ac_institution");
$ins=$_SESSION['ins'];
if($tp=='a')
{
$ins=$_POST['comboin'];
}
$_SESSION['ins']=$ins;
$dt1 = isset($_REQUEST["date41"]) ? $_REQUEST["date41"] : "";
$dt2 = isset($_REQUEST["date42"]) ? $_REQUEST["date42"] : "";
$_SESSION['bdt9']=$dt1;
$_SESSION['bdt10']=$dt2;
 $dtd1=date('d-m-Y',strtotime( $dt1));
  $dtd2=date('d-m-Y',strtotime( $dt2));
$qry1=execute("select * from ac_institution  where vinstitution=\"$ins\"");
$w1=mysql_fetch_object($qry1);
$t1=$w1->iIdx_institution;
//echo $t1;
$qry2=execute("select * from ac_ledger where iIdx_grp=5");
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
if(document.form1.comboin.value=="select")
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
    <style type="text/css">
<!--
.style2 {color: #CC6600}
.style5 {font-size: 13px}
.style7 {font-size: 13px; font-weight: bold; }
-->
    </style>
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
          <form id="form1" name="form1" method="post" action="exportprofitloss.php" onsubmit="return validate();">
            <table width="200" border="1" style="position:absolute; left: 216px; top: 111px; width: 702px; height: 114px;" cellspacing="0" bgcolor="#FFFFCC" id="tbl">
              <tr id="th">
                <td colspan="3"><div align="center" class="style3 style5"><strong>PROFIT AND LOSS ACCOUNT </strong></div></td>
              </tr>
              <tr id="td1">
                <td width="360" height="51"><center><b><?php echo $ins."<br>".$dtd1." To "."$dtd2";?></b></center> </td>
                        <td width="360" colspan="2"><center><b><?php echo $ins."<br>".$dtd1." To "."$dtd2";?></b></center> </td>
              </tr>
              <tr id="td1">
                <td height="17"><span class="style7">EXPENSE</span></td>
                        <td colspan="2"><span class="style7">INCOME</span></td>
              </tr>
              <tr id="td1">
                <td height="17"> 
				
				  <?php
				$q11=execute("select * from ac_ledger where vins='$ins'");
				$sum3=0;
				
				while($r11=mysql_fetch_assoc($q11))
				{
			
				$idd1=$r11[iIdx_group];
				//echo $idd1."<br>";
				$qry31=execute("select * from ac_allgroup where iIdx_grp='$idd1'");
				
while($q21=mysql_fetch_assoc($qry31))
{
	
//echo $q21[vpath]."<br>";
//echo "fsdfsdF";
//
$string1=$q21[vpath];
//echo $string."<br>"	;
$a11=explode(',',$string1);
//echo $a11[2];
if($a11[2]==3 || $idd1==3)
{
$ff11=$q21[vgroupname]."<br>";
$lkd1= $r11[vledger];
//echo $q21[vgroupname];
$qq21=execute("select max(iIdx_op) from ac_opbal where opdate<='$dt2' and Vledger='$r11[vledger]' and vins='$ins'");
$f11=fetchrow($qq21);
//echo $f1[0];
$qq31=execute("select * from ac_opbal where iIdx_op='$f11[0]'");
$f21=mysql_fetch_object($qq31);
$tt1=$f21->fopbal;
//echo $tt;
//echo "<div align=left>$r1[vledger]<div align=right> $tt</div></div>";
 $sum3=$sum3+$tt1;
 $a1=$sum3;
// echo $sum1;

 //echo $sum3;
//echo $f1[0];
/*$yy1=execute("select * from ac_opbal where opdate<='$dt2' and Vledger='$r1[vledger]' and vins='$ins'");
while($b0=mysql_fetch_assoc($yy1))
{
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$dt2' and iId_grp='$b0[iId_grp]' and vins='$ins'");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$rr= $f2->Vledger;
$tt=$f2->fopbal;

}*/
//echo $ff1."<br>";
//echo $rr;
//echo $tt;
}


				}
				//echo $sum1;
				}
				
				//echo "<br><b><div align=right>TOTAL:$sum</div></b>";
				
				?>
			
			<?php
				$q1=execute("select * from ac_ledger where vins='$ins'");
				$sum=0;
				while($r1=mysql_fetch_assoc($q1))
				{
				$idd=$r1[iIdx_group];
				//echo $idd."<br>";
				$qry3=execute("select * from ac_allgroup where iIdx_grp='$idd'");
while($q2=mysql_fetch_assoc($qry3))
{
//echo $q1[vpath]."<br>";
$string=$q2[vpath];
//echo $string."<br>"	;
$a=explode(',',$string);
if($a[2]==5 || $idd==5)
{
//echo $idd;
$ff1=$q2[vgroupname]."<br>";
$lkd= $r1[vledger];
//echo $r1[vledger];
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$dt2' and Vledger='$r1[vledger]' and vins='$ins'");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$tt=$f2->fopbal;
//echo $tt;
echo "<div align=left>$r1[vledger]<div align=right> $tt</div></div>";
 $sum=$sum+$tt;
 
//echo $f1[0];
/*$yy1=execute("select * from ac_opbal where opdate<='$dt2' and Vledger='$r1[vledger]' and vins='$ins'");
while($b0=mysql_fetch_assoc($yy1))
{
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$dt2' and iId_grp='$b0[iId_grp]' and vins='$ins'");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$rr= $f2->Vledger;
$tt=$f2->fopbal;

}*/
//echo $ff1."<br>";
//echo $rr;
//echo $tt;
}
				}
				
				}
				
				if($sum==0)
				{
				//profit
				
				$rr=number_format($sum3,2);
				echo "<div align=left>Profit<div align=right>$rr</div></div>";
				//$sum=$sum3;
				$etotal=$rr;
				// $sum1=number_format($sum1,2);
				}
				if($sum<$sum3)
				{
				$pf=$sum3-$sum;
				$df=number_format($pf,2);
				echo "<div align=left>Profit<div align=right> $df</div></div>";
				//$sum=$sum+$df;
				$etotal=$pf+$sum;
				}
				if($sum3==0)
				{
				$etotal=$sum;
				}
				?>
				&nbsp;				</td>
			  <td colspan="2">	  
	  
	  
	  <?php
				$q1=execute("select * from ac_ledger where vins='$ins'");
				$sum1=0;
				while($r1=mysql_fetch_assoc($q1))
				{
				$idd=$r1[iIdx_group];
				//echo $idd."<br>";
				$qry3=execute("select * from ac_allgroup where iIdx_grp='$idd'");
while($q2=mysql_fetch_assoc($qry3))
{
//echo $q1[vpath]."<br>";
$string=$q2[vpath];
//echo $string."<br>"	;
$a=explode(',',$string);
if($a[2]==3 || $idd==3)
{
//echo $idd;
$ff1=$q2[vgroupname]."<br>";
$lkd= $r1[vledger];
//echo $r1[vledger];
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$dt2' and Vledger='$r1[vledger]' and vins='$ins'");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$tt=$f2->fopbal;
//echo $tt;
echo "<div align=left>$r1[vledger]<div align=right> $tt</div></div>";
 $sum1=$sum1+$tt;
 $a=$sum1;
// echo $sum1;

 
//echo $f1[0];
/*$yy1=execute("select * from ac_opbal where opdate<='$dt2' and Vledger='$r1[vledger]' and vins='$ins'");
while($b0=mysql_fetch_assoc($yy1))
{
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$dt2' and iId_grp='$b0[iId_grp]' and vins='$ins'");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$rr= $f2->Vledger;
$tt=$f2->fopbal;

}*/
//echo $ff1."<br>";
//echo $rr;
//echo $tt;
}


				}
				//echo $sum1;
				}
				if($sum1==0)
				{
				$rr=number_format($etotal,2);
				echo "<div align=left>Loss<div align=right>$rr</div></div>";
				//$sum1=$sum;
				// $sum1=number_format($sum1,2);
				$itotal=$sum;
				}
				if($sum1<$sum)
				{
				$sum1=$etotal-$sum1;
				$df=number_format($sum1,2);
				//echo "<div align=left>Loss<div align=right> $df</div></div>";
				//$sum1=$a+$sum1;;
				$itotal=$sum1+$df;
				}
				if($sum==0)
				{
				$itotal=$sum1;
				}
				//echo "<br><b><div align=right>TOTAL:$sum</div></b>";
				?>
				
				&nbsp;				</td></tr>
              <tr id="td1">
                <td height="17"><?php $sum=number_format($sum,2);echo "<br><b><div align=right>TOTAL:$etotal</div></b>";
			  ?>&nbsp;</td>
                <td colspan="2"><?php
				
				 $sum1=number_format($sum1,2);	
				echo "<br><b><div align=right>TOTAL:$itotal</div></b>";
			  ?>&nbsp;</td>
              </tr>
				
				
				
				
						
				
				
				
				
				
				
				
    
              <tr>
                      <td height="17" colspan="3"><div align="right"><?php /*?><input name="button" type='button' onclick='javascript:window.location.href=&quot;exportprofitloss.php&quot;' value='Export' /><?php */?></div> </td>
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

