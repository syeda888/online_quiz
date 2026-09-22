let time = 300;

function startTimer() {

    let timer = setInterval(function () {

        let minutes = Math.floor(time / 60);
        let seconds = time % 60;

        seconds = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById("timer").innerHTML =
            "Time Left: " + minutes + ":" + seconds;

        time--;

        if (time < 0) {

            clearInterval(timer);

            document.getElementById("quizForm").submit();

        }

    }, 1000);
}

window.onload = startTimer;