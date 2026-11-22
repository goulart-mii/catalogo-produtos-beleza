<?php

class Catalogo
{
    private array $produtos = [];
    private array $categorias = [];

    public function __construct(private PDO $conexao)
    {
    }

    public function listarProdutos(): array
    {
        $sql = 'SELECT p.id, p.nome, p.preco, p.descricao, p.estoque, p.imagem,
                       c.id AS categoria_id, c.nome AS categoria_nome
                FROM produtos p
                INNER JOIN categorias c ON c.id = p.categoria_id
                ORDER BY p.nome';

        $linhas = $this->conexao->query($sql)->fetchAll();
        $this->produtos = $this->mapearProdutos($linhas);

        return $this->produtos;
    }

    public function buscarPorNome(string $nome, int $categoriaId = 0): array
    {
        $sql = 'SELECT p.id, p.nome, p.preco, p.descricao, p.estoque, p.imagem,
                       c.id AS categoria_id, c.nome AS categoria_nome
                FROM produtos p
                INNER JOIN categorias c ON c.id = p.categoria_id
                WHERE p.nome LIKE :nome';
        $parametros = [':nome' => '%' . trim($nome) . '%'];

        if ($categoriaId > 0) {
            $sql .= ' AND c.id = :categoria';
            $parametros[':categoria'] = $categoriaId;
        }

        $sql .= ' ORDER BY p.nome';
        $consulta = $this->conexao->prepare($sql);
        $consulta->execute($parametros);
        $this->produtos = $this->mapearProdutos($consulta->fetchAll());

        return $this->produtos;
    }

    public function buscarPorCategoria(int $categoriaId): array
    {
        $sql = 'SELECT p.id, p.nome, p.preco, p.descricao, p.estoque, p.imagem,
                       c.id AS categoria_id, c.nome AS categoria_nome
                FROM produtos p
                INNER JOIN categorias c ON c.id = p.categoria_id
                WHERE c.id = :categoria
                ORDER BY p.nome';

        $consulta = $this->conexao->prepare($sql);
        $consulta->execute([':categoria' => $categoriaId]);
        $this->produtos = $this->mapearProdutos($consulta->fetchAll());

        return $this->produtos;
    }

    public function listarCategorias(): array
    {
        $linhas = $this->conexao->query('SELECT id, nome FROM categorias ORDER BY nome')->fetchAll();
        $this->categorias = array_map(
            static fn (array $linha): Categoria => new Categoria((int) $linha['id'], $linha['nome']),
            $linhas
        );

        return $this->categorias;
    }

    private function mapearProdutos(array $linhas): array
    {
        return array_map(
            static function (array $linha): Produto {
                $categoria = new Categoria((int) $linha['categoria_id'], $linha['categoria_nome']);

                return new Produto(
                    (int) $linha['id'],
                    $linha['nome'],
                    (float) $linha['preco'],
                    $linha['descricao'],
                    (int) $linha['estoque'],
                    $linha['imagem'],
                    $categoria
                );
            },
            $linhas
        );
    }
}
