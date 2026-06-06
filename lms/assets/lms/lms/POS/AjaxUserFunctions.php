<?
$userID =$_GET['userID'];

require "includes/dbconnect.php";// connection to database
require "includes/functions.php";
$str="";

if(!is_null($userID))
{
	// DELETE CUSTOMER_INFO FROM ALL TABLES CONCERNED


	$q=mysql_query("DELETE FROM users WHERE USER_ID = '{$userID}'");

	echo mysql_error();

	$str1 = "Success";
	$str = $str . "\"$str1\"".",";

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