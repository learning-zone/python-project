<?
$prodArray1 = $_GET['prodArray1'];
$receiptNumber =$_GET['receiptNumber'];
$custName =$_GET['custName'];
$custPhone =$_GET['custPhone'];
$custEmail =$_GET['custEmail'];

$my_array = unserialize(urldecode(stripslashes($_GET['prodArray1'])));

require "includes/dbconnect.php";// connection to database
require "includes/functions.php";
$str="";

$str1 = $prodArray1[0]; //"Success";
$str = $str . "\"$str1\"".",";


if(!is_null($prodArray1))
{
	//var $str = '';
	//var $str1 = '';
/*
	for (i=0;i<$prodArray1.length;i++)
	{
			$str1 = $prodArray1[i];
			$str = $str . "\"$str1\"".",";
			$str1 = '';
	}

	$str1 = "Success";
	$str = $str . "\"$str1\"".",";
*/
}

/*
elseif(!is_null($messageID) && !is_null($orgID) && !is_null($messageType) && $messageType == 'EMAIL'){

	if(!is_null($operation) && $operation == 'HIDE'){
		$q=mysql_query("UPDATE EMAIL_MESSAGES SET HIDE='YES' WHERE ORG_ID='{$orgID}' AND EMAIL_ID = '{$messageID}'");
	}
	elseif(!is_null($operation) && $operation == 'DELETE'){

	}

}
elseif(!is_null($messageID) && !is_null($orgID) && !is_null($messageType) && $messageType == 'SMS'){

	if(!is_null($operation) && $operation == 'HIDE'){
		$q=mysql_query("UPDATE SMS_MESSAGES SET HIDE='YES' WHERE ORG_ID='{$orgID}' AND SMS_ID = '{$messageID}'");
	}
	elseif(!is_null($operation) && $operation == 'DELETE'){

	}
}
*/


$str=substr($str,0,(strLen($str)-1)); // Removing the last char , from the string
echo "new Array($str)";

?>