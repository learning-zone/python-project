<?php
session_start();
require_once("../db.php");

$accno=$_POST['accno'];
$media=$_POST['media'];
$cardno=$_POST['cardno'];
$IDay=$_POST['IDay'];
$IMon=$_POST['IMon'];
$IYear=$_POST['IYear'];
$DDay=$_POST['IDay'];
$DMon=$_POST['IMon'];
$DYear=$_POST['IYear'];
$remark=$_POST['remark'];
$m_id=$_POST['m_id'];
$msg=$_GET['msg'];
		$xyz1 = "Student ID";
		$xyz2 = "Student Name";
		$xyz3 = "Member Type";
		$xyz4 = "Branch";
		$xyz5 = "Sem/Section";
		
        $aa = "Title";
		$bb = "Language";
		$cc = "Periodicity";
		$dd = "Supplier";
		$ee = "Source";

if($accno!="" && $media!=0)
{  
    //echo "<p>Access no: $accno</p>";
	$var7 = "select * from lib_circulation_m where acc_id='$accno' and media_type='$media' and status=0";
	$res7 = execute($var7);
	$num7 = rowcount($res7);
	
	if($num7>0)
	{
		//echo "inside if";
		$dis = "disabled";
		$dis1="";

		$row7 = fetcharray($res7);
		$cardno = $row7[cno];
		$media = $row7[media_type];

		$i_date = $row7[issue_date];
		$d_date = $row7[due_date];

		$i_time = $row7[issue_time];
		$d_time = $row7[due_time];
	}
	else
	{
		$dis="";
		$dis1="disabled";
	}
	
    if($media==7)
	{
		//echo "inside if";
		$var5 = "select a.title,a.language,a.periodicity,a.supplier,a.source from lib_magazine_subscription a,";
		$var5.=" lib_magazine b where b.magazine_no='$accno' and a.id=b.magazine_sub_no";
		//echo $var5;
		$res5 = execute($var5);
	    $row5 = fetcharray($res5);
		
		$aa1 = $row5[title];
		$bb1 = $row5[language];
		$cc1 = $row5[periodicity];
		$dd1 = $row5[supplier];
		$ee1 = $row5[source];
	
	}
	if($media==8)
	{
        $varnew = "select a.course,a.sem,a.subject,a.month,a.year,a.scheme,b.coursename,c.year_name,d.subject_name";
		$varnew.=" from lib_question_paper_det a,course_m b,course_year c,subject_m d where a.id='$accno'";
		$varnew.=" and b.course_id=a.course and c.year_id=a.sem and d.subject_id=a.subject";
		$resnew = execute($varnew);
	    $rownew = fetcharray($resnew);
		
		$aa = "Branch";
		$bb = "Semester";
		$cc = "Subject";
		$dd = "Month/Year";
		$ee = "Scheme";

        $aa1 = $rownew[coursename];
		$bb1 = $rownew[year_name];
		$cc1 = $rownew[subject_name];
		$dd1 = $rownew[month]."/".$rownew[year];
		$ee1 = $rownew[scheme];
	}
	
}

