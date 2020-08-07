<?php
require_once '../libs/config.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$conn = connDB();

$getCate = "SELECT * FROM categories WHERE id = :id";

$stmt = $conn->prepare($getCate);
$stmt->bindParam(':id', $id);
$stmt->execute();
$view = $stmt->fetch();


