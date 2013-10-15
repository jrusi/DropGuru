<?php

function listmodems()
{
 $i=1;
 exec('ls /dev/ | grep ttyUSB', $modems);
 exec('ls /dev/ | grep ttyACM', $modems2);
 echo ("<select name=modemselected>");
 foreach($modems as $modem1) 
 {
   if($i>2) echo ('<option value='.$modem1.'>Modem '.$i.' GSM</option>');
   $i++;
 } 
 foreach($modems2 as $modem2) 
 {
   echo ('<option value='.$modem2.'>Modem '.$i.' Line</option>');
   $i++;
 }
 echo ("</select>");
}

?>
