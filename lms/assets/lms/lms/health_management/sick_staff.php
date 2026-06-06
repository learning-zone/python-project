<html>
<?
   include("../db.php");
$staf = $_POST['staf'];
$stafd = $_POST['stafd'];
?>
<head>
<script language='Javascript'>
function cli()
{
   document.frm.action='sick_staff.php';
   document.frm.submit();
}
function reload()
{
   document.frm.action='sick_staffs.php';
   document.frm.submit();
}
</script>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>New Page 1</title>
</head>
<body>
<p>&nbsp;</p>
<form name='frm' method='post' action='sick_staffs.php'>
<table align=center width='35%'>
<tr><td align=center colspan=2 class=head>Staff Sick Report</td></tr>
<tr><td >&nbsp;Select Staff Group</td>
<td><select name="staf" onchange='cli()' style="width:100">
<option value='0'>---Select---</option>
<?php
$query=execute("select * from staff_group");
$rc=rowcount($query);
for($i=0;$i<$rc;$i++)
{
        $rt=fetcharray($query,$i);
		  if($staf==$rt[id])
      	        {
                     echo("<option value='$rt[0]' selected>$rt[1]</option>");
		}
		else
	        {
	             echo("<option value='$rt[0]'>$rt[1]</option>");
		}
		
}
?>
</select></td></tr>

<tr><td >&nbsp;Select Designation</td>
<td><select name="stafd" onchange='reload()' style="width:100">
<option value='0'>---Select---</option>
<?php
$querys=execute("select * from staff_des where group_id='$staf' order by d_name");
$rcs=rowcount($querys);
for($i=0;$i<$rcs;$i++)
{
        $rts=fetcharray($querys,$i);
		  if($stafd==$rts[id])
      	        {
                   echo("<option value='$rts[1]' selected>$rts[0]</option>");
		}
		 else
	       {
	            echo("<option value='$rts[1]'>$rts[0]</option>");
	       }
		
}
?>
</select></td></tr>
</table><br>
</body>
</html>

