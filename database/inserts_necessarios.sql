INSERT INTO tipo_despesa (tipo) VALUES ('Fixa');
INSERT INTO tipo_despesa (tipo) VALUES ('Esporádico');

INSERT INTO usuario (usuario, senha, nome, nome_mae, cpf, email, telefone_celular, data_criacao)
VALUES (
	'henrick',
	'senha123',
	'Henrick Santiago',
	'Mãe Teste',
	'38138291955',
	'henrick@mail.com',
	'15996432007',
	current_date
);

INSERT INTO usuario (usuario, senha, nome, nome_mae, cpf, email, telefone_celular, data_criacao)
VALUES (
	'alex',
	'senha123',
	'Alexandre de Sousa Vieira',
	'Mãe Teste2',
	'00000000000',
	'alex@mail.com',
	'42999999999',
	current_date
);