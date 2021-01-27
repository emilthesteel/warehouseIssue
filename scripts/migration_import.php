<?php

$mysql_host = 'localhost';
$mysql_username = 'root';
$mysql_password = 'root';
$mysql_database = 'susan_db';

try
    {
        $db = new PDO('mysql:dbname='. $mysql_database . ';host='.$mysql_host,$mysql_username,$mysql_password);
        $sql = implode(array_map(function ($v)
        {
            return file_get_contents($v);
        }, glob(__DIR__ . "/*.sql")));

        $qr = $db->exec($sql);
        echo "Import action - 100% successfull";
    }
    catch (PDOException $e)
    {
     echo 'Connection failed: ' . $e->getMessage();
    }
