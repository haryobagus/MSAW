<?php

session_name('session_saw');
session_start();
require_once 'config.php';
$con->close();
session_destroy();
session_unset();
exit("<script>window.location='".$www."';</script>");

?>