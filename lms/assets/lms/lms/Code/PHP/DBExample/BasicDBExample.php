<?php
//We've included ../Includes/FusionCharts.php and ../Includes/DBConn.php, which contains
//functions to help us easily embed the charts and connect to a database.
include("../Includes/FusionCharts.php");
include("../Includes/DBConn.php");
?>
<HTML>
<HEAD>
	<TITLE>
	FusionCharts Free - Database Example
	</TITLE>
	<?php
	//You need to include the following JS file, if you intend to embed the chart using JavaScript.
	//Embedding using JavaScripts avoids the "Click to Activate..." issue in Internet Explorer
	//When you make your own charts, make sure that the path to this JS file is correct. Else, you would get JavaScript errors.
	?>	
	<SCRIPT LANGUAGE="Javascript" SRC="../../FusionCharts/FusionCharts.js"></SCRIPT>
	<style type="text/css">
	<!--
	body {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	.text{
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	-->
	</style>
</HEAD>
<BODY>

<CENTER>
<?php
	//In this example, we show how to connect FusionCharts to a database.
	//For the sake of ease, we've used an MySQL databases containing two
	//tables.
		
	// Connect to the DB

	//$strXML will be used to store the entire XML document generated
	//Generate the graph element
	$strXML = "<graph caption='Factory Output report' subCaption='By Quantity' pieSliceDepth='30' showBorder='1' showNames='1' formatNumberScale='0' numberSuffix=' Units' decimalPrecision='0'>";

	// Fetch all factory records
    
	//Iterate through each factory
	for($i=0;$i<10;$i++)
	{	
		//Now create a second query to get details for this factory
			
			//Generate <set name='..' value='..' />        
			$strXML .= "<set name='hh' value='2' />";
			//free the resultset
			
		
	}
	
	//Finally, close <graph> element
	$strXML .= "</graph>";
	
	//Create the chart - Pie 3D Chart with data from $strXML
	echo renderChart("../../FusionCharts/FCF_Pie3D.swf", "", $strXML, "FactorySum", 950, 450);
?>
</BODY>
</HTML>