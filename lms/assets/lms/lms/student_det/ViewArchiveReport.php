<html>
<head>
<?php
session_start();
include("../db.php");
?>
</head>
<body>

<?php
if($a_sts=='F')
	$tname="student_m";
else
	$tname="archive_student";


$mod="select * from $tname where id='$StudID'";
$mod1=mysql_query($mod);
$mod2=mysql_fetch_array($mod1);

$det=execute("select * from academic_details where id='$StudID'");
//echo "select * from academic_details where id='$StudID'";
$det1=mysql_fetch_array($det);
?>

<form name='frm' method='post' ENCTYPE='multipart/form-data' action="modify_Archived.php">
<input type='hidden' name='StudID' value='<?php echo $StudID ?>'>
<input type='hidden' name="fname" value='<?php echo $mod2[first_name] ?>'>
<input type='hidden' name='image' value='<?php echo $mod2[img_source] ?>'>
<input type='hidden' name='a_sts' value='<?php echo $a_sts ?>'>

<table class='forumline' align='center' width='90%'  height="10%" border=1 cellpadding=0 cellspacing=0>
	<tr>
		<td align='center' class='head'><font size="4"><b> <?php echo collegename(); ?> </b></font></td>
	</tr>
	<tr>
		<td align='center' class='head'><b>Application for admission to School </b></td>
	</tr>
<tr><td>
<table class='forumline' align='center' width='100%' border='0'>
	<tr>
		<td width="25%">
			<table  border='0' align='left' width='100%'  height="100%"> 
			<tr>
				<td align="center">Student Photo</td></tr>
					<tr height="70">
						<td align='center'>
							<img src="<?php echo $mod2[img_source]?>" width='110' height='120'>
					    </td>
					</tr>
				</td>
			</tr>
			</table>
		 </td>
		 <td>
		   	<table border="0" cellspacing='4' cellpadding='0' width='100%'>
				 <tr>
					 
					 <td > Fee Rec.No</td>
					 <td ><?=$mod2[cetreceiptno]?></td>
				     <td >Rs.</td>
					 <td ><?php echo $mod2[cetfee]?></td>
				</tr>

				<tr>
					
                     <td >Academic Year</td>
                        <td ><?php echo $mod2[academic_year]?></td>
              
					 <td>Admission Quota</td>
					 <td ><?php echo $mod2[quota_id]?></td>
					 <tr>
						
				     <td>KAR/NKR/FN</td>
					 <td ><?php echo $mod2[cetunder]?></td>
			
					<td>Admission Type</td>
					<?php
					        $qq="select id,name from admission";
					        $qqq=execute($qq) or die(error_description());
							for($i=0;$i<rowcount($qqq);$i++)
							  {
								$myq=mysql_fetch_array($qqq);
                                if($mod2[admission_type]==$myq[id])
								  {
                    ?>
				     		   <td ><?php echo $myq[name]?></td>
							   <?php
							  }
							  }
							   ?>
	                 
					 
				 </tr>
			</table>
			</td>
		</tr>
</table></td></tr>
<tr><td>		 
<table class='forumline' align='center' width='100%' border='0' cellspacing='0' cellpadding='0'>
	<tr height="25">
		<td> Admission Date:</td>
		<?php
		   $str=explode("-",$mod2[admission_date]);
           $aDay=$str[2];
           $aMon=$str[1];
           $aYear=$str[0];
		   $adate=$aDay."-".$aMon."-".$aYear;
		?>
		<td ><?php echo $adate?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr height="25">
		<td width="20%">School Division:</td>
		<?php
           $sql="select course_id,coursename from course_m";
           $rs=execute($sql) or die(error_description());
           for($i=0;$i<rowcount($rs);$i++)
              {
               $r=mysql_fetch_array($rs);
			   if($mod2[course_admitted]==$r[course_id])
                 {
        ?>
             <td ><?php echo $r[coursename]?></td>
       <?php
                 }
			  }
	    ?>
		
		<td  width="20%"> Class :</td>
		<?php
		     $rs=execute("SELECT year_name,year_id FROM course_year");
				while($r=fetcharray($rs))
				{
					if($mod2[course_yearsem]==$r[year_id])
					{
						?>
						<td ><?php echo $r[year_name]?></td>
						<?php
					}
				}
	    ?>
	</tr>
<tr height="25">
		<td>Apllication Number:</font></td>
		<td ><?php echo $mod2[student_id]?></td>
		<td >Admission Number:</td>
		<td ><?php echo $mod2[admission_id]?></td>
	</tr>	
