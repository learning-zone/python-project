<?php
	session_start();

	include("../../db.php");
	
		function Check_Total($total_lines, $heading1, $heading2, $field_header, $_LINE_, $xy, $current_date, $page, $_BLANK_)
				{
		if ($total_lines >= 61)
					{
						fwrite($xy, $_LINE_);			// LINE NO 62.
						fwrite($xy, "Date : $current_date");	// INSERT THE PRINTING DATE IN THE TEXT FILE.
						fwrite($xy, $_BLANK_);
						fwrite($xy, "PAGE : $page\n\n");		// INSERT THE PAGE NUMBER IN THE TEXT FILE.
						fwrite($xy, "\n\n\n\n\n\n\n\n\n\n\n\n");	// PAGE EJECT
						fwrite($xy,               $heading1);			// INSERT THE MAIN HEADER IN THE TEXT FILE.
						fwrite($xy,                   $heading2);			// INSERT THE SUB HEADER IN THE TEXT FILE.
						fwrite($xy, "\n\n\n");
						fwrite($xy, "ITEM STOCK STATUS REPORT \n");
						fwrite($xy, $_LINE_);
						fwrite($xy, $field_header);
						fwrite($xy, $_LINE_);
						$total_lines = 7;
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

			// VARIABLE DECLARATION BEGINS.
			$current_date = date("d-m-Y");		// FOR STORING THE CURRENT DATE.
			$filename = "../../printmodule/itemstockstatusreport.txt";	// FOR STORING THE FILE NAME WITH PATH.
			$rs_sql=execute("SELECT * FROM college");
			$r_sql=fetcharray($rs_sql);
			$college_name=$r_sql[col_name];
			$Caption=$college_name;
			$heading1 = "$Caption";
			$headlen1 = strlen($heading1);	// LENGTH FOR REPORT  HEADER.
			$headlen2 = strlen($heading2);	// LENGTH FOR REPORT HEADER 2.

			$fld = "Item Name        |                  Stock in Hand             |~~";
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
			
			for($num=0;$num<$fldlen;$num++)
			{
				$_BLANK_ .= "    ";
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
				$temp = $_BLANK_PART2_.ceil($len_diff/2);

			for ($i=1;$i<=$temp;$i++)
				$_BLANK_PART2_ .= " ";
				

			$heading2 = $_BLANK_PART2_ . "$heading2" .$_BLANK_PART2_."\n";
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

			echo "<br>";
			echo "<br>";
			?>

<html>
<script language="JavaScript">
function printReport()
{
	prn.style.display = "none";
	window.print();
	prn.style.display = "";
}
</script>
<head><title>Consumables -- Stock Status Report</title></head>
<body>
<FORM NAME="tempfrm" METHOD="POST" ACTION="StockStatusReport.php">

<!--Modified by Muzammil Ahmed A on 11-Feb-2005
The Display format was not Correct it has been rectified-->

<!--<div aLIGN='right'><INPUT class=bgbutton TYPE='SUBMIT' NAME='print' VALUE='PRINT THE REPORT'></div>--><br>
		<INPUT TYPE="HIDDEN" NAME="filename" VALUE="<?=$filename;?>">
	<?php
//$sql="select a.*,b.* from itemmaster a,stockdetails b where ";
//$sql.=" a.id=b.itemid and b.qoh<>0 order by a.itemname ASC";
$sql="select a.* from h_item_master a order by a.item_name ASC";
	$rs=execute($sql) or die(error_description());
	echo "<table border=1 class=forumline align=center>";
	echo "<tr><td Class=head align=center colspan=3>Item Stock Status Report</td></tr>";

	echo "<tr><td Class=rowpic><font color=#0000ff>Item Name</font></td><td Class=rowpic><font color=#0000ff>Stock On Hand</font></td><td Class=rowpic><font color=#0000ff>Quantity Type</font></td></tr>";

	//	THIS NINE LINES FOR INSERTING THE HEADER DETAILS ONLY IN FIRST PAGE.
		//	BEGIN		//
		fwrite($xy, $heading1);			// INSERT THE MAIN HEADER IN THE TEXT FILE.
		fwrite($xy, $heading2);			// INSERT THE SUB HEADER IN THE TEXT FILE.
		fwrite($xy, "\n");
		fwrite($xy, "ITEMWISE STOCK STAUS REPORT as on $current_date \n");
		fwrite($xy, $_LINE_);
		fwrite($xy, $field_header);
		fwrite($xy, $_LINE_);
		$total_lines = 7;
	//	END		//

	for($i=0;$i<rowcount($rs);$i++)
	{
		$r=fetcharray($rs,$i);
		$fld1 = Insert_Others($var_len[0], $r[itemname]);

//Modified by Muzammil Ahmed A on 11-Feb-2005
//The Stock in Hand was displaying extra stock rather than the actual stock and the print format was not correct it has been rectified.



		$fld2 = Insert_Others($var_len[1], "\t\t\t$r[qoh]");
		$line  = $fld1 ." ". $fld2 ."\n";
		fwrite($xy, $line);
		$line = "";
		$total_lines++;
		$total_lines++;
		$t = Check_Total($total_lines, $heading1, $heading2, $field_header, $_LINE_, $xy, $current_date, $page, $_BLANK_);
		if ($t == $total_lines)
		$total_lines = $t;
				else
				{
				$total_lines = $t;
				$page++;
				}

//Modified by Muzammil Ahmed A on 11-Feb-2005
//Stock On Hand Quantity was Displaying more than the actual stock it has been rectified


		//echo "<tr><td class=row2 align=left>$r[itemname]</td><td class=row2 align=center>$r[qoh]</td></tr>";
		echo "<tr><td class=row2 align=left>$r[item_name]</td><td class=row2 align=center>$r[stock]</td><td class=row2 align=center>$r[quantity_type]</td></tr>";
	}
	echo "</table>";
	fwrite($xy, $_LINE_);
	fwrite($xy, "Date : $current_date");	// INSERT THE PRINTING DATE IN THE TEXT FILE.
	fwrite($xy, $_BLANK_);
	fwrite($xy, "PAGE : $page\n\n");		// INSERT THE PAGE NUMBER IN THE TEXT FILE
	$total_lines+=6;
?>
</FORM>
<form method="POST" name=form1>
	  <div id="prn" align='center'><input class=bgbutton type="button" value="   Print   " name="B1"
	  onClick="printReport()" ></div>
</form>
</body>
</html>
