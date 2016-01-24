
Create database tomate_efood;
use tomate_efood;

create table personas(
  id_personas varchar (20) not null primary key,
  cedula      varchar (10),
  nombres     varchar (25),
  ape_pat     varchar (25),
  ape_mat     varchar (25),
  direccion   varchar (50),
  telefono    int (10)
);

create table clientes(
  id_clientes varchar (20) not null primary key,
  id_personas varchar (20),
  foreign key(id_personas) references personas(id_personas)
) ;

create table empleados(
  id_clientes varchar (20) not null primary key,
  id_empleados varchar (20),
  foreign key(id_empleados) references personas(id_personas)
);

create table usuarios{
  id_usuario     int not null auto_increment primary key,
  nombre_usuario varchar(15),
  clave          varchar(15),
  privilegio     varchar(10),
  id_personas    varchar(20),
  foreign key(id_personas) references personas(id_personas)
  };
  