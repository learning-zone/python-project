<?php
session_start();
include("../db.php");
$ins=$_SESSION['ins'];
$bd1=$_SESSION['bdt7'];
$bd2=$_SESSION['bdt8'];
$dt11=date('d-m-Y',strtotime($bd1));
$dt22=date('d-m-Y',strtotime($bd2));
$tp=$_SESSION['type'];
$ordep=$_SESSION['ordep'];
if($tp=='a')
{
$or1=$_SESSION['or11'];
}
else
{
$or1=$_SESSION['ior'];
}
//$ins=$_SESSION['ins'];
$dep=$_SESSION['cdep'];
$qq=execute("select * from ac_institution where vinstitution=\"$dep\"");
$b1=mysql_fetch_object($qq);
$qq8=execute("select vorgname from ac_organization where iIdx_organization=\"$or1\"");
$b2=fetchrow($qq8);
$qry=execute("select * from ac_voucher where ddate between \"$bd1\" and \"$bd2\" and acc<>\"$ledger\" and iIdx_institution=\"$b1->iIdx_institution\"");
//$yr=date('Y');
$yr=substr($bd1,0,strpos($bd1,'-'));
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
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=trialbalance.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<b><table border=1 width=1000>";





 echo "<tr>
                <td colspan=7></a>
                  <div align=center ><strong>TRIAL BALANCE </strong></div></td>
      </tr>";
	    if($ordep==1)
{
 echo "<tr>
              <td><strong>ORGANIZATION</strong></td>
        <td colspan=6>$b2[0]&nbsp;</td>
      </tr>";
} else {
              echo "<tr>
              <td><strong>DEPARTMENT</strong></td>
        <td colspan=6>$dep&nbsp;</td>
      </tr>";}
              echo "<tr>
                <td colspan=7><div align=center><strong>TRIAL BALANCE AS ON  </strong>$dt22</div></td>
      </tr>
              <tr>
                <td rowspan=2></td>
        <td colspan=2><div align=center><strong>Opening Balance </strong></div></td>
		 <td colspan=2><div align=center><strong>Transaction Amount </strong></div></td>
        <td colspan=2><div align=center><strong>Closing Balance </strong></div></td>
      </tr>
              <tr>
                <td><div align=center><strong>Dr</strong></div></td>
        <td><div align=center><strong>Cr</strong></div></td>
		<td><div align=center><strong>Dr</strong></div></td>
        <td><div align=center><strong>Cr</strong></div></td>
        <td><div align=center><strong>Dr</strong></div></td>
        <td><div align=center><strong>Cr</strong></div></td>
      </tr>";
	
	
	  if($ordep==1)
		{
	  ?>
	   <?php
	   $s1=0; $s2=0; $s3=0; $s4=0;$st7=0;$st8=0; 
	$yy=execute("select * from ac_voucher where vins=\"$ins\"");
	$qry1=execute("select * from ac_allgroup");
	while($row1=mysql_fetch_assoc($qry1))
	{
	$id1=$row1[iIdx_grp];
	?>
   
    
	 
	  <?php
	 
	  $s=0;$sub1=0;$sub2=0;$sub3=0;$sub4=0;$t1=0;$t2=0; $t3=0;$t4=0;$st5=0;$st6=0;$tr1=0;$tr2=0;$tr3=0;$tr4=0;
	  if($mon>3)
		{
		if($chk==1)
		{
	  $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and  iIdx_organization=\"$or1\" and opdate >= '".$y21."' and opdate <= '".$bd2."' order by Vledger");
	  }
	  else
	   $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and  iIdx_organization=\"$or1\" and opdate >= '".$y21."' and opdate <= '".$bd2."'");
	  }
	  else
	  {
	  if($chk==1)
	   $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and  iIdx_organization=\"$or1\" and opdate >= '".$y33."' and opdate <= '".$bd2."' order by Vledger");
	   else
	   $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and  iIdx_organization=\"$or1\" and opdate >= '".$y33."' and opdate <= '".$bd2."'");
	  }
	  while($r5=mysql_fetch_assoc($q6))
	  {
	  $a=$r5[Vledger];
	
	  ?>
	   
	  <?php
	  $klm=execute("select vgroupname from ac_allgroup where IIdx_grp='$id1'");
	  $kl=fetchrow($klm);
	  if($kl[0]!=$vc)
	  {
	    echo " <tr id=td1><td><b>$kl[0]&nbsp;</b></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		}
		else
		{
		 //echo " <tr id=td1><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		}
		 $vc=$kl[0];
		/*if($mon>3)
		{*/
		$qcnt=execute("select * from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$a\" and opdate<'$bd1'");
				$ct=rowcount($qcnt);
		
	/*  }
	  else
	  {
	   $qcnt=execute("select * from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$a\" and opdate<'$dt1'");
	  $ct=rowcount($qcnt);
	  }*/
		if($ct>0)
		{
	  $q5=execute("select max(iIdx_op) from ac_opbal where opdate<\"$bd1\" and iIdx_organization=\"$or1\" and Vledger=\"$a\" and iId_grp=\"$id1\"");
	  $r6=fetchrow($q5);
	  $d=$r6[0];
	  }
	 else
	 {
	 $q5=execute("select min(iIdx_op) from ac_opbal where opdate=\"$bd1\" and iIdx_organization=\"$or1\" and Vledger=\"$a\" and iId_grp=\"$id1\"");
	  $r6=fetchrow($q5);
	  $d=$r6[0];
	 }
	  //echo $d;
	  
	  $q1=execute("select fopbal from ac_opbal where iId_grp=\"$id1\" and iIdx_op=\"$d\" and iIdx_organization=\"$or1\" and Vledger=\"$a\"");
	  $r7=fetchrow($q1);
	 
	  $s=$s+$r7[0];
	  $q2=execute("select Dr_Cr from ac_opbal where iId_grp=\"$id1\" and opdate<=\"$bd1\" and iIdx_organization=\"$or1\"");
	  $r2=fetchrow($q2);
	  $r1=fetchrow($q1);
	 //echo $r1[0];
	 
	   echo "<tr id=td1><td>$a</td>";
	  // if($id==20 || $id==21)
	 if($ct==0)
	 {
	    if($r2[0]=="Dr"){
	  ?>
      <td><?php echo $t1=$r7[0];$r7[0];$sub1=$sub1+$r7[0];?>&nbsp;</td> <td>0.00&nbsp;</td><?php }?>
	  
      <?php
	  if($r2[0]=="Cr"){
	 
	  ?>
        <td>0.00&nbsp;</td> <td><?php if($r7[0]<0){ $sub2=($sub2+$r7[0])*-1;$t2=$r7[0]*-1;}else { $sub2=($sub2+$r7[0]);}$t2=$r7[0];if($r7[0]<0){echo $r7[0]*-1;}else{ echo $r7[0];}?>&nbsp;</td><?php }
		}
		
		else
		{
		if($r7[0]>=0)
		{?>
		<td><?php if($id1==13){echo "0.00";$t1=0.00;} else {$sub1=$sub1+$r7[0];$t1=$r7[0];echo $r7[0];}?>&nbsp;</td> <td><?php  if($id1==13){echo $r7[0];$t2=$r7[0];$sub2=($sub2+$r7[0]);}else { echo "0.00"; }?>&nbsp;</td><?php }?><?php
		
		if($r7[0]<0)
		{?>
		  <td>0.00&nbsp;</td> <td><?php $sub2=($sub2+$r7[0])*-1;$t2=$r7[0]*-1;echo $r7[0]*-1;?></td><?php }?><?php
		}
		
		?>
		 
		
	 <?php
	  $q3=execute("select max(iIdx_op) from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_organization=\"$or1\" and opdate <= '".$bd2."'");
	  $r31=fetchrow($q3);
	  $q32=execute("select fopbal from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_organization=\"$or1\" and iIdx_op='$r31[0]'");
	   $r3=fetchrow($q32);
	$po=execute("select * from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_organization=\"$or1\" and iIdx_op='$r31[0]'");
	$po1=mysql_fetch_object($po);
	
	 ?>
	<!--  transaction amount-->
	
	<?php
	$dr="Dr";
	$cr="Cr";
	$dqr=execute("select max(iIdx_op) from ac_opbal where iId_grp=\"$id1\" and opdate<='$bd2' and Vledger='$a' and Dr_Cr='$dr' and iIdx_organization=\"$or1\" and iIdx_op<'$r31[0]'");
	$dq=fetchrow($dqr);
	//echo $dq[0];
	if($dq[0]=="")
	{
	$ar2=execute("select fopbal from ac_opbal where iIdx_op='$dq[0]'");
	
	// $ar3=fetchrow($ar2);
	$ar3[0]=0.00;
	}
	else
	{
	$ar2=execute("select fopbal from ac_opbal where iIdx_op='$dq[0]'");
	
	 $ar3=fetchrow($ar2);
	}
	 $dqr1=execute("select max(iIdx_op) from ac_opbal where iId_grp=\"$id1\" and opdate<='$bd2' and Vledger='$a' and Dr_Cr='$cr' and iIdx_organization=\"$or1\" and iIdx_op<'$r31[0]'");
	$dq1=fetchrow($dqr1);
	if($dq1[0]=="")
	{
	$ar21=execute("select fopbal from ac_opbal where iIdx_op='$dq1[0]'");

	 //$ar31=fetchrow($ar21);}
	 $ar31[0]=0.00;
	 }
	 else
	 {  
	 $ar21=execute("select fopbal from ac_opbal where iIdx_op='$dq1[0]'");

	$ar31=fetchrow($ar21);
	 }
	 if($r3[0]<0)
	 {
	 $t3=$r3[0];
	
//	 $t3=$t3*-1;
	 }
	 if($r3[0]>0)
	 {
	 $t4=$r3[0];
	
//	 $t4=$t4*-1;
	 }
	 if($r3[0]==0)
	 {
	 $t10=$r3[0];
	
//	 $t4=$t4*-1;
	 }
	 $t5=$t2-$t3;
	 $t6=$t1-$t4;
	
//	 {
//	 $tt1=$t5*-1;
//	  $st5=$st5+$tt1;
//	 }
//	 else
//	 {
//	  $st5=$st5+$t5;
//	 }
//	  if($t6<0)
//	 {
//	 $tt2=$t6*-1;
//	  $st6=$st6+$tt2;
//	 }
//	 else
//	 {
//	  $st6=$st6+$t6;
//	 }
	 $st5=$st5+$t5;
	  $st6=$st6+$t6;
	
	?>












<?php
	  if($r3[0]>0){
	  ?>
       <?php if($po1->iId_grp==13){$t33=0.00;} else {$t33=$r3[0];$t44=0.00;}?><?php  if($po1->iId_grp==13){$t44=$r3[0];$t33=0.00;}?><?php }?>
      <?php
	  if($r3[0]<0){
	  ?>
     <?php $t33=0.00;$t44=$r3[0];?><?php }?>
	   <?php
	   if($r3[0]==0){
	  ?>
    <?php $t33=0.00;?><?php $t44=0.00;?><?php }?>













	
	<td><?php if($t1<0){$t1=$t1*-1;}if($t33<0){$t33=$t33*-1;}$dd=$t1-$t33;if($dd<0){echo $dd*-1;}if($dd==0){echo "0.00";}if($dd>0){echo $dd;}?></td><td><?php if($t2<0){$t2=$t2*-1;}if($t44<0){$t44=$t44*-1;}$cc=$t2-$t44;if($cc<0){echo $cc*-1;;}if($cc==0){echo "0.00";}if($cc>0){ echo $cc;}$tr1=$tr1+$dd;$tr2=$tr2+$cc;?></td>
	<?php /*?><td><?php if($ar3[0]==""){echo "0.00";}else {if($id1==13){echo "0.00";}else{echo $ar3[0];}}?></td><td><?php if($id1==13){echo $ar3[0];}if($ar31[0]==""){echo "0.00";}else{ echo $ar31[0];}?></td><?php */?>
	<!--------------------------------->
	 <?php
	  if($r3[0]>0){
	  ?>
       <td><?php if($po1->iId_grp==13){echo "0.00";$t1=0.00;} else {$sub3=$sub3+$r3[0];$t1=$r3[0];echo $r3[0];}?>&nbsp;</td> <td><?php  if($po1->iId_grp==13){echo $r3[0];$t2=$r3[0];$sub4=($sub4+$r3[0]);}else { echo "0.00"; }?>&nbsp;</td><?php }?>
      <?php
	  if($r3[0]<0){
	  ?>
       <td>0.00&nbsp;</td> <td><?php $sub4=($sub4+$r3[0])*-1;$t2=$r3[0];echo $r3[0]*-1;?></td><?php }?>
	   <?php
	   if($r3[0]==0){
	  ?>
       <td><?php $sub4=($sub4+$r3[0]);$t2=$r3[0];echo $r3[0];?></td> <td><?php $sub4=($sub4+$r3[0]);$t2=$r3[0];echo $r3[0];?></td><?php }?>
	 
    </tr>
		
	  <?php
	   
	  }
	// echo $st6;
	  ?>
     
    
	
	  
	  <?php
	  if($sub1!=0 || $sub2!=0 || $sub3!=0 || $sub4!=0)
	  {
	   if($st6<0){$st61=$st6*-1; }else { $st61=$st6; }if($st5<0){ $st51=$st5*-1; }else { $st51=$st5; }if($st6==0){$st61="0.00"; }if($st5==0){ $st51="0.00"; }
	  $sub11=number_format($sub1,2); $sub22=number_format($sub2,2); $sub33=number_format($sub3,2); $sub44=number_format($sub4,2);
	  if($tr1<0){ $tr11=$tr1*-1; }else{$tr11=$tr1; }  if($tr2<0){ $tr22=$tr2*-1;}else{$tr22=$tr2; }
	  $sub55=number_format($tr11,2); $sub66=number_format($tr22,2);
	 
	  echo "<tr id=td1><td><div align=right>Subtotal:</div></td><td><b>$sub11</b></td><td><b>$sub22</b></td><td><b>$sub55</b></td><td><b>$sub66</b></td><td><b>$sub33</b></td><td><b>$sub44</b></td></tr>";
	 
	  $st7=$st7+$tr1; $st8=$st8+$tr2;
	 
	$s1=$s1+$sub1;$s2=$s2+$sub2;$s3=$s3+$sub3;$s4=$s4+$sub4;
	$s11=number_format($s1,2);$s22=number_format($s2,2);$s33=number_format($s3,2);$s44=number_format($s4,2);
	
	}
	
	  }
	    if($st7<0){$st71=$st7*-1; }else { $st71=$st7; }if($st8<0){ $st81=$st8*-1; }else{ $st81=$st8;}
		$s55=number_format($st71,2);$s66=number_format($st81,2);
	 echo "<tr id=td1><td><div align=right><b>Grand Total:<b></div></td><td><b>$s11</b></td><td><b>$s22</b></td><td><b>$s55</b></td><td><b>$s66</b></td><td><b>$s33</b></td><td><b>$s44</b></td></tr>";
	  }
	  if($ordep==2)
	  {
	  ?>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	     <?php
	   $s1=0; $s2=0; $s3=0; $s4=0;$st7=0;$st8=0; 
	$qry1=execute("select * from ac_allgroup");
	while($row1=mysql_fetch_assoc($qry1))
	{
	$id1=$row1[iIdx_grp];
	?>
   
    
	 
	  <?php
	 
	  $s=0;$sub1=0;$sub2=0;$sub3=0;$sub4=0;$t1=0;$t2=0; $t3=0;$t4=0;$st5=0;$st6=0;$tr1=0;$tr2=0;$tr3=0;$tr4=0;
	  if($mon>3)
		{
		if($chk==1)
		{
	  $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and  iIdx_organization=\"$or1\" and opdate >= '".$y21."' and opdate <= '".$bd2."' order by Vledger");
	  }
	  else
	   $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and  iIdx_organization=\"$or1\"  and opdate >= '".$y21."' and opdate <= '".$bd2."'");
	  }
	  else
	  {
	  if($chk==1)
	   $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and  iIdx_organization=\"$or1\" and   opdate >= '".$y33."' and opdate <= '".$bd2."' order by Vledger");
	   else
	   $q6=execute("select distinct(Vledger) from ac_opbal where iId_grp=\"$id1\" and  iIdx_organization=\"$or1\" and   opdate >= '".$y33."' and opdate <= '".$bd2."'");
	  }
	  while($r5=mysql_fetch_assoc($q6))
	  {
	  $a=$r5[Vledger];
	
	  ?>
	   
	  <?php
	  $klm=execute("select vgroupname from ac_allgroup where IIdx_grp='$id1'");
	  $kl=fetchrow($klm);
	  if($kl[0]!=$vc)
	  {
	    echo " <tr id=td1><td><b>$kl[0]&nbsp;</b></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		}
		else
		{
		
		}
		 $vc=$kl[0];
		/*if($mon>3)
		{*/
		//$qcnt=execute("select * from ac_opbal where iIdx_organization=\"$or1\" and  vins=\"$dep\" and Vledger=\"$a\" and opdate<'$dt1'");
				//$ct=rowcount($qcnt);
		
	/*  }
	  else
	  {
	   $qcnt=execute("select * from ac_opbal where iIdx_organization=\"$or1\" and Vledger=\"$a\" and opdate<'$dt1'");
	  $ct=rowcount($qcnt);
	  }*/
		//if($ct>0)
		//{
	 // $q5=execute("select max(iIdx_op) from ac_opbal where opdate<\"$dt1\" and iIdx_organization=\"$or1\" and  vins=\"$dep\" and Vledger=\"$a\" and iId_grp=\"$id1\"");
	 // $r6=fetchrow($q5);
	  //$d=$r6[0];
	  //}
	// else
	 //{
	 $q5=execute("select min(iIdx_op) from ac_opbal where iIdx_organization=\"$or1\" and   Vledger=\"$a\" and iId_grp=\"$id1\" and opdate>=\"$y11\" and opdate<='$y32'");
	  $r6=fetchrow($q5);
	  $d=$r6[0];
	// }
	  //echo $d;
	  
	  $q1=execute("select fopbal from ac_opbal where iId_grp=\"$id1\" and iIdx_op=\"$d\" and iIdx_organization=\"$or1\" and   Vledger=\"$a\"");
	  $r7=fetchrow($q1);
	 
	  $s=$s+$r7[0];
	  $q2=execute("select Dr_Cr from ac_opbal where iId_grp=\"$id1\" and opdate<=\"$bd1\" and iIdx_organization=\"$or1\" ");
	  $r2=fetchrow($q2);
	  $r1=fetchrow($q1);
	 //echo $r1[0];
	 
	   echo "<tr id=td1><td>$a</td>";
	  // if($id==20 || $id==21)
	 if($ct==0)
	 {
	    if($r2[0]=="Dr"){
	  ?>
      <td><?php echo $t1=$r7[0];$r7[0];$sub1=$sub1+$r7[0];?>&nbsp;</td> <td>0.00&nbsp;</td><?php }?>
	  
      <?php
	  if($r2[0]=="Cr"){
	 
	  ?>
        <td>0.00&nbsp;</td> <td><?php if($r7[0]<0){ $sub2=($sub2+$r7[0])*-1;$t2=$r7[0]*-1;}else { $sub2=($sub2+$r7[0]);}$t2=$r7[0];if($r7[0]<0){echo $r7[0]*-1;}else{ echo $r7[0];}?>&nbsp;</td><?php }
		}
		
		else
		{
		if($r7[0]>=0)
		{?>
		<td><?php if($id1==13){echo "0.00";$t1=0.00;} else {$sub1=$sub1+$r7[0];$t1=$r7[0];echo $r7[0];}?>&nbsp;</td> <td><?php  if($id1==13){echo $r7[0];$t2=$r7[0];$sub2=($sub2+$r7[0]);}else { echo "0.00"; }?>&nbsp;</td><?php }?><?php
		
		if($r7[0]<0)
		{?>
		  <td>0.00&nbsp;</td> <td><?php $sub2=($sub2+$r7[0])*-1;$t2=$r7[0]*-1;echo $r7[0]*-1;?></td><?php }?><?php
		}
		
		?>
		 
		
	 <?php
	  $q3=execute("select max(iIdx_op) from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_organization=\"$or1\" and  vins=\"$dep\" and opdate <= '".$bd2."'");
	  $r31=fetchrow($q3);
	  if($r31[0]=="")
	  {
	 
	    $q30=execute("select min(iIdx_op) from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_organization=\"$or1\" and opdate <= '".$bd2."'");
		$iidd=fetchrow($q30);
		 
	  $q32=execute("select fopbal from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_organization=\"$or1\" and iIdx_op='$iidd[0]'");
	   $r3=fetchrow($q32);
	    //echo $r3[0];
	$po=execute("select * from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_organization=\"$or1\" and iIdx_op='$iidd[0]'");
	$po1=mysql_fetch_object($po);
	  }
	  else
	  {
	  $q32=execute("select fopbal from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_organization=\"$or1\" and  vins=\"$dep\" and iIdx_op='$r31[0]'");
	   $r3=fetchrow($q32);
	$po=execute("select * from ac_opbal where iId_grp=\"$id1\" and Vledger='$a' and iIdx_organization=\"$or1\" and  vins=\"$dep\" and iIdx_op='$r31[0]'");
	$po1=mysql_fetch_object($po);
	}
	//echo $r3[0];
	 ?>
	<!--  transaction amount-->
	
	<?php
	$dr="Dr";
	$cr="Cr";
	$dqr=execute("select max(iIdx_op) from ac_opbal where iId_grp=\"$id1\" and opdate<='$bd2' and Vledger='$a' and Dr_Cr='$dr' and iIdx_organization=\"$or1\" and  vins=\"$dep\" and iIdx_op<'$r31[0]'");
	$dq=fetchrow($dqr);
	//echo $dq[0];
	if($dq[0]=="")
	{
	$ar2=execute("select fopbal from ac_opbal where iIdx_op='$dq[0]'");
	
	// $ar3=fetchrow($ar2);
	$ar3[0]=0.00;
	}
	else
	{
	$ar2=execute("select fopbal from ac_opbal where iIdx_op='$dq[0]'");
	
	 $ar3=fetchrow($ar2);
	}
	 $dqr1=execute("select max(iIdx_op) from ac_opbal where iId_grp=\"$id1\" and opdate<='$bd2' and Vledger='$a' and Dr_Cr='$cr' and iIdx_organization=\"$or1\" and  vins=\"$dep\" and iIdx_op<'$r31[0]'");
	$dq1=fetchrow($dqr1);
	if($dq1[0]=="")
	{
	$ar21=execute("select fopbal from ac_opbal where iIdx_op='$dq1[0]'");

	 //$ar31=fetchrow($ar21);}
	 $ar31[0]=0.00;
	 }
	 else
	 {  
	 $ar21=execute("select fopbal from ac_opbal where iIdx_op='$dq1[0]'");

	$ar31=fetchrow($ar21);
	 }
	 if($r3[0]<0)
	 {
	 $t3=$r3[0];
	
//	 $t3=$t3*-1;
	 }
	 if($r3[0]>0)
	 {
	 $t4=$r3[0];
	
//	 $t4=$t4*-1;
	 }
	 if($r3[0]==0)
	 {
	 $t10=$r3[0];
	
//	 $t4=$t4*-1;
	 }
	 $t5=$t2-$t3;
	 $t6=$t1-$t4;
	
//	 {
//	 $tt1=$t5*-1;
//	  $st5=$st5+$tt1;
//	 }
//	 else
//	 {
//	  $st5=$st5+$t5;
//	 }
//	  if($t6<0)
//	 {
//	 $tt2=$t6*-1;
//	  $st6=$st6+$tt2;
//	 }
//	 else
//	 {
//	  $st6=$st6+$t6;
//	 }
	 $st5=$st5+$t5;
	  $st6=$st6+$t6;
	
	?>












<?php
	  if($r3[0]>0){
	  ?>
       <?php if($po1->iId_grp==13){$t33=0.00;} else {$t33=$r3[0];$t44=0.00;}?><?php  if($po1->iId_grp==13){$t44=$r3[0];$t33=0.00;}?><?php }?>
      <?php
	  if($r3[0]<0){
	  ?>
     <?php $t33=0.00;$t44=$r3[0];?><?php }?>
	   <?php
	   if($r3[0]==0){
	  ?>
    <?php $t33=0.00;?><?php $t44=0.00;?><?php }?>









<?php
$dgf=execute("select count(*) from ac_opbal where iIdx_organization=\"$or1\" and  vins=\"$dep\"");;
$df=fetchrow($dgf);
if($df[0]==0)
{
?>
<td>0.00</td><td>0.00</td>
<?php
}
else
{
?>

	
	<td><?php if($t1<0){$t1=$t1*-1;}if($t33<0){$t33=$t33*-1;}$dd=$t1-$t33;if($dd<0){echo $dd*-1;}if($dd==0){echo "0.00";}if($dd>0){echo $dd;}?></td><td><?php if($t2<0){$t2=$t2*-1;}if($t44<0){$t44=$t44*-1;}$cc=$t2-$t44;if($cc<0){echo $cc*-1;;}if($cc==0){echo "0.00";}if($cc>0){ echo $cc;}$tr1=$tr1+$dd;$tr2=$tr2+$cc;?></td><?php } ?>
	<?php /*?><td><?php if($ar3[0]==""){echo "0.00";}else {if($id1==13){echo "0.00";}else{echo $ar3[0];}}?></td><td><?php if($id1==13){echo $ar3[0];}if($ar31[0]==""){echo "0.00";}else{ echo $ar31[0];}?></td><?php */?>
	<!--------------------------------->
	
	 <?php
	 
	  if($r3[0]>0){
	  ?>
       <td><?php if($po1->iId_grp==13){echo "0.00";$t1=0.00;} else {$sub3=$sub3+$r3[0];$t1=$r3[0];echo $r3[0];}?>&nbsp;</td> <td><?php  if($po1->iId_grp==13){echo $r3[0];$t2=$r3[0];$sub4=($sub4+$r3[0]);}else { echo "0.00"; }?>&nbsp;</td>
      <?php
}
	  if($r3[0]<0){
	 
	  ?>
       <td>0.00&nbsp;</td> <td><?php $sub4=($sub4+$r3[0])*-1;$t2=$r3[0];echo $r3[0]*-1;?></td><?php }?>
	   <?php
	   if($r3[0]==0){
	  ?>
       <td><?php $sub4=($sub4+$r3[0]);$t2=$r3[0];echo $r3[0];?></td> <td><?php $sub4=($sub4+$r3[0]);$t2=$r3[0];echo $r3[0];?></td><?php }?>
	 <?php
	
	 ?>
    </tr>
		
	  <?php
	   
	  }
	// echo $st6;
	  ?>
     
    
	
	  
	  <?php
	  if($sub1!=0 || $sub2!=0 || $sub3!=0 || $sub4!=0)
	  {
	   if($st6<0){$st61=$st6*-1; }else { $st61=$st6; }if($st5<0){ $st51=$st5*-1; }else { $st51=$st5; }if($st6==0){$st61="0.00"; }if($st5==0){ $st51="0.00"; }
	  $sub11=number_format($sub1,2); $sub22=number_format($sub2,2); $sub33=number_format($sub3,2); $sub44=number_format($sub4,2);
	  if($tr1<0){ $tr11=$tr1*-1; }else{$tr11=$tr1; }  if($tr2<0){ $tr22=$tr2*-1;}else{$tr22=$tr2; }
	  $sub55=number_format($tr11,2); $sub66=number_format($tr22,2);
	 
	  echo "<tr id=td1><td><div align=right>Subtotal:</div></td><td><b>$sub11</b></td><td><b>$sub22</b></td><td><b>$sub55</b></td><td><b>$sub66</b></td><td><b>$sub33</b></td><td><b>$sub44</b></td></tr>";
	 
	  $st7=$st7+$tr1; $st8=$st8+$tr2;
	 
	$s1=$s1+$sub1;$s2=$s2+$sub2;$s3=$s3+$sub3;$s4=$s4+$sub4;
	$s11=number_format($s1,2);$s22=number_format($s2,2);$s33=number_format($s3,2);$s44=number_format($s4,2);
	
	}
	
	  }
	    if($st7<0){$st71=$st7*-1; }else { $st71=$st7; }if($st8<0){ $st81=$st8*-1; }else{ $st81=$st8;}
		$s55=number_format($st71,2);$s66=number_format($st81,2);
	 echo "<tr id=td1><td><div align=right><b>Grand Total:<b></div></td><td><b>$s11</b></td><td><b>$s22</b></td><td><b>$s55</b></td><td><b>$s66</b></td><td><b>$s33</b></td><td><b>$s44</b></td></tr>";
	  
	 
	  }
	 
	  
	 
	 
	  





echo "</table>";
echo "</body>";
echo "</html>";
?>