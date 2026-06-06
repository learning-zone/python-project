<?php

session_start();

require("../db.php");

$mid = $_POST['mid'];

$RCode= $_POST['RCode'];

$RName= $_POST['RName'];

$RDistance= $_POST['RDistance'];

$Types = $_REQUEST['Types'];

while( list(,$value) = each($mid))

{

	if(strtoupper($Types) == "MOD")

	{

		$sql = "Update trans_route_master set route_code='$RCode[$value]',route_name='$RName[$value]',distance='$RDistance[$value]' where id=$value";

		execute($sql);

		?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Updated Sudccessfully");

        </script>

        <?php

	}
    
	if(strtoupper($Types) == "DEL")

	{

		$sql1 = "INSERT into trans_route_master_del SELECT * from trans_route_master WHERE id=$value";
		execute($sql1);
		$sql2 = "delete from trans_route_master where id=$value";

		execute($sql2);

		?>

        <SCRIPT LANGUAGE ="JavaScript">

            alert("Deleted Sudccessfully");

        </script>

        <?php

	}
}

//header("Location: add_route_master.php?msg=Updated details...");

?>
<!DOCTYPE html>
<html>
<head>
<SCRIPT LANGUAGE ="JavaScript">

    function reload1()

    {

        document.form1.action="add_route_master.php";

        document.form1.submit();

    }

     </script>

</head>

<body onLoad="reload1()">

 <form name="form1" method="post">

     </form>

     </body>

     </html>