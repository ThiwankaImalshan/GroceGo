<?php
    session_start();

    // Initialize the loggedin session variable
        if (!isset($_SESSION["loggedin"])) {
            $_SESSION["loggedin"] = false;
        }

?>

<?php
    if(isset($_POST['Logout'])){
        session_destroy();
        header("location: index.php");
    }
?> 


<?php

$isLoggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]; // Check if $_SESSION["loggedin"] is set and true

?>


<?php
    // Database connection
        require("config.php");

    // Fetch top products from the database where products_top is True
        $query = "SELECT * FROM category WHERE products_top = 'True'";
        $result = $conn->query($query);

    // Store products in an array
        $topProducts = [];
            while ($row = $result->fetch_assoc()) {
                $topProducts[] = $row;
            }

    // Calculate the number of rows needed
        $numRows = ceil(count($topProducts) / 3);
?>



<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GrocGo</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <style>
            .disabled-button {
                opacity: 0.5;
                pointer-events: none;
            }
            .warning-message p{
                color:red;
                font-family: "Inter", sans-serif;
                font-optical-sizing: auto;
                font-weight: 600;
                font-style: normal;
                font-variation-settings: "slnt" 0;
                font-size: 15px;
                padding-left: 30px;
                padding-top: 20px;
            }
            .userProfileImg{
                width: 35px;
                height:35px;
                border-radius: 35px;
            }


            .popupProfile {
                display: none;
                position: absolute;
                top: 70px;
                right: 45px;
                width: 250px;
                height:300px;
                border-radius: 10px;
                background-color: #f9f9f9;
                min-width: 120px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1000;
                font-family: "Inter", sans-serif;
            }

            .popupProfile button {
                margin-top: 50px;
                color: white;
                padding: 5px 15px;
                border-radius: 5px;
                text-decoration: none;
                display: block;
                font-weight: 600;
                font-size: 15px;
                background-color: green;
                border: 1px solid green;
            }

            .popupProfile button:hover {
                color:white;
                cursor: pointer;
                background-color: #51ac37;
                border: 1px solid #51ac37;
            }

            .popupProfile img {
                margin-left:75px;
                margin-top: 30px;
                padding: 5px;
                border: 2px solid black;
                width: 100px; /* Adjust image size as needed */
                border-radius: 50%; /* Make the image round */
                margin-bottom: 10px;
            }

            .popupProfile h4 {
                color: black;
                margin-bottom: 10px;
            }

            .popupProfile .close {
                color:black;
                position: absolute;
                top: 10px;
                right: 15px;
                font-size: 25px;
                cursor: pointer;
            }

        </style>
    </head>

    <body onload="loadingFunction()">
    
        <div id="loader">
            <img src="img/G icon.gif" alt="">
        </div>

        <div id="container" style="display:none; width:fit-content;">


        <!-- Navigation Bar/Header -->
        <header>
                <div class="header-navbar">
                    <div class="navbar-row">
                        <div class="navbar-logo">
                            <h2>GrocGo</h2>
                        </div>
                        <div class="navbar-items">
                            <ul>
                                <h3><a href="index.php">Home</a></h3>
                                <h3><a href="product.php">Products</a></h3>
                                <h3><a href="services.php">Services</a></h3>
                                <h3><a href="about.php">About Us</a></h3>

                                <button class="hamburger rpbtn">&#9776;</button>
                                <button class="cross rpbtn" title="Close">&#735;</button>

                                <div class="navbar-cart" title="Cart">
                                    <small>Add to Cart</small>
                                    <i class="fa fa-shopping-cart" aria-hidden="true">
                                        <span id="smart-checkout-count" class="badge">0</span>
                                    </i>
                                </div>
                                <div class="navbar-signin" title="Sign in">
                                    <!-- <i class="fa fa-user-circle-o" aria-hidden="true" id="signin-popup-icon"></i> -->

                                    <?php if ($isLoggedIn): ?>
                                            <img src="img/Customer.png" class="userProfileImg" alt="User Profile Image" id="signin-popup-img" onclick="togglePopup()">
                                            <div class="popupProfile" id="profilePopup">
                                                <span class="close" onclick="togglePopup()">&times;</span> <!-- Close button -->
                                                <img src="img/Customer.png" alt="User Profile Image">
                                                <form action="" method="POST">
                                                    <center>
                                                    <h4>Welcome to GrocGo!</h4>
                                                    <button name="Logout">Sign Out</button>
                                                    </center>
                                                </form>
                                            </div>
                                    <?php else: ?>
                                            <i class="fa fa-user-circle-o" aria-hidden="true" id="signin-popup-icon"></i>
                                    <?php endif; ?>

                                    <div class="signin-popup" id="signup-popup">
                                        <div class="signin-popup-content">
                                            <span class="signin-popup-close" id="signin-popup-close1">&times;</span>
                                            <h3>Sign Up</h3>
                                            <form action="customer_signup.php" method="post" id="SignUpForm">
                                                <div class="form-field-wrapper flex">
                                                    <div class="form-field-wrapper">
                                                    <input type="text" id="fname" name="fname" placeholder="First Name*" required/>
                                                    </div>
                                                    <div class="form-field-wrapper">
                                                    <input type="text" id="lname" name="lname" placeholder="Last Name*" required/>
                                                    </div>
                                                </div>

                                                <div class="form-field-wrapper">
                                                    <input type="text" id="email" name="email" placeholder="Email*" required/>
                                                </div>

                                                <div class="form-field-wrapper">
                                                    <input type="text" id="tel" name="tel" placeholder="Phone*" required />
                                                </div>
                                                
                                                <div class="form-field-wrapper">
                                                    <input type="password" id="password" name="password" placeholder="Password*" required/>
                                                </div>

                                                <div class="form-field-wrapper">
                                                    <input type="password" id="password" name="password" placeholder="Confirm Password*" required/>
                                                </div>
                                            <div class="form-field-bottom">
                                                <div class="form-bottom-checkbox">
                                                    <input type="checkbox" name="checkbox" id="termsCheckbox"><span class="form-bottom-checkbox-label">Accept <strong>Terms & Conditions</strong></span><br>
                                                </div>
                                                <button type="submit">Create Account</button><br><br>
                                                <span class="form-field-bottom-p">Already have an account? <span id="switchToSignIn"><b>Sign In</b></span></span>
                                            </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="signin-popup" id="signin-popup" style="display: none;">
                                        <div class="signin-popup-content">
                                            <span class="signin-popup-close" id="signin-popup-close2">&times;</span>
                                            <h3>Sign In</h3>
                                            <form action="signIn.php" method="post">

                                                <div class="form-field-wrapper">
                                                    <input type="text" id="login_email" name="login_email" placeholder="Email*" required/>
                                                </div>
                                                
                                                <div class="form-field-wrapper">
                                                    <input type="password" id="login_password" name="login_password" placeholder="Password*" required/>
                                                </div>

                                            
                                            <div class="form-field-bottom">
                                                <div class="form-bottom-checkbox">
                                                    <!-- <input type="checkbox" name="" id=""><span class="form-bottom-checkbox-label">Remember me</span><br> -->
                                                </div>
                                                <button type="submit">Login</button><br><br>
                                                <span class="form-field-bottom-p">I don't have an account? <span id="switchToSignUp"><b>Sign Up</b></span></span>
                                            </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </ul>
                        </div>
                    </div>


                    <!-----Responsive navigation bar-->
                    <div class="menu rpbtn">
                        <ul>
                        <a href="index.php"><li>Home</li></a>
                        <a href="product.php"><li>Product</li></a>
                        <a href="services.php"><li>Service</li></a>
                        <a href="about.php"><li>About Us</li></a>
                        
                        </ul>
                    </div> 
                    
                    <div class="header-searchbar">
                        <div class="product-search">
                            <div class="category_menu_btn_product_search" id="btn-categories">
                                <span>Categories </span>
                                <i class="fa fa-angle-down" style="padding-left: 0.9375rem;"></i>
                            </div>
                            <div class="auto-complete-text">
                                <input type="text" placeholder="Search for any product" value="" id="searchInput" onkeyup="suggestProducts()" title="Search" spellcheck="true">
                                <ul id="searchResults" class="search-result"></ul>
                            </div>
                            <button class="product-search-button" onclick="passDataAndRedirect()">
                                <span>SEARCH PRODUCTS </span>
                                <i class="fa fa-search" style="padding-left: 0.625rem;"></i>
                            </button>
                        </div>
                        

                        <!-- Drop Down Menu -->
                        <div class="category-drop-down-menu" id="category_menu_default_header" style="display: block;">
                            <img src="img/close Button.png" alt="menu-close_btn" class="category-menu-default-header-close-btn" id="close-category-menu" title="Close">
                            <div class="category-menu-default-header-container">
                                <ul class="category_menu_default_header-area">

                                    <li id="dep_id_1">Vegetables 
                                        <span>
                                            <i class="fa fa-angle-right"></i>
                                        </span>
                                    </li>
                                    <ul id="sub_dep_id_1" style="display: none;">
                                        <a onclick="handleItemClick('sub_dep_1_all')">
                                            <li class="cat_item_" data-cat-id="all">
                                                <strong>All Vegetables</strong>
                                            </li>
                                        </a>
                                        <a onclick="handleItemClick('sub_dep_1_all')">
                                            <li>Organic</li>
                                        </a>
                                        <a onclick="handleItemClick('sub_dep_1_all')">
                                            <li>Inorganic</li>
                                        </a>
                                        <a onclick="handleItemClick('sub_dep_1_all')">
                                            <li>Packets</li>
                                        </a>
                                    </ul>
                                    
                                    <li id="dep_id_2">Fruits 
                                        <span>
                                            <i class="fa fa-angle-right"></i>
                                        </span>
                                    </li>
                                        <ul id="sub_dep_id_2" style="display: none;">
                                            <a onclick="handleItemClick('sub_dep_2_all')">
                                                <li class="cat_item_" data-cat-id="all">
                                                    <strong>All Fruits</strong>
                                                </li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_2_all')">
                                                <li>Organic</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_2_all')">
                                                <li>Inorganic</li>
                                            </a>
                                        </ul>

                                        <li id="dep_id_3">Meat 
                                            <span>
                                                <i class="fa fa-angle-right"></i>
                                            </span>
                                        </li>
                                        <ul id="sub_dep_id_3" style="display: none;">
                                            <a onclick="handleItemClick('sub_dep_3_all')">
                                                <li class="cat_item_" data-cat-id="all">
                                                    <strong>All Meat</strong>
                                                </li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_3_all')">
                                                <li>Fresh Meat</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_3_all')">
                                                <li>Processed Meat Serve Over</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_3_all')">
                                                <li>Frozen Chicken</li>
                                            </a>
                                        </ul>

                                        <li id="dep_id_4">Fish 
                                            <span>
                                                <i class="fa fa-angle-right"></i>
                                            </span>
                                        </li>
                                        <ul id="sub_dep_id_4" style="display: none;">
                                            <a onclick="handleItemClick('sub_dep_4_all')">
                                                <li class="cat_item_" data-cat-id="all">
                                                    <strong>All Fish</strong>
                                                </li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_4_all')">
                                                <li>Fresh Sea Food</li>
                                            </a>
                                        </ul>

                                        <li id="dep_id_5">Rice 
                                            <span>
                                                <i class="fa fa-angle-right"></i>
                                            </span>
                                        </li>
                                        <ul id="sub_dep_id_5" style="display: none;">
                                            <a onclick="handleItemClick('sub_dep_5_all')">
                                                <li class="cat_item_" data-cat-id="all">
                                                    <strong>All Rice</strong>
                                                </li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_5_all')">
                                                <li>Local Rice</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_5_all')">
                                                <li>Imported Rice</li>
                                            </a>
                                        </ul>
                                        
                                        <li id="dep_id_6">Beverages 
                                            <span>
                                                <i class="fa fa-angle-right"></i>
                                            </span>
                                        </li>
                                        <ul id="sub_dep_id_6" style="display: none;">
                                            <a onclick="handleItemClick('sub_dep_6_all')">
                                                <li class="cat_item_" data-cat-id="all">
                                                    <strong>All Beverages</strong>
                                                </li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_6_all')">
                                                <li>Juices &amp; Carbonates</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_6_all')">
                                                <li>Malt Drink</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_6_all')">
                                                <li>Sports &amp; Energy Drinks</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_6_all')">
                                                <li>Milk &amp; Creamers</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_6_all')">
                                                <li>RTD Beverages</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_6_all')">
                                                <li>Water</li>
                                            </a>
                                        </ul>

                                        <li id="dep_id_7">Chilled 
                                            <span>
                                                <i class="fa fa-angle-right"></i>
                                            </span>
                                        </li>
                                        <ul id="sub_dep_id_7" style="display: none;">
                                            <a onclick="handleItemClick('sub_dep_7_all')">
                                                <li class="cat_item_" data-cat-id="all">
                                                    <strong>All Chilled</strong>
                                                </li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_7_all')">
                                                <li>Desserts</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_7_all')">
                                                <li>Cheese</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_7_all')">
                                                <li>Yoghurt</li>
                                            </a>
                                        </ul>

                                        <li id="dep_id_8">Grocery 
                                            <span>
                                                <i class="fa fa-angle-right"></i>
                                            </span>
                                        </li>
                                        <ul id="sub_dep_id_8" style="display: none;">
                                            <a onclick="handleItemClick('sub_dep_8_all')">
                                                <li class="cat_item_" data-cat-id="all">
                                                    <strong>All Grocery</strong>
                                                </li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_8_all')">
                                                <li>Pasta &amp; Noodles</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_8_all')">
                                                <li>Snacks</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_8_all')">
                                                <li>Cerials</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_8_all')">
                                                <li>Oils</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_8_all')">
                                                <li>Sauces</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_8_all')">
                                                <li>Flour</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_8_all')">
                                                <li>Biscuits</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_8_all')">
                                                <li>Sugar</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_8_all')">
                                                <li>Eggs</li>
                                            </a>
                                        </ul>
                                        <li id="dep_id_9">Pharmacy 
                                            <span>
                                                <i class="fa fa-angle-right"></i>
                                            </span>
                                        </li>
                                        <ul id="sub_dep_id_9" style="display: none;">
                                            <a onclick="handleItemClick('sub_dep_9_all')">
                                                <li class="cat_item_" data-cat-id="all">
                                                    <strong>All Pharmacy</strong>
                                                </li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_9_all')">
                                                <li>Skin &amp; Hair Care</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_9_all')">
                                                <li>First Aid</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_9_all')">
                                                <li>Lifestyle &amp; Wellbeing</li>
                                            </a>
                                        </ul>
                                        <li id="dep_id_10">Bakery Production
                                            <span>
                                                <i class="fa fa-angle-right"></i>
                                            </span>
                                        </li>
                                        <ul id="sub_dep_id_10" style="display: none;">
                                            <a onclick="handleItemClick('sub_dep_10_all')">
                                                <li class="cat_item_" data-cat-id="all">
                                                    <strong>All Bakery Production</strong>
                                                </li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_10_all')">
                                                <li>Bakery</li>
                                            </a>
                                        </ul>
                                        <li id="dep_id_11">Homeware
                                            <span>
                                                <i class="fa fa-angle-right"></i>
                                            </span>
                                        </li>
                                        <ul id="sub_dep_id_11" style="display: none;">
                                            <a onclick="handleItemClick('sub_dep_11_all')">
                                                <li class="cat_item_" data-cat-id="all">
                                                    <strong>All Homeware</strong>
                                                </li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_11_all')">
                                                <li>Tools</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_11_all')">
                                                <li>Kitchenware</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_11_all')">
                                                <li>Genaral Needs</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_11_all')">
                                                <li>Greeting Cards</li>
                                            </a>
                                            <a onclick="handleItemClick('sub_dep_11_all')">
                                                <li>Books &amp; Stationry</li>
                                            </a>
                                        </ul>
                            </div>
                        </div>

                    </div>
                </div>

    

                <!-- Cart-Tab -->
                <div class="cartTab">
                    <h1>Shopping Cart</h1>
                    <div class="listCart">

                    </div>
                    <div id="warning-checkout" class="warning-message" style="display: none;">
                        <p>! Sign in to place an order through Checkout.</p>
                    </div>
                    <div class="cartTab-btn">
                        <button class="cartTab-close">Close</button>
                        <button class="cartTab-checkOut" id="checkoutButton" onclick="document.location='checkout.php'">Check Out</button>
                    </div>
                </div>

        </header>



        <!-- Main container -->
        <main>
            <div class="main-container">
                <img class="background-img" src="img/Green Wave.jpg" alt="Green Wave" width="100%" draggable="false"> 
                <div class="main-subcontainer">
                    <div class="main-subcontainer-txt">
                        <h1 id="welcome-message">Order groceries <br> to your <br><span>Door Step</span></h1>
                        <br><br>
                        <p>Whatever you want from local stores, brought right to your door.</p>
                        <button class="btn-shopnow" onclick="document.location='search.php'">Shop Now</button>
                    </div>
                    <div class="main-subcontainer-img">
                        <img src="img/SuperMarket.png" alt="SuperMarket Cart" draggable="false">
                    </div>
                </div>
            </div>
        </main>



        <!-- Middle icons Bar -->
        <div class="middle-bar">
            <ul>
                <li><i class="fa fa-truck" aria-hidden="true"></i><p>Fresh to Your Door</p></li>
                <li><i class="fa fa-smile-o" aria-hidden="true"></i><p>More Choices</p></li>
                <li><i class="fa fa-shopping-bag" aria-hidden="true"></i><p>More Meals</p></li>
                <li><i class="fa fa-clock-o" aria-hidden="true"></i><p>Less Time Shopping</p></li>
            </ul>
        </div>



        <!-- Top Categories Title -->
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text"><span class="text_1">Top <strong>Categories</strong></span></div>
            <div class="section-title-line"></div>
        </div>



        <!-- Categorie Gallery -->
        <div class="gallery">
            <figure class="gallery__item gallery__item--1" data-task="task1">
                <img src="category img/Veg Banner.jpg" class="gallery__img" alt="Image 1" draggable="false">
                <figcaption class="gallery-caption"><p>Vegetables</p></figcaption>
            </figure>
            <figure class="gallery__item gallery__item--2" data-task="task2">
                <img src="category img/Rice Banner.jpg" class="gallery__img" alt="Image 2" draggable="false">
                <figcaption class="gallery-caption"><p>Rice & Cereals</p> </figcaption>
            </figure>
            <figure class="gallery__item gallery__item--3" data-task="task3">
                <img src="category img/Meat Banner.jpg" class="gallery__img" alt="Image 3" draggable="false">
                <figcaption class="gallery-caption"><p>Meat & Fish</p></figcaption>
            </figure>
            <figure class="gallery__item gallery__item--4" data-task="task4">
                <img src="category img/Milk Banner.jpg" class="gallery__img" alt="Image 4" draggable="false">
                <figcaption class="gallery-caption"><p>Dairy Products</p></figcaption>
            </figure>
        </div>



        <!-- Top Product Title -->
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text"><span class="text_1">Top <strong>Products</strong></span></div>
            <div class="section-title-line"></div>
        </div>



        <!-- Card Row -->
        <!-- <div class="carousel-container">
            <div class="carousel" id="rowBody">
            </div>
        </div> -->



        <div class="a-row-body">
            <div class="a-slider-container">
                <!-- <div class="a-slider" style="transform: translateX(0%);"> -->
                <?php
                    // Insert products into HTML structure
                        for ($i = 0; $i < $numRows; $i++) {
                            echo '<div class="a-slider" style="transform: translateX(0%);">';
                            echo '<ul>';
                            
                            for ($j = $i * 4; $j < min(($i + 1) * 4, count($topProducts)); $j++) {
                                $product = $topProducts[$j];

                                echo '<div class="row-card a-slider-item" data-id="' . $product['products_id'] . '">';
                                echo '<div class="row-card-img" onclick="redirectToProductDetail(' . $product['products_id'] . ')">';
                                echo '<img src="' . $product['products_image'] . '" alt="' . $product['products_name'] . '">';
                                echo '</div>';
                                echo '<div class="row-txt">';
                                echo '<h3>' . $product['products_name'] . '</h3>';
                                echo '<h4>Rs.' . $product['products_price'] . '</h4>';
                                
                                // Apply availability check and styling to the button
                                $buttonText = 'Add to Cart';
                                $buttonStyle = '';
                                $buttonDisabled = '';

                                if ($product['products_availability'] === 'out of stock') {
                                    $buttonText = 'Out of Stock';
                                    $buttonStyle = 'background-color: #DE3163; color: white; pointer-events: none;';
                                    $buttonDisabled = 'disabled';
                                }

                                echo '<button class="btn-addtocart" style="' . $buttonStyle . '" ' . $buttonDisabled . '>' . $buttonText . '</button>';
                                echo '</div>';
                                echo '</div>';
                            }
                        
                        echo '</ul>';
                        echo '</div>';
                    }
                    ?>
                <!-- </div> -->
            </div>
            <!-- <i class="fa fa-arrow-circle-left a-prev-btn fa-2x" aria-hidden="true"></i>
            <i class="fa fa-arrow-circle-right a-next-btn fa-2x" aria-hidden="true"></i> -->
        </div>

        <!-- <div class="row-body" >
            <ul class="row-body-ul" id="rowBody"> -->


                <!-- <div class="row-card">
                    <div class="row-card-img">
                        <img src="img/apple.jpg" alt="Product 1">
                    </div>
                    <div class="row-txt">
                        <h3>Fresh Apple</h3>
                        <h4>In Stock</h4>
                        <button class="btn-addtocart">
                            Add to Cart
                        </button>
                    </div>
                </div> -->

        <!-- 
            </ul>
        </div> -->


        <!-- Bottom Cards -->

        <div class="bottom-cards">
            <div class="bottom-card1">
                <p>Fresh to Your Door <br><span>Enjoy top-quality groceries deliverd fresh.</span></p>
                <img src="img/Delivary Bike.png" alt="Delivery Bike" draggable="false">
            </div>
            <div class="bottom-card2">
                <p>More Choices   <br><span>150+ products to inspire your culinary creations.</span></p>
                <img src="img/Grocery cart.png" alt="Grocery Cart" draggable="false">
            </div>
        </div>



        <!-- Footer Section -->
            <footer>
                <div class="footer-container">
                    <img src="img/footer-bg.png" alt="Footer Background" draggable="false">
                    <div class="footer-content">
                        <div class="footer-content-sec1">
                            <div class="footer-sec footer-sec1">
                                <h3>GrocGo</h3><br>
                                <p>Copyright © 2024 GrocGo  LK (PVT) Ltd. </p>
                                <p>All Rights Reserved</p>
                                <p>Designed & Developed by .......................</p>
                            </div>
                        </div>
                        <div class="footer-content-sec2">
                            <div class="footer-sec footer-sec2">
                                <h3>Customer Care</h3><br>
                                <p><a href="about.php">About US</a></p>
                                <p><a href="services.php">Services</a></p>
                                <p><a href="product.php">Products</a></p>
                            </div>
                            <div class="footer-sec footer-sec3">
                                <h3>Contact Us</h3><br>
                                <p><a href="tel:+9471234567"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;+9471234567</a></p>
                                <p><a href="https://maps.app.goo.gl/iZKTKozdvHXE7WxQ9"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Waidya Road, Dehiwala</a></p>
                                <p><a href="mailto: grocgo@gmail.com"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;grocgo@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div> 
    




    <script>


            function togglePopup() {
                var popup = document.getElementById("profilePopup");
                if (popup.style.display === "block") {
                    popup.style.display = "none";
                } else {
                    popup.style.display = "block";
                }
            }



            //------------Products suggestion in search bar---------
                function suggestProducts() {
                    const searchInput = document.getElementById('searchInput').value.toLowerCase();
                    const searchResultsContainer = document.getElementById('searchResults');
                    searchResultsContainer.innerHTML = ''; // Clear previous results

                    // Fetch products data from fetch_products.php
                    fetch(`suggest_products.php?search=${encodeURIComponent(searchInput)}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            const suggestions = data;
                            // Display suggestions if input is not empty and there are matches
                            if (searchInput !== '' && suggestions.length > 0) {
                                searchResultsContainer.style.display = 'block';
                                suggestions.forEach(suggestion => {
                                    const li = document.createElement('li');
                                    li.textContent = suggestion;
                                    li.addEventListener('click', () => {
                                        document.getElementById('searchInput').value = suggestion;
                                        searchResultsContainer.style.display = 'none';
                                        // Run searchProducts with the selected suggestion
                                        searchProducts();
                                    });
                                    searchResultsContainer.appendChild(li);
                                });
                            } else {
                                searchResultsContainer.style.display = 'none';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                        });
                }








            // Function to capture search input and redirect to search.php
                function passDataAndRedirect() {
                    const searchData = document.getElementById("searchInput").value.trim(); // Trim any whitespace
                    if (searchData !== "") { // Check if search input is not empty
                        // Encode search input to handle special characters
                        const encodedSearchData = encodeURIComponent(searchData);
                        // Redirect to search.php with search input as a query parameter
                        window.location.href = "search.php?searchInput=" + encodedSearchData;
                    } else {
                        console.log("Search input is empty. Redirect aborted.");
                    }
                }






        
            //----------Category Drop Down Menu----------

                //default category menu display none
                document.getElementById("category_menu_default_header").style.display = "none"
                // Display Category menu when click btn-categories.
                document.getElementById( 'btn-categories' ).addEventListener( 'click', function( event ) {
                    document.getElementById( 'category_menu_default_header' ).style.display = 'inline';
                    event.stopPropagation();
                });




                // // PHP to JavaScript: Check if the user is logged in
                // var isLoggedIn = <?php echo $_SESSION["loggedin"] ? 'true' : 'false'; ?>;
                
                // // Enable or disable the checkout button based on the login status
                // var checkoutButton = document.getElementById('checkoutButton');
                // if (!isLoggedIn) {
                //     checkoutButton.classList.add('disabled-button');
                // } else {
                //     checkoutButton.classList.remove('disabled-button');
                // }



                // PHP to JavaScript: Check if the user is logged in
                var isLoggedIn = <?php echo $_SESSION["loggedin"] ? 'true' : 'false'; ?>;

                // Enable or disable the checkout button based on the login status
                var checkoutButton = document.getElementById('checkoutButton');
                var warningCheckout = document.getElementById('warning-checkout');

                if (!isLoggedIn) {
                    checkoutButton.classList.add('disabled-button');
                    warningCheckout.style.display = 'block';  // Show the warning message
                } else {
                    checkoutButton.classList.remove('disabled-button');
                    warningCheckout.style.display = 'none';  // Hide the warning message
                }




                // // Update the welcome message if it's the user's first login
                // if (isFirstLogin) {
                //     var welcomeMessage = document.getElementById('welcome-message');
                //     welcomeMessage.innerHTML = 'Welcome to GroceGo!';
                //     <?php unset($_SESSION["first_login"]); // Unset the first_login session variable ?>
                // }







                document.getElementById("SignUpForm").addEventListener("submit", function(event) {
                    const checkbox = document.getElementById("termsCheckbox");
                    if (!checkbox.checked) {
                        event.preventDefault(); // Prevent form submission
                        alert("Please accept the terms and conditions.");
                    }
                });




                function handleItemClick(itemId) {
                    // Redirect to product.html with clicked item ID as query parameter
                    window.location.href = "product.php?id=" + itemId;
                }







        //*_________________________HOME PAGE__________________________________


            //_________________Cart__________________

                let rowbody = document.querySelector('.a-row-body');
                let listCart = document.querySelector('.listCart');
                let navbarcart = document.querySelector('.navbar-cart');
                let navbarcartSpan = document.querySelector('.navbar-cart span');
                // let cartBox = [];
                let outerProductsArray = [];
                let cartBox = JSON.parse(localStorage.getItem('cart')) || [];


            //---------Add to cart product id event listener--------
                rowbody.addEventListener('click',(event)=>{
                    let positionClick =event.target;
                    if(positionClick.classList.contains('btn-addtocart')){
                        let product_id = positionClick.parentNode.parentNode.dataset.id;
                        console.log("Product ID:",product_id);
                        addtoCart(product_id);
                    }
                })


             
            //----------------Add to cart function------------
                const addtoCart = (product_id) => {
                    let positionThisProductInCart = cartBox.findIndex((value) => value.product_id == product_id);
                    if (cartBox.length <= 0) {
                        cartBox = [{
                            product_id: product_id,
                            quantity: 1
                        }];
                    } else if (positionThisProductInCart < 0) {
                        cartBox.push({
                            product_id: product_id,
                            quantity: 1
                        });
                    } else {
                        cartBox[positionThisProductInCart].quantity = cartBox[positionThisProductInCart].quantity + 1;
                    }
                    console.log("Cart Box:",cartBox);
                    addcarttoHTML();
                    saveCartToLocalStorage(); // Save the cart data to local storage after each modification
                };





            //---------------add cart to html file--------------
                const addcarttoHTML=()=>{
                    listCart.innerHTML='';
                    const allProductsArray = JSON.parse(localStorage.getItem('allProductsArray'));
                    let totalQuantity=0;
                    if(cartBox.length>0){
                        cartBox.forEach(cartss => {
                        totalQuantity += cartss.quantity;
                        let newCart = document.createElement('div');
                        newCart.classList.add('listCart-items');
                        newCart.dataset.id = cartss.product_id;
                        let product = allProductsArray.find(product => product.products_id == cartss.product_id);
                        console.log(product.products_id);
                        console.log(cartss.product_id);
                        if (product) {
                            newCart.innerHTML = `
                                <div class="listCart-image">
                                    <img src="${product.products_image}">
                                </div>
                                <div class="listCart-name">
                                    ${product.products_name}
                                </div>
                                <div class="listCart-totalPrice">Rs.${product.products_price * cartss.quantity}</div>
                                <div class="listCart-quantity">
                                    <span class="listCart-minus"><</span>
                                    <span>${cartss.quantity}</span>
                                    <span class="listCart-plus">></span>
                                </div>
                            `;
                            listCart.appendChild(newCart);
                        } else {
                            console.error(`Product with ID ${cartss.product_id} not found.`);
                        }
                    })
                }
                navbarcartSpan.innerText = totalQuantity;
                }


            //-----------------capture the product position click in cart and minus or plus click----------
                listCart.addEventListener('click',(event)=>{
                    let positionClick=event.target;
                    if(positionClick.classList.contains('listCart-minus')||positionClick.classList.contains('listCart-plus')){
                        let product_id =positionClick.parentElement.parentElement.dataset.id;
                        let type='listCart-minus';
                        if(positionClick.classList.contains('listCart-plus')){
                            type='listCart-plus';
                        }
                        changequantity(product_id,type);
                        console.log("Product ID and Type:",product_id,type);
                    }
                })


            //--------------adjust quantity and price when plus or minus click------------
                const changequantity=(product_id,type)=>{
                    let positionItemInCart=cartBox.findIndex((value)=>value.product_id==product_id);
                    if(positionItemInCart>=0){
                        switch (type) {
                            case 'listCart-plus':
                                cartBox[positionItemInCart].quantity=cartBox[positionItemInCart].quantity+1;
                                break;
                        
                            default:
                                let valueChange=cartBox[positionItemInCart].quantity-1;
                                if(valueChange>0){
                                    cartBox[positionItemInCart].quantity=valueChange;
                                }else{
                                    cartBox.splice(positionItemInCart,1);
                                }
                                break;
                        }
                    }
                    saveCartToLocalStorage();
                    addcarttoHTML();
                }


                
            //-----------Function to save the cart data to local storage--------
                const saveCartToLocalStorage = () => {
                    localStorage.setItem('cart', JSON.stringify(cartBox));
                };


            // // Function to retrieve cart data from local storage and render it in the HTML
            // const renderCartFromLocalStorage = () => {
            //     let storedCart = JSON.parse(localStorage.getItem('cart'));
            //     if (storedCart) {
            //         cartBox = storedCart;
            //         addcarttoHTML();
            //     }
            // };

            // // Call renderCartFromLocalStorage on page load to display the cart contents
            // renderCartFromLocalStorage();




            //---------------Retrieve cart data from local storage on page load----------------
                window.addEventListener('load', () => {
                    // Get cart data from local storage
                    const cartData = JSON.parse(localStorage.getItem('cart'));
                    // If cart data exists, assign it to cartBox array
                    if (cartData && Array.isArray(cartData)) {
                        cartBox = cartData;
                    }
                    // Render cart items from local storage
                    renderCartItemsFromLocalStorage();
                });



            // Function to RENDER CART ITEMS from local storage
            const renderCartItemsFromLocalStorage = () => {
                console.log("Rendering cart items from local storage...");

                // Get outerArray data from local storage
                const outerProductsArray = JSON.parse(localStorage.getItem('allProductsArray'));
                console.log("Cart data from local storage:", cartBox);

                listCart.innerHTML = '';
                let totalQuantity = 0;

                if (cartBox && cartBox.length > 0 && outerProductsArray) {
                    cartBox.forEach(cartss => {
                        totalQuantity += cartss.quantity;
                        let newCart = document.createElement('div');
                        newCart.classList.add('listCart-items');
                        newCart.dataset.id = cartss.product_id;

                        let positionProduct = outerProductsArray.findIndex((value) => value.id == cartss.product_id);
                        if (positionProduct !== -1) {
                            let info = outerProductsArray[positionProduct];

                            if (info) {  // Check if info is defined
                                newCart.innerHTML = `
                                    <div class="listCart-image">
                                        <img src="${info.image}">
                                    </div>
                                    <div class="listCart-name">
                                        ${info.name}
                                    </div>
                                    <div class="listCart-totalPrice">Rs.${info.price * cartss.quantity}</div>
                                    <div class="listCart-quantity">
                                        <span class="listCart-minus"><</span>
                                        <span>${cartss.quantity}</span>
                                        <span class="listCart-plus">></span>
                                    </div>
                                `;
                                listCart.appendChild(newCart);
                            } else {
                                console.warn(`Product with ID ${cartss.product_id} not found in outerProductsArray`);
                            }
                        } else {
                            console.warn(`Product with ID ${cartss.product_id} not found in outerProductsArray`);
                        }
                    });
                }

                navbarcartSpan.innerText = totalQuantity;
                console.log("Cart items rendered successfully.");
                addcarttoHTML();
            };














            document.getElementById('switchToSignIn').addEventListener('click', function() {
                document.getElementById('signin-popup').style.display = 'block';
                document.getElementById('signup-popup').style.display = 'none';
            });

            document.getElementById('switchToSignUp').addEventListener('click', function() {
                document.getElementById('signup-popup').style.display = 'block';
                document.getElementById('signin-popup').style.display = 'none';
            });

            document.getElementById('signin-popup-icon').addEventListener('click', function() {
                document.getElementById('signup-popup').style.display = 'block';
                document.getElementById('signin-popup').style.display = 'none';
            });

            document.getElementById('signin-popup-close1').addEventListener('click', function() {
                document.getElementById('signup-popup').style.display = 'none';
                document.getElementById('signin-popup').style.display = 'none';
            });

            document.getElementById('signin-popup-close2').addEventListener('click', function() {
                document.getElementById('signup-popup').style.display = 'none';
                document.getElementById('signin-popup').style.display = 'none';
            });






    </script>

    <script src="script.js"></script>
    <script src="shopping-cart.js"></script>


    </body>
</html>