if($cardno!="")
{
	//echo "inside if";
	$var= "select a.m_no,a.s_id,a.type,b.m_id from lib_membership_m a,lib_membership_det b where b.mbno='$cardno' and a.id=b.m_id"; 
	//echo $var;
	$res = execute($var) ; 
	$row = fetcharray($res);
	if($row[type]==1)
	{
		$var1 = "select a.first_name,a.last_name,a.usn,a.student_id,a.course_admitted,a.course_yearsem,a.class_section_id"; 
		$var1.=" ,a.img_source from student_m a where a.id='$row[s_id]' ";
		$res1 = execute($var1) ; 
		$row1 = fetcharray($res1);
		$var2 = execute("select coursename from course_m where course_id='$row1[course_admitted]'");
		$row2 = fetcharray($var2);

		$var3 = execute("select year_name from course_year where year_id='$row1[course_yearsem]'");
		$row3 = fetcharray($var3);

		$var4 = execute("select section_name from class_section where id='$row1[class_section_id]'");
		$row4 = fetcharray($var4);
		if($row4[section_name]=="")
		{
			$section='No Section';
		}
		else
		{
			$section=$row4[section_name];
		}
		$sem_sec = $row3[year_name]." / ".$section;
		
		if($row1[usn]!=0)
		{
			$xyz1 = "University No";
			$xyz6 = $row1[usn];
		}
		else
		{
			$xyz1 = "Appl No";
			$xyz6 = $row1[student_id];
		}

		$xyz7 = $row1[first_name].".".$row1[last_name];
		$xyz8 = "Student";
		$xyz9 = $row2[coursename];
		$xyz10 = $row3[year_name];
		$image = $row1[img_source];
	}
	if($row[type]==2)
	{
		$var1 = "select f_name,s_name,slno,subj,type_id,img_col from staff_det where id='$row[s_id]' ";
		$res1 = execute($var1) ; 
		$row1 = fetcharray($res1);

		$var2 = "select Dept from dept_no  where dpt_id='$row1[subj]' ";
		$res2 = execute($var2) ; 
		$row2 = fetcharray($res2);

		$var3 = "select d_name from staff_des where d_id='$row1[type_id]' ";
		$res3 = execute($var3) ; 
		$row3 = fetcharray($res3);

		$xyz1 = "Staff ID";
		$xyz2 = "Staff Name";
		$xyz3 = "Member Type";
		$xyz4 = "Department";
		$xyz5 = "Designation";

		
	
		$xyz6 = $row1[slno];
		$xyz7 = $row1[f_name].".".$row1[s_name];
		$xyz8 = "Staff";
		$xyz9 = $row2[Dept];
		$xyz10 = $row3[d_name];
		$image = $row1[img_col];
	}
}
if($Action=='issue')
{
	if($flag==1)
	{
		echo "<script language='jkavascript'>";
		echo "alert('Book Issued Successfully')";
		echo "</script>";
	}
}
?>
<html>
<head>
	<script langauge='javascript'>
	function checkTime(i)
	{
		if (i<10)
		  {
			  i="0" + i;
		  }
		return i;
	}
		function reload()
		{
			document.frm.action='media2.php'
			document.frm.submit();
		}
		function issueMe()
		{
			alert("Confirm Issue ???");
			document.frm.action='issueMedia2.php';
			document.frm.submit();
		}
		function retrunMe()
		{   
		    alert("Confirm Return ???");
			document.frm.action='returnMedia2.php';
			document.frm.submit();
		}
	</script>
</head>
<body onLoad="startTime()">
<form name='frm' method='post'>
<table border='0' align='center' class='forumline' width='80%'>
   <tr>
	<td class='head' colspan='6' align='center'> Media Transnaction Details</td>
   </tr>
   <tr>
   <td height="24" >&nbsp;&nbsp;Accession Number</td>
	<td ><input type='text' name='accno' value='<?php echo $accno ?>' size='14' onchange='reload()'></td>
	<td  align='right'>Media Type&nbsp;</td>
	<td >
		<select size="1" name="media" onchange='reload()'>
		<option value='0'>Select Media</option> 
		<?php
               if($media== "7")
                 {
	               $mag="selected";
	               $que="";
                 }
               if($media== "8")
                 {
	               $mag="";
	               $que="selected";
               }
			   ?>
		<option value='7' <?php echo $mag ?> >Magazine/Journal</option>
		<option value='8' <?php echo $que ?> >Question Paper</option>
		</select>
	
	</td>
	<td >Card Number&nbsp;</td>
	<td ><input type='text' name='cardno' value='<?php echo $cardno ?>' size='14' onchange='reload()'></td>
   </tr>
