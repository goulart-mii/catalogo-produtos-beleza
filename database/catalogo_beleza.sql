CREATE DATABASE IF NOT EXISTS catalogo_beleza
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE catalogo_beleza;

CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    descricao TEXT NULL,
    estoque INT NOT NULL DEFAULT 0,
    imagem VARCHAR(255) NULL,
    categoria_id INT NOT NULL,
    CONSTRAINT fk_produtos_categoria
        FOREIGN KEY (categoria_id) REFERENCES categorias(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;

INSERT IGNORE INTO categorias (id, nome) VALUES
    (1, 'Limpeza'),
    (2, 'Hidratação'),
    (3, 'Tratamentos'),
    (4, 'Proteção solar');

-- Produtos de exemplo para testar a primeira versão do catálogo.
INSERT INTO produtos (nome, preco, descricao, estoque, imagem, categoria_id)
SELECT 'Gel de Limpeza Facial', 32.90, 'Gel para limpeza diária da pele.', 12, NULL, 1
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Gel de Limpeza Facial');

INSERT INTO produtos (nome, preco, descricao, estoque, imagem, categoria_id)
SELECT 'Hidratante Facial', 45.50, 'Hidratante para uso diário.', 8, NULL, 2
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Hidratante Facial');

INSERT INTO produtos (nome, preco, descricao, estoque, imagem, categoria_id)
SELECT 'Sérum Facial', 59.90, 'Sérum para cuidados faciais.', 5, NULL, 3
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Sérum Facial');

INSERT INTO produtos (nome, preco, descricao, estoque, imagem, categoria_id)
SELECT 'Protetor Solar Facial', 49.90, 'Protetor solar para uso diário.', 10, NULL, 4
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Protetor Solar Facial');
