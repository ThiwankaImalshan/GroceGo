<?php
    session_start();

    // Initialize the loggedin session variable
        if (!isset($_SESSION["loggedin"])) {
            $_SESSION["loggedin"] = false;
        }

?>

<?php

    // Initialize the loggedin session variable if not already set
    if (!isset($_SESSION["loggedin"])) {
        $_SESSION["loggedin"] = false;
    }

    // Check if the user is logged in
    if ($_SESSION["loggedin"] === false) {
        // Redirect to index.html if not logged in
        header("Location: index.php");
        exit;
    }

    // Your existing checkout.php code goes here
?>


<?php

$isLoggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]; // Check if $_SESSION["loggedin"] is set and true

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GrocGo</title>
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="jQueryFile.js"></script>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <style>
      .navbar-signin img{
          width: 35px;
          height:35px;
          border-radius: 35px;
      }
      .submit-order-btn{
        cursor: pointer;
      }
    </style>
  </head>
  <body class="checkout-body">
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
              <button class="hamburger rpbtn">&#9776;</button>
              <button class="cross rpbtn" title="Close">&#735;</button>
              <div class="navbar-signin nav-sign-icon">
                  <?php if ($isLoggedIn): ?>
                          <img src="img/Customer.png" alt="User Profile Image" id="signin-popup-img">
                  <?php else: ?>
                          <i class="fa fa-user-circle-o" aria-hidden="true" id="signin-popup-icon"></i>
                  <?php endif; ?>
              </div>
            </ul>
          </div>
        </div>
      </div>
    </header>
    <br />
    <!-----Responsive navigation bar-->
    <div class="menu rpbtn" style="top: 6rem; right: 0px; position: fixed">
      <ul>
        <a href="index.php"><li>Home</li></a>
        <a href="product.php"><li>Product</li></a>
        <a href="services.php"><li>Service</li></a>
        <a href="about.php"><li>About Us</li></a>
      </ul>
    </div>
    <script>
      $(document).ready(function () {
        $(".cross").hide();
        $(".menu").hide();php

        $(".hamburger").click(function () {
          $(".menu").slideToggle("slow", function () {
            $(".hamburger").fadeOut(200);
            $(".cross").fadeIn();
          });
        });

        $(document).click(function (e) {
          if (
            !$(e.target).closest(".menu").length &&
            !$(e.target).closest(".hamburger").length
          ) {
            $(".menu").slideUp("slow", function () {
              $(".cross").fadeOut(200);
              $(".hamburger").fadeIn();
            });
          }
        });
      });
    </script>



    <!-- Checkout Container -->
    <div class="checkout-container">
      <h3>Checkout</h3>
      <div class="checkout-container-sections">
        <!-- First -->
        <div class="checkout-container-section1">
          <div class="checkout-customer-info">
            <h4>Customer Information</h4>
            <form id="checkout-form" >
              <div class="form-field-wrapper">
                <input
                  type="text"
                  id="email"
                  placeholder="Email*"
                  autocomplete="off"
                  spellcheck="false"
                  title="Enter Your email address here"
                  autofocus
                />
              </div>
              <div class="form-field-wrapper">
                <input
                  type="text"
                  id="tel"
                  placeholder="Phone*"
                  autocomplete="off"
                  spellcheck="false"
                  title="Enter Your Telephone number here"
                  maxlength="12"
                  required
                />
              </div>
              <div class="form-field-wrapper flex">
                <div class="form-field-wrapper">
                  <input
                    type="text"
                    id="fname"
                    placeholder="First Name*"
                    autocomplete="off"
                    spellcheck="false"
                    title=" Enter Your First name"
                    required
                  />
                </div>
                <div class="form-field-wrapper">
                  <input
                    type="text"
                    id="lname"
                    placeholder="Last Name*"
                    spellcheck="false"
                    autocomplete="off"
                    title=" Enter Your Last name"
                    required
                  />
                </div>
              </div>
              <div class="form-field-wrapper">
                <input
                  type="text"
                  id="address"
                  placeholder="Street Address*"
                  autocomplete="off"
                  spellcheck="false"
                  title="Enter Your  address"
                  required
                />
              </div>
              <div class="form-field-wrapper flex">
                <div class="form-field-wrapper city-container">
                  <input type="text" id="city" placeholder="City*" spellcheck="false" autocomplete="off" title="City" required />
                  <ul id="subCityList"></ul>
                </div>
                <div class="form-field-wrapper">
                  <input
                    type="text"
                    id="postal-code"
                    placeholder="Postal Code"
                    autocomplete="off"
                    spellcheck="false"
                    title="Postal code"
                    required
                  />
                </div>
              </div>
            <!-- </form> -->
          </div>
          <div class="checkout-shipping">
            <!-- second -->
            <h4>Shipping Information</h4>
            <div class="checkout-selection-bar">
              <input type="radio" name="radio-cat1" id="radio1" />
              <label for="radio1"
                >Pickup from nearby outlet: <span id="cityNameSpan"></span
              ></label>
            </div>
            <div class="checkout-selection-bar">
              <input type="radio" name="radio-cat1" id="radio2" />
              <label for="radio2"
                >Delivary through courier service:
                <span id="deliveryChargeSpan"></span
              ></label>
            </div>
          </div>
          <div class="checkout-payment">
            <h4>Payment Information</h4>
            <div class="checkout-selection-bar">
              <input type="radio" name="radio-cat2" id="radio3" />
              <label for="radio3">Cash on Delivary</label>
            </div>
            <div class="checkout-selection-bar">
              <input type="radio" name="radio-cat2" id="radio4" />
              <label for="radio4">Cash Payment</label>
            </div>
          </div>
        </div>
        <div class="checkout-container-section2">
          <!-- thrid -->
          <div class="checkout-order-summery">
            <h4>Order Summary</h4>

            <div class="order-detail-box" id="orderDetail-Box"></div>

            <h5 id="price-div-1">
              Stock available Near to you : <span id="shipping-city"></span>
            </h5>
            <div class="order-price-calculations" id="price-div-2">
              <p>Sub Total : <span id="sub-total"></span></p>
              <p id="shipping-charge">
                Shipping Charge : <span id="shipping-cost"></span>
              </p>
            </div>
            <h6 id="price-div-3">Total : <span id="full-total"></span></h6>
            <input type="hidden" id="order-details" name="order-details">
            <input type="hidden" id="cityNameInput" name="cityName">
            <input type="hidden" id="totalValueInput" name="totalValue">
            <input type="hidden" id="shippingOptionInput" name="shippingOption">
            <div class="btn-place-your-order" id="price-div-4">
              <button type="submit" id="submit-order-btn">Place Your Order</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>












    <!-- Footer Section -->
    <footer>
      <div class="footer-container">
        <img src="img/footer-bg.png" alt="Footer Background" />
        <div class="footer-content">
          <div class="footer-content-sec1">
            <div class="footer-sec footer-sec1">
              <h3>GrocGo</h3>
              <br />
              <p>Copyright © 2024 GrocGo LK (PVT) Ltd.</p>
              <p>All Rights Reserved</p>
              <p>Designed & Developed by .......................</p>
            </div>
          </div>
          <div class="footer-content-sec2">
            <div class="footer-sec footer-sec2">
              <h3>Customer Care</h3>
              <br />
              <p><a href="about.php">About US</a></p>
              <p><a href="services.php">Services</a></p>
              <p><a href="product.php">Products</a></p>
            </div>
            <div class="footer-sec footer-sec3">
              <h3>Contact Us</h3>
              <br />
              <p>
                <a href="tel:+9471234567"
                  ><i class="fa fa-phone" aria-hidden="true"></i
                  >&nbsp;&nbsp;+9471234567</a
                >
              </p>
              <p>
                <a href="https://maps.app.goo.gl/iZKTKozdvHXE7WxQ9"
                  ><i class="fa fa-map-marker" aria-hidden="true"></i
                  >&nbsp;&nbsp;&nbsp;Waidya Road, Dehiwala</a
                >
              </p>
              <p>
                <a href="mailto: grocgo@gmail.com"
                  ><i class="fa fa-envelope" aria-hidden="true"></i
                  >&nbsp;&nbsp;grocgo@gmail.com</a
                >
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>







    <script>

        document.addEventListener("DOMContentLoaded", () => {
            // const orderForm = document.getElementById("orderForm");
            // const cityNameInput = document.getElementById("cityNameInput");
            // const totalValueInput = document.getElementById("totalValueInput");
            const shippingOptionInput = document.getElementById("shippingOptionInput");

            // Function to update the hidden input with the selected radio button ID
            const updateShippingOptionInput = () => {
                const selectedRadio = document.querySelector('input[name="radio-cat1"]:checked');
                if (selectedRadio) {
                    shippingOptionInput.value = selectedRadio.id; // You can change this to selectedRadio.name if you want the name
                }
            };

            // Attach event listeners to radio buttons
            const radioButtons = document.querySelectorAll('input[name="radio-cat1"]');
            radioButtons.forEach(radio => {
                radio.addEventListener("change", updateShippingOptionInput);
            });

            // orderForm.addEventListener("submit", (event) => {
            //     const cityNameSpan = document.getElementById("cityNameSpan").textContent;
            //     const totalValue = document.getElementById("subTotalSpan").textContent.replace("Rs.", "").trim();

            //     cityNameInput.value = cityNameSpan;
            //     totalValueInput.value = totalValue;

            //     // Ensure the hidden input is updated on form submission
            //     updateShippingOptionInput();
            // });
        });























      // Get the radio buttons
      const radioCat1 = document.getElementsByName("radio-cat1");
      const radioCat2 = document.getElementsByName("radio-cat2");

      // Add event listeners to radioCat1
      radioCat1.forEach(function(radio) {
          radio.addEventListener("change", function() {
              if (radio.id === "radio1") {
                  // If radio1 is selected, automatically select radio4 in radio-cat2 and disable radio3
                  selectRadio(radioCat2, "radio4");
                  disableRadio(radioCat2, "radio3");
              } else if (radio.id === "radio2") {
                  // If radio2 is selected, automatically select radio3 in radio-cat2 and disable radio4
                  selectRadio(radioCat2, "radio3");
                  disableRadio(radioCat2, "radio4");
              }
          });
      });

      // Function to select a radio button in a radio group
      function selectRadio(radioGroup, radioId) {
          radioGroup.forEach(function(radio) {
              if (radio.id === radioId) {
                  radio.checked = true;
              }
          });
      }

      // Function to disable a radio button in a radio group
      function disableRadio(radioGroup, radioId) {
          radioGroup.forEach(function(radio) {
              if (radio.id === radioId) {
                  radio.disabled = true;
              } else {
                  radio.disabled = false;
              }
          });
      }




























        document.getElementById('checkout-form').addEventListener('submit', function(event) {
          event.preventDefault();

          const orderDetails = {
              email: document.getElementById('email').value,
              phone: document.getElementById('tel').value,
              firstName: document.getElementById('fname').value,
              lastName: document.getElementById('lname').value,
              address: document.getElementById('address').value,
              city: document.getElementById('city').value,
              postalCode: document.getElementById('postal-code').value,
              cartItems: cartBox
          };

          const orderDetailsInput = document.getElementById('order-details');
          if (orderDetailsInput) {
              orderDetailsInput.value = JSON.stringify(orderDetails);

              const formData = new FormData(document.getElementById('checkout-form'));

              fetch('submit_order.php', {
                  method: 'POST',
                  body: formData
              })
              .then(response => response.text())
              .then(data => {
                  alert(data);
                  // Optionally, redirect or update the UI
              })
              .catch(error => console.error('Error:', error));
          } else {
              console.error('Order details input not found.');
          }
      });
 






    
      //_______________________Cart for each pages_________________________

      //---------------Retrieve cart data from local storage on page load----------------
      let order_Detail_Box = document.querySelector(".order-detail-box");

      window.addEventListener("load", () => {
        // Get cart data from local storage
        const cartData = JSON.parse(localStorage.getItem("cart"));
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
        console.log("Cart data from local storage:", cartBox);

        // Get outerArray data from local storage
        const outerItems = JSON.parse(localStorage.getItem("allProductsArray"));

        order_Detail_Box.innerHTML = "";

        let totalQuantity = 0;
        let totalPrice = 0; // Variable to store the total price

        if (cartBox.length > 0) {
          cartBox.forEach((cartss) => {
            totalQuantity += cartss.quantity;
            let newCart = document.createElement("div");
            newCart.classList.add("order-details");
            newCart.dataset.id = cartss.product_id;
            let positionProduct = outerItems.findIndex(
              (value) => value.products_id == cartss.product_id
            );
            let info = outerItems[positionProduct];

            const itemPrice = info.products_price * cartss.quantity; // Calculate the total price for this item
            totalPrice += itemPrice; // Add the item price to the total price

            newCart.innerHTML = `
                    <div class="order-details-img">
                        <img src="${info.products_image}" alt="${info.products_name}">
                    </div>
                    <div class="order-details-texts">
                        <div class="order-detail-txt">
                            <p>${info.products_name}<span>Rs.${itemPrice}</span></p>
                        </div>
                        <div class="order-detail-icons">
                            <div class="order-add-items">
                                <button class="add-items-btn-minus items-btn">-</button>
                                <span class="add-no-of-items">${cartss.quantity}</span>
                                <button class="add-items-btn-plus items-btn">+</button>
                            </div>
                        </div>
                    </div>
                `;
            order_Detail_Box.appendChild(newCart);
          });
        }
        console.log("Cart items rendered successfully.");
        // Display total price
        const totalPriceElement = document.getElementById("sub-total");
        totalPriceElement.textContent = `Rs.${totalPrice}`;
      };




          // Capture the product position click in cart and minus or plus click
          order_Detail_Box.addEventListener("click", (event) => {
            let positionClick = event.target;
            if (
              positionClick.classList.contains("add-items-btn-minus") ||
              positionClick.classList.contains("add-items-btn-plus")
            ) {
              let product_id =
                positionClick.parentElement.parentElement.parentElement
                  .parentElement.dataset.id;
              let type = "add-items-btn-minus";
              if (positionClick.classList.contains("add-items-btn-plus")) {
                type = "add-items-btn-plus";
              }
              changequantity(product_id, type);
              console.log(product_id, type);
            }
          });

          // Adjust quantity and price when plus or minus click
          const changequantity = (product_id, type) => {
            let positionItemInCart = cartBox.findIndex(
              (value) => value.product_id == product_id
            );
            if (positionItemInCart >= 0) {
              switch (type) {
                case "add-items-btn-plus":
                  cartBox[positionItemInCart].quantity =
                    cartBox[positionItemInCart].quantity + 1;
                  break;

                default:
                  let valueChange = cartBox[positionItemInCart].quantity - 1;
                  if (valueChange > 0) {
                    cartBox[positionItemInCart].quantity = valueChange;
                  } else {
                    cartBox.splice(positionItemInCart, 1);
                  }
                  break;
              }
            }
            saveCartToLocalStorage();
            addcarttoHTML();
          };

          // Function to save the cart data to local storage
          const saveCartToLocalStorage = () => {
            localStorage.setItem("cart", JSON.stringify(cartBox));
          };

          // Add cart to HTML file
          const addcarttoHTML = () => {
            order_Detail_Box.innerHTML = "";
            const outerItems = JSON.parse(
              localStorage.getItem("allProductsArray")
            );

            let totalQuantity = 0;
            let totalPrice = 0; // Variable to store the total price

            if (cartBox.length > 0) {
              cartBox.forEach((cartss) => {
                totalQuantity += cartss.quantity;
                let newCart = document.createElement("div");
                newCart.classList.add("order-details");
                newCart.dataset.id = cartss.product_id;
                let positionProduct = outerItems.findIndex(
                  (value) => value.products_id == cartss.product_id
                );

                if (positionProduct !== -1) { // Check if product was found
                  let info = outerItems[positionProduct];

                  const itemPrice = parseFloat(info.products_price) * cartss.quantity; // Calculate the total price for this item
                  totalPrice += itemPrice; // Add the item price to the total price

                  newCart.innerHTML = `
                    <div class="order-details-img">
                        <img src="${info.products_image}" alt="${info.products_name}">
                    </div>
                    <div class="order-details-texts">
                        <div class="order-detail-txt">
                            <p>${info.products_name}<span>Rs.${itemPrice.toFixed(2)}</span></p>
                        </div>
                        <div class="order-detail-icons">
                            <div class="order-add-items">
                                <button class="add-items-btn-minus items-btn">-</button>
                                <span class="add-no-of-items">${cartss.quantity}</span>
                                <button class="add-items-btn-plus items-btn">+</button>
                            </div>
                        </div>
                    </div>
                  `;
                  order_Detail_Box.appendChild(newCart);
                } else {
                  console.error(`Product with id ${cartss.product_id} not found in outerItems.`);
                }
              });
            }
            const totalPriceElement = document.getElementById("sub-total");
            totalPriceElement.textContent = `Rs.${totalPrice.toFixed(2)}`;
          };



      

      // Function to add product to cart
      const addtoCart = (product_id) => {
        let positionThisProductInCart = cartBox.findIndex(
          (value) => value.product_id == product_id
        );
        if (cartBox.length <= 0) {
          cartBox = [
            {
              product_id: product_id,
              quantity: 1,
            },
          ];
        } else if (positionThisProductInCart < 0) {
          cartBox.push({
            product_id: product_id,
            quantity: 1,
          });
        } else {
          cartBox[positionThisProductInCart].quantity += 1;
        }
        console.log(cartBox);
        addcarttoHTML(); // Update HTML representation of cart
        saveCartToLocalStorage(); // Save cart data to local storage
      };




      //-------------display nearby city branch and delivery charge---------------
      // Function to fetch and display data based on input value
      function fetchDataAndDisplay(cityInput) {
        // Fetch data from city.json
        fetch("city.json")
          .then((response) => {
            if (!response.ok) {
              throw new Error("Network response was not ok");
            }
            return response.json();
          })
          .then((data) => {
            console.log("Fetched data:", data); // Debug: Check if data is fetched correctly

            // Flag to check if any subcity matches the input
            let matchFound = false;

            // Iterate over each city
            data.forEach((cityData) => {
              const cityName = cityData.city;

              // Iterate over subcities for each city
              cityData.subCities.forEach((subCity) => {
                console.log("Subcity:", subCity); // Debug: Check the current subcity
                // Check if subCity is defined and if the input city matches it
                if (
                  subCity &&
                  subCity.name &&
                  subCity.name.toLowerCase() === cityInput
                ) {
                  console.log("Match found:", subCity); // Debug: Confirm a match is found
                  document.getElementById(
                    "cityNameSpan"
                  ).textContent = `${cityName}`;
                  document.getElementById(
                    "cityNameInput"
                  ).value = `${cityName}`;
                  document.getElementById(
                    "shipping-city"
                  ).textContent = `${cityName}`;
                  document.getElementById(
                    "shipping-cost"
                  ).textContent = `Rs.${subCity.deliveryCharge}`;
                  document.getElementById(
                    "deliveryChargeSpan"
                  ).textContent = `Rs.${subCity.deliveryCharge}`;
                  matchFound = true;
                }
              });
            });

            // If no match found, clear the spans
            if (!matchFound) {
              console.log("No matching subcity found"); // Debug: Confirm no match is found
              document.getElementById("cityNameSpan").textContent = "";
              document.getElementById("shipping-city").textContent = "";
              document.getElementById("shipping-cost").textContent = "";
              document.getElementById("deliveryChargeSpan").textContent = "";
            }
          })
          .catch((error) => {
            console.error("Error fetching data:", error);
          });
      }

      // Add event listener to input field
      document.getElementById("city").addEventListener("input", function () {
        const cityInput = this.value.toLowerCase(); // Get input value and convert to lowercase
        fetchDataAndDisplay(cityInput); // Fetch data and display based on input value
      });

      // Add event listener to suggested subcities (inside <li> tags)
      document
        .getElementById("subCityList")
        .addEventListener("click", function (event) {
          if (event.target.tagName === "LI") {
            const subCityName = event.target.textContent.trim().toLowerCase(); // Get subcity name from clicked li
            document.getElementById("city").value = subCityName; // Fill input field with clicked subcity name
            fetchDataAndDisplay(subCityName); // Fetch data and display based on clicked subcity name
          }
        });

      //-------------------suggest city-------------------
      // Add event listener to input field
      document.getElementById("city").addEventListener("input", function () {
        const cityInput = this.value.toLowerCase().trim(); // Get trimmed input value and convert to lowercase
        const subCityList = document.getElementById("subCityList");

        // Fetch data from city.json
        fetch("city.json")
          .then((response) => {
            if (!response.ok) {
              throw new Error("Network response was not ok");
            }
            return response.json();
          })
          .then((data) => {
            console.log("Fetched data:", data); // Debug: Check if data is fetched correctly

            // Flag to check if any subcity matches the input
            let matchFound = false;

            // Clear the subcity list
            subCityList.innerHTML = "";

            // Hide the subCityList if the input field is empty
            if (cityInput === "") {
              subCityList.style.display = "none";
              return; // Exit the function if the input field is empty
            }

            // Iterate over each city
            data.forEach((cityData) => {
              const cityName = cityData.city;

              // Iterate over subcities for each city
              cityData.subCities.forEach((subCity) => {
                console.log("Subcity:", subCity); // Debug: Check the current subcity
                // Check if subCity is defined and if the input city matches it
                if (
                  subCity &&
                  subCity.name &&
                  subCity.name.toLowerCase().includes(cityInput)
                ) {
                  console.log("Match found:", subCity); // Debug: Confirm a match is found
                  matchFound = true;

                  // Create li element for the subcity and add to subCityList
                  const li = document.createElement("li");
                  li.textContent = subCity.name;
                  li.addEventListener("click", function () {
                    // Set the input value to the selected subcity
                    document.getElementById("city").value = subCity.name;
                    // Hide the subCityList
                    subCityList.style.display = "none";
                  });
                  subCityList.appendChild(li);
                }
              });
            });

            // If no match found, hide the subCityList
            if (!matchFound) {
              console.log("No matching subcity found"); // Debug: Confirm no match is found
              subCityList.style.display = "none";
            } else {
              // Show the subCityList only if there are matches and the input field is not empty
              if (cityInput !== "") {
                subCityList.style.display = "block";
              }
            }
          })
          .catch((error) => {
            console.error("Error fetching data:", error);
          });
      });

      // Add event listener to document body to hide subCityList when clicking outside of it or the input field
      document.body.addEventListener("click", function (event) {
        const subCityList = document.getElementById("subCityList");
        const cityInput = document.getElementById("city");

        // Check if the click target is not within the subCityList or the input field
        if (
          !event.target.closest("#subCityList") &&
          event.target !== cityInput
        ) {
          subCityList.style.display = "none"; // Hide the subCityList
        }
      });

      // Check if cartBox is empty
      const cartData = JSON.parse(localStorage.getItem("cart"));
      const priceDiv1 = document.getElementById("price-div-1"); // Assuming the ID of the price div is 'price-div'
      const priceDiv2 = document.getElementById("price-div-2");
      const priceDiv3 = document.getElementById("price-div-3");
      const priceDiv4 = document.getElementById("price-div-4");

      if (!cartData || cartData.length === 0) {
        // If cartData is empty or undefined, or if cartData has no items
        priceDiv1.style.display = "none"; // Hide the price div
        priceDiv2.style.display = "none";
        priceDiv3.style.display = "none";
        priceDiv4.style.display = "none";
      } else {
        // If cartData is not empty and has items
        priceDiv1.style.display = "block"; // Show the price div
        priceDiv2.style.display = "block";
        priceDiv3.style.display = "block";
        priceDiv4.style.display = "flex";
      }

      //--------------Total calculation with deliver charge or without delivery charge-----------------
      const radioInput1 = document.getElementById("radio1"); // Replace 'radio-id' with the actual ID of your radio button
      const radioInput2 = document.getElementById("radio2");
      const subTotalSpan = document.getElementById("sub-total");

      const input_city = document.getElementById("city"); // Replace 'city' with the actual ID of your input field

      // Function to update total based on radio button state
      const updateTotal = () => {
      const fullTotalDiv = document.getElementById("full-total");
      const totalValueInput = document.getElementById("totalValueInput");
      const shipping_Charge = document.getElementById("shipping-charge");
      const delivery_charge_span = document.getElementById("deliveryChargeSpan");
      let shippingCont = 0; // Initialize shipping charge to 0

        if (delivery_charge_span.textContent.trim() !== "") {
            // If delivery charge is not empty, get the shipping charge
            shippingCont = parseFloat(delivery_charge_span.textContent.replace("Rs.", ""));
        }

        if (radioInput2.checked) {
            // If radio input 2 is checked
            if (shippingCont === 0) {
                // If delivery charge is empty, set full total to empty
                fullTotalDiv.style.display = "none";
            } else {
                // If radio button is selected, show div and calculate total with shipping charge
                shipping_Charge.style.display = "block";
                const subTotal = parseFloat(subTotalSpan.textContent.replace("Rs.", ""));
                const ship_charge = parseFloat(delivery_charge_span.textContent.replace("Rs.", ""));
                const totalValue = ship_charge + subTotal;
                fullTotalDiv.textContent = "Rs." + totalValue;

                // Set the total value to the hidden input field
                totalValueInput.value = totalValue;
            }
        } else if (radioInput1.checked) {
            shipping_Charge.style.display = "none";
            const subTotal = parseFloat(subTotalSpan.textContent.replace("Rs.", ""));
            fullTotalDiv.textContent = "Rs." + subTotal;

            // Set the total value to the hidden input field
            totalValueInput.value = subTotal;
        } else {
            // If radio button is not selected, hide div
            shipping_Charge.style.display = "none";
            fullTotalDiv.textContent = "";

            // Set an empty value to the hidden input field
            totalValueInput.value = "";
        }
    };


      // Listen for change event on radio button
      radioInput1.addEventListener("change", updateTotal);
      radioInput2.addEventListener("change", updateTotal);

      // Function to update total when value in sub-total span changes
      const updateTotalOnValueChange = () => {
        updateTotal(); // Call the updateTotal function to recalculate the total
      };

      // MutationObserver to observe changes in sub-total span
      const observer = new MutationObserver(updateTotalOnValueChange);

      // Configuration of the observer
      const config = { attributes: false, childList: true, subtree: false };

      // Start observing the target node (sub-total span) for changes
      observer.observe(subTotalSpan, config);

      //----------------Disable radio buttons when city input empthy-------------
      // Function to check if the input field is empty
      const isCityEmpty = () => {
        return input_city.value.trim() === "";
      };

      // Function to update radio buttons based on the input field value
      const updateRadioButtons = () => {
        if (isCityEmpty()) {
          // If the input field is empty, disable radio buttons
          radioInput1.disabled = true;
          radioInput2.disabled = true;
        } else {
          // If the input field has a value, enable radio buttons
          radioInput1.disabled = false;
          radioInput2.disabled = false;
        }
      };

      // Listen for input event on the input field
      input_city.addEventListener("input", updateRadioButtons);

      // Initial update when page loads
      updateRadioButtons();
    </script>
    <script src="shopping-cart.js"></script>
  </body>
</html>
