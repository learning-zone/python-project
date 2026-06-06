<html>
<?php
	session_start();
	include("../db1.php");
	$branch=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$today = date('Y-m-d');
	$studentid =$_REQUEST['studentid'];
	
?>
<head>

<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>New Page 1</title>
</head>
<script>
function prn()

		{

			pr1.style.display = "none";

			window.print();

		}
</script>
<body>
<p>&nbsp;</p>
<form name='frm'>
<table  class='forumline' cellspacing=0 align=center width='100%'>
<tr><td align=center colspan=2  class=head><b><u>STUDENT MEDICAL INFORMATION</u></b></td></tr><br>
<tr height='35'><td align="left">&nbsp;&nbsp;<u>Date:&nbsp;&nbsp;<?=$today?></u></td></tr>
  <?php
					
					 $cr22=execute("select * from student_m where id='$studentid'");
					 $cr23=execute("select * from hospital_det where doc_detail_id='$cr22[id]'");
				   $rtt1=fetcharray($cr22);
				    $rtt2=fetcharray($cr23);
				   
				   	?>
<tr height='35'><td align="left">&nbsp;&nbsp;Student:&nbsp;&nbsp;<?=$rtt1[first_name]?>&nbsp;<?=$rtt1[last_name]?></td></tr>
<tr height='35'><td align="left">&nbsp;&nbsp;Birthdate:&nbsp;&nbsp;<?=$rtt1[dob]?></td><td>Blood Group:&nbsp;&nbsp;<?=$rtt1[blood_group]?></td></tr>
<tr height='35'><td align="left">&nbsp;&nbsp;Doctor:&nbsp;&nbsp;<?=$rtt2[doc_name]?></td><td >Hospital:&nbsp;&nbsp;<?=$rtt2[hospital_name]?></td></tr>
<tr height='35'><td align="left" nowrap><b><u>EMERGENCY CONTACT</u></b></td><td></td></tr>
 <tr>
     <td></td></tr>
     <?php
    $var2=fetcharray(execute("SELECT * FROM additional_info2 WHERE `student_id`='$studentid'"));
	?>
                            <tr>
                             <td class="keycell" >&nbsp;&nbsp;Name :&nbsp;&nbsp;					        
					       <?php echo $var2[emergency_name]?>
				                </td>
				               
                        <td class="keycell" >&nbsp;Address :&nbsp;&nbsp;				        
                       <?=$var2[emergency_address]?>
                            </td>
                            </tr>
                            <tr height='35'>
                            <td class="keycell" >&nbsp;&nbsp;Phone :				        
					        <?php echo $var2[emergency_phone]?>
				                </td>
                            </tr> 
                            <tr height='35'><td align="left" nowrap><b><u>MEDICAL INFORMATION</u></b></td><td></td></tr> 
                          <?php

					    

					     $xyz2=fetcharray(execute("SELECT * FROM doc_student WHERE `student_id`='$studentid'"));

					

					?>
                              <tr height='80'>
                             <td class="keycell" >&nbsp;&nbsp;Allergies :&nbsp;&nbsp;<?=$xyz2[additional_info1]?>				        
					   
				                </td>                            
				               
                             <td class="keycell" >&nbsp;Regular Medication :&nbsp;&nbsp;<?=$xyz2[additional_info2]?>					        
					   
				                </td>                            
				                </tr>
                                <tr height='80'>
                             <td class="keycell" >&nbsp;&nbsp;Operation Undergone  :&nbsp;&nbsp;<?=$xyz2[additional_info3]?>				        
					   
				                </td>                           
				                
                             <td class="keycell" >&nbsp;Immunization/Vaccination  :&nbsp;&nbsp;<?=$xyz2[additional_info4]?>				        
					   
				                </td>                           
				                </tr>
                                <tr height='80'>
                             <td class="keycell" >&nbsp;&nbsp;Anything Important To Know  :&nbsp;&nbsp;<?=$xyz2[additional_info5]?>				        
					   
				                </td>                           
				                </tr>
                               
                                

</table><br>
<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>

</div>
</form>
</body>
</html>
