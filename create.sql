# Movie

CREATE TABLE Movie (
	id INT PRIMARY KEY,
	title VARCHAR(100),
	year INT,
	rating VARCHAR(10),
	company VARCHAR(50)
) ENGINE=INNODB;


# Actor

CREATE TABLE Actor (
	id INT PRIMARY KEY,
	last VARCHAR(20),
	first VARCHAR(20),
	sex VARCHAR(6),
	dob DATE,
	dod DATE
) ENGINE=INNODB;


# Sales

CREATE TABLE Sales (
	mid INT,
	ticketsSold INT,
	totalIncome INT,
	FOREIGN KEY (mid) references Movie(id),
	CHECK(ticketsSold >= 0)
) ENGINE=INNODB;


# Director

CREATE TABLE Director (
	id INT PRIMARY KEY,
	last VARCHAR(20),
	first VARCHAR(20),
	dob DATE,
	dod DATE
) ENGINE=INNODB;


# MovieGenre

CREATE TABLE MovieGenre (
	mid INT,
	genre VARCHAR(20),
	FOREIGN KEY (mid) references Movie(id)
) ENGINE=INNODB;


# MovieDirector

CREATE TABLE MovieDirector (
	mid INT,
	did INT,
	FOREIGN KEY (mid) references Movie(id),
	FOREIGN KEY (did) references Director(id)
) ENGINE=INNODB;


# MovieActor

CREATE TABLE MovieActor (
	mid INT,
	aid INT,
	role VARCHAR(50),
	FOREIGN KEY (mid) references Movie(id),
	FOREIGN KEY (aid) references Actor(id)
) ENGINE=INNODB;


# MovieRating

CREATE TABLE MovieRating (
	mid INT,
	imdb INT,
	rot INT,
	FOREIGN KEY (mid) references Movie(id),
	CHECK(imdb >= 0 AND imdb <= 100 AND rot >= 0 AND rot <= 100)
) ENGINE=INNODB;


# Review

CREATE TABLE Review (
	name VARCHAR(20),
	time TIMESTAMP,
	mid INT PRIMARY KEY,
	rating INT,
	comment VARCHAR(500),
	FOREIGN KEY (mid) references Movie(id)
) ENGINE=INNODB;


# MaxPersonID

CREATE TABLE MaxPersonID (
	id INT PRIMARY KEY
) ENGINE=INNODB;


# MaxMovieID

CREATE TABLE MaxMovieID (
	id INT PRIMARY KEY
) ENGINE=INNODB;
