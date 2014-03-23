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