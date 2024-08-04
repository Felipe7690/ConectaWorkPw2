create database ConectaWork;

use ConectaWork;

create table usuarios (
    id_usuario int auto_increment primary key,
    nome varchar(255) not null,
    email varchar(100) not null unique,
    senha varchar(50) not null
);

create table candidatos (
    id_candidato int auto_increment primary key,
    id_usuario int not null,
    experiencia text,
    habilidades text,
    formacao text,
    foreign key (id_usuario) references usuarios(id_usuario)
);

create table empregadores (
    id_empregador int auto_increment primary key,
    id_usuario int not null,
    empresa varchar(50) not null,
    descricao_empresa text,
    localizacao varchar(100),
    foreign key (id_usuario) references usuarios(id_usuario)
);

create table vagas (
    id_vaga int auto_increment primary key,
    id_empregador int not null,
    titulo varchar(50) not null,
    descricao text not null,
    requisitos text,
    beneficios text,
    localizacao varchar(100),
    data_publicacao date not null,
    foreign key (id_empregador) references empregadores(id_empregador)
);

create table candidaturas (
    id_candidatura int auto_increment primary key,
    id_vaga int not null,
    id_candidato int not null,
    data_candidatura date not null,
    status varchar(50) default 'em análise',
    foreign key (id_vaga) references vagas(id_vaga),
    foreign key (id_candidato) references candidatos(id_candidato)
);
