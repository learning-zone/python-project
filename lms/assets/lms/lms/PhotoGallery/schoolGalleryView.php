<?php
  include("../db.php");
	if(!$_REQUEST['id'])
	{
	?><br>
		<table  class='forumline' align='center' width="60%" border="1" cellspacing="0" cellpadding="0">
		  <tr>
			<td colspan="4" class="head" align="center">Photo Gallery  </td>
			</tr>
		 <tr height='25'>
			
	  <?php
	  
		$inc=1;
		$temsql3=execute("select * from album where status=1 order by id desc");
		while($r=fetcharray($temsql3))
		{
			if($inc==5)
			echo "<tr>";
			echo "<td width='25%' align='center'  nowrap>$r[Albumname]<br>";
			?>
			<?php
				$tems=fetcharray(execute("select HalfImagepath from albumpic where AlbumID='$r[id]' and (Cover=1 or Cover=0) order by Cover desc, id  limit 1 "));
			?>
	
			<a href="schoolGalleryView.php?id=<?=$r[id]?>" title="<?=$r[Description]?>">
			<img src='<?=$tems[0]?>'  height='46' width='70'  />
			</a>
			</td>
		<?php		
			if($inc==4)
			{
				echo "<tr>";
				$inc=1;	
			}
			else
			$inc++;
		}
		if($inc==2)
		echo "<td></td><td></td><td></td><tr>";
		if($inc==3)
		echo "<td></td><td></td><tr>";
		if($inc==4)
		echo "<td></td><tr>";


	
	}
	else
	{	
		?>
		</table>
		<a href="schoolGalleryView.php">
		<input type="button" name="go" value="Go Back to Album" class="bgbutton" />
		</a><br>
		<div align="center">
            <div style="text-align: center; alignment-adjust:central; width:700;">
            <?php
            $id=$_REQUEST['id'];;
            $temsql3=execute("select * from album where id='$id'");
            while($r=fetcharray($temsql3))
            {
                echo "<B>$r[Albumname]</B>
                <p align='justify'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$r[Description]
                </p>";
            }
            ?>
        </div>
        </div>
        <div align="center" >
            <iframe align="middle" src="themes/classic/classic-demo.php?id=<?=$_REQUEST['id']?>" scrolling="no" allowtransparency="" height="450" width="700">
            </iframe>
        </div>
        <?php
	}
	?>