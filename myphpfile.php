<?php
$filename = 'myphpfile.php';  //about 500MB
//$output = shell_exec('exec tail -n10 ' . $filename);  //only print last 50 lines
$output = shell_exec("exec sudo tail -n5 /var/log/messages | grep 'chat\|pppd' | grep -o ']:.*' | sed -n 's/]://p'");  //only print last 50 lines
echo str_replace(PHP_EOL, '<br />', $output);         //add newlines
?>
