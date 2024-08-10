<?php
// Database connection (replace with your own credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_vehicle_rental_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['booking_id'])) {
    $booking_id = intval($_POST['booking_id']);

    // Update the price to 0 for the given booking_id
    $sql = "UPDATE bookings SET price = 0 WHERE booking_id = ?";
    $sql1 = "UPDATE bookings SET payment_status = "Paid" WHERE booking_id = ?";


    if ($stmt = $conn->prepare($sql1)) {
        $stmt->bind_param("i", $booking_id);
        if ($stmt->execute()) {
            echo "Price updated successfully";
        } else {
            echo "Error updating price: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Booking ID not provided.";
}


    
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $booking_id);
        if ($stmt->execute()) {
            echo "Price updated successfully";
        } else {
            echo "Error updating price: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Booking ID not provided.";
}

$conn->close();
?>
