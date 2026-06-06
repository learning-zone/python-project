<html>
<head>
<?php
	session_start();
	include("../db.php");
	$branch=$_POST['branch'];
	$sem=$_POST['sem'];
	$app_no=$_POST['app_no'];
	$student_id=$_GET['student_id'];
	$academic_year=$_SESSION['AcademicYear'];
	$stid=$_GET['stid'];
	$stid=$_POST['stid'];
//	print_r($_GET);
//	print_r($_POST);
	
?>

<script language='javascript'>
	function OpenWind3(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left)
}
</script>

</head>
<body>
<form method='post'  name="frm1" >
<input type="hidden" name="app_no" value="<?php echo $app_no?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
<input type="hidden" name="sem" value="<?php echo $sem ?>">
<input type="hidden" name="studfname" value="<?php echo $studfname ?>">
<input type="hidden" name="a_year" value="<?php echo $a_year?>">
<input type="hidden" name="un" value="<?php echo $un ?>">
<br>
<table border=1 class=forumline align=center width='70%' cellspacing=0 cellpadding=0>
<tr>
<td align='center' class='head' colspan='4'>Detail View</td>
</tr>
<?php
$vewdet=mysql_query("select * from student_m where id='$stid'");
while($viewsetss=mysql_fetch_array($vewdet))
{
	?>
    <tr>
    <td  nowrap>&nbsp;<b>Student:</b></td>
    <td colspan="2">&nbsp;
	 <a href="id_card2.php?id=<?=$viewsetss[id]?>">
     <a href="javascript:void(0);" onClick ="OpenWind3('id_card2.php?id=<?=$stid?>', 'OpenWind3',800,500)">
	<?=$viewsetss[first_name]?>&nbsp;<?=$viewsetss[last_name]?></a>
    </td>
    <td align="center"><img src="<?php echo $viewsetss[img_source]?>"  height='80'></td>
    </tr>
    <?
}
?>
<?php
$gurds=mysql_query("select a.parent_name,a.m_name,a.g_name,b.f_photo,b.m_photo,b.g_photo from student_m a,student_photo b where a.id='$stid' and b.studid=a.id");
while($gurdsts=mysql_fetch_array($gurds))
{
	?>
    <tr>
    <td  nowrap>&nbsp;<b>Father:</b></td>
    <td colspan="2">&nbsp;
	     <a href="javascript:void(0);" onClick ="OpenWind3('id_card3.php?id=<?=$stid?>&cnfm_id=d1', 'OpenWind3',800,500)">
	<?=$gurdsts[0]?>
    </a>
    </td>
    <td align="center"><img src="<?php echo $gurdsts[3]?>"  height='80'></td>
    </tr>
    <tr>
    <td  nowrap>&nbsp;<b>Mother:</b></td>
    <td colspan="2">&nbsp;
	     <a href="javascript:void(0);" onClick ="OpenWind3('id_card3.php?id=<?=$stid?>&cnfm_id=m1', 'OpenWind3',800,500)">
	<?=$gurdsts[1]?>
    </a>
    </td>
    <td align="center"><img src="<?php echo $gurdsts[4]?>"  height='80'></td>
    </tr>
    <tr>
    <td  nowrap>&nbsp;<b>Guardian:</b></td>
    <td colspan="2">&nbsp;
	     <a href="javascript:void(0);" onClick ="OpenWind3('id_card3.php?id=<?=$stid?>&cnfm_id=g1', 'OpenWind3',800,500)">
	<?=$gurdsts[2]?>
    </a>
    </td>
    <td align="center"><img src="<?php echo $gurdsts[5]?>"  height='80'></td>
    </tr>
    <?
}
?>
<?php
$other_gurds=mysql_query("select relation,s_name,s_photo,id from student_photo_other where  studid='$stid' and status=1");
while($other_gurdsts=mysql_fetch_array($other_gurds))
{
	?>
    <tr>
    <td nowrap>&nbsp;<b><?=$other_gurdsts[0]?></b></td>
    <td>&nbsp;<font color="#0000FF">Bule color</font>
    <br>
        <a href="javascript:void(0);" onClick ="OpenWind3('id_card3.php?id=<?=$stid?>&other_id=<?=$other_gurdsts[3]?>&cnfm_id=oth1', 'OpenWind3',800,500)">
        <?=$other_gurdsts[1]?>
        </a>
    </td>
    <td>&nbsp;<font color="#FF9900">Orange color</font>
    <br>
        <a href="javascript:void(0);" onClick ="OpenWind3('id_card3.php?id=<?=$stid?>&other_id=<?=$other_gurdsts[3]?>&cnfm_id=oth1&color=1', 'OpenWind3',800,500)">
        <font color="#FF9900"><?=$other_gurdsts[1]?></font>
        </a>
    </td>
    <td align="center"><img src="<?php echo $other_gurdsts[2]?>"  height='80'></td>
    </tr>
    <?
}
?>
</table>
<br>
<!--<div align='center'><input type="submit" class='bgbutton' value="Submit" name="studdet"></div>
--></form>
</body>
</html>
