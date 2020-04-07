<?php

include 'database_connection.php';

if ($_POST["action"] == "add_task") {
    $user = $_POST["user"];
    $email = $_POST["email"];
    $task = $_POST["task"];

    $query = '
            INSERT INTO tasks_tbl
            (user, email, task_description, status)
            VALUES("' . $user . '", "' . $email . '", "' . $task . '", "0")
            ';
    $statement = $connect->prepare($query);
    if ($statement->execute()) {
        $output = array(
            'success' => 'Запись успешно добавлена',
        );
    }
    echo json_encode($output);

}