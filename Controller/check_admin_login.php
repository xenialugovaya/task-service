<?php
session_start();
include '../Model/database_connection.php';

$admin_user_name = '';
$admin_password = '';
$error_admin_user_name = '';
$error_admin_password = '';
$error = 0;

//проверяем ввод логина и пароля

if (empty($_POST["admin_user_name"])) {
    $error_admin_user_name = 'Введите логин';
    $error++;

} else {
    $admin_user_name = htmlspecialchars($_POST["admin_user_name"]);

}

if (empty($_POST["admin_password"])) {
    $error_admin_password = 'Введите пароль';
    $error++;
} else {
    $admin_password = htmlspecialchars($_POST["admin_password"]);
}

//запрос в базе данных

if ($error == 0) {
    $query = "
        SELECT * FROM admin_tbl
        WHERE login = '" . $admin_user_name . "'
        ";
    $statement = $connect->prepare($query);

    if ($statement->execute()) {
        $total_row = $statement->rowCount();

        if ($total_row > 0) {
            $result = $statement->fetchALL();
            foreach ($result as $row) {
                if (password_verify($admin_password, $row["password"]) == 1) {
                    $_SESSION["admin_id"] = $row["admin_id"];

                } else {
                    $error_admin_password = "Неверный пароль";
                    $error++;
                }
            }
        } else {
            $error_admin_user_name = 'Неверное имя пользователя';
            $error++;
        }

    }
}

if ($error > 0) {
    $output = array(

        'error' => true,
        'error_admin_user_name' => $error_admin_user_name,
        'error_admin_password' => $error_admin_password,

    );
} else {
    $output = array(

        'success' => true,
    );
}

echo json_encode($output);