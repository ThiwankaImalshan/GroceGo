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
        #searchResults{
            margin-top: 2rem;
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
        <div class="header-navbar-checkout" >
            <div class="navbar-row">
                <div class="navbar-logo" >
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
                        <!-- <button class="hamburger rpbtn" >&#9776;</button>
                        <button class="cross rpbtn" title="Close">&#735;</button> -->
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
<!-- <div class="menu rpbtn" style="top: 5.8rem; right: 0px; position: fixed">
    <ul>
      <a href="index.html"><li>Home</li></a>
      <a href="product.html"><li>Product</li></a>
      <a href="services.html"><li>Service</li></a>
      <a href="about.html"><li>About Us</li></a>
    </ul>
  </div> -->
  
 
    <div class="promotion-img">
        <img src="promotion img/Slide3.gif" width="100%" alt="">
    </div>

    <div class="search-body">
        <div class="search-left-section">
            <div class="search-now">
                <h3>Search Now</h3>
                <div class="search-now-bar">
                    <input type="text" name="" id="searchInput" placeholder="Search products..." oninput="suggestProducts()">
                    <button class="search-now-btn" onclick="searchProducts()">
                        <i class="fa fa-search"></i>
                    </button>
                    <ul id="searchResults" style="display: none;"></ul>
                </div>
                <div class="filter-bar">
                    <h3>Filter By</h3>
                    <div class="filter-box">
                        <input class="range-bar" type="range" id="price" name="price" oninput="filterByPrice()" min="500" max="10000" step="1" value="500" onchange="updatePrice(this.value)">
                        <p><span>Rs.100</span> - <span id="price-display"></span></p>
                    </div>
                </div>
                <!-- <div class="categories-bar">
                    <h3>Categories</h3>
                    <div class="categories-box">

                    </div>
                </div> -->
            </div>
        </div>
        <div class="search-right-section">
            <div class="searching-result">
                <!-- <select id="sortSelect" onchange="filterAndSort()">
                    <option value="priceLowToHigh">Price Low to High</option>
                    <option value="priceHighToLow">Price High to Low</option>
                    <option value="nameAToZ">Name A to Z</option>
                    <option value="nameZToA">Name Z to A</option>
                </select> -->
            </div>
            
            <div class="row-body" id="results"></div>
            <!-- Card Row -->
            <!-- <div class="row-body">
                <ul>
                    <div class="row-card">
                        <div class="row-card-img">
                            <img src="product img/apple.jpg" alt="Product 1">
                        </div>
                        <div class="row-txt">
                            <h3>Fresh Apple</h3>
                            <h4>In Stock</h4>
                            <button class="btn-addtocart">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    <div class="row-card">
                        <div class="row-card-img">
                            <img src="product img/snickers.jpg" alt="Product 2">
                        </div>
                        <div class="row-txt">
                            <h3>Snickers</h3>
                            <h4>In Stock</h4>
                            <button class="btn-addtocart">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    <div class="row-card">
                        <div class="row-card-img">
                            <img src="product img/Orange juice.jpg" alt="Product 4">
                        </div>
                        <div class="row-txt">
                            <h3>Fresh Orange juice</h3>
                            <h4>In Stock</h4>
                            <button class="btn-addtocart">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </ul>
            </div> -->

            <!-- Card Row -->
            <!-- <div class="row-body">
                <ul>
                    <div class="row-card">
                        <div class="row-card-img">
                            <img src="product img/snickers.jpg" alt="Product 2">
                        </div>
                        <div class="row-txt">
                            <h3>Snickers</h3>
                            <h4>In Stock</h4>
                            <button class="btn-addtocart">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    <div class="row-card">
                        <div class="row-card-img">
                            <img src="product img/Almond.jpg" alt="Product 3">
                        </div>
                        <div class="row-txt">
                            <h3>Almonds</h3>
                            <h4>In Stock</h4>
                            <button class="btn-addtocart">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    <div class="row-card">
                        <div class="row-card-img">
                            <img src="product img/Orange juice.jpg" alt="Product 4">
                        </div>
                        <div class="row-txt">
                            <h3>Fresh Orange juice</h3>
                            <h4>In Stock</h4>
                            <button class="btn-addtocart">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </ul>
            </div> -->

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





            let allProductsArray = [];
            let cartBox = JSON.parse(localStorage.getItem('cart')) || [];


            document.addEventListener('DOMContentLoaded', function() {
                renderCartItemsFromLocalStorage();
                addcarttoHTML();
            });




            // Fetch all products from the server
            $.ajax({
                url: 'render_products.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        console.error('Error fetching products:', response.error);
                        return;
                    }
                    allProductsArray = response;
                    console.log(allProductsArray);
                    localStorage.setItem('allProductsArray', JSON.stringify(allProductsArray));
                    renderProducts(allProductsArray);
                    addcarttoHTML(allProductsArray);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching products:', error);
                }
            });

            function renderProducts(products) {
                const catalog = document.getElementById('results');
                catalog.innerHTML = ''; // Clear existing content

                for (let i = 0; i < products.length; i += 3) {
                    const rowBody = document.createElement('div');
                    rowBody.classList.add('row-body');

                    const ul = document.createElement('ul');

                    for (let j = i; j < i + 3 && j < products.length; j++) {
                        const product = products[j];
                        const rowCard = document.createElement('div');
                        rowCard.classList.add('row-card');
                        rowCard.dataset.id = product.products_id;

                        rowCard.innerHTML = `
                            <div class="row-card-img">
                                <img src="${product.products_image}" alt="${product.products_name}">
                            </div>
                            <div class="row-txt">
                                <h3>${product.products_name}</h3>
                                <h4>${product.products_availability === 'out of stock' ? 'Out of Stock' : 'In Stock'}</h4>
                                <button class="btn-addtocart"${product.products_availability === 'out of stock' ? ' disabled style="background-color: #DE3163; color: white; pointer-events: none;"' : ''}>
                                    ${product.products_availability === 'out of stock' ? 'Out of Stock' : 'Add to Cart'}
                                </button>
                            </div>
                        `;

                        ul.appendChild(rowCard);
                    }

                    rowBody.appendChild(ul);
                    catalog.appendChild(rowBody);
                }
            }














            //-----------range bar price changement display---------
            function updatePrice(val) {
                document.getElementById('price-display').textContent = 'Rs.' + val;
            }


            //-----------range-input level up to maximum------------
            const rangeInput = document.getElementById('price');
            rangeInput.value = rangeInput.max;

            




        //----------fetch data---------
        let searchData; // Variable to store fetched data






        //---------------search products-----------
        function searchProducts() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const searchResultsContainer = document.getElementById('searchResults');
            searchResultsContainer.innerHTML = ''; // Clear previous results

            // Fetch products data from fetch_products.php
            fetch(`fetch_products.php?search=${encodeURIComponent(searchInput)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    displayProducts(data); // Call the function to display products

                    const filterBar = document.querySelector('.filter-bar');
                    if (filterBar) {
                        filterBar.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        // Fetch products data from the PHP endpoint
        function fetchProducts() {
            return fetch('render_products.php') // Replace with your actual PHP script path
                .then(response => response.json())
                .then(data => {
                    if (data && !data.error) {
                        return data;
                    }
                    throw new Error(data.error || 'Invalid data format');
                });
        }

        // Display product results
        function displayProducts(products) {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const resultsContainer = document.getElementById('results');
            resultsContainer.innerHTML = ''; // Clear previous results

            // Filter products based on search input
            const filteredProducts = products.filter(product => product.products_name.toLowerCase().includes(searchInput));

            // If no results found
            if (filteredProducts.length === 0) {
                const noResultsMessage = document.createElement('p');
                noResultsMessage.textContent = 'No products found matching your search...';
                noResultsMessage.classList.add('no-result-message');
                resultsContainer.appendChild(noResultsMessage);
                return;
            }

            let productCounter = 0;
            let ul;

            // Display each result
            filteredProducts.forEach(product => {
                if (productCounter % 3 === 0) {
                    // Create a new row every 3 products
                    ul = document.createElement('ul');
                    ul.classList.add('search-row');
                    resultsContainer.appendChild(ul);
                }

                const rowCard = createProductCard(product);
                ul.appendChild(rowCard);

                productCounter++;
            });
        }




        // Create a product card element
        function createProductCard(product) {
            const rowCard = document.createElement('div');
            rowCard.classList.add('row-card');
            rowCard.setAttribute('data-id', product.products_id);

            const rowCardImg = document.createElement('div');
            rowCardImg.classList.add('row-card-img');
            rowCardImg.onclick = () => redirectToProductDetail(product.products_id);
            rowCard.appendChild(rowCardImg);

            const image = document.createElement('img');
            image.src = product.products_image; // Assuming the image path is stored in products_image
            image.alt = product.products_name;
            rowCardImg.appendChild(image);

            const rowTxt = document.createElement('div');
            rowTxt.classList.add('row-txt');
            rowCard.appendChild(rowTxt);

            const name = document.createElement('h3');
            name.textContent = product.products_name;
            rowTxt.appendChild(name);

            const head4 = document.createElement('h4');
            head4.textContent = 'Rs.' + product.products_price;
            rowTxt.appendChild(head4);

            const button = document.createElement('button');
            button.classList.add('btn-addtocart');
            button.textContent = 'Add to Cart';
            rowTxt.appendChild(button);

            // Apply availability check and styling to the button
            if (product.products_availability === 'out of stock') {
                button.style.backgroundColor = '#DE3163';
                button.style.color = 'white';
                button.textContent = "Out of Stock";
                button.style.pointerEvents = 'none';
                button.disabled = true;
            } else {
                button.style.backgroundColor = ''; // Use default stylesheet color
                button.disabled = false;
            }

            return rowCard;
        }

        // Handle redirection to productDetail.html
        function redirectToProductDetail(productId) {
            window.location.href = "productDetail.php?id=" + productId;
        }

        // Search products based on input
        function searchProducts() {
            fetchProducts().then(products => {
                displayProducts(products);
            }).catch(error => {
                console.error('Error fetching data:', error);
            });
        }

        // Event listener for search input
        document.getElementById('searchInput').addEventListener('input', searchProducts);

        // Initial fetch and display of products
        fetchProducts().then(products => {
            displayProducts(products);
        }).catch(error => {
            console.error('Error fetching data:', error);
        });








        // Function to filter products by price
        function filterByPrice() {
            const maxPrice = parseFloat(document.getElementById('price').value);
            fetchProducts().then(products => {
                const filteredProducts = products.filter(product => product.products_price <= maxPrice);
                displayProducts(filteredProducts);
            }).catch(error => {
                console.error('Error fetching data:', error);
            });
        }





        //------------------Cart window--------------------
        let naviCart = document.querySelector('.navbar-cart');
        let bodyCon = document.querySelector('body');
        let closetheCart = document.querySelector('.cartTab-close');
        // Show Cart
        naviCart.addEventListener('click', () => {
            bodyCon.classList.toggle('showCart');
        })

        // Close Cart
        closetheCart.addEventListener('click', () => {
            bodyCon.classList.toggle('showCart');
        })








        // Display search get from index.html
        window.onload = function() {
            // Retrieve search input from query parameter
            const urlParams = new URLSearchParams(window.location.search);
            const encodedSearchInput = urlParams.get('searchInput');
            console.log("encodedSearchInput is "+ encodedSearchInput);

            // Call performSearch() function after 3 seconds
            setTimeout(function() {
                if (encodedSearchInput) {
                    // Decode the encoded search input
                    const searchInput = decodeURIComponent(encodedSearchInput);
                    console.log("Search Input Provided is "+ searchInput);
                    performSearch(searchInput);
                } else {
                    console.log("No search input provided.");
                }
            }, 1000); // 3000 milliseconds = 3 seconds
        };





        function performSearch(searchInput) {
            // Convert search input to lowercase
            searchInput = searchInput.toLowerCase();

            // Filter the products based on the search input
            const filteredData = allProductsArray.filter(product =>
                product.products_name.toLowerCase().includes(searchInput)
            );

            // Assuming you have a function displayProducts() to display the filtered data
            displayProducts(filteredData);

            // Hide the filter bar if it exists
            const filterBar = document.querySelector('.filter-bar');
            if (filterBar) {
                filterBar.style.display = 'none';
            }
        }












        //_______________________Cart for each pages_________________________

            //---------------Retrieve cart data from local storage on page load----------------
            let list__Cart = document.querySelector('.listCart');
            let navbar__cartSpan = document.querySelector('.navbar-cart span');


            window.addEventListener('load', () => {
                // Get cart data from local storage
                const cartData = JSON.parse(localStorage.getItem('cart'));
                // If cart data exists, assign it to cartBox array
                if (cartData && Array.isArray(cartData)) {
                    cartBox = cartData;
                }
                console.log("CartBox",cartBox);
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




            //-----------------CAPTURE PRODUCT POSITION click in cart and minus or plus click----------
            list__Cart.addEventListener('click',(event)=>{
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


            //--------------ADJUST QUANTITY and price when plus or minus click------------
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
            const addcarttoHTML = () => {
            list__Cart.innerHTML = '';
            let totalQuantity = 0;
            if (cartBox.length > 0) {
                cartBox.forEach(cartss => {
                    totalQuantity += cartss.quantity;
                    let newCart = document.createElement('div');
                    newCart.classList.add('listCart-items');
                    newCart.dataset.id = cartss.product_id;
                    console.log(cartss.product_id);
                    let product = allProductsArray.find(product => product.products_id == cartss.product_id);
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
                        list__Cart.appendChild(newCart);
                    } else {
                        console.error(`Product with ID ${cartss.product_id} not found.`);
                    }
                })
            }
            navbar__cartSpan.innerText = totalQuantity;
        }




        //^^^^^^^^^^^^^^Product Id render when click on each button^^^^^^^^^^^^^^
        document.getElementById('results').addEventListener('click', function(event) {
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
                console.log("Product ID:",product_id);
                addtoCart(product_id);
            }
        });




        //^^^^^^^^^^^^^Function to add product to cart^^^^^^^^^^^^^^
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
            console.log("addtoCart cartBox:",cartBox);
            addcarttoHTML(); // Update HTML representation of cart
            saveCartToLocalStorage(); // Save cart data to local storage
        };







 





</script>
<script src="script.js"></script>
</body>
</html>