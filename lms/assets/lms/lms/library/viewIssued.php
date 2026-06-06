<?php
require_once("../db.php");
$media=$_POST['media'];
$DDay=$_POST['DDay'];
$DMon=$_POST['DMon'];
$DYear=$_POST['DYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear'];

if(!checkdate($DMon,$DDay,$DYear))
{
	echo "<p>Invalid From Date.</p>";
	die("</td></tr></table>");
}
$issue_date = "$DYear-$DMon-$DDay";

if(!checkdate($TMon,$TDay,$TYear))
{
	echo "<p>Invalid To Date.</p>";
	die("</td></tr></table>");
}
$to_date = "$TYear-$TMon-$TDay";
if($media==0)
{
	$sql="select acc_id,issue_date,due_date,return_date,cno,media_type from lib_circulation_m where issue_date between '".$issue_date."' and '".$to_date."' order by issue_date";
}
if($media!=0)
{
	$sql="select acc_id,issue_date,due_date,return_date,cno,media_type from lib_circulation_m where media_type='$media' and issue_date between '".$issue_date."' and '".$to_date."' order by issue_date";
}
$rs = execute($sql);
//echo $rs;
$row1=rowcount($rs);
//print_r($_GET);
//print_r($_POST);
//echo "<p>ToDate :$to_date</p>";
//echo "<p>FromDate :$issue_date</p>";

?>
<HTML>
<HEAD>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = " ";
}
</script>
</HEAD>
<BODY>
<?php
$slno=1;
$rs_col=execute("select * from college");
$r_col=fetcharray($rs_col);
$college=$r_col[col_name];
mysql_free_result($rs_col);
?>
	<!--<div align="center"><b><font size=4><?=$college?> </font></b></div><br>-->
	<FORM NAME="frm" METHOD="POST">
	<INPUT TYPE="HIDDEN" NAME="issue_date" VALUE="<?=$issue_date;?>">
	<INPUT TYPE="HIDDEN" NAME="to_date" VALUE="<?=$to_date;?>">
	<INPUT TYPE="HIDDEN" NAME="TYear" VALUE="<?=$TYear;?>">
	<INPUT TYPE="HIDDEN" NAME="TMon" VALUE="<?=$TMon;?>">
	<INPUT TYPE="HIDDEN" NAME="TDay" VALUE="<?=$TDay;?>">
	<INPUT TYPE="HIDDEN" NAME="DYear" VALUE="<?=$DYear;?>">
	<INPUT TYPE="HIDDEN" NAME="DMon" VALUE="<?=$DMon;?>">
	<INPUT TYPE="HIDDEN" NAME="DDay" VALUE="<?=$DDay;?>">
	<INPUT TYPE="HIDDEN" NAME="register" VALUE="<?=$register;?>">
	<INPUT TYPE="HIDDEN" NAME="library" VALUE="<?=$library;?>">
<table align='center' width='90%' colspan='5'>
 <tr height='20'>
  <td align='center'>As on: <?=date('d-m-Y g:i:s:a')?></td>
 </tr>
 <tr height='25'>
  <td align="center" Class="head">Issued Media Report</td>
 </tr>
 <tr height='20'>
  <td align="center">A list of media issued between <?=date("d-m-Y",strtotime($issue_date))?> and <?=date("d-m-Y",strtotime($to_date))?></td>
 </tr>
</table>
<?
if($row1 > 0)
{  
	?>
	<br/>
	<table width="90%" cellspacing="1" align='center' class='forumline' colspan='9'>
	  <tr>
	    <td class="head" align="center">Sl.No</td>
	    <td class="head" align="center">Card No.</td>
	    <td class="head" align="center">Accession No.</td>
	    <td class="head" align="center">Issued Date</td>
	    <td class="head" align="center">Due Date</td>
		<td class="head" align="center">Return Date</td>
		<td class="head" align="center">Issued By</td>
		<td class="head" align="center">Return To</td>
	    <td class="head" align="center">Status</td>
      </tr>
<?php
for($j=0;$j<$row1;$j++)
 {
  $r = fetcharray($rs,$j);
  
  //echo "<p>Issue Date :$r[issue_date]</p>";
  #### TO CONVERT DATE FORMAT(YYYY-MM-DD) ####
	$issue_date=$r[issue_date];
	$dateArray=explode('-',$issue_date);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$issue_date="$acq_yy-$acq_mm-$acq_dd";
	#############################################
  //echo "<p>Due Date :$r[due_date]</p>";
  	$due_date=$r[due_date];
	$dateArray=explode('-',$due_date);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$due_date="$acq_yy-$acq_mm-$acq_dd";
	
  //echo "<p>Return Date :$r[return_date]</p>"; 
  	$return_date=$r[return_date];
	$dateArray=explode('-',$return_date);
	$acq_yy=$dateArray[2];
    $acq_mm=$dateArray[1];
	$acq_dd=$dateArray[0];
	$return_date="$acq_yy-$acq_mm-$acq_dd";
	
	if($issue_date=='00-00-0000')
	{
		$issue_date='';
	}
	if($due_date=='00-00-0000')
	{
		$due_date='';
	}
	if($return_date=='00-00-0000')
	{
		$return_date='';
	}

?>
  	
	 
<tr height='15'>
  <td class="CBody" align='center'><?=$slno?></td>
  <td class="CBody" align='center'><a href="viewMemberInfo.php?Cno=<?=$r["cno"]?>"><?=$r["cno"]?></a></td>
  <td class="CBody" align='center'><a href="view_acc1.php?acc_no=<?=$r["acc_id"]?>&m_no=<?=$r["cno"]?>"><?=$r["acc_id"]?></a></td>
  <!--<td class="CBody" align='center'><?=date("d-m-Y ",strtotime($r["issue_date"]))?></td>
  <td class="CBody" align='center'><?=date("d-m-Y",strtotime($r["due_date"]))?></td>
  <td class="CBody" align='center'><?=date("d-m-Y",strtotime($r["return_date"]))?></td>-->
  
  <td class="CBody" align='center'><?=$issue_date?></td>
  <td class="CBody" align='center'><?=$due_date?></td>
  <td class="CBody" align='center'><?=$return_date?></td>
  
  <td class="CBody" align='center'><?=$r["name"]?></td>
  <td class="CBody" align='center'><?=$r["ret_to"]?></td>
		<?php
			if($r[status]==0)
			{
				$state11="Issued";
			}
			if($r[status]==1)
			{
				$state11="Returned";
			}
          ?>
			<td class="CBody" align='center'><font color='red'><?=$state11?></font></td>
			<?
		$slno++;
	}
	?>
</tr>
</table>
<br>
	<div id='prn' align='center'>
	<INPUT TYPE="button" id="prn" NAME="print" VALUE="<<  Print  >>" class='bgbutton' onClick="printReport()">
	</div>
	<?
}

else
{
	?>
	<tr><td><p align="center">No media were Issued between <?=date("d-m-Y",strtotime($issue_date))?> and <?=date("d-m-Y",strtotime($to_date))?></p></td></tr>
	<?php
}
echo "<br>";
?>
</form>
</BODY>
</HTML>