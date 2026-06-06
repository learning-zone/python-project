<?php
session_start();
include("../db.php");
$ins=$_SESSION['ins'];
$bd1=$_SESSION['bdt9'];
$bd2=$_SESSION['bdt10'];
$dt11=date('d-m-Y',strtotime($bd1));
$dt22=date('d-m-Y',strtotime($bd2));
//$ins=$_SESSION['ins'];
$ordep=$_SESSION['ordep'];
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
//echo $b1->iIdx_institution.$b2[0];
$b2=fetchrow($qq8);
$qry2=execute("select * from ac_institution");
$qry1=execute("select * from ac_institution  where vinstitution=\"$ins\"");
$w1=mysql_fetch_object($qry1);
$t1=$w1->iIdx_institution;
//echo $t1;
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
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=incomeexpense.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";

echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />";
//echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "</head>";
echo "<body>";?>
<img src="C:\xampp\htdocs\AccountManagement26julymd\kmf_accounting.jpg">;
<?php
  echo "<b><table border=1>";

echo "<tr>
                <td colspan=3><div align=center ><strong>INCOME/EXPENSE ACCOUNT </strong></div></td>
              </tr>
              <tr>
                <td colspan=3><center><b>";
				 if($ordep==1)
{echo $b2[0]."<br>".$dt11." To ".$dt22;}else { echo $dep."<br>".$dt11." To ".$dtd22; }
echo "</b></center> 
                  <center>
                  </center>                 </td>
              </tr>
              <tr>
                <td><b>EXPENSE</b></td>
                        <td colspan=2><b>INCOME</b></span></td>
              </tr>";
			   
	  if($ordep==1)
		{
	
	  
	   echo "<tr>
                <td> ";
				
				 
				$q11=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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
$qq21=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r11[vledger]' and iIdx_organization=\"$or1\"");
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
//echo $tt;
$tut=$f2->fopbal;
if($tt<0)
{
$tt=$tt*-1;
}
//echo $tut;
echo "<div align=left>$r1[vledger]<div align=right> $tt</div></div>";
 $sum=$sum+$tt;
 //echo $sum;
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
				echo "<div align=left>Profit<div align=right>$sum3</div></div>";
				$sum=$sum3;
				}
				//echo "<br><b><div align=right>TOTAL:$sum</div></b>";
				if($sum<$sum3)
				{
				$pr=$sum3-$sum;
				echo "<div align=left>Profit<div align=right>$pr</div></div>";
				$sum=$sum+$pr;
				}
				
							echo "</td>
			  <td colspan=2>	";  
	  

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
//echo $tt;
$tut=$f2->fopbal;
if($tt<0)
{
$tt=$tt*-1;
}
//echo $tut;
echo "<div align=left>$r1[vledger]<div align=right> $tt</div></div>";
 $sum1=$sum1+$tt;
 $a=$sum1;
// echo $sum1;
//echo $a;
 
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
				echo "<div align=left>Loss<div align=right> $sum</div></div>";
				$sum1=$sum;
				}
				if($sum1<$sum)
				{
				$los=$sum-$sum1;
				$ls=number_format($los,2);
					echo "<div align=left>Loss<div align=right> $los</div></div>";
					$sum1=$sum1+$los;
				}
				
				
				
				
				echo "</tr>
              <tr>
                <td>";
				$sum=number_format($sum,2);echo "<br><b><div align=right>TOTAL:$sum</div></b>";
			 echo "</td>
                <td colspan=2>";
				
				 $sum1=number_format($sum1,2);	
				echo "<br><b><div align=right>TOTAL:$sum1</div></b>";
			echo "</td>
              </tr>";
				
				
				
				
						
				
				
				
				
				
				
				
    
	  
	
	  } if($ordep==2){
	  
	  echo "<tr>
                <td> ";
				
				
				$q11=execute("select * from ac_ledger where iIdx_organization=\"$or1\"");
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
$qq21=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r11[vledger]' and vins='$dep' and iIdx_organization=\"$or1\"");
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
				
				
				$q1=execute("select * from ac_ledger where iIdx_organization='$or1'");
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
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and vins='$dep' and iIdx_organization=\"$or1\"");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$tt=$f2->fopbal;
//echo $tt;
$tut=$f2->fopbal;
if($tt<0)
{
$tt=$tt*-1;
}
//echo $tut;
echo "<div align=left>$r1[vledger]<div align=right> $tt</div></div>";
 $sum=$sum+$tt;
 //echo $sum;
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
				echo "<div align=left>Profit<div align=right>$sum3</div></div>";
				$sum=$sum3;
				}
				//echo "<br><b><div align=right>TOTAL:$sum</div></b>";
				if($sum<$sum3)
				{
				$pr=$sum3-$sum;
				echo "<div align=left>Profit<div align=right>$pr</div></div>";
				$sum=$sum+$pr;
				}
			
				echo "</td>
			  <td colspan=2>";	  
	  
	  
	
				$q1=execute("select * from ac_ledger where iIdx_organization='$or1'");
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
$qq2=execute("select max(iIdx_op) from ac_opbal where opdate<='$bd2' and Vledger='$r1[vledger]' and vins='$dep' and iIdx_organization=\"$or1\"");
$f1=fetchrow($qq2);
//echo $f1[0];
$qq3=execute("select * from ac_opbal where iIdx_op='$f1[0]'");
$f2=mysql_fetch_object($qq3);
$tt=$f2->fopbal;
//echo $tt;
$tut=$f2->fopbal;
if($tt<0)
{
$tt=$tt*-1;
}
//echo $tut;
echo "<div align=left>$r1[vledger]<div align=right> $tt</div></div>";
 $sum1=$sum1+$tt;
 $a=$sum1;
// echo $sum1;
//echo $a;
 
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
				echo "<div align=left>Loss<div align=right> $sum</div></div>";
				$sum1=$sum;
				}
				if($sum1<$sum)
				{
				$los=$sum-$sum1;
				$ls=number_format($los,2);
					echo "<div align=left>Loss<div align=right> $los</div></div>";
					$sum1=$sum1+$los;
				}
				
				echo "</tr>
              <tr>
                <td>";
				$sum=number_format($sum,2);echo "<br><b><div align=right>TOTAL:$sum</div></b>";
			  echo "</td>
                <td colspan=2>";
				
				 $sum1=number_format($sum1,2);	
				echo "<br><b><div align=right>TOTAL:$sum1</div></b>";
			echo "</td>
              </tr>";
				
				
				
				
						
				
				
				
				
	 
	  }


































echo "</body>";
echo "</html>";
?>