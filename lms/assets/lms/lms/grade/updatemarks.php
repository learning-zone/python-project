<html>
<HEAD>
  <?php
	session_start();
	require("../db.php");
	
	$accyear=$_SESSION['AcademicYear'];
	
		$course=$_REQUEST['course'];
		$sem=$_REQUEST['sem'];
		$examid=$_REQUEST['examid'];
		$class_section_id=$_REQUEST['class_section_id'];
		$subject=$_REQUEST['subject'];
		$level=$_REQUEST['level'];
		$examsub=$_REQUEST['examsub'];
		$testid=$_REQUEST['testid'];
		$unit=$_REQUEST['unit'];
		$class=$_REQUEST['class'];

		$exam1=$examid;
		$examsub1=$examsub;
		$testid1=$testid;
		$tablename="igc_".$accyear."_"."$sem";
			
	if($_POST['save'])
	{
		
		$marks=$_POST['marks'];
		$studentid=$_POST['studentid'];
		$remarks=$_POST['remarks'];
		$grade=$_POST['grade'];
		for($i=0;$i<sizeof($studentid);$i++)
		{
			
			$stuid=$studentid[$i];
			$mark1=$marks[$i];
			$uppermark=strtoupper($mark1);
			$remarks1=$remarks[$stuid];
			$upperremarks=$remarks1;
			$grade1=$grade[$i];
			$mainid;
			$testid;
			
				$newquery=execute("select id from obe_skill_mark where student_id='$stuid' and  sem_id='$examid'  and unit='$unit'");
				if(rowcount($newquery)>0)
				{
					
					$sqlquery="update obe_skill_mark set mark='$uppermark', remarks='$upperremarks',grade='$grade1' where student_id='$stuid' and sem_id='$examid' and unit='$unit'";
				}
				else
				{
					
						$sqlquery="insert into obe_skill_mark(class_section,student_id,subject_id,mark,status, sem_id,remarks,grade,unit) values('$class_section_id','$stuid','$subject','$uppermark','1','$examid','$upperremarks','$grade1','$unit')";
					
				}
				//if($remarks1)
				//echo $sqlquery.'<br>';
				execute($sqlquery);
				$sqlquery='';
				$mark1='';
				$mark1='';
				$remarks1='';
				$grade1='';
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

function countit(what)
{
//Character count script- by javascriptkit.com
//Visit JavaScript Kit (http://javascriptkit.com) for script
//Credit must stay intact for use

formcontent=what.form.remks.value
what.form.displaycount.value=formcontent.length
}	

</SCRIPT>
<script>
function limitlength(obj, length)
{
 var maxlength=length
 if (obj.value.length>maxlength)
 obj.value=obj.value.substring(0, maxlength)
}
</SCRIPT>
<script>
function countit(what){

//Character count script- by javascriptkit.com
//Visit JavaScript Kit (http://javascriptkit.com) for script
//Credit must stay intact for use

formcontent=what.form.remks.value
what.form.displaycount.value=formcontent.length
}	
function lenval(val)
{
	alert(val);
	if(val=='Announcement')
	what.form.displaycount1.value=13;
	else
	what.form.displaycount1.value=16;
	

}
</script>
</HEAD>

<body>
<form name="frm" action="" method="post">

<?php

echo "	<input type='hidden' name='course' value='$course'>
		<input type='hidden' name='sem' value='$sem'>
		<input type='hidden' name='examid' value='$exam1'>
		<input type='hidden' name='class_section_id' value='$class_section_id'>
		<input type='hidden' name='subject' value='$subject'>
		<input type='hidden' name='level' value='$level'>
		<input type='hidden' name='examsub' value='$examsub1'>
		<input type='hidden' name='testid' value='$testid1'>";
			
  	
		$sql123.="select c.id,c.student_id,c.first_name,c.last_name from class_section a,student_course b,student_m c where a.status=1 and a.id=b.sub_sec and b.acc_year='$accyear' and b.stu_id=c.id and c.archive='N' and a.id='$class'  and a.grade='$sem' group by a.id,b.stu_id order by c.first_name";
		
	$rs=execute($sql123) ;
  ?><br>  <table width="80%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr height="25">
   <td width="10%"  align="center" class="head" nowrap>&nbsp;Sl No.</td>
    <td width="40%" align="center" class="head" nowrap>&nbsp;Name</td>
    <td width="27%" align="center" class="head" nowrap>&nbsp;Student Id</td>
    <td width="23%" align="center" class="head" nowrap>&nbsp;Comments</td> 
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
	$sql111=execute("select mark, status,remarks,grade from obe_skill_mark where  student_id='$r1[id]'  and sem_id='$examid'  and unit='$unit'");
	if(rowcount($sql111)>0)
	{
		$maxmark=$_GET["sid"];
		while($oldmarks=fetcharray($sql111))
		{
			?>
			
			
						<td width="23%" align="center"  nowrap>&nbsp;<textarea cols="40" rows="2" name='remarks[<?=$r1[id]?>]' id='g<?php echo $r1[id]; ?>' width="4"  ><?php echo $oldmarks[2]; ?></textarea></td>
			 
			</tr><?php
		}
	}
	else
	{
		?>
<td width="23%" align="center"  nowrap>&nbsp;
    <textarea cols="40" rows="2" name='remarks[<?=$r1[id]?>]' id='g<?php echo $r1[id]; ?>'></textarea>&nbsp;</td>
</tr><?php
	}
$i++;  
}
  ?>

</table>
<br>
<div align="center"><input type="submit" name="save" value="SAVE" class="bgbutton" ></div>
</form>	
</body>
</html>