<?php

function ConnectToDB($Sname, $Uname, $p, $db)
{
    $con = new mysqli($Sname, $Uname, $p, $db);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } else {
        return $con;
    }
}


function insertMenuItem($con, $section_name, $item, $image_path, $price)
{
    $sql = "SELECT Section.SID
    FROM Section
    where section = '$section_name'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $SID = $row['SID'];
        $sql1 = "INSERT INTO Menu (SID,item,image_path,price)
        VALUES ($SID,'$item','$image_path',$price);";
        if ($con->query($sql1)) {
            echo "item added succesfully!!";
        } else {
            echo $con->error;
        }
    } else {
        echo "there must be an existing section to insert the item!!!";
    }
}

function updateMenuItem($con, $section_name, $item_name, $newItemName, $image_path, $price)
{
    $sid = getSectionId($con, $section_name);
    $sql = "UPDATE Menu SET item = '" . $newItemName . "' ,image_path = '" . $image_path . "', price = '" . $price . "'" .
        " WHERE item = '" . $item_name . "' AND SID = " . $sid . "";
    if ($con->query($sql) === TRUE) {
        echo "item updated successfully";
    } else {
        echo "Error updating record: " . $con->error;
    }

    $con->close();
}


function getSectionId($con, $section_name)
{
    $sql = "SELECT Section.SID
    FROM Section
    where section = '$section_name'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $SID = $row['SID'];
    }
    return $SID;
}

function ItemsOfSection($con, $section_name)
{
    $SID = getSectionId($con, $section_name);
    $sql = "SELECT item,image_path,price FROM Menu
    WHERE SID = $SID;";
    $result = $con->query($sql);
    return $result;
}

function DeleteItem($con, $section, $item)
{
    $SID = getSectionId($con, $section);
    $sql = "Delete FROM Menu WHERE SID = $SID AND item = '" . $item . "';";
    if ($con->query($sql) === TRUE) {
        echo "item deleted successfully";
    } else {
        echo "failure: " . $con->error;
    }
}

function LoginCursor($name, $email)
{
    $con = ConnectToDB('localhost', 'root', '', 'Restaurant');
    $sql = "SELECT * FROM Staff where name = '" . $name . "' AND email = '" . $email . "'";
    $result = $con->query($sql);
    return $result;
}

function getReservation($date)
{
    $con = ConnectToDB("localhost", "root", '', "Restaurant");
    $sql = "SELECT cname,book_time,nb_of_people FROM Reservations AS r,Client as c 
    where r.cid = c.cid AND book_date = '" . $date . "';";
    $result = $con->query($sql);
    return $result;
}

function Res($date, $time)
{
    $sql = "SELECT rid FROM Reservations WHERE book_date = '" . $date . "' AND book_time = '" . $time . "';";
    $con = ConnectToDB("localhost", "root", '', "Restaurant");
    $check_res = $con->query($sql);
    if ($check_res->num_rows != 0) {
        return 0;
    } else return 1;
}

function Reserve($con, $cust_name, $email, $phone, $date, $time, $nb_of_people)
{
    if (Res($date, $time) == 1) {
        $sql = "SELECT cid FROM Client WHERE cname = '" . $cust_name . "' AND cemail = '" . $email . "'AND phone = '" . $phone . "';";
        $check_Client = $con->query($sql);
        if ($check_Client->num_rows != 0) {
            $get_Cid = $check_Client->fetch_assoc();
            $cid = $get_Cid['cid'];
            // $sql1 = "SELECT book_date,book_time FROM Reservations WHERE cid = $cid;";
            // $check = $con->query($sql1);
            // if ($check->num_rows > 0) {
            //     break;
            // }
            // $info = $check->fetch_assoc();
            // $date = $info['book_date'];
            // $time = $info['book_time'];
            //Check if HE Can Reserve
            $sql3 = "INSERT INTO Reservations(cid,book_date,book_time,nb_of_people) VALUES ($cid,'$date','$time','$nb_of_people');";
            if ($con->query($sql3)) {
                echo "Reservation succesfully Done!!";
            } else {
                echo $con->error;
                return -1;
            }
        } else {
            $sql4 = "INSERT INTO Client (cname,cemail,phone) VALUES ('$cust_name','$email','$phone');";
            if ($con->query($sql4)) {
                $check_Client = $con->query($sql);
                $row = $check_Client->fetch_assoc();
                $cid = $row['cid'];
                $sql3 = "INSERT INTO Reservations(cid,book_date,book_time,nb_of_people) VALUES ($cid,'$date','$time','$nb_of_people');";
                if ($con->query($sql3)) {
                    echo "Reservation succesfully Donee!!";
                } else {
                    echo $con->error;
                    return -1;
                }
            } else {
                echo $con->error;
                return -1;
            }
        }
        return 1;
    } else {
        echo "A reservation in this time is already booked!!! <br>";
        return -1;
    }
}

//write a function to register a client if he has no account and the it will book a reservation for him.