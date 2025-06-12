<?php

$db_host = 'localhost';
$db_name = 'api_produtos';
$db_user = 'root';
$db_pass = '';

$conn = new PDO("mysql:host=".$db_host.";port=3306;dbname=".$db_name.";charset=utf8mb4", $db_user, $db_pass);
