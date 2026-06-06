<?php
require_once("../db.php");
if($_POST)
{
	$id=$_POST['id'];
	$library=$_POST['library'];
	$register=$_POST['register'];
	$media=$_POST['media'];
	$action1=$_POST['action1'];

}
if($_REQUEST)
{
		$action=$_REQUEST['action'];
}
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
	if (charCode > 31 && (charCode < 48 || charCode > 57 )  && charCode!=KEY_LEFT && charCode!=KEY_RIGHT ) 
	{
		if((charCode >= 65456 && charCode <= 65465) || (charCode >= 96 && charCode <= 105))
		{
			return true
		}
		else
		{
			alert("Please make sure entries are numbers only.")
				document.form1.accNo.value="";


			return false
		}
	}
	return true
}
function frmSubmit(act)
{
	//alert("inside");
	document.form1.action='addMedialoc.php';	
	document.form1.action=act;
	document.form1.submit();
}
</script>
</HEAD>
<BODY topMargin=0 leftMargin="0">
<div align="left">
<form method="POST" name="form1">
<input type=hidden name='action1' value="<?php echo $action?>">

<div class="label" align="left">
<?php echo $Str?>
</div><br/>
<table class='forumline' align='center' width="47%" border="1">
<tr>
<?php
if((strtoupper($action) != "VIEWTOTALMEDIA.PHP") && (strtoupper($action) != "VIEWRESERVATIONDET.PHP") && (strtoupper($action) != "VIEWRETURNS.PHP") && (strtoupper($action) != "VIEWISSUED.PHP") && (strtoupper($action) != "VIEWOUTSTANDING.PHP") && (strtoupper($action) != "VIEWDUEREPORT.PHP") && (strtoupper($action) != "VIEWPURCHASEORDER.PHP") && (strtoupper($action) != "VIEWPURCHASE.PHP") && (strtoupper($action) != "BUDGETREPORT.PHP"))
{
	if($action == 'addMediaDet.php')
	{
	
	 //$smedia =execute("SELECT * FROM lib_mediatype where id not in (6) order by id");
	 $smedia =execute("SELECT * FROM lib_mediatype order by id");
	}
	else
	{
		$smedia =execute("SELECT * FROM lib_mediatype where id not in (5,6,7) order by id");
	}
	$num = rowcount($smedia);
	$numn = $num;
	if($action != 'addMediaDet.php')
	{
		?>
		<tr><td align='center' Class='head' colspan='2'>Search Media</td></tr>
		<?php
	}
	else
	{
		echo "<tr><td align='center' Class='head' align='center' colspan='2'>Add Media</td></tr>";
	}
	if(strtoupper($action) != "MODIFYMEDIADET.PHP")
	{
	?>
		<td width="100" align="center" colspan="2"><select size="1" name="media">
		<?php
		for($i=0;$i<$num;$i++)
		{
			$r = fetcharray($smedia,$i);
			if($r[id]== $media)
				$sel="selected";
			else
				$sel="";
			?>
			<option value="<?php echo $r["id"]?>" <?php echo $sel?>><?php echo $r["name"]?></option>
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
		<tr><td colspan='2' class='head' align='center'><?php echo $str1?></td></tr>
		<?php
	}
	if (strtoupper($action)=="VIEWTOTALMEDIA.PHP")
	{
		
		$str1="Brief Media Report ";
		?>
		<tr><td colspan='2' class='head' align='center'><?php echo $str1?></td></tr>
		<?php
	}
	if (strtoupper($action)=="VIEWPURCHASEORDER.PHP")
	{
		$str1="Purchase Order Report ";
		?>
		<tr><td colspan=2 class=head align=center><?php echo $str1?></td></tr>
		<?php
	}
	else if (strtoupper($action)=="VIEWPURCHASE.PHP")
	{
		$str1="Purchase Report ";
		?>
		<tr><td colspan=2 class=head align=center><?php echo $str1?></td></tr>
		<?php
	}
	elseif (strtoupper($action)=="VIEWISSUED.PHP")
	{
		$str1="View Issued Media Report ";
		?>
		<tr><td colspan=2 class=head align=center><?php echo $str1?></td></tr>
		<?php
	}
	elseif (strtoupper($action)=="VIEWRETURNS.PHP")
	{
		$str1="View Returned Media Report ";
		?>
		<tr><td colspan=2 class=head align=center><?php echo $str1?></td></tr>
		<?php
	}
	if (strtoupper($action) == "VIEWOUTSTANDING.PHP")
	{
		$str1="View Outstanding ";
		?>
		<tr><td colspan=2 class=head align=center><?php echo $str1?></td></tr>
		<?php
	}
	if (strtoupper($action) == "VIEWDUEREPORT.PHP")
	{
		$str1="View Due Report";
		?>
		<tr><td colspan=2 class=head align=center><?php echo $str1?></td></tr>
		<?php
	}
	if (strtoupper($action) == "VIEWDUEREPORT.PHP")
	{
		?>
		<tr><td width="30%" align="left">&nbsp;&nbsp;&nbsp;Member Type</td>
		<td width="100"><select size="1" name="member" >
		<option value="1">Student</option>
		<option value="2">Staff</option>
		</select></td></tr>
		<?php
	}
	if(strtoupper($action) != "MODIFYMEDIADET.PHP" && strtoupper($action)!="VIEWRESERVATIONDET.PHP" && strtoupper($action)!="VIEWISSUED.PHP" && strtoupper($action)!="VIEWRETURNS.PHP"  && strtoupper($action)!="VIEWDUEREPORT.PHP" )
	{
		?>
		<td width="30%" align="left">
        <?php
		/*
		<div align="left">Library</td>
		<td width="100"><select size="1" name="library" onChange="javascript:document.form1.submit()">
		<option value="0">-- All --</option>
		<?php
		for($i=0;$i<$num;$i++)
		{
			$r1 = fetcharray($slib,$i);
			if($r1[id]==$library)
				$sel="selected";
			else
				$sel="";
			?>
			<option value="<?php echo $r1["id"]?>" <?php echo $sel?>><?php echo $r1["name"]?></option>
			<?php
		}
		?>
		</select></td>
		*/
		$library=1;
		?>
		<?php
	}
	if (strtoupper($action)=="VIEWRESERVATIONDET.PHP")
	{
		?>
		<tr><td align="right">Select Media Type&nbsp;&nbsp;&nbsp;</td>
	<td><select name="media">
	<option value='0'>-------- All --------</option>
	<?php
	$sql1 = "select * from lib_mediatype order by id";
	$rs = execute($sql1);
	$row=rowcount($rs);
	for($i=0;$i<$row;$i++)
	{
		$r = fetcharray($rs,$i);
		if($media==$r[id])
		{
			?>
			<option value="<?php echo $r["id"]?>" selected><?php echo $r["name"]?></option>
			<?php
		}
		else
		{
			?>
			<option value="<?php echo $r["id"]?>" ><?php echo $r["name"]?></option>
			<?php
		}
	}
	?>
	</select></td>
	</tr>
	<?php
	}
		?>
	    <tr>
	<?php
	if (strtoupper($action)!="VIEWPURCHASE.PHP" && strtoupper($action)!="VIEWPURCHASEORDER.PHP")
	{
		if($library > -1)
		{
			/*
			echo "<td>";
			echo "<div align=left>Register";
			echo "</td>";
			echo "<td>";
			$qry="select * from lib_register where library=$library";
			echo "<select name=register>";
			echo "<option value=0>All</option>";
			$ls=execute($qry) or die(error_description());
			for($ii=0;$ii < rowcount($ls);$ii++)
			{
				$lr=fetcharray($ls,$ii);
				echo "<option value=$lr[id]>$lr[register]</option>";
			}
			echo "</select>";
			echo "</td>";
			*/
			$register=1;
		}
	}
	?>
	</tr>
	<?php
	if ((strtoupper($action)=="VIEWRETURNS.PHP") || (strtoupper($action)=="VIEWISSUED.PHP") ||(strtoupper($action)=="VIEWDUEREPORT.PHP") ||(strtoupper($action)=="VIEWPURCHASE.PHP") ||(strtoupper($action)=="VIEWPURCHASEORDER.PHP") ||(strtoupper($action)=="BUDGETREPORT.PHP"))
	{
		?>
		<tr><td align="left">&nbsp;&nbsp;&nbsp;Select Media Type</td>
	<td><select name="media">
	<option value='0'>-------- All --------</option>
	<?php
	$sql1 = "select * from lib_mediatype order by id";
	$rs = execute($sql1);
	$row=rowcount($rs);
	for($i=0;$i<$row;$i++)
	{
		$r = fetcharray($rs,$i);
		if($media==$r[id])
		{
			?>
			<option value="<?php echo $r["id"]?>" selected><?php echo $r["name"]?></option>
			<?php
		}
		else
		{
			?>
			<option value="<?php echo $r["id"]?>" ><?php echo $r["name"]?></option>
			<?php
		}
	}
	?>
	</select></td>
	</tr><tr>
		<?php
		if (strtoupper($action) != "VIEWDUEREPORT.PHP")
		{
			?>

			<td width="30%" align="left">&nbsp;&nbsp;&nbsp;From Date</td>
			<?php
		}
		else
		{
			?>
			<td width="30%" align="left">&nbsp;&nbsp;&nbsp;Select Date</td>
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
			<tr><td width="30%" align="left">&nbsp;&nbsp;&nbsp;To Date</td>
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
			</td></tr>
			<?php
		}
	}
	if((strtoupper($action) != "VIEWTOTALMEDIA.PHP") && (strtoupper($action) != "VIEWRESERVATIONDET.PHP") && (strtoupper($action)!= "VIEWRETURNS.PHP") && (strtoupper($action) != "VIEWISSUED.PHP") &&(strtoupper($action) != "VIEWOUTSTANDING.PHP") && (strtoupper($action) != "VIEWDUEREPORT.PHP") && (strtoupper($action)!= "VIEWPURCHASEORDER.PHP") && (strtoupper($action) != "VIEWPURCHASE.PHP") && (strtoupper($action) != "BUDGETREPORT.PHP" ) && (strtoupper($action) != "ADDMEDIADET.PHP") && (strtoupper($action) != "VIEWATTRIBUTES.PHP") )
	{
		?>
		<td>Select Media Type</td>
		<td width="100" align="left"><select size="1" name="media">
		<?php
		for($i=0;$i<$numn;$i++)
		{
			$r = fetcharray($smedia,$i);
			if($r[id]==$media)
				$sel="selected";
			else
				$sel="";
			?>
			<option value="<?php echo $r["id"]?>" <?php echo $sel?>><?php echo $r["name"]?></option>
			<?php
		}
		?>
		</select></td></tr><tr>
		<td>Enter Accession Number</td>
		<td width="100">
		<input type="text" name="accNo" value="<?php echo $accNo?>"></td>
		<?php
	}
}
if (strtoupper($action)=="SEARCHMEDIA.PHP")
{
	$slib =execute("SELECT * FROM library_name");
	$num = rowcount($slib);
	?>
	<td width="100"><select size="1" name="library"><option value="">Select Library</option>
	<?php
	for($i=0;$i<$num;$i++)
	{
		$r2 = fetcharray($slib,$i);
		?>
		<option value="<?php echo $r2["id"]?>"><?php echo $r2["name"]?></option>
		<?php
	}
	?>
	</select></td></tr>
	<tr><td width="100"><select size="1" name="attrib">
	<option value="1">Accession Number</option>
	<option value="2">Author</option>
	<option value="3">Keywords</option>
	<option value="4">Publisher</option>
	<option value="5">Subject</option>
	<option value="6">Title</option></select></td>
	<td width="100"><input type="text" name="val" value="<?php echo $val?>">
	<?php
}
?>
</tr></table></form>
<!--<tr><td colspan=2 align=center>-->
<p align="center">
<?php
if(strtoupper($action)== "SEARCHMEDIA.PHP")
{
	?>
<input type="button" value=" Search " onClick="F06a943c5('<?php echo $action?>')" class=bgbutton>
<input type="hidden" name="a_name">
	<input type="hidden" name="register" value="$register">
	<?php
}
else
{
	?>
	<input type="button" value="Search" class="bgbutton" onClick="frmSubmit('<?php echo $action?>')">
	<?php
}
?>
</p>
<!--</td></tr></table></form></div>-->
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