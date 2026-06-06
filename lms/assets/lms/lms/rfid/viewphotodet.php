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
$vewdet=execute("select * from student_m where id='$stid'");
while($viewsetss=fetcharray($vewdet))
{
	?>
    <tr>
    <td nowrap>&nbsp;<b>Student:</b></td>
    <td nowrap>&nbsp;
	 <a href="id_card2.php?id=<?=$viewsetss[id]?>">
     <a href="javascript:void(0);" onClick ="OpenWind3('id_card2.php?id=<?=$stid?>', 'OpenWind3',800,500)">
	<?=$viewsetss[first_name]?>&nbsp;<?=$viewsetss[last_name]?></a>&nbsp;&nbsp;&nbsp;
	 <a href="id_card2.php?id=<?=$viewsetss[id]?>">
     <a href="javascript:void(0);" onClick ="OpenWind3('../rfid/rfid_det.php?StudID=<?=$stid?>', 'OpenWind3',800,500)"><input type="button" class="bgbutton" value="Personalize" name="Personalize"></a>
    </td>
    <td align="center"><img src="<?php echo $viewsetss[img_source]?>"  height='80'></td>
    </tr>
    <?
}
?>
<?php
$gurds=execute("select a.parent_name,a.m_name,a.g_name,b.f_photo,b.m_photo,b.g_photo from student_m a,student_photo b where a.id='$stid' and b.studid=a.id group by b.f_photo");
while($gurdsts=fetcharray($gurds))
{
	?>
    <tr>
    <td nowrap>&nbsp;<b>Father:</b></td>
    <td nowrap>&nbsp;
	     <a href="javascript:void(0);" onClick ="OpenWind3('id_card2d.php?id=<?=$stid?>&cnfm_id=d1', 'OpenWind3',800,500)">
	<?=$gurdsts[0]?>
    </a>
    &nbsp;&nbsp;&nbsp;
	 <a href="id_card2.php?id=<?=$viewsetss[id]?>">
     <a href="javascript:void(0);" onClick ="OpenWind3('../rfid/rfid_detf.php?StudID=<?=$stid?>&cnfm_id=d1', 'OpenWind3',800,500)"><input type="button" class="bgbutton" value="Personalize" name="Personalize"></a>
    </td>
    <td align="center"><img src="<?php echo $gurdsts[3]?>"  height='80'></td>
    </tr>
    <tr>
    <td nowrap>&nbsp;<b>Mother:</b></td>
    <td nowrap>&nbsp;
	     <a href="javascript:void(0);" onClick ="OpenWind3('id_card2m.php?id=<?=$stid?>&cnfm_id=m1', 'OpenWind3',800,500)">
	<?=$gurdsts[1]?>
    </a> &nbsp;&nbsp;&nbsp;
	 <a href="id_card2.php?id=<?=$viewsetss[id]?>">
     <a href="javascript:void(0);" onClick ="OpenWind3('../rfid/rfid_detm.php?StudID=<?=$stid?>&cnfm_id=m1', 'OpenWind3',800,500)"><input type="button" class="bgbutton" value="Personalize" name="Personalize"></a>
    </td>
    <td align="center"><img src="<?php echo $gurdsts[4]?>"  height='80'></td>
    </tr>
    <tr>
    <td >&nbsp;<b>Guardian:</b></td>
    <td nowrap> &nbsp;
	     <a href="javascript:void(0);" onClick ="OpenWind3('id_card2g.php?id=<?=$stid?>&cnfm_id=g1', 'OpenWind3',800,500)">
	<?=$gurdsts[2]?>
    </a> &nbsp;&nbsp;&nbsp;
	 <a href="id_card2.php?id=<?=$viewsetss[id]?>">
     <a href="javascript:void(0);" onClick ="OpenWind3('../rfid/rfid_detc.php?StudID=<?=$stid?>&cnfm_id=g1', 'OpenWind3',800,500)"><input type="button" class="bgbutton" value="Personalize" name="Personalize"></a>
    </td>
    <td align="center"><img src="<?php echo $gurdsts[5]?>"  height='80'></td>
    </tr>
    <?
}
?>
<?php
$i=1;
$other_gurds=execute("select relation,s_name,s_photo,id from student_photo_other where  studid='$stid' and status=1");
while($other_gurdsts=fetcharray($other_gurds))
{
	?>
    <tr>
    <td  nowrap>&nbsp;<b><?=$other_gurdsts[0]?></b></td>
    <td align="center">
    <br>
	     <a href="javascript:void(0);" onClick ="OpenWind3('id_card2cr.php?id=<?=$stid?>&other_id=<?=$other_gurdsts[3]?>&cnfm_id=oth1', 'OpenWind3',800,500)">
	<?=$other_gurdsts[1]?></a>
    &nbsp;&nbsp;&nbsp;
	 <a href="id_card2.php?id=<?=$viewsetss[id]?>">
     <a href="javascript:void(0);" onClick ="OpenWind3('../rfid/id_cardgc.php?StudID=<?=$stid?>&countid=<?=$i?>&cnfm_id=g1', 'OpenWind3',800,500)"><input type="button" class="bgbutton" value="Personalize" name="Personalize"></a>
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
