<?php
session_start();
unset($_SESSION['role']);
unset($_SESSION['uid']);
header("Location: /");
die();
