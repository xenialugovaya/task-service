<?php

include 'database_connection.php';

if ($_POST["action"] == "add_task") {

    $db = new Database();

    $args = [
        'user' => htmlspecialchars($_POST["user"]),
        'email' => htmlspecialchars($_POST["email"]),
        'task' => htmlspecialchars($_POST["task"]),
    ];

    $query = '
            INSERT INTO tasks_tbl
            (user, email, task_description, status)
            VALUES(:user, :email, :task, "0")
            ';

    $insert = $db::sql($query, $args);

    if ($insert) {
        $output = [
            'success' => true,
        ];
    }
    echo json_encode($output);

}