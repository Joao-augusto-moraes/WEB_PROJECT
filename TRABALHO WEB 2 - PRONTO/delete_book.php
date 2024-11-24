<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'db.php';

// Verifica se o ID foi enviado na URL
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Exclui o livro do banco de dados
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$book_id]);

    // Redireciona de volta para o dashboard
    header('Location: dashboard.php');
    exit;
} else {
    // Se o ID não foi passado, redireciona para o dashboard
    header('Location: dashboard.php');
    exit;
}
?>
