#[3/2/2014 8:49:10 PM] Dmitrij: table threads(threadID,cathegory,title,op,numPosts,timestamp,locked,sticky)
#[3/2/2014 8:49:37 PM] Dmitrij: table posts(threadID,postSucc,poster,message,time)
#[3/2/2014 8:50:21 PM] Dmitrij: table users(username,password,group,avatar,signature,postcount)


#Clear existing database
DROP database projForum;
CREATE database projForum;
use projForum;


#Create new ones

CREATE TABLE categories (
	id int UNIQUE NOT NULL AUTO_INCREMENT,
	name varchar(64),
	numthreads int,
	PRIMARY KEY (id)
);

CREATE TABLE users (
	username varchar(64) NOT NULL,
	password varchar(64) NOT NULL,
	salt varchar(3) NOT NULL,
	admin varchar(64) NOT NULL,
	#group varchar(64) NOT NULL,
	#admin int DEFAULT 0,
	avatar varchar(64),
	signature varchar(256),
	postcount int NOT NULL,
	PRIMARY KEY (username)
);

CREATE TABLE threads (
	threadID int NOT NULL AUTO_INCREMENT,
	#category varchar(64),
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

CREATE TABLE posts (
	threadID int NOT NULL,
	postSucc int NOT NULL,
	poster varchar(64),
	message text,
	timestamp datetime,
	PRIMARY KEY (threadID,postSucc),
	FOREIGN KEY (threadID) REFERENCES threads(threadID)
);

CREATE TABLE savedmessages (
	username varchar(64) NOT NULL,
	category int,
	title varchar(128),
	message1 text,
	threadID int,
	message2 text,
	PRIMARY KEY (username), 
	FOREIGN KEY (username) REFERENCES users(username)
);




#Create Triggers

DELIMITER |

CREATE TRIGGER newThread AFTER INSERT ON threads
	FOR EACH ROW BEGIN
		UPDATE categories SET numThreads = numThreads+1 WHERE id = NEW.category;
		UPDATE savedmessages SET category = NULL, title = NULL, message1 = NULL WHERE username = NEW.op AND category = NEW.category;
	END
|

CREATE TRIGGER threadDeleted AFTER DELETE ON threads
	FOR EACH ROW BEGIN
		UPDATE categories SET numThreads = numThreads-1 WHERE id = OLD.category;
	END;
|


CREATE TRIGGER newPost AFTER INSERT ON posts
	FOR EACH ROW BEGIN
		UPDATE threads SET numPosts = numPosts+1, timestamp = NOW() WHERE threadID = NEW.threadID;
		UPDATE users SET postCount = postCount+1 WHERE users.username = NEW.poster;
		UPDATE savedmessages SET threadID = NULL, message2 = NULL WHERE username = NEW.poster AND threadID = NEW.threadID;
	END;
|

CREATE TRIGGER postDeleted AFTER DELETE ON posts
	FOR EACH ROW BEGIN
		UPDATE threads SET numPosts = numPosts-1 WHERE threadID = OLD.threadID;
	END;
|

CREATE TRIGGER initSavedmsg AFTER INSERT ON users
	FOR EACH ROW BEGIN
		INSERT INTO savedmessages VALUES (NEW.username, NULL, NULL, NULL, NULL, NULL);
	END;
|


DELIMITER ;

CREATE TABLE savedmessages (
	username varchar(64) NOT NULL,
	category int,
	title varchar(128),
	message1 text,
	threadID int,
	message2 text,
	PRIMARY KEY (username), 
	FOREIGN KEY (username) REFERENCES users(username)
);




INSERT INTO categories
VALUES (NULL, 'Blueberries', 0);

INSERT INTO categories
VALUES (NULL, 'Comfortable furniture', 0);

INSERT INTO categories
VALUES (NULL, 'Laser cannons specifically designed for highly humid conditions', 0);


SET @salt = SUBSTRING(MD5(RAND()) FROM 1 FOR 3);
SET @encrypted_password = MD5(CONCAT(MD5('admin'), @salt));

INSERT INTO users
VALUES ('admin', @encrypted_password, @salt, 'administrator', 'admin.png', 'I am the administrator.', 0);


#Insert initial threads. Initialize postCount to 0 due to triggers.

INSERT INTO threads
VALUES (1, 1, 'Important information! (locked sticky)', 'admin', 0, NOW(), true, true);

INSERT INTO threads
VALUES (2, 1, 'TIL sky is blue (non-locked-nonsticky)', 'admin', 0, NOW(), false, false);

INSERT INTO threads
VALUES (3, 3, 'locked non-sticky', 'admin', 0, NOW(), true, false);

INSERT INTO threads
VALUES (4, 2, 'Non-locked sticky', 'admin', 0, NOW(), false, true);

INSERT INTO posts
VALUES (1, 1, 'admin', 'There is only one rule... are you ready? Here it is: There are no rules! GO! Start posting!', NOW());

INSERT INTO posts
VALUES (2, 1, 'admin', 'I live in London...', NOW());

INSERT INTO posts
VALUES (2, 2, 'admin', 'Thahahahaha good one', NOW());

INSERT INTO posts
VALUES (3, 1, 'admin', 'BATMAN', NOW());

INSERT INTO posts
VALUES (4, 1, 'admin', 'testtsettest', NOW());




