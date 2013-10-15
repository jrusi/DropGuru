<html>
 <head>
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
      window.open(href, windowname, 'width=400,height=200,scrollbars=yes');;
      href='';
      window.setTimeout( function(){
        window.location.href=window.location.href; }
      , 1 * 1000);
      return false;
      }
      //-->
  </SCRIPT>
  <style type="text/css">a {color:white;} a:visited {color: #ffffff} body {background-color: black; color: white;}</style>
 </head>
 <body <?php session_start(); $connecting=$_POST['connecting']; $number=$_POST["number"]; $modemselected=$_POST["modemselected"]; $_SESSION['connecting']=$_POST["connecting"]; $_SESSION['number']=$_POST["number"]; $_SESSION['modemselected2']=$_POST["modemselected"]; if($connecting==true && $number<>"" && $modemselected<>""){ echo("onLoad=\"popup('connect.php','ad')\""); $connecting=false;} ?> >
  <?php 
   include "functions.php";
   $connecting=false;
  ?>
  <center>
  <table border=0 background=lightsbkg.jpg height=550>
   <tr>
    <td>
     <center><h2><a href=index.php>DropGuru</a></h2></center>
    </td>
   </tr>
   <tr>
    <td>
     Connection options:
     <form action=index.php method=post><?php listmodems(); ?>
     <INPUT TYPE="button" onClick="window.location.reload()" VALUE="Refresh">
     <input type=hidden name=connecting value=true>
     Tel:<input type=text name=number><input type=submit value=Connect>
     </form>
    </td>
   </tr>
   <tr>
    <td>
     <iframe src="exindex.php" height="400" width="600"></iframe>
    </td>
   </tr>
  </table>
  </center> 
 </body>
</html>
