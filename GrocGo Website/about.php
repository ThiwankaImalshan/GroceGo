<?php
session_start();

$isLoggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]; // Check if $_SESSION["loggedin"] is set and true

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrocGo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <script src="jQueryFile.js"></script>
    <style>
            .navbar-signin img{
                width: 35px;
                height:35px;
                border-radius: 35px;
            }
    </style>
</head>
<body>

    <!-- Navigation Bar/Header -->
    <header>
        <div class="header-navbar-checkout">
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
                        <!-- <div class="navbar-cart">
                            <small>Add to Cart</small>
                            <i class="fa fa-shopping-cart" aria-hidden="true">
                                <span id="smart-checkout-count" class="badge">0</span>
                            </i>
                        </div> -->
                        <div class="navbar-signin nav-sign-icon">
                            <?php if ($isLoggedIn): ?>
                                    <img src="img/Customer.png" alt="User Profile Image" id="signin-popup-img">
                            <?php else: ?>
                                    <i class="fa fa-user-circle-o" aria-hidden="true" id="signin-popup-icon"></i>
                            <?php endif; ?>
                        </div>
                        <button class="hamburger rpbtn" >&#9776;</button>
                        <button class="cross rpbtn" title="Close">&#735;</button>
                    </ul>
                </div>
            </div>
        </div>
    </header>
      <!-----Responsive navigation bar-->
      <div class="menu rpbtn" style="top: 5.8rem; position: fixed;">
        <ul>
          <a href="index.php"><li>Home</li></a>
          <a href="product.php"><li>Product</li></a>
          <a href="services.php"><li>Service</li></a>
          <a href="about.php"><li>About Us</li></a>
        
        </ul>
      </div> 
      <script>

$( document ).ready(function() {

$( ".cross" ).hide();
$( ".menu" ).hide();

$( ".hamburger" ).click(function() {
$( ".menu" ).slideToggle( "slow", function() {
$( ".hamburger" ).fadeOut(200);
$( ".cross" ).fadeIn();
});
});

$(document).click(function(e) {

if(!$(e.target).closest('.menu').length && !$(e.target).closest('.hamburger').length){
$( ".menu" ).slideUp( "slow", function() {
$( ".cross" ).fadeOut(200);
$( ".hamburger" ).fadeIn();
});

}

});

});
      </script>


    <!-- Top Banner -->
    <div class="top-banner">
        <div class="top-banner-img">
            <img src="img/Top Banner.jpg" alt="">
            <h1>About Us</h1>
        </div>
        <h1 class="Banner">About Us</h1>
    </div>

    <div class="aboutus-container">
        <div class="aboutus-txts">
            <span>Welcome to <b>GrocGo</b></span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias ipsam nostrum delectus, magnam accusamus quae tempore deleniti magni, a inventore fugit quisquam adipisci ad dolor corrupti quasi illo neque similique.
            Inventore voluptatum consectetur, perspiciatis soluta voluptates nesciunt accusantium saepe repudiandae cumque. Veniam, velit perferendis dolor error officiis, sed, excepturi a repellat voluptates magnam eligendi? Atque voluptatum quia temporibus error dolore!
            Corrupti animi consectetur ratione aut explicabo eos veritatis quam veniam natus voluptatibus repellat eaque similique rerum optio possimus cumque labore, blanditiis eveniet officiis minima pariatur, a molestias eum itaque. Officia!
            Quam quisquam porro quod soluta id sit debitis quis accusamus assumenda ullam natus veritatis ipsam excepturi hic ipsa quaerat culpa sunt beatae ex deleniti quas nostrum, officia consequatur? Omnis, dolorem?<br><br>

            Sed sapiente dolorum quisquam sint pariatur, ea repellat fuga unde tempore, officia nesciunt perferendis quia, a minima maiores et consequatur reprehenderit mollitia? Ipsa similique sapiente eligendi repellendus mollitia expedita facilis?
            Reprehenderit at ipsam impedit necessitatibus! Blanditiis atque cum, consectetur laboriosam, pariatur doloremque nesciunt hic corporis laborum, provident illo possimus. A perferendis amet quibusdam ratione non asperiores saepe ipsa, repudiandae ipsam?
            Accusantium soluta natus consequuntur dolores corporis, molestiae autem maxime! Accusamus nulla esse aperiam voluptas! Cum veniam voluptatem dolorum, eligendi tempore sequi hic fugiat animi excepturi repellat magni dolores unde mollitia!
            Deleniti aut itaque, accusamus ad voluptatum nostrum nobis ut laboriosam tempore est blanditiis nemo commodi repellat voluptatem sequi, minima illum vero. Laborum porro praesentium nam, odio id facilis quia incidunt.
            Incidunt explicabo doloribus facere rerum. Modi unde, at repudiandae eos sapiente dignissimos qui tenetur ad! Eos quam eligendi optio officia rerum deleniti? Eveniet eius corrupti eos iusto necessitatibus dolorem eaque.
            Voluptatibus, excepturi dolore! Consectetur perspiciatis accusantium amet magnam eveniet ad repudiandae dolorum itaque at architecto, repellendus unde rem facilis nisi sit rerum illo adipisci error nulla repellat enim. Fugit, in. <br><br>

            Quae laborum architecto dolores eligendi cupiditate, fugit perspiciatis totam, corporis sed magnam, iusto odio. Illo, reprehenderit! Perferendis rem odio accusantium neque similique dolorum, modi optio molestiae vel itaque recusandae dolorem.
            Similique error placeat nam inventore sequi, dolorum tempore ullam eligendi, quae omnis reprehenderit molestias laborum voluptatum distinctio beatae ducimus officia ratione debitis, sit rem. Eos odio architecto quae consequuntur doloremque?
            Nam, veritatis corrupti in ducimus voluptate animi quia, ullam minus dolore, necessitatibus dolorum tenetur cupiditate ex. Unde adipisci placeat nisi voluptate doloremque! Officia vel in consectetur dolorum, corrupti beatae possimus.
            Minima sequi obcaecati deleniti fugit sint molestias modi, asperiores excepturi eligendi, nostrum ipsam doloremque unde illum facilis voluptas, inventore soluta adipisci totam error repellendus quasi repellat! Facere qui earum nam!
            Dolorum nobis, ullam molestias fuga quae temporibus aliquam facere expedita eius veniam deleniti autem debitis praesentium eaque iusto commodi repellendus similique consectetur recusandae iste, impedit modi explicabo. Optio, doloribus quis!</p>
        </div>
    </div>


    <!-- Footer Section -->
    <footer>
        <div class="footer-container">
            <img src="img/footer-bg.png" alt="Footer Background">
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
                        <p><a href="product.php">Products</a></p>php
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
    
</body>
</html>