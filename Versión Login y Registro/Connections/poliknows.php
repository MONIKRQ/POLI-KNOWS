<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_poliknows = "localhost";
$database_poliknows = "bdpoliknows";
$username_poliknows = "root";
$password_poliknows = "";
$poliknows = mysql_pconnect($hostname_poliknows, $username_poliknows, $password_poliknows) or trigger_error(mysql_error(),E_USER_ERROR); 
?>