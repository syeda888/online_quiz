<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "online_quiz");

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $conn->query("DELETE FROM questions WHERE id=$id");
}

header("Location: admin.php");

exit();

?>