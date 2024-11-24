<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_book'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image_url = $_POST['image_url'];

        $stmt = $pdo->prepare("INSERT INTO books (title, author, category_id, description, price, image_url) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $author, $category_id, $description, $price, $image_url]);

        header('Location: dashboard.php');
    }

    if (isset($_POST['delete_book'])) {
        $book_id = $_POST['book_id'];

        $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
        $stmt->execute([$book_id]);

        header('Location: dashboard.php');
    }
}
?>
