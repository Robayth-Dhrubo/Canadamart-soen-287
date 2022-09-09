<?php
session_start();

if ( !isset( $_SESSION['role'] ) && $_SESSION['role']!='admin' ) {
     header("Location: /");
}

$users_xml = simplexml_load_file(__DIR__ . '/../../data/users.xml');
$user = $users_xml->xpath("/users/user[id=".$_GET['id']."]");
unset($user[0][0]);
$users_xml->asXml(__DIR__ . '/../../data/users.xml');
header("Location: /users/");
die();
?>