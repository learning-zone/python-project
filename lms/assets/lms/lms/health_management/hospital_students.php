<?php
	session_start();
	include("../db.php");
	$studentid=$_REQUEST['studentid'];
	$adate=$_REQUEST['adate'];
	$bdate=$_REQUEST['bdate'];
	?>
    <html>
    <head>
    <script language="JavaScript">

		function prn()

		{

			pr1.style.display = "none";

			window.print();

		}

</script>
    </head>
    <body>
    <table  align="center" width="80%" border="1" cellpadding="0" cellspacing="0">
    
			<tr class="submenu">
            <td vAlign="top" align="Center" colspan=6 class=head>List Of Students Taken To Hospital
            </td>
            <tr>
        <td align=center nowrap>&nbsp;Sl No</td>
		        <td align=center nowrap>&nbsp;Student Name</td>
			<td align=center nowrap>&nbsp;Diagnosis</td>
			<td align=center nowrap>&nbsp;Time In</td>
			<td align=center nowrap>&nbsp;Time Out</td>
                	<td align=center nowrap>&nbsp;Place</td>
		</tr>
		  <?php
	
		/*$adate1 = explode('/',$adate);
		$adate=$adate1[2]."-".$adate1[1]."-".$adate1[0];
		$bdate1 = explode('/',$bdate);
		$bdate=$bdate1[2]."-".$bdate1[1]."-".$bdate1[0];*/
	
 $df=execute("select a.*,b.first_name,b.last_name,b.course_yearsem,b.id from doc_detail a,student_m b where a.d_date between '$adate' and '$bdate' and a.stud_id=b.id and a.type='no' group by a.stud_id");
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
			<td align="center">&nbsp;<?php echo $fd?></td>
			<td align=center>&nbsp;<?php echo $ddf[complaints]?></td>
			<td align="center">&nbsp;<?php echo $ddf[time]?></td>
			<td align=center>&nbsp;<?php echo $ddf[time_1]?></td>
            <td align="center">&nbsp;<?php echo $ddf[place]?></td>
           
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
  </body>
  </html>