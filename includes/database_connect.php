<?php
$conn = mysqli_connect("127.0.0.1:3307", "root", "", "traditional_arts");

if (mysqli_connect_errno()) {
    // Throw error message based on ajax or not
    echo "Failed to connect to MySQL! Please contact the admin.";
    return;
}
