<?php
session_start();
require_once("../db1.php");
$academic_year=$_SESSION['AcademicYear'];
//header("Refresh: 5");
?>
<HTML>
<HEAD>
<TITLE>Student List</TITLE>
<style type="text/css">
<!--
table.forumline
{ 
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	color: #68BBE1;
	//background-color: #fafafa;
	border: 1px  solid;
	border-collapse: collapse;
	border-spacing: 0px;
	margin-top: 0px;
}
table.body
{ 
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	//color: #404040;
	//background-color: #fafafa;
	border: 1px solid;
	background: url('../bgy.png') repeat-y;
	border-collapse: collapse;
	border-spacing: 0px;
	margin-top: 0px;
}
table
{ 
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	color: #404040;
	//background-color: #fafafa;
	//border: 1px #6699CC solid;
	border-collapse: collapse;
	border-spacing: 0px;
	margin-top: 0px;
}
/*table.tablesty	{ background-color:"#E5FAFA"; border: 2px #ffffff solid;font-size:12px;color:#ff0000; }*/
table.tablesty
{ 
	background-color:#ffffff; border: 2px #ffffff solid; 
	font-size:17px; color:#0A2756;
}
table.tablesty td
{ 
	font-size:12px;
	color:#0A2756;
	border: -1px solid; 
}


/* Main table cell colours and backgrounds */
td
{ 
	border-bottom: 0px dotted;  /*1px dotted*/
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;font-weight: normal;
	font-size: 12px;
	color: #404040;
	background-color: white;
	//text-align: left;
	padding-left: 3px;
}
td.nor
{
	background-color: #E5FAFA;font-size:12px;
	color:#0A2756;
	border: 1px #ffffff solid;font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	margin-left:12px;
	font-weight:normal;
}
td.norhead
{ 
	background-color: #E5FAFA;font-size:12px;color:#800000;
	border: 1px #ffffff solid;font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	margin-left:12px;
	font-weight:;
}
td.row2
{
	border-bottom: 2px solid ;
	background-color: #BEC8D1;
	font-weight:;
	text-align: center;
	background:#DFE0FC url('../bg4.png') repeat-x;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 12px;
	color: #404040; 
}
td.row3
{ 
	//background-color: #BEC8D1;
	font-weight:bold;
	background-image:url('../bg4.png');
	background-repeat:repeat-x,y;
	text-align: center;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 12px;
	//color: #404040;
}

/*
  This is for the table cell above the Topics, Post & Last posts on the index.php page
  By default this is the fading out gradiated silver background.
  However, you could replace this with a bitmap specific for each forum
*/
td.rowpic
{
	border-bottom: 0px solid ;
	background-color: #BEC8D1;
	//text-align: center;
	font-weight: bold;
	background:#DFE0FC url('../bg4.png') repeat-x;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	
	font-size: 12px;
	color: #404040;
}
td.back
{
	background-color: #F1E763;
	background-image: url(images/cellpic2.jpg);
	
	background-repeat: repeat-y;
}
/* Header cells - the blue and silver gradient backgrounds */
td.head1
{
	border-bottom: 2px solid #6699CC;
	background-color: #BEC8D1;
	//text-align: center;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;

	font-size: 12px;
	color: #404040;
}


td.head2
{
	border-bottom: 2px solid #6699CC;
	background-color: #BEC8D1;
	//text-align: center;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 12px;
	color: #404040;
}
td.head
{
	border-bottom: 1px solid #68BBE1;
	//font-weight:;
	//text-align: center;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	font-size: 14px;
	color: #000;
	background-image: url('../bg1.PNG');
	background-repeat:repeat-x,y;

}
/*************************************************************************************/
.head:hover{
    background-color : #68BBE1;/* BEC8D1*/
	color : #68BBE1; /*030B52*/
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
    font-size: 14px; font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;	
    background:#DFE0FC url('../bg6.png') repeat-x;
 }
/*************************************************************************************/
td.headc
{
	border-bottom: 2px solid #6699CC;
	background-color: #0066CC;
	background:#DFE0FC url('../bgc.png') repeat-x;
	font-family: "Segoe UI", Arial, Verdana, Helvetica, sans-serif;
	
	font-size: 14px;
	color: #FFFFFF;
}

