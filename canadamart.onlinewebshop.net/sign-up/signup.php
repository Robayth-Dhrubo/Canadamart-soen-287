<?php
session_start();

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$postalCode = $_POST['postalCode'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$address = $_POST['address'];
$city = $_POST['city'];
$province = $_POST['province'];
$country = $_POST['country'];
$number_of_users = 0;

$users = simplexml_load_file("../data/users.xml");
$email_taken = false;
foreach ($users->user as $u) {
    $number_of_users++;
    if ($u->email == $email) {
        $email_taken = true;
    }
}

if (!$email_taken) {
    $user = $users->addChild("user");
    $user->addChild("id", $number_of_users);
    $user->addChild("role", "customer");
    $user->addChild("email", $email);
    $user->addChild("password", $password);
    $user->addChild("firstname", $firstName);
    $user->addChild("lastname", $lastName);
    $user->addChild("address", $address);
    $user->addChild("city", $city);
    $user->addChild("province", $province);
    $user->addChild("country", $country);
    $user->addChild("postalcode", $postalCode);


    $users->saveXML("../data/users.xml");
} else {
    echo "email already in use";
}
header('Location: /');
die();
