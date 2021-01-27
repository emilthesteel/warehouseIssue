<?php

namespace SusanIssue\Data;

use \PDO;

class DB
{
    private $hostname = 'localhost'; // Put your host name here
    private $username = 'root'; // Put your MySQL User name here
    private $password = 'root'; // Put Your MySQL Password here
    private $dbName = 'susan_db'; // Put Your MySQL Database name here

    public $dbh = NULL; // Database handler

    public function __construct() // Default Constructor
    {
        try
        {
            $this->dbh = new PDO("mysql:host=$this->hostname;dbname=$this->dbName", $this->username, $this->password);
            /*** echo a message saying we have connected ***/
            //echo 'Connected to database'; // Test with this string
        }
        catch(PDOException $e)
        {
            echo __LINE__.$e->getMessage();
        }
    }

    public function __destruct()
    {
        $this->dbh = NULL; // Setting the handler to NULL closes the connection propperly
    }

    public function runQuery($sql)
    {
        try
        {
            //echo $sql;
            $count = $this->dbh->exec($sql) or print_r($this->dbh->errorInfo());
        }
        catch(PDOException $e)
        {
            echo __LINE__.$e->getMessage();
        }
    }

    public function getQuery($sql)
    {
        $stmt = $this->dbh->query($sql);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt; // Returns an associative array that can be diectly accessed or looped through with While or Foreach
    }

    public function getRs($data)
    {
        $result = [];
        while ($row = $data->fetch())
        {
            $result[] = $row;
        }

        return count($result) > 1 ?
                $result : array_pop($result);
    }

}
