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
echo "<center><table border=0 bordercolor=black cellspacing=0 width=500 id=c1>";
?>
		  <tr >
              <td height="65" colspan="3"><div align="center" class="style5 style4"><span class="style7 style5"><strong>BANGALORE SCHOOL<br />
              SARJAPUR MAIN ROAD,KORAMANGALA,BANGALORE-34</strong></span></div>
              <p class="style6 style4 style5">&nbsp;</p>
              <div align="center" class="style6 style4 style5">INDIVIDUAL CASH STATEMENT FOR THE MONTH <?php echo $m."-".$year;?></div>              <p class="style6 style4">&nbsp;</p>
              <p class="style7 style5 style4"><strong>DEPARTMENT:<?php echo $dep[0];?></strong></p></td>
            </tr>
			 <tr>
			  <td colspan=3><div align=center >________________________________________________________________________________________________________________________________________</div></td></tr>
            <tr >
              <td   ><b><span class="style7">A/C NO: </span></td>
              <td  ><b><span class="style7">NAME</span></td>
              <td ><b><span class="style7">AMOUNT</span></td>
            </tr>
			 <tr>
			  <td colspan=3><div align=center >________________________________________________________________________________________________________________________________________</div></td></tr>
            <?php
			$s1=0;
			$qry=mysql_query("select * from emp_details1 where iIdx_institution='$dept'");
			while($r1=mysql_fetch_assoc($qry))
			{
			
			$qry1=mysql_query("select * from emp_salary where vId_emp='$r1[vemp_id]' and vmonth='$month' and iyear='$year'  and ptype='cash'");
			while($r2=mysql_fetch_assoc($qry1))
			{
			
			?>
            <tr>
              <td height="26"><span class="style4"><?php echo $r1[vaccount];?></span></td>
              <td><span class="style4"><?php echo $r1[vemp_name];?></span></td>
              <td><span class="style4"><?php echo $r2[fnetsal];?></span></td>
            </tr>
			<?php
				$s1=$s1+$r2[fnetsal];
			}
	
			}
			
			?>
			 <tr>
			  <td colspan=3><div align=center >________________________________________________________________________________________________________________________________________</div></td></tr>
			  <tr>
              <td><span class="style4"></span></td>
              <td><div align="right" class="style7"><b>TOTAL:</div></td>
              <td><span class="style7"><b><?php echo $s1;?></span></td>
            </tr>
            <tr>
              <td><span class="style4"></span></td>
              <td><span class="style4"></span></td>
              <td><span class="style4"></span></td>
            </tr>
			</table>
			<?php
			echo "</body></html>";
          
?>