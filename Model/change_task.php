<?php
include 'database_connection.php';

if ($_POST["action"] == "edit") {

    $id = $_POST["edit_task_id"];
    $task = $_POST["edit_task_field"];
    $edit_status = 'отредактировано администратором';
    $query = '
        UPDATE tasks_tbl
        SET task_description = "' . $task . '", edit_status = "' . $edit_status . '"
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