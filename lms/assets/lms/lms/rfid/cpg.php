<?php
session_start();
$per00=$_SESSION['per00'];
include("db1.php");


	$sem=$_SESSION['sem'];
	$branch=$_SESSION['branch'];
	$academic_year=$_SESSION['AcademicYear'];


if($branch=='0')
{
	$sem='';
}
//print_r($_SESSION);
//att code start
$section[]="";
$section[]="A";
$section[]="B";
$section[]="C";
$section[]="D";
$section[]="E";
$secnt=fetcharray(execute("SELECT max(class_section_id) FROM student_m WHERE archive='N' and academic_year='$academic_year'"));
$secmax=$secnt[0];

  $secnt=execute("SELECT * FROM class_section WHERE id <= $secmax");
	$cntsec=rowcount($secnt);
	for($i=0;$i<$cntsec;$i++)
	{
		$r=fetcharray($secnt);
	}
	if($branch!='0' and $branch!='')
	{
		$rsBR = execute("SELECT year_id,year_name,short_name FROM course_year WHERE status=1 AND head_id='$branch' ORDER BY head_id,year_id");
		$countBR = rowcount($rsBR);
	}
/*	elseif($sem!='' AND $branch!='')
	{
		$rsBR = execute("SELECT year_id,year_name,short_name FROM course_year WHERE status=1 AND year_id='$sem' order by head_id,year_id");
		$countBR = rowcount($rsBR);
	}*/
	else
	{
		$rsBR = execute("SELECT year_id,year_name,short_name FROM course_year WHERE status=1 order by head_id,year_id");
		$countBR = rowcount($rsBR);
	}
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
		$rs3e=fetcharray(execute("SELECT count(id) FROM student_m WHERE course_yearsem='$rBR[0]' AND archive='N' and academic_year='$academic_year'"));
		if($rs3e[0])
		{
			
			$ttl=0;
			$ttm=0;
			$ttn=0;
			for($j=0;$j<5;$j++)
			{
				$morningp[0]=0;
				$noonngp[0]=0;
				
				$rs=fetcharray(execute("SELECT count(id) FROM student_m WHERE course_yearsem='$rBR[0]' AND class_section_id='$j' AND archive='N' and academic_year='$academic_year'"));
				if($rs[0]!='0' or $rs[0]!=0 )
				{
					$hedid=fetcharray(execute("SELECT head_id FROM course_year WHERE year_id='$rBR[0]'"));
					$attandanceTablename="att_$rBR[0]";
					$mo1=fetcharray(execute("SELECT subject_id FROM $attandanceTablename WHERE att_date='$ststemdate' AND mor='1' AND sec='$j' group by subject_id limit 1"));
					$morningp1=execute("SELECT mor  FROM $attandanceTablename WHERE att_date='$ststemdate' AND mor='1' AND sec='$j' and subject_id='$mo1[0]' group by stu_id");
					$m1=0;
					while($m=fetcharray($morningp1))
					{
						$m1=$m1+1;
					}
					$morningp[0]=$m1;
				//	$noonngp=fetcharray(execute("SELECT count(after) FROM $attandanceTablename WHERE att_date='$ststemdate' and after='1' and sec='$j'"));
				
					
					$morningatt[]=$morningp[0];
					
					
					$noonat[]=$noonngp[0];
					if($section[$j]=='')
					{
						$classname[]=$rBR[2];
						$classID[]=$rBR[0];
						$sectionID[]=$j;
					}
					else
					{
						$classname[]=$rBR[2]."-".$section[$j];
						$classID[]=$rBR[0];
						$sectionID[]=$j;
					}
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
				$ttm;
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
		
	$arraySize=sizeof($morningatt);
		
	for($i=0; $i<$arraySize; ++$i)
	{	
		//$absent[] = $totalstudent[$i] - $morningatt[$i];
		//$var="100";
		//echo "<br>".$totalstudent[$i];	
		//echo "<br>".$morningatt[$i];
		
		$absent[] = $totalstudent[$i] - $morningatt[$i];
		//$present[] = $morningatt[$i];
		//$absent[] = rand(1,9);
		if(!$morningatt[$i])
		{
			$present[] = -1;
		}
		else
		{
			$present[] = $morningatt[$i];
		}
		$hostel[] = -1;	
		
		if(!$sectionID[$i])
		{
			$sectionID[$i]=0;
		}
		//echo "<br>".$classID[$i]."-".$sectionID[$i];
			
	}
		
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
#marqueecontainer {
	position: relative;
	width: 390px; /*marquee width */
	height: 210px; /*marquee height */
	background-color: light orange;
	overflow: hidden;
	border: none;
	padding: 2px;
	padding-left: 4px;

}
.scroll_div {
	background-color: light orange;
	border: solid 1px #66CCFF;
	width: 300px;
	width /**/: 280px !important;
}
.vmarquee_content {
	position: absolute;
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
</style>
<script type="text/javascript">
function ReloadMe(classid,secid)
{		
	var w=800,h=500;
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open ('student_det/view_studlist_att.php?clid='+classid+'&secid='+secid, 'STUDENT ATTENDANCE', '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

}
</script>
<script type="text/javascript" src="Code/Highcharts-3.0.2/js/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Attendance Summary [ <?=date('d-m-Y H:i:s')?> ]'
            },
            xAxis: {
                /*categories: ['Apple','Mango','Banana']*/
				categories: [
				<?PHP
					
					for($i=0;$i<$arraySize;++$i)
					{
						?>
						'<a href="javascript:ReloadMe(<?=$classID[$i]?>,<?=$sectionID[$i]?>)"><?=$classname[$i]?></a>',
						<?
					}
				?>
				]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'No of Students'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -100,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: [{
                name: 'Present',
              
				 data: [
				 <?PHP
				  	for($i=0;$i<$arraySize;++$i)
					{  
					  ?>
					     <?=$present[$i]?>,
					  <?
					}
				 ?>]
            }, {
                name: 'Absent',
				data: [	 
				<?PHP
					for($i=0;$i<$arraySize;++$i)
					{	
					  ?>	 
						  <?=$absent[$i]?>,
					  <?	
					}
				 ?>]
            }, {
                name: 'Medical Room',
                data: [	 
				<?PHP
				  	for($i=0;$i<$arraySize;++$i)
					{
						?>
						   <?=$hostel[$i]?>,
						<?	
					}
				 ?>]
            }]
        });
    });
 </script>
 <!------------------------------------------------------------------------------------------------------------>
