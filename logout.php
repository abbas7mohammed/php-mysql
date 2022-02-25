<?php

session_start();


unset($_SESSION['adminEmail']);

session_destroy();


header("Location: login.php");
exit();



?>