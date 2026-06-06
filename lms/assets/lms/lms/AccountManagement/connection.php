<?php
$host="localhost";
$username="root";
$password="";
$database="renew_mbis";
$con=mysql_connect($host,$username,$password);
 if ($con)
    {
        mysql_select_db($database,$con) or die(mysql_error());
    }
    else
    {
       echo 'Connection failed.';
    }
    
    

?>