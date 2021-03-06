# API de Usuários, Endereços, Cidades e Estados - Laravel

Esta é a versão Laravel da API. Foi desenvolvida usando o Laravel na versão 9.

## Instalação

### Pré-requisitos globais:
- [x]  O PHP o caminho para o binário do PHP deve estar no PATH do sistema operacional
- [x]  O Composer deve estar instalado de forma global no sistema

### Banco de Dados
- Pegue o arquivo <b>mentes_notaveis_test.sql<b> na raiz deste repositório, crie um bando de dados chamado <b>mentes_noatveis_test</b> ou outro nome de sua preferência, desde que especifique no arquivo de configuração e importe para o servidor MySQL
  
### Arquivo de Configuração
- Edite o arquivo <b>.env.example</b> com suas informações de banco de dados e servidor, para isso, edite as variáveis de ambiente <b>DB_CONNECTION</b>, <b>DB_HOST</b>, <b>DB_PORT</b>, <b>DB_DATABASE</b>, <b>DB_USERNAME</b> e <b>DB_PASSWORD</b> com suas informações.
- Renomeie o arquivo <b>.env.example</b> para <b>.env</b>

### Instalação
- Faça o clone deste repositório para a sua máquina
- Rode o comando: `composer install`
- Depois esse: `php artisan key:generate`

### Para rodar o projeto
- Digite o comando: `php artisan serve`
  
### Acessar a aplicação
- Para acessar a aplicação basta seguir os endpoints listados abaixo, utilizando um software como <b>Postman</b> ou <b>Insomnia</b>, setando as URLs corretas
  
## ENDPOINTS

MÉTODO | ENDPOINT | DESCRIÇÃO
------------|-----|------------
GET | /users | Lista todos os usuários
GET | /users/{id} | Lista um usuário por id
GET | /userspercity/{cityId} | Lista o total de usuários por cidade, através do id da cidade passado por parâmetro
GET | /usersperstate/{stateId} | Lista o total de usuários por estado, através do id do estado passado por parâmetro
POST | /users | Insere um usuário. É necessário passar os parâmetros: <b>name</b>, <b>address</b> (<i>id do endereco</i>), <b>email</b> e <b>password</b>
PUT | /users/{id} | Atualiza dados de um usuário. Apenas o ID é obrigatório
DELETE | /users/{id} | Exclui um usuário. 
GET | /states | Lista todos os estados cadastrados
GET | /states/{id} | Lista um estado por id
GET | /cities | Lista todas as cidades cadastradas
GET | /cities/{id} | Lista uma cidade por id
GET | /addresses | Lista todos os endereços cadastrados
GET | /address/{id} | Lista um endereço por id
