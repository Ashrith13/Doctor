<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";
$table_name = "patient_details";

$conn = new mysqli('localhost', 'ashrith', 'ashrith', 'doctor');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$phoneNumber = $_POST['phoneNumber'];
$patientName = $_POST['patientName'];
$medicine = $_POST['medicine'];

$sql = "INSERT INTO number (phone_number, patient_name, medicine) VALUES ('$phoneNumber', '$patientName', '$medicine')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully. Details for phone number $phoneNumber:<br>";
    
    $selectSql = "SELECT * FROM $table_name WHERE phone_number = '$phoneNumber'";
    $result = $conn->query($selectSql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . "<br>";
            echo "Patient Name: " . $row["patient_name"] . "<br>";
            echo "Medicine: " . $row["medicine"] . "<br>";
            // Add more fields as needed
        }
    } else {
        echo "No details found for this phone number.";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
