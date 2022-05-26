# econo.me
Integrantes:

	Alexandre de Souza Vieira RA 1488880
	
	Henrick Bueno Santiago RA 2164426

---BANCO DE DADOS------------------------

Criar um banco de dados Postgres no seu localhost com o nome 'econome' e rodar os comandos de CREATE TABLE do arquivo 'script_bd.sql' encontrado na pasta 'database' na raiz do projeto.

Posterior a criação das tabelas... Rodar os comandos de INSERT do arquivo 'inserts_necessarios.sql' também encontrado na pasta 'database' na raiz do projeto.

(Os INSERTS servem para ter alguns dados que possam ser utilizados no sistema).

Por último, garantir que o arquivo de 'conexao.php' dentro da pasta 'backend/conexao' está com usuário e senha do servidor local configurado corretamente.

---BACKEND-------------------------------

Necessário a configuração de um Virtual Host
Em:  C:\xampp\apache\conf\extra\httpd-vhosts.conf
Adicionar as linhas abaixo ao final do arquivo

	<VirtualHost *:80>
		DocumentRoot "C:\xampp\htdocs\econo.me"
		ServerName econo.me
		<Directory "C:\xampp\htdocs\econo.me">
		</Directory>
	</VirtualHost>

Deve-se adicionar também no arquivo C:\Windows\System32\drivers\etc\hosts a linha:
127.0.0.1 econo.me

IMPORTANTE!

Essa configuração de backend não precisa ser necessariamente feita para ter o endereço http://econo.me.
Basta o apontamento para a pasta do projeto estar correto e alteração da baseUrl em axios.js em frontend/src.

Utilizando o terminal na pasta do projeto dar os comandos:
cd backend
composer install

---FRONTEND------------------------------

Se a configuração da API está feita, basta roda os comandos para a execução do projeto:

cd frontend

npm i

npm run serve

---LOGIN---------------------------------

Pode usar o Login: 'henrick' ou 'alex' com a senha 'senha123' ou o do próprio usuário criado no cadastro de usuário.

---RECUPERAÇÃO DE SENHA------------------

Para se testar a funcionalidade deve ser criado um novo usuário no cadastro de usuário com um E-MAIL válido para o recebimento da nova senha.
