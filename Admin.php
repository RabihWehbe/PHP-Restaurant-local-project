<?php
require_once("DBConnect.php");
if (!isset($_POST['name']) || !isset($_POST['email'])) {
    header("location: StaffLogin.html");
} else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    if (!preg_match("/^[a-zA-Z0-9_.-]+@email+.[a-zA-Z0-9-.]+$/", $email)) {
        die("Please enter a valid email format");
    }
    $result = LoginCursor($name, $email);
    if ($result->num_rows == 0) {
        die("Invalid login");
    }
}
$row = $result->fetch_assoc();
$type = $row['type'];
session_start();
if ($type == 'SuperAdmin') {
    $_SESSION['user-type'] = 'admin';
    echo '
    <html>

<body>
    <div style="margin-bottom: 200px;">
        <h3 style="color: chartreuse;">Add a new item:</h3>
        <form action="http://localhost:3000/DBManagement.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="op-type" value="addItem">


            <label for="section">Section:</label><br>
            <input type="text" placeholder="Section Title" name="section"><br>

            <label for="item">item:</label><br>
            <input type="text" placeholder="item" name="item"><br>

            <label for="price">price:</label><br>
            <input type="number" placeholder="price in $" name="price"><br>

            <p>
            <h4>upload an image:</h4>
            </p>
            <input type="file" name="image_path"><br>

            <input type="submit" value="submit">
        </form>
    </div>

    <div style="margin-bottom: 200px;margin: top 100px;">
        <h3 style="color:aqua;">update an existing item:</h3>
        <form action="http://localhost:3000/DBManagement.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="op-type" value="updateItem">


            <label for="section">Section:</label><br>
            <input type="text" placeholder="Section Title" name="section"><br>

            <label for="item">item:</label><br>
            <input type="text" placeholder="old item name" name="item"><br>

            <label for="newItemName"> new name:</label><br>
            <input type="text" placeholder="new item name" name="newItemName"><br>

            <label for="price">price:</label><br>
            <input type="number" placeholder="price in $" name="price"><br>

            <p>
            <h4>upload an image:</h4>
            </p>
            <input type="file" name="image_path"><br>

            <input type="submit" value="submit">
        </form>
    </div>

    <div style="margin-bottom: 200px;margin: top 100px;">
        <h3 style="color:aqua;">delete an existing item:</h3>
        <form action="http://localhost:3000/DBManagement.php" method="post">

            <input type="hidden" name="op-type" value="deleteItem">


            <label for="section">Section:</label><br>
            <input type="text" placeholder="Section Title" name="section"><br>

            <label for="item">item:</label><br>
            <input type="text" placeholder="old item name" name="item"><br>

            <input type="submit" value="submit">
        </form>
    </div>
</body>

</html>
    ';
} else {
    $_SESSION['user-type'] = 'reception';
    echo '
    <html>
    <head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <p>select to see the clients reserved in a specific date:</p>
    <div style="margin:100px 100px">
    <form action="http://localhost:3000/DBManagement.php" method="post">
        <input type="date" class="resv-input" id="resv-date" name="date"><br>
        <input value="submit" type="submit">
    </form>
    </div>
</html>
    ';
}