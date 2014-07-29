<html>
 <head>
 </head>
 <body>
  <h1>Dialing...</h1>
  <?php
   session_start();
   $modemselected="/dev/".$_SESSION['modemselected2'];
   $number=trim($_SESSION['number']);
   //$dial="ATD".$number."; > ".$modemselected;
   $dial="OK-AT-OK \"ATD".$number."\"\n";
   $disconnect=$_POST['disconnect'];
   exec ("stty -F ".$modemselected." -echo", $output);
   //require "php_serial.class.php";
   //$serial = new phpSerial();
   //$serial->deviceSet($modemselected);
   //$serial->confBaudRate(9600);
   //$serial->confParity("none");
   //$serial->confCharacterLength(8);
   //$serial->confStopBits(1);
   //$serial->confFlowControl("none");
   //$serial->deviceOpen();
   //fopen($modemselected,'r+');
   //stream_set_timeout($serial->_dHandle, 10);
   //if($modemselected=="/dev/ttyUSB2" OR $modemselected=="/dev/ttyUSB4") $serial->sendMessage("AT^CURC=0\r");
   //$serial->sendMessage("AT\n\r");
   //sleep(1);
   //$serial->sendMessage("AT S7=45 S0=0 L1 V1 X4 &c1 E1 Q0\n\r");
   //sleep(1);
   //$serial->sendMessage("AT\n\r");
   //$serial->sendMessage($dial);
   //$dial2="echo \"".$dial."\" > ".$modemselected;
   //$dial2="pppd call dropgurunew";
   //exec($dial2, $output2);
   //exec("echo ATD92027631065 > /dev/ttyACM0", $output2); 
   sleep(3);
   //$read=$serial->readPort();
   //sleep(3);
   //$serial->deviceClose();   
   if($disconnect!="true")
   {
    //fwrite($fp, "AT S7=45 S0=0 L1 V1 X4 &c1 E1 Q0\n\r");
    //fclose($fp);
    //exec ("echo \"~^M~AT S7=45 S0=0 L1 V1 X4 &c1 E1 Q0\r\n\" > ".$modemselected, $output);
    //sleep(3);
    //exec ("cat $modemselected", $output);

$data = file('ppp-peers/chatscript_analog'); // reads an array of lines
function replace_a_line($data) {
   global $dial;
   if (stristr($data, 'OK-AT-OK')) {
     return $dial;
   }
   return $data;
}
$data = array_map('replace_a_line',$data);
file_put_contents('ppp-peers/chatscript_analog', implode('', $data));

    exec("sudo pppd call dropguru-analog >/dev/null 2>/dev/null &", $output3);
    echo ("number: ".$number."<br>");
    echo ("modem: ".$modemselected."<br>");
    echo ("command: ".$dial."<br>");
    echo ("<iframe src=test.php></iframe>");
   }
   if($disconnect=="true")
   {
    exec("sudo killall pppd");
    exec("echo \"ATH\r\" > ".$_POST['modemselected2'], $output);
    echo "<br>disconnected";
   } 
  ?>
  <br><br>
  <center>
   <form action=connect.php method=post>
    <input type=hidden name=disconnect value="true">
    <input type=hidden name=modemselected2 value=<?php echo $modemselected; ?>>
    <input type=submit value=Disconnect>
   </form>
  </center>
 </body>
</html>
