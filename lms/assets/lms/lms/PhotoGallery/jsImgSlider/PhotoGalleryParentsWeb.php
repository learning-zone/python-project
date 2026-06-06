<!DOCTYPE html>
<html>
<head>
    <title>PARENTS WEB</title>
    <link href="themes/1/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="themes/1/js-image-slider.js" type="text/javascript"></script>
    <link href="generic.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div id="sliderFrame">
    	<div id="slider">
        
        	<img src="images/1.JPG" alt="Welcome to MySchool" />
            <img src="images/2.JPG" alt="My Computer Lab" />
            <img src="images/3.jpg" alt="Play,Learn & Grow Together" />
            <img src="images/4.jpg" alt="My Friends" />
            <img src="images/5.jpg" alt="Fly on Sky" />
    	
    <?
		/*include("../../db1.php");
		
		$rs=execute("SELECT HalfImagepath FROM albumpic ORDER BY id LIMIT 5");

		while($r=fetcharray($rs))
		{
						
	 	 ?>
   			 <img src="../<?=$r[HalfImagepath]?>" height="460" align='center'>            
      	 <?
		}*/
	?>
      </div>
    </div>
</body>
</html>
