<html>
<head>
<?php
session_start();
include("../db.php");
$per00=$_SESSION['per00'];
$user=$_SESSION['user'];
if($per00==1)
{
	echo "This link will work only for student's an parent's  ";
	die();
}

$mod="select * from student_m where student_id='$user'";
$mod1=execute($mod);
$mod2=fetcharray($mod1);
	$stuid=$mod2[3];
	$stuname=$mod2['first_name'];
	$branch=$mod2['course_admitted'];
	$sem=$mod2['course_yearsem'];
	
	$studentid=$mod2[0];
	$class_section_id=$mod2['class_section_id'];
	$stundetname=$mod2['first_name'];
	$admissionid=$mod2[1];
	$student_id=$mod2[3];
	if(date("m")>5)
	$accyear=date("Y");
	else
	$accyear=date("Y")-1;
	$rs_ec=fetchrow(execute("select id from exam_m where accyear='$accyear' and curriculam='$branch' and class='$sem' order by id desc limit 1"));
	$examid=$rs_ec[0];
?>
<script LANGUAGE="JavaScript">
function setPageBreak()
{
document.getElementById("footer").style.pageBreakAfter="always";
}
function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
</script>
</head>
<body>
<?php
		$sqlt=execute("select * from college");
		while($r=fetcharray($sqlt))
		{
			
			$col_name=$r[col_name];
			$col_code=$r[col_code];
			$col_addr=$r[col_addr];
			$col_pin=$r[col_pin];
			$col_phone=$r[col_phone];
			$col_fax=$r[col_fax];
			$email=$r[email];
		}
