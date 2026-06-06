<?php
include("../db.php");
$q=$_GET["q"];
$p=$_GET["p"];
$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$yr3=$yr-2;
		$mon=date('m');
		$dat=date('d');
		$y11=$yr.'-04-01';
		$y12=$yr.'-03-31';
		$y21=$yr1.'-04-01';
		$y22=$yr1.'-03-31';
		$y31=$yr2.'-04-01';
		$y32=$yr2.'-03-31';
		$y33=$yr3.'-04-01';
		
		echo "
                <th height=37 scope=row>";
				$qry3=execute("select * from ac_vouchermaster where vvouchertype=\"$q\"");
$obj3=mysql_fetch_object($qry3);
$vn3=$obj3->iIdx_vouchermaster;
if($q==2){echo "<b>Bank/Cash:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>"; } else {echo "<b>By:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>"; }  echo "</th> <td colspan=4>";
       
     
         
	  if($q==1)
	  {
	  if($mon>3)
		{
		
          
         echo " <select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
          
	    $qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and date between '$y21' and '$y32'");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	 
            echo "<option value=".$row[vledger].">  $row[vledger] </option>";
            }  
            echo "</select><br><br>";
          
	   }
	   else
	   {
	  
         echo " <select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
           
	   $qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and date between '$y33' and '$y11'");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  
            echo "<option value=".$row[vledger].">$row[vledger] </option>";
            
           
	   }  echo "</select><br><br>";
          
	   }
	   }
	
         
          
          
          
          
          
          
	  if($q==2 || $q==3)
	  {
	   if($mon>3)
		{
		
          echo "<select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
            
	$qry1=execute("select * from ac_ledger where  iIdx_group=21 or iIdx_group=20 and date between '$y21' and '$y32' and iIdx_organization=\"$p\"");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	
            echo "<option value=".$row[vledger].">   $row[vledger]  </option>";
           }  
            echo "</select><br><br>";
          } 
		else
		{
		
          echo "<select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
            
	$qry1=execute("select * from ac_ledger where iIdx_group=21 or iIdx_group=20 date between '$y33' and '$y11' and  iIdx_organization=\"$p\"");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	 
           echo " <option value=".$row[vledger]."> $row[vledger]  </option>";
          
	   }   echo "</select><br><br>";
         
	   }
	   }
	  
          
          
          
          
         
	  if($q==6){
	  if($mon>3)
		{
		
          
         echo " <select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
          
	$qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and iIdx_group!=21 and iIdx_group!=20 and date between '$y21' and '$y32'" );
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	 
            echo "<option value=".$row[vledger]."> $row[vledger] </option>";
             }  
           echo " </select><br><br>"; } else { 
         echo " <select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
            
	$qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and iIdx_group!=21 and iIdx_group!=20 date between '$y33' and '$y11'");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  
            echo "<option value=".$row[vledger]."> $row[vledger]  </option>";
          
	   }   echo "</select><br><br>";
         
	   }
	   }
	      echo " </td>
        
                <th height=26 scope=row>";
                  
                  if($q==1){echo "<b>Bank/Cash:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>"; } else {echo "<span class=style4 style11 style20><b>To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>"; }echo "</th>";
        echo "<td colspan=4>";
		
        
         
         
	  if($q==1 || $q==3)
	  {
	  if($mon>3)
		{
	   echo "<select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>"; $qry1=execute("select * from ac_ledger where iIdx_group=21 or iIdx_group=20  and date between '$y21' and '$y32' and iIdx_organization=\"$p\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  
            echo "<option value=".$row[vledger].">  $row[vledger]  </option>";
             }  
            echo "</select><br><br>"; } else { 
         echo " <select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>"; $qry1=execute("select * from ac_ledger where  iIdx_group=21 or iIdx_group=20 and date between '$y33' and '$y11' and iIdx_organization=\"$p\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	 
            echo "<option value=".$row[vledger]."> $row[vledger]  </option>";
             }  
            echo "</select><br><br>";
           } }
          
          
          
          
          
        
	  if($q==2){
	  if($mon>3)
		{
	  
          echo "<select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>";
          
		 $qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and date between '$y21' and '$y32'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	 
           echo " <option value=".$row[vledger].">  $row[vledger]  </option>";
            }  
            echo "</select><br>"; } else { 
         echo " <select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>";
            
		 $qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and date between '$y33' and '$y11'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	 
            echo "<option value=".$row[vledger].">   $row[vledger]  </option>";
             }  
            echo "</select><br><br>";
          } }
          
          
          
          
          
        
	  if($q==6){
	   if($mon>3)
		{
	  echo "<select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>";$qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and iIdx_group!=21 and iIdx_group!=20  and date between '$y21' and '$y32'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  
           echo " <option value=".$row[vledger].">  $row[vledger]  </option>";
           }  
           echo " </select><br>"; } else { 
          echo "<select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>"; $qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and iIdx_group!=21 and iIdx_group!=20 and date between '$y33' and '$y11'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  
           echo " <option value=".$row[vledger]."> $row[vledger]  </option>";
             }  
           echo " </select><br><br>";
         } }
          
          echo "</td>
      ";
	  echo "<input type=hidden name=vtv value=".$q.">";
 
?>
