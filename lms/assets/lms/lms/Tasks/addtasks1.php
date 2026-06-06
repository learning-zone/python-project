<?php 

session_start();
require_once ("../db.php");

$user = $_SESSION['user'];

//print_r($_POST);

  $id=fetcharray(execute("SELECT `S_ID` FROM `users` WHERE  username='$user'"));
  
  $pseudo_name=fetcharray(execute("SELECT `pseudo_name` FROM `task_pseudo_details` WHERE staff_det_slno='$id[0]'"));
    
  
if ($_GET) {

    $Sel = $_GET['Sel'];
    $flag = $_GET['flag'];
    $token = $_GET['token'];
    $branch = $_GET['branch'];
    $app_nu = $_GET['app_nu'];
    $comments = $_GET['comments'];
    $datefilter = $_GET['adate'];
    $orderfilter = $_GET['orderfilter'];
    $statusfilter = $_GET['statusfilter'];
    $ending_time = $_GET['ending_time'];
    $pulling_time = $_GET['pulling_time'];
    $process_status = $_GET['process_status'];
}

if ($_POST) {

    $Sel = $_POST['Sel'];
    $token = $_POST['token'];
    $status = $_POST['status'];
    $datefilter = $_POST['adate'];
    $comments = $_POST['comments'];
    $pseudo_name=$_POST['pseudo_name'];   
    $ending_time = $_POST['ending_time'];
    $orderfilter = $_POST['orderfilter'];
    $statusfilter = $_POST['statusfilter'];
    $pulling_time = $_POST['pulling_time'];
    $process_status = $_POST['process_status'];
       
}


if(!$pseudo_name)
  $pseudo_name=$pseudo_name[0];
  
$Type = $_GET['Type'];


if($token==""){

    if($Type=="NEW"){
        
        $pseudo_name ="";
    }
}


if($_REQUEST['Type'] == "NEW"){ //FOR NEW RECORD INSERTION

    $token = $pulling_time = $ending_time = '';
}
if(empty($date)){
    
    $date=date("d/m/Y");
}
   // echo "<br>ending_time :".$ending_time;
   // echo "<br>pulling_time :".$pulling_time;
   // echo "<br>process_status :".$process_status;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/datetimepicker.css" rel="stylesheet" media="screen">    
    <script language="JavaScript" src="../js/gen_validatorv2.js" type="text/javascript"></script>
    <script language="javascript" src="../js/cal2.js"></script>
    <script language="javascript" src="../js/cal_conf2.js"></script>
    
  <script type="text/javascript">
    function startFunction(token){

        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = '00';
        
        if(hours<10){
            hours='0' + hours;
        }
         if(minutes<10){
            minutes='0' + minutes;
        }
             
        var mydate= hours + ":" + minutes + ":" + seconds;
        
        if(token=='Start'){
          
            document.getElementById('pulling_time').value=mydate;
            document.getElementById('process_status').value=token;
            
            document.frm.action = "addtasks_exec.php?Type=INSERT";
            document.frm.submit();
            
        }
        
    }
  </script>
  <script type="text/javascript">
    function completedFunction(token){

        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = '00';
        
        if(hours<10){
            hours='0' + hours;
        }
         if(minutes<10){
            minutes='0' + minutes;
        }
             
        var mydate= hours + ":" + minutes + ":" + seconds;
        
        if(token=='Completed'){
               
            document.getElementById('ending_time').value=mydate;
            document.getElementById('process_status').value=token;
            
            document.frm.action = "addtasks_exec.php?Type=UPDATE";
            document.frm.submit();
            
        }
        
    }
  </script>
  <script type="text/javascript">
    function rejectedFunction(token){

        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = '00';
        
        if(hours<10){
            hours='0' + hours;
        }
         if(minutes<10){
            minutes='0' + minutes;
        }
             
        var mydate= hours + ":" + minutes + ":" + seconds;
        
         if(token=='Rejected'){
        
            document.getElementById('ending_time').value=mydate;
            document.getElementById('process_status').value=token;
            
            var comments=document.getElementById("comments").value;
            
            if(comments==''){
                
                alert('Please enter the comments');
        
            }else{
                document.frm.action = "addtasks_exec.php?Type=UPDATE";
                document.frm.submit();
                
            }
            
            document.frm.action = "addtasks1.php?process_status=" + token + "&ending_time=" + mydate;
            document.frm.submit();
			//document.getElementById('pulling_time').value=NULL;
            //document.getElementById('process_status').value=NULL;
			//document.getElementById('file_number').value=NULL;
			
        }
        
    }
    </script>
    <script type="text/javascript">
   
    function ReloadMe() {

        document.frm.action = "addtasks1.php?Type=NULL";
        document.frm.submit();

    }

    function New_onClick() {
        //document.frm.action = "addtasks.php?Type=NEW";
        //document.frm.submit();
		//document.getElementById();
		document.getElementById('pulling_time').value=NULL;
            document.getElementById('process_status').value=NULL;
			document.getElementById('file_number').value=NULL;
    }

    function Save_onClick() {

        //alert('INSERT');
        document.frm.action = "addtasks_exec.php?Type=INSERT";
        document.frm.submit();

    }

    function Update_onClick() {

        //alert('UPDATE');
        document.frm.action = "addtasks_exec.php?Type=UPDATE";
        document.frm.submit();

    }

    function Reload(token) {

        document.frm.action = "addtasks1.php?token=" + token;
        document.frm.submit();

    }
