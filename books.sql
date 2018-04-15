 drop database books; create database books; use books;

CREATE TABLE author ( 
author_id VARCHAR (200),
name VARCHAR (200),  
constraint pk_author_id PRIMARY KEY (author_id));

CREATE TABLE supplier ( 
sup_id VARCHAR (200), 
name VARCHAR (200), 
rating NUMERIC (3,1), 
CONSTRAINT pk_sup_id PRIMARY KEY (sup_id), 
CONSTRAINT chk_supplier_rating CHECK (rating <= 10.0 and rating >= 0.0));

CREATE TABLE publisher ( 
pub_id VARCHAR (200), 
name VARCHAR (200),  
CONSTRAINT pk_pub_id PRIMARY KEY (pub_id));

CREATE TABLE books ( 
ISBN VARCHAR (200), 
name VARCHAR (200),
language VARCHAR (200), 
ranking INTEGER, 
price FLOAT,  
CONSTRAINT pk_isbn PRIMARY KEY (ISBN));

CREATE TABLE similar (ISBN_1 VARCHAR (200), 
ISBN_2 VARCHAR (200),  
CONSTRAINT pk_similar PRIMARY KEY (ISBN_1,ISBN_2),  
CONSTRAINT fk_similar_isbn_1 FOREIGN KEY (ISBN_1) REFERENCES books (ISBN),  
CONSTRAINT fk_similar_isbn_2 FOREIGN KEY (ISBN_2) REFERENCES books (ISBN));

CREATE TABLE supply (ISBN VARCHAR (200), 
sup_id VARCHAR (200), 
in_out_stock CHAR(1), 
CONSTRAINT pk_supply PRIMARY KEY (ISBN,sup_id), 
CONSTRAINT fk_supply_isbn FOREIGN KEY (ISBN) REFERENCES books (ISBN),  
CONSTRAINT fk_supply_sup_id FOREIGN KEY (sup_id) REFERENCES supplier (sup_id),  
CONSTRAINT chk_in_out_stock CHECK (in_out_stock IN ('Y','N')));

CREATE TABLE authored_by (ISBN VARCHAR (200), 
author_id VARCHAR (200),  
CONSTRAINT pk_authored_by PRIMARY KEY (ISBN,author_id),  
CONSTRAINT fk_authored_by_isbn FOREIGN KEY (ISBN) REFERENCES books (ISBN),  
CONSTRAINT fk_authored_by_author_id FOREIGN KEY (author_id) REFERENCES author (author_id));

CREATE TABLE published_by (ISBN VARCHAR (200), 
pub_id VARCHAR (200), 
CONSTRAINT pk_published_by PRIMARY KEY (ISBN,pub_id), 
CONSTRAINT fk_published_by_isbn FOREIGN KEY (ISBN) REFERENCES books (ISBN),  
CONSTRAINT pk_published_by_pub_id FOREIGN KEY (pub_id) REFERENCES publisher (pub_id));

CREATE TABLE customer (
customer_id VARCHAR (200), 
name VARCHAR (200), 
e_mail VARCHAR (200), 
phone_number BIGINT, 
password VARCHAR (200),  
CONSTRAINT pk_cusotmer_id PRIMARY KEY (customer_id));

CREATE TABLE review (
ISBN VARCHAR (200),
review_date DATE,
review_text VARCHAR (500),
rating NUMERIC(3,1),
CONSTRAINT pk_review PRIMARY KEY (ISBN,review_date,review_text,rating),
CONSTRAINT fk_review_isbn FOREIGN KEY (ISBN) REFERENCES books (ISBN),
CONSTRAINT chk_review_rating CHECK (rating >= 0.0 and rating <= 10.0));

CREATE TABLE buys (
customer_id VARCHAR (200), 
ISBN VARCHAR (200), 
purchase_date DATE, 
purchase_count INTEGER,  
CONSTRAINT pk_buys PRIMARY KEY (customer_id,ISBN,purchase_date,purchase_count),  
CONSTRAINT fk_buys_customer_id FOREIGN KEY (customer_id) REFERENCES customer (customer_id),  
CONSTRAINT fk_buys_isbn FOREIGN KEY (ISBN) REFERENCES books (ISBN));

CREATE TABLE admin (
admin_id VARCHAR (200), 
name VARCHAR (200), 
e_mail VARCHAR (200), 
phone_number BIGINT, 
password VARCHAR (200),  
CONSTRAINT pk_cusotmer_id PRIMARY KEY (admin_id));


INSERT INTO `author`(author_id,name) VALUES ('1', 'Amish Tripathi');
INSERT INTO `author`(author_id,name) VALUES ('2', 'J K Rowling');
INSERT INTO `supplier`(sup_id,name,rating) VALUES ('1', 'Samuel', 4.5);
INSERT INTO `supplier`(sup_id,name,rating) VALUES ('2', 'Jackson', 8.8);
INSERT INTO `publisher`(pub_id,name) VALUES ('1', 'Sun publications');
INSERT INTO `publisher`(pub_id,name) VALUES ('2', 'Ford publications');
INSERT INTO `publisher`(pub_id,name) VALUES ('3', 'Routledge');
INSERT INTO `books`(ISBN,name,language,ranking,price) VALUES ('9781408708989','Fantastic Beasts and Where to Find Them', 'en',1,388.55);
INSERT INTO `books`(ISBN,name,language,ranking,price) VALUES ('9781408869130','Harry Potter and the Prisoner of Azkaban', 'en',4,250.00);
INSERT INTO `similar`(ISBN_1,ISBN_2) VALUES ('9781408708989', '9781408869130');
INSERT INTO `authored_by`(ISBN,author_id) VALUES ('9781408708989','2');
INSERT INTO `authored_by`(ISBN,author_id) VALUES ('9781408869130','2');
INSERT INTO `supply`(ISBN,sup_id,in_out_stock) VALUES ('9781408708989','1','Y');
INSERT INTO `supply`(ISBN,sup_id,in_out_stock) VALUES ('9781408869130','2','Y');
INSERT INTO `published_by`(ISBN,pub_id) VALUES ('9781408708989','3');
INSERT INTO `published_by`(ISBN,pub_id) VALUES ('9781408869130','3');
INSERT INTO `review`(ISBN, review_date, review_text,rating) VALUES('9781408708989',CURDATE(),'A feat of imagination and featuring a cast of remarkable characters and magical creatures, this is epic adventure-packed storytelling at its very best.',6.6);
INSERT INTO `buys`(customer_id,ISBN,purchase_date,purchase_count) VALUES ('tom15','9781408708989',CURDATE(),2);
INSERT INTO `admin`(admin_id,name,e_mail,phone_number,password) VALUES ('1','Safna Hassan','safna@gmail.com',123456789,'safna16');
INSERT INTO `admin`(admin_id,name,e_mail,phone_number,password) VALUES ('safnah','Safna Hassan','safna@gmail.com',123456789,'safna16');




