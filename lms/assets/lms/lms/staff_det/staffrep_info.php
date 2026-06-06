<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
session_start();
include('../db.php');
?>
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<?php 
if($id!="")
{
$sq=mysql_query("select * from staff_det where slno='$id'");
$det=mysql_fetch_array($sq);
$sqj=mysql_query("select * from staff_qua where slno='$id'");
$dep=mysql_fetch_array($sqj);
$sqm=mysql_query("select * from staff_prev_det where slno='$id'");
$dem=mysql_fetch_array($sqm);
$sqn=mysql_query("select * from staff_exp where slno='$id'");
$dej=mysql_fetch_array($sqn);
}
?>
<script type="text/javascript" src="jquery-1.4.1.min.js"></script>
<style>
ul.tabs {
	margin: 0;
	padding: 0;
	float: left;
	list-style: none;
	height: 32px; /*--Set height of tabs--*/
	border-bottom: 1px solid #999;
	border-left: 1px solid #999;
	width: 100%;
}
ul.tabs li {
	float: left;
	margin: 0;
	padding: 0;
	height: 31px; /*--Subtract 1px from the height of the unordered list--*/
	line-height: 31px; /*--Vertically aligns the text within the tab--*/
	border: 1px solid #999;
	border-left: none;
	margin-bottom: -1px; /*--Pull the list item down 1px--*/
	overflow: hidden;
	position: relative;
	background: #e0e0e0;
}
ul.tabs li a {
	text-decoration: none;
	color: #000;
	display: block;
	font-size: 1.2em;
	padding: 0 20px;
	border: 1px solid #fff; /*--Gives the bevel look with a 1px white border inside the list item--*/
	outline: none;
}
ul.tabs li a:hover {
	background: #ccc;
}
html ul.tabs li.active, html ul.tabs li.active a:hover  { /*--Makes sure that the active tab does not listen to the hover properties--*/
	background: #fff;
	border-bottom: 1px solid #fff; /*--Makes the active tab look like it's connected with its content--*/
}
.tab_container {
	border: 1px solid #999;
	border-top: none;
	overflow: hidden;
	clear: both;
	float: left; width: 100%;
	background: #fff;
}
.tab_content {
	padding: 20px;
	font-size: 1.2em;
}
</style>
<script>

$(document).ready(function()
	{
//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
});
function reload1()
	{
		document.staff.action="staffrep_info.php";
		document.staff.submit();
	}
</script>
</HEAD>

<BODY>
<form name="staff" action="staffrep_info.php" method="post"  ENCTYPE="multipart/form-data">

<input type="hidden" name='id' value='<?php echo $id?>'>

<div class="tab_container" style="background:#eee;">
<div id="tab1" class="tab_content">
      <div>
	  <table  class='tablesty' align='center' cellspacing='2' cellpadding="" width='85%' style="background:#eee;">
  <tr><td class='head' align='center'colspan="4"><font face="arial" size="3" color="#FFFFFF">PERSONAL INFORMATION</font></td></tr>
 <tr>
	<td style="font-size:12px;padding:5px;">Staff ID</b> </td><td colspan='2'><b><?php echo $det[slno] ?></b></td>
</tr>
  <tr>
	<td style="font-size:12px;padding:5px;">Name<span style='color:red'>*</span></b> </td><td colspan='2'><?php echo $det[f_name] ?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Surname</b></td><td colspan='2'><?php echo $det[s_name] ?></td>
</tr>
<tr><?php
  if($det[gender]==1)
{
	$s1="Male";
	$s2="";
}
if($det[gender]==2)
{
	$s2="Female";
	$s1="";
}
?>
	<td style="font-size:12px;padding:5px;">Gender</b></td><td colspan='2' style="font-size:12px;"><?php echo $s1 ?><?php echo $s2?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Permanent Address</b></td><td colspan='2'><?php echo $det[address] ?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Residential Phone Number</b></td><td colspan='2'><?php echo $det[res_no] ?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Office Phone Number</b></td><td colspan='2'><?php echo $det[off_no] ?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Cell Phone Number</b></td><td colspan='2'><?php echo $det[cell_no] ?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Email-Id<span style='color:red'>*</span></b></td><td colspan='2'><?php echo $det[email]?></td>
