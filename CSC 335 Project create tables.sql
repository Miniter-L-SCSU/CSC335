/*
show databases;
create database shop;
use shop;
show tables;
*/

#drop table User;
create table User (
user_id int NOT NULL auto_increment,
username varchar(20) NOT NULL,
password varchar(20) NOT NULL,
f_name varchar(20) NOT NULL,
l_name varchar(20) NOT NULL,
m_name varchar(2) NOT NULL DEFAULT '',
email varchar(40) NOT NULL DEFAULT '',
member_type varchar(20) NOT NULL DEFAULT 'Standard',
created_time datetime DEFAULT CURRENT_TIMESTAMP,
last_update timestamp DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
primary key (user_id),
unique(username)
);

#drop table Item;
create table Item (
item_id int NOT NULL auto_increment,
item_name varchar(20) NOT NULL,
item_desc varchar(80) NOT NULL DEFAULT '',
category varchar(20) NOT NULL DEFAULT '',
price numeric(12,2) NOT NULL DEFAULT 0,
status varchar(1) NOT NULL DEFAULT 'A',
available_quantity int NOT NULL DEFAULT 0,
actual_quantity int NOT NULL DEFAULT 0,
manufacturer varchar(20) NOT NULL DEFAULT '',
weight numeric(12,2) NOT NULL DEFAULT 0,
size numeric(12,2) NOT NULL DEFAULT 0,
file_name varchar(40) NOT NULL DEFAULT 'test.png',
created_time datetime DEFAULT CURRENT_TIMESTAMP,
last_update timestamp DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
primary key (item_id)
);

#drop table ShipAddr;
create table ShipAddr (
user_id int NOT NULL,
ship_seq int NOT null,
street varchar(20) NOT NULL,
appt varchar(20) NOT NULL DEFAULT '',
city varchar(20) NOT NULL,
state varchar(2) NOT NULL,
zip varchar(11) NOT NULL,
created_time datetime DEFAULT CURRENT_TIMESTAMP,
last_update timestamp DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
primary key (user_id, ship_seq),
foreign key (user_id) references User(user_id)
);

#drop table BillAddr;
create table BillAddr (
user_id int NOT NULL,
bill_seq int NOT null,
street varchar(20) NOT NULL,
appt varchar(20) NOT NULL DEFAULT '',
city varchar(20) NOT NULL,
state varchar(2) NOT NULL,
zip varchar(11) NOT NULL,
created_time datetime DEFAULT CURRENT_TIMESTAMP,
last_update timestamp DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
primary key (user_id, bill_seq),
foreign key (user_id) references User(user_id)
);

#drop table Payment;
create table Payment (
pay_id int NOT NULL auto_increment,
user_id int NOT NULL,
card_name varchar(20) NOT NULL,
card_num varchar(20) NOT NULL,
exp_date date NOT NULL,
created_time datetime DEFAULT CURRENT_TIMESTAMP,
last_update timestamp DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
primary key (pay_id),
foreign key (user_id) references User(user_id)
);

#drop table Cart;
create table Cart (
user_id int NOT NULL,
item_id int NOT NULL,
quantity int NOT NULL DEFAULT 1,
created_time datetime DEFAULT CURRENT_TIMESTAMP,
last_update timestamp DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
primary key (user_id, item_id),
foreign key (user_id) references User(user_id),
foreign key (item_id) references Item(item_id)
);

#drop table Orders;
create table Orders (
order_id int NOT NULL,
user_id int NOT NULL,
status varchar(10) NOT NULL DEFAULT 'in prog',
delivery_time datetime DEFAULT (DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 DAY)),
created_time datetime DEFAULT CURRENT_TIMESTAMP,
last_update timestamp DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
ship_seq int NOT NULL,
bill_seq int NOT NULL,
pay_id int NOT NULL,
primary key (order_id),
foreign key (user_id) references User(user_id),
foreign key (user_id, ship_seq) references ShipAddr(user_id, ship_seq),
foreign key (user_id, bill_seq) references BillAddr(user_id, bill_seq),
foreign key (pay_id) references Payment(pay_id)
);

#drop table Ordered;
create table Ordered (
item_id int NOT NULL,
order_id int NOT NULL,
quantity int NOT NULL DEFAULT 1,
last_update timestamp DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
primary key (item_id, order_id),
foreign key (item_id) references Item(item_id),
foreign key (order_id) references Orders(order_id)
);

/*
drop table Ordered;
drop table Orders;
drop table Cart;
drop table ShipAddr;
drop table BillAddr;
drop table Payment;
drop table Item;
drop table User;

insert into user (username, f_name, l_name, m_name, password) values ('TEST_User', 'John','Smith','H','1234');
select * from user;
*/