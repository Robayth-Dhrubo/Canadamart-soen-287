<?php


session_start();

if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
     header("Location: /");
}
$file = 'orders.xml';
$xml = simplexml_load_file(__DIR__ . "/../data/orders.xml");
$orders = $xml->xpath('/orders');
$idcount = count($orders[0]->order) - 1;
$lastid = ($orders[0]->order[$idcount]->id) + 1;
$order = $orders[0]->addChild('order');
$order->addChild('id', $lastid);
$order->addChild('customerid', $_POST['customerid']);
$order->addChild('items', $_POST['productid']);
$order->addChild('quantities', $_POST['amount']);
$xml->asXML(__DIR__ . "/../data/orders.xml");
header("Location: /orders/");
die();
