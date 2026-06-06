<html>
<head>
<?php
session_start();
include("../db.php");

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


<?php
$StudID=$_REQUEST['StudID'];
$mod="select * from student_m where id='$StudID'";
$mod1=execute($mod);
$mod2=fetcharray($mod1);
?>
<table align='center' width='90%' class='forumline' border='2' >
<!--
<tr><td align='center' class='head'><?php echo collegename(); ?></td></tr>
<tr><td align='center' class='head' ><?php echo collegeadress(); ?></td></tr>
-->
<tr><td align='center' class='head'>STUDENT BIODATA </td></tr>

<tr><td><table width='100%' border='0' align='center'>
<tr><td colspan='4' class="submenu">Admission details </td></tr>
<tr><td nowrap>&nbsp;&nbsp;Application Number</td>
		<td><?php echo $mod2[admission_id]?></td>
		<td rowspan='4'><img src="<?php echo $mod2[img_source]?>" width="100" height='100'> </td></tr>
		<tr><td nowrap>&nbsp;&nbsp;Admission Date</td>
        <?
		
        $var123 = explode('-',$mod2[admission_date]);
        $adate= $var123[2]."/".$var123[1]."/".$var123[0];
		?>
		<td><?php echo $adate ?>
		</td></tr>
		<tr height="25">
		<td>&nbsp;&nbsp;<?php echo $_SESSION['branchname']; ?></td>
		<td>
		
			<?php
				$sql="select course_id,coursename from course_m";
				$rs=execute($sql) or die(error_description());
				for($i=0;$i<rowcount($rs);$i++)
				{
				  $r=fetcharray($rs);

					if($mod2[course_admitted]==$r[course_id])
					{
						?>
						 <?php echo $r[coursename] ?>
						<?php
					}
					
				}
			?>
		</select>
		</td>
		</tr>
		<tr>
		<td>&nbsp;&nbsp;<?php echo $_SESSION['semname']; ?></td>
        <td>
			<?php
				$rs=execute("SELECT year_name,year_id FROM course_year");
				while($r=fetcharray($rs))
				{
					if($mod2[course_yearsem]==$r[year_id])
					{
						echo  $r[year_name];
					}
					
				}
			?>
			

		</td>
	</tr>
<tr height="25">
 <td>&nbsp;&nbsp;Admission Category</td>

                
        
			 <td>
           
                <?php
							$qq="select id,name from admission";
					        $qqq=execute($qq) or die(error_description());
							for($i=0;$i<rowcount($qqq);$i++)
							  {
								$myq=fetcharray($qqq);
                                if($fee_type==$myq[id])
								 {
									 echo $myq['name'];
								 }
								
							  }
						?>
               </td>
	</tr></table>
<tr><td>
 <table border='0' align='center' width='100%' class='forumline'>
    <tr height="25"> 
      <td colspan=6 class="submenu">Student Details </td>
    </tr>
	<tr height="25">
    <td nowrap>&nbsp;&nbsp;Student Name </td>
    <td><?php echo $mod2[first_name]?></td>
      <td nowrap>&nbsp;&nbsp;Student ID</td>
		<td nowrap><?php echo $mod2[student_id]?></td>
	<td nowrap>&nbsp;&nbsp;Gender</td>
		<td>
		
			<?php
               if($mod2[gender]== "M")
                 {
	             $sj="Male";
	             $sk="";
                 }
               if($mod2[gender]== "F")
                 {
	           $sk="Female";
	           $sj="";
               }
			   ?>
			 <?php echo $sj?>
			 <?php echo $sk?>
		</td></tr>
		<td nowrap>&nbsp;&nbsp;Date of Birth</td>
		
		<?php
	            $str=explode("-",$mod2[dob]);
                $DobDay=$str[2];
                $DobMon=$str[1];
                $DobYear=$str[0];
				$dob1=$DobDay."-".$DobMon."-".$DobYear;
          ?>
         <td ><?php echo $dob1?></td>
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
	
	<td nowrap>&nbsp;&nbsp;Blood Group</td>
      <td > 
          <?php
                             if($mod2[blood_group]=="A+ve")
                                 {
	                               echo "A+ve";
			                     }
                             if($mod2[blood_group]=="B+ve")
                                 {
								   echo "B+ve";
                                  }
                             if($mod2[blood_group]=="A-ve")
                                 {
	                              echo "A-ve";
								 }
								 if($mod2[blood_group]=="B-ve")
                                 {
	                               echo "B-ve";
								 }
								 if($mod2[blood_group]=="O+ve")
                                 {
	                               echo "O+ve";
								 }
								 if($mod2[blood_group]=="O-ve")
                                 {
	                               echo "O-ve";
								 }
								 if($mod2[blood_group]=="AB+ve")
                                 {
	                               echo "AB+ve";
								 }
								 if($mod2[blood_group]=="AB-ve")
                                 {
	                               echo "AB-ve";
								 }

							?>
           </td>
  
	<td nowrap>&nbsp;Mother Tounge</td>
            <td>
                <?php
							$qq="select id,lang from language";
					        $qqq=execute($qq) or die(error_description());
							for($i=0;$i<rowcount($qqq);$i++)
							  {
								$myq=fetcharray($qqq);
                                if($mod2[mother_tongue]==$myq[id])
								 {
						?>
              <?php echo $myq[lang] ?>
                
                <?php
						         }
							  }
						?>
              </select> </td></tr>
     <tr height="15"><td nowrap>&nbsp;&nbsp;Birth Place Details </td>
            <td>Village/Town&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $mod2[place_of_birth]?></td>
			<td>&nbsp;&nbsp;District</td>
			<td><?php echo $mod2[birth_disct]?></td>
			<td>&nbsp;&nbsp;State</td>
			<td><?php echo $mod2[State]?></td></tr>  
    <tr height="25">
	    <td>&nbsp;&nbsp;KAR/NKR/FN</td>
              <td> 
                 
                  <?php
                             if($mod2[stud_type]=="KAR")
                                 {
	                              echo "KAR";
                                 }
                             if($mod2[stud_type]=="NKR")
                                 {
								  echo "NKR";
                                  }
                             if($mod2[stud_type]=="FN")
                                 {
	                               
	                               echo "FN";
								 }
							?>
                  </td>
      <td>&nbsp;&nbsp;Religion</td>
		<td>
			
			<?php
			   $res = execute("select * from religion");
			   while($row = fetcharray($res))
			   {
				   if($mod2[religion]==$row[id])
					{
						echo  $row[name];
					}
					
				   //echo "<option value='$row[id]'>$row[name]</option>";
			   }
			?>
			
		</td>
		 <td>&nbsp;&nbsp;Nationality</td>
      <td>
			<?php
			   $res = execute("select * from nationality");
			   while($row = fetcharray($res))
			   {
				   if($mod2[nationality]==$row[id])
					{
						echo $row[nation];
					}
				
				   //echo "<option value='$row[id]'>$row[nation]</option>";
			   }
			?></select> </td> 
		<tr height="25"> 
      	<td>&nbsp;&nbsp;Caste</td>
		<td><?php echo $mod2[caste_id]?></td>
	<td>&nbsp;&nbsp;Category</td>
		<td >
			
			<?php
			   $res = execute("select * from category");
			   while($row = fetcharray($res))
			   {
				   if($mod2[quota_id]==$row[id])
					{
						echo  $row[name];
					}
					
			   }
			?>
			</select>
		</td>
		<td nowrap>&nbsp;&nbsp;Other Languages Known</td>
			  <td><?=$mod2[lang_id]?>
        </tr>
	<tr height='10'>
			 
              <?
		
        $var123 = explode('-',$mod2[vdate]);
        $v_day= $var123[2];
		$v_month=$var123[1];
		$v_year=$var123[0];
		?>
      
	
  </table></td></tr>
  <tr><td>
