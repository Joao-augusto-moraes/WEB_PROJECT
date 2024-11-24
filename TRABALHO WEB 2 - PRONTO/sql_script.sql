-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS livraria_tech;
USE livraria_tech;

-- Tabela de usuários (para login)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Adicionar o campo de e-mail na tabela users, caso ainda não exista
ALTER TABLE users ADD COLUMN IF NOT EXISTS email VARCHAR(255) UNIQUE NOT NULL AFTER username;

-- Tabela de categorias
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Tabela de livros
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    category_id INT,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Inserção de categorias iniciais
INSERT INTO categories (name) VALUES ('Programação'), ('Redes'), ('Inteligência Artificial');

-- Inserção de livros iniciais com URLs das capas
INSERT INTO books (title, author, category_id, description, price, image_url)
VALUES 
('Estruturas de Dados', 'Mark Allen Weiss', 1, 'Livro sobre algoritmos.', 89.99, 'https://m.media-amazon.com/images/I/41CxssmdTuL._AC_UF1000,1000_QL80_.jpg'),
('Redes de Computadores', 'Andrew Tanenbaum', 2, 'Fundamentos de redes.', 99.99, 'https://m.media-amazon.com/images/I/91uoaAYJkrL._AC_UF1000,1000_QL80_.jpg'),
('Machine Learning', 'Tom Mitchell', 3, 'Introdução à IA.', 119.99, 'https://m.media-amazon.com/images/I/71h9jhxr7vL._AC_UF1000,1000_QL80_.jpg');

-- Inserção de usuário administrativo
INSERT INTO users (username, email, password)
VALUES ('admin', 'admin@livrariatech.com', '$2y$10$KbQiFzCe1/XBwPZZsDZ2q.OAKaPjKb.6Cm8Jw8Szt7vCrr/oKcu3m'); -- senha: admin123
