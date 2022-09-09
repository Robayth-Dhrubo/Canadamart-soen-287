<?php
session_start();
if (!isset($_SESSION['role']) || !isset($_SESSION['uid'])) {
     header("Location: /");
     die();
}

$products = null;
$quantities = null;
if (isset($_COOKIE['items'])) {
     $products = trim($_COOKIE['items'], "[]");
     $quantities = trim($_COOKIE['quantities'], "[]");
} else {
     header("Location: /");
     die();
}

$order_xml = simplexml_load_file(__DIR__ . '/../data/orders.xml');
$orders = $order_xml->xpath('/orders');
$idcount = count($orders[0]->order) - 1;
$oid = ($orders[0]->order[$idcount]->id) + 1;
$order = $orders[0]->addChild('order');
$order->addChild('id', $oid);
$order->addChild('customerid', $_SESSION['uid']);
$order->addChild('items', $products);
$order->addChild('quantities', $quantities);
$order_xml->asXML(__DIR__ . '/../data/orders.xml');

unset($_COOKIE['items']);
unset($_COOKIE['quantities']);
setcookie('items', '', time() - 3600, '/');
setcookie('quantities', '', time() - 3600, '/');

header("Location: /");
die();
