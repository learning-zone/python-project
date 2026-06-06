<?php

include("../db.php");

?>

<!DOCTYPE html >
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title> School Announcement</title>



<script language="javascript">

function OpenWind(k)

{

	var finalVar;

	finalVar=k;

	window.open(finalVar,'Stud','height=700,width=1000,status=yes,toolbar=no,scrollbars=yes,menubar=no,location=no');

}

function showdetails(str)

{

	

	var xmlhttp;

	if (str=="")

	  {

	  document.getElementById("txtHint").innerHTML="";

	  return;

	  }

	if (window.XMLHttpRequest)

	  {// code for IE7+, Firefox, Chrome, Opera, Safari

	  xmlhttp=new XMLHttpRequest();

	  }

	else

	  {// code for IE6, IE5

	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

	  }

	xmlhttp.onreadystatechange=function()

	  {

	  if (xmlhttp.readyState==4 && xmlhttp.status==200)

		{

			document.getElementById("txtHint").innerHTML=xmlhttp.responseText;

		}

	  }

	xmlhttp.open("GET","announce.php?q="+str,true);

	xmlhttp.send();

	

}

</script>

</head>



<body >



<br><br>

<table width="960" align="center" border="1" cellpadding="5" cellspacing="15">

    <tr>

    	<td align="center" class="head" colspan="2">

        	School Announcement

        </td>

    </tr>

    <tr>

   	    <td width="480">

                <div style="height:454px; overflow:auto;">

                    <table border="0" width="480" cellpadding="0" cellspacing="0">

                    <?php

//code starts 

$sql1=execute("SELECT *  FROM `announcement_class` where grade=0 order by fromdate desc");

while($r1=fetcharray($sql1))

{

	$sql2=execute("SELECT * FROM `announcement_class` where id='$r1[id]'");

	while($r2=fetcharray($sql2))

	{

		

		$fd=explode('-',$r2[fromdate]);

		$td=explode('-',$r2[todate]);

		$kvl=$r2[id];

		if($r2['type']==1)

		{

			

			if($i%2)

			echo "	<tr height='14' class='clsname' > ";

			else

			echo "	<tr height='14'> ";

			?>

			

					<td align='left' 

 style="width:100%; background-color:"

 onMouseover="this.style.backgroundColor='#CCCCCC';"

 onMouseout="this.style.backgroundColor='';" nowrap="nowrap"><?php

                    echo "<a onclick='showdetails($kvl)' >&nbsp;&nbsp;$fd[2]-$fd[1]-$fd[0]

					&nbsp;&nbsp;$r2[title]

					</a>

					</td>

				</tr>";

		}

		else

		{

			if($i%2)

			echo "	<tr height='14' class='clsname' > ";

			else

			echo "	<tr height='14'> ";

?>

			<td align='left' bgcolor=""  style="width:100%; background-color:"

 onMouseover="this.style.backgroundColor='#CCCCCC';"

 onMouseout="this.style.backgroundColor='';" nowrap="nowrap"><a onclick="showdetails(<?=$kvl?>)"><?php echo "&nbsp;&nbsp;$fd[2]-$fd[1]-$fd[0] - $td[2]-$td[1]-$td[0]&nbsp;&nbsp;$r2[title]

					</a></td>

					

				</tr>";

			

		}

	}

	$i++;

}

echo " <tr>

			<td >&nbsp;</td>

		</tr>	";

		

//code ends

?>		

                    </table>  

                </div>

        </td>

        <td  width="480" align="justify" valign="top"><br>

              <div id="txtHint" ></div>

        </td>

    </tr>

</table>

</body></html>