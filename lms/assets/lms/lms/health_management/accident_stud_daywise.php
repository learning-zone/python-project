<html>
<?php
  include("../db1.php");
  if($_REQUEST)
  {
		/*$penal_day = $_REQUEST['penal_day'];
		$penal_month = $_REQUEST['penal_month'];
		$penal_year = $_REQUEST['penal_year'];
		
		$penal_days = $_REQUEST['penal_days'];
		$penal_months = $_REQUEST['penal_months'];
		$penal_years = $_REQUEST['penal_years'];
		
		$mtype = $_REQUEST['mtype'];
		$penal_from=$penal_year."-".$penal_month."-".$penal_day;
		$penal_to=$penal_years."-".$penal_months."-".$penal_days;*/
		$today = $_REQUEST['$today'];
		$today=date('Y-m-d');
		//echo $today;
  }
  if($_POST)
  {
		$mtype=$_POST['mtype'];
		$penal_to=$_POST['penal_to'];
		$penal_from=$_POST['penal_from'];
  
  }
?>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>Student details</title>
<script language="JavaScript">

		function prn()

		{

			pr1.style.display = "none";

			window.print();

		}

</script>
</head>
<body>
<form name='frm' method="POST" action='accident_stud_daywise.php'>
<input type='hidden' name='penal_day' value='<?php echo $penal_day?>'>
<input type='hidden' name='penal_month' value='<?php echo $penal_month?>'>
<input type='hidden' name='penal_year' value='<?php echo $penal_year?>'>
<input type='hidden' name='penal_days' value='<?php echo $penal_days?>'>
<input type='hidden' name='penal_months' value='<?php echo $penal_months?>'>
<input type='hidden' name='penal_years' value='<?php echo $penal_years?>'>
<input type='hidden' name='mtype' value='<?php echo $mtype?>'>
<input type='hidden' name='penal_from' value='<?php echo $penal_from?>'>
<input type='hidden' name='penal_to' value='<?php echo $penal_to?>'>

<table border='1'  width="90%" align='center' cellpadding="0" cellspacing="0"> 
		<tr><td colspan=10 align=center class=head>DAILY TREATMENT RECORD</td></tr>
		<tr class="submenu">
        <td align=center nowrap>&nbsp;Sl No</td>
         <td align=center nowrap>&nbsp;Date</td>
          <td align=center nowrap>&nbsp;Student ID</td>
		        <td align=center nowrap>&nbsp;Student Name</td>
			<td align=center nowrap>&nbsp;Time In</td>
			<td align=center nowrap>&nbsp;Time Out</td>
             	<td align=center nowrap>&nbsp;Diagnosis</td>
            <td align=center nowrap>&nbsp;Treatment Given</td>
           
                	<td align=center nowrap>&nbsp;Remarks</td>
                    
		</tr>
		<?php
		
			
			echo  $df=execute("select a.*,b.first_name,b.last_name,b.course_yearsem,b.student_id from doc_detail a,student_m b where a.d_date='$today' and a.stud_id=b.id group by a.stud_id");
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
        
        <td align=center>&nbsp;<?php echo $ddf[d_date]?></td>
        <td align=center>&nbsp;<?php echo $ddf[student_id]?></td>
			<td align="center">&nbsp;<?php echo $fd?></td>
		
			<td align="center">&nbsp;<?php echo $ddf[time]?></td>
			<td align=center>&nbsp;<?php echo $ddf[time_1]?></td>
            	
            <td align="center">&nbsp;<?php echo $ddf[treatment]?></td>
            <td align=center>&nbsp;<?php echo $ddf[complaints]?></td>
         <td align="center">&nbsp;<?php echo $ddf[place]?></td>
            <!--<td align="center">&nbsp;<?php echo $ddf[remarks]?></td>-->
		</tr>
		<?php
		 $SlNo = $SlNo + 1;
		   }
		?>
		
	</table>
    
</div>
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
FROM student_m b, accident_report a WHERE a.stud_id = b.id and a.d_date='$today'");
 
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
  
