<?php
if (isset($_POST['submit2'])) {
    // Connect to the database
    require 'includes/dbconnection.php';

    // Query the database for events with selected status
    $status = "Approved"; // Change this to the desired status (approved, pending, canceled)
    $sql = "SELECT Name, Email FROM tblbooking WHERE Status = '$status'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $eventName = $row['Name'];
            $to = $row['Email'];

            // Email parameters
            $subject = "Event Status Update";
            $message = "Your event '$eventName' has been $status.";

            // Send email
            mail($to, $subject, $message);
        }
        echo "Emails sent successfully.";
    } else {
        echo "No events with '$status' status found.";
    }

    $conn->close();
}
?>
