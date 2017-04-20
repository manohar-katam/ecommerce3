<?php

session_start();

unset($_SESSION["c_id"]);

unset($_SESSION["c_name"]);

unset($_SESSION["c_type"]);
unset($_SESSION['edit_id']);
unset($_SESSION['delete_id']);

header("location: index.php");

?>