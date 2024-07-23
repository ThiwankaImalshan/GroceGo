<?php
    session_start();

    // Initialize the loggedin session variable
        if (!isset($_SESSION["loggedin"])) {
            $_SESSION["loggedin"] = false;
        }

?>

<?php

$isLoggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]; // Check if $_SESSION["loggedin"] is set and true

?>


<?php
// Database connection
require("config.php");

// Query to get all categories and their subcategories
$sql = "SELECT categories_name, subcategories_name FROM category GROUP BY categories_name, subcategories_name";
$result = $conn->query($sql);

// Store the results in a multidimensional array
$data = array();
while ($row = $result->fetch_assoc()) {
    $category = $row["categories_name"];
    $subcategory = $row["subcategories_name"];
    $data[$category][] = $subcategory;
}

// Include the database connection file
// include 'fetch_products.php';

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
    <style>
        .search-right-section {
            
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
            flex-direction: column;
            margin-top:-60px;
        }
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
                        <div class="navbar-cart">
                            <small>Add to Cart</small>
                            <i class="fa fa-shopping-cart" aria-hidden="true">
                                <span id="smart-checkout-count" class="badge">0</span>
                            </i>
                        </div>
                        <div class="navbar-signin">
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

 <!-----Responsive navigation bar-->
 <div class="menu rpbtn" style="top: 5.8rem; right: 0px; position: fixed">
    <ul>
        <a href="index.php"><li>Home</li></a>
        <a href="product.php"><li>Product</li></a>
        <a href="services.php"><li>Service</li></a>
        <a href="about.php"><li>About Us</li></a>
    </ul>
  </div>

 

    <div class="carousel">
        <div class="carousel-inner">
          <div class="carousel-item">
            <img src="promotion img/Slide1.jpg" alt="Image 1">
          </div>
          <div class="carousel-item">
            <img src="promotion img/Slide2.jpg" alt="Image 2">
          </div>
          <div class="carousel-item">
            <img src="promotion img/Slide4.jpg" width="100%" alt="Image 3">
          </div>
        </div>
      </div>


      <!-- Product Section -->
      <div class="search-body">
        <div class="search-left-section">
            <div class="search-now">
                <div class="product-categories-bar ">
                    <h3>Categories</h3>
                    
                    <div class="item-categories-box ">
                        
                        <ul class="item-categories-ul">
                            
                            <li id="vegitable-btn">Vegetables 
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                            <li id="fruit-btn">Fruits
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                            <li id="meat-btn">Meat
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                            <li id="fish-btn">Fish
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                            <li id="rice-btn">Rice
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                            <li id="beverages-btn">Beverages
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                            <li id="chilled-btn">Chilled
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                            <li id="grocery-btn">Grocery
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                            <li id="pharmacy-btn">Pharmacy
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                            <li id="bakery-btn">Bakery Production
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                            <li id="homeware-btn">Homeware
                                <span>
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
       
        <!-- <div class="search-right-section" id="searchRightSection"> -->
            <div class="search-right-section" id="catalog" style=" flex-direction: column;">
            <!-- <div class="product-searching-result">
                
            </div> -->

            </div>

        </div>

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


    
        
    <script src="script.js"></script>
    <script>

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





    let outerProductsArray = [];
    let allProductsArray = [];

    // Fetch all products from the server
    $.ajax({
        url: 'render_products.php',
        type: 'GET',
        dataType: 'json',
        success: function(products) {
            allProductsArray = products;
            renderProducts(allProductsArray);
            console.log("All Products:",allProductsArray);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching products:', error);
        }
    });



    
    //------------get clicking id from index.html and display each category--------
    function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
    
    // Retrieve clicked item ID from URL query parameter
    const clickedItemId = getQueryParam('id');
    console.log("Clicked Item ID:", clickedItemId);
    
    // Check if the clicked item ID matches a specific value
    if (clickedItemId === 'sub_dep_1_all') {
        // Perform a task if the clicked item ID matches the specific value
        console.log("Performing a task for the sub_dep_1_all...");
        renderCategory('vegetables');
    }else if(clickedItemId === 'sub_dep_2_all'){
    
        console.log("Performing a task for the sub_dep_2_all...");
        renderCategory('fruits');
    }else if(clickedItemId === 'sub_dep_3_all'){
    
        console.log("Performing a task for the sub_dep_3_all...");
        renderCategory('meats');
    }else if(clickedItemId === 'sub_dep_4_all'){
    
        console.log("Performing a task for the sub_dep_4_all...");
        renderCategory('fish');
    }else if(clickedItemId === 'sub_dep_5_all'){
    
        console.log("Performing a task for the sub_dep_5_all...");
        renderCategory('rice');
    }else if(clickedItemId === 'sub_dep_6_all'){
    
        console.log("Performing a task for the sub_dep_6_all...");
        renderCategory('beverages');
    }else if(clickedItemId === 'sub_dep_7_all'){
    
        console.log("Performing a task for the sub_dep_7_all...");
        renderCategory('chilled');
    }else if(clickedItemId === 'sub_dep_8_all'){
    
        console.log("Performing a task for the sub_dep_8_all...");
        renderCategory('grocery');
    }else if(clickedItemId === 'sub_dep_9_all'){
    
        console.log("Performing a task for the sub_dep_9_all...");
        renderCategory('pharmacy');
    }else if(clickedItemId === 'sub_dep_10_all'){
    
        console.log("Performing a task for the sub_dep_10_all...");
        renderCategory('bakery production');
    }else if(clickedItemId === 'sub_dep_11_all'){
    
        console.log("Performing a task for the sub_dep_11_all...");
        renderCategory('homeware');
    }else {
        // Perform a default task if the clicked item ID does not match the specific value
        console.log("Performing a default task...");
    }














    document.getElementById('vegitable-btn').addEventListener('click', function() {
        renderCategory('vegetables');
    });

    document.getElementById('fruit-btn').addEventListener('click', function() {
        renderCategory('fruits');
    });

    document.getElementById('meat-btn').addEventListener('click', function() {
      renderCategory('meats');
    });

    document.getElementById('fish-btn').addEventListener('click', function() {
        renderCategory('fish');
    });

    document.getElementById('rice-btn').addEventListener('click', function() {
        renderCategory('rice');
    });

    document.getElementById('beverages-btn').addEventListener('click', function() {
        renderCategory('beverages');
    });

    document.getElementById('chilled-btn').addEventListener('click', function() {
        renderCategory('chilled');
    });

    document.getElementById('grocery-btn').addEventListener('click', function() {
        renderCategory('grocery');
    });

    document.getElementById('pharmacy-btn').addEventListener('click', function() {
        renderCategory('pharmacy');
    });

    document.getElementById('bakery-btn').addEventListener('click', function() {
        renderCategory('bakery production');
    });

    document.getElementById('homeware-btn').addEventListener('click', function() {
        renderCategory('homeware');
    });



    function renderCategory(category) {
        $.ajax({
            url: 'fetch_products.php',
            type: 'GET',
            data: { category: category },
            dataType: 'json',
            success: function(data) {
                outerProductsArray = data; // Store products in outerProductsArray
                console.log(outerProductsArray);
                const catalog = document.getElementById('catalog');
                catalog.innerHTML = ''; // Clear existing content
                for (const subcategory in data) {
                    const subcategoryDiv = document.createElement('div');
                    subcategoryDiv.classList.add('row-body');
                    subcategoryDiv.innerHTML = `<h5>${subcategory}</h5>
                                                <div class="p-slider-container">
                                                    <div class="p-slider"></div>
                                                    <i class="fa fa-arrow-circle-left p-prev-btn fa-2x" aria-hidden="true"></i>
                                                    <i class="fa fa-arrow-circle-right p-next-btn fa-2x" aria-hidden="true"></i>
                                                </div>`;
                    const pSlider = subcategoryDiv.querySelector('.p-slider');
                    let rowDiv;
                    data[subcategory].forEach((product, index) => {
                        if (index % 3 === 0) {
                            rowDiv = document.createElement('div');
                            rowDiv.classList.add('p-slider-row');
                            pSlider.appendChild(rowDiv);
                        }
                        const productDiv = document.createElement('div');
                        productDiv.classList.add('row-card', 'p-slider-item');
                        productDiv.dataset.id = product.id;
                        productDiv.innerHTML = `<div class="row-card-img" onclick="redirectToProductDetail('${product.id}')">
                                                    <img src="${product.image}" alt="${product.name}">
                                                </div>
                                                <div class="row-txt">
                                                    <h3>${product.name}</h3>
                                                    <h4>Rs.${product.price}</h4>
                                                    <button class="btn-addtocart">Add to Cart</button>
                                                </div>`;
                        const button = productDiv.querySelector('.btn-addtocart');
                        if (product.availability === 'out of stock') {
                            button.style.backgroundColor = '#DE3163';
                            button.style.color = 'white';
                            button.textContent = "Out of Stock";
                            button.style.pointerEvents = 'none';
                            button.disabled = true;
                        }
                        rowDiv.appendChild(productDiv);
                    });
                    catalog.appendChild(subcategoryDiv);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function redirectToProductDetail(productId) {
        window.location.href = "productDetail.php?id=" + productId;
    }

    // // Load default category when the page loads
    // document.addEventListener('DOMContentLoaded', function() {
    //     renderCategory('vegetables');
    // });












        //------------Cart window---------------
        let navCart = document.querySelector('.navbar-cart');
        let bodyContain = document.querySelector('body');
        let closeTheCart = document.querySelector('.cartTab-close');
        // Show Cart
        navCart.addEventListener('click', () => {
            bodyContain.classList.toggle('showCart');
        })

        // Close Cart
        closeTheCart.addEventListener('click', () => {
            bodyContain.classList.toggle('showCart');
        })
















        //_________________________HOME PAGE__________________________________

        //_______________________Cart for each pages_________________________

        //---------------Retrieve cart data from local storage on page load----------------
        let list_Cart = document.querySelector('.listCart');
        let navbar_cartSpan = document.querySelector('.navbar-cart span');

        window.addEventListener('load', () => {
            // Get cart data from local storage
            const cartData = JSON.parse(localStorage.getItem('cart'));
            // If cart data exists, assign it to cartBox array
            if (cartData && Array.isArray(cartData)) {
                cartBox = cartData;
            }
            console.log(cartBox);
            // Render cart items from local storage
            renderCartItemsFromLocalStorage();
        });



        // Function to render the cart items from local storage
        const renderCartItemsFromLocalStorage = () => {
            console.log("Rendering cart items from local storage...");

            // Get outerArray data from local storage
            const outerProductsArray = JSON.parse(localStorage.getItem('allProductsArray'));
            console.log("Cart data from local storage:", cartBox);

            list_Cart.innerHTML = '';
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
                            list_Cart.appendChild(newCart);
                        } else {
                            console.warn(`Product with ID ${cartss.product_id} not found in outerProductsArray`);
                        }
                    } else {
                        console.warn(`Product with ID ${cartss.product_id} not found in outerProductsArray`);
                    }
                });
            }

            navbar_cartSpan.innerText = totalQuantity;
            console.log("Cart items rendered successfully.");
            addcarttoHTML();
        };





        //-----------------capture the product position click in cart and minus or plus click----------
        list_Cart.addEventListener('click',(event)=>{
            let positionClick=event.target;
            if(positionClick.classList.contains('listCart-minus')||positionClick.classList.contains('listCart-plus')){
                let product_id =positionClick.parentElement.parentElement.dataset.id;
                let type='listCart-minus';
                if(positionClick.classList.contains('listCart-plus')){
                    type='listCart-plus';
                }
                changequantity(product_id,type);
                console.log(product_id,type);
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

        //---------------add cart to html file--------------
        const addcarttoHTML=()=>{
            list_Cart.innerHTML='';
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
                    list_Cart.appendChild(newCart);
                } else {
                    console.error(`Product with ID ${cartss.product_id} not found.`);
                }
            })
        }
        navbar_cartSpan.innerText = totalQuantity;
        }








        

        //------------Add a click event listener to the parent element of all btn-addtocart buttons-----------
        document.getElementById('catalog').addEventListener('click', function(event) {
            let product_id;
            // Check if the clicked element is a btn-addtocart
            if (event.target.classList.contains('btn-addtocart')) {
                // Retrieve the parent row-card element of the clicked button
                const parentRowCard = event.target.closest('.row-card');
                // Retrieve the dataset-id attribute value of the parent row-card
                const productId = parentRowCard.getAttribute('data-id');
                // Assign the dataset-id to the product_id variable
                product_id = productId;
                // Print the dataset-id to the console
                console.log(product_id);
                addtoCart(product_id);
            }
        });



        // Function to add product to cart
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
                cartBox[positionThisProductInCart].quantity += 1;
            }
            console.log(cartBox);
            addcarttoHTML(); // Update HTML representation of cart
            saveCartToLocalStorage(); // Save cart data to local storage
        };










    </script>
</body>
</html>