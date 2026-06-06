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
   
    $queue_name=$_GET['queue_name'];
    $process_name=$_GET['process_name'];
    $queue_description=$_GET['queue_description'];
    $process_description=$_GET['process_description'];
   
    
}
if($_POST)
{   
    $queue_name=$_POST['queue_name'];
    $process_name=$_POST['process_name'];
    $queue_description=$_POST['queue_description'];
    $process_description=$_POST['process_description'];   
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
        document.frm.action="tastssetup.php";
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
        $(".iframe").lightbox({iframe:true, width:"60%", height:"60%"});                                
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
                <td align='center' Class='head' colspan="3">PROCESS MASTER</td>
            </tr>
            <tr height="25">
                <td colspan="2" nowrap align="right">Process Name&nbsp;&nbsp;</td>
                <td width="65%"><INPUT TYPE="text"  NAME="nprocess_name" size="50"></td>
            </tr>
            <tr height="25">
                <td colspan="2" nowrap align="right">Description&nbsp;&nbsp;</td>
                <td width="65%"><textarea name="nprocess_description" rows="4" cols="40"></textarea>
            </tr>
 </table>
        <p align="center">
        <input type="submit"  value="Add" onClick="adds_onclick()" class='bgbutton' style="width:60px;"></p>
            
            <table align='center' class=forumline width='90%' >
            <tr height="25">
                <td align='center' Class='head' colspan='5'>QUEUE MASTER</td>
            </tr>
        
            <tr height="25">
                <td colspan="2" nowrap align="right">Process Name&nbsp;&nbsp;</td>
                <td width="65%"><select name='process_name'>
                <option value="">------ Select ------</option>
                    <?php
                    $sqlT=execute("SELECT * FROM `tasks_process` WHERE status=1 ORDER BY `process_name`");
                        while($r=fetcharray($sqlT))
                        {
                            if($process_name==$r[process_name])
                                echo "<option value='$r[process_name]' selected>$r[process_name]</option>";
                            else
                                echo "<option value='$r[process_name]' >$r[process_name]</option>";
                        }
                    ?>
                </select>
              <a class='iframe' href="addSubject_edt.php" style="color:#FFF;">&nbsp;&nbsp;<img src="../images/edit.png" height="20" title="Change Subject Title" align="absmiddle"></a></td></tr>


            <tr height="25">
                <td colspan="2" nowrap align="right">Queue Name &nbsp;&nbsp;</td>
                <td colspan="4" ><INPUT TYPE="text"  NAME="queue_name" size="50" ></td>
            </tr>
            
             <tr height="25">
                <td colspan="2" nowrap align="right">Queue Description&nbsp;&nbsp;</td>
                <td width="65%"><textarea name="queue_description" rows="4" cols="40"></textarea>
            </tr>

    </table>
        <p align="center">
        <input type="submit"  value="Add" onClick="adds_onclickC()" class='bgbutton' style="width:60px;"></p>
    
<?php
        
       $result=execute("SELECT a.*,b.* FROM tasks_process a, tasks_queue b WHERE  a.id = b.tasks_process_id AND a.status=1 AND b.status=1");
        
       if(rowcount($result)>0)
       {
       ?>
       
      <table class='forumline' align='center' width='90%'>
        <tr height='22' >
            <td width="21%" align='center' Class="head">Select</td>
            <td width="33%" align='left' Class="head">Process Name</td>
            <td width="46%" align='left' Class="head">&nbsp;&nbsp;Queue Name</td>
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
            <td class="CBody" align='left'>&nbsp;&nbsp;<?=$row[process_name]?></td>
            <td class="CBody" align='left'><Input Type="Text" Name="<?=$row[id]?>queue_name" value="<?=$row[queue_name]?>" size="40"></td>
         
             <?php
               $i++;
               $sno++;
              
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
