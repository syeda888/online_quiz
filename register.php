<?php
$conn = new mysqli("localhost", "root", "", "online_quiz");

if ($conn->connect_error) {
    die("Database connection failed");
}

$message = "";

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM students WHERE email='$email'");

    if ($check->num_rows > 0) {
        $message = "Email already registered!";
    } else {

        $sql = "INSERT INTO students(name,email,password)
                VALUES('$name','$email','$password')";

        if ($conn->query($sql)) {
            $message = "Registration successful! You can login now.";
        } else {
            $message = "Registration failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">

<h2>Student Registration</h2>

<p class="message"><?php echo $message; ?></p>

<form method="POST">

<input type="text" name="name" placeholder="Enter Name" required>

<input type="email" name="email" placeholder="Enter Email" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit" name="register">Register</button>

</form>

<a href="login.php">Already have an account? Login</a>

</div>

</body>
</html>