<html>
<?
  include("../db.php");
  $staf=$_POST['staf'];
  $stafd=$_POST['stafd'];
  
  
$stud = $_POST['stud'];
$fn = $_POST['fn'];
$gen = $_POST['gen'];

$dts = $_POST['dts'];
  
?>
<head>
<script>
function reload()
{
	document.frm.action='daily_edit_staff_next.php';
	document.frm.submit();
}
</script>
<title>New Page 1</title>
</head>
<body>
<p>&nbsp;</p>
<form name='frm' method="POST" action='daily_edit_staff_next.php'>

		
<table border=1  align=center width="70%"> 
		<tr><td colspan=6 align=center class=head>Staff Details</td></tr>
		<tr>
		        <td align=center>&nbsp;Staff Name</td>
			<td align=center>&nbsp;Identification Number</td>
			<td align=center>&nbsp;Sex</td>
			<td align=center>&nbsp;Designation</td>
			<td align=center>&nbsp;Date</td>
		</tr>
		<?php
		       $df=execute("select * from doc_staff");
		       while($ddf=fetcharray($df))
		       {
				   
				   
		         $ecc=execute("select * from staff_des");
			 $ec=fetcharray($ecc);
			 
			 $mnv=execute("select * from staff_det where slno='$ddf[slno]' and active='YES'");
			 $vv=fetcharray($mnv);
			 $fname=$vv[f_name]." ".$vv[s_name];
			 
		   ?>
		<input type=hidden name='staf' value='<?php echo $ddf[group_id]?>'>
		<input type=hidden name='stafd' value='<?php echo $ddf[des_id]?>'>
		<input type=hidden name='stud' value='<?php echo $ddf[slno]?>'>
		<input type=hidden name='fn' value='<?php echo $fname?>'>
		<input type=hidden name='gen'value='<?php echo $ddf[sex]?>'>
        <input type=hidden name='staff_id' value='<?php echo $vv[id]?>'>
		
		<tr>
			<td >&nbsp;<?php echo $fname?></td>
			<td align=center>&nbsp;<?php echo $ddf[slno]?></td>
			<td >&nbsp;<?php echo $ddf[sex]?></td>
			<td >&nbsp;&nbsp;<b><?php echo $ec[d_name]?></td>
			<td align=center><select style="WIDTH: 185px" name="dts" onchange='reload()'>
					<option value='0'>Select Date</option>
					<?php
					$dv=execute("select * from doc_staff where slno='$ddf[slno]'");
					
					$rcp=rowcount($dv);
                                        for($i=0;$i<$rcp;$i++)
                    			{
						$dg=fetcharray($dv);
		 		                $dt=date('d-m-Y',strtotime($dg[d_date]));
						if($dts==$dg[d_date])
						{
					          echo("<option value='$dg[d_date]' selected>$dt</option>");
				                }
					    else
				               {
					         echo("<option value='$dg[d_date]'>$dt</option>");
				               }                                        
				        }
					
?>
</select></td>
			
		</tr>
		<?php
		   }
		?>
		
	</table>
</div>
</form>
</body>
</html>
