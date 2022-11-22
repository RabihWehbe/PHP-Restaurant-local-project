<?php
require_once("DBConnect.php");
$con = ConnectToDB('localhost', 'root', '', 'Restaurant');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="Logo">
            <img src="./Resources/La Petite.png" alt="">
            <p class="logo-description">
                pour le luxe de la cuisine et du goût</p>
        </div>
        <nav class="navbar">
            <div class="Resturant-title"><a href="index.html">La Petite Maison</a></div>
            <div class="nav-links">
                <ul>
                    <li><a href="index.html"> Home</a></li>
                    <li><a href="#About">About</a></li>
                    <li><a href="./Menu.html">Menu</a></li>
                    <li><a href="#Contact   ">Contact</a></li>
                </ul>
            </div>
        </nav>
        <div class="page-title">
            <h1>We Serve
                Taste of All french</h1>
        </div>
    </header>
    <section class="menu-page">
        <div class="menu-page-bk"></div>


        <div class="menu-page-section breakfast-page ">
            <div class="menu-Title"> Breakfast</div>
            <div class="Item-container reveal">

                <?php
                $section_name = 'Breakfast';
                $result = ItemsOfSection($con, $section_name); 
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $item = $row['item'];
                        $img = $row['image_path'];
                        $price = $row['price'];
                        echo "<div class='Item'>
                              <div class='Item-image' style='background-image:url($img)'></div>
                                <h3 id='Item-name'>$item</h3>
                                <h3 id='Item-price'>$price $</h3>
                                </div>";
                    }
                }
                ?>

            </div>
        </div>



        <div class="menu-page-section starters-page ">
            <div class="menu-Title"> Starters</div>
            <div class="Item-container reveal">
                <?php
                $section_name = 'Starters';
                $result = ItemsOfSection($con, $section_name);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $item = $row['item'];
                        $img = $row['image_path'];
                        $price = $row['price'];
                        echo "<div class='Item'>
                              <div class='Item-image' style='background-image:url($img)'></div>
                                <h3 id='Item-name'>$item</h3>
                                <h3 id='Item-price'>$price $</h3>
                                </div>";
                    }
                }
                ?>
            </div>
        </div>




        <div class="menu-page-section Salads-page ">
            <div class="menu-Title"> Salads</div>
            <div class="Item-container reveal">
                <?php
                $section_name = 'Salads';
                $result = ItemsOfSection($con, $section_name);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $item = $row['item'];
                        $img = $row['image_path'];
                        $price = $row['price'];
                        echo "<div class='Item'>
                              <div class='Item-image' style='background-image:url($img)'></div>
                                <h3 id='Item-name'>$item</h3>
                                <h3 id='Item-price'>$price $</h3>
                                </div>";
                    }
                }
                ?>
            </div>
        </div>



        <div class="menu-page-section MainCourse-page ">
            <div class="menu-Title"> MainCourse</div>
            <div class="Item-container reveal">
                <?php
                $section_name = 'MainCourse';
                $result = ItemsOfSection($con, $section_name);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $item = $row['item'];
                        $img = $row['image_path'];
                        $price = $row['price'];
                        echo "<div class='Item'>
                              <div class='Item-image' style='background-image:url($img)'></div>
                                <h3 id='Item-name'>$item</h3>
                                <h3 id='Item-price'>$price $</h3>
                                </div>";
                    }
                }
                ?>
            </div>
        </div>




        <div class="menu-page-section Desserts-page">
            <div class="menu-Title"> Desserts</div>
            <div class="Item-container reveal">
                <?php
                $section_name = 'Desserts';
                $result = ItemsOfSection($con, $section_name);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $item = $row['item'];
                        $img = $row['image_path'];
                        $price = $row['price'];
                        echo "<div class='Item'>
                              <div class='Item-image' style='background-image:url($img)'></div>
                                <h3 id='Item-name'>$item</h3>
                                <h3 id='Item-price'>$price $</h3>
                                </div>";
                    }
                }
                ?>
            </div>
        </div>




    </section>

    <footer>
        <footer class="footer">
            <p class="footer-title">CopyRights@ <span>Petite La Maison</span></p>
            <div class="social-icons">
                <a href="#">
                    <i class="fab fa-facebook"></i></a>

                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
            <div class="contact-info">
                <p id="phone">+33 1234567890</p>
                <p id="email">restuarant@mail.com</p>
                <a href="">


                    <i class="fa-light fa-map-pin"></i>Location</a>
            </div>
        </footer>
    </footer>

    <script src="./file.js"></script>

</body>

</html>