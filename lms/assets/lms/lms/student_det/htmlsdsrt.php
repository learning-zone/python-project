<html>
<head>
<title>Student strength report</title>
<?php
include("../db.php");
?>
<script language="JavaScript">
function printReport()
{
	prn.style.display="none";
	window.print(this.form);
	
}
</script>
</head>
<form name='frm' method='post'>
<table class='forumline' align='center'>
<tr><td colspan='20' class='head' align='center'><font size=3><b>VIDYAVARDHAKA COLLEGE OF ENGINEERING, MYSORE<br>BANGALORE - 78</b></font></td></tr>
<tr>
      <?php
	  $qry_ch = "select cname from coursehead where id = '$ctype'";
	  $res_ch = mysql_query($qry_ch);
	  $row_ch = mysql_fetch_assoc($res_ch);
	  ?>
      <td colspan='20' class='head' align='center'>STUDENT STRENGTH DURING THE 
        ACADEMIC YEAR <?=$gr?>-<?=$gr+1?>&nbsp; <?= $row_ch['cname'] ?>
        Courses </td>
    </tr>
<tr><td class='row3' rowspan=2>SLNO</td><td class='row3' rowspan=2>BRANCH</td>
<td class='row3' colspan='3' align='center' nowrap>I Year</td>
<td class='row3' colspan='3' align='center' nowrap>II year</td>
<td class='row3' colspan='3' align='center' nowrap>III year</td>
<td class='row3' colspan='3' align='center' nowrap>IV year</td>
<td class='row3' colspan='3' align='center' nowrap>V year</td>
<td class='row3' colspan='3' align='center' width='10%'>TOTAL</td></tr>
<tr><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td align='center' class='row3'>TTL</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td align='center' class='row3'>TTL</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td align='center' class='row3'>TTL</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td align='center' class='row3'>TTL</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td align='center' class='row3'>TTL</td><td class='row3' align='center'>M</td><td class='row3' align='center'>F</td><td class='row3' align='center'>TTL</td></tr>
<?
$wsd=0;
$rpo=0;
$s=1;
$dsg=execute("select a.* from course_m a ,coursehead b where a.head_id=b.id and b.cname = '$row_ch[cname]'");
while($ss=fetcharray($dsg))
{
	echo "<tr>";
	echo "<td align='center'>$s</td><td align='center'>$ss[course_abbr]</td>";
	
	$wert=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (course_yearsem=1 or course_yearsem=2 ) and  gender='M'"));
	$wert1=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (course_yearsem=2 or course_yearsem=2 ) and  gender='F'"));
	
	$wer=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (course_yearsem=3 or course_yearsem=4 ) and  gender='M'"));
	$wer1=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (course_yearsem=3 or course_yearsem=4) and  gender='F'"));
	$cor_tot=$wert[0]+$wer[0];
	echo "<td align='center'>$wert[0]</td><td align='center'>$wer[0]</td><td align='center'><font color=brown>$cor_tot</font></td>";
    $cor_tot1=$wert1[0]+$wer1[0];
	echo "<td align='center'>$wert1[0]</td><td align='center'>$wer1[0]</td><td align='center'><font color=brown>$cor_tot1</font></td>";

	$wert2=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (course_yearsem=5 or course_yearsem=6 ) and  gender='M'"));
	$wer2=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (course_yearsem=5 or course_yearsem=6 ) and  gender='F'"));
	
	$cor_tot2=$wert2[0]+$wer2[0];
	echo "<td align='center'>$wert2[0]</td><td align='center'>$wer2[0]</td><td align='center'><font color=brown>$cor_tot2</font></td>";

	$wert3=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (course_yearsem=7 or course_yearsem=8) and  gender='M'"));
	$wer3=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (course_yearsem=7 or course_yearsem=8 ) and  gender='F'"));
	
	$cor_tot3=$wert3[0]+$wer3[0];
	echo "<td align='center'>$wert3[0]</td><td align='center'>$wer3[0]</td><td align='center'><font color=brown>$cor_tot3</font></td>";

	if($ss[0]==13)
	{
		$wert4=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (course_yearsem=9 or course_yearsem=10) and  gender='M'"));
		$wer4=fetcharray(execute("select count(id) from student_m where course_admitted='$ss[course_id]' and (course_yearsem=9 or course_yearsem=10) and  gender='F'"));
	
		$cor_tot4=$wert4[0]+$wer4[0];
		$grd_tot4+=$wert4[0];
		$grd_totf4+=$wer4[0];
		$grd_tott4+=$cor_tot4;

		echo "<td align='center'>$wert4[0]</td><td align='center'>$wer4[0]</td><td align='center'><font color=brown>$cor_tot4</font></td>";
	}
	else
		echo "<td align='center'>---</td><td align='center'>---</td><td align='center'><font color=brown>---</font></td>";
	
	$net_totm=$wert[0]+$wert1[0]+$wert2[0]+$wert3[0]+$wert4[0];
	$net_totf=$wer[0]+$wer1[0]+$wer2[0]+$wer3[0]+$wer4[0];
	$net_tot=$net_totm+$net_totf;	

	echo "<td align='center'>$net_totm</td><td align='center'>$net_totf</td><td align='center'><font color=blue>$net_tot</font></td></tr>";

	$grd_tot+=$wert[0];
	$grd_totf+=$wer[0];
	$grd_tott+=$cor_tot;
	
	$grd_tot1+=$wert1[0];
	$grd_totf1+=$wer1[0];
	$grd_tott1+=$cor_tot1;

	$grd_tot2+=$wert2[0];
	$grd_totf2+=$wer2[0];
	$grd_tott2+=$cor_tot2;

	$grd_tot3+=$wert3[0];
	$grd_totf3+=$wer3[0];
	$grd_tott3+=$cor_tot3;
	
	$totm+=$net_totm;
	$totf+=$net_totf;
	$tot+=$net_tot;
	$s++;
}
?>
</tr>
<tr><td colspan='2'>GRAND TOTAL</td>
<td align='center'><?=$grd_tot?></td><td align='center'><?=$grd_totf?></td><td align='center'><font color='brown'><?=$grd_tott?></td>
<td align='center'><?=$grd_tot1?></td><td align='center'><?=$grd_totf1?></td><td align='center'><font color='brown'><?=$grd_tott1?></td>
<td align='center'><?=$grd_tot2?></td><td align='center'><?=$grd_totf2?></td><td align='center'><font color='brown'><?=$grd_tott2?></td>
<td align='center'><?=$grd_tot3?></td><td align='center'><?=$grd_totf3?></td><td align='center'><font color='brown'><?=$grd_tott3?></td>
<td align='center'><?=$grd_tot4?></td><td align='center'><?=$grd_totf4?></td><td align='center'><font color='brown'><?=$grd_tott4?></td>
<td align='center'><?=$totm?></td><td align='center'><?=$totf?></td><td align='center'><font color='brown'><?=$tot?></td>
</tr>
</table>
<br><div id='prn' align='center'>
<INPUT TYPE="button" class='bgbutton' NAME="print" VALUE="PRINT THE REPORT" onClick="printReport()"></div>
</form>
</html>