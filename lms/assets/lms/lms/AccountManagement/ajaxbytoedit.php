<?php
include("../db.php");
require_once('classes/tc_calendar.php');
require_once('classes1/tc_calendar1.php');
$q=$_GET["q"];
$p=$_GET["p"];
$r=$_GET["r"];
$s=$_GET["s"];
$yr=date('Y');
$q1=execute("select * from ac_voucher where vvoucherno=\"$r\" and iIdx_vouchermaster='$s'");
while($row1=mysql_fetch_assoc($q1))
	{
		$date=$row1[ddate];
		$dated=$row1[ddate];
		if($row1[vvoucherno]==$v1) {$to=$row1[acc];} else {$by=$row1[acc];}
		$cno=$row1[chequedd_no];
		$cdate=$row1[chequedd_date];
		if($row1[vvoucherno]==$v1) {if($row1[fcredit]!=0.00){$amt=$row1[fcredit];}else{ $amt=$row1[fdebit]; }}
		if($row1[vvoucherno]!=$v1){$nar=$row1[vnarration];}
		//$nar=$row1[vnarration];
		$a=explode("-",$date);
$day=$a[2];
$month=$a[1];
$year=$a[0];
$a1=explode("-",$cdate);
$day1=$a1[2];
$month1=$a1[1];
$year1=$a1[0];
	    $v1=$row1[vvoucherno];

	}

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
		$u1=execute("select * from ac_voucher where iIdx_vouchermaster='$q' and iIdx_organization='$p' and ddate<='$date'");
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
		 $myCalendar->setDate($day, $month, $year);
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
		 $myCalendar->setDate($day, $month, $year);
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
if($q==2){echo "<div align center><b>Bank/Cash:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div>"; } else {echo "<div align center><b>By:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div>"; }  echo "</th> <td colspan=4>";
       
     
         
	  if($q==1)
	  {
	  if($mon>3)
		{
		
          
         echo " <input type=text name=combobc1 value=$by readonly><select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
          
	    $qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\"");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	 
            echo "<option value='".$row['vledger']."'>  $row[vledger] </option>";
            }  

          
	   }
	   else
	   {
	  
         echo " <input type=text name=combobc1 value=$by readonly><select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
           
	   $qry1=execute("select * from ac_ledger where and iIdx_organization=\"$p\"");
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
		
          echo "<input type=text name=combobc1 value=$by readonly><select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
            
	$qry1=execute("select * from ac_ledger where  iIdx_group=21 or iIdx_group=20 and iIdx_organization=\"$p\"");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	
            echo "<option value='".$row['vledger']."'>   $row[vledger]  </option>";
           }  
            echo "</select><br><br>";
          } 
		else
		{
		
          echo "<input type=text name=combobc1 value=$by readonly><select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
            
	$qry1=execute("select * from ac_ledger where iIdx_group=21 or iIdx_group=20 and  iIdx_organization=\"$p\"");
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
		
          
         echo " <input type=text name=combobc1 value=$by readonly><select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
          
	$qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and iIdx_group!=21 and iIdx_group!=20" );
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	 
            echo "<option value='".$row['vledger']."'> $row[vledger] </option>";
             }  
           echo " </select><br><br>"; } else { 
         echo " <input type=text name=combobc1 value=$by readonly><select name=combobc onchange=showBybal(this.value)>
            <option value=select>-SELECT-</option>";
            
	$qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and iIdx_group!=21 and iIdx_group!=20");
	    while ($row = mysql_fetch_assoc($qry1))
      {
	  $a=$row[vledger];
	  
            echo "<option value='".$row['vledger']."'> $row[vledger]  </option>";
          
	   }   echo "</select><br><br>";
         
	   }
	   }
	      echo " </td></tr><tr id=td1>
        
                <th height=26 scope=row>";
                  
                  if($q==1){echo "<div align center><b>Bank/Cash:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div>"; } else {echo "<span class=style4 style11 style20><div align center><b>To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span></div>"; }echo "</th>";
        echo "<td colspan=4>";
		
        
         
         
	  if($q==1 || $q==3)
	  {
	  if($mon>3)
		{
	   echo "<input type=text name=comboacname1 value=$to readonly><select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>"; $qry1=execute("select * from ac_ledger where iIdx_group=21 or iIdx_group=20 and iIdx_organization=\"$p\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  
            echo "<option value='".$row['vledger']."'>  $row[vledger]  </option>";
             }  
            echo "</select><br><br>"; } else { 
         echo " <input type=text name=comboacname1 value=$to readonly><select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>"; $qry1=execute("select * from ac_ledger where  iIdx_group=21 or iIdx_group=20 and iIdx_organization=\"$p\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	 
            echo "<option value='".$row['vledger']."'> $row[vledger]  </option>";
             }  
            echo "</select><br><br>";
           } }
          
          
          
          
          
        
	  if($q==2){
	  if($mon>3)
		{
	  
          echo "<input type=text name=comboacname1 value=$to readonly><select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>";
          
		 $qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	 
           echo " <option value='".$row['vledger']."'>  $row[vledger]  </option>";
            }  
            echo "</select><br>"; } else { 
         echo "<input type=text name=comboacname1 value=$to readonly> <select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>";
            
		 $qry1=execute("select * from ac_ledger whereiIdx_organization=\"$p\"");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	 
            echo "<option value='".$row['vledger']."'>   $row[vledger]  </option>";
             }  
            echo "</select><br><br>";
          } }
          
          
          
          
          
        
	  if($q==6){
	   if($mon>3)
		{
	  echo "<input type=text name=comboacname1 value=$to readonly><select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>";$qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and iIdx_group!=21 and iIdx_group!=20");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  
           echo " <option value='".$row['vledger']."'>  $row[vledger]  </option>";
           }  
           echo " </select><br>"; } else { 
          echo "<input type=text name=comboacname1 value=$to readonly><select name=comboacname onchange=showTobal(this.value)>
            <option value=select>-SELECT-</option>"; $qry1=execute("select * from ac_ledger where iIdx_organization=\"$p\" and iIdx_group!=21 and iIdx_group!=20");
	  while ($row = mysql_fetch_assoc($qry1))
      {
	  
           echo " <option value='".$row['vledger']."'> $row[vledger]  </option>";
             }  
           echo " </select><br><br>";
         } }
          
          echo "</td>";
		 
     
	 
 
?>
