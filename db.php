<?php
$host = 'localhost';
$dbName = 'surya_store';
$dbUser = 'root';
$dbPass = '';

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error de conexión a la base de datos.',
        'message' => $conn->connect_error
    ]);
    exit;
}

function getConnection() {
    global $conn;
    return $conn;
}
