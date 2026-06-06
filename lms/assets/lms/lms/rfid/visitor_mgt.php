<?php
session_start();
include("../db.php");
$academic_year=$_SESSION['AcademicYear'];
$sql="select * from visitor_mgt where id is not null";
$rs=execute($sql);
?>
<html>
<head>
<script language="javascript" type="text/javascript">
function OpenWind2(k2)

{

	var finalVar ;

	finalVar=k2 ;

	window.open(finalVar,'Stud','width=1100,height=800,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}
</script>
</head>
<body>
<table border=1 class=forumline align=center cellspacing=0 cellpadding=0 width='90%'>
<tr height="25"><td class="submenu" colspan="8" nowrap>

<div id=123A style="float: center; text-align: center;"><b>Visitor details </b></div>

<div id=123B style="float: right; text-align: right;">

<a href="javascript:OpenWind2('visitor_mgt1.php')">

<input type="button" class="bgbutton" value="Add new visitor">

</a></div>
</td></tr>
<tr height='25'>
<td Class="rowpic" align='center'>Sl No</td>
<td Class="rowpic" align='center'>Appointment ID</td>
<td Class="rowpic" align='center'>Visitor Name </td>
<td Class="rowpic" align='center'>No Of Person</td>
<td Class="rowpic" align='center'>Expected IN Time</td>
<td Class="rowpic" align='center'>Expected OUT Time</td>
<td Class="rowpic" align='center'>Action</td>

</tr>
<?php
  $rowclass=1;
  $sno=1;
  for($i=0;$i<rowcount($rs);$i++)
  {
		$r=fetcharray($rs);
		if($sno<10)
		$sno="0".$sno;
		if($i%2)
		echo "	<tr class='clsname' > ";
		else
		echo "	<tr > ";
?>
<td align='center' ><?=$sno?></td>
<td align="center">&nbsp;&nbsp;<?=$r[id]?></td>
<td align="center">&nbsp;&nbsp;<?=$r[visitor_name]?>&nbsp;</td>
<td align="center">&nbsp;&nbsp;<?=$r[add_prsn]?>&nbsp;</td>
<td align="center">&nbsp;&nbsp;<?=$r[time_1]?>&nbsp;</td>
<td align="center">&nbsp;&nbsp;<?=$r[time_2]?>&nbsp;</td>
<td align="center" nowrap>
<a href="modify_visitor_mgt.php?id=<?php echo $r[id]?>&visitor_name=<?php echo $r[visitor_name]?>">
 <a href= "javascript:OpenWind2('modify_visitor_mgt.php?id=<?=$r[id]?>visitor_name=<?php echo $r[visitor_name]?>')"><input type="button" value="Modify" class="bgbutton"></a>
 <a href= "javascript:OpenWind2('personalise_visitor_mgt.php?id=<?=$r[0]?>')"><input type="button" value="Personalise" class="bgbutton"></a>

  </td>
</tr>

		<?php

		$sno++;

		$rowclass = 1 - $rowclass;

	}

?>

</table></body></html>