</table>
<br/>
<table border='0' align='center' class='forumline' width='80%' >
	<tr>
		<td width='40%'>
			<!-- for student/satff details -->
			<table border='0' align='center' class='forumline' width='100%' height='158'>
				<tr>
					<td class='head' colspan='3' align='center'><?php echo "$xyz8 Details" ?> </td>
				</tr>
				<tr>
					<td width='18%'>&nbsp;&nbsp;<?php echo $xyz1 ?></td>
					<td width='25%'>&nbsp;&nbsp;<?php echo $xyz6 ?></td>
					<td rowspan=5 align='center' width='10%'><img src="<?php echo $image ?>" width='110' height='120'></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;<?php echo $xyz2 ?></td>
					<td>&nbsp;&nbsp;<?php echo $xyz7 ?></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;<?php echo $xyz3 ?></td>
			    	<td width="150"><?php echo  $xyz8 ?></td></tr>
		
				<tr>
					<td>&nbsp;&nbsp;<?php echo $xyz4 ?></td>
					<td>&nbsp;&nbsp;<?php echo $xyz9 ?></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;<?php echo $xyz5 ?></td>
					<td>&nbsp;&nbsp;<?php echo $xyz10 ?></td>
				</tr>

			</table>

		</td>
		<td width='40%'>
			<!-- for book details---->
			<table border='0' align='center' class='forumline' width='100%' height='158'>
				<tr>
					<td class='head' colspan='2' align='center'> Media details</td>
				</tr>
				<tr>
					<td width='18%'>&nbsp;&nbsp;<?php echo $aa ?></td>
					<td width='25%'>&nbsp;&nbsp;<?php echo $aa1?></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;<?php echo $bb ?></td>
					<td>&nbsp;&nbsp;<?php echo $bb1?></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;<?php echo $cc ?></td>
			    	<td >&nbsp;&nbsp;<?php echo  $cc1 ?></td></tr>
		
				<tr>
					<td>&nbsp;&nbsp;<?php echo $dd ?></td>
					<td>&nbsp;&nbsp;<?php echo $dd1 ?></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;<?php echo $ee ?></td>
					<td>&nbsp;&nbsp;<?php echo $ee1 ?></td>
				</tr>
			</table>

		</td>
	</tr>
</table>

		<table class=forumline align=center width='80%'>
		<tr>
			<td nowrap class="row3">Issued On</td>
			<td width="270" >
			<?php
			if($num7==0)
			{
				$d=getdate();
				$MyDay=$d["mday"];
				$MyMonth=$d["mon"];
				$MyYear=$d["year"];
				
				if($MyMonth < 10)
					$IMon="0".$MyMonth;
				if($MyDay < 10)
				{
					$IDay="0".$MyDay;
				}
				else
				{
					$IDay=$MyDay;
				}
				$IYear=$MyYear;
			}
			if($num7>0)
			{
			  $var1= explode("-",$i_date);
			  $IDay = $var1[2];
			  $IMon = $var1[1];
			  $IYear = $var1[0];
			}
			?>
			<input type="text" name="IDay" size="2" maxlength=2 value="<?php echo $IDay ?>">-
			<input type="text" name="IMon" size="2" maxlength=2 value="<?php echo $IMon ?>">-
			<input type="text" name="IYear" size="4" maxlength=4 value="<?php echo $IYear?>">&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td nowrap class="row3">Due Date</td>
			<td width="250" >
			<?php
			if($num7==0)
			{
			    $d=getdate();
			    $MyDay=$d["mday"];
			    $MyMonth=$d["mon"];
			    $MyYear=$d["year"];
			    $ndate= date(" Y-m-d",mktime(0,0,0,$MyMonth,$MyDay+14,$MyYear));
			    $due_date=explode("-",$ndate);
			    $MyDay=$due_date[2];
			    $MyMonth=$due_date[1];
			    $MyYear=$due_date[0];
			   
				$DDay=$MyDay;
				$DMon=$MyMonth;
				$DYear=trim($MyYear);
			}
			if($num7>0)
			{
			  $var2= explode("-",$d_date);

			  $DDay = $var2[2];
			  $DMon = $var2[1];
			  $DYear = $var2[0];
			}
			?>
        	<input type="text" name="DDay" size="2" maxlength=2 value="<?php echo $DDay?>">-
			<input type="text" name="DMon" size="2" maxlength=2 value="<?php echo $DMon?>">-
			<input type="text" name="DYear" size="4" maxlength=4 value="<?php echo $DYear?>">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<?php
        if($num7==0)
		{
		?>
		<tr><td align="left" width="170" class=row3>Remarks</td>
		<td align="left" width="202" colspan='3'><input type="text" name="remark" size="20"></td></tr>
		<?php
		}
        if($num7>0)
		{
		?>
		<tr><td align="left" width="170" class=row3>Remarks</td>
		<td align="left" width="202" ><input type="text" name="remark" size="20" value="<?php echo $row7[remarks]?>"></td>
		<td></td>
		<td></td>
		</tr>
		<?php
		}
		?>

