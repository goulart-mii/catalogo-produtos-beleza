<?php
require_once __DIR__ . '/config/conexao.php';
require_once __DIR__ . '/classes/Categoria.php';
require_once __DIR__ . '/classes/Produto.php';
require_once __DIR__ . '/classes/Catalogo.php';
require_once __DIR__ . '/classes/Cliente.php';

$catalogo = new Catalogo($pdo);
$cliente = new Cliente();

$busca = trim((string) ($_GET['busca'] ?? ''));
$categoriaSelecionada = filter_input(INPUT_GET, 'categoria', FILTER_VALIDATE_INT);
$categoriaSelecionada = ($categoriaSelecionada !== false && $categoriaSelecionada !== null && $categoriaSelecionada > 0)
    ? $categoriaSelecionada
    : 0;

$categorias = $catalogo->listarCategorias();

if ($busca !== '' || $categoriaSelecionada > 0) {
    $produtos = $cliente->localizarProduto($catalogo, $busca, $categoriaSelecionada);
} else {
    $produtos = $cliente->consultarCatalogo($catalogo);
}

function escapar(?string $valor): string
{
    return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Produtos de Beleza</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header class="topo">
        <div class="container">
            <p class="marca">Catálogo de Beleza</p>
            <h1>Encontre seu próximo produto favorito</h1>
            <p class="subtitulo">Consulte os produtos e filtre por nome ou categoria.</p>
        </div>
    </header>

    <main class="container conteudo">
        <section class="filtros" aria-labelledby="titulo-filtros">
            <h2 id="titulo-filtros">Localizar produtos</h2>
            <form action="index.php" method="GET" class="form-filtros">
                <div class="campo campo-busca">
                    <label for="busca">Nome do produto</label>
                    <input
                        type="search"
                        id="busca"
                        name="busca"
                        placeholder="Ex.: hidratante facial"
                        value="<?= escapar($busca) ?>"
                    >
                </div>

                <div class="campo">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" name="categoria">
                        <option value="">Todas as categorias</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option
                                value="<?= $categoria->getId() ?>"
                                <?= $categoriaSelecionada === $categoria->getId() ? 'selected' : '' ?>
                            >
                                <?= escapar($categoria->getNome()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="botao">Buscar</button>
                <a class="limpar" href="index.php">Limpar filtros</a>
            </form>
        </section>

        <section class="resultados" aria-labelledby="titulo-resultados">
            <div class="cabecalho-resultados">
                <h2 id="titulo-resultados">Produtos disponíveis no catálogo</h2>
                <span><?= count($produtos) ?> produto(s)</span>
            </div>

            <?php if (count($produtos) > 0): ?>
                <div class="grade-produtos">
                    <?php foreach ($produtos as $produto): ?>
                        <?php $dados = $produto->consultarDetalhes(); ?>
                        <article class="card-produto">
                            <?php if (!empty($dados['imagem'])): ?>
                                <img
                                    class="imagem-produto"
                                    src="<?= escapar($dados['imagem']) ?>"
                                    alt="<?= escapar($dados['nome']) ?>"
                                >
                            <?php else: ?>
                                <div class="imagem-placeholder" aria-label="Imagem não cadastrada">
                                    <span>Produto de beleza</span>
                                </div>
                            <?php endif; ?>

                            <div class="informacoes-produto">
                                <span class="categoria-produto"><?= escapar($dados['categoria']) ?></span>
                                <h3><?= escapar($dados['nome']) ?></h3>
                                <p class="descricao"><?= escapar($dados['descricao']) ?></p>
                                <p class="preco">R$ <?= number_format($dados['preco'], 2, ',', '.') ?></p>
                                <p class="disponibilidade">
                                    <?= $dados['estoque'] > 0 ? 'Disponível' : 'Indisponível no momento' ?>
                                </p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="sem-resultados">
                    <h3>Nenhum produto encontrado</h3>
                    <p>Tente alterar o nome pesquisado ou selecionar outra categoria.</p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer class="rodape">
        <div class="container">
            <p>Sistema de Catálogo de Produtos de Beleza · Projeto Integrador</p>
        </div>
    </footer>
</body>
</html>
