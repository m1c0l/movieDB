# Movie table

CREATE TABLE Movie (
	id INT PRIMARY KEY,
	title VARCHAR(100),
	year INT,
	rating VARCHAR(10),
	company VARCHAR(50)
);

LOAD DATA LOCAL INFILE '~/data/movie.del' INTO TABLE Movie
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';


# Actor

CREATE TABLE Actor (
	id INT PRIMARY KEY,
	last VARCHAR(20),
	first VARCHAR(20),
	sex VARCHAR(6),
	dob DATE,
	dod DATE
);

LOAD DATA LOCAL INFILE '~/data/actor1.del' INTO TABLE Actor
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE '~/data/actor2.del' INTO TABLE Actor
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE '~/data/actor3.del' INTO TABLE Actor
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';


# Sales

CREATE TABLE Sales (
	mid INT PRIMARY KEY,
	ticketsSold INT,
	totalIncome INT
);

LOAD DATA LOCAL INFILE '~/data/sales.del' INTO TABLE Sales
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';


# Director

CREATE TABLE Director (
	id INT PRIMARY KEY,
	last VARCHAR(20),
	first VARCHAR(20),
	dob DATE,
	dod DATE
);

LOAD DATA LOCAL INFILE '~/data/director.del' INTO TABLE Director
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';


# MovieGenre

CREATE TABLE MovieGenre (
	mid INT,
	genre VARCHAR(20)
);

LOAD DATA LOCAL INFILE '~/data/moviegenre.del' INTO TABLE MovieGenre
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';


# MovieDirector

CREATE TABLE MovieDirector (
	mid INT,
	did INT
);

LOAD DATA LOCAL INFILE '~/data/moviedirector.del' INTO TABLE MovieDirector
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';


# MovieActor

CREATE TABLE MovieActor (
	mid INT,
	aid INT,
	role VARCHAR(50)
);

LOAD DATA LOCAL INFILE '~/data/movieactor1.del' INTO TABLE MovieActor
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE '~/data/movieactor2.del' INTO TABLE MovieActor
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';


# MovieRating

CREATE TABLE MovieRating (
	mid INT,
	imdb INT,
	rot INT
);

LOAD DATA LOCAL INFILE '~/data/movierating.del' INTO TABLE MovieActor
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';


# Review

CREATE TABLE Review (
	name VARCHAR(20),
	time TIMESTAMP,
	mid INT PRIMARY KEY,
	rating INT,
	comment VARCHAR(500)
);


# MaxPersonID

CREATE TABLE MaxPersonID (
	id INT PRIMARY KEY
);

INSERT INTO MaxPersonID VALUES(69000);


# MaxMovieID

CREATE TABLE MaxMovieID (
	id INT PRIMARY KEY
);

INSERT INTO MaxMovieID VALUES(4750);
