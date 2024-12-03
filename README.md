# BookStore API

## Descrição
   <p>API voltada para gerenciamento de livraria. Ela inclui funcionalidades para autenticação de usuários, gerenciamento de livros, autores, categorias, pedidos e a geração de relatórios. A API utiliza Laravel como framework e está estruturada para ser extensível e escalável.</p>
   <p>Tendo como CRUDS principais e completos o de Orders e Book, seguindo o padrão de Request, Controller, Service, Repository e Resource, tendo a implementação do JWT, sendo usado o banco de dados MySQL (xampp).</p>

## Funcionalidades Principais
 ### Autenticação
  - Registro e login de usuários.
  - Rotas protegidas e rotas de buscas livres.
    
### Gerenciamento de Livros, Autores e Categorias
- Endpoints para listagem pública de livros, categorias e autores.

### Pedidos e Livros
  - CRUD completo para pedidos e para livros, incluindo a associação um com o outro e com o usuario.

### Relatórios
- Geração de um relatório detalhado dos pedidos e dos livros via job.

## Requisitos
- PHP >= 8.1
- Composer
- Laravel >= 10
- Banco de dados configurado (MySQL/PostgreSQL)

## Sobre o Job
  ### Relatório de Pedidos
  - O Job é responsável por gerar um relatório de pedidos e salvá-lo no servidor.
  - O Job é executado em fila, garantindo que o processo não bloqueie a API.

  ### Informações no relatório:
  - Dados do pedido: ID, usuário e preço total.
  - Livros associados: título, autor, categoria e quantidade.

 ### Como disparar o Job?
 - Acesse a rota `/test-job`
 - Um relatório será gerado no caminho: storage/app/private/reports/order_report.json.

## Instalação
 ### Clone o Repositório
 ```
    git clone https://github.com/seu-usuario/pos-livraria.git
```
 ### Instalação dos pacotes
 ```
    composer install
```
 ### Execução das Migrações
 ```
    php artisan migrate
```
 ### Configure o Arquivo .env
 - Configure o banco de dados e o JWT
### Execução das Migrações
 ```
    php artisan migrate
```
### Gere a chave JWT
 ```
   php artisan jwt:secret
```
### Inicie o servidor
 ```
   php artisan serve
```


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