</tr>
 <tr>
	<td style="font-size:12px;padding:5px;">Nationality</b></td><td colspan='2'><?php echo $det[nation] ?></td>
</tr>
 <tr>
	<td style="font-size:12px;padding:5px;">Country Of Origin</b></td><td colspan='2'><?php echo $det[corg] ?></td>
</tr>
  <tr>
  <?php
  if($det[mar_sta]==1)
{
	$p1="Single";
	$p2="";
}
if($det[mar_sta]==2)
{
	$p2="Married";
	$p1="";
}
?>
	<td style="font-size:12px;padding:5px;">Martial Status</b></td><td colspan='2' style="font-size:12px;"><?php echo $p1?> <?php echo $p2 ?></td>
</tr>
  <tr>
	<td style="font-size:12px;padding:5px;">Children</b></td>
	<td>
	<?php echo $det[child]?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Other Dependants</b></td><td colspan='2'><?php echo $det[depd] ?></td>
</tr>
   <tr>
	<td style="font-size:12px;padding:5px;">Date Of Birth</b></td>
	   <td>
	   <?php 
$doa=explode("-",$det["dob"]);
		?>
<?php echo $doa[2]."-".$doa[1]."-".$doa[0] ?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Age</b></td><td colspan='2'><?php echo $det[age] ?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Work Permit?</b></td><td colspan='2'><?php echo $det[wrk_prt] ?></td>
</tr>
<tr>
 <?php
  if($det[phy_dis]==1)
{
$s1="Yes";
$s2="";
}
if($phy_dis[phy_dis]==2)
{
$s2="No";
$s1="";
}?>
    <td style="font-size:12px;padding:5px;">Physical Disability?</b></td><td colspan='2'>
    <?php echo $s1 ?><?php echo $s2 ?></td>
</tr>
<tr>
    <td style="font-size:12px;padding:5px;">If Yes Specify</b></td><td colspan='2'><?php echo $det[yes_dis] ?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Languages Known</b></td><td colspan='2' style="font-size:12px;">
	<?php
	if($det[lang1]=="english")
	{
	$sp1="English";
	}
	if($det[lang2]=="kiswahili")
	{
	$sp2="Kiswahili";
	}if($det[lang3]=="french")
	{
	$sp3="French";
	}if($det[lang4]=="other")
	{
	$sp4="Other";
	}
	?>
	<?php echo $sp1?><br>
	<?php echo $sp2?><br>
	<?php echo $sp3?><br>
	<?php echo $sp4?>
	</td>
</tr>
<tr>
    <td style="font-size:12px;padding:5px;">If Other Specify</b></td><td colspan='2'><?php echo $det[oth_lang] ?></td>
</tr>
</table>
</div>
    
    
	<div style="background:#eee;">
	<table  class='tablesty' align='center' cellspacing='2' cellpadding="" width='85%'>
  <tr><td class='head' align='center'colspan="4"><font face="arial" size="3" color="#FFFFFF">STAFF DETAIL</font></td></tr> 
  
<tr>
          <td style="font-size:12px;padding:5px;">Department<font color="#FF0000"><strong>*</strong> </td>
          <td colspan='2'>

<?php
$SQL = "SELECT * FROM dept_no";
$rs = execute($SQL);
$num = rowcount($rs);
for($i=0;$i<$num;$i++){
	$r = fetcharray($rs);
	if($det[subj]==$r[1])
		{
		echo $r[Dept];
		}
}
?> 
</td></tr>
<tr>
     <td style="font-size:12px;padding:5px;">Staff Group<font color="#FF0000"><strong>*</strong></td>
<?php 
if($det[group_id]==1)
{
	$ss1="Teaching";
	$ss2="";
}
if($det[group_id]==2)
{
	$ss2="Non-Teaching";
	$ss1="";
}
?>
	 <td colspan='2'><?php echo $ss1?><?php echo $ss2?>
	</td>
	</select>
</tr>
<tr>
<td style="font-size:12px;padding:5px;">Staff Designation<font color="#FF0000"><strong>*</strong></td>
<td colspan='2'>
<?php
$SQL = "SELECT * FROM staff_des";
$rs = execute($SQL);
$num = rowcount($rs);

