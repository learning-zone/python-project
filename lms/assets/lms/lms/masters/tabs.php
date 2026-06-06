<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

$user_name = $_SESSION['user'];
if($_GET)
{
	$p = $_REQUEST['token'];
	
}
if($_POST)
{
	$id=$_POST['id'];
	$Type=$_POST['Type'];
	$firstname=$_POST['firstname'];
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
body
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}
.editbox
{
  	display:none;
}
td
{
	padding:5px;
}
.editbox
{
	font-size:14px;
	width:200px;
	background-color:#ffffcc;
	border:solid 1px #000;
	padding:4px;
}
.edit_td:hover
{
	/*background-color:#6600CC;*/
	background:url(edit.png) right no-repeat #80C8E5; 
	cursor:pointer;
}
</style>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".edit_td").click(function()
{
  var ID=$(this).attr('id');
  $("#first_"+ID).hide();
  $("#first_input_"+ID).show();
  }).change(function()
{
  var ID=$(this).attr('id');
  var first=$("#first_input_"+ID).val();
  var dataString = 'id='+ ID +'&firstname='+first;
  $("#first_"+ID).html('<img src="load.gif" />'); // Loading image

if(ID.length>0)
{

  $.ajax({
  type: "POST",
  url: "table_edit_ajax.php",
  data: dataString,
  cache: false,
  success: function(html)
{
$("#first_"+ID).html(first);
}
});
}
else
{
  alert('Enter something.');
}

});

// Edit input box click action
$(".editbox").mouseup(function() 
{
return false
});

// Outside click action
$(document).mouseup(function()
{
  $(".editbox").hide();
  $(".text").show();
});

});
</script>
<script type="text/javascript">  
$(document).ready(function() {    
  
    $("#edit_status").click(function(){    
        $.ajax({
            url: 'edit_status.php', //This is the current doc
            type: "POST",
            data: "#edit_status",
            success: function(data){
                // Why were you reloading the page? This is probably your bug
                // location.reload();

                // Replace the content of the clicked paragraph
                // with the result from the ajax call
				alert(data);
                $("#edit_status").html(data);
            }
        });        
    });
});

</script>
<script type="text/javascript">
function add_onClick()
{
	
	document.frm.action="tabs.php?Type=add_field";
	document.frm.submit();
	
}
</script>
</head>
<body>
<form action="tabs.php" method="post" name="frm">
<table class="forumline"  align="center" width="90%" >
<tr>
<?
	if($p==1)
	{
     	 
   $sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `status` FROM `student_m_field` WHERE  `tab_id`=1 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
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
                    <td class="edit_td" id="<?=$rf['id']?>" title="<?=$title?>">
                    <?
						if($rf['mandatory']=='1'){
						 ?>
                            <?=$firstname?><?=$f?></td>
                         <?
						}
						else{
							?>
						<span id="first_<?=$rf['id']?>" class="text"><?=$firstname?><?=$f?></span>
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
					}
           			     ++$i;
                }
			?>
            <tr><td>
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=1', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
            <?
   			   
	}
	elseif($p==2)
	{
	   	
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory`, `status` FROM `student_m_field` WHERE `tab_id`=2 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
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
                    <td class="edit_td" id="<?=$rf['id']?>" title="<?=$title?>">
                    <?
						if($rf['mandatory']=='1'){
						 ?>
                            <?=$firstname?><?=$f?></td>
                         <?
						}
						else{
							?>
						<span id="first_<?=$rf['id']?>" class="text"><?=$firstname?><?=$f?></span>
  					    <input type="text" value="<?=$firstname?>" class="editbox" id="first_input_<?=$rf['id']?>"/>
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
					}
           			     ++$i;
                }
			?>
            <tr><td>
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=2', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
	elseif($p==3)
	{
			 
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=3 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
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
                    <td class="edit_td" id="<?=$rf['id']?>" title="<?=$title?>">
                    <?
						if($rf['mandatory']=='1'){
						 ?>
                            <?=$firstname?><?=$f?></td>
                         <?
						}
						else{
							?>
						<span id="first_<?=$rf['id']?>" class="text"><?=$firstname?><?=$f?></span>
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
					}
           			     ++$i;
                }
			?>
            <tr><td>
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=3', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
	elseif($p==4)
	{
			 
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=4 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
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
                    <td class="edit_td" id="<?=$rf['id']?>" title="<?=$title?>">
  					<span id="first_<?=$rf['id']?>" class="text"><?=$firstname?><?=$f?></span>
  					<input type="text" value="<?=$firstname?>" class="editbox" id="first_input_<?=$rf['id']?>"/></td>
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
					}
           			     ++$i;
                }
		?>
            <tr><td>
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=4', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
	elseif($p==5)
	{
			
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=5 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
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
                    <td class="edit_td" id="<?=$rf['id']?>" title="<?=$title?>">
  					<span id="first_<?=$rf['id']?>" class="text"><?=$firstname?><?=$f?></span>
  					<input type="text" value="<?=$firstname?>" class="editbox" id="first_input_<?=$rf['id']?>"/></td>
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
					}
           			     ++$i;
                }
		?>
            <tr><td>
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=5', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
	elseif($p==6)
	{
			  
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=6 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$firstname="<font color=#FF0000>".$rf['display_name']."</font>";
					}else{
						$firstname=$rf['display_name'];
					}
					?>
                    <td class="edit_td" id="<?=$rf['id']?>">
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
					}
           			     ++$i;
                }
		?>
            <tr><td>
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=6', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	}
	elseif($p==7)
	{
			  
	$sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=7 ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$firstname="<font color=#FF0000>".$rf['display_name']."</font>";
					}else{
						$firstname=$rf['display_name'];
					}
					?>
                    <td class="edit_td" id="<?=$rf['id']?>">
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
					}
           			     ++$i;
                }
		?>
            <tr><td>
       <a href="javascript:void(0);" onClick ="OpenWind2('add_field.php?tab_id=7', 'OpenWind2',400,200)" title="Click to add new field">
       		<img src="../images/add.png" align="top" height="15" width="15"></a></td></tr>
        <?
	
	}
	
	else
	{
			  
   $sqlF="SELECT `id`, `display_name`, `field_type`, `mandatory` FROM `student_m_field` WHERE  `tab_id`=$p ORDER BY `order`";
			  $resultF=execute($sqlF) or die(mysql_error());
                $i=1;
			    while($rf=fetcharray($resultF))
                {
					if($rf['mandatory']=='1'){
						$firstname="<font color=#FF0000>".$rf['display_name']."</font>";
					}else{
						$firstname=$rf['display_name'];
					}
					?>
                    <td class="edit_td" id="<?=$rf['id']?>">
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
					}
           			     ++$i;
                }
		?>
       <tr><td>
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