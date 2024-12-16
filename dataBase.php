<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "itthink";

try {
    $connect = new mysqli($hostname,$username,$password,$database);
} catch(exception $e){
    echo "failed to connect database";
}
