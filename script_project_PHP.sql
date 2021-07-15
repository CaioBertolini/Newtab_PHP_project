create database newtab_PHP_project;

use newtab_PHP_project;

create table cliente(
	id int auto_increment not null,
    primary key(id),
    nome_cliente varchar(255) not null,
    cpf bigint not null,
    email varchar(255) not null,
    data_cliente datetime default CURRENT_TIMESTAMP,
    data_delecao datetime,
);

CREATE UNIQUE INDEX cliente_id ON cliente(id);
CREATE INDEX cliente_nome ON cliente(nome_cliente);
CREATE INDEX cliente_cpf ON cliente(cpf);
CREATE INDEX cliente_email ON cliente(email);

create table produto (
	id int auto_increment not null,
    primary key(id),
    cod_barras varchar(50) not null,
    nome_produto varchar(255) not null,
    valor_produto float(12,2) not null,
    data_cadastro datetime default current_timestamp,
    data_delecao datetime
);

CREATE UNIQUE INDEX produto_id ON produto(id);
CREATE INDEX produto_cod ON produto(cod_barras);
CREATE INDEX produto_nome ON produto(nome_produto);
CREATE INDEX produto_valor ON produto(valor_produto);

create table pedido (
	num_pedido int auto_increment not null,
    primary key(num_pedido),
    id_cliente int,
    foreign key(id_cliente) references cliente(id),
    id_produto int,
    foreign key(id_produto) references produto(id),
    quantidade int not null,
    status_pedido enum('Aberto','Pago','Cancelado') not null,
    data_pedidos datetime default CURRENT_TIMESTAMP,
    data_delecao datetime
);

CREATE UNIQUE INDEX pedido_num ON pedido(num_pedido);
CREATE INDEX pedido_cliente ON pedido(id_cliente);
CREATE INDEX pedido_produto ON pedido(id_produto);

ALTER TABLE pedido ADD COLUMN data_delecao datetime;

insert into cliente(nome_cliente, cpf, email) values ("Caio",43123435612,"caio@bol.com");

insert into produto(cod_barras ,nome_produto, valor_produto) values (454543543543,"Tenis puma", 250.33);

insert into pedido(id_cliente, id_produto, quantidade, status_pedido) values (4,4,2,"Cancelado");

select * from pedido;

UPDATE cliente SET data_delecao=null WHERE id = 4;
