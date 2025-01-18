<h1 align="center">
<br>
  <img src="img/logo.png"  width="120">
<br>
<br>
Conecta
</h1>

<p align="center">
Teste para Desenvolvedor Pleno </p>



 ### Comando do teste

```sh
Desenvolva uma api RESTful em PHP para criar, atualizar, deletar e listar todos os usuários. As informações devem ser salvas em um banco de dados MySQL.
O endpoint deve retornar os dados em formato JSON e permitir operações GET, POST, PUT e DELETE para manipular os registros de usuário.
Considere aspectos como segurança, validação de entrada e tratamento de erros. O exame deverá ser entregue através do link do projeto no Git.
Desejável que utilize Laravél ou CodeIgniter 3.

```


<hr />

## Introdução

```sh
 Este documento descreve as funcionalidades da API do sistema, com detalhes sobre as rotas disponíveis para manipulação de usuários e autenticação. Cada rota apresenta a método HTTP utilizado, o endpoint e a descrição de sua funcionalidade.

 
```

## Endpoints

```sh
 1. Listar Usuários

URL: GET http://127.0.0.1:8000/api/users

Descrição: Retorna uma lista de todos os usuários cadastrados no sistema.

Autenticação: É necessário possuir um token válido para acessar este endpoint.

2. Adicionar Usuário

URL: POST http://127.0.0.1:8000/api/users

Descrição: Permite adicionar um novo usuário ao sistema.

Autenticação: Apenas usuários com permissão de administrador (tipo "admin") podem acessar este endpoint.

```

## Exemplo

```
Adicionar usuario
 {
    "name": "João Silva",
    "email": "joao.silva@example.com",
    "password": "senha123"
} 

 
```

```sh
resposta
{
    "id": 1,
    "name": "João Silva",
    "email": "joao.silva@example.com",
    "created_at": "2025-01-18T12:00:00",
    "updated_at": "2025-01-18T12:00:00"
}

 
```

```sh

3. Atualizar Usuário

URL: PUT http://127.0.0.1:8000/api/users/{id}

Descrição: Atualiza as informações de um usuário específico identificado pelo id.

Autenticação: Apenas administradores podem acessar este endpoint.


4. Deletar Usuário

Método: DELETEURL: http://127.0.0.1:8000/api/users/{id}
Descrição: Remove um usuário do sistema.Requisição:

Substitua {id} pelo identificador único do usuário.
Resposta:

Sucesso: Retorna uma mensagem confirmando a exclusão.

```


```sh

5. Login

URL: POST http://127.0.0.1:8000/api/login

Descrição: Realiza o login de um usuário, gerando um token de autenticação.Sendo que somente que é tipo "Admin" poderá ter tokes de acesso

Corpo da Requisição (exemplo):
 
```

```sh

{
  "email": "joao.silva@example.com",
  "password": "senha123"
}
 
```

```sh
resposta
{
  "message": "Login realizado com sucesso!",
  "token": "abcdef123456..."
}
 
```
## Segurança

```sh
1. Tokens de Autenticação

Após o login bem-sucedido, a API gera um token exclusivo para o usuário. Este token é necessário para acessar endpoints protegidos.

O token é armazenado no banco de dados na coluna remember_token da tabela users.

O sistema somente libera o tokes se usuario for do tipo "Admin"

Recomendações de segurança:

Utilize HTTPS para proteger as comunicações entre o cliente e o servidor.

Configure uma expiração para os tokens, solicitando que os usuários façam login novamente após um período definido.

Armazene os tokens de forma segura no cliente (ex.: em cookies seguros ou localStorage).
 
```

## Banco de Dados

```sh
Sistema Gerenciador: MySQL

Tabelas Principais:

users: Armazena informações dos usuários.

Colunas:

id: Identificador único do usuário.

name: Nome do usuário.

email: Endereço de e-mail do usuário.

password: Hash da senha do usuário.

tipo: Tipo do usuário (admin ou user).

remember_token: Token de autenticação para sessões ativas.

created_at e updated_at: Datas de criação e atualização do registro.
 
```

## Boas Práticas no Banco de Dados

```sh
Senhas são armazenadas utilizando hashing seguro (ex.: bcrypt).

Permissões baseadas no campo tipo, garantindo acesso apenas a usuários autorizados.
 
```

## Contato

```sh
E-mail: david.foxmulder@gmail.com

LinkedIn: [david orion](https://www.linkedin.com/in/davidmuldersilva/)
 
```








