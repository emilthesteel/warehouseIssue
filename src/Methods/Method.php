<?php

namespace SusanIssue\Methods;

use SusanIssue\Models\Product;
use SusanIssue\Models\Warehouse;

abstract class Method
{
    protected $product;
    protected $warehouse;

    function __construct(Product $product, Warehouse $warehouse)
    {
        $this->product = $product;
        $this->warehouse = $warehouse;
    }

    abstract function calculate();

    public function printResult(string $method, float $height, float $width, float $lenght)
    {
        echo "Calculating task using {$method} method .... \n";
        echo "Height: {$height}m \n";
        echo "Height: {$width}m \n";
        echo "Height: {$lenght}m \n";
    }
}
