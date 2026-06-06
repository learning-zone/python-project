<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";

session_start();
require_once("../db.php");

$academic_year=$_SESSION['AcademicYear'];

if($_GET)
{
	$studId = $_REQUEST['studId'];
	$branch=$_REQUEST['branch'];
	$sem=$_REQUEST['sem'];
	$academic_year=$_REQUEST['academic_year'];

}

if($_POST)

{

	$Disapprove = $_POST['Disapprove'];

	$StudID  = $_POST['StudID '];

	$appl_num = $_POST['appl_num'];

	$save = $_POST['save'];

	$branch=$_POST['branch'];

	$sem=$_POST['sem'];

	$academic_year=$_POST['academic_year'];

}



?>

<TITLE> Approve Form </TITLE>

<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>

<script language="javascript" src="../js/cal2.js"></script>

<script language="javascript" src="../js/cal_conf2.js"></script>

<script language="javascript">

function reload1()
{
	document.frm.action="approve.php";
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

function EnableStatus()

{

	document.frm.stud_status2.checked=false;

	document.frm.stud_status1.checked=true;

}

function disable1()

{

	document.frm.stud_status2.checked=true;

	document.frm.stud_status1.checked=false;

}

function disable2()

{

	document.frm.stud_status1.checked=true;

	document.frm.stud_status2.checked=false;

}

function calage()

{

	var a=parseInt(document.frm.DobDay.value);

	var b=parseInt(document.frm.DobMon.value);

	var c=parseInt(document.frm.DobYear.value);

	var d=document.frm.adate.value;

	var myarry=d.split('/');

	var aa=parseInt(myarry[0]);

	var bb=parseInt(myarry[1]);

	var cc=parseInt(myarry[2]);

	if(b<bb)

	{

		var f=cc-c;

	}

	else

	{

		if(b==bb)

		{

			if(a<=aa)

			{

				var f=cc-c;

			}

			else

			{

				var f=cc-c-1;

			}

		}

		else

		{

			var f=cc-c-1;

		}

	}

	if(f>0)

	{

		document.frm.age_yr.value=f;

	}

	else

	{

		alert("DOB cannont greater than admission date");

	}

}

//ajax code starts 

function reload(str)

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
</head>
<body>
<form name='frm' method='post' ENCTYPE='multipart/form-data' action="update.php">

<input type="hidden" name="pqr1" value="<?php echo $app_no?>">

<input type="hidden" name="pqr2" value="<?php echo $branch ?>">

<input type="hidden" name="pqr3" value="<?php echo $sem ?>">

<input type="hidden" name="pqr4" value="<?php echo $studfname ?>">

<input type="hidden" name="pqr5" value="<?php echo $a_year?>">

<input type="hidden" name="pqr6" value="<?php echo $un?>">

<input type='hidden' name='StudID' value='<?php echo $StudID ?>'>

<input type='hidden' name='usn' value='<?php echo $usn ?>'>

<?php

$mod="select * from student_m_online where id='$studId'";

$mod1=execute($mod);

$mod2=fetcharray($mod1);

?>

<input type='hidden' name='image' value='<?php echo $mod2[img_source] ?>'>

<table align='center' width='90%' class='forumline' border='2'>

<tr>
	<td align='center' class='head'>Approve Application Form</td>
</tr>
<tr height="25">
	<td class="submenu"><b>Admission details </b></td>
</tr>
<tr>
	<td><table width='100%' border='0' align='center'>
<tr><td nowrap>&nbsp;&nbsp;Application Number</td>

		<td><input name="appl_num" type="text" value="<?php echo $studId?>" size="34" readonly></td>

		<td rowspan='4'><img src="<?php echo $mod2[img_source]?>" width="100" height='100'> </td></tr>

		<tr><td nowrap>&nbsp;&nbsp;Admission Date</td>

        <?

		if($mod2[admission_date]!='0000-00-00')

		{

			$var123 = explode('-',$mod2[admission_date]);

			if($adate=="")

				$adate= $var123[2]."/".$var123[1]."/".$var123[0];

		}

		?>

		<td><input type="text" name="adate" value="<?php echo $adate ?>" readonly>&nbsp;&nbsp;

		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td></tr>

		<tr height="25">

		<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> </td>

		<td>

		<select name="branch" onChange="reload(this.value)">

		<option value="0">----Select----</option>

			<?php

				$sql="select course_id,coursename from course_m";

				$rs=execute($sql) or die(error_description());

				for($i=0;$i<rowcount($rs);$i++)

				{

				  $r=fetcharray($rs);



					if($mod2[course_admitted]==$r[course_id])

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

		</tr>

		<tr>

		<td>&nbsp;&nbsp;<?php

		if(!$branch)

			$branch=$mod2['course_admitted'];

			 echo $_SESSION['semname']; ?> </td>

        <td><div id="txtHint9" class="inline">  

        		<select name="sem">

			<option value='0'>----------Select---------</option>

			<?php

			

				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");

				while($r=fetcharray($rs))

				{

					if($mod2[course_yearsem]==$r[year_id])

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

		</div>

		</td>

	</tr>

<tr height="25">

 <td>&nbsp;&nbsp;Academic Year</td>

              <td> <select name="a_year" id="a_year" >

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

			  <td nowrap>&nbsp;&nbsp;Admission Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <select name="fee_type">

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

	</tr></table></td></tr>

<tr><td>

 <table border='0' align='center' width='100%' class='forumline'>

    <tr height="25"> 

      <td colspan=6 class="submenu"><b>Student Details</b> </td>

    </tr>

	<tr height="25">

    <td nowrap>&nbsp;&nbsp;First Name </td>

    

    <td><input type="text" name="fname" value="<?php echo $mod2[first_name]?>" size=30></td>

      <td>&nbsp;&nbsp;Last Name </td>

		<td><input type="text" name="lname" value="<?php echo $mod2[last_name]?>" size=40></td>

	<td>&nbsp;Gender</td>

		<td>

			<select name="gender">

			<option value="0">-------select--------</option>

			<?php

               if($mod2[gender]== "M")

                 {

	             $sj="selected";

	             $sk="";

                 }

               if($mod2[gender]== "F")

                 {

	           $sk="selected";

	           $sj="";

               }

			   ?>

			<option value="M" <?=$sj?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Male</option>

			<option value="F" <?=$sk?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Female</option>

            </select>

		</td>

        

        </tr>

		<td nowrap>&nbsp;&nbsp;Date of Birth</td>

		<?php

		$dc = explode('-',$mod2[dob]);

		if($DobDay=="")

		{

			$DobDay=$dc[2];

			$DobMon=$dc[1];

			$DobYear=$dc[0];

		}

		?>

        <td><select name="DobDay" onchange='calage()'>

		 <?php

		        for($i=1;$i<=31;$i++)

                   {

					   $sel='';

	               if($i == $DobDay)

					   $sel='selected';

		           echo "<option value='$i' $sel>$i</option>";

	               }

         ?>

				</select>

                

				<select name="DobMon" onchange='calage()'>

				<?php

				for($i=1;$i<=12;$i++)

				{

					   $sel='';

					if($i==$DobMon)

						$sel='selected';

                    echo "<option value='$i' $sel>$i</option>";

				}

				?>

				</select>

				

				<select name="DobYear" onchange='calage()'>

				<?php

				$j=date('Y');

				$d=$j-30;

				for($i=$d;$i<=$j+1;$i++)

                    {

						$sel='';

	                  if($i==$DobYear)

						  $sel='selected';

	                  echo "<option value=$i $sel>$i</option>";

                    }

				?>

				</select>

		</td> 

	<td>&nbsp;&nbsp;Age on Admission</td><td><input type="text" name="age_yr" value="<?php echo $mod2[age] ?>" size='2' readonly></td>

	<td nowrap>

            &nbsp;Mother Tongue</td>

            <td><select name="mother">

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

                <option value="<?php echo $myq[id] ?>"> 

                <?=$myq[lang]?>

                </option>

                <?php

						         }

							  }

						?>

              </select> </td></tr>

     <tr height="25">

            <td nowrap>&nbsp;&nbsp;Birth Place Details  </td>

            <td>City&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="place" value="<?php echo $mod2[place_of_birth]?>"></td>

			<td>&nbsp;&nbsp;State</td>

			<td><input type="text" name="dist" value="<?php echo $mod2[birth_disct]?>"></td> 	

			<td>&nbsp;Country</td>

			<td><input type="text" name="state" value="<?php echo $mod2[State]?>"></td></tr>

     <tr height="25"> 

      	<td>&nbsp;&nbsp;Nationality</td>

      <td><select name="nat">

          <option value="0">----- select -----</option>

			<?php

			   $res = execute("select * from nationality");

			   while($row = fetcharray($res))

			   {

				   if($mod2[nationality]==$row[id])

					{

						echo "<option value='$row[id]' selected>&nbsp;&nbsp;$row[nation]</option>";

					}

					else

					{

						echo "<option value='$row[id]'>&nbsp;&nbsp;$row[nation]</option>";

					}

				   //echo "<option value='$row[id]'>$row[nation]</option>";

			   }

			?></select> </td> 

	<td nowrap>&nbsp;&nbsp;Mother Tongue</td>            

     <td ><select name="mother">

		<?php

		$qq="select id,lang from language";

		$qqq=execute($qq) or die(error_description());

		for($i=0;$i<rowcount($qqq);$i++)

		{

			$myq=fetcharray($qqq);

			if($mod2[mother_tongue]==$myq[id])

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

        </select> </td>

      <td>&nbsp;Blood Group</td>

      <td > <select name="b_group">

          <option value='NA'>-------select--------</option>

          <?php

                             if($mod2[blood_group]=="A+ve")

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

                             if($mod2[blood_group]=="B+ve")

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

                             if($mod2[blood_group]=="A-ve")

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

								 if($mod2[blood_group]=="B-ve")

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

								 if($mod2[blood_group]=="O+ve")

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

								 if($mod2[blood_group]=="O-ve")

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

								 if($mod2[blood_group]=="AB+ve")

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

								 if($mod2[blood_group]=="AB-ve")

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

			 <td nowrap>&nbsp;&nbsp;Change Student Photo</td>

           <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>

        <td nowrap>&nbsp;&nbsp;E-Mail ID</td>

	 <td><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='40'></td> 

     <td nowrap></td>            

     <td ></td>

                </tr>

  </table></td></tr>

  <tr><td>

  <table border='0' align='center' width='100%' class='forumline' >

<tr>

   <td colspan="6" class="submenu"><b>Regular contact details </b></td>

</tr>

<tr>

   <td>&nbsp;&nbsp;MSG Phone number</td>

   <td><input type="text" name="msgphone" value="<?php echo $mod2['msgphone']; ?>" maxlength="10" > </td>

   <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

   <input type="text" name="usn" value="<?php echo $mod2['usn']; ?>" maxlength="10" > </td>

   <td>Mail-Id</td>

   <td><input type="text" name="rgmailid" value="<?php echo $mod2['rgmailid']; ?>" size="45" ></td>

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

<td align='center' colspan=1>Guardian Details

</td></tr>

 <tr>

	<td nowrap>&nbsp;&nbsp;Name</td>

	<td align='center'><input type="text" name="f_name" value="<?php echo $mod2[parent_name]?>" size="40" ></td>

	<td align='center'><input type="text" name="mname" value="<?php echo $mod2[m_name] ?>" size="40" ></td>

	<td align='center'><input type="text" name="gname" value="<?php echo $mod2[g_name] ?>" size="40" ></td>

	</tr>

    <tr>

	<td nowrap>&nbsp;&nbsp;Occupation</td>

	<td align='center'><input type="text" name="foccup" value="<?php echo $mod2[parent_occupation]?>" size="40">

	</td><td align='center'><input type="text" name="moccup" value="<?php echo $mod2[m_occ] ?>" size="40" >

	  </td>

	<td align='center'><input type="text" name="goccup" value="<?php echo $mod2[g_occ]?>" size="40" ></td>

</tr>

 <tr>

   <td nowrap>&nbsp;&nbsp;Mobile Number</td>

   <td align='center'><input type="text" name="fmb" value="<?php echo $mod2[sms_mobile]?>" size="40"></td>

   <td align='center'><input type="text" name="mnum" value="<?php echo $mod2[mnum]?>" size="40"></td>

   <td align='center'><input type="text" name="gmb" value="<?php echo $mod2[g_num]?>" size="40"></td>

 </tr>

 <tr>

	<td nowrap>&nbsp;&nbsp;E-mail</td>

	<td align='center'><input type="text" name="femail" value="<?php echo $mod2[f_email]?>" size="40"></td>

	<td align='center'><input type="text" name="memail" value="<?php echo $mod2[m_email]?>" size="40"></td>

	<td align='center'><input type="text" name="gemail" value="<?php echo $mod2[g_mail]?>" size="40"></td>

 </tr>

 <tr>

<td nowrap>&nbsp;&nbsp;Educational Qualification</td>

<td align='center'><input type="text" name="fqul" value="<?php echo $mod2[f_quali] ?>" size="40"></td>	

<td align='center'><input type="text" name="mqul" value="<?php echo $mod2[m_quali] ?>" size="40"></td>		

<td align='center'><input type="text" name="gqul" value="<?php echo $mod2[g_quali] ?>" size="40"></td>			

		</tr>

		<tr>

<td nowrap>&nbsp;&nbsp;Office Address</td>

<td align='center'><input type="text" name="foadd" value="<?php echo $mod2[foadd] ?>" size="40"></td>	

<td align='center'><input type="text" name="moadd" value="<?php echo $mod2[moadd] ?>" size="40"></td>		

<td align='center'><input type="text" name="goadd" value="<?php echo $mod2[goadd] ?>" size="40"></td>			

		</tr>

</table></td></tr>

<tr><td>

<table border='0' align='center' width='100%' class='forumline'>

	<tr height="25">

		<td class="submenu" colspan="3" nowrap ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Present Address</b> </td>

		<td class="submenu" nowrap ><b>Permanent Address</b></td>

		<tr> 

        <td></td>

        <td><input type="checkbox" name="check" value="" onClick="getAddr()">&nbsp;&nbsp;&nbsp;Click if Permanent Address is same Present Address</td></td>

	</tr>

    <tr>
    	<td nowrap>&nbsp;&nbsp;Address</td>
		<td><textarea style="width: 223px; height: 50px;" name='cor_addr' ><?php echo $mod2[cor_address] ?></textarea></td>
        
      <td nowrap>&nbsp;&nbsp;Address</td>
	  <td><textarea style="width: 223px; height: 50px;" name='per_addr'><?php echo $mod2[per_address]?></textarea></td>
	</tr>
	<tr>
		<td nowrap>&nbsp;&nbsp;City/Town</td>
            <td><input type="text" name="cor_city" value="<?php echo $mod2[cor_city]?>" size="40"></td>
      
		<td nowrap>&nbsp;&nbsp;City/Town</td>
            <td><input type="text" name="per_city" value="<?php echo $mod2[per_city]?>" size="40"></td>
	  </tr>
      <tr>
			<td nowrap>&nbsp;&nbsp;State</td><td><input type="text" name="cor_state" value="<?=$mod2[cor_state]?>" size="40"></td>
			<td nowrap>&nbsp;&nbsp;State</td><td><input type="text" name="per_state" value="<?=$mod2[per_state]?>" size="40"></td>
		</tr>
		<tr>
			<td nowrap>&nbsp;&nbsp;Country</td><td><input type="text" name="cor_country" value="<?=$mod2[cor_country]?>" size="40"></td>
			<td nowrap>&nbsp;&nbsp;Country</td><td><input type="text" name="per_country" value="<?=$mod2[per_country]?>" size="40"></td>

		</tr>
		<tr>
			<td nowrap>&nbsp;&nbsp;Pin Code</td><td><input type="text" name="cor_pin" value="<?=$mod2[cor_pincode]?>" size="40"></td>
			<td nowrap>&nbsp;&nbsp;Pin Code</td><td><input type="text" name="per_pin" value="<?=$mod2[per_pincode]?>" size="40"></td>

		</tr>
		<tr>
			<td nowrap>&nbsp;&nbsp;Phone No</td><td><input type="text" name="cor_phone" value="<?=$mod2[cor_phone]?>" size="40"></td> 
			<td nowrap>&nbsp;&nbsp;Phone No</td><td><input type="text" name="per_phone" value="<?=$mod2[per_phone]?>" size="40"></td>
  </tr>
</table></td></tr>
<tr><td>
</td>
</tr>
</table></td></tr>
<tr><td>
<table border='0' align='center' width='90%' class='forumline' >
<tr>
   <td align='center'>&nbsp;&nbsp;Remarks</td>
   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea rows="4" cols="100" name='extra' > <?=$mod2[remarks]?></textarea></td>
</tr>

</table>
</td></tr>
</table><br>

<div align='center'>
  <input type="submit" value="Disapprove" name="Disapprove" class='bgbutton'>
  <input type="submit" value="Approve" name="save" class='bgbutton'>
</div>
<input type='hidden' name='s_name' value='<?php echo $fname ?>'>
</form>
</body>
</html>

