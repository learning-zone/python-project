<?php
/*
* Breadcrumb navigation class
* Mick Sear
* http://www.ecreate.co.uk
*
* The key to using this is to decide on a $level for each page.  (array, starting position 0)
* This determines where in the trail a link will be placed.  So, I normally make the homepage level 0,
* then every page that can be accessed from the top level nav becomes level 1, and every page
* from that second level becomes level 2, and so on.  When users return to a higher level (e.g. level 1)
* the surplus links are removed.  Only one page can occupy a $level in the crumb trail.
* There might be several routes to a page.  In which case, the trail will reflect the route that the
* user actually took to get to that page.
*/

class Breadcrumb{

   var $output;
   var $crumbs = array();
   var $location;


   /*
    * Constructor
    */
   function Breadcrumb(){

      if ($_SESSION['breadcrumb'] != null){
         $this->crumbs = $_SESSION['breadcrumb'];
      }

   }

   /*
    * Add a crumb to the trail:
    * @param $label - The string to display
    * @param $url - The url underlying the label
    * @param $level - The level of this link.
    *
    */
   function add($label, $url, $level){

      $crumb = array();
      $crumb['label'] = $label;
      $crumb['url'] = $url;

		//echo '111 label :' . $crumb['label'];
		//echo '111 URL :' . $crumb['url'];

      if (!is_null($crumb['label']) && !is_null($crumb['url']) && isset($level)){

         while(count($this->crumbs) > $level){
            array_pop($this->crumbs); //prune until we reach the $level we've allocated to this page
         }

         if (!isset($this->crumbs[0]) && $level > 0){ //If there's no session data yet, assume a homepage link

            $this->crumbs[0]['url'] = "validUser.php";
            $this->crumbs[0]['label'] = "Home";

         }
        // else{
        // 	$this->crumbs[$level]['url'] = $url;
        //    $this->crumbs[$level]['label'] = $label;
        // }


         $this->crumbs[$level] = $crumb;

         //echo '222 label :' .$this->crumbs[$level]['label'];
         //echo '222 URL :' .$this->crumbs[$level]['url'] . '<br>';

      }

        $_SESSION['breadcrumb'] = $this->crumbs; //Persist the data
        $this->crumbs[$level]['url'] = null; //Ditch the underlying url for the current page.
   }

   /*
    * Output a semantic list of links.  See above for sample CSS.  Modify this to suit your design.
    */
   function output(){

      echo "<div id='breadcrumb'><ul><li></li>";
		$i = 0;

      foreach ($this->crumbs as $crumb1){
			//echo $i;
			//echo 'label : ' . $crumb1['label'];
         if (!is_null($crumb1['url'])){

            echo "<li> <font style='font:normal 10px verdana'> > <a href='".$crumb1['url'].'.php'."' title='".$crumb1['label']."'> ".$crumb1['label']."</font></a></li> ";

         } else {

            echo "<li> <font style='font:normal 10px verdana'> > <!--<a href='".$crumb1['url']."' title='".$crumb1['label']."'>--> ".$crumb1['label']."</font><!--</a>--></li> ";

         }
         $i++;
      }

      echo "</ul></div>";
   }
}
?>