<?php
session_start();
include("../connection.php");
//$r1=$_SESSION['r'];
$name=$_SESSION['name'];
$msg1=$_REQUEST['msg1'];
$msg2=$_REQUEST['msg2'];
$msg3=$_REQUEST['msg3'];
 $or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$type=$_SESSION['type'];
$org=$_SESSION['org'];
$array=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$month=$_SESSION['vm'];
$year=$_SESSION['vy'];
$q=mysql_query("select vinstitution from ac_institution where iIdx_institution='dept'");
$dep=mysql_fetch_row($q);
if($month==1)
{
$m="JANUARY";
}
if($month==2)
{
$m="FEBRUARY";
}
if($month==3)
{
$m="MARCH";
}
if($month==4)
{
$m="APRIL";
}
if($month==5)
{
$m="MAY";
}
if($month==6)
{
$m="JUNE";
}
if($month==7)
{
$m="JULY";
}
if($month==8)
{
$m="AUGUST";
}
if($month==9)
{
$m="SEPTEMBER";
}
if($month==10)
{
$m="OCTOBER";
}
if($month==11)
{
$m="NOVEMBER";
}
if($month==12)
{
$m="DECEMBER";
}
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=cashstatement.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<center><table border=0 bordercolor=black cellspacing=0 width=700 id=c1>";
?>
  <tr>
              <td height="79" colspan="6" id="TH"><div align="center" class="style5"><strong>BANGALORE SCHOOL<br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</strong></div>
              <p class="style5">&nbsp;</p>
              <div align="center" class="style5"><strong>CONSOLIDATED SALARY STATEMENT  FOR THE MONTH <?php echo $m."-".$year;?></strong></div>              <p class="style4">&nbsp;</p></td>
            </tr>
			 <tr>
			  <td colspan=6><div align=center >________________________________________________________________________________________________________________________________________</div></td></tr>
            <tr>
              <td width="16%" id="TH"><span class="style4"><strong>SL NO: </strong></span></td>
              <td width="24%"><span class="style4"><strong>DEPARTMENT</strong></span></td>
              <td width="20%"><span class="style4"><strong>DIRECTLY TO SB A/C </strong></span></td>
              <td width="12%"><span class="style4"><strong>BY CHEQUE </strong></span></td>
              <td width="14%"><span class="style4"><strong>BY CASH </strong></span></td>
              <td width="14%"><span class="style4"><strong>TOTAL</strong></span></td>
            </tr>
			 <tr>
			  <td colspan=6><div align=center >________________________________________________________________________________________________________________________________________</div></td></tr>
            <?php
			$i=1;$s1=0;$s2=0;$s3=0;$s4=0;$s5=0;
			$qry=mysql_query("select * from ac_institution");
			while($r1=mysql_fetch_assoc($qry))
			{
			$qry1=mysql_query("select sum(fnetsal) from emp_salary  where vmonth='$month' and iyear='$year' and ptype='sb' and iIdx_department='$r1[iIdx_institution]'");
			$r5=mysql_fetch_row($qry1);
			$qry2=mysql_query("select sum(fnetsal) from emp_salary  where vmonth='$month' and iyear='$year' and ptype='cheque' and iIdx_department='$r1[iIdx_institution]'");
			$r6=mysql_fetch_row($qry2);
			$qry3=mysql_query("select sum(fnetsal) from emp_salary  where vmonth='$month' and iyear='$year' and ptype='cash' and iIdx_department='$r1[iIdx_institution]'");
			$r7=mysql_fetch_row($qry3);
			 	$s1=$r5[0]+$r6[0]+$r7[0];
			?>
           <tr >
		   <td><span class="style4"><strong><?php echo $i;?></strong></span></td>
              <td><span class="style4"><strong><?php echo $r1[vinstitution];?></strong></span></td>
             <td><span class="style4"><strong><?php echo $r5[0];?></strong></span></td>
			  <td><span class="style4"><strong><?php echo $r6[0];?></strong></span></td>
			   <td><span class="style4"><strong><?php echo $r7[0];?></strong></span></td>
			  
			    <td><span class="style4"><strong><?php echo $s1;?></strong></span></td>
            </tr>
			<?php
			//}
			$i++;
		$s2=$s2+$r5[0];	$s3=$s3+$r6[0];	$s4=$s4+$r7[0];	$s5=$s5+$s1;
		
			}
			?>
			 <tr>
			  <td colspan=6><div align=center >________________________________________________________________________________________________________________________________________</div></td></tr>
            <tr >
              <td colspan="2"><div align="right" class="style4"><strong>TOTAL:</strong></div></td>
              <td><span class="style4"><strong><?php echo $s2;?></strong></span></td>
              <td><span class="style4"><strong><?php echo $s3;?></strong></span></td>
              <td><span class="style4"><strong><?php echo $s4;?></strong></span></td>
              <td><span class="style4"><strong><?php echo $s5;?></strong></span></td>
            </tr>
			</table></body></html>