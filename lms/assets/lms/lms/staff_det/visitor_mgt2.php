<?php

session_start();

include("../db.php");
if($_GET["page"]) //$_page
{ 
	$page  = $_GET["page"]; 
} 
else 
{ 
	$page=1; 
};
$start_from = ($page-1) * 10;
$sort_by = $_REQUEST['sort_by'];
$sort_type = $_REQUEST['sort_type'];

if($sort_by=="")
$sort_by="id";
	

if($sort_type=="")
$sort_type="DESC";

$academic_year=$_SESSION['AcademicYear'];
 $sql="SELECT * from visitor_mgt where id is not null order by $sort_by $sort_type LIMIT $start_from, 10";

//$sql="select * from visitor_mgt where id is not null order by id desc";

$rs=mysql_query($sql);



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



<td Class="rowpic" align='center'>Company From</td>

<td Class="rowpic" align='center'>No Of Person</td>

<td Class="rowpic" align='center'>Date</td>

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





<td align="center">&nbsp;&nbsp;<?=strtoupper($r[company_frm])?>&nbsp;</td>



<td align="center">&nbsp;&nbsp;<?=$r[add_prsn]?>&nbsp;</td>

<td align="center">&nbsp;&nbsp;<?=$r[d_date]?>&nbsp;</td>

<td align="center">&nbsp;&nbsp;<?=$r[time_2]?>&nbsp;</td>

<td align="center">&nbsp;&nbsp;<?=$r[time_1]?>&nbsp;</td>

<td align="center" nowrap>

<!--<a href="modify_visitor_mgt.php?id=<?php echo $r[id]?>&visitor_name=<?php echo $r[visitor_name]?>">-->

 <a href= "javascript:OpenWind2('modify_visitor_mgt.php?id=<?=$r[id]?>&visitor_name=<?=$r[visitor_name]?>')"><input type="button" value="Modify" class="bgbutton"></a>

 <a href= "javascript:OpenWind2('personalise_visitor_mgt.php?id=<?=$r[0]?>')"><input type="button" value="Personalise" class="bgbutton"></a>



  </td>

</tr>



		<?php



		$sno++;



		$rowclass = 1 - $rowclass;



	}



?>



</table>
<div>
	
<?php
//Pagination code
$tempsql=$sql;
	
	$tempsql1=explode("SELECT *", $tempsql);
	$tempsql2=explode(" LIMIT ", $tempsql1[1]);
	$tempsql1 = $tempsql2[0];
	$sql ="SELECT COUNT(id) ".$tempsql1;
	$rs_result = mysql_query($sql);
	$row = mysql_fetch_row($rs_result);
	$total_records = $row[0];
	$total_pages = ceil($total_records / 10);
	 
	echo "<p align='center'>";
	if($page==1)
		echo "First&nbsp;";
	else 
		echo "<a href='visitor_mgt2.php?page=1&sort_by=".$sort_by."&sort_type=".$sort_type."&company_frm=".$company_frm."&add_prsn=".$add_prsn."&d_date=".$d_date."&time_2=".$time_2."&time_1=".$time_1."' title='Click to go to last page..'> First </a> &nbsp;";
	$prv=$page-1;
	if($prv>0)
		echo "<a href='visitor_mgt2.php?page=".$prv."&sort_by=".$sort_by."&sort_type=".$sort_type."&company_frm=".$company_frm."&add_prsn=".$add_prsn."&d_date=".$d_date."&time_2=".$time_2."&time_1=".$time_1."' title='Click to go to last page..'> < </a> &nbsp;";
	else
		echo "<";
	echo "&nbsp;(Page $page of $total_pages)&nbsp;";
	$nxt=($page+1);	
	if($nxt<=$total_pages)
		echo "<a href='visitor_mgt2.php?page=".$nxt."&sort_by=".$sort_by."&sort_type=".$sort_type."&company_frm=".$company_frm."&add_prsn=".$add_prsn."&d_date=".$d_date."&time_2=".$time_2."&time_1=".$time_1."' title='Click to go to last page..'> > </a> &nbsp;";	
	else
		echo ">";
		
	if($page==$total_pages)
		echo "&nbsp;Last&nbsp;";
	else
		echo "<a href='visitor_mgt2.php?page=".$total_pages."&sort_by=".$sort_by."&sort_type=".$sort_type."&company_frm=".$company_frm."&add_prsn=".$add_prsn."&d_date=".$d_date."&time_2=".$time_2."&time_1=".$time_1."' title='Click to go to last page..'>Last</a> &nbsp;";
		
	echo "<BR>Total $total_records Record(s)</p>";
	
echo "</div>";

//echo "</tr>";
?>


</body></html>