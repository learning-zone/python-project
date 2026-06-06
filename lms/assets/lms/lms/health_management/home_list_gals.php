<?php

include("../db1.php");
$gender=$_REQUEST['gender'];
$semid=$_REQUEST['semid'];
$adate=$_REQUEST['adate'];
$bdate=$_REQUEST['bdate'];

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
            <td vAlign="top" align="Center" colspan=7 class=head>List Of Girls Sent Home</td>
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
	//echo "select a.id,a.sex from doc_detail a,accident_report b where a.sex='Female' and a.d_date BETWEEN '$adate' AND '$bdate' and a.type='yes' or b.type='yes'";
 $df=execute("select a.id,a.sex,a.stud_id from doc_detail a,accident_report b where a.sex='Female' and a.d_date BETWEEN '$adate' AND '$bdate' and a.type='yes' or b.type='yes'");
			  $SlNo = 1;
		     while($ddf=fetcharray($df))
		       {
		         $mm=$ddf[adm_type];
			 $fd=$ddf[first_name]." ".$ddf[last_name];
			 $ecc=execute("select * from admission where id='$mm'");
			 $ec=fetcharray($ecc);
			 $studnames=fetcharray(mysql_quer)
		        
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
  