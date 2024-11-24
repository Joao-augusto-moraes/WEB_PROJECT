<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'db.php';

// Busca todos os livros do banco
$stmt = $pdo->prepare("SELECT books.id, books.title, books.author, books.price, books.image_url, categories.name AS category_name
                       FROM books
                       LEFT JOIN categories ON books.category_id = categories.id");
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Livraria Tech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">Livraria Tech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">Livros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report.php">Relatório</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Bem-vindo ao Gerenciador de Livros</h1>

        <!-- Carrossel de Livros -->
        <div id="booksCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($books as $index => $book): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="<?= htmlspecialchars($book['image_url']) ?>" class="d-block w-100" alt="<?= htmlspecialchars($book['title']) ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= htmlspecialchars($book['title']) ?></h5>
                        <p>Autor: <?= htmlspecialchars($book['author']) ?> | Categoria: <?= htmlspecialchars($book['category_name']) ?> | R$ <?= number_format($book['price'], 2, ',', '.') ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#booksCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#booksCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div>

        <!-- Botões para CRUD -->
        <div class="mt-4 text-center">
            <a href="add_book.php" class="btn btn-success">Adicionar Livro</a>
        </div>

        <!-- Listagem de Livros para Edição/Exclusão -->
        <div class="row mt-5">
            <?php foreach ($books as $book): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?= htmlspecialchars($book['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($book['title']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($book['title']) ?></h5>
                        <p class="card-text">Autor: <?= htmlspecialchars($book['author']) ?></p>
                        <p class="card-text">Categoria: <?= htmlspecialchars($book['category_name']) ?></p>
                        <p class="card-text">Preço: R$ <?= number_format($book['price'], 2, ',', '.') ?></p>
                        <a href="edit_book.php?id=<?= $book['id'] ?>" class="btn btn-primary">Editar</a>
                        <a href="delete_book.php?id=<?= $book['id'] ?>" class="btn btn-danger">Excluir</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="bg-dark text-center text-white py-3">
        <p>© 2024 Livraria Tech. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
