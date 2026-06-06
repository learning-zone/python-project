<?php
session_start();
$or1=$_SESSION['ior'];
$name=$_SESSION['name'];
$tp=$_SESSION['type'];
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
include("../db.php");
$qry2=execute("select * from ac_institution");
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
if($tp=='a')
{
$ins=$_POST['comboin'];
}
$_SESSION['ins']=$ins;
$dt1 = isset($_REQUEST["date51"]) ? $_REQUEST["date51"] : "";
$dt2 = isset($_REQUEST["date52"]) ? $_REQUEST["date52"] : "";
$_SESSION['bdt11']=$dt1;
$_SESSION['bdt12']=$dt2;
$dtd1=date('d-m-Y',strtotime( $dt1));
  $dtd2=date('d-m-Y',strtotime( $dt2));
$qry1=execute("select * from ac_ledger where iIdx_grp=3");
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
		
		/*$nn=execute("select distinct(Vledger) from ac_ledger");
		while($tt=mysql_fetch_assoc($nn))
		{
		//echo $tt[Vledger]."<br>";
		
		$nn2=execute("select iIdx_group from ac_ledger where Vledger=\"$tt[Vledger]\"");
		$tt11=fetchrow($nn2);
		//$tt12=mysql_fetch_object($nn2);
		//echo $tt11[0];
		$nn7=execute("select * from ac_allgroup where iIdx_grp=\"$tt11[0]\"");
		$n7=mysql_fetch_object($nn7);
		if($tt11[0]!=$aaa)
		{
		echo $n7->vgroupname."-";
		}
		echo $tt[Vledger]."-";
		
		 $aaa=$tt11[0];
		 $nn6=execute("select fopbal from ac_ledger where Vledger=\"$tt[Vledger]\" and iIdx_group='$tt11[0]'");
		$n6=fetchrow($nn6);
		 echo $n6[0]."<br>"."<br>";
		for($i=0;$i<=50;$i++)
		{
		$nn3=execute("select * from ac_allgroup where iIdx_grp=\"$aaa\"");
		$n3=mysql_fetch_object($nn3);
		 $aaa=$n3->iparentid;
		
		 if($aaa!=0)
		 {
		
		 }
		 }
		 $aaa=$tt11[0];
		}*/
		
		
	/*	$nn=execute("select distinct(iIdx_group) from ac_ledger");
		while($tt=mysql_fetch_assoc($nn))
		{
		//echo $tt[Vledger]."<br>";
		$nn7=execute("select * from ac_allgroup where iIdx_grp=\"$tt[iIdx_group]\"");
		$n7=mysql_fetch_object($nn7);
		
		echo $n7->vgroupname."-";
		$nn2=execute("select * from ac_ledger where iIdx_group=\"$tt[iIdx_group]\"");
		while($tt11=mysql_fetch_assoc($nn2))
		{
		//$tt12=mysql_fetch_object($nn2);
		//echo $tt11[0];
		
		
		echo $tt11[vledger]."-";
		$nn6=execute("select fopbal from ac_ledger where Vledger=\"$tt11[vledger]\" and iIdx_group='$tt[iIdx_group]'");
		$n6=fetchrow($nn6);
		echo $n6[0]."<br>"."<br>";
		   if($n7->iparentid==0)
		 {
		if($n7->iIdx_grp==2)
		{
		echo $n7->vgroupname."-";	
		echo $tt11[vledger]."-";	
		 echo $n6[0]."<br>"."<br>";
		}
		 }
		}
		 $aaa=$tt[iIdx_group];
		}*/
	
			/*$nn=execute("select distinct(iIdx_group) from ac_ledger order by iIdx_group");
		while($tt=mysql_fetch_assoc($nn))
		{
		$nn9=execute("select * from ac_allgroup where iIdx_grp=\"$tt[iIdx_group]\"");
		$pd=mysql_fetch_object($nn9);
		$pid=$pd->iparentid;
	echo $pid."<br>";
		for($i=0;$i<=50;$i++)
		{
		$ii=$n->iparentid;
		$nn10=execute("select * from ac_allgroup where iIdx_grp=\"$pid\"");
		$n10=mysql_fetch_object($nn10);
		
		$pid=$n10->iparentid;
		if($pid=="")
		{
		$pid==$ii;
		}
		//echo $pid."<br>";
		}
	
		//echo $pid;
		if($pid==0)
		{
		if($n10->iIdx_grp==2)
		{
			echo $pd->vgroupname."-";
		$nn2=execute("select * from ac_ledger where iIdx_group=\"$tt[iIdx_group]\"");
		while($tt11=mysql_fetch_assoc($nn2))
		{
		//$tt12=mysql_fetch_object($nn2);
		//echo $tt11[0];
		
		
		echo $tt11[vledger]."-";
		$nn6=execute("select fopbal from ac_ledger where Vledger=\"$tt11[vledger]\" and iIdx_group='$tt[iIdx_group]'");
		$n6=fetchrow($nn6);
		echo $n6[0]."<br>"."<br>";
		  
		}
		 $aaa=$tt[iIdx_group];
		}
		}
		}*/
		
		
		
		
		
		
		
		
		
		
		
		//echo $tt[Vledger]."<br>";
		/*$nn7=execute("select * from ac_allgroup where iIdx_grp=\"$tt[iIdx_group]\"");
		$n7=mysql_fetch_object($nn7);
		
		echo $n7->vgroupname."-";
		*/
			
			
				$q1=execute("select * from ac_ledger where vins='$ins'");
				$sump=0;
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
//echo "<div align=left>$r1[vledger]<div align=right> $tt</div></div>";
 $sump=$sump+$tt;
 
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
				
				
				?>
				&nbsp;				</td>
			  <td colspan="2">	  
	  
	  
	  <?php
				$q1=execute("select * from ac_ledger where vins='$ins'");
				$sumf=0;
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
//echo "<div align=left>$r1[vledger]<div align=right> $tt</div></div>";
 $sumf=$sumf+$tt;
 $a=$sumf;
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
				
				//echo "<br><b><div align=right>TOTAL:$sum</div></b>";
				
			
			
			
		echo $sump."<br>";
			
			echo $sumf."<br>";
			
	
		
