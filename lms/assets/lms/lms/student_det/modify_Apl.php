<?php

session_start();

include("../db.php");



$un=$_REQUEST['un'];

$sem=$_REQUEST['sem'];

$StudID=$_REQUEST['StudID'];

$app_nu=$_REQUEST['app_nu'];

$branch=$_REQUEST['branch'];

$a_year=$_REQUEST['a_year'];

$studfname=$_REQUEST['studfname'];

?>

<html>

<head>

<TITLE> MODIFY STUDENT DETAILS </TITLE>



<script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>



<script language="javascript" src="../js/cal2.js"></script>



<script language="javascript" src="../js/cal_conf2.js"></script>



<script language="javascript">



function OpenWind7(URL, title,w,h)

{

	var left = (screen.width/2)-(w/2);

	var top = (screen.height/2)-(h/2);

var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

}

function reload1()



{



	document.frm.action="modify_Apl.php";



	document.frm.submit();



} 



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











function getAddr()



{



	document.frm.per_addr.value    = document.frm.cor_addr.value;



	document.frm.per_city.value    = document.frm.cor_city.value;



	document.frm.per_state.value   = document.frm.cor_state.value;



	document.frm.per_country.value = document.frm.cor_country.value;



	document.frm.per_pin.value	   = document.frm.cor_pin.value;



	document.frm.per_phone.value   = document.frm.cor_phone.value;



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



function OpenWind2(k2)



{



	var finalVar ;



	finalVar=k2 ;



	window.open(finalVar,'Stud','width=1100,height=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');



}



</script>

<script language="javascript">

function OpenWindC(URL, title,w,h)

{

	var left = (screen.width/2)-(w/2);

	var top = (screen.height/2)-(h/2);

var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

}

</script>

 <script>

function goBack()

  {

  window.history.back()

  }

</script>

</head>



<body>

<?php

$mod="select * from student_m where id='$StudID'";



$mod1=execute($mod);

$mod2=fetcharray($mod1);

 	

if($_POST['a_year'])

$a_year=$_POST['a_year'];

else

$a_year=$mod2['academic_year'];



?>

<form name='frm' method='post' ENCTYPE='multipart/form-data' action="modify_AplEng.php">



<input type="hidden" name="pqr1" value="<?php echo $app_no?>">



<input type="hidden" name="pqr2" value="<?php echo $branch ?>">



<input type="hidden" name="pqr3" value="<?php echo $sem ?>">



<input type="hidden" name="pqr4" value="<?php echo $studfname ?>">



<input type="hidden" name="pqr5" value="<?php echo $a_year?>">



<input type="hidden" name="pqr6" value="<?php echo $un?>">



<input type='hidden' name='StudID' value='<?php echo $StudID ?>'>



<input type='hidden' name='usn' value='<?php echo $usn ?>'>



<?php





$stud_id=fetcharray(execute("SELECT student_id FROM student_m WHERE `id`='$StudID'"));







$var2=fetcharray(execute("SELECT * FROM additional_info2 WHERE `student_id`='$StudID'"));





$prts=fetcharray(execute("select * from student_photo where studid='$StudID'"));

$mrts=fetcharray(execute("select * from student_photo where studid='$StudID'"));

$grts=fetcharray(execute("select * from student_photo where studid='$StudID'"));



?>



<?php

$fmcodes=fetcharray(execute("SELECT family_code FROM `stud_sibling` where `stud`='$StudID' and `status`=1"));





///Father mother update



$fsibilings=fetchrow(execute("select f_photo from student_photo where studid='$StudID' and f_photo!='' limit 1"));



$msibilings=fetchrow(execute("select m_photo from student_photo where studid='$StudID' and m_photo!='' limit 1"));



$stfname=execute("SELECT stud FROM `stud_sibling` where `family_code`='$fmcodes[0]' and `status`=1");

while($stfnameone=fetcharray($stfname))

{

	

	$Sql66=execute("select id from student_photo where  studid='$stfnameone[0]' and status=1");

			if(rowcount($Sql66)>0)

			{

				execute("update `student_photo` set f_photo='$fsibilings[0]' where studid='$stfnameone[0]' and status=1 and f_photo=''");

				execute("update `student_photo` set m_photo='$msibilings[0]' where studid='$stfnameone[0]' and status=1 and m_photo=''");

			}

			else

			{

	execute("insert into student_photo (`studid`,`f_photo`,`m_photo`,`acc_year`,`status`) values('$stfnameone[0]', '$fsibilings[0]' ,'$msibilings[0]', '$academic_year','1')");

			}

}





?>







<input type='hidden' name='image' value='<?php echo $mod2[img_source] ?>'>



<!--<div align="left">&nbsp;&nbsp;&nbsp;&nbsp;

<input type="button"  class="bgbutton" value="Back" onClick="goBack()">

</div>-->

<table align='center' width='95%' class='forumline' border='2'>



<tr><td align='center' class='head'>MODIFY ADMISSION FORM



<!--<table border='0' align='center' width='100%' class='forumline'>



<tr><td align='center' ><?php echo collegename(); ?></td></tr>



<tr><td align='center' ><?php echo collegeadress(); ?></td></tr>



</table>--></td></tr>







<tr height="25"><td class="submenu">Admission Details </td></tr>



<tr><td><table width='100%' border='0' align='center'>







<tr height="25">



<td nowrap>&nbsp;&nbsp;Application Number</td>



		<td><input name="appl_num" type="text" value="<?php echo $mod2[id] ?>" size="34" readonly></td>



			<!--<td>&nbsp;&nbsp;Application Date</td>

<?php

$adate=$mod2[admission_date];

$a=explode('-',$adate);

$adate="$a[2]/$a[1]/$a[0]";

?>

		<td><input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate ?>" readonly>&nbsp;&nbsp;



		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>--></tr>



		<tr height="25">



		<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?> *</td>



		<td width="35%">



        <?php



		//echo $branch;



		?>



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



		



		<td>&nbsp;&nbsp;<?php



		if(!$branch)



			$branch=$mod2['course_admitted'];



			 echo Grade;?> *</td>



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



<td nowrap>&nbsp;&nbsp;Academic Year*</td>



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



              </select></td><?php



		if(!$branch)



			$branch=$mod2['course_admitted'];



			?>



			 



	</tr>



</table></td></tr>



<tr><td>



 <table border='0' align='center' width='100%' class='forumline'>



    <tr height="25"> 



      <td colspan='2' class="submenu">Student Details <td colspan="6"  class="submenu" align="right"><a href="javascript:OpenWind2('student_medical_info.php?student_id=<?=$StudID?>')" ><input type="button" class="bgbutton" value="Medical Information"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      <a href="javascript:OpenWind2('../passport/register_exec.php?student_id=<?=$StudID?>')" ><input type="button" class="bgbutton" value="Student Additional Information"></a>

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick ="OpenWind7('familys.php?stuid=<?=$StudID?>', 'OpenWind7',600,530)"><input type="button" class="bgbutton" value="Add Siblings"></a></td></td>



    </tr>



	<tr height="25">



    <td nowrap>&nbsp;&nbsp;Student Name *</td>



    <td><input type="text" name="fname" value="<? echo $mod2[first_name]?>" size=40></td>



      <td>&nbsp;&nbsp;&nbsp;&nbsp;Last Name *</td>



		<td><input type="text" name="lname" value="<? echo $mod2[last_name]?>" size=40></td>



	<td>&nbsp;&nbsp;Student ID</td>



		<td><input type="text" name="adm_num"  value="<?php echo $mod2[student_id]?>" size="24" onchange='updtid(this.value)' readonly></td>



        



        </tr>



		<td nowrap>&nbsp;&nbsp;Date of Birth*</td>



		<?php



		$dc = explode('-',$mod2[dob]);



		if($DobDay=="")



		{



			$DobDay=$dc[2];



			$DobMon=$dc[1];



			$DobYear=$dc[0];



		}



		?>



        <td>DD<select name="DobDay" onchange='calage()'>



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

         MM<select name="DobMon" onchange='calage()'>



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

        YYYY <select name="DobYear" onchange='calage()'>



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



	<!--<td>&nbsp;&nbsp;Age on Admission</td><td><input type="text" name="age_yr" value="<?php echo $mod2[age] ?>" size='2' readonly></td>-->

    <td>&nbsp;&nbsp;Gender*</td><td>



    <select name="gender">



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



      <option value="M" <?=$sj?>>&nbsp;&nbsp;&nbsp;&nbsp;Male</option>



      <option value="F" <?=$sk?>>&nbsp;&nbsp;&nbsp;&nbsp;Female</option>



		</select></td>



	</tr>



              <?php



			  //echo "hello";



			  ?>



     <tr height="25">



            <td nowrap>&nbsp;&nbsp;Place Of Birth</td>



            <td><input type="text" name="place" value="<?php echo $mod2[place_of_birth]?>"></td>



			<!--<td>&nbsp;&nbsp;State</td>



			<td><input type="text" name="dist" value="<?php echo $mod2[birth_disct]?>"></td>-->



			<td nowrap>&nbsp;&nbsp;Country of Citizenship</td>





			<td><input type="text" name="state" value="<?php echo $mod2[State]?>"></td>

            <td nowrap>&nbsp;&nbsp;Mother Tongue*</td>            



     <td nowrap ><select name="mother"><option>-----Select------</option>



		<?php



		$qq="select id,lang from language";



		$qqq=execute($qq) ;



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



        </select><a href="../masters/language.php"><img width="25" src="../images/add1.png" align="absmiddle"> </a> </td>

            </tr>



     <tr height="25"> 



      <td>&nbsp;&nbsp;Nationality*</td>



      <td><select name="nat"><option>-----Select------</option>



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



				  



			   }



			?>



        </select><a href="../masters/national.php"><img width="25" src="../images/add1.png" align="absmiddle"> </a> </td><td nowrap>&nbsp;&nbsp;E-Mail ID</td>



	 <td ><input type="text" name="std_email" onChange="validateForm(this.name)"  value="<?=$mod2[img_source_s]?>" size='30'></td> 