<script type="text/javascript">
$(function () {
        $('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Total Members [ <?=date('d-m-Y H:i:s')?> ]'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'MBIS MEMBERS',
                data: [
                    ['Student',   45.0],
                    ['Staff',       26.8],
                    {
                        name: 'Father',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Mother',    8.5],
                    ['Visitor',     6.2],
                    ['Care Giver',   0.7]
                ]
            }]
        });
    });
   </script>
  <!------------------------------------------------------------------------------------------------------------>
<script type="text/javascript">
$(function () {
        $('#container3').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Ongoing Classes [ <?=date('d-m-Y H:i:s')?> ]'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Ongoing Classes',
                data: [
                    ['LKG 1',   20.0],
                    ['LKG 2',       20.0],
                    {
                        name: 'I - A',
                        y: 20.0,
                        sliced: true,
                        selected: true
                    },
                    ['II - A',    20.0],
                    ['III - A',     20.0]
                    
                ]
            }]
        });
    });
   </script>
 <!------------------------------------------------------------------------------------------------------------>
<script src="Code/Highcharts-3.0.2/js/highcharts.js"></script>
<script src="Code/Highcharts-3.0.2/js/modules/exporting.js"></script>
<script type="text/javascript" language="javascript">
  var  delayb4scroll=1000; 
  var marqueespeed=1; 
  var pauseit=1; 
  var tim;
  var copyspeed=marqueespeed;
  var pausespeed=(pauseit==0)? copyspeed: 0;
  var actualheight='';
  var acht='';
function scrollmarquee(){

		marqueeheight = document.getElementById("marqueecontainer").offsetHeight;

		actualheight = cross_marquee.offsetHeight;

	 	if (document.getElementById('track').value == "") {

			if (parseInt(cross_marquee.style.top)>(actualheight*(-1)+8)) {

				cross_marquee.style.top=parseInt(cross_marquee.style.top)-copyspeed+"px";			

			}

			else {

				 cross_marquee.style.top=parseInt(marqueeheight)-8+"px";

			}

		}

	}
