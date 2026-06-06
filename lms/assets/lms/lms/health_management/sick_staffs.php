<html>
<?
include("../db.php");
$staf=$_POST['staf'];
$stafd=$_POST['stafd'];  
$stud =$_POST['stud'];
$gen =$_POST['gen'];
$aa =$_POST['aa'];  
?>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>Staff Details</title>
</head>
<body>
<p>&nbsp;</p>
<form name='frm' method="POST" action='sick_staffs.php'>
<input type=hidden name='staf' value='<?php echo $staf?>'>
<input type=hidden name='stafd' value='<?php echo $stafd?>'>
<table  class='forumline' cellspacing=0 width="55%" align=center> 
		<tr><td colspan=6 align=center  class=head>Staff Details</td></tr>
		<tr>
		        <td align=center>Staff Name</td>
			<td align=center>Identification Number</td>
			<td align=center>Sex</td>
            <td align=center>Designation</td>
			
		</tr>
		<?php
		       $df=execute("select * from staff_det where active='YES'");
		       while($ddf=fetcharray($df))
		       {
		         $fn=$ddf[f_name]." ".$ddf[s_name];
		         $staff_id=$ddf['id'];
			 $ecc=execute("select * from staff_des where d_id='$stafd'");
			 $ec=fetcharray($ecc);
			 
			 if($ddf[gender]=='F')
			 {
			   $ss='Female';
			 }
			 else
			 {
			   $ss='Male';
			 }
		        
		?>
		<tr>
			<td >&nbsp;<?php echo $fn?></td>
			<td align=LEFT>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='staff_next.php?stud=<?php echo $fn?>&staff_id=<?php echo $staff_id?>&gen=<?php echo $ss?>&stafd=<?php echo $ddf[type_id]?>&aa=<?php echo $ddf[slno]?>&staf=<?php echo $ddf[group_id]?>'>
			<?php echo $ddf[slno]?></td>
			<td >&nbsp;<?php echo $ss?></td>
			<td >&nbsp;&nbsp;<b><?php echo $ec[d_name]?></td>
			
		</tr>
		<?php
		   }
		?>
		
	</table>
</div>
</form>
</body>
</html>
