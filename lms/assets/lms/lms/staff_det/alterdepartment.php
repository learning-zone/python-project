<html>
<head>
<?php
session_start();
require("../db.php");
$Types = $_REQUEST['Types'];

$sdept = $_POST['sdept'];
$dcode = $_POST['dcode'];
$sgid = $_POST['sgid'];
$sgName = $_POST['sgName'];
$DCode = $_POST['DCode'];
if ($Types=="Mod" || $Types=="Del")
{
	if(is_array($sgid))
	{
		while(list(,$Value) = each($sgid))
		{
		//$mnamem = "sgName$Value";
		//$mNamem = $$mnamem;
		$mNamem = $_POST["sgName".$Value];
		//$d_code="DCode".$Value;
		//$DCode=$$d_code;
		$DCode = $_POST["DCode".$Value];
		//echo"select * from dept_no where dpt_id='$Value'";
		if($Types == "Mod")
		{
			$sql2=execute("select * from dept_no where Dept='".strtoupper($mNamem)."' and status=1");// or die(error_description());
			if (rowcount($sql2)>=1 )
			{
				$r_sql2=fetcharray($sql2);
				if($r_sql2[dept_code]==$DCode)
				{
					$sql="Update dept_no set Dept ='".strtoupper($mNamem)."',dept_code='".strtoupper($DCode)."' where dpt_id=$Value";
					if(mysql_query($sql))
					{
						//$msg_upd = 'ok';
						?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Updated Successfully");
        </script>
        <?php
					}
					else 
					{
						//die("Cannot alter department  table!1"); 
						}
				}
				else
				{
					$sql22=execute("select * from dept_no where dept_code='".strtoupper($DCode)."'");
					// or die(error_description());
					if(rowcount($sql22)>=1)
					{
						//header("Location:departmentadd.php?msg_dup=ok");
						//die();
					}
					
				}
			}
			$sql="Update dept_no set Dept ='".strtoupper($mNamem)."',dept_code='".strtoupper($DCode)."' where dpt_id=$Value";
			if(mysql_query($sql))
			{
				//$msg_upd = 'ok'; 
				?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Updated Successfully");
        </script>
        <?php
			} 
			else { 
			//die("Cannot alter department  table!1");
			}
		}
		else
		{
			if(strtoupper($Types) == "DEL")
			{
				$sql = "update	dept_no set status = 0 WHERE dpt_id = $Value";
				if(mysql_query($sql)){ $msg_del = 'ok'; }
				else{
					//die("Cannot alter department  table!1");
					}
			}
		}
		header("Location:departmentadd.php?msg_upd=$msg_upd");
	}
	
}
else
{
	//die("<font color=red><b>Please follow Proper Procedure</b></font>");
	?>
        <SCRIPT LANGUAGE ="JavaScript">
            alert("Please follow Proper Procedure");
        </script>
        <?php
}
//exit();
}
elseif ($Types=="Act")
{
	while(list(,$Value) = each($dname))
	{ 
		if($Types == "Act")
		{
			$sql="Update dept_no set status=1 where dpt_id=$Value";
			execute($sql); //or die("Cannot alter department  table!1");
		}
		//header("Location:departmentadd.php");
		//exit();
	}
}

?>
<SCRIPT LANGUAGE ="JavaScript">
    function reload1()
    {
        document.form1.action="departmentadd.php";
        document.form1.submit();
    }
     </script>
</head>
<body onLoad="reload1()">
 <form name="form1" method="post">
     </form>
     </body>
     </html>