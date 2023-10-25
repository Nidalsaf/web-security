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
$sql = "SELECT id, name, mail, phone FROM collage_info";
$result = $mysql->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>ניהול מידע</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg,orange,purple);
        }

        h2 {
            color: #000000;
            font-size: 35px;
            font-weight: bold;
            clear: both;
        }

        a {
            font-size: 20px;
            font-weight: bold;
            color: #150000;
            text-decoration: none;
            border: 2px solid;
            padding: 10px;
            border-radius: 8px;
            margin: 10px auto;
            display: inline-block;
            width: 30%;
        }
        .add_lect{
            width: 12%;
        }

        .add_lect:hover{
            box-shadow: 0 0 20px 0 black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #949494;
        }

         td {
            border: 2px solid #000000;
            text-align: center;

            font-weight: bold;
            font-size: 20px;
        }

        th {
            background-color: lightblue;
            color: #070000;
            border: 2px solid #000000;
            text-align: center;
            padding: 15px;
            font-weight: bold;
            font-size: 25px;
        }

        tr:nth-child(even) {
            background-color: #e8e8e8;
        }

        tr:nth-child(odd) {
            background-color: #e8e8e8;
            padding: 10px;
        }

        .btn{
            padding: 5px;
            width: 70px;
            background: #9FEF00;
            border-radius: 20px;
            float: right;
            margin-right: 10px;
        }

        .btn:hover{
            box-shadow: 0 0 20px 0 #9FEF00;
            border: unset;
        }
    </style>
</head>
<body>
<center>
    <form   method="POST" action="../web/logOut.php">
        <input class="btn" type="submit" value="logout">
    </form>
<h2>ניהול מידע</h2>
<a class="add_lect" href="add_lecturer.php">הוספת מרצה חדש</a>
</center>
<table>
    <tr>
        <th>שם</th>
        <th>מספר תיבת דואר</th>
        <th>מספר טלפון</th>
        <th>פעולות</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["mail"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
            echo "<td><a href='edit_lecturer.php?id=" . $row["id"] . "'>ערוך</a>    <a href='delete_lecturer.php?id=" . $row["id"] . "'>מחק</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>0 תוצאות</td></tr>";
    }
    ?>
</table>
</body>
</html>

