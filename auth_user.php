<?php

session_start();
if(!isset($_SESSION["user"])) header("Location: /pages/login_user.php");