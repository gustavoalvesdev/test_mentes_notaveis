# API de Usuários, Endereços, Cidades e Estados - PHP Puro

Esta é a versão PHP puro da API. Foi desenvolvida usando o PHP na versão 8.

Foi utilizado o Apache como servidor da aplicação, com auxílio do XAMPP.

## Instalação

### Banco de Dados
- Pegue o arquivo <b>mentes_notaveis_test.sql<b> na raiz deste repositório, crie um bando de dados chamado <b>mentes_noatveis_test</b> ou outro nome de sua preferência, desde que especifique no arquivo de configuração e importe para o servidor MySQL
  
### Arquivo de Configuração
- Edite o arquivo <b>config.php</b> com suas informações de banco de dados e servidor

### Para gerar o autoload do Composer
`composer update`
  
### Acessar a aplicação
- Para acessar a aplicação basta seguir os endpoints listados abaixo, utilizando um software como <b>Postman</b> ou <b>Insomnia</b>, setando as URLs corretas
  
## ENDPOINTS

MÉTODO | ENDPOINT | DESCRIÇÃO
------------|-----|------------
GET | /users | Lista todos os usuários
GET | /users/{id} | Lista um usuário por id
POST | /users | Insere um usuário. É necessário passar os parâmetros: <b>name</b>, <b>address</b> (<i>id do endereco</i>), <b>email</b> e <b>password</b>