for($i=0;$i<$num;$i++)
	{
	$r = fetcharray($rs);
	if($det[stafftype]==$r[d_id])
	{
		echo $r[d_name];
	}
	}

?>
</font></td>
</tr>
<tr>
<td style="font-size:12px;padding:5px;">Staff Type</td>
<td colspan='2'>
<?php
$SQL = "SELECT * FROM staff_type";
$rs = execute($SQL);
$num = rowcount($rs);
for($i=0;$i<$num;$i++){
	$r = fetcharray($rs);
	if($det[type_id]==$r[id])
		{
		echo $r[cname];
	}
}
?>
</td>
</tr>
<tr>
<td style="font-size:12px;padding:5px;">Attach Your Photo</b></td><td colspan='2'><img src='<?php echo $det[photo]?>' width=160 height=160>
</td>
</tr>
<tr><td><font face="Arial">Joined Date</td>
<td><?php 
$da=explode("-",$det["doj"]);
?><?php echo $da[2]."-".$da[1]."-".$da[0] ?></td>

</tr>
  </table>
</div></div></div>

<div id="tab3" class="tab_content">
     <div style="background:#eee;">
   <table  class='tablesty' align='center' width='100%' cellspacing='2' cellpadding="1">
  <tr><td class='head' colspan="8" align='center'><font size="3" color="#FFFFFF">EDUCATION DETIALS</font></td></tr></table>
   <table  class='tablesty' align='center' cellspacing='2' cellpadding="1" width='100%' style="background:#eee;">
   <caption style="font-size:11px;"></b></caption>
   <tbody cellpadding="2">
<tr>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>Institution</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center' WIDTH="180">Year Of Joining<Br>(MM/YYYY)</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center' WIDTH="180">Year Of Passout<Br>(MM/YYYY)</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>Qualification</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>Grade</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>Certificates<Br>Surrendered<Br>(Yes/No)</TD>

</tr>
<tr>
<td style="font-size:12px;" align="center"><b>Secondary</b><br>
<?php echo $dep[edu1]?></td>
<td align="center">
			
<?php 
$dhn=explode("-",$dep[yoj1]);
if ($dhn[0]<10)
{
$dhn[0]="0".$dhn[0];
}
?>

<?php echo $dhn[0]."-".$dhn[1] ?></td>
<td align="center">
	<?php		
			
$dh1=explode("-",$dep["yop1"]);
if ($dh1[0]<10)
{
$dh1[0]="0".$dh1[0];
}
?>

<?php echo $dh1[0]."-".$dh1[1] ?></td>
<td style="font-size:12px;padding:5px;"><?php echo $dep[qa1]?></td>
<td style="font-size:12px;padding:5px;"><?php echo $dep[gr1]?></td>
<?php
	if($dep[cert1]=="1")
	{
	$sp11="Yes";
	}
	else
	{
    $sp11="No";
	}
?>
<td style="font-size:12px;" align="center"><?php echo $sp11?></td>

</tr>
<tr>
<td style="font-size:12px;" align="center"><b>Others</b><br><?php echo $dep[edu2]?></td>
<td align="center">
			
			<?php 
$dhs=explode("-",$dep["yoj2"]);
if ($dhs[0]<10)
{
$dhs[0]="0".$dhs[0];
}
?>
<?php echo $dhs[0]."-".$dhs[1] ?></td>

<td align="center">
			
			<?php 
$dhk=explode("-",$dep["yop2"]);
if ($dhk[0]<10)
{
$dhk[0]="0".$dhk[0];
}
?><?php echo $dhk[0]."-".$dhk[1] ?></td>

<td style="font-size:12px;padding:5px;"><?php echo $dep[qa2]?></td>
<td style="font-size:12px;padding:5px;"><?php echo $dep[gr2]?></td>
<?php
	if($dep[cert2]=="2")
	{
	$sp12="Yes";
	}
	else
	{
    $sp12="No";
	}
