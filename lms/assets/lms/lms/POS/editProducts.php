<?php

require('includes/functions.php'); //include functions
require('../db.php'); //include db connection
//require('class.datagrid.php');
include('ps_pagination.php');

$userID = $_SESSION['userID'];
$userFullName = $_SESSION['userName'];
$privID = $_SESSION['privID'];

?>

<script language="javascript" type="text/javascript">

	function confirmSubmit(productID)
	{
	//alert("INSIDE");
	var agree=confirm("Are you sure you want to delete?");
	if (agree){
	
		window.sendMsg.action="updt1.php?tempid="+productID;
		document.sendMsg.submit();
	}
	else
		return false ;
	}

	function confirmSubmit1(serviceID)
	{
	//alert("INSIDE");
	var agree=confirm("Are you sure you wish to delete?");
	if (agree){
		deleteService(serviceID);
		return true ;
	}
	else
		return false ;
	}

	function deleteProduct(productID)
	{

		var httpxml;
		try
		  {
			  // Firefox, Opera 8.0+, Safari
			  httpxml=new XMLHttpRequest();
		  }
		  catch (e)
		  {
			 // Internet Explorer
			  try
				{
					httpxml=new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e)
				{
					try
						{
							httpxml=new ActiveXObject("Microsoft.XMLHTTP");
						}
						catch (e)
						{
							alert("Your browser does not support AJAX!");
							return false;
						}
				}
		  }
		function stateck()
		{
			if(httpxml.readyState==4)
			{
				var myarray=eval(httpxml.responseText);
				alert(myarray);
				location.reload(true);
			}
		}
		//alert(document.testform.orgID.value);
		//alert(prod_id_ref);
		var url="AjaxCustomerFunctions.php";
		url=url+"?productID="+productID;
		url=url+"&sid="+Math.random();
		httpxml.onreadystatechange=stateck;
		httpxml.open("GET",url,true);
		httpxml.send(null);
	  }

	function deleteService(serviceID)
	{

		var httpxml;
		try
		  {
			  // Firefox, Opera 8.0+, Safari
			  httpxml=new XMLHttpRequest();
		  }
		  catch (e)
		  {
			 // Internet Explorer
			  try
				{
					httpxml=new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch (e)
				{
					try
						{
							httpxml=new ActiveXObject("Microsoft.XMLHTTP");
						}
						catch (e)
						{
							alert("Your browser does not support AJAX!");
							return false;
						}
				}
		  }
		function stateck()
		{
			if(httpxml.readyState==4)
			{
				var myarray=eval(httpxml.responseText);

				location.reload(true);
			}
		}
		//alert(document.testform.orgID.value);
		//alert(prod_id_ref);
		var url="AjaxCustomerFunctions.php";
		url=url+"?serviceID="+serviceID;
		url=url+"&sid="+Math.random();
		httpxml.onreadystatechange=stateck;
		httpxml.open("GET",url,true);
		httpxml.send(null);
	  }


</script>

<html>
  <head>
    <title>Edit Products</title>
  </head>
  <body>
    				<?php
						$error = array();
						// GET 'PRODUCT ID'

								$queryStatement = "SELECT * FROM products WHERE CATEGORY=1 ORDER BY PRODUCT_NAME ASC";

								//print $queryStatement;

								/**----------------------------------------------------
								Pagination Implementation
								---------------------------------------------------- **/
								$paramValues = "status=".$status;
								$pager = new PS_Pagination($con, $queryStatement, 200, 5, $paramValues);
								$pager->setDebug(true);

								$searchProductQuery = $pager->paginate();
								if($searchProductQuery){
								//print "abc";
								?>
										<form name="sendMsg" method="post" action="">
										
												<table align="center" width="70%" border="0">
													<tr>
                                                    	<td class="head" colspan="4" align="center">
                                                        	Products
                                                        </td>
                                                    </tr>
                                                    <tr >
														<td width="15%" class="row3">
															<b>Code</b>
														</td>
														<td width="50%" class="row3">
															<b>Product</b>
														</td>
														<td width="15%" class="row3">
															<b>Price</b>
														</td>
														<td width="20%" class="row3">
															<b>Edit/Delete</b>
														</td>
													</tr>
														<?php
															$i = 1;
															while ($row = mysql_fetch_array($searchProductQuery, MYSQL_ASSOC)) {
																$i++;
																$bcolor = '#FFFFFF';
																if($i%2 == 0){
																	$bcolor = '#C3D9FF';
																}
																print "<tr bgcolor=".$bcolor.">";
																print "<td>&nbsp;".$row["PRODUCT_CODE"] ."</td> \n";
																print "<td>&nbsp;".$row["PRODUCT_NAME"] . "</td> \n";
																print "<td>&nbsp;".$row["AMOUNT"] . "</td> \n";
														?>
																<td>
																	<a href="javascript:void(0)" onClick="window.open('editProductInfo.php?productID=<?php echo $row['PRODUCT_ID']; ?>','editproducts', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false">&nbsp;<b>EDIT</b></a>
																	&nbsp;/&nbsp;
																	<a href='#' onClick="return confirmSubmit(<?php echo $row['PRODUCT_ID']; ?>)"><b> DELETE </b></a>
																</td>
														<?php
																print "</tr>";
															}
															mysql_free_result($searchProductQuery);
														?>
													<tr>
															<td colspan="8" width="100%">&nbsp;
																
															</td>
													</tr>
													<tr>
														<td colspan="8" width="100%">&nbsp;
															
														</td>
													</tr>
												</table>
									</form>
	
								<?php
								}
								else{
								?>
												<table width="100%" border="0">
													<tr>
															<td width="100%">&nbsp;
																
															</td>
													</tr>
													<tr>
														<td width="100%">
															<b>No Products Found</b>
														</td>
													</tr>
												</table>
								<?php
								}
						?>
  </body>
</html>
