<?php
session_start();
unset($_SESSION['EmailId']);
unset($_SESSION['Login']);
session_destroy();
header("location: login.php");

?>