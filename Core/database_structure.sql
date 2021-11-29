create database usalva;
use usalva;
create table admins(
	id varchar(256) not null primary key,
    admin_name varchar(30) not null,
    admin_password varchar(256) not null,
    record_date date,
    record_time time
);
create table investments(
	id varchar(256) not null primary key,
    investment_name varchar(100) not null,
    record_date date,
    record_time time,
    color varchar(50),
    admin_id varchar(256) not null,
    currency double,
    foreign key (admin_id) references admins(id)
);
create table users(
	id varchar(256) not null primary key,
    user_name varchar(100) not null,
    email varchar(100) not null,
    phone varchar(14),
    user_password varchar(256) not null,
    sponsor varchar(256) not null,
    side varchar(20) not null,
    status tinyint not null default 0,
    record_date date,
    record_time time,
    accountStatus tinyint not null default 0    
);