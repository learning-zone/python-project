<?php
	session_start();
	include("../db.php");

	$adate = $_POST['adate']; 
	$bdate = $_POST['bdate'];
	$user=$_SESSION['user'];

?>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
<script language="javascript">
function prn()
{
	pr1.style.display = "none";
	window.print();
}

function OpenWind3(k2)
{
	var finalVar ;
	finalVar=k2 ;
	window.open(finalVar,'Stud','width=700,height=550,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');
}
</script>
</head>
<body  >
<form name="frm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">								
<table width="50%" align="center">
<tr>
	<td colspan="2" class="head" align="center">Select Date Range
	</td>
</tr>
<tr>
	<td width="30%" align="right">
	Select From Date *
	</td>
	<td>&nbsp;&nbsp;<input type="text" name="adate" value="<?php if($adate==""){ $adate=date("d/m/Y"); } echo $adate?>" readonly>&nbsp;&nbsp;
	<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
	</td>
</tr>
<tr>
	<td width="30%" align="right">
	Select To Date *
	  </td>
		 <td>&nbsp;&nbsp;<input type="text" name="bdate" value="<?php if($bdate==""){ $bdate=date("d/m/Y"); } echo $bdate?>" readonly>&nbsp;&nbsp;
		  <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a>&nbsp;&nbsp;
	  </td>
	</tr>
	
</table>
<br>
<div align="center">
<input type="submit" name="search" value="Search" class="bgbutton"/>
</div>
<br>
		
	<table  align="center" width="80%" border="1">
    
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
	if($_POST['search'])
	{
		$adate1 = explode('/',$adate);
		$adate=$adate1[2]."-".$adate1[1]."-".$adate1[0];
		$bdate1 = explode('/',$bdate);
		$bdate=$bdate1[2]."-".$bdate1[1]."-".$bdate1[0];
	
 $df=execute("select a.*,b.f_name,b.s_name from doc_staff a,staff_det b where a.d_date between '$adate' and '$bdate' and a.staff_id=b.id and a.type='yes' group by a.staff_id");
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
		
		
																											 
		<?php
	} // End of IF
?> 
  </table><br>
  <div id=pr1 align="center">
	<INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="Print" onclick='prn()'>
  </div>

</form>	
</body>
</html>

