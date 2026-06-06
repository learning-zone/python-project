<?php
include("../db.php");
class query
{
    var $msg1; 
	function insertmaster($mgrp1)
	{
       execute("insert into ac_groupmaster(vgrouptype) values(\"$mgrp1\")");
	   $msg1="Group name saved successfully";
	   header("location:addgroupmaster.php?msg1=$msg1");
	}

}
?>

