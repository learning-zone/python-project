<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
require_once("../db.php");
if($_POST)
{
	$id=$_POST['id'];
	$LAST=$_POST['LAST'];
	$media=$_POST['media'];
	$PAGES=$_POST['PAGES'];
	$go_to=$_POST['go_to'];
	$SeekPos=$_POST['SeekPos'];
}
else
{
	$id=$_REQUEST['id'];
	$lib=$_REQUEST['lib'];
	$LAST=$_REQUEST['LAST'];
	$regt=$_REQUEST['regt'];
	$mode=$_REQUEST['mode'];
	$PAGES=$_REQUEST['PAGES'];
	$mtype=$_REQUEST['mtype'];
	$go_to=$_REQUEST['go_to'];
	$media=$_REQUEST['media'];
	$SeekPos=$_REQUEST['SeekPos'];
}
$_NUMREC_ = 15; // Number of result per page;
//Set the initial seek position
if(empty($SeekPos))
{
    $SeekPos = 0;
}
?>
<HTML>
<HEAD>
<script language="javascript">
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function checkIt(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!

	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT )
	{
		if((charCode >= 65456 && charCode <= 65465) || (charCode >= 96 && charCode <= 105)|| (charCode >= 49 && charCode <= 59))
		{
			return true
		}
		else
		{
			alert("Please make sure entries are numbers only.")
			return false
		}
	}
	return true
}
</script>
</HEAD>
<table  align='center' class=forumline width="90%">
<tr><td class='rowpic' align='center' colspan=10>
Media Report</td></tr>
<tr><td class='row3' align="center">Sl No.</td>
<td class='row3' nowrap align="center" >Q.Paper No</td>
<td class='row3' nowrap align="center">Course</td>
<td class='row3' nowrap align="center">Sem</td>
<td class='row3' nowrap align="center">Subject</td>
<td class='row3' nowrap align="center" >Month</td>
<td class='row3' nowrap align="center">Year</td>
<td class='row3' nowrap align="center">Scheme</td>
<td class='row3' nowrap align="center">Register</td>
<td class='row3' nowrap align="center">No of Pages</td>
</tr>
<?php
if($_GET['lib']=="1")
{    

	
$ssql="select question_paper_no,course,sem,subject,month,year,register,scheme,noupld from lib_question_paper_det where library='$lib'";
if($regt>0){
$ssql .= "and register='$regt'";	
}

$rs=execute($ssql); 
$cnt = 1;
while($row = mysql_fetch_assoc($rs))
  {
  
 ?>
 
 
<tr><td><?= $cnt++ ?></td>
<td nowrap><?= @$row['question_paper_no'] ?></td>

      <td nowrap> 
	
	   <?php


if($row[course]==0)
{
echo "First Year";
}
else
{

$rr1="select coursename from course_m where course_id='$row[course]'";
$rs12=execute($rr1);
$row1=fetcharray($rs12);
echo"$row1[coursename]";
}

?>
       
<td nowrap>
<?
$rr2="select year_name from course_year where year_id='$row[sem]'";
$rs13=execute($rr2);
$row2=fetcharray($rs13);
echo"$row2[year_name]";
echo"</td>";

?>

<td nowrap>
<?php
$rr3="select subject_name from subject_m where subject_id='$row[subject]'";
$rs14=execute($rr3);
$row3=fetcharray($rs14);
echo"$row3[subject_name]";
echo"</td>";
?>

<td nowrap><?php
if($row[month]==1)
{
echo "January";
}
if($row[month]==2)
{
echo "Feburary";
}if($row[month]==3)
{
echo "March";
}if($row[month]==4)
{
echo "April";
}if($row[month]==5)
{
echo "May";
}if($row[month]==6)
{
echo "June";
}if($row[month]==7)
{
echo "July";
}if($row[month]==8)
{
echo "August";
}
if($row[month]==9)
{
echo "Septmember";
}if($row[month]==10)
{
echo "October";
}if($row[month]==11)
{
echo "November";
}if($row[month]==12)
{
echo "December";
}
?>
<td><?= @$row['year'] ?></td>
<td><?= @$row['scheme'] ?></td>
<td nowrap>
            <?php 
		$r_sql=fetcharray($row);
		
	    $rsql=execute("select register from lib_register where id='$row[register]'");
	
         $rs2=fetcharray($rsql);

	     echo "$rs2[register]";
	
		?>
<td><?= @$row['noupld'] ?></td>
</tr>
<?php
	
	}
	}


