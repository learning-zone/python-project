<?php

session_start();

require("../db.php");

$rs123=execute("select id from trans_drop_time");
while($r=fetcharray($rs123))
{
	$sql_alter="alter table trans_route_vechile_details add column drop_time".$r[0]." varchar(20)";
	execute($sql_alter);

}

$pickup=$_POST['pickup'];
$route2= $_POST['route2'];
$mid = $_POST['mid'];
$vechile2 = $_POST['vechile2'];
$driver2 = $_POST['driver2'];
$weekday = $_POST['weekday'];
$drop_time = $_POST['drop_time'];
$route = $_POST['route'];
$vechile = $_POST['vechile'];
$driver = $_POST['driver'];
$check=$_POST['check'];
?>

<html>

<head>

<script language="JavaScript">

function reload()

{

document.form1.flag.value=1;

document.form1.vflag.value=1;

document.form1.wflag.value=1;

document.form1.action="applyvechile.php";

document.form1.submit();

}




</script>

</head>



<body>
<form Name="applayv" action="addapplayvechile.php" method="Post">
<Table  width="80%"class='forumline' align='center' border='1' colspan='8'>
<tr><td Class="head" colspan='9' align=center>Assign Vehicle to Route </td></tr>
<tr>

<td align="center" class="row2">Route Name</td> 

<td align="center" class="row2">Vehicle name </td>

<td align="center" class="row2">Trip</b></td>

<td class="row2" align="center">Pick Up</td>

 <?php

	 	$rs2=execute("select * from trans_drop_time");

	 	while($r2=fetchrow($rs2))

	 	{

	 		

				?>
               <td class="row2" align="center">

	 			<?=$r2[1]?></td>
                <?php

				}
				?>
</tr>

<td align="center"><select name="route">

<option value="-1">---- Select ----</option>

<?php

$sql="select * from trans_route_master order by route_code";

$rs=execute($sql);

for($i=0;$i<rowcount($rs);$i++)

{

$r=fetcharray($rs,$i);

echo "<option value=$r[id] >$r[route_code] - $r[route_name]</option>";

}

?>
</select>
</td>

<td align="center"><select name="vechile">

<option value="-1">---- Select ----</option>

<?php

$sql2="select * from trans_vechile_master";

$rs2=execute($sql2);

for($i2=0;$i2<rowcount($rs2);$i2++)

{

$r2=fetcharray($rs2,$i2);



echo "<option value=$r2[id] > $r2[vechile_mod_no]</option>";

}

?>

</select>

</td>
<td align="center">
<select name="weekday">

<option value="-1">---- Select ----</option>

<?php


for($i=1;$i<7;$i++)

{

?>



 <option value='<?php echo weekname($i);?>' ><?php echo weekname($i);
?></option>
<?

}

?>

</select>
</td>
          
<td align="center">
<?php
if($pickup=='1')
{
	$check='checked';
}
else
{
	$check='0';
}

?>

<input type='checkbox' name='pickup' value='1'  <?=$check?>></td>
	
     <?php
	 	$sql2="select * from trans_drop_time";
	 	$rs2=execute($sql2);
	 	for($i=0;$i<rowcount($rs2);$i++)
	 	{
			$r321=fetcharray($rs2);
			
	 		?>
	 			<td align='center'>
                <input type='checkbox' size='7' name='drop_time<?=$r321[id]?>' value="<?=$r321[id]?>"></td>
				<?php
		}
	 ?>	
</tr>
</select>
</table>
        <br>
        <center>	
		<div align='center' colspan='6'>
<input class='bgbutton' type="Submit" value="ADD"></div>
            </center>
	</form>
    
<?php
$sql = "SELECT * FROM trans_route_vechile_details order by id";



$rs = execute($sql);

$num = rowcount($rs);
if($num)
{

?>

  <form method="post" name="form1">
    <Table class='forumline' align=center width='80%'>
      
      <tr>
  <td class="head" colspan=10 align='center'>Modify Vehicle to Route </td>
  </tr>

  <tr><td class="rowpic" align='center'>Route</td><td class="rowpic" align='center'>Vehicle Name</td>
  <td class="rowpic" align='center'>Trip</td>
  <td class="rowpic" align="center">Pick Up</td>

 <?php

	 	$rs2=execute("select * from trans_drop_time");

	 	while($r2=fetchrow($rs2))

	 	{

	 		

				?>
               <td class="rowpic" align="center">

	 			<?=$r2[1]?></td>
                <?php

				}
				?>
  
      
<?php





$fetch_qry=execute("select * from trans_route_vechile_details order by weekday");


while($frt=fetcharray($fetch_qry))
{
	?>
    <tr>
	 <?
				
				$cc=fetcharray(execute("SELECT `route_name`,route_code 	FROM `trans_route_master` WHERE `id` ='$frt[route_id]'"));
				$cc1=fetcharray(execute("SELECT `vechile_mod_no` FROM `trans_vechile_master` WHERE `id` ='$frt[vechile_id]'"));
				$ss=fetcharray(execute("select point_name from trans_point_master where id='$frt[point_id]'"));
				$ss1=fetcharray(execute("select drop_time from trans_drop_time where id='$frt[drop_time]'"));
				
			?>
            <input type="hidden" name="sel[]">
           
            <td >&nbsp;&nbsp;&nbsp;<?=$cc[0]?> - <?=$cc[1]?></td>
			
            <td >&nbsp;&nbsp;&nbsp;<?=$cc1[0]?></td>
            <td align="center"><?=$frt[10]?></td>
            <?
				if($frt[pick_t]==1)
				{
					$check="checked";
				}else{
					$check="";
				}
			?>
            <td align="center"><input type="checkbox" name="pick_t"   <?=$check?> disabled>
            
         <?
		       $check=execute("select id from trans_drop_time");
			   $n=rowcount($check);
			   
			
			   for($i=1;$i<=$n;++$i)
			   {
				   $field="drop_time$i";
				   if($frt[$field]==$i){
					   $sel="checked";
					 
				   }else{
					   $sel="";
					   
				   }
				   ?>
                       <td align="center"><input type="checkbox" name="mid3<?=$frt['id']?>" <?=$sel?> disabled>
                   <?
			   }
		 ?>      
    </tr>
    <?
	
}

?>
</table>
</form>
  <?
}
?>
<?php
function weekname($mon)
{
 if($mon == 1) return("1st Trip");
 if($mon == 2) return("2nd Trip");
 if($mon == 3) return("3rd Trip");
 if($mon == 4) return("4th Trip");
 if($mon == 5) return("5th Trip");
 if($mon == 6) return("6th Trip");
}

?>

</body>

</html>

