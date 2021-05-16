<?php

// Nothing too special, just a simple session destroyer

session_start(); //Ack the current session

session_destroy();

header("Location: index.php");
exit;