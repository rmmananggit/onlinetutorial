<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Perform password validation
    if ($password !== $confirmPassword) {
        echo "false";
    } else {
        echo "true";
    }
}
?>