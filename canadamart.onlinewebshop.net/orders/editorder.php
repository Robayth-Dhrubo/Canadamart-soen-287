<?php

session_start();

if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
     header("Location: /");
}

// $file = 'orders.xml';
$xml = simplexml_load_file(__DIR__ . "/../data/orders.xml");
$order = $xml->xpath('/orders/order[id=' . $_GET["id"] . ']');
unset($order[0]->customerid);
unset($order[0]->items);
unset($order[0]->quantities);
//$order-> addChild('id',$lastid);
$order[0]->addChild('customerid', $_POST['customerid']);
$order[0]->addChild('items', $_POST['productid']);
$order[0]->addChild('quantities', $_POST['amount']);

$xml->asXML(__DIR__ . "/../data/orders.xml");
header("Location: /orders/");
die();
