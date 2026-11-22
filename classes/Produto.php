<?php

class Produto
{
    public function __construct(
        private int $id,
        private string $nome,
        private float $preco,
        private ?string $descricao,
        private int $estoque,
        private ?string $imagem,
        private Categoria $categoria
    ) {
    }

    public function consultarDetalhes(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'preco' => $this->preco,
            'descricao' => $this->descricao,
            'estoque' => $this->estoque,
            'imagem' => $this->imagem,
            'categoria' => $this->categoria->getNome(),
        ];
    }

    public function atualizarDados(array $dados): void
    {
        if (isset($dados['nome']) && trim((string) $dados['nome']) !== '') {
            $this->nome = trim((string) $dados['nome']);
        }

        if (isset($dados['preco']) && is_numeric($dados['preco']) && (float) $dados['preco'] >= 0) {
            $this->preco = (float) $dados['preco'];
        }

        if (array_key_exists('descricao', $dados)) {
            $this->descricao = $dados['descricao'] !== null ? (string) $dados['descricao'] : null;
        }

        if (isset($dados['estoque']) && filter_var($dados['estoque'], FILTER_VALIDATE_INT) !== false && (int) $dados['estoque'] >= 0) {
            $this->estoque = (int) $dados['estoque'];
        }

        if (array_key_exists('imagem', $dados)) {
            $this->imagem = $dados['imagem'] !== null ? (string) $dados['imagem'] : null;
        }
    }
}
