<h1>API REST com Laravel</h1>

<p>O objetivo do projeto foi aplicar de forma prática os conceitos de API REST, utilizando as ferramentas e tecnologias do framework Laravel, PHP Unit e Docker.</p>

<h2>💡 Como executar o projeto</h2>

<h3>Clonar o repositório</h3>

```
git clone https://github.com/rayllaluiiza/api-rest-laravel.git
```

<h3>Acessar a pasta do projeto</h3>

```
cd api-rest-laravel
```

<h3>Gerar o arquivo .env</h3>

```
cp .env.example .env
```

<h3>Alterar as variáveis do banco de dados</h3>

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_api
DB_USERNAME=root
DB_PASSWORD=root
```

<h3>Executar os containers</h3>

```
docker-compose up -d
```

<h3>Acessar o container da aplicação</h3>

```
docker-compose exec app bash
```

<h3>Instalar as dependências do projeto</h3>

```
composer install
```

<h3>Gerar a chave do projeto</h3>

```
php artisan key:generate
```

<h3>Executar as migrations</h3>

```
php artisan migrate
```

<h3>Executar as seeders</h3>

```
php artisan db:seed
```

<h3>Projeto disponível através do link:</h3>

```
http://localhost:8989/
```

<h2>👤 Usuário</h2>
<p>Para acessar as rotas da API, é necessário fazer uma requisição para <a href="http://localhost:8989/api/login">http://localhost:8989/api/login</a>, informando o e-mail e a senha. Em resposta, será fornecido um token que deverá ser enviado em todas as requisições subsequentes.</p>

```
E-mail: usuario@teste.com.br
Senha: password
```

<h2>👩🏻‍💻 Testes</h2>
<p>Para execução dos testes, na raíz da pasta api-laravel-1, execute o seguinte comando:</p>

```
php artisan test
```

<h2>💻 Tecnologias utilizadas</h2>
<ul>
    <li><a href="https://laravel.com/">Laravel</a></li>
    <li><a href="https://www.docker.com/">Docker</a></li>
    <li><a href="https://www.mysql.com/">MySQL</a></li>
    <li><a href="https://phpunit.de/">PHP Unit</a></li>
    <li><a href="https://git-scm.com/">Git</a></li>
</ul>
