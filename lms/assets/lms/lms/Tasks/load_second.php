<?php
$last_msg_id=$_GET['last_msg_id'];

 $rs=mysql_query("SELECT `id`, `order_number`, `process_status`, `date` FROM `tasks_m` WHERE id < '$last_msg_id' ORDER BY id DESC LIMIT 5");
 $last_msg_id="";

		?>
     <select name="token" multiple style="height:300px; width:170px" onChange="Reload(this.value)" >    

    <?php
        while($row=fetcharray($rs))
        {
        
            if($row['process_status']=='Completed'){
                $fontColor = '#0F0';
            }elseif($row['process_status']=='Rejected'){
                $fontColor = 'red';
            }else{
                $fontColor = 'blue';
            }
               
 
              $date = date('d-M-Y', strtotime("$row[date]"));
            if($token==$row['id'])
                echo "<option value='$row[id]' selected title='$row[order_number] - $date - $row[process_status]' style=background-color:$fontColor>$row[order_number]</option>";
            else
                echo "<option value='$row[id]' title='$row[order_number] - $date - $row[process_status]' style=background-color:$fontColor>$row[order_number]</option>";

        }
        ?>
         </select>
       <? 
?>
