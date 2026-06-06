<?php
session_start();
$name=$_SESSION['name'];
	    	$tp=$_SESSION['type'];
			$org=$_SESSION['org'];
			$ins=$_SESSION['ins'];
			$ut=$_SESSION['ut'];
			$tran=$_SESSION['tran'];
			$dab=$_SESSION['dab'];
			$bab=$_SESSION['bab'];
			$cab=$_SESSION['cab'];
			$leb=$_SESSION['leb'];
			$trib=$_SESSION['trib'];
			$pl=$_SESSION['pl'];
			$bash=$_SESSION['bash'];
			$chp=$_SESSION['chp'];
			$cmast=$_SESSION['cmast'];
			$cgp=$_SESSION['cgp'];
			$cvch=$_SESSION['cvch'];
			$cled=$_SESSION['cled'];
			$cdep=$_SESSION['cdep'];
			$cjob=$_SESSION['cjob'];
			$addemp=$_SESSION['addemp'];
			$addatt=$_SESSION['addatt'];
			$addsal=$_SESSION['addsal'];
			$ine=$_SESSION['inex'];
?>
 <div id="categories">
        <ul id="identifier">
		<li><a href="home.php">Home</a></li>
			<?php if($tran==1) { ?><li><a href="createvoucher2.php">Transactions</a></li><?php } ?>
		   <li><a href="#">Settings</a>
			   <ul>
			     
			      	<?php if($cmast==1) { ?><li><a href="viewmastergroups.php">Master Groups</a></li><?php } ?>
				   	<?php if($cgp==1) { ?><li><a href="addgroups.php">Groups</a></li><?php } ?>
				  	<!-- <?php if($cvch==1) { ?> <li><a href="addvouchermaster.php">Voucher Types</a></li><?php } ?> -->
				   	<?php if($cled==1) { ?><li><a href="addledger.php">Ledgers</a></li><?php } ?>
			  </ul>
		   </li>
		 <!--  <li><a href="#">Display</a>
			  <ul>
				   <li><a href="viewmastergroups.php">Master Groups</a></li>
				   <li><a href="viewgroups.php">Groups</a></li>
				   <li><a href="viewledgers.php">Ledgers</a></li>
				   <li><a href="viewvouchermaster.php">Voucher Types</a></li>
			  </ul>
		   </li>-->
		   <li><a href="#">Reports</a>
			  <ul>
				   <?php if($dab==1) { ?><li><a href="viewdaybook.php">Day Book</a></li><?php } ?>
				   <?php if($bab==1) { ?><li><a href="bankbook.php">Bank Book</a></li><?php } ?>
				   <?php if($cab==1) { ?> <li><a href="cashbook.php">Cash Book</a></li><?php } ?>
				  <?php if($leb==1) { ?> <li><a href="ledgerbook.php">Ledger Book</a></li><?php } ?>
				   <?php if($trib==1) { ?><li><a href="trialbalance.php">Trial Balance</a></li><?php } ?>
			  </ul>
		   </li>
		   <li><a href="#">Final Account</a>
			  <ul>
				   <?php if($pl==1) { ?><li><a href="profitloss.php">Profit & Loss</a></li><?php } ?>
				   <?php if($bash==1) { ?><li><a href="balancesheet.php">Balance Sheet</a></li><?php } ?>
				   <?php if($ine==1) { ?> <li><a href="incomeexpense.php">Income/Expense</a></li><?php } ?>
			  </ul>
		   </li>
		   <?php if($chp==1) { ?><li ><a href="changepassword.php">Change Password</a>		   </li><?php } ?>
		  <li ><a href="#">Payroll</a>		   
		   <ul>
		   <?php /*?> <?php if($cdep==1) { ?><li ><a href="payroll/adddepartment.php">Institution</a>		   </li><?php } ?><?php */?>
			  <?php if($cjob==1) { ?><li ><a href="payroll/adddesignation.php">Designation</a>		   </li><?php } ?>
			   <?php if($addemp==1) { ?> <li ><a href="payroll/addemp1.php">Employees</a>		   </li><?php } ?>
				  <?php if($addatt==1) { ?><li ><a href="payroll/attendance.php">Attendance</a>		   </li><?php } ?>
				    <?php if($addsal==1) { ?><li ><a href="payroll/salarypayment1.php">Salary</a>		   </li><?php } ?>
					 <li ><a href="payroll/report.php">Reports</a>		   </li>
		   </ul></li>
		    <li ><a href="help.php">Help</a></li>
		  <li ><a style="border-bottom:1px solid #696969;">&nbsp;</a>		   </li>
		</ul>
		
      </div>