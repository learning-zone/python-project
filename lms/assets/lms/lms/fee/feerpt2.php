<html>
<head>
<?php
session_start();
include("../db.php");
$stud_id=$_REQUEST['stud_id'];
?>
<SCRIPT LANGUAGE="JavaScript">
function prnfee()
{
	prn.style.display = "none";
	window.print(this.form);
	prn.style.display = "";
}
</script>
</head>
<body>
<form name='frm' method='post'>
<?php
$rs=fetcharray(execute("select student_id,first_name,last_name,course_admitted,course_yearsem from student_m where id='$stud_id'"));
$rs1=fetcharray(execute("select course_abbr from course_m where course_id='$rs[course_admitted]'"));
$rs2=fetcharray(execute("select year_name from course_year where year_id='$rs[course_yearsem]'"));
$sql11=execute("select distinct(a.pid),a.sid,b.course_abbr,c.year_name from fee_master a,course_m b,course_year c where a.studid='$stud_id' and a.status=0 and a.pid=b.course_id and a.sid=c.year_id order by a.pid,a.sid");
if(rowcount($sql11)>0)
{
	?>
	<table class='forumline' border=1 align=center width="80%">
	<tr height="30"><td align=center class=head colspan=6><font size='3'>STUDENT WISE FEE REPORT</font></TD></TR>
	<tr height="25"><td align=center colspan=6><br><?=$_SESSION['branchname']?> : <?=$rs1[0]?> , <?=$_SESSION['semname']?> : <?=$rs2[0]?></td></tr>
	<tr height="25"><td align=center colspan=6><br>SR Number : <?=$rs[0]?> , Name : <?=$rs[1]?> <?=$rs[2]?></td></tr>
	<tr height="25"><td align=center>Sl.No</td><td align=center><?=$_SESSION['branchname']?> & <?=$_SESSION['semname']?></td><td align=center>Demanded Amount</td><td align=center>Paid Amount</td><td align=center>Concession</td><td align=center>Balance</td></tr>
	<?php
	$sno=1;
	while($r=fetcharray($sql11))
	{
		
		$sql=fetcharray(execute("select * from fee_master where studid='$stud_id' and status=0 and pid='$r[pid]' and sid='$r[sid]' "));
		$sql1=fetcharray(execute("select max(fee_id) from fee_type"));
		$rs1=fetcharray(execute("select course_abbr from course_m where course_id='$r[pid]'"));
		$rs2=fetcharray(execute("select year_name from course_year where year_id='$r[sid]'"));
		$cs=$rs1[0]." - ".$rs2[0];
		$dmdttl=0;
		$pdttl=0;
		for($i=1;$i<=$sql1[0];$i++)
		{
			$damt="dtfee".$i;
			$dmdamt=$sql[$damt];
			$pamt="ptfee".$i;
			$pdamt=$sql[$pamt];
			$dmdttl+=$dmdamt;
			$pdttl+=$pdamt;
		}
		if($sno<10)
			$sno="0".$sno;
		echo "<tr height='25'><td align='center'>$sno</td>";
		echo "<td>&nbsp;&nbsp;<a href='feerpt3.php?mid=$sql[0]'>$cs</a></td>";
		$amt=number_format($dmdttl,2);
		$amt1=number_format($pdttl,2);
		$amt2=number_format($sql[cenamt],2);
		$amt3=number_format(($dmdttl-$pdttl-$sql[cenamt]),2);
		$ttl1+=$dmdttl;
		$ttl2+=$pdttl;
		$ttl3+=$sql[cenamt];
		$ttl4+=$dmdttl-$pdttl-$sql[cenamt];
		echo "<td align='right'>$amt</td>";
		echo "<td align='right'>$amt1</td>";
		echo "<td align='right'>$amt2</td>";
		echo "<td align='right'>$amt3</td></tr>";
		$sno++;
	}
	
	
	
	
	?>
	<tr>
        <td align='right' colspan='2'>Total&nbsp;&nbsp;</td>
        <td align='right'><?=number_format($ttl1,2)?></td>
        <td align='right'><?=number_format($ttl2,2)?></td>
        <td align='right'><?=number_format($ttl3,2)?></td>
        <td align='right'><font color='red'><b><?=number_format($ttl4,2)?></b></font></td>
    </tr>
<?php
  $curstype='EUR';
?>
	<tr>
        <td align='right' colspan='2'>Euros&nbsp;&nbsp;</td>
        <td align='right'><?=calcCurrency1($ttl1,$curstype)?></td>
        <td align='right'><?=calcCurrency1($ttl2,$curstype)?></td>
        <td align='right'><?=calcCurrency1($ttl3,$curstype)?></td>
        <td align='right'><font color='red'><b><?=calcCurrency1($ttl4,$curstype)?></b></font></td>
    </tr>
<?php
  $curstype='GBP';
?>
	<tr>
        <td align='right' colspan='2'>Pounds&nbsp;&nbsp;</td>
        <td align='right'><?=calcCurrency1($ttl1,$curstype)?></td>
        <td align='right'><?=calcCurrency1($ttl2,$curstype)?></td>
        <td align='right'><?=calcCurrency1($ttl3,$curstype)?></td>
        <td align='right'><font color='red'><b><?=calcCurrency1($ttl4,$curstype)?></b></font></td>
    </tr>
<?php
  $curstype='USD';
?>

	<tr>
        <td align='right' colspan='2'>USD&nbsp;&nbsp;</td>
        <td align='right'><?=calcCurrency1($ttl1,$curstype)?></td>
        <td align='right'><?=calcCurrency1($ttl2,$curstype)?></td>
        <td align='right'><?=calcCurrency1($ttl3,$curstype)?></td>
        <td align='right'><font color='red'><b><?=calcCurrency1($ttl4,$curstype)?></b></font></td>
    </tr>



    </table><br>
	<div id="prn" align="center"><input type="button" name="prnfeest" value="PRINT" class="bgbutton" onClick="prnfee()"></div>
	<?php
}
else
	echo "This Student not paid the fee...";



