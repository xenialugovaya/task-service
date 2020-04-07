<?php
$connect = new PDO("mysql:host=localhost;dbname=tasks;unix_socket=/tmp/mysql.sock", "root", "password");
$base_url = 'http://localhost:3000/';

function get_total_records($connect, $table_name)
{
    $query = "SELECT * FROM $table_name";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}