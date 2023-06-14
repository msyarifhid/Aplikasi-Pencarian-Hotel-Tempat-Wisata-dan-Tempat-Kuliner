<?php
session_start();
unset($_SESSION['kln_adm']);

echo "<script>window.location='../login.php';</script>";
?> 