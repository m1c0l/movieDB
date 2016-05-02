# Movie

CREATE TABLE Movie (
	id INT,
	title VARCHAR(100),
	year INT,
	rating VARCHAR(10),
	company VARCHAR(50),
  PRIMARY KEY(id) # each Movie has a unique ID
) ENGINE=INNODB;


# Actor

CREATE TABLE Actor (
	id INT,
	last VARCHAR(20),
	first VARCHAR(20),
	sex VARCHAR(6),
	dob DATE,
	dod DATE,
  PRIMARY KEY(id), # each Actor has a unique ID
  CHECK(dod IS NULL OR dob < dod) # either still alive, or died after birth
) ENGINE=INNODB;


# Sales

CREATE TABLE Sales (
	mid INT,
	ticketsSold INT,
	totalIncome INT,
	FOREIGN KEY (mid) references Movie(id), # mid must exist in Movie
	CHECK(ticketsSold >= 0) # number of tickets sold is nonnegative
) ENGINE=INNODB;


# Director

CREATE TABLE Director (
	id INT,
	last VARCHAR(20),
	first VARCHAR(20),
	dob DATE,
	dod DATE,
  PRIMARY KEY(id), # each Director has a unique ID
  CHECK(dod IS NULL OR dob < dod) # either still alive, or died after birth
) ENGINE=INNODB;


# MovieGenre

CREATE TABLE MovieGenre (
	mid INT,
	genre VARCHAR(20),
	FOREIGN KEY (mid) references Movie(id) # mid must exist in Movie
) ENGINE=INNODB;


# MovieDirector

CREATE TABLE MovieDirector (
	mid INT,
	did INT,
	FOREIGN KEY (mid) references Movie(id), # mid must exist in Movie
	FOREIGN KEY (did) references Director(id) # did must exist in Director
) ENGINE=INNODB;


# MovieActor

CREATE TABLE MovieActor (
	mid INT,
	aid INT,
	role VARCHAR(50),
	FOREIGN KEY (mid) references Movie(id), # mid must exist in Movie
	FOREIGN KEY (aid) references Actor(id) # aid must exist in Actor
) ENGINE=INNODB;


# MovieRating

CREATE TABLE MovieRating (
	mid INT,
	imdb INT,
	rot INT,
	FOREIGN KEY (mid) references Movie(id), # mid must exist in Movie
	CHECK(imdb >= 0 AND imdb <= 100 AND
        rot >= 0 AND rot <= 100) # rating scale is 0-100
) ENGINE=INNODB;


# Review

CREATE TABLE Review (
	name VARCHAR(20),
	time TIMESTAMP,
	mid INT,
	rating INT,
	comment VARCHAR(500),
	FOREIGN KEY (mid) references Movie(id), # mid must exist in Movie
  CHECK(rating >= 0 AND rating <= 100) # rating scale is 0-100
) ENGINE=INNODB;


# MaxPersonID

CREATE TABLE MaxPersonID (
	id INT PRIMARY KEY
) ENGINE=INNODB;


# MaxMovieID

CREATE TABLE MaxMovieID (
	id INT PRIMARY KEY
) ENGINE=INNODB;
