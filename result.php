<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "online_quiz");

$score = 0;
$total = 0;

if (isset($_POST['answer'])) {

    foreach ($_POST['answer'] as $question_id => $answer) {

        $question_id = intval($question_id);

        $query = $conn->query(
            "SELECT correct_answer FROM questions
             WHERE id=$question_id"
        );

        $row = $query->fetch_assoc();

        if ($answer == $row['correct_answer']) {
            $score++;
        }

        $total++;
    }
}

$student_id = $_SESSION['student_id'];

$conn->query(
    "INSERT INTO results(student_id,score,total)
     VALUES('$student_id','$score','$total')"
);
?>

<!DOCTYPE html>
<html>
<head>

<title>Quiz Result</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="result">

<h1>Quiz Completed!</h1>

<h2>Your Result</h2>

<div class="score">

<?php echo $score; ?> / <?php echo $total; ?>

</div>

<p>
<?php echo $_SESSION['student_name']; ?>
</p>

<a href="quiz.php" class="btn">Try Again</a>

<a href="logout.php" class="btn">Logout</a>

</div>

</body>
</html>