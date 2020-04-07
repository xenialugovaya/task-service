<?php

include 'database_connection.php';

$query = "
		SELECT * FROM tasks_tbl
		";

if (isset($_POST["search"]["value"])) {
    $query .= '
            WHERE tasks_tbl.user LIKE "%' . $_POST["search"]["value"] . '%"
            ';
}
/*
$query .= 'GROUP BY tbl_student.student_id ';
if (isset($_POST["order"])) {
$query .= '
ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . '
';
} else {
$query .= '
ORDER BY tbl_student.student_roll_number ASC
';
}

if ($_POST["length"] != -1) {
$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
 */
$statement = $connect->prepare($query);

$statement->execute();
$result = $statement->fetchAll();
$data = [];
$filtered_rows = $statement->rowCount();
foreach ($result as $row) {
    if ($row["status"] === '0') {
        $status = '<p class="text-danger">Ожидает выполнения</p>';
        $change_status = '<p><input type="checkbox" id="done' . $row["task_id"] . '" name="done" value="1"> Отметить как выполненное</p>';
    } else {
        $status = '<p class="text-success">Выполнено</p>';
        $change_status = '<p><input type="checkbox" id="done' . $row["task_id"] . '" name="done" value="0"> Отметить как не выполненное</p>';
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
    'draw' => intval($_POST["draw"]),
    "recordsTotal" => $filtered_rows,
    "recordsFiltered" => get_total_records($connect, 'tasks_tbl'),
    "data" => $data,
);
echo json_encode($output);