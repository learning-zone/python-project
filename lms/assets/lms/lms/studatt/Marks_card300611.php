<?php
session_start();
include("../db.php");
$StudID;
$app_num;
$branch;
$sem;
?>
<html>
<head>

</head>

<body>
<script LANGUAGE="JavaScript">
function prn()
		{
			pr1.style.display = "none";
			window.print();
		}
</script>
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
?>
<table  class='forumline' align='center' width="80%" border="1" cellspacing="0" cellpadding="0"><tr><td><br>
<table  class='forumline' align='center' width="96%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  width="17%" align="center">
    <img src="../images/logo.jpg" width='106' height='90'></td>
    <td width="59%" align="center"><font style="font-size:20" size='0' color='blue'><?php echo $col_name; ?></font><br>
    ( Recognized by Govt. Of Karnataka )<br>
    <?php echo $col_addr." -".$col_pin." Tel : ".$col_phone; ?><br>
   <font style="font-size:17" color="#333333"> Statement of Marks </font></td><td width="24%"><br><br><br><br><br>
    &nbsp;
    Date : <?php echo date("d-m-Y"); ?></td>
  </tr></table>
  <BR><table align="center" width="96%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="39%">&nbsp;&nbsp;<?php echo $stuname ?></td>
    <td width="20%">&nbsp;Admn No :&nbsp;<?php echo $stuid ?></td>
    <td width="17%">&nbsp;<?php echo 'hh';?></td>
    <td width="24%">&nbsp;ROLL No. <?php echo $stuid ?></td>
  </tr>
</table>

  <BR>
    <table  align="center"   width="96%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%">
        <table     width="98%" border="1" cellspacing="0" cellpadding="0">
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
	$accyear=$r1['accyear'];
	$exam_count=$r1['exam_count'];
	$max_mark=$r1['max_mark'];
}
$assmk='a.assmk'.$exam_count;
$assmk1='assmk'.$exam_count;
$totalmark=0;
$scormark=0;
$maxmark=execute("select sum($assmk1) from $tablename where studid='$studentid' and accyr='$accyear'");
if(sizeof($subid)<11)
$arrsize=10;
for($i=0;$i<=$arrsize;$i++)
{
	$tablename="marks_".$branch."_".$sem;
	$markqury=execute("select $assmk,b.subject_name,a.cc,a.ca,a.sub_remks,a.ba from $tablename a, subject_m b where a.studid='$studentid' and a.subid='$subid[$i]' and b.subject_id=a.subid");
	if(rowcount($markqury)==0)
	{
		echo "<tr height='15'>
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
		
		
		$markqury1=execute("select subject_name from subject_m  where subject_id='$subid[$i]'");
		$name=fetchrow($markqury1);
		while($mark=fetcharray($markqury))
		{
		$markqury12=execute("select max($assmk) from $tablename a where subid='$subid[$i]' and accyr='$accyear' ");
		$maxmarkt=fetchrow($markqury12);
		$pett=($mark[0]*100)/$max_mark;
		$markqury13=execute("select name from grade where g_from<='$pett' and g_to>='$pett' ");
		$maxmark3=fetchrow($markqury13);
		echo "<tr height='15'>
			<td nowrap>&nbsp;$mark[1]</td>
            <td align='center'>&nbsp;$max_mark</td>
            <td align='center'>$mark[0]</td>
            <td align='center'>$maxmark3[0]</td>
            <td align='center'>$maxmarkt[0]</td>
            <td align='center'>$mark[ba]</td>
          </tr>";
		  	$marktotal=$marktotal+$max_mark;
			$scormark=$scormark+$mark[0];
		  	$cc=$mark['cc'];
		  	$ca=$mark['ca'];
			$sub_remks=$mark['sub_remks'];
		}
		
	}
}

		$sql6=execute("SELECT posi FROM exam_topers WHERE exam_id='$examid' and stud_id='$studentid'");
		$stposi=fetchrow($sql6);
		$sql7=execute("SELECT max(posi) FROM exam_topers WHERE exam_id='$examid' ");
		$maxposi=fetchrow($sql7);
		?>
            
          <tr>
            <td>&nbsp;TOTAL</td>
            <td align="center">&nbsp;<?php echo $marktotal; ?></td>
              <td align="center">&nbsp;<?php echo $scormark; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;POSI=</td>
            <td align="center">&nbsp;<?php echo "$stposi[0]/$maxposi[0]";?></td>
          </tr>
        </table></td>
        <td  width="50%" align="center">
          <table align="right" width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">&nbsp;PROGRESS CHART</td>
  </tr>
  <?php  
  $trh=((--$i)*15)+30;
  $imgh=$trh-15;
  if($scormark>0)
