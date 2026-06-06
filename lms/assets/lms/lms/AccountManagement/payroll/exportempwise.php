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
$q=mysql_query("select vinstitution from ac_institution where iIdx_institution='$dept'");
$dep=mysql_fetch_row($q);
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
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=employeewisesalary.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<center><table border=0 bordercolor=black cellspacing=0 width=1000 id=c1>";
echo "<tr >
              <td colspan=17><div align=center><strong><strong>BANGALORE SCHOOL<br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</strong></strong></div>
            <br /><br />
              <b><div align=center >EMPLOYEE WISE SALARY STATEMENT FOR  $m-$year</div></b> <br /> </td></tr><tr>
			  <td colspan=17><div align=center >_______________________________________________________________________________________________________________________________</div></td></tr>
			
       
            <tr>
              <td <strong>SL No:</strong></td>
              <td ><strong>Name:</strong></td>
              <td ><strong>Desig:</strong></td>
              <td><strong>Basic</strong></td>
              <td ><strong>DA</strong></td>
              <td><strong>HRA</strong></td>
              <td ><strong>CCA</strong></td>
              <td><strong>Others</strong></td>
              <td ><strong>Total</strong></td>
              <td ><strong>LOP</strong></td>
              <td ><strong>PF</strong></td>
              <td ><strong>PT</strong></td>
              <td ><strong>Loans</strong></td>
              <td ><strong>Others</strong></td>
			  <td ><strong>Total Ded:</strong></td>
              <td><strong>Net Salary </strong></td>
              <td ><strong>Signature</strong></td>
            </tr>
           <tr>
			  <td colspan=17><div align=center >_______________________________________________________________________________________________________________________________</div></td></tr>";
			
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
			
              echo " <tr><td><font color=black>$j</td>
              <td><font color=black>$r1[vemp_name]</td>
              <td><font color=black>$d[0]</td>
              <td><font color=black>$r1[femp_bpay]</td>
              <td><font color=black>$r2[fda]</td>
              <td><font color=black>$r2[fhra]</td>
              <td><font color=black>$r2[fcca]</td>
              <td><font color=black>$r2[fotherear]</td>
			  <td><font color=black>$r2[fgrosssal]</td>
              <td><font color=black>$r2[flop]</td>
              <td><font color=black>$r2[fpf]</td>
              <td><font color=black>$r2[fpt]</td>
              <td><font color=black>$r2[floans]</td>
              <td><font color=black>$r2[fotherded]</td>
           
              <td><font color=black>$r2[ftotded]</td>
              <td><font color=black>$r2[fnetsal]</td>   <td><font color=black> </td>   </tr>";
		
			  }
			  $j=$j+1;
			  
			  }
			 
         echo "<tr>
			  <td colspan=17><div align=center >_______________________________________________________________________________________________________________________________</div></td></tr>";
           echo " <tr>
              <td colspan=3><b>TOTAL:</td>
              <td>$s1</td>
               <td>$s2</td>
        <td>$s3</td>
             <td>$s4</td>
              <td>$s5</td>
             <td>$s6</td>
               <td>$s7</td>
              <td>$s8</td>
        <td>$s9</td>
         <td>$s10</td>
              <td>$s11</td>
              <td>$s12</td>
           <td>$s13</td>
            <td></td>
            </tr>";
			echo "</body></html>";
?>