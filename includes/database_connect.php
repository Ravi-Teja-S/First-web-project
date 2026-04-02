<?php
$conn = mysqli_connect("sql112.infinityfree.com", "if0_39566429", "6UHwaau8iA", "if0_39566429_traditional_arts");

if (mysqli_connect_errno()) {
    // Throw error message based on ajax or not
    echo "Failed to connect to MySQL! Please contact the admin.";
    return;
}