?>

<?php
				$q11=execute("select * from ac_ledger where vins='$ins'");
				$sum11=0;
				while($r11=mysql_fetch_assoc($q11))
				{
				$idd1=$r11[iIdx_group];
				//echo $idd."<br>";
				$qry31=execute("select * from ac_allgroup where iIdx_grp='$idd1'");
while($q21=mysql_fetch_assoc($qry31))
{
//echo $q1[vpath]."<br>";
$string1=$q21[vpath];
//echo $string."<br>"	;
$a1=explode(',',$string1);
if($a1[2]==1 || $idd1==1)
{
//echo $idd;
$ff11=$q21[vgroupname]."<br>";
$lkd1= $r11[vledger];
//echo $r1[vledger];
$qq21=execute("select max(iIdx_op) from ac_opbal where opdate<='$dt2' and Vledger='$r11[vledger]' and vins='$ins'");
$f11=fetchrow($qq21);
//echo $f1[0];
$qq31=execute("select * from ac_opbal where iIdx_op='$f11[0]'");
$f21=mysql_fetch_object($qq31);
$tt1=$f21->fopbal;
//echo $tt;
if($tt1<0)
{
$ty1=($tt1*-1);
$ty1=number_format($ty1,2)."Cr";
}
else
{
$ty1=$tt1;
$ty1=number_format($ty1,2)."Dr";
}
echo "<div align=left><b>$r11[vledger]</b><div align=right> $ty1</div></div>";
 $sum11=$sum11+$tt1;
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
          <form id="form1" name="form1" method="post" action="exportbalancesheet.php" onSubmit="return validate();">
            <table width="200" border="0" style="position:absolute; left: 210px; top: 130px; width: 715px; height: 170px;"  id="tb1">
              <tr id="th">
                <td colspan="3"><div align="center" class="style3 style5"><strong>BALANCE SHEET </strong></div></td>
              </tr>
              <tr id="td1">
                <td width="360" height="51"><center><b><?php echo $ins."<br>".$dtd1." To "."$dtd2";?></b></center></td>
                        <td width="360" colspan="2"><center><b><?php echo $ins."<br>".$dtd1." To "."$dtd2";?></b></center></td>
              </tr>
              <tr id="th1">
                <td height="17"><span class="style7">LIABILITIES</span></td>
                        <td colspan="2"><span class="style7">ASSETS</span></td>
              </tr>
              <tr id="td1">
                <td>
				
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
if($a[2]==2 || $idd==2)
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
//echo "<div align=left><b>$r1[vledger]</b><div align=right> $ty</div></div>";



//echo $tt;
if($tt<0)
{
$ty=($tt*-1);
$ty=number_format($ty,2)."Cr";
}
else
{
$ty=$tt;
$ty=number_format($ty,2)."Dr";
}
//echo $tt;
if($f2->iId_grp==13)
{
if($sump>$sumf)
{
$cbal=$sump-$sumf;
//echo $cbal;
$dfg="Loss :".$cbal;
if($tt<0)
{
$tt=$tt*-1;
}
$sdf=$tt-$cbal;
if($sdf<0)
{
$sdf=($sdf*-1)."Cr";
}
else
{
$sdf=$sdf."Dr";
}

}
if($sump<$sumf)
{
$cbal=$sumf-$sump;
//echo $cbal;
$dfg="Profit :".$cbal;
if($tt<0)
{
$tt=$tt*-1;
}
$sdf=$tt+$cbal;
if($sdf<0)
{
$sdf=($sdf*-1)."Cr";
}
else
{
$sdf=$sdf."Dr";
}
}

}
echo $q2[vgroupname];
echo "<div align=left><b>($r1[vledger])</b><div align=right> $ty</div></div>";
$sum=$sum+$tt;
if($f2->iId_grp==13)
{

echo "<div align=right>$dfg</div>";
echo "<div align=right>-----------------------</div>";
echo "<div align=right>$sdf</div>";
$sum=$sum+$sdf;
}
 
 
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
				//echo $sum;
				//echo $sum;
				?>
				</td>
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
if($a[2]==1 || $idd==1)
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
if($tt<0)
{
$ty=($tt*-1);
$ty=number_format($ty,2)."Cr";
}
else
{
$ty=$tt;
$ty=number_format($ty,2)."Dr";
}
echo "<div align=left><b>$r1[vledger]</b><div align=right> $ty</div></div>";
 $sum1=$sum1+$tt;
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
				?>
			  &nbsp;</td>
              </tr>
			  <tr id="td1">
                <td height="17"><?php if($sum<0)
				{
				$sum=($sum*-1);
				}echo "<br><b><div align=right>TOTAL:$sum</div></b>";
			  ?>&nbsp;</td>
                <td colspan="2"><?php
				if($sum1<0)
				{
				$sss=($sum1*-1);
				}
				$sss=number_format($sum1,2);
				echo "<b><div align=right>TOTAL: $sss</div></b>";
			
				
			  ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3"><div align="right"><?php /*?><input name="button" type='button' onclick='javascript:window.location.href=&quot;exportbalancesheet.php&quot;' value='Export' /><?php */?></div>&nbsp;</td>
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

