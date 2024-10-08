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
    body{
        position: absolute;
        width: 100%;
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
                        <!-- <button class="hamburger rpbtn" >&#9776;</button>
                        <button class="cross rpbtn" title="Close">&#735;</button> -->
                    </ul>
                </div>
            </div>
        </div>
       
    </header>
                <!-----Responsive navigation bar-->
                <!-- <div class="menu rpbtn" style="top: 5.8rem; position: fixed;">
                  <ul>
                    <a href="index.php"><li>Home</li></a>
                    <a href="product.php"><li>Product</li></a>
                    <a href="services.php"><li>Service</li></a>
                    <a href="about.php"><li>About Us</li></a>
                  
                  </ul>
                </div>  -->
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
        </div>
    </div>

    <main>
        <div class="cityCardContainer">
            <h3 class="cityCardContainer-Heading">Our Delivery Grid</h3>
            <div id="cityContainer" class="city-container-box"></div>
            <ul id="subCityList" class="sub-city-list"></ul>
        </div>
    </main>

    <div class="location-main">
        <h3 class="cityCardContainer-Heading">Our Delivery Branches</h3>
        <div class="location-container">
            <div class="location-cards" id="locationCards">
                <!-- <button id="button1">Location 1</button>
                <button id="button2">Location 2</button> -->
            </div>
            <div class="location-map">
                <div id="map"></div>
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

    <script>

        
// Function to fetch data from city.json
function fetchCityData() {
  return fetch('city.json')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
}

// Function to create a card for each city
function createCityCard(cityData) {
  const cityContainer = document.getElementById('cityContainer');

  // Create card element
  const card = document.createElement('div');
  card.classList.add('card-city');
  
  // Create card title (city name)
  const title = document.createElement('h3');
  title.textContent = cityData.city;
  card.appendChild(title);
  
  // Create sub-city list
  const subCityList = document.createElement('ul');
  subCityList.classList.add('sub-city-list');

  // Add event listener to show sub-cities when clicked
  card.addEventListener('click', () => {
    // Clear existing sub-city list
    subCityList.innerHTML = '';

    // Create li elements for each sub-city
    cityData.subCities.forEach(subCity => {
      const li = document.createElement('li');
      li.textContent = subCity.name;
      subCityList.appendChild(li);
    });

    // Toggle visibility of sub-city list
    subCityList.classList.toggle('show');
  });

  // Append sub-city list to card
  card.appendChild(subCityList);

  // Append card to container
  cityContainer.appendChild(card);
}

// Fetch city data and create cards
fetchCityData()
  .then(data => {
    data.forEach(cityData => {
      createCityCard(cityData);
    });
  });














        // Function to initialize the map
    function initMap() {
      const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 6.9271, lng: 79.8612 }, // Default center
        zoom: 10,
      });

      // Function to add marker to the map
      function addMarker(location) {
        new google.maps.Marker({
          position: location,
          map: map,
        });
      }

      // Fetch data from city.json
      fetch('city.json')
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          const locationCardsContainer = document.querySelector('.location-cards');
          
          // Iterate over each city data
          data.forEach(cityData => {
            const cityName = cityData.city;
            const cityDetails = cityData.details;
            
            // Create card element
            const card = document.createElement('div');
            card.classList.add('location-card');
            
            // Add city name to the card
            const cityNameElement = document.createElement('h3');
            cityNameElement.textContent = cityName;
            card.appendChild(cityNameElement);
            
            // Add address and telephone details to the card
            const detailsList = document.createElement('ul');
            for (const [key, value] of Object.entries(cityDetails)) {
              // Check if the key is address or telephone
              if (key === 'address' || key === 'telephone') {
                // Capitalize first letter of the key
                const capitalizedKey = key.charAt(0).toUpperCase() + key.slice(1);
                
                // Create detail item element
                const detailItem = document.createElement('li');
                
                // Bold the key
                detailItem.innerHTML = `<strong>${capitalizedKey}</strong>: ${value}`;
                
                // Append the detail item to the list
                detailsList.appendChild(detailItem);
              }
            }
            card.appendChild(detailsList);
            
            // Add click event listener to show location on map
            card.addEventListener('click', () => {
              const lat = parseFloat(cityDetails.lat);
              const lng = parseFloat(cityDetails.lng);
              if (!isNaN(lat) && !isNaN(lng)) {
                map.setCenter({ lat, lng });
                map.setZoom(15); // Zoom in for better view
                addMarker({ lat, lng });
              } else {
                alert('Latitude and longitude not available for this city.');
              }
            });
            
            // Append the card to the container
            locationCardsContainer.appendChild(card);
          });
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    }



    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>
</body>
</html>