<?php
session_start();
require_once("../db.php");

//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";

if($_GET['tab']!='')
{
	$p=$_GET['tab'];
}
elseif($_POST['tab']!='')
{
	$p=$_POST['tab'];
}
else
{
	$p=2;
}
//echo "Value :".$p;

$sem=$_SESSION['sem'];
$user=$_SESSION['user'];
$branch=$_SESSION['branch'];
$academic_year=$_SESSION['AcademicYear'];

if($_GET)
{
	$sem=$_GET['sem'];
	$un=$_REQUEST['un'];
	$StudID=$_GET['StudID'];
	$branch=$_GET['branch'];
	$flag=$_REQUEST['flag'];
	$token=$_REQUEST['token'];
	$fname=$_REQUEST['fname'];
	$app_nu=$_REQUEST['app_nu'];
	$studfname=$_REQUEST['studfname'];	
	$class_section_id=$_GET['class_section_id'];	
}
if($_POST)
{
	$app_no=$_POST['app_no'];
	$sem_filter=$_POST['sem_filter'];
	$studentName=$_POST['studentName'];
	$branch_filter=$_POST['branch_filter'];
	$class_section_id=$_POST['class_section_id'];
	$class_section_id_filter=$_POST['class_section_id_filter'];
	
	$usn=$_POST['usn'];
	$nat=$_POST['nat'];
	$rel=$_POST['rel'];
	$dob=$_POST['dob'];
	$sem=$_POST['sem'];
	$cat=$_POST['cat'];
	$sel=$_POST['sel'];
	$mmb=$_POST['mmb'];
	$gmb=$_POST['gmb'];
	$fmb=$_POST['fmb'];
	$fqul=$_POST['fqul'];
	$mqul=$_POST['mqul'];
	$gqul=$_POST['gqul'];
	$lang=$_POST['lang'];
	$finc=$_POST['finc'];
	$foadd=$_POST['foadd'];
	$moadd=$_POST['moadd'];
	$goadd=$_POST['goadd'];
	$adate=$_POST['adate'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$caste=$_POST['caste'];
	$state=$_POST['state'];
	$memail=$_POST['memail'];
	$f_name=$_POST['f_name'];
	$foccup=$_POST['foccup'];
	$branch=$_POST['branch'];
	$gender=$_POST['gender'];
	$age_yr=$_POST['age_yr'];
	$per_addr=$_POST['per_addr'];
	$per_city=$_POST['per_city'];
	$per_state=$_POST['per_state'];
	$per_country=$_POST['per_country'];

	$gname=$_POST['gname'];
	$goccup=$_POST['goccup'];
	$ginc=$_POST['ginc'];
	$mother=$_POST['mother'];
	$dist=$_POST['dist'];
	$stud_type=$_POST['stud_type'];
	$vdt=$_POST['vdt'];
	$mname=$_POST['mname'];
	$moccup=$_POST['moccup'];
	$minc=$_POST['minc'];
	
	$gemail=$_POST['gemail'];
	$femail=$_POST['femail'];
	$place=$_POST['place'];

	$msgphone=$_POST['msgphone']; 
	$rgmailid=$_POST['rgmailid'];
	$b_year=$_POST['b_year'];	
	$b_month=$_POST['b_month'];
	$b_day=$_POST['b_day'];
	$per_pin=$_POST['per_pin'];
	$per_phone=$_POST['per_phone'];
	$cor_addr=$_POST['cor_addr'];
	$cor_city=$_POST['cor_city'];
	$cor_state=$_POST['cor_state'];
	$cor_country=$_POST['cor_country'];
	$cor_pin=$_POST['cor_pin'];
	$cor_phone=$_POST['cor_phone'];
    $appl_num=$_POST['appl_num'];
	$adm_num=$_POST['adm_num'];

    $std_email=$_POST['std_email'];
	$a_year=$_POST['a_year'];
	$extra=$_POST['extra'];
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	$parent_username=$_POST['parent_username'];
	$parent_password=$_POST['parent_password'];
	$b_group=$_POST['b_group'];
	$fee_type=$_POST['fee_type'];

}

 	if($branch!=0 && $sem!=0 && $a_year!=0)
	{

			$new=substr($a_year,-2);

			$siddet=fetchrow(execute("SELECT student_id FROM `course_year` where year_id='$sem'"));

			$da=$siddet[0];	

			$res = execute("SELECT max(RIGHT(`admission_id`,4)) FROM `student_m` ");

			$row = fetchrow($res);

			$varb = $da.$new.($row[0]+1);

			$app_num = $varb;

			$papp_num = $app_num."P";

	}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<style type="text/css">
<!--
  body
  {
	  font: 14px "Helvetica Neue", Helvetica, Arial, sans-serif;	
	  margin: 10px 15px;		
  }
  td
  {
	  padding:3px;
  }
-->
</style>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<script type="text/javascript">
	function ReloadMe()
	{
		document.frm.action="SearchStudent.php";
		document.frm.submit();
	}
	function New_onClick()
	{
		document.frm.action="SearchStudent.php?Type=NEW";
		document.frm.submit();
	}
	function Save_onClick()
	{
		//alert('hi');
		document.frm.action="res.php?Type=SAVE";
		document.frm.submit();
	}
	function Reload(token)
	{
		document.frm.action="SearchStudent.php?StudID="+token;
		document.frm.submit();
	}
	function SearchName(name)
	{
		document.frm.action="SearchStudent.php?studentName="+name;
		document.frm.submit();
	}
</script>
<script language="javascript" type="text/javascript">
function validateForm(tempn)
{
	var x=document.forms["frm"][tempn].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	  {
	  		alert("Not a valid e-mail address");
			return false;
	  }
}
function reload()
{
	document.frm.action='SearchStudent.php';
	document.frm.submit();
}
function getAddr()
{
	document.frm.per_addr.value  = document.frm.cor_addr.value;
	document.frm.per_city.value  = document.frm.cor_city.value;
	document.frm.per_state.value  = document.frm.cor_state.value;
	document.frm.per_country.value = document.frm.cor_country.value;
	document.frm.per_pin.value	 = document.frm.cor_pin.value;
	document.frm.per_phone.value  = document.frm.cor_phone.value;
}
function updtid(a)
{
	var b=a+"P";
	document.frm.username.value=a;
	document.frm.password.value=a;
	document.frm.parent_username.value=b;
	document.frm.parent_password.value=b;

}
</script>
<title>STUDENT DETAILS</title>
</head>
<body>
<form name="frm" action="" method="post" ENCTYPE="multipart/form-data">
<input type="hidden" name="tab" value="<?=$p?>"/>
<input type="hidden" name="StudID" value="<?=$StudID?>"/>
<div id='menu'>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
   <ul class="tabHead">
  <table class="forumline"  align="center" width="100%">
	<tr><td valign="top"><BR>    
    <li class="currentBtn"><a href="SearchStudent.php?tab=2&StudID=<?=$StudID?>" title="Student Details">Student</a></li>
    <li><a href="" title="Student Behaviour">Behaviour</a></li>
    <li><a href="" title="Parent-Teacher Conference">P/T Conference</a></li>
    <li><a href="" title="Lesson Plan">Lesson Plan</a></li>
    <li><a href="" title="Transportation Details">Transport</a></li>
    <li><a href="" title="Schedule Details">Calender</a></li>
    <li><a href="" title="Medical Report">Medical</a></li>
    <li><a href="StudentReportCard.php?admission_id=<?=$details['admission_id']?>&StudID=<?=$details['student_id']?>" title="Student Report">Assessment</a></li>
    <li><a href="familys.php?stuid=<?=$StudID?>" title="Add Siblings">Family</a></li>
      </td>
      <td align="right" valign="top"><input type="button" name="New" value="New" onClick="New_onClick()" class="bgbutton" style="width:60px; height:22px"/>
      <input type="button" name="Save" value="Save" onClick="Save_onClick()" class="bgbutton" style="width:60px; height:22px"/></td>
 
            <!--<td align="right"><img height='150' width='170'  src="<?=$details[img_source]?>"/></td>-->
            <!--<td align="right" valign="top"><img height='120' width='130'  src="img/img.jpg"/></td>
       </tr>-->
  </table>      
 </ul>
</div></div></div>
<table class='forumline'  align='center' width="98%">
<tr>
	<td valign="top" rowspan="100" nowrap>
    <input type="text" name="studentName" value="" size="25"  onChange="SearchName(this.value)" placeholder="Search Here" style="height:25px;"><img src="../images/search.png" align="bottom" height="18" width="22"><BR>
 	<select name="StudID" multiple style="height:600px; width:178px" onChange="Reload(this.value)">             
   <?php
        $sql="SELECT `id`,`first_name`,`last_name` FROM `student_m` WHERE id is not null AND archive='N' and academic_year='$academic_year'";
			if($branch_filter!=0)
			{		
				$sql.=" AND course_admitted='$branch_filter'";
			}
			if($sem_filter!=0)
			{
				$sql.=" AND course_yearsem='$sem_filter'";
			}
			if($class_section_id_filter!='')
			{
				$sql.=" AND class_section_id='$class_section_id_filter'";
			}
			if($studentName!='')
			{
				$sql.=" AND first_name like '%$studentName%'";
			}
			
		 $sql.=" ORDER BY first_name";
 			$rs=execute($sql) or die(mysql_error());
			
            while($row=fetcharray($rs))
            {
                if($StudID==$row['0'])
                	echo "<option value='$row[0]' selected>$row[first_name]&nbsp;$row[last_name]</option>";
                else
               		echo "<option value='$row[0]' >$row[first_name]&nbsp;$row[last_name]</option>";
            }
        ?>
    	</select></td>
     </tr>
     <tr>
   <!------------------------------------------------------------------------------------------------------------------------------>
	<td colspan='6' class="row3" valign="top">Admission details </td></tr>
<tr height="25" >
	<td nowrap>&nbsp;&nbsp;Application Number</td>

		<td><input name="appl_num" type="text" value="<?php echo $app_num ?>" size="20" readonly placeholder="Auto-generated"></td>
		<td nowrap>Admission Date</td>
		<td colspan="4" nowrap><input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly><a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td></tr>

		<tr height="25">

		<td width="15%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> *</td>

		<td width="35%">
		<select name="branch" id="branch" onchange='reload()'>
		<option value="0">--- Select School Division ---</option>
			<?php
				$sql="select course_id,coursename from course_m";
				$rs=execute($sql) or die(error_description());
				
				for($i=0;$i<rowcount($rs);$i++)
				{

				  $r=fetcharray($rs);
					if($branch==$r[course_id])
					{
						?>
						<option value="<?=$r[course_id]?>" selected><?php echo $r[coursename] ?></option>
						<?php
					}
					else
					{
						?>
						<option value="<?php echo $r[course_id] ?>"><?=$r[coursename]?></option>
						<?php
					}
				}
			?>
		</select>
		</td>
		<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?>  *</td>
        <td colspan="4"><select name="sem" id="sem" onchange='reload()'>
			<option value='0'>--- Select Grade ---</option>
			<?php

				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");

				while($r=fetcharray($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>$r[year_name]</option>";
					}
				}
			?>
			</select>
		</td>
	</tr>
<tr height="25">
<td nowrap>&nbsp;&nbsp;Academic Year*</td>
            <td> <select name="a_year" id="a_year" onchange='reload()'>
                <option value='0'>Select Year</option>
                <?php
				   $MyYear=date('Y')-1;
				   $CurrentYr=date("Y")+2;

				   for($i=$MyYear;$i<$CurrentYr;$i++)
				   {
						$Fyear=$i;
						$Tyear=$i+1;

						$Tyear=substr($Tyear,2);

						$sele="";

						if($a_year=='')
						{
							if($i==date('Y'))
							$sele="selected";
						}
						else
						{
							if($i==$a_year)
							$sele="selected";
						}
						?>
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?>- <?=$Tyear?></option>
						<?php
					 }
		 ?>
              </select></td>
			  <td nowrap>&nbsp;&nbsp;Admission Category*</td>
            <td colspan="4"> <select name="fee_type">
                <?php
					$qq="select id,name from admission";

					$qqq=execute($qq) or die(error_description());

					for($i=0;$i<rowcount($qqq);$i++)
					{
						$myq=fetcharray($qqq);
						if($fee_type==$myq[id])
					    {
						   ?>
               			   <option value="<?=$myq[id]?>" selected><?php echo $myq[name] ?></option>
                		   <?
						 }
						else
						{
						?>
                		   <option value="<?php echo $myq[id] ?>"><?=$myq[name]?></option>

                		<?php
					     }
					}
				?>
              </select> </td>
	 </tr>
  <tr height="25"> 
      <td colspan="6" class="row3">Student Details</td>
  </tr>
 <tr height="25">
    <td nowrap>&nbsp;&nbsp;First Name *</td>
    <td><input type="text" name="fname" value="<?=$fname?>" size="30"></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;Last Name *</td>
	<td colspan="4"><input type="text" name="lname" value="<?=$lname?>" size="20"></td>
  </tr>
  <tr height="25">
     <td nowrap>&nbsp;&nbsp;Date of Birth*</td>
     <td nowrap><select name="b_day" onchange='reload()'>
      <?php
			echo "<option value='0'>00</option>";
			for($i=1;$i<=31;$i++)
			{
	                if($i<10)
						$i="0".$i;
					$sel='';
					if($b_day==$i)
						$sel='selected'; 
					echo "<option value='$i' $sel >$i</option>";
			    }
				?>
    		</select>
    <select name="b_month" onchange='reload()'>
      <?php
			echo "<option value='0'>00</option>";
			for($i=1;$i<=12;$i++)
			{
				if($i<10)
					$i="0".$i;
				$sel='';
				if($b_month==$i)
					$sel='selected';
				echo "<option value='$i' $sel >$i</option>";
			}
		?>
    </select>
    <select name="b_year" onchange='reload()'>
      <?php
			  echo "<option value=0 >0000</option>";
			  $d=date('Y')-50;
			  $dd=date('Y');
			  for($i=$dd;$i>=$d;$i--)
			  {
					$sel='';
					if($b_year==$i)
					  $sel='selected';
					echo "<option value=$i $sel >$i</option>";
			   }
		?>

    </select></td>
	<?php
	$d=date("d");
	$m=date("m");
	$y=date("Y");
	if($b_month<$m)
	{
		$age_yr=$y-$b_year;
	}
	else
	{
		if($b_month==$m)
		{
			if($b_day<=$d)
			{
				$age_yr=$y-$b_year;
			}
			else
			{
				$age_yr=($y-$b_year)-1;
			}
		}
		else
		{
			$age_yr=($y-$b_year)-1;
		}
	}
	?>
	<td>&nbsp;&nbsp;Age</td>
    <td colspan="6"><input type="text" name="age_yr" value="<?php echo $age_yr?>" size='2' readonly></td>
    </tr>
    <tr height="25">
            <td nowrap>&nbsp;&nbsp;Birth Place Details </td>
            <td>City&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="place" value="<?php echo $place?>"></td>
			<td>&nbsp;&nbsp;State</td>
			<td colspan="6"><input type="text" name="dist" value="<?php echo $dist?>"></td>
     </tr>
     <tr height="25"> 

     <td>&nbsp;&nbsp;Nationality*</td>

      <td><select name="nat">

          <?php

			   $res = execute("select * from nationality");

			   while($row = fetcharray($res))

			   {

				   if($rel==$row[id])

					{

						echo "<option value='$row[id]' selected>&nbsp;&nbsp;$row[nation]</option>";

					}

					else

					{

						echo "<option value='$row[id]'>&nbsp;&nbsp;$row[nation]</option>";

					}

				  

			   }

			?>

        </select> </td>
        <td>&nbsp;&nbsp;Blood Group</td>
         <td colspan="4"><select name="b_group">
          <option value='NA'>-------select--------</option>
          <?php
				 if($b_group=="A+ve"){
					   $m="selected";
					   $n=$o=$p=$r=$s=$t=$u="";
				 }
				 if($b_group=="B+ve"){
					   $n="selected";
					   $m=$o=$p=$r=$s=$t=$u="";
				  }
				 if($b_group=="A-ve"){
					   $o="selected";
					   $m=$n=$p=$r=$s=$t=$u="";
				 }
				 if($b_group=="B-ve"){
					   $p="selected";
					   $m=$n=$o=$r=$s=$t=$u="";

				 }
				 if($b_group=="O+ve"){
					   $r="selected";
					   $m=$n=$o=$p=$s=$t=$u="";

				 }
				 if($b_group=="O-ve"){
				   $s="selected";
				   $m=$n=$o=$p=$r=$t=$u="";

				 }
				 if($b_group=="AB+ve") {
				   $t="selected";
				   $m=$n=$o=$p=$r=$s=$u="";

				 }

				 if($b_group=="AB-ve"){
					$u="selected";
					$m=$n=$o=$p=$r=$s=$t="";
				 }
			?>

          <option value="A+ve" <?=$m?>>A Rh Positive</option>

          <option value="B+ve" <?=$n?>>B Rh Positive</option>

          <option value="A-ve" <?=$o?>>A Rh Negative</option>

          <option value="B-ve" <?=$p?>>B Rh Negative</option>

          <option value="O+ve" <?=$r?>>O Rh Positive</option>

          <option value="O-ve" <?=$s?>>O Rh Negative</option>

          <option value="AB+ve" <?=$t?>>AB Rh Positive</option>

          <option value="AB-ve" <?=$u?>>AB Rh Negative</option>

        </select> </td>
    </tr>
	<tr height='25'>
         <td nowrap>&nbsp;&nbsp;Upload Student Photo</td>
         <td><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>
         <td nowrap>&nbsp;&nbsp;E-Mail ID</td>
	 <td><input type="text" id="std_email" onChange="validateForm(this.name)" name="std_email" value="<?php echo $std_email; ?>" size="20"></td>

    
 </tr>
 <tr>
 	 <td nowrap>&nbsp;&nbsp;Student ID</td>
     <td><input type="text" name="adm_num"  value="<?php echo $app_num ?>"  onchange='updtid(this.value)' readonly></td>
     
     <td nowrap>&nbsp;&nbsp;Gender* </td>
    <td colspan="6"><select name="gender">
		<?php
			 if($gender== "M")
			 {
			   $sj="selected";
			   $sk="";
			 }
			 if($gender== "F")
			 {
			 	$sk="selected";
			 	$sj="";
			 }
         ?>
          <option value="M" <?=$sj?>>Male</option>
          <option value="F" <?=$sk?>>Female</option>
       </select></td>
  </tr>
  <tr>
  		<td>&nbsp;&nbsp;Country</td>
		<td><input type="text" name="state" value="<?php echo $state?>"></td>
        
        <td nowrap>&nbsp;&nbsp;Mother Tongue*</td>
	    <td colspan="4"><select name="mother">
	  <?php
			$qq="select id,lang from language";

			$qqq=execute($qq) or die(error_description());

			for($i=0;$i<rowcount($qqq);$i++)
			{

				$myq=fetcharray($qqq);

				if($mother==$myq[id])
				 {

				?>
	  					<option value="<?=$myq[id]?>" selected><?php echo $myq[lang] ?></option>
	  			<?php
				 }
				else
     			 {
				?>
	  					<option value="<?php echo $myq[id] ?>"><?=$myq[lang]?></option>
	             <?php
				   }
				}
		  ?>
	  </select></td>  
   </tr>
<tr height="25">
   <td colspan="6" class="row3" valign="top">Emergency contact details</td>
</tr>
<tr>
   <td nowrap>&nbsp;&nbsp;MSG Phone number &nbsp;&nbsp;
   <input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" ></td>
   <td>&nbsp;&nbsp;EC number </td>
   <td colspan="2">
   <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>
   
</tr>
<tr>
	<td colspan="6">&nbsp;&nbsp;Mail-Id
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input type="text" name="rgmailid" onChange="validateForm(this.name)"  value="<?php echo $rgmailid; ?>" size="30" ></td>
</tr>
	<tr>
		<td colspan="6" class="row3">Parent/Guardian Details</td>
	</tr>
    <tr>
        <td align='center'>Description</td>
        <td align='center'>Father Details</td>
        <td align='center'>Mother Details</td>
        <td align='center' colspan="4">Guardian Details</td>
    </tr>
     <tr>
        <td>&nbsp;&nbsp;Name</td>
        <td align='center'><input type="text" name="f_name" value="<?php echo $f_name?>" ></td>
        <td align='center'><input type="text" name="mname" value="<?php echo $mname ?>" ></td>
        <td align='center' colspan="4"><input type="text" name="gname" value="<?php echo $gname?>" ></td>
     </tr>
     <tr>
        <td>&nbsp;&nbsp;Occupation</td>
        <td align='center'><input type="text" name="foccup" value="<?php echo $foccup?>"></td>
        <td align='center'><input type="text" name="moccup" value="<?php echo $moccup ?>" ></td>
        <td align='center' colspan="4"><input type="text" name="goccup" value="<?php echo $goccup?>" ></td>
    </tr>
 	<tr>
   	   <td>&nbsp;&nbsp;Mobile Number</td>
       <td align='center'><input type="text" name="fmb" value="<?php echo $fmb?>"></td>
       <td align='center'><input type="text" name="mnum" value="<?php echo $mnum?>" ></td>
       <td align='center' colspan="4"><input type="text" name="gmb" value="<?php echo $gmb?>" ></td>
   </tr>
   <tr>
      <td>&nbsp;&nbsp;E-mail</td>
      <td align='center'><input type="text" name="femail" value="<?php echo $femail?>" onChange="validateForm(this.name)" ></td>
      <td align='center'><input type="text" name="memail" value="<?php echo $memail?>" onChange="validateForm(this.name)" ></td>
      <td align='center' colspan="4"><input type="text" name="gemail" value="<?php echo $gemail?>" onChange="validateForm(this.name)" ></td>
   </tr>
   <tr>
        <td >&nbsp;&nbsp;Educational Qualification</td>
        <td align='center'><input type="text" name="fqul" value="<?php echo $fqul ?>"></td>	
        <td align='center'><input type="text" name="mqul" value="<?php echo $mqul ?>"></td>		
        <td align='center' colspan="4"><input type="text" name="gqul" value="<?php echo $gqul ?>"></td>			
   </tr>
   <tr>
        <td >&nbsp;&nbsp;Office Address</td>
        <td align='center'><input type="text" name="foadd" value="<?php echo $foadd ?>"></td>	
        <td align='center'><input type="text" name="moadd" value="<?php echo $moadd ?>"></td>		
        <td align='center' colspan="4"><input type="text" name="goadd" value="<?php echo $goadd ?>"></td>			
	</tr>
    <tr height="25">
		<td width='50%' class="row3" >Present Address </td>
		<td width='50%' class="row3" colspan="6">Permanent Address <br/>
		<input type="checkbox" name="check" value="" onClick="getAddr()">
        &nbsp;&nbsp;&nbsp;Click if Permanent Address is same Present Address</td></td>
	</tr>
    <tr>
    	<td>&nbsp;&nbsp;
		<textarea rows="3" cols="40" name='cor_addr' placeholder="PRESENT ADDRESS"><?=$cor_addr?></textarea></td>
       <td colspan="6" align="CENTER">&nbsp;&nbsp;
       <textarea rows="3" cols="40" name='per_addr' placeholder="PERMANENT ADDRESS"><?=$per_addr?></textarea>
      </td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;City/Town</td>
        <td><input type="text" name="cor_city" value="<?php echo $cor_city?>"></td>
        
        <td>&nbsp;&nbsp;City/Town</td>
        <td colspan="4"><input type="text" name="per_city" value="<?php echo $per_city?>"></td>
    </tr>
	<tr>
		<td>&nbsp;&nbsp;State</td>
        <td><input type="text" name="cor_state" value="<?=$cor_state?>"></td>
        
        <td>&nbsp;&nbsp;State</td>
        <td colspan="4"><input type="text" name="per_state" value="<?=$per_state?>"></td>
    </tr>
    <tr>
		<td>&nbsp;&nbsp;Country</td>
        <td><input type="text" name="cor_country" value="<?=$cor_country?>"></td>
        
        <td>&nbsp;&nbsp;Country</td>
        <td colspan="4"><input type="text" name="per_country" value="<?=$per_country?>"></td>
	</tr>
    <tr>
		<td>&nbsp;&nbsp;Pin Code</td>
        <td><input type="text" name="cor_pin" value="<?=$cor_pin?>"></td>
        
        <td>&nbsp;&nbsp;Pin Code</td>
        <td colspan="4"><input type="text" name="per_pin" value="<?=$per_pin?>"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;Phone No</td>
        <td><input type="text" name="cor_phone" value="<?=$cor_phone?>"></td>
        
        <td>&nbsp;&nbsp;Phone No</td>
        <td colspan="4"><input type="text" name="per_phone" value="<?=$per_phone?>"></td>
	</tr>
<tr height="25">
   <td class="row3" colspan="6" >Documents Enclosed(Tick the relevent documents)</td>
</tr>
<tr>
	<td>
  <?php
	$sql=execute("select * from certificate_m where status=1 order by id") or die(error_description());
	$count=0;
	for($i=0;$i<rowcount($sql);$i++)
	{
		$sel=$_POST['sel'];
		$r1=fetcharray($sql);
		$count=$count+1;
	
		if($sel[$i])
			$check='checked';
		else
			$check='';	
		?>
			<td width='2%'><input type="checkbox" name="sel[]" value="<?=$r1["id"]?>"  <?=$check?>></td>
			<td><?=$r1["name"]?></td>
		<?
		if($count==4)
		{
			echo "</tr>";
			$count=0;
		}
	}
	
		if($count==0)
			echo "<td colspan='6'></td></tr>";
	
	?>
</tr>
<tr>
   <td align='center'>Remarks</td>
   <td colspan="6"><textarea rows="5" cols="70" name='extra' value=""><?=$extra?></textarea></td>
</tr>
<tr height="25">
   <td colspan="6" class="row3" >Username & Password</td>
</tr>
	<tr>
		<td>&nbsp;&nbsp;Student Username</td>   
		<td><input name='username' type='text' value="<?=$app_num?>" size='15' readonly></td>
		<td>&nbsp;&nbsp;Student Password</td>
		<td colspan="4"><input name='password' type="text" value="<?=$app_num?>" size='15' readonly></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;Parent Username</td>
		<td><input name='parent_username' type='text' value="<?=$papp_num?>" size='15' readonly></td>
		<td>&nbsp;&nbsp;Parent Password</td>
		<td colspan="4"><input name='parent_password' type="text" value="<?=$papp_num?>" size='15' readonly></td>
	</tr>
	<tr height="25">
   	    <td colspan="6" class="row3" >Upload Files</td>
 </tr>
 <tr>
    <td height="25">&nbsp;&nbsp;Upload Documents</td>
	<td colspan="6"><input size="20" name="uploadedPassport[]" id='uploadedPassport' type="file" class="bgbutton" multiple />  
</tr>
</table>
</form>
</BODY>
</HTML>
