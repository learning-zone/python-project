<?php
session_start();
include("../db.php");
$SQL="select * from staff_det where id='$id'";
$rsa = mysql_query($SQL);
$r = mysql_fetch_array($rsa);
$num = mysql_num_rows($rsa);

if($num == 0)
{
	echo "<div class='CBody'><b>The staff type was not found.</b></div>";
}
if($r["i_name"] == "")
{
	$r["i_name"] = '&nbsp;';
}
if($r["expirydate"] == "")
{
	$r["expirydate"] = '&nbsp;';
}
if($r["sp_assoc"] == "")
{
	$r["sp_assoc"] = '&nbsp;';
}
if($r["xtra"] == "")
{
	$r["xtra"] = '&nbsp;';
}
if($r["cert"] == "")
{
	$r["cert"] = '&nbsp;';
}
if($r["other_facilities"] == "")
{
	$r["other_facilities"] = '&nbsp;';
}
if($r["other_responsibilities"] == "")
{
	$r["other_responsibilities"] = '&nbsp;';
}
if($r["prev_post"] == " ")
{
	$r["prev_post"] = '&nbsp;';
}
if($r["prev_work_place"] == " ")
{
	$r["prev_work_place"] = '&nbsp;';
}
if($r["prev_work_city"] == " ")
{
	$r["prev_work_city"] = '&nbsp;';
}
if($r["prev_work_country"] == " ")
{
	$r["prev_work_country"] = '&nbsp;';
}
if($r["doa"] == "")
{
	$r["doa"] = '&nbsp;';
}
if($r["email"] == "")
{
	$r["email"] = '&nbsp;';
}
if($r["j_date"] == "")
{
	$r["j_date"] = '&nbsp;';
}
if($r["cmts"] == "")
{
	$r["cmts"] = '&nbsp;';
}
?>
<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<script language="javascript">
function Print()
{
	prn.style.display="none";
	window.print();
}
</script>
</head><table border="1" width='90%' class=forumline align='centre'>
 <tr>
<td width="100%" class=head colspan=6 align='center'>
 <b><?php echo $Caption?><br><font size=3>DETAILS OF STAFF MEMBER</b></td>
    </tr><td>&nbsp;Name</td>
  <td>&nbsp;<?php echo $r["f_name"]?></td>
  <td>&nbsp;Gender</td>
  <td>&nbsp;<?php echo $r["gender"]?></td>
 </tr>
 <tr><td>&nbsp;Staff ID</td>
    <td>&nbsp;<?php echo $r["slno"]?></td>
 <?php
  if($r["staff_status_id"] == 1)
  {
  	$name = "Active";
  }
  elseif($r["staff_status_id"] == 2)
  {
  	$name = "Ex-Staff";
  }
 $sql1 = "select * from staff_status ";
 $rss = mysql_query($sql1);
 $num1 = mysql_num_rows($rss);
 $r1 = mysql_fetch_array($rss);
?>
<td>&nbsp;Staff Type</td>
<td>&nbsp;<?php echo $r1["name"]?></td></tr>
<?php
 	if($r1["name"] == 3)
 	{
		$d0 = explode(" ",$r["expirydate"]);
	}
?>
<tr>
<td>&nbsp;Offered Salary</td>
<td>&nbsp;<?php echo $r["offeredsal"]?></td>
<td>&nbsp;Basic Salary Rate</td>
<td>&nbsp;<?php echo $r["basicsal"]?></td>
</tr>
 		<tr>
		<td>&nbsp;Association</td>
		<td>&nbsp;<?php echo $r["sp_assoc"]?></font></td>
<td>&nbsp;Extra Curricular</font></td>
<td>&nbsp;<?php echo $r["extraact"]?></font></td>
</tr>
 <tr>
	<td>&nbsp;Merits</font></td>
	<td>&nbsp;<?php echo $r["cert"]?></font></td>
	<td>&nbsp;Other facilities</font></td>
	<td>&nbsp;<?php echo $r["other_facilities"]?></font></td>
</tr>
		<tr>
			<td>&nbsp;Other Responsibilities</font></td>
			<td>&nbsp;<?php echo $r["other_responsibilities"]?></font></td>
<?php
	 $d = explode(" ",$r["j_date"]);
	 $dat=date("d-m-Y",strtotime($r[j_date]));

 ?>

	 	<td>&nbsp;Date of Joining</font></td>
		<td>&nbsp;<?php echo $dat?></font></td>
 </tr>
</table>
		<table class=forumline width="90%" border="1">
		<tr height='30'>
		<td width='100%' colspan='4' align='center'>
		<b><font size=3>&nbsp;Personal Details<b>
		</td>
	</tr>
	<tr>
		<td>&nbsp;Fathers Name</font></td>
		<td>&nbsp;<?php echo $r["father"]?></font></td>
	
	<?php
			$d2 = explode(" ",$r["dob"]);
			$temp_dob = explode("-",$r["dob"]);
			$act_dob = $temp_dob[2]."-".$temp_dob[1]."-".$temp_dob[0];
	?>
		<td>&nbsp;Date of Birth</font></td>
		<td>&nbsp;
			<?php echo $act_dob;?></font>
		</td>
	</tr>
	<tr>
		<td>&nbsp;
			Marital Status</font>
		</td>
		<td>
			&nbsp;<?php echo $r["ms"]?></font>
		</td>
		<td></td><td></td>
	</tr>
	<?php
 		$d3 = explode(" ",$r["doa"]);
	?>

	 <tr>
		<td colspan="4" class="CBody">
		<table border='0' width='100%'>
		<tr height='20'>
			<td width='25%'  align='center'>
				<b><u>&nbsp;Permanent Address</font></u></b>
			</td>
			<td width='25%'  align='center'>
				<b><u>&nbsp;Present Address</font></u></b>
			</td>
		</tr>
		<tr height='20'>
			<td width='25%'  align='left'>&nbsp;
				<?php echo $r["addr_perm"]?> <br>
				<?php echo $r["ct_perm"]?> - <?php echo $r["pin_perm"]?><br>
				<?php echo $r["st_perm"]?><br>
				</font>
			</td>
			<td width='25%'  align='left'>&nbsp;
			<?php echo $r["addr_pres"]?><br>
			<?php echo $r["ct_pres"]?> - <?php echo $r["pin_pres"]?><br>
			<?php echo $r["st_pres"]?><br>

	</font>
   </td>
  </tr>
  </table>
  </td>
  </tr>
  
  <tr height='20'>
		<td width='25%' align='center'>	
			Phone</font>
		</td>
		<td width='25%' align='center'>
			<?php echo $r["ph_perm"]?></font>
		</td>
		<td width='25%' align='center' >
			STATE
		</td>
 		
		<td width='25%' align='center'  >
			<?php echo $r["st_perm"]?></font>
		</td>
  </tr>

</table>
	<script language="JavaScript">
		function delete_me(id1)
			{
				if(confirm("Are you sure that you want to delete this record"))
					{
						document.frm2.delete_id.value = id1
						document.frm2.submit()
					}
			}
	</script>
	<form method="GET"  action="delete.php" name="frm2">
		<input type="hidden" name="delete_id">
	</form>
	<p align="left">&nbsp;</p>
<center>
<table>
	<form method="post" name="form1" id="form1">
		<div id="prn">
			<input type="button" class=bgbutton value="Print" onClick="Print()">
		</div>
	</form>
</table>
</center>
</BODY>
</HTML>
