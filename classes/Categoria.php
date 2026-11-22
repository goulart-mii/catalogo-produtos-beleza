<?php

class Categoria
{
    public function __construct(
        private int $id,
        private string $nome
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function listarProdutos(Catalogo $catalogo): array
    {
        return $catalogo->buscarPorCategoria($this->id);
    }
}
