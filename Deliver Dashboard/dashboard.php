<?php
session_start();
require 'config.php'; // Include your database configuration

// Ensure the user is logged in
if (!isset($_SESSION['deliver_name'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['deliver_name'];

// Prepare and execute the query
$stmt = $conn->prepare("SELECT deliver_id, deliver_name, deliver_email, deliver_photo FROM delivers WHERE deliver_name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $deliver_id = $user['deliver_id'];
    $deliver_name = $user['deliver_name'];
    $deliver_photo = $user['deliver_photo'];
    $deliver_email = $user['deliver_email'];
} else {
    // Handle user not found
    echo "User not found";
    exit();
}

$stmt->close();
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ============ Remixicon ============ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css">

        <!-- ============ CSS ============ -->
        <link rel="stylesheet" href="assets/css/style.css">

        <title>Delivery Dashboard</title>

        <style>
            .num-plate {
                display: flex;
                justify-content: center; /* Center the image horizontally */
                align-items: center;     /* Center the image vertically */
                /* margin-top:20px; */
                height: 80px;           /* Adjust height as needed */
                width: 27%;            /* Adjust width as needed */
            }

            .number-plate-img {
                max-width: 100%;         /* Ensure the image does not overflow the container */
                max-height: 100%;        /* Ensure the image does not overflow the container */
                width: auto;             /* Maintain aspect ratio */
                height: auto;            /* Maintain aspect ratio */
            }

            @media (max-width: 768px) {
                .num-plate {
                    height: 100px;       /* Increase height for smaller screens */
                    width: 100%;        /* Increase width for smaller screens */
                }

                .number-plate-img {
                    max-width: 80%;      /* Adjust the image size relative to the container */
                    max-height: 80%;     /* Adjust the image size relative to the container */
                }
            }
        </style>
    </head>
    <body>
        <!-- Sidebar bg -->
        <img src="assets/img/blank-white.jpg" alt="sidebar img" class="bg-image">

        <!-- ============ Header ============ -->
         <header class="header">
            <div class="header__container container">
                <div class="header__toggle" id="header-toggle">
                    <i class="ri-menu-line"></i>
                </div>

                <a href="#" class="header__logo">
                    <img src="assets/img/logo-medium - Copy.png" alt="">
                     <!-- <h2>GrocGo</h2> -->
                </a>
            </div>
         </header>

        <!-- ============ SideBar ============ -->
         <div class="sidebar" id="sidebar">
            <nav class="sidebar__container">
                <div class="sidebar__logo">
                    <img src="assets/img/logo-small.png" alt="" class="sidebar__logo-img">
                    <img src="assets/img/logo-medium.png" alt="" class="sidebar__logo-text">
                </div>

                <div class="sidebar__content">
                    <div class="sidebar__list">
                        <a href="#" class="sidebar__link active-link" data-target="main-home">
                            <i class="ri-home-4-line"></i>
                            <span class="sidebar__link-name">Home</span>
                            <span class="sidebar__link-floating">Home</span>
                        </a>
                
                        <a href="#" class="sidebar__link" data-target="main-orders">
                            <i class="ri-shopping-bag-2-line"></i>
                            <span class="sidebar__link-name">Orders</span>
                            <span class="sidebar__link-floating">Orders</span>
                        </a>
                
                        <a href="#" class="sidebar__link" data-target="main-income">
                            <i class="ri-wallet-3-line"></i>
                            <span class="sidebar__link-name">Income</span>
                            <span class="sidebar__link-floating">Income</span>
                        </a>
                    </div>
                

                    <h3 class="sidebar__title">
                        <span>Account</span>
                    </h3>

                    <div class="sidebar__list">
                        <a href="#" class="sidebar__link" data-target="main-setting">
                            <i class="ri-settings-3-line"></i>
                            <span class="sidebar__link-name">Settings</span>
                            <span class="sidebar__link-floating">Settings</span>
                        </a>

                        <a href="index.php" class="sidebar__link">
                            <i class="ri-logout-box-r-line"></i>
                            <span class="sidebar__link-name">Logout</span>
                            <span class="sidebar__link-floating">logout</span>
                        </a>
                        
                    </div>

                </div>

                <!-- <div class="sidebar__account">
                    <img src="assets/img/profile-pic.jpg" alt="sidebar image" class="sidebar__perfil">

                    <div class="sidebar__names">
                       <h3 class="sidebar__name">Will Lens</h3>
                       <span class="sidebar__email">willens@email.com</span>
                    </div> -->
     
                    <!-- <i class="ri-arrow-right-s-line"></i> -->
                <!-- </div> -->

                <div class="sidebar__account">
                    <img src="pro_pic/<?php echo htmlspecialchars($deliver_photo); ?>" alt="Sidebar image" class="sidebar__perfil">
                    <div class="sidebar__names">
                        <h3 class="sidebar__name"><?php echo htmlspecialchars($deliver_name); ?></h3>
                        <span class="sidebar__email"><?php echo htmlspecialchars($deliver_email); ?></span>
                    </div>
                </div>

            </nav>
         </div>
        
        <!-- ============ Main ============ -->
        <main class="main container" id="main">
            <!-- <h1>Sidebar Menu</h1> -->
            <div id="main-home" class="main-content">

                   
                    <!-- Profile Row -->
                    <div class="row card profile-row">
                        <div class="col-12 profile-details">
                            <!-- <img src="assets/img/profile-pic.jpg" alt="Profile Picture" class="profile-pic">
                            <div class="profile-text">
                                <h2 class="profile-name">John Doe</h2>
                                <p class="profile-id">ID: 123456</p>
                            </div> -->
                            <img src="pro_pic/<?php echo htmlspecialchars($deliver_photo); ?>" alt="Profile Picture" class="profile-pic">
                                <div class="profile-text">
                                    <h2 class="profile-name"><?php echo htmlspecialchars($deliver_name); ?></h2>
                                    <p class="profile-id">ID: <?php echo htmlspecialchars($deliver_id); ?></p>
                                </div>

                            <!-- Switch Container -->
                            <div class="switch-container">
                                <label class="switch">
                                    <input type="checkbox" id="status-switch">
                                    <span class="slider"></span>
                                </label>
                                <span class="switch-label" id="status-label">Available</span>
                            </div>
                        </div>
                        




                        <?php
                        // Include the database connection
                        require 'config.php';

                        // Ensure the session is started
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        // Check if deliver_name is set in the session
                        if (!isset($_SESSION['deliver_name'])) {
                            echo '<p>Deliver name not set in session.</p>';
                            exit();
                        }

                        // Fetch deliver_status from delivers table where deliver_name matches
                        $deliver_name = $_SESSION['deliver_name'];
                        $sql = "SELECT deliver_status FROM delivers WHERE deliver_name = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('s', $deliver_name);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $deliver = $result->fetch_assoc();

                        if ($deliver) {
                            $deliver_status = $deliver['deliver_status'];
                        } else {
                            echo '<p>Delivery status not found.</p>';
                            exit();
                        }

                        // Determine if bike-details should be displayed
                        $showBikeDetails = $deliver_status === 'available' || $deliver_status === 'unavailable';
                        ?>

                        <!-- Bike Details Section -->
                        <!-- <div class="col-12 bike-details" style="display: <?php echo $showBikeDetails ? '' : 'none'; ?>;">
                            <div class="bike-info">
                                <h3>Delivery Transporter</h3>
                                <div class="bike-detail">
                                    <div class="detail-row">
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Type:</span> Bike</p>
                                        </div>
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Owner:</span> Company</p>
                                        </div>
                                    </div>
                                    <div class="detail-row">
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Brand:</span> Vespa</p>
                                        </div> -->
                                        <!-- Add another detail if needed -->
                                        <!-- <div class="detail-col">
                                            <p><span class="detail-topic">Model:</span> Primavera</p>
                                        </div>
                                    </div>
                                    <div class="detail-row">
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Weight:</span> 10Kg</p>
                                        </div> -->
                                        <!-- Add another detail if needed -->
                                        <!-- <div class="detail-col">
                                            <p><span class="detail-topic">Branch:</span> Panadura</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="num-plate">
                                    <img class="number-plate-img" src="assets/img/NumPlate.png" alt="">
                                </div> -->
                                
                                <!-- <div class="number-plate"></div> -->
                            <!-- </div>
                            <img src="assets/img/bike.png" alt="Bike Picture" class="bike-pic">
                        </div> -->



                        <!-- <div class="col-12 bike-details" style="display: none;" >
                            <div class="bike-info">
                                <h3>Bike Transporter</h3>
                                <div class="bike-detail">
                                    <div class="detail-row">
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Color:</span> Red</p>
                                        </div>
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Make:</span> Yamaha</p>
                                        </div>
                                    </div>
                                    <div class="detail-row">
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Model:</span> 2021</p>
                                        </div> -->
                                        <!-- Add another detail if needed -->
                                        <!-- <div class="detail-col">
                                            <p><span class="detail-topic">Detail:</span> Description</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="number-plate">ABC-1234</div>
                            </div>
                            <img src="assets/img/bike.png" alt="Bike Picture" class="bike-pic">
                        </div> -->


                        <?php
                        // Include the database connection
                        require 'config.php';

                        // Ensure the session is started
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        // Check if deliver_name is set in the session
                        if (!isset($_SESSION['deliver_name'])) {
                            echo '<p>Deliver name not set in session.</p>';
                            exit();
                        }

                        // Get deliver_name from session
                        $deliver_name = $_SESSION['deliver_name'];

                        // Fetch details from delivers table
                        $sql = "SELECT deliver_vehicle, deliver_from, deliver_numplate FROM delivers WHERE deliver_name = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('s', $deliver_name);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $deliver = $result->fetch_assoc();

                        if ($deliver) {
                            $vehicleType = $deliver['deliver_vehicle'];
                            $branch = $deliver['deliver_from'];
                            $numPlate = $deliver['deliver_numplate'];
                            
                            // Set default values
                            $brand = '';
                            $model = '';
                            $weight = '';
                            $bikePic = 'assets/img/bike.png'; // Default image for Bike

                            // Update details based on vehicle type
                            switch ($vehicleType) {
                                case 'Bike':
                                    $brand = 'Vespa';
                                    $model = 'Primavera';
                                    $weight = '10Kg';
                                    break;
                                case 'Threewheeler':
                                    $brand = 'Bajaj';
                                    $model = 'RE';
                                    $weight = '100Kg';
                                    $bikePic = 'assets/img/threewheeler.png';
                                    break;
                                case 'Truck':
                                    $brand = 'TATA';
                                    $model = 'ACE';
                                    $weight = '500Kg';
                                    $bikePic = 'assets/img/buddytruck.png';
                                    break;
                                default:
                                    $brand = 'Unknown';
                                    $model = 'Unknown';
                                    $weight = 'Unknown';
                                    break;
                            }
                        }
                        ?>
                        <!-- Bike Details Section -->
                        <div class="col-12 bike-details" style="display: <?php echo $showBikeDetails ? '' : 'none'; ?>;">
                            <div class="bike-info">
                                <h3>Delivery Transporter</h3>
                                <div class="bike-detail">
                                    <div class="detail-row">
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Type:</span> <?php echo htmlspecialchars($vehicleType); ?></p>
                                        </div>
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Owner:</span> Company</p>
                                        </div>
                                    </div>
                                    <div class="detail-row">
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Brand:</span> <?php echo htmlspecialchars($brand); ?></p>
                                        </div>
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Model:</span> <?php echo htmlspecialchars($model); ?></p>
                                        </div>
                                    </div>
                                    <div class="detail-row">
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Weight:</span> <?php echo htmlspecialchars($weight); ?></p>
                                        </div>
                                        <div class="detail-col">
                                            <p><span class="detail-topic">Branch:</span> <?php echo htmlspecialchars($branch); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="num-plate">
                                    <img class="number-plate-img" src="assets/img/<?php echo htmlspecialchars($numPlate); ?>" alt="Number Plate">
                                </div>
                            </div>
                            <img src="<?php echo htmlspecialchars($bikePic); ?>" alt="Bike Picture" class="bike-pic">
                        </div>

                    </div>



                    <?php
                    // Include the database connection
                    require 'config.php';

                    // Ensure the session is started
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Check if deliver_name is set in the session
                    if (!isset($_SESSION['deliver_name'])) {
                        echo json_encode(['error' => 'Deliver name not set in session.']);
                        exit();
                    }

                    // Fetch deliver_id from delivers table where deliver_name and deliver_status match
                    $deliver_name = $_SESSION['deliver_name'];
                    $sql = "SELECT order_id FROM delivers WHERE deliver_name = ? AND deliver_status = 'assigned'";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('s', $deliver_name);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $deliver = $result->fetch_assoc();

                    if ($deliver) {
                        $order_id = $deliver['order_id'];

                        // Fetch order details from orders table using the retrieved order_id
                        $sql = "SELECT * FROM orders WHERE order_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('i', $order_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $order = $result->fetch_assoc();

                        if ($order) {
                            // Convert delivery fee to float to avoid errors
                            $delivery_fee = floatval($order['order_deliver']);

                            // Display order details
                            ?>
                            <div class="new-order-container">
                                <div class="order-details-section">
                                    <h3 class="order-title">New Order Received</h3>
                                    <p class="order-description"><strong>Order ID:</strong> <?php echo htmlspecialchars($order['order_id']); ?></p>
                                    <p class="order-description"><strong>Customer Name:</strong> <?php echo htmlspecialchars($order['order_name']); ?></p>
                                    <p class="order-description"><strong>Address:</strong> <?php echo htmlspecialchars($order['order_address']); ?></p>
                                    <p class="order-description"><strong>Order Price:</strong> Rs.<?php echo number_format(floatval($order['order_price']), 2); ?></p>
                                    <p class="order-description"><strong>Delivery Fee:</strong> Rs.<?php echo number_format(floatval($order['order_deliveryCharge']), 2); ?></p>
                                    <!-- <button class="view-details-button"><b>Order In Progress</b></button> -->
                                </div>
                                <div class="order-image-section">
                                    <img src="assets/img/Groce Bucket.png" alt="Product Image" class="order-image">
                                </div>
                            </div>
                            <?php
                        } else {
                            echo "<p>Order not found.</p>";
                        }
                    } else {
                        // echo "<p>Delivery not assigned.</p>";
                    }

                    // Close the statement and connection
                    $stmt->close();
                    $conn->close();
                    ?>







                    <!-- <div class="new-order-container">
                        <div class="order-details-section">
                            <h3 class="order-title">New Order Received</h3>
                            <p class="order-description"><strong>Order ID:</strong> 123456</p>
                            <p class="order-description"><strong>Customer Name:</strong> Jane Doe</p>
                            <p class="order-description"><strong>Address:</strong> 123 Main St, Anytown</p>
                            <p class="order-description"><strong>Order Price:</strong> $50.00</p>
                            <p class="order-description"><strong>Delivery Fee:</strong> $5.00</p>
                            <button class="view-details-button"><b>View Details</b></button>
                        </div>
                        <div class="order-image-section">
                            <img src="assets/img/Groce Bucket.png" alt="Product Image" class="order-image">
                        </div>
                    </div> -->
                    

                
                    <!-- Information Showcase -->
                    <div class="showcase-container">


                    <?php
                    // Include the database connection
                    require 'config.php';

                    // Ensure the session is started
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Check if deliver_name is set in the session
                    if (!isset($_SESSION['deliver_name'])) {
                        echo json_encode(['error' => 'Deliver name not set in session.']);
                        exit();
                    }

                    // Fetch deliver_id from delivers table where deliver_name and deliver_status match
                    $deliver_name = $_SESSION['deliver_name'];
                    $sql = "SELECT order_id FROM delivers WHERE deliver_name = ? AND deliver_status = 'assigned'";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('s', $deliver_name);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $deliver = $result->fetch_assoc();

                    if ($deliver) {
                        $order_id = $deliver['order_id'];

                        // Fetch order details from orders table using the retrieved order_id
                        $sql = "SELECT * FROM orders WHERE order_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('i', $order_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $order = $result->fetch_assoc();

                        if ($order) {
                            // Decode order details JSON
                            $order_details = json_decode($order['order_details'], true);

                            // Prepare item details array
                            $items = [];

                            // Fetch product details for each item
                            foreach ($order_details as $item) {
                                $product_id = $item['product_id'];
                                $quantity = $item['quantity'];

                                // Fetch product information
                                $sql = "SELECT * FROM products WHERE product_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('i', $product_id);
                                $stmt->execute();
                                $product_result = $stmt->get_result();
                                $product = $product_result->fetch_assoc();

                                if ($product) {
                                    // Add item only if the product name is valid
                                    $items[] = [
                                        'id' => htmlspecialchars($product['product_id']),
                                        'name' => (strtolower($product['name']) === 'unknown product') ? '' : htmlspecialchars($product['name']),
                                        'quantity' => $quantity
                                    ];
                                } else {
                                    // Add item with only id and quantity if product is not found
                                    $items[] = [
                                        'id' => htmlspecialchars($product_id),
                                        'name' => '',
                                        'quantity' => $quantity
                                    ];
                                }
                            }

                            // Display order details
                            ?>
                            <div class="details-section order_details">
                                <div class="section-content">
                                    <h3 class="section-title">Order Details</h3>
                                    <p class="section-text"><strong>Order Number:</strong> <?php echo htmlspecialchars($order['order_id']); ?></p>
                                    <p class="section-text"><strong>Date:</strong> <?php echo date('F j, Y'); ?></p>
                                    <p class="section-text"><strong>Items:</strong></p>
                                    <div class="items-container">
                                        <?php if (!empty($items)): ?>
                                            <?php foreach ($items as $item): ?>
                                                <div class="item">
                                                    <p><strong>Product ID:</strong> <?php echo htmlspecialchars($item['id']); ?><br>
                                                    <?php if (!empty($item['name'])): ?>
                                                        <strong>Name:</strong> <?php echo htmlspecialchars($item['name']); ?><br>
                                                    <?php endif; ?>
                                                    <strong>Quantity:</strong> <?php echo htmlspecialchars($item['quantity']); ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p>No items found.</p>
                                        <?php endif; ?>
                                    </div>
                                    <p class="section-text"><strong>Total:</strong> Rs.<?php echo number_format(floatval($order['order_price']), 2); ?></p>
                                </div>
                            </div>
                            <?php
                        } else {
                            echo "<p>Order not found.</p>";
                        }
                    } else {
                        // echo "<p>Delivery not assigned.</p>";
                    }

                    // Close the statement and connection
                    $stmt->close();
                    $conn->close();
                    ?>



                        <!-- Order Details Section -->
                        <!-- <div class="details-section order_details">
                            <div class="section-content">
                                <h3 class="section-title">Order Details</h3>
                                <p class="section-text"><strong>Order Number:</strong> 123456</p>
                                <p class="section-text"><strong>Date:</strong> July 24, 2024</p>
                                <p class="section-text"><strong>Items:</strong></p>
                                <ul class="item-list">
                                    <li>Item 1 - $20.00</li>
                                    <li>Item 2 - $35.00</li>
                                    <li>Item 3 - $10.00</li>
                                </ul>
                                <p class="section-text"><strong>Total:</strong> $65.00</p>
                            </div>
                        </div> -->







                        <?php
                        // Include the database connection
                        require 'config.php';

                        // Ensure the session is started
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        // Check if deliver_name is set in the session
                        if (!isset($_SESSION['deliver_name'])) {
                            echo json_encode(['error' => 'Deliver name not set in session.']);
                            exit();
                        }

                        // Fetch deliver_id from delivers table where deliver_name and deliver_status match
                        $deliver_name = $_SESSION['deliver_name'];
                        $sql = "SELECT order_id FROM delivers WHERE deliver_name = ? AND deliver_status = 'assigned'";

                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('s', $deliver_name);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $deliver = $result->fetch_assoc();

                        if ($deliver) {
                            $order_id = $deliver['order_id'];

                            // Fetch order details from orders table using the retrieved order_id
                            $sql = "SELECT order_name, order_email, order_phone, order_address, order_city, order_postal_code FROM orders WHERE order_id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('i', $order_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $order = $result->fetch_assoc();

                            if ($order) {
                                // Construct the full address
                                $full_address = htmlspecialchars($order['order_address']) . '<br>' .
                                                htmlspecialchars($order['order_city']) . '<br>' .
                                                htmlspecialchars($order['order_postal_code']);
                                ?>
                                <!-- Customer Details Section -->
                                <div class="details-section customer-details">
                                    <div class="section-content">
                                        <h3 class="section-title">Customer Details</h3>
                                        <p class="section-text"><strong>Name:</strong> <?php echo htmlspecialchars($order['order_name']); ?></p>
                                        <p class="section-text"><strong>Email:</strong> <?php echo htmlspecialchars($order['order_email']); ?></p>
                                        <p class="section-text"><strong>Phone:</strong> <?php echo htmlspecialchars($order['order_phone']); ?></p>
                                        <p class="section-text"><strong>Address:</strong></p>
                                        <p class="section-text"><?php echo $full_address; ?></p>
                                    </div>
                                </div>
                                <?php
                            } else {
                                echo "<p>Order not found.</p>";
                            }
                        } else {
                            // echo "<p>Delivery not assigned.</p>";
                        }

                        // Close the statement and connection
                        $stmt->close();
                        $conn->close();
                        ?>




                        <!-- Customer Details Section -->
                        <!-- <div class="details-section customer-details">
                            <div class="section-content">
                                <h3 class="section-title">Customer Details</h3>
                                <p class="section-text"><strong>Name:</strong> Jane Doe</p>
                                <p class="section-text"><strong>Email:</strong> janedoe@example.com</p>
                                <p class="section-text"><strong>Phone:</strong> (555) 123-4567</p>
                                <p class="section-text"><strong>Address:</strong></p>
                                <p class="section-text">123 Main St, Apt 4B</p>
                                <p class="section-text">Springfield, IL 62701</p>
                            </div>
                        </div> -->



                    </div>



                    <!-- <div class="delivery-confirmation-card">
                        <h3 class="confirmation-title">Order Delivered Successfully</h3>
                        <p class="confirmation-message">Thank you for your business! Your order has been successfully delivered.</p>
                        <div class="confirmation-buttons">
                            <button class="confirm-button"><b>Confirm Delivery</b></button>
                            <button class="details-button"><b>Not Delivered</b></button>
                        </div>
                    </div> -->


                    <?php
                    // Include the database connection
                    require 'config.php';

                    // Ensure the session is started
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Check if deliver_name is set in the session
                    if (!isset($_SESSION['deliver_name'])) {
                        echo json_encode(['error' => 'Deliver name not set in session.']);
                        exit();
                    }

                    // Fetch deliver_id from delivers table where deliver_name and deliver_status match
                    $deliver_name = $_SESSION['deliver_name'];
                    $sql = "SELECT order_id FROM delivers WHERE deliver_name = ? AND deliver_status = 'assigned'";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('s', $deliver_name);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $deliver = $result->fetch_assoc();

                    if ($deliver) {
                        $order_id = $deliver['order_id'];
                        ?>
                        <div class="delivery-confirmation-card">
                            <h3 class="confirmation-title">Order Delivered Successfully</h3>
                            <p class="confirmation-message">Thank you for your business! Your order has been successfully delivered.</p>
                            <div class="confirmation-buttons">
                                <button class="confirm-button" onclick="updateOrderStatus('<?php echo $order_id; ?>', 'confirm')"><b>Confirm Delivery</b></button>
                                <button class="details-button" onclick="updateOrderStatus('<?php echo $order_id; ?>', 'not_delivered')"><b>Return Delivery</b></button>
                            </div>
                        </div>

                        <script>
                        function updateOrderStatus(orderId, action) {
                            fetch('update_order_confirmation.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    order_id: orderId,
                                    action: action
                                })
                            }).then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Order status updated successfully.');
                                } else {
                                    alert('Error: ' + data.error);
                                }
                            }).catch(error => console.error('Error:', error));
                        }
                        </script>
                        <?php
                    }

                    // Close the statement and connection
                    $stmt->close();
                    $conn->close();
                    ?>

            </div>





            <div id="main-orders" class="main-content" style="display: none;">
                <div class="order-card">
                    <div class="order-card-header">
                        <h3>Order Details</h3>
                        <!-- <button class="view-details-btn" onclick="showPopup()">View Orders</button> -->
                    </div>
                    <table class="order-details-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Order Price</th>
                                <th>Delivery Fee</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>123456</td>
                                <td>Jane Doe</td>
                                <td>123 Main St, Apt 4B, Springfield, IL 62701</td>
                                <td>$65.00</td>
                                <td>$5.00</td>
                                <td><button onclick="showOrderDetails('order1')">View Details</button></td>
                            </tr>
                            <tr>
                                <td>789012</td>
                                <td>John Smith</td>
                                <td>456 Oak St, Springfield, IL 62701</td>
                                <td>$80.00</td>
                                <td>$7.00</td>
                                <td><button onclick="showOrderDetails('order2')">View Details</button></td>
                            </tr>
                            <tr>
                                <td>123456</td>
                                <td>Jane Doe</td>
                                <td>123 Main St, Apt 4B, Springfield, IL 62701</td>
                                <td>$65.00</td>
                                <td>$5.00</td>
                                <td><button onclick="showOrderDetails('order1')">View Details</button></td>
                            </tr>
                            <tr>
                                <td>789012</td>
                                <td>John Smith</td>
                                <td>456 Oak St, Springfield, IL 62701</td>
                                <td>$80.00</td>
                                <td>$7.00</td>
                                <td><button onclick="showOrderDetails('order2')">View Details</button></td>
                            </tr>
                            <!-- Add more orders as needed -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Popup Modal for Orders List -->
                <div id="popup" class="popup">
                    <div class="popup-content">
                        <span class="close-btn" onclick="closePopup()">&times;</span>
                        <h4>All Orders</h4>
                        <p>Select an order to view details.</p>
                    </div>
                </div>
                
                <!-- Detailed Order Modal -->
                <div id="order-details-popup" class="popup">
                    <div class="popup-content">
                        <span class="close-btn" onclick="closeOrderDetails()">&times;</span>
                        <h4 id="order-title">Order Details</h4>
                        <p id="order-description">Details will be displayed here...</p>
                    </div>
                </div>
                

            </div>
            











            <div id="main-income" class="main-content" style="display: none;">
                <!-- Monthly Income Chart and Descriptive Section -->
                <div class="income-section">
                    <!-- Monthly Income Chart -->
                    <div class="chart-container">
                        <h2>Latest Orders Income Chart</h2>
                        <canvas id="incomeChart"></canvas> <!-- Chart.js canvas element -->
                    </div>

                    <!-- Descriptive Section for Calculating All Order Delivery Income -->
                    <!-- <div class="income-details">
                        <h3>Total Delivery Income</h3>
                        <p id="totalIncome">0.00</p> Display total income here -->
                        <!-- <button onclick="calculateTotalIncome()">Calculate Total Income</button>
                    </div> -->


                    <?php
                    // Include the database connection
                    require 'config.php';

                    // Ensure the session is started
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Fetch the total delivery income from the orders table
                    $sql = "SELECT SUM(order_deliveryCharge) AS totalIncome FROM orders";
                    $result = $conn->query($sql);

                    $totalIncome = 0;
                    if ($result) {
                        $row = $result->fetch_assoc();
                        $totalIncome = $row['totalIncome'];
                    }

                    // Close the connection
                    $conn->close();
                    ?>

                    <!-- Descriptive Section for Calculating All Order Delivery Income -->
                    <div class="income-details">
                        <h3>Total Delivery Income</h3>
                        <p id="totalIncome">Rs.<?php echo number_format($totalIncome, 2); ?></p> <!-- Display total income here -->
                        <button>Request Payment</button>
                    </div>


                </div>
            </div>











            <div id="main-setting" class="main-content" style="display: none;">

            <?php
            // Include the database connection
            require 'config.php';

            // Ensure the session is started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Check if deliver_name is set in the session
            if (!isset($_SESSION['deliver_name'])) {
                echo "<p>Deliver name not set in session.</p>";
                exit();
            }

            // Fetch profile information from the delivers table
            $deliver_name = $_SESSION['deliver_name'];
            $sql = "SELECT deliver_photo, deliver_name, deliver_email, deliver_vehicle FROM delivers WHERE deliver_name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $deliver_name);
            $stmt->execute();
            $result = $stmt->get_result();
            $deliver = $result->fetch_assoc();

            // Check if profile information is retrieved
            if ($deliver) {
                $profile_pic = htmlspecialchars($deliver['deliver_photo']);
                $profile_name = htmlspecialchars($deliver['deliver_name']);
                $profile_email = htmlspecialchars($deliver['deliver_email']);
                $profile_vehicle = htmlspecialchars($deliver['deliver_vehicle']);
            } else {
                $profile_pic = 'assets/img/default-profile-pic.jpg'; // Default image if not found
                $profile_name = 'Not Available';
                $profile_email = 'Not Available';
                $profile_vehicle = 'Not Available';
            }

            // Close the connection
            $stmt->close();
            $conn->close();
            ?>

            <!-- User Profile Section -->
            <div class="profile-container">
                <div class="profile-header">
                    <img src="pro_pic/<?php echo $profile_pic; ?>" alt="Profile Picture" class="profile-pic">
                    <div class="profile-info">
                        <h2 class="profile-name"><?php echo $profile_name; ?></h2>
                        <p class="profile-email"><?php echo $profile_email; ?></p>
                        <p class="profile-vehicle"><?php echo 'Vehicle: ' . $profile_vehicle; ?></p>
                    </div>
                </div>
                <div class="profile-actions">
                    <button class="btn-update-profile">Update Profile</button>
                    <button class="btn-change-password">Change Password</button>
                    <button class="btn-delete-account">Delete Account</button>
                </div>
            </div>


                <!-- User Profile Section
                <div class="profile-container">
                    <div class="profile-header">
                        <img src="assets/img/profile-pic.jpg" alt="Profile Picture" class="profile-pic">
                        <div class="profile-info">
                            <h2 class="profile-name">John Doe</h2>
                            <p class="profile-email">johndoe@example.com</p>
                            <p class="profile-vehicle">Vehicle: Tesla Model S</p>
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button class="btn-update-profile">Update Profile</button>
                        <button class="btn-change-password">Change Password</button>
                        <button class="btn-delete-account">Delete Account</button>
                    </div>
                </div> -->
        
                <!-- Update Profile Modal -->
                <!-- <div id="update-profile-modal" class="modal hidden" style="z-index: 1000;">
                    <div class="modal-content">
                        <h3>Update Profile</h3>
                        <form id="update-profile-form" method="post" enctype="multipart/form-data"> -->
                            <!-- <label for="profile-pic">Profile Picture URL</label>
                            <input type="text" id="profile-pic" name="profile-pic" placeholder="Image URL"> -->
                            <!-- <label for="profile-pic">Profile Picture</label>
                            <input type="file" id="profile-pic" name="profile-pic" accept="image/*">
        
                            <label for="profile-name">Name</label>
                            <input type="text" id="profile-name" name="profile-name" required>
        
                            <label for="profile-email">Email</label>
                            <input type="email" id="profile-email" name="profile-email" required>
        
                            <label for="profile-vehicle">Vehicle</label>
                            <input type="text" id="profile-vehicle" name="profile-vehicle" required>
        
                            <button type="submit" class="btn-submit">Update</button>
                            <button type="button" class="btn-close">Close</button>
                        </form>
                    </div>
                </div> -->


                <!-- Update Profile Modal -->
                <div id="update-profile-modal" class="modal hidden" style="z-index: 1000;">
                    <div class="modal-content">
                        <h3>Update Profile</h3>
                        <form id="update-profile-form" action="update_profile.php" method="post" enctype="multipart/form-data">
                            <label for="profile-pic">Profile Picture</label>
                            <input type="file" id="profile-pic" name="profile-pic" accept="image/*">
                    
                            <label for="profile-name">Name</label>
                            <input type="text" id="profile-name" name="profile-name" required>
                    
                            <label for="profile-email">Email</label>
                            <input type="email" id="profile-email" name="profile-email" required>
                    
                            <label for="profile-vehicle">Vehicle</label>
                            <input type="text" id="profile-vehicle" name="profile-vehicle" required>
                    
                            <button type="submit" class="btn-submit">Update</button>
                            <button type="button" class="btn-close" onclick="closeModal()">Close</button>
                        </form>
                    </div>
                </div>

                <script>
                function closeModal() {
                    document.getElementById('update-profile-modal').classList.add('hidden');
                }

                document.getElementById('update-profile-form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);
                    
                    fetch('update_profile.php', {
                        method: 'POST',
                        body: formData
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Profile updated successfully.');
                            closeModal();
                        } else {
                            alert('Error: ' + data.error);
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                    });
                });
                </script>

        
                <!-- Change Password Modal
                <div id="change-password-modal" class="modal hidden" style="z-index: 1000;">
                    <div class="modal-content">
                        <h3>Change Password</h3>
                        <form id="change-password-form">
                            <label for="current-password">Current Password</label>
                            <input type="password" id="current-password" name="current-password" required>
        
                            <label for="new-password">New Password</label>
                            <input type="password" id="new-password" name="new-password" required>
        
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" id="confirm-password" name="confirm-password" required>
        
                            <button type="submit" class="btn-submit">Submit</button>
                            <button type="button" class="btn-close">Close</button>
                        </form>
                    </div>
                </div> -->


                <!-- Change Password Modal -->
                <div id="change-password-modal" class="modal hidden" style="z-index: 1000;">
                    <div class="modal-content">
                        <h3>Change Password</h3>
                        <form id="change-password-form" action="update_password.php" method="post">
                            <label for="current-password">Current Password</label>
                            <input type="password" id="current-password" name="current-password" required>

                            <label for="new-password">New Password</label>
                            <input type="password" id="new-password" name="new-password" required>

                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" id="confirm-password" name="confirm-password" required>

                            <button type="submit" class="btn-submit">Submit</button>
                            <button type="button" class="btn-close" onclick="closeModal()">Close</button>
                        </form>
                    </div>
                </div>

                <script>
                    document.getElementById('change-password-form').addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent the form from submitting normally

                    const formData = new FormData(this);

                    fetch('update_password.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert('Error: ' + data.error);
                        } else if (data.success) {
                            alert(data.success);
                            document.getElementById('change-password-modal').classList.add('hidden'); // Hide the modal
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
                </script>
  



        
                <!-- Delete Account Modal -->
                <div id="delete-account-modal" class="modal hidden"style="z-index: 1000;">
                    <div class="modal-content">
                        <h3 style=" margin-bottom: 20px;">Delete Account</h3>
                        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                        <button class="btn-confirm-delete">Delete Account</button>
                        <button class="btn-close">Cancel</button>
                    </div>
                </div>

                <script>
                    document.querySelector('.btn-confirm-delete').addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                        fetch('delete_account.php', {
                            method: 'POST'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                alert('Error: ' + data.error);
                            } else if (data.success) {
                                alert(data.success);
                                window.location.href = 'login.php'; // Redirect to login page or another page
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    }
                    });
                </script>

            </div>
            
         </main>


        <!-- ============ Main JS ============ -->
        <script src="assets/js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const switchInput = document.getElementById('status-switch');
                const switchLabel = document.querySelector('.switch-label');
        
                if (!switchInput || !switchLabel) {
                    console.error('Switch input or label not found');
                    return;
                }
        
                function updateLabel() {
                    switchLabel.textContent = switchInput.checked ? 'Available' : 'Unavailable';
                }
        
                // Initial label update
                updateLabel();
        
                // Update label on switch change
                switchInput.addEventListener('change', updateLabel);
            });







            document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('.sidebar__link');
            const contents = document.querySelectorAll('.main-content');

            function showContent(targetId) {
                contents.forEach(content => {
                    content.style.display = content.id === targetId ? 'block' : 'none';
                });
            }

            links.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault(); // Prevent default link behavior
                    const targetId = link.getAttribute('data-target');
                    showContent(targetId);

                    // Remove active-link class from all links
                    links.forEach(l => l.classList.remove('active-link'));

                    // Add active-link class to clicked link
                    link.classList.add('active-link');
                });
            });
        });







        function showPopup() {
            document.getElementById('popup').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function showOrderDetails(orderId) {
            const orderTitle = document.getElementById('order-title');
            const orderDescription = document.getElementById('order-description');
            
            // Fetch and display the order details based on the orderId
            // For demonstration, using static text. You can fetch from server or use a data structure.
            let orderDetails = {
                'order1': 'Details of Order 1: [Order details here...]',
                'order2': 'Details of Order 2: [Order details here...]',
                // Add more order details as needed
            };

            orderTitle.textContent = `Details for ${orderId}`;
            orderDescription.textContent = orderDetails[orderId] || 'No details available for this order.';

            // Show the detailed order modal
            document.getElementById('order-details-popup').style.display = 'block';
        }

        function closeOrderDetails() {
            document.getElementById('order-details-popup').style.display = 'none';
        }








        // // Function to calculate and display total income
        // function calculateTotalIncome() {
        //     // Example order data
        //     const orders = [
        //         { deliveryFee: 5.00 },
        //         { deliveryFee: 7.00 },
        //         { deliveryFee: 3.50 },
        //         // Add more orders as needed
        //     ];

        //     // Calculate total income
        //     const totalIncome = orders.reduce((total, order) => total + order.deliveryFee, 0);

        //     // Update the total income display
        //     document.getElementById('totalIncome').textContent = `$${totalIncome.toFixed(2)}`;
        // }

        // // Example of chart setup using Chart.js
        // document.addEventListener('DOMContentLoaded', () => {
        //     const ctx = document.getElementById('incomeChart').getContext('2d');
        //     const incomeChart = new Chart(ctx, {
        //         type: 'bar',
        //         data: {
        //             labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        //             datasets: [{
        //                 label: 'Monthly Income',
        //                 data: [1200, 1500, 1700, 1600, 1400, 1800, 1900, 2000, 2200, 2100, 2300, 2500], // Example data
        //                 backgroundColor: 'rgba(47, 94, 0, 0.2)',
        //                 borderColor: 'rgba(47, 94, 0, 1)',
        //                 borderWidth: 1
        //             }]
        //         },
        //         options: {
        //             scales: {
        //                 y: {
        //                     beginAtZero: true
        //                 }
        //             }
        //         }
        //     });
        // });



        document.addEventListener('DOMContentLoaded', () => {
        // Fetch latest 10 delivery charges from the PHP script
        fetch('get_delivery_charges.php')
            .then(response => response.json())
            .then(deliveryCharges => {
                // Create labels for the orders
                const labels = deliveryCharges.map((_, index) => `Order ${index + 1}`);

                // Set up Chart.js
                const ctx = document.getElementById('incomeChart').getContext('2d');
                const incomeChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Delivery Charges',
                            data: deliveryCharges,
                            backgroundColor: 'rgba(47, 94, 0, 0.2)',
                            borderColor: 'rgba(47, 94, 0, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching delivery charges:', error));
    });








        document.addEventListener('DOMContentLoaded', () => {
        const updateProfileButton = document.querySelector('.btn-update-profile');
        const changePasswordButton = document.querySelector('.btn-change-password');
        const deleteAccountButton = document.querySelector('.btn-delete-account');
        const closeButtons = document.querySelectorAll('.btn-close');

        const updateProfileModal = document.getElementById('update-profile-modal');
        const changePasswordModal = document.getElementById('change-password-modal');
        const deleteAccountModal = document.getElementById('delete-account-modal');

        function openModal(modal) {
            modal.classList.remove('hidden');
        }

        function closeModal(modal) {
            modal.classList.add('hidden');
        }

        updateProfileButton.addEventListener('click', () => openModal(updateProfileModal));
        changePasswordButton.addEventListener('click', () => openModal(changePasswordModal));
        deleteAccountButton.addEventListener('click', () => openModal(deleteAccountModal));

        closeButtons.forEach(button => {
            button.addEventListener('click', () => {
                closeModal(updateProfileModal);
                closeModal(changePasswordModal);
                closeModal(deleteAccountModal);
            });
        });

        // Handle form submissions
        const updateProfileForm = document.getElementById('update-profile-form');
        updateProfileForm.addEventListener('submit', (event) => {
            event.preventDefault();
            // Handle profile update logic here
            // Example: Collect form data and send it to server
            const formData = new FormData(updateProfileForm);
            console.log('Profile updated:', Object.fromEntries(formData));
            closeModal(updateProfileModal);
        });

        const changePasswordForm = document.getElementById('change-password-form');
        changePasswordForm.addEventListener('submit', (event) => {
            event.preventDefault();
            // Handle password change logic here
            console.log('Password changed');
            closeModal(changePasswordModal);
        });

        const confirmDeleteButton = document.querySelector('.btn-confirm-delete');
        confirmDeleteButton.addEventListener('click', () => {
            // Handle account deletion logic here
            console.log('Account deleted');
            closeModal(deleteAccountModal);
        });
    });











    document.getElementById('status-switch').addEventListener('change', function() {
        const status = this.checked ? 'available' : 'unavailable';
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_status.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('status=' + encodeURIComponent(status));
    });









    // // Check local storage and set the switch status on page load
    // document.addEventListener('DOMContentLoaded', () => {
    //     const statusSwitch = document.getElementById('status-switch');
        
    //     // Retrieve switch status from local storage
    //     const savedStatus = localStorage.getItem('statusSwitch');
        
    //     if (savedStatus === 'true') {
    //         statusSwitch.checked = true;
    //     } else {
    //         statusSwitch.checked = false;
    //     }
    // });

    // // Save the switch status to local storage when changed
    // document.getElementById('status-switch').addEventListener('change', function() {
    //     const status = this.checked;
        
    //     // Save the status to local storage
    //     localStorage.setItem('statusSwitch', status);
    // });





    // Check local storage and set the switch status and label on page load
    document.addEventListener('DOMContentLoaded', () => {
        const statusSwitch = document.getElementById('status-switch');
        const switchLabel = document.getElementById('status-label');

        // Retrieve switch status and label from local storage
        const savedStatus = localStorage.getItem('statusSwitch');
        const savedLabel = localStorage.getItem('statusLabel');

        if (savedStatus === 'true') {
            statusSwitch.checked = true;
        } else {
            statusSwitch.checked = false;
        }

        // Set the label text based on savedLabel
        if (savedLabel) {
            switchLabel.textContent = savedLabel;
        } else {
            // Default label text if no savedLabel
            switchLabel.textContent = statusSwitch.checked ? 'Available' : 'Unavailable';
        }
    });

    // Save the switch status and label to local storage when changed
    document.getElementById('status-switch').addEventListener('change', function() {
        const status = this.checked;
        const switchLabel = document.getElementById('status-label');

        // Determine the label based on switch status
        const labelText = status ? 'Available' : 'Unavailable';

        // Save the status and label to local storage
        localStorage.setItem('statusSwitch', status);
        localStorage.setItem('statusLabel', labelText);
    });













    document.addEventListener('DOMContentLoaded', () => {
        fetchOrders();

        function fetchOrders() {
            fetch('fetch_orders.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('.order-details-table tbody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    data.forEach(order => {
                        const row = document.createElement('tr');
                        
                        row.innerHTML = `
                            <td>${order.order_id}</td>
                            <td>${order.order_name}</td>
                            <td>${order.full_address}</td>
                            <td>Rs.${order.order_price}</td>
                            <td>Rs.${order.order_deliveryCharge}</td> <!-- Example static delivery fee -->
                            <td>${order.order_status}</td>
                        `;
                        
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching orders:', error);
                });
        }
    });

    // function showOrderDetails(orderId) {
    //     // Implement function to show order details
    //     alert(`Showing details for Order ID: ${orderId}`);
    // }
    





    

        </script>
    </body>
</html>