</script>
    <title>THOUGHTFOCUS KPO</title>
</head>
    <body>
<form name="frm" action="" method="post" ENCTYPE="multipart/form-data">

<? if($_POST[token]) { ?>  
<input type="hidden" name="id" value="<?=$token?>"/>
<? }if($Type){ ?>
<input type="hidden" name="Type" value="<?=$Type?>"/>
<? }if($process_status){ ?>
<!--<input type="hidden" name="process_status" value="<?=$process_status?>"/>-->
<? }if($pulling_time){ ?>
<input type="hidden" name="pulling_time" value="<?=$pulling_time?>"/>
<? }if($ending_time){ ?>
<input type="hidden" name="ending_time" value="<?=$ending_time?>"/>
<? } ?>

<input type="hidden" name="process_status" id="process_status" value=""/>      
<?php

    // GETTING STUDENT DETAILS FROM TABLE
      $details=fetcharray(execute("SELECT * FROM `tasks_m` WHERE `id`='$token' AND status=1 LIMIT 1"));

?>

    <table class='forumline' align='center' width="99%" style="border-bottom: none;" >
        <tr><td colspan="7" class="row3">Search Here</td></tr>
    <tr>
 
        <td>&nbsp;&nbsp;  Status</td>
        <td><select name="statusfilter" onChange="reloadFirst()" style="width:200px;">
                 <option value="">-------  Select   -------</option>
                 <?php
                    $firstfilter=$secondfilter='';
                     if(statusfilter=='Completed'){
                         $firstfilter="selected";$secondfilter="";
                     }
                     elseif(statusfilter=='Rejected'){
                         $firstfilter="";$secondfilter="selected";
                     }
                            
                 ?> 
                 <option value="Completed" <?=$firstfilter?>>&nbsp; Completed</option>
                 <option value="Rejected" <?=$secondfilter?>>&nbsp; Rejected </option>
                                                       
              </select></td>
        <td>Date</td>

         <td nowrap><input type="text" name="adate" value="" style="height:25px; width:170px" >&nbsp;&nbsp;

         <a href="javascript:showCal('Calendar1')"><img src="../images/calendar.jpg" align="absmiddle" ></a></td>
         
         <td><input type="text" name="orderfilter" style="width:140px; height: 25px;" value="<?=$orderfilter?>" placeholder="Search Order Number"></td>
         <td><input type="button" name="Search" value="Search"  class="bgbutton" onClick="ReloadMe()" ></td>
         
         <td><input type="button" name="New" value="New" onClick="New_onClick()" class="bgbutton" style="width:60px;"/></td>

</tr>
<tr>

    <td colspan="7">
    <hr>
    </td>

</tr>
</table>
 </ul>

