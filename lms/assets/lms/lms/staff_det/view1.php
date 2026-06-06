<?php
session_start();
include("../db.php");

$SQL="select * from staff_det where id='$id'";
$rsa = mysql_query($SQL);
$r = mysql_fetch_array($rsa);
$num = mysql_num_rows($rsa);

if($num == 0)
{
	echo "<div class='CBody'><b>The staff type was not found.</b></div>";
}


?>
<html>
<head>
<LINK rel="stylesheet" type="text/css" href="../mistStyle.css">
<script language="javascript">
function Print(){
	prn.style.display="none";
	window.print();
}
</script>
</head>
<body>
  <center>
  <table border="1" width='50%' height='80%' class=forumline>
    <tr>
    <td COLSPAN=5 ALIGN="CENTER"><font color="blue">
     PERSONAL DETAILS OF <?php echo $r["f_name"]?></b></td>
    </tr>
   
 <tr >
  <td><font color="brown">&nbsp Name </td>
  <td >&nbsp
         <?php echo $r["f_name"]?>
  </td></tr>
  <tr><td ><font color="brown">&nbsp Father</td> 
  
  <td >&nbsp
 	<?=$r["father"]?>
    </td>
 </tr>
 

 <tr>
	<?php
			$d2 = explode(" ",$r["dob"]);
			$temp_dob = explode("-",$r["dob"]);
			$act_dob = $temp_dob[2]."-".$temp_dob[1]."-".$temp_dob[0];
	?>

	
		<td width='25%'><font color="brown">&nbsp Date of Birth</td>

		<td width='25%' class="CBody">&nbsp <?=$act_dob;?></font>
		</td>
	</tr><tr >
		<td ><font color="brown">&nbsp Marital Status</td>
		<td >&nbsp <?=$r["ms"]?></font></td></tr>
		<!-- <tr>

	
			<td width='25%'>
			Husband/Wife Name</font>
		</td>
		<td width='25%' >
			<?php echo $r["husband"]?></font>
		</td>
	</tr> -->
	
	 <tr >
		
			<td ><font color="brown">&nbsp
				<b>Permanent Address</font></b>
			</td>
           	<td width='25%'  align='left'>&nbsp
				<?=$r["addr_perm"]?> <br>
				<?=$r["ct_perm"]?> - <?=$r["pin_perm"]?><br>
				<?=$r["st_perm"]?><br>
				</font>



	   </td>	
	   </tr>
	   
            <tr>
			<td ><font color="brown">&nbsp
				<b>Present Address</font></b>
			</td>        
		
			<td width='25%'  align='left'>&nbsp
				<?=$r["addr_perm"]?> <br>
				<?=$r["ct_perm"]?> - <?=$r["pin_perm"]?><br>
				<?=$r["st_perm"]?><br>
				</font>

		
			</td>
			
  </tr>
  
  <tr >
		<td><font color="brown">&nbsp;	
			email</font>
		</td>
		<td width='25%'>&nbsp;
			<?=$r["email"]?></font>
		</td></tr>

</table>
	<script language="JavaScript">
		function delete_me(id1)
			{
				if(confirm("Are you sure that you want to delete this record"))
					{
						document.frm2.delete_id.value = id1
						document.frm2.submit()
					}
			}
	</script>
	<form method="GET"  action="delete.php" name="frm2">
		<input type="hidden" name="delete_id">
	</form>
	<p align="left">&nbsp;</p>
<center>
<table>
	<form method="post" name="form1" id="form1">
		<div id="prn">
			<input type="button" class=bgbutton value="Print" onClick="Print()">
		</div>
	</form>
</table>
</center>
</BODY>
</HTML>
