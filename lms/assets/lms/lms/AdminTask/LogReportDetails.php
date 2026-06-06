<html>
<head><title>View Log Report</title>
</head>
<body class='bodyline'>

<?php

session_start();

include("../db.php");
//$date32 = $_POST['date32'];
//print_r($_POST);
$date31 = $_POST['date31'];
//$FromDate = date("Y-m-d", strtotime($FromDate));
$ToDate= $_POST['ToDate'];
//$ToDate = date("Y-m-d", strtotime($ToDate));

	
	$tempdate=explode('/',$date31);
	$FromDate = $tempdate[2]."-".$tempdate[1]."-".$tempdate[0];
	$tempdate1=explode('/',$ToDate);
	$ToDate = $tempdate1[2]."-".$tempdate1[1]."-".$tempdate1[0];



//echo "from :".$FromDate;
//echo "To :".$ToDate;
$ToDate = date("Y-m-d", strtotime($ToDate));
$FromDate = date("Y-m-d", strtotime($FromDate));

//echo "date32 : ". $ToDate ."<br>";
	$username = $_POST['username'];
	$modulename = $_POST['modulename'];
if(($username=="0") && ($modulename=="") && ($FromDate=="1970-01-01") && ($FromDate=="1970-01-01"))
{
	//echo "inside if";
	$sql="select username,address,DATE_FORMAT(accessdate,'%d-%m-%Y %H:%i:%S') as access_date,urladdress,linkname,module from log  order by accessdate DESC";
}
elseif(($username=="0") && ($modulename=="") && ($FromDate!="1970-01-01") && ($FromDate!="1970-01-01"))
{
	//echo "inside elseif1";
	$sql="select username,address,DATE_FORMAT(accessdate,'%d-%m-%Y %H:%i:%S') as access_date ,urladdress,linkname,module from log where trans_date between ";
	$sql.=" '$FromDate' and '$ToDate' order by accessdate DESC";
}
elseif(($username=="0") && ($modulename!="") && ($FromDate!="1970-01-01") && ($FromDate!="1970-01-01"))
{
	//echo "inside elseif2";
	$sql="select username,address,DATE_FORMAT(accessdate,'%d-%m-%Y %H:%i:%S') as access_date ,urladdress,linkname,module from log where  module='$modulename' and  trans_date between '$FromDate' and '$ToDate' order by accessdate DESC";
}
elseif(($username!="0") && ($modulename=="") && ($FromDate!="1970-01-01") && ($FromDate!="1970-01-01"))
{
	//echo "inside elseif2";
	$sql="select username,address,DATE_FORMAT(accessdate,'%d-%m-%Y %H:%i:%S') as access_date ,urladdress,linkname,module from log where  username='$username' and trans_date between '$FromDate' and '$ToDate' order by accessdate DESC";
}
elseif(($username=="0") && ($modulename!="") && ($FromDate=="1970-01-01") && ($FromDate=="1970-01-01"))
{
	//echo "inside elseif2";
	$sql="select username,address,DATE_FORMAT(accessdate,'%d-%m-%Y %H:%i:%S') as access_date ,urladdress,linkname,module from log where  module='$modulename' order by accessdate DESC";
}
elseif(($username!="0") && ($modulename=="") && ($FromDate=="1970-01-01") && ($FromDate=="1970-01-01"))
{
	//echo "inside elseif2";
	$sql="select username,address,DATE_FORMAT(accessdate,'%d-%m-%Y %H:%i:%S') as access_date ,urladdress,linkname,module from log where  username='$username'  order by accessdate DESC";
}

else
{
	//echo "inside elseif3";
	$sql="select username,address,DATE_FORMAT(accessdate,'%d-%m-%Y %H:%i:%S') as access_date,urladdress,linkname,module from log where module='$modulename' and username='$username' and trans_date between '$FromDate' and '$ToDate' order by accessdate DESC";
}

//echo $sql;
$rs=execute($sql) or die(error_description());
if(rowcount($rs)>0)
{
echo "<table  class='forumline' align='center' width='90%' border='1'>";
echo "<tr><td Class=head colspan=6 align=center>Detailed Log Report</td></tr>";
echo "<tr><td Class='rowpic' align='center'>Sl No</td>";
//echo "<td Class='rowpic' align='center'>Module Name</td>";
echo "<td Class='rowpic' align='center'>Link Name</td>";
echo " <td Class=rowpic align='center'>Url Path</td><td Class='rowpic' align='center'>Date & Time</td>";
echo "<td Class='rowpic' align='center'>Machine Address</td></tr>";

$slno=1;
$j=0;
for($i=0;$i<rowcount($rs);$i++)
{
	$r=fetcharray($rs,$i);
	$flag=0;
	for($j=0;$j<sizeof($uname);$j++)
	{
		
		//echo "<td align='center'>";
		if($uname[$j] == $r[username])
		{
			$flag=1;
			$username="";
		}
	}
	if($flag==0)
	{
		$uname[$j]=$r[username];
		$username=$r[username];
		echo "<tr><td  colspan=6 align=center class = 'row2'>User Name :$username</td></tr>";
	}
	if($slno%2)
		echo "        <tr class='clsname'> ";
		else
		echo "        <tr> ";
	echo "<td align='center' nowrap>&nbsp;&nbsp;$slno</td>";
	//echo "<td nowrap>&nbsp;&nbsp;$r[module]</td>";
	echo "<td  nowrap>&nbsp;&nbsp;$r[linkname]</td>";
	echo " <td  align='center' nowrap>&nbsp;&nbsp;$r[urladdress]</td>";
	echo "<td  align='center' nowrap>&nbsp;&nbsp;$r[access_date]</td>";
	echo "<td align='center' nowrap>&nbsp;&nbsp;$r[address]</td></tr>";
	$slno++;
	
}
echo "</table>";
}


//Validation has been done so that if there are no records then the below message is displayed

else
{
	echo "<br> <div align='center'>"; 
	echo "No Log Entries Found !!";
	echo "</div>";
}
?>
</body></html>
