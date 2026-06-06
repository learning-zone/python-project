<?php
session_start();
include("../db.php");

/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/

if($_GET)
{
	$Type = $_GET['Type'];
	$token = $_GET['token'];
	$event = $_GET['event'];
}
if($_POST)
{
	$id=$_POST['id'];
	$event = $_POST['event'];
}


if($Type== "add")
{
	 
	 $sqlInsert="INSERT INTO `student_m_event`(`event`) VALUES('$event')";
 	 //echo "<br>".$resultInsert;
	 $resultInsert=execute($sqlInsert) or die(mysql_error());
	 if($resultInsert){
		 ?>
         	<script type="text/javascript">
			   window.reload();
			 </script>
         <?
	 }
}
if($Type== "update")
{
	 
	 $sqlUpdate="UPDATE `student_m_event` SET `event`='$event' WHERE `id`='$id'";
 	 //echo "<br>".$sqlUpdate;
	 $resultUpdate=execute($sqlUpdate) or die(mysql_error());
	 if($resultUpdate){
		 ?>
         	<script type="text/javascript">
			   window.reload();
			 </script>
         <?
	 }
	 
}
if($Type== "delete")
{
	 
	 $sqlUpdate="UPDATE `student_m_event` SET `status`='0' WHERE `id`='$id'";
 	 //echo "<br>".$sqlUpdate;
	 $resultUpdate=execute($sqlUpdate) or die(mysql_error());
	 if($resultUpdate){
		 ?>
         	<script type="text/javascript">
			   window.reload();
			 </script>
         <?
	 }
}

$msg=$_REQUEST['msg'];
if($_GET['msg']!='')
{
?>
    <script language="javascript">
		alert("<?=$msg?>");
		window.close();
    </script>
<?
}
?>
<html>
<head>
<Script language="JavaScript">
  function RefreshMe(token)
  {
	  document.frm.action="addEvent.php?token="+token;
	  document.frm.submit();
  }
  function adds_onclick()
  {
	  document.frm.action="addEvent.php?Type=add";
	  document.frm.submit();
  }
  function update_onclick()
  {
	  document.frm.action="addEvent.php?Type=update";
	  document.frm.submit();
  }
  function delete_onclick()
  {
	  document.frm.action="addEvent.php?Type=delete";
	  document.frm.submit();
  }
  function WindowClose()
  {
	  window.close();
  }
</script>
</head>
<title>ADD NEW EVENT</title>
<body>
<form method="post" name="frm">
<!--<div style="overflow-x:hidden;overflow-y:scroll; height:250px">-->
<table align='center' class='forumline' width='90%'>
 <tr>
<?
		$result=execute("SELECT * FROM `student_m_event` WHERE `status`=1 ORDER BY `event`");
		  $i=0;
		  $rowclass=1;
		  
		while($row=fetcharray($result))
        {
				if($i%2)
					echo "<tr class='clsname'>";
				else
					echo "<tr>";
     ?>
       
       <td align='left'>&nbsp;&nbsp;<a herf="addEvent.php?token=<?=$row['id']?>" onClick="RefreshMe('<?=$row['id']?>');" ><?=$row['event']?>
       <input type="hidden" name="token" value="<?=$row['id']?>"/></a></td>
  </form>
        
     <?
	 	$i++;
		 
		       $rowclass = 1 - $rowclass;
		}
?>
</tr>
</table>
<!--</div>-->
<table align='center' class='forumline' width='90%'>
   <tr>
   	<?
	      $event=fetcharray(execute("SELECT `event` FROM `student_m_event` WHERE id='$token' LIMIT 1"));
	?>
       <td><input type="text" name="event" value="<?=$event['event']?>" size="80"></td>
   </tr>
</table>
<?
if($token!='')
{
	?>
	<p align="center"><input type="button"  value="Save"  style="width:86px; height:22px" onClick="update_onclick()" class="bgbutton">
	<? 
}else{ 
	?>
	<p align="center"><input type="button"  value="Save"  style="width:86px; height:22px" onClick="adds_onclick()" class="bgbutton">
	<?
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button"  value="Delete"  style="width:86px; height:22px" onClick="delete_onclick()" class="bgbutton"></p>
<input type="hidden" name="id" value="<?=$token?>"/>
 </form>
 </body>
</html>