else 
{
	$ssql="select question_paper_no,course,sem,subject,month,year,register,scheme,noupld from lib_question_paper_det order by course,sem,subject,month";
 
$rs_sql=execute($ssql);
$rs=execute($ssql); 
$cnt = 1;
while($row = mysql_fetch_assoc($rs))
  {
  
 ?>
 
 
<tr><td><?= $cnt++ ?></td>
<td nowrap><?= @$row['question_paper_no'] ?></td>

      <td nowrap> 
	
	   <?php


if($row[course]==0)
{
echo "First Year";
}
else
{

$rr1="select coursename from course_m where course_id='$row[course]'";
$rs12=execute($rr1);
$row1=fetcharray($rs12);
echo"$row1[coursename]";
}

?>
       
<td nowrap>
<?
$rr2="select year_name from course_year where year_id='$row[sem]'";
$rs13=execute($rr2);
$row2=fetcharray($rs13);
echo"$row2[year_name]";
echo"</td>";

?>

<td nowrap>
<?php
$rr3="select subject_name from subject_m where subject_id='$row[subject]'";
$rs14=execute($rr3);
$row3=fetcharray($rs14);
echo"$row3[subject_name]";
echo"</td>";
?>

<td nowrap><?php
if($row[month]==1)
{
echo "January";
}
if($row[month]==2)
{
echo "Feburary";
}if($row[month]==3)
{
echo "March";
}if($row[month]==4)
{
echo "April";
}if($row[month]==5)
{
echo "May";
}if($row[month]==6)
{
echo "June";
}if($row[month]==7)
{
echo "July";
}if($row[month]==8)
{
echo "August";
}
if($row[month]==9)
{
echo "Septmember";
}if($row[month]==10)
{
echo "October";
}if($row[month]==11)
{
echo "November";
}if($row[month]==12)
{
echo "December";
}
?>
<td><?= @$row['year'] ?></td>
<td><?= @$row['scheme'] ?></td>
<td nowrap>
            <?php 
		$r_sql=fetcharray($row);
		
	    $rsql=execute("select register from lib_register where id='$row[register]'");
	
         $rs2=fetcharray($rsql);

	     echo "$rs2[register]";
	
		?>
<td><?= @$row['noupld'] ?></td>
</tr>
<?php
}

}

$rs_sql=execute($ssql);
$countRS = rowcount($rs_sql);
if($countRS==0)
{
	die ("No Records");
}

else
{
	mysql_data_seek($rs_sql,$SeekPos); //Move the data pointer to the next position.
	if( ($SeekPos + $_NUMREC_) > $countRS)
	{
		$MAX = $countRS;
	}
	else
	{
		$MAX = $SeekPos + $_NUMREC_ ;
	}
	if( ($SeekPos + $_NUMREC_) >= $countRS)
	{
		$NEXT = $SeekPos;
	}
	else
	{
		$NEXT  = $SeekPos + $_NUMREC_ ;
	}
	if( ($SeekPos - $_NUMREC_)  > 0)
	{
		$PREV = $SeekPos - $_NUMREC_;
	}
	else
	{
		$PREV = 0;
	}
	$PAGES = $countRS / $_NUMREC_;
	if($countRS % $_NUMREC_)
	{
		$PAGES++;
	}
	$LAST = ((int) $PAGES - 1) * $_NUMREC_;
	$SeelPos=$PAGES;
	$slno=$SeekPos+1;
	
	?>
	<tr>
	</tr>
	<?php
}
?>

</table>
<form name="frm" action="brief_med_rep1.php">
<input type="hidden" name="id" value="<?php echo $id?>">
<input type="hidden" name="SeekPos" value="<?php echo $SeekPos?>">
<input type="hidden" name="LAST" value="<?php echo $LAST?>">
<input type="hidden" name="media" value="<?php echo $media?>">
<input type="hidden" name="PAGES" value="<?php echo $PAGES?>">
<input type=hidden name=media value='<?=$media?>'>

<input type=hidden name=lib value='<?=$lib?>'>
<input type=hidden name=regt value='<?=$regt?>'>
<input type=hidden name=mtype value='<?=$mtype?>'>
<input type=hidden name=mode value='<?=$mode?>'>
<div align="center">
<table width="10%" border="0" cellspacing="2" cellpadding="1" align='center'>
<tr><td colspan="4" align="center">Go To
<input type="text" name="go_to" value="<?php echo  ($SeekPos / $_NUMREC_) +1?>" size="3" onKeydown="return checkIt(event)">
<input type="button" name="but_go_to" value="Go" onClick="fun_go_to()"  ></td></tr>
 <tr>
	 <td title="First"><a href="Javascript:first()"><<</td>
	 <td title="Previous"><a href="Javascript:prev()"><</td>
	 <td title="Next"><a href="Javascript:next()">></td>
	 <td title="Last"><a href="Javascript:last()">>></td>
 </tr>
</table>
</div>
<div align="center">
Page <?php echo  ($SeekPos / $_NUMREC_) +1?> of <?php echo (int) $PAGES?></div>
<script language="JavaScript">
function fun_go_to()
{
	if((document.frm.go_to.value==0)||(document.frm.go_to.value=="")||(parseInt(document.frm.go_to.value) > parseInt(document.frm.PAGES.value) ))
	{
		alert("Page not found");
	}
	else
	{
		document.frm.SeekPos.value = (parseInt(document.frm.go_to.value)-1)* 15;
		document.frm.submit();
	}
}
</script>
<script language="JavaScript">
	function first()
		{
			//alert("first");
			var i;
            i = 0;
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
	function prev()
		{
			//alert("prev");
			var i;
            i = "<?=$PREV?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
    function next()
		{
			//alert("next");
		    var i;
            i = "<?=$NEXT?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
	function last()
		{
            //alert("last");
			var i;
            i = "<?=$LAST?>";
		    document.frm.SeekPos.value = i;
            document.frm.submit();
		}
</script>
</form>
</body>
</html>