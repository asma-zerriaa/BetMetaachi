<?php
session_start();
session_destroy(); 
header("Location: ../front/login_form.php"); // narjouu l page cnx
exit();
?>
