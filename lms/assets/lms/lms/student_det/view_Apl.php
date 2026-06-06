<html>

<head>

<?php

session_start();

include("../db.php");

$StudID=$_REQUEST['StudID'];

$app_nu=$_REQUEST['app_nu'];

$branch=$_REQUEST['branch'];

$sem=$_REQUEST['sem'];

$studfname=$_REQUEST['studfname'];

$a_year=$_REQUEST['a_year'];

$un=$_REQUEST['un'];

?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"> 



  <TITLE> New Document </TITLE>

  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>

  <script language="javascript" src="../js/cal2.js"></script>

  <script language="javascript" src="../js/cal_conf2.js"></script>

  <script language="javascript">



	// function to refresh form

	function reload()

	{

		document.frm.action="ViewArchiveReport.php";

		document.frm.submit();

	} 

	function printReport()

{

	prn.style.display = "none";

	window.print();

}



  



    function getAddr(a)

	{

		var type = a;

		

	    if(type==1)

		{

			document.frm.per_addr.value    = document.frm.cor_addr.value;

			document.frm.per_state.value   = document.frm.cor_state.value;

			document.frm.per_country.value = document.frm.cor_country.value;

			document.frm.per_pin.value	   = document.frm.cor_pin.value;

			document.frm.per_phone.value   = document.frm.cor_phone.value;

			document.frm.per_email.value   = document.frm.cor_email.value;   

		}

		if(type==2)

		{

			document.frm.loc_addr.value = document.frm.cor_addr.value;

			document.frm.loc_state.value   = document.frm.cor_state.value;

			document.frm.loc_country.value = document.frm.cor_country.value;

			document.frm.loc_pin.value	   = document.frm.cor_pin.value;

			document.frm.loc_phone.value   = document.frm.cor_phone.value;

			document.frm.loc_email.value   = document.frm.cor_email.value;   

		}

	} 

	

	//function to calculate total mark & percentage



function getMark()

	{

		var phyObt  = parseFloat(document.frm.phy_obt.value);

		var mathObt = parseFloat(document.frm.math_obt.value);

		var optObt  = parseFloat(document.frm.opt_obt.value);



		var phyMax  = parseFloat(document.frm.phy_max.value);

		var mathMax = parseFloat(document.frm.math_max.value);

		var optMax  = parseFloat(document.frm.opt_max.value);



			var total = phyObt + mathObt + optObt;



			var maxi = phyMax + mathMax + optMax;



			if(total<=maxi)

			{	

				var res = (total / maxi) * 100;



				document.frm.tot_mark.value=total+'/'+maxi;

				document.frm.result.value=res+'%';

			}

	}



function getMark1()

	{

		var markObt  =document.frm.mark_obt.value;

		

		var markMax  = document.frm.mark_max.value;

		

		if(markObt<=markMax)

			{	

				var res1 = (markObt/markMax) * 100;



				document.frm.mark_total.value=markObt+'/'+markMax;

				document.frm.mark_res.value=res1+'%';

			}

	

	}

  </script>

 </head>

 <body>

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

$mod="select * from student_m where id='$StudID'";

$mod1=mysql_query($mod);

$mod2=mysql_fetch_array($mod1);

?>

<input type='hidden' name='image' value='<?php echo $mod2[img_source] ?>'>

<table align='center' width='95%' class='forumline' border='2'>

<tr>

  <td align='center' class='head'><b> ADMISSION FORM</b>

<!--<table border='0' align='center' width='100%' class='forumline'>

<tr><td align='center' ><?php echo collegename(); ?></td></tr>

<tr><td align='center' ><?php echo collegeadress(); ?></td></tr>

</table>--></td></tr>



<tr height="25"><td class="submenu"><b>Admission details </b></td></tr>

<tr><td><table width='100%' border='1' align='center'>



