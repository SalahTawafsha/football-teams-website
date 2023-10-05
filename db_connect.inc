<?php
    function connect(): PDO
    {
        $host = "localhost";
        $dbname = "c75_football_teams";
        $userName = "c75wb1200339";
        $password = "Node@2023";
        return new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $userName, $password);
    }
