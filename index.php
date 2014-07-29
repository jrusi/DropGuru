<!doctype html>
<html lang="us">
<head>
	<meta charset="utf-8">
	<title>Drop Guru</title>
	<link href="css/start/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
  <SCRIPT TYPE="text/javascript">
   <!--
   function popup(mylink, windowname)
   {
    if (! window.focus)return true;
    var href;
    if (typeof(mylink) == 'string')
    href=mylink;
    else
      href=mylink.href;
      window.open(href, windowname, 'width=400,height=430,scrollbars=yes');;
      href='';
      window.setTimeout( function(){
        window.location.href=window.location.href; }
      , 1 * 1000);
      return false;
      }
      //-->
  </SCRIPT>

	<script>
	$(function() {
		
		$( "#accordion" ).accordion();
		$( "#accordion").css('width','640px');
		
		$("button, input:submit, input:button").button();
		$( "#radioset" ).buttonset();
		

		
		$( "#tabs" ).tabs();
		$( "#tabs").css('width','635px');

		
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 400,
			buttons: [
				{
					text: "Ok",
					click: function() {
						$( this ).dialog( "close" );
					}
				},
				{
					text: "Cancel",
					click: function() {
						$( this ).dialog( "close" );
					}
				}
			]
		});

		// Link to open the dialog
		$( "#dialog-link" ).click(function( event ) {
			$( "#dialog" ).dialog( "open" );
			event.preventDefault();
		});
		

		

		
		$( "#slider" ).slider({
			range: true,
			values: [ 17, 67 ]
		});
		

		
		$( "#progressbar" ).progressbar({
			value: 20
		});
		

		// Hover states on the static widgets
		$( "#dialog-link, #icons li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
		);
	});
	</script>
	<style>
	body{
		font: 62.5% "Trebuchet MS", sans-serif;
		margin: 20px;
	}
	.demoHeaders {
		margin-top: 2em;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	</style>
<style type="text/css">a {color:white;} a:visited {color: #ffffff} body {background-color: black; color: white;}</style>
</head>
<body bgcolor=white background="lightsbkg.jpg" <?php session_start(); $connecting=$_POST['connecting']; $number=$_POST["number"]; $modemselected=$_POST["modemselected"]; $_SESSION['connecting']=$_POST["connecting"]; $_SESSION['number']=$_POST["number"]; $_SESSION['modemselected2']=$_POST["modemselected"]; if($connecting==true && $number<>"" && $modemselected<>""){ echo("onLoad=\"popup('connect.php','ad')\""); $connecting=false;} ?> >

  <?php 
   include "functions.php";
   $connecting=false;
  ?>

<?php
session_start();
header('Cache-control: private'); // IE 6 FIX
 
if(isSet($_GET['lang']))
{
$lang = $_GET['lang'];
 
// register the session and set the cookie
$_SESSION['lang'] = $lang;
 
setcookie('lang', $lang, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['lang']))
{
$lang = $_SESSION['lang'];
}
else if(isSet($_COOKIE['lang']))
{
$lang = $_COOKIE['lang'];
}
else
{
$lang = 'en';
}
 
switch ($lang) {
case 'en':
$lang_file = 'lang.en.php';
break;
 
case 'es':
$lang_file = 'lang.es.php';
break;
 
default:
$lang_file = 'lang.en.php';
 
}
 
include_once 'languages/'.$lang_file;
?>

<center><a href=index.php><img src="logo.gif" width="230"></a></center>

<center>
<!-- Accordion -->
<div id="accordion">
	<h3><?php echo $lang['LANGUAGE']; ?></h3>
	<div><a href="index.php?lang=es"><img src="/languages/flag_es.gif" border="0" height="21"></a> <a href="index.php?lang=en"><img src="/languages/flag_en.gif" border="0"></a><br></div>
	<h3><?php echo $lang['ABOUT']; ?></h3>
	<div><?php echo $lang['ABOUT_BODY']; ?><br><br></div>
	<h3><?php echo $lang['HARDWARE']; ?></h3>
	<div><?php echo $lang['HARDWARE_BODY']; ?></div>
</div><br>


<!-- Tabs -->
	  <?php
	    $waitingon=$_POST['waiting']; 
	    $stopwaitingon=$_POST['stopwaiting']; 
	  ?>
	  <?php
	    if ($stopwaitingon=='true') { stopmgetty(); $stopwaitingon='false'; $waitingon='false';}     
 	    if ($waitingon=='true') { startmgetty(); $waitingon='waiting'; }
	  ?>
<div id="tabs" align="left">
	<ul>
		<li><a href="#tb1"><?php echo $lang['OUTGOING']; ?></a></li>
		<li><a href="#tb2"><?php echo $lang['INCOMING']; ?></a></li>
		<!-- <li><a href="#tb3"><?php echo $lang['CONFIGURATION']; ?></a></li> -->
	</ul>
        <div id="tb1">
          <?php echo $lang['CON_OPTIONS']; ?><br><br>
	  <?php 
	   if (mgettyrunning()=="false"){ 
            echo "<form action=index.php method=post>";
            listmodems();
            echo "<button id='button' onClick='window.location.reload()' VALUE='Refresh'>".$lang['REFRESH']."</button>"; 
            echo "<input type=hidden name=connecting value=true>";
            echo "Tel#:<input type=text name=number>";
            echo "<button id='submit' type='submit'>".$lang['CONNECT']."</button>";
            echo "</form><br><br>";
	   }
	   else {
            echo "<div class='ui-widget'>";
	      echo "<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>";
  		  echo "<p><span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>";
		  echo $lang['WAITING_CANT_CON'];
		  echo "</p>";
    	      echo "</div>";
            echo "</div>";
	   }
          ?>
          <div class="ui-widget">
	    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
		<?php echo $lang['OUTGOING_DESC']; ?></p>
    	    </div>
          </div><br>
          <!-- <iframe src="media/index.php" height="400" width="600" border="0"></iframe> -->
	  <?php if(mgettyrunning()=="false") echo("<iframe src='smbwebclient.php' height='400' width='600' border='0'></iframe>");
		 else echo("<iframe src='smbwebclient_mgetty.php' height='400' width='600' border='0'></iframe>");
	  ?>
        </div>
	<div id="tb2">
          <?php 
	    echo $lang['CON_OPTIONS']; 
            echo "<br><br>";
	    if (mgettyrunning()=="false"){ 
               echo "<form action=index.php method=post>";
               listmodems();
               echo "<input type=hidden name=waiting value=true>";
               echo "<button id='submit' type='submit' value='statr_wait_con' id='waitforcon'>";
 	       echo $lang['WAIT_FOR_CON']; 
	       echo "</button></form><br>";
	       mgettyrunning();
	       echo $mgettyisrunning;
	    } 
 	    else {
             echo "<div class='ui-widget'>";
	       echo "<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>";
   		   echo "<p><span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>";
		   echo $lang['WAITING_CANT_WAIT'];
		   echo "</p>";
    	       echo "</div>";
             echo "</div>";
	    }
          ?>
          <br>
          <form action=index.php method=post>
           <input type=hidden name=stopwaiting value=true>
	   <button id="submit" type="submit" value="stop_wait_con"><?php echo $lang['STOP_WAIT_FOR_CON']; ?></button>
	  </form>
	  <br> 
          <div class="ui-widget">
	    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
		<?php echo $lang['INCOMING_DESC']; ?></p>
    	    </div>
          </div><br>
	  <?php if(mgettyrunning()=="false") echo("<iframe src='smbwebclient.php' height='400' width='600' border='0'></iframe>");
		 else echo("<iframe src='smbwebclient_mgetty.php' height='400' width='600' border='0'></iframe>"); ?>
           <button id="button" onClick="window.location.reload()" VALUE="Refresh">Refresh</button>
        </div>
	<!-- <div id="tb3">Configuration:<br><br></div> -->
</div>
</center>

<br><br>

<div style="position: relative; width: 96%; height: 70px; padding:1% 2%; overflow:hidden;" class="fakewindowcontain">
	<p>This is Open Source Software...</p>
<!-- ui-dialog -->
<div class="ui-overlay"><div class="ui-widget-overlay"></div></div>	
</div>

<!-- ui-dialog -->
<div id="dialog" title="Dialog Title">
	<p></p>
</div>

</body>
</html>
