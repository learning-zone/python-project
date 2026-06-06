<?php
  session_start();
require("../db.php");
$phid = $_REQUEST['phid'];
$phpath = $_REQUEST['phpath'];
?>

<html>
<head>
<meta charset="utf-8" />
<title>Photo Capture</title>
<link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
<link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox-1.3.4.css" />
</head>
<body>
<form name="frm" method="post">
<input type="hidden" name="phid" id='phid' value="<?=$phid?>">
<input type="hidden" name="phpath" id='phpath' value="<?=$phpath?>">
    <div id="screen"></div>
    <div id="buttons">
    	<div class="buttonPane">
        	<a id="shootButton" href="" class="blueButton">Shoot!</a>
			<a id="cancelButton" href="" class="blueButton">Cancel</a> <a id="uploadButton" href="" class="greenButton">Upload!</a>
        </div>
    </div>
<script src="assets/fancybox/jquery.min.js"></script>
<script src="assets/fancybox/jquery.easing-1.3.pack.js"></script>
<script src="assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script src="assets/webcam/webcam.js"></script>
<script src="assets/js/script.js"></script>
</form>
</body>
</html>