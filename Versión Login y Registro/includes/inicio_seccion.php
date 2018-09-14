<?php require_once('/Connections/poliknows.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['correo'])) {
  $loginUsername=$_POST['correo'];
  $password=$_POST['contraseña'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "temp.html";
  $MM_redirectLoginFailed = "usuario_duplicado.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_poliknows, $poliknows);
  
  $LoginRS__query=sprintf("SELECT correo, password FROM tblusuario WHERE correo=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $poliknows) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Poli Knows</title>
</head>

<body>
<div id="wrapper">
<div id="box">
<div id="top_header">
      <h3>POLI KNOWS</h3>
      <h5>
        INGRESA TU USUARIO Y CONTRASEÑA<br />

      </h5>
<form id="Formacceso" name="Formacceso" method="POST" action="<?php echo $loginFormAction; ?>">
  <p>
<label for="correo"></label>
<input type="text" placeholder="Correo Electronico" name="correo" id="correo" />
<label for="contraseña"></label>
<input type="password" placeholder="Contraseña" name="contraseña" id="contraseña" />
<input type="submit" name="button" id="button" value="Enviar" />
      <div id="bottom">
      <a href="Reg_usuario.php">Crear una cuenta</a>
      <a class="right_a" href="#">Restablecer Contraseña</a>
  </p>
</form>

</div>
</div>	
</div>
</body>
</html>
