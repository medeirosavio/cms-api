CMS-API

Descrição

A API-CMS é uma aplicação baseada em Laravel que fornece endpoints para criar, atualizar, listar e deletar postagens. Esta API também permite filtrar postagens por tags específicas. A documentação da API é gerada utilizando Swagger.

Funcionalidades

1. Listar todas as postagens.
2. Filtrar postagens por tags.
3. Criar uma nova postagem.
4. Atualizar uma postagem existente.
5. Deletar uma postagem por ID.

Requisitos

- PHP >= 7.4
- Composer
- Laravel 8.x
- MySQL ou outro banco de dados suportado pelo Laravel

 Instalação

Instale as dependências do PHP:
composer install

   1. Clone o repositório para o seu ambiente local:
      git clone https://github.com/medeirosavio/cms-api.git
      cd API-CMS

 Configure o arquivo .env:
 cp .env.example .env
 Configure o arquivo .env com suas credenciais de banco de    dados e outras configurações necessárias.
Gere a chave da aplicação:
php artisan key:generate
Execute as migrações para criar as tabelas no banco de dados:
php artisan migrate
Execute as seeder para popular o banco de dados (opcional):
php artisan db:seed
Inicie o servidor de desenvolvimento:
php artisan serve
Documentação da API
A documentação da API é gerada utilizando Swagger e pode ser acessada em:
http://127.0.0.1:8000/api/documentation

Endpoints
Listar todas as postagens
URL: /posts
Método: GET
Resposta: 200 OK
json
Copy code
[
    {
        "id": 1,
        "title": "Notion",
        "author": "Marcia Thiel",
        "content": "Sed soluta nemo et consectetur reprehenderit ea reprehenderit sit...",
        "tags": ["organization", "planning", "collaboration", "writing", "calendar"]
    },
    {
        "id": 2,
        "title": "json-server",
        "author": "Eldora Schinner",
        "content": "Laudantium illum modi tenetur possimus natus...",
        "tags": ["api", "json", "schema", "node", "github", "rest"]
    }
]

Filtrar postagens por tag
URL: /posts?tag={tag}
Método: GET
Resposta: 200 OK
json
Copy code
[
    {
        "id": 2,
        "title": "json-server",
        "author": "Eldora Schinner",
        "content": "Laudantium illum modi tenetur possimus natus...",
        "tags": ["api", "json", "schema", "node", "github", "rest"]
    }
]

Criar uma nova postagem
URL: /posts
Método: POST
Corpo da Requisição:
json
Copy code
{
    "title": "hotel",
    "author": "Jett Hilpert",
    "content": "Local app manager...",
    "tags": ["node", "organizing", "webapps", "domain", "developer", "https", "proxy"]
}

Resposta: 201 Created
json
Copy code
{
    "id": 5,
    "title": "hotel",
    "author": "Jett Hilpert",
    "content": "Local app manager...",
    "tags": ["node", "organizing", "webapps", "domain", "developer", "https", "proxy"]
}

Atualizar uma postagem
URL: /posts/{id}
Método: PUT
Corpo da Requisição:
json
Copy code
{
    "title": "hotel",
    "author": "Taylor Haag",
    "content": "Local app manager...",
    "tags": ["organizing", "webapps", "domain", "developer", "proxy"]
}

Resposta: 200 OK
json
Copy code
{
    "id": 5,
    "title": "hotel",
    "author": "Taylor Haag",
    "content": "Local app manager...",
    "tags": ["organizing", "webapps", "domain", "developer", "proxy"]
}

Deletar uma postagem
URL: /posts/{id}
Método: DELETE
Resposta: 204 No Content
Testes
Para rodar os testes da aplicação, utilize o comando:
php artisan test

Contribuição
Faça um fork do projeto.
Crie uma branch para sua feature (git checkout -b feature/fooBar).
Faça commit das suas alterações (git commit -am 'Add some fooBar').
Faça push para a branch (git push origin feature/fooBar).
Crie um novo Pull Request.
Licença
Este projeto está licenciado sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.
Contato
Sávio Medeiros - @medeirosavio - savio.medeiros@ccc.ufcg.edu.br
Link do Projeto: https://github.com/medeirosavio/cms-api