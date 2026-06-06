<?php
session_start();
require("../db.php");
if($Types=='Add')
{
$ret=execute("select id from users where username='$user' ");
$a=fetcharray($ret);
$sql=execute("insert into tempreqindent(dept,agroup,aname,qty,user) values($dept,$agroup,$adesc,$qty,$a[0])") or die("<font color='red'><b>Value not inserted</b></font><a href='RequirementIndent.php'>Back</a>'");
if($sql)
{
	header("Location:RequirementIndent.php");
}
}
?>
<?php
if(is_array($id) )
{
	while( list(,$Value) = each($id) )
	{
		$agroup = "agroup" . $Value;
		$IName = $_POST[$agroup];
		if($IName=="")
		{
		  die("<font color=red><b>Asset Group should not to be Blank</b></font><br>");
		}
		$adesc = "adesc" . $Value;
		$IAame = $_POST[$adesc];
	
		if($IAame=="")
		{
		  die("<font color=red><b>Asset Abbreviation should not to be Blank</b></font><br>");
		}

		$dept = "dept" . $Value;
		$Deptn = $_POST[$dept];
	
		if($Deptn=="")
		{
		  die("<font color=red><b>Department should not to be Blank</b></font><br>");
		}
		$qty = "qty" . $Value;
		$Qnty = $_POST[$qty];
	
		if($Qnty=="")
		{
		  die("<font color=red><b>Quantity should not to be Blank</b></font><br>");
		}

	    if($Types=="Mod")
		{
			echo $adesc1;
            $sqlstr = "Update tempreqindent set agroup=$IName,aname=$IAame,dept=$Deptn,qty=$Qnty where id=$Value";
			$x=execute($sqlstr);
			if($x)
			{
				header("Location:RequirementIndent.php");
			}
		
        }
		 if($Types=="Del")
		{
			echo $adesc1;
            $sqlstr = "delete from tempreqindent where id=$Value";
			$x=execute($sqlstr);
			if($x)
			{
				header("Location:RequirementIndent.php");
			}
		
        }

	}
	
}
?>