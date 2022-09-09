<?php
session_start();

$id_matched = false;
if(isset($_GET["id"]) && !empty($_GET["id"])){
    $id = $_GET["id"];
    
    $xml = new DOMDocument();
    $xml->load(__DIR__."/../data/products.xml");

    $record = $xml->getElementsByTagName('product');
    foreach ($record as $person) {
        $person_id = $person->getElementsByTagName('id')->item(0)->nodeValue;
        if ($person_id == $id) {
            $id_matched = true;
            $person->parentNode->removeChild($person);            
            break;
        }
    }
    if ($id_matched == true) {
        if ($xml->save(__DIR__."/../data/products.xml")) {
            header("location: http://localhost/products/");
        }
    }
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
