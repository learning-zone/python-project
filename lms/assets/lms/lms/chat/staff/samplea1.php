<?php
session_start();
include("../../db.php");
$user=$_SESSION['user'];
if($id=='a1')
{
	echo $_SESSION['username'] =$user;	
}
else
{
	$staffid=fetchrow(execute("select S_ID from users where username='$user'"));
	$id=$staffid[0];
	$staffname=execute("select f_name, s_name from staff_det where slno='$id'");
	while($r=fetcharray($staffname))
	{
		
		$varname=$r[0].$r[1].$staffid[0];
		$varname=str_replace(' ','',$varname);
		$varname=str_replace("'",'',$varname);
		echo $varname=str_replace('.','',$varname);
		$_SESSION['username'] =$varname;
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/loose.dtd" >

<html>
<head>
<title>MySchool Chat Application</title>
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

		$query = "SELECT username, S_ID FROM users WHERE Activated='On' and username!='$user'  ORDER BY username";
		$rs = execute($query) or die("QUERY $query " . error_description());
     	while($trow=fetcharray($rs))
	   	{
			if($trow[1]!='a1')
			{
				$id=$trow[1];
				$staffname=execute("select f_name, s_name from staff_det where slno='$id'");
				while($r=fetcharray($staffname))
				{
					$car=$r[0].$r[1].$trow[1];
				}
				$trow1=trim($car, ' ');
			}
			else
			{
				$trow1=$trow[0];
			}
			$trow1=str_replace(' ','',$trow1);
			$trow1=str_replace('.','',$trow1);
			$trow1=str_replace("'",'',$trow1);
			?>
			<a href="javascript:void(0)" onClick="javascript:chatWith('<?=$trow1?>')">Chat With <?=$trow1?></a><br>
			<!-- YOUR BODY HERE -->
			<?php
		}
?>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>

</body>
</html>