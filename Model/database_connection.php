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

function load_tasks_list($connect)
{

    $query = "
SELECT * FROM tasks_tbl
";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach ($result as $row) {

        $output .= '<option value="' . $row["task_id"] . '">' . $row["user"] . '</option>';
    }
    return $output;

}