<html>
<?
  include("../db1.php");
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
?>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>New Page 1</title>
</head>
<body>
<p>&nbsp;</p>
<form name='frm' method="POST" action='accident_day_staff.php'>
<input type='hidden' name='penal_day' value='<?php echo $penal_day?>'>
<input type='hidden' name='penal_month' value='<?php echo $penal_month?>'>
<input type='hidden' name='penal_year' value='<?php echo $penal_year?>'>
<input type='hidden' name='penal_days' value='<?php echo $penal_days?>'>
<input type='hidden' name='penal_months' value='<?php echo $penal_months?>'>
<input type='hidden' name='penal_years' value='<?php echo $penal_years?>'>
<table border=1  width="75%" align=center cellpadding="0" cellspacing="0"> 
		<tr><td colspan=7 align=center  class=head>Staff Details</td></tr>
		<tr>
		         <td align=center nowrap>&nbsp;Sl No</td>
		        <td align=center nowrap>&nbsp;Staff Name</td>
			<td align=center nowrap>&nbsp;Diagnosis</td>
			<td align=center nowrap>&nbsp;Time In</td>
			<td align=center nowrap>&nbsp;Time Out</td>
            	<td align=center nowrap>&nbsp;Treatment Given</td>
                	<td align=center nowrap>&nbsp;Remarks</td>
		</tr>
		<?php
		     echo  $df=execute("select a.*,b.f_name,b.s_name from doc_staff a,staff_det b where a.group_id=b.group_id and a.des_id=b.type_id and a.d_date='$today' group by a.slno");
		       $SlNo = 1; 
		       while($ddf=fetcharray($df))
		       {
		         $vvv=$ddf['type_id'];
			 $ecc=execute("select * from staff_des where d_id='$ddf[des_id]'");
			 $ec=fetcharray($ecc);
			 $rf=execute("select * from staff_det where slno='$ddf[slno]'");
			 $rff=fetcharray($rf);
			 $m=$rff[f_name]." ".$rff[s_name];
			
		?>
		<tr>
        <td width="11%" height="23" align='center' style=" font-size:12px"><?=$SlNo?></td>
			<td align=center>&nbsp;<?php echo $m?></td>
			<td align=center>&nbsp;<?php echo $ddf[complaints]?></td>
			<td align=center>&nbsp;<?php echo $ddf[time]?></td>
			<td align=center>&nbsp;&nbsp;<?php echo $ddf[time_1]?></td>
            <td align=center>&nbsp;&nbsp;<?php echo $ddf[treatment]?></td>
            <td align=center>&nbsp;&nbsp;<?php echo $ddf[remarks]?></td>
			
		</tr>
		<?php
		$SlNo = $SlNo + 1;
		   }
		?>
		
	</table>
    <br>
  	<br>
    <table  align="center" width="75%" border="1">
    
			<tr class="submenu">
            <td vAlign="top" align="Center" colspan=6 class=head>List Of Staff Taken To Hospital
            </td>
            <tr>
        <td align=center nowrap>&nbsp;Sl No</td>
		        <td align=center nowrap>&nbsp;Staff Name</td>
			<td align=center nowrap>&nbsp;Diagnosis</td>
			<td align=center nowrap>&nbsp;Time In</td>
			<td align=center nowrap>&nbsp;Time Out</td>
                	<td align=center nowrap>&nbsp;Treatment</td>
		</tr>
		  <?php
	
 $df=execute("select a.*,b.f_name,b.s_name from doc_staff a,staff_det b where a.d_date='$today'  and a.staff_id=b.id and a.type='yes' group by a.staff_id");
			  $SlNo = 1;
		     while($ddf=fetcharray($df))
		       {
		         $mm=$ddf[adm_type];
			 $fd=$ddf[f_name]." ".$ddf[s_name];
			 $ecc=execute("select * from admission where id='$mm'");
			 $ec=fetcharray($ecc);
			 
		        
		?>
		<tr>
        <td width="11%" height="23" align='center' style=" font-size:12px"><?=$SlNo?></td>
			<td align="center">&nbsp;<?php echo $fd?></td>
			<td align=center>&nbsp;<?php echo $ddf[complaints]?></td>
			<td align="center">&nbsp;<?php echo $ddf[time]?></td>
			<td align=center>&nbsp;<?php echo $ddf[time_1]?></td>
            <td align="center">&nbsp;<?php echo $ddf[treatment]?></td>
           
		</tr>
		<?php
		 $SlNo = $SlNo + 1;
		   }
		?>
		
		
																								
  </table><br>
  <div id=pr1 align="center">
	<INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="Print" onclick='prn()'>
  </div>

</form>	
</body>
</html>

</div>
</form>
</body>
</html>