<table border='0' align='center' width='100%' class='forumline'>
    <tr height="25">
		<td colspan=8 class="submenu">Parent/Guardian Details</td>
</tr>
<tr>
<td  colspan=1>Description</td>
<td  colspan=1>Father Details</td>
<td  colspan=1>Mother Details</td>
<td  colspan=1>Gaurdian Details
</td></tr>
 <tr>
	<td>&nbsp;&nbsp;Name</td>
	<td ><?php echo $mod2[parent_name]?></td>
	<td> <?php echo $mod2[m_name] ?></td>
	<td> <?php echo $mod2[g_name]?></td>
	</tr>
    <tr>
	<td>&nbsp;&nbsp;Occupation</td>
	<td ><?php echo $mod2[parent_occupation]?></td>
	<td ><?php echo $mod2[m_occ] ?></td>
	<td ><?php echo $mod2[g_occ]?></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;Annual Income</td>
	<td ><?php echo $mod2[parent_income]?></td>
	<td ><?php echo $mod2[m_inc]?></td>
	<td ><?php echo $mod2[g_in]?></td>
 </tr>
 <tr>
	<td>&nbsp;&nbsp;Mobile Number</td>
	<td ><?php echo $mod2[sms_mobile]?></td>
	<td ><?php echo $mod2[mnum]?></td>
	<td ><?php echo $mod2[g_num]?></td>
 </tr>
 <tr>
	<td>&nbsp;&nbsp;E-mail</td>
	<td ><?php echo $mod2[f_email]?></td>
	<td ><?php echo $mod2[m_email]?></td>
	<td ><?php echo $mod2[g_email]?></td>
 </tr>
 <tr>
<td >&nbsp;&nbsp;Educational Qualification</td>
<td ><?php echo $mod2[f_quali]?></td>	
<td ><?php echo $mod2[m_quali] ?></td>		
<td ><?php echo $mod2[g_quali] ?></td>			
		</tr>
		<tr>
<td >&nbsp;&nbsp;Office Address</td>
<td ><?php echo $mod2[foadd] ?></td>	
<td ><?php echo $mod2[moadd] ?></td>		
<td ><?php echo $mod2[goadd] ?></td>			
		</tr>
</table></td></tr>
<tr><td>
<table border='0' align='center' width='100%' class='forumline'>
	<tr height="25">
		<td width='50%'>Present Address </td>
		<td width='50%'>Permanent Address <br>
			</tr>
    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php echo $mod2[cor_address] ?></td>
		
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $mod2[per_address] ?>
      </td>
	</tr>
		<td><table border="0">
		<tr>
		<td>&nbsp;&nbsp;City/Town&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><?php echo $mod2[cor_city]?></td></tr>
			<tr>
			<td>&nbsp;&nbsp;State&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><?php echo $mod2[cor_state]?></td>
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
		<td><table border="0">
		<tr>
		<td>&nbsp;&nbsp;City/Town&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><?php echo $mod2[per_city]?></td>
			</tr>
			<tr>
			<td>&nbsp;&nbsp;State&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><?php echo $mod2[per_state]?></td>
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
		
</table></td></tr>
<tr><td>
<div id='prn' align='center'>
  <input class='bgbutton' type="button" value="PRINT" name="print" onClick="printReport()" >
</div>
<input type='hidden' name='s_name' value='<?php echo $fname ?>'>
</form>
</body>
</html>