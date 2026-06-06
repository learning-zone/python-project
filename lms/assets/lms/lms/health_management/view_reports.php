<html>
<?php
  include("../db.php");
  $grade = $_POST['grade'];
$dts = $_POST['dts'];
?>
<head>
<script>
function reload()
{
	
	document.frm.action='view_reports.php';
	document.frm.submit();
	
}
function vali()
{
	
	document.frm.action='view_other.php';
	document.frm.submit();
	
}

</script>
</head>	
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="File-List" href="SICK%20REPORT_files/filelist.xml">
<title>Sick Report</title>
</head>
<body>
<p>&nbsp;</p>
<form name='frm' method='POST' action='view_other.php'> 
<table align=center width='35%'>
<tr><td align=center colspan=2 class=head>View Other Sick Report</td></tr>
<tr><td width="29%" >&nbsp;Select Name</td>
<td width="71%"><select name='grade' onchange='reload()'>
<option value='0'>---Select---</option>
<?
$query=execute("select distinct(name) from doc_other");
$rc=rowcount($query);
for($i=0;$i<$rc;$i++)
{
        $rt=fetcharray($query,$i);
	if($grade==$rt[name])
      	{
                 echo("<option value='$rt[name]' selected>$rt[name]</option>");
	}
   else
	 {
	          echo("<option value='$rt[name]'>$rt[name]</option>");
	 }
		
}
?>
</select></td>
<tr><td >&nbsp;Select Date</td>
<td ><select name="dts" style="WIDTH: 185px" onchange='vali()'>
					<option value='0'>Select Date</option>
					<?php
					$dv=execute("select * from doc_other where name='$grade'");
					
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
</table><br>
</form>
</body>
</html>
