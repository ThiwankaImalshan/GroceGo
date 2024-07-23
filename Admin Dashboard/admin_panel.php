<?php
    session_start();
    if(!isset($_SESSION['AdminLoginId'])){
        header('location: index.Php');
    }
?>

<?php
    $conn = mysqli_connect("localhost","root","","grocgo");
?>

<?php
require("login_connection.php");

// Start output buffering
ob_start();

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Ensure Admin_Id is set in the session
if (isset($_SESSION['AdminLoginId'])) {
    $adminId = $_SESSION['AdminLoginId'];

    // Fetch admin data from the database
    $stmt = $con->prepare("SELECT Admin_Id, Admin_Photo, Admin_Name, Admin_Password, Admin_Email, Admin_Phone FROM admin_login WHERE Admin_Name = ?");
    $stmt->bind_param("s", $adminId); // Admin_Id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the admin is found
    if ($result->num_rows > 0) {
        // Fetch the admin data
        $adminData = $result->fetch_assoc();
    } else {
        header("Location: index.php#error=AdminNotFound");
        exit;
        // echo "Admin not found.";
        // You can redirect to a login page or show an error message
    }

    $stmt->close();
} else {
    echo "No AdminLoginId found in session.";
    // Redirect to login page or show an error message
}

// Flush the output buffer
ob_flush();

// Handle logout
if(isset($_POST['Logout'])){
    session_destroy();
    header("location: index.php");
    exit; // Make sure to exit after redirection
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- ----------------Styles---------- -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <style>


        /* ---------------------Settings Form------------------ */
        .settingForm .profilePic{
            width: 200px;
            height: 200px;
            border-radius: 150px ;
            position: relative;
            padding: 20px;
            display: grid;
            grid-gap: 30px;
            margin-left: auto;
            margin-right: auto;
        }
        .settingForm input[type=file]::file-selector-button {
            margin-right: 20px;
            border: none;
            background: var(--lightGreen);
            padding: 8px 16px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: .2s ease-in-out;
            margin-top: 8px;
            margin-bottom: 50px;
        }
        .settingForm input[type=file]::file-selector-button:hover {
            background: var(--green);
        }
        .settingForm label{
            color: #4c4441;
        }
        .settingForm input[type=text],input[type=email], input[type=number]{
            border-radius: 8px;
            border: 1px solid var(--black2);
            height: 30px;
            padding-left: 10px;
            margin-top: 8px;
            width: 100%;
        }
        #saveChanges{
            margin-right: 20px;
            border: none;
            background: green;
            padding: 10px 20px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: .2s ease-in-out;
            margin-top: 30px;
        }
        #saveChanges:hover{
            background: var(--lightGreen);
        }
        .accountSet{
            margin-top: 50px;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
        .accountSet1,   .accountSet2{
            background: #eee;
            border-radius: 20px;
            padding: 20px;
            margin: 20px;
        }
        .accountSet1 button{
            background: white;
            color: black;
            border: 1px solid var(--black2);
            border-radius: 8px;
            padding: 5px 10px;
            margin-top: 10px;
            cursor: pointer;
        }
        .accountSet2 button{
            background: white;
            color: red;
            border: 1px solid var(--black2);
            border-radius: 8px;
            padding: 5px 10px;
            margin-top: 10px;
            cursor: pointer;
        }
        .accountSet p{
            margin-top: 10px;
            font-size: 14px;
        }

        /* -------------Password Change Popup------------- */
        .change_popup, .delete_popup, .register_popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px); /* Adds background blur effect */
        }

        .change_popup_content,  .delete_popup_content, .register_popup_content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .change_popup_content{
            width: 500px;
            height: 500px;
        }

        .delete_popup_content{
            width: 250px;
            height: 250px;
        }

        .register_popup_content{
            width: 350px;
            height: 550px;
        }

        .delete_popup_content p{
            margin-top: 30px;
        }

        .register_popup_content h2{
            margin-bottom: 10px;
            font-size: 20px;
            padding-left: 12px;
        }

        .delete_popup_content button{
            margin-top: 40px;
            padding: 8px 16px;
            border-radius: 8px;
            width:100%;
            font-weight: 600;
            font-size: 18px;
            color: white;
            background-color: red;
            border: 1px solid white;
        }

        .delete_popup_content button:hover{
            color: red;
            background-color: pink;
            border: 1px solid red;
            cursor:pointer;
        }

        .change_popup_close, .delete_popup_close, .register_popup_close{
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 30px;
        }

        .change_popup input[type=password]{
            border-radius: 8px;
            border: 1px solid var(--black2);
            height: 30px;
            padding-left: 10px;
            margin-top: 8px;
            width: 100%;
        }

        .register_popup_content button{
            font-weight: 500;
            font-size: 15px;
            color: white;
        }

        .register_popup input[type=text], input[type=password]{
            border-radius: 8px;
            border: 1px solid var(--black2);
            height: 30px;
            padding-left: 10px;
            margin-top: 8px;
            width: 100%;
        }

        .change_popup form{
            margin-top: 50px;
        }

        .change_popup button{
            margin-top: 100px;
            padding: 8px 16px;
            border-radius: 8px;
            width:100%;
            font-weight: 600;
            font-size: 18px;
            color: white;
            background-color: green;
            border: 1px solid white;
        }

        .change_popup button:hover{
            color: green;
            background-color: white;
            border: 1px solid green;
            cursor:pointer;
        }




        .register_new_admin_clickable{
            color:green;
            cursor: pointer;
        }
        .register_new_admin{
            font-size:15px;
        }
        .register_new_admin{
            font-weight:500;
        }
        #form_admin_register{
            transform: scale(0.9);
        }
        #form_admin_register input[type=file]::file-selector-button {
            margin-right: 20px;
            border: none;
            background: var(--lightGreen);
            padding: 8px 16px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: .2s ease-in-out;
            margin-top: 8px;
        }
        
        #form_admin_register input[type=file]::file-selector-button:hover {
            background: var(--green);
        }

        /* ------adminPanel_topic----- */
        .adminPanel_topic h2{
            font-size:20px;
            color: white;
            background-color:green;
            border: 1px solid green;
            border-radius: 20px;
            padding: 5px 40px;
        }

    </style>
