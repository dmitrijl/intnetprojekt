-- [3/2/2014 8:49:10 PM] Dmitrij: table threads(threadID,cathegory,title,op,numPosts,timestamp,locked,sticky)
-- [3/2/2014 8:49:37 PM] Dmitrij: table posts(threadID,postSucc,poster,message,time)
-- [3/2/2014 8:50:21 PM] Dmitrij: table users(username,password,group,avatar,signature,postcount)


-- Clear existing database
drop database projForum;
create database projForum;
use projForum;




-- Create new ones

create table categories (
	id int UNIQUE NOT NULL AUTO_INCREMENT,
	name varchar(64),
	numthreads int,
	PRIMARY KEY (id)
);

create table users (
	username varchar(64) NOT NULL,
	password varchar(64) NOT NULL,
	salt varchar(3) NOT NULL,
	admin varchar(64) NOT NULL,
	-- group varchar(64) NOT NULL,
	-- admin int DEFAULT 0,
	avatar varchar(64),
	signature varchar(256),
	postcount int NOT NULL,
	PRIMARY KEY (username)
);

create table threads (
	threadID int NOT NULL AUTO_INCREMENT,
	-- category varchar(64),
	category int NOT NULL,
	title varchar(128) NOT NULL,
	op varchar(64) NOT NULL,
	numPosts int NOT NULL,
	timestamp datetime,
	locked boolean,
	sticky boolean,
	PRIMARY KEY (threadID),
	FOREIGN KEY (category) REFERENCES categories(id),
	FOREIGN KEY (op) REFERENCES users(username)
);

create table posts (
	threadID int NOT NULL,
	postSucc int NOT NULL,
	poster varchar(64),
	message text,
	timestamp datetime,
	PRIMARY KEY (threadID,postSucc),
	FOREIGN KEY (threadID) REFERENCES threads(threadID)
);


insert into categories
values (NULL, 'Blueberries', 0);

insert into categories
values (NULL, 'Comfortable furniture', 0);

insert into categories
values (NULL, 'Laser cannons specifically designed for highly humid conditions', 0);


SET @salt = SUBSTRING(MD5(RAND()) FROM 1 FOR 3);
SET @encrypted_password = MD5(CONCAT(MD5('admin'), @salt));

insert into users
values ('admin', @encrypted_password, @salt, 'administrator', 'admin.png', 'I am the administrator.', 0);


insert into threads
values (1, 1, 'Important information! (locked sticky)', 'admin', 1, NOW(), true, true);

insert into threads
values (2, 1, 'TIL sky is blue (non-locked-nonsticky)', 'admin', 2, NOW(), false, false);

insert into threads
values (3, 1, 'locked non-sticky', 'admin', 1, NOW(), true, false);

insert into threads
values (4, 1, 'Non-locked sticky', 'admin', 1, NOW(), false, true);

insert into posts
values (1, 1, 'admin', 'There is only one rule... are you ready? Here it is: There are no rules! GO! Start posting!', NOW());

insert into posts
values (2, 1, 'admin', 'I live in London...', NOW());

insert into posts
values (2, 2, 'admin', 'Thahahahaha good one', NOW());

insert into posts
values (3, 1, 'admin', 'BATMAN', NOW());

insert into posts
values (4, 1, 'admin', 'testtsettest', NOW());




