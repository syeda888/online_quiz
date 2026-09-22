<?php
session_start();

$conn = new mysqli("localhost", "root", "", "online_quiz");

if ($conn->connect_error) {
    die("Database connection failed");
}

$message = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM students WHERE email='$email'");

    if ($result->num_rows == 1) {

        $student = $result->fetch_assoc();

        if (password_verify($password, $student['password'])) {

            $_SESSION['student_id'] = $student['id'];
            $_SESSION['student_name'] = $student['name'];

            header("Location: quiz.php");
            exit();

        } else {
            $message = "Incorrect password!";
        }

    } else {
        $message = "Student not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">

<h2>Student Login</h2>

<p class="message"><?php echo $message; ?></p>

<form method="POST">

<input type="email" name="email" placeholder="Enter Email" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit" name="login">Login</button>

</form>

<a href="register.php">Create new account</a>

</div>

</body>
</html>