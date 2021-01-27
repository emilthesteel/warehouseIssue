<?php

namespace SusanIssue\Models;

use SusanIssue\Data\DB;

/**
 * Product wrapper for sql queries and business logic
 *
 */
class Product
{
    public $volumeOfallProducts = 0;
    public $maxDimensions = [];

    /**
     * Helper method for retrieving the all volume
     * of all products
     * @return float
     */
    function getVolumeForAllProducts() : float
    {
        // Values in DB are in mm we will convert to meeters and
        // calculate all volumns V = H*L*W
        // We are exlcuding the items that can't fit in warehouse with
        // heigh 3.6m
        $sql_query = "
            SELECT
            SUM(
                round(
                    (TRIM(length / 1000)+0) * (TRIM(width / 1000)+0) * (TRIM(height / 1000)+0)
                ,3)
            ) as sum_of_volumes
            FROM product
            WHERE product_id not in (
                SELECT product_id FROM product WHERE length > 3600 AND width > 3600 AND height > 3600
            )
        ";
        $database = new DB();
        $data = $database->getQuery($sql_query);
        $rs = $database->getRs($data);

        //we need to reserve space for 5qty from each product
        $this->volumeOfallProducts = round($rs['sum_of_volumes'], 3) * 5;

        return $this->volumeOfallProducts;
    }

        /**
     * Helper method for retrieving the all volume
     * of all products
     * @return float
     */
    function getMaxDimensions() : array
    {
        // Values in DB are in mm we will convert to meeters and
        // get max heigh, length and width
        // We are exlcuding the items that can't fit in warehouse with
        // heigh 3.6m
        $sql_query = "
            SELECT
                MAX(round(TRIM(length / 1000)+0,3)) as max_lenght,
                MAX(round(TRIM(height / 1000)+0,3)) as max_height,
                MAX(round(TRIM(width / 1000)+0,3)) as max_width
            FROM product
            WHERE product_id not in (
                SELECT product_id FROM product WHERE length > 3600 AND width > 3600 AND height > 3600
            )
        ";
        $database = new DB();
        $data = $database->getQuery($sql_query);
        $rs = $database->getRs($data);
        //we need to reserve space for 5qty from each product
        $this->maxDimensions = $rs;

        return $this->maxDimensions;
    }
}
