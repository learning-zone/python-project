<?php
session_start();
include("../db.php");
$ins=$_SESSION['ins'];
$bd1=$_SESSION['bdt11'];
$bd2=$_SESSION['bdt12'];
$dt11=date('d-m-Y',strtotime($bd1));
$dt22=date('d-m-Y',strtotime($bd2));
//$ins=$_SESSION['ins'];
$ordep=$_SESSION['ordep'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
if($tp=='a')
{
$or1=$_SESSION['or11'];
}
else
{
$or1=$_SESSION['ior'];
}
$dep=$_SESSION['cdep'];
$qq=execute("select * from ac_institution where vinstitution=\"$dep\"");
$b1=mysql_fetch_object($qq);
$qq8=execute("select vorgname from ac_organization where iIdx_organization=\"$or1\"");

$b2=fetchrow($qq8);
$qry2=execute("select * from ac_institution");
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
if($tp=='a')
{
$ins=$_POST['comboin'];
}
$qry1=execute("select * from ac_ledger where iIdx_grp=3");
$qry2=execute("select * from ac_ledger where iIdx_grp=5");
//$yr=date('Y');
$yr=substr($bd1,0,strpos($bd1,'-'));
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

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=balancesheet.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<b><table border=1>";
 echo "<tr>
                <td colspan=3><div align=center ><strong>BALANCE SHEET </strong></div></td>
              </tr>
              <tr>
                <td height=51 colspan=3><center><b>";
				 if($ordep==1)
{echo $b2[0]."<br>".$dt11." To ".$dt22;}else { echo $dep."<br>".$dt11." To ".$dt22; }
echo "</b></center> 
                  <center>
                  </center>                 </td>
              </tr>
              <tr>
                <td><b>LIABILITIES</b></td>
                        <td colspan=2><b>ASSETS</b></td>
              </tr>";
			 
			
			  if($ordep==1)
{
?>

 <tr id="td1">
                <td>
				<?php
				
				$q1=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and iIdx_organization=\"$or1\"");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$tt=$f2->fopbal;
$tut=$f2->fopbal;
if($tt<0)
{
$tt=$tt*-1;
}
//echo $tut;
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
				&nbsp;			
	  
	  
	  <?php
				$q1=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and iIdx_organization=\"$or1\"");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$tt=$f2->fopbal;
$tut=$f2->fopbal;
if($tt<0)
{
$tt=$tt*-1;
}
//echo $tut;
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
				
				
				
				
				
				
				
				
				
				$q11=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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

$qq21=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r11[vledger]' and iIdx_organization=\"$or1\"");
$f11=fetchrow($qq21);
//echo $f1[0];
$qq31=execute("select * from ac_opbal where iIdx_op='$f11[0]'");
$f21=mysql_fetch_object($qq31);
$tt1=$f21->fopbal;
if($tt1<0)
{
//echo $tt;
if($tt1<0)
{
$ty1=($tt1*-1);
$ty1=number_format($ty1,2);
}
else
{
$ty1=$tt1;
$ty1=number_format($ty1,2);
}
//$assbal=$array($tt1);
echo "<font size=2><b>$ff11</b></font>";
echo "<div align=left><font size=2>($r11[vledger])</font><div align=right><font size=2> $ty1</font></div></div>";
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
				}
				?>
				
<!--====================================================================================================================================================	-->			
				<?php
				echo $assbal[0];
				$q1=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and iIdx_organization=\"$or1\"");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
if($f2->iId_grp==13)
{
$tt=$f2->fopbal*-1;
$cap=$tt;
}
else
{
$tt=$f2->fopbal;
$sum=$sum+$tt;
}
//echo $sum;
if($tt<0)
{
//echo "<div align=left><b>$r1[vledger]</b><div align=right> $ty</div></div>";
//echo $r1[vledger].$tt;

//echo $tt;
if($tt<0)
{
$ty=($tt*-1);
$ty=number_format($ty,2);
}
else
{
$ty=$tt;
$ty=number_format($ty,2);
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
$sdf=($sdf*-1);
}
else
{
$sdf=$sdf;
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
$sdf=($sdf*-1);
}
else
{
$sdf=$sdf;
}
}

}
echo "<font size=2><b>$q2[vgroupname]</b></font>";
echo "<div align=left><font size=2>($r1[vledger])</font><div align=right> <font size=2>$ty</font></div></div>";

