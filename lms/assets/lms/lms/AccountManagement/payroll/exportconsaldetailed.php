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
              <td height="79" colspan="10" id="TH"><div align="center" class="style5"><span class="style4"><b>BANGALORE SCHOOL</b><br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</span></div>
              <p>&nbsp;</p>
              <div align="center" class="style6"><b>CONSOLIDATED SALARY STATEMENT  FOR THE MONTH <?php echo $m."-".$year;?></div>              <p>&nbsp;</p></td>
            </tr>
             <tr>
			  <td colspan=10><div align=center >__________________________________________________________________________________________________________________________________________________</div></td></tr>
            <tr >
              <td id="TH"><span class="style5"><strong>SL NO: </strong></span></td>
              <td ><span class="style5"><strong>DEPARTMENT</strong></span></td>
              <td><span class="style5"><strong>GROSS SALARY </strong></span></td>
              <td ><span class="style5"><strong>LOP</strong></span></td>
              <td ><span class="style5"><strong>PF</strong></span></td>
              <td><span class="style5"><strong>PT</strong></span></td>
              <td ><span class="style5"><strong>LOANS</strong></span></td>
              <td ><span class="style5"><strong>OTHERS</strong></span></td>
              <td ><span class="style5"><strong>TOT:DEDUCTION</strong></span></td>
              <td><span class="style5"><strong>NETSALARY</strong></span></td>
            </tr>
			 <tr>
			  <td colspan=10><div align=center >__________________________________________________________________________________________________________________________________________________</div></td></tr>
       <?php
			$i=1;$s1=0;$s2=0;$s3=0;$s4=0;$s5=0;$s6=0;$s7=0;$s8=0;
			$qry=mysql_query("select * from ac_institution");
			while($r1=mysql_fetch_assoc($qry))
			{
			$qry1=mysql_query("select sum(fgrosssal),sum(flop),sum(fpf),sum(fpt),sum(floans),sum(fotherded),sum(ftotded),sum(fnetsal) from emp_salary  where vmonth='$month' and iyear='$year' and iIdx_department='$r1[iIdx_institution]'");
			$r5=mysql_fetch_array($qry1);
			
			 	$s1=$s1+$r5[0];$s2=$s2+$r5[1];$s3=$s3+$r5[2];$s4=$s4+$r5[3];$s5=$s5+$r5[4];$s6=$s6+$r5[5];$s7=$s7+$r5[6];$s8=$s8+$r5[7];
			?>
           <tr>
		   <td><span class="style5"><?php echo $i;?></span></td>
              <td><span class="style5"><?php echo $r1[vinstitution];?></span></td>
             <td><span class="style5"><?php echo $r5[0];?></span></td>
			  <td><span class="style5"><?php echo $r5[1];?></span></td>
			   <td><span class="style5"><?php echo $r5[2];?></span></td>
			  
			    <td><span class="style5"><?php echo $r5[3];?></span></td>
			    <td><span class="style5"><?php echo $r5[4];?></span></td>
			    <td><span class="style5"><?php echo $r5[5];?></span></td>
			    <td><span class="style5"><?php echo $r5[6];?></span></td>
			    <td><span class="style5"><?php echo $r5[7];?></span></td>
            </tr>
			<?php
			//}
			$i++;
		
		
			}
			?>
			 <tr>
			  <td colspan=10><div align=center >__________________________________________________________________________________________________________________________________________________</div></td></tr>
            <tr>
              <td colspan="2"><div align="right" class="style5"><strong>TOTAL:</strong></div></td>
              <td><span class="style5"><strong><?php echo $s1;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s2;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s3;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s4;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s5;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s6;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s7;?></strong></span></td>
              <td><span class="style5"><strong><?php echo $s8;?></strong></span></td>
            </tr>
			</table></body></html>