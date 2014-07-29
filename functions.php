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

function startmgetty()
{
 sleep(2);
 // exec('sudo /usr/bin/killall mgetty>/dev/null 2>/dev/null &', $startmgettyon);
 exec('sudo /sbin/mgetty -D /dev/'.$_POST['modemselected'].' >/dev/null 2>/dev/null &', $startmgettyon);
}

function stopmgetty()
{
 exec('sudo /usr/bin/killall mgetty>/dev/null 2>/dev/null &', $stopmgettynon);
}

function mgettyrunning()
{
 exec('ps ax | grep mgetty', $mgettyrun);
 $mgettyrun2 = preg_replace('#.*(/sbin/mgetty -D)#i', '$1', $mgettyrun[0]);
 $mgettyrun2 = str_replace('/sbin/mgetty -D', 'Waiting for connections on modem', $mgettyrun2);
 if (substr($mgettyrun2, 0, 7)<>'Waiting') return $mgettyisrunning="false"; 
 else { 
	// echo $mgettyrun2; 
	return $mgettyisrunning="true"; 
      }
}
?>
