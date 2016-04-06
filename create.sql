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
