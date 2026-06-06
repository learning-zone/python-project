<?php
	include("../db1.php");
	$txt1=$_POST['txt1'];
	$txt2=$_POST['txt2'];
	$txt3=$_POST['txt3'];
	$txt4=$_POST['txt4'];
	$txt5=$_POST['txt5'];
	$txt6=$_POST['txt6'];
	$txt7=$_POST['txt7'];
	$type1=$_POST['type1'];
	$type2=$_POST['type2'];
	$type3=$_POST['type3'];
	$type4=$_POST['type4'];
	$type5=$_POST['type5'];
	$additional_info1 = $_POST['additional_info1'];
	$additional_info2 = $_POST['additional_info2'];
	$additional_info3 = $_POST['additional_info3'];
	$additional_info4 = $_POST['additional_info4'];
	$additional_info5 = $_POST['additional_info5'];
	$additional_info6 = $_POST['additional_info6'];
	$additional_info7 = $_POST['additional_info7'];
	$additional_info8 = $_POST['additional_info8'];
	$additional_info9 = $_POST['additional_info9'];
	$additional_info10 = $_POST['additional_info10'];
	$additional_info11 = $_POST['additional_info11'];
 ?>
 <html>
 <head>
 <body>
 <form name="frm" method="post" action='recommendation_form.php'>
 <table class="formtable" width="70%" id="table2" align=center>
 
 <tr height="25">
		<td align="center" colspan="4"><b>Confidencial School Recomendation Form</b></td>
   </tr>
 
 
   <tr height="25">
     	<td nowrap>Name of the applicant<br/>(as in passport) *</td>
    <td><input type="text" name="fname" value="<?=$fname?>" size=40></td>
    
   <td nowrap>&nbsp;&nbsp;Date of Birth*</td><td nowrap><select name="b_day" onchange='reload()'>
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
    </tr>
  <tr height="25">
		<td width="15%">&nbsp;&nbsp;School Division *</td>
		<td width="35%">
		<select name="branch" id="branch" onchange='reload()'>
		<option value="0">-------- Select --------</option>
			<?php
				$sql="select course_id,coursename from course_m";
				$rs=execute($sql) or die(error_description());
				for($i=0;$i<rowcount($rs);$i++)
				{
				  $r=fetcharray($rs);

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
		
		<td width='15%'>&nbsp;&nbsp;Class  *</td>
        <td width='35%'><select name="sem" id="sem" onchange='reload()'>
			<option value='0'>----------Select---------</option>
			<?php
				$rs=execute("SELECT a.year_name,a.year_id FROM course_year a,course_m b where a.head_id=b.head_id and b.course_id='$branch'");
				while($r=fetcharray($rs))
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
    </table><br>
    <table class="formtable" width="70%" id="table2" align=center>
    <tr><td>
 To the Teacher : The above mentioned student is applying for admission to Mercedes-Benz International School, a college preparatory, English-language International School in Pune – India.
Your recommendation is helpful to our placement process. We appreciate the time you spend to complete this form. Your candid evaluation of the applicant will be of great value to the Admissions Committee.
All information shared is considered confidential and disclosed only to the Admission Committee and other schools personnel as deemed necessary by the Admission Office.
We request you to email the completed form to the School Admissions office at <b>info@mbis.org / priti.satpute@mbis.org</b>
   
 </td></tr>
 </table>
    
<table width="70%" border="1" align="center">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;Always</td>
    <td>&nbsp;Usually</td>
    <td>&nbsp;Occasionally</td>
    <td nowrap>&nbsp;Not Yet</td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Demonstrates responsibility for own learning</td>
    
     <?php
  if($row['gender']=='male')
  $check='checked';
  else
  $check1='checked';
  ?>
  
    <td align="center"> <input type="radio" name="type1"  value="" <?=$check?>></td>
    <td align="center"> <input type="radio" name="type1"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type1"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type1"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Focuses and maintains attention</td>
    <td align="center"><input type="radio" name="type2"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type2"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type2"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type2"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Completes tasks independently</td>
    <td align="center"><input type="radio" name="type3"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type3"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type3"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type3"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Communicates ideas clearly</td>
    <td align="center"><input type="radio" name="type4"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type4"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type4"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type4"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Displays a balanced temperament</td>
    <td align="center"><input type="radio" name="type5"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type5"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type5"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type5"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Is able to take part in group presentations</td>
    <td align="center"><input type="radio" name="type6"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type6"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type6"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type6"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Cooperates with others during group activities</td>
    <td align="center"><input type="radio" name="type7"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type7"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type7"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type7"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Can reflect on own learning experiences</td>
    <td align="center"><input type="radio" name="type8"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type8"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type8"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type8"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Has a sense of humour</td>
    <td align="center"><input type="radio" name="type9"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type9"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type9"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type9"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Demonstrates an age-appropriate reaction to criticism</td>
    <td align="center"><input type="radio" name="type10"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type10"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type10"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type10"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Displays self confidence</td>
    <td align="center"><input type="radio" name="type11"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type11"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type11"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type11"  value="" <?=$check3?>></td>
  </tr>
  <tr>
    <td nowrap>&nbsp;Shows concern for others</td>
    <td align="center"><input type="radio" name="type12"  value="" <?=$check?>></td>
    <td align="center"><input type="radio" name="type12"  value="" <?=$check1?>></td>
    <td align="center"><input type="radio" name="type12"  value="" <?=$check2?>></td>
    <td align="center"><input type="radio" name="type12"  value="" <?=$check3?>></td>
  </tr>
  </table>
 
 <table class="formtable" width="70%" id="table2" align=center>
<tr>
<td>1.How long have you known the student?</td>
<td colspan="2">&nbsp;&nbsp;&nbsp; <input type=text name="txt1" value='<?php echo $fgb[txt1]?>'></td>
</tr>
<tr>
<td>2.Are the parents supportive??</td>
<td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes
         &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td>
</tr>
<tr>
<td  class="keycell">Please provide comments :</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info1'><?=$fgb[additional_info1]?></textarea> 

	</td>
    </tr>
    <tr>
    <td nowrap colspan="2">3.Please describe the students performance in the following areas :</td>
    </tr>
    <tr>
    <td>Quality of work :</td>
<td align="right">

		<textarea rows="4" cols="60" name='additional_info2'><?=$fgb[additional_info2]?></textarea> 

	</td>
    </tr>
    <tr>
    <td>Peer interactions :</td>
<td align="right">

		<textarea rows="4" cols="60" name='additional_info3'><?=$fgb[additional_info3]?></textarea> 

	</td>
    </tr>
    <tr>
    <td>Faculty interactions :</td>
<td align="right">

		<textarea rows="4" cols="60" name='additional_info4'><?=$fgb[additional_info4]?></textarea> 

	</td>
    </tr>
    <tr>
    <td>4. Has the student ever received any academic, behavioral, or similar support within or outside of school?</td>
    <td nowrap>&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes
         &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>
    </tr>
   <tr>
<td  class="keycell">If yes, what type of support has the student received ?</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info5'><?=$fgb[additional_info5]?></textarea> 

	</td>
    </tr>
    <tr>
<td colspan="2">5.Has the student ever been supported by a special programme (i.e. : gifted and talented, learning difficulty, speech and/or language therapy, resource, behavioural, etc) or had any individualised testing (i.e. intelligence testing, writing, reading and math diagnostics and/or psycho-educational testing)?</td>

</tr>
<tr>
<td  class="keycell">If yes, what type of programme and/or testing has the student received or taken?</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info6'><?=$fgb[additional_info6]?></textarea> 

	</td>
    </tr>
    <tr>
    <td>6. Please add any additional comments that will help us to facilitate this student’s transition to MBIS.</td>
<td align="right">

		<textarea rows="4" cols="60" name='additional_info7'><?=$fgb[additional_info7]?></textarea> 

	</td>
    </tr>
    <tr>
    <td>7. Academic strengths and weaknesses :</td>
<td align="right">

		<textarea rows="4" cols="60" name='additional_info8'><?=$fgb[additional_info8]?></textarea> 

	</td>
    </tr>
    <tr>
<td>8. Does this student have grade-level appropriate English skills?</td>
<td nowrap>&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes
         &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>
</tr>
<tr>
<td>9. Is this student currently enrolled in an EAL (English as an Additional Language)/ESOL (English for Speakers of Other Languages) programme?</td>
<td nowrap>&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes
         &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>
</tr>
 <tr>
    <td>10. Did your school make any special accommodations for this student?
If yes, please explain in detail :</td>
<td align="right">

		<textarea rows="4" cols="60" name='additional_info9'><?=$fgb[additional_info9]?></textarea> 

	</td>
    </tr>
    <tr>
    <td>11. Has the student missed more than 10 days of school during any school year?</td>
<td nowrap>&nbsp; <input type="radio" name="type5"  value="yes" <?=$check?>>Yes
         &nbsp;<input type="radio" name="type5"  value="no" <?=$check1?>>No</td>
         </tr>
          <tr>
<td  class="keycell">If yes, please explain in detail :</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info10'><?=$fgb[additional_info10]?></textarea> 

	</td>
    </tr>
    <tr>
    <td colspan="2">I recommend this application for admission to MBIS :</td>
    </tr>
    <tr>
    <td valign='top' nowrap>
    <input type="checkbox" name="check1">&nbsp;with great enthusiasm</td>
      <td valign='top' nowrap>&nbsp;&nbsp;
    <input type="checkbox" name="check2">&nbsp;with confidence</td>
    </tr>
    <tr>
      <td valign='top' nowrap>
      
    <input type="checkbox" name="check3">&nbsp;with reservation</td>
      <td valign='top' nowrap>&nbsp;&nbsp;
    <input type="checkbox" name="check4">&nbsp;I do not recommend</td>
    </tr>
    <tr>
<td>Print Name</td>
<td colspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name="txt2" value='<?php echo $fgb[txt2]?>'></td>
</tr>
<tr>
<td>Professional Title :</td>
<td colspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name="txt3" value='<?php echo $fgb[txt3]?>'></td>
</tr>
<tr>
<td>School Name :</td>
<td colspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name="txt4" value='<?php echo $fgb[txt4]?>'></td>
</tr>
<tr>
<td>School Phone No. :</td>
<td colspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name="txt5" value='<?php echo $fgb[txt5]?>'></td>
</tr>
<tr>
<td>Evaluators Signature :</td>
<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name="txt6" value='<?php echo $fgb[txt6]?>'></td>
</tr>
<tr>
<td>Date (mm/dd/yy)</td>
<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;<select name="b_day" onchange='frm_reload()'>

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

    <select name="b_month" onchange='frm_reload()'>

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

    <select name="b_year" onchange='frm_reload()'>

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
</tr>
<tr>
<td>Email address</td>
<td colspan="2"> &nbsp;&nbsp;&nbsp;&nbsp;<input type=text name="txt7" value='<?php echo $fgb[txt7]?>'></td>
</tr>
<tr>
<td  class="keycell">Comments<br> (please feel free to add any comments) :</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info11'><?=$fgb[additional_info11]?></textarea> 

	</td>
    </tr>
    
      
    
    

 
 
 
 
 
 
    </table>
 </form>
 </body>
 </head>
 </html>