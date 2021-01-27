<?php

namespace SusanIssue\Methods;

use SusanIssue\Models\Product;
use SusanIssue\Models\Warehouse;

/**
 * Calculation for method "Eaual sides"
 *
 */
class BruteForce extends Method
{
    function __construct(Product $product, Warehouse $warehouse)
    {
        parent::__construct($product, $warehouse);
    }

    /**
     * We know that the heigh is 3.6. For other 2 sides of the warehouse
     * we will brute force and try to find the minumum lenght and width
     * with help of the maxdimensions from product table
     */
    function calculate()
    {
        //get maxDimensions and sort them
        $maxDimensions = $this->product->maxDimensions;
        arsort($maxDimensions);
        //get last 2 dimensions as width and length
        $maxWidth = array_pop($maxDimensions);
        $maxLength = array_pop($maxDimensions);

        //we can get the minimum product dimension
        $storegeHeight = $this->warehouse->getHeight();
        $storegeLenght = 0;
        $storegeWidth = 0;
        $minStep = 0.2;
        $maxSqrt = $this->product->volumeOfallProducts;
        for ($i=0.2; $i < $maxSqrt; $i += $minStep)
        {
            $mockWidth = $i;
            $mockLength = $maxSqrt / ($mockWidth * $storegeHeight);

            //try when mockWidth and mockLendght fit into the warehouse
            if ($mockWidth > $maxWidth && $mockLength > $maxLength)
            {
                $sqrt = $mockWidth * $mockLength * $storegeHeight;
                //check if mockWarhouse dimensions will be ok
                //for the all product volumes
                if($maxSqrt > $sqrt)
                {
                    $maxSqrt = $sqrt;
                    $storegeLenght = $mockLength;
                    $storegeWidth = $mockWidth;
                }
            }
        }

        $this->printResult(
            static::class,
            $this->warehouse->getHeight(),
            round($storegeWidth,3),
            round($storegeLenght,3)
        );
    }
}
