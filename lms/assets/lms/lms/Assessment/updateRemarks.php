<html>
<HEAD>
  <?php
	session_start();
	require("../db.php");
	
	$accyear=$_SESSION['AcademicYear'];
	if($_REQUEST)
	{
		$course=$_REQUEST['course'];
		$sem=$_REQUEST['sem'];
		$examid=$_REQUEST['examid'];
		$class_section_id=$_REQUEST['class_section_id'];
		$subject=$_REQUEST['subject'];
		$level=$_REQUEST['level'];
	}
	if($_POST)
	{
		$course=$_POST['course'];
		$sem=$_POST['sem'];
		$examid=$_POST['examid'];
		$class_section_id=$_POST['class_section_id'];
		$subject=$_POST['subject'];
		$level=$_POST['level'];
	}
	$tablename="marks_".$accyear."_"."$sem";

		if($level==2)
		{	
		
			
			$mxam=execute("select mark from exam_sub_sub_m where id='$examid'");	
			$maxmark=fetchrow($mxam);
			
			$sql1=execute("select exam_id from exam_sub_sub_m where id='$examid'");	
			$exm1=fetchrow($sql1);
			$sql2=execute("select exam_id from exam_sub_m where id='$exm1[0]' ");
			$exm2=fetchrow($sql2);
			
			$sql2=execute("select id from exam_year_m where acc_year='$accyear' and class='$sem' and status=1 order by order_id");	
			$j=1;
			while($r=fetchrow($sql2))
			{
				if($exm2[0]==$r[0])
				{
					$semname=$j;
					$mainid=$r[0];
				}
				$j++;			
			}
			$sql3=execute("select id from exam_sub_m where exam_id='$mainid' and subject_id='$subject' order by order_id");	
			$k=1;
			while($r1=fetchrow($sql3))
			{
				if($exm1[0]==$r1[0])
				{
					//$semname=$k;
					$subsemid=$k;
					$examsub=$r1[0];
				}
				$k++;			
			}
			$sql3=execute("select id from exam_sub_sub_m where exam_id='$examsub' order by order_id");	
			$m=1;
			while($r1=fetchrow($sql3))
			{
				if($examid==$r1[0])
				$testid=$m;
				$m++;			
			}

		}
		$examsub=$subsemid;

	if(isset($_POST['save']))
	{
		$conduct=$_POST['conduct'];
		$behaviour=$_POST['behaviour'];
		$studentid=$_POST['studentid'];
		for($i=0;$i<sizeof($studentid);$i++)
		{
			
			$conduct1=$conduct[$i];
			$behaviour1=$behaviour[$i];
			$stuid=$studentid[$i];
			
				$count_id=fetchrow(execute("select id from exam_remarks where section='$class_section_id' and exam_sem='$mainid' and int_id='$examsub' and tst_id='$testid' and acc_year='$accyear' and sem='$sem' and status=1 and student_id='$stuid'"));
				if($count_id[0])
				{
					$sqlquery="update exam_remarks set remarks1='".addslashes($conduct1)."', remarks2='".addslashes($behaviour1)."' where id='$count_id[0]'";
					execute($sqlquery);
				}
				else
				{
					if($conduct1 or $behaviour1)
					{
						$sqlquery="insert into exam_remarks(section, exam_sem, int_id, tst_id, acc_year, sem, status, student_id, remarks1, remarks2) values('$class_section_id','$mainid' ,'$examsub', '$testid','$accyear', '$sem', 1, '$stuid', '".addslashes($conduct1)."', '".addslashes($behaviour1)."')";						
					execute($sqlquery);
					}
				}
				
				$sqlquery='';
				$conduct1='';
				$behaviour1='';
	
			}
					
		?>
        <script language="javascript">
        alert("Update Successfully ");
		//window.close();
        </script>
        <?
	}

$newmaxmark=$maxmark[0];

?>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='updateRemarks.php';
	document.frm.submit();
}
function test(id)
{
	var maxmark1=parseInt("<?php echo $maxmark[0]; ?>");
	var element =document.getElementById(id).value; 
	if(isNaN(element) && element!='A')
	{
		alert("Enter number only. For Absentees enter as A");
		document.getElementById(id).value='';
	}
	else
	{
		if(maxmark1 < element)
		{

			if(maxmark1!=element)
			{	
				alert("Maximum marks should be less then or equal to "+maxmark1);	
				document.getElementById(id).value='';
			}
		}
		if(maxmark1 > element)
		{
//ajax code starts
			var url="sessionfile.php";
			url=url+"?q="+element;
			url=url+"&sid="+maxmark1;
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			  		xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("g"+id).value=xmlhttp.responseText;
					}
			 }
			xmlhttp.open("GET",url,true);
			xmlhttp.send();
			


//ajax code ends
			//alert("hai 1 proper data");	
			
		}
		if(maxmark1==element)
		{	
//ajax code starts
			var url="sessionfile.php";
			url=url+"?q="+element;
			url=url+"&sid="+maxmark1;
			
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			  		xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("g"+id).value=xmlhttp.responseText;
					}
			 }
			xmlhttp.open("GET",url,true);
			xmlhttp.send();
			


//ajax code ends
		}

	}

}

</SCRIPT>
</HEAD>

<body>
<form name="frm" action="" method="post">

<?php
echo "	<input type='hidden' name='course' value='$course'>
		<input type='hidden' name='sem' value='$sem'>
		<input type='hidden' name='examid' value='$examid'>
		<input type='hidden' name='class_section_id' value='$class_section_id'>
			<input type='hidden' name='subject' value='$subject'>
		<input type='hidden' name='level' value='$level'>";
			
			
		$sql123.="select id,student_id,first_name,last_name from student_m where id is not null and archive='N'";
		if($branch!=0)
		{
		$sql123.=" and course_admitted=$course";
		}
		if($sem!=0)
		{
		$sql123.=" and course_yearsem=$sem";
		}
		if($class_section_id!='')
		{
		$sql123.=" and class_section_id=$class_section_id  ";
		}
		
		$sql123.=" order by first_name";
		
	
	$rs=execute($sql123) or die(mysql_error());
  ?><br>  <table width="60%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr height="25">
   <td width="10%"  align="center" class="head" nowrap>&nbsp;Sl No.&nbsp;</td>
    <td width="40%" align="center" class="head" nowrap>&nbsp;Name&nbsp;</td>
    <td width="27%" align="center" class="head" nowrap>&nbsp;Student Id&nbsp;</td>
    <td width="23%" align="center" class="head" nowrap>&nbsp;Att %&nbsp;</td>  <td width="23%" align="center" class="head" nowrap>&nbsp;Conduct&nbsp;</td> 
    <td width="23%" align="center" class="head" nowrap>&nbsp;Behaviour&nbsp;</td> 
  </tr>
  <?php
  $i=1;
 while($r1=fetcharray($rs))
 { 
  echo "<input type='hidden' name='studentid[]' value='$r1[id]'>";
  echo "<tr >
    <td align='center' nowrap>$i</td>
    <td nowrap>&nbsp;&nbsp;$r1[first_name] $r1[last_name]</td>
    <td nowrap align='center'>&nbsp;$r1[student_id]</td>";

	$att_tablename="att_".$sem;
	if($sem==12)
	$subject12=208;
	if($sem==13)
	$subject12=225;


	  $sql6=fetchrow(execute("SELECT count(id) FROM $att_tablename where sec='$class_section_id'  and subject_id='$subject12' group by stu_id"));
 	$count6=$sql6[0];
	
	$sql7=fetchrow(execute("SELECT count(id) FROM $att_tablename where sec='$class_section_id'  and subject_id='$subject12' and stu_id='$r1[id]' and mor=1"));
 	$count7=$sql7[0];
	$sql111=execute("select id, remarks1, remarks2 from exam_remarks where section='$class_section_id' and exam_sem='$mainid' and int_id='$examsub' and tst_id='$testid' and acc_year='$accyear' and sem='$sem' and status=1 and student_id='$r1[id]'");
	
	?>
    <td width="" align="center"  nowrap>&nbsp;<?=$count6." / ".$count7?>&nbsp;</td>
    <?php
	if(rowcount($sql111)>0)
	{

		while($oldmarks=fetcharray($sql111))
		{
			?>
			<td width="" align="center"  nowrap>&nbsp;
			<textarea id="con<?php echo $r1[id]; ?>" cols="42" rows="2" name="conduct[]"><?=$oldmarks[1];?></textarea>&nbsp;</td>
			<td width="" align="center"  nowrap>&nbsp;
			<textarea id="beh<?php echo $r1[id]; ?>" cols="42" rows="2" name="behaviour[]"><?=$oldmarks[2];?></textarea>&nbsp;</td> 
			</tr><?php
		}
	}
	else
	{
		?> 
    <td width="" align="center"  nowrap>&nbsp;
    <textarea id="con<?php echo $r1[id]; ?>" cols="42" rows="2" name="conduct[]"></textarea>&nbsp;</td> 
 <td width="" align="center"  nowrap>&nbsp;
    <textarea id="beh<?php echo $r1[id]; ?>" cols="42" rows="2" name="behaviour[]"></textarea>&nbsp;</td> 

</tr><?php
	}
$i++;  
}
  ?>

</table>
<br>
<div align="center"><input type="submit" name="save" value="SAVE" class="bgbutton" onClick="reload()" ></div>
</form>	
</body>
</html>