?>
<td style="font-size:12px;" align="center"><?php echo $sp12?></td>
</tr>
<tr>
<td style="font-size:12px;" align="center"><b>University</b><br><?php echo $dep[edu3]?></td>
<td align="center">
			
			<?php 
$dh2=explode("-",$dep["yoj3"]);
if ($dh2[0]<10)
{
$dh2[0]="0".$dh2[0];
}
?>
<?php echo $dh2[0]."-".$dh2[1] ?></td>
<td align="center">
			
			<?php 
$dh11=explode("-",$dep["yop3"]);
if ($dh11[0]<10)
{
$dh11[0]="0".$dh11[0];
}
?><?php echo $dh11[0]."-".$dh11[1] ?></td>



		<td style="font-size:12px;padding:5px;"><?php echo $dep[qa3]?></td>
        <td style="font-size:12px;padding:5px;"><?php echo $dep[gr3]?></td>
		<?php
	if($dep[cert3]=="3")
	{
	$sp13="Yes";
	}
	else
	{
    $sp13="No";
	}
?>
	    <td style="font-size:12px;" align="center"><?php echo $sp13?></td>
				
</tr>
</tbody>
   </table>
   </div>
	  <div>
  <table  class='tablesty' align='center' cellspacing='2' cellpadding="" width='100%' style="background:#eee;">
  <tr><td class='head' align='center'colspan="4"><font face="arial" size="3" color="#FFFFFF">INTERESTS</font></td></tr>
  <tr>
	<td style="font-size:12px;padding:5px;" colspan="4">Specialy Interested</b> </td>
  </tr>
<tr>
	<td style="font-size:12px;padding:5px;">Describe the subjects in which you have Authoritative Experience?</b></td><td colspan='2'><?php echo $det[intr1] ?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;" colspan="4">Suitability</b> </td>
  </tr>
<tr>
	<td style="font-size:12px;padding:5px;">Why do you think you are suitable for applying to this position?</b></td><td colspan='2'><?php echo $det[intr2] ?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;" colspan="4">Job Satisfaction</b> </td>
  </tr>
<tr>
	<td style="font-size:12px;padding:5px;">What aspect of your job to the Date have givenyou most Stisfaction?</b></td><td colspan='2'><?php echo $det[intr3] ?></td>
</tr>
  </table>
  </div>
    </div>

	<div id="tab5" class="tab_content">
     <div>
  <table  class='tablesty' align='center' cellspacing='1' cellpadding="1" width='100%'>
  <tr><td class='head' align='center'colspan="9"><font face="arial" size="3" color="#FFFFFF">EXPERIENCE DETAILS</font></td></tr> 
 <table  class='tablesty' align='center' cellspacing='2' cellpadding="1" width='100%' style="background:#eee;">
   <tbody cellpadding="1">
   
<tr>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>Name Of<br>Institution</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>From<BR>(MM/YYYY)</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>To<BR>(MM/YYYY)</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>Worked<BR>(YY/MM)</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>Classes & Subjects<Br>Taught</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>Position Or<Br>Responsibility Held</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>Basic Salary</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>Reasons For Leaving</TD>
</tr>
<?php
$qsql="select * from staff_exp where slno='$id'";
$qrs=execute($qsql);
$qnum=rowcount($qrs);
if($qnum>=1)
{
	for($q=0;$q<$qnum;$q++)
	{
		$dej=fetcharray($qrs);
	?>
<tr>
<td style="font-size:12px;" align="center"><?php echo $dej[inst_name]?></td>
<td align="center">
    <?php 
		$dd=date('d');
        $mm=date('m');
        $yy=date('Y');
$lt=explode('-',$dej[frm_dt]);
$jt=explode('-',$dej[to_dt]);
		
	?>
			<?php
	if($lt[0]<10)
		{
	$lt[0]='0'.$lt[0];
	}
	echo $lt[0]."-".$lt[1]; ?>
				
				</td>

				<td align="center">
			
			<?php 
			if($jt[0]<10)
		{
	$jt[0]='0'.$jt[0];
	}	
			echo $jt[0]."-".$jt[1]; ?>
				</td>
                
<td style="font-size:12px;padding:5px;"><?php echo $dej[yrs_exp]?></td>
<td style="font-size:12px;" align="center"><?php echo $dej[sub_taught]?></td>
<td style="font-size:12px;" align="center"><?php echo $dej[position]?></td>
<td style="font-size:12px;padding:5px;"><?php echo $dej[salary]?></td>
<td style="font-size:12px;" align="center">
<?php echo $dej[leaving_reason]?></td>
</tr>
<?php 
	}

}
?>
</tbody>
</table>	 
	 
	 </table>
	 <?php
	 if(isset($addexp))
	 {
		 if($stafftxt!="")
		 {
			$expfrm=$frmmonth."-".$frmyear;
			$expto=$tomonth."-".$toyear;
			 $sql="insert into staff_exp(slno,inst_name,frm_dt,to_dt,yrs_exp,sub_taught,position,salary,leaving_reason) values('$stafftxt','$inst','$expfrm','$expto','$work','$sub','$resp','$work1','$reason')";
				echo $sql;
		     execute($sql);
		 }
		 else
		 {	 
		 echo "Please Follow The Procedure<br>";
		 }
	 }
	 ?>
	 </div>  
    </div>

	<div id="tab6" class="tab_content">
     <div>
  <table  class='tablesty' align='center' cellspacing='2' cellpadding="" width='100%'>
  <tr><td class='head' align='center'colspan="4"><font face="arial" size="3" color="#FFFFFF">SALARY DETAILS</font></td></tr> 