if($f2->iId_grp==13)
{

echo "<div align=right><font size=2>$dfg</font></div>";
echo "<div align=right>-----------------------</div>";
echo "<div align=right><font size=2>$sdf</font></div>";

$sdf=$sdf*-1;
$asd=$f2->fopbal;
$sum=$sum-$asd;
$sum=$sum+$sum11+$sdf-$cap;
}

/*echo $asd;
echo $sum11;
echo $sdf;
echo $sum;*/
}
}
				}
				}
				//echo $sum;
				//echo $sum;
				?>				</td>
                        <td colspan="2">
							<?php
				$q1=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
				$sum2=0;
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
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and iIdx_organization=\"$or1\"");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
if($f2->iId_grp==13)
{
$tt=$f2->fopbal*-1;
$cap=$tt;
}
else
{
$tt=$f2->fopbal;
}
//echo "<div align=left><b>$r1[vledger]</b><div align=right> $ty</div></div>";


if($tt>0)
{
//echo $tt;
if($tt<0)
{
$ty=($tt*-1);
$ty=number_format($ty,2);
}
else
{
$ty=$tt;
$ty=number_format($ty,2);
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
$sdf=($sdf*-1);
}
else                
{
$sdf=$sdf;
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
$sdf=($sdf*-1);
}
else
{
$sdf=$sdf;
}
}

}
echo "<b><font size=2>$q2[vgroupname]</b></font>";
echo "<div align=left><font size=2>($r1[vledger])</font><div align=right> <font size=2>$ty</font></div></div>";
$sum2=$sum2+$tt;
if($f2->iId_grp==13)
{

//echo "<div align=right>$dfg</div>";
//echo "<div align=right>-----------------------</div>";
//echo "<div align=right>$sdf</div>";
$sum2=$sum2+$sdf;
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
				}
				//echo $sum;
				//echo $sum;
				?>
	<!--==========			===================================================================================================================================-->
						<?php
				$q1=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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
if($idd!=1)
echo "<b><font size=2>$ff1</font></b>";
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and iIdx_organization=\"$or1\"");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$tt=$f2->fopbal;
if($tt>0)
{
//echo $tt;
if($tt<0)
{
$ty=($tt*-1);
$ty=number_format($ty,2);
}
else
{
$ty=$tt;
$ty=number_format($ty,2);
}
echo "<div align=left><font size=2>($r1[vledger])</font><div align=right> <font size=2>$ty</font></div></div>";
 $sum1=$sum1+$tt+$sum2;
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
				
				}
				if($sumf!=0)
				//echo "<b><font size=2>Profit and Loss Account <div align=right></b>$sumf</div></font>";
				?>
			  &nbsp;</td>
              </tr>
			  <tr id="td1">
                <td height="17"><?php if($sum<0)
				{
				$sum=number_format(($sum*-1),2);
				}echo "<br><font size=2><b><div align=right>TOTAL:$sum</div></b></font>";
			  ?>&nbsp;</td>
                <td colspan="2"><?php
				if($sum1<0)
				{
				$sss=($sum1*-1);
				}
				$ase=$sum1;
				$sss=number_format($ase,2);
				echo "<b><font size=2><div align=right>TOTAL: $sss</div></font></b>";
			
				
			  ?>&nbsp;</td>
              </tr>



<?php
}
else
{
?>
  <tr id="td1">
                <td>
				<?php
				
				$q1=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and vins='$dep' and iIdx_organization=\"$or1\" and vins='$dep'");
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
				&nbsp;			
	  
	  
	  <?php
				$q1=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and vins='$dep' and iIdx_organization=\"$or1\" and vins='$dep'");
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
				
				
				
				
				
				
				
				
				
				$q11=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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

$qq21=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r11[vledger]' and vins='$dep' and iIdx_organization=\"$or1\" and vins='$dep'");
$f11=fetchrow($qq21);
//echo $f1[0];
$qq31=execute("select * from ac_opbal where iIdx_op='$f11[0]'");
$f21=mysql_fetch_object($qq31);
$tt1=$f21->fopbal;
if($tt1<0)
{
//echo $tt;
if($tt1<0)
{
$ty1=($tt1*-1);
$ty1=number_format($ty1,2);
}
else
{
$ty1=$tt1;
$ty1=number_format($ty1,2);
}
//$assbal=$array($tt1);
echo "<font size=2><b>$ff11</b></font>";
echo "<div align=left><font size=2>($r11[vledger])</font><div align=right><font size=2> $ty1</font></div></div>";
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
				}
				?>
				
