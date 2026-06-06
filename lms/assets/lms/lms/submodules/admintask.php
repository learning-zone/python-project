<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
 session_start();
include("../db.php");
  $det1 = execute("  select linkpath, linkname from usermenu where module='$mainmodule' and submodule='$submoduledet' and access='YES' and  username='$user' order by id ");
  ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" /></head>

<body>
 <div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
      <?php
  while($row3=fetcharray($det1))
			{
				echo " <li title='Click here to  $row3[linkname]' class='TabbedPanelsTab' tabindex='0'><strong><a href='../homefile.php'><font color='#FFFFFF'>$row3[linkname]</font></a></strong></li>";
			}?>
     
  </ul>
  <div class="TabbedPanelsContentGroup">
   
     <?php
	  $det2 = execute(" select linkpath, linkname from usermenu where module='$mainmodule' and submodule='$submoduledet' and access='YES' and  username='$user' order by id ");
  while($row2=fetcharray($det2))
			{
				
				echo "<div class='TabbedPanelsContent'>";
				$tempval=$row2[linkpath];
				echo "<iframe name='$row2[linkname]' src='$tempval' marginheight='100%' height='500' width='100%' marginwidth='100%' scrolling='auto' noresize></iframe>";
echo "</div>";
			}?>
  </div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
