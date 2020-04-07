<?php
include 'database_connection.php';

if ($_POST["action"] == "change_status") {

    $db = new Database();

    $args = [
        'id' => $_POST["id"],
        'status' => $_POST["status"],
    ];

    $query = '
        UPDATE tasks_tbl
        SET status = :status
        WHERE task_id = :id
        ';

    $update = $db::sql($query, $args);

    if ($update) {
        $output = array(
            'success' => true,
        );
    }
    echo json_encode($output);

}