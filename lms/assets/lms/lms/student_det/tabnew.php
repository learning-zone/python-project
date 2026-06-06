<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if ($_REQUEST['tab']!='')
{
		$tabID = $_REQUEST['tab'];
} else {
		$tabID = 2;
	}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/tab.css" />
<style type="text/css">
<!--
  body
  {
	  font: 14px "Helvetica Neue", Helvetica, Arial, sans-serif;	
	  margin: 20px 25px;		
  }
  td
  {
	  padding:5px;
  }
-->
</style>
<script language='javascript'>
  function ReloadMe(token)
  {		
	  document.frm.action="tabnew.php?tab="+token;
	  document.frm.submit();
	  //alert('hi');
  }
</script>
<title>STUDENT DETAILS</title>
</head>
<body>
<form name="frm" action="" method="post" >
<table class="forumline" align="center" width="98%">
<tr><td>
<div class="webwidget_scroller_tab" id="webwidget_scroller_tab">
<div class="tabContainer">
   <ul class="tabHead">
    <?
	  
   		      $sqlT="SELECT `id`, `tab_name`, `description` FROM `student_m_tab` WHERE status='1' ORDER BY `id`";
			  $resultT=execute($sqlT) or die();
                $i=2;
			    while($rt=fetcharray($resultT))
                {
					
					   if($rt['id']==$tabID){
						?>
                  <li class="currentBtn"><a title="<?=$rt['description']?>" onClick="ReloadMe('<?=$i?>')"><?=$rt['tab_name']?></a></li>
				  		<?
					   }
					   else{
						   ?>
                   <li><a title="<?=$rt['description']?>" onClick="ReloadMe('<?=$i?>')"><?=$rt['tab_name']?></a></li>
				   		   <?
						}
				?>
                   					
                <?
           			     ++$i;
                }
 			
      ?>        

  </ul>
</div></div>	
</td>
            <td align="right"><img height='150' width='170'  src=<?=$details[img_source]?> /></td>
     </tr>
    </table>
<table class='forumline'  align='center' width="98%">
 <tr>
<?
if($tabID==2)
{
	?>
         <TD align="center">TAB FIRST SELECTED !!!</TD>
    <?
}
if($tabID==3)
{
	?>
         <TD align="center">TAB SECOND SELECTED !!!</TD>
    <?
}
if($tabID==4)
{
	?>
         <TD align="center">TAB THIRD SELECTED !!!</TD>
    <?
}
if($tabID==5)
{
	?>
         <TD align="center">TAB FOURTH SELECTED !!!</TD>
    <?
}
if($tabID==6)
{
	?>
         <TD align="center">TAB FIFTH SELECTED !!!</TD>
    <?
}
if($tabID==7)
{
	?>
         <TD align="center">TAB SIXTH SELECTED !!!</TD>
    <?
}
?>
 </tr>
</table>
</form>	
</body>
</html>