<?php
//We've included ../Includes/FusionCharts.php, which contains functions
//to help us easily embed the charts.
	session_start();

include("../Includes/FusionCharts.php");
require("../../../db.php");
	$academic_year=$_SESSION['AcademicYear'];

//att code start

$section[]="";
$section[]="A";
$section[]="B";
$section[]="C";
$section[]="D";
$section[]="E";
$secnt=fetcharray(execute("select max(class_section_id) from student_m where archive='N' and academic_year='$academic_year'"));
$secmax=$secnt[0];

  $secnt=execute("select * from class_section where id <= $secmax");
	$cntsec=rowcount($secnt);
	for($i=0;$i<$cntsec;$i++)
	{
		$r=fetcharray($secnt);
	}
	$rsBR = execute("SELECT year_id,year_name,short_name FROM course_year where status=1 order by head_id,year_id");
	$countBR = rowcount($rsBR);
	$sno=1;
	$secttl[]=0;
	$gttl=0;
	$gmor1=0;
	$gnoon1=0;
	$ststemdate=date("Y-m-d");
	for($i=0;$i<$countBR;$i++)
	{
		if($sno<10)
			$sno="0".$sno;
		$rBR = fetcharray($rsBR);
		$rs3e=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and archive='N'  and academic_year='$academic_year'"));
		if($rs3e[0])
		{
			
			$ttl=0;
			$ttm=0;
			$ttn=0;
			for($j=0;$j<$cntsec;$j++)
			{
				$morningp[0]=0;
				$noonngp[0]=0;
				$rs=fetcharray(execute("select count(id) from student_m where course_yearsem='$rBR[0]' and class_section_id='$j' and archive='N'  and academic_year='$academic_year'"));
				if($rs[0]>0)
				{
					
					$hedid=fetcharray(execute("SELECT head_id FROM course_year where year_id='$rBR[0]'"));
					$attandanceTablename="att_$rBR[0]";
					$morningp=fetcharray(execute("SELECT count(mor) FROM $attandanceTablename where att_date='$ststemdate' and mor='1' and sec='$j' group by subject_id"));
				//	$noonngp=fetcharray(execute("SELECT count(after) FROM $attandanceTablename where att_date='$ststemdate' and after='1' and sec='$j'"));
				
				$morningatt[]=$morningp[0];
				$noonat[]=$noonngp[0];
				if($section[$j]=='')
				$classname[]=$rBR[2];
				else
				$classname[]=$rBR[2]."-".$section[$j];
				$totalstudent[]=$rs[0];
				}
				else
				$rs[0];
				
				$ttl+=$rs[0];
				$secttl[$j]+=$rs[0];
				$ttm+=$morningp[0];
				$ttn+=$noonngp[0];
			}
			if($ttl>0)
			{
				 $ttm ;
				$ttn;
			}
			else
				echo "<td align='center'>$ttl</td>";
			$gttl+=$ttl;
			$gmor1+=$ttm;
			$gnoon1+=$ttn;
			$sno++;
		}
	
	}
	if($gttl>0)
	{
			$gmor1;
			$gnoon1;
			$gttl;
	}
	else
		$gttl;
//att code end
?>
<HTML>
<HEAD>
	<TITLE>
	FusionCharts Free - Array Example using Multi Series Column 3D Chart
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
	-->
	</style>
</HEAD>
<BODY>

<CENTER>

<?php
	//In this example, we plot a multi series chart from data contained
	//in an array. The array will have three columns - first one for data label (product)
	//and the next two for data values. The first data value column would store sales information
	//for current year and the second one for previous year.
	
	//Let's store the sales data for 6 products in our array. We also store the name of products. 
	
	//$morningatt[]=$morningp[0];
	//$noonat[]=$noonngp[0];
	//$classname[]=$rBR[1]."-$j";
	for($i=0;$i<sizeof($morningatt);$i++)
	{
	//Store Name of Products
	
		$arrData[$i][1] = $classname[$i];
	//Store sales data for current year
	
		$arrData[$i][2] =$totalstudent[$i];
		//Store sales data for previous year
		$arrData[$i][3] =$morningatt[$i];
		
	
	}
	
	

	//Now, we need to convert this data into multi-series XML. 
	//We convert using string concatenation.
	// $strXML - Stores the entire XML
	// $strCategories - Stores XML for the <categories> and child <category> elements
	// $strDataCurr - Stores XML for current year's sales
	// $strDataPrev - Stores XML for previous year's sales
	
	//Initialize <graph> element
	$strXML = "<graph caption='' numberPrefix='' formatNumberScale='1' rotateValues='1' decimalPrecision='0' >";
	
	//Initialize <categories> element - necessary to generate a multi-series chart
	$strCategories = "<categories>";
	
	//Initiate <dataset> elements
	$strDataCurr = "<dataset seriesName='Number of student' color='AFD8F8'>";
	$strDataPrev = "<dataset seriesName='Present student' color='F6BD0F'>";
	
	//Iterate through the data  
	foreach ($arrData as $arSubData) {
        //Append <category name='...' /> to strCategories
        $strCategories .= "<category name='" . $arSubData[1] . "' />";
        //Add <set value='...' /> to both the datasets
        $strDataCurr .= "<set value='" . $arSubData[2] . "' />";
        $strDataPrev .= "<set value='" . $arSubData[3] . "' />";
	}
	
	//Close <categories> element
	$strCategories .= "</categories>";
	
	//Close <dataset> elements
	$strDataCurr .= "</dataset>";
	$strDataPrev .= "</dataset>";
	
	//Assemble the entire XML now
	$strXML .= $strCategories . $strDataCurr . $strDataPrev . "</graph>";
	
	//Create the chart - MS Column 3D Chart with data contained in strXML
	echo renderChart("../../FusionCharts/FCF_MSColumn3D.swf", "", $strXML, "productSales", 900, 260);
?>

</CENTER>
</BODY>
</HTML>