<tr><td width="25%" nowrap>&nbsp;&nbsp;Application Number</td>

		<td width="25%" nowrap><?php echo $mod2[admission_id]?></td>

		<td rowspan='4'  width="25%" nowrap><img src="<?php echo $mod2[img_source]?>" width="100" height='100'> </td></tr>

		<!--<tr>
        <td  width="25%" nowrap>&nbsp;&nbsp;Admission Date</td>

        <?

		if($mod2[admission_date]!='0000-00-00')

		{

			$var123 = explode('-',$mod2[admission_date]);

			if($adate=="" and $mod2[admission_date]!='')

				$adate= $var123[2]."/".$var123[1]."/".$var123[0];

				

		}

		?>

		<td><?php echo $adate ?>&nbsp;&nbsp;

		</td></tr>-->

		<tr height="25">

		<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>

		<td>

		

			<?php

				$sql="select course_id,coursename from course_m";

				$rs=execute($sql) or die(error_description());

				for($i=0;$i<rowcount($rs);$i++)

				{

				  	$r=mysql_fetch_array($rs);

					if($mod2[course_admitted]==$r[course_id])

					{

						 echo $r[coursename];

					}

				}

			?>

		</td>

		</tr>

		<tr>

		<td>&nbsp;&nbsp;<?php

		if(!$branch)

			$branch=$mod2['course_admitted'];

			 echo $_SESSION['semname']; ?></td>

        <td>

			<?php

			

				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");

				while($r=fetcharray($rs))

				{

					if($mod2[course_yearsem]==$r[year_id])

					{

						echo "$r[year_name]";

					}

				}

			?>

		</td>

	</tr>

<tr height="25">

 <td>&nbsp;&nbsp;Academic Year</td>

              <td> 

                  <?php

							   $MyYear=date('Y')-2;

                               $CurrentYr=date("Y")+2;

	                           for($i=$MyYear;$i<$CurrentYr;$i++)

	                             {

		                            $Fyear=$i;

		                            $Tyear=$i+1;

		                            if($mod2['academic_year']==$i)

			                        echo "$Fyear - $Tyear";

		              			 }

						   ?>

                </td>

			  <td  width="50%" nowrap>&nbsp;&nbsp;Admission Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <?php

							$qq="select id,name from admission";

					        $qqq=mysql_query($qq) or die(error_description());

							for($i=0;$i<rowcount($qqq);$i++)

							  {

								$myq=mysql_fetch_array($qqq);

                                if($mod2['admission_type']==$myq[id])

								 {

						 			echo $myq[name];

								 }

							  }

						?>

				</td>

	</tr></table></td></tr>

<tr><td>

 <table border='1' align='center' width='100%' class='forumline'>

    <tr height="25"> 

      <td colspan=6 class="submenu"><b>Student Details</b> </td>

    </tr>

	<tr height="25">

    <td nowrap>&nbsp;&nbsp;First Name </td>

    <td><?php echo $mod2[first_name]?></td>

    <td nowrap>&nbsp;&nbsp;Last  Name </td>

    <td><?php echo $mod2[last_name]?></td>

      <td>&nbsp;&nbsp;Student ID</td>

		<td><?php echo $mod2[student_id]?></td>

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

        <td> <?php

		           echo "$DobDay / $DobMon / $DobYear";

	        

         ?>

			

		</td> 

	<td>&nbsp;&nbsp;Age on Admission</td><td><?php echo $mod2[age] ?></td>

	<td>&nbsp;&nbsp;Gender</td>

		<td>

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

		</td></tr>

     <tr height="25">

            <td nowrap>&nbsp;&nbsp;Birth Place Details  </td>

            <td nowrap>City&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $mod2[place_of_birth]?></td>

			<td>&nbsp;&nbsp;State</td>

			<td><?php echo $mod2[birth_disct]?></td>

			<td>&nbsp;&nbsp;Country</td>

			<td><?php echo $mod2[State]?></td></tr>

     <tr height="25"> 

      	<td>&nbsp;&nbsp;Nationality</td>

      <td><?php

			   $res = mysql_query("select * from nationality");

			   while($row = mysql_fetch_array($res))

			   {

				   if($mod2[nationality]==$row[id])

					{

						echo "$row[nation]";

					}

			   }

			?></td> 

	 <td nowrap>

            &nbsp;&nbsp;Mother Tongue</td>

            

     <td >             <?php

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

						?>

              </td>

      <td nowrap>&nbsp;&nbsp;Blood Group</td>

      <td > <?php

			 	echo $mod2[blood_group];

			?>

         </td>

    </tr>

	<tr height='25'>

			 <td nowrap>&nbsp;&nbsp;E-Mail ID</td>

	 <td><?=$mod2[img_source_s]?></td> <td nowrap>&nbsp;</td>

	 <td></td> <td nowrap>&nbsp;</td>

            

     <td >             

              </td></tr>

  </table></td></tr>

  <tr><td>

  <table border='0' align='center' width='100%' class='forumline' >

<tr>

   <td colspan="4" class="submenu"><b>Emergency  contact details </b></td>

</tr>

<tr>

   <td nowrap>&nbsp;&nbsp;MSG Phone number &nbsp;&nbsp;

   <?php echo $mod2['msgphone']; ?></td>

   <td>&nbsp;&nbsp;EC number &nbsp;&nbsp;

   <?php echo $mod2['usn']; ?> </td>

   <td>Mail-Id</td>

   <td><?php echo $mod2['rgmailid']; ?></td>

</tr>

<tr>

	

</table>

<table border='1' align='center' width='100%' class='forumline'>

    <tr height="25">

		<td colspan=8 class="submenu"><b>Parent/Guardian Details</b></td>

</tr>

<tr>

<td  colspan=1>&nbsp;&nbsp;Description</td>

<td colspan=1>&nbsp;&nbsp;Father Details</td>

<td colspan=1>&nbsp;&nbsp;Mother Details</td>

<td colspan=1>&nbsp;&nbsp;Guardian Details

</td></tr>

 <tr>

	<td>&nbsp;&nbsp;Name</td>

	<td >&nbsp;&nbsp;<?php echo $mod2[parent_name]?></td>

	<td >&nbsp;&nbsp;<?php echo $mod2[m_name] ?></td>

	<td >&nbsp;&nbsp;<?php echo $mod2[g_name]?></td>

	</tr>

    <tr>

	<td>&nbsp;&nbsp;Occupation</td>

	<td >&nbsp;&nbsp;<?php echo $mod2[parent_occupation]?>

	</td><td >&nbsp;&nbsp;<?php echo $mod2[m_occ] ?></td>

	<td >&nbsp;&nbsp;<?php echo $mod2[g_occ]?></td>

</tr>

 <tr>

   <td>&nbsp;&nbsp;Mobile Number</td>

   <td >&nbsp;&nbsp;<?php echo $mod2[sms_mobile]?></td>

   <td >&nbsp;&nbsp;<?php echo $mod2[mnum]?></td>

   <td >&nbsp;&nbsp;<?php echo $mod2[g_num]?></td>

 </tr>

 <tr>

	<td>&nbsp;&nbsp;E-mail</td>

	<td >&nbsp;&nbsp;<?php echo $mod2[f_email]?></td>

	<td >&nbsp;&nbsp;<?php echo $mod2[m_email]?></td>

	<td >&nbsp;&nbsp;<?php echo $mod2[g_mail]?></td>

 </tr>

 <tr>

<td >&nbsp;&nbsp;Educational Qualification</td>

<td >&nbsp;&nbsp;<?php echo $mod2[f_quali]?></td>	

<td >&nbsp;&nbsp;<?php echo $mod2[m_quali] ?></td>		

<td >&nbsp;&nbsp;<?php echo $mod2[g_quali] ?></td>			

		</tr>

		<tr>

<td >&nbsp;&nbsp;Office Address</td>

<td >&nbsp;&nbsp;<?php echo $mod2[foadd] ?></td>	

<td >&nbsp;&nbsp;<?php echo $mod2[moadd] ?></td>		

<td >&nbsp;&nbsp;<?php echo $mod2[goadd] ?></td>			

		</tr>

</table></td></tr>

<tr><td>

<table border='1' align='center' width='100%' class='forumline'>

	<tr height="25">

		<td width='50%' class="submenu">Present Address </td>

		<td width='50%' class="submenu">Permanent Address </td>

	</tr>

    <tr><td>&nbsp;&nbsp;

	<textarea rows="3" cols="25" name='cor_addr' value='<?=$mod2[cor_address]?>' readonly ><?php echo $mod2[cor_address] ?></textarea></td>

		

      <td>&nbsp;&nbsp;

		<textarea rows="3" cols="25" name='cor_addr' value='<?=$mod2[per_address]?>' readonly ><?php echo $mod2[per_address] ?></textarea> 

      </td>

	</tr>

		<td><table border="0" width="100%">

		<tr>

		<td width="35%" nowrap>&nbsp;&nbsp;City/Town </td>

            <td><?php echo $mod2[cor_city]?></td></tr>

			<tr>

			<td>&nbsp;&nbsp;State</td><td><?php echo $mod2[cor_state]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;Country</td><td><?php echo $mod2[cor_country]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;Pin Code</td><td><?php echo $mod2[cor_pincode]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;Phone No</td><td><?php echo  $mod2[cor_phone]?></td>

		</tr></table></td>

		<td><table border="0" width="100%">

		<tr>

		<td width="35%" nowrap>&nbsp;&nbsp;City/Town</td>

            <td><?php echo $mod2[per_city]?></td>

			</tr>

			<tr>

			<td>&nbsp;&nbsp;State</td><td><?php echo $mod2[per_state]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;Country</td><td><?php echo $mod2[per_country]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;Pin Code</td><td><?php echo  $mod2[per_pincode]?></td>

		</tr>

		<tr>

			<td>&nbsp;&nbsp;Phone No</td><td><?php echo $mod2[per_phone]?></td>

		</tr></table></td>

	</tr>	

</table></td></tr>

<tr><td>

<table border='0' align='center' width='100%' class='forumline'>

<tr>

   <td><b>Documents enclosed(Tick the relevent items)</b></td>

</tr>

<tr>

 <td>

	<table border="0" width='70%' >

   <?php

$count=1;

$sql=execute("select * from certificate_m where status='1' order by id") or die(mysql_error());

$numrows=rowcount($sql);

for($i=0;$i<rowcount($sql);$i++)

{

	$r1=fetcharray($sql,$i);

	$qry="select * from certificate_det where new_id='$StudID' and cert_id=$r1[id] and status='true'";

	$t=execute($qry) or die(mysql_error());;

	if(rowcount($t)>0)

		$sel=$r1["name"];

	else

		$sel="";

	if($doc_count ==0)

		echo "<tr>";

     if($doc_count <$numrows)

		 {

		if($count%5==0)

			echo "<tr>";

		?>

		<td valign='top' nowrap><?=$sel?></td>

		<?php

		$doc_count=$doc_count+1;

		$count++;

	}

	else

	{

		$doc_count=0;

		echo "</tr>";

	}

}

if($doc_count !=0)

{

	echo "<td colspan=2></td></tr>";

}

?>

</table>

</td></tr></table></td></tr>

<tr><td>

<table border='0' align='center' width='100%' class='forumline' >

<tr>

   <td align='center'>Remarks</td>

	<td>

	<textarea rows="5" cols="116" name='extra' readonly><?=$mod2[remarks]?></textarea> 

	</td>

</tr>

</table>

<!--<table class='forumline' align='center' width='100%' border="1">

<tr>

   <td colspan="4" class="submenu"><b>Username & Password</b></td>

</tr>

	<tr>

		<td width="22%">&nbsp;&nbsp;Student Username</td>   

		<td width="15%"><?=$mod2[username]?></td>

		<td width="20%">&nbsp;&nbsp;Student Password</td>

		<td width="43%"><?=$mod2[password]?></td>

	</tr>

	<tr>

		<td>&nbsp;&nbsp;Parent Username</td>

		<td><?=$mod2[parent_username]?></td>

		<td>&nbsp;&nbsp;Parent Password</td>

		<td><?=$mod2[parent_password]?></td>

	</tr>-->

	

	<td></td>

	<td></td></tr>

</table></td></tr>

</table><br>



<div id='prn' align='center'>

  <input class='bgbutton' type="button" value="PRINT" name="print" onClick="printReport()" >

</div>

<input type='hidden' name='s_name' value='<?php echo $fname ?>'>

</form>

</body>

</html>