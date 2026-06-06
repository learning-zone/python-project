<HTML>
<HEAD>
<TITLE> New Document </TITLE> 

<?php
	session_start();
	include("../db.php");
	$da = date("y");
?>
<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
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
	document.frm.per_addr.value    = document.frm.cor_addr.value;
	document.frm.per_city.value   = document.frm.cor_city.value;
	document.frm.per_state.value   = document.frm.cor_state.value;
	document.frm.per_country.value = document.frm.cor_country.value;
	document.frm.per_pin.value	   = document.frm.cor_pin.value;
	document.frm.per_phone.value	   = document.frm.cor_phone.value;
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
</HEAD>
 <BODY>
 <?php
if(!$_POST)
{
	$action=$_REQUEST[''];
	$flag=$_REQUEST['flag'];
	$fname=$_REQUEST['fname'];
}
else
{
$adate=$_POST['adate'];
$std_email=$_POST['std_email'];
 $usn=$_POST['usn'];
$appl_num=$_POST['appl_num'];
$adm_num=$_POST['adm_num'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$nat=$_POST['nat'];
$rel=$_POST['rel'];
$gender=$_POST['gender'];
$caste=$_POST['caste'];
$dob=$_POST['dob'];
$age_yr=$_POST['age_yr'];
$per_addr=$_POST['per_addr'];
$per_city=$_POST['per_city'];
$per_state=$_POST['per_state'];
$per_country=$_POST['per_country'];
$per_pin=$_POST['per_pin'];
$per_phone=$_POST['per_phone'];
$cor_addr=$_POST['cor_addr'];
$cor_city=$_POST['cor_city'];
$cor_state=$_POST['cor_state'];
$cor_country=$_POST['cor_country'];
$cor_pin=$_POST['cor_pin'];
$cor_phone=$_POST['cor_phone'];
$f_name=$_POST['f_name'];
$foccup=$_POST['foccup'];
$finc=$_POST['finc'];
$branch=$_POST['branch'];
$sem=$_POST['sem'];
$cat=$_POST['cat'];
$a_year=$_POST['a_year'];
$extra=$_POST['extra'];
$username=$_POST['username'];
$password=$_POST['password'];
$parent_username=$_POST['parent_username'];
$parent_password=$_POST['parent_password'];
$b_group=$_POST['b_group'];
$fee_type=$_POST['fee_type'];
$memail=$_POST['memail'];
$mmb=$_POST['mmb'];
$gname=$_POST['gname'];
$goccup=$_POST['goccup'];
$ginc=$_POST['ginc'];
$gmb=$_POST['gmb'];
$gemail=$_POST['gemail'];
$femail=$_POST['femail'];
$place=$_POST['place'];
$fqul=$_POST['fqul'];
$mqul=$_POST['mqul'];
$gqul=$_POST['gqul'];
$lang=$_POST['lang'];
$state=$_POST['state'];
$fmb=$_POST['fmb'];
$mother=$_POST['mother'];
$dist=$_POST['dist'];
$stud_type=$_POST['stud_type'];
$vdt=$_POST['vdt'];
$mname=$_POST['mname'];
$moccup=$_POST['moccup'];
$minc=$_POST['minc'];
$foadd=$_POST['foadd'];
$moadd=$_POST['moadd'];
$goadd=$_POST['goadd'];
$sel=$_POST['sel'];
$msgphone=$_POST['msgphone']; 
$rgmailid=$_POST['rgmailid'];
$b_year=$_POST['b_year'];
$b_month=$_POST['b_month'];
$b_day=$_POST['b_day'];

}
 	if($branch!=0 && $sem!=0 && $a_year!=0)
	{
			$da = substr($a_year,2,4);	
			$var = "select MAX(id) from student_m where academic_year='$a_year'";
			$res = mysql_query($var) or die(mysql_error());
			$row = mysql_fetch_row($res);
			if($row[0]=="")
			{
				$var01 = $_SESSION['SchoolCode'].$da."0001";	
				$app_num=$var01; 
			}
			else
			{
				$var1 = mysql_query("select student_id from student_m where id='$row[0]'") or die(mysql_error());
				$row1 = mysql_fetch_row($var1);
				$vara=substr("$row1[0]",6);
				$varb = $vara+1;
				if($varb<10)
					$app_num = $_SESSION['SchoolCode'].$da."000".$varb;
				else if($varb<100)
					$app_num = $_SESSION['SchoolCode'].$da."00".$varb;
				else if($varb<1000)
					$app_num = $_SESSION['SchoolCode'].$da."0".$varb;
				else
					$app_num = $_SESSION['SchoolCode'].$da.$varb;
			}
			$papp_num = $app_num."P";
	}
 ?>
 <form name='frm' method='post' ENCTYPE="multipart/form-data" action='res.php'>
<table align='center' width='95%' class='forumline' border='2' >
<tr><td align='center' class='head'>
<!--<table border='0' align='center' width='100%' class='forumline'>
<tr><td align='center'  class="head"><?php echo collegename(); ?>
</td></tr>
<tr><td align='center'  class="head"><?php echo collegeadress(); ?></td></tr>
</table>--><b>ADMISSION FORM</b></td></tr>
<tr><td align='center'>
<table border='0' align='center' width='100%' class='forumline'>
<tr height="25">
	<td colspan='4' class="submenu" ><b>Admission details </b></td></tr>
<tr height="25">
<td nowrap>&nbsp;&nbsp;Application Number</td>
		<td><input name="appl_num" type="text" value="<?php echo $app_num ?>" size="34" readonly></td>
			<td>&nbsp;&nbsp;Admission Date</td>
		<td><input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td></tr>
		<tr height="25">
		<td width="15%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> *</td>
		<td width="35%">
		<select name="branch" id="branch" onchange='reload()'>
		<option value="0">-------- Select --------</option>
			<?php
				$sql="select course_id,coursename from course_m";
				$rs=mysql_query($sql) or die(error_description());
				for($i=0;$i<rowcount($rs);$i++)
				{
				  $r=mysql_fetch_array($rs);

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
		
		<td width='15%'>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?>  *</td>
        <td width='35%'><select name="sem" id="sem" onchange='reload()'>
			<option value='0'>----------Select---------</option>
			<?php
				$rs=mysql_query("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=mysql_fetch_array($rs))
				{
					if($sem==$r[year_id])
					{
						echo "<option value='$r[year_id]' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
					}
					else
					{
						echo "<option value='$r[year_id]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $r[year_name]</option>";
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
            <td> <select name="fee_type">
                <?php
							$qq="select id,name from admission";
					        $qqq=mysql_query($qq) or die(error_description());
							for($i=0;$i<rowcount($qqq);$i++)
							  {
								$myq=mysql_fetch_array($qqq);
                                if($fee_type==$myq[id])
								 {
						?>
                <option value="<?=$myq[id]?>" selected><?php echo $myq[name] ?></option>
                <?php
								 }
							else
								 {
						?>
                <option value="<?php echo $myq[id] ?>"> 
                <?=$myq[name]?>
                </option>
                <?php
						         }
							  }
						?>
              </select> </td>
	</tr>
</table></td></tr>
<tr><td>
 <table border='0' align='center' width='100%' class='forumline'>
    <tr height="25"> 
      <td colspan=6 class="submenu"><b>Student Details </b></td>
    </tr>
	<tr height="25">
    <td nowrap>&nbsp;&nbsp;First Name *</td>
    <td><input type="text" name="fname" value="<?=$fname?>" size=40></td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Last Name *</td>
		<td><input type="text" name="lname" value="<?=$lname?>" size=40></td>
	<td>&nbsp;&nbsp;Student ID</td><td><input type="text" name="adm_num"  value="<?php echo $app_num ?>"  onchange='updtid(this.value)' readonly></td></tr>
		<tr height="25"><td nowrap>&nbsp;&nbsp;Date of Birth*</td><td nowrap><select name="b_day" onchange='reload()'>
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
	<td>&nbsp;&nbsp;Age</td><td><input type="text" name="age_yr" value="<?php echo $age_yr?>" size='2' readonly></td>
	<td nowrap>&nbsp;&nbsp;Gender* </td>
            <td><select name="gender">
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
              <option value="M" <?=$sj?>>&nbsp;&nbsp;&nbsp;&nbsp;Male</option>
              <option value="F" <?=$sk?>>&nbsp;&nbsp;&nbsp;&nbsp;Female</option>
          </select></td></tr>
     <tr height="25">
            <td nowrap>&nbsp;&nbsp;Birth Place Details </td>
            <td>City&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="place" value="<?php echo $place?>"></td>
			<td>&nbsp;&nbsp;State</td>
			<td><input type="text" name="dist" value="<?php echo $dist?>"></td>
			<td>&nbsp;&nbsp;Country</td>
			<td><input type="text" name="state" value="<?php echo $state?>"></td></tr>  
    <tr height="25">
	 <td>&nbsp;&nbsp;Region</td>
            <td><select name="stud_type">
    <?php
                             if($stud_type=="1")
                                 {
	                               $x="selected";
	                               $y="";
								   $z="";
                                 }
                             if($stud_type=="2")
                                 {
								   $x="";
	                               $y="selected";
	                               $z="";
                                  }
                             if($stud_type=="3")
                                 {
	                               
	                               $x="";
								   $y="";
								   $z="selected";
								 }
							?>
                    <option value="1" <?=$x?>>LOCAL 
                  </option>
                  <option value="2" <?=$y?>>OTHER STATE 
                  </option>
                  <option value="3" <?=$z?>>FOREIGN </option>
   </select>
  </td>
      <td>&nbsp;&nbsp;Religion</td>
      <td> <select name="rel">
          <?php
		  if($rel=="")
			$rel=3;
			   $res = mysql_query("select * from religion");
			   while($row = mysql_fetch_array($res))
			   {
				   if($rel==$row[id])
					{
						echo "<option value='$row[id]' selected>&nbsp;&nbsp;$row[name]</option>";
					}
					else
					{
						echo "<option value='$row[id]'>&nbsp;&nbsp;$row[name]</option>";
					}
				   //echo "<option value='$row[id]'>$row[name]</option>";
			   }
			?>
        </select> </td>
		 <td>&nbsp;&nbsp;Nationality*</td>
      <td><select name="nat">
          <?php
			   $res = mysql_query("select * from nationality");
			   while($row = mysql_fetch_array($res))
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
		<tr height="25"> 
      <td>&nbsp;&nbsp;Caste</td>
      <td><input type="text" name="caste" value="<?php echo $caste?>"></td>
	<td nowrap>&nbsp;&nbsp;Caste Category*</td>
      <td  > <select name="cat">
          <option value="0">-------select--------</option>
          <?php
			   $res = mysql_query("select * from category");
			   while($row = mysql_fetch_array($res))
			   {
				   if($cat==$row[id])
					{
						echo "<option value='$row[id]' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $row[name]</option>";
					}
					else
					{
						echo "<option value='$row[id]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $row[name]</option>";
					}
			   }
			?>
        </select> </td>
      <td>&nbsp;&nbsp;Blood Group</td>
      <td > <select name="b_group">
          <option value='NA'>-------select--------</option>
          <?php
                             if($b_group=="A+ve")
                                 {
	                               $m="selected";
	                               $n="";
								   $o="";
                                   $p="";
								   $r="";
								   $s="";
								   $t="";
								   $u="";
			                     }
                             if($b_group=="B+ve")
                                 {
								   $m="";
	                               $n="selected";
								   $o="";
                                   $p="";
								   $r="";
								   $s="";
								   $t="";
								   $u="";
                                  }
                             if($b_group=="A-ve")
                                 {
	                               $m="";
	                               $n="";
								   $o="selected";
                                   $p="";
								   $r="";
								   $s="";
								   $t="";
								   $u="";
								 }
								 if($b_group=="B-ve")
                                 {
	                               $m="";
	                               $n="";
								   $o="";
                                   $p="selected";
								   $r="";
								   $s="";
								   $t="";
								   $u="";
								 }
								 if($b_group=="O+ve")
                                 {
	                               $m="";
	                               $n="";
								   $o="";
                                   $p="";
								   $r="selected";
								   $s="";
								   $t="";
								   $u="";
								 }
								 if($b_group=="O-ve")
                                 {
	                               $m="";
	                               $n="";
								   $o="";
                                   $p="";
								   $r="";
								   $s="selected";
								   $t="";
								   $u="";
								 }
								 if($b_group=="AB+ve")
                                 {
	                               $m="";
	                               $n="";
								   $o="";
                                   $p="";
								   $r="";
								   $s="";
								   $t="selected";
								   $u="";
								 }
								 if($b_group=="AB-ve")
                                 {
	                               $m="";
	                               $n="";
								   $o="";
                                   $p="";
								   $r="";
								   $s="";
								   $t="";
								   $u="selected";
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
			 <td nowrap>&nbsp;&nbsp;Other Languages Known</td>
			  <td><input type="text" name="lang" value="<?php echo $lang; ?>" size='40'></td>
             <td nowrap>&nbsp;&nbsp;E-Mail ID</td>
	 <td><input type="text" id="std_email" onChange="validateForm(this.name)" name="std_email" value="<?php echo $std_email; ?>" size='40'></td>
     <td nowrap>&nbsp;&nbsp;Mother Tounge*</td>
	<td ><select name="mother">
	  <?php
							$qq="select id,lang from language";
					        $qqq=mysql_query($qq) or die(error_description());
							for($i=0;$i<rowcount($qqq);$i++)
							  {
								$myq=mysql_fetch_array($qqq);
                                if($mother==$myq[id])
								 {
						?>
	  <option value="<?=$myq[id]?>" selected><?php echo $myq[lang] ?></option>
	  <?php
								 }
							else
								 {
						?>
	  <option value="<?php echo $myq[id] ?>">
	    <?=$myq[lang]?>
	    </option>
	  <?php
						         }
							  }
						?>
	  </select></td>
     
 </tr>
	<tr><td nowrap>&nbsp;&nbsp;Upload Student Photo</td>
           <td colspan='5'><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td></tr>
  </table></td></tr>
  <tr><td>
  <table border='0' align='center' width='100%' class='forumline' >
<tr height="25">
   <td colspan="4" class="submenu"><b>Emergency contact details </u>
   </b></td>
</tr>
<tr>
   <td nowrap>&nbsp;&nbsp;MSG Phone number &nbsp;&nbsp;
   <input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" ></td>
   <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;
   <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>
   <td>Mail-Id</td>
   <td><input type="text" name="rgmailid" onChange="validateForm(this.name)"  value="<?php echo $rgmailid; ?>" size="45" ></td>
</tr>

<tr>
	
</table>
<table border='0' align='center' width='100%' class='forumline'>
    <tr height="25">
		<td colspan=8  class="submenu"><b>Parent/Guardian Details</b></td>
</tr>
<tr>
<td align='center' colspan=1>Description</td>
<td  align='center' colspan=1>Father Details</td>
<td align='center' colspan=1>Mother Details</td>
<td align='center' colspan=1>Gaurdian Details
</td></tr>
 <tr>
	<td>&nbsp;&nbsp;Name</td>
	<td align='center'><input type="text" name="f_name" value="<?php echo $f_name?>" ></td>
	<td align='center'><input type="text" name="mname" value="<?php echo $mname ?>" ></td>
	<td align='center'><input type="text" name="gname" value="<?php echo $gname?>" ></td>
	</tr>
    <tr>
	<td>&nbsp;&nbsp;Occupation</td>
	<td align='center'><input type="text" name="foccup" value="<?php echo $foccup?>">
	</td><td align='center'><input type="text" name="moccup" value="<?php echo $moccup ?>" ></td>
	<td align='center'><input type="text" name="goccup" value="<?php echo $goccup?>" ></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;Annual Income</td>
	<td align='center'><input type="text" name="finc" value="<?php echo $finc?>"></td>
	<td align='center'><input type="text" name="minc" value="<?php echo $minc?>" ></td>
	<td align='center'><input type="text" name="ginc" value="<?php echo $ginc?>" ></td>
 </tr>
 <tr>
	<td>&nbsp;&nbsp;Mobile Number</td>
	<td align='center'><input type="text" name="fmb" value="<?php echo $fmb?>"></td>
	<td align='center'><input type="text" name="mnum" value="<?php echo $mnum?>" ></td>
	<td align='center'><input type="text" name="gmb" value="<?php echo $gmb?>" ></td>
 </tr>
 <tr>
	<td>&nbsp;&nbsp;E-mail</td>
	<td align='center'><input type="text" name="femail" value="<?php echo $femail?>" onChange="validateForm(this.name)" ></td>
	<td align='center'><input type="text" name="memail" value="<?php echo $memail?>" onChange="validateForm(this.name)" ></td>
	<td align='center'><input type="text" name="gemail" value="<?php echo $gemail?>" onChange="validateForm(this.name)" ></td>
 </tr>
 <tr>
<td >&nbsp;&nbsp;Educational Qualification</td>
<td align='center'><input type="text" name="fqul" value="<?php echo $fqul ?>"></td>	
<td align='center'><input type="text" name="mqul" value="<?php echo $mqul ?>"></td>		
<td align='center'><input type="text" name="gqul" value="<?php echo $gqul ?>"></td>			
		</tr>
		<tr>
<td >&nbsp;&nbsp;Office Address</td>
<td align='center'><input type="text" name="foadd" value="<?php echo $foadd ?>"></td>	
<td align='center'><input type="text" name="moadd" value="<?php echo $moadd ?>"></td>		
<td align='center'><input type="text" name="goadd" value="<?php echo $goadd ?>"></td>			
		</tr>
</table></td></tr>
<tr><td>
<table border='0' align='center' width='100%' class='forumline'>
	<tr height="25">
		<td width='50%' class="submenu" ><b>Present Address</b> </td>
		<td width='50%' class="submenu"><b>Permanent Address</b> <br>
		<input type="checkbox" name="check" value="" onClick="getAddr()">&nbsp;&nbsp;&nbsp;Click if Permanent Address is same Present Address</td></td>
	</tr>
    <tr><td>&nbsp;&nbsp;
	<textarea rows="3" cols="25" name='cor_addr' value=""><?=$cor_addr?></textarea></td>
		
      <td>&nbsp;&nbsp;
<textarea rows="3" cols="25" name='per_addr' value=""><?=$per_addr?></textarea>
      </td>
	</tr>
		<td><table border="0">
		<tr>
		<td>&nbsp;&nbsp;City/Town</td>
            <td><input type="text" name="cor_city" value="<?php echo $cor_city?>"></td></tr>
			<tr>
			<td>&nbsp;&nbsp;State</td><td><input type="text" name="cor_state" value="<?=$cor_state?>"></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;Country</td><td><input type="text" name="cor_country" value="<?=$cor_country?>"></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;Pin Code</td><td><input type="text" name="cor_pin" value="<?=$cor_pin?>"></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;Phone No</td><td><input type="text" name="cor_phone" value="<?=$cor_phone?>"></td>
		</tr></table></td>
		<td><table border="0">
		<tr>
		<td>&nbsp;&nbsp;City/Town</td>
            <td><input type="text" name="per_city" value="<?php echo $per_city?>"></td>
			</tr>
			<tr>
			<td>&nbsp;&nbsp;State</td><td><input type="text" name="per_state" value="<?=$per_state?>"></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;Country</td><td><input type="text" name="per_country" value="<?=$per_country?>"></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;Pin Code</td><td><input type="text" name="per_pin" value="<?=$per_pin?>"></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;Phone No</td><td><input type="text" name="per_phone" value="<?=$per_phone?>"></td>
		</tr></table></td>
	</tr>	
</table></td></tr>
<tr><td>
<table border='0' align='center' width='100%' class='forumline' >
<tr height="25">
   <td class="submenu" ><b>Documents Enclosed(Tick the relevent documents)</td>
</tr>
<tr>
	<td><table border="0" width='100%' >
  <?php
$sql=mysql_query("select * from certificate_m where status=1 order by id") or die(error_description());
$count=0;
for($i=0;$i<rowcount($sql);$i++)
{
	$sel=$_POST['sel'];
	$r1=mysql_fetch_array($sql);
	$count=$count+1;
	if($sel[$i])
	$check='checked';
	else
	$check='';
	
	?>
		<td width='2%'>
        <input type="checkbox" name="sel[]" value="<?=$r1["id"]?>"  <?=$check?>>
		</td><td><?=$r1["name"]?></td>
	<?
	if($count==4)
	{
		echo "</tr>";
		$count=0;
	}
}
	if($count!=0)
	echo "<td colspan=2></td></tr>";
?>
</table>
</td>
</tr>
</table></td></tr>
<tr><td>
<table border='0' align='center' width='100%' class='forumline' >
<tr>
   <td align='center'>Remarks</td>
	<td>
		<textarea rows="5" cols="100" name='extra' value=""><?=$extra?></textarea> 
	</td>
</tr>
</table>


<table class='forumline' align='center' width='100%' border="0">
<tr height="25">
   <td colspan="4" class="submenu" ><b>Username & Password</b></td>
</tr>
	<tr>
		<td>&nbsp;&nbsp;Student Username</td>   
		<td><input name='username' type='text' value="<?=$app_num?>" size='15' readonly="true"></td>
		<td>&nbsp;&nbsp;Student Password</td>
		<td><input name='password' type="text" value="<?=$app_num?>" size='15' readonly="true"></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;Parent Username</td>
		<td><input name='parent_username' type='text' value="<?=$papp_num?>" size='15' readonly="true"></td>
		<td>&nbsp;&nbsp;Parent Password</td>
		<td><input name='parent_password' type="text" value="<?=$papp_num?>" size='15' readonly="true"></td>
	</tr>
</table></td></tr>
</table><br>
<div align='center'>
<input type="submit" value="Save Details" name="save" class='bgbutton'>
</div>
<input type='hidden' name='s_name' value='<?php echo $fname ?>'>
</form>

</BODY>
</HTML>
<?php
	if($action=='save')
	{
		if($flag==1)
		{
		 ?>
			<script language='javascript'>
	        var fname = document.frm.s_name.value; 
			alert(fname + '`s' +' Details Added Successfully');
			</script>
		<?php
	    }
	}
?>