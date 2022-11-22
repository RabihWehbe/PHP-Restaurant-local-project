<?php
require_once("DBConnect.php");
$con = ConnectToDB("localhost", "root", "", "Restaurant");


$sql1 = "CREATE TABLE Section (
    SID int NOT NULL AUTO_INCREMENT,
    section varchar(30),
    PRIMARY KEY (SID)
);";

$sql2 = "CREATE TABLE Menu (
    SID int NOT NULL,
    item varchar(30) NOT NULL,
    image_path varchar(100) NOT NULL, 
    price int NOT NULL,
    PRIMARY KEY (item),
    CONSTRAINT FK_SectionId FOREIGN KEY (SID)
    REFERENCES Section(SID)
);";

$sql3 = "CREATE TABLE Client (
    cid int NOT NULL AUTO_INCREMENT,
    cname varchar(50) NOT NULL,
    cemail varchar(50) NOT NULL,
    phone varchar(50),
    PRIMARY KEY (cid)
);";

$sql4 = "CREATE TABLE Reservations (
    rid int NOT NULL AUTO_INCREMENT,
    cid int NOT NULL,
    book_date varchar(50) NOT NULL,
    book_time varchar(50) NOT NULL,
    phone varchar(50),
    PRIMARY KEY (rid),
    CONSTRAINT FK_ClientId FOREIGN KEY (cid)
    REFERENCES Client(cid)
);";

if ($con->query($sql1) === TRUE) {
    echo "Section created successfully<br>";
} else {
    echo "Error creating database: " . $con->error . "<br>";
}

if ($con->query($sql2) === TRUE) {
    echo "Menu created successfully";
} else {
    echo "Error creating database: " . $con->error . "<br>";
}

if ($con->query($sql3) === TRUE) {
    echo "Client created successfully";
} else {
    echo "Error creating database: " . $con->error . "<br>";
}

if ($con->query($sql4) === TRUE) {
    echo "Reservations created successfully";
} else {
    echo "Error creating database: " . $con->error;
}