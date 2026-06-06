<?php
//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";

session_start();
require_once("../db.php");
$msg=$_REQUEST['msg'];
if($msg!='')
{
?>
    <script language="javascript">
	  alert("<?=$msg?>");
    </script>
<?php
}
if($_REQUEST)
{
	$action1=$_REQUEST['action1'];
	$action=$_REQUEST['action'];
}
if($_POST)
{
	$action1=$_POST['action1'];
	$action=$_POST['action'];
	$media=$_POST['media'];
	$library=$_POST['library'];
	$accNo=$_POST['accNo'];
	$media_type=$_POST['media_type'];
	$a_name = $_POST['a_name'];
	$member = $_POST['member'];
	$fr_dd = $_POST['fr_dd'];
	$fr_mm = $_POST['fr_mm'];
	$fr_yy = $_POST['fr_yy'];
	$to_dd = $_POST['to_dd'];
	$to_mm = $_POST['to_mm'];
	$to_yy = $_POST['to_yy'];
	$DDay = $_POST['DDay'];
	$DMon = $_POST['DMon'];
	$DYear = $_POST['DYear'];
	$TDay = $_POST['TDay'];
	$TMon = $_POST['TMon'];
	$TYear = $_POST['TYear'];
	$attrib = $_POST['attrib'];
	$val = $_POST['val'];
}
?>
<?php
if(trim($action) == "")
{
	$action = "viewAttributes.php";
}
else
{
	$Str = "";
}
?>
<HTML>
<HEAD>
<script language=javascript>
var KEY_LEFT=268762961;
var KEY_RIGHT=268762963;
function checkIt(e)
{
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT ) {
		if((charCode >= 65456 && charCode <= 65465) || (charCode >= 96 && charCode <= 105))
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

function frmSubmit(act)
{
	document.form1.action=act;
	document.form1.submit();
}
</script>
</HEAD>
<BODY topMargin=0 leftMargin="0">
<div align="left">
<form method="POST" name="form1">
<input type='hidden' name='action1' value="<?=$action?>">
<div class="label" align="left">
<?=$Str?>
</div>
<table class='forumline' align='center' width="45%" border="1">
<!--<table class=forumline align=center>-->
<tr>
<?php
if((strtoupper($action) != "VIEWTOTALMEDIA.PHP") && (strtoupper($action) != "VIEWRESERVATIONDET.PHP") && (strtoupper($action) != "VIEWRETURNS.PHP") && (strtoupper($action) != "VIEWISSUED.PHP") && (strtoupper($action) != "VIEWOUTSTANDING.PHP") && (strtoupper($action) != "VIEWDUEREPORT.PHP") && (strtoupper($action) != "VIEWPURCHASEORDER.PHP") && (strtoupper($action) != "VIEWPURCHASE.PHP") && (strtoupper($action) != "BUDGETREPORT.PHP"))
{
	$smedia =execute("SELECT * FROM lib_mediatype order by id");
	$num = rowcount($smedia);
	if($action != 'addMediaDet.php')
	{
		?>
		<br/><tr><td align='center' Class='head' colspan='2'>Search Media</td></tr>
		<?
	}
	else
	{
		echo "<tr><td align='left' Class='head'><small>Add Media</small></td></tr>";
	}
	if(strtoupper($action) != "MODIFYMEDIADET.PHP")
	{
	?>
		<td width="100" align="center">
		<select size="1" name="media">
		<?php
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
		<?php
	}
}
?>
</tr>
<?php
if ((strtoupper($action)== "MODIFYMEDIADET.PHP") || (strtoupper($action)=="VIEWTOTALMEDIA.PHP") || (strtoupper($action)=="VIEWRESERVATIONDET.PHP") || (strtoupper($action)=="VIEWRETURNS.PHP") || (strtoupper($action)=="VIEWISSUED.PHP") || (strtoupper($action)=="VIEWOUTSTANDING.PHP") || (strtoupper($action)=="VIEWDUEREPORT.PHP") || (strtoupper($action)=="VIEWPURCHASEORDER.PHP") ||(strtoupper($action)=="VIEWPURCHASE.PHP") ||(strtoupper($action)=="BUDGETREPORT.PHP")||(strtoupper($action)=="RETURNMEDIADET.PHP"))
{
	$slib =execute("SELECT * FROM library_name");
	$num = rowcount($slib);
	?>
	<?php
	if (strtoupper($action)=="VIEWRESERVATIONDET.PHP")
	{
		$str1="Check Reservation";
		?>
		<tr><td colspan=2 class=head align=center><?=$str1?></td></tr>
		<?
	}
	?>
	<?php
	if (strtoupper($action)=="VIEWTOTALMEDIA.PHP")
	{
		$str1="Get Total Media ";
		?>
		<tr><td colspan=2 class=head align=center><?=$str1?></td></tr>
		<?
	}
	?>
	<?php
	if (strtoupper($action)=="VIEWPURCHASEORDER.PHP")
	{
		$str1="Purchase Order Report ";
		?>
		<tr><td colspan=2 class=head align=center><?=$str1?></td></tr>
		<?
	}
	else if (strtoupper($action)=="VIEWPURCHASE.PHP")
	{
		$str1="Purchase Report ";
		?>
		<tr><td colspan=2 class=head align=center><?=$str1?></td></tr>
		<?
	}
	elseif (strtoupper($action)=="VIEWISSUED.PHP")
	{
		$str1="View Issued Media Report ";
		?>
		<tr><td colspan=2 class=head align=center><?=$str1?></td></tr>
		<?
	}
	elseif (strtoupper($action)=="VIEWRETURNS.PHP")
	{
		$str1="View Returned Media Report ";
		?>
		<tr><td colspan=2 class=head align=center><?=$str1?></td></tr>
		<?
	}

	?>
	<?php
	if (strtoupper($action) == "VIEWOUTSTANDING.PHP")
	{
		$str1="View Outstanding ";
		?>
				<tr><td colspan=2 class=head align=center><?=$str1?></td></tr>
		<?

	}
	?>
	<?php
	if (strtoupper($action) == "VIEWDUEREPORT.PHP")
	{
		$str1="View Due Report";
		?>
				<tr><td colspan=2 class=head align=center><?=$str1?></td></tr>
		<?

	}
	if (strtoupper($action) == "VIEWDUEREPORT.PHP")
	{
	?>
	<tr>
	<td width="30%" align="left">
    <div align="left">Member Type</div></td>
	<td width="100">
	<select size="1" name="member">
	<option value="1" selected>Student</option>
	<option value="2">Staff</option>
	<option value="3">Institution</option>
	</select></td>
	</tr>
	<?
	}

	if(strtoupper($action) != "MODIFYMEDIADET.PHP" && strtoupper($action)!="VIEWRESERVATIONDET.PHP" && strtoupper($action)!="VIEWISSUED.PHP" && strtoupper($action)!="VIEWRETURNS.PHP"  && strtoupper($action)!="VIEWDUEREPORT.PHP" )
	{
		?>
		<td width="30%" align="left"><div align="left">Library</td>
		<td width="100">
		<!--
        <select size="1" name="library" onChange="javascript:document.form1.submit()">
        -->
        $library = 1;
        <?php
		/*
        <select size="1" name="library">
		<option value="">Select Library</option>
		<?php
		for($i=0;$i<$num;$i++)
		{
			$r1 = fetcharray($slib);
			if($r1[id]==$library)
				$sel="selected";
			else
				$sel="";
			?>
			<option value="<?=$r1["id"]?>" <?=$sel?>><?=$r1["name"]?></option>
			<?php
		}
		?>
		</select>
        */
        ?>
		</td>
		<?
	}
	if (strtoupper($action)=="VIEWRESERVATIONDET.PHP")
	{
		?>
		<td>
		From
		</td>
		<td>
		<?php
		$d=getdate();
		if($d["mday"] <9)
		{
			$MyDay="0".$d["mday"];
		}
		else
		{
			$MyDay=$d["mday"];
		}
		if($d["mon"] <9)
		{
			$MyMon="0".$d["mon"];
		}
		else
		{
			$MyMon=$d["mon"];
		}
		$MyYear=$d["year"];
		if(@$fr_dd=="")
		{
			$fr_dd=$MyDay;
		}
		if(@$fr_mm=="")
		{
			$fr_mm=$MyMon;
		}
		if(@$fr_yy=="")
		{
			$fr_yy=$MyYear;
		}
		?>
		<input type="text" name="fr_dd" value="<?=$fr_dd?>" size=2 maxlength="2" onKeydown="return checkIt(event)">
		<input type="text" name="fr_mm" value="<?=$fr_mm?>" size=2 maxlength="2" onKeydown="return checkIt(event)">
		<input type="text" name="fr_yy" value="<?=$fr_yy?>" size=4 maxlength="4" onKeydown="return checkIt(event)">
		</td></tr>
		<tr><td>To</td>
		<td>
		<?php
		if(@$to_dd=="")
		{
			$to_dd=$MyDay;
		}
		if(@$to_mm=="")
		{
			$to_mm=$MyMon;
		}
		if(@$to_yy=="")
		{
			$to_yy=$MyYear;
		}
		?>
		<input type="text" name="to_dd" value="<?=$to_dd?>" size=2 maxlength="2" onKeydown="return checkIt(event)">
		<input type="text" name="to_mm" value="<?=$to_mm?>" size=2 maxlength="2" onKeydown="return checkIt(event)">
		<input type="text" name="to_yy" value="<?=$to_yy?>" size=4 maxlength="4" onKeydown="return checkIt(event)">
		</td>
		<?
	}
	?>
	</tr>
	<tr>
	<?

//For ViewPurchaseOrder.php there was no need of register drop down menu as the purchase orders are not stored in to any register rather they are stored into library it has been rectified
	if (strtoupper($action)!="VIEWPURCHASE.PHP" && strtoupper($action)!="VIEWPURCHASEORDER.PHP")
	{
		
		/*if($library > -1)
		{
			echo "<td>";
			echo "<div align=left>Register";
			echo "</td>";
			echo "<td>";
			$qry="select * from lib_register where library=$library";
			echo "<select name=register>";
			//Modified by Muzammil Ahmed A on 23-Feb-2005
			//All Option has been added in the drop down menu of registers
			echo "<option value=0>All</option>";
			$ls=execute($qry) or die(error_description());
			for($ii=0;$ii < rowcount($ls);$ii++)
			{
				$lr=fetcharray($ls,$ii);
				echo "<option value=$lr[id]>$lr[register]</option>";
			}
			echo "</select>";
			echo "</td>";
		}*/
	}
	?>
	</tr>
	<?php
	if ((strtoupper($action)=="VIEWRETURNS.PHP") || (strtoupper($action)=="VIEWISSUED.PHP") ||(strtoupper($action)=="VIEWDUEREPORT.PHP") ||(strtoupper($action)=="VIEWPURCHASE.PHP") ||(strtoupper($action)=="VIEWPURCHASEORDER.PHP") ||(strtoupper($action)=="BUDGETREPORT.PHP"))
	{
		?>
		<tr>
		<?php
		if (strtoupper($action) != "VIEWDUEREPORT.PHP")
		{
			?>
			<td width="30%" align="right"><div align="left">From Date</td>
			<?php
		}
		else
		{
			?>
			<td width="30%" align="right"><div align="left">Select Date</td>
			<?php
		}
		?>
		<td>
		<?php
		$d=getdate();
		$MyDay=$d["mday"];
		echo "<select name='DDay'>";
		for($i=1;$i<=31;$i++)
		{
			if($i == $MyDay)
				echo "<option value='$i' selected>$i</option>\n";
			else
				echo "<option value='$i'>$i</option>\n";
		}
		echo "</select>";
		$MyMonth=$d["mon"];
		echo "<select name='DMon'>";
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
		echo "<select name='DYear'>";
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
		<?php
		if (strtoupper($action) != "VIEWDUEREPORT.PHP")
		{
			?>
			<tr>
			<td width="30%" align="left"><div align="left">To Date</td>
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
			<?php
		}
		?>
		<?php
	}
	if((strtoupper($action) != "VIEWTOTALMEDIA.PHP") && (strtoupper($action) != "VIEWRESERVATIONDET.PHP") && (strtoupper($action)!= "VIEWRETURNS.PHP") && (strtoupper($action) != "VIEWISSUED.PHP") &&(strtoupper($action) != "VIEWOUTSTANDING.PHP") && (strtoupper($action) != "VIEWDUEREPORT.PHP") && (strtoupper($action)!= "VIEWPURCHASEORDER.PHP") && (strtoupper($action) != "VIEWPURCHASE.PHP") && (strtoupper($action) != "BUDGETREPORT.PHP" ) && (strtoupper($action) != "ADDMEDIADET.PHP") && (strtoupper($action) != "VIEWATTRIBUTES.PHP") )
	{
		?>
		<tr>
        
		<td width="120" align="right" height="22" >Library*&nbsp;&nbsp;&nbsp;</td>
		<td  height="22">
		<select size="1" name="library" >
		<option value='0'> Select Library&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </option>
		<?php
		$sql1 = "SELECT * FROM library_name";
		$rs1 = execute($sql1);
		$row1 = rowcount($rs1);
		for($i=0;$i<$row1;$i++)
		{
			$r1 = fetcharray($rs1);
			if($r1[id]==$library)
				$sel="selected";
			else
				$sel="";
			?>
			<option value="<?=$r1["id"]?>" <?=$sel?>><?=$r1["name"]?></option>
			<?php
		}
		?>
		</select>
		</td>
		</tr>
		
		<tr>
		<td align="right">Media Type&nbsp;&nbsp;&nbsp;</td>
		<td>
		<select name='media_type'>
		<option value='0'> Select Media Type </option>
		<?php
		$rs_sql=execute("select * from lib_mediatype where id not in (6) order by id");
		for($i=0;$i< rowcount($rs_sql);$i++)
		{
			$r_sql=fetcharray($rs_sql,$i);
			$sel="";
			if($r_sql[id]==$media_type)
				$sel="selected";
			?>
			
			<option value="<?php echo $r_sql["id"]?>" <?php echo $sel?>><?php echo $r_sql["name"]?></option>
			
			<!--echo "<option value='$r_sql[id]' $sel >$r_sql[name]</option>";-->
		<?php
		}
		?>
		</select>
		</td>
		</tr>
		<tr>		
		<td align="right">Accession Number&nbsp;&nbsp;&nbsp;</td>
		<td width="100"><input type="text" name="accNo" value="<?=$accNo?>" maxlength=15></td>
		</tr>
		<?php
	}
}
?>
<?php
if (strtoupper($action)=="SEARCHMEDIA.PHP")
{
	$slib =execute("SELECT * FROM library_name");
	$num = rowcount($slib);
	?>
	<td width="100">
	<select size="1" name="library">
	<option vaalue="">Select Library</option>
	<?php
	for($i=0;$i<$num;$i++)
	{
		$r2 = fetcharray($slib,$i);
		?>
		<option value="<?=$r2["id"]?>"><?=$r2["name"]?></option>
		<?php
	}
	?>
	</select></td></tr>
	<tr>
	<td width="100">
	<select size="1" name="attrib">
	<option value="1">Accession Number</option>
	<option value="2">Author</option>
	<option value="3">Keywords</option>
	<option value="4">Publisher</option>
	<option value="5">Subject</option>
	<option value="6">Title</option></select></td>
	<td width="100">
	<input type="text" name="val" value="<?=$val?>">
	<?php
}
?>
</tr></table>
<!--<tr>
<td colspan=2 align='center'>-->
<p align="center">
<?php
if(strtoupper($action)== "SEARCHMEDIA.PHP")
{
	?>
	<input type="button" value=" Search " onClick="F06a943c5('<?=$action?>')" class=bgbutton>
	<input type="hidden" name="a_name">
	<?php
}
else
{
	?>
	<input type="button" value=" Submit " onClick="frmSubmit('<?=$action?>')" class=bgbutton>
	<?php
}
?>
</p></form>
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
<?php
if(strtoupper($action)== "SEARCHMEDIA.PHP")
{
	?>
	<script language="JavaScript">
	function F06a943c5(act)
	{
		document.form1.a_name.value = document.form1.attrib.options[document.form1.attrib.selectedIndex].text;
		document.form1.action=act;
		document.form1.submit();
	}
	</script>
	<?php
}
?>
</BODY></HTML>