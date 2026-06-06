<?php
session_start();
require("../db.php");

$SchoolCode=$_SESSION['SchoolCode'];
$user = $_POST['user'];
$f_name = $_POST['f_name'];
$s_name = $_POST['s_name'];
$Gender = $_POST['Gender'];
$dobDay = $_POST['dobDay'];
$dobMon = $_POST['dobMon'];
$dobYear = $_POST['dobYear'];
$bg = $_POST['bg'];
$ms = $_POST['ms'];
$mobileno = $_POST['mobileno'];
$email = $_POST['email'];
$father = $_POST['father'];
$religion = $_POST['religion'];
$bank = $_POST['bank'];
$bank_ac_no = $_POST['bank_ac_no'];
$pf_ac_no = $_POST['pf_ac_no'];
$pan_no = $_POST['pan_no'];
$xtra = $_POST['xtra'];
$assoc = $_POST['assoc'];
$cert = $_POST['cert'];
$cmts = $_POST['cmts'];


$subj = $_POST['subj'];
$staff_id = $_POST['staff_id'];
$staff_group = $_POST['staff_group'];
$stype = $_POST['stype'];
$sstatus = $_POST['sstatus'];
$category = $_POST['category'];
$scard = $_POST['scard'];
$RecPro = $_POST['RecPro'];
$AppDay = $_POST['AppDay'];
$AppMon = $_POST['AppMon'];
$AppYear = $_POST['AppYear'];
$JDay = $_POST['JDay'];
$JMon = $_POST['JMon'];
$JYear = $_POST['JYear'];
$other_facilities = $_POST['other_facilities'];
$other_responsibilities = $_POST['other_responsibilities'];

$course = $_POST['course'];
$specialization = $_POST['specialization'];
$yearpass = $_POST['yearpass'];
$college = $_POST['college'];
$univers = $_POST['univers'];
$regno = $_POST['regno'];
$boardname = $_POST['boardname'];

$exp_type = $_POST['exp_type'];

$post  = $_POST['post'];
$Organisation  = $_POST['Organisation'];
$city   = $_POST['city'];
$country  = $_POST['country'];
$FrDay  = $_POST['FrDay'];
$FrMon  = $_POST['FrMon'];
$FrYear  = $_POST['FrYear'];
$LaDay  = $_POST['LaDay'];
$LaMon  = $_POST['LaMon'];
$LaYear  = $_POST['LaYear'];
$flag  = $_POST['flag'];
$dname  = $_POST['dname'];
$drel  = $_POST['drel'];
$dep_addr  = $_POST['dep_addr'];
$d_phone  = $_POST['d_phone'];
$doccu  = $_POST['doccu'];
$flag1  = $_POST['flag1'];
$flag2  = $_POST['flag2'];
$addr_pres  = $_POST['addr_pres'];
$addr_perm  = $_POST['addr_perm'];
$ct_pres  = $_POST['ct_pres'];
$ct_perm  = $_POST['ct_perm'];
$state_pres  = $_POST['state_pres'];
$state_perm  = $_POST['state_perm'];
$pin_pres  = $_POST['pin_pres'];
$pin_perm  = $_POST['pin_perm'];
$ph_pres  = $_POST['ph_pres'];
$ph_perm  = $_POST['ph_perm'];
$uploadedfile  = $_POST['uploadedfile'];
$B1  = $_POST['B1'];

$addquali  = $_POST['addquali'];
$ModifyjobDet  = $_POST['ModifyjobDet'];
$jodadd  = $_POST['jodadd'];
$depmod  = $_POST['depmod'];
$depadd  = $_POST['depadd'];

$phid = $_POST['phid'];
$phfg = $_POST['phfg'];
$cid = $_POST['cid'];
$did = $_POST['did'];
$qid = $_POST['qid'];
$phpath = $_POST['phpath'];
$pth = $_POST['pth'];

$tempimgpath = $_POST['tempimgpath'];
$leav_type=$_POST['leav_type'];


if($subj!='')
{
	$res_dep = execute("select dept_code from dept_no where dpt_id = '$subj'");
	$row_dep = mysql_fetch_assoc($res_dep);
	
	$res_staff = execute("select max(id) as id from staff_det ");
	$staff_row = mysql_fetch_assoc($res_staff);

	$res_slno = execute("select max(id) from staff_det ");
	$row_slno = fetchrow($res_slno);
	$nxt=$row_slno[0];
	 $nxt = $nxt+1;
	if($nxt<10)
		$nxt="000".$nxt;
	elseif($nxt<100)
		$nxt="00".$nxt;
	elseif($nxt<1000)
		$nxt="0".$nxt;
	$staff_id = $SchoolCode.$nxt;
	
}
else
{
	$staff_id = '';	
}

if($flag=="")	
{
	$sql="delete from temp_previous_job where username='$user'";
	execute($sql);
}
if($flag1=="")	
{
	$sql="delete from tempstaff_qualification where username='$user'";
	execute($sql);
}
if($flag2=="")
{
	$sql=execute("delete from temp_staff_dependents where username='$user'");
}
if(isset($addquali)) 
	{
	if(empty($course) && empty($yearpass) && empty($univers))	
	{
		
	}
else
	{
		$queryget = "SELECT MAX( id ) FROM tempstaff_qualification";
		$mod1=execute($queryget );	
		$mod2=fetcharray($mod1);
		$qid1 = $mod2[0];
		$qid1 = $qid1 + 1;
		$sql="insert into tempstaff_qualification(id,course_name,year_pass,university,reg_date,name_board,college,specialization,username) values('$qid1','$course','$yearpass','$univers','$regno','$boardname','$college','$specialization','$user')";
		execute($sql) or die(mysql_error());
		$flag1=1;
	}
}

