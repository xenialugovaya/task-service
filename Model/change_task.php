<?php
include 'database_connection.php';

if ($_POST["action"] == "edit") {

    $db = new Database();

    $args = [
        'id' => $_POST["edit_task_id"],
        'task' => htmlspecialchars($_POST["edit_task_field"]),
        'edit_status' => 'отредактировано администратором',
    ];

    $query = '
        UPDATE tasks_tbl
        SET task_description = :task, edit_status = :edit_status
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