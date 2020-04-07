<?php

include 'database_connection.php';

$db = new Database();

$query = "
        SELECT * FROM tasks_tbl
        ORDER BY tasks_tbl.task_id DESC
		";

if (isset($_POST["search"]["value"])) {
    $query .= '
            WHERE tasks_tbl.user LIKE "%' . $_POST["search"]["value"] . '%"
            ';
}

$rows = $db::getRows($query);
$data = [];

foreach ($rows as $row) {
    if ($row["status"] === '0') {
        $status = '<p class="text-danger">Ожидает выполнения</p>';
        $change_status = '<p><input class="change_status" type="checkbox" data-change="' . $row["task_id"] . '" name="done" value="1"> Отметить как выполненное</p>';
    } else {
        $status = '<p class="text-success">Выполнено</p>';
        $change_status = '<p><input class="change_status" type="checkbox" data-change="' . $row["task_id"] . '" name="done" value="0"> Отметить как не выполненное</p>';
    }
    if ($row["edit_status"]) {
        $edit_status = '<p class="text-success">' . $row["edit_status"] . '</p>';
    } else {
        $edit_status = 'Не изменено';
    }
    $sub_array = [];
    $sub_array[] = $row["user"];
    $sub_array[] = $row["email"];
    $sub_array[] = $row["task_description"];
    $sub_array[] = $status;
    $sub_array[] = $edit_status;
    $sub_array[] = '<button type="button" name="edit_task" class="btn btn-primary btn-sm edit_task" id="' . $row["task_id"] . '">Изменить</button>' . $change_status;
    $data[] = $sub_array;
}

$output = array(
    "data" => $data,
);
echo json_encode($output);