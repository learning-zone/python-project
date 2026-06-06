<?php
require_once("../db.php");
  //print_r($_GET);
  //print_r($_POST);
  //print_r($_REQUEST);
  if($_POST)
  {
	$action1=$_POST['action1'];
	$media=$_POST['media']; 
	$library=$_POST['library'];
	$register=$_POST['register'];
	$Sel=$_POST['Sel'];
	$fr_dd=$_POST['fr_dd'];
	$fr_mm=$_POST['fr_mm'];
	$fr_yy=$_POST['fr_yy'];
	$to_dd=$_POST['to_dd'];
	$to_mm=$_POST['to_mm'];
	$to_yy=$_POST['to_yy'];
  }
  if($_REQUEST)
  {
 	$action=$_REQUEST['action'];
	$media=$_REQUEST['media'];
  }
?>
<?php
$cdate = date("Y-m-d");
if($media>0)
 $sql1="select * from lib_reservation_temp where end_date >='$cdate' and media_type='$media' order by accno";
else
	$sql1="select * from lib_reservation_temp where end_date >='$cdate' order by accno";
	
//echo $sql1;
$rs1 = execute($sql1);
$row1=rowcount($rs1);
//echo $row1;
if($row1 > 0)
{
	?>
	<html>
    <head></head>
    <BODY>
	<table width="90%" class='forumline' align="center">
	<tr><td colspan='6' align="center" Class="head">View Reservation Details</td></tr>
    <form action="deleteReservation.php" method="POST">
	<input type="hidden" name="fr_dd" value="<?=$fr_dd?>">
	<input type="hidden" name="fr_mm" value="<?=$fr_mm?>">
	<input type="hidden" name="fr_yy" value="<?=$fr_yy?>">

	<input type="hidden" name="to_dd" value="<?=$to_dd?>">
	<input type="hidden" name="to_mm" value="<?=$to_mm?>">
	<input type="hidden" name="to_yy" value="<?=$to_yy?>">

	<tr>
		<td width="82" align="center" class="rowpic">Select</td>
		<td width="402" align="center" class="rowpic">Title</td>
		<td width="108" align="center" class="rowpic">Accession Number</td>
		<td width="171" align="center" class="rowpic">Media Type</td>
		<td width="82" align="center" class="rowpic">Card No</td>
		<td width="235" align="center" class="rowpic">Reserved Date</td>
	</tr>
	
<?php
for($i=0;$i<$row1;$i++)
{
	$r1 = fetcharray($rs1,$i);
	
	######## TO DISPLAY ARRAY CONTENTS #########
	/*
	foreach($r1 as $key){
	echo $key;
	echo "<br/>";
	}*/
	#############################################
	//echo $r1[id];
	//echo $r1[l_id];

	$sql="select distinct(b.mbno),a.title,c.resdate,c.id,d.acc_no,d.media_type from lib_cd_det a,lib_membership_det b,";
	$sql.="lib_reservation_temp c,lib_cd_acc_det d where b.mbno=c.m_id and a.id=d.master_id and c.l_id=d.acc_no and ";
	$sql.="c.id=".$r1[id]." and d.acc_no=$r1[l_id] order by c.resdate";
	//echo $sql."<br>";
	$rs=execute($sql);
	$row=rowcount($rs);
	//echo $row;
	if($row ==0)
	{
		$sql="select a.title,c.resdate,c.id,d.acc_no,d.media_type from lib_book_details a,";
		$sql.="lib_reservation_temp c,lib_acc_details d where a.id=d.master_id and c.accno=d.acc_no and ";
		$sql.="c.id=".$r1[id]." order by c.resdate";
		$rs=execute($sql);
		$row=rowcount($rs);
		//echo $row;
		if($row ==0)
		{
			$sql="select distinct(b.mbno),a.title,c.resdate,c.id,d.acc_no,d.media_type from lib_project_report_det a,";				
			$sql.="lib_membership_det b,lib_reservation_temp c,lib_proj_acc_det d where b.mbno=c.m_id and a.id=d.master_id and ";
			$sql.="c.l_id=d.acc_no and c.id=".$r1[id]." and d.acc_no=$r1[l_id] order by c.resdate";				
			$rs = execute($sql);
			$row=rowcount($rs);
			//echo $row;
			if($row==0)
			{
				$sql="select distinct(b.mbno),a.title,c.resdate,c.id,a.acc_no,d.bound_type from lib_bound_media_det a,";
				$sql.="lib_membership_det b,lib_reservation_temp c,lib_bound_acc_det d where b.mbno=c.m_id and a.id=d.master_id and ";
				$sql.="c.l_id=a.acc_no and c.id=".$r1[id]." and a.acc_no=$r1[l_id] order by c.resdate";
				$rs = execute($sql);
				$row=rowcount($rs);
			}
		}
	}
	$r=fetcharray($rs);
	$b=strtotime($r["resdate"]);
	$c=strtotime(date("d,m,y 00:00"));
	$dt=(($b-$c)/86400);
	if ( $dt >= 7 )
	{
		$str1 = "";
		$str2 .= "";
	}
	else
	{
		$str1 = "" ;
		$str2 .= "" ;
	}
	$resdate=explode("-",$r["resdate"]);
	?>
	<tr>
	<td width="82" align="center" class="CBody"><input type="checkbox" name="Sel[]" value="<?=$r["id"]?>"></td>
	<td width="402" align="center" class="CBody"><?php echo $str1 ?><?php echo $r["title"] ?>  <?php echo $str2 ?></td>
	<td width="108" align="center" class="CBody"><?php echo $r["acc_no"] ?> <?php echo $str2 ?></td>
	<td width="171" align="center" class="CBody">
		<?php
			
			echo $r[media_type];
			
			if($r[media_type]==1)
			{
				echo "Book";
			}
			elseif($r[media_type]==2)
			{
				echo "Book CD";
			}
			elseif($r[media_type]==3)
			{
				echo "Floppy";
			}
			elseif($r[media_type]==4)
			{
				echo "Other CD";
			}
			elseif($r[media_type]==5)
			{
				echo "Project";
			}
			else
			{
				echo "Bound Volume";
			}
			?>	</td>
	<td width="82" align="center" class="CBody"><?php echo $r["mbno"] ?></td>
	<td width="235" align="center" class="CBody"><?php echo $resdate[2]."-".$resdate[1]."-".$resdate[0] ?></td>
</tr>
<?php
}
?>
<tr>
	
</tr>
</table>
<br>
<div align="center"><input type="submit" class='bgbutton' value=" Delete Reservation "></div>
<?php
}
else
{
?>
<div align="center" class="label">There are no reservations in the list.</div>
<?php
}
?>
<input type="hidden" name="library" value="<?=$library?>">
</BODY>
</HTML>