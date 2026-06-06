<html>
<head>
<Script language="JavaScript">
	function RefreshMe(val)
	{
		document.frm.action="reflection.php";
		document.frm.submit();
	}
</script>
  <script language="javascript" src="cal2.js"></script>
  <script language="javascript" src="cal_conf2.js"></script>

<?php
	session_start();
	include("../db.php");
	$accyeardet=$_SESSION['AcademicYear'];
	//print_r($_POST);
if($_POST)
{
	$course=$_POST['course'];
	$sem=$_POST['sem'];
	$examname_m=$_POST['examname_m'];
}
else
{
	$course=$_SESSION['branch'];
	$sem=$_SESSION['sem'];
	$user=$_POST['user'];
}
	$comments=$_POST['comments'];
	$cas=$_POST['cas'];
	$fdate=$_POST['fdate'];
	$adate=$_POST['adate'];
	$examname_m=$_POST['examname_m'];
	
if($_POST['update'])
{
	
	$tfdate=explode('/',$adate);
	$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];

	$cid=$_POST['cid'];
	for($i=0;$i<sizeof($cid);$i++)
	{
		$comments=$_POST['comments'.$cid[$i]];
		$cas=$_POST['cas'.$cid[$i]];
		$fdate=$_POST['fdate'.$cid[$i]];
        execute("update dp_refection set comments='".addslashes($comments)."',adate='$fdate',cas='$cas' where id='$cid[$i]'");	
	}
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php		
}
if(isset($_POST['save']))
{
if($cas!='')
{
	$sql2=execute("select * from dp_refection where  class='$sem' username='$user' and examid='$examname_m'");
	if(mysql_num_rows($sql2)>=1)
	{
		?>
		<Script language="JavaScript">
		alert("C/A/S Not be Null");
		</Script>
		<?php
	}
	else
	{
		$tfdate=explode('/',$adate);
		$fdate=$tfdate[2]."-".$tfdate[1]."-".$tfdate[0];
 
 		$sql5="INSERT INTO dp_refection (username,class,cas,comments,examid,adate,status) VALUES ('$user','$sem', '$cas', '".addslashes($comments)."','$examname_m','$fdate',1)";
		execute($sql5);
		?>
		<Script language="JavaScript">
		alert("Updated successfully");
		</Script>
		<?php
		}
		}
		else
		{
		?>
		
		<SCRIPT LANGUAGE="JavaScript">
	alert("Enter C/A/S");
	</script>
	
		<?php
			
	}
}
?>

</head>
<body class='bodyline'>
<form method="post" name="frm">
<input type="hidden" name="flag" value="<?=$flag?>">
<input type="hidden" name="user" value="<?=$user?>">
<input type="hidden" name="sem" value="<?=$sem?>">
<input type="hidden" name="userid" value="<?=$userid?>">
<table align='center' class='forumline' width='70%' >

<tr>
  <td colspan=2 align='center' class='head'>REFLECTIONS</td></tr>
<tr>
<?
$sem=$_SESSION['sem'];
?>
<td>&nbsp;&nbsp;Exam</td><td><select name="examname_m" onChange="RefreshMe(0)">
	<option value="0">Select  </option>
<?php
	echo $sql3=execute("SELECT id, descr FROM `exam_m` where `class`='$sem' and sts=1 ");
	for($j=0;$j<rowcount($sql3);$j++)
	{
		$r3=fetcharray($sql3,$j);
		if($r3[0]==$examname_m)
		{
			echo "<option value=$r3[0] selected>$r3[1]</option>";
		}
		else
		{
			echo "<option value=$r3[0]>$r3[1]</option>";
		}
	}
?>
</select>
</td>
</tr>
</table>
<?php
$examname_m=$_POST['examname_m'];

	
if($examname_m=='0' ||  $examname_m=='' )
{
die();
}
?>
<br>
<table align='center' class='forumline' width='70%' border="1" >
	<tr>
		<td align='center' class='head' nowrap>Date</td>
		<td align='center' class='head' nowrap>C/A/S</td>
		<td align='center' class='head' nowrap>REFLECTIONS</td>        
	</tr>
	<tr>
      <td align='center' nowrap>
    <input type="text" name="adate" size="10%" value="" >&nbsp;&nbsp;
		<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>		</td>
       <td align='center' nowrap>
          <input size="10%" type='text' name='cas' value=''>
		</td>
        <td align='center' nowrap>
        <textarea name="comments" cols="60" rows="2"></textarea>
	</tr>
</table>
<br>
  <div align='center' >
  <input type="submit" name="save" value="SAVE"  class='bgbutton'></div>
  <br>
    <?php
$sql3=execute("select id,adate,cas,comments from dp_refection where  class='$sem' and username='$user' and examid='$examname_m'");
if(mysql_num_rows($sql3)>=1)
{	
	?>
<br>
<table align='center' class='forumline' width='70%' border="1" >
<tr>
		<td align='center' class='head' nowrap>Sel</td>
		<td align='center' class='head' nowrap>Date</td>
		<td align='center' class='head' nowrap>C/A/S</td>
		<td align='center' class='head' nowrap>REFLECTIONS</td>        
	</tr>
	<?php
	$i=2;
	while($r6=fetcharray($sql3))
	{
	echo "<tr><td align='center'  nowrap><input type='checkbox' name='cid[]' value='$r6[0]'>
		</td>
		 <td align='center' nowrap>
        <input type='text' size='10%' name='adate$r6[0]' value='$r6[1]'>";
		?>
		<a href="javascript:showCal('Calendar<?=$i?>')"><img src="../images/calendar.jpg" align="absmiddle" ></a>		</td>
		<?
		echo "</td>
		 <td align='center' nowrap>
        <input type='text' size='10%' name='cas$r6[0]' value='$r6[2]'>
		</td>        
        <td align='center' nowrap>
        <textarea name='comments$r6[0]' cols='60' rows='2'>$r6[3]</textarea>
		</td></tr>";
		$i++;
	}
	?>
	<?php
	?>
	</table>
    <br>
  <div align='center' >
  <input type="submit" name="update" value="UPDATE"  class='bgbutton'></div>
	<?php
}
?>	
 
	</form></body></html>