<tr>
	<td style="font-size:12px;padding:5px;" colspan="4">CURRENT SALARY & BENEFITS</b> </td>
  </tr>
<tr>
	<td style="font-size:12px;padding:5px;">Basic Salary</b></td><td colspan='2'>
	<?php echo $dem[basic_sal]?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Housing Allowance</b></td><td colspan='2'>
	<?php echo $dem[house_allowance]?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Other Allowance</b></td><td colspan='2'>
	<?php echo $dem[oth_all]?></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Other Benefits</b></td><td colspan='2'>
	<?php echo $dem[oth_ben]?></td>
</tr>
<tr>
<td style="font-size:12px;padding:5px;">Attach Copy Of Your Current Pay-Slip</b></td><td colspan='2'><img src='<?php echo $dem[doc_photo]?>' width=160 height=160></td>
</tr>
<tr>
	<td style="font-size:12px;padding:5px;">Salary Expected</b></td><td colspan='2'>
	<?php echo $dem[salary_exp]?></td>
</tr>

</table>
 <div>
  <table  class='tablesty' align='center' cellspacing='2' cellpadding="" width='100%'>
  <tr><td class='head' align='center'colspan="4"><font face="arial" size="3" color="#FFFFFF">PROFESSIONAL REFERENCES</font></td></tr> 
<tr>
	<td style="font-size:12px;padding:5px;" colspan="4">List Two Professional Referees:(Referees will not be approached until after final interview,but only &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;with your permission.)</b> </td>
  </tr>
<table  class='tablesty' align='center' cellspacing='2' cellpadding="1" width='100%' style="background:#eee;">
   <caption style="font-size:12px;"></b></caption>
   <tbody cellpadding="2">
<tr>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>NAME</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>ADDRESS</TD>
<TD style="font-size:12px;COLOR:#FFF;" class='head' ALIGN='center'>DESIGNATION</TD>
</tr>
<tr>
<td style="font-size:12px;padding:5px;" align="center"> 
<?php echo $dem[ref_name1]?></td>
<td style="font-size:12px;" align="center"><?php echo $dem[ref_add1]?></td>
<td style="font-size:12px;padding:5px;"><?php echo $dem[des1]?></td>
</tr>
<tr>
<td style="font-size:12px;padding:5px;" align="center">
<?php echo $dem[ref_name2]?></td>
<td style="font-size:12px;" align="center"><?php echo $dem[ref_add2]?></td>
<td style="font-size:12px;padding:5px;">
<?php echo $dem[des2]?></td>
</tr>
<?php
  if($dem[ed_sts]==1)
{
	$a1="Yes";
	$a2="";
}
if($dem[ed_sts]==2)
{
	$a2="No";
	$a1="";
}?>
<tr>
    <td style="font-size:12px;padding:5px;">Do You Know Any Person In The Employment Of The Education Board?</b></td><td colspan='2'>
    <?php echo $a1 ?><br>
	 <?php echo $a2 ?></td>
