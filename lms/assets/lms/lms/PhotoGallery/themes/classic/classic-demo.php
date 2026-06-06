<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>

            /* Demo styles */
            html,body{background:#222;margin:0;}
            body{border-top:4px solid #000;}
            .content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:620px;margin:20px auto;}
            h1{font-size:12px;font-weight:normal;color:#ddd;margin:0;}
            p{margin:0 0 20px}
            a {color:#22BCB9;text-decoration:none;}
            .cred{margin-top:20px;font-size:11px;}

            /* This rule is read by Galleria to define the gallery height: */
            #galleria{height:400px}

        </style>

        <!-- load jQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

        <!-- load Galleria -->
        <script src="../../galleria-1.2.7.min.js"></script>

    </head>
<body>
    <div class="content">
        <!-- Adding gallery images. We use resized thumbnails here for better performance, but it’s not necessary -->

      <div id="galleria">
       <?php
	   
    include("../../../db.php");

	   $id=$_REQUEST['id'];
	   $temsql3=mysql_query("select * from albumpic where status=1 and AlbumID='$id' order by id desc");
	while($r=mysql_fetch_array($temsql3))
	{
   ?> 
            <a href="../../<?php echo $r[FullImagePath]; ?>">
                <img data-title="<?php echo $r[PicName]; ?>"
                     data-description="<?php echo $r[Description]; ?>"
                     src="../../<?php echo $r[HalfImagepath]; ?>">
            </a>
   <?php
   }
   ?> 
           
        </div>

    </div>

    <script>

    // Load the classic theme
    Galleria.loadTheme('galleria.classic.min.js');

    // Initialize Galleria
    Galleria.run('#galleria');

    </script>
    </body>
</html>