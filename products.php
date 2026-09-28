<?php
header('Content-Type: application/json; charset=utf-8');
require 'db.php';

$conn = getConnection();

$sql = "
    CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        image_url VARCHAR(255) NOT NULL DEFAULT '',
        category VARCHAR(100) NOT NULL DEFAULT 'General',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
";

if (!$conn->query($sql)) {
    http_response_code(500);
    echo json_encode(['error' => 'No se pudo crear la tabla products', 'message' => $conn->error]);
    exit;
}

$check = $conn->query('SELECT COUNT(*) AS total FROM products');
$row = $check->fetch_assoc();

if ((int)$row['total'] === 0) {
    $products = [
        [
            'name' => 'Auriculares Pro X',
            'description' => 'Audio envolvente con cancelación de ruido y batería de larga duración.',
            'price' => 249.99,
            'image_url' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=900&q=80',
            'category' => 'Tecnología'
        ],
        [
            'name' => 'Lámpara de Escritorio',
            'description' => 'Diseño minimalista con brillo ajustable para estudiar o trabajar.',
            'price' => 89.50,
            'image_url' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
            'category' => 'Hogar'
        ],
        [
            'name' => 'Kit de Cuidado Facial',
            'description' => 'Set con limpieza, hidratación y protección para una rutina completa.',
            'price' => 74.00,
            'image_url' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=900&q=80',
            'category' => 'Belleza'
        ],
        [
            'name' => 'Chaqueta Urban',
            'description' => 'Prenda ligera y moderna para el día a día con estilo casual.',
            'price' => 129.90,
            'image_url' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80',
            'category' => 'Ropa'
        ]
    ];

    $stmt = $conn->prepare('INSERT INTO products (name, description, price, image_url, category) VALUES (?, ?, ?, ?, ?)');

    foreach ($products as $product) {
        $stmt->bind_param('ssdss', $product['name'], $product['description'], $product['price'], $product['image_url'], $product['category']);
        $stmt->execute();
    }

    $stmt->close();
}

$result = $conn->query('SELECT * FROM products ORDER BY id DESC');
$products = [];

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
