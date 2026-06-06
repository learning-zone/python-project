<?php

require('includes/functions.php'); //include functions
require('includes/dbconnect.php'); //include db connection

		$productID=$_REQUEST[tempid];
		mysql_query(" DELETE FROM products WHERE PRODUCT_ID='$productID'");
		header('Location: editProducts.php');
		
?>