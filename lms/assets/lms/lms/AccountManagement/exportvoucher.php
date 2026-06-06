<?php
session_start();
$name=$_SESSION['name'];
$or1=$_SESSION['ior'];
$ins=$_SESSION['ins'];
$org=$_SESSION['org'];
$tp=$_SESSION['type'];
if($tp=='a')
{
$or1=$_SESSION['bdtr'];
//echo $or1;
}
include("../db.php");
$bd1=$_SESSION['bdt1'];
$bd2=$_SESSION['bdt2'];
$dt11=date('d-m-Y',strtotime($bd1));
$dt22=date('d-m-Y',strtotime($bd2));
$qqr=execute("select vorgname from ac_organization where iIdx_organization='$or1'");
$qqr1=fetchrow($qqr);
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=voucherentries.doc");
header("Pragma: no-cache");
header("Expires: 0");
echo "<html>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
echo "<body>";
echo "<b><table border=1 style=border:thin>";
 echo "<tr>
                <td colspan=8><div align=center><div align=left>$qqr1[0]</div>       
            DAY BOOK From  $dt11 To $dt22</div></td><td></td><td></td>
        </tr>
              <tr>
                <td width=137 ><strong>Date</strong></td> <td width=137 ><strong>Bill NO:</strong></td> <td width=137 ><strong>Bill Date</strong></td>
        <td width=156><strong>Particulars</strong></td>
        <td width=156><strong>Voucher Type </strong></td>
        <td width=141><strong>Voucher Number </strong></td>
		<td width=119><strong>Cheque/DD No:</strong></td>
        <td width=133><strong>Cheque/DD Date:</strong></td>
        <td width=119><strong>Debit</strong></td>
        <td width=133><strong>Credit</strong></td>
		
      </tr>";
             
	$qry=execute("select * from ac_voucher where iIdx_organization=\"$or1\" and ddate between \"$bd1\" and \"$bd2\""); 
		while($row1=mysql_fetch_assoc($qry))
	{
	?>
              <tr id="td1">
                <?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td><?php } else {?>
                <td><?php echo date('d-m-Y',strtotime($row1[ddate])); ?>&nbsp;</td><?php } ?>
				
				  <?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td><?php } else {?>
                <td><?php echo $row1[vbillno]; ?>&nbsp;</td><?php } ?>
				
				  <?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td><?php } else {?>
                <td><?php echo $row1[dbilldate]; ?>&nbsp;</td><?php } ?>
				
				
                <td><?php echo $row1[acc]; ?>&nbsp;</td>
	    <?php
	  $qryy=execute("select * from ac_vouchermaster where iIdx_vouchermaster=\"$row1[iIdx_vouchermaster]\"");
	  $o=mysql_fetch_object($qryy);
	  ?>
                <?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td><?php } else {?>
                <td><?php echo $o->vvouchertype; ?>&nbsp;</td><?php } ?>
				
                <?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td></td><?php } else {?>
                <td><?php echo $row1[vvoucherno]; ?>&nbsp;</td><?php } ?>
				
				<?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td><?php echo $row1[chequedd_no]; ?></td><?php } else {?>
                <td><?php echo $row1[chequedd_no]; ?>&nbsp;</td><?php } ?>
				
				<?php if($row1[vvoucherno]==$v1 && $row1[iIdx_vouchermaster]==$v2) {?><td><?php echo $row1[chequedd_date]; ?></td><?php } else {?>
                <td><?php echo $row1[chequedd_date]; ?>&nbsp;</td><?php } ?>
				
                <td><?php echo $row1[fdebit]; ?>&nbsp;</td>
        <td><?php if($row1[fcredit]<0){ ?><font color="#FF0000"><?php echo $row1[fcredit]; ?></font><?php } else {echo $row1[fcredit]; }?>&nbsp;</td>
		
	   <?php
		if($tp=='a')
		{
	?>
                
                
              </tr>
              <?php
	$v1=$row1[vvoucherno];
	$v2=$row1[iIdx_vouchermaster];
	}
	}
	echo "</table>";
	echo "</body>";
	echo "</html>";
	
	?>
	