<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Slides, A Slideshow Plugin for jQuery</title>
	<link rel="stylesheet" href="css/global.css">
	<script src="jquery.min.js"></script>
	<script src="js/slides.min.jquery.js"></script>

	<script>

	function OpenWind2(k2)

	{

		var finalVar ;

		finalVar=k2 ;

		window.open(finalVar,'Stud','width=900,height=550,status=yes,toolbar=no,scrollbars=no,menubar=no,location=no');

	}

		$(function(){

			$('#slides').slides({

				preload: true,

				preloadImage: 'img/loading.gif',

				play: 5000,

				pause: 2500,

				hoverPause: true,

				animationStart: function(current){

					$('.caption').animate({

						bottom:-35

					},100);

					if (window.console && console.log) {

						// example return of current slide number

						console.log('animationStart on slide: ', current);

					};

				},

				animationComplete: function(current){

					$('.caption').animate({

						bottom:0

					},200);

					if (window.console && console.log) {

						// example return of current slide number

						console.log('animationComplete on slide: ', current);

					};

				},

				slidesLoaded: function() {

					$('.caption').animate({

						bottom:0

					},200);

				}

			});

		});

	</script>

</head>

<body>

	<div id="container">

		<div id="example">

			

			<div id="slides">

				<div class="slides_container">

<?php

  include("../db1.php");



$temsql3=execute("select * from album where status=1 order by id desc");

		while($r=fetcharray($temsql3))

		{

				$tems=fetchrow(execute("select HalfImagepath from albumpic where AlbumID='$r[id]' and (Cover=1 or Cover=0) order by Cover desc, id  limit 1 "));

		/*	<a href="schoolGalleryView.php?id=<?=$r[id]?>" title="<?=$r[Description]?>"> */

				

?>					

					<div class="slide">

						<a href="javascript:OpenWind2('schoolGalleryView2.php?id=<?=$r[id]?>')" ><img src="<?=$tems[0]?>" width="570" height="270" alt="Slide 5"></a>

						<div class="caption">

							<p>&ldquo;<?=$r[Albumname]?>&rdquo;</p>

						</div>

					</div>

<?php



		}

?>				

				</div>

				<a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>

				<a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>

			</div>

			<img src="img/example-frame.png" width="739" height="341" alt="Example Frame" id="frame">

		</div>

		<div id="footer">

			<p>For full instructions go to <a href="http://slidesjs.com" target="_blank">http://slidesjs.com</a>.</p>

			<p>Slider design by Orman Clark at <a href="http://www.premiumpixels.com/" target="_blank">Premium Pixels</a>. You can donwload the source PSD at <a href="http://www.premiumpixels.com/clean-simple-image-slider-psd/" target="_blank">Premium Pixels</a></p>

			<p>&copy; 2010 <a href="http://nathansearles.com" target="_blank">Nathan Searles</a>. All rights reserved. Slides is licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache license</a>.</p>

		</div>

	</div>

</body>

</html>

