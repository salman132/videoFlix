<?php

require_once('inlcudes/init.php');

$session->logout($_SESSION['user']);
redirect("index.php");
die();

?>