//coversion code


function calcCurrency1($value,$curstype)
{
	$fromCurrency='INR';
	if($curstype=='GBP')
	{
		$toCurrency='GBP';
		$varnew=calcCurrency($value,$fromCurrency,$toCurrency,$round);
		echo $varnew[result];
	}
	elseif($curstype=='EUR')
	{
		$toCurrency='EUR';
		$varnew=calcCurrency($value,$fromCurrency,$toCurrency,$round);
		echo $varnew[result];
	}
	elseif($curstype=='USD')
	{
		$toCurrency='USD';
		$varnew=calcCurrency($value,$fromCurrency,$toCurrency,$round);
		echo $varnew[result];
	}
	else
	{
		echo $value;
	}

}


function calcCurrency($value,$fromCurrency,$toCurrency,$round)
{
    $timestamp = time();
    $fromCurrency = preg_replace('[^A-Z]', '', strtoupper(trim($fromCurrency)));
    $toCurrency = preg_replace('[^A-Z]', '', strtoupper(trim($toCurrency)));
    $round = (bool) $round;

    $wrongJSON = file_get_contents("http://www.google.com/ig/calculator?hl=en&q=1$fromCurrency=?$toCurrency");
    $search = array('lhs', 'rhs', 'error', 'icc');
    $replace = array('"lhs"', '"rhs"', '"error"', '"icc"');
    $json = str_replace($search, $replace, $wrongJSON);
    $jsonData = json_decode($json, true);
    if ('' !== $jsonData['error']) throw new Exception('FEHLER: '.$jsonData['error']);
    $rhs = explode(' ', $jsonData['rhs'], 2);

    $calcValue = floatval(0.00);
    $value = floatval($value);
    $ratio = floatval($rhs[0]);

    // Gültigkeitsprüfungen
    if ($value < 0) throw new Exception('Umzurechnender Wert darf nicht negativ sein.');

    // Plausibilitätsprüfung der eingestellten Währung und Festlegung
    if ($toCurrency == $fromCurrency) {
        // Ursprungswährung = Zielwährung | Es erfolgt keine Berechnung
        $calcValue = $value;
        $ratio = 1;
    } else {
        $calcValue = floatval($value * $ratio);
    }

    // Array mit Rückgabewerten erzeugen und zurück geben
    return array(
        'timestamp' => $timestamp,
        'datetime_iso' => date('Y-m-d H:i:s', $timestamp),
        'datetime_de' => date('d.m.Y H:i:s', $timestamp),
        'value' => $value,
        'from' => $fromCurrency,
        'to' => $toCurrency,
        'ratio' => round($ratio, 6),
        'result' => (true===$round)
            ? round($calcValue, 2)
            : $calcValue
    );
}























?>
</form>
</body>
</html>