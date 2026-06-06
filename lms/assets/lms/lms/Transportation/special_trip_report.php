<?php
session_start();
require("../db.php");
$vechilename=$_POST['vechilename'];
if($vechilename=='a')
$sel123='selected';
else
$sel123='';

	$ststemdate=date("Y-m-d");


if($_POST['zoom'])
$zoom=$_POST['zoom'];
else
$zoom=15;
$adate=$_POST['adate'];
if($adate)
{	
	$d=explode('/',$adate);
	$date1="$d[2]-$d[1]-$d[0]";
}
else
{
	$adate=date("d/m/Y");
	$date1=date("Y-m-d");
}
if(!$vechilename)
$vechilename='a';
?>
<html>
<head>
<SCRIPT LANGUAGE="JavaScript">

function reload1()
{
	document.frm.submit();
}
function timedRefresh(timeoutPeriod) 
{
	setTimeout("document.frm.submit();",timeoutPeriod);
}
</script>
 <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
<script language="javascript" src="../js/cal2.js"></script>
<script language="javascript" src="../js/cal_conf2.js"></script>
</head>
<?php
$val=12000;
?>
<body leftmargin=0 topmargin=0 onLoad="JavaScript:timedRefresh(<?=$val?>);">
<form action='' method='post' name="frm">
<table align=center width="642" class='forumline'>
<tr><td colspan=2 align="center" class=head>Bus Tracker</td></tr>
<tr>
	<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;Select Vehicle&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<select name='vechilename' onChange="reload1()">
		<option value='a' <?php echo $sel123; ?> >ALL</option>
		
		<?php
        $qry="select simNumber from rfid_gpsinfo where timeStamp like timeStamp '$ststemdate%' group by simNumber order by id desc";
		$rs = execute($qry);
		if($rs)
		{
			if(rowcount($rs)>0)
			{
				while($row=fetcharray($rs))
				{
					$disname=fetchrow(execute("select registration_no from vechile_master where vechile_mod_no='$row[0]'"));
				
					$sel="";
					if($vechilename==$row[0])
					echo "<option value='$row[0]' selected>$disname[0] ( $row[0]  )</option>";			
					else
					echo "<option value='$row[0]'>$disname[0] ( $row[0]  )</option>";			
					

				}

			}

		}?>
	</select>&nbsp;&nbsp;&nbsp;&nbsp;Date &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="adate" value="<?=$adate?>" size="10"  onFocus="reload1()" readonly>&nbsp;&nbsp;
	<a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a>
    </td>
    	</tr>	
	
</table>

<?php
$k=0;

?>

  <div id="map" align="center" style="width: 1100px; height: 480px;"></div>

  <script type="text/javascript">
    // Define your locations: HTML content for the info window, latitude, longitude
  var locations = [
   <?php
if($vechilename=='a')
{	
	$qry=execute("select simNumber from rfid_gpsinfo where timeStamp like timeStamp '$ststemdate%' and timeStamp like '$date1%'  group by simNumber order by id desc");
	while($r=fetcharray($qry))	
	{
      	$r1=fetchrow(execute("select longitude, latitude, timeStamp, location from  rfid_gpsinfo where simNumber='$r[0]' and timeStamp like '$date1%'  order by timeStamp desc limit 1"));
		$disname=fetchrow(execute("select registration_no from vechile_master where vechile_mod_no='$r[0]'"));
	   ?>
		
		  ['<h4><?="$disname[0] ( $r[0] ) $r1[2] $r1[3]"?></h4>', <?=$r1[1]?>, <?=$r1[0]?>],
		
    <?php
	}
}
else
{
	$ftlt1=execute("select longitude, latitude, timeStamp, location from  rfid_gpsinfo where simNumber='$vechilename' and timeStamp like '$date1%' order by timeStamp desc ");
   while($r=fetcharray($ftlt1))
   {
	   ?>
		  ['<h4><?=$r[2].' '.$r[3]?></h4>', <?=$r[1]?>, <?=$r[0]?>],
    <?php
   }
}
?>];
    // Setup the different icons and shadows
<?php
if($vechilename=='a')
{	
?>
    var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
    
    var icons = [
      iconURLPrefix + 'red-dot.png',
      iconURLPrefix + 'green-dot.png',
      iconURLPrefix + 'blue-dot.png',
      iconURLPrefix + 'orange-dot.png',
      iconURLPrefix + 'purple-dot.png',
      iconURLPrefix + 'pink-dot.png',      
      iconURLPrefix + 'yellow-dot.png'
    ]
<?php
}
else
{	
	?> 
	    var iconURLPrefix = 'http://labs.google.com/ridefinder/images/';

	   
	   var icons = [
     		
     		iconURLPrefix + 'mm_20_green.png',
 		]
	
	<?php
}?>    

    var icons_length = icons.length;
    
    
    var shadow = {
      anchor: new google.maps.Point(35,90),
      url: iconURLPrefix + 'msmarker.shadow.png'
    };

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: new google.maps.LatLng(-37.92, 151.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: false,
      panControl: false,
      zoomControlOptions: {
         position: google.maps.ControlPosition.LEFT_BOTTOM
      }
    });

    var infowindow = new google.maps.InfoWindow({
      maxWidth: 160
    });

    var marker;
    var markers = new Array();
    
    var iconCounter = 0;
    
    // Add the markers and infowindows to the map
    for (var i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon : icons[iconCounter],
        shadow: shadow
      });

      markers.push(marker);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      
      iconCounter++;
      // We only have a limited number of possible icon colors, so we may have to restart the counter
      if(iconCounter >= icons_length){
      	iconCounter = 0;
      }
    }

    function AutoCenter() {
      //  Create a new viewpoint bound
      var bounds = new google.maps.LatLngBounds();
      //  Go through each...
      $.each(markers, function (index, marker) {
        bounds.extend(marker.position);
      });
      //  Fit these bounds to the map
      map.fitBounds(bounds);
    }
    AutoCenter();
  </script> 

</form>
</body>
</html>
