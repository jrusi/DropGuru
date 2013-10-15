<html>
 <head>
 </head>
 <body>
  <h1>Dialing...</h1>
  <?php
   session_start();
   $modemselected="/dev/".$_SESSION['modemselected2'];
   $number=$_SESSION['number'];
   $dial="echo \"ATD".$number."\r\" > ".$modemselected;
   $disconnect=$_POST['disconnect'];
   exec ("stty -F ".$modemselected." -echo", $output);
   require "php_serial.class.php";
   $serial = new phpSerial();
   $serial->deviceSet($modemselected);
   $serial->confBaudRate(115200);
   $serial->confParity("none");
   $serial->confCharacterLength(8);
   $serial->confStopBits(1);
   $serial->confFlowControl("none");
   $serial->deviceOpen();
   stream_set_timeout($serial->_dHandle, 10);
   $serial->sendMessage("AT^CURC=0\r");
   //$serial->sendMessage("AT\n\r");
   //$serial->sendMessage("AT S7=45 S0=0 L1 V1 X4 &c1 E1 Q0\n\r");
   $serial->sendMessage($dial);
   sleep(2);
   $read=$serial->readPort();
   $serial->deviceClose();   
   if($disconnect!="true")
   {
    //$fp=fopen('/dev/ttyUSB2','r+');
    //fwrite($fp, "AT S7=45 S0=0 L1 V1 X4 &c1 E1 Q0\n\r");
    //fclose($fp);
    //exec ("echo \"~^M~AT S7=45 S0=0 L1 V1 X4 &c1 E1 Q0\r\n\" > ".$modemselected, $output);
    //sleep(3);
    //exec ("$dial", $output);
    echo ("number: ".$number."<br>");
    echo ("modem: ".$modemselected."<br>");
    echo ("command: ".$dial);
    echo $read;
   }
   if($disconnect=="true")
   {
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