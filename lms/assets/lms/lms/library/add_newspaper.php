<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
session_start();
require_once("../db.php");

$dd=$_POST['dd'];
$mm=$_POST['mm'];
$yy=$_POST['yy'];
$act=$_POST['act'];
$title=$_POST['title'];
$idttl=$_POST['idttl'];
$copies=$_POST['copies'];
$amount=$_POST['amount'];
$l_name=$_POST['l_name'];
$r_name=$_POST['r_name'];
$remarks=$_POST['remarks'];
$library=$_POST['library'];
$language=$_POST['language'];
$newspaper_no=$_POST['newspaper_no'];
$magazine_sub_no=$_POST['magazine_sub_no'];
?>
<html>
<head>
<Script language="JavaScript">
function addnew()
{
	document.frm.action="newspaper.php?actn=1";
	document.frm.submit();
}
function modnew()
{
	document.frm.action="newspaper.php?actn=2";
	document.frm.submit();
}
function delnew()
{
	document.frm.action="newspaper.php?actn=3";
	document.frm.submit();
}
function frmsubmit()
{
	document.frm.action="add_newspaper.php";
	document.frm.submit();
}
</script>
</head>
<body>
<div>
<?php
if($act==1)
{
	$sel3="selected";
	$sel4="";
}
elseif($act==2)
{
	$sel3="";
	$sel4="selected";
}
?>
<form method="POST" name="frm">
<table border='1' align='center'class='forumline' width="47%">
  <tr>
    <br/><td class='head' colspan='2' align='center'>Add/Modify Newpaper Details</td>
  </tr>
  <tr>
		<td>&nbsp;&nbsp;&nbsp;Subsciption No.</td>
		<td>
			
		<select name="magazine_sub_no" onchange='frmsubmit()'>
		<option value=0>Select Subscription No</option>
		<?php
		
		$rsql23=execute("select distinct(title),id from lib_magazine_subscription where title!='' and ssp_type='3' and stts=1") or die(mysql_error());
		$ddd=rowcount($rsql23);
		
		    for($fd=0;$fd<$ddd;$fd++)
			{
				$rrs3=fetcharray($rsql23,$fd);
				$sel="";
				if($rrs3[id]==$magazine_sub_no)
					{
						$sel="selected";
					}
		?>
		<option value="<?php echo $rrs3[id]?>" <?php echo $sel?>><?php echo $rrs3[id]."-".$rrs3[title]?></option>
		<?php
			}
		?>
		</select></td>
  <tr> 
    <td>&nbsp;&nbsp;&nbsp;Action</td>
    <td><select name='act' onchange='frmsubmit()'>
	<option value='0'>--Select Action Type--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
	<option value='1' <?php echo $sel3 ?>>Add</option>
	<option value='2' <?php echo $sel4 ?>>Modify/Inactive</option>
	</select></td>
  </tr>
