<?php

namespace SusanIssue\Models;

/**
 * Model for warehouse
 */
class Warehouse
{
    protected $height;
    protected $width;
    protected $lenght;

    function setHeight(float $height)
    {
        $this->height = $height;
    }

    function setWidth(float $width)
    {
        $this->width = $width;
    }

    function setLength(float $lenght)
    {
        $this->lenght = $lenght;
    }

    function getHeight() : float
    {
        return $this->height;
    }

    function getWidth() : float
    {
        return $this->width;
    }

    function getLength() : float
    {
        return $this->lenght;
    }
}
