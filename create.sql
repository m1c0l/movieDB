# Movie

CREATE TABLE Movie (
	id INT PRIMARY KEY,
	title VARCHAR(100),
	year INT,
	rating VARCHAR(10),
	company VARCHAR(50)
);


# Actor

CREATE TABLE Actor (
	id INT PRIMARY KEY,
	last VARCHAR(20),
	first VARCHAR(20),
	sex VARCHAR(6),
	dob DATE,
	dod DATE
);


# Sales

CREATE TABLE Sales (
	mid INT PRIMARY KEY,
	ticketsSold INT,
	totalIncome INT
);


# Director

CREATE TABLE Director (
	id INT PRIMARY KEY,
	last VARCHAR(20),
	first VARCHAR(20),
	dob DATE,
	dod DATE
);


# MovieGenre

CREATE TABLE MovieGenre (
	mid INT,
	genre VARCHAR(20)
);


# MovieDirector

CREATE TABLE MovieDirector (
	mid INT,
	did INT
);


# MovieActor

CREATE TABLE MovieActor (
	mid INT,
	aid INT,
	role VARCHAR(50)
);


# MovieRating

CREATE TABLE MovieRating (
	mid INT,
	imdb INT,
	rot INT
);


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


# MaxMovieID

CREATE TABLE MaxMovieID (
	id INT PRIMARY KEY
);
