<?php
session_start();
include("../db1.php");

$q=$_GET["q"];
$subject=$q;

	echo "<select name='subsubject'><option value=''>---  Select Subtitle ---</option>";
		
          $sql1=execute("SELECT * FROM `lib_book_subtitle` WHERE status=1 AND `lib_book_title_id`='$subject' ORDER BY id");
              while($r=fetcharray($sql1))
              {
                  if($subsubject==$r[id])
                      echo "<option value='$r[id]' selected>$r[subtitle]</option>";
                  else
                      echo "<option value='$r[id]' >$r[subtitle]</option>";
              }
          
          echo "</select>";
?>

