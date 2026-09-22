<?php
session_start();

$conn = new mysqli("localhost", "root", "", "online_quiz");

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin123") {

        $_SESSION['admin'] = true;

        header("Location: admin.php");
        exit();

    } else {

        $error = "Invalid admin username or password";

    }
}

if (!isset($_SESSION['admin'])) {
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Login</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="box">

<h2>Admin Login</h2>

<p class="message">
<?php echo $error ?? ""; ?>
</p>

<form method="POST">

<input type="text"
name="username"
placeholder="Username"
required>

<input type="password"
name="password"
placeholder="Password"
required>

<button type="submit" name="login">
Login
</button>

</form>

<a href="index.php">Back to Home</a>

</div>

</body>
</html>

<?php
exit();
}

$questions = $conn->query("SELECT * FROM questions");
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="admin-container">

<h1>Admin Dashboard</h1>

<a href="add_question.php" class="btn">
Add Question
</a>

<a href="logout.php" class="btn">
Logout
</a>

<h2>Questions</h2>

<table>

<tr>
<th>ID</th>
<th>Question</th>
<th>Correct Answer</th>
<th>Action</th>
</tr>

<?php while ($row = $questions->fetch_assoc()) { ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['question']; ?></td>

<td><?php echo $row['correct_answer']; ?></td>

<td>

<a href="delete_question.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this question?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>