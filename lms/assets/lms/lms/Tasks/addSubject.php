<?php
session_start();
require_once("../db.php");


//echo "<pre>";
//print_r($_GET);
//print_r($_POST);
//echo "</pre>";

$msg=$_REQUEST['msg'];
if($_GET)
{
	$title=$_REQUEST['title'];
	$subtitle=$_REQUEST['subtitle'];
	
}
if($_POST)
{	
	$title=$_POST['title'];
	$subtitle=$_POST['subtitle'];	 
}

if($msg)
{
?>
    <script language="javascript">
		alert("<?=$msg?>");
    </script>
<?php
}
?>
<!DOCTYPE html>
<html>
<head>
<script language="javascript">
    function reloadMe()
	{
		//alert("Hello");
		document.frm.action="addSubject.php";
		document.frm.submit();
		
	}
	function adds_onclick()
	{
		document.frm.action="addSubject_exec.php?Type=Add";
		document.frm.submit();
		
	}
	function adds_onclickC()
	{
		document.frm.action="addSubject_exec.php?Type=AddChild";
		document.frm.submit();
		
	}
	function Modify_onclick()
	{
		
		document.frm.action="addSubject_exec.php?Type=Mod";
		document.frm.submit();
		
	}
    function Delete_onclick()
	{
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="addSubject_exec.php?Type=Del";
			document.frm.submit();
		}
	}
</script>
<script language="javascript">
    function Delete_onclickM()
	{
		
		var answer = confirm("Are you sure to delete record ???")
		if (answer)
		{
			document.frm.action="addSubject_exec.php?Type=DelM";
			document.frm.submit();
		}
	}
</script>
<script language="javascript">
function OpenWinds(URL, title,w,h)
{
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
var newWin = window.open (URL, title, '_blank, toolbar=no, location=no,directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<!-- LIGHTBOX CODE PROPERTY -->
<link rel="stylesheet" href="../Code/LightBox/lightbox.css" />
<script src="../Code/LightBox/jquery/1.10.2/jquery.min.js"></script>
<script src="../Code/LightBox/jquery/jquery.lightbox.js"></script>
<script>
    $(document).ready(function(){
        //Assign the lightbox event to elements
        $(".iframe").lightbox({iframe:true, width:"70%", height:"80%"});                                
        //Preserving a JavaScript event for inline calls.
        $("#click").click(function(){ 
            $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
            return false;
        });
    });
</script>
<title>ADD CATEGORY</title>
</head>
<body>
<FORM id="frm" NAME="frm" ACTION="" METHOD="post">
	<table align='center' class="forumline" width='90%' >
			<tr height="25">
				<td align='center' Class='head' colspan="3">SUBJECT CATEGORY</td>
			</tr>
			<tr height="25">
				<td colspan="2" nowrap align="right">Subject Title&nbsp;&nbsp;</td>
				<td width="65%"><INPUT TYPE="text"  NAME="ntitle" size="50"></td>
			</tr>
 </table>
        <p align="center">
        <input type="submit"  value="Add" onClick="adds_onclick()" class='bgbutton' style="width:60px; height:22px"></p>
            
         	<table align='center' class=forumline width='90%' >
			<tr height="25">
				<td align='center' Class='head' colspan=5>SUBJECT SUBCATEGORY</td>
			</tr>
		
            <tr height="25">
				<td colspan="2" nowrap align="right">Subject Title&nbsp;&nbsp;</td>
				<td><select name='title'>
                <option value="">--- Select ---</option>
					<?php
					$sqlT=execute("SELECT * FROM `lib_book_title` WHERE status=1 ORDER BY `title`");
						while($r=fetcharray($sqlT))
						{
							if($title==$r[title])
								echo "<option value='$r[title]' selected>$r[title]</option>";
							else
								echo "<option value='$r[title]' >$r[title]</option>";
						}
					?>
				</select>
	          </td>
<td align="right">
			<a class='iframe' href="addSubject_edt.php"><img src="../images/edit.png" height="30" width="30" title="Change Subject Title"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
            
			<tr height="25">
				<td colspan="2" nowrap align="right">Subject Subtitle &nbsp;&nbsp;</td>
                <td colspan="4"><INPUT TYPE="text"  NAME="subtitle" size="50" ></td>
			</tr>

	</table>
        <p align="center">
        <input type="submit"  value="Add" onClick="adds_onclickC()" class='bgbutton' style="width:60px; height:22px"></p>
	
<?php
		
	   $result=execute("SELECT a.*,b.* FROM lib_book_title a, lib_book_subtitle b WHERE  a.title = b.lib_book_title AND a.status=1 AND b.status=1");
		
	   if(rowcount($result)>0)
       {
	   ?>
	   
	  <table class='forumline' align='center' width='90%'>
		<tr height='22' >
		    <td width="21%" align='center' Class="head">Select</td>
			<td width="33%" align='left' Class="head">Subject Title</td>
			<td width="46%" align='left' Class="head">&nbsp;&nbsp;Subject Subtitle</td>
	   </tr>
       <?
	   	    $i=0;
            $rowclass=1;
            $sno=1; 
           while($row=fetcharray($result))
           {
		   			if($sno<10)
					{
						$sno="0".$sno;
					}
				
					echo   "<tr>";
					//echo "id ".$row[id];
				
			 ?>
	         
            <td class="CBody" align="center"><Input Type="checkbox" name="Sel[]" value="<?=$row[id]?>" size="10"></td>
			<td class="CBody" align='left'>&nbsp;&nbsp;<?=$row[title]?></td>
            <td class="CBody" align='left'><Input Type="Text" Name="<?=$row[id]?>subtitle" value="<?=$row[subtitle]?>" size="40"></td>
         
	         <?
			   $i++;
		       $sno++;
		       $rowclass = 1 - $rowclass;
            }
 ?>
 </table>
 	<p align="center">
		<Input type="submit" Name="Modify" value="Modify" LANGUAGE=javascript onClick="return Modify_onclick()" class='bgbutton'>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<Input type="submit" Name="Delete" value="Delete" LANGUAGE=javascript onClick="return Delete_onclick()" class='bgbutton'> </p>
   <?
    }
?>
</form>
 </body>
 </html>