<br>

<table border='0' align='center'  width='80%' >
	<tr>
		<td align='center'>
<?php //        <input type='button' name='Action' value='Issue' class="bgbutton" onclick='issueMe()' <?php echo $dis ?>
<input type='button' name='Action' value='Issue' class="bgbutton" onclick='issueMe()'>
</td>
<td align='center'>
<?php //		 <input type='button' name='Action' value='Return' class="bgbutton"onclick='retrunMe()' <?php echo $dis1?> 
 <input type='button' name='Action' value='Return' class="bgbutton"onclick='retrunMe()'>
</td>
	</tr>
</table>

	<table border='0' align='center' >
		<tr>
			<?php
			    //echo "<p>Number Value:$num7</p>";
				if($num7>0)
				{
					echo "<td><font color='darkyellow' size='2'><blink> Already Issued </blink></td>";
				}
				if($num7==0 && $aa1!="")
				{
					echo "<td><font color='green' size='2'><blink>Available</blink></td>";
				}
				if($accno!="" && $media!=0)
				{
				if($aa1=="")
				{
					echo "<td><font color='red' size='2'><blink>Details Not Found</blink></td>";
				}
				}

		?>
		</tr>
	</table>
	<input type='hidden' name='m_id' value='<?php echo $row[m_id] ?>' >
<?php
$bk=fetcharray(execute("select count(*) from lib_magazine where status='0' and magazine_no like 'M%'"));

$bk1=rowcount(execute("select a.id,b.id from lib_circulation_m a,lib_magazine b where a.status='0' and magazine_no like 'M%' and a.media_type=7 and a.acc_id=b.magazine_no"));

$cd=fetcharray(execute("select count(*) from lib_magazine where status='0' and magazine_no like 'J%'"));
$cd1=rowcount(execute("select a.id,b.id from lib_circulation_m a,lib_magazine b where a.status='0' and magazine_no like 'J%' and a.media_type=7 and a.acc_id=b.magazine_no"));

$flp=fetcharray(execute("select count(*) from lib_question_paper_det where flag='0'"));
$flp1=rowcount(execute("select a.id,b.id from lib_circulation_m a,lib_question_paper_det b where a.status='0' and a.media_type=8 and a.acc_id=b.id"));
?>
<table border='0' align='center' class='forumline' width='80%'>
<tr>
	<td class='head' colspan='4' align='center'> Magazine/Journal/Question Paper Available And Issued Details</td>
</tr>
<tr>
   <td>&nbsp;Media Type :-</td>
   <td align="center">Magazines</td>
   <td align="center">Journals</td>
   <td align="center">Question Papers</td>
</tr>
<tr>
   <td>&nbsp;Available :-</td>
   <td align="center"><?php echo $bk[0]?></td>
   <td align="center"><?php echo $cd[0]?></td>
   <td align="center"><?php echo $flp[0]?></td>
</tr>
<tr>
   <td>&nbsp;Issued :-</td>
   <td align="center"><?php echo $bk1?></td>
   <td align="center"><?php echo $cd1?></td>
   <td align="center"><?php echo $flp1?></td>
</tr>
</table>
<?php
if($msg==1)
{
	echo "<p align='center'>Media Issued Successfully</p>";
}
else if($msg==2)
{
	echo "<p align='center'>Media Returned Successfully</p>";
}
?>
</form>
</body>
</html>