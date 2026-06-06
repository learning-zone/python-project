<?php
   include("../db.php");
   $student_id=$_REQUEST['student_id'];
   $additional_info1 = $_POST['additional_info1'];
	$additional_info2 = $_POST['additional_info2'];
	$additional_info3 = $_POST['additional_info3'];
	$additional_info4 = $_POST['additional_info4'];
	$additional_info5 = $_POST['additional_info5'];
	$additional_info6 = $_POST['additional_info6'];
	$additional_info7 = $_POST['additional_info7'];
	$additional_info8 = $_POST['additional_info8'];
	$additional_info9 = $_POST['additional_info9'];
?>
<html>
<head>
<body>
 <form name="frm" method="post" action='additional_info.php'>
   <table class="formtable" width="80%" id="table2" align=center>
  
			<tr>
			<td vAlign="top" align="Center" height="30" colspan=5 class=head>
			Student Additional Details</td>
			
		</tr>
    <td>&nbsp;Name of the school last attended</td>
    <td>&nbsp;City / Country</td>
    <td>&nbsp;Type of curriculum</td>
    <td>&nbsp;Attended (To / From)</td>
    <td>Grade / Standard / Form / Year</td>
  </tr>
  <tr>
  <td class="keycell">				
  <input type=text name="txt1" value='<?php echo $fgb[txt1]?>'>
   </td>
   <td class="keycell">				
  <input type=text name="txt2" value='<?php echo $fgb[txt2]?>'>
   </td>
   <td class="keycell">				
  <input type=text name="txt3" value='<?php echo $fgb[txt3]?>'>
   </td>
   <td class="keycell">				
  <input type=text name="txt4" value='<?php echo $fgb[txt4]?>'>
   </td>
  	<td class="keycell">				
  <input type=text name="txt5" value='<?php echo $fgb[txt5]?>'>
   </td>	                
  </tr><br>
  
</tr>
</table>

 <table class="formtable" width="80%" id="table2" align=center>
 <tr></tr>
<tr>
<td colspan="4">1. Has the student received any special academic, social, emotional support. (ie. Speech, learning disability, counseling, etc.) and / or psycho educational testing.</td>
<td nowrap>&nbsp;&nbsp; <input type="radio" name="type1"  value="yes" <?=$check?>>Yes
         &nbsp;<input type="radio" name="type1"  value="no" <?=$check1?>>No</td>
         
</tr>
<tr>
<td  class="keycell" colspan="4">If yes what type of support has the student received ?</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info1'><?=$fgb[additional_info1]?></textarea> 

	</td>
    
    </tr>
    <tr>
<td colspan="4">2. Has the student ever repeated a grade level?</td>
<td nowrap>&nbsp;&nbsp; <input type="radio" name="type2"  value="yes" <?=$check?>>Yes
         &nbsp;<input type="radio" name="type2"  value="no" <?=$check1?>>No</td>
         
</tr>
<tr>
<td  class="keycell" colspan="4">If yes, please elaborate :</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info2'><?=$fgb[additional_info2]?></textarea> 

	</td>
   
    </tr>
     <tr>
<td colspan="4">3. Has the student been accelerated to a grade above age appropriate level?</td>
<td nowrap>&nbsp;&nbsp; <input type="radio" name="type3"  value="yes" <?=$check?>>Yes
         &nbsp;<input type="radio" name="type3"  value="no" <?=$check1?>>No</td>
         
</tr>
<tr>
<td  class="keycell" colspan="4">If so, at what age?</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info3'><?=$fgb[additional_info3]?></textarea> 

	</td>
    
    </tr>
    <tr>
<td colspan="4">4. Has the student ever been in an English as an additional language (EAL) programme?</td>
<td nowrap>&nbsp;&nbsp; <input type="radio" name="type4"  value="yes" <?=$check?>>Yes
         &nbsp;<input type="radio" name="type4"  value="no" <?=$check1?>>No</td>
</tr>
<tr>
<td  class="keycell" colspan="4">If yes, please elaborate:</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info4'><?=$fgb[additional_info4]?></textarea> 

	</td>
    </tr>
    <tr>
<td  class="keycell" colspan="4">5. Other comments to assist the teacher?</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info5'><?=$fgb[additional_info5]?></textarea> 

	</td>
    </tr>
   
   <tr>
<td  class="keycell" colspan="4">6. Name of the current school the student is studying at :</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info6'><?=$fgb[additional_info6]?></textarea> 

	</td>
    </tr>
     <tr>
<td  class="keycell" colspan="4">7. What curriculum is the student studying eg.: National curriculum, Bachillerato, Cambridge, IB etc.</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info7'><?=$fgb[additional_info7]?></textarea> 

	</td>
    </tr>
     <tr>
<td  class="keycell" colspan="4">8. Name and email id of the Head teacher of the current school</td>

	<td align="right">

		<textarea rows="4" cols="60" name='additional_info8'><?=$fgb[additional_info8]?></textarea> 

	</td>
    </tr>
    <tr>
      <td colspan="4"><b>EMERGENCY INFORMATION</b></td><td></td></tr>
     <tr vAlign="top" align="left">
					        <td class="keycell" nowrap colspan="4">&nbsp;Person to be contacted in an emergency if parents are not available</td><td></td></tr>
                            <tr>
                             <td class="keycell" colspan="4">&nbsp;Name :</td>
					        <td class="keycell">					        
					        <input type=text name="hospital_name" value='<?php echo $fgb[hospital_name]?>'>
				                </td>
				                </tr>
                 <tr vAlign="top" align="left">
                        <td class="keycell" colspan="4">&nbsp;Address :</td>
                        <td class="keycell">					        
                       <textarea rows="4" cols="60" name='additional_info9'><?=$fgb[additional_info9]?></textarea> 
                            </td>
                            </tr>  
	</table>
        <br>
        <center>	
		<div>
			
			<input type=submit name='save' value='Submit' class='bgbutton'>
			</div>
            </center>
	</form>

</body>

</html>
                           

