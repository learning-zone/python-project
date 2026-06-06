<?php

include("../db1.php");

$gender=$_REQUEST['gender'];
$adate=$_REQUEST['adate'];
$bdate=$_REQUEST['bdate'];
$semid=$_REQUEST['semid'];

?>
<HTML>

<HEAD>

</HEAD>

<script language="JavaScript">

		function prn()

		{

			pr1.style.display = "none";

			window.print();

		}

</script>

<BODY>
<table  align="center" width="85%" border="1" cellpadding="0" cellspacing="0">
    
			<tr class="submenu">
            <td vAlign="top" align="Center" colspan=7 class=head>Daily Treatment Record
            </td>
            <tr>
       <td align=center nowrap>&nbsp;Sl No</td>
		        <td align=center nowrap>&nbsp;Student Name</td>
                <td align=center nowrap>&nbsp;Date</td>
                 <td align=center nowrap>&nbsp;Time In</td>
			<td align=center nowrap>&nbsp;Time Out</td>
			
			<!--<td align=center nowrap>&nbsp;Taken By</td>-->
               <td align=center nowrap>&nbsp;Diagnosis</td>
                <td align=center nowrap>&nbsp;Remarks</td>
		</tr>
		  <?php
		  $temp_sem=$semid;	
	 $sql3=execute("select year_name from course_year where year_id='$temp_sem'");

	$tempval=fetchrow($sql3);

	$disvalue=$tempval[0];
	
	
 $df=execute("SELECT a . * , b.id, b.first_name, b.last_name, b.course_yearsem FROM student_m b, doc_detail a WHERE a.stud_id = b.id AND b.gender = 'F' and a.d_date BETWEEN  '$adate' AND  '$bdate'");
 
			  $SlNo = 1;
		     while($ddf=fetcharray($df))
		       {
		         $mm=$ddf[adm_type];
			 $fd=$ddf[first_name]." ".$ddf[last_name];
			 $ecc=execute("select * from admission where id='$mm'");
			 $ec=fetcharray($ecc);
			 
		        
		?>
		<tr>
        <td width="11%" height="23" align='center' style=" font-size:12px"><?=$SlNo?></td>
			<td align="center">&nbsp;<?php echo $ddf[23]." ".$ddf[24]?></td>
            <td align="center">&nbsp;<?php echo $ddf[7]?> 
			<td align=center>&nbsp;<?php echo $ddf[12]?></td>
            <td align=center>&nbsp;<?php echo $ddf[13]?></td>
			<td align="center">&nbsp;<?php echo $ddf[9]?></td>
			<td align=center>&nbsp;<?php echo $ddf[10].$ddf[15]?></td>
           
           
		</tr>
		<?php
		 $SlNo = $SlNo + 1;
		   }
		?>
		
		
																											 
		<?php
	 // End of IF
?> 
  </table>
  <br>
<table  align="center" width="85%" border="1" cellpadding="0" cellspacing="0">
    
			<tr class="submenu">
            <td vAlign="top" align="Center" colspan=7 class=head>Accident Report Record
            </td>
            <tr>
        <td align=center nowrap>&nbsp;Sl No</td>
		        <td align=center nowrap>&nbsp;Student Name</td>
                <td align=center nowrap>&nbsp;Date</td>
                 <td align=center nowrap>&nbsp;Time In</td>
			<td align=center nowrap>&nbsp;Time Out</td>
			
			<!--<td align=center nowrap>&nbsp;Taken By</td>-->
               <td align=center nowrap>&nbsp;Diagnosis</td>
                <td align=center nowrap>&nbsp;Remarks</td>
		</tr>
		  <?php
		  $temp_sem=$semid;	
	 $sql3=execute("select year_name from course_year where year_id='$temp_sem'");

	$tempval=fetchrow($sql3);
	//echo "SELECT a . * , b.id, b.first_name, b.last_name, b.course_yearsemFROM student_m b, accident_report a WHERE a.stud_id = b.id AND b.gender = 'F' BETWEEN  '$adate' AND  '$bdate'";

	$disvalue=$tempval[0];
	
 $df=execute("SELECT a . * , b.id, b.first_name, b.last_name, b.course_yearsem
FROM student_m b, accident_report a WHERE a.stud_id = b.id AND b.gender = 'F' and a.d_date BETWEEN  '$adate' AND  '$bdate'");
 
			  $SlNo = 1;
		     while($ddf=fetcharray($df))
		       {
		         $mm=$ddf[adm_type];
			 $fd=$ddf[first_name]." ".$ddf[last_name];
			 $ecc=execute("select * from admission where id='$mm'");
			 $ec=fetcharray($ecc);
			 
		        
		?>
		<tr>
        <td width="11%" height="23" align='center' style=" font-size:12px"><?=$SlNo?></td>
			<td align="center">&nbsp;<?php echo $ddf[22]." ".$ddf[23]?></td>
            <td align="center">&nbsp;<?php echo $disvalue?> </td>
            	<td align=center>&nbsp;<?php echo $ddf[12]?></td>
            <td align=center>&nbsp;<?php echo $ddf[13]?></td>
			
			<td align="center">&nbsp;<?php echo $ddf[9]?></td>
			<td align=center>&nbsp;<?php echo $ddf[15]?></td>
           
           
		</tr>
		<?php
		 $SlNo = $SlNo + 1;
		   }
		?>
		
		
																											 
		<?php
	 // End of IF
?> 
  </table>
<br>

<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>

</div>

</form>

</BODY>

</HTML>
  