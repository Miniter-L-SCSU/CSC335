

insert into User (username, f_name, l_name, m_name, password) values 
('User1', 'John','Smith','H','1234'),
('User2', 'Don','Carl','R','1234'),
('User3', 'Sara','White','G','1234'),
('User4', 'Alex','Cru','W','1234'),
('User5', 'Rishi','Vinnie','M','1234'),
('User6', 'Clio','Elias','H','1234'),
('User7', 'Shou','Nicolas','O','1234'),
('User8', 'Herenui','Suk','P','1234'),
('User9', 'Isiah','Khadija','H','1234')
;
#select * from User;

insert into Item (item_name, price, category, manufacturer) values 
("USB-c cable", 12.99, "Tech Accessories", "Samsung"),
("Tool set", 26.99, "Tools", "KOBALT"),
("Watch", 100.00, "Accessories", "OverPriced Watches");
#select * from Item;

insert into BillAddr (user_id, bill_seq, street, city, state, zip) values 
(1, 1, "11th Blake st.", "New Haven", "CT", "06515"),
(2, 1, "12th Blake st.", "New Haven", "CT", "06515"),
(3, 1, "13th Blake st.", "New Haven", "CT", "06515");
#select * from BillAddr;

insert into ShipAddr (user_id, ship_seq, street, city, state, zip) values 
(1, 1, "11th Blake st.", "New Haven", "CT", "06515"),
(1, 2, "PO box 12345", "New Haven", "CT", "06515"),
(2, 1, "12th Blake st.", "New Haven", "CT", "06515"),
(3, 1, "13th Blake st.", "New Haven", "CT", "06515");
#select * from shipAddr;

insert into Payment (user_id, card_name, card_num, exp_date) values 
(1, 'John H Smith', '1111-2222-3333-4444', '2027/11/1'),
(2, 'Don R Carl', '2222-3333-4444-5555', '2027/11/1'),
(3, 'Sara G White', '3333-4444-5555-6666', '2027/11/1');
#select * from Payment;
#delete from Payment;
