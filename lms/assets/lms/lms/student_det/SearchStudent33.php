<?php
session_start();
require_once("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

	$sem=$_SESSION['sem'];
	$user=$_SESSION['user'];
	$branch=$_SESSION['branch'];
	$academic_year=$_SESSION['AcademicYear'];

if($_GET)
{
	$sem=$_GET['sem'];
	$un=$_REQUEST['un'];
	$flag=$_GET['flag'];
	$token=$_GET['token'];
	$fname=$_GET['fname'];
	$StudID=$_GET['StudID'];
	$branch=$_GET['branch'];
	$app_nu=$_GET['app_nu'];
	$studfname=$_GET['studfname'];	
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

	$dist=$_POST['dist'];
	$ginc=$_POST['ginc'];
	$gname=$_POST['gname'];
	$goccup=$_POST['goccup'];
	$mother=$_POST['mother'];
	
	
	$vdt=$_POST['vdt'];
	$minc=$_POST['minc'];
	$b_day=$_POST['b_day'];
	$mname=$_POST['mname'];
	$extra=$_POST['extra'];
	$place=$_POST['place'];
	$moccup=$_POST['moccup'];
	$b_year=$_POST['b_year'];
	$gemail=$_POST['gemail'];
	$femail=$_POST['femail'];
	$b_month=$_POST['b_month'];
	$per_pin=$_POST['per_pin'];	
	$cor_addr=$_POST['cor_addr'];
	$cor_city=$_POST['cor_city'];
	
	
	$a_year=$_POST['a_year'];
	$cor_pin=$_POST['cor_pin'];
	$adm_num=$_POST['adm_num'];
    $b_group=$_POST['b_group'];
    $appl_num=$_POST['appl_num'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$fee_type=$_POST['fee_type'];
	$msgphone=$_POST['msgphone']; 
	$rgmailid=$_POST['rgmailid'];
	$cor_state=$_POST['cor_state'];
	$std_email=$_POST['std_email'];
	$cor_phone=$_POST['cor_phone'];
	$per_phone=$_POST['per_phone'];
	$stud_type=$_POST['stud_type'];
	$cor_country=$_POST['cor_country'];
	$parent_username=$_POST['parent_username'];
	$parent_password=$_POST['parent_password'];
	
}

$Type=$_REQUEST['Type'];
/*echo "Type :".$Type;

echo "StudID :".$StudID;*/

if($StudID==""){

	if($Type=="NEW" and !$_POST['sem'] and !$_POST['branch'])
	{
		$sem="";
		$b_day="";
		$b_year="";
		$age_yr="";
		$branch="";
		$b_month="";
		$appl_num="";
		$papp_num="";
	}
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
		document.frm.action="SearchStudent33.php";
		document.frm.submit();
	}
	function New_onClick()
	{
		document.frm.action="SearchStudent33.php?Type=NEW";
		document.frm.submit();
	}
	function Save_onClick()
	{
		//alert('INSERT');
		document.frm.action="res.php?Type=SAVE";
		document.frm.submit();
	}
	function Update_onClick()
	{
		//alert('UPDATE');
		document.frm.action="modify_AplEng.php?Type=SAVE";
		document.frm.submit();
	}
	function Reload(token)
	{
		document.frm.action="SearchStudent33.php?StudID="+token;
		document.frm.submit();
	}
	function SearchName(name)
	{
		document.frm.action="SearchStudent33.php?studentName="+name;
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
	document.frm.action='SearchStudent33.php';
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
<script LANGUAGE="JavaScript">
function reloadAjax(str)
{
var url="../sessionbranchfile.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)
  {
    document.getElementById("txtHint9").innerHTML=xmlhttp.responseText;
   }
 }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
</script>


<title>STUDENT DETAILS</title>
</head>
<body>
<form name="frm" action="" method="post" ENCTYPE="multipart/form-data">   
<input type="hidden" name="tab" value="<?=$p?>"/>
<input type="hidden" name="StudID" value="<?=$StudID?>"/>
<? if($Type){   ?>
<input type="hidden" name="Type" value="<?=$Type?>"/>
<? } ?>
<div id='menu'>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
   <ul class="tabHead">
  <table class="forumline"  align="center" width="100%">
    <?			
 		$details=fetcharray(execute("SELECT * FROM `student_m` WHERE `id`='$StudID' LIMIT 1"));
		if($details['admission_id']){
			$app_num=$details['admission_id'];
			$papp_num=$details['parent_username'];
		}
      ?>
      
	<tr><td valign="top"><BR>    
    <li class="currentBtn"><a href="SearchStudent33.php?StudID=<?=$StudID?>" title="Student Details">Student</a></li>
    <li><a href="behaviour.php?StudID=<?=$StudID?>" title="Student Behaviour">Pastoral Care</a></li>
    <li><a href="conference_edt.php?StudID=<?=$StudID?>" title="Parent-Teacher Conference">P/T Conference</a></li>
    <li><a href="transport.php?StudID=<?=$StudID?>" title="Transportation Details">Transport</a></li>
    <li><a href="StudentReportCard.php?StudID=<?=$StudID?>&StudID=<?=$details['id']?>" title="Student Report">Assessment</a></li>
    <li><a href="familys.php?StudID=<?=$StudID?>" title="Add Siblings">Family</a></li>
    <li><a href="ecContact.php?StudID=<?=$StudID?>" title="Emergency Contact">EC Contact</a></li>
    </td>
   <td align="right" valign="top"><input type="button" name="New" value="New" onClick="New_onClick()" class="bgbutton" style="width:60px; height:22px"/>
  <?
  	if($_REQUEST['Type']=="NEW" and $StudID==""){  ?>
      <input type="button" name="Save" value="Save" onClick="Save_onClick()" class="bgbutton" style="width:70px; height:22px"/></td>
      	<?
	}else{  ?>
       <input type="button" name="Save" value="Save" onClick="Update_onClick()" class="bgbutton" style="width:70px; height:22px"/></td>
       <?  }  ?>
            
  </table>      
 </ul>
</div></div></div>
<?
 $staffrigtss=fetchrow(execute("SELECT groupname FROM `users` where username='$user'"));
echo $staffrigtss[0]; 
?>
<table class='forumline'  align='center' width="100%">
<tr>
	<td valign="top" rowspan="100" nowrap>
    <input type="text" name="studentName" value="" size="25"  onChange="SearchName(this.value)" placeholder="Search Here" style="height:25px;"><img src="../images/search.png" align="bottom" height="18" width="22"><BR>
 	<select name="StudID" multiple style="height:600px; width:178px" onChange="Reload(this.value)">             
   <?php
   
   $staffrigtss=fetchrow(execute("SELECT groupname FROM `users` where username='$user'"));
	$academic_year=$_SESSION['AcademicYear'];

   
   if($staffrigtss[0]!='adminm' || $staffrigtss[0]!='admin')
	{
   $sql="select e.id,e.first_name,e.last_name from all_teachers a,users b,class_section c,student_course d,student_m e where b.username='$user' and c.id=a.section and e.id=d.stu_id and c.status=1 and d.class=a.class and e.academic_year='$academic_year' and d.sub_sec=a.section and d.sub=a.sub and b.srid IN ( sub_teac2, sub_teac, home_teac)";
   
   
		if($branch_filter!=0)
		{		
		$sql.=" AND e.course_admitted='$branch_filter'";
		}
		if($sem_filter!=0)
		{
		$sql.=" AND e.course_yearsem='$sem_filter'";
		}
		if($studentName!='')
		{
		$sql.=" AND e.first_name like '%$studentName%'";
		}
   		 
	 $sql.="group by d.stu_id ORDER BY e.first_name, a.class, a.section";


	}
	if($staffrigtss[0]=='adminm' || $staffrigtss[0]=='admin')
	{		
        $sql="SELECT `id`,`first_name`,`last_name` FROM `student_m` WHERE id is not null AND archive='N' AND academic_year='$academic_year'";
	
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
		 
}
 			
 			$rs=execute($sql) or die(mysql_error());
			
            while($row=fetcharray($rs))
            {
                if($StudID==$row['id'])
                	echo "<option value='$row[id]' selected>$row[first_name]&nbsp;$row[last_name]</option>";
                else
               		echo "<option value='$row[id]' >$row[first_name]&nbsp;$row[last_name]</option>";
            }
        ?>
    	</select></td>
     </tr>
     
     <tr>
   <!------------------------------------------------------------------------------------------------------------------------------>
	<td colspan='6' class="row3" valign="top">
    ADMISSION DETAILS &nbsp;&nbsp;[ <?=$details['first_name']?>  <?=$details['last_name']?> ]</td></tr>
<tr height="25" >
		<td nowrap>&nbsp;&nbsp;Application Number</td>
		<td><input name="appl_num" type="text" value="<?=$details['admission_id']?>" size="20" readonly placeholder="Auto-generated"></td>
		
        <td nowrap>Admission Date</td>
		<td colspan="4" nowrap><input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly><a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
    </tr>
		<tr height="25">
		<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> *</td>
		<td>
		<select name="branch" onChange="reloadAjax(this.value)">
		<option value="0">--- Select School Division ---</option>
		<?php
            $sql="SELECT course_id,coursename FROM course_m";
            $rs=execute($sql) or die(error_description());

            if($details['course_admitted']){
                $branch=$details['course_admitted'];
            }
            
            for($i=0;$i<rowcount($rs);$i++)
            {
                $r=fetcharray($rs);
                if($branch==$r['course_id'])
                     echo "<option value=$r[course_id] selected>$r[coursename]</option>";
                else
                    echo "<option value=$r[course_id]>$r[coursename]</option>";
            }
        ?>
		</select>
		</td>
		<td><?php echo $_SESSION['semname']; ?>  *</td>
        <td colspan="4"><div id="txtHint9" class="inline"><select name="sem" >
			<option value='0'>--- Select Grade ---</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b WHERE a.head_id=b.head_id AND b.course_id='$branch'");
				
				if($details['course_yearsem']){
					$sem=$details['course_yearsem'];
				}
				while($r=fetcharray($rs))
				{
					if($sem==$r['year_id'])			
						echo "<option value='$r[year_id]' selected>$r[year_name]</option>";
					else
						echo "<option value='$r[year_id]'>$r[year_name]</option>";
				}
			?>
			</select></div>
		</td>
	</tr>
<tr height="25">
		<td nowrap>&nbsp;&nbsp;Academic Year*</td>
            <td><select name="a_year"  onChange='reload()'>
                <option value='0'>-- Select Year --</option>
                <?php
				   $MyYear=date('Y')-1;
				   $CurrentYr=date("Y")+2;	
				   if($details['academic_year']){	   
				   		$a_year=$details['academic_year'];
				   }
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
					<option value="<?=$i?>" <?=$sele?>><?=$Fyear?> - <?=$Tyear?></option>
						<?php
					 }
		 ?>
              </select></td>
			  <td nowrap>Admission Category*</td>
            <td colspan="4"><select name="fee_type">
                <?php
					$qq="SELECT id,name FROM admission";

					$qqq=execute($qq) or die(error_description());

					for($i=0;$i<rowcount($qqq);$i++)
					{
						$myq=fetcharray($qqq);
						if($details['admission_type']){
							$fee_type=$details['admission_type'];
						}
						if($fee_type==$myq[id])
               			   echo "<option value=$myq[id] selected>$myq[name]</option>";
						else
                		   echo "<option value='$myq[id]' >$myq[name]</option>";
					}
				?>
              </select> </td>
	 </tr>
  <tr height="25"> 
      <td colspan="6" class="row3">STUDENT DETAILS</td>
  </tr>
  <tr height="25">

     <td nowrap>&nbsp;&nbsp;Date of Birth*</td>
     <td nowrap><select name="b_day" onchange='reload()'>
      <?php
	  		  if($details['dob']){
				$dob=$details['dob'];
				
				  $dateArray=explode('-',$dob);
				  $b_day=$dateArray[2];
				  $b_month=$dateArray[1];
				  $b_year=$dateArray[0];
				  
			}
	  		
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
	if($b_month < $m)
	{
		$age_yr=$y - $b_year;
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
		if($age_yr==date("Y")){
			$age_yr='';
		}
	?>
	<td>Age</td>
    <td colspan="6"><input type="text" name="age_yr" value="<?=$age_yr?>" size='2' readonly></td>
    </tr>
   <tr height="25">
    <td nowrap>&nbsp;&nbsp;First Name *</td>
    <td><input type="text" name="fname" value="<?=$details['first_name']?>" size="30"></td>
    <td>Last Name *</td>
	<td colspan="4"><input type="text" name="lname" value="<?=$details['last_name']?>" size="20"></td>
  </tr>
    <tr height="25">
            <td nowrap>&nbsp;&nbsp;Birth Place Details </td>
    
            <td>City&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="place" value="<?=$details['place_of_birth']?>"></td>
			<td>State</td>
			<td colspan="6"><input type="text" name="dist" value="<?=$details['birth_disct']?>"></td>
     </tr>
     <tr height="25"> 

     <td>&nbsp;&nbsp;Nationality*</td>

      <td><select name="nat">
      <option value=''>-- Select Nationality --</option>
          <?php
			   $res = execute("SELECT * FROM nationality");
			
			   if($details['nationality']){
					$nat=$details['nationality'];
				}
			   while($row = fetcharray($res))
			   {
				   
				   if($nat==$row[id])
						echo "<option value='$row[id]' selected>$row[nation]</option>";
					else
						echo "<option value='$row[id]'>$row[nation]</option>";			  
			   }
			?>

        </select> </td>
        <td>Blood Group</td>
         <td colspan="4"><select name="b_group">
          <option value='NA'>-- Select Blood Group --</option>
          <?php
		  		if($details['blood_group']){
					$b_group=$details['blood_group'];
				}
				
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
         <td nowrap>E-Mail ID</td>
	 <td><input type="text" id="std_email" onChange="validateForm(this.name)" name="std_email" value="<?=$details['img_source_s']?>" size="20"></td>   
 </tr>
 <tr>
 	 <td nowrap>&nbsp;&nbsp;Student ID</td>
     <td>
     <input type="text" name="adm_num"  value="<?=$details['student_id']?>"  ></td>
     
     <td nowrap>Gender* </td>
    <td colspan="6"><select name="gender">
    <option value=''>-- Select Gender --</option>
		<?php
			if($details['gender']){
				$gender=$details['gender'];
			}
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
		<td><input type="text" name="state" value="<?=$details['State']?>"></td>
        
        <td nowrap>Mother Tongue*</td>
	    <td colspan="4"><select name="mother">
        <option value=''>-- Select --</option>
	  <?php
			$qq="select id,lang FROM language";

			$qqq=execute($qq) or die(error_description());
			
			if($details['mother_tongue']){
				$mother=$details['mother_tongue'];
			  }
				

			for($i=0;$i<rowcount($qqq);$i++)
			{
				$myq=fetcharray($qqq);
				
				
				if($mother==$myq[id])
	  					echo "<option value=$myq[id] selected>$myq[lang]</option>";
				else
	  				    echo "<option value=$myq[id]>$myq[lang]</option>";
				}
		  ?>
	  </select></td>  
   </tr>
<tr height="25">
   <td colspan="6" class="row3" valign="top">EMERGENCY CONTACT DETAILS</td>
</tr>
<tr>
   <td nowrap>&nbsp;&nbsp;MSG Phone number &nbsp;&nbsp;
   <input type="text" name="msgphone" value="<?=$details['msgphone']?>" maxlength="10" ></td>
   <td>&nbsp;&nbsp;EC number </td>
   <td colspan="2">
   <input type="text" name="usn" value="<?=$details['usn']?>" maxlength="10" > </td>
   
</tr>
<tr>
	<td colspan="6">&nbsp;&nbsp;Mail-Id
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input type="text" name="rgmailid" onChange="validateForm(this.name)"  value="<?=$details['rgmailid']?>" size="30" ></td>
</tr>
	<tr>
		<td colspan="6" class="row3">PARENT/GUARDIAN DETAILS</td>
	</tr>
    <tr>
        <td align='center'>Description</td>
        <td align='center'>Father Details</td>
        <td align='center'>Mother Details</td>
        <td align='center' colspan="4">Guardian Details</td>
    </tr>
     <tr>
        <td>&nbsp;&nbsp;Name</td>
        <td align='center'><input type="text" name="f_name" value="<?=$details['parent_name']?>" size="22" ></td>
        <td align='center'><input type="text" name="mname" value="<?=$details['m_name']?>" size="22"></td>
        <td align='center' colspan="4"><input type="text" name="gname" value="<?=$details['g_name']?>" size="22"></td>
     </tr>
     <tr>
        <td>&nbsp;&nbsp;Occupation</td>
        <td align='center'><input type="text" name="foccup" value="<?=$details['parent_occupation']?>" size="22"></td>
        <td align='center'><input type="text" name="moccup" value="<?=$details['m_occ']?>" size="22"></td>
        <td align='center' colspan="4"><input type="text" name="goccup" value="<?=$details['g_occ']?>" size="22"></td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;Organisation</td>
        <td align='center'><input type="text" name="f_org" value="<?=$details['f_org']?>" size="22"></td>
        <td align='center'><input type="text" name="m_org" value="<?=$details['m_org']?>" size="22"></td>
        <td align='center' colspan="4"><input type="text" name="g_org" value="<?=$details['g_org']?>" size="22"></td>
    </tr>
     <tr>
        <td>&nbsp;&nbsp;Designation</td>
        <td align='center'><input type="text" name="f_desg" value="<?=$details['f_desg']?>" size="22"></td>
        <td align='center'><input type="text" name="m_desg" value="<?=$details['m_desg']?>" size="22"></td>
        <td align='center' colspan="4"><input type="text" name="g_desg" value="<?=$details['g_desg']?>" size="22"></td>
    </tr>
 	<tr>
   	   <td>&nbsp;&nbsp;Mobile Number</td>
       <td align='center'><input type="text" name="fmb" value="<?=$details['sms_mobile']?>" size="22"></td>
       <td align='center'><input type="text" name="mnum" value="<?=$details['mnum']?>" size="22"></td>
       <td align='center' colspan="4"><input type="text" name="gmb" value="<?=$details['g_num']?>" size="22"></td>
   </tr>
   <tr>
      <td>&nbsp;&nbsp;E-mail</td>
      <td align='center'><input type="text" name="femail" value="<?=$details['f_email']?>"  onChange="validateForm(this.name)" size="22" ></td>
      <td align='center'><input type="text" name="memail" value="<?=$details['m_email']?>" onChange="validateForm(this.name)" size="22"></td>
      <td align='center' colspan="4"><input type="text" name="gemail" value="<?=$details['g_mail']?>" onChange="validateForm(this.name)" size="22"></td>
   </tr>
<!--   <tr>
        <td >&nbsp;&nbsp;Educational Qualification</td>
        <td align='center'><input type="text" name="fqul" value="<?=$details['f_quali']?>"></td>	
        <td align='center'><input type="text" name="mqul" value="<?=$details['m_quali']?>"></td>		
        <td align='center' colspan="4"><input type="text" name="gqul" value="<?=$details['g_quali']?>"></td>			
   </tr>-->
   <tr>
        <td >&nbsp;&nbsp;Office Address</td>
        <td align='center'><textarea name="foadd" rows="1" cols="16"><?=$details['foadd']?></textarea></td>	
        <td align='center'><textarea name="moadd" rows="1" cols="16"><?=$details['moadd']?></textarea></td>		
        <td align='center' colspan="4"><textarea name="goadd" rows="1" cols="16"><?=$details['goadd']?></textarea></td>			
	</tr>
    <tr height="25">
		<td width='20%' class="row3" >Present Address </td>
		<td width='80%' class="row3" colspan="6">Permanent Address <br/>
		<input type="checkbox" name="check"  onClick="getAddr(1)">
        &nbsp;&nbsp;&nbsp;Click if Permanent Address is same Present Address</td></td>
	</tr>
    <tr>
    	<td>&nbsp;&nbsp;
		<textarea rows="3" cols="40" name='cor_addr' placeholder="PRESENT ADDRESS"><?=$details['cor_address']?></textarea></td>
       <td colspan="6" align="CENTER">&nbsp;&nbsp;
       <textarea rows="3" cols="40" name='per_addr' placeholder="PERMANENT ADDRESS"><?=$details['per_address']?></textarea>
      </td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;City/Town</td>
        <td><input type="text" name="cor_city" value="<?=$details['cor_city']?>"></td>
        
        <td>City/Town</td>
        <td colspan="4"><input type="text" name="per_city" value="<?=$details['per_city']?>"></td>
    </tr>
	<tr>
		<td>&nbsp;&nbsp;State</td>
        <td><input type="text" name="cor_state" value="<?=$details['cor_state']?>"></td>
        
        <td>State</td>
        <td colspan="4"><input type="text" name="per_state" value="<?=$details['per_state']?>"></td>
    </tr>
    <tr>
		<td>&nbsp;&nbsp;Country</td>
        <td><input type="text" name="cor_country" value="<?=$details['cor_country']?>"></td>
        
        <td>Country</td>
        <td colspan="4"><input type="text" name="per_country" value="<?=$details['per_country']?>"></td>
	</tr>
    <tr>
		<td>&nbsp;&nbsp;Pin Code</td>
        <td><input type="text" name="cor_pin" value="<?=$details['cor_pincode']?>"></td>
        
        <td>Pin Code</td>
        <td colspan="4"><input type="text" name="per_pin" value="<?=$details['per_pincode']?>"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;Phone No</td>
        <td><input type="text" name="cor_phone" value="<?=$details['cor_phone']?>"></td>
        
        <td>Phone No</td>
        <td colspan="4"><input type="text" name="per_phone" value="<?=$details['per_phone']?>"></td>
	</tr>
<tr height="25">
   <td class="row3" colspan="6" >DOCUMENTS ENCLOSED(TICK THE RELEVENT DOCUMENTS)</td>
</tr>
<tr>
	<td>
  <?php
	$sql=execute("SELECT * FROM certificate_m where status=1 order by id") or die(error_description());
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
   <td colspan="6"><textarea rows="5" cols="70" name='extra' value=""><?=$details['extra']?></textarea></td>
</tr>
<tr height="25">
   <td colspan="6" class="row3" >USERNAME & PASSWORD</td>
</tr>
	<tr>
		<td>&nbsp;&nbsp;Student Username</td>   
		<td><input name='username' type='text' value="<?=$details['username']?>" size='15' readonly></td>
		<td>Student Password</td>
		<td colspan="4"><input name='password' type="text" value="<?=$details['password']?>" size='15' readonly></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;Parent Username</td>
		<td><input name='parent_username' type='text' value="<?=$details['parent_username']?>" size='15' readonly></td>
		<td>Parent Password</td>
		<td colspan="4"><input name='parent_password' type="text" value="<?=$details['parent_password']?>" size='15' readonly></td>
	</tr>
	<tr height="25">
   	    <td colspan="6" class="row3" >UPLOAD FILES</td>
 </tr>
 <tr>
    <td height="25">&nbsp;&nbsp;Upload Documents</td>
	<td colspan="6"><input type='FILE' name="uploadedPassport[]" id='uploadedPassport' multiple />  
</tr>
</table>
</form>
</BODY>
</HTML>
