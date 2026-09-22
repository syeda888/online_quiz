<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "online_quiz");

if (isset($_POST['add'])) {

    $question = $_POST['question'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $correct = $_POST['correct'];

    $sql = "INSERT INTO questions
    (question,option_a,option_b,option_c,option_d,correct_answer)
    VALUES
    ('$question','$a','$b','$c','$d','$correct')";

    if ($conn->query($sql)) {
        header("Location: admin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Question</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="box">

<h2>Add Quiz Question</h2>

<form method="POST">

<textarea name="question"
placeholder="Enter Question"
required></textarea>

<input type="text"
name="a"
placeholder="Option A"
required>

<input type="text"
name="b"
placeholder="Option B"
required>

<input type="text"
name="c"
placeholder="Option C"
required>

<input type="text"
name="d"
placeholder="Option D"
required>

<select name="correct" required>

<option value="">Select Correct Answer</option>

<option value="A">Option A</option>
<option value="B">Option B</option>
<option value="C">Option C</option>
<option value="D">Option D</option>

</select>

<button type="submit" name="add">
Add Question
</button>

</form>

<a href="admin.php">Back to Admin</a>

</div>

</body>

</html>