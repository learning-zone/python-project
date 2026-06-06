<?php
include("../connection.php");
$q=$_GET["q"];
echo "<select name=comboid onchange=showemp(this.value)>
                  <option value=select>-SELECT ID-</option>";
                  
				  $q1=mysql_query("select * from emp_details1 where iIdx_institution='$q'");
				  while($row1=mysql_fetch_assoc($q1))
				  {
				  
                 echo " <option value='".$row1[ vemp_id]."'>".$row1[ vemp_id]."</option>";
                 
				  }
               echo " </select>";
?>