<?php

namespace SusanIssue\Methods;

use SusanIssue\Models\Product;
use SusanIssue\Models\Warehouse;

/**
 * Calculation for method "Equal sides"
 *
 */
class EqualSides extends Method
{
    function __construct(Product $product, Warehouse $warehouse)
    {
        parent::__construct($product, $warehouse);
    }

    /**
     * We know that the heigh is 3.6
     * The formula for Volume is V = H*L*W
     * In this method we will assume that L and W will be equal
     * So we need to find the sqrt(LH)
     */
    function calculate()
    {
        $widthLenght = $this->product->volumeOfallProducts / $this->warehouse->getHeight();
        $result = round(sqrt($widthLenght), 3);
        $this->printResult(static::class, $this->warehouse->getHeight(), $result, $result);
    }
}