if(isset($modifyquali)) 
{
	while( list(,$Value) = each($qid) )	
	{
		
		$course = $_POST["course" . $Value];		
		$yearpass = $_POST["yearpass" . $Value];
		$univers = $_POST["univers" . $Value];
		$country = $_POST["country" . $Value];
		$regno = $_POST["regno" . $Value];
		$boardname = $_POST["boardname" . $Value];
		$specialization = $_POST["specialization" . $Value];
		$college = $_POST["college" . $Value];
		
		$sqlstr = "Update tempstaff_qualification set course_name ='$course',year_pass='$yearpass',";
		$sqlstr.="university ='$univers',reg_date='$regno',name_board='$boardname',college='$college',specialization='$specialization',username='$user' where id=$Value";
		execute($sqlstr) or die(mysql_error());
		$flag1=1;
	}
}
if(isset($jodadd))
{
	$lastdate=$LaYear."-".$LaMon."-".$LaDay;
	$todate=$FrYear."-".$FrMon."-".$FrDay;
	if(empty($post) && empty($Organisation))
	{
	}
	else
	{
		$queryget = "SELECT MAX( id ) FROM temp_previous_job";
		$mod1=execute($queryget );	
		$mod2=fetcharray($mod1);
		$jid = $mod2[0];
		$jid = $jid + 1;
		
	$sql="insert into temp_previous_job (id,prev_post,prev_work_place,prev_work_city,prev_work_country,last_date_work,from_date,username,exp_type) values('$jid','$post','$Organisation','$city','$country','$lastdate','$todate','$user','$exp_type')";
	execute($sql) or die(mysql_error());
	$flag=1;
	}
}

