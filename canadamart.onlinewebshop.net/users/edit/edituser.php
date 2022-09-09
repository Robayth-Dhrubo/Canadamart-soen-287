<?php
session_start();

if ( !isset( $_SESSION['role'] ) && $_SESSION['role']!='admin' ) {
     header("Location: /");
}

$file = 'users.xml';
$xml = simplexml_load_file(__DIR__ . '/../../data/users.xml');
$user = $xml->xpath('/users/user[id='.$_GET["id"].']');

$password=null;
unset($user[0]->role);
unset($user[0]->email);
unset($user[0]->firstname);
unset($user[0]->lastname);
unset($user[0]->age);
unset($user[0]->address);
unset($user[0]->city);
unset($user[0]->province);
unset($user[0]->country);
unset($user[0]->postalcode);
if(isset($_POST['password'])&&$_POST['password']!=''){
     unset($user[0]->password);
     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
}


$user[0]-> addChild('role',$_POST['role']);
$user[0]-> addChild('email',$_POST['email']);
$user[0]-> addChild('firstname',$_POST['fname']);
$user[0]-> addChild('lastname',$_POST['lname']);
$user[0]-> addChild('age',$_POST['age']);
$user[0]-> addChild('address',$_POST['address']);
$user[0]-> addChild('city',$_POST['city']);
$user[0]-> addChild('province',$_POST['province']);
$user[0]-> addChild('country',$_POST['country']);
$user[0]-> addChild('postalcode',$_POST['postalcode']);
if(isset($_POST['password'])){
     $user[0]-> addChild('password',$password);
}




$xml->asXML(__DIR__ . '/../../data/users.xml');
header("Location: /users/");
die();
?>