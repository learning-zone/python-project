<?php

		require('includes/functions.php'); //include functions
		require('includes/dbconnect.php'); //include db connection
		$description=$_POST['description'];
		$qty=$_POST['qty'];
		$amount=$_POST['amount'];
		$subTotal=$_POST['subTotal'];
		$discountAmount=$_POST['discountAmount'];
		$serviceTaxAmount=$_POST['serviceTaxAmount'];
		$attendedBy=$_POST['attendedBy'];
		$total=$_POST['total'];
		$category=$_POST['category'];
		 
		mysql_query( "INSERT INTO temp_rec(DESCRIPTION,QTY,AMOUNT,SUBTOTAL,DISCOUNTAMOUNT,SERVICETAXAMOUNT,ATTENDEDBY,TOTAL,USERNAME)
			VALUES('$description','$qty','$amount','$subTotal','$discountAmount','$serviceTaxAmount','$attendedBy','$total','$attendedBy')");
		header('Location: generateReceipt.php?stud_id='.$attendedBy.'&&cat='.$category.'');

?>