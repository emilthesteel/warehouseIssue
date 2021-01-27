<?php
// include(__DIR__ . '/src/DB.php');

require_once realpath("vendor/autoload.php");

// use SusanIssue\Models;
// use SusanIssue\Data;

// $database = new SusanIssue\Data\DB;
// $sql = "SELECT * FROM product";
// $data = $database->getQuery($sql);
// foreach ($data as $d) {
//     var_dump($d);
//     die();
// }
use SusanIssue\Models\Product;
use SusanIssue\Models\Warehouse;

$warehouse = new Warehouse;
$warehouse->setHeight(3.6);

var_dump($warehouse->getHeight());
