<html>
<head>
<?php
session_start();
include("../db.php");
include("../Code/PHP/Includes/FusionCharts.php");
//We've also included ../Includes/FC_Colors.asp, having a list of colors
//to apply different colors to the chart's columns. We provide a function for it - getFCColor()
include("../Code/PHP/Includes/FC_Colors.php");
$user=$_REQUEST['stuid'];
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
<SCRIPT LANGUAGE="Javascript" SRC="../Code/FusionCharts/FusionCharts.js"></SCRIPT>
	
	
<script LANGUAGE="JavaScript">
	
	function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
</script>
	<style type="text/css">
	<!--
	body {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	-->
	</style>
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

<table align="center"  width="50%" border="1" cellspacing="0" cellpadding="0">
<tr><td>
  <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
 </table><table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr height='25'>
    <td width="34%" nowrap><strong>&nbsp;&nbsp;Name : <?php echo $stuname ?></strong></td>
    <td width="20%" nowrap><strong>&nbsp;&nbsp;Admn No :&nbsp;<?php echo $admissionid ?></strong></td>
    <td width="21%" nowrap><strong>&nbsp;&nbsp;
      <?php 
	$claname=fetchrow(execute("SELECT year_name FROM course_year where year_id='$sem'")); 
	echo $claname[0]."&nbsp;/&nbsp;";
	$secid=fetchrow(execute("SELECT section_name FROM class_section where id='$class_section_id'")); 
	echo $secid[0]; ?>
    </strong></td>
    <td width="24%" nowrap><strong>&nbsp;&nbsp;ROLL No. <?php echo $stuid ?></strong></td>
  </tr>
</table>

    <table  align="center"  width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <!--   <td width="50%">
         <table  width="98%" border="1" cellspacing="0" cellpadding="0">
        <tr height="30">
            <td nowrap align="center"><font style="font-size:9px">SUBJECT</font></td>
            <td align="center"><font style="font-size:9px">MAX MARKS</font></td>
            <td align="center"><font style="font-size:9px">SCORED MARKS</font></td>
            <td align="center"><font style="font-size:9px">SUBJ. GRADE</font></td>
            <td align="center"><font style="font-size:9px">SUBJ. TOPPER</font></td>
            <td align="center"><font style="font-size:9px">SUBJ. POSITION</font></td>
          </tr>-->
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
for($i=0;$i<=$arrsize;$i++)
{
	$tablename="marks_".$branch."_".$sem;	
	$markqury=execute("select $assmk,b.subject_name,$ba from $tablename a, subject_m b where a.studid='$studentid' and a.subid='$subid[$i]' and b.subject_id=a.subid");
	if(rowcount($markqury)==0)
	{
		
	}
	else
	{
		$markqury1=execute("select sub_type from subject_m  where subject_id='$subid[$i]'");
		$name=fetchrow($markqury1);
		while($mark=fetcharray($markqury))
		{
		$markqury12=execute("select max($assmk) from $tablename a where subid='$subid[$i]' and accyr='$accyear' ");
		$maxmarkt=fetchrow($markqury12);
	
		
		if($mark[0]>0)
		{
			$per=$mark[0]*100/$mmks[$i];
			if($per<35)
			{
				if($name[0]<3)
					$ovrflg="Fail";
				
			}	
			
		}
		else
		{
			$per=0;
			if($name[0]<3)
			{
				if($ovrflg!='Fail')
					$ovrflg='Ab';
			}
		
		}
		$markqury13=execute("select name from grade where g_from<='$per' and g_to>='$per' ");
		$maxmark3=fetchrow($markqury13);
         
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
            
         <?php
	//if($ovrflg=='Fail')
	//	echo "Fail";
	//elseif($ovrflg=='Ab')
	//	echo "Ab";
	//else
		//echo "$stposi[0]/$maxposi[0]";
		?>
        <td width="100%" align="center">
          <table align="right" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr height='20'>
    <td align="center">&nbsp;PROGRESS CHART</td>
  </tr>
  <?php  
  $trh=((--$i)*20)+30;
  $imgh=$trh-20;
  ?>

<?php
$ks=0;
$ct=0;
$rs_ec=execute("select id from exam_m where curriculam='$branch' and class='$sem' and id<='$examid' and accyear='$accyear' ");
$avrper=0;
while($r1=fetcharray($rs_ec))
{
	$rs_ec1=execute("select sub_id,max_mark,vct from exam_m where id='$r1[0]'");
	$r2=fetcharray($rs_ec1);
	
	$subid=explode(',',$r2['sub_id']);
	$tlsub=sizeof($subid);
	
	$max_mark=$r2['vct'];

	$rs_ec1=execute("select total_mark,rfg from exam_topers where exam_id='$r1[0]' and stud_id='$studentid'");
	$r3=fetcharray($rs_ec1);
	
	$ks++;
	if($r3[0]>0)
	{
		$pert=(100*$r3[0])/$max_mark;
		$avrper+=$pert;
		$iact=($pert*$imgh)/100 ;
	}
	else
	{
		$pert=0;
		$iact=0;
	}
	if($r3[rfg]!='P')
	{
		$imagepath='b.gif';
	}
	else
	{
		$imagepath='c.gif';
	}
	
	if($pert>0)
	{	
		?>
	    <?php
		$exammark[]=$pert;
	}
	else
	{
		echo "<td width='5.5%'>&nbsp;</td>";
	}
	?>
	<?php
	$ks++;
	$ct++;
}
$ks1=10-$ks;
for($zz=0;$zz<$ks1;$zz++)
{
?>
    <?php
}
$avrpert=$avrper/$ct;
$iact=($avrpert*$imgh)/100 ;
if($avrpert>0)
{	
	?>
    <?php
	$exammark[]=$avrpert;
}
else
{
	//echo "<td width='5.5%'>&nbsp;</td>";
}
?>


  <tr height='30'>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  
<?php
$ct=0;
$rs_ec=execute("select id from exam_m where curriculam='$branch' and class='$sem' and id<='$examid' and accyear='$accyear' ");
while($r1=fetcharray($rs_ec))
{
	$examnamed=fetchrow(execute("SELECT exam_name FROM exam_m where id='$r1[0]'"));
	$rs_ec1=execute("select rfg from exam_topers where exam_id='$r1[0]' and stud_id='$studentid'");
	$r3=fetcharray($rs_ec1);
	$avssts=$r3[rfg];
	$examnadet[]=$examnamed[0];
	$ct++;
}
for($zz=0;$zz<$ks1;$zz++)
{
?>
  
    <?php
}
$examnadet[]='AVG';

?>
<tr><td>
<?php
//**********************
$exammark;

$arrData[0][1] ="TOT";
$arrData[0][2] =100;

for($i=0;$i<sizeof($exammark);$i++)
{
	$kn=1;
	$j=$exammark[$i];
	$kn=$examnadet[$i];
	$arrData[$kn][1] =$kn;
	
	//Store sales data
	
	$arrData[$kn][2] =$j;
	$kn++;
}

$strXML = "<graph caption='' numberPrefix='' formatNumberScale='0' decimalPrecision='0'>";
	//Convert data to XML and append
	foreach ($arrData as $arSubData)
		$strXML .= "<set name='" . $arSubData[1] . "' value='" . $arSubData[2] ."' color='". getFCColor() ."' />";

	//Close <graph> element
	$strXML .= "</graph>";
	
	//Create the chart - Column 3D Chart with data contained in strXML
	echo renderChart("../Code/FusionCharts/FCF_Column3D.swf", "", $strXML, "productSales", 480, 310);



//*************

?>

</td></tr> 
</table></td>
  </tr>
</table>

</td>
      </tr>
    </table>
<br>
<br>
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


</div>

</body>
</html>

