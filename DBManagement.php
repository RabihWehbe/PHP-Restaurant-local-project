<?php
require_once("DBConnect.php");
$con = ConnectToDB('localhost', 'root', '', 'Restaurant');
session_start();
//1)check user type:could be admin,receptionist,or a book from client
//2)if there is no user-type => client => new booking
//3)else: check operation type; especially for admin 
if (isset($_SESSION['user-type'])) {
    if ($_SESSION['user-type'] == 'admin') {
        if ($_POST['op-type'] == 'addItem') {
            $section = $_POST['section'];
            $item = $_POST['item'];
            $price = $_POST['price'];
            $target_dir = "C:\Users\Rabih\OneDrive\Documents\PHPTest\Resources";
            foreach ($_FILES as $uploads => $distinct_file) {
                if (is_uploaded_file($distinct_file['tmp_name'])) {
                    $name = "name";
                    $file = $distinct_file['name'];
                    move_uploaded_file($distinct_file['tmp_name'], "$target_dir/$distinct_file[$name]") or die("Couldn't copy");
                    $image_path = "Resources/$file";
                    insertMenuItem($con, $section, $item, $image_path, $price);
                    echo "done<br>";
                } else {
                    echo $distinct_file['error'];
                }
            }
        } elseif ($_POST['op-type'] == 'updateItem') {
            $section = $_POST['section'];
            $item = $_POST['item'];
            $newItemName = $_POST['newItemName'];
            $price = $_POST['price'];
            $target_dir = "C:\Users\Rabih\OneDrive\Documents\PHPTest\Resources";
            foreach ($_FILES as $uploads => $distinct_file) {
                if (is_uploaded_file($distinct_file['tmp_name'])) {
                    $name = "name";
                    $file = $distinct_file['name'];
                    move_uploaded_file($distinct_file['tmp_name'], "$target_dir/$distinct_file[$name]") or die("Couldn't copy");
                    $image_path = "Resources/$file";
                    updateMenuItem($con, $section, $item, $newItemName, $image_path, $price);
                    echo "done<br>";
                } else {
                    echo $distinct_file['error'];
                }
            }
        } else {
            $section = $_POST['section'];
            $item = $_POST['item'];
            DeleteItem($con, $section, $item);
            echo "done<br>";
        }
    } else {
        $date = $_POST['date'];
        echo $date . ":<br>";
        $result = getReservation($date);
        if ($result->num_rows == 0) {
            die("No reservations in the speciefied date");
        } else {
            echo '<ul>';
            while ($row = $result->fetch_assoc()) {
                echo "<li> " . $row['cname'] . " reserved a table at " . $row['book_time'] . " for " . $row['nb_of_people'] . " people</li>";
            }
            echo '</ul>';
        }
    }
    session_destroy();
}

//else: the session is not set => client registeration(if no account and reservation)
//here use the function to register the client and echo to him a successful or failure message.
else {
    $cust_name = $_POST['guest-name'];
    $email = $_POST['guest-email'];
    $phone = $_POST['guest-phone'];
    $date = $_POST['resv-date'];
    $time = $_POST['resv-time'];
    $nb_of_people = $_POST['resv-count'];
    if (Reserve($con, $cust_name, $email, $phone, $date, $time, $nb_of_people) == 1) {
        echo "Reservation succesfully Done!!";
    } else {
        echo "Something Wrong!!!";
    }
}
?>

<html>
<a href="http://localhost:3000/Admin.php"><button>Go Back</button></a>

</html>