if(!$check)
{
	
$sql111=execute("SELECT posi FROM exam_topers WHERE exam_id='$examid' and stud_id='$studentid'");
if(rowcount($sql111)>0)
{
?>
<br><br><br><br><br><br><div align="center"  >
    <h3>
      <?php $examnamed1=fetchrow(execute("SELECT descr FROM exam_m where id='$examid'")); 
	echo $examnamed1[0];
	?>
    </h3>
</div>

<table align='center' width="100%" border="3" cellspacing="0" cellpadding="0">
<tr><td>
  <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr height="25">
  <td align="right">Date : <?php echo date('d-m-Y'); ?>&nbsp;&nbsp;</td>
  </tr></table><table align="center" width="96%" border="1" cellspacing="0" cellpadding="0">
  
  <tr height='25'>
    <td width="34%"><strong>&nbsp;&nbsp;Name : <?php echo $stuname ?></strong></td>
    <td width="20%"><strong>&nbsp;&nbsp;Admn No :&nbsp;<?php echo $admissionid ?></strong></td>
    <td width="21%"><strong>&nbsp;&nbsp;
      <?php 
	$claname=fetchrow(execute("SELECT year_name FROM course_year where year_id='$sem'")); 
	echo $claname[0]."&nbsp;/&nbsp;";
	$secid=fetchrow(execute("SELECT section_name FROM class_section where id='$class_section_id'")); 
	echo $secid[0]; ?>
    </strong></td>
    <td width="24%"><strong>&nbsp;&nbsp;ROLL No. <?php echo $stuid ?></strong></td>
  </tr>
</table>

  <BR>
    <table  align="center"  width="96%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%">
        <table  width="98%" border="1" cellspacing="0" cellpadding="0">
          <tr height="30">
            <td nowrap align="center"><font style="font-size:9px">SUBJECT</font></td>
            <td align="center"><font style="font-size:9px">MAX MARKS</font></td>
            <td align="center"><font style="font-size:9px">SCORED MARKS</font></td>
            <td align="center"><font style="font-size:9px">SUBJ. GRADE</font></td>
            <td align="center"><font style="font-size:9px">SUBJ. TOPPER</font></td>
            <td align="center"><font style="font-size:9px">SUBJ. POSITION</font></td>
          </tr>
          <?php
	$rs_ec=execute("select * from exam_m where id='$examid'");
while($r1=fetcharray($rs_ec))
{
	$subid=explode(',',$r1['sub_id']);
	$mmks=explode(',',$r1['max_mark']);
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
	$max_mark=$r1['max_mark'];
}
$assmk='a.assmk'.$exam_count;
$assmk1='assmk'.$exam_count;
$ba="a.ba".$exam_count;
$totalmark=0;
$scormark=0;
if(sizeof($subid)<11)
$arrsize=10;
else
$arrsize=sizeof($subid);

for($i=0;$i<=$arrsize;$i++)
{
	$tablename="marks_".$branch."_".$sem;	
	$markqury=execute("select $assmk,b.subject_name,$ba from $tablename a, subject_m b where a.studid='$studentid' and a.subid='$subid[$i]' and b.subject_id=a.subid");
	if(rowcount($markqury)==0)
	{
		echo "<tr height='20'>
			<td nowrap>&nbsp;</td>
            <td align='center'>&nbsp;</td>
            <td align='center'>&nbsp;</td>
            <td align='center'>&nbsp;</td>
            <td align='center'>&nbsp;</td>
            <td align='center'>&nbsp;</td>
          </tr>";	
	}
	else
	{
		$markqury1=execute("select sub_type from subject_m  where subject_id='$subid[$i]'");
		$name=fetchrow($markqury1);
		while($mark=fetcharray($markqury))
		{
		$markqury12=execute("select max($assmk) from $tablename a where subid='$subid[$i]' and accyr='$accyear' ");
		$maxmarkt=fetchrow($markqury12);
	
		if($name[0]<3)
			echo "<tr height='20'><td nowrap>&nbsp;&nbsp;$mark[1]</td>";
		else
			echo "<tr height='20'><td nowrap>&nbsp;&nbsp;$mark[1] #</td>";
		echo "<td align='center'>$mmks[$i]</td>";
		if($mark[0]>0)
		{
			$per=$mark[0]*100/$mmks[$i];
			if($per<35)
			{
				if($name[0]<3)
					$ovrflg="Fail";
				echo "<td align='center'>$mark[0] *</td>";
			}	
			else
				echo "<td align='center'>$mark[0]</td>";
		}
		else
		{
			$per=0;
			if($name[0]<3)
			{
				if($ovrflg!='Fail')
					$ovrflg='Ab';
			}
			echo "<td align='center'>Ab</td>";
		}
		$markqury13=execute("select name from grade where g_from<='$per' and g_to>='$per' ");
		$maxmark3=fetchrow($markqury13);
         echo "<td align='center'>$maxmark3[0]</td>
            <td align='center'>$maxmarkt[0]</td>
            <td align='center'>$mark[2]</td>
          </tr>";
		  if($name[0]<3)
			{
				$marktotal=$marktotal+$mmks[$i];
				$scormark=$scormark+$mark[0];
			}
		}
		
	}
}
		$sql6=execute("SELECT posi FROM exam_topers WHERE exam_id='$examid' and stud_id='$studentid'");
		$stposi=fetchrow($sql6);
		$sql7=execute("SELECT count(posi) FROM exam_topers WHERE exam_id='$examid' and sec_id='$class_section_id'");
		$maxposi=fetchrow($sql7);
		?>
            
          <tr height='30'>
            <td>&nbsp;TOTAL</td>
            <td align="center">&nbsp;<?php echo $marktotal; ?></td>
              <td align="center">&nbsp;<?php echo $scormark; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;POSI=</td>
            <td align="center">&nbsp;<?php
	if($ovrflg=='Fail')
		echo "Fail";
	elseif($ovrflg=='Ab')
		echo "Ab";
	else
		echo "$stposi[0]/$maxposi[0]";
		?></td>
          </tr>
        </table></td>
       
  </tr>
</table>

</td>
      </tr>
    </table><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Note : &nbsp;&nbsp;&nbsp;*&nbsp;&nbsp;&nbsp;Need to Improve&nbsp;&nbsp;&nbsp;and&nbsp;&nbsp;&nbsp;#&nbsp;&nbsp;&nbsp;Marked Subject's marks not added in Total.
   <br><br><table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%"><table width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" width="32%">PERCENTAGE</td>
    <td align="center" width="18%">GRADE</td>
    <td align="center" width="50%">REMARKS</td>
  </tr>
  <tr>
    <td align="center"><?php
	if($scormark>0)
	{
		$pert=(100*$scormark)/$marktotal;
		echo round($pert, 2);
	}
	else
echo '0';
	if($ovrflg=='Fail')
	{
		$markqury14=execute("select name,remarks from grade where g_from<='$pert' and g_to>='$pert' ");
		$maxmark4=fetchrow($markqury14);
		$maxmark4[1]='Fail';
	}
	elseif($ovrflg=='Ab')
	{
		$maxmark4[0]='&nbsp';
		$maxmark4[1]='&nbsp';
	}
	else
	{
		$markqury14=execute("select name,remarks from grade where g_from<='$pert' and g_to>='$pert' ");
		$maxmark4=fetchrow($markqury14);
	}
  ?></td>
    <td  align="center">&nbsp;<?php echo $maxmark4[0]; ?></td>
    <td  align="center">&nbsp;<?php echo $maxmark4[1]; ?></td>
  </tr>
</table>
</td>
    <td width="50%"><table align="right" width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="60%">&nbsp;NO OF WORKING DAYS</td>
<?php
	$ccval=fetcharray(execute("select cc,ca,sub_remks from exam_topers where exam_id='$examid' and stud_id='$studentid'"));
	$cc=$ccval[cc];
	$ca=$ccval[ca];
	$sub_remks=stripslashes($ccval[sub_remks]);
?>
    <td width="20%" align="center"><?php echo $cc; ?></td>
    <td width="20%" align="center">( % )</td>
  </tr>
  <tr>
    <td width="60%">&nbsp;NO OF DAYS PRESENT</td>
    <td width="20%"  align="center"><?php echo $ca; ?></td>
    <td width="20%" align="center"><?php 
	echo $teee=round(($ca*100)/$cc,2);
	 ?></td>
  </tr>
</table>
</td>
  </tr>
</table>
<br>
<table width="96%" align="center" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td width="5%" align="center">POS</td>
    <td width="45%" align="center">CLASS TOPPERS</td>
    <td width="20%" align="center">SECTION</td>
    <td width="20%" align="center">ROLL NO.</td>
    <td width="10%" align="center">PERCENTAGE</td>
  </tr>
<?php
$s=1;
$sql55=execute("select total_mark from exam_topers where exam_id='$examid' and sec_id='$class_section_id' and rfg='P' group BY posi order BY posi limit 3");
while($r44=fetcharray($sql55))
{
	$sql2=execute("select a.stud_id,a.total_mark,b.first_name,b.student_id,c.section_name from exam_topers a, student_m b, class_section c where a.exam_id='$examid' and a.stud_id=b.id and  b.class_section_id=c.id and c.id='$class_section_id' and a.total_mark='$r44[0]' and a.rfg='P'");
$countnum=rowcount($sql2);
if(rowcount($sql2)>1)
{
	$tps=
	$tempstdid="";	
	while($r4=fetcharray($sql2))
	{
		$perrta=($r4[1]*100)/$marktotal;
		$tempstdid="---";
		$sectionname="---";
		$mks=$r4[1];
	}
	echo "<tr>
		<td align='center'>&nbsp;$s</td>
		<td nowrap>&nbsp;$countnum  toppers (Total Marks = $mks)</td>
		<td align='center'>&nbsp;$sectionname</td>
		<td align='center'>&nbsp;$tempstdid</td>
		<td align='center'>&nbsp;";
		echo round($perrta,2);
		echo "</td>
	  </tr>";
	$s++;
}
else
{
	while($r4=fetcharray($sql2))
	{
		$perrta=($r4[1]*100)/$marktotal;
		echo "<tr>
		<td align='center'>&nbsp;$s</td>
		<td>&nbsp;$r4[2]</td>
		<td align='center'>&nbsp;$r4[4]</td>
		<td align='center'>&nbsp;$r4[3]</td>
		<td align='center'>&nbsp;";
		echo round($perrta,2);
		echo "</td>
	  </tr>";
	   $s++;
	}
}
}
?>
</table>
<BR>
<table align="center" width="96%" border="1" cellspacing="0" cellpadding="0">
  <tr height='20'><td align="center">PREVIOUS TEST / EXAM MARKS</td></tr>
<tr><td><table align="center" width="100%" border="1" cellspacing="0" cellpadding="0">
<tr><td align='center'>TEST/EXAM</td>
<?php
$subqry=execute("select subject_code from subject_m where course_year_id='$sem' and status=1 order by sub_pre");
for($tt=0;$tt<rowcount($subqry);$tt++)
{
	$subdet=fetcharray($subqry);
	echo "<td align='center' nowrap>$subdet[0]</td>";
}
echo "<td align='center'>Total</td><td align='center'>Per</td></tr>";
$rs_ec=execute("select id from exam_m where curriculam='$branch' and class='$sem' and id<'$examid' and accyear='$accyear' order by id");
while($r1=fetcharray($rs_ec))
{
	
	$rs_ec1=execute("select sub_id,max_mark,exam_name,exam_count,vct from exam_m where id='$r1[0]'");
	$r2=fetcharray($rs_ec1);
	
	$subid=explode(',',$r2['sub_id']);
	$tlsub=sizeof($subid);
	$max_mark=$r2['vct'];

	$exam_count=$r2['exam_count'];
	$assmk='a.assmk'.$exam_count;
	$assmk1='assmk'.$exam_count;

	$rs_ec1=execute("select total_mark from exam_topers where exam_id='$r1[0]' and stud_id='$studentid'");
	$r3=fetcharray($rs_ec1);

	$ks++;
	if($r3[0]>0)
	{
		$pert=(100*$r3[0])/$max_mark;
	}
	else
		$pert=0;
	echo "<tr><td align='center' nowrap>$r2[exam_name]</td>";
	$subqry=execute("select subject_id from subject_m where course_year_id='$sem' and status=1 order by sub_pre");
	for($tt=0;$tt<rowcount($subqry);$tt++)
	{
		$subdet=fetcharray($subqry);
		$tablename="marks_".$branch."_".$sem;	
		$markqury=execute("select $assmk from $tablename a, subject_m b where a.studid='$studentid' and a.subid='$subdet[0]' and b.subject_id=a.subid");
		if(rowcount($markqury)>0)
		{
			$esubm=fetcharray($markqury);
			if($esubm[0]!='')
			{
				if($esubm[0]>0)
					echo "<td align='center' nowrap>$esubm[0]</td>";
				else
					echo "<td align='center' nowrap>Ab</td>";
			}
			else
				echo "<td align='center' nowrap>---</td>";
		}
		else
			echo "<td align='center' nowrap>---</td>";
	}
	if($r3[0]>0)
		echo "<td align='center' nowrap>$r3[0]</td>";
	else
		echo "<td align='center' nowrap>&nbsp;</td>";
	echo "<td align='center' nowrap>".round($pert,2)."</td></tr>";
}
?>
</table></td></tr></table>
<br>
<table align="center" width="96%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%"><table width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" ><font size="+5"><strong>ACKNOWLEDGEMENT</strong></font></td></tr>
	<tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan='2'>
	<br>&nbsp;&nbsp;&nbsp;Reviewed marks list of my child.<br><br><BR><BR></td></tr>
	<tr><td>&nbsp;Date : </td><td align='right'>Parent&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>
</td></tr></table></td>
    <td><table align="right" width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" colspan='2'><font size="+5"><strong>REMARKS</strong></font></td></tr>
  <tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan='2'>
	<br>&nbsp;&nbsp;&nbsp;<?php echo $sub_remks; ?><br><br><br><br></td></tr>
	<tr><td width='50%'>&nbsp;&nbsp;&nbsp;Class Teacher </td><td align='right'>Principal&nbsp;&nbsp;&nbsp;</td></tr></table>
</td></tr></table></td>
  </tr>
</table><br>
</td>
  </tr>
</table>
</td>
  </tr>
</table>
	<?php
	}
	else
	{
		echo "<div><font color='brown'><b>Marks for selected examination not entered...</b></font></div>";
	}
}

?>
<br><br>

<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>

</div>
</body>
</html>

