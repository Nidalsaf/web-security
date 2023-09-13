<?php
session_start();

$max_attempts = 3;
$block_duration = 10;

//Brute Force
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['block_start_time']) && time() - $_SESSION['block_start_time'] < $block_duration) {
        $remaining_time = $block_duration - (time() - $_SESSION['block_start_time']);
        $error_message = "Too many login attempts. Please try again in " . $remaining_time . " seconds.";
    } else {
        $password = $_POST["password"];
        $correct_password = "AAA";

        if ($password === $correct_password) {
            unset($_SESSION['login_attempts']);
            unset($_SESSION['block_start_time']);
            $_SESSION["authenticated"] = true;
            header("Location: index.php");
            exit;
        } else {
            if (!isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts'] = 1;
            } else {
                $_SESSION['login_attempts']++;
                if ($_SESSION['login_attempts'] >= $max_attempts) {
                    // Set the block start time
                    $_SESSION['block_start_time'] = time();
                    $error_message = "Too many login attempts. Please try again in $block_duration seconds.";
                }
            }
            $error_message = "סיסמה שגויה";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lec-Page</title>
    <style>
        body {
            background-color: teal;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2 {
            font-size: 3rem;
            font-weight: bold;
            text-align: center;
            font-family: sans-serif;
        }

        .container {
            width: 60%;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            width: 50%;
        }

        input[type="password"] {
            width: 50%;
            height: 20px;
            margin-bottom: 10px;
            box-shadow: 0 0 20px 0 white;
        }

        input[type="submit"] {
            background: green;
            padding: 5px;
            margin: auto;
            border-radius: 5px;
            width: 70px;
            font-size: medium;

        }

        input[type="submit"]:hover {
            background-color: black;
            color: green
        }

        p.error-message {
            color: red;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Please Enter Your Password</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <!--XSS prevention-->
        <label for="password"> <input type="password" name="password" placeholder="Password" maxlength="3" minlength="3"
                                      required></label>
        <input type="submit" value="login">
    </form>
</div>

<?php
if (isset($error_message)) {
    echo "<p class='error-message'>$error_message</p>";
}
?>
</body>
</html>
