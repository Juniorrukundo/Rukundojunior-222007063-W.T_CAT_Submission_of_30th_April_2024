<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard - Customer Orders</title>
    <style>
        /* CSS styles for the form */
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
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .update-button {
            background-color: #007bff;
            color: #fff;
        }

        .delete-button {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer Orders</h1>
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Time of Order</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>2024-05-05 13:45:00</td>
                    <td>123 Main St, Cityville</td>
                    <td class="action-buttons">
                        <button class="update-button">Update</button>
                        <button class="delete-button">Delete</button>
                    </td>
                </tr>
                <!-- Additional rows for more orders -->
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript code for handling order actions
        document.addEventListener('DOMContentLoaded', function() {
            var updateButtons = document.querySelectorAll('.update-button');
            var deleteButtons = document.querySelectorAll('.delete-button');

            updateButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Handle update button click
                    var customerName = this.parentElement.parentElement.children[0].textContent;
                    console.log('Update button clicked for customer: ' + customerName);
                });
            });

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Handle delete button click
                    var customerName = this.parentElement.parentElement.children[0].textContent;
                    console.log('Delete button clicked for customer: ' + customerName);
                    this.parentElement.parentElement.remove(); // Remove the row from the table
                });
            });
        });
    </script>

    <?php
    // Connect to your database (assuming localhost with username 'root' and no password)
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

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from the form
        $customerName = $_POST["customer_name"];
        $timeOfOrder = $_POST["time_of_order"];
        $address = $_POST["address"];

        // Insert data into the database
        $sql = "INSERT INTO orders (customer_name, time_of_order, address) VALUES ('$customerName', '$timeOfOrder', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
