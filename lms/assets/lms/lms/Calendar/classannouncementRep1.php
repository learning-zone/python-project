<?php
session_start();
include("../db.php");
	$sem=$_SESSION['sem'];
	$query="SELECT *  FROM `announcement_class` where class='$sem' or class='0'";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel='stylesheet' type='text/css' href='demos/cupertino/theme.css' />
<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.print.css' media='print' />


<script type='text/javascript' src="jquery/jquery-1.7.1.min.js"></script>
<script type='text/javascript' src='jquery/jquery-ui-1.8.17.custom.min.js'></script>
<script type='text/javascript' src='fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: false,
			events: [
			<?php
				$sql3=execute($query);
				$rcount=rowcount($sql3);
				$i=1;
				while($r2=fetcharray($sql3))
				{
					
					$fd=$r2['fromdate'];
					
					$fd1=explode('-',$fd);
					if($fd1[0]==date(Y))
					$fdy='y';
					else
					$fdy=$fd1[0];
					if(MonthName($fd1[1])!='m')
					$newm='m'.MonthName($fd1[1]);
					else
					$newm='m';
					
  
			
			?>
				{
					title: '<?=$r2['title']?>',
					start: new Date(<?=$fdy?>, <?=$newm?>, <?=$fd1[2]?>, 10, 00),
					<?php
					if($r2['type']==2)
					{
						$fd=$r2['todate'];
					
					$fd1=explode('-',$fd);
					if($fd1[0]==date(Y))
					$fdy='y';
					else
					$fdy=$fd1[0];
					if(MonthName($fd1[1])!='m')
					$newm='m'.MonthName($fd1[1]);
					else
					$newm='m';
					?>
					end: new Date(<?=$fdy?>, <?=$newm?>, <?=$fd1[2]?>, 10, 00),
					<?php
					}
					?>
					url: 'viewannouncement_class.php?id=<?=$r2[id]?>',
					allDay: false,
				}
			<?php
			if($i!=9)
			?>,
			<?php
			}
			?>
			],
			eventClick: function(event) 
			{
				// opens events in a popup window
				window.open(event.url, 'gcalevent', 'width=700,height=600');
				return false;
			},
		});
		
	});

</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 11px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 700px;
		margin: 0 auto;
		}

</style>
</head>
<body>
<div id='calendar'></div>
</body>
</html>
<?php
function MonthName($mont)
{
	if(date(m)==$mont)
	{
		return(m);
	}
	if(date(m)>$mont)
	{
		if($mont == 1) return($mont-date(m));
     	if($mont == 2) return($mont-date(m));
        if($mont == 3) return($mont-date(m));
        if($mont == 4) return($mont-date(m));
        if($mont == 5) return($mont-date(m));
        if($mont == 6) return($mont-date(m));
        if($mont == 7) return($mont-date(m));
        if($mont == 8) return($mont-date(m));
        if($mont == 9) return($mont-date(m));
        if($mont == 10) return($mont-date(m));
        if($mont == 11) return($mont-date(m));
        if($mont == 12) return($mont-date(m));
	}
	if(date(m)<$mont)
	{
		if($mont == 1) return($mont-date(m));
     	if($mont == 2) return($mont-date(m));
        if($mont == 3) return($mont-date(m));
        if($mont == 4) return($mont-date(m));
        if($mont == 5) return($mont-date(m));
        if($mont == 6) return($mont-date(m));
        if($mont == 7) return($mont-date(m));
        if($mont == 8) return($mont-date(m));
        if($mont == 9) return($mont-date(m));
        if($mont == 10) return($mont-date(m));
        if($mont == 11) return($mont-date(m));
        if($mont == 12) return($mont-date(m));
	}
}
   

?>