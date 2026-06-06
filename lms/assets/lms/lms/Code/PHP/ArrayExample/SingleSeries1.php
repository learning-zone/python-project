<?php
//We've included ../Includes/FusionCharts.php, which contains functions
//to help us easily embed the charts.
include("../Includes/FusionCharts.php");
//We've also included ../Includes/FC_Colors.asp, having a list of colors
//to apply different colors to the chart's columns. We provide a function for it - getFCColor()
include("../Includes/FC_Colors.php");
?>
<HTML>
<HEAD>
	<TITLE>
	FusionCharts Free - Array Example using Single Series Column 3D Chart
	</TITLE>
	<?php
	//You need to include the following JS file, if you intend to embed the chart using JavaScript.
	//Embedding using JavaScripts avoids the "Click to Activate..." issue in Internet Explorer
	//When you make your own charts, make sure that the path to this JS file is correct. Else, you would get JavaScript errors.
	?>	
	<SCRIPT LANGUAGE="Javascript" SRC="../../FusionCharts/FusionCharts.js"></SCRIPT>
	
	
<script LANGUAGE="JavaScript">
	
	function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
</script>
	<style type="text/css">
	<!--
	body {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	-->
	</style>
</HEAD>
<BODY onLoad="JavaScript:timedRefresh(50000);">

<CENTER>
<?php
	//In this example, we plot a single series chart from data contained
	//in an array. The array will have two columns - first one for data label/names
	//and the next one for data values.
	
	//Let's store the sales data for 6 products in our array). We also store
	//the name of products. 
	//Store Name of Products
	
for($i=0;$i<12;$i++)
{
	$arrData[$i][1] = "Student".$i;
	
	//Store sales data
	$arrData[$i][2] =4*$i;
}

	//Now, we need to convert this data into XML. We convert using string concatenation.
	//Initialize <graph> element
	$strXML = "<graph caption='' numberPrefix='' formatNumberScale='0' decimalPrecision='0'>";
	//Convert data to XML and append
	foreach ($arrData as $arSubData)
		$strXML .= "<set name='" . $arSubData[1] . "' value='" . $arSubData[2] ."' color='". getFCColor() ."' />";

	//Close <graph> element
	$strXML .= "</graph>";
	
	//Create the chart - Column 3D Chart with data contained in strXML
	echo renderChart("../../FusionCharts/FCF_Column3D.swf", "", $strXML, "productSales", 430, 260);
?>

</CENTER>
</BODY>
</HTML>