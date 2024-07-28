<?php
    session_start();

    // Initialize the loggedin session variable
        if (!isset($_SESSION["loggedin"])) {
            $_SESSION["loggedin"] = false;
        }

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Basic styling for main content */
        main {
            padding: 20px;
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
                        <!-- <div class="navbar-signin">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        </div> -->
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

    <main>
        <section class="productDetail-detail" id="productDetails">
            <div class="productDetail-image">
                <!-- Product image -->
                <img src="product img/apple.jpg" alt="Product Image">
            </div>
            <div class="productDetail-info">
                <h1 class="productDetail-name">Product Name</h1>
                <p class="productDetail-description">Product Description</p>
                <p class="productDetail-price">Price: $XX.XX</p>
                <button class="btn-addtocart" style="margin-left: 0;">Add to Cart</button>
                <p class="productDetail-stores">Available Stores: <span>GrocGo</span></p>
            </div>
        </section>
    </main>


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
                        <p><a href="">Privacy Policy</a></p>
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
                
                


    //------------Cart window---------------
    let nav_Cart = document.querySelector('.navbar-cart');
        let body_Contain = document.querySelector('body');
        let close_The_Cart = document.querySelector('.cartTab-close');
        // Show Cart
        nav_Cart.addEventListener('click', () => {
            body_Contain.classList.toggle('showCart');
        })

        // Close Cart
        close_The_Cart.addEventListener('click', () => {
            body_Contain.classList.toggle('showCart');
        })
























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
        document.getElementById('productDetails').addEventListener('click', function(event) {
            let product_id;
            // Check if the clicked element is a btn-addtocart
            if (event.target.classList.contains('btn-addtocart')) {
                // Retrieve the parent productDetail-info element of the clicked button
                const parentDetailInfo = event.target.closest('.productDetail-info');
                // Retrieve the data-id attribute value of the parent element
                const productId = parentDetailInfo.getAttribute('data-id');
                // Assign the data-id to the product_id variable
                product_id = productId;
                // Print the data-id to the console
                console.log("Product ID: " + product_id);
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




      











    

// Function to get the value of a query parameter by its name
function getQueryParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Function to initialize the product detail page
function init() {
    const dataId = getQueryParam('id');
    console.log(dataId);
    if (dataId) {
        const outerItems = JSON.parse(localStorage.getItem('allProductsArray'));
        if (outerItems) {
            const matchedItem = outerItems.find(item => item.products_id === dataId);
            if (matchedItem) {
                // If a matching item is found, print its details using innerHTML
                const productDetailContainer = document.getElementById('productDetails');
                if (productDetailContainer) {
                    productDetailContainer.innerHTML = `
                        <div class="productDetail-image">
                            <!-- Product image -->
                            <img src="${matchedItem.products_image || 'default-image.jpg'}" alt="${matchedItem.products_name}">
                        </div>
                        <div class="productDetail-info" data-id="${matchedItem.products_id}">
                            <h1 class="productDetail-name">${matchedItem.products_name}</h1>
                            <p class="productDetail-description">${matchedItem.products_description || 'No description available.'}</p>
                            <p class="productDetail-price">Price: Rs.${matchedItem.products_price}</p>
                            <button class="btn-addtocart" style="margin-left: 0;">Add to Cart</button>
                            <p class="productDetail-stores">Available Stores: <span>GrocGo</span></p>
                        </div>
                    `;

                    // Check availability and update button styling
                    const button = productDetailContainer.querySelector('.btn-addtocart');
                    if (button) {
                        if (matchedItem.availability === 'out of stock') {
                            button.style.backgroundColor = '#DE3163';
                            button.style.color = 'white';
                            button.textContent = "Out of Stock";
                            button.style.pointerEvents = 'none';
                            button.disabled = true;
                        } else {
                            button.style.backgroundColor = ''; // Use default stylesheet color
                            button.disabled = false;
                        }
                    }
                }
            } else {
                console.log("No matching item found in outerItems.");
            }
        } else {
            console.log("No products found in localStorage.");
        }
    } else {
        console.log("No data ID found in the URL.");
    }
}

// Call init() when the page loads
window.onload = init;

</script>
</body>
</html>