</table></td></tr>
<tr><td>
<table class='forumline' align='center' width='100%' border='0' cellspacing='0' cellpadding='0'>
   <tr height="25">
		<td colspan='6'><font color="blue" size="2"><u>Student Details:</u></font></td></tr>
   <tr height="25">
		
		<td>Category</td>
		<?php
			   $res = mysql_query("select * from category");
			   while($row = mysql_fetch_array($res))
			   {
				   if($mod2[cetcategory]==$row[id])
					{
					   ?>
						<td ><?php echo $row[name]?></td>
						<?php
						}
					}
        ?>
			
    </tr>
	<tr>
		<td>First Name</td>
		<td ><?php echo $mod2[first_name]?></td>
		<td>Last Name</td>
		<td ><?php echo $mod2[last_name]?></td>
		<td>Gender</td>
		<td ><?php echo $mod2[gender]?></td>

</tr>
	<tr height="25">
		<td>Date of Birth</td>
		<?php
	            $str=explode("-",$mod2[dob]);
                $DobDay=$str[2];
                $DobMon=$str[1];
                $DobYear=$str[0];
				$dob1=$DobDay."-".$DobMon."-".$DobYear;
          ?>
         <td ><?php echo $dob1?></td>
		<td>Age as On 1st july</td>
		<td ><?=$mod2[age]?></td>
		<td>Nationality</td>
		<td ><?php echo $mod2[nationality]?></td>	
	</tr>
	<tr height="25">
		<td>Religion</td>
        <?php
			   $res = mysql_query("select * from religion");
			   while($row = mysql_fetch_array($res))
			   {
				   if($mod2[religion]==$row[id])
					{
					   ?>
						<td ><?php echo $row[name]?></td>
						<?php
					}
				}
		?>
		
		<td>Caste</td>
		<td ><?php echo $mod2[caste_id]?></td>

		<td>Blood Group</td>
		<td ><?php echo $mod2[blood_group]?></td>
			
	</tr>
</table></td></tr>
<tr><td>
<table border='0' align='center' width='90%' class='forumline'>
    <tr height="25">
		<td colspan=8><font color="blue" size="2"><u>Parent/Guardian Details</u></font></td>
</tr>
<tr>
<td align='center' colspan=1><font size="2" color="#CC0000">Description</font></td>
<td align='center' colspan=1><font size="2" color="#CC0000">Mother Details</font>
</td><td  align='center' colspan=1><font size="2" color="#CC0000">Father Details</font>
<td align='center' colspan=1><font size="2" color="#CC0000">Gaurdian Details</font>
</td></tr>
 <tr>
	<td>Name</td>
	<td align='center'><?=$mod2[parent_name]?></td>
	<td align='center'><?=$det1[puc_state]?></td>
	<td align='center'><?=$mod2[g_name]?></td>
	</tr>
    <tr>
	<td>Occupation</td>
	<td align='center'><?=$mod2[parent_occupation]?>
	</td><td align='center'><?=$det1[obt_sub]?></td>
	<td align='center'><?=$mod2[g_occ]?></td>
</tr>
<tr>
	<td>Income</td>
	<td align='center'><?=$mod2[parent_income]?></td>
	<td align='center'><?=$mod2[in_all_subjects]?></td>
	<td align='center'><?=$mod2[g_in]?></td>
 </tr>
 <tr>
	<td>Mobile Number</td>
	<td align='center'><?=$mod2[mnum]?></td>
	<td align='center'><?=$mod2[pcm_marks]?></td>
	<td align='center'><?=$mod2[g_num]?></td>
 </tr>
 <tr>
	<td>E-mail</td>
	<td align='center'><?=$mod2[m_email]?></td>
	<td align='center'><?=$mod2[f_email]?></td>
	<td align='center'><?=$mod2[g_mail]?></td>
 </tr>