</tr>
<tr>
    <td style="font-size:12px;padding:5px;">If Yes Specify Name & Designation</b></td><td colspan='2'> <?php echo $dem[des]?></td>
</tr>
</table>
</table>
</div>
</div>
	 </div> 
<?php 
	 $sd=execute("select * from staff_salr_current where slno='$id'");
	 $Fetsd=fetcharray($sd);
	 ?>
<div id="tab7" class="tab_content">
     <div>
  <table  class='tablesty' align='center' cellspacing='2' cellpadding="" width='100%'>
  <tr><td class='head' align='center'colspan="4"><font face="arial" size="3" color="#FFFFFF">CURRENT SALARY DETAILS</font></td></tr>
  <tr><td colspan='2'><B>GROSS SALARY</B></td><td colspan='2'><B>DEDUCTIONS</B></td></tr>
  <tr><td colspan='4'>&nbsp;</td></tr>
  <tr><td>BASIC SALARY : </td><td><INPUT TYPE='text' name='bsicsal' value='<?php echo $Fetsd[basic_salr] ?>' class='text'  ALIGN='RIGHT'></td><td>PAYE</td><td><INPUT TYPE='text' name='paye' value='<?php echo $Fetsd[paye_salr] ?>'></td></tr>
  <tr><td>HOUSING ALLOWANCE : </td><td><INPUT TYPE='text' name='ha' value='<?php echo $Fetsd[ha_salr] ?>'></td><td>NSSF</td><td><INPUT TYPE='text' name='naaf' value='<?php echo $Fetsd[nssf_salr] ?>'></td></tr>
  <tr><td>MEDICAL : </td><td><INPUT TYPE='text' name='med' value='<?php echo $Fetsd[med_salr] ?>'></td><td>ADVANCE</td><td><INPUT TYPE='text' name='adv' value='<?php echo $Fetsd[advn_salr] ?>'></td></tr>
  <tr><td>OVER TIME : </td><td><INPUT TYPE='text' name='ot' value='<?php echo $Fetsd[ot_salr] ?>'></td><td>TUICO</td><td><INPUT TYPE='text' name='tuico' value='<?php echo $Fetsd[tuico_salr] ?>'></td></tr>
  <tr><td>LEAVE SOLD : </td><td><INPUT TYPE='text' name='ls' value='<?php echo $Fetsd[ls_salr] ?>'></td><td>ABSENT</td><td><INPUT TYPE='text' name='abst' value='<?php echo $Fetsd[abst_salr] ?>'></td></tr>
  <tr><td>ARREARS : </td><td><INPUT TYPE='text' name='arr' value='<?php echo $Fetsd[arr_salr] ?>'></td><td COLSPAN='2'></td></tr>
  <tr><td>TAXABLE INCOME : </td><td><INPUT TYPE='text' name='taxinc' value='<?php echo $Fetsd[ti_salr] ?>'></td>
  <td>TOTAL DEDUCTIONS</td><td><INPUT TYPE='text' name='totdud' onclick='dectot()' value='<?php echo $Fetsd[ded_salr] ?>' readonly></td></tr>
  <tr><td>TOTAL SALARY : </td><td><INPUT TYPE='text' name='totsal' value='<?php echo $Fetsd[totgross_salr] ?>' onclick='gettot()' readonly></td><td>NET PAY</td><td><INPUT TYPE='text' name='ntpay' onclick='nettot()' readonly value='<?php echo $Fetsd[net_salr] ?>'></td></tr>
  <TR><td></td><td></td><td></td><td></td></tr>
  </table></div></div>

<div>
	<ul class="tabs">
      <li><a href="#tab1">Staff Information</a></li>
	  <li><a href="#tab3">Education</a></li>
	  <li><a href="#tab5">Staff Experience</a></li>
	  <li><a href="#tab6">Old Salary</a></li>
	  <li><a href="#tab7">Current Salary</a></li>
	</ul>
</div>
</form>
</BODY>
</HTML>
