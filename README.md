#  Sistema de Catálogo de Produtos de Beleza

Trata-se de um trabalho acadêmico que tem como objetivo desenvolver a especificação inicial de um sistema. O projeto consiste em um catálogo de produtos de beleza, considerando as dificuldades enfrentadas na organização e apresentação das informações dos produtos, bem como na localização de itens específicos e comparação entre diferentes opções.

## Usuários

- **Administrador:** responsável pelo cadastro, edição e exclusão dos produtos.
- **Cliente:** responsável pela consulta e localização dos produtos no catálogo.

## Funcionalidades

- Visualização do catálogo de produtos.
- Localização de produtos.
- Cadastro de produtos.
- Edição de produtos cadastrados.
- Exclusão de produtos cadastrados.

## Objetivo

Organizar e facilitar a consulta aos produtos de beleza, permitindo a visualização e localização dos itens disponíveis.

## Equipe

- Camily Vitória de Souza Goulart – Desenvolvimento individual.

## Arquitetura do Sistema

O sistema é composto por quatro blocos principais:

- **Interface:** permite que o administrador cadastre produtos e o cliente visualize e pesquise o catálogo.
- **Back-end:** processa as solicitações e realiza operações de cadastro, edição e exclusão.
- **Banco de dados:** armazena informações dos produtos, como nome, preço, categoria, descrição, estoque e imagem.
- **Servidor:** disponibiliza o sistema para acesso pelo navegador.

## Interfaces e Dados Manipulados

### Página inicial / Catálogo
- Mensagem de boas-vindas;
- Menu de navegação;
- Barra de pesquisa;
- Categorias de produtos;
- Catálogo de produtos disponíveis.

### Página de cadastro de produtos
- Formulário de cadastro;
- Campos de nome, preço, categoria, descrição, estoque e imagem;
- Botão para salvar o cadastro.

## Diagramas UML

- [Diagrama de Casos de Uso](documentos/Casos%20de%20Uso.png)
- [Diagrama de Classes](documentos/Diagrama%20de%20Classes.png)

## Plano detalhado

- [Plano do Projeto](documentos/plano-projeto.md)

O desenvolvimento será realizado individualmente, utilizando VS Code, HTML, CSS, PHP, MySQL, XAMPP e GitHub.

O acompanhamento será feito por meio da organização das etapas, definição de prazos, testes das funcionalidades e registro das alterações no GitHub.

## Riscos e Ações Preventivas

- **Perda de dados:** realizar backups periódicos do banco de dados.
- **Produtos com disponibilidade incorreta:** atualizar frequentemente o status dos produtos.
- **Sistema inoperável por falta de manutenção:** realizar manutenção preventiva e testes periódicos.
