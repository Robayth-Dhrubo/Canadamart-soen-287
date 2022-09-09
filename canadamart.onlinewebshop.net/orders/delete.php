<?php
session_start();

if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
     header("Location: /");
}
$orders_xml = simplexml_load_file(__DIR__ . "/../data/orders.xml");
$order = $orders_xml->xpath("/orders/order[id=" . $_GET["id"] . "]");
unset($order[0][0]);
$orders_xml->asXml(__DIR__ . "/../data/orders.xml");
header("Location: /orders/");
die();
