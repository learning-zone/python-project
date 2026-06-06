<?php
ini_set('register_globals', 'On'); 
	$con  = mysql_pconnect("localhost",'focuscrm_claret','claretuser!@#')
	 or die("<b>Cannot open connection to database</b>.");
	
	mysql_select_db("focuscrm_claret")	 or die("<b>could not select database</b>.");

function execute($sql)
{
	$rs = mysql_query($sql);
	return($rs);
}
?>