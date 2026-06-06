<?php
require_once("../db.php");
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";
$media=$_POST['media'];
$report_gen=$_POST['report_gen'];
$FDay=$_POST['FDay'];
$FMon=$_POST['FMon'];
$FYear=$_POST['FYear'];
$TDay=$_POST['TDay'];
$TMon=$_POST['TMon'];
$TYear=$_POST['TYear']; 
$sub1 = $_POST['sub1'];
?>
<html><head>
<script language=javascript>
function validate()
{
	if(document.frm.report_gen.value=="")
		{
	      alert("Report Generation On");
	      return false
	    }
    else
		{
	      return true
	    }
}
function printreport()
{
prn.style.display="none";
print(this.form);
}
function OpenWind2(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, 'toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
</head>
<BODY topMargin=0 leftMargin="0">
<form method="POST" name="frm" onSubmit="return validate()">
<table class='forumline' align=center colspan=2 width="47%">
<tr>
   <td colspan=2 class=head align=center>View Total Report</td>
</tr>

<tr>
  <td align="right">Select Media Type&nbsp;&nbsp;&nbsp;</td>
  <td><select size="1" name="media">
  <option value=0>ALL</option>
  <?php
	$smedia =execute("SELECT * FROM lib_mediatype where id not in (6) order by id");
	$num = rowcount($smedia);
	for($i=0;$i<$num;$i++)
	{
		$r = fetcharray($smedia,$i);
		if($r[id]==$media)
			$sel="selected";
		else
			$sel="";
    ?>
		<option value="<?=$r["id"]?>" <?=$sel?>><?=$r["name"]?></option>
    <?php
	  }
   ?>
    </select></td>
</tr>

<tr>
<td align="right">Report Generation On&nbsp;&nbsp;&nbsp;</td>
<td><select size="1" name="report_gen">
<option value="">---Select----</option>
<?php
	if("Ref"==$report_gen)
		$sel="selected";
	elseif("Issu"==$report_gen)
		$sel2="selected";
?>
<option value="Ref" <?=$sel?>>Reference Media</option>
<option value="Issu" <?=$sel2?>>Issue Media</option>
</select></td>
</tr>

<tr>
<td align="right">From Date&nbsp;&nbsp;&nbsp;</td>
<td>
<?php
	$d=getdate();
	$MyDay=$d["mday"];
	echo "<select name='FDay'>";
	for($i=1;$i<=31;$i++)
	{
		if($i == $MyDay)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i'>$i</option>\n";
	}
	echo "</select>";
	$MyMonth=$d["mon"];
	echo "<select name='FMon'>";
	for($i=1;$i<=12;$i++)
	{
		if($i <10)
		{
			$i="0".$i;
		}
		if($i == $MyMonth)
			echo "<option value='$i' selected>" . F367c6aa8($i) . "</option>\n";
		else
			echo "<option value='$i'>" . F367c6aa8($i) . "</option>\n";
	}
	echo "</select>";
	$maxYr = $d["year"]+1;
	$MyYear=$d["year"];
	echo "<select name='FYear'>";
	for($i=1997;$i<=$maxYr;$i++)
	{
		if($i == $MyYear)
			echo "<option value='$i' selected>$i</option>\n";
		else
			echo "<option value='$i' >$i</option>\n";
	}
	echo "</select>";
?>
</td>
</tr>

<tr>
<td align="right">To Date&nbsp;&nbsp;&nbsp;</td>
<td>
	<?php
		$d=getdate();
		$MyDay=$d["mday"];
		echo "<select name='TDay'>";
		for($i=1;$i<=31;$i++)
		{
			if($i == $MyDay)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i'>$i</option>\n";
		}
		echo "</select>";
		$MyMonth=$d["mon"];
		echo "<select name='TMon'>";
		for($i=1;$i<=12;$i++)
		{
			if($i <10)
			{
				$i="0".$i;
			}
			if($i == $MyMonth)
				echo "<option value='$i' selected>" . F367c6aa8($i) . "</option>\n";
			else
				echo "<option value='$i'>" . F367c6aa8($i) . "</option>\n";
		}
		echo "</select>";
		$maxYr = $d["year"]+1;
		$MyYear=$d["year"];
		echo "<select name='TYear'>";
		for($i=1997;$i<=$maxYr;$i++)
		{
			if($i == $MyYear)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i' >$i</option>\n";
		}
		echo "</select>";
	?>
		</td>
</tr>

<tr>
 
</tr>
</table>
<br>
 <div align=center><input type="submit" name="sub1" value="<< View Report >>" class='bgbutton'></div>

<?php
if(isset($sub1))
{
	$datefrom=$FYear."-".$FMon."-".$FDay;
	$dateto=$TYear."-".$TMon."-".$TDay;
	if($report_gen=="Ref")
	    {
		  $head_name="Reference";
	    }
	elseif($report_gen=="Issu")
		{
		  $head_name="Issued";
	    }
?>
	<br>
	<table align='center' class='forumline' colspan=3 width="60%">
	<tr>
	  <td colspan=3 align=center class='head'>Total <?=$head_name?> Media Issued/Returned From <?=date('d-m-Y',strtotime($datefrom))?> To <?=date('d-m-Y',strtotime($dateto))?></td></tr>
	<tr>
	  <td align="center">Media</td>
	  <td align="center">No. Of Media Issued</td>
	  <td align="center">No. Of Media Returned</td>
   </tr>
<?
if($report_gen=="Ref")
{
	if($media==0)	
		{
		for($s=0;$s<5;$s++)	
			{
			$ss=$s+1;
			$nop=rowcount(execute("select * from lib_reference_media_trans where media_type='$ss' and status=0 and (issue_date >= '".$datefrom."') and (issue_date <= '".$dateto."')"));

            $msg=rowcount(execute("select * from lib_reference_media_trans  where media_type='$ss' and status=1 and (issue_date >= '".$datefrom."') and (issue_date <= '".$dateto."')"));
			
			$sb=fetcharray(execute("select * from lib_mediatype where id=$ss and id not in (6)"));
			?>
			<tr><td align="center"><?=$sb[1]?></td>
			<td align="center"><?=$nop?></td>
            <td align="center"><?=$msg?></td>
			</tr>
			<?php
			}
		}
   if($media!=0)
	   {
	        $nop1=rowcount(execute("select * from lib_reference_media_trans where media_type='$media' and status=0 and (issue_date >= '".$datefrom."') and (issue_date <= '".$dateto."')"));

            $msg1=rowcount(execute("select * from lib_reference_media_trans  where media_type='$media' and status=1 and (issue_date >= '".$datefrom."') and (issue_date <= '".$dateto."')"));
			
			$sb1=fetcharray(execute("select * from lib_mediatype where id=$media and id not in (6)"));
			?>
			<tr><td align="center" ><?=$sb1[1]?></td>
			<td align="center"><?=$nop1?></td><td align="center"><?=$msg1?></td>
			</tr>
			<?php
	   }
}

if($report_gen=="Issu")
	{
		
	if($media==0)	
		{
			
		for($s=0;$s<5;$s++)	
			{
			$ss=$s+1;
			$nop=rowcount(execute("select * from lib_circulation_m where media_type='$ss' and status=0 and (issue_date >= '".$datefrom."') and (issue_date <= '".$dateto."')"));
     
            $msg=rowcount(execute("select * from lib_circulation_m where media_type='$ss' and status=1 and (issue_date >= '".$datefrom."') and (issue_date <= '".$dateto."')"));
			
			$sb=fetcharray(execute("select * from lib_mediatype where id=$ss and id not in (6)"));
			?>
			<tr><td  align="center"><?=$sb[1]?></td>
			<td align="center"><?=$nop?></td>
            <td align="center"><?=$msg?></td>
			</tr>
			<?php
			}
		}
   if($media!=0)
	   {
		   
	        $sb1=fetcharray(execute("select * from lib_mediatype where id='$media' and id not in (6)"));
			
			$nop1=rowcount(execute("select * from lib_circulation_m where media_type='$media' and status=0 and (issue_date >= '".$datefrom."') and (issue_date <= '".$dateto."')"));

            $msg1=rowcount(execute("select * from lib_circulation_r where media_type='$media' and status=1 and (issue_date >= '".$datefrom."') and (issue_date <= '".$dateto."') AND returned='Yes'"));
			
			
			?>
			<tr><td align="center"><?=$sb1[1]?></td>
			<td align="center"><?=$nop1?></td>
            <td align="center"><?=$msg1?></td>
			</tr>
			<?php
	   }
	}
}
?>
</form>
<?php
function F367c6aa8($mon)
{
	if($mon == '01') return("Jan");
	if($mon == '02') return("Feb");
	if($mon == '03') return("Mar");
	if($mon == '04') return("Apr");
	if($mon == '05') return("May");
	if($mon == '06') return("Jun");
	if($mon == '07') return("Jul");
	if($mon == '08') return("Aug");
	if($mon == '09') return("Sep");
	if($mon == '10') return("Oct");
	if($mon == '11') return("Nov");
	if($mon == '12') return("Dec");
}
?>
</BODY>
</HTML>