if(isset($ModifyjobDet))	{
	while( list(,$Value) = each($cid))	{
		
		$postj = $_POST["post" . $Value];

		
		$cityj = $_POST["city" . $Value];

		
		$workplacej = $_POST["workplace" . $Value];

		
		$countryj = $_POST["country" . $Value];

		
		$expyrj = $_POST["expyr" . $Value];

		
		$LaDayj = $_POST["LaDay" . $Value];

		
		$LaMonj = $_POST["LaMon" . $Value];

		
		$LaYearj = $_POST["LaYear" . $Value];

		
		$FrDayj = $_POST["FrDay" . $Value];

		
		$FrMonj = $_POST["FrMon" . $Value];

		
		$FrYearj = $_POST["FrYear" . $Value];

		$lastdate=$LaYearj."-".$LaMonj."-".$LaDayj;
		$todate=$FrYearj."-".$FrMonj."-".$FrDayj;
		
		
		$exp_typej = $_POST["exp_type".$Value];
		
		$sqlstr = "Update temp_previous_job set prev_post='$postj',prev_work_place='$workplacej',";
		$sqlstr.="prev_work_city='$cityj',prev_work_country='$countryj',last_date_work='$lastdate',from_date='$todate',username='$user',exp_type='$exp_typej' where id=$Value";
		execute($sqlstr) or die(mysql_error());
		$flag=1;
	}
}

 
if(isset($depadd))
{
	if(empty($drel) && empty($dname))
	{
	}
	else
	{
		$queryget = "SELECT MAX( id ) FROM temp_staff_dependents";
		$mod1=execute($queryget );	
		$mod2=fetcharray($mod1);
		$did = $mod2[0];
		$did = $did + 1;
		
	$sql="insert into temp_staff_dependents(id,username,dname,drel,doccu,d_addr,d_phone) values('$did','$user','$dname','$drel','$doccu','$dep_addr','$d_phone')";
	execute($sql);
	$flag2=2;
	}
}
if(isset($depmod))
{
	
	//if($did>0)
	{
		while(list(,$Value)=each($did))
		{
			
			$dname = $_POST["dname".$Value];
			
			
			$drel = $_POST["drel".$Value];
			
			
			$doccu = $_POST["doccu".$Value];
			
			
			$dep_addr12 = $_POST["dep_addr".$Value];
			
			
			$d_phone = $_POST["d_phone".$Value];			
			
			$depupd=execute("update temp_staff_dependents set dname='$dname',drel='$drel',doccu='$doccu',d_addr='$dep_addr12',d_phone='$d_phone' where id=$Value");
			$flag2=2;
		}
	}
}
?>
<html>
<head>
<title>Enter New Staff Details </title>
<script>
function OpenWind3(URL, title,w,h)
{
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<script language="JavaScript">
function validate_me(){
	if(document.frm.f_name.value == ''){
		alert("Please provide a name to Staff");
		document.frm.f_name.focus();
		return false;
	}else if(document.frm.subj.value == ''){
		alert("Please select a Department");
		document.frm.subj.focus();
		return false;
	}else if(document.frm.staff_group.value == '-1'){
		alert("Please select a Staff Group");
		document.frm.staff_group.focus();
		return false;
	}else if(document.frm.stype.value == '-1'){
		alert("Please select a Staff Designation Type");
		document.frm.stype.focus();
		return false;
	}
	return true;
}
function send()
{
 if(validate_me()){
 document.frm.method="POST";
 document.frm.action="updatestaff.php";			 
 document.frm.submit();
 }else{
 	return false;
 }
}
function sho()
{
	document.frm.action="update.php";
	document.frm.submit();
}

function reload1()
	{
		document.frm.action="update.php";
		document.frm.submit();
	}
	function OpenWind(k)
{
	var finalVar;
	finalVar=k;
	window.open(finalVar,'Stud','height=600,width=750,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
</head>
<body>
<form method="POST" name="frm" ENCTYPE="multipart/form-data" action="update.php"  >
<?php
/*
	if($phid=='')
	{
		$phfg=1;
		//$phid=$REMOTE_ADDR."_".date("YmdHis");
		$phid=date("YmdHis");
		$pth="../staff_images/temp/".$phid.".jpg";
	}
	else
	{
		$phid=str_replace(".jpg","","$phid");
		$pth="../staff_images/temp/".$phid.".jpg";
		$phfg=2;
	}
	$phpath="../staff_images/temp/";
?>
<input type='hidden' name='phid' value='<?=$phid?>'>
<input type='hidden' name='phfg' value='<?=$phfg?>'>
<table width="90%" border="0" align="center" cellpadding="0">
<tr><td Class="Head" align="center">Staff Recruitment Form</td></tr>
<tr><td align='center'><table border='0' align='center' width='90%' class='forumline'>
<tr><td width='10%' align='center'><a href="javascript:OpenWind('../photobooth/index.php?phid=<?=$phid?>&phpath=<?=$phpath?>')"><img src="../staff_images/temp/".$phid.".jpg"  title="Click to Capture Photo" border="1"></img>
</a>
<?php
if($_REQUEST['phid'] and !$_POST)
{
       $tempimgpath="../staff_images/temp/".$_REQUEST['phid'];
}
else
{
       $tempimgpath=$_POST['tempimgpath'];
}
echo "<input type='hidden' name='tempimgpath' value='$tempimgpath'> ";
?>
</td><td align='center' width='10%'>
<?php
echo "<img src='$tempimgpath'  width='75' height='85' border='1'>"
?>
</img></td></tr></table></td></tr>

*/
?>
<tr><td><table width="98%" border="0" cellpadding="0" class="forumline" align="center">
<tr><td class="row3" colspan='4'>Personal Details</td></tr>
<tr align="center">
	<td align="left">&nbsp;&nbsp;First Name </td>
	<td align="left">
	  <input type="text" name="f_name" size="30" value='<?=$f_name?>' onKeyDown="return checkit(event)">
	</td>
	<td align="left">Sur Name </td>
	<td align="left">
	  <input type="text" name="s_name" size="30" value='<?=$s_name?>' onKeyDown="return checkit(event)">
	</td>
</tr>
<tr align="center">
	<td align="left">&nbsp;&nbsp;Gender</td>
	<td align="left">
    <select name="Gender">
      <option value=0>--Select--</option>
      <?php
    	$tempml="";
    	$tempfml="";
    	if($Gender=="MALE")
    	{
    		$tempml="selected";
    		$tempfml="";
    	}
    	elseif($Gender=="FEMALE")
    	{
    		$tempfml="selected";
    		$tempml="";
    	}
	?>
      <option value="MALE" <?=$tempml?>>Male</option>
      <option value="FEMALE" <?=$tempfml?>>Female</option>
    </select>
	</td>
   <td align="left">Date of Birth</td>
	<td align="left"><?php
	$d=getdate();
	$MyDay=$d["mday"];
	if($dobDay != ''){
		$MyDay = $dobDay;
	}
	//Day
	echo "<select name='dobDay' >";
	for($i=1;$i<=31;$i++){
		if($i == $MyDay)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	
	echo "</select>";
     

	 $MyMonth=$d["mon"];
	if($dobMon != ''){
		$MyMonth = $dobMon;
	}
	//Month
	echo "<select name='dobMon'>";
	for($i=1;$i<=12;$i++)
	{
		if($i == $MyMonth)
			echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i'>" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
	
	$maxYr =$d["year"]+1;
	$MyYear=$d["year"];
	if($dobYear!=''){
		$MyYear	= $dobYear;
	}
	echo "<select name='dobYear'>";
	for($i=1940;$i<=$maxYr;$i++)
	{
		if($i == $MyYear)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
        $dorDay=$dobDay;
        $dorMon=$dobMon;
        $dorYear=$dobYear+58;
?></td>
</tr>
<tr align="center"><td align="left" height="25">&nbsp;&nbsp;Blood Group</td>
<td align="left" height="25"><select name="bg" size="1">
  <option value=0>-- Select --</option>
  <?php
$bg1="";
$bg2="";
$bg3="";
$bg4="";
$bg5="";
$bg6="";
$bg7="";
$bg8="";
$bg9="";
if($bg=="NA")
{
	$bg1="selected";
	$bg2="";
	$bg3="";
	$bg4="";
	$bg5="";
	$bg6="";
	$bg7="";
	$bg8="";
	$bg9="";
}
elseif($bg=="A+ve")
{
	$bg1="";
	$bg2="selected";
	$bg3="";
	$bg4="";
	$bg5="";
	$bg6="";
	$bg7="";
	$bg8="";
	$bg9="";
}
elseif($bg=="B+ve")
{
	$bg1="";
	$bg2="";
	$bg3="selected";
	$bg4="";
	$bg5="";
	$bg6="";
	$bg7="";
	$bg8="";
	$bg9="";
}
elseif($bg=="A-ve")
{
	$bg1="";
	$bg2="";
	$bg3="";
	$bg4="selected";
	$bg5="";
	$bg6="";
	$bg7="";
	$bg8="";
	$bg9="";
}
elseif($bg=="B-ve")
{
	$bg1="";
	$bg2="";
	$bg3="";
	$bg4="";
	$bg5="selected";
	$bg6="";
	$bg7="";
	$bg8="";
	$bg9="";
}
elseif($bg=="O+ve")
{
	$bg1="";
	$bg2="";
	$bg3="";
	$bg4="";
	$bg5="";
	$bg6="selected";
	$bg7="";
	$bg8="";
	$bg9="";
}
elseif($bg=="O-ve")
{
	$bg1="";
	$bg2="";
	$bg3="";
	$bg4="";
	$bg5="";
	$bg6="";
	$bg7="selected";
	$bg8="";
	$bg9="";
}
elseif($bg=="AB+ve")
{
	$bg1="";
	$bg2="";
	$bg3="";
	$bg4="";
	$bg5="";
	$bg6="";
	$bg7="";
	$bg8="selected";
	$bg9="";
}
elseif($bg=="AB-ve")
{
	$bg1="";
	$bg2="";
	$bg3="";
	$bg4="";
	$bg5="";
	$bg6="";
	$bg7="";
	$bg8="";
	$bg9="selected";
	}
?>
  <option value="NA" <?=$bg1?>>NA</option>
  <option value="A+ve" <?=$bg2?>>A Rh Positive</option>
  <option value="B+ve" <?=$bg3?>>B Rh Positive</option>
  <option value="AB+ve" <?=$bg8?>>AB Rh Positive</option>
  <option value="O+ve" <?=$bg6?>>O Rh Positive</option>
  <option value="A-ve" <?=$bg4?>>A Rh Negative</option>
  <option value="B-ve" <?=$bg5?>>B Rh Negative</option>
  <option value="AB-ve" <?=$bg9?>>AB Rh Negative</option>
  <option value="O-ve" <?=$bg7?>>O Rh Negative</option>
</select></td>
<td  align="left">Marital Status</td>
  <td  align="left"><select name="ms" size="1">
    <?
if($ms=="Married")
{
	$ms_sel1="selected";
	$ms_sel2="";
}else
{
	$ms_sel2="selected";
	$ms_sel1="";
}
?>
    <option value="Married" <?=$ms_sel1?>>Married</option>
    <option value="Unmarried" <?=$ms_sel2?>>Unmarried</option>
  </select></td>
</tr>
<tr align="center">
	<td align="left">&nbsp;&nbsp;Mobile No.&nbsp;&nbsp;(SMS Alert)</td>
	<td align="left">
	  <input type="text" name="mobileno" size="15" value='<?=$mobileno?>' maxlength='10'>
	</td>
<td align="left">Email&nbsp;&nbsp;(E-Mail Alert)</td>
	<td align="left">
	  <input type="text" name="email" size="40" value="<?=$email?>">
	</td>
</tr>
<tr align="center">
  <td  align="left">&nbsp;&nbsp;Fathers/Husband Name</td>
  <td  align="left"><input type="text" name="father" size="30" value="<?=$father?>" ></td>
  <td align="left">Religion</td>
  <td  align="left"><select name='religion'>
    <option value=0>-- Select Religion --</option>
    <?
		$qry=execute("select * from religion");
		for($s=0;$s<rowcount($qry);$s++)
		{
			$ff=fetcharray($qry,$s);
			if($religion==$ff[id])	{
			$gg="selected";
			}else	{
						$gg="";
			}
	?>
    <option value="<?=$ff[id]?>" <?=$gg?>>
      <?=$ff[name]?>
      </option>
    <?	}
	?>
  </select></td>
  </tr>
<tr align="center">
	<td align="left">&nbsp;&nbsp;Bank</td>
	<td align="left"><select name="bank">
	  <option value=''>--Select--</option>
	  <?php
$bank11=execute("select * from bank_details where status=1 order by bank_name");
while($bank1=fetcharray($bank11))
{
	if($bank1[bank_name]==$bank)
	{
		echo "<option value='$bank1[bank_name]' selected>$bank1[bank_name]</option>";
	}
	else
	{
		echo "<option value='$bank1[bank_name]'>$bank1[bank_name]</option>";
	}
}
?>
	  </select></td>	
	<td align="left">Bank A/C No</td>
	<td align="left">
	  <input type="text" name="bank_ac_no" size="30" value='<?=$bank_ac_no?>' onKeyDown="return check(event)">
	</td>
</tr>
<tr align="center">
<td align="left">&nbsp;&nbsp;PF A/C No.</td>
<td align="left">
  <input type="text" name="pf_ac_no" size="30" value='<?=$pf_ac_no?>' onKeyDown="return check(event)">
</td>
  <td  align="left">PAN No.</td>
  <td align="left">
    <input type="text" name="pan_no" size="30" value='<?=$pan_no?>' onKeyDown="return check(event)">
  </td>
</tr>
<tr>
  <td align="left" valign="top">&nbsp;&nbsp;Extra Curricular Activities</td>
  <td  align="left"><input type="text" name="xtra" size="30" value="<?=$xtra?>"></td>
 <td align="left">Association(Membership of professional Bodies)</td>
  <td align="left"><input type="text" name="assoc" size="30" value="<?=$assoc?>"></td>  
</tr>
<tr>
<td align="left" valign="top">&nbsp;&nbsp;Rank/Merits/Certificates/Credits Achieved</td>
	<td align="left"><textarea name="cert" rows=4 cols=40 wrap><?=$cert?></textarea></td>
	<td align="left" valign="top">Comments</td>
  <td  align="left"><textarea rows="4" name="cmts" cols="40" wrap ><?=$cmts?>
  </textarea></td>	
</tr>
</table></td></tr>
  <tr><td>
<table width="98%" border="0" cellpadding="0" class="forumline" align="center">
<tr>	
<td colspan='4' class="row3"><a name="UP">Office Details</a></td></tr>
<tr align="center" height='30'>
  <td align="left">&nbsp;&nbsp;Department </td>
  <td align="left">  

      <select name="subj" size="1" onChange="reload1()">
        <option value="" selected>-- Select a Department --</option>
        <?php
$SQL = "SELECT * FROM dept_no";
$rs1 = execute($SQL);
$num = rowcount($rs1);
for($i=0;$i<$num;$i++){
	$r2 = fetcharray($rs1,$i);
	if($r2["dpt_id"] == $r[subj]){
?>	       <option selected value="<?php echo $r2[dpt_id]?>">   <?php echo $r2[0]?>   </option>
<?php 	}elseif($r2["dpt_id"] == $subj){
?>	       <option selected value="<?php echo $r2[dpt_id]?>">   <?php echo $r2[0]?>   </option>
        <?php
	}else{
?>        <option value="<?php echo $r2[1]?>"> <?php echo $r2[0]?>   </option>
        <?php
	}
}
?>  </select>  
  </td>
  <td align="left" nowrap>Staff Id</td>
  <td align="left"><input type="text" name="staff_id" size="20" value="<?=$staff_id?>" >&nbsp;<!--<a href="javascript:void(0);" onClick ="OpenWind3('staffview.php?id=<?=$r6[0]?>', 'OpenWind3',400,400)">Reporting Manager</a>--></td>
</tr>
<tr align="center" height='30'>
        <td align="left">&nbsp;&nbsp;Staff Group </td>
	<td align="left"><select size="1" name="staff_group" onChange="reload1()">	
	<option value='-1'>--Select--</option>
<?
	$mm=execute("select * from staff_group where status=1");
	for($k=0;$k<rowcount($mm);$k++)
	{
		$fmm=fetcharray($mm);
		if($staff_group==$fmm[id])
		{
			echo "<option value=$fmm[id] selected>$fmm[name]</option>";
		}else
		{
			echo "<option value=$fmm[id]>$fmm[name]</option>";
		}
	}
?>
</select>
<td align="left">Staff Designation</td>
<td align="left">
<select name="stype" size="1">
<option value='-1'>--Select Designation--</option>
<?php
$SQL = "SELECT * FROM staff_des where group_id=$staff_group order by d_name";
$rs = execute($SQL);
$num = rowcount($rs);

for($i=0;$i<$num;$i++){
	$r = fetcharray($rs,$i);
	if($stype==$r[d_id])
	{
?>
		<option value="<?=$r["d_id"]?>" selected><?=$r["d_name"]?></option>
<?php
	}
	else
	{?>
		<option value="<?=$r["d_id"]?>"><?=$r["d_name"]?></option>
	<?php
	}
}
?>
</select> 
</td>
</tr>
<tr align="center" height='30'>
<td align="left">&nbsp;&nbsp;Staff Type</td>
<td align="left"><select size="1" name="sstatus">
<option value=-1>--Select--</option>
<?php
$SQL = "SELECT * FROM staff_status where status=1";
$rs = execute($SQL);
$num = rowcount($rs);
for($i=0;$i<$num;$i++){
	$r = fetcharray($rs,$i);
	if($sstatus==$r[id]){
		echo "<option value='" . $r["id"] . "' selected>" . $r["name"] . "</option>";
	}
	else{
		echo "<option value='" . $r["id"] . "'>" . $r["name"] . "</option>";
	}
}
?>
</select></td>
  <td align="left">Category</td>
  <td align="left"><select name=category>
    <option value=0>-- Select Catogory --</option>
    <?
		$qry=execute("select * from category");
		for($s=0;$s<rowcount($qry);$s++)
		{
			$ff=fetcharray($qry,$s);
			if($category==$ff[id])
			{
	?>
    <option value="<?=$ff[id]?>" selected>
      <?=$ff[name]?>
      </option>
    <?
		}
			else
			{
				?>
    <option value="<?=$ff[id]?>">
      <?=$ff[name]?>
      </option>
    <?
		}
		}
	?>
  </select></td>
</tr>
<tr align="center" height='30'>
<td align="left">&nbsp;&nbsp;Swap card number</td>
  <td  align="left"><input type="text" name="scard" size="30" value=<?=$scard?> ></td>
<td align="left">User Type</td>
	<td align="left">
	<select name="RecPro">
<?php
$tempr="";
$tempr1="";
if($RecPro=="User")
{
	$tempr="selected";
	$tempr1="";
}
elseif($RecPro=="Nonuser")
{
	$tempr1="selected";
	$tempr="";
}
?>
	<option value="User" <?=$tempr?>>User</option>
	<option value="Nonuser" <?=$tempr1?>>Non-user</option>
</select>
</td></tr>
<tr height='30'><td>&nbsp;&nbsp;Appointment Order Date</td><td>
  <?php
$d=getdate();
$MyDay=$d["mday"];
if($AppDay!=''){
	$MyDay = $AppDay; 
}

echo "<select name='AppDay'>";
	for($i=1;$i<=31;$i++){
	if($i == $MyDay)
		echo "<option value='$i' selected>$i</option>\n";
	else
		echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	

$MyMonth=$d["mon"];
if($AppMon!=''){
	$MyMonth=$AppMon;
}
//Month
echo "<select name='AppMon' >";
	for($i=1;$i<=12;$i++)
	{
		if($i == $MyMonth)
			echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i' >" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
	//Year
$maxYr =$d["year"]+1;
$MyYear=$d["year"];
if($AppYear!=''){
	$MyYear=$AppYear;
}
	echo "<select name='AppYear' >";
	for($i=1940;$i<=$maxYr;$i++)
	{
		if($i == $MyYear)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
echo "<input type=hidden name=AD >";
?>
</td><td>Joined Date</td>
<td>
<?php
$d=getdate();
$MyDay=$d["mday"];
if($JDay!=''){
	$MyDay=$JDay;
}
//Day
echo "<select name='JDay' >";
echo "<option></option>";
	for($i=1;$i<=31;$i++){
	if($i == $MyDay)
		echo "<option value='$i' selected>$i</option>\n";
	else
		echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	

$MyMonth=$d["mon"];
if($JMon!=''){
	$MyMonth=$JMon;
}
//Month
echo "<select name='JMon' >";
echo "<option></option>";
	for($i=1;$i<=12;$i++)
	{
		if($i == $MyMonth)
			echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i' >" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
//Year
$maxYr =$d["year"]+1;
$MyYear=$d["year"];
if($JYear!=''){
	$MyYear=$JYear;
}
echo "<select name='JYear' >";
echo "<option></option>";
	for($i=1940;$i<=$maxYr;$i++)
	{
		if($i == $MyYear)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
?>
</td></tr>
<tr align="center" height='30'>
	<td align="left" valign="top">&nbsp;&nbsp;Facilities Offered</td>
	<td align="left"><textarea name="other_facilities" rows=4 cols=30 wrap> <?=$other_facilities?> </textarea></td>
	<td align="left" valign="top">Responsibilities</td>
	<td align="left"><textarea name="other_responsibilities" rows=4 cols=30 wrap><?=$other_responsibilities?></textarea></td>
</tr>
 <tr>
        <td>
         <br>
        <b>Leave Type *</b></td>
        <td colspan="3">
        <br>
        <?php
		//select leave_name,id from staff_leave_type where status=1 and id!='2' and id!='5'
        $leavtype=execute("select leave_name,id from staff_leave_type where status=1 and id!='2' and id!='5'");
        while($leavedisplay=fetcharray($leavtype))
        {
			$stcds=fetcharray(execute("select id from staff_leave_type_group where staff_id='$id1' and leave_type='$leavedisplay[1]' and status=1"));
			
			if($stcds[0])
			$check11='checked';
			else
			$check11='';
		?>
        <input type="checkbox" name="leav_type[]" value="<?=$leavedisplay[1]?>" <?=$check11?>>
        &nbsp;
        <?=$leavedisplay[0]?>
        &nbsp;&nbsp;
		<?php
        }
		?>
        </td>
        </tr>
</table></td></tr>
<table class="forumline"  width="98%" align="center">
	<tr align="center">
		<td colspan="2" align="left" class="row3"><div align="left">Present Address</td>
		<td colspan="2" align="left" class="row3"><div align="left"><input type="checkbox" onClick="copyadd()">
		  Permanent Address is Same as Present Address</td>
		  
	</tr>
	<tr align="center">
		<td valign="top" align="left">&nbsp;&nbsp;Address</td>
		<td valign="top" align="left">
		  <textarea rows="4" name="addr_pres" wrap cols="30" ><?=$addr_pres?>
		  </textarea>
		</td>
		<td align="left" valign="top">Address</td>
		<td align="left">
		  <textarea rows="4" name="addr_perm" wrap cols="30" ><?=$addr_perm?>
		  </textarea>
		</td>
	</tr>
	<tr align="center">
		<td align="left"><div align="left">&nbsp;&nbsp;City</td>
		<td align="left">
		  <input type="text" name="ct_pres" size="30" value="<?=$ct_pres?>"  onKeyDown="return checkit(event)">
		</td>
		<td align="left">City</td>
		<td align="left">
		  <input type="text" name="ct_perm" size="30" value="<?=$ct_perm?>" onKeyDown="return checkit(event)">
		</td>
	</tr>
	<tr align="center">
		<td align="left"><div align="left">&nbsp;&nbsp;State</td>
		<td align="left">
		  <input type="text" name="state_pres" size="30" value="<?=$state_pres?>"  onKeyDown="return checkit(event)">
		</td>
		<td align="left">State</td>
		<td align="left">
		  <input type="text" name="state_perm" size="30" value="<?=$state_perm?>" onKeyDown="return checkit(event)">
		</td>
	</tr>
	<tr align="center">
		<td align="left"><div align="left">&nbsp;&nbsp;Pin</td>
		<td align="left">
		  <input type="text" name="pin_pres" size="30" value="<?=$pin_pres?>"  onKeyDown="return check(event)">
		</td>
		<td align="left">Pin</td>
		<td align="left">
		  <input type="text" name="pin_perm" size="30" value="<?=$pin_perm?>" onKeyDown="return check(event)">
		</td>
	</tr>
	<tr align="center">
		<td align="left"><div align="left">&nbsp;&nbsp;Phone</td>
		<td align="left">
		  <input type="text" name="ph_pres" size="30" value="<?=$ph_pres?>"  onKeyDown="return check(event)">
		</td>
		<td align="left">Phone</td>
		<td align="left">
		  <input type="text" name="ph_perm" size="30" value="<?=$ph_perm?>" onKeyDown="return check(event)">
		</td>
	</tr>
	<?php
	if($phfg==1)
			{
				?>
	<tr>
	<td>&nbsp;&nbsp;Staff Photo</td>
	<td colspan='3'><input type='FILE' name='uploadedfile' value="<?php echo $_FILES['uploadedfile']['name'] ?>" size='15' ></td>
	</tr>
	<?php
			}
				?>
	
        </table>
<br>
<table border=0 class="forumline" width="98%" align="center">
<tr><td class= "head" align="center" colspan="9"> Additional Details</td></tr>
<tr align="center" >
	<td colspan="7" class="row3" align="left">Qualification</td>
	</tr>
<?php
$qsql="select * from tempstaff_qualification where username='$user'";
$qrs=execute($qsql);
$qnum=rowcount($qrs);
if($qnum>=1)
{
	echo "<tr>";
	echo "<td class='rowpic' nowrap>Select&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "Course</td>";
	echo "<td class='rowpic'>Specialization</td>";
	echo "<td class='rowpic'>Year of Passing</td>";
	echo "<td class='rowpic'>College</td>";
	echo "<td class='rowpic'>University</td>";
	echo "<td class='rowpic'>SR Number. & date</td>";
	echo "<td class='rowpic'>Name of the State </td>";
	echo "</tr>";
	for($q=0;$q<$qnum;$q++)
	{
		$qrow=fetcharray($qrs,$q);
		echo "<tr>";
			echo "<td nowrap>&nbsp;&nbsp;<input type=checkbox name='qid[]' value=$qrow[0] checked>&nbsp;&nbsp;";
				echo "<input type=text name='course$qrow[0]' value='$qrow[1]' width='100%' ></td>";
				echo "<td><input type=text name='specialization$qrow[0]' value='$qrow[7]' width='100%'></td>";
				echo "<td><input type=text name='yearpass$qrow[0]' value='$qrow[2]' width='100%'></td>";
				echo "<td><input type=text name='college$qrow[0]' value='$qrow[6]' width='100%'></td>";
				echo "<td><input type=text name='univers$qrow[0]' value='$qrow[3]' width='100%'></td>";
				echo "<td><input type=text name='regno$qrow[0]' value='$qrow[4]' width='100%'></td>";
				echo "<td><input type=text name='boardname$qrow[0]' value='$qrow[5]' width='100%'></td>";
			echo "</tr>";
	}
	echo "<tr>";
		$flag1=1;
		?>
		<input type="hidden" value="<?=$flag1?>" name="flag1">
		<?php
		echo "<td colspan='8' align='left'><input type='submit' value='Modify' name='modifyquali' class='bgbutton'></td>";
	echo "</tr>";
}
?>
<tr>
	<td class='rowpic'>Course</td>
	<td class='rowpic'>Specialization</td>
	<td class='rowpic' nowrap>Year of Passing</td>
	<td class='rowpic'>College</td>
	<td class='rowpic'>University</td>
	<td class='rowpic' nowrap>SR Number. & date</td>
	<td class='rowpic' nowrap>Name of the State </td>
</tr>
<tr>
	<td><input type=text name="course" onKeyDown="return checkit(event)" width="100%"></td>
	<td><input type=text name="specialization" onKeyDown="return checkit(event)" width="100%"></td>
	<td><input type=text name="yearpass" onKeyDown="return check(event)" width="100%"></td>
	<td><input type=text name="college" onKeyDown="return checkit(event)" width="100%"></td>
	<td><input type=text name="univers" onKeyDown="return checkit(event)" width="100%"></td>
	<td><input type=text name="regno" width="100%"></td>
	<td><input type=text name="boardname" onKeyDown="return checkit(event)" width="100%"></td>
</tr>
<tr>
<?php
	$flag1=1;
?>
<input type="hidden" name="flag1" value="<?=$flag1?>">
<td align='left' colspan='7'><input type="submit" name="addquali" value="Add" class="bgbutton"> </td>
</tr>
</table>

<table class="forumline" align=center width=98% align="center">
<tr>
       	<td colspan="7" align="left" class="row3">Previous Job Details</td>
</tr>
<?php
$rsql="select * from temp_previous_job where username='$user'";
//echo $rsql;
$rrs=execute($rsql);
$rnum=rowcount($rrs);
if($rnum>=1)
{
	echo "<tr>";
		echo "<td class='rowpic' nowrap>Select&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "Experience In</td>";
		echo "<td class='rowpic'>Post</td>";
		echo "<td class='rowpic'>Organization</td>";
		echo "<td class='rowpic'>City</td>";
		echo "<td class='rowpic'>Country</td>";
		echo "<td class='rowpic'>From Date</td>";
		echo "<td class='rowpic'>To Date</td>";
	echo "</tr>";
	while($prow=fetcharray($rrs))
	{
		echo "<tr>";
		echo "<td nowrap>&nbsp;&nbsp;<input type=checkbox name='cid[]' value=$prow[5] checked>&nbsp;&nbsp;";
		echo "<select name=exp_type$prow[5]>";
		if($prow[exp_type]=="Teaching")	{
			$sel1="selected";
		}elseif($prow[exp_type]=="Practice")	{
			$sel2="selected";
		}elseif($prow[exp_type]=="Industry"){
			$sel3="selected";
		}elseif($prow[exp_type]=="Research"){
			$sel4="selected";
		}
		elseif($prow[exp_type]=="Clerical"){
			$sel5="selected";
		}elseif($prow[exp_type]=="Administration"){
			$sel6="selected";
		}elseif($prow[exp_type]=="Accounts"){
			$sel7="selected";
		}elseif($prow[exp_type]=="Computers"){
			$sel9="selected";
		}		

		echo "<option value='Teaching' $sel1>Teaching</option>";
		echo "<option value='Practice' $sel2>Practice</option>";
		echo "<option value='Industry' $sel3>Industry</option>";
		echo "<option value='Clerical' $sel5>Clerical</option>";
		echo "<option value='Administration' $sel6>Administration</option>";
		echo "<option value='Accounts' $sel7>Accounts</option>";
		echo "<option value='Computers' $sel9>Computers</option>";
		echo "<option value='Research' $sel4>Research</option></select></td>";
		echo "<td><input type=text name='post$prow[5]' value='$prow[0]' width='100%'></td>";
		echo "<td><input type=text name='workplace$prow[5]' value='$prow[1]' width='100%'></td>";
		echo "<td><input type=text name='city$prow[5]' value='$prow[2]' width='100%'></td>";
		echo "<td><input type=text name='country$prow[5]' value='$prow[3]' width='100%'></td>";
		echo "<td>";
		$yr = explode("-",$prow[6]);
		$MyDay=$yr[2];
		//Day
		echo "<select name='FrDay$prow[5]'>";
		echo "<option></option>";
		for($i=1;$i<=31;$i++){
		if($i == $MyDay)
			echo "<option value='$i'selected>$i</option>\n";
		else
			echo "<option value='$i'>$i</option>\n";
		}
		echo "</select>";
		$MyMonth=$yr[1];
		//Month
		echo "<select name='FrMon$prow[5]'>";
		echo "<option></option>";
		for($i=1;$i<=12;$i++)
		{
			if($i == $MyMonth)
				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
			else
				echo "<option value='$i'>" . MonthName($i) . "</option>\n";
		}
		echo "</select>";
		//Year
		$maxYr =2010;
		$MyYear=$yr[0];
		echo "<select name='FrYear$prow[5]'>";
		echo "<option></option>";
		for($i=1940;$i<=$maxYr;$i++)
		{
			if($i == $MyYear)
				echo "<option value='$i' selected >$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
		}
		echo "</select>";
			echo "</td>";
			//end from date
			// to date
			echo "<td nowrap>";
			$yr = explode("-",$prow[4]);
			$MyDay=$yr[2];
			//Day
			echo "<select name='LaDay$prow[5]'>";
			echo "<option></option>";
			for($i=1;$i<=31;$i++){
			if($i == $MyDay)
				echo "<option value='$i'selected>$i</option>\n";
			else
				echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
			$MyMonth=$yr[1];
			//Month
			echo "<select name='LaMon$prow[5]'>";
			echo "<option></option>";
			for($i=1;$i<=12;$i++)	{
				if($i == $MyMonth)
					echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				else
					echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
				echo "</select>";
			//Year
			$maxYr =2010;
			$MyYear=$yr[0];
			echo "<select name='LaYear$prow[5]'>";
			echo "<option></option>";
			for($i=1940;$i<=$maxYr;$i++)	{
				if($i == $MyYear)
					echo "<option value='$i' selected >$i</option>\n";
				else
					echo "<option value='$i' >$i</option>\n";
			}
			echo "</select>";
			echo "</td>";
			//end to date
	echo "</tr>";
}
$flag=1;?>
<input type=hidden value=<?=$flag?> name=<?=$flag?>>
<tr><td><input type=submit name='ModifyjobDet' value='Modify' class='bgbutton'></td>
<td></td><td></td><td></td><td></td><td></td><td></td>
</tr>
<?php
}?>
<tr>
	<td class='rowpic'>Experience In</td>
	<td class='rowpic'>Post</td>
	<td class='rowpic'>Organisation</td>
	<td class='rowpic'>City</td>
	<td class='rowpic'>Country</td>
	<td class='rowpic'>From date</td>
	<td class='rowpic'>To Date</td>

</tr>
<tr>
	<td><select name="exp_type">
	<option value="Teaching">Teaching</option>
	<option value="Practice">Practice</option>
	<option value="Industry">Industry</option>
	<option value="Research">Research</option>
	<option value="Clerical">Clerical</option>
	<option value="Administration">Administration</option>	
	<option value="Accounts">Accounts</option>
	<option value="Computers">Computers</option></select></td>	
	<td><input type=text name='post' onKeyDown="return checkit(event)" width="100%"></td>
	<td><input type=text name='Organisation' onKeyDown="return checkit(event)" width="100%"></td>
	<td><input type=text name='city' onKeyDown="return checkit(event)" width="100%"></td>
	<td><input type=text name='country' onKeyDown="return checkit(event)" width="100%"></td>
	<td nowrap>
	<?php
	//from date
	$d=getdate();
	$MyDay=$d["mday"];
	//Day
	echo "<select name='FrDay'>";
	echo "<option></option>";
	for($i=1;$i<=31;$i++){
	if($i == $MyDay)
		echo "<option value='$i' >$i</option>\n";
	else
		echo "<option value='$i'>$i</option>\n";
	}
	echo "</select>";
	$MyMonth=$d["mon"];
	//Month
	echo "<select name='FrMon'>";
	echo "<option></option>";
	for($i=1;$i<=12;$i++)
	{
		if($i == $MyMonth)
			echo "<option value='$i' >" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i'>" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
	//Year
	$maxYr =$d["year"]+1;
	$MyYear=$d["year"];
	echo "<select name='FrYear'>";
	echo "<option></option>";
	for($i=1940;$i<=$maxYr;$i++)
	{
		if($i == $MyYear)
			echo "<option value='$i' >$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
	echo "</td>";
//end from date
//to date
?>
<td nowrap>
<?php
$d=getdate();
$MyDay=$d["mday"];
//Day
echo "<select name='LaDay'>";
echo "<option></option>";
for($i=1;$i<=31;$i++){
if($i == $MyDay)
	echo "<option value='$i' >$i</option>\n";
else
	echo "<option value='$i'>$i</option>\n";
}
	echo "</select>";

	$MyMonth=$d["mon"];
	//Month
	echo "<select name='LaMon'>";
	echo "<option></option>";
	for($i=1;$i<=12;$i++)
	{
		if($i == $MyMonth)
			echo "<option value='$i' >" . MonthName($i) . "</option>\n";
		else
			echo "<option value='$i'>" . MonthName($i) . "</option>\n";
	}
	echo "</select>";
	//Year
	$maxYr =$d["year"]+1;
	$MyYear=$d["year"];
	echo "<select name='LaYear'>";
	echo "<option></option>";
	for($i=1940;$i<=$maxYr;$i++)
	{
		if($i == $MyYear)
			echo "<option value='$i' >$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
echo "</td>";
//end to date
?>
</tr>
<tr>
<?php
$flag=1;
?>
	<input type=hidden name=flag value=<?=$flag?>>
	<td align='left' colspan='7'><input type="submit" name="jodadd" value="Add" class="bgbutton"></td>
</tr>
</table>
<table class="forumline" align="center" width="98%" align="center">
<tr>
       	<td colspan="5" align="left" class="row3">Dependent Details</td>
</tr>
<?php
$rsql="select * from temp_staff_dependents where username='$user'";
$rrs=execute($rsql);
$rnum=rowcount($rrs);
if($rnum>=1)
{
	echo "<tr>";
		
		//echo "<td width='10' class='rowpic'>Select</td>";
		echo "<td class='rowpic' nowrap>Select&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "Name</td>";
		echo "<td class='rowpic'>Relation</td>";
		echo "<td class='rowpic'>Address</td>";
		echo "<td class='rowpic'>Phone</td>";
		echo "<td class='rowpic'>Occupation</td>";
	echo "</tr>";
	while($prow=fetcharray($rrs,$i))
	{
		//$prow=fetcharray($rrs,$i);
		echo "<tr>";
		//echo "<td ><input type=checkbox name='cid[]' value=$prow[5] checked></td>";
		echo "<td nowrap>&nbsp;&nbsp;<input type=checkbox name='did[]' value=$prow[0] checked>&nbsp;&nbsp;";
		echo "<input type=text name='dname$prow[0]' value='$prow[1]' width='100%'></td>";
		echo "<td><input type=text name='drel$prow[0]' value='$prow[3]' width='100%'></td>";
		echo "<td><input type=text name='dep_addr$prow[0]' value='$prow[5]' width='100%'></td>";
//		echo  $prow[5] ;
		echo "<td><input type=text name='d_phone$prow[0]' value='$prow[8]' width='100%'></td>";
		echo "<td><input type=text name='doccu$prow[0]' value='$prow[4]' width='100%'></td>";
		echo "</tr>";
	}
	$flag2=2;
?>
<input type="hidden" value="<?=$flag2?>" name="flag2">
<td align='left' colspan='5'><input type='submit' name='depmod' value='Modify' class='bgbutton'></td>
</tr>
<?php
}
?>
<tr>
		<td class='rowpic'>Name</td>
		<td class='rowpic'>Relation</td>
		<td class='rowpic'>Address</td>
		<td class='rowpic'>Phone</td>
		<td class='rowpic'>Occupation</td>
	</tr>
	<tr>
		<td><input type=text name='dname' onKeyDown="return checkit(event)"></td>
		<td><input type=text name='drel' onKeyDown="return checkit(event)" width="100%"></td>
		<td><input type=text name='dep_addr' onKeyDown="return checkit(event)" width="100%"></td>
		<td><input type=text name='d_phone' onKeyDown="return check(event)" width="100%"></td>
		<td><input type=text name='doccu' onKeyDown="return checkit(event)" width="100%"></td>
	</tr>
	<tr>
<?php
	$flag2=2;
?>
	<input type="hidden" name="flag2" value="<?=$flag2?>">
	<td align='left' colspan='5'><input type="submit" name="depadd" value="Add" class="bgbutton"></td>
	</tr></table>
	
        <br>
        <div align="center">
		<input type="submit" value="Save" name="B1" onClick="return send()" class="bgbutton">
        </div>
</form>
<?php
function MonthName($mon){
        if($mon == 1) return("Jan");
        if($mon == 2) return("Feb");
        if($mon == 3) return("Mar");
        if($mon == 4) return("Apr");
        if($mon == 5) return("May");
        if($mon == 6) return("Jun");
        if($mon == 7) return("Jul");
        if($mon == 8) return("Aug");
        if($mon == 9) return("Sep");
        if($mon == 10) return("Oct");
        if($mon == 11) return("Nov");
        if($mon == 12) return("Dec");
}
?>
<script language="JavaScript">
	function copyadd()
	{
		document.frm.addr_perm.value = document.frm.addr_pres.value;
		document.frm.ct_perm.value = document.frm.ct_pres.value;
		document.frm.ph_perm.value = document.frm.ph_pres.value;
		document.frm.pin_perm.value = document.frm.pin_pres.value;
		document.frm.state_perm.value = document.frm.state_pres.value;
	}
</script>
</body>
</html>
