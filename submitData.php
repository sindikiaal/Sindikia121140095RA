<?php
session_start();
include "connectDB.php";

function saveUserDataToSession($name, $email, $subscribe, $gender)
{
    $_SESSION['user_data'] = array(
        'name' => $name,
        'email' => $email,
        'subscribe' => $subscribe,
        'gender' => $gender,
    );
}

function getUserDataFromSession()
{
    return isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subscribe = isset($_POST["subscribe"]) ? $_POST["subscribe"] : 0; 
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : null;

    saveUserDataToSession($name, $email, $subscribe, $gender);

    $sql = "INSERT INTO users (name, email, subscribe, gender) VALUES ('$name', '$email', $subscribe, '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Data has been submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
