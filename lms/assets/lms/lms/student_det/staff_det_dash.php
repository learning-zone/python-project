<?php
session_start();
require("../db1.php");
//header("Refresh: 5");

//$rutimes=date( "G:i",mktime(date("G")+5,date("i")+30,date("s"),date("d"),date("m"),date("Y")) );

$rutimes=date( "G:i");

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

<script language="javascript">function timedRefresh(timeoutPeriod) {

	setTimeout("location.reload(true);",timeoutPeriod);

}

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

$secnt=fetcharray(execute("select max(class_section_id) from student_m where archive='N'"));

$secmax=$secnt[0];

?>
<table class='forumline' align='center' width='100%' border=1>
	<tr>
		<td Class="head"  align='center' colspan='<?php echo $secmax+3;?>'>On Going Class</td>
	</tr>
	<tr height='30'><td align='center' class="row3">Class</td>
	<td align='center' class="row3" colspan='<?php echo $secmax+2;?>' nowrap>
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

		echo "<td align='center'>$r[section_name]

		

		</td>";

	}

	echo "</tr>";

	$rsBR = execute("SELECT year_id,year_name FROM course_year where status=1 order by head_id,year_id");

	$countBR = rowcount($rsBR);

	$sno=1;

	$secttl[]=0;

	$gttl=0;

	$ststemdate=date("Y-m-d");

	for($i=0;$i<$countBR;$i++)

	{

		if($sno<10)

			$sno="011".$sno;

		$rBR = fetcharray($rsBR);

		//kk

		$rs3e=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and archive='N'"));

		if($rs3e[0])

		{

			echo "<tr>";

			echo "<td nowrap>&nbsp;&nbsp;$rBR[1]</td>";

			$ttl=0;



			for($j=1;$j<=$cntsec;$j++)

			{


//echo "select count(id) from student_m where course_yearsem='$rBR[0]' and class_section_id='$j' and archive='N'";
				$rs=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and class_section_id='$j' and archive='N'"));

				if($rs[0]>0)

				{



					$sbsort='NIL';

					$description="NIL";

					$hedid=fetcharray(execute("SELECT head_id FROM course_year where year_id='$rBR[0]'"));

					$attandanceTablename="att_$hedid[0]_$rBR[0]";
//echo "SELECT nopd FROM classtime where pid='$rBR[0]'<br>";
				$prdtime=fetcharray(execute("SELECT nopd FROM classtime where pid='$rBR[0]'"));

				for($p=1;$p<=$prdtime[0];$p++)

				{
//echo "SELECT id , fmp$p , top$p , p$p  FROM classtime where pid='$rBR[0]'<br> ";
					$sq1=mysql_query("SELECT id , fmp$p , top$p , p$p  FROM classtime where pid='$rBR[0]' ");

					while($r5=mysql_fetch_array($sq1))

					{

						$fromtime=explode(":",$r5[1]);

						$totime=explode(":",$r5[2]);

						

						if($fromtime[0]!=12 and $r5[3]==1 and $fromtime[0]!=11)

							$newFromTime=($fromtime[0]+12).":".$fromtime[1];

						else

							$newFromTime=$fromtime[0].":".$fromtime[1];

							

						if($totime[0]!=12 and $r5[3]==1 and $totime[0]!=11)

							$newToTime=($totime[0]+12).":".$totime[1];

						else

							$newToTime=$totime[0].":".$totime[1];

							if(date("w")==0)

							$weekd=7;

							else

							$weekd=date("w");

//echo "if(($newFromTime<=$rutimes) and ($newToTime>$rutimes))<br>";
							if(($newFromTime<=$rutimes) and ($newToTime>$rutimes))
							{

//echo "select subjectcode, subname, hallno, staffname from timetable where sem_id='$rBR[0]' and sec_id='$j' and pid='$p' and  weekday='$weekd'<br>";

								$sql2=mysql_query("select subjectcode, subname, hallno, staffname,sub_id from timetable where sem_id='$rBR[0]'	and sec_id='$j' and pid='$p' and  weekday='$weekd'");

								while($r35=mysql_fetch_array($sql2))

								{

									$sbsort=$r35[0];

									$rdate=date("Y-m-d");

							

								$sql24=mysql_query("select description from teacher_lesson_plan where subj='$r35[4]' and  r_date='$rdate' and sec='$j'");

									while($r4=mysql_fetch_array($sql24))

									{

										$messa=" $r4[0]";										

									}		

									

									$description="Subject : $r35[1]

			Staff : $r35[3] , Lesson $messa";

								}

							}
							

							

					}

				}



							$morningp=fetcharray(execute("SELECT count(mor) FROM $attandanceTablename where att_date='$ststemdate' and mor='1' and sec='$j'"));

							$noonngp=fetcharray(execute("SELECT count(after) FROM $attandanceTablename where att_date='$ststemdate' and after='1' and sec='$j'"));

							echo "<td align='center' nowrap>";

							

				?>

			   <!-- <a href="javascript:OpenWind('view_studlist_att.php?clid=<?=$rBR[0]?>&secid=<?=$j?>')" title="<?=$description?>"><?=$sbsort?></a>-->

			   <a href="#" title="<?=$description?>" ><?=$sbsort?></a></td>



							<?php

						}

						else

							echo "<td align='center'>$rs[0]</td>";

						$ttl+=$rs[0];

						$secttl[$j]+=$rsf[0];

						

			}

			$gttl+=$ttl;

		

			$sno++;

		}

		//kkk

	

	}

	echo "</tr>";

	?>

	

</table><br>

<div id="prn" align='center'><input class='bgbutton' type="button" value=" Print " name="B1" onClick="printReport()" ></div>

</form>

</body>

</html>