<td nowrap>&nbsp;&nbsp;Mother Tongue 2</td>   

        

       <td nowrap><select name="mother_tongue_2"><option>-----Select------</option>



		<?php



		$qq="select id,lang from language";



		$qqq=execute($qq);



		for($i=0;$i<rowcount($qqq);$i++)



		{



			$myq=fetcharray($qqq);



			if($var2[mother_tongue_2]==$myq[id])



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



      <td><select name="nationality2"><option>-----Select------</option>



          <?php



			   $res = execute("select * from nationality");



			   while($row = fetcharray($res))



			   {



				   if($var2[nationality2]==$row[id])



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

			 <td nowrap>&nbsp;&nbsp;Change Student Photo</td>

           <td colspan=''><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>



        

     



                </tr>



	



<tr>



	  <td width="110">&nbsp;&nbsp;Passport No. </td>

      <td width="100"><input type="text" name="passport_no" id="passport_no" size="15" maxlength="50" value="<? echo $var2[passport_no]?>">  </td>

       <td nowrap>&nbsp;&nbsp;Country Of Issue</td>

      <td width="100"><input type="text" name="country_of_issue" id="country_of_issue" size="15" maxlength="50" value="<?=$var2[country_of_issue]?>" />  </td>

      <td rowspan='4' align="center" colspan="2"><img src="<?php echo $mod2[img_source]?>"  height='100'> &nbsp;&nbsp;&nbsp;&nbsp;

        </td>

	</tr>

    <tr>



	  <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>

	  <?

	  $mdatse=explode('-',$var2[date_of_enrol]);

	$mdatsea=$mdatse[2]."/".$mdatse[1]."/".$mdatse[0];

	  ?>

       <td align="left"><input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $mdatsea?>" readonly>&nbsp;&nbsp;



		<a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>

        <?php

  if($var2[type1]=='yes')

  $check='checked';

  else

  $check1='checked';

  ?>

       <td  nowrap>&nbsp;&nbsp;Boarding required?</td>

     <td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes

         &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td></tr>

         <tr>

         <?php

  if($var2[type2]=='yes')

  $check2='checked';

  else

  $check3='checked';

  ?>

         <td nowrap>&nbsp;&nbsp;Admission Granted?</td>

     <td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check2?>>Yes

         &nbsp;<input type="radio" name="type2"  value="no" <?=$check3?>>No</td>

         <?php

  if($var2[type4]=='yes')

  $check5='checked';

  else

  $check6='checked';

  ?> 

         

         

          <td  nowrap>&nbsp;&nbsp;Transport required?</td>

     <td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check5?>>Yes

         &nbsp;<input type="radio" name="type4"  value="no" <?=$check6?>>No</td>

         

	</tr>

    <?php

  if($var2[type3]=='yes')

  $check2='checked';

  else

  $check3='checked';

  ?>

    <tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>

     <td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check2?>>Yes

         &nbsp;<input type="radio" name="type3"  value="no" <?=$check3?>>No</td>



  </table></td></tr>



  <tr><td>



 <!-- <table border='0' align='center' width='100%' class='forumline' >



<tr height="25">



   <td colspan="6" class="submenu">Regular contact details </u>



   </td>



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



	



</table>-->



<table border='0' align='center' width='100%' class='forumline'>



    <tr height="25">



		<td colspan=2  class="submenu">Parent/Guardian Details</td>

		<td colspan=3 align="right"  class="submenu"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$StudID?>', 'OpenWind2',700,600)">

<input type="button" class="bgbutton" value="Add Other Member">

</a></td>



</tr>



<tr>



<td align='center' colspan=1>Description</td>



<td  align='center' colspan=1>Father Details</td>



<td align='center' colspan=1>Mother Details</td>



<td align='center' colspan=1>Guardian Details



</td>

<td align='center' width="10%"></td></tr>

<tr height='25'>

			<td nowrap>&nbsp;</td>

           <td align='center'>

           <img src="<?php echo $prts[f_photo]?>" height='100'> 

           </td>

           <td align='center'>

           <img src="<?php echo $mrts[m_photo]?>" height='100'>

           </td>

           <td align='center'>

           <img src="<?php echo $grts[g_photo]?>" height='100'>

           </td>

           <td nowrap>&nbsp;</td>

</tr>



 <tr>



	<td>&nbsp;&nbsp;Name</td>



	<td align='center'><input type="text" name="f_name" value="<?php echo $mod2[parent_name]?>" ></td>



	<td align='center'><input type="text" name="mname" value="<?php echo $mod2[m_name] ?>" ></td>



	<td align='center'><input type="text" name="gname" value="<?php echo $mod2[g_name] ?>" ></td>

    <td></td>



	</tr>



<tr>



	<td>&nbsp;&nbsp;Parent ID</td>



	<td align='center'><input type="text" name="f_id" value="<?php echo $var2[f_id] ?>"></td>	



<td align='center'><input type="text" name="m_id" value="<?php echo $var2[m_id] ?>"></td>		



<td align='center'><input type="text" name="g_id" value="<?php echo $var2[g_id] ?>"></td>	

	</tr>





     <tr>



	<td>&nbsp;&nbsp;Passport Number</td>



	<td align='center'><input type="text" name="foccup" value="<?php echo $mod2[parent_occupation]?>">



	</td><td align='center'><input type="text" name="moccup" value="<?php echo $mod2[m_occ] ?>" ></td>



	<td align='center'><input type="text" name="goccup" value="<?php echo $mod2[g_occ]?>" ></td>



</tr>

<tr>



<td >&nbsp;&nbsp;Country Of Issue</td>



<td align='center'><input type="text" name="fqul" value="<?php echo $mod2[f_quali] ?>"></td>	



<td align='center'><input type="text" name="mqul" value="<?php echo $mod2[m_quali] ?>"></td>		



<td align='center'><input type="text" name="gqul" value="<?php echo $mod2[g_quali] ?>"></td>	

<td></td>		



		</tr>



        <tr>



<td >&nbsp;&nbsp;Citizenship</td>



<td align='center'><input type="text" name="fciti" value="<?php echo $var2[fciti] ?>"></td>	



<td align='center'><input type="text" name="mciti" value="<?php echo $var2[mciti] ?>"></td>		



<td align='center'><input type="text" name="gciti" value="<?php echo $var2[gciti] ?>"></td>	

<td></td>		



		</tr>



 <tr>



   <td>&nbsp;&nbsp;Mobile Number</td>



   <td align='center'><input type="text" name="fmb" value="<?php echo $mod2[sms_mobile]?>"></td>



   <td align='center'><input type="text" name="mmb" value="<?php echo $mod2[mnum]?>" ></td>



   <td align='center'><input type="text" name="gmb" value="<?php echo $mod2[g_num]?>" ></td>

   <td></td>



 </tr>



 <tr>



	<td>&nbsp;&nbsp;E-mail or Parent Username</td>



	<td align='center'><input type="text" name="femail" value="<?php echo $mod2[f_email]?>" size="35"></td>



	<td align='center'><input type="text" name="memail" value="<?php echo $mod2[m_email]?>" size="35"></td>



	<td align='center'><input type="text" name="gemail" value="<?php echo $mod2[g_mail]?>" size="35"></td>

    <td></td>



 </tr>

<tr>

		<td>&nbsp;&nbsp;Parent Password</td>



		<td align='center'><input name='parent_username' type="password" value="<?=$mod2[parent_username]?>" ></td>

		<td align='center'><input name='parent_password' type="password" value="<?=$mod2[parent_password]?>" ></td>

		<td align='center'></td>

	</tr>

 



		<tr>



<td >&nbsp;&nbsp;Office Address</td>



<td align='center'><input type="text" name="foadd" value="<?php echo $mod2[foadd] ?>"></td>	



<td align='center'><input type="text" name="moadd" value="<?php echo $mod2[moadd] ?>"></td>		



<td align='center'><input type="text" name="goadd" value="<?php echo $mod2[goadd] ?>"></td><td></td>			



		</tr>

         <tr height='25'>

			 <td nowrap>&nbsp;&nbsp;Change Uploaded Photo</td>

           <td align='center'><input type='FILE' name='father'  id='father' value='<?php echo $father ?>' size='15' ></td>

           <td align='center'><input type='FILE' name='motherp' id='motherp' value='<?php echo $motherp ?>' size='15' ></td>

           <td align='center'><input type='FILE' name='guardian' id='guardian' value='<?php echo $guardian ?>' size='15' ></td>

           <td nowrap>&nbsp;</td>

           </tr>



</table></td></tr>



<tr><td>



<table border='0' align='center' width='100%' class='forumline'>



	<tr height="25">



		<td width='50%' class="submenu" >Present Address </td>



		<td width='50%' class="submenu">Permanent Address</td> <br>



		<tr> 



        <td></td>



        <td><input type="checkbox" name="check" value="" onClick="getAddr()">&nbsp;&nbsp;&nbsp;Click if Permanent Address is same Present Address</td></td>



	</tr>



    <tr><td valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address



	<textarea rows="3" cols="25" name='cor_addr' ><?php echo $mod2[cor_address] ?></textarea></td>



		



      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address



<textarea rows="3" cols="25" name='per_addr'><?php echo $mod2[per_address]?></textarea>



      </td>



	</tr>



		<td><table border="0">



		<tr>



		<td>&nbsp;&nbsp;City/Town</td>



            <td><input type="text" name="cor_city" value="<?php echo $mod2[cor_city]?>"></td></tr>



			<tr>



			<td>&nbsp;&nbsp;State</td><td><input type="text" name="cor_state" value="<?=$mod2[cor_state]?>"></td>



		</tr>



		<tr>



			<td>&nbsp;&nbsp;Country</td><td><input type="text" name="cor_country" value="<?=$mod2[cor_country]?>"></td>



		</tr>



		<tr>



			<td>&nbsp;&nbsp;Pin Code</td><td><input type="text" name="cor_pin" value="<?=$mod2[cor_pincode]?>"></td>



		</tr>



		<tr>



			<td>&nbsp;&nbsp;Phone No</td><td><input type="text" name="cor_phone" value="<?=$mod2[cor_phone]?>"></td>



		</tr></table></td>



		<td><table border="0">



		<tr>



		<td>&nbsp;&nbsp;City/Town</td>



            <td><input type="text" name="per_city" value="<?php echo $mod2[per_city]?>"></td>



			</tr>



			<tr>



			<td>&nbsp;&nbsp;State</td><td><input type="text" name="per_state" value="<?=$mod2[per_state]?>"></td>



		</tr>



		<tr>



			<td>&nbsp;&nbsp;Country</td><td><input type="text" name="per_country" value="<?=$mod2[per_country]?>"></td>



		</tr>



		<tr>



			<td>&nbsp;&nbsp;Pin Code</td><td><input type="text" name="per_pin" value="<?=$mod2[per_pincode]?>"></td>



		</tr>



		<tr>



			<td>&nbsp;&nbsp;Phone No</td><td><input type="text" name="per_phone" value="<?=$mod2[per_phone]?>"></td>



		</tr></table></td>



	</tr>	



</table></td></tr>



<tr><td>



<?php



/*



<table border='0' align='center' width='100%' class='forumline' >



<tr height="25">



   <td class="submenu" >Documents Enclosed(Tick the relevent documents)</td>



</tr>



<tr>



	<td><table border="0" width='100%' >



  <?php



$sql=execute("select * from certificate_m where status=1 order by id") ;



$count=0;



for($i=0;$i<rowcount($sql);$i++)



{



	$r1=fetcharray($sql);



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



</td></tr>



<tr><td>



<table border='0' align='center' width='100%' class='forumline'>



    <tr height="25">



		<td colspan="6"  class="submenu">Emergency Information</td>



</tr>

<tr>

 

					        <td nowrap colspan="4">&nbsp;Person to be contacted in an emergency if parents are not available</td><td></td></tr>

                            <tr>

                             <td class="keycell" colspan="4">&nbsp;Name :</td>

					        <td class="keycell">					        

					        <input type=text name="emergency_name" value='<?php echo $var2[emergency_name]?>'>

				                </td>

				                </tr>

                 <tr vAlign="top" align="left">

                        <td class="keycell" colspan="4">&nbsp;Address :</td>

                        <td class="keycell">					        

                       <textarea rows="4" cols="60" name='emergency_address'><?=$var2[emergency_address]?></textarea> 

                            </td>

                            </tr>  

</table>



<table class='forumline' align='center' width='100%' border="0">



<tr>



   <td colspan="6" class="submenu">Username & Password</td>



</tr>



	<tr>



		<td>&nbsp;&nbsp;Student Username</td>   



		<td><input name='username' type='text' value="<?=$mod2[username]?>" size='15' readonly></td>



		<td>&nbsp;&nbsp;Student Password</td>



		<td><input name='password' type="password" value="<?=$mod2[password]?>" size='15' ></td>



	</tr>



	 <!-- <tr>



		<td>&nbsp;&nbsp;Parent Username</td>



		<td><input name='parent_username' type='text' value="<?=$mod2[parent_username]?>" size='15' readonly></td>



		<td>&nbsp;&nbsp;Parent Password</td>



		<td><input name='parent_password' type="text" value="<?=$mod2[parent_password]?>" size='15' readonly></td>



	</tr>

  <tr>



		<td>&nbsp;&nbsp;Caregiver Username</td>



		<td><input name='caregiver_username' type='text' value="<?=$var2[caregiver_username]?>" size='15'></td>



		<td>&nbsp;&nbsp;Caregiver Password</td>



		<td><input name='caregiver_password' type="text" value="<?=$var2[caregiver_password]?>" size='15'></td>



	</tr>-->

<table border='0' align='center' width='100%' class='forumline' >

<tr height="25">

   <td colspan="4" class="submenu" >Upload Files</td>

</tr>

<tr>

   <td height="25">&nbsp;&nbsp;Upload Documents</td>

	 <td><input size="20" name="uploadedPassport[]" id='uploadedPassport' type="file" class="bgbutton" multiple />

       &nbsp;&nbsp;&nbsp;&nbsp;

              <a href="javascript:void(0);" onClick ="OpenWindC('student_doc.php?student_id=<?=$StudID?>&type=doc_edt', 'OpenWind2',800,800)">Modify Documents</a> </td>

</tr>



</table>

	



</table></td></tr>



</table>

<br>



<div align='center'>



<input type="submit" value="Modify Details" name="save" class='bgbutton'>



</div>



<input type='hidden' name='s_name' value='<?php echo $fname ?>'>



</form>



</body>



</html>