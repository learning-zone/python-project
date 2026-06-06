<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />
	<title>Event Calendar</title>
	<link rel="shortcut icon" href="Code/eventCalendar_v054/images/favicon.ico" />
	<!-- Grid CSS File (only needed for demo page) -->
	<link rel="stylesheet" href="Code/eventCalendar_v054/css/paragridma.css">
	<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
	<link rel="stylesheet" href="Code/eventCalendar_v054/css/eventCalendar.css">
	<!-- Theme CSS file: it makes eventCalendar nicer -->
	<link rel="stylesheet" href="Code/eventCalendar_v054/css/eventCalendar_theme_responsive.css">
	<!--<script src="js/jquery.js" type="text/javascript"></script>-->
	<script src="Code/eventCalendar_v054/js/jquery.min.js" type="text/javascript"></script>

</head>
<body id="responsiveDemo">
	<div class="container">
		<div class="row">
			<div class="g6">
				<h2 class="h4" align="center">Class Announcement</h2>
				<!--<p class="demoDesc">Most of you don't like timestamp date format, so now you can use another formats</p>-->
				<div id="eventCalendarHumanDate"></div>
				<script>
					$(document).ready(function() {
						$("#eventCalendarHumanDate").eventCalendar({
							eventsjson: 'Code/eventCalendar_v054/json/event.humanDate.json.php',
							jsonDateFormat: 'human'  // 'YYYY-MM-DD HH:MM:SS'
						});
					});
				</script>
<!--<pre>$(id).eventCalendar({
  eventsjson: 'file.json',
  jsonDateFormat: 'human'
});</pre>-->
			</div>
		</div>
	
				</div>
			</div>
		</div>
	</div>
</body>

<!--script src="js/jquery.timeago.js" type="text/javascript"></script-->
<!--<script src="js/jquery.eventCalendar.min.js" type="text/javascript"></script>-->
<script src="Code/eventCalendar_v054/js/jquery.eventCalendar.js" type="text/javascript"></script>

</html>