</table></td></tr>
<tr><td>
<table class='forumline' align='center' width='100%' border='0' cellspacing='0' cellpadding='0' colspan='6'>
	<tr height="25">
		<td><font color="blue" size="2"><u>Student Address:</u></font></td>
		<td><font color="blue" size="2"><u>Parent Address:</u></font></td>
		<td><font color="blue" size="2"><u>Guardian Address:</u></font></td>
	</tr>
	<tr>
		<td></td>
	</tr>	
	<tr>
	</tr>
	<tr>	
		<td>
		<!-- Student Address-->
		<table border="0">
		<tr>
		<td>Address:</td>
		<td ><?=$mod2[cor_address]?></td>
		<tr>	
		<td>State:</td><td ><?=$mod2[cor_state]?></td>
		</tr>
		<tr>
			<td>Country:</td><td ><?=$mod2[cor_country]?></td>
		</tr>
		<tr>
			<td>Pin Code:</td><td ><?=$mod2[cor_pincode]?></td>
		</tr>
		<tr>
			<td>Phone Number:</td><td ><?=$mod2[cor_phone]?></td>			
		</tr>
		<tr>
			<td>Email-ID:</td><td ><?=$mod2[cor_email]?></td>		
		</tr>
		</table>
		</td>
		<td>
		<!-- ends here -->
		<!-- parent address -->
		<table border="0">
		<tr>
		<td>Address:</td>
		<td ><?=$mod2[per_address]?></td>
		<tr>
			<td>State:</td><td ><?=$mod2[per_state]?></td>
		</tr>
		<tr>
			<td>Country:</td><td ><?=$mod2[per_country]?></td>
		</tr>
		<tr>
			<td>Pin Code:</td><td ><?=$mod2[per_pincode]?></td>
		</tr>
		<tr>
			<td>Phone Number:</td><td ><?=$mod2[per_phone]?></td>			
		</tr>
		<tr>
			<td>Email-ID:</td><td ><?=$mod2[per_email]?></td>		
		</tr>
		</table>
		</td>
		<td>
		<!-- ends here -->
		<!-- Guardian Address -->
		<table border="0">
		<tr>
		<td>Address:</td>
		<td ><?=$mod2[loc_address]?></td>
		<tr>
			<td>State:</td><td ><?=$mod2[loc_state]?></td>
		</tr>
		<tr>
			<td>Country:</td><td ><?=$mod2[loc_country]?></td>
		</tr>
		<tr>
			<td>Pin Code:</td><td ><?=$mod2[loc_pincode]?></td>
		</tr>
		<tr>
			<td>Phone Number:</td><td ><?=$mod2[loc_phone]?></td>			
		</tr>
		<tr>
			<td>Email-ID:</td><td ><?=$mod2[loc_email]?></td>		
		</tr>

		</table>
		<!-- ends here -->
		</td>
	</tr>	
</table></td></tr>
<tr><td>
<table border="0" width="100%" align="center">
<tr>
	<td><font color="blue" size="2"><u>Previous Academic Details:</u></font></td>
</tr>
</table></td></tr>
<tr><td>
<tr><td>
<table class='forumline' align='center' width='100%' border='1' cellspacing='0' cellpadding='0'>
	<tr height="25">
		<td>&nbsp;School</td>
		<td>&nbsp;Subject-Name1</td>
		<td>&nbsp;Subject-Name2</td>
		<td align="center">Subject-Name3</td>
		<td>&nbsp;Subject-Name4</td>
		<td>&nbsp;Subject-Name5</td>
		<td>&nbsp;Subject-Name6</td>
	</tr>
	<tr height="80">
		<td>&nbsp;&nbsp;Subject:</td>
		<td align="center"><?php echo $det1['12_board'] ?></td>
		<td align="center"><?php echo $det1['12_passing'] ?></td>
		<td>
		  <table border="0" width="100%">
<tr>
<td align="center"><?php echo $det1['12_msub1']?></td>
</table>	

<td align="center">
			<?php echo $det1['12_total'] ?>
		</td>
		<td align='center'>
			<?php echo $det1['12_perc'] ?>
		</td>
		<td align="center">
			<?php echo $det1['rem']?>
		</td>
			
	</tr>

	
</table></td></tr>

<table border='0' align='center' width='90%'>
<tr>
   <td><b><font color='blue' size="2"><u>Documents enclosed</u></font></b></td>
</tr>
</table></td></tr>
<tr><td>
<table class='forumline' align='center' width='90%' border='1' cellspacing='0' cellpadding='0'>
<td>
	<table border="0" >
    <?php 
	     $chk=mysql_query("select a.id,a.name from certificate_m a,certificate_det b where a.id=b.cert_id and b.new_id='$StudID'");
		 $num = mysql_num_rows($chk);
		 $var = $num % 2;
		 $var1 = $num -$var;
		 $var2 = $var1/2 + $var;

		 for($i=1;$i<=$var2;$i++)
		 {
		 $chk1=mysql_fetch_array($chk);
		 ?>
		 <tr><td><?php echo $i?></td>
		 <td>)</td>
		 <td>&nbsp;</td>
		 <td><?php echo $chk1['name']?></td>
		 <?php
		 }
		 ?>
	 </table>
	 
	<table border='0' >
	<?php
	for($i=$var2+1;$i<=$num;$i++)
		{
			$chk1=mysql_fetch_array($chk);
		 ?>
		 <tr><td><?php echo $i?></td>
		 <td>)</td>
		 <td>&nbsp;</td>
		 <td><?php echo $chk1['name']?></td></tr>
		 <?php
		 }
			?>
     </td>
	</table>
	</table></td></tr>
</table>
</body>
</html>