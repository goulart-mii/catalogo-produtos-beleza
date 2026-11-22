# Execução do primeiro incremento funcional

## Funcionalidade implementada

Visualização dos produtos cadastrados no catálogo, com pesquisa por nome e filtro por categoria.

## Requisitos

- XAMPP com Apache e MySQL/MariaDB em execução.
- PHP com a extensão PDO MySQL habilitada.
- Navegador web.

## Instalação e execução

1. Extraia os arquivos do incremento para `C:\xampp\htdocs\catalogo_beleza\`.
2. Abra o painel do XAMPP e inicie os módulos **Apache** e **MySQL**.
3. Acesse `http://localhost/phpmyadmin`.
4. Na opção **Importar**, selecione `database/catalogo_beleza.sql` e execute a importação. O script cria o banco `catalogo_beleza`, as tabelas `categorias` e `produtos` e registros de demonstração.
5. Confira as credenciais em `config/conexao.php`. A configuração inicial utiliza o usuário `root` e senha vazia, padrão comum em instalações locais do XAMPP. Ajuste se seu ambiente utilizar outras credenciais.
6. Abra `http://localhost/catalogo_beleza/` no navegador.
7. Teste a pesquisa digitando parte do nome de um produto, escolhendo uma categoria ou combinando os dois filtros.
8. Use **Limpar filtros** para voltar à listagem completa.

## Resultado esperado

A página apresenta os produtos cadastrados no banco de dados. A pesquisa por nome e o filtro por categoria atualizam a listagem. Quando não houver correspondências, o sistema apresenta uma mensagem informando que nenhum produto foi encontrado.

## Limites deste incremento

Esta primeira versão implementa a consulta e a localização de produtos. As operações de cadastro, edição e exclusão do Administrador permanecem previstas para incrementos posteriores. Os produtos inseridos pelo script SQL são dados de demonstração.
