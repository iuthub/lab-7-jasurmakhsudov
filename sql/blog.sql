CREATE TABLE Users(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	username varchar(250),
	email varchar(250),
	password varchar(250),
	fullname varchar(250),
	dob DATE
);

CREATE TABLE Posts(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	title varchar(250),
	body text,
	publishDate DATE,
	userID int,
	FOREIGN KEY (userID) REFERENCES Users(id)
);