<?php
session_start();
if (isset($_SESSION["user_image"])) {
    $userImage = $_SESSION["user_image"];

}
$userImage =  $_SESSION["user_image"]
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .quiz-container {
            max-width: 600px;
            margin: auto;
            text-align: left;
        }
        .question {
            margin-bottom: 15px;
        }
        .loading-screen {
            display: none;
        }
        .progress-bar-container {
            width: 100%;
            background-color: #ddd;
            border-radius: 5px;
            margin-top: 10px;
        }
        .progress-bar {
            width: 0%;
            height: 20px;
            background-color: #4caf50;
            border-radius: 5px;
            transition: width 5s ease-in-out;
        }
    </style>
</head>
<body>

<div class="quiz-container" id="quizForm">
    <h2>Take the Quiz to Find the Dino Best For You!</h2>
    <form id="quiz" onsubmit="return startProcessing()">
        <?php
        $questions = [
            "What magical ability would you like to have?" => ["The ability to teleport and bend space.", "The ability to fly and conjure fog.", "The ability to breathe fire.", "The ability to time travel and stop time."],
            "Which is your favorite creature?" => ["Humans", "Fairies", "Vampires", "Demons"],
            "Which of the following most closely describes your profession?" => ["Map Maker", "Magician", "Assassin", "Bandit"],
            "What is your weapon of choice?" => ["My fangs", "A hastily brandished shoe", "Pen and Paper", "Something Else"],
            "Which of the following articles would you read if all appear in the same magazine?" => [
                "Teen Boy Runs Away from Home, Parents Breathe a Sigh of Relief",
                "How to Turn an Ant Infestation into a Delicious Jam",
                "How to Entertain Yourself While Stuck in a Burning Building Awaiting the Firefighters",
                "I'd rather take the magazine apart and make paper planes out of its pages"
            ],
            "Should the government stop dumping all their money in a giant hole?" => ["Yes", "No"],
            "How would you describe your ideal pet?" => ["Very tasty", "Very intelligent", "Very obedient", "All of these"],
            "Where do you spend most of your time?" => ["The graveyard", "The park", "In a crumbling castle", "In a little hut on the outskirts of the city"],
            "Which of the following seems like the most horrifying nightmare?" => [
                "Being eaten by a giant marshmallow",
                "Finding a circle of strangers, who in the middle, god forbid, are forming a circle",
                "Having the urge to use the bathroom but the only available bathroom is in a Walmart",
                "Being turned into a cat with elevator music playing in your head"
            ],
            "Which of the following is your favorite team member?" => ["Awesome Sauce", "Thunder", "The Lion's Sin of Pride"]
        ];

        $qNumber = 1;
        foreach ($questions as $question => $options) {
            echo "<div class='question'><strong>Q$qNumber: $question</strong><br>";
            $optionLetter = 'a';
            foreach ($options as $option) {
                echo "<label><input type='radio' name='q$qNumber' value='$option'> $optionLetter. $option</label><br>";
                $optionLetter++;
            }
            echo "</div>";
            $qNumber++;
        }
        ?>
        <button type="submit" id="submitBtn" disabled>Submit</button>
    </form>
</div>

<div class="loading-screen" id="loadingScreen">
    <h2>Using our omnipotence and telepathy to find the best dinosaur...</h2>
    <div class="progress-bar-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("quiz");
        const submitBtn = document.getElementById("submitBtn");

        form.addEventListener("change", function() {
            let allAnswered = true;
            for (let i = 1; i <= 10; i++) {
                if (!document.querySelector(`input[name="q${i}"]:checked`)) {
                    allAnswered = false;
                    break;
                }
            }
            submitBtn.disabled = !allAnswered;
        });
    });

    function startProcessing() {
        document.getElementById("quizForm").style.display = "none";
        document.getElementById("loadingScreen").style.display = "block";
        
        // Start progress bar animation
        document.getElementById("progressBar").style.width = "100%";

        // Redirect after 5 seconds with a random result
        setTimeout(function() {
            const result = Math.floor(Math.random() * 14) + 1;
            window.location.href = "Product.php?id=" + result;
        }, 5000);

        return false; // Prevent form submission
    }
</script>

</body>
</html>
