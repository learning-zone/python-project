<?php
	session_start();
	include("../db.php");
	$da = date("y");
	if($branch!=0 && $sem!=0)
	{
		$a = mysql_query("select student_id from student_m where course_admitted='$branch' and course_yearsem='$sem'") or die(mysql_error());
		$num = rowcount($a);
		$num1=$num+1;

			$qq=mysql_query("select intake from sanction_intake where course_id='$branch' and course_year_id='$sem'") or die(mysql_error());	
			$qqq=mysql_fetch_array($qq);
			if($qqq[intake]<$num1)
			{
				echo "<script language=javascript>";
				echo "alert('NO Seat For This Branch.Please Update Intake Details')";
				echo "</script>";
			}
	}
	?>
	
<HTML>
 <HEAD>
  <TITLE> New Document </TITLE> 
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript" src="../js/cal2.js"></script>
  <script language="javascript" src="../js/cal_conf2.js"></script>
  <script language="javascript" type="text/javascript">
	function ajaxFunction()
	{
		var ajaxRequest; 
		try
		{
			ajaxRequest = new XMLHttpRequest();
		} 
		catch (e)
		{
			try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} 
			catch (e) 
			{
				try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser broke!");
				return false;
			}
			}
		}

		ajaxRequest.onreadystatechange = function()
		{
			if(ajaxRequest.readyState == 4)
			{
				var ajaxDisplay = ajaxRequest.responseText;
				var studId = ajaxDisplay;
				
				document.frm.appl_num.value = studId;
				document.frm.adm_num.value = studId;
				document.frm.username.value = studId;
				document.frm.password.value = studId;
				document.frm.parent_username.value = "P" + studId;
				document.frm.parent_password.value = "P" + studId;
			}
		}

		var branch =  document.getElementById('branch').value;
		var sem = document.getElementById('sem').value;
		var a_year = document.getElementById('a_year').value;


		var queryString = "?branch=" + branch + "&sem=" + sem + "&a_year=" + a_year;
		ajaxRequest.open("POST","StudentID.php"+queryString,true);
		ajaxRequest.send(null);
		
	}
	
	
	function reload()
	{
		document.frm.action='SearchStudent.php';
		document.frm.submit();
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
			document.frm.per_phone.value   = document.frm. cor_phone.value;
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
		var markObt  = parseFloat(document.frm.mark_obt.value);
		
		var markMax  =  parseFloat(document.frm.mark_max.value);
		
		if(markObt<=markMax)
			{	
				var res1 = (markObt/markMax) * 100;

				document.frm.mark_total.value=markObt+'/'+markMax;
				document.frm.mark_res.value=res1+'%';
			}
			
	}
  </script>
 </HEAD>

 <BODY>
 
 <form name='frm' method='post' ENCTYPE="multipart/form-data" action='res.php'>
<table align='center' width='90%' border='0'>
<tr><td align='center'><font color=red size=3> Fields marked '*' are mandatory.Please fill them </font></td></tr>
</table>
<table border='0' align='center' width='90%' class='forumline'>
<?php
$sql=mysql_query("select Company_Name from company") or die("ERROR DESCRIPTION");
$mysql=mysql_fetch_row($sql)
?>
	<tr>
	<td align='center' class='head'><strong>&nbsp;&nbsp;<?php echo $mysql[0] ?></strong></td>
	</tr>
	
	<tr>
		<td align='center' class='head'><b>Application for admission </b></td>
	</tr>
</table>

<table class='forumline' align='center' width='90%' border='0'>
	<tr>
		<td width="25%">
			<table  border='0' align='left' width='100%'  height="100%">
          <tr> 
            <td align="center">Student Photo</td>
          </tr>
          <tr> 
            <td><input type='FILE' name='uploadedfile' value='<?php echo $photo ?>' size='15' ></td>
          </tr>
        </table>
	  </td>
		 <td>
		   	<table border='0' align='center' width='90%'  cellpadding="0" cellspacing="0">
          <tr> 
            
            <td align="right"> Fee Rec.No<font color='red'>*</font></td>
            <td><input type="text" name="rect_no" value="<?=$rect_no?>"></td>
        
            
            <td align="right">Rs.<font color='red'>*</font></td>
            <td><input type="text" name="rup" value="<?php echo $rup ?>"></td>
          </tr>
		  
          <tr>
        <td align="right" nowrap><br>Academic Year<font color='red'>*</font></td>
            <td> <select name="a_year" id="a_year" onchange='ajaxFunction()'>
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
		                            if($i==date('Y'))
			                            $sele="selected";
		                   ?>
                <option value="<?=$i?>" <?=$sele?>> 
                <?=$Fyear?>
                - 
                <?=$Tyear?>
                </option>
                <?php
								 }
						   ?>
              </select></td>
           
            <td>KAR/NKR/FN</td>
            <td><select name="stud_type">
    <option value="0">--------select-------</option>
    <?php
                             if($stud_type=="KAR")
                                 {
	                               $x="selected";
	                               $y="";
								   $z="";
                                 }
                             if($stud_type=="NKR")
                                 {
								   $x="";
	                               $y="selected";
	                               $z="";
                                  }
                             if($stud_type=="FN")
                                 {
	                               
	                               $x="";
								   $y="";
								   $z="selected";
								 }
							?>
    <option value="KAR" <?=$x?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KAR </option>
    <option value="NKR" <?=$y?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NKR </option>
    <option value="FN" <?=$z?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FN</option>
  </select>
  </td>
	</tr>
			  <tr>
            <td align='right' nowrap>Qual.Exam Passed</td>
            <td><input type="text" name="exam_pass" value="<?php echo $exam_pass?>"></td>
         
            <td nowrap><br>
            &nbsp;Fee Category<font color='red'>*</font></td>
            <td> <select name="fee_type">
                <option value="0">--------Select------- </option>
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
              </select> </td></tr>
			
        
  </table>
	  </td>
	</tr>
