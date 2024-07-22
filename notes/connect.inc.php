<?php

$con_error='Couldnt connect';

$mysql_host='localhost';
$mysql_user='root';
$mysql_password='sandy76#';
$mysql_db='a_database';

if(@!mysql_connect($mysql_host,$mysql_user,$mysql_password)||@!(mysql_select_db($mysql_db)))
{
  echo mysql_error();
}
else {
  //echo 'Connected!';
}



 ?>
