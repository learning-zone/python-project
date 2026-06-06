<html>
<head>
<?php
session_start();
require("../db.php");
$cname=$_POST['cname'];
$ccode=$_POST['ccode'];
$caddr=$_POST['caddr'];
$pincode=$_POST['pincode'];
$cphone=$_POST['cphone'];
$cfax=$_POST['cfax'];
$cemail=$_POST['cemail'];
$ccity=$_POST['ccity'];
$cstate=$_POST['cstate'];
$cpanno=$_POST['cpanno'];
$Types=$_REQUEST['Types'];
if($Types == "Mod")
{
	$sqlstr = "Update college set col_name='" . trim($cname) . "',col_code='" . trim($ccode) . "',col_addr='" . trim($caddr) . "',col_pin='" . trim($pincode) . "',col_phone='" . trim($cphone) . "',col_fax='" . trim($cfax) . "',email='" . trim($cemail) . "',company_id='$cpanno' , col_city='$ccity' , col_state='$cstate' , col_tin='$cpanno'" ;
	execute($sqlstr) or die("Query $sql_comp :". error_description());

	$colname=strtoupper($cname);

	$coladdr=strtoupper($caddr);
	$city=strtoupper($ccity);
	$state=strtoupper($cstate);

	$sql_comp="update company set Company_Name='$colname',Address='$coladdr',City='$city',State='$state',Telephone='$cphone',fax='$cfax',Email='$cemail',PAN_No='$cpanno'";
	//execute($sql_comp) or die("Query $sql_comp :". error_description());
	echo "<font color=blue><b>Record Modified Successfully</b></font>";
	?>
    
        <?php
	//header("Location: collegeadd.php?flag_modify=1");
}
?>
 <SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="collegeadd.php?flag_modify=1";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>