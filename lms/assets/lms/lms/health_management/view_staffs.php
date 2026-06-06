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
	
	document.frm.action='view_medical_staff.php';
	document.frm.submit();
	
}
</script>

<title>Staff Details</title>
</head>
<body>
<p>&nbsp;</p>
<form name='frm' method="POST" action='view_staffs.php'>
<input type=hidden name='staf' value='<?php echo $staf?>'>
<input type=hidden name='stafd' value='<?php echo $stafd?>'>
<table border=1 width="70%" align=center> 
		<tr><td colspan=6 align=center class=head>Staff Details</td></tr>
		<tr>
		        <td align=center>&nbsp;Staff Name</td>
			<td align=center nowrap>&nbsp;Identification Number</td>
			<td align=center>&nbsp;Sex</td>
			<td align=center>&nbsp;Designation</td>
			<td align=center>&nbsp;Date</td>
		</tr>
		<?php
		       $df=execute("select * from doc_staff where group_id='$staf' and des_id='$stafd' group by slno");
		       while($ddf=fetcharray($df))
		       {
		         
			 $ecc=execute("select * from staff_des where d_id='$stafd'");
			 $ec=fetcharray($ecc);
			 $st=execute("select * from staff_det where slno='$ddf[slno]' and active='YES'");
			 $stt=fetcharray($st);
			 $f=$stt[f_name]." ".$stt[s_name];
		?>
		<input type=hidden name='gen' value='<?php echo $ddf[sex]?>'>
		<input type=hidden name='stud' value='<?php echo $ddf[slno]?>'>
		<input type=hidden name='staf' value='<?php echo $ddf[group_id]?>'>
		<input type=hidden name='stafd' value='<?php echo $ddf[des_id]?>'>
		<input type=hidden name='fn' value='<?php echo $f?>'>

		<tr>
			<td >&nbsp;<?php echo $f?></td>
			<td align=LEFT>&nbsp;<?php echo $ddf[slno]?></td>
			<td>&nbsp;<?php echo $ddf[sex]?></td>
			<td>&nbsp;&nbsp;<?php echo $ec[d_name]?></td>
			<td align=center><select style="WIDTH: 185px" name="dts" onchange='reload()'>
					<option value='0'>Select Date</option>
					<?php
					$dv=execute("select * from doc_staff where group_id='$staf' and des_id='$stafd'");
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
