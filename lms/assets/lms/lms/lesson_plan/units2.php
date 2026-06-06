<html>
<head><?php
session_start();
require("../db.php");
$Types=$_REQUEST['Types'];
$rid=$_POST['rid'];

if( is_array($rid) )
{
	while( list(,$Value) = each($rid) )
	{
		$RName =$_POST['RName'.$Value];

		if(strtoupper($Types) == "MOD")
		{
			$sql=execute("select * from lms_units where unit_name='$RName' ") ;
            if(rowcount($sql)>=1)
			{
				?>
                <script language="javascript">
				alert("Duplicate Unit Name!!");
                </script>
                <?
			}
			elseif(trim($RName)!='')
			{
				
				$sqlstr = execute("Update lms_units set unit_name='" .trim($RName) . "'  where id=" .trim($Value));
				?>
                <script language="javascript">
				alert("Updated successfully  ");
                </script>
                <?

			}
			else
			{
				?>
                <script language="javascript">
				alert("Unit Name Can not be Empty");
                </script>
                <?
				
			}
		}
	}
}
else
{
	?>
	<script language="javascript">
	alert("Please Follow Proper Procedure");
	</script>
	<?
	
}

?><SCRIPT LANGUAGE ="JavaScript">
	function reload1()
	{
    document.form1.action="units.php?msg=$msg";
	 document.form1.submit();
	 }
	 </script>
</head>
<body onLoad="reload1()" >
 <form name="form1" method="post">
     </form>
     </body>
     </html>