</table>
<br>
<?php
if($act==1 && $magazine_sub_no!="")
{
	$rsql24=execute("select * from lib_magazine_subscription where id='$magazine_sub_no' and ssp_type='3'");
	if(rowcount($rsql24)>0)
	{		
		$rs1 = fetcharray($rsql24);
		$sql="select max(id) from lib_newspaper_det";
		$rs=execute($sql);
		$newid = fetcharray($rs);
		$magazin=$newid[0]+1;
		
		$library=$rs1[library];
		$register1=$rs1[register];
		$lsql=execute("select name from library_name where id='$rs1[library]' ");
		$l_name=fetcharray($lsql);
		$rsql=execute("select register from lib_register where id='$rs1[register]' ");
		$r_name=fetcharray($rsql);
		?>
		<table border='1' align='center'class='forumline'>
		<tr>
		<td class='head' colspan='4' align='center'>Add Newpaper Details</td>
	  </tr>
      <?php
	  /*
		<tr height='20'>
		<td>
		Library
		</td>
		<td>&nbsp;&nbsp;<?php echo $l_name[0]?></td>
		<td>egister</td>
		<td>&nbsp;&nbsp;<?php echo $r_name[0]?></td></tr>
		*/
			$library=1;
$Register=1;
		?>
	<tr height='20'>
		<td>News Paper No</td>
		<td colspan="3"><?php echo $magazin ?>
	    <input type="hidden" name="newspaper_no" value="<?php echo $rs1[id] ?>"></td>
	</tr>
	<tr height='20'>
		<td>&nbsp;&nbsp;&nbsp;Name </td>
	    <td ><?php echo $rs1[title]?>
        <input type="hidden" name="title" value="<?php echo $rs1[title] ?>"></td>
		<td>Language</td>
		<td><?php echo $rs1[language] ?>
        <input type="hidden" name="language" value="<?php echo $rs1[language] ?>"></td>
        
         <input type="hidden" name="library" value="<?php echo $rs1[library] ?>">
	</tr>
    <tr height='20'>
		<td>&nbsp;&nbsp;&nbsp;Date</td>
		<td>
		<?php
		if($dd=="")
			$dd=date("d");
		echo "<select name='dd' onchange='frmsubmit()'>";
		for($i=1;$i<=31;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$dd)
				  echo "<option value='$i' selected>$i</option>\n";
				else
				  echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
		if($mm=="")
		$mm=date("m");
		echo "<select name='mm' onchange='frmsubmit()'>";
		for($i=1;$i<=12;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$mm)
				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				else
				echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
		echo "</select>";
		$maxYr =date("Y")+1;
		$st=date("Y")-4;
		if($yy=="")
			$yy=date("Y");
		echo "<select name='yy' onchange='frmsubmit()'>";
		for($i=$st;$i<=$maxYr;$i++)
			{
				if($i==$yy)
				echo "<option value='$i' selected>$i</option>\n";
				else
				echo "<option value='$i' >$i</option>\n";
			}
		echo "</select></td>";
		$dtt=$yy."-".$mm."-".$dd;
		$day_cal = date("l",strtotime($dtt));
		?>
		<td>Day</td>
		<td><?php echo $day_cal ?></td>
	</tr>

	<tr height='20'>
		<td>&nbsp;&nbsp;&nbsp;Price</td>
		<td>
		<input type="text" name="amount" value="<?php echo $amount ?>" size='8'></td>


		<td>No of Copies</td>
		<td>
		<input type="text" name="copies" value="<?php echo $copies ?>" size='5'></td>
	</tr>

	<tr height='20'>
		<td>&nbsp;&nbsp;&nbsp;Remarks</td>
		<td colspan='3'>
		<textarea name='remarks' rows=3 cols=50><?php echo $remarks?></textarea></td>
	</tr>
</table>
<br>
<div align=center><p align="center">
		<input type="button" name="add" value="     Add    " onClick="addnew()" class=bgbutton></p></div>
<?php
		}
}
if($act==2 && $magazine_sub_no!="")
{
	?>
	<table align='center' class='forumline'>
		<tr>
		<td class='head' colspan='4' align='center'>Modify Newpaper Details</td>
	  </tr>
		<tr>
			<td colspan='4' align="center">Select ID/Date&nbsp;
			<select name='idttl' onchange='frmsubmit()'>
			<option value=''>---Select--</option>
			<?php
			$sql="select id,newspaper_date from lib_newspaper_det where newspaper_no='$magazine_sub_no' and stts=1 order by id";
			$rs=execute($sql);
			while($r=fetcharray($rs))
			{
				$dt=explode("-",$r[newspaper_date]);
				$dte="(".$dt[2]." ". MonthName($dt[1])." ".$dt[0].")";
				$idttl1=$r[id]."-".$dte;
				$newid=$r[id];
				if($idttl==$newid)
				{
					echo "<option value=$newid selected>$idttl1</option>";
				}
				else
				{
					echo "<option value=$newid>$idttl1</option>";
				}
			}
			?>
			</td>
		</tr>
	<?php
		if($idttl!='')
		{
			$r= fetcharray(execute("select * from lib_newspaper_det where id='$idttl'"));
			$rs1 = fetcharray(execute("select * from lib_magazine_subscription where id='$magazine_sub_no' and ssp_type='3'"));
			$magazin=$idttl;
			$library=$rs1[library];
			$register1=$rs1[register];
			$lsql=execute("select name from library_name where id='$rs1[library]' ");
			$l_name=fetcharray($lsql);
			$rsql=execute("select register from lib_register where id='$rs1[register]' ");
			$r_name=fetcharray($rsql);
			?>
			
            <?php
			/*
            <td>Library</td>
            <td>&nbsp;&nbsp;<?php echo $l_name[0]?></td>
			<td>Register</td>
			<td>&nbsp;&nbsp;<?php echo $r_name[0]?></td>
			*/
			?>
		<tr height='20'>
			<td>News Paper No</td>
			<td colspan="3">&nbsp;&nbsp;<?php echo $magazin ?>
			<input type="hidden" name="newspaper_no" value="<?php echo $rs1[id] ?>"></td>
	</tr>
	<tr height='20'>
		<td>&nbsp;&nbsp;&nbsp;Name </td>
	    <td ><?php echo $rs1[title]?></td>
		<td>Language</td>
		<td>&nbsp;&nbsp;<?php echo $rs1[language] ?></td>
	</tr>
    <tr height='20'>
		<td>&nbsp;&nbsp;&nbsp;Date</td>
		<td>
		<?php
		if($dd=="")
			$dd=$dt[2];
		echo "<select name='dd' onchange='frmsubmit()'>";
		for($i=1;$i<=31;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$dd)
				  echo "<option value='$i' selected>$i</option>\n";
				else
				  echo "<option value='$i'>$i</option>\n";
			}
			echo "</select>";
		if($mm=="")
		$mm=$dt[1];
		echo "<select name='mm' onchange='frmsubmit()'>";
		for($i=1;$i<=12;$i++)
			{
				if($i<='9')
				{
					$i='0'.$i;
				}
				if($i==$mm)
				echo "<option value='$i' selected>" . MonthName($i) . "</option>\n";
				else
				echo "<option value='$i'>" . MonthName($i) . "</option>\n";
			}
		echo "</select>";
		$maxYr =date("Y")+1;
		$st=date("Y")-4;
		if($yy=="")
			$yy=$dt[0];
		echo "<select name='yy' onchange='frmsubmit()'>";
		for($i=$st;$i<=$maxYr;$i++)
			{
				if($i==$yy)
				echo "<option value='$i' selected>$i</option>\n";
				else
				echo "<option value='$i' >$i</option>\n";
			}
		echo "</select></td>";
		$dtt=$yy."-".$mm."-".$dd;
		$day_cal = date("l",strtotime($dtt));
		?>
		<td>Day</td>
		<td>&nbsp;&nbsp;<?php echo $day_cal ?></td>
	</tr>

	<tr height='20'>
		<td>&nbsp;&nbsp;&nbsp;Price</td>
		<td>
		<input type="text" name="amount" value="<?php echo $r[amount] ?>" size='8'></td>
		<td>No of Copies</td>
		<td>
		<input type="text" name="copies" value="<?php echo $r[nofcp] ?>" size='5'></td>
	</tr>

	<tr height='20'>
		<td>&nbsp;&nbsp;&nbsp;Remarks</td>
		<td colspan='3'>
		<textarea name='remarks' rows=3 cols=50><?php echo stripslashes($r[remarks]) ;?></textarea></td>
	</tr>
	</table>
    <br><div colspan=2 align="center"><input type="button" name="mod" value=" MODIFY " onClick="modnew()" class='bgbutton'></div>
	<br><div colspan=2 align="center"><input type="button" name="del" value=" INACTIVE " onClick="delnew()" class='bgbutton'></div>

	<?php
	}
}
function MonthName($mon)
	{
		if($mon == 1) return("Jan");
		if($mon == 2) return("Feb");
		if($mon == 3) return("Mar");
		if($mon == 4) return("Apr");
		if($mon == 5) return("May");
		if($mon == 6) return("Jun");
		if($mon == 7) return("Jul");
		if($mon == 8) return("Aug");
		if($mon == 9) return("Sep");
		if($mon == 10) return("Oct");
		if($mon == 11) return("Nov");
		if($mon == 12) return("Dec");
	}
?>
</form>
</BODY>
</HTML>