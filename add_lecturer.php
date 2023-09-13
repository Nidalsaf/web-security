<?php
session_start();
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

if (!isset($_SESSION["authenticated"]) || !$_SESSION["authenticated"]) {
    header("Location: login.php");
    exit;
}

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

// Generate a CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = uniqid('', true); // Generate a token based on the current time
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF Token validation failed!");
    }

    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO collage_info (name, mail, phone)
            VALUES ('$name', '$mail', '$phone')";

    if ($mysql->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $mysql->error;
    }
}

$mysql->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>הוספת מרצה חדש</title>
    <style>

        body {
            height: 100%;
            background: #141D2B;
            color: white;
        }

        label {
            display: block;
            margin: 10px auto;
        }

        .body {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .btn {
            border-radius: 20px;
            padding: 5px;
            margin-right: 70px;
            margin-top: 10px;
        }

        .btnn {
            display: flex;
            justify-content: center;
            align-items: center;

        }

    </style>
</head>
<body>
<div class="body">
    <h1>הוספת מרצה חדש</h1>

    <form method="POST" action="">

        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="mail">postal code:</label>
        <input type="number" name="mail" id="mail" required>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required><br>

        <button class="btn" type="submit">Submit</button>
    </form>
</body>
</html>