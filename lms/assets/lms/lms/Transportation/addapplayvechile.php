<?php

session_start();
require("../db.php");


$weekday=$_POST['weekday'];

$pickup=$_POST['pickup'];

$route = $_POST['route'];

$vechile = $_POST['vechile'];

$driver = $_POST['driver'];

$p_time = $_POST['p_time'];

$drop_time = $_POST['drop_time'];

$check=$_POST['check'];
if($pickup=='')
{
	$pickup="0";
}

$sql=execute("select * from trans_route_vechile_details where route_id=$route and vechile_id=$vechile and weekday='$weekday'");

	if(rowcount($sql)>=1)
	{

		?>

            <script type="text/javascript">

			alert("Already applied..!!")

			</script>

            <?

		//echo "Already applied..!!";

	}
	else
	{
$sql1=execute("insert into trans_route_vechile_details(vechile_id,route_id,status,pick_t,weekday) values('$vechile','$route','1','$pickup','$weekday')");

		$maxid=fetchrow(execute("select max(id) from trans_route_vechile_details where vechile_id='$vechile' and route_id='$route' and pick_t='$pickup' and weekday='$weekday'"));	
	  	$rs123=execute("select id from trans_drop_time");
	 	while($r=fetcharray($rs123))
	 	{
			$id=$r[0];
			$pontval=$_POST['drop_time'.$id]; 
			
			
$sql_upd=execute("update trans_route_vechile_details set drop_time$r[0]='$pontval' where id='$maxid[0]'"); 
		}
  

		?>



        <SCRIPT LANGUAGE ="JavaScript">

            alert("Inserted Successfully");

        </script>

        <?php

//echo "Record Entered Succesfully";



//header("Location: applyvechile.php");



	}

?>
<html>
<head>

<SCRIPT LANGUAGE ="JavaScript">

    function reload1()

    {

        document.form1.action="applyvechile.php";

        document.form1.submit();

    }

     </script>

</head>

<body onLoad="reload1()">

 <form name="form1" method="post">

     </form>

     </body>

     </html>