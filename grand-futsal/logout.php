<?php

include('__fungsi.php');

unset($_SESSION["id"]);
unset($_SESSION["username"]);
session_destroy();
header('Location: login.php');
