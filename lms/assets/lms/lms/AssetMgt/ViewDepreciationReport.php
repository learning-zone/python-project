<html>
<body>
<?php
	session_start();

	include("../db.php");
	
	$print = $_POST['print'];
$subass = $_POST['subass'];
$filename = $_POST['filename'];


	function Check_Total($total_lines, $heading1, $heading2, $field_header, $main_field_header2, $_LINE_, $xy, $current_date, $page, $_BLANK_, $FinancialYear)
	{
		if ($total_lines >= 61)
		{
			fwrite($xy, $_LINE_);			// LINE NO 62.
			fwrite($xy, "Date : $current_date");	// INSERT THE PRINTING DATE IN THE TEXT FILE.
			fwrite($xy, $_BLANK_);
			fwrite($xy, "PAGE : $page\n\n");		// INSERT THE PAGE NUMBER IN THE TEXT FILE.
			fwrite($xy, "\n\n\n\n\n\n\n\n\n\n\n\n");	// PAGE EJECT
			fwrite($xy, $heading1);			// INSERT THE MAIN HEADER IN THE TEXT FILE.
			fwrite($xy, $heading2);			// INSERT THE SUB HEADER IN THE TEXT FILE.
			fwrite($xy, "\n");
			fwrite($xy, "LIST OF FIXED ASSETS FOR THE YEAR $FinancialYear\n");
			fwrite($xy, $_LINE_);
			fwrite($xy, $main_field_header2);
			fwrite($xy, $field_header);
			fwrite($xy, $_LINE_);
			$total_lines = 8;
		}
		return $total_lines;
	}

	function Insert_Amt($varlength, $amt)
	{
		$ins_line = "";
		$temp = $varlength - strlen(number_format($amt,2,".",""));
		for ($a=1;$a<=$temp;$a++)
			$ins_line .= " ";
		$ins_line .= number_format($amt,2,".","");
		return $ins_line;
	}

	function Insert_Others($varlength, $oval)
	{
		$ins_line = $oval;
		$temp = $varlength - strlen($oval);
		for ($a=1;$a<=$temp;$a++)
			$ins_line .= " ";
		return $ins_line;
	}



if (isset($print))
{
	echo "<FONT color=0000FF><B>File is Priniting......</B></FONT><BR>";
	echo "<FONT color=#FF0000><B>The Printing File is  :: </B><B><U>$filename</U></B><BR>";
	exec("lpr $filename");
	die();
}
$FinancialYear=$FinYear."-".($FinYear+1);

	$FYearStart=$FinYear."-04-01";
	$FYearEnd=($FinYear+1)."-03-31";
// VARIABLE DECLARATION BEGINS.
$current_date = date("d-m-Y");		// FOR STORING THE CURRENT DATE.
$filename = "../printmodule/viewdepreciation.txt";	// FOR STORING THE FILE NAME WITH PATH.
$heading1 = "MEF";
$heading2 = "Bangalore.";
$headlen1 = strlen($heading1);	// LENGTH FOR REPORT  HEADER.
$headlen2 = strlen($heading2);	// LENGTH FOR REPORT HEADER 2.
$main_fld2 = "       |                       |BALANCE AS ON  |Additions During| GROSS BLOCK AS |   RATE OF     |   AMOUNT OF  |W.D.V AS ON |~~";
$fld	   = "Sl. No.|PARTICULARS            |$FYearStart    |    The Year    |  ON $FYearEnd  |DEPRECIATION(%)| DEPRECIATION |$FYearEnd   |~~";
$mainfldlen2 = strlen($main_fld2);
$fldlen = strlen($fld);
$page = 1;
$serial = 1;
$total_lines = 0;
$j = 0;
// ENDS

// TEXT FILE OPENING
// BEGINS
$xy = fopen($filename, "w") or die("Could not open the file !!");
// ENDS

//	SET THE UNDERLINE CHARACTER VARIABLE.
//	BEGIN	//
for($num=0;$num<$fldlen;$num++)
{
	$_LINE_ .= "-";
}
$_LINE_ .= "\n";
//	END	//
//	SET THE BLANK VARIABLE WITH BLANK SPACES.
//	BEGIN	//
for($num=0;$num<$fldlen-28;$num++)
{
	$_BLANK_ .= " ";
}
//	END	//