//press down
function pressdown() {

		document.getElementById('track').value = "yes";

		//marqueeheight=document.getElementById("marqueecontainer").offsetHeight;

		actualheight = cross_marquee.offsetHeight;

			if (parseInt(cross_marquee.style.top)<(actualheight-8-(actualheight-acht))) {

				cross_marquee.style.top=parseInt(cross_marquee.style.top)+ 10 +"px";

				tim = setTimeout("pressdown()", 150);

			}

			else {


				cross_marquee.style.top=parseInt(marqueeheight)*(-1)-(actualheight-acht)+"px";

				tim = setTimeout("pressdown()", 150);

			}

	}
//press up
function pressup() {

		document.getElementById('track').value = "yes";
		actualheight = cross_marquee.offsetHeight;

			if (parseInt(cross_marquee.style.top)>(actualheight*(-1)+8)) {

				cross_marquee.style.top=parseInt(cross_marquee.style.top)-10 +"px";

				tim = setTimeout("pressup()", 150);

			}

			else {

				//alert("inside else");

				cross_marquee.style.top=parseInt(marqueeheight)-8+"px";

				tim = setTimeout("pressup()", 150);

				

			}

	}
//on mouse out
function mouse_out() {

		document.getElementById('track').value = "";

		clearTimeout(tim);

		scrollmarquee;

	}

//init()

