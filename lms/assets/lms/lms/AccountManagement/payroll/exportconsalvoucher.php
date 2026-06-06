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
$dept=$_SESSION['ddpt'];
$month=$_SESSION['vm'];
$year=$_SESSION['vy'];
//$_SESSION['r']=$r;
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
$q=mysql_query("select vinstitution from ac_institution where iIdx_institution='$dept'");
$dep=mysql_fetch_row($q);
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=cashstatement.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<center><table border=0 bordercolor=black cellspacing=0 width=700 id=c1>";
?>
  <tr >
              <td height="65" colspan="12"><div align="center" class="style5"><span class="style4"><b>BANGALORE SCHOOL</b><br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</span></div>
              <p>&nbsp;</p>
              <div align="center" class="style6">CONSOLIDATED SALARY STATEMENT  FOR THE MONTH <?php echo $m."-".$year;?></div>              <p>&nbsp;</p>
              <p class="style5"><strong>DEPARTMENT</strong>:<b><?php echo $dep[0];?></b></p></td>
            </tr>
			 <tr>
			  <td colspan=12><div align=center >________________________________________________________________________________________________________________________________________</div></td></tr>
            <tr >
              <td width="48"><span class="style5"><strong>SL No: </strong></span></td>
              <td width="49"><span class="style5"><strong>Name:</strong></span></td>
              <td width="48"><span class="style5"><strong>Desig:</strong></span></td>
              <td width="39"><span class="style5"><strong>Gross Salary </strong></span></td>
              <td width="31"><span class="style5"><strong>LOP</strong></span></td>
              <td width="24"><span class="style5"><strong>PF</strong></span></td>
              <td width="24"><span class="style5"><strong>PT</strong></span></td>
              <td width="46"><span class="style5"><strong>Loans</strong></span></td>
              <td width="52"><span class="style5"><strong>Others</strong></span></td>
			  <td width="68"><span class="style5"><strong>Total Ded:</strong></span></td>
              <td width="53"><span class="style5"><strong>Net Salary </strong></span></td>
              <td width="29"><span class="style5"><strong>Signature</strong></span></td>
            </tr>
            <tr>
			  <td colspan=12><div align=center >________________________________________________________________________________________________________________________________________</div></td></tr>
			<?php
			$s1=0;$s2=0;$s3=0;$s4=0;$s5=0;$s6=0;$s7=0;$s8=0;$s9=0;$s10=0;$s11=0;$s12=0;$s13=0;$j=1;
			$qry=mysql_query("select * from emp_details1 where iIdx_institution='$dept'");
			while($r1=mysql_fetch_assoc($qry))
			{
				
			$qry1=mysql_query("select * from emp_salary where vId_emp='$r1[vemp_id]' and vmonth='$month' and iyear='$year'");
			while($r2=mysql_fetch_assoc($qry1))
			{
		
			$qry3=mysql_query("select vjob from emp_job where iId_job='$r1[iemp_designation]'");
			$d=mysql_fetch_row($qry3);
			$s1=$s1+$r1[femp_bpay];$s2=$s2+$r2[fda];$s3=$s3+$r2[fhra];$s4=$s4+$r2[fcca];$s5=$s5+$r2[fotherear];$s6=$s6+$r2[fgrosssal];$s7=$s7+$r2[flop];$s8=$s8+$r2[fpf];$s9=$s9+$r2[fpt];$s10=$s10+$r2[floans];$s11=$s11+$r2[fotherded];$s12=$s12+$r2[ftotded];$s13=$s13+$r2[fnetsal];
			
              echo " <tr ><td><font color=black>$j</td>
              <td><font color=black>$r1[vemp_name]</td>
              <td><font color=black>$d[0]</td>
          	  <td><font color=black>$r2[fgrosssal]</td>
              <td><font color=black>$r2[flop]</td>
              <td><font color=black>$r2[fpf]</td>
              <td><font color=black>$r2[fpt]</td>
              <td><font color=black>$r2[floans]</td>
              <td><font color=black>$r2[fotherded]</td>
           
              <td><font color=black>$r2[ftotded]</td>
              <td><font color=black>$r2[fnetsal]</td>  </tr";
			
			  }
			  $j=$j+1;
			  }
			  ?>
           <tr>
			  <td colspan=12><div align=center >________________________________________________________________________________________________________________________________________</div></td></tr>
            <tr>
              <td colspan="3"><span class="style5"><b>TOTAL:</span></td>
              <td><span class="style5"><strong><b><?php echo $s6;?></strong></span></td>
               <td><span class="style5"><strong><b><?php echo $s7;?></strong></span></td>
              <td><span class="style5"><strong><b><?php echo $s8;?></strong></span></td>
        <td><span class="style5"><strong><b><?php echo $s9;?></strong></span></td>
         <td><span class="style5"><strong><b><?php echo $s10;?></strong></span></td>
              <td><span class="style5"><strong><b><?php echo $s11;?></strong></span></td>
              <td><span class="style5"><strong><b><?php echo $s12;?></strong></span></td>
           <td><span class="style5"><strong><b><?php echo $s13;?></strong></span></td>
            <td><span class="style5"></span></td>
            </tr>
			</body></b></html>