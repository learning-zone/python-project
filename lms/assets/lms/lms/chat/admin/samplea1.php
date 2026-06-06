<?php
session_start();
echo $_SESSION['username'] = $_SESSION['user']; // Must be already set

include("../db.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/loose.dtd" >

<html>
<head>
<title>Sample Chat Application</title>
<style>
body {
	background-color: #eeeeee;
	padding:0;
	margin:0 auto;
	font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
	font-size:11px;
}
</style>

<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />

<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->

</head>
<body>
<div id="main_container">
<?php
		$query = "SELECT username FROM users WHERE Activated='On' and username!='$user'  ORDER BY username";
		$rs = execute($query) or die("QUERY $query " . error_description());
     	while($trow=fetcharray($rs))
	   	{
			?>
			<a href="javascript:void(0)" onClick="javascript:chatWith('<?=$trow[username]?>')">Chat With <?=$trow[username]?></a><br>
			
			<!-- YOUR BODY HERE -->
			<?php
		}
?>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>

</body>
</html>