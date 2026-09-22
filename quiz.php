<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "online_quiz");

$result = $conn->query("SELECT * FROM questions ORDER BY RAND() LIMIT 10");
?>

<!DOCTYPE html>
<html>
<head>

<title>Online Quiz</title>

<link rel="stylesheet" href="style.css">

<script src="script.js"></script>

</head>

<body>

<div class="quiz-container">

<h2>Online Quiz</h2>

<p>Welcome, <?php echo $_SESSION['student_name']; ?></p>

<div id="timer">Time Left: 05:00</div>

<form action="result.php" method="POST" id="quizForm">

<?php

$i = 1;

while ($row = $result->fetch_assoc()) {

?>

<div class="question">

<h3>
<?php echo $i . ". " . $row['question']; ?>
</h3>

<label>
<input type="radio"
name="answer[<?php echo $row['id']; ?>]"
value="A"
required>
<?php echo $row['option_a']; ?>
</label>

<label>
<input type="radio"
name="answer[<?php echo $row['id']; ?>]"
value="B">
<?php echo $row['option_b']; ?>
</label>

<label>
<input type="radio"
name="answer[<?php echo $row['id']; ?>]"
value="C">
<?php echo $row['option_c']; ?>
</label>

<label>
<input type="radio"
name="answer[<?php echo $row['id']; ?>]"
value="D">
<?php echo $row['option_d']; ?>
</label>

</div>

<?php

$i++;

}

?>

<button type="submit" class="submit-btn">
Submit Quiz
</button>

</form>

</div>

</body>
</html>