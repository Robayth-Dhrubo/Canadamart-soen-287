<?php


session_start();

if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
     header("Location: /");
}

$file = 'users.xml';
$xml = simplexml_load_file(__DIR__ . '/../../data/users.xml');
$users = $xml->xpath('/users');
$idcount = count($users[0]->user) - 1;
$lastid = ($users[0]->user[$idcount]->id) + 1;

$person = $users[0]->addChild('user');
$person->addChild('id', $lastid);
$person->addChild('firstname', $_POST['fname']);
$person->addChild('lastname', $_POST['lname']);
$person->addChild('age', $_POST['age']);
$person->addChild('address', $_POST['address']);
$person->addChild('city', $_POST['city']);
$person->addChild('province', $_POST['province']);
$person->addChild('country', $_POST['country']);
$person->addChild('postalcode', $_POST['postalcode']);
$person->addChild('password', password_hash($_POST['password'], PASSWORD_DEFAULT));
$person->addChild('email', $_POST['email']);

$xml->asXML(__DIR__ . '/../../data/users.xml');
header("Location: /users/");
die();