-->
</style>
<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {

	setTimeout("location.reload(true);",timeoutPeriod);

}
-->
function OpenWind(k)
{

	var finalVar;

	finalVar=k;

	window.open(finalVar,'Stud','height=700,width=1000,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}
function printReport()
{

	prn.style.display="none";

	window.print();

}
</script>
</HEAD>
<BODY leftmargin=0 topmargin=0  onload="JavaScript:timedRefresh(50000);" class="td">
<form method="POST" name="frm">
<?php

$secnt=fetcharray(execute("select max(class_section_id) from student_m where archive='N'  and academic_year='$academic_year'"));

$secmax=$secnt[0];

?>
<table class='forumline' align='center' width='100%' border=1>
  <tr>

		<td Class="head"  align='center' colspan='<?php echo $secmax+3;?>'>Today's Student Attendance List</td>
	</tr>
	<tr height='30'><td align='center' class='row3'>Class</td>
	<td align='center' class='row3' colspan='<?php echo $secmax+1;?>' nowrap>
    <?php

    echo date("d-M-Y");
	
    ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    Section wise&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <?php

    echo date("l");

   	?>   

    </td></tr><tr><td>&nbsp;</td>

	<?php

	$secnt=execute("select * from class_section where id <= $secmax");

	$cntsec=rowcount($secnt);

	for($i=0;$i<$cntsec;$i++)

	{

		$r=fetcharray($secnt);
		
		?>

		<td nowrap align='center'><?=$r['section_name']?><br>
		<table width='100%'  border='0'  align='center' cellspacing='0' cellpadding='0'>
		  <tr>

			<td class='cls1' align='center'>P</td>
			<td class='cls1' align='center'>T

			</td>

		  </tr>

		</table>

		</td>
<?
	}
?>
	<td align='center'>Total<br>
	<table width='100%' border='0'  align='center' cellspacing='0' cellpadding='0'>
		  <tr>
			<td class='cls1' align='center'> P </td>
			<td class='cls1' align='center'> T </td>
		  </tr>
		</table></td></tr>
   <?

	$rsBR = execute("SELECT year_id,year_name FROM course_year where status=1 order by head_id,year_id");

	$countBR = rowcount($rsBR);

	$sno=1;

	$secttl[]=0;

	$gttl=0;

	$gmor1=0;

	$gnoon1=0;

	$ststemdate=date("Y-m-d");

	for($i=0;$i<$countBR;$i++)

	{

		if($sno<10)

			$sno="0".$sno;

		$rBR = fetcharray($rsBR);

		$rs3e=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and archive='N'  and academic_year='$academic_year'"));

		if($rs3e[0])

		{
			?>
			<tr >

			<td class='cls1' nowrap>&nbsp;&nbsp;<?=$rBR[1]?></td>
		<?
			$ttl=0;

			$ttm=0;

			$ttn=0;

			for($j=1;$j<=$cntsec;$j++)

			{

				$morningp[0]=0;

				$noonngp[0]=0;

				$rs=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and class_section_id='$j' and archive='N'  and academic_year='$academic_year'"));

				if($rs[0]>0)
				{
				

					$hedid=fetcharray(execute("SELECT head_id FROM course_year where year_id='$rBR[0]'"));

					$attandanceTablename="att_$rBR[0]";

					//echo "SELECT count(mor) FROM $attandanceTablename where att_date='$ststemdate' and mor='1' and sec='$j'<br>";

	$morningp=fetcharray(execute("SELECT count(mor) FROM $attandanceTablename where att_date='$ststemdate' and mor='1' and sec='$j'"));
	$noonngp=fetcharray(execute("SELECT count(after) FROM $attandanceTablename where att_date='$ststemdate' and after='1' and sec='$j'"));
  ?>
		<td align='center' class='cls1' nowrap>

	<table width='100%' align='center' border='0' cellspacing='0' cellpadding='0'>
	  <tr>
		<td class='cls1' width='33%'align='center'><?=$morningp[0]?></td>
		<td class='cls1' width='33%'align='center'>
		<a href="javascript:OpenWind('view_studlist_att.php?clid=<?=$rBR[0]?>&secid=<?=$j?>')"><?=$rs[0]?></a>
        </td>
	  </tr>

	</table>
		</td>
			<?php

				}

				else
				{
					?>
					    <td align='center'><?=$rs[0]?></td>
                    <?
				}

				$ttl+=$rs[0];

				$secttl[$j]+=$rs[0];

				$ttm+=$morningp[0];

				$ttn+=$noonngp[0];

			}

			if($ttl>0)
			{
			?>
			<td align='center' class='cls1'>
	<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0'>
	   <tr>
			<td width='33%'align='center' class='cls1'><?=$ttm?></td>
			<td width='33%'align='center' class='cls1'> 
				<a href="javascript:OpenWind('view_studlist_att.php?clid=<?=$rBR[0]?>&secid=a')"><?=$ttl?></a></td>
			  </tr>
			</table></td>
		<?php

			}

			else
			{
				?>
					<td align='center'><?=$ttl?></td>
               	<?
			}

			$gttl+=$ttl;

			$gmor1+=$ttm;

			$gnoon1+=$ttn;

			$sno++;

		}

	

	}
?>
	</tr>
	<tr height='30'><td align='right' colspan='<?php echo $secmax+1;?>'>Total&nbsp;&nbsp;</td>
    <?php
	if($gttl>0)
	{
		?>
		<td align='center'>
		<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0'>
		  <tr>
			<td width='33%'align='center'><?=$gmor1?></td>
			<td width='33%'align='center'>
			<a href="javascript:OpenWind('view_studlist_att.php?clid=a&secid=a')"><?=$gttl?></a></td>
		  </tr>
		</table></td>
		<?php

	}

	else
	{
	 ?>
		<td align='center'><?=$gttl?></td>
     <?
	 
	}
     ?>
	</tr>
</table><br>
<div id="prn" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="printReport()" ></div>
</form>
</body>
</html>