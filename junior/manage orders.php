<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Orders</title>
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

        .order-list {
            list-style-type: none;
            padding: 0;
        }

        .order-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .order-details {
            margin-bottom: 10px;
        }

        .order-actions {
            margin-top: 10px;
        }

        .order-actions button {
            margin-right: 10px;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .order-actions button.processed {
            background-color: #28a745;
            color: #fff;
        }

        .order-actions button.delete {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Orders</h1>
        <ul class="order-list">
            <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "restaurant_management_system";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch orders from the database
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="order-item" data-order-id="' . $row['order_id'] . '">';
                    echo '<div class="order-details">';
                    echo '<strong>Order ID:</strong> #' . $row['order_id'] . '<br>';
                    echo '<strong>Customer Name:</strong> ' . $row['customer_name'] . '<br>';
                    echo '<strong>Items:</strong> ' . $row['items'] . '<br>';
                    echo '<strong>Total:</strong> $' . $row['total'] . '<br>';
                    echo '<strong>Status:</strong> ' . $row['status'] . '<br>';
                    echo '</div>';
                    echo '<div class="order-actions">';
                    echo '<button class="processed">Mark as Processed</button>';
                    echo '<button class="delete">Delete</button>';
                    echo '</div>';
                    echo '</li>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </ul>
    </div>

    <script>
        // JavaScript code for handling order actions
        document.addEventListener('DOMContentLoaded', function() {
            var orderItems = document.querySelectorAll('.order-item');

            orderItems.forEach(function(orderItem) {
                var orderId = orderItem.dataset.orderId;

                // Event listener for marking order as processed
                orderItem.querySelector('.processed').addEventListener('click', function() {
                    // Simulate marking order as processed (change status to 'Processed')
                    updateOrderStatus(orderId, 'Processed');
                });

                // Event listener for deleting order
                orderItem.querySelector('.delete').addEventListener('click', function() {
                    // Simulate deleting order (remove order item from the list)
                    orderItem.remove();
                });
            });

            function updateOrderStatus(orderId, status) {
                // Here you can send an AJAX request to update the order status in the database
                console.log('Order ID ' + orderId + ' status updated to: ' + status);
            }
        });
    </script>
</body>
</html>