</div></div></div>
<table class='forumline'  align='center' width="99%" border="0" style="border-top: none;">
<tr>
    <td valign="top" rowspan="120"  align='left' > 


  <select name="token" multiple style="height:300px; width:170px" onChange="Reload(this.value)" >             
   <?php

     $sql="SELECT `id`, `order_number`, `process_status` FROM `tasks_m` WHERE status=1";

        if($statusfilter!='')
        {
            $sql.= " AND `process_status`='$statusfilter'";
        }
        if($datefilter!='')
        {
            $sql.= " AND `date`='$datefilter'";
        }
        if($orderfilter!='')
        {
            $sql.= " AND `order_number`='$orderfilter'";
        }

        $sql.=" ORDER BY id DESC";

        $rs=@execute($sql);


        while($row=fetcharray($rs))
        {
        
            if($row['process_status']=='Completed'){
                $fontColor = '#0F0';
            }elseif($row['process_status']=='Rejected'){
                $fontColor = 'red';
            }else{
                $fontColor = 'blue';
            }
            if($token==$row['id'])
                echo "<option value='$row[id]' selected title='$row[order_number] - $row[process_status]' style=background-color:$fontColor>$row[order_number]</option>";
            else
                echo "<option value='$row[id]' title='$row[order_number] - $row[process_status]' style=background-color:$fontColor>$row[order_number]</option>";

        }
    ?>

        </select>
     </tr>     
     <tr>
         <td colspan='4' class="row3" valign="center">TASKS DETAILS </td>

   </tr>
   <tr>
         <td align="left" width="100%" colspan="2"><table><tr><td><B><!--SECTION A : STUDENT DETAILS--></B></td></tr></table></td>
         <td align="left" width="50%" colspan="2"><table><tr><td><B><!--DATE OF TASKS : <?=date('d-M-Y');?>--></B></td></tr></table></td>
        
     </tr>
     
      
    <tr>

     <td align="left" nowrap>&nbsp;Queue Number</td>
     <td colspan="3"><select name="queue_number" style="min-width: 150px;" >
     <option value="">&nbsp;</option>
      <?php

         $rsq=execute("SELECT `id`, `queue_name` FROM `tasks_queue` WHERE status=1");
         
          if($details[queue_number]){
            
            $queue_number=$details[queue_number];
        }

        while($q=fetcharray($rsq))
        {

            if($queue_number==$q['queue_name'])
                echo "<option value='$q[queue_name]' selected>$q[queue_name]</option>";
            else
                echo "<option value='$q[queue_name]'>$q[queue_name]</option>";

        }
    ?></select></td>
     </tr> 
     <tr>
        <td align="left" nowrap >&nbsp;File Number </td>
        <td><input type="text" id="file_number" name="file_number" value="<?=$details[file_number]?>"  required></td>
        <td align="left" nowrap>&nbsp;Order Number</td>
        <td><input type="text" name="order_number" value="<?=$details[order_number]?>" required></td>
    </tr>  
    <tr>
           <td align="center"  colspan="4">
     <?php
         
         $check=rowcount(execute("SELECT `ending_time` FROM `tasks_m` WHERE status=1 AND ending_time='00:00:00' AND id='$token'"));
     
         if($check > 0){ ?>            
              <input type="button" name="Start" id="Start" value="Start" class="bgbutton" style="width:70px;" disabled/>
       <? }else{ ?>
              <input type="button" name="Start" id="Start" value="Start" onClick="startFunction('Start')" class="bgbutton" style="width:70px;"/>
        <? } ?>
              <input type="button" name="Completed" value="Completed" onClick="completedFunction('Completed')" class="bgbutton" />
              <input type="button" name="Rejected" value="Rejected" onClick="rejectedFunction('Rejected')" class="bgbutton" style="width:70px;"/>
          </td>
    </tr>                       
     <tr>
        
         <td align="left" nowrap >&nbsp;Name </td>
         <td><select name="pseudo_name">  
             <option value="">&nbsp;&nbsp;</option>           
   <?php

        
     $sql="SELECT `id`, `pseudo_name` FROM `task_pseudo_details` WHERE status=1 ORDER BY id";

        $rs=@execute($sql);
        
        if($details[pseudo_name]){
            
            $pseudo_name=$details[pseudo_name];
        }

        while($row=fetcharray($rs))
        {

            if($pseudo_name==$row['pseudo_name'])
                echo "<option value='$row[pseudo_name]' selected title='$row[pseudo_name]'>$row[pseudo_name]</option>";
            else
                echo "<option value='$row[pseudo_name]' title='$row[pseudo_name]'>$row[pseudo_name]</option>";

        }

    ?>

        </select></td>

         <td align="left" nowrap>&nbsp;Date </td>

        <?php
            if ($details['date'] != "0000-00-00" and $details['date'] != '') {
    
                $date = $details['date'];
    
                $dateArray = explode('-', $date);
    
                $b_day = $dateArray[2];
    
                $b_month = $dateArray[1];
    
                $b_year = $dateArray[0];
    
                $date = $b_day . "/" . $b_month . "/" . $b_year;
    
            } 
        ?>

         <td nowrap><input type="text" name="bdate" value="<?=$date?>" placeholder='(DD/MM/YYYY)'>&nbsp;&nbsp;
 <a href="javascript:showCal('Calendar2')"><img src="../images/calendar.jpg" align="absmiddle" ></a> &nbsp;&nbsp;</td>

  </tr>
<tr>
     <td align="left" nowrap>&nbsp;Pulling Time</td>
     <?php
     if(!empty($pulling_time)){
        
     }else{
         $pulling_time=$details[pulling_time];
     }
     ?>
     <td><input type="text" name="pulling_time" value="<?=$pulling_time?>" id="pulling_time" /></td>
    
     <td align="left" nowrap>&nbsp;Ending Time</td>
      <?php
     if(!empty($ending_time)){
        
     }else{
         $ending_time=$details[ending_time];
     }
     ?>
     <td><input type="text" name="ending_time" value="<?=$ending_time?>" id="ending_time" /></td>
     
</tr>
<tr> 
    <td align="left" nowrap>&nbsp;Comments</td>
    <td colspan="4"><textarea name="comments" id="comments" rows="2" cols="80" required><?=$details[comments]?></textarea></td>
</tr>
<tr>
    
</tr>
</table>
</td>
</tr>
</table>
<p align="center">
        
        &nbsp;&nbsp;&nbsp;&nbsp;
<?php
    if($_REQUEST['Type']=="NEW" or $token==""){  ?>

     <!-- <input type="button" name="Save" value="Save" onClick="Save_onClick()" class="bgbutton" style="width:70px;"/>-->

<?  }else{  ?>
       <!--<input type="button" name="Save" value="Save" onClick="Update_onClick()" class="bgbutton" style="width:70px;"/>-->

<?  }  ?>
        
</p>
</form>
</BODY>
</HTML>