//	SET THE BLANK VARIABLE TO DISPLAY THE HEADING IN CENTRE		//
//	BEGIN	//
$len_diff = $fldlen - $headlen1;
if ($len_diff % 2 == 0)
	$temp = $len_diff / 2;
else
	$temp = ceil($len_diff/2);

for ($i=1;$i<=$temp;$i++)
	$_BLANK_PART2_ .= " ";

$heading1 = $_BLANK_PART2_ . "$heading1" . $_BLANK_PART2_ . "\n";
//	END	//


//	SET THE BLANK VARIABLE TO DISPLAY THE HEADING IN CENTRE		//
//	BEGIN	//
$_BLANK_PART2_ = "";
$len_diff = $fldlen - $headlen2;
if ($len_diff % 2 == 0)
	$temp = $len_diff / 2;
else
	$temp = ceil($len_diff/2);

for ($i=1;$i<=$temp;$i++)
	$_BLANK_PART2_ .= " ";

$heading2 = $_BLANK_PART2_ . "$heading2" . $_BLANK_PART2_ . "\n";
//	END	//


// THIS IS FOR SEPARATING THE FIELDS FROM FIELD HEADER PASSED BY THE PREVIOUS FORM AND
// CALCULATING THE LENGTH OF EACH FIELD HEADER AND ALSO NUMBER OF FIELDS.
// BEGINS //
for ($i=0;$i<$fldlen;$i++)
{
	if (($fld[$i] != "|") && ($fld[$i] != "~"))
	{
		$field_header .= $fld[$i];
		$onevariable .= $fld[$i];
	}
	elseif ($fld[$i] == "|")
	{
		$field_header .= " ";
		$var_len[$j] = strlen($onevariable);
		$j++;
		$onevariable = "";
	}
	elseif (($fld[$i] == "~") && ($fld[$i+1] == "~"))
	{
		$field_header .= "\n";
	}
}
// ENDS //

// THIS IS FOR SEPARATING THE FIELDS FROM FIELD HEADER PASSED BY THE PREVIOUS FORM AND
// CALCULATING THE LENGTH OF EACH FIELD HEADER AND ALSO NUMBER OF FIELDS.
// BEGINS //
for ($i=0;$i<$mainfldlen2;$i++)
{
	if (($main_fld2[$i] != "|") && ($main_fld2[$i] != "~"))
	{
		$main_field_header2 .= $main_fld2[$i];
		$main_onevariable .= $main_fld2[$i];
	}
	elseif ($main_fld2[$i] == "|")
	{
		$main_field_header2 .= " ";
		$var_len[$j] = strlen($main_onevariable);
		$j++;
		$main_onevariable = "";
	}
	elseif (($main_fld2[$i] == "~") && ($main_fld2[$i+1] == "~"))
	{
		$main_field_header2 .= "\n";
	}
}
// ENDS //







?>

<FORM NAME="tempfrm" METHOD="POST" ACTION="ViewDepreciationReport.php">
<INPUT TYPE="HIDDEN" NAME="filename" VALUE="<?=$filename;?>">
<DIV ALIGN='right'><INPUT TYPE='SUBMIT' NAME='print' VALUE='PRINT THE REPORT' class=bgbutton></DIV><BR>