function initializemarquee(){

	cross_marquee=document.getElementById('vmarquee');

	actualheight = cross_marquee.offsetHeight;

	acht=cross_marquee.offsetHeight;

  	cross_marquee.style.top=0;

    marqueeheight = document.getElementById("marqueecontainer").offsetHeight;



		setTimeout('lefttime=setInterval("scrollmarquee()",35)', delayb4scroll);

}
function openNews(linkUrl) {

	var w=window.open(linkUrl, 'glossarypopup', 'scrollbars=yes,menubar=no,height=600,width=810,resizable=yes,toolbar=no,location=no,status=no'); 

	w.focus(); 

	return false;

}
</script>
</head>
<body style="background-image:url(bgy.png)" >
<?php
//if($_SESSION['user']=='administrator' and $per00==1)
if($per00==1)
{

	?>
	<table class=""  width="98%" height="515" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td  class="homebody" scope="col" colspan="2" valign="top">
    <!--xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx   STUDENT GRAPH   xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->
        <div id="container" style="min-width: 100%; height: 280px; margin: 0 auto"></div><BR>
        </td></tr>
<!--	  <tr>
		<td class="homebody"  scope="row">
        xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx   TOTAL MEMBER GRAPH   xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        <div id="container2" style="min-width: 400px; height: 300px; margin: 0 auto"></div>
        </td>
		<td  class="homebody" >
        xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  ONGOING CLASS GRAPH   xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        <div id="container3" style="min-width: 400px; height: 300px; margin: 0 auto"></div>
        </td>
	  </tr>-->
		<td class="homebody"  scope="row" colspan="2"><font size="+1"><b>Members Present in School</b></font></td>
	  </tr>
	<tr>
		<td class="homebody"  scope="row" valign="top" colspan="2">
        <table class=""  width="300"  border="1"  cellpadding="3" cellspacing="0" style="border:1px solid black;">
	  <tr><td style="border:0px solid black;" bgcolor="#EDF5FF"><b>
        Students</b></td><td style="border:0px solid black;" bgcolor="#EDF5FF">
        <?php
		$intime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and b.user_type='1' group by b.rfid "));
		
		//SELECT `user_type` FROM `rfid_enrolment_user` where `status`=1 group by user_type
		
		 $outtime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and b.user_type='1' group by b.rfid "));
		
		$total=$intime-$outtime;
        
        ?>
        <a href="javascript:ReloadMe('a','a')">
        <?=$total?></a></td>
	</tr>
    
	  <tr><td style="border:0px solid black;" bgcolor="#FFFFFF" ><b>
        Staff</b></td><td style="border:0px solid black;" bgcolor="#FFFFFF" >
<?php
		$intime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and b.user_type='2' group by b.rfid "));
		
		
		//SELECT `user_type` FROM `rfid_enrolment_user` where `status`=1 group by user_type
		
		 $outtime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and b.user_type='2'  group by b.rfid  "));
		
		$total=$intime-$outtime;
        if($total<0)
		$total=0;
        ?>
        <?=$total?></td>
	 	
	</tr>
	
    
	  <tr><td style="border:0px solid black;" bgcolor="#EDF5FF"><b>
        Fathers</b></td><td style="border:0px solid black;" bgcolor="#EDF5FF">
        
		
        <?php
		$intime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and b.user_type='3'  group by b.rfid "));
		
		//SELECT `user_type` FROM `rfid_enrolment_user` where `status`=1 group by user_type
		
		 $outtime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and b.user_type='3'  group by b.rfid "));
		
		$total=$intime-$outtime;
        if($total<0)
		$total=0;
        
        ?>
        <?=$total?></td>
	</tr>

		<tr><td style="border:0px solid black;" bgcolor="#FFFFFF" ><b>
        Mothers</b></td><td style="border:0px solid black;" bgcolor="#FFFFFF" >
        <?php
		$intime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and b.user_type='4'  group by b.rfid "));
		
		//SELECT `user_type` FROM `rfid_enrolment_user` where `status`=1 group by user_type
		
		 $outtime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and b.user_type='4'   group by b.rfid "));
		
		$total=$intime-$outtime;
        if($total<0)
		$total=0;
        
        ?>
        <?=$total?></td>
	</tr>
	<tr>
<tr><td style="border:0px solid black;" bgcolor="#EDF5FF"><b>
        Care givers</b></td><td style="border:0px solid black;" bgcolor="#EDF5FF">               <?php
		$intime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and (b.user_type='5' or b.user_type='6' or b.user_type='7')  group by b.rfid "));
		
		//SELECT `user_type` FROM `rfid_enrolment_user` where `status`=1 group by user_type
		
		 $outtime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and ( b.user_type='6' )   group by b.rfid "));
		
		$total=$intime-$outtime;
        if($total<0)
		$total=0;
        
        ?>
        <?=$total?></td>
	</tr>
<tr><td style="border:0px solid black;" bgcolor="#FFFFFF" ><b>
        Visitors</b></td><td style="border:0px solid black;" bgcolor="#FFFFFF" >               <?php
		$intime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and ((a.controllerip='192.168.0.31' and (a.readerno='1' or a.readerno='5')) or (a.controllerip='192.168.0.32' and (a.readerno='1' or a.readerno='5'))) and b.status=1 and (b.user_type='9')  group by b.rfid "));
		
		//SELECT `user_type` FROM `rfid_enrolment_user` where `status`=1 group by user_type
		
		 $outtime=rowcount(execute("SELECT a.att_time FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate' and ((a.controllerip='192.168.0.31' and (a.readerno='4' or a.readerno='8')) or (a.controllerip='192.168.0.32' and (a.readerno='4' or a.readerno='8'))) and b.status=1 and ( b.user_type='9')   group by b.rfid "));
		
		$total=$intime-$outtime;
        if($total<0)
		$total=0;
        
        ?>
        <?=$total?></td>
	</tr>
<tr><td style="border:0px solid black;" bgcolor="#EDF5FF"><b>
        Medical Room</b></td><td style="border:0px solid black;" bgcolor="#EDF5FF">               <?php
		$intime=execute("SELECT  a.rfidno FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and a.controllerip='192.168.0.33' and  a.readerno='4'  and b.status=1  group by b.rfid ");
		$count=0;
		while($r=fetchrow($intime))
		{
			$intime1=fetchrow(execute("select count(*) from rfidupdate where  rfidno='$r[0]' and att_date='$ststemdate' and controllerip='192.168.0.33' and  readerno='4' "));
			if(2%$intime1[0])
			$count++;
		}
		
        
        ?>
        <?=$count?></td>
	</tr>	
<tr><td style="border:0px solid black;" bgcolor="#FFFFFF"><b>
        Hostel</b></td><td style="border:0px solid black;" bgcolor="#FFFFFF">               <?php
		$intime=execute("SELECT  a.rfidno FROM rfidupdate a, rfid_enrolment_user b where a.rfidno=b.rfid and a.att_date='$ststemdate'  and a.controllerip='192.168.0.33' and  a.readerno='5'  and b.status=1  group by b.rfid ");
		$count=0;
		while($r=fetchrow($intime))
		{
			$intime1=fetchrow(execute("select count(*) from rfidupdate where rfidno='$r[0]' and att_date='$ststemdate' and controllerip='192.168.0.33' and  readerno='5' "));
			if(2%$intime1[0])
			$count++;
		}
		
        
        ?>
        <?=$count?></td>
	</tr>    </table>
    
	<?php

}
elseif($_SESSION['user']!='administrator' and $per00==1)
{
			//echo "<p align=center>Faculty Login</p>";
}
?>
<!--<div align="center"><input type="button" name="print" value="Print All"></div>
--></body>
</html>