</table>
<br>		 
<table border='0' align='center' width='90%' class='forumline'>
	<tr height="25">
		<td> Admission Date<font color='red'>*</font></td>
		<td><input type="text" name="adate" value="<?php echo $adate?>">&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
		<td align='right'>Transportation&nbsp;</td>
		<td>
			Yes : <input type='radio' name='diploma' value='Y'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			No : <input type='radio' name='diploma' value='N' checked>

		</td>
	</tr>
	<tr height="25">
		<td width="20%">Curriculam<font color='red'>*</font></td>
		<td width="35%">
		<select name="branch" id="branch" onchange='ajaxFunction()'>
		<option value="0">---------------Select----------------</option>
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
		
		<td align="right" width="20%"> Class <font color='red'>*</font></td>
        <td>&nbsp;&nbsp;&nbsp;<select name="sem" id="sem" onchange='ajaxFunction()'>
			<option value='0'>----------Select---------</option>
			<?php
				$rs=mysql_query("SELECT year_name,year_id FROM course_year");
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
		<td>Apllication Number</td>
		<td><input name="appl_num" type="text" value="<?php echo $app_num ?>" size="34" readonly></td>
		<td align="right">Temporary ID</td>
		<td>&nbsp;&nbsp;&nbsp;<input type="text" name="adm_num" value="" size="24" readonly></td>
	</tr>	
</table>
<br>
  <table border='0' align='center' width='90%' class='forumline'>
    <tr height="25"> 
      <td colspan=7>&nbsp;&nbsp;<font color="blue" size="2"><u>Student Details:</u></font></td>
     
    </tr>
    <tr height="25"> 
      <td>Category<font color='red'>*</font></td>
      <td colspan='2'> <select name="cat">
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
      <td colspan="3">Marital Status<font color='red'>*</font>&nbsp;&nbsp;&nbsp;Yes : 
        <input type='radio' name='maritalstatus' value='Y'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        No : 
        <input type='radio' name='maritalstatus' value='N' checked></td>
    </tr><tr>
    <td>First Name<font color='red'>*</font></td>
    <td><input type="text" name="fname" value=""></td>
    <td>Last Name<font color='red'>*</font></td>
    <td><input type="text" name="lname" value=""></td>
    <td>Gender<font color='red'>*</font></td><td>
    <select name="gender">
      <option value="0">-------select--------</option>
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
      <option value="M" <?=$sj?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Male</option>
      <option value="F" <?=$sk?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Female</option></td></tr>
	  <tr height="25"><td>Date of Birth<font color='red'>*</font></td><td><select name="b_day">
      <option value='0'></option>
      <?php
	
				$j=date('d');
				for($i=1;$i<=31;$i++)
				{
	                $sel='';
					if($j==$i)
						$sel='selected'; 
						echo "<option value='$i' $sel >$i</option>";
			    }
				?>
    </select>
    <select name="b_month">
      <?php
				$j=date('m');
				for($i=1;$i<=12;$i++)
				{
					$sel='';
					if($j==$i)
                    $sel='selected';
					echo "<option value='$i' $sel >$i</option>";
				}
				?>
    </select>
    <select name="b_year">
      <?php
				$j=date('Y');
				$d=$j-30;
				for($i=$d;$i<=$j+1;$i++)
                    {
	                  $sel='';
	                  if($j==$i)
	                  $sel='selected';
	                  echo "<option value=$i $sel >$i</option>";
                    }
				?>
    </select></td>
    <td>Age as On 1st july<font color='red'>*</font></td>
    <td><input type="text" name="age" value="<?=$age?>"></td>
    <td>Nationality<font color='red'>*</font></td>
    <td><input type="text" name="nat" value="<?php echo $nat?>"> </td>
    </tr>
    <tr height="25"> 
      <td>Religion</td>
      <td> <select name="rel">
          <option value="0">---------select----------</option>
          <?php
			   $res = mysql_query("select * from religion");
			   while($row = mysql_fetch_array($res))
			   {
				   if($rel==$row[id])
					{
						echo "<option value='$row[id]' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $row[name]</option>";
					}
					else
					{
						echo "<option value='$row[id]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $row[name]</option>";
					}
				   //echo "<option value='$row[id]'>$row[name]</option>";
			   }
			?>
        </select> </td>
      <td>Caste</td>
      <td><input type="text" name="caste" value="<?php echo $caste_id?>"></td>
      <td>Blood Group</td>
      <td> <select name="b_group">
          <option value="0">-------select--------</option>
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
  </table>
<br>
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
	<td align='center'><input type="text" name="pname" value="<?php echo $pname?>" ></td>
	<td align='center'><input type="text" name="puc_state 	" value="<?php echo $puc_state ?>" ></td>
	<td align='center'><input type="text" name="g_name" value="<?php echo $g_name?>" ></td>
	</tr>
    <tr>
	<td>Occupation</td>
	<td align='center'><input type="text" name="p_occup" value="<?php echo $p_occup?>">
	</td><td align='center'><input type="text" name="obt_sub" value="<?php echo $obt_sub ?>" ></td>
	<td align='center'><input type="text" name="g_occ " value="<?php echo $g_occ?>" ></td>
</tr>
<tr>
	<td>Income</td>
	<td align='center'><input type="text" name="p_inc" value="<?php echo $p_inc?>"></td>
	<td align='center'><input type="text" name="f_email" value="<?php echo $f_email?>" ></td>
	<td align='center'><input type="text" name="g_in" value="<?php echo $g_in?>" ></td>
 </tr>
 <tr>
	<td>Mobile Number</td>
	<td align='center'><input type="text" name="mnum" value="<?php echo $mnum?>"></td>
	<td align='center'><input type="text" name="10_board" value="<?php echo $10_board?>" ></td>
	<td align='center'><input type="text" name="g_num" value="<?php echo $g_num?>" ></td>
 </tr>
 <tr>
	<td>E-mail</td>
	<td align='center'><input type="text" name="email" value="<?php echo $email?>"></td>
	<td align='center'><input type="text" name="f_email" value="<?php echo $f_email?>" ></td>
	<td align='center'><input type="text" name="g_mail" value="<?php echo $g_mail?>" ></td>
 </tr>
</table>
<br>
<table border='0' align='center' width='90%' class='forumline'>
	<tr height="25">
		<td><font color="blue" size="2"><u>Student Address:</u></font></td>
		<td><font color="blue" size="2"><u>Parent Address:</u></font></td>
		<td><font color="blue" size="2"><u>Guardian Address:</u></font></td>
	</tr>
	<tr>
		<td></td>
		<td>If Parent Address is same Student Address Click Here:<input type="checkbox" name="check" value="" onClick="getAddr(1)"></td>
		<td>If Parent Address is same Student Address Click Here:<input type="checkbox" name="check" value=""  onclick="getAddr(2)"></td>
		
	</tr>	
	<tr>
		
      <td>
        <textarea rows="3" cols="25" name='cor_addr' value="<?=$cor_addr?>"></textarea></td>
		
      <td>
        <textarea rows="3" cols="25" name='per_addr' value="<?=$per_addr?>"></textarea></td>
		
      <td>
<textarea rows="3" cols="25" name='loc_addr' value="<?=$loc_addr?>"></textarea>
        </p>
      </td>
	</tr>
	<tr>	
		<td>
		<!-- Student Address-->
		<table border="0">
		<tr>
			<td>State:</td><td><input type="text" name="cor_state" value="<?=$cor_state?>"></td>
		</tr>
		<tr>
			<td>Country:</td><td><input type="text" name="cor_country" value="<?=$cor_country?>"></td>
		</tr>
		<tr>
			<td>Pin Code:</td><td><input type="text" name="cor_pin" value="<?=$cor_pin?>"></td>
		</tr>
		<tr>
			<td nowrap>Phone Number:</td><td><input type="text" name="cor_phone" value="<?=$cor_phone?>"></td>			
		</tr>
		<tr>
			<td>Email-ID:</td><td><input type="text" name="cor_email" value="<?=$cor_email?>"></td>		
		</tr>
		</table>
		</td>
		<td>
		<!-- ends here -->
		<!-- parent address -->
		<table border="0">
		<tr>
			<td>State:</td><td><input type="text" name="per_state" value="<?=$per_state?>"></td>
		</tr>
		<tr>
			<td>Country:</td><td><input type="text" name="per_country" value="<?=$per_country?>""></td>
		</tr>
		<tr>
			<td>Pin Code:</td><td><input type="text" name="per_pin" value="<?=$per_pin?>""></td>
		</tr>
		<tr>
			<td>Phone Number:</td><td><input type="text" name="per_phone" value="<?=$per_phone?>""></td>			
		</tr>
		<tr>
			<td>Email-ID:</td><td><input type="text" name="per_email" value="<?=$per_email?>""></td>		
		</tr>
		</table>
		</td>
		<td>
		
		<table border="0">
		<tr>
			<td>State:</td><td><input type="text" name="loc_state" value="<?=$loc_state?>"></td>
		</tr>
		<tr>
			<td>Country:</td><td><input type="text" name="loc_country" value="<?=$loc_country?>"></td>
		</tr>
		<tr>
			<td>Pin Code:</td><td><input type="text" name="loc_pin" value="<?=$loc_pin?>"></td>
		</tr>
		<tr>
			<td>Phone Number:</td><td><input type="text" name="loc_phone" value="<?=$loc_phone?>"></td>			
		</tr>
		<tr>
			<td>Email-ID:</td><td><input type="text" name="loc_email" value="<?=$loc_email?>"></td>		
		</tr>

		</table>
		
      </td>
	</tr>	
</table>
<br>
<table border='0' align='center' width='90%' class='forumline'>
<tr>
	<td><font color="blue" size="2"><u>Previous Academic Details:</u></font></td>
</tr>
</table>
<table border='0' align='center' width='90%' class='forumline'>
	<tr height="25">
		<td nowrap>&nbsp;School Name</td>
	  <td nowrap>&nbsp;Subject-Name1<br></td>
		<td>&nbsp;Subject-Name2</td>
		<td align="center">Subject-Name3</td>
		<td>&nbsp;Subject-Name4</td>
		<td>&nbsp;Subject-Name5</td>
		<td>&nbsp;Subject-Name6</td>
	</tr>
	<tr height="80">
		<td>&nbsp;&nbsp;Marks</td>
		<td align="center"><input type="text" name="pu_board" value="<?php echo $pu_board?>" size="10"></td><!-- board name -->
		<td align="center"><input type="text" name="pu_pass" value="<?php echo $pu_pass?>" size="10"></td><!-- year passing-->
		<td>
		  <table border="0" width="100%">
	<td align="center"><input type="text" name="phy_max" value="<?php echo $phy_max?>"  size="10" onChange="getMark()"></td>

			</tr>
			
			
		  </table>	
		</td>
		<td align="center">
			<input type="text" name="tot_mark" value="<?php echo $tot_mark?>"  size="10" onChange="getMark()"><!-- total marks -->
		</td>
		<td align="center">
			<input type="text" name="result" value="<?php echo $result?>"  size="10" onChange="getMark()"><!-- result -->
		</td>
		<td align="center">
			<input type="text" name="remark" value="<?php echo $remark?>"  size="10" onChange="getMark()"><!-- remarks -->
		</td>
			
	</tr>
	
</table>
<br>
  
<table border='0' align='center' width='90%' class='forumline' >
<tr>
   <td><b><font color='blue' size="2"><u>Documents enclosed(Tick the relevent items)</u></font></b></td>
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
</td>
</tr>
</table>
<br>
<table border='0' align='center' width='90%' class='forumline' >
<tr>
   <td><b><font color='blue' size="2"><u>Extra Curricular Activites / Games etc.</u></font></b></td>
</tr>
<tr>
	<td>
		<textarea rows="5" cols="100" name='extra' value="<?=$extra?>"></textarea> 
	</td>
</tr>
</table>

<br>
<table class='forumline' align='center' width='90%' border="0">
<tr>
   <td colspan="4"><b><font color='blue' size="2"><u>Username & Password.</u></font></b></td>
</tr>
	<tr>
		<td><b>Student Username</b></td>   
		<td><input name='username' type='text' value="<?=$app_num?>" size='15' readonly="true"></td>
		<td><b>Student Password</b></td>
		<td><input name='password' type="text" value="<?=$app_num?>" size='15' readonly="true"></td>
	</tr>
	<tr>
		<td><b>Parent Username</b></td>
		<td><input name='parent_username' type='text' value="<?=$papp_num?>" size='15' readonly="true"></td>
		<td><b>Parent Password</b></td>
		<td><input name='parent_password' type="text" value="<?=$papp_num?>" size='15' readonly="true"></td>
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
