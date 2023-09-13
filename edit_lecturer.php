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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $phone = $_POST["phone"];
    $sql = "UPDATE collage_info SET name = '$name', mail = '$mail', phone = '$phone' WHERE id = $id";
    if ($mysql->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . $mysql->error;
    }
}
$id = $_GET["id"];
$sql = "SELECT id, name, mail, phone FROM collage_info WHERE id = $id";
$result = $mysql->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
} else {
    echo "מרצה לא נמצא";
    exit;
}
$mysql->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>עריכת מרצה</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h2 {
            color: #333;
            font-family: "Mongolian Baiti";
            font-size: 3rem;
            text-align: center;
        }

        form {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 5px #888888;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<h2>Edit Page</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"><!--XSS-->
    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
    שם: <input type="text" name="name" value="<?php echo $row["name"]; ?>" required><br>
    מספר תיבה: <input type="number" name="mail" value="<?php echo $row["mail"]; ?>" required><br>
    מספר טלפון: <input type="text" name="phone" value="<?php echo $row["phone"]; ?>"><br>
    <input type="submit" value="ערוך מרץ">
</form>
</body>
</html>
