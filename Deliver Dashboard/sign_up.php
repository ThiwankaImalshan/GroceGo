<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Deliver</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic Reset */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Sign-Up Container */
        .signup-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }

        /* Logo Styling */
        .logo img {
            width: 80px; /* Adjust size as needed */
            margin-bottom: 20px;
        }

        /* Heading Styling */
        .heading {
            font-size: 26px;
            margin-bottom: 25px;
            color: #333;
        }

        /* Form Styling */
        .signup-form {
            display: flex;
            flex-direction: column;
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 15px;
            text-align: left;
            margin-right: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Button Styling */
        .signup-button {
            background-color: #51ac37; /* Green color */
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
            font-weight: bold;
            margin-top: 30px;
        }

        .signup-button:hover {
            background-color: green; /* Lighter green */
        }

        .signup-button:active {
            background-color: #1e4b00; /* Darker green */
        }

        /* Sign-In Link Styling */
        .signin-link {
            margin-top: 20px;
        }

        .signin-link a {
            color: #2f5e00; /* Blue color */
            text-decoration: none;
            font-weight: bold;
        }

        .signin-link a:hover{
            color: #51ac37;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .signup-container {
                padding: 15px;
                max-width: 90%;
            }

            .logo img {
                width: 60px; /* Smaller logo for smaller screens */
            }

            .heading {
                font-size: 20px; /* Adjust heading size */
            }

            .form-group label {
                font-size: 13px; /* Smaller label text */
            }

            .form-group input {
                font-size: 14px; /* Smaller input text */
                padding: 8px; /* Adjust input padding */
            }

            .signup-button {
                font-size: 14px; /* Smaller button text */
                padding: 12px; /* Adjust button padding */
            }
        }

    </style>
</head>
<body>
    <div class="signup-container">
        <!-- <div class="logo">
            <img src="assets/img/logo-colored.png" alt="Deliver Logo">
        </div> -->
        <h1 class="heading">Sign Up</h1>
        <form class="signup-form">
            <div class="form-group">
                <!-- <label for="fullname">Full Name</label> -->
                <input type="text" id="fullname" name="fullname" placeholder="Enter your Full Name" required>
            </div>
            <div class="form-group">
                <!-- <label for="email">Email</label> -->
                <input type="email" id="email" name="email" placeholder="Enter your Email" required>
            </div>
            <div class="form-group">
                <!-- <label for="username">Username</label> -->
                <input type="text" id="username" name="username" placeholder="Choose a Username" required>
            </div>
            <div class="form-group">
                <!-- <label for="password">Password</label> -->
                <input type="password" id="password" name="password" placeholder="Create a Password" required>
            </div>
            <div class="form-group">
                <!-- <label for="confirm-password">Confirm Password</label> -->
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your Password" required>
            </div>
            <button type="submit" class="signup-button">Sign Up</button>
        </form>
        <div class="signin-link">
            <p>Already have an account? <a href="#">Sign in here</a></p>
        </div>
    </div>
</body>
</html>
