<?php

session_start();

require("../db1.php");

$id=$_REQUEST['id'];
$branch = $_POST['branch'];

?>

<html>

<HEAD>

<script language="Javascript">

function prn()

{

	pr1.style.display="none";	

	print(this.form);

}

</script>

</HEAD>

<body>



<?php

$count=1;

$sql = "SELECT * FROM trans_route_vechile_details where vechile_id='$id'";



$rs = execute($sql);



$num = rowcount($rs);

 $rowclass=1;

if($num==0)

{

echo "NO DATA FOUND";

}



?>




  <table width="90%" border="1" cellspacing="0"  align="center" class="forumline"  cellpadding="0">
  <tr height="40%"><td class="head" colspan=9 align='center'>Vehicle Details For <?=$cc1[0]?></td></tr>
  <tr><td class="rowpic">Sl No</td>
  <td class="rowpic" nowrap>Route</td>
  <td class="rowpic" nowrap>Pick Up</td>
  <td class="rowpic" nowrap>Trip</td>
  <td class="rowpic" nowrap>12 P.M</td>
  <td class="rowpic" nowrap>2 P.M</td>
  <td class="rowpic" nowrap>3.10 P.M</td>
  <td class="rowpic" nowrap>4.20 P.M</td></tr>



<?php

	for($i=0;$i<$num;$i++)
	{

	if($i%2)

	echo "<tr> ";

	else

	echo "<tr class='clsname'> ";

		$r = fetcharray($rs,$i);

?>



 <!-- <tr  class='row<?php /* echo $rowclass */ ?>'> -->

  <td class="CBody" align="center">



  <?=$count ?>

  </td><td class="CBody">&nbsp;&nbsp;
  <?php
$fetch_qry=execute("select * from trans_route_vechile_details");
 $jj=fetcharray(execute("SELECT `route_name`,route_code FROM `trans_route_master` WHERE `id` ='$frt[route_id]'"));

while($frt=fetcharray($fetch_qry))
{
 
 
 
  			
}
				?>
  
    <?=$r[route_id]?>
 

  </td>

   <td class="CBody" align="LEFT">&nbsp;&nbsp;
   
   <?php
   if($r[pick_t]==1) 
   {
	   $pick="YES";
   }
   else if($r[pick_t]==0)
   {
	   $pick="NO";
   }
   echo $pick;
   ?>

   </td>
    <td class="CBody" align="LEFT">&nbsp;&nbsp;
    <?=$frt[weekday]?></td>

   <td class="CBody" align="center">
   <?php
   if($r[drop_time1]==1) 
   {
	   $drop_1="YES";
   }
   else if($r[drop_time2]==2)
   {
	   $drop_2="YES";
   }
   else if($r[drop_time3]==3)
   {
	   $drop_3="YES";
   }
   else if($r[drop_time4]==4)
   {
	   $drop_4="YES";
   }
 echo $drop_1;
   ?>



   </td>

   <td class="CBody">&nbsp;&nbsp;

   <?=$drop_2?>

   </td>

 
   <td class="CBody" align="center">
 <?=$drop_3?>
   </td>

   <td class="CBody">&nbsp;&nbsp;

   <?=$drop_4?>

   </td>

     </tr>

<?php

$count++;

	$rowclass = 1 - $rowclass ;

	}

?>
</table><br>

<br>

<div id=pr1 align=center><INPUT TYPE="button" NAME="print" class='bgbutton' VALUE="PRINT" OnClick="prn()"></div><br><br>


</body>

</html>

