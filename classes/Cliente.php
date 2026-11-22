<?php

class Cliente
{
    public function __construct(
        private ?int $id = null,
        private string $nome = 'Visitante'
    ) {
    }

    public function consultarCatalogo(Catalogo $catalogo): array
    {
        return $catalogo->listarProdutos();
    }

    public function localizarProduto(Catalogo $catalogo, string $nome = '', int $categoriaId = 0): array
    {
        if (trim($nome) !== '') {
            return $catalogo->buscarPorNome($nome, $categoriaId);
        }

        if ($categoriaId > 0) {
            return $catalogo->buscarPorCategoria($categoriaId);
        }

        return $catalogo->listarProdutos();
    }
}
