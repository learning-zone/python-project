<?php

include("../db1.php");

$gender=$_REQUEST['gender'];

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
<table  align="center" width="80%" border="1" cellpadding="0" cellspacing="0">
    
			<tr class="submenu">
            <td vAlign="top" align="Center" colspan=7 class=head>List Of Girls Taken To Hospital
            </td>
            <tr>
        <td align=center nowrap>&nbsp;Sl No</td>
		        <td align=center nowrap>&nbsp;Student Name</td>
                <td align=center nowrap>&nbsp;Class</td>
			<td align=center nowrap>&nbsp;Doctor Name</td>
			<td align=center nowrap>&nbsp;Treatment Date</td>
               <td align=center nowrap>&nbsp;Diagnosis</td>
		</tr>
		  <?php
		  $temp_sem=$semid;	
	 $sql3=execute("select year_name from course_year where year_id='$temp_sem'");

	$tempval=fetchrow($sql3);

	$disvalue=$tempval[0];
 $df=execute("select a.*,b.id,b.first_name,b.last_name,b.course_yearsem,c.stud_id from hospital_det a,student_m b,doc_detail c where c.stud_id=b.id and c.id=a.doc_detail_id and c.type='no' and b.gender='F' group by c.stud_id");
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
			<td align="center">&nbsp;<?php echo $$ddf[13]?></td>
            <td align="center">&nbsp;<?php echo $disvalue?> 
			<td align=center>&nbsp;<?php echo $ddf[1]?></td>
			<td align="center">&nbsp;<?php echo $ddf[2]?></td>
			<td align=center>&nbsp;<?php echo $ddf[5]?></td>
           
           
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
  