<!--====================================================================================================================================================	-->			
				<?php
				echo $assbal[0];
				$q1=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and vins='$dep' and iIdx_organization=\"$or1\" and vins='$dep'");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$tt=$f2->fopbal;
$sum=$sum+$tt;
//echo $sum;
if($tt<0)
{
//echo "<div align=left><b>$r1[vledger]</b><div align=right> $ty</div></div>";
//echo $r1[vledger].$tt;

//echo $tt;
if($tt<0)
{
$ty=($tt*-1);
$ty=number_format($ty,2);
}
else
{
$ty=$tt;
$ty=number_format($ty,2);
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
$sdf=($sdf*-1);
}
else
{
$sdf=$sdf;
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
$sdf=($sdf*-1);
}
else
{
$sdf=$sdf;
}
}

}
echo "<font size=2><b>$q2[vgroupname]</b></font>";
echo "<div align=left><font size=2>($r1[vledger])</font><div align=right> <font size=2>$ty</font></div></div>";

if($f2->iId_grp==13)
{

echo "<div align=right><font size=2>$dfg</font></div>";
echo "<div align=right>-----------------------</div>";
echo "<div align=right><font size=2>$sdf</font></div>";

$sdf=$sdf*-1;
$asd=$f2->fopbal;
$sum=$sum-$asd;
$sum=$sum+$sum11+$sdf;
}

/*echo $asd;
echo $sum11;
echo $sdf;
echo $sum;*/
}
}
				}
				}
				//echo $sum;
				//echo $sum;
				?>				</td>
                        <td colspan="2">
							<?php
				$q1=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
				$sum2=0;
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
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and vins='$dep' and iIdx_organization=\"$or1\" and vins='$dep'");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$tt=$f2->fopbal;
//echo "<div align=left><b>$r1[vledger]</b><div align=right> $ty</div></div>";


if($tt>0)
{
//echo $tt;
if($tt<0)
{
$ty=($tt*-1);
$ty=number_format($ty,2);
}
else
{
$ty=$tt;
$ty=number_format($ty,2);
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
$sdf=($sdf*-1);
}
else
{
$sdf=$sdf;
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
$sdf=($sdf*-1);
}
else
{
$sdf=$sdf;
}
}

}
echo "<b><font size=2>$q2[vgroupname]</b></font>";
echo "<div align=left><font size=2>($r1[vledger])</font><div align=right> <font size=2>$ty</font></div></div>";
$sum2=$sum2+$tt;
if($f2->iId_grp==13)
{

//echo "<div align=right>$dfg</div>";
//echo "<div align=right>-----------------------</div>";
//echo "<div align=right>$sdf</div>";
$sum2=$sum2+$sdf;
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
				}
				//echo $sum;
				//echo $sum;
				?>
	<!--==========			===================================================================================================================================-->
						<?php
				$q1=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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
if($idd!=1)
echo "<b><font size=2>$ff1</font></b>";
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and vins='$dep' and iIdx_organization=\"$or1\"");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$tt=$f2->fopbal;
if($tt>0)
{
//echo $tt;
if($tt<0)
{
$ty=($tt*-1);
$ty=number_format($ty,2);
}
else
{
$ty=$tt;
$ty=number_format($ty,2);
}
echo "<div align=left><font size=2>($r1[vledger])</font><div align=right> <font size=2>$ty</font></div></div>";
 $sum1=$sum1+$tt+$sum2;
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
				
				}
				if($sumf!=0)
				//echo "<b><font size=2>Profit and Loss Account <div align=right></b>$sumf</div></font>";
				?>
			  &nbsp;</td>
              </tr>
			  <tr id="td1">
                <td height="17"><?php if($sum<0)
				{
				$sum=number_format(($sum*-1),2);
				}echo "<br><font size=2><b><div align=right>TOTAL:$sum</div></b></font>";
			  ?>&nbsp;</td>
                <td colspan="2"><?php
				if($sum1<0)
				{
				$sss=($sum1*-1);
				}
				$ase=$sum1;
				$sss=number_format($ase,2);
				echo "<b><font size=2><div align=right>TOTAL: $sss</div></font></b>";
			
				
			  ?>&nbsp;</td>
              </tr>



<?php

}

				  
										  
										  
										  
          echo "</table>";




echo "</body>";
echo "</html>";
?>