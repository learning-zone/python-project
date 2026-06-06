<?php 
session_start();
include ("../db.php");

$da = date("y");

$store_stud = $_POST['store_stud'];

if (!$_POST['store_stud']) {

    $store_stud = date("his");

} else {

    $store_stud = $_POST['store_stud'];

}
?>

<!DOCTYPE HTML>

<HTML>

<HEAD>

<TITLE> ADD STUDENT DETAILS </TITLE> 

<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>

<script language="javascript" src="../js/cal2.js"></script>

<script language="javascript" src="../js/cal_conf2.js"></script>

<script language="javascript" type="text/javascript">
    function validateForm(tempn) {

        var x = document.forms["frm"][tempn].value;

        var atpos = x.indexOf("@");

        var dotpos = x.lastIndexOf(".");

        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {

            alert("Not a valid e-mail address");

            return false;

        }

    }

    function reload() {

        document.frm.action = 'SearchStudent.php';

        document.frm.submit();

    }

    function OpenWind2(k2) {

        var finalVar;

        finalVar = k2;

        window.open(finalVar, 'Stud', 'width=1100,height=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

    }

    function getAddr() {

        document.frm.per_addr.value = document.frm.cor_addr.value;

        document.frm.per_city.value = document.frm.cor_city.value;

        document.frm.per_state.value = document.frm.cor_state.value;

        document.frm.per_country.value = document.frm.cor_country.value;

        document.frm.per_pin.value = document.frm.cor_pin.value;

        document.frm.per_phone.value = document.frm.cor_phone.value;

    }

    function updtid(a) {

        var b = a + "P";

        document.frm.username.value = a;

        document.frm.password.value = a;

        document.frm.parent_username.value = b;

        document.frm.parent_password.value = b;

    }

</script>

<script language="javascript">
    function OpenWindC(URL, title, w, h) {

        var left = (screen.width / 2) - (w / 2);

        var top = (screen.height / 2) - (h / 2);

        var newWin = window.open(URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

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



$b_day=$_POST['b_day' ];

    }

    if($branch!=0 && $sem!=0 && $a_year!=0)

    {

    $res = mysql_fetch_row(mysql_query("SELECT student_id from student_m order by id desc limit 1 "));

    $row = explode('S',$res[0]);

    $varb = $row[1]+1;

    $app_num = "S".$varb;

    //$papp_num = "P".$app_num;

    $papp_num = "12345";

    $capp_num=
"12345";

        }



 ?>



 <form name='frm' method='post' ENCTYPE="multipart/form-data" action='res.php'>



<table align='center' width='95%' class='forumline' border='2' >



<tr><td align='center' class='head'>ADMISSION FORM</td></tr>



<tr><td align='center'>



<table border='0' align='center' width='100%' class='forumline'>



<tr height="25"><td class="submenu" colspan="4" nowrap>



<div id=123A style="float: left; text-align: left;">Admission details </div>



<div id=123B style="float: right; text-align: right;">



<a href="javascript:OpenWind2('student_medical_info.php?student_id=<?=$store_stud?>')" >

<input type="hidden" name="store_stud" value="<?=$store_stud?>">



<input type="button" class="bgbutton" value="Add medical information">



</a></div>



</td></tr>



<!--<tr height="25">



			<td >&nbsp;&nbsp;Application Date</td>



		<td align="left" colspan="3"><input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;



		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td></tr>-->



		<tr height="25">



		<td width="15%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> *</td>



		<td width="35%">



		<select name="branch" id="branch" onchange='reload()'>



		<option value="0">-------- Select --------</option>



			<?php



				$sql="select course_id,coursename from course_m";



				$rs=mysql_query($sql);



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

              <td></td><td></td>



			 <!-- <td nowrap>&nbsp;&nbsp;Admission Category*</td>



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



              </select> </td>-->



	</tr>



</table></td></tr>



<tr>



  <td>



 <table border='0' align='center' width='100%' class='forumline'>



    <tr height="25"> 



      <td colspan=6 class="submenu">Student Details </td>



    </tr>



	<tr height="25">



    <td nowrap>&nbsp;&nbsp;Student Name *</td>



    <td><input type="text" name="fname" value="<?=$fname?>" size=40></td>



    <?php



	/*



      <td>&nbsp;&nbsp;Student ID</td>



		<td><input type="text" name="adm_num"  value="<?php echo $app_num ?>" size="24" onchange='updtid(this.value)'></td> */



	?>



    <td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Last Name *</td>



		<td><input type="text" name="lname" value="<?=$lname?>" size=40></td>



	<td>&nbsp;&nbsp;Student ID</td><td><input type="text" name="adm_num"  value="<?php echo $app_num ?>"  onchange='updtid(this.value)' readonly></td>



        



        </tr>



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



	<!--<td>&nbsp;&nbsp;Age</td><td><input type="text" name="age_yr" value="<?php echo $age_yr?>" size='2' readonly></td>-->

    <td>&nbsp;&nbsp;Gender*</td><td>



    <select name="gender">



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



		</select></td>



	</tr>



     <tr height="25">



            <td nowrap>&nbsp;&nbsp;Place Of Birth </td>



            <td><input type="text" name="place" value="<?php echo $place?>"></td>



			<!--<td>&nbsp;&nbsp;State</td>



			<td><input type="text" name="dist" value="<?php echo $dist?>"></td>-->



			<td nowrap>&nbsp;&nbsp;Country of Citizenship</td>



			<td><input type="text" name="state" value="<?php echo $state?>"></td>

            

            <td nowrap>&nbsp;&nbsp;Mother Tongue*</td>            



     <td ><select name="mother"> <option>-----Select------</option>



		<?php



		$qq="select id,lang from language";



		$qqq=mysql_query($qq) or die(error_description());



		for($i=0;$i<rowcount($qqq);$i++)



		{



			$myq=mysql_fetch_array($qqq);



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

            

            </tr>



     <tr height="25"> 



      <td>&nbsp;&nbsp;Nationality*</td>



      <td><select name="nat"><option>-----------Select-----------</option>



          <?php



			   $res = mysql_query("select * from nationality");



			   while($row = mysql_fetch_array($res))



			   {



				   if($rel==$row[id])



					{



						echo "<option value='$row[id]' selected>$row[nation]</option>";



					}



					else



					{



						echo "<option value='$row[id]'>$row[nation]</option>";



					}



				  



			   }



			?>



        </select> </td> 



	



      <!--<td>&nbsp;&nbsp;Blood Group</td>



      <td> <select name="b_group">



          <option value='NA'>-------Select--------</option>



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



        </select> </td>--><td colspan="2"></td>

        <td nowrap>&nbsp;&nbsp;Mother Tongue 2</td>   

        

       <td><select name="mother_tongue_2"><option>-----Select------</option>



		<?php



		$qq="select id,lang from language";



		$qqq=mysql_query($qq) or die(error_description());



		for($i=0;$i<rowcount($qqq);$i++)



		{



			$myq=mysql_fetch_array($qqq);



			if($mod2[mother_tongue_2]==$myq[id])



			{



				?>



                <option value="<?=$myq[id]?>" selected ><?php echo $myq[lang] ?></option>



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



	<tr height='25'>

    <td>&nbsp;&nbsp;Dual Nationality</td>



      <td><select name="nationality2"><option>-----------Select-----------</option>



          <?php



			   $res = mysql_query("select * from nationality");



			   while($row = mysql_fetch_array($res))



			   {



				   if($rel==$row[id])



					{



						echo "<option value='$row[id]' selected>$row[nation]</option>";



					}



					else



					{



						echo "<option value='$row[id]'>$row[nation]</option>";



					}



				  



			   }



			?>



        </select> </td> 



<td nowrap>&nbsp;&nbsp;Upload Student Photo</td>



           <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>



          <td nowrap>&nbsp;&nbsp;E-Mail ID</td>



	 <td colspan="3"><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='22'></td> 

</tr>

 <tr>



	  <td width="110">&nbsp;&nbsp;Passport No. </td>

      <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td>

       <td nowrap>&nbsp;&nbsp;Country Of Issue</td>

      <td width="100"><input type="text" name="country_of_issue" id="passport_no" size="15" maxlength="50" value="<?=$country_of_issue?>" />  </td>

	</tr>

    <tr>



	  <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>

       <td align="left"><input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;



		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

       <td  nowrap>&nbsp;&nbsp;Boarding required?</td>

     <td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes

         &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td></tr>

         <tr>

         <td nowrap>&nbsp;&nbsp;Admission Granted?</td>

     <td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes

         &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>

          <td  nowrap>&nbsp;&nbsp;Transport required?</td>

     <td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes

         &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>

	</tr>

    <tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>

     <td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes

         &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>



  </table></td></tr>



  <tr><td>



 <!-- <table border='0' align='center' width='100%' class='forumline' >

                <tr height="25">

                <td colspan="6" class="submenu">Regular contact details </u>

                </td>

                </tr>

                <tr>

                <td>&nbsp;&nbsp;MSG Phone number</td>

                <td><input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" > </td>

                <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

                <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>

                <td>Mail-Id</td>

                <td><input type="text" name="rgmailid" value="<?php echo $rgmailid; ?>" size="45" ></td>

                </tr>

                <tr>

                </table>-->

                <table border='0' align='center' width='100%' class='forumline'>

                    <tr height="25">

                        <td colspan=8  class="submenu">Parent/Guardian Details</td>

                    </tr>

                    <tr>

                        <td colspan=1>&nbsp;&nbsp;Description</td>

                        <td  align='center' colspan=1>Father Details</td>

                        <td align='center' colspan=1>Mother Details</td>

                        <td align='center' colspan=1>Guardian Details </td>

                        <td align='center' width="10%"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$store_stud?>', 'OpenWind2',700,600)">
                        <input type="button" class="bgbutton" value="Add Other Member">
                        </a></div></td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Name</td>

                        <td align='center'>
                        <input type="text" name="f_name" value="<?php echo $f_name?>" >
                        </td>

                        <td align='center'>
                        <input type="text" name="mname" value="<?php ="javascript" src="../js/cal_conf2.js"></script>

                            <script language="javascript" type="text/javascript">
                            function validateForm(tempn) {

                            var x = document.forms["frm"][tempn].value;

                            var atpos = x.indexOf("@");

                            var dotpos = x.lastIndexOf(".");

                            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {

                            alert("Not a valid e-mail address");

                            return false;

                            }

                            }

                            function reload() {

                            document.frm.action = 'SearchStudent.php';

                            document.frm.submit();

                            }

                            function OpenWind2(k2) {

                            var finalVar;

                            finalVar = k2;

                            window.open(finalVar, 'Stud', 'width=1100,height=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

                            }

                            function getAddr() {

                            document.frm.per_addr.value = document.frm.cor_addr.value;

                            document.frm.per_city.value = document.frm.cor_city.value;

                            document.frm.per_state.value = document.frm.cor_state.value;

                            document.frm.per_country.value = document.frm.cor_country.value;

                            document.frm.per_pin.value = document.frm.cor_pin.value;

                            document.frm.per_phone.value = document.frm.cor_phone.value;

                            }

                            function updtid(a) {

                            var b = a + "P";

                            document.frm.username.value = a;

                            document.frm.password.value = a;

                            document.frm.parent_username.value = b;

                            document.frm.parent_password.value = b;

                            }

                            </script>

                            <script language="javascript">
                            function OpenWindC(URL, title, w, h) {

                            var left = (screen.width / 2) - (w / 2);

                            var top = (screen.height / 2) - (h / 2);

                            var newWin = window.open(URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

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

                            $b_day=$_POST['b_day' ];

                            }

                            if($branch!=0 && $sem!=0 && $a_year!=0)

                            {

                            $res = mysql_fetch_row(mysql_query("SELECT student_id from student_m order by id desc limit 1 "));

                            $row = explode('S',$res[0]);

                            $varb = $row[1]+1;

                            $app_num = "S".$varb;

                            //$papp_num = "P".$app_num;

                            $papp_num = "12345";

                            $capp_num=
                            "12345";

                            }

                            ?>

                            <form name='frm' method='post' ENCTYPE="multipart/form-data" action='res.php'>

                            <table align='center' width='95%' class='forumline' border='2' >

                            <tr><td align='center' class='head'>ADMISSION FORM</td></tr>

                            <tr><td align='center'>

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25"><td class="submenu" colspan="4" nowrap>

                            <div id=123A style="float: left; text-align: left;">Admission details </div>

                            <div id=123B style="float: right; text-align: right;">

                            <a href="javascript:OpenWind2('student_medical_info.php?student_id=<?=$store_stud?>')" >

                            <input type="hidden" name="store_stud" value="<?=$store_stud?>">

                            <input type="button" class="bgbutton" value="Add medical information">

                            </a></div>

                            </td></tr>

                            <!--<tr height="25">

                            <td >&nbsp;&nbsp;Application Date</td>

                            <td align="left" colspan="3"><input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td></tr>-->

                            <tr height="25">

                            <td width="15%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> *</td>

                            <td width="35%">

                            <select name="branch" id="branch" onchange='reload()'>

                            <option value="0">-------- Select --------</option>

                            <?php

                            $sql="select course_id,coursename from course_m";

                            $rs=mysql_query($sql);

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

                            <td></td><td></td>

                            <!-- <td nowrap>&nbsp;&nbsp;Admission Category*</td>

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

                            </select> </td>-->

                            </tr>

                            </table></td></tr>

                            <tr>

                            <td>

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=6 class="submenu">Student Details </td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Student Name *</td>

                            <td><input type="text" name="fname" value="<?=$fname?>" size=40></td>

                            <?php

                            /*

                            <td>&nbsp;&nbsp;Student ID</td>

                            <td><input type="text" name="adm_num"  value="<?php echo $app_num ?>" size="24" onchange='updtid(this.value)'></td> */

                            ?>

                            <td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Last Name *</td>

                            <td><input type="text" name="lname" value="<?=$lname?>" size=40></td>

                            <td>&nbsp;&nbsp;Student ID</td><td><input type="text" name="adm_num"  value="<?php echo $app_num ?>"  onchange='updtid(this.value)' readonly></td>

                            </tr>

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

                            <!--<td>&nbsp;&nbsp;Age</td><td><input type="text" name="age_yr" value="<?php echo $age_yr?>" size='2' readonly></td>-->

                            <td>&nbsp;&nbsp;Gender*</td><td>

                            <select name="gender">

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

                            </select></td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Place Of Birth </td>

                            <td><input type="text" name="place" value="<?php echo $place?>"></td>

                            <!--<td>&nbsp;&nbsp;State</td>

                            <td><input type="text" name="dist" value="<?php echo $dist?>"></td>-->

                            <td nowrap>&nbsp;&nbsp;Country of Citizenship</td>

                            <td><input type="text" name="state" value="<?php echo $state?>"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue*</td>

                            <td ><select name="mother"> <option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

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

                            </tr>

                            <tr height="25">

                            <td>&nbsp;&nbsp;Nationality*</td>

                            <td><select name="nat"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <!--<td>&nbsp;&nbsp;Blood Group</td>

                            <td> <select name="b_group">

                            <option value='NA'>-------Select--------</option>

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

                            </select> </td>--><td colspan="2"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue 2</td>

                            <td><select name="mother_tongue_2"><option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

                            if($mod2[mother_tongue_2]==$myq[id])

                            {

                            ?>

                            <option value="<?=$myq[id]?>" selected ><?php echo $myq[lang] ?></option>

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

                            <tr height='25'>

                            <td>&nbsp;&nbsp;Dual Nationality</td>

                            <td><select name="nationality2"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <td nowrap>&nbsp;&nbsp;Upload Student Photo</td>

                            <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>

                            <td nowrap>&nbsp;&nbsp;E-Mail ID</td>

                            <td colspan="3"><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='22'></td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Passport No. </td>

                            <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td>

                            <td nowrap>&nbsp;&nbsp;Country Of Issue</td>

                            <td width="100"><input type="text" name="country_of_issue" id="passport_no" size="15" maxlength="50" value="<?=$country_of_issue?>" />  </td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>

                            <td align="left"><input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

                            <td  nowrap>&nbsp;&nbsp;Boarding required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td></tr>

                            <tr>

                            <td nowrap>&nbsp;&nbsp;Admission Granted?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>

                            <td  nowrap>&nbsp;&nbsp;Transport required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>

                            </tr>

                            <tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>

                            </table></td></tr>

                            <tr><td>

                            <!-- <table border='0' align='center' width='100%' class='forumline' >

                            <tr height="25">

                            <td colspan="6" class="submenu">Regular contact details </u>

                            </td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;MSG Phone number</td>

                            <td><input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" > </td>

                            <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

                            <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>

                            <td>Mail-Id</td>

                            <td><input type="text" name="rgmailid" value="<?php echo $rgmailid; ?>" size="45" ></td>

                            </tr>

                            <tr>

                            </table>-->

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=8  class="submenu">Parent/Guardian Details</td>

                            </tr>

                            <tr>

                            <td colspan=1>&nbsp;&nbsp;Description</td>

                            <td  align='center' colspan=1>Father Details</td>

                            <td align='center' colspan=1>Mother Details</td>

                            <td align='center' colspan=1>Guardian Details </td>

                            <td align='center' width="10%"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$store_stud?>', 'OpenWind2',700,600)">
                            <input type="button" class="bgbutton" value="Add Other Member">
                            </a></div></td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Name</td>

                            <td align='center'>
                            <input type="text" name="f_name" value="<?php echo $f_name?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="mname" value="<?php echo $mname
 ?>" >
                        </td>

                        <td align='center'>
                        <input type="text" name="gname" value="<?php echo $gname?>" >
                        </td>

                        <td nowrap>&nbsp;</td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Parent ID</td>

                        <td align='center'>
                        <input type="text" name="f_id" value="<?php var b = a + "P";

                            document.frm.username.value = a;

                            document.frm.password.value = a;

                            document.frm.parent_username.value = b;

                            document.frm.parent_password.value = b;

                            }

                            </script>

                            <script language="javascript">
                            function OpenWindC(URL, title, w, h) {

                            var left = (screen.width / 2) - (w / 2);

                            var top = (screen.height / 2) - (h / 2);

                            var newWin = window.open(URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

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

                            $b_day=$_POST['b_day' ];

                            }

                            if($branch!=0 && $sem!=0 && $a_year!=0)

                            {

                            $res = mysql_fetch_row(mysql_query("SELECT student_id from student_m order by id desc limit 1 "));

                            $row = explode('S',$res[0]);

                            $varb = $row[1]+1;

                            $app_num = "S".$varb;

                            //$papp_num = "P".$app_num;

                            $papp_num = "12345";

                            $capp_num=
                            "12345";

                            }

                            ?>

                            <form name='frm' method='post' ENCTYPE="multipart/form-data" action='res.php'>

                            <table align='center' width='95%' class='forumline' border='2' >

                            <tr><td align='center' class='head'>ADMISSION FORM</td></tr>

                            <tr><td align='center'>

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25"><td class="submenu" colspan="4" nowrap>

                            <div id=123A style="float: left; text-align: left;">Admission details </div>

                            <div id=123B style="float: right; text-align: right;">

                            <a href="javascript:OpenWind2('student_medical_info.php?student_id=<?=$store_stud?>')" >

                            <input type="hidden" name="store_stud" value="<?=$store_stud?>">

                            <input type="button" class="bgbutton" value="Add medical information">

                            </a></div>

                            </td></tr>

                            <!--<tr height="25">

                            <td >&nbsp;&nbsp;Application Date</td>

                            <td align="left" colspan="3"><input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td></tr>-->

                            <tr height="25">

                            <td width="15%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> *</td>

                            <td width="35%">

                            <select name="branch" id="branch" onchange='reload()'>

                            <option value="0">-------- Select --------</option>

                            <?php

                            $sql="select course_id,coursename from course_m";

                            $rs=mysql_query($sql);

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

                            <td></td><td></td>

                            <!-- <td nowrap>&nbsp;&nbsp;Admission Category*</td>

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

                            </select> </td>-->

                            </tr>

                            </table></td></tr>

                            <tr>

                            <td>

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=6 class="submenu">Student Details </td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Student Name *</td>

                            <td><input type="text" name="fname" value="<?=$fname?>" size=40></td>

                            <?php

                            /*

                            <td>&nbsp;&nbsp;Student ID</td>

                            <td><input type="text" name="adm_num"  value="<?php echo $app_num ?>" size="24" onchange='updtid(this.value)'></td> */

                            ?>

                            <td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Last Name *</td>

                            <td><input type="text" name="lname" value="<?=$lname?>" size=40></td>

                            <td>&nbsp;&nbsp;Student ID</td><td><input type="text" name="adm_num"  value="<?php echo $app_num ?>"  onchange='updtid(this.value)' readonly></td>

                            </tr>

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

                            <!--<td>&nbsp;&nbsp;Age</td><td><input type="text" name="age_yr" value="<?php echo $age_yr?>" size='2' readonly></td>-->

                            <td>&nbsp;&nbsp;Gender*</td><td>

                            <select name="gender">

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

                            </select></td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Place Of Birth </td>

                            <td><input type="text" name="place" value="<?php echo $place?>"></td>

                            <!--<td>&nbsp;&nbsp;State</td>

                            <td><input type="text" name="dist" value="<?php echo $dist?>"></td>-->

                            <td nowrap>&nbsp;&nbsp;Country of Citizenship</td>

                            <td><input type="text" name="state" value="<?php echo $state?>"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue*</td>

                            <td ><select name="mother"> <option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

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

                            </tr>

                            <tr height="25">

                            <td>&nbsp;&nbsp;Nationality*</td>

                            <td><select name="nat"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <!--<td>&nbsp;&nbsp;Blood Group</td>

                            <td> <select name="b_group">

                            <option value='NA'>-------Select--------</option>

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

                            </select> </td>--><td colspan="2"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue 2</td>

                            <td><select name="mother_tongue_2"><option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

                            if($mod2[mother_tongue_2]==$myq[id])

                            {

                            ?>

                            <option value="<?=$myq[id]?>" selected ><?php echo $myq[lang] ?></option>

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

                            <tr height='25'>

                            <td>&nbsp;&nbsp;Dual Nationality</td>

                            <td><select name="nationality2"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <td nowrap>&nbsp;&nbsp;Upload Student Photo</td>

                            <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>

                            <td nowrap>&nbsp;&nbsp;E-Mail ID</td>

                            <td colspan="3"><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='22'></td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Passport No. </td>

                            <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td>

                            <td nowrap>&nbsp;&nbsp;Country Of Issue</td>

                            <td width="100"><input type="text" name="country_of_issue" id="passport_no" size="15" maxlength="50" value="<?=$country_of_issue?>" />  </td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>

                            <td align="left"><input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

                            <td  nowrap>&nbsp;&nbsp;Boarding required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td></tr>

                            <tr>

                            <td nowrap>&nbsp;&nbsp;Admission Granted?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>

                            <td  nowrap>&nbsp;&nbsp;Transport required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>

                            </tr>

                            <tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>

                            </table></td></tr>

                            <tr><td>

                            <!-- <table border='0' align='center' width='100%' class='forumline' >

                            <tr height="25">

                            <td colspan="6" class="submenu">Regular contact details </u>

                            </td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;MSG Phone number</td>

                            <td><input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" > </td>

                            <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

                            <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>

                            <td>Mail-Id</td>

                            <td><input type="text" name="rgmailid" value="<?php echo $rgmailid; ?>" size="45" ></td>

                            </tr>

                            <tr>

                            </table>-->

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=8  class="submenu">Parent/Guardian Details</td>

                            </tr>

                            <tr>

                            <td colspan=1>&nbsp;&nbsp;Description</td>

                            <td  align='center' colspan=1>Father Details</td>

                            <td align='center' colspan=1>Mother Details</td>

                            <td align='center' colspan=1>Guardian Details </td>

                            <td align='center' width="10%"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$store_stud?>', 'OpenWind2',700,600)">
                            <input type="button" class="bgbutton" value="Add Other Member">
                            </a></div></td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Name</td>

                            <td align='center'>
                            <input type="text" name="f_name" value="<?php echo $f_name?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="mname" value="<?php echo $mname ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="gname" value="<?php echo $gname?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Parent ID</td>

                            <td align='center'>
                            <input type="text" name="f_id" value="<?php echo $f_id
                        ?>" >
                        </td>

                        <td align='center'>
                        <input type="text" name="m_id" value="<?php $store_stud = $_POST['store_stud'];

                            }
                            ?>

                            <!DOCTYPE HTML>

                            <HTML>

                            <HEAD>

                            <TITLE> ADD STUDENT DETAILS </TITLE>

                            <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>

                            <script language="javascript" src="../js/cal2.js"></script>

                            <script language="javascript" src="../js/cal_conf2.js"></script>

                            <script language="javascript" type="text/javascript">
                            function validateForm(tempn) {

                            var x = document.forms["frm"][tempn].value;

                            var atpos = x.indexOf("@");

                            var dotpos = x.lastIndexOf(".");

                            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {

                            alert("Not a valid e-mail address");

                            return false;

                            }

                            }

                            function reload() {

                            document.frm.action = 'SearchStudent.php';

                            document.frm.submit();

                            }

                            function OpenWind2(k2) {

                            var finalVar;

                            finalVar = k2;

                            window.open(finalVar, 'Stud', 'width=1100,height=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

                            }

                            function getAddr() {

                            document.frm.per_addr.value = document.frm.cor_addr.value;

                            document.frm.per_city.value = document.frm.cor_city.value;

                            document.frm.per_state.value = document.frm.cor_state.value;

                            document.frm.per_country.value = document.frm.cor_country.value;

                            document.frm.per_pin.value = document.frm.cor_pin.value;

                            document.frm.per_phone.value = document.frm.cor_phone.value;

                            }

                            function updtid(a) {

                            var b = a + "P";

                            document.frm.username.value = a;

                            document.frm.password.value = a;

                            document.frm.parent_username.value = b;

                            document.frm.parent_password.value = b;

                            }

                            </script>

                            <script language="javascript">
                            function OpenWindC(URL, title, w, h) {

                            var left = (screen.width / 2) - (w / 2);

                            var top = (screen.height / 2) - (h / 2);

                            var newWin = window.open(URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

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

                            $b_day=$_POST['b_day' ];

                            }

                            if($branch!=0 && $sem!=0 && $a_year!=0)

                            {

                            $res = mysql_fetch_row(mysql_query("SELECT student_id from student_m order by id desc limit 1 "));

                            $row = explode('S',$res[0]);

                            $varb = $row[1]+1;

                            $app_num = "S".$varb;

                            //$papp_num = "P".$app_num;

                            $papp_num = "12345";

                            $capp_num=
                            "12345";

                            }

                            ?>

                            <form name='frm' method='post' ENCTYPE="multipart/form-data" action='res.php'>

                            <table align='center' width='95%' class='forumline' border='2' >

                            <tr><td align='center' class='head'>ADMISSION FORM</td></tr>

                            <tr><td align='center'>

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25"><td class="submenu" colspan="4" nowrap>

                            <div id=123A style="float: left; text-align: left;">Admission details </div>

                            <div id=123B style="float: right; text-align: right;">

                            <a href="javascript:OpenWind2('student_medical_info.php?student_id=<?=$store_stud?>')" >

                            <input type="hidden" name="store_stud" value="<?=$store_stud?>">

                            <input type="button" class="bgbutton" value="Add medical information">

                            </a></div>

                            </td></tr>

                            <!--<tr height="25">

                            <td >&nbsp;&nbsp;Application Date</td>

                            <td align="left" colspan="3"><input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td></tr>-->

                            <tr height="25">

                            <td width="15%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> *</td>

                            <td width="35%">

                            <select name="branch" id="branch" onchange='reload()'>

                            <option value="0">-------- Select --------</option>

                            <?php

                            $sql="select course_id,coursename from course_m";

                            $rs=mysql_query($sql);

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

                            <td></td><td></td>

                            <!-- <td nowrap>&nbsp;&nbsp;Admission Category*</td>

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

                            </select> </td>-->

                            </tr>

                            </table></td></tr>

                            <tr>

                            <td>

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=6 class="submenu">Student Details </td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Student Name *</td>

                            <td><input type="text" name="fname" value="<?=$fname?>" size=40></td>

                            <?php

                            /*

                            <td>&nbsp;&nbsp;Student ID</td>

                            <td><input type="text" name="adm_num"  value="<?php echo $app_num ?>" size="24" onchange='updtid(this.value)'></td> */

                            ?>

                            <td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Last Name *</td>

                            <td><input type="text" name="lname" value="<?=$lname?>" size=40></td>

                            <td>&nbsp;&nbsp;Student ID</td><td><input type="text" name="adm_num"  value="<?php echo $app_num ?>"  onchange='updtid(this.value)' readonly></td>

                            </tr>

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

                            <!--<td>&nbsp;&nbsp;Age</td><td><input type="text" name="age_yr" value="<?php echo $age_yr?>" size='2' readonly></td>-->

                            <td>&nbsp;&nbsp;Gender*</td><td>

                            <select name="gender">

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

                            </select></td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Place Of Birth </td>

                            <td><input type="text" name="place" value="<?php echo $place?>"></td>

                            <!--<td>&nbsp;&nbsp;State</td>

                            <td><input type="text" name="dist" value="<?php echo $dist?>"></td>-->

                            <td nowrap>&nbsp;&nbsp;Country of Citizenship</td>

                            <td><input type="text" name="state" value="<?php echo $state?>"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue*</td>

                            <td ><select name="mother"> <option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

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

                            </tr>

                            <tr height="25">

                            <td>&nbsp;&nbsp;Nationality*</td>

                            <td><select name="nat"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <!--<td>&nbsp;&nbsp;Blood Group</td>

                            <td> <select name="b_group">

                            <option value='NA'>-------Select--------</option>

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

                            </select> </td>--><td colspan="2"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue 2</td>

                            <td><select name="mother_tongue_2"><option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

                            if($mod2[mother_tongue_2]==$myq[id])

                            {

                            ?>

                            <option value="<?=$myq[id]?>" selected ><?php echo $myq[lang] ?></option>

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

                            <tr height='25'>

                            <td>&nbsp;&nbsp;Dual Nationality</td>

                            <td><select name="nationality2"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <td nowrap>&nbsp;&nbsp;Upload Student Photo</td>

                            <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>

                            <td nowrap>&nbsp;&nbsp;E-Mail ID</td>

                            <td colspan="3"><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='22'></td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Passport No. </td>

                            <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td>

                            <td nowrap>&nbsp;&nbsp;Country Of Issue</td>

                            <td width="100"><input type="text" name="country_of_issue" id="passport_no" size="15" maxlength="50" value="<?=$country_of_issue?>" />  </td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>

                            <td align="left"><input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

                            <td  nowrap>&nbsp;&nbsp;Boarding required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td></tr>

                            <tr>

                            <td nowrap>&nbsp;&nbsp;Admission Granted?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>

                            <td  nowrap>&nbsp;&nbsp;Transport required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>

                            </tr>

                            <tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>

                            </table></td></tr>

                            <tr><td>

                            <!-- <table border='0' align='center' width='100%' class='forumline' >

                            <tr height="25">

                            <td colspan="6" class="submenu">Regular contact details </u>

                            </td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;MSG Phone number</td>

                            <td><input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" > </td>

                            <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

                            <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>

                            <td>Mail-Id</td>

                            <td><input type="text" name="rgmailid" value="<?php echo $rgmailid; ?>" size="45" ></td>

                            </tr>

                            <tr>

                            </table>-->

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=8  class="submenu">Parent/Guardian Details</td>

                            </tr>

                            <tr>

                            <td colspan=1>&nbsp;&nbsp;Description</td>

                            <td  align='center' colspan=1>Father Details</td>

                            <td align='center' colspan=1>Mother Details</td>

                            <td align='center' colspan=1>Guardian Details </td>

                            <td align='center' width="10%"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$store_stud?>', 'OpenWind2',700,600)">
                            <input type="button" class="bgbutton" value="Add Other Member">
                            </a></div></td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Name</td>

                            <td align='center'>
                            <input type="text" name="f_name" value="<?php echo $f_name?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="mname" value="<?php echo $mname ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="gname" value="<?php echo $gname?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Parent ID</td>

                            <td align='center'>
                            <input type="text" name="f_id" value="<?php echo $f_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="m_id" value="<?php echo $m_id
                        ?>" >
                        </td>

                        <td align='center'>
                        <input type="text" name="g_id" value="<?php one . value;

                            }

                            function updtid(a) {

                            var b = a + "P";

                            document.frm.username.value = a;

                            document.frm.password.value = a;

                            document.frm.parent_username.value = b;

                            document.frm.parent_password.value = b;

                            }

                            </script>

                            <script language="javascript">
                            function OpenWindC(URL, title, w, h) {

                            var left = (screen.width / 2) - (w / 2);

                            var top = (screen.height / 2) - (h / 2);

                            var newWin = window.open(URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

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

                            $b_day=$_POST['b_day' ];

                            }

                            if($branch!=0 && $sem!=0 && $a_year!=0)

                            {

                            $res = mysql_fetch_row(mysql_query("SELECT student_id from student_m order by id desc limit 1 "));

                            $row = explode('S',$res[0]);

                            $varb = $row[1]+1;

                            $app_num = "S".$varb;

                            //$papp_num = "P".$app_num;

                            $papp_num = "12345";

                            $capp_num=
                            "12345";

                            }

                            ?>

                            <form name='frm' method='post' ENCTYPE="multipart/form-data" action='res.php'>

                            <table align='center' width='95%' class='forumline' border='2' >

                            <tr><td align='center' class='head'>ADMISSION FORM</td></tr>

                            <tr><td align='center'>

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25"><td class="submenu" colspan="4" nowrap>

                            <div id=123A style="float: left; text-align: left;">Admission details </div>

                            <div id=123B style="float: right; text-align: right;">

                            <a href="javascript:OpenWind2('student_medical_info.php?student_id=<?=$store_stud?>')" >

                            <input type="hidden" name="store_stud" value="<?=$store_stud?>">

                            <input type="button" class="bgbutton" value="Add medical information">

                            </a></div>

                            </td></tr>

                            <!--<tr height="25">

                            <td >&nbsp;&nbsp;Application Date</td>

                            <td align="left" colspan="3"><input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td></tr>-->

                            <tr height="25">

                            <td width="15%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> *</td>

                            <td width="35%">

                            <select name="branch" id="branch" onchange='reload()'>

                            <option value="0">-------- Select --------</option>

                            <?php

                            $sql="select course_id,coursename from course_m";

                            $rs=mysql_query($sql);

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

                            <td></td><td></td>

                            <!-- <td nowrap>&nbsp;&nbsp;Admission Category*</td>

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

                            </select> </td>-->

                            </tr>

                            </table></td></tr>

                            <tr>

                            <td>

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=6 class="submenu">Student Details </td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Student Name *</td>

                            <td><input type="text" name="fname" value="<?=$fname?>" size=40></td>

                            <?php

                            /*

                            <td>&nbsp;&nbsp;Student ID</td>

                            <td><input type="text" name="adm_num"  value="<?php echo $app_num ?>" size="24" onchange='updtid(this.value)'></td> */

                            ?>

                            <td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Last Name *</td>

                            <td><input type="text" name="lname" value="<?=$lname?>" size=40></td>

                            <td>&nbsp;&nbsp;Student ID</td><td><input type="text" name="adm_num"  value="<?php echo $app_num ?>"  onchange='updtid(this.value)' readonly></td>

                            </tr>

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

                            <!--<td>&nbsp;&nbsp;Age</td><td><input type="text" name="age_yr" value="<?php echo $age_yr?>" size='2' readonly></td>-->

                            <td>&nbsp;&nbsp;Gender*</td><td>

                            <select name="gender">

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

                            </select></td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Place Of Birth </td>

                            <td><input type="text" name="place" value="<?php echo $place?>"></td>

                            <!--<td>&nbsp;&nbsp;State</td>

                            <td><input type="text" name="dist" value="<?php echo $dist?>"></td>-->

                            <td nowrap>&nbsp;&nbsp;Country of Citizenship</td>

                            <td><input type="text" name="state" value="<?php echo $state?>"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue*</td>

                            <td ><select name="mother"> <option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

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

                            </tr>

                            <tr height="25">

                            <td>&nbsp;&nbsp;Nationality*</td>

                            <td><select name="nat"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <!--<td>&nbsp;&nbsp;Blood Group</td>

                            <td> <select name="b_group">

                            <option value='NA'>-------Select--------</option>

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

                            </select> </td>--><td colspan="2"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue 2</td>

                            <td><select name="mother_tongue_2"><option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

                            if($mod2[mother_tongue_2]==$myq[id])

                            {

                            ?>

                            <option value="<?=$myq[id]?>" selected ><?php echo $myq[lang] ?></option>

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

                            <tr height='25'>

                            <td>&nbsp;&nbsp;Dual Nationality</td>

                            <td><select name="nationality2"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <td nowrap>&nbsp;&nbsp;Upload Student Photo</td>

                            <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>

                            <td nowrap>&nbsp;&nbsp;E-Mail ID</td>

                            <td colspan="3"><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='22'></td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Passport No. </td>

                            <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td>

                            <td nowrap>&nbsp;&nbsp;Country Of Issue</td>

                            <td width="100"><input type="text" name="country_of_issue" id="passport_no" size="15" maxlength="50" value="<?=$country_of_issue?>" />  </td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>

                            <td align="left"><input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

                            <td  nowrap>&nbsp;&nbsp;Boarding required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td></tr>

                            <tr>

                            <td nowrap>&nbsp;&nbsp;Admission Granted?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>

                            <td  nowrap>&nbsp;&nbsp;Transport required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>

                            </tr>

                            <tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>

                            </table></td></tr>

                            <tr><td>

                            <!-- <table border='0' align='center' width='100%' class='forumline' >

                            <tr height="25">

                            <td colspan="6" class="submenu">Regular contact details </u>

                            </td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;MSG Phone number</td>

                            <td><input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" > </td>

                            <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

                            <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>

                            <td>Mail-Id</td>

                            <td><input type="text" name="rgmailid" value="<?php echo $rgmailid; ?>" size="45" ></td>

                            </tr>

                            <tr>

                            </table>-->

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=8  class="submenu">Parent/Guardian Details</td>

                            </tr>

                            <tr>

                            <td colspan=1>&nbsp;&nbsp;Description</td>

                            <td  align='center' colspan=1>Father Details</td>

                            <td align='center' colspan=1>Mother Details</td>

                            <td align='center' colspan=1>Guardian Details </td>

                            <td align='center' width="10%"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$store_stud?>', 'OpenWind2',700,600)">
                            <input type="button" class="bgbutton" value="Add Other Member">
                            </a></div></td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Name</td>

                            <td align='center'>
                            <input type="text" name="f_name" value="<?php echo $f_name?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="mname" value="<?php echo $mname ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="gname" value="<?php echo $gname?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Parent ID</td>

                            <td align='center'>
                            <input type="text" name="f_id" value="<?php echo $f_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="m_id" value="<?php echo $m_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="g_id" value="<?php echo $g_id
                        ?>" >
                        </td>

                        <td nowrap>&nbsp;</td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Passport Number</td>

                        <td align='center'>
                        <input type="text" name="foccup" value="<?php echo $foccup?>">
                        </td><td align='center'>
                        <input type="text" name="moccup" value="<?php echo $moccup ?>" >
                        </td>

                        <td align='center'>
                        <input type="text" name="goccup" value="<?php echo $goccup?>" >
                        </td><td nowrap>&nbsp;</td>

                    </tr>

                    <tr>

                        <td >&nbsp;&nbsp;Country Of Issue</td>

                        <td align='center'>
                        <input type="text" name="fqul" value="<?php echo $fqul ?>">
                        </td>

                        <td align='center'>
                        <input type="text" name="mqul" value="<?php <tr><td align='center'>

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25"><td class="submenu" colspan="4" nowrap>

                            <div id=123A style="float: left; text-align: left;">Admission details </div>

                            <div id=123B style="float: right; text-align: right;">

                            <a href="javascript:OpenWind2('student_medical_info.php?student_id=<?=$store_stud?>')" >

                            <input type="hidden" name="store_stud" value="<?=$store_stud?>">

                            <input type="button" class="bgbutton" value="Add medical information">

                            </a></div>

                            </td></tr>

                            <!--<tr height="25">

                            <td >&nbsp;&nbsp;Application Date</td>

                            <td align="left" colspan="3"><input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td></tr>-->

                            <tr height="25">

                            <td width="15%">&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> *</td>

                            <td width="35%">

                            <select name="branch" id="branch" onchange='reload()'>

                            <option value="0">-------- Select --------</option>

                            <?php

                            $sql="select course_id,coursename from course_m";

                            $rs=mysql_query($sql);

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

                            <td></td><td></td>

                            <!-- <td nowrap>&nbsp;&nbsp;Admission Category*</td>

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

                            </select> </td>-->

                            </tr>

                            </table></td></tr>

                            <tr>

                            <td>

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=6 class="submenu">Student Details </td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Student Name *</td>

                            <td><input type="text" name="fname" value="<?=$fname?>" size=40></td>

                            <?php

                            /*

                            <td>&nbsp;&nbsp;Student ID</td>

                            <td><input type="text" name="adm_num"  value="<?php echo $app_num ?>" size="24" onchange='updtid(this.value)'></td> */

                            ?>

                            <td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Last Name *</td>

                            <td><input type="text" name="lname" value="<?=$lname?>" size=40></td>

                            <td>&nbsp;&nbsp;Student ID</td><td><input type="text" name="adm_num"  value="<?php echo $app_num ?>"  onchange='updtid(this.value)' readonly></td>

                            </tr>

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

                            <!--<td>&nbsp;&nbsp;Age</td><td><input type="text" name="age_yr" value="<?php echo $age_yr?>" size='2' readonly></td>-->

                            <td>&nbsp;&nbsp;Gender*</td><td>

                            <select name="gender">

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

                            </select></td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Place Of Birth </td>

                            <td><input type="text" name="place" value="<?php echo $place?>"></td>

                            <!--<td>&nbsp;&nbsp;State</td>

                            <td><input type="text" name="dist" value="<?php echo $dist?>"></td>-->

                            <td nowrap>&nbsp;&nbsp;Country of Citizenship</td>

                            <td><input type="text" name="state" value="<?php echo $state?>"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue*</td>

                            <td ><select name="mother"> <option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

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

                            </tr>

                            <tr height="25">

                            <td>&nbsp;&nbsp;Nationality*</td>

                            <td><select name="nat"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <!--<td>&nbsp;&nbsp;Blood Group</td>

                            <td> <select name="b_group">

                            <option value='NA'>-------Select--------</option>

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

                            </select> </td>--><td colspan="2"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue 2</td>

                            <td><select name="mother_tongue_2"><option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

                            if($mod2[mother_tongue_2]==$myq[id])

                            {

                            ?>

                            <option value="<?=$myq[id]?>" selected ><?php echo $myq[lang] ?></option>

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

                            <tr height='25'>

                            <td>&nbsp;&nbsp;Dual Nationality</td>

                            <td><select name="nationality2"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <td nowrap>&nbsp;&nbsp;Upload Student Photo</td>

                            <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>

                            <td nowrap>&nbsp;&nbsp;E-Mail ID</td>

                            <td colspan="3"><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='22'></td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Passport No. </td>

                            <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td>

                            <td nowrap>&nbsp;&nbsp;Country Of Issue</td>

                            <td width="100"><input type="text" name="country_of_issue" id="passport_no" size="15" maxlength="50" value="<?=$country_of_issue?>" />  </td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>

                            <td align="left"><input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

                            <td  nowrap>&nbsp;&nbsp;Boarding required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td></tr>

                            <tr>

                            <td nowrap>&nbsp;&nbsp;Admission Granted?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>

                            <td  nowrap>&nbsp;&nbsp;Transport required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>

                            </tr>

                            <tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>

                            </table></td></tr>

                            <tr><td>

                            <!-- <table border='0' align='center' width='100%' class='forumline' >

                            <tr height="25">

                            <td colspan="6" class="submenu">Regular contact details </u>

                            </td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;MSG Phone number</td>

                            <td><input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" > </td>

                            <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

                            <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>

                            <td>Mail-Id</td>

                            <td><input type="text" name="rgmailid" value="<?php echo $rgmailid; ?>" size="45" ></td>

                            </tr>

                            <tr>

                            </table>-->

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=8  class="submenu">Parent/Guardian Details</td>

                            </tr>

                            <tr>

                            <td colspan=1>&nbsp;&nbsp;Description</td>

                            <td  align='center' colspan=1>Father Details</td>

                            <td align='center' colspan=1>Mother Details</td>

                            <td align='center' colspan=1>Guardian Details </td>

                            <td align='center' width="10%"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$store_stud?>', 'OpenWind2',700,600)">
                            <input type="button" class="bgbutton" value="Add Other Member">
                            </a></div></td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Name</td>

                            <td align='center'>
                            <input type="text" name="f_name" value="<?php echo $f_name?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="mname" value="<?php echo $mname ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="gname" value="<?php echo $gname?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Parent ID</td>

                            <td align='center'>
                            <input type="text" name="f_id" value="<?php echo $f_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="m_id" value="<?php echo $m_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="g_id" value="<?php echo $g_id?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Passport Number</td>

                            <td align='center'>
                            <input type="text" name="foccup" value="<?php echo $foccup?>">
                            </td><td align='center'>
                            <input type="text" name="moccup" value="<?php echo $moccup ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="goccup" value="<?php echo $goccup?>" >
                            </td><td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td >&nbsp;&nbsp;Country Of Issue</td>

                            <td align='center'>
                            <input type="text" name="fqul" value="<?php echo $fqul ?>">
                            </td>

                            <td align='center'>
                            <input type="text" name="mqul" value="<?php echo $mqul
 ?>">
                        </td>

                        <td align='center'>
                        <input type="text" name="gqul" value="<?php <td><input type="text" name="adm_num"  value="<?php echo $app_num ?>" size="24" onchange='updtid(this.value)'></td> */

                            ?>

                            <td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;Last Name *</td>

                            <td><input type="text" name="lname" value="<?=$lname?>" size=40></td>

                            <td>&nbsp;&nbsp;Student ID</td><td><input type="text" name="adm_num"  value="<?php echo $app_num ?>"  onchange='updtid(this.value)' readonly></td>

                            </tr>

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

                            <!--<td>&nbsp;&nbsp;Age</td><td><input type="text" name="age_yr" value="<?php echo $age_yr?>" size='2' readonly></td>-->

                            <td>&nbsp;&nbsp;Gender*</td><td>

                            <select name="gender">

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

                            </select></td>

                            </tr>

                            <tr height="25">

                            <td nowrap>&nbsp;&nbsp;Place Of Birth </td>

                            <td><input type="text" name="place" value="<?php echo $place?>"></td>

                            <!--<td>&nbsp;&nbsp;State</td>

                            <td><input type="text" name="dist" value="<?php echo $dist?>"></td>-->

                            <td nowrap>&nbsp;&nbsp;Country of Citizenship</td>

                            <td><input type="text" name="state" value="<?php echo $state?>"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue*</td>

                            <td ><select name="mother"> <option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

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

                            </tr>

                            <tr height="25">

                            <td>&nbsp;&nbsp;Nationality*</td>

                            <td><select name="nat"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <!--<td>&nbsp;&nbsp;Blood Group</td>

                            <td> <select name="b_group">

                            <option value='NA'>-------Select--------</option>

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

                            </select> </td>--><td colspan="2"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue 2</td>

                            <td><select name="mother_tongue_2"><option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

                            if($mod2[mother_tongue_2]==$myq[id])

                            {

                            ?>

                            <option value="<?=$myq[id]?>" selected ><?php echo $myq[lang] ?></option>

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

                            <tr height='25'>

                            <td>&nbsp;&nbsp;Dual Nationality</td>

                            <td><select name="nationality2"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <td nowrap>&nbsp;&nbsp;Upload Student Photo</td>

                            <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>

                            <td nowrap>&nbsp;&nbsp;E-Mail ID</td>

                            <td colspan="3"><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='22'></td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Passport No. </td>

                            <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td>

                            <td nowrap>&nbsp;&nbsp;Country Of Issue</td>

                            <td width="100"><input type="text" name="country_of_issue" id="passport_no" size="15" maxlength="50" value="<?=$country_of_issue?>" />  </td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>

                            <td align="left"><input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

                            <td  nowrap>&nbsp;&nbsp;Boarding required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td></tr>

                            <tr>

                            <td nowrap>&nbsp;&nbsp;Admission Granted?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>

                            <td  nowrap>&nbsp;&nbsp;Transport required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>

                            </tr>

                            <tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>

                            </table></td></tr>

                            <tr><td>

                            <!-- <table border='0' align='center' width='100%' class='forumline' >

                            <tr height="25">

                            <td colspan="6" class="submenu">Regular contact details </u>

                            </td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;MSG Phone number</td>

                            <td><input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" > </td>

                            <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

                            <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>

                            <td>Mail-Id</td>

                            <td><input type="text" name="rgmailid" value="<?php echo $rgmailid; ?>" size="45" ></td>

                            </tr>

                            <tr>

                            </table>-->

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=8  class="submenu">Parent/Guardian Details</td>

                            </tr>

                            <tr>

                            <td colspan=1>&nbsp;&nbsp;Description</td>

                            <td  align='center' colspan=1>Father Details</td>

                            <td align='center' colspan=1>Mother Details</td>

                            <td align='center' colspan=1>Guardian Details </td>

                            <td align='center' width="10%"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$store_stud?>', 'OpenWind2',700,600)">
                            <input type="button" class="bgbutton" value="Add Other Member">
                            </a></div></td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Name</td>

                            <td align='center'>
                            <input type="text" name="f_name" value="<?php echo $f_name?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="mname" value="<?php echo $mname ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="gname" value="<?php echo $gname?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Parent ID</td>

                            <td align='center'>
                            <input type="text" name="f_id" value="<?php echo $f_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="m_id" value="<?php echo $m_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="g_id" value="<?php echo $g_id?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Passport Number</td>

                            <td align='center'>
                            <input type="text" name="foccup" value="<?php echo $foccup?>">
                            </td><td align='center'>
                            <input type="text" name="moccup" value="<?php echo $moccup ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="goccup" value="<?php echo $goccup?>" >
                            </td><td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td >&nbsp;&nbsp;Country Of Issue</td>

                            <td align='center'>
                            <input type="text" name="fqul" value="<?php echo $fqul ?>">
                            </td>

                            <td align='center'>
                            <input type="text" name="mqul" value="<?php echo $mqul ?>">
                            </td>

                            <td align='center'>
                            <input type="text" name="gqul" value="<?php echo $gqul
 ?>">
                        </td>

                        <td nowrap>&nbsp;</td>

                    </tr>

                    <tr>

                        <td >&nbsp;&nbsp;Citizenship</td>

                        <td align='center'>
                        <input type="text" name="fciti" value="<?php ><input type="text" name="dist" value="<?php echo $dist?>"></td>-->

                            <td nowrap>&nbsp;&nbsp;Country of Citizenship</td>

                            <td><input type="text" name="state" value="<?php echo $state?>"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue*</td>

                            <td ><select name="mother"> <option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

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

                            </tr>

                            <tr height="25">

                            <td>&nbsp;&nbsp;Nationality*</td>

                            <td><select name="nat"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <!--<td>&nbsp;&nbsp;Blood Group</td>

                            <td> <select name="b_group">

                            <option value='NA'>-------Select--------</option>

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

                            </select> </td>--><td colspan="2"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue 2</td>

                            <td><select name="mother_tongue_2"><option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

                            if($mod2[mother_tongue_2]==$myq[id])

                            {

                            ?>

                            <option value="<?=$myq[id]?>" selected ><?php echo $myq[lang] ?></option>

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

                            <tr height='25'>

                            <td>&nbsp;&nbsp;Dual Nationality</td>

                            <td><select name="nationality2"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <td nowrap>&nbsp;&nbsp;Upload Student Photo</td>

                            <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>

                            <td nowrap>&nbsp;&nbsp;E-Mail ID</td>

                            <td colspan="3"><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='22'></td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Passport No. </td>

                            <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td>

                            <td nowrap>&nbsp;&nbsp;Country Of Issue</td>

                            <td width="100"><input type="text" name="country_of_issue" id="passport_no" size="15" maxlength="50" value="<?=$country_of_issue?>" />  </td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>

                            <td align="left"><input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

                            <td  nowrap>&nbsp;&nbsp;Boarding required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td></tr>

                            <tr>

                            <td nowrap>&nbsp;&nbsp;Admission Granted?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>

                            <td  nowrap>&nbsp;&nbsp;Transport required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>

                            </tr>

                            <tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>

                            </table></td></tr>

                            <tr><td>

                            <!-- <table border='0' align='center' width='100%' class='forumline' >

                            <tr height="25">

                            <td colspan="6" class="submenu">Regular contact details </u>

                            </td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;MSG Phone number</td>

                            <td><input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" > </td>

                            <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

                            <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>

                            <td>Mail-Id</td>

                            <td><input type="text" name="rgmailid" value="<?php echo $rgmailid; ?>" size="45" ></td>

                            </tr>

                            <tr>

                            </table>-->

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=8  class="submenu">Parent/Guardian Details</td>

                            </tr>

                            <tr>

                            <td colspan=1>&nbsp;&nbsp;Description</td>

                            <td  align='center' colspan=1>Father Details</td>

                            <td align='center' colspan=1>Mother Details</td>

                            <td align='center' colspan=1>Guardian Details </td>

                            <td align='center' width="10%"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$store_stud?>', 'OpenWind2',700,600)">
                            <input type="button" class="bgbutton" value="Add Other Member">
                            </a></div></td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Name</td>

                            <td align='center'>
                            <input type="text" name="f_name" value="<?php echo $f_name?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="mname" value="<?php echo $mname ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="gname" value="<?php echo $gname?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Parent ID</td>

                            <td align='center'>
                            <input type="text" name="f_id" value="<?php echo $f_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="m_id" value="<?php echo $m_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="g_id" value="<?php echo $g_id?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Passport Number</td>

                            <td align='center'>
                            <input type="text" name="foccup" value="<?php echo $foccup?>">
                            </td><td align='center'>
                            <input type="text" name="moccup" value="<?php echo $moccup ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="goccup" value="<?php echo $goccup?>" >
                            </td><td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td >&nbsp;&nbsp;Country Of Issue</td>

                            <td align='center'>
                            <input type="text" name="fqul" value="<?php echo $fqul ?>">
                            </td>

                            <td align='center'>
                            <input type="text" name="mqul" value="<?php echo $mqul ?>">
                            </td>

                            <td align='center'>
                            <input type="text" name="gqul" value="<?php echo $gqul ?>">
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td >&nbsp;&nbsp;Citizenship</td>

                            <td align='center'>
                            <input type="text" name="fciti" value="<?php echo $fciti
 ?>">
                        </td>

                        <td align='center'>
                        <input type="text" name="mciti" value="<?php $n = "selected";

                            $o = "";

                            $p = "";

                            $r = "";

                            $s = "";

                            $t = "";

                            $u = "";

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

                            </select> </td>--><td colspan="2"></td>

                            <td nowrap>&nbsp;&nbsp;Mother Tongue 2</td>

                            <td><select name="mother_tongue_2"><option>-----Select------</option>

                            <?php

                            $qq="select id,lang from language";

                            $qqq=mysql_query($qq) or die(error_description());

                            for($i=0;$i<rowcount($qqq);$i++)

                            {

                            $myq=mysql_fetch_array($qqq);

                            if($mod2[mother_tongue_2]==$myq[id])

                            {

                            ?>

                            <option value="<?=$myq[id]?>" selected ><?php echo $myq[lang] ?></option>

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

                            <tr height='25'>

                            <td>&nbsp;&nbsp;Dual Nationality</td>

                            <td><select name="nationality2"><option>-----------Select-----------</option>

                            <?php

                            $res = mysql_query("select * from nationality");

                            while($row = mysql_fetch_array($res))

                            {

                            if($rel==$row[id])

                            {

                            echo "<option value='$row[id]' selected>$row[nation]</option>";

                            }

                            else

                            {

                            echo "<option value='$row[id]'>$row[nation]</option>";

                            }

                            }

                            ?>

                            </select> </td>

                            <td nowrap>&nbsp;&nbsp;Upload Student Photo</td>

                            <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>

                            <td nowrap>&nbsp;&nbsp;E-Mail ID</td>

                            <td colspan="3"><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='22'></td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Passport No. </td>

                            <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<?=$passport_no?>" />  </td>

                            <td nowrap>&nbsp;&nbsp;Country Of Issue</td>

                            <td width="100"><input type="text" name="country_of_issue" id="passport_no" size="15" maxlength="50" value="<?=$country_of_issue?>" />  </td>

                            </tr>

                            <tr>

                            <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>

                            <td align="left"><input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;

                            <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

                            <td  nowrap>&nbsp;&nbsp;Boarding required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td></tr>

                            <tr>

                            <td nowrap>&nbsp;&nbsp;Admission Granted?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>

                            <td  nowrap>&nbsp;&nbsp;Transport required?</td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>

                            </tr>

                            <tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>

                            <td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes

                            &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>

                            </table></td></tr>

                            <tr><td>

                            <!-- <table border='0' align='center' width='100%' class='forumline' >

                            <tr height="25">

                            <td colspan="6" class="submenu">Regular contact details </u>

                            </td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;MSG Phone number</td>

                            <td><input type="text" name="msgphone" value="<?php echo $msgphone; ?>" maxlength="10" > </td>

                            <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

                            <input type="text" name="usn" value="<?php echo $usn; ?>" maxlength="10" > </td>

                            <td>Mail-Id</td>

                            <td><input type="text" name="rgmailid" value="<?php echo $rgmailid; ?>" size="45" ></td>

                            </tr>

                            <tr>

                            </table>-->

                            <table border='0' align='center' width='100%' class='forumline'>

                            <tr height="25">

                            <td colspan=8  class="submenu">Parent/Guardian Details</td>

                            </tr>

                            <tr>

                            <td colspan=1>&nbsp;&nbsp;Description</td>

                            <td  align='center' colspan=1>Father Details</td>

                            <td align='center' colspan=1>Mother Details</td>

                            <td align='center' colspan=1>Guardian Details </td>

                            <td align='center' width="10%"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$store_stud?>', 'OpenWind2',700,600)">
                            <input type="button" class="bgbutton" value="Add Other Member">
                            </a></div></td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Name</td>

                            <td align='center'>
                            <input type="text" name="f_name" value="<?php echo $f_name?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="mname" value="<?php echo $mname ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="gname" value="<?php echo $gname?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Parent ID</td>

                            <td align='center'>
                            <input type="text" name="f_id" value="<?php echo $f_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="m_id" value="<?php echo $m_id?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="g_id" value="<?php echo $g_id?>" >
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td>&nbsp;&nbsp;Passport Number</td>

                            <td align='center'>
                            <input type="text" name="foccup" value="<?php echo $foccup?>">
                            </td><td align='center'>
                            <input type="text" name="moccup" value="<?php echo $moccup ?>" >
                            </td>

                            <td align='center'>
                            <input type="text" name="goccup" value="<?php echo $goccup?>" >
                            </td><td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td >&nbsp;&nbsp;Country Of Issue</td>

                            <td align='center'>
                            <input type="text" name="fqul" value="<?php echo $fqul ?>">
                            </td>

                            <td align='center'>
                            <input type="text" name="mqul" value="<?php echo $mqul ?>">
                            </td>

                            <td align='center'>
                            <input type="text" name="gqul" value="<?php echo $gqul ?>">
                            </td>

                            <td nowrap>&nbsp;</td>

                            </tr>

                            <tr>

                            <td >&nbsp;&nbsp;Citizenship</td>

                            <td align='center'>
                            <input type="text" name="fciti" value="<?php echo $fciti ?>">
                            </td>

                            <td align='center'>
                            <input type="text" name="mciti" value="<?php echo $mciti
 ?>">
                        </td>

                        <td align='center'>
                        <input type="text" name="gciti" value="<?php echo $gciti ?>">
                        </td>

                        <td nowrap>&nbsp;</td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Mobile Number</td>

                        <td align='center'>
                        <input type="text" name="fmb" value="<?php echo $fmb?>">
                        </td>

                        <td align='center'>
                        <input type="text" name="mnum" value="<?php echo $mnum?>" >
                        </td>

                        <td align='center'>
                        <input type="text" name="gmb" value="<?php echo $gmb?>" >
                        </td>

                        <td nowrap>&nbsp;</td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;E-mail or Parent Username</td>

                        <td align='center'>
                        <input type="text" name="femail" value="<?php echo $femail?>" size="35">
                        </td>

                        <td align='center'>
                        <input type="text" name="memail" value="<?php echo $memail?>" size="35">
                        </td>

                        <td align='center'>
                        <input type="text" name="gemail" value="<?php echo $gemail?>" size="35">
                        </td>

                        <td nowrap>&nbsp;</td>

                    </tr>

                    <tr>

                        <td >&nbsp;&nbsp;Office Address</td>

                        <td align='center'>
                        <input type="text" name="foadd" value="<?php echo $foadd ?>">
                        </td>

                        <td align='center'>
                        <input type="text" name="moadd" value="<?php echo $moadd ?>">
                        </td>

                        <td align='center'>
                        <input type="text" name="goadd" value="<?php echo $goadd ?>">
                        </td>

                        <td nowrap>&nbsp;</td>

                    </tr>

                    <tr height='25'>

                        <td nowrap>&nbsp;&nbsp;Upload Photo</td>

                        <td align='center'>
                        <input type='FILE' name='father'  id='father' value='' size='15' >
                        </td>

                        <td align='center'>
                        <input type='FILE' name='motherp' id='motherp' value='' size='15' >
                        </td>

                        <td align='center'>
                        <input type='FILE' name='guardian' id='guardian' value='' size='15' >
                        </td>

                        <td nowrap>&nbsp;</td>

                    </tr>

</table></td></tr>

                <tr>
                    <td>
                    <table border='0' align='center' width='100%' class='forumline'>

                        <tr height="25">

                            <td width='50%' class="submenu" >Present Address </td>

                            <td width='50%' class="submenu">Permanent Address
                            <br>
                            <input type="checkbox" name="check" value="" onClick="getAddr()">
                            &nbsp;&nbsp;&nbsp;Click if Permanent Address is same Present Address</td>
                    </td>

                </tr>

                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                     <textarea rows="3" cols="25" name='cor_addr' value="<?=$cor_addr?>" placeholder="Present Address"></textarea></td>

                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                     <textarea rows="3" cols="25" name='per_addr' value="<?=$per_addr?>" placeholder="Permanent Address "></textarea></td>

                </tr>

                <td>
                <table border="0">

                    <tr>

                        <td>&nbsp;&nbsp;City/Town</td>

                        <td>
                        <input type="text" name="cor_city" value="<?php echo $cor_city?>" size="35">
                        </td>
                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;State</td><td>
                        <input type="text" name="cor_state" value="<?=$cor_state?>" size="35">
                        </td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Country</td><td>
                        <input type="text" name="cor_country" value="<?=$cor_country?>" size="35">
                        </td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Pin Code</td><td>
                        <input type="text" name="cor_pin" value="<?=$cor_pin?>" size="35">
                        </td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Phone No</td><td>
                        <input type="text" name="cor_phone" value="<?=$cor_phone?>" size="35">
                        </td>

                    </tr>
                </table></td>

                <td>
                <table border="0">

                    <tr>

                        <td>&nbsp;&nbsp;City/Town</td>

                        <td>
                        <input type="text" name="per_city" value="<?php echo $per_city?>" size="35">
                        </td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;State</td><td>
                        <input type="text" name="per_state" value="<?=$per_state?>" size="35">
                        </td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Country</td><td>
                        <input type="text" name="per_country" value="<?=$per_country?>" size="35">
                        </td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Pin Code</td><td>
                        <input type="text" name="per_pin" value="<?=$per_pin?>" size="35">
                        </td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Phone No</td><td>
                        <input type="text" name="per_phone" value="<?=$per_phone?>" size="35">
                        </td>

                    </tr>
                </table></td>

                </tr>

                </table></td></tr>

                <tr>
                    <td>



<?php /*

 <table border='0' align='center' width='100%' class='forumline' >

 <tr height="25">

 <td class="submenu" >Documents Enclosed(Tick the relevent documents)</td>

 </tr>

 <tr>

 <td><table border="0" width='100%' >

 <?php

 $sql=mysql_query("select * from certificate_m where status=1 order by id") or die(error_description());

 $count=0;

 for($i=0;$i<rowcount($sql);$i++)

 {

 $r1=mysql_fetch_array($sql);

 $count=$count+1;

 ?>

 <td width='2%'><input type="checkbox" name="sel[]" value="<?=$r1["id"]?>" >

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

 */
?>
      </td>

            </tr>

            </table></td></tr>

            <tr>
                <td>
                <table border='0' align='center' width='95%' class='forumline' >

                    <tr height="25">

                        <td colspan="5" class="submenu">Emergency Information</u> </td>

                    <tr>

                        <td nowrap colspan="4">&nbsp;Person to be contacted in an emergency if parents are not available</td><td></td>
                    </tr>

                    <tr>

                        <td class="keycell" colspan="4">&nbsp;Name :</td>

                        <td class="keycell">
                        <input type=text name="emergency_name" value='<?php echo $fgb[emergency_name]?>'>
                        </td>

                    </tr>

                    <tr vAlign="top" align="left">

                        <td class="keycell" colspan="4">&nbsp;Address :</td>

                        <td class="keycell">                        <textarea rows="4" cols="60" name='emergency_address'><?=$fgb[emergency_address]?></textarea></td>
                    <tr>

                        <td class="keycell" colspan="4">&nbsp; Phone Number :</td>

                        <td class="keycell">
                        <input type=text name="emergency_number" value='<?php echo $fgb[emergency_number]?>'>
                        </td>
                    </tr>
                    <tr>

                        <td class="keycell" colspan="4">&nbsp;E-Mail :</td>

                        <td class="keycell">
                        <input type="email" name="emergency_mail" value='<?php echo $fgb[emergency_mail]?>'>
                        </td>

                    </tr>

                </table>
                <table class='forumline' align='center' width='95%' border="0">

                    <tr height="25">

                        <td colspan="4" class="submenu" >Username & Password</td>

                    </tr>

                    <tr>

                        <td>&nbsp;&nbsp;Student Username</td>

                        <td>
                        <input name='username' type='text' value="<?=$app_num?>" size='15' readonly>
                        </td>

                        <td>&nbsp;&nbsp;Student Password</td>

                        <td>
                        <input name='password' type="text" value="<?=$app_num?>" size='15' readonly>
                        </td>

                    </tr>
                    <input name='parent_username' type='hidden' value="<?=$papp_num?>" size='15' readonly>
                    <input name='parent_password' type="hidden" value="<?=$papp_num?>" size='15' readonly>

                    <!--

                    <tr>

                    <td>&nbsp;&nbsp;Parent Username</td>

                    <td></td>

                    <td>&nbsp;&nbsp;Parent Password</td>

                    <td></td></tr>

                    <tr>

                    <td>&nbsp;&nbsp;Caregiver Username</td>

                    <td><input name='caregiver_username' type='text' value="<?=$capp_num?>" size='15' readonly></td>-->

                    <!-- <td>&nbsp;&nbsp;Caregiver Password</td>

                    <td><input name='caregiver_password' type="text" value="<?=$capp_num?>" size='15' readonly></td>

                    </tr>-->

                    <table border='0' align='center' width='95%' class='forumline'>

                        <tr height="25">

                            <td colspan="4" class="submenu" title="Upload photograph page of student passport">Upload photograph page of student passport</td>

                        </tr>

                        <tr>

                            <td height="25" title="Upload photograph page of student passport">&nbsp;&nbsp;Upload Documents</td>

                            <td title="Upload photograph page of student passport">
                            <input size="20" name="uploadedPassport[]" id='uploadedPassport' type="file" class="bgbutton" multiple />
                        </tr>

                    </table>

                </table></td>
            </tr>

            </table>
            <br>

            <div align='center'>

                <input type="submit" value="Save Details" name="save" class='bgbutton'>

            </div>

            <input type='hidden' name='s_name' value='<?php echo $fname ?>'>

            </form>

            </BODY>

            </HTML>



<?php



	if($action=='save' )

    {

    if($flag==1)

    {
?>

<script language='javascript'>
    var fname = document.frm.s_name.value;

    alert(fname + '`s' + ' Details Added Successfully');

</script>

<?php

}

}
?>