<?php

session_start();

require("../db.php");

$branch = $_REQUEST['branch'];

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



$sql = "select a.*,b.*,c.* from trans_route_vechile_details a,trans_vechile_master b,trans_driver_master c where a.vechile_id=b.id and a.driver_id=c.id";



$rs = execute($sql);



$num = rowcount($rs);



if($num==0)

{

echo "NO DATA FOUND";

}



?>



 <table width="90%" class='forumline' align=center border="1">

  <tr><td class="head" colspan=9 align='center'><b>Vehicle Details </b></td></tr>

    <tr class='clsname'>

    

	<td>VEHICLE REGISTRATION NUMBER</td>

	

	<?php

	for($i=0;$i<$num;$i++){

	

		$r = fetcharray($rs,$i);

?>

 <td>&nbsp;&nbsp;

  <?=$r[registration_no]?>

  </td>

<?

 }

?>

</tr><td>DRIVER NAME</td>

<?

$sql1 = "select a.*,b.*,c.* from trans_route_vechile_details a,trans_vechile_master b,trans_driver_master c where a.vechile_id=b.id and a.driver_id=c.id";



$rs1 = execute($sql1);



$num1 = rowcount($rs1);



if($num1==0)

{

echo "NO DATA FOUND";

}



	for($i1=0;$i1<$num1;$i1++){



		$r1 = fetcharray($rs1,$i1);

		?>

 <td>&nbsp;&nbsp;

  <?=$r1[driver_name]?>

  </td>

<?

 }

?>

</tr>



  <tr class='clsname'>



  <td >ROAD TAX</td>

<?php

$sqla ="select a.*,b.*,c.* from trans_route_vechile_details a,trans_vechile_master b,trans_driver_master c where a.vechile_id=b.id and a.driver_id=c.id ";



$rsa = execute($sqla);



$numa = rowcount($rsa);

	for($ia=0;$ia<$numa;$ia++){



		$ra = fetcharray($rsa,$ia);

?>



<TD>&nbsp;&nbsp;

<?=$ra[road_tax_date]?>

</td>

<?

 }

?>

 </tr>

 <tr><td>INSURANCE</td>

 <?php

$sqlb ="select a.*,b.*,c.* from trans_route_vechile_details a,trans_vechile_master b,driver_master c where a.vechile_id=b.id and a.driver_id=c.id ";



$rsb= execute($sqlb);



$numb = rowcount($rsb);

	for($ib=0;$ib<$numb;$ib++){



		$rb = fetcharray($rsb,$ib);

?>



<TD>&nbsp;&nbsp;

<?=$rb[insurance_date]?>

</td>

<?

 }

?>



   



  </tr>

  <tr class='clsname'> <td>FC</td>

  <?php

$sqlc ="select a.*,b.*,c.* from trans_route_vechile_details a,trans_vechile_master b,driver_master c where a.vechile_id=b.id and a.driver_id=c.id ";



$rsc = execute($sqlc);



$numc = rowcount($rsc);

	for($ic=0;$ic<$numc;$ic++){



		$rc = fetcharray($rsc,$ic);

?>



<TD>&nbsp;&nbsp;

<?=$rc[fittness_date]?>

</td>

<?

 }

?>

  </tr>

<tr> <td>PERMIT</td>

<?php

$sqld = "select a.*,b.*,c.* from trans_route_vechile_details a,trans_vechile_master b,trans_driver_master c where a.vechile_id=b.id and a.driver_id=c.id";



$rsd = execute($sqld);



$numd = rowcount($rsd);

	for($id=0;$id<$numd;$id++){



		$rd = fetcharray($rsd,$id);

?>



<TD>&nbsp;&nbsp;

<?=$rd[permit]?>

</td>

<?

 }

?>

</tr>

</table>



<br>

<div id=pr1 align=center><INPUT TYPE="button" NAME="print" class='bgbutton' VALUE="PRINT THE REPORT" OnClick="prn()"></div>



