<?php
	session_start();
	$Types=$_REQUEST['Types'];
	require("../db1.php");
	$cid=$_POST['cid'];
      if( is_array($cid) )
        {
		while( list(,$Value) = each($cid) )
		{
			$Cname =$_POST['CName'.$Value];
			if($Types == "Mod")
			{
				$sqlstr = "Update certificate_m set name='" . trim($Cname) . "' where id=" . trim($Value) ;
			}
			elseif($Types =="Del")
			{
				$sqlstr = "Update certificate_m set status=0 where id=" . trim($Value) ;
			}

			execute($sqlstr) or die("Cannot alter certificate_m table!");
		}

	}

if($Types == "Act")
		{
		$ctname=$_POST['ctname'];
		while(list($key,$value) = each($ctname))
			{

				$sqlstr = "Update certificate_m set status=1 where id=" . trim($value) ;

				execute($sqlstr) or die ("canot activate");


			}

	}

/*
 Redirect to courseadd.php

 IMPORTANT: output_buffering is to be turned on ... refer to php.ini file.

*/
	header("Location:ViewCertificate.php");


?>

