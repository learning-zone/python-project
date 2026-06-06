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
		$exam1=$_REQUEST['exam1'];
		$exam2=$_REQUEST['exam2'];
		$exam3=$_REQUEST['exam3'];
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

		//if($level==2)
		//{	
		
			
			$mxam=execute("select mark from dp_exam_sub_sub_m where id='$exam3'");	
			$maxmark=fetchrow($mxam);
			
			$sql1=execute("select exam_id from dp_exam_sub_sub_m where id='$examid'");	
			$exm1=fetchrow($sql1);
			$sql2=execute("select exam_id from dp_exam_sub_m where id='$exm1[0]' ");
			$exm2=fetchrow($sql2);
			
			$sql2=execute("select id from dp_exam_year_m where class='$sem' and status=1 order by order_id");	
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

			$sql3=execute("select id from dp_exam_sub_m where exam_id='$mainid' and subject_id='$subject' order by order_id");	
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
			$sql3=execute("select id from dp_exam_sub_sub_m where exam_id='$examsub' order by order_id");	
			$m=1;
			while($r1=fetchrow($sql3))
			{
				if($examid==$r1[0])
				$testid=$m;
				$m++;			
			}

		//}
		$examsub=$subsemid;
			
	if(isset($_POST['save']))
	{
		
		$marks=$_POST['marks'];
		$studentid=$_POST['studentid'];
		for($i=0;$i<sizeof($studentid);$i++)
		{
			
			$stuid=$studentid[$i];
			$mark1=$marks[$i];
			$mainid;
			$testid;
			if($mark1)
			{
				$newquery=execute("select id from dp_marks where class_section='$class_section_id' and student_id='$stuid' and subject_id='$subject' and sem_id='$exam1' and int_id='$exam2' and tst_id='$exam3'");
				if(rowcount($newquery)>0)
				{
					
					$sqlquery="update dp_marks set mark='$mark1',maxmark='$maxmark[0]' where class_section='$class_section_id' and student_id='$stuid' and subject_id='$subject' and sem_id='$exam1' and int_id='$exam2' and tst_id='$exam3'";
				}
				else
				{
					if($mark1!='')
					{
						
						$sqlquery="insert into dp_marks(class_section,student_id,subject_id,mark,status, sem_id, int_id, tst_id,maxmark) values('$class_section_id','$stuid','$subject','$mark1','1','$exam1' ,'$exam2', '$exam3','$maxmark[0]')";
					}
				}
				//echo $sqlquery.'<br>';
				execute($sqlquery);
				$sqlquery='';
				$mark1='';
				$mark1='';
				$grade1='';
			}
		}
		?>
        <script language="javascript">
        alert("Marks added successfully ");
		//window.close();
        </script>
        <?
	}

$newmaxmark=$maxmark[0];
?>
<SCRIPT LANGUAGE="JavaScript">
function reload()
{
	document.frm.action='updatemarks.php';
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
		<input type='hidden' name='exam1' value='$exam1'>
		<input type='hidden' name='exam2' value='$exam2'>
		<input type='hidden' name='exam3' value='$exam3'>
		<input type='hidden' name='class_section_id' value='$class_section_id'>
		<input type='hidden' name='subject' value='$subject'>
		<input type='hidden' name='level' value='$level'>";
			
  	$subel=execute(" select elective from subject_m where subject_id='$subject'");
	$subel1=fetchrow($subel);
	if($subel1[0]=='N')
	{
			
		$sql123.="select id,student_id,first_name,last_name from student_m where id is not null and archive='N' and academic_year='$accyear'";
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
		
		$sql123.=" order by gender desc,first_name";
		
	}
	else
	{	
		$sql123.="select a.id,a.student_id,a.first_name,a.last_name from student_m a,student_course b where a.id is not null and a.archive='N' and academic_year='$accyear'";
		if($branch!=0)
		{
		$sql123.=" and a.course_admitted=$course";
		}
		if($sem!=0)
		{
		$sql123.=" and a.course_yearsem=$sem";
		}
		if($class_section_id!='')
		{
		$sql123.=" and a.class_section_id=$class_section_id   ";
		}
		
		$sql123.=" and b.stu_id=a.id and b.sub='$subject' group by a.id order by first_name ";
	}
	
	$rs=execute($sql123) or die(mysql_error());
  ?><br>  <table width="60%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="5">
  <tr height="25">
   <td width="10%"  align="center" class="head" nowrap>&nbsp;Sl No.</td>
    <td width="40%" align="center" class="head" nowrap>&nbsp;Name</td>
    <td width="27%" align="center" class="head" nowrap>&nbsp;Student Id</td>
    <td width="23%" align="center" class="head" nowrap>&nbsp;Mark</td>
   <!-- <td width="23%" align="center" class="head" nowrap>&nbsp;Grade</td> 
    <td width="23%" align="center" class="head" nowrap>&nbsp;Remarks</td> -->
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
	$sql111=execute("select mark, status,maxmark from dp_marks where class_section='$class_section_id' and student_id='$r1[id]' and subject_id='$subject' and sem_id='$exam1' and int_id='$exam2' and tst_id='$exam3'");
	if(rowcount($sql111)>0)
	{
		$maxmark=$_GET["sid"];
		while($oldmarks=fetcharray($sql111))
		{
			?><td nowrap align='center'>&nbsp;<input type="text" size="4" name='marks[]' id='<?php echo $r1[id]; ?>' onChange="test(this.id)" width="4" value="<?php echo $oldmarks[0]; ?>" <?php echo $readonly; ?>>&nbsp;</td>
			<!--<td width="23%" align="center"  nowrap>&nbsp;<input type="text" size="4" name='grade[]' id='g<?php echo $r1[id]; ?>' onChange="test1(this.id)" width="4" value="<?php echo $oldmarks[3]; ?>"  readonly>&nbsp;</td> 
			<td width="" align="center"  nowrap>&nbsp;
			<textarea id="r<?php echo $r1[id]; ?>" cols="52" rows="2" name="remarks[]"><?=$oldmarks[2];?></textarea>&nbsp;</td> -->
			</tr><?php
		}
	}
	else
	{
		
		?><td nowrap align='center'>&nbsp;<input type="text" size="4" name='marks[]' id='<?php echo $r1[id]; ?>' onChange="test(this.id)" width="4" value="">&nbsp;</td> 
   <!-- <td width="23%" align="center"  nowrap>&nbsp;
    <input type="text" size="4" name='grade[]' id='g<?php echo $r1[id]; ?>' onChange="test1(this.id)" width="4" value="" readonly>&nbsp;</td> 
    <td width="" align="center"  nowrap>&nbsp;
    <textarea id="r<?php echo $r1[id]; ?>" cols="52" rows="2" name="remarks[]"></textarea>&nbsp;</td>--> 

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

