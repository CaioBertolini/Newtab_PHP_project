create database newtab_PHP_project;

use newtab_PHP_project;

create table tabela_velha(
	NumeroPedido int not null,
    NomeCliente varchar(100) not null,
    CPF char(11) not null,
    Email varchar(255),
    DtPedido datetime default CURRENT_TIMESTAMP,
    CodBarras varchar(20) not null,
    NomeProduto varchar(100),
    ValorUnitario float(12,2) not null,
    Quantidade int not null
);

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

desc tabela_velha;

CREATE UNIQUE INDEX pedido_num ON pedido(num_pedido);
CREATE INDEX pedido_cliente ON pedido(id_cliente);
CREATE INDEX pedido_produto ON pedido(id_produto);

ALTER TABLE pedido ADD COLUMN data_delecao datetime;

insert into cliente(nome_cliente, cpf, email) values ("Caio",43123435612,"caio@bol.com");

insert into produto(cod_barras ,nome_produto, valor_produto) values (454543543543,"Tenis puma", 250.33);

insert into pedido(id_cliente, id_produto, quantidade, status_pedido) values (4,4,2,"Cancelado");

insert into tabela_velha(NumeroPedido, NomeCliente, CPF, Email, CodBarras, NomeProduto, ValorUnitario, Quantidade)
values (15,"Pedro","33423456412","pedro@gmail.com","321321321123","Tenis Nike",123.12,1);

select distinct * from tabela_velha;

UPDATE pedido SET data_delecao=null WHERE num_pedido = 5;

DELETE FROM cliente;

SELECT pedido.num_pedido, cliente.nome_cliente, produto.id, pedido.quantidade, pedido.status_pedido
FROM pedido 
INNER JOIN cliente ON pedido.id_cliente = cliente.id
INNER JOIN produto ON pedido.id_produto = produto.id
WHERE pedido.data_delecao IS NULL;

SELECT tabela_velha.NumeroPedido, cliente.id AS id_cliente, produto.id AS id_produto, tabela_velha.Quantidade
FROM tabela_velha 
INNER JOIN cliente ON tabela_velha.NomeCliente = cliente.nome_cliente
INNER JOIN produto ON tabela_velha.NomeProduto = produto.nome_produto;
