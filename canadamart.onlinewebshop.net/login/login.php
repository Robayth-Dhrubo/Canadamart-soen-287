<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];

$users = simplexml_load_file('../data/users.xml');
$email_valid = false;
$password_valid = false;
$is_admin = false;
$role = "";
$uid = "";

foreach ($users[0]->user as $u) {

    if ($u->email == $email) {
        $email_valid = true;
        // echo ('email valid');
    }

    if (password_verify($password, $u->password)) {
        $password_valid = true;
        // echo ('pass valid');
    }
    if ($u->role == "admin") {
        $is_admin = true;
        $role = "admin";
        $uid = $u->id;
    } else {
        $role = $u->role;
        $uid = $u->id;
    }
}
if ($email_valid && $password_valid && $is_admin) {
    $_SESSION['role'] = 'admin';
    $_SESSION['uid'] = 0;
    header('Location: /');
    // if (isset($_GET['continue'])) {
    //     header('Location: /' . $_GET['continue']);
    // }
} else if ($email_valid && $password_valid) {
    $_SESSION['role'] = $role;
    $_SESSION['uid'] = $uid;
    // echo ($_SESSION['role'] . " " . $_SESSION['uid']);
    header('Location: /');
    // if (isset($_GET['continue'])) {
    //     header('Location: /' . $_GET['continue']);
    // }
}
