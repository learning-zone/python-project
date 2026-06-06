<?php


/*
if($_SESSION['userID'] == null)
{
	header('Location: login.php');
}
*/
// Breadcrumb

//include("./Breadcrumb.php");
//$trail = new Breadcrumb();
//$trail->add('Customer Reports', customerReports, 1);

// END of Breadcrumb


require('includes/functions.php'); //include functions
require('includes/dbconnect.php'); //include db connection
//require('class.datagrid.php');
include('ps_pagination.php');

$userID = $_SESSION['userID'];
$userFullName = $_SESSION['userName'];
$privID = $_SESSION['privID'];

?>

<script language="javascript" type="text/javascript">

	function confirmSubmit(userID)
	{
	//alert("INSIDE");
	var agree=confirm("Are you sure you wish to delete?");
	if (agree){
		deleteUser(userID);
		return true ;
	}
	else
		return false ;
	}

	function deleteUser(userID)
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
		var url="AjaxUserFunctions.php";
		url=url+"?userID="+userID;
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
<?php //include "validUserHeader.php"; ?>
<table width="100%" border="0" cellpadding=0 cellspacing=0>
  	<tr>
  		<td class="bottomborder" colspan="2" height="22" valign="top">
  		<?php include "topMenu.php"; ?> <!--<script SRC="JS/myCRM_Top_Menu.js"></script>-->
  		</td>
  	</tr>
    <tr>
    	<!--
	   <td width="10%" height="400" border="1" valign="top">
			&nbsp;
        </td>
        -->
        <td width="100%" height="350" valign="top"><!-- Center of the page -->
            <table width="100%">
				<tr>
					<td align="left">
						&nbsp;
					</td>
				</tr>
					<?php
						$error = array();
						// GET 'PRODUCT ID'

								$queryStatement = "SELECT * FROM users ORDER BY FIRST_NAME ASC";

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
								<tr>
									<td width="100%">
										<form name="sendMsg" method="post" action="">
										<div>
											<fieldset>
											<legend><font style='font:normal 14px verdana'><b>Staff</b></font> </legend>
												<table class="boxtable" width="100%" border="0">
													<tr bgcolor="#3C74E6">
														<td width="5%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>ID</b></font>
														</td>
														<td width="20%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>Name</b></font>
														</td>
														<td width="10%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>Phone</b></font>
														</td>
														<td width="15%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>Email</b></font>
														</td>
														<td width="25%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>Address</b></font>
														</td>
														<!--
														<td width="15%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>Amount</b></font>
														</td>
														-->
														<td width="10%">
															<font style="font:normal 10px verdana; color:#FFFFFF"><b>Edit/Delete</b></font>
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
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["USER_ID"] ."</font></td> \n";
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["FIRST_NAME"] .' ' .$row["LAST_NAME"].  "</font></td> \n";
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["PHONE"] . "</font></td> \n";
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["EMAIL"] . "</font></td> \n";
																print "<td><font style='font:normal 9px verdana'>&nbsp;".$row["ADDRESS"] . "</font></td> \n";
														?>
																<td>
																	<a href="javascript:void(0)" onClick="window.open('editStaffInfo.php?userID=<?php echo $row['USER_ID']; ?>','editstaff', 'resizable=yes, scrollbars=yes, height=400, width=600'); return false"><font style='font:normal 9px verdana'>&nbsp;<b>EDIT</b></font></a>
																	&nbsp;/&nbsp;
																	<a href='#' onClick="return confirmSubmit(<?php echo $row['USER_ID']; ?>)"><font style='font:normal 9px verdana'><b> DELETE </b></font></a>
																</td>
														<?php
																print "</tr>";
															}
															mysql_free_result($searchProductQuery);
														?>
													<tr>
															<td colspan="8" width="100%">
																&nbsp;
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
														<td colspan="8" width="100%">
															&nbsp;
														</td>
													</tr>
												</table>
											</fieldset>
										</div>
									</form>
									</td>
								</tr>

								<?php
								}
								else{
								?>
								<tr>
									<td width="100%">
										<div style='width:750; cellpadding:20'>
											<fieldset>
											<legend> <font style="font:normal 14px verdana"><b>Reports</b></font> </legend>
												<table width="100%" border="0">
													<tr>
															<td width="100%">
																&nbsp;
															</td>
													</tr>
													<tr>
														<td width="100%">
															<font style="font:normal 12px verdana"><b>No Products/Services Found</b></font>
														</td>
													</tr>
												</table>
											</fieldset>
										</div>
									</td>
								</tr>
								<?php
								}
						?>
                </tr>
            </table>

        </td>
    </tr>
  </table>
  </body>
</html>
