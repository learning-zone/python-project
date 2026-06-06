<?php
include("../db.php");
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
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
		$u1=execute("select * from ac_voucher where iIdx_vouchermaster='$q'");
		$ru1=rowcount($u1);
		if($ru1>0)
		{
			$n1=$ru1/2;
			if($n1>9)
			{
				$n2='00'.($n1+1);
			}
			else
			{
				$n2='000'.($n1+1);
			}
		}
		else
		{
		$n2='0001';
		}
		 //echo $q;
		echo" <table  border=1 id=tb2 cellspacing=0>
              <tr id=td1>
                <th width=97 height=33 scope=row><div align=center>Voucher No: </div></th>
        <td width=177><input type=text name=txtvno size=35 value=".$n2." readonly=true></td>
        <td colspan=2><div align=center><strong>Date:</strong></div></td>
        <td><b>";
         
		$yr=date('Y');
		$yr1=$yr-1;
		$yr2=$yr+1;
		$mon=date('m');
		$dat=date('d');
		if($mon>3)
		{
	  $myCalendar = new tc_calendar("date5", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr2);
	  $myCalendar->dateAllow($yr.'-04-01', $yr2.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	  else
	  {
	   $myCalendar = new tc_calendar("date5", true, false);
	  $myCalendar->setIcon("images1/iconCalendar.gif");
	 $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("./");
	  $myCalendar->setYearInterval($yr3, $yr);
	  $myCalendar->dateAllow($yr1.'-04-01', $yr.'-03-31');
	  $myCalendar->setDateFormat('j F Y');
	  //$myCalendar->setHeight(350);	  
	  //$myCalendar->autoSubmit(true, "form1");
	  $myCalendar->writeScript();
	  }
	
         echo" </b>
          </span></td>
      </tr> <tr id=td1>";
	  
             
               
       
		
		
		
		
		
		
		
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
          
	    $qry1=execute("select * from ac_ledger where  date between '$y21' and '$y32' and iIdx_organization=\"$p\"");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	 
            echo "<option value='".$row['vledger']."'>  $row[vledger] </option>";
            }  

          
	   }
	   else
	   {
	  
         echo " <select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
           
	   $qry1=execute("select * from ac_ledger where date between '$y33' and '$y11' and iIdx_organization=\"$p\"");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  
            echo "<option value='".$row['vledger']."'>$row[vledger] </option>";
            
           
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
	
            echo "<option value='".$row['vledger']."'>   $row[vledger]  </option>";
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
	 
           echo " <option value='".$row['vledger']."'> $row[vledger]  </option>";
          
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
	 
            echo "<option value='".$row['vledger']."'> $row[vledger] </option>";
             }  
           echo " </select><br><br>"; } else { 
         echo " <select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
            
	$qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and iIdx_group!=21 and iIdx_group!=20 date between '$y33' and '$y11'");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  
            echo "<option value='".$row['vledger']."'> $row[vledger]  </option>";
          
	   }   echo "</select><br><br>";
         
	   }
	   }
	      echo " </td></tr><tr id=td1>
        
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
	  
            echo "<option value='".$row['vledger']."'>  $row[vledger]  </option>";
             }  
            echo "</select><br><br>"; } else { 
         echo " <select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>"; $qry1=execute("select * from ac_ledger where  iIdx_group=21 or iIdx_group=20 and date between '$y33' and '$y11' and iIdx_organization=\"$p\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	 
            echo "<option value='".$row['vledger']."'> $row[vledger]  </option>";
             }  
            echo "</select><br><br>";
           } }
          
          
          
          
          
        
	  if($q==2){
	  if($mon>3)
		{
	  
          echo "<select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>";
          
		 $qry1=execute("select * from ac_ledger where  date between '$y21' and '$y32' and iIdx_organization=\"$p\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	 
           echo " <option value='".$row['vledger']."'>  $row[vledger]  </option>";
            }  
            echo "</select><br>"; } else { 
         echo " <select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>";
            
		 $qry1=execute("select * from ac_ledger where  date between '$y33' and '$y11' and iIdx_organization=\"$p\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	 
            echo "<option value='".$row['vledger']."'>   $row[vledger]  </option>";
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
	  
           echo " <option value='".$row['vledger']."'>  $row[vledger]  </option>";
           }  
           echo " </select><br>"; } else { 
          echo "<select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>"; $qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and iIdx_group!=21 and iIdx_group!=20 and date between '$y33' and '$y11'");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  
           echo " <option value='".$row['vledger']."'> $row[vledger]  </option>";
             }  
           echo " </select><br><br>";
         } }
          
          echo "</td>";
		 
     
	 
 
?>
