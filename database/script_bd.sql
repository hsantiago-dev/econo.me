CREATE TABLE usuario (
    id SERIAL PRIMARY KEY,
    usuario VARCHAR(18) UNIQUE NOT NULL,
    nome VARCHAR(150) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    nome_mae VARCHAR(150) NOT NULL,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    telefone_celular VARCHAR(11) NOT NULL,
    data_criacao TIMESTAMP NOT NULL
);

CREATE TABLE grupo (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(18) NOT NULL,
    data_criacao TIMESTAMP NOT NULL
);

CREATE TABLE pix (
    id SERIAL PRIMARY KEY,
    id_usuario INT NOT NULL,
    tipo_chave VARCHAR(20) NOT NULL,
    chave VARCHAR(100) NOT NULL,
    data_criacao TIMESTAMP NOT NULL,
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id)
);

CREATE TABLE usuarios_grupo (
    id_usuario INT NOT NULL,
    id_grupo INT NOT NULL,
    admin BOOLEAN DEFAULT false,
    data_entrada TIMESTAMP NOT NULL,
    PRIMARY KEY (id_usuario, id_grupo),
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id),
    FOREIGN KEY (id_grupo)
        REFERENCES grupo (id)
);

CREATE TABLE tipo_despesa (
    id SERIAL PRIMARY KEY,
    tipo VARCHAR(30) NOT NULL
);

CREATE TABLE despesa (
    id SERIAL PRIMARY KEY,
    admin_despesa INT NOT NULL,
    tipo_despesa INT NOT NULL,
    data_vencimento TIMESTAMP,
    titulo VARCHAR(30) NOT NULL,
    valor_total NUMERIC(15,2) NOT NULL,
    data_criacao TIMESTAMP NOT NULL,
    FOREIGN KEY (admin_despesa)
        REFERENCES usuario (id),
    FOREIGN KEY (tipo_despesa)
        REFERENCES tipo_despesa (id)
);

CREATE TABLE rateio (
    id SERIAL PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_despesa INT NOT NULL,
    data_pagamento TIMESTAMP,
    valor NUMERIC(15,2) NOT NULL,
    confirmacao_pagamento_admin BOOLEAN DEFAULT false,
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id),
    FOREIGN KEY (id_despesa)
        REFERENCES despesa (id)
);

CREATE TABLE periodicidade (
    id SERIAL PRIMARY KEY,
    id_despesa INT NOT NULL,
    tipo_periodicidade VARCHAR(10) NOT NULL,
    dia_referencia INT NOT NULL,
    repetir_ate TIMESTAMP,
    FOREIGN KEY (id_despesa)
        REFERENCES despesa (id)
);