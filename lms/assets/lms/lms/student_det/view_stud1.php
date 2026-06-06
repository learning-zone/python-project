<html>
<head>
<?php
session_start();
include("../db.php");
$per00=$_SESSION['per00'];
$user=$_SESSION['user'];
if($per00==1)
{
	echo "<font color='red'>This link will work only for student's an parent's </font> ";
	die();
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"> 

  <TITLE> New Document </TITLE>
  <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
  <script language="javascript"  src="../js/cal2.js"></script>
  <script language="javascript" src="../js/cal_conf2.js"></script>
  <script language="javascript">

function OpenWind2(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}

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

<br>
<?php
$mod="select * from student_m where student_id='$user'";
$mod1=mysql_query($mod);
$mod2=mysql_fetch_array($mod1);
?>
<table align='center' width='100%' class='forumline' border='0' >
<tr>
<td colspan="3" class="head" align="center">Welcome 
<?php echo $mod2[first_name]?>
</td></tr>
<tr><td width="28%" nowrap>&nbsp;&nbsp;Application Number</td>
		<td width="42%"><?php echo $mod2[admission_id]?></td>
		<td width="30%" rowspan='5'><img src="<?php echo $mod2[img_source]?>" width="100" height='100'> </td></tr>
		<tr><td nowrap>&nbsp;&nbsp;Admission Date</td>
        <?
		
        $var123 = explode('-',$mod2[admission_date]);
        $adate= $var123[2]."/".$var123[1]."/".$var123[0];
		$branch=$mod2['course_admitted'];
		$sem=$mod2['course_yearsem'];
		?>
		<td><?php echo $adate ?>
		</td></tr>
		<tr height="25">
		<td>&nbsp;&nbsp;Curriculam</td>
		<td>
		
			<?php
				$sql="select course_id,coursename from course_m";
				$rs=execute($sql) or die(error_description());
				for($i=0;$i<rowcount($rs);$i++)
				{
				  $r=mysql_fetch_array($rs);

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
		<td>&nbsp;&nbsp;Class </td>
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
							
							$mod2[academic_year];
							$fee_type=$mod2[admission_type];
							$qq="select id,name from admission where id='$fee_type'";
					        $qqq=mysql_query($qq) or die(error_description());
							for($i=0;$i<rowcount($qqq);$i++)
							  {
								$myq=mysql_fetch_array($qqq);
                                if($fee_type==$myq[id])
								 {
						?>
               <?php echo $myq[name] ?>
                <?php
								 }
							  }?></td>
	</tr></table>
<tr><td>
 <table border='0' align='center' width='100%' class='forumline'>
    <tr height="25"> 
      <td colspan=6><br><font color="blue" size="2"><u>Student Details :</u></font></td>
    </tr>
	<tr height="25">
    <td nowrap>&nbsp;&nbsp;Student Name </font></td>
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
		<td nowrap>&nbsp;&nbsp;Date of Birth</font></td>
		
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
					        $qqq=mysql_query($qq) or die(error_description());
							for($i=0;$i<rowcount($qqq);$i++)
							  {
								$myq=mysql_fetch_array($qqq);
                                if($mod2[mother_tongue]==$myq[id])
								 {
						?>
              <?php echo $myq[lang] ?>
                
                <?php
						         }
							  }
						?>
              </select> </td></tr>
     <tr height="15">
            <td nowrap>&nbsp;&nbsp;Birth Place Details  </td>
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
			   $res = mysql_query("select * from religion");
			   while($row = mysql_fetch_array($res))
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
			   $res = mysql_query("select * from nationality");
			   while($row = mysql_fetch_array($res))
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
			   $res = mysql_query("select * from category");
			   while($row = mysql_fetch_array($res))
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
  <tr><td> <table border='0' align='center' width='100%' class='forumline' >
<tr>
   <td colspan="4"><br><b><font color='blue' size="2"><u>Regular contact details </u></font>
   </b></td>
</tr>
<tr>
   <td>&nbsp;&nbsp;MSG Phone number</td>
   <td><?php echo $mod2['msgphone']; ?> </td>
   <td>Mail-Id</td>
   <td><?php echo $mod2['rgmailid']; ?></td>
</tr>
</table>
<br>
<?php include("../Calendar/classannouncementRep1.php"); ?>

</form>
</body>
</html>