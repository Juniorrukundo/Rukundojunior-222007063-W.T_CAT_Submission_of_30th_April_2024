<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $quantity = $_POST['quantity'];
    $food_item = $_POST['food_item'];

    $sql = "INSERT INTO delivery (name, email, phone, address, quantity, food_item)
            VALUES ('$name', '$email', '$phone', '$address', '$quantity', '$food_item')";

    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully. Redirecting to payment page...";
        echo "<script>setTimeout(function(){window.location.href='payment.html';}, 2000);</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Delivery Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"], input[type="email"], input[type="tel"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 50%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none; /* added */
            display: inline-block; /* added */
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function validateForm() {
            var name = document.forms["deliveryForm"]["name"].value;
            var email = document.forms["deliveryForm"]["email"].value;
            var phone = document.forms["deliveryForm"]["phone"].value;
            var address = document.forms["deliveryForm"]["address"].value;
            var quantity = document.forms["deliveryForm"]["quantity"].value;
            var food_item = document.forms["deliveryForm"]["food_item"].value;

            if (name == "" || email == "" || phone == "" || address == "" || quantity == "" || food_item == "") {
                alert("All fields must be filled out");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Order Delivery</h1>
        <form name="deliveryForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="tel" name="phone" placeholder="Your Phone Number" required>
            <textarea name="address" placeholder="Delivery Address" rows="4" required></textarea>
            <input type="number" name="quantity" placeholder="Quantity" min="1" required>
            <input type="text" name="food_item" placeholder="Food Item" required>
            <!-- Changed input type to button and added onclick event -->
            <input type="button" value="Place Order" onclick="validateForm()">
        </form>
        <!-- Added link with proper href -->
        <a href="payment.php" style="text-decoration: none; color: white;"><button style="width: 50%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">Proceed to Payment</button></a>
    </div>
</body>
</html>
