<?php

$nwords = array(  "", "one", "two", "three", "four", "five", "six", 
	      	  "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", 
	      	  "fourteen", "fifteen", "sixteen", "seventeen", "eightteen", 
	     	  "nineteen", "twenty", 30 => "thirty", 40 => "fourty",
                     50 => "fifty", 60 => "sixty", 70 => "seventy", 80 => "eigthy",
                     90 => "ninety" );

function number_to_words ($x)
{
     global $nwords;
     if(!is_numeric($x))
     {
         $w = '#';
     }else if(fmod($x, 1) != 0)
     {
         $w = '#';
     }else{
         if($x < 0)
         {
             $w = 'minus ';
             $x = -$x;
         }else{
             $w = '';
         }
         if($x < 21)
         {
             $w .= $nwords[$x];
         }else if($x < 100)
         {
             $w .= $nwords[10 * floor($x/10)];
             $r = fmod($x, 10);
             if($r > 0)
             {
                 $w .= ' '. $nwords[$r];
             }
         } 
		 else if($x < 1000)
         {
		
             $w .= $nwords[floor($x/100)] .' hundred ';
             $r = fmod($x, 100);
             if($r > 0)
             {
                 $w .= ' '. number_to_words($r);
             }
         } else if($x < 100000)
         {
         	$w .= number_to_words(floor($x/1000)) .' thousand';
             $r = fmod($x, 1000);
             if($r > 0)
             {
                 $w .= ' ';
                 $w .= number_to_words($r);
             }
         } else if($x < 10000000)
         {
         	$w .= number_to_words(floor($x/100000)) .' lakh';
             $r = fmod($x, 100000);
             if($r > 0)
             {
                 $w .= ' ';
                 $w .= number_to_words($r);
             }
		 } else {
             $w .= number_to_words(floor($x/10000000)) .' crore';
             $r = fmod($x, 10000000);
             if($r > 0)
             {
                 $w .= ' ';
                 $w .= number_to_words($r);
             }
         }
     }
     return $w;
}
?>