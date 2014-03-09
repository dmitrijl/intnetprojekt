use projForum; # Byt till din egen

#[3/2/2014 8:49:10 PM] Dmitrij: table threads(threadID,cathegory,title,op,numPosts,timestamp,locked,sticky)
#[3/2/2014 8:49:37 PM] Dmitrij: table posts(threadID,postSucc,poster,message,time)
#[3/2/2014 8:50:21 PM] Dmitrij: table users(username,password,group,avatar,signature,postcount)

drop table users; # Radera om redan finns
drop table threads;
drop table posts;

create table users (
    username varchar(64) NOT NULL,
	password varchar(64) NOT NULL,
	group varchar(64) NOT NULL,
	avatar varchar(64),
	signature varchar(256),
	postcount int NOT NULL,
	PRIMARY KEY (username)
);

create table threads (
	threadID int NOT NULL AUTO_INCREMENT,
    category varchar(64),
	title varchar(128) NOT NULL,
    op varchar(64) NOT NULL,
	numPosts int NOT NULL,
    timestamp datetime,
    locked boolean,
    sticky boolean,
	PRIMARY KEY (threadID)
);

create table posts (
	threadID int NOT NULL,
    postSucc int NOT NULL,
    poster varchar(64),
    message text,
    timestamp datetime,
	PRIMARY KEY (threadID,postSucc)
);

create table categories (
	id int NOT NULL AUTO_INCREMENT,
	name varchar(64),
	numthreads int
);
