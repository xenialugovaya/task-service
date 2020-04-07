<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header('location:./View/AdminView/index.php');
} else {
    header('location:./View/index.php');
}