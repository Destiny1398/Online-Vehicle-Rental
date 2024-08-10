<?php
session_start();

require_once "../config.php";

if (!isset($_SESSION['customer_id'])) {
    echo 'Unauthorized access';
    exit();
}

$customer_id = $_SESSION['customer_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = intval($_POST['booking_id']);

    // Check if the booking belongs to the logged-in customer
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_id = ? AND customer_id = ?");
    $stmt->bind_param("ii", $booking_id, $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the payment status
        $update_stmt = $conn->prepare("UPDATE bookings SET payment_status = 'Paid' WHERE booking_id = ?");
        $update_stmt->bind_param("i", $booking_id);
        if ($update_stmt->execute()) {
            echo 'Success';
        } else {
            echo 'Failed';
        }
    } else {
        echo 'Booking not found or does not belong to the customer';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request';
}
?>
