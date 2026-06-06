<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/
$user_name = $_SESSION['user'];
if ($_REQUEST['tab']!='')
{
		$tabID = $_REQUEST['tab'];
}else{
		$tabID = 2;
	}

if($_GET)
{

	$flag=$_REQUEST['flag'];
	$token=$_REQUEST['token'];
	$fname=$_REQUEST['fname'];
}
if($_POST)
{
	
	$id=$_POST['id'];
	$Type=$_POST['Type'];
	$module=$_POST['module'];
	$firstname=$_POST['firstname'];
	$submodule=$_POST['submodule'];

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
	  margin: 10px 15px;		
  }
  td
  {
	  padding:3px;
  }
-->
</style>
<script language='javascript'>
  function ReloadMe(token)
  {		
	  document.frm.action="flexi_setup.php?tab="+token;
	  document.frm.submit();
  }
</script>
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
<table class="forumline"  align="center" width="90%" >
<tr><td>
<div id='menu'>
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
   		<li>
<a href="javascript:void(0);" onClick ="OpenWind2('add_tab.php', 'OpenWind2',400,300)" title="Click to add new tab">NEW</a></li>
	</ul>
</div>
</div>
</div>
</td>
</tr>
<tr>
	<td><BR><BR></td>
</tr>
</table>
<!----------------------------------------------------------------------------------------------------------------------->
<table class="forumline"  align="center" width="90%" >
<tr>
<?
	if($tabID==1)
	{
     	 
   $sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `status` FROM `student_m_field` WHERE  `tab_id`=1 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
			  $rowcount=rowcount($resultF);
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
						$firstname=$rf['display_name'];
					?>                   
                    <td title="<?=$title?>">
                    <?
						if($rf['mandatory']=='1'){
						 ?>
                            <?=$firstname?><?=$f?></td>
                         <?
						}
						else{
							?>
						
  					    <input type="text" value="<?=$firstname?>" class="editbox" id="first_input_<?=$rf['id']?>"/>
                    <?
					}
					?>
                    <? if($rf['field_type']=='SELECT'){
						?>
                    <td><select name="" disabled style="width:173px;" >
                        <option value="0">&nbsp;&nbsp;</option>
                        </select></td>
                       <?
					}else{  ?>
                    <td><input type="text" name="" value="" size="30" disabled="disabled" /></td>
                    <? } ?>
                                       
                <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}elseif($i==$rowcount){
						?>
                        <td></td><td></td>
                        <?
					}
           			     ++$i;
                }
			?>
            <tr><td colspan="4">
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=1', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
            <?
   			   
	}
	elseif($tabID==2)
	{
	   	
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `status` FROM `student_m_field` WHERE `tab_id`=2 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
			  $rowcount=rowcount($resultF);
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
						$firstname=$rf['display_name'];
					?>                   
                    <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;
                    <?
						if($rf['mandatory']=='1'){
						 ?>
                            <?=$firstname?><?=$f?></td>
                         <?
						}
						else{
							?>
						
  					    <input type="text" value="<?=$firstname?>" size="30"/>
                    <?
					}
					
					?>
                    <? if($rf['field_type']=='SELECT'){
						?>
                    <td><select name="" disabled style="width:173px;" >
                        <option value="0">&nbsp;&nbsp;</option>
                        </select>
                        <?
						if($rf['mandatory']=='0'){
							
						 ?>
                            <select name='status' id="edit_status_<?=$rf['id']?>">
                         <?
						 	 $status=$rf['status'];
						     $first="";$second="";
							 if($status=='1')
								 $first="selected";$second="";
							 if($status=='0')
								 $second="selected";$first="";
				
				         ?>
                            <option value="1" <?=$first?> selected>SHOW</option>
                            <option value="0" <?=$second?>>HIDE</option>
						   </select>
                         <?
						}
						
						
						?>
                       <?
					}else{  ?>
                    <td><input type="text" name="" value="" size="30" disabled="disabled" />
                      <?
						if($rf['mandatory']=='0'){
						 ?>
                          <select name='status' id="edit_status_<?=$rf['id']?>">
                         <?
						 	 $status=$rf['status'];
						     $first="";$second="";
							 if($status=='1')
								 $one="selected";$two="";
							 if($status=='0')
								 $two="selected";$one="";
				
				         ?>
                            <option value="1" <?=$one?> selected>SHOW</option>
                            <option value="0" <?=$two?>>HIDE</option>
						   </select></td>
                         <?
						}
						?></td>
                    <? } ?>
                                       
                <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}elseif($i==$rowcount){
						?>
                        <td></td><td></td>
                        <?
					}
					 ++$i;
                }
			?>
            <tr><td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=2', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
	elseif($tabID==3)
	{
			 
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=3 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
			  $rowcount=rowcount($resultF);
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
						$firstname=$rf['display_name'];
					?>                   
                    <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;
                    <?
						if($rf['mandatory']=='1'){
						 ?>
                            <?=$firstname?><?=$f?></td>
                         <?
						}
						else{
							?>
  					    <input type="text" value="<?=$firstname?>" size="30"/>
                    <?
					}
					?>
                    <? if($rf['field_type']=='SELECT'){
						?>
                    <td><select name="" disabled style="width:173px;" >
                        <option value="0">&nbsp;&nbsp;</option>
                        </select></td>
                       <?
					}else{  ?>
                    <td><input type="text" name="" value="" size="30" disabled="disabled" /></td>
                    <? } ?>
                                       
                <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}elseif($i==$rowcount){
						?>
                        <td></td><td></td>
                        <?
					}
           			     ++$i;
                }
			?>
            <tr><td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=3', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
	elseif($tabID==4)
	{
			 
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=4 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
			  $rowcount=rowcount($resultF);
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
						$firstname=$rf['display_name'];
					?>                   
                    <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;
  					<input type="text" value="<?=$firstname?>" class="editbox" id="first_input_<?=$rf['id']?>" size="30"/></td>
                    <? if($rf['field_type']=='TEXTAREA'){
						?>
                    <td><textarea name="" style="width:173px; height:20px;" disabled></textarea></td>
                       <?
					}else{  ?>
                    <td><input type="text" name="" value="" size="30" disabled="disabled" /></td>
                    <? } ?>
                    <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}elseif($i==$rowcount){
						?>
                        <td></td><td></td>
                        <?
					}
           			     ++$i;
                }
		?>
            <tr><td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=4', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
	elseif($tabID==5)
	{
			
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=5 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
			  $rowcount=rowcount($resultF);
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$title="Mandatory Field";
						$f="<font color=#FF0000>*</font>";
					}else{
						$title='';
						$f='';
					}
						$firstname=$rf['display_name'];
					?>                   
                    <td title="<?=$title?>">&nbsp;&nbsp;&nbsp;&nbsp;  					
  					<input type="text" value="<?=$firstname?>" size="30" /></td>
                 	<? if($rf['field_type']=='TEXTAREA'){
						?>
                    <td><textarea name="" style="width:173px; height:20px;" disabled></textarea></td>
                       <?
					}else{  ?>
                    <td><input type="text" name="" value="" size="30" disabled="disabled" /></td>
                    <? } ?>
                    <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}elseif($i==$rowcount){
						?>
                        <td></td><td></td>
                        <?
					}
           			     ++$i;
                }
		?>
            <tr><td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=5', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
	elseif($tabID==6)
	{
			  
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=6 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
			  $rowcount=rowcount($resultF);
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$firstname="<font color=#FF0000>".$rf['display_name']."</font>";
					}else{
						$firstname=$rf['display_name'];
					}
					?>
                    <td>
  					<span id="first_<?=$rf['id']?>" class="text"><?=$firstname?></span>
  					<input type="text" value="<?=$firstname?>" class="editbox" id="first_input_<?=$rf['id']?>"/></td>
                    <? if($rf['field_type']=='SELECT'){
						?>
                    <td><select name="" disabled style="width:173px;" >
                    <option value="0">&nbsp;&nbsp;</option>
                    </select></td>
                       <?
					}else{  ?>
                    <td><input type="text" name="" value="" size="30" disabled="disabled" /></td>
                    <? } ?>
                    <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}elseif($i==$rowcount){
						?>
                        <td></td><td></td>
                        <?
					}
           			     ++$i;
                }
		?>
            <tr><td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=6', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
	elseif($tabID==7)
	{
			  
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=7 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
			  $rowcount=rowcount($resultF);
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$firstname="<font color=#FF0000>".$rf['display_name']."</font>";
					}else{
						$firstname=$rf['display_name'];
					}
					?>
                    <td>
  					<span id="first_<?=$rf['id']?>" class="text"><?=$firstname?></span>
  					<input type="text" value="<?=$firstname?>" class="editbox" id="first_input_<?=$rf['id']?>"/></td>
                    <? if($rf['field_type']=='SELECT'){
						?>
                    <td><select name="" disabled style="width:173px;" >
                    <option value="0">&nbsp;&nbsp;</option>
                    </select></td>
                       <?
					}else{  ?>
                    <td><input type="text" name="" value="" size="30" disabled="disabled" /></td>
                    <? } ?>
                    <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}elseif($i==$rowcount){
						?>
                        <td></td><td></td>
                        <?
					}
           			     ++$i;
                }
		?>
            <tr><td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=7', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	
	}
	
	else
	{
			  
   $sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=$tabID ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
			  $rowcount=rowcount($resultF);
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$firstname="<font color=#FF0000>".$rf['display_name']."</font>";
					}else{

						$firstname=$rf['display_name'];
					}
					?>
                    <td>
  					<span id="first_<?=$rf['id']?>" class="text"><?=$firstname?></span>
  					<input type="text" value="<?=$firstname?>" class="editbox" id="first_input_<?=$rf['id']?>"/></td>
                    <? if($rf['field_type']=='SELECT'){
						?>
                    <td><select name="" disabled style="width:173px;" >
                    <option value="0">&nbsp;&nbsp;</option>
                    </select></td>
                       <?
					}else{  ?>
                    <td><input type="text" name="" value="" size="30" disabled="disabled" /></td>
                    <? } ?>
                    <?
					if($i%2==0){
						?>
                           </tr>
                        <?
					}elseif($i==$rowcount){
						?>
                        <td></td><td></td>
                        <?
					}
           			     ++$i;
                }
		?>
       <tr><td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=<?=$p?>', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
?>
</tr>
</table>
</form>
</body>
</html>
<?
}
?>
</form>
</body>
</html>
