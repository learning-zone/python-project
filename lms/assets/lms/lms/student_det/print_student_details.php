<?php
session_start();
include("../db1.php");

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
function printReport()
{
// prn.style.display="none";
 window.print();
}
function reload1()

{

	document.frm.action="print_student_details.php";

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
function printReport()
{
// prn.style.display="none";
 window.print();
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
function prn()
{
	pr1.style.display = "none";
	window.print();
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

</head>

<body onLoad="printReport()">

<form name='frm' method='post' ENCTYPE='multipart/form-data'>

<input type="hidden" name="pqr1" value="<?php echo $app_no?>">

<input type="hidden" name="pqr2" value="<?php echo $branch ?>">

<input type="hidden" name="pqr3" value="<?php echo $sem ?>">

<input type="hidden" name="pqr4" value="<?php echo $studfname ?>">

<input type="hidden" name="pqr5" value="<?php echo $a_year?>">

<input type="hidden" name="pqr6" value="<?php echo $un?>">

<input type='hidden' name='StudID' value='<?php echo $StudID ?>'>

<input type='hidden' name='usn' value='<?php echo $usn ?>'>

<?php

$mod="select * from student_m where id='$StudID'";

$mod1=mysql_query($mod);

$stud_id=mysql_fetch_array(mysql_query("SELECT student_id FROM student_m WHERE `id`='$StudID'"));

$mod2=mysql_fetch_array($mod1);

$var2=mysql_fetch_array(mysql_query("SELECT * FROM additional_info2 WHERE `student_id`='$StudID'"));


$prts=mysql_fetch_array(mysql_query("select * from student_photo where studid='$StudID'"));
$mrts=mysql_fetch_array(mysql_query("select * from student_photo where studid='$StudID'"));
$grts=mysql_fetch_array(mysql_query("select * from student_photo where studid='$StudID'"));

?>

<input type='hidden' name='image' value='<?php echo $mod2[img_source] ?>'>

<table align='center' width='95%' class='forumline' border='2' cellpadding="0" cellspacing="0">

<tr><td align='center' class='head'>STUDENT FORM

<!--<table border='0' align='center' width='100%' class='forumline'>

<tr><td align='center' ><?php echo collegename(); ?></td></tr>

<tr><td align='center' ><?php echo collegeadress(); ?></td></tr>

</table>--></td></tr>



<tr height="25"><td class="submenu"><b>Admission details </b></td></tr>

<tr><td><table width='100%' border='0' align='center' >
<tr height="25">

<td nowrap width="20%">&nbsp;&nbsp;<u>Application Number</u></td>

		<td width="10%"><?php echo $mod2[id] ?></td>

			<td width="20%">&nbsp;&nbsp;<u>Application Date</u></td>

		<td width="20%"><?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>&nbsp;&nbsp;

	</td></tr>

		<tr height="25">

		<td>&nbsp;&nbsp;<u><?php echo $_SESSION['branchname']; ?></u></td>

		<td width="35%">
		<?php echo $r[coursename]?>

		</td>
		<td>&nbsp;&nbsp;<u><?=$r[year_name]?></u>
		</td>
	</tr>

<tr height="25">

<td nowrap>&nbsp;&nbsp;<u>Academic Year</u></td>
<?=$Fyear?>- <?=$Tyear?></td>
	</tr>

</table></td></tr>

<tr><td>

 <table border='0' align='center' width='100%' class='forumline'>

    <tr height="25"> 

      <td colspan=6 class="submenu"><b>Student Details </b></td>

    </tr>

	<tr height="25">

    <td nowrap>&nbsp;&nbsp;<u>Student Name</u></td>

    <td width="50"><? echo $mod2[first_name]?></td>

      <td width="20">&nbsp;&nbsp;&nbsp;&nbsp;<u>Last Name</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $mod2[last_name]?></td>

	<td>&nbsp;&nbsp;<u>Student ID</u></td>

		<td><?php echo $mod2[student_id]?></td>

        

        </tr>

		<td nowrap>&nbsp;&nbsp;<u>Date of Birth</u></td>

		<?php

		$dc = explode('-',$mod2[dob]);

		if($DobDay=="")

		{

			$DobDay=$dc[2];

			$DobMon=$dc[1];

			$DobYear=$dc[0];

		}

		?>

        <td> <?php

		           echo "$DobDay / $DobMon / $DobYear";

	        

         ?>

			

		</td> 

	<!--<td>&nbsp;&nbsp;Age on Admission</td><td><?php echo $mod2[age] ?></td>-->
    <td width="20">&nbsp;&nbsp;<u>Gender</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

			<?php

               if($mod2[gender]== "M")

                 {

	             echo "Male";

                 }

               if($mod2[gender]== "F")

                 {

	          echo "Female";

               }

			   ?>

		</td>
<td></td>
              <?php

			  //echo "hello";

			  ?>

     <tr height="25">

            <td nowrap>&nbsp;&nbsp;<u>Place Of Birth</u></td>

            <td>&nbsp;<?php echo $mod2[place_of_birth]?></td>

			<!--<td>&nbsp;&nbsp;State</td>

			<td><input type="text" name="dist" value="<?php echo $mod2[birth_disct]?>"></td>-->

			<td nowrap>&nbsp;&nbsp;<u>Country of Citizenship</u></td>


			<td><?php 
			if($mod2[State]==0)
			{
				$mod2[State]="";
			}
			echo $mod2[State]?></td>
            <td nowrap>&nbsp;&nbsp;<u>Mother Tongue</u></td>            

     <td >

		 <?php

							$qq="select id,lang from language";

					        $qqq=mysql_query($qq) or die(error_description());

							for($i=0;$i<rowcount($qqq);$i++)

							  {

								$myq=mysql_fetch_array($qqq);

                                if($mod2[mother_tongue]==$myq[id])

								 {

						 			echo $myq[lang];

								 }

							  }

						?></td>
            </tr>

     <tr height="25"> 

      <td>&nbsp;&nbsp;<u>Nationality</u></td>

      <td><?php

			   $res = mysql_query("select * from nationality");

			   while($row = mysql_fetch_array($res))

			   {

				   if($mod2[nationality]==$row[id])

					{

						echo "$row[nation]";

					}

			   }

			?> </td>
<td colspan="2"></td>
<td nowrap>&nbsp;&nbsp;<u>Mother Tongue 2</u></td>   
        
       <td>

		<?php

		$qq="select id,lang from language";

		$qqq=mysql_query($qq) or die(error_description());

		for($i=0;$i<rowcount($qqq);$i++)

		{

			$myq=mysql_fetch_array($qqq);

			if($var2[mother_tongue_2]==$myq[id])

			{

				
						 			echo $myq[lang];

								 }

							  }

						?></td>
	 

    </tr>

	<tr height='25'>
 <td>&nbsp;&nbsp;<u>Dual Nationality</u></td>

      <td>          <?php

			   $res = mysql_query("select * from nationality");

			   while($row = mysql_fetch_array($res))

			   {

				   if($var2[nationality2]==$row[id])

					{

							echo "$row[nation]";


					}		  

			   }

			?>

        </td>
			 

        <td nowrap width="20%">&nbsp;&nbsp;<u>E-Mail ID</u>&nbsp;&nbsp;&nbsp;&nbsp;

	<?=$mod2[img_source_s]?></td> 

     

                </tr>

	

<tr>

	  <td width="110">&nbsp;&nbsp;<u>Passport No.</u></td>
      <td width="100"><? echo $var2[passport_no]?></td>
       <td nowrap>&nbsp;&nbsp;<u>Country Of Issue</u></td>
      <td width="100"><?=$var2[country_of_issue]?> </td>
      <td rowspan='4' align="center" colspan="2"><img src="<?php echo $mod2[img_source]?>"  height='100'> &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:void(0);" onClick ="OpenWind7('familys.php?stuid=<?=$StudID?>', 'OpenWind7',600,530)">
			   <!-- <input type="button" class="bgbutton" value="Add Siblings">-->
			  </a></td>
	</tr>
  <!--  <tr>

	  <td width="110">&nbsp;&nbsp;Date Of Enrolment</td>
       <td align="left"><?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $var2[date_of_enrol]?>&nbsp;&nbsp;

		</td>
       
       <td  nowrap>&nbsp;&nbsp;Boarding required?</td>
     <td nowrap>&nbsp;&nbsp;<?=strtoupper($var2[type1])?></td></tr>-->
         <tr>
        
         <!--<td nowrap>&nbsp;&nbsp;Admission Granted?</td>
       <td nowrap>&nbsp;&nbsp;<?=strtoupper($var2[type2])?></td>-->
          <td  nowrap>&nbsp;&nbsp;<u>Transport required?</u></td>
     <td nowrap>&nbsp;&nbsp;<?=strtoupper($var2[type4])?></td>
         
	</tr>
  
    <!--<tr><td colspan="3" nowrap><i>I agree to have my name, address and phone number published in the student directory :</i></td>
     <td nowrap>&nbsp;&nbsp; <?=strtoupper($var2[type3])?></td>-->

  </table></td></tr>

  <tr><td>

 <!-- <table border='0' align='center' width='100%' class='forumline' >

<tr height="25">

   <td colspan="6" class="submenu"><b>Regular contact details </u>

   </b></td>

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

		<td colspan=8  class="submenu"><b>Parent/Guardian Details</b></td>

</tr>

<tr>

<td align='center' colspan=1><u>Description</u></td>

<td  align='center' colspan=1><u>Father Details</u></td>

<td align='center' colspan=1><u>Mother Details</u></td>

<td align='center' colspan=1><u>Guardian Details</u>

</td>
<td align='center' width="10%"><a href="javascript:void(0);" onClick ="OpenWind2('add_other_stud.php?student_id=<?=$StudID?>', 'OpenWind2',700,600)">
<!--<input type="button" class="bgbutton" value="Add Other Member">-->
</a></div></td></tr>
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

	<td>&nbsp;&nbsp;<u>Name</u></td>

	<td align='center'><?php echo $mod2[parent_name]?></td>

	<td align='center'><?php echo $mod2[m_name] ?></td>

	<td align='center'><?php echo $mod2[g_name] ?></td>
    <td></td>

	</tr>

<tr>

	<td>&nbsp;&nbsp;<u>Parent ID</u></td>

	<td align='center'><?php echo $var2[f_id] ?></td>	

<td align='center'><?php echo $var2[m_id] ?></td>		

<td align='center'><?php echo $var2[g_id] ?></td>	
	</tr>


     <tr>

	<td>&nbsp;&nbsp;<u>Passport Number</u></td>

	<td align='center'><?php echo $mod2[parent_occupation]?>

	</td><td align='center'><?php echo $mod2[m_occ] ?></td>

	<td align='center'><?php echo $mod2[g_occ]?></td>

</tr>
<tr>

<td >&nbsp;&nbsp;<u>Country Of Issue</u></td>

<td align='center'><?php echo $mod2[f_quali] ?></td>	

<td align='center'><?php echo $mod2[m_quali] ?></td>		

<td align='center'><?php echo $mod2[g_quali] ?></td>	
<td></td>		

		</tr>

        <tr>

<td >&nbsp;&nbsp;<u>Citizenship</u></td>

<td align='center'><?php echo $var2[fciti] ?></td>	

<td align='center'><?php echo $var2[mciti] ?></td>		

<td align='center'><?php echo $var2[gciti] ?></td>	
<td></td>		

		</tr>

 <tr>

   <td>&nbsp;&nbsp;<u>Mobile Number</u></td>

   <td align='center'><?php echo $mod2[sms_mobile]?></td>

   <td align='center'><?php echo $mod2[mnum]?></td>

   <td align='center'><?php echo $mod2[g_num]?></td>
   <td></td>

 </tr>

 <tr>

	<td>&nbsp;&nbsp;<u>E-mail or Parent Username</u></td>

	<td align='center'><?php echo $mod2[f_email]?></td>

	<td align='center'><?php echo $mod2[m_email]?></td>

	<td align='center'><?php echo $mod2[g_mail]?></td>
    <td></td>

 </tr>
		<tr>

<td >&nbsp;&nbsp;<u>Office Address</u></td>

<td align='center'><?php echo $mod2[foadd] ?></td>	

<td align='center'><?php echo $mod2[moadd] ?></td>		

<td align='center'><?php echo $mod2[goadd] ?></td><td></td>			

		</tr>
        

</table></td></tr>

<tr><td>

<table border='0' align='center' width='100%' class='forumline'>

	<tr height="25">

		<td width='50%' class="submenu" ><b><u>Present Address</u></b> </td>

		<td width='50%' class="submenu"><b><u>Permanent Address</u></b></td> <br>

		<tr> 

        <td></td>

       </td>

	</tr>

    <tr><td valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Address</u>

	<?php echo $mod2[cor_address] ?></td>

		

      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Address</u>
<?php echo $mod2[per_address]?></td>

	</tr>

		<td><table border="0">

		<tr>

		<td>&nbsp;&nbsp;<u>City/Town</u></td>

            <td><?php echo $mod2[cor_city]?></td></tr>

			<tr>

			<td>&nbsp;&nbsp;<u>State</u></td><td><?=$mod2[cor_state]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;<u>Country</u></td><td><?=$mod2[cor_country]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;<u>Pin Code</u></td><td><?=$mod2[cor_pincode]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;<u>Phone No</u></td><td><?=$mod2[cor_phone]?></td>

		</tr></table></td>

		<td><table border="0">

		<tr>

		<td>&nbsp;&nbsp;<u>City/Town</u></td>

            <td><?php echo $mod2[per_city]?></td>

			</tr>

			<tr>

			<td>&nbsp;&nbsp;<u>State</u></td><td><?=$mod2[per_state]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;<u>Country</u></td><td><?=$mod2[per_country]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;<u>Pin Code</u></td><td><?=$mod2[per_pincode]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;<u>Phone No</u></td><td><?=$mod2[per_phone]?></td>

		</tr></table></td>

	</tr>	

</table></td></tr>

<tr><td>

<?php

/*

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

</td></tr>

<tr><td>

<table border='0' align='center' width='100%' class='forumline'>

    <tr height="25">

		<td colspan="6"  class="submenu"><b>Emergency Information</b></td>

</tr>
<tr>
 
					        <td nowrap colspan="4">&nbsp;Person to be contacted in an emergency if parents are not available</td><td></td></tr>
                            <tr>
                             <td class="keycell" colspan="4">&nbsp;<u>Name :</u></td>
					        <td class="keycell">					        
					        <?php echo $var2[emergency_name]?>
				                </td>
				                </tr>
                 <tr vAlign="top" align="left">
                        <td class="keycell" colspan="4">&nbsp;<u>Address :</u></td>
                        <td class="keycell">					        
                       <?=$var2[emergency_address]?> 
                            </td>
                           <tr>
                             <td class="keycell" colspan="4">&nbsp;<u>Phone Number :</u></td>
					        <td class="keycell">					        
					        <?php echo $fgb[emergency_number]?>
				                </td></tr><tr>
                                 <td class="keycell" colspan="4">&nbsp;<u>E-Mail :</u></td>
					        <td class="keycell">					        
					       <?php echo $fgb[emergency_mail]?>
				                </td>
                            </tr>  
</table>

<!--<table class='forumline' align='center' width='100%' border="0">

<tr>

   <td colspan="6" class="submenu"><b>Username & Password</b></td>

</tr>

	<tr>

		<td>&nbsp;&nbsp;Student Username</td>   

		<td><?=$mod2[username]?></td>

		

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

	</tr>
<table border='0' align='center' width='100%' class='forumline' >
<tr height="25">
   <td colspan="4" class="submenu" ><b>Upload Files</b></td>
</tr>
<tr>
   <td height="25">&nbsp;&nbsp;Upload Documents</td>
	 <td><input size="20" name="uploadedPassport[]" id='uploadedPassport' type="file" class="bgbutton" multiple />
       &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="javascript:void(0);" onClick ="OpenWindC('student_doc.php?student_id=<?=$StudID?>&type=doc_edt', 'OpenWind2',800,800)">Modify Documents</a> </td>
</tr>

</table>-->
	

</table><br></td></tr>
<tr><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Signature of Parent / Guardian</u></td>
</tr>
</table>
<br>


<input type='hidden' name='s_name' value='<?php echo $fname ?>'>

</form>

</body>

</html>