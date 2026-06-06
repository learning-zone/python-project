<?php

require('../db.php'); //include db connection
include('ps_pagination.php');
?>

<script language="javascript" type="text/javascript">

	function confirmSubmit(productID)
	{
	alert("INSIDE");
	var agree=confirm("Are you sure you wish to delete?");
	if (agree){
		deleteProduct(productID);
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

</script>

<html>
  <head>
    <title>Edit Products</title>
	<link href="newStyles.css" rel="stylesheet" type="text/css" />
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
								$pager = new PS_Pagination($con, $queryStatement, 25, 5, $paramValues);
								$pager->setDebug(true);

								$searchProductQuery = $pager->paginate();
								if($searchProductQuery){
								//print "abc";
								?>
										<form name="sendMsg" method="post" action="">
										<br>
												<table align="center" class="boxtable" width="80%" border="0">
													<tr>
                                                    	<td align="center" class="head" colspan="5">Products/Services</td>
                                                    </tr>
                                                    <tr >
                                                    
														<td width="10%" class="row3">
															<b>Code</b>
														</td>
														<td width="50%" class="row3">
															<b>Name/Description</b>
														</td>
														<td width="10%" class="row3">
															<b>Amount</b>
														</td>
														<td width="15%" class="row3">
															<b>In Stock</b>
														</td>
														<td width="15%" class="row3">
															<b>Add Inventory</b>
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
																print "<td>&nbsp;".$row["QUANTITY"] . "</td> \n";
														?>
																<td>
																	<a href="javascript:void(0)" onClick="window.open('addNewInventory.php?productID=<?php echo $row['PRODUCT_ID']; ?>','addnewinventory', 'resizable=yes, scrollbars=yes, height=300, width=300'); return false">&nbsp;<b>ADD</b></a>
																	&nbsp;
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
														<td class="bottomtopborder" colspan="8" width="100%" align="center">
															<?php
																//Display the full navigation in one go
																echo $pager->renderFullNav();
																echo "<br/>\n";
															?>
														</tr>
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
													<tr>
														<td width="100%">
															<b>No Products/Services Found</b>
														</td>
													</tr>
												</table>
											
								<?php
								}
						?>
  </body>
</html>
