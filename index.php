<?php
// include(__DIR__ . '/src/DB.php');

require_once realpath("vendor/autoload.php");

use SusanIssue\Models\Product;
use SusanIssue\Models\Warehouse;
use SusanIssue\Methods\EqualSides;
use SusanIssue\Methods\BruteForce;

//By default we have the height wich is 3.6 meters
$warehouse = new Warehouse;
$warehouse->setHeight(3.6);

$product = new Product;
$product->getVolumeForAllProducts();

//Start caluclating with EqualSidesMethod
//Keep in mind this is not the the optimal solution for sure :)
(new EqualSides($product, $warehouse))
    ->calculate();

$product->getMaxDimensions();

//Calculating with BruteForce method
(new BruteForce($product, $warehouse))
    ->calculate();