$pert=(100*$scormark)/$marktotal;
else
echo '0';
if($pert<40)
$imagepath='b.gif';
else
$imagepath='a.gif';
$iact=($pert*$imgh)/100 ;
  ?>
  <tr height="<?=$trh?>">
    <td valign="bottom" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td>&nbsp;</td>
    <td>&nbsp;<?php echo $pert;?><br>
    &nbsp;<img src="<?=$imagepath?>" height="<?=$iact?>" width=25></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>

    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

</td>
      </tr>
    </table>
    
    
    
    <BR><table width="96%" align="center" border="0" cellspacing="0" cellpadding="0">
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
echo  $pert=(100*$scormark)/$marktotal;
else
echo '0';
$markqury14=execute("select name,remarks from grade where g_from<='$pert' and g_to>='$pert' ");
		$maxmark4=fetchrow($markqury14);
  ?></td>
    <td  align="center">&nbsp;<?php echo $maxmark4[0]; ?></td>
    <td  align="center">&nbsp;<?php echo $maxmark4[1]; ?></td>
  </tr>
</table>
</td>
    <td width="50%"><table align="right" width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="60%">&nbsp;NO OF WORKING DAYS</td>
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
    <td width="8%" align="center">S.NO</td>
    <td width="43%" align="center">CLASS TOPPERS</td>
    <td width="13%" align="center">SECTION</td>
    <td width="19%" align="center">ROLL NO.</td>
    <td width="17%" align="center">PERCENTAGE</td>
  </tr>
<?php
$sql2=execute("select a.stud_id,a.total_mark,b.first_name,b.student_id,c.section_name from exam_topers a, student_m b, class_section c where a.exam_id='$examid' and a.stud_id=b.id and  b.class_section_id=c.id   ORDER BY a.posi limit 3");
$s=1;
while($r4=fetcharray($sql2))
{
	$perrta=($r4[1]*100)/$marktotal;
	echo "<tr>
    <td align='center'>&nbsp;$s</td>
    <td>&nbsp;$r4[2]</td>
    <td align='center'>&nbsp;$r4[4]</td>
    <td align='center'>&nbsp;$r4[3]</td>
    <td align='center'>&nbsp;$perrta</td>
  </tr>";
  $s++;
}
?>
  
  
</table>
<BR>
<table align="center" width="96%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">PREVIOUS TEST / EXAM MARKS</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
<table align="center" width="96%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%"><table width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">ACKNOWLEDGEMENT</td>
  </tr>
  <tr>
    <td>&nbsp;REF :<BR><BR><BR><BR>&nbsp;DATE : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PARENT</td>
  </tr>
</table>
</td>
    <td><table align="right" width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">REMARKS</td>
  </tr>
  <tr>
    <td>&nbsp;<?php echo $sub_remks; ?><BR><BR><BR><BR>&nbsp;Class &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Teacher Principal</td>
  </tr>
</table>
</td>
  </tr>
  
</table>
<BR>
</td>
  </tr>
</table>
<br>

<div id=pr1 align=center><INPUT TYPE="SUBMIT" class=bgbutton NAME="print" VALUE="PRINT " onclick='prn()'>
</div>
</body>
</html>