<?php






	//$FinancialYear=$FinYear."-".($FinYear+1);

	//$FYearStart=$FinYear."-04-01";
	//$FYearEnd=($FinYear+1)."-03-31";


	//	THIS NINE LINES FOR INSERTING THE HEADER DETAILS ONLY IN FIRST PAGE.
	//	BEGIN		//
	fwrite($xy, $heading1);			// INSERT THE MAIN HEADER IN THE TEXT FILE.
	fwrite($xy, $heading2);			// INSERT THE SUB HEADER IN THE TEXT FILE.
	fwrite($xy, "\n");
	fwrite($xy, "LIST OF FIXED ASSETS FOR THE YEAR $FinancialYear\n");
	fwrite($xy, $_LINE_);
	fwrite($xy, $main_field_header2);
	fwrite($xy, $field_header);
	fwrite($xy, $_LINE_);
	$total_lines = 8;
	//	END		//


	$sql=execute("select * from depreciation_data where financial_year='$FinancialYear'");

		if(rowcount($sql)>=1)
	{

	echo "<center><b>$Caption</b></center>";
	echo "<table class=forumline align=center>";
	echo "<tr><td align=center Class=head colspan=10>LIST OF FIXED ASSETS FOR THE YEAR $FinancialYear</td></tr>";

	echo "<tr><td class=rowpic><b>Sl No</b></td><td class=rowpic><b>PARTICULARS</b></td><td class=rowpic><b>BALANCE AS ON ".date("d-m-Y",strtotime($FYearStart))."</b></td><td class=rowpic><b>ADDITIONS DURING THE YEAR</b></TD>";
	echo "<td class=rowpic><b>GROSS BLOCK AS ON ".date("d-m-Y",strtotime($FYearEnd))."</b></td><td class=rowpic><b>RATE OF DEPRECIATION(%)</b></TD><TD class=rowpic><b>AMOUNT OF DEPRECIATION</b></TD><TD class=rowpic><b>W.D.V AS ON ".date("d-m-Y",strtotime($FYearEnd))."</b></td></tr>";

	$sql1=execute("select * from asset_group") or die(error_description());

	$slno=1;

	for($i=0;$i<rowcount($sql1);$i++)
	{
		$r1=fetcharray($sql1,$i);

		$sql22=execute("select * from depreciation_data where asset_group_id=$r1[id] and financial_year='$FinancialYear'") or die(error_description());
		$rs22=fetcharray($sql22);

		$DepreciationRate=$rs22["depreciation_rate"];


		$sql33="select sum(asset_value) as AssetValue,sum(depreciation_amount) as DepnAmt,";
		$sql33.="sum(current_asset_value) as CurrentAssetValue from depreciation_data ";
		$sql33.=" where financial_year='$FinancialYear' and OldAsset='Yes' and asset_group_id=$r1[id]";

		$rs33=execute($sql33) or die(error_description());

		$r33=fetcharray($rs33);


		if($r33["AssetValue"]==NULL)
		{
			$BalanceValue=0;
		}
		else
		{
			$BalanceValue=$r33["AssetValue"];
		}

		if($r33["DepnAmt"]==NULL)
		{
			$OldDepnAmt=0;
		}
		else
		{
			$OldDepnAmt=$r33["DepnAmt"];
		}

		if($r33["CurrentAssetValue"]==NULL)
		{
			$OldCurrentAssetValue=0;
		}
		else
		{
			$OldCurrentAssetValue=$r33["CurrentAssetValue"];
		}

		$TotalBalanceValue=$TotalBalanceValue+$BalanceValue;

		$sql34="select sum(asset_value) as AssetValue,sum(depreciation_amount) as DepnAmt,";
		$sql34.="sum(current_asset_value) as CurrentAssetValue from depreciation_data ";
		$sql34.=" where financial_year='$FinancialYear' and OldAsset='No' and asset_group_id=$r1[id]";

		$rs34=execute($sql34) or die(error_description());

		$r34=fetcharray($rs34);

		if($r34["AssetValue"]==NULL)
		{
			$CurrentAdditions=0;
		}
		else
		{
			$CurrentAdditions=$r34["AssetValue"];
		}

		if($r34["DepnAmt"]==NULL)
		{
			$NewDepnAmt=0;
		}
		else
		{
			$NewDepnAmt=$r34["DepnAmt"];
		}

		if($r34["CurrentAssetValue"]==NULL)
		{
			$NewCurrentAssetValue=0;
		}
		else
		{
			$NewCurrentAssetValue=$r34["CurrentAssetValue"];
		}

		$TotalCurrentAdditions=$TotalCurrentAdditions+$CurrentAdditions;

		$GrossBlock=$BalanceValue+$CurrentAdditions;

		$DepreciationAmount=$OldDepnAmt+$NewDepnAmt;

		$TotalGrossBlock=$TotalGrossBlock+$GrossBlock;

		$TotalDepreciationAmount=$TotalDepreciationAmount+$DepreciationAmount;

		$WRDValue=$OldCurrentAssetValue+$NewCurrentAssetValue;

		$TotalWRDValue=$TotalWRDValue+$WRDValue;

		$fld1 = Insert_Others($var_len[0], $slno);
		$fld2 = Insert_Others($var_len[1], $r1[assetgroupname]);
		$fld3 = Insert_Others($var_len[2], $BalanceValue);
		$fld4 = Insert_Amt($var_len[3], $CurrentAdditions);
		$fld5 = Insert_Amt($var_len[4], $GrossBlock);
		$fld6 = Insert_Amt($var_len[5], $DepreciationRate);
		$fld7 = Insert_Amt($var_len[6], $DepreciationAmount);
		$fld8 = Insert_Amt($var_len[7], $WRDValue);
		$line  = $fld1 ." ". $fld2 ." ". $fld3 ." ". $fld4 ." ". $fld5 ." ";
		$line .= $fld6 ." ". $fld7 ." ". $fld8 ."\n";
		fwrite($xy, $line);
		$line = "";
		$total_lines++;
		$t = Check_Total($total_lines, $heading1, $heading2, $field_header, $main_field_header2, $_LINE_, $xy, $current_date, $page, $_BLANK_, $FinancialYear);
		if ($t == $total_lines)
			$total_lines = $t;
		else
		{
					$total_lines = $t;
					$page++;
		}


		echo "<tr><td>$slno</td><td>$r1[assetgroupname]</td><td align=right>".number_format($BalanceValue,"2",".",",")."</td>";
		echo "<td align=right>".number_format($CurrentAdditions,"2",".",",")."</td><td align=right>".number_format($GrossBlock,"2",".",",")."</td>";
		echo "<td align=center>".number_format($DepreciationRate,"2",".",",")."</td><td align=right>".number_format($DepreciationAmount,"2",".",",")."</td>";
		echo "<td align=right>".number_format($WRDValue,"2",".",",")."</td></tr>";

		$slno++;
	}

	$fld1 = Insert_Others($var_len[0], "");
	$fld2 = Insert_Others($var_len[1], "TOTAL");
	$fld3 = Insert_Others($var_len[2], $TotalBalanceValue);
		$fld4 = Insert_Amt($var_len[3], $TotalCurrentAdditions);
		$fld5 = Insert_Amt($var_len[4], $TotalGrossBlock);
		$fld6 = Insert_Others($var_len[5], "");
		$fld7 = Insert_Amt($var_len[6], $TotalDepreciationAmount);
		$fld8 = Insert_Amt($var_len[7], $TotalWRDValue);
		$line  = $fld1 ." ". $fld2 ." ". $fld3 ." ". $fld4 ." ". $fld5 ." ";
		$line .= $fld6 ." ". $fld7 ." ". $fld8 ."\n";
		fwrite($xy, $_LINE_);
		fwrite($xy, $line);
		$line = "";

	echo "<tr>";
	echo "<td>&nbsp;</td>";
	echo "<td><b>TOTAL</b></td>";
	echo "<td align=right><b>".number_format($TotalBalanceValue,"2",".",",")."</b></td>";
	echo "<td align=right><b>".number_format($TotalCurrentAdditions,"2",".",",")."</b></td>";
	echo "<td align=right><b>".number_format(($TotalGrossBlock),"2",".",",")."</b></td>";
	echo "<td>&nbsp;</td><td align=right><b>".number_format($TotalDepreciationAmount,"2",".",",")."</b></td>";
	echo "<td align=right><b>".number_format($TotalWRDValue,"2",".",",")."</b></td></tr>";
	echo "</table>";
	fwrite($xy, $_LINE_);
	fwrite($xy, "Date : $current_date");	// INSERT THE PRINTING DATE IN THE TEXT FILE.
	fwrite($xy, $_BLANK_);
        fwrite($xy, "PAGE : $page\n\n");		// INSERT THE PAGE NUMBER IN THE TEXT FILE.
	}


?>
</body>
</form>
</html>
