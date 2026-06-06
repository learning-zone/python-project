<?php
session_start();
require("../db.php");
$id = $_REQUEST['id'];
if($id == ""){
	die("Please follow proper procedure.");
}


$SQL = "SELECT a.*,b.dept,c.d_name FROM staff_det a,dept_no b,staff_des c WHERE a.id = $id AND ";
$SQL .= " b.dpt_id = a.subj and a.type_id=c.d_id";



$rs = execute($SQL);

$num = rowcount($rs);

if($num == 0){
	echo "<div class='CBody'><b>The staff type was not found.</b></div>";
}

$r = fetcharray($rs,0);


if($r["i_name"] == "")
{
	$r["i_name"] = '&nbsp;';
}
if($r["category"] == "")
{
	$r["category"] = '&nbsp;';
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
if($r["cmts"] == "")
{
	$r["cmts"] = '&nbsp;';
}



?>
<html>
<head>
<script language="javascript">
function Print(){
	prn.style.display="none";
	window.print();
}
</script>
</head>
<body>
<div align="center">
  <center>
  <table border="1" cellpadding="0" cellspacing="0" width='80%' class=forumline>
    <tr>
      <td width="100%" class=head colspan=4 align=center>
       <b><?=$Caption?><br><BR>
      DETAILS OF STAFF MEMBER</b></td>
    </tr>
   <TR><td width="100%" class=row3 colspan=4 align=center><font color="brown" size="3">&nbsp;</font></td>
    </TR>
 
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Staff ID </td><td width='25%' class="CBody" colspan=3>&nbsp;&nbsp;&nbsp;<?=$r["slno"]?></td>
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Swap Card No </td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["scard"]?></td>


<td width='100%' colspan='2' align='center'  rowspan="8">
		  <img src="../staff_images/<?=$r["id"]?>.jpg" alt="<?=$r["f_name"]?> <?=$r["s_name"]?>" border="1" width="100" height="120">
	
	  </td></tr>
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Staff Name</td><td width='25%' class="Cbody">&nbsp;&nbsp;&nbsp;<?=$r["f_name"]?>&nbsp&nbsp;<?=$r["s_name"]?></td></tr>
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Gender</td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["gender"]?></td></tr>
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Bank A/C No</td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["bank_ac_no"]?></td></tr>
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;PF A/C No</td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["pf_ac_no"]?></td></tr>
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Pan No</td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["panno"]?></td></tr>
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Passport No</td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["pno"]?></td></tr>
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Place of issue</td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["issue_place"]?></td></tr>
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Date Of Issue</td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["vfdate"]?></td>
<td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Expiry Date</td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["vtadate"]?></td></tr>
<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Department</td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["dept"]?></td>
<td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Designation</td><td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["d_name"]?></td></tr>
 <?php
 $sql1 = "select * from staff_group where id = ".$r["status_id"] ;
 $rss = execute($sql1);
 $num = rowcount($rss);
 $r1 = fetcharray($rss,0);
?>
 <tr>
    <td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Staff Group </td>
    <td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r1["name"]?></td>
 <?php
  if($r["staff_status_id"] == 1)  {
  	$name = "Active";
  }
  elseif($r["staff_status_id"] == 2)  {
  	$name = "Inactive";
  }
?>
<?php
 $sql3 = "select * from category where id = ".$r["status_id"] ;

 $rss3= execute($sql3);
 $num2 = rowcount($rss3);
 $r3 = fetcharray($rss3,0);
 
?>

<td width=25% class=row3>&nbsp;&nbsp;&nbsp;Category</td><td width=25% class=cbody>&nbsp;&nbsp;&nbsp;<?=$r3["name"]?></td></tr>
 <?php
 $sql2 = "select * from staff_status where id = ".$r["status_id"] ;
 $rss2= execute($sql2);
 $num1 = rowcount($rss2);
 $r2 = fetcharray($rss2,0);
 
?>
<tr><td width=25% class=row3>&nbsp;&nbsp;&nbsp;Staff Type</td><td width=25% class=cbody>&nbsp;&nbsp;&nbsp;<?=$r2["name"]?></td>

<?php
	  $d3 = explode(" ",$r["j_date"]);

	  $temp_jdate = explode("-",$r["j_date"]);
	  $act_jdate= $temp_jdate[2]."-".$temp_jdate[1]."-".$temp_jdate[0];
	 ?>
	 <td class="row3"><font face="Arial">&nbsp;&nbsp;&nbsp;Joined Date</font></td>
<td width="25%" align="left"><font face="Arial">&nbsp;&nbsp;&nbsp;<?=$act_jdate;?></font></td></tr>
<tr><td width='25%' class="row3" nowrap>&nbsp;&nbsp;&nbsp;Father/Husband Name</td>
<td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["father"]?></td>

	<?php
	  $d2 = explode(" ",$r["dob"]);

	  $temp_dob = explode("-",$r["dob"]);
	  $act_dob = $temp_dob[2]."-".$temp_dob[1]."-".$temp_dob[0];
	 ?>

<td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Date of Birth</td>
<td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$act_dob;?></td>
</tr>

<tr><td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Blood Group</td>
<td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["bg"]?></td>
<td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Marital Status</td>
<td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["ms"]?></td>
</tr>
<tr>
  <td width='25%' class="row3">&nbsp;&nbsp;&nbsp;Mobile No</td>
  <td width='25%' Class="CBody">&nbsp;&nbsp;&nbsp;<?=$r[mobileno]?></td>
<td width='25%' class="row3">&nbsp;&nbsp;&nbsp;E-mail</td>
<td width='25%' class="CBody">&nbsp;&nbsp;&nbsp;<?=$r["email"]?></td>
</tr>
 <?php
 	  $d3 = explode(" ",$r["doa"]);

 ?>

<tr><td colspan="2"  align='center' class="row3">
<b>Permanent Address</b>
</td>
<td colspan="2"  align='center' class="row3">
<b>Present Address</b>
</td>
</tr>

<tr>
<td colspan="2" align='left' class="CBody">
&nbsp;&nbsp;&nbsp;<?=$r["addr_perm"]?> <br>
&nbsp;&nbsp;&nbsp;<?=$r["ct_perm"]?> - <?=$r["pin_perm"]?><br>
&nbsp;&nbsp;&nbsp;<?=$r["st_perm"]?><br>
&nbsp;&nbsp;&nbsp;Phone : <?=$r["ph_perm"]?>
</td>

<td colspan="2"  align='left' class="CBody">
&nbsp;&nbsp;&nbsp;<?=$r["addr_pres"]?><br>
&nbsp;&nbsp;&nbsp;<?=$r["ct_pres"]?> - <?=$r["pin_pres"]?><br>
&nbsp;&nbsp;&nbsp;<?=$r["st_pres"]?><br>
&nbsp;&nbsp;&nbsp;Phone : <?=$r["ph_pres"]?>
</font>

   </td>
  </tr>
  </table>
  </td>
  </tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" width='80%' class=forumline>
<tr align="center">
<td colspan=7 class="head"><font face="Arial">Qualification</font></td>
</tr>
     <?php
         $qsql="select * from staff_qualification where staff_id=$id order by id";
         $qrs=execute($qsql);
         $qnum=rowcount($qrs);
        if($qnum>=1)
         {
         	echo "<tr>";
         	echo "<td class='row3'>Course</td>";
         	echo "<td class='row3'>Specialization</td>";
         	echo "<td class='row3'>Year of Passing</td>";
         	echo "<td class='row3'>College/ School</td>";
         	echo "<td class='row3'>University/ Board</td>";
         	echo "<td class='row3'>Name of professional Board /Council</td>";
         	echo "<td class='row3'>SR Number & date</td>";
        	echo "</tr>";
         	for($q=0;$q<$qnum;$q++)
         	{
         		$qrow=fetcharray($qrs,$q);
         		echo "<tr>";
				echo "<td>$qrow[2]</td>";
				echo "<td>$qrow[8]</td>";
				echo "<td>$qrow[3]</td>";
				echo "<td>$qrow[7]</td>";
				echo "<td>$qrow[4]</td>";
				echo "<td>$qrow[6]</td>";
				echo "<td>$qrow[5]</td>";
				echo "</tr>";
         	}
         	echo "<tr>";
	}
	?>
	</table>
<table border="1" cellpadding="0" cellspacing="0" width='80%' class=forumline>
<tr align="center">
<td height="20" colspan=6 class="head"><font face="Arial">Previous Job Details <font color="#FF0000"></font></font></td>
</tr>
   <?php
   $jsql="select * from previous_job where staff_id=$id order by id";
   //echo $jsql;
   $jrs=execute($jsql);
   $jnum=rowcount($jrs);
   if($jnum >=1)
   {
		echo"<tr>";
		echo "<td class='row3'> Post</td>";
		echo "<td class='row3'>Employee/Organisation</td>";
		echo "<td class='row3'>City</td>";
		echo "<td class='row3'>Country</td>";
		echo "<td class='row3'>From Date</td>";
		echo "<td class='row3'>To Date</td>";
		echo "</tr>";

		for($j=0;$j<$jnum;$j++)
		{
			$jrow=fetcharray($jrs,$j);
			echo"<tr>";
			echo"<td>$jrow[2]</td>";
			echo"<td>$jrow[3]</td>";
			echo"<td>$jrow[4]</td>";
			echo"<td>$jrow[5]</td>";
			echo"<td>$jrow[from_date]</td>";
			echo"<td>$jrow[last_date_work]</td>";
			echo "</tr>";
		}
		echo"<tr>";
  }
?>
</table>
<table border="1" cellpadding="0" cellspacing="0" width='80%' class=forumline>
<tr align="center">
<td height="20" colspan=6 class="head"><font face="Arial">Dependent Details<font color="#FF0000"></font></font></td>
</tr>
   <?php
   $jsql="select * from staff_dependents where staff_id=$id";
   //echo $jsql;
   $jrs=execute($jsql);
   $jnum=rowcount($jrs);
   if($jnum >=1)
   {
		echo"<tr>";
		echo "<td class='row3'> Name</td>";
		echo "<td class='row3'>Relation</td>";
		echo "<td class='row3'>	Address</td>";
		echo "<td class='row3'>	Phone</td>";
		echo "<td class='row3'>Occupation</td>";
		
		echo "</tr>";

		for($j=0;$j<$jnum;$j++)
		{
			$jrow=fetcharray($jrs,$j);
			echo"<tr>";
			echo"<td>$jrow[1]</td>";
			echo"<td>$jrow[3]</td>";
			echo"<td>$jrow[5]</td>";
			echo"<td>$jrow[9]</td>";
			echo"<td>$jrow[4]</td>";
			
			echo "</tr>";
		}
		echo"<tr>";
  }
?>
</table>


<table border="1" cellpadding="0" cellspacing="0" width='80%' class=forumline>
<tr><td width='100%' class="head" colspan='2' align='center'><b>General Details<b></td></tr>
<tr><td width='25%' class="row3">Comments</td>
<td width='75%' class="CBody"><?=$r["cmts"]?></td>
</tr>
</table><br>
<div id="prn">
<input type="button" class=bgbutton value="<< PRINT >>" onClick="Print1()">
</div>
</BODY>
</HTML>  