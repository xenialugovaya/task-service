<?php
include 'database_connection.php';

if ($_POST["action"] == "change_status") {

    $id = $_POST["id"];
    $status = $_POST["status"];

    $query = '
        UPDATE tasks_tbl
        SET status = "' . $status . '"
        WHERE task_id = "' . $id . '"
        ';
    $statement = $connect->prepare($query);
    if ($statement->execute()) {
        $output = array(
            'success' => 'Запись успешно изменена',
        );
    }
    echo json_encode($output);

}