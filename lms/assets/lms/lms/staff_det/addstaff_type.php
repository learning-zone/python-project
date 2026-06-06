<?php
session_start();
require("../db.php");
$sgroup = $_POST['sgroup'];
$sql1=execute("select * from staff_status where name='$sgroup'")or die(error_description());
if(rowcount($sql1)>=1)
{
	?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Duplicate Staff Type !! Cannot Save Details");
        </script>
        <?php
}else
{
$sql = "INSERT INTO staff_status (name) VALUES ('$sgroup')" ;
if($sgroup != "" && $sgroup != null){
	execute($sql);
	?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("updated Successfully");
        </script>
        <?php
	
	//or die("Please Fill the Blanks");
}
//header("Location:stafftypeadd.php");
}
?>
<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="stafftypeadd.php";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>
