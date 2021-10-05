<?
  session_start();
  unset($_SESSION["idEmpleado"]);//liberarán las variables de sesión registradas 
  session_destroy();//libera la sesión actual, elimina cualquier dato de la sesión
  header("Location: login.php");
  exit;
?>