</head>
<body>
    <!-- -------------Navigation--------- -->

    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">G</span>
                        <span class="title">GrocGo</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleVisibility('div1')">
                        <span class="icon"><ion-icon name="home"></ion-icon></span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleVisibility('div2')">
                        <span class="icon"><ion-icon name="cart"></ion-icon></span>
                        <span class="title">Products</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleVisibility('div3')">
                        <span class="icon"><ion-icon name="bag-handle"></ion-icon></span>
                        <span class="title">Orders</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleVisibility('div4')">
                        <span class="icon"><ion-icon name="people"></ion-icon></span>
                        <span class="title">Customers</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleVisibility('div5')">
                        <span class="icon"><ion-icon name="bicycle"></ion-icon></span>
                        <span class="title">Delivers</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleVisibility('div6')">
                        <span class="icon"><ion-icon name="settings"></ion-icon></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ------------------Main-------------- -->
        <div class="main">
            <div class="topbar" style="background-color:#f8f8f8;">
                <div class="toggle">
                    <ion-icon name="menu"></ion-icon>
                </div>

                <!-- <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search"></ion-icon>
                    </label>
                </div> -->

                <!-- <div class="adminPanel_topic">
                    <h2>GrocGo - <small>Admin Panel</small></h2>
                </div> -->

                <div class="user" id="userIcon">
                    <img src="assets/imgs/<?php echo htmlspecialchars($adminData['Admin_Photo']); ?>" alt="user">
                </div>

                <!-- Sign-out popup -->
                <!-- <div class="signout-popup" id="signoutPopup">
                    <h3>Admin Panel</h3>
                    -- <img src="assets/imgs/Person3.jpg" alt="user" id="signImage"> --
                    <img src="assets/imgs/<?php echo $_SESSION['AdminLoginId']?>" alt="user" id="signImage">
                    <p>Welcome, <?php echo $_SESSION['AdminLoginId']?>!</p>
                    <ul>
                        <li><a href="#" onclick="toggleVisibility('div6'),closeSignoutPopup()">Settings</a></li>
                    </ul>
                    <form action="" method="POST">
                    <button class="signOutBtn" name="Logout" onclick="signOut(),closeSignoutPopup()">Sign Out</button>
                    <button class="closeBtn" onclick="closeSignoutPopup()">Cancel</button>
                    </form>
                </div> -->

                <div class="signout-popup" id="signoutPopup">
                    
                    <h3>Admin Panel</h3>
                    <!-- <img src="assets/imgs/Person3.jpg" alt="user" id="signImage"> -->

                        <img src="assets/imgs/<?php echo htmlspecialchars($adminData['Admin_Photo']); ?>" alt="user" id="signImage">
                        <p>Welcome, <?php echo htmlspecialchars($adminData['Admin_Name']); ?>!</p>
                   
                    <ul>
                        <li><a href="#" onclick="toggleVisibility('div6'),closeSignoutPopup()">Settings</a></li>
                    </ul>

                    <form action="" method="POST">
                    <button class="signOutBtn" name="Logout" onclick="signOut(),closeSignoutPopup()">Sign Out</button>
                    <button class="closeBtn" onclick="closeSignoutPopup()">Cancel</button>
                    </form>

                </div>

            </div>

            <!-- <?php
                if(isset($_POST['Logout'])){
                    session_destroy();
                    header("location: index.php");
                }
            ?> -->

            <div class="home-contents" id="div1">

                    <!-- ------------------Cards-------------- -->

                    <div class="cardBox">
                        <?php
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            // Query to get the count of products
                            $sql = "SELECT COUNT(*) AS product_count FROM category";
                            $result = mysqli_query($conn, $sql);

                            // Check if the query was successful
                            if ($result) {
                                // Fetch the product count
                                $row = mysqli_fetch_assoc($result);
                                $product_count = $row['product_count'];
                            } else {
                                // Error handling if the query fails
                                $product_count = "Error fetching product count";
                            }

                        ?>

                        <div class="card">
                            <div>
                                <div class="numbers"><?php echo $product_count; ?></div>
                                <div class="cardName">Products</div>
                            </div>

                            <div class="iconBx">
                                <ion-icon name="cube"></ion-icon>
                            </div>
                        </div>



                        <?php
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            // Query to get the count of products
                            $sql = "SELECT COUNT(*) AS order_count FROM orders";
                            $result = mysqli_query($conn, $sql);

                            // Check if the query was successful
                            if ($result) {
                                // Fetch the product count
                                $row = mysqli_fetch_assoc($result);
                                $order_count = $row['order_count'];
                            } else {
                                // Error handling if the query fails
                                $order_count = "Error fetching order count";
                            }

                        ?>

                        <div class="card">
                            <div>
                                <div class="numbers"><?php echo $order_count; ?></div>
                                <div class="cardName">Orders</div>
                            </div>

                            <div class="iconBx">
                                <ion-icon name="cart"></ion-icon>
                            </div>
                        </div>



                        <?php
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            // Query to get the count of products
                            $sql = "SELECT COUNT(*) AS customer_count FROM customers";
                            $result = mysqli_query($conn, $sql);

                            // Check if the query was successful
                            if ($result) {
                                // Fetch the product count
                                $row = mysqli_fetch_assoc($result);
                                $customer_count = $row['customer_count'];
                            } else {
                                // Error handling if the query fails
                                $customer_count = "Error fetching customer count";
                            }

                        ?>

                    <?php
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Query to get the count of products
                        $sql = "SELECT COUNT(*) AS delivery_count FROM delivers";
                        $result = mysqli_query($conn, $sql);

                        // Check if the query was successful
                        if ($result) {
                            // Fetch the product count
                            $row = mysqli_fetch_assoc($result);
                            $delivery_count = $row['delivery_count'];
                        } else {
                            // Error handling if the query fails
                            $delivery_count = "Error fetching delivery count";
                        }

                    ?>

                        <div class="card">
                            <div>
                                <div class="numbers"><?php echo $delivery_count; ?></div>
                                <div class="cardName">Delivers</div>
                            </div>

                            <div class="iconBx">
                                <ion-icon name="bicycle"></ion-icon>
                            </div>
                        </div>

                        <div class="card">
                            <div>
                                <div class="numbers"><?php echo $customer_count; ?></div>
                                <div class="cardName">Customers</div>
                            </div>

                            <div class="iconBx">
                                <ion-icon name="people"></ion-icon>
                            </div>
                        </div>

                    </div>

                    <!-- -------------------Add Charts JS--------------- -->
                    <!-- <div class="chartsBx">
                        <div class="chart">  <canvas id="chart-1"></canvas></div>
                        <div class="chart">  <canvas id="chart-2"></canvas></div>
                    </div> -->

                    <!-- -------------------Order Details List--------------- -->
                    <div class="details">
                        <div class="recentOrders">
                            <div class="cardHeader">
                                <h2>Recent Orders</h2>
                                <a href="#" onclick="toggleVisibility('div3')" class="btn">View All</a>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Price</td>
                                        <td>Payment</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                    $i = 1;
                                    $rows = mysqli_query($conn,"SELECT * FROM orders ORDER BY order_id DESC");
                                    $count = 0; // Counter variable to track the number of records displayed

                                    while ($row = mysqli_fetch_assoc($rows)) {
                                        // Display only the latest 3 records
                                        if ($count >= 10) {
                                            break;
                                        }

                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['order_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['order_price']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['order_payment']) . "</td>";

                                        // Determine the class name based on the order status
                                        $statusClass = '';
                                        switch ($row['order_status']) {
                                            case 'Delivered':
                                                $statusClass = 'status delivered';
                                                break;
                                            case 'Pending':
                                                $statusClass = 'status pending';
                                                break;
                                            case 'Return':
                                                $statusClass = 'status return';
                                                break;
                                            case 'In Progress':
                                                $statusClass = 'status inProgress';
                                                break;
                                            default:
                                                $statusClass = 'status';
                                        }

                                        // Output the status with the appropriate class
                                        echo "<td><span class='" . $statusClass . "'>" . htmlspecialchars($row['order_status']) . "</span></td>";
                                        echo "</tr>";

                                        $count++; // Increment the counter
                                    }
                                    ?>

                                </tbody>

                            </table>

                        </div>

                        <!-- -------------------New Customers--------------- -->
                        <div class="recentCustomers">
                            <div class="cardHeader">
                                <h2>Recent Customers</h2>
                            </div>

                            <table>

                            <?php
                                $i = 1;
                                $rows = mysqli_query($conn,"SELECT * FROM customers ORDER BY customer_id DESC");
                                $count = 0; // Counter variable to track the number of records displayed

                                while ($row = mysqli_fetch_assoc($rows)) {
                                    // Display only the latest 10 records
                                    if ($count >= 10) {
                                        break;
                                    }

                                    $customer_photo = htmlspecialchars($row['customer_photo']);
                                    // Check if customer photo is set and not empty
                                    if (empty($customer_photo)) {
                                        $customer_photo = 'Customer.png';
                                    } else {
                                        // Check if the image file exists
                                        $image_path = 'assets/imgs/' . $customer_photo;
                                        if (!file_exists($image_path)) {
                                            $customer_photo = 'Customer.png';
                                        }
                                    }

                                    echo "<tr>";
                                    echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/" . $customer_photo . "' alt='Customer Image'></div></td>";
                                    echo "<td><h4>" . htmlspecialchars($row['customer_name']) . " <br><span>" . htmlspecialchars($row['customer_from']) . "</span></h4></td>";
                                    echo "</tr>";
                                    $count++; // Increment the counter
                                }
                            ?>


                            </table>
                        </div>
                    </div>

            </div>

            <div class="product-contents" id="div2" style="display: none;">
                <div class="details2">
                        <div class="allProducts">
                            <div class="cardHeader">
                                <h2>All Products</h2>
                                <a href="#" class="btn" onclick="toggleVisibility('div7')">Add Product</a>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <td>Product</td>
                                        <td>Product Name</td>
                                        <td>Price</td>
                                        <td>Availability</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1;
                                    $rows = mysqli_query($conn," SELECT * FROM category ORDER BY products_id DESC");
                                    ?>

                                    <?php
                                    while ($row = mysqli_fetch_assoc($rows)) {
                                        echo "<tr>";
                                        echo "<td><img src='" . htmlspecialchars($row['products_image']) . "' alt='' width='50px' height='50px'></td>";
                                        echo "<td>" . htmlspecialchars($row['products_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['products_price']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['products_availability']) . "</td>";
                                        echo "<td>
                                                <a href='#' class='btn-update' onclick=\"toggleVisibility('div8'); showEditForm(
                                                    " . $row['products_id'] . ",
                                                    '" . htmlspecialchars($row['products_name']) . "'
                                                )\">Update</a>
                                                <a href='delete.php?product_id=" . urlencode($row['products_id']) . "' class='btn-delete'>Delete</a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>

                            </table>

                        </div>

                    </div>
            </div>

            <div class="order-contents" id="div3" style="display: none;">
                <div class="details2">
                    <div class="allProducts">
                        <div class="cardHeader">
                            <h2>Orders</h2>
                            <!-- <a href="#" class="btn">View All</a> -->
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Price</td>
                                    <td>Payment</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                    $i = 1;
                                    $rows = mysqli_query($conn," SELECT * FROM orders ORDER BY order_id DESC");
                                    ?>

                                    <?php
                                    while ($row = mysqli_fetch_assoc($rows)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['order_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['order_price']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['order_payment']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['order_status']) . "</td>";
                                        echo "<td>
                                                <a href='#' class='btn-update' onclick=\"toggleVisibility('div9'); showEditOrder(" . $row['order_id'] . ",
                                                '" . htmlspecialchars($row['order_name']) . "')\">Update</a>
                                                <a href='order_delete.php?order_id=" . urlencode($row['order_id']) . "' class='btn-delete'>Delete</a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                    ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="customer-contents" id="div4" style="display: none;">
                <div class="details2">
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Customers</h2>
                        </div>

                        <table>
                            <?php
                                $i = 1;
                                $rows = mysqli_query($conn," SELECT * FROM customers ORDER BY customer_id DESC");
                            ?>

                            <?php
                                while ($row = mysqli_fetch_assoc($rows)) {
                                    $customer_photo = htmlspecialchars($row['customer_photo']);
                                    // Check if customer photo is set and not empty
                                    if (empty($customer_photo)) {
                                        $customer_photo = 'Customer.png';
                                    } else {
                                        // Check if the image file exists
                                        $image_path = 'assets/imgs/' . $customer_photo;
                                        if (!file_exists($image_path)) {
                                            $customer_photo = 'Customer.png';
                                        }
                                    }

                                    echo "<tr>";
                                    echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/" . $customer_photo . "' alt='Customer Image'></div></td>";
                                    echo "<td><h4>" . htmlspecialchars($row['customer_name']) . " <br><span>" . htmlspecialchars($row['customer_from']) . "</span></h4></td>";
                                    echo "</tr>";
                                }
                            ?>


                        </table>
                    </div>
                </div>
            </div>

            <div class="delivery-contents" id="div5" style="display: none;">
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Deliver Details</h2>
                            <!-- <a href="#" class="btn">View All</a> -->
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Contact</td>
                                    <td>Status</td>
                                    <td>Order</td>
                                </tr>
                            </thead>

                            <tbody>
                                    <?php
                                        $i = 1;
                                        $rows = mysqli_query($conn, "SELECT * FROM delivers ORDER BY deliver_id DESC");
                                    ?>

                                    <?php
                                         while ($row = mysqli_fetch_assoc($rows)) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['deliver_name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['delivery_contact']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['deliver_status']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                                            echo "</tr>";
                                        }

                                    ?>





                                    <!-- <?php
                                        // $i = 1;
                                        // $rows = mysqli_query($conn, "SELECT * FROM delivery_details ORDER BY delivery_id DESC");
                                    ?> -->
                                    
                                    <!-- <?php
                                    // while ($row = mysqli_fetch_assoc($rows)) {
                                    //     echo "<tr>";
                                    //     echo "<td>" . htmlspecialchars($row['delivery_name']) . "</td>";
                                    //     echo "<td>Rs. " . htmlspecialchars($row['delivery_price']) . "</td>";
                                    //     echo "<td>" . htmlspecialchars($row['delivery_payment']) . "</td>";
                                    //     echo "<td>";
                                    
                                    //     // Determine the class name based on the order status
                                    //     $statusClass = '';
                                    //     switch ($row['delivery_status']) {
                                    //         case 'Delivered':
                                    //             $statusClass = 'status delivered';
                                    //             break;
                                    //         case 'Pending':
                                    //             $statusClass = 'status pending';
                                    //             break;
                                    //         case 'Return':
                                    //             $statusClass = 'status return';
                                    //             break;
                                    //         case 'In Progress':
                                    //             $statusClass = 'status inProgress';
                                    //             break;
                                    //         default:
                                    //             $statusClass = 'status';
                                    //     }
                                    
                                    //     // Output the status with the appropriate class
                                    //     echo "<span class='" . $statusClass . "'>" . htmlspecialchars($row['delivery_status']) . "</span>";
                                    
                                    //     echo "</td>";
                                    //     echo "</tr>";
                                    //}
                                    ?> -->

                                
                            </tbody>

                        </table>

                    </div>

                    <!-- -------------------New Delivers--------------- -->
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Delivers</h2>
                        </div>

                        <table>
                            <?php
                                $i = 1;
                                $rows = mysqli_query($conn," SELECT * FROM delivers ORDER BY deliver_id DESC");
                            ?>

                            <?php
                                while ($row = mysqli_fetch_assoc($rows)) {
                                    echo "<tr>";
                                    echo "<td width='60px'><div class='imgBx'><img src='assets/imgs/" . htmlspecialchars($row['deliver_photo']) . "' alt=''></div></td>";
                                    echo "<td><h4>" . htmlspecialchars($row['deliver_name']) . " <br><span>" . htmlspecialchars($row['deliver_from']) . "</span></h4></td>";
                                    echo "</tr>";
                                }
                            ?>

                            
                        </table>
                    </div>
                </div>
            </div>

            <div class="setting-contents" id="div6" style="display: none;">
                <div class="details3">
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Settings</h2>
                        </div>

                        <div class="settingForm">
                            <img src="assets/imgs/<?php echo htmlspecialchars($adminData['Admin_Photo']); ?>" alt="" srcset="" class="profilePic">

                            <form action="update_admin.php" method="post" enctype="multipart/form-data">
                                <center><input type="file" name="admin_photo" id=""><br><br></center>

                                <label for="admin_name">Name:</label><br>
                                <input type="text" name="admin_name" id="admin_name" value="<?php echo htmlspecialchars($adminData['Admin_Name']); ?>" placeholder="Name..."><br><br>

                                <label for="admin_email">Email:</label><br>
                                <input type="email" name="admin_email" id="admin_email" value="<?php echo htmlspecialchars($adminData['Admin_Email']); ?>" placeholder="Email..."><br><br>

                                <label for="admin_phone">Phone:</label><br>
                                <input type="number" name="admin_phone" id="admin_phone" value="<?php echo htmlspecialchars($adminData['Admin_Phone']); ?>" placeholder="Phone No..."><br><br>

                                <center><button type="submit" id="saveChanges">Save Changes</button></center>
                            </form>


                            <div class="accountSet">
                                <div class="accountSet1">
                                    <h4>Password</h4>
                                    <p>You can change your password by clicking here...</p>
                                    <button type="" id="change_openPopupBtn">Change</button>
                                </div>
                                <div class="accountSet2">
                                    <h4>Delete</h4>
                                    <p>You can delete your account by clicking here...</p>
                                    <button type="" id="delete_openPopupBtn">Delete</button>
                                </div>
                            </div>
                            <center><span class="register_new_admin">Register New Admin: <span id="register_new_admin_switchToSignUp" class="register_new_admin_clickable"><b>Click here</b></span></span></center>
                        </div>
                    </div>
                </div>
            </div>


            <div id="register_popup" class="register_popup">
                <div class="register_popup_content">
                    <span id="register_closePopupBtn" class="register_popup_close">&times;</span>
                    <h2>Register New Admin</h2>
                    <form action="register_admin.php" method="post" id="form_admin_register" enctype="multipart/form-data">
                    
                    <label for="admin_name">Name:</label><br>
                    <input type="text" name="admin_name" id="admin_name" value="" placeholder="Name..."><br><br>

                    <label for="admin_email">Email:</label><br>
                    <input type="email" name="admin_email" id="admin_email" value="" placeholder="Email..."><br><br>

                    <label for="admin_phone">Phone:</label><br>
                    <input type="number" name="admin_phone" id="admin_phone" value="" placeholder="Phone No..."><br><br>

                    <input type="file" name="admin_photo" id="admin_photo"><br><br>

                    <label for="newPassword">Password:</label><br>
                    <input type="password" name="newPassword" placeholder="New Password" required><br><br>

                    <label for="confirmPassword">Confirm Password:</label><br>
                    <input type="password" name="confirmPassword" placeholder="Confirm New Password" required>

                    <center><button type="submit" id="saveChanges">Save Changes</button></center>
                    </form>
                </div>
            </div>            

            <div id="change_popup" class="change_popup">
                <div class="change_popup_content">
                    <span id="change_closePopupBtn" class="change_popup_close">&times;</span>
                    <h2>Change Password</h2>
                    <form action="update_password.php" method="post">
                        <label for="email">Your Email:</label><br>
                        <input type="email" name="email" placeholder="Email" required><br><br>

                        <label for="newPassword">Password:</label><br>
                        <input type="password" name="newPassword" placeholder="New Password" required><br><br>

                        <label for="confirmPassword">Confirm Password:</label><br>
                        <input type="password" name="confirmPassword" placeholder="Confirm New Password" required>

                        <button type="submit" name="submit">Save Changes</button>
                    </form>
                </div>
            </div>



            <div id="delete_popup" class="delete_popup" style="display: none;">
                <div class="delete_popup_content">
                    <span id="delete_closePopupBtn" class="delete_popup_close">&times;</span>
                    <h2>Warning!</h2>
                    <p>Are you sure you want to delete your account?</p>
                    <form action="admin_delete.php" method="post" >
                    <input type="hidden" name="adminName" value="<?php echo htmlspecialchars($adminData['Admin_Name']); ?>">
                        <button type="submit" name="deleteAdmin" id="confirmDeleteBtn">Yes, Delete</button>
                    </form>
                </div>
            </div>


            <div class="addProduct-contents" id="div7" style="display: none;">
                <div class="details3">
                        <div class="addProducts">
                            <div class="cardHeader">
                                <h2>Add New Product</h2>
                                <!-- <a href="#" class="btn">Add Product</a> -->
                            </div>

                            <div class="addProductsForm">
                                <form action="add_product.php" method="post" enctype="multipart/form-data">
                                    <label for="name">Product Name:</label><br>
                                    <input type="text" name="name" id="name" placeholder="Item Name..." required><br><br>
    
                                    <label for="description">Description:</label><br>
                                    <textarea id="description" name="description" rows="4" cols="50" placeholder="Write Description Here..." required></textarea><br><br>
    
                                    <label for="price">Price:</label><br>
                                    <input type="number" step="0.01" name="price" id="price" placeholder="Item Price..." required><br><br>
    
                                    <label for="image">Image:</label><br>
                                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png"><br><br>
    
                                    <!-- <label for="Cat">Category:</label><br>
                                    <select name="Cat" id="Cat">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                    </select><br><br>
    
                                    <label for="SubCat">Sub Category:</label><br>
                                    <select name="SubCat" id="SubCat">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                    </select><br><br> -->
    
                                    <label for="availability">Availability:</label><br>
                                    <select name="availability" id="availability">
                                        <option value="in stock">In Stock</option>
                                        <option value="out of stock">Out of Stock</option>
                                    </select><br><br>
    
                                    <center><input type="submit" value="Submit Product"></center>
                                </form>
                            </div>
 
                        </div>

                    </div>
            </div>


            <div class="addProduct-contents" id="div8" style="display: none;">
                <div class="details3">
                    <div class="addProducts">
                        <div class="cardHeader">
                            <h2>Edit Product</h2>
                        </div>

                        <div class="addProductsForm">
                            <form action="update.php" method="POST" enctype="multipart/form-data">
                                <label for="product_id">Product Id:</label><br>
                                <input type="text" name="product_id" id="product_id" value="<?php echo $product['product_id']; ?>" readonly><br><br>
                                
                                <label for="name">Product Name:</label><br>
                                <input type="text" name="name" id="product_name" value="" required><br><br>

                                <label for="description">Description:</label><br>
                                <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

                                <label for="price">Price:</label><br>
                                <input type="number" step="0.01" name="price" id="price" value="" required><br><br>

                                <label for="image">Image:</label><br>
                                <input type="file" name="image" id="image" accept="image/*"><br><br>
                                <!-- <img id="product_image" src="img/" alt="Product Image" width="100"><br><br> -->

                                <label for="availability">Availability:</label><br>
                                <select name="availability" id="product_availability">
                                    <option value="in stock" >In Stock</option>
                                    <option value="out of stock" >Out of Stock</option>
                                </select><br><br>

                                <center><input type="submit" value="Update Product"></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <div class="addProduct-contents" id="div9" style="display: none;">
                <div class="details3">
                        <div class="addProducts">
                            <div class="cardHeader">
                                <h2>Edit Order</h2>
                                <!-- <a href="#" class="btn">Add Product</a> -->
                            </div>

                            <div class="addProductsForm">
                                <form action="update_order.php" method="POST" enctype="multipart/form-data">
                                    <label for="order_id">Order Id:</label><br>
                                    <input type="text" name="order_id" id="order_id" value="" readonly><br><br>
                                    
                                    <label for="order_name">Order Name:</label><br>
                                    <input type="text" name="order_name" id="order_name" value="" required><br><br>

                                    <label for="order_price">Price:</label><br>
                                    <input type="number" step="0.01" name="order_price" id="order_price" value="" required><br><br>

                                    <label for="order_payment">Payment:</label><br>
                                    <select name="order_payment" id="order_payment">
                                        <option value="Paid" >Paid</option>
                                        <option value="Due">Due</option>
                                    </select><br><br>

                                    <label for="status">Status:</label><br>
                                    <select name="order_status" id="order_status">
                                        <option value="Delivered" >Delivered</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Return" >Return</option>
                                        <option value="In Progress">In Progress</option>
                                    </select><br><br>
    
                                    <center><input type="submit" value="Update Order"></center>
                                </form>
                            </div>
 
                        </div>

                    </div>
            </div>




        </div>

    </div>


    <script>
    function showEditForm(productId,productName) {
        // Set the product_id value in the hidden input field
        document.getElementById('product_id').value = productId;
        document.getElementById('product_name').value = productName;

        // Add any other code you need for showing the edit form
    }

    function showEditOrder(orderId,orderName) {
        // Set the product_id value in the hidden input field
        document.getElementById('order_id').value = orderId;
        document.getElementById('order_name').value = orderName;

        // Add any other code you need for showing the edit form
    }

    
    document.getElementById("change_openPopupBtn").addEventListener("click", function() {
        document.getElementById("change_popup").style.display = "block";
    });

    document.getElementById("change_closePopupBtn").addEventListener("click", function() {
        document.getElementById("change_popup").style.display = "none";
    });

    document.getElementById("delete_openPopupBtn").addEventListener("click", function() {
        document.getElementById("delete_popup").style.display = "block";
    });

    document.getElementById("delete_closePopupBtn").addEventListener("click", function() {
        document.getElementById("delete_popup").style.display = "none";
    });

    document.getElementById("register_new_admin_switchToSignUp").addEventListener("click", function() {
        document.getElementById("register_popup").style.display = "block";
    });

    document.getElementById("register_closePopupBtn").addEventListener("click", function() {
        document.getElementById("register_popup").style.display = "none";
    });
    </script>

    <!-- ----------------Scripts---------- -->
    <script src="assets/js/script.js"></script>

    <!-- ----------------Chart JS---------- -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script src="assets/js/chartJS.js"></script>

    <!-- --------------ionicons----------- -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>