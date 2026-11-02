<?php
session_start();
session_unset();
session_destroy();
header("Location: https://ardentinc.com/login.php");
?>