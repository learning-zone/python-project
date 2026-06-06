<?php
session_start();
include("../db.php");
$StudID=$_REQUEST['StudID'];
?>
<html>
<head>
</head>
<body>
<form name="frm" action="" method="">
<?php
$mod=mysql_query("select * from student_m where id='$StudID'");
$mod2=mysql_fetch_array($mod);
?>
<table align='center' width='95%' class='forumline' border='0'>
<tr>
  <td align='center' class='head'><b></b>
<?=$mod2[first_name]?> <?=$mod2[last_name]?></td></tr>


<tr height="25"><td class="submenu"><b>Admission details </b></td></tr>

<tr><td><table width='100%' border='1' align='center'>



<tr><td width="25%" nowrap>&nbsp;&nbsp;Admission Date Number</td>

		<td width="25%" nowrap><?php echo $mod2[admission_date]?></td>

	</tr>

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
                </tr>
              </table></td></tr>

<tr><td>

 <table border='1' align='center' width='100%' class='forumline'>

    <tr height="25"> 

      <td colspan=6 class="submenu"><b>Student Details</b> </td>

    </tr>

	<tr height="25">

   

      <td>&nbsp;&nbsp;Student ID</td>

		<td><?php echo $mod2[student_id]?></td>
        </tr>
        
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

		</td>

	</tr>
    <tr>

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

			

		</td></tr>
        <tr>
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
        </tr>
        <tr>

	<td>&nbsp;&nbsp;Age on Admission</td><td><?php echo $mod2[age] ?></td>
    </tr>
    <tr>

      <td nowrap>&nbsp;&nbsp;Blood Group</td>

      <td > <?php

			 	echo $mod2[blood_group];

			?>

         </td><td nowrap>&nbsp;</td>

	</tr>

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

   <?php echo $mod2['msgphone']; ?></td></tr>
   <tr>

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

		<td colspan=8 class="submenu"><b>Address Details</b></td>

</tr>


	<tr height="25">

		<td width='50%' class="submenu">Present Address </td>

		<td width='50%' class="submenu">Permanent Address </td>

	</tr>

    <tr><td>&nbsp;&nbsp;

	<?=$mod2[cor_address]?><?php echo $mod2[cor_address] ?></td>

		

      <td>&nbsp;&nbsp;

	<?=$mod2[per_address]?><?php echo $mod2[per_address] ?>
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

			<td height="21">&nbsp;&nbsp;Phone No</td><td><?php echo  $mod2[cor_phone]?></td>

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

</table>
</form>
</body>