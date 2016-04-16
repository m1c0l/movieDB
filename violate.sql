# Primary key constraints

# These insert statements duplicate all records in the table, so each id would
# be in the table twice. However, there cannot be duplicates of a primary key,
# so the statements violate the constraint. These statements assume that each
# table is not empty.

INSERT INTO Movie (SELECT * FROM Movie);
INSERT INTO Actor (SELECT * FROM Actor);
INSERT INTO Director (SELECT * FROM Director);



# Referential integrity constraints

# These insert statements attempt to put values in a foreign key attribute that
# do not exists in the referenced table, which is a violation.

# Cannot delete movies that are referenced by other tables' foreign keys
DELETE FROM Movie WHERE id IN (SELECT mid FROM Sales);
DELETE FROM Movie WHERE id IN (SELECT mid FROM MovieGenre);
# MaxPersonID and MaxMovieID are the next available id, so they do not exist as
# entries in the respective tables
INSERT INTO MovieDirector SELECT id, NULL FROM MaxMovieID;
INSERT INTO MovieDirector SELECT NULL, id FROM MaxPersonID;
UPDATE MovieActor SET mid = (SELECT id FROM MaxMovieID);
UPDATE MovieActor SET did = (SELECT id FROM MaxPersonID);
INSERT INTO MovieRating SELECT id, NULL, NULL FROM MaxMovieID;
INSERT INTO Review SELECT NULL, NULL, id, NULL, NULL FROM MaxMovieID;



# CHECK constraints

# Actors and Directors must have a birth date before their death date
INSERT INTO Actor SELECT id, NULL, NULL, NULL, '2000-01-01', '1970-01-01' FROM MaxPersonID;
UPDATE Director SET dod = dob - 1; # sets dod to one day before dob

# The number of tickets sold must be nonnegative
INSERT INTO Sales SELECT id, -1, 0 FROM Movie LIMIT 1;

# Ratings must be on a 0 to 100 scale
INSERT INTO MovieRating SELECT id, 200, NULL FROM Movie LIMIT 1;
INSERT INTO MovieRating SELECT id, NULL, -40 FROM Movie LIMIT 1;
UPDATE Review SET rating = rating + 1000;
