<?php
session_start();
require_once ("../db.php");

if($_GET)
{
	$last_msg_id=$_GET['last_msg_id'];
	$action=$_GET['action'];
}

if($action <> "get")
{
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Load Data while scrolling</title>
  <script type="text/javascript" src="../code/jquery/1.10.2/jquery.min.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
			
		function last_msg_funtion() 
		{ 
		   
           var ID=$(".message_box:last").attr("id");
			$('div#last_msg_loader').html('<img src="loader.gif">');
			$.post("load_data.php?action=get&last_msg_id="+ID,
			
			function(data){
				if (data != "") {
				$(".message_box:last").after(data);			
				}
				$('div#last_msg_loader').empty();
			});
		};  
		
		$(window).scroll(function(){
			if  ($(window).scrollTop() == $(document).height() - $(window).height()){
			   last_msg_funtion();
			}
		}); 
		
	});
	</script>

</head>
<body>
<div align="center">
<?php

include('load_first.php');

?>
<div id="last_msg_loader"></div>
</div>
</body>
</html>

<?php
}
else
{
 
	include('load_second.php');		
	
}
?>	