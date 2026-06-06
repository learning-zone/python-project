<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if($_GET)
{
	
	$flag=$_REQUEST['flag'];
	$token=$_REQUEST['token'];
	$fname=$_REQUEST['fname'];
}

if($_POST)
{
	$module=$_POST['module'];
	$submodule=$_POST['submodule'];

}

?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	body
	{
		font-family: Arial;
		font-size: 12px;
	}
	.container
	{
		float: left;
		width: 100%;
		border: 1px solid #000000;
	}
	.navcontainer ul
	{
		background-color: #5F707A;
		border-bottom:1px solid #DFDFDF;
		border-top:1px solid #DFDFDF;
		float:left;
		font-family:arial,helvetica,sans-serif;
		font-size:12px;
		margin:0pt;
		padding:0pt;
		width:100%;
	}
	.navcontainer ul li
	{
		display: inline;
		text-align: center;
		
	}
	.navcontainer ul li a:hover
	{
		background-color:#CCCCCC;
		color:#FFFFFF;
	
	}
	.navcontainer ul li a
	{
		border-right:1px solid #DFDFDF;
		background-color: #BBBBBB; 
		font-weight: bold;
		color:#FFFFFF;
		float:left;
		padding:10px;
		text-decoration:none;
		width: 90px;
		
	}
	.navcontainer ul li a.current
	{
		border-right:1px solid #33758E;
		background-color: #33758E;
		font-weight: bold;
		color:#fff;
		float:left;
		padding:10px;
		text-decoration:none;
		width: 90px;
		
	}
	#tabcontent
	{
		min-height: 400px;
		padding-top: 80px;
		padding-left: 10px;
		
	}
	#preloader
	{
		position: absolute;
		top: 150px;
		left: 100px;
		z-index: 100;
		padding: 5px;
		text-align: center;
		background-color: #FFFFFF;
		border: 1px solid #000000;
		
	}
</style>
<script language='javascript'>
	function reloadMe()
	{
		document.frm.action="flexi_setup.php"; 
		document.frm.submit();
	}
</script>
<script language="javascript">
	function OpenWind2(URL, title,w,h)
	{
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
	var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=no, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
	}
</script>
<script type="text/javascript" src="jquery-1.2.3.pack.js"></script>
<script type="text/javascript">			
	
	function loadTabContent(tabUrl){
		$("#preloader").show();
		jQuery.ajax({
			url: tabUrl, 
			cache: false,
			success: function(message) {
				jQuery("#tabcontent").empty().append(message);
				$("#preloader").hide();
			}
		});
	}
	
	jQuery(document).ready(function(){				
		
		$("#preloader").hide();				
		jQuery("[id^=tab]").click(function(){	
			
			// get tab id and tab url
			tabId = $(this).attr("id");										
			tabUrl = jQuery("#"+tabId).attr("href");
			
			jQuery("[id^=tab]").removeClass("current");
			jQuery("#"+tabId).addClass("current");
			
			// load tab content
			loadTabContent(tabUrl);
			return false;
		});
	});
	
</script>
<title>FLEXI TAB</title>
</head>
<body>
<form name="frm" action="" method="post"><br>
<table class=forumline  align=center width="90%" >
  <tr height="30">
		<td class="head" align="center" colspan="6">Flexi Tab Setup</td>
	</tr>
     <tr>
      	<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;Modules</td>
      	<td><select name='module' onChange="reloadMe()">
        <option value="">--- Select ---</option>
			<?php
       $sqlM=execute("SELECT DISTINCT(c.Display_name),a.id
	FROM usermenu a, modules b, links c
		WHERE a.username='administrator' AND a.module='Main' AND a.submodule='Main' 
			AND a.access='Yes' AND a.linkname=b.module AND a.linkname=c.linkname ORDER BY b.id");
                while($rm=fetcharray($sqlM))
                {
			
                    if($module==$rm['id'])
                        echo "<option value='$rm[id]' selected>$rm[Display_name]</option>";
                    else
                        echo "<option value='$rm[id]'>$rm[Display_name]</option>";
                }
            ?>
			</select>
	    </td>     
        <?
		    $modules=fetcharray(execute("SELECT `linkname` FROM `links` WHERE `id`='$module'"));
		
		?>
        <td align="left" >Sub Module</td>
        <td ><select name='submodule' onChange="reloadMe()">
        <option value="">--- Select ---</option>
	     <?php
			
          $sqlSM=execute("SELECT id, Display_name FROM links WHERE module='$modules[0]' ORDER BY `Display_name`");
                while($rsm=fetcharray($sqlSM))
                {
			
                    if($submodule==$rsm['id'])
                        echo "<option value='$rsm[id]' selected>$rsm[Display_name]</option>";
                    else
                        echo "<option value='$rsm[id]'>$rsm[Display_name]</option>";
                }
            ?>
			</select>
        </td>
       </tr>
   </table><BR><BR>
   
<?
	if($module == 207 and $submodule == 317)
	{
?>
<table class=forumline  align=center width="90%" >
<tr><td>
		<div class="container">
		
			<div class="navcontainer">
				<ul>
    <?
   		      $sqlT="SELECT `tab_name`, `description` FROM `student_m_tab` WHERE status='1' ORDER BY `id`";
			  $resultT=execute($sqlT) or die(mysql_error());
                $i=2;
			    while($rt=fetcharray($resultT))
                {
					
					?>
              <li><a id="tab<?=$i?>" title="<?=$rt['description']?>" href="tabs.php?token=<?=$i?>"><?=$rt['tab_name']?></a></li>
                    <?
           			     ++$i;
                }
   			
   ?>
   		<li><a href="javascript:void(0);" onClick ="OpenWind2('add_tab.php', 'OpenWind2',400,300)" title="Click to add new tab">
        <img src="../images/add.png" align="top" height="15" width="15"></a></li>
	</ul>
</div>
            	
<!--<div id="preloader"><img src="loading.gif" align="absmiddle">Loading...</div>-->
<div id="tabcontent">
			Please select any Tab
		</div>
	</div>
</td>
</tr>
</table>
<?
}
?>
</form>
</body>
</html>
