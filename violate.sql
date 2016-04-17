# Primary key constraints

# These insert statements duplicate all records in the table, so each id would
# be in the table twice. However, there cannot be duplicates of a primary key,
# so the statements violate the constraint. These statements assume that each
# table is not empty.

INSERT INTO Movie (SELECT * FROM Movie);
# mysql output: ERROR 1062 (23000): Duplicate entry '2' for key 'PRIMARY'

INSERT INTO Actor (SELECT * FROM Actor);
# mysql output: ERROR 1062 (23000): Duplicate entry '1' for key 'PRIMARY'

INSERT INTO Director (SELECT * FROM Director);
# mysql output: ERROR 1062 (23000): Duplicate entry '16' for key 'PRIMARY'





# Referential integrity constraints

# These insert statements attempt to put values in a foreign key attribute that
# do not exists in the referenced table, which is a violation.

# Cannot delete movies that are referenced by other tables' foreign keys
DELETE FROM Movie WHERE id IN (SELECT mid FROM Sales);
# mysql output: ERROR 1451 (23000): Cannot delete or update a parent row: a
# foreign key constraint fails (`CS143`.`Sales`, CONSTRAINT `Sales_ibfk_1`
# FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

DELETE FROM Movie WHERE id IN (SELECT mid FROM MovieGenre);
# mysql output (the error happens to trigger on the Sales table first): ERROR
# 1451 (23000): Cannot delete or update a parent row: a foreign key constraint
# fails (`CS143`.`Sales`, CONSTRAINT `Sales_ibfk_1` FOREIGN KEY (`mid`)
# REFERENCES `Movie` (`id`))

# MaxPersonID and MaxMovieID are the next available id, so they do not exist as
# entries in the respective tables
INSERT INTO MovieDirector SELECT id, NULL FROM MaxMovieID;
# mysql output: ERROR 1452 (23000): Cannot add or update a child row: a foreign
# key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT
# `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

INSERT INTO MovieDirector SELECT NULL, id FROM MaxPersonID;
# mysql output: ERROR 1452 (23000): Cannot add or update a child row: a foreign
# key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT
# `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

UPDATE MovieActor SET mid = (SELECT id FROM MaxMovieID);
# mysql output: ERROR 1452 (23000): Cannot add or update a child row: a foreign
# key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1`
# FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

UPDATE MovieActor SET aid = (SELECT id FROM MaxPersonID);
# mysql output: ERROR 1452 (23000): Cannot add or update a child row: a foreign
# key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2`
# FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))

INSERT INTO MovieRating SELECT id, NULL, NULL FROM MaxMovieID;
# mysql output: ERROR 1452 (23000): Cannot add or update a child row: a foreign
# key constraint fails (`CS143`.`MovieRating`, CONSTRAINT `MovieRating_ibfk_1`
# FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

INSERT INTO Review SELECT NULL, NULL, id, NULL, NULL FROM MaxMovieID;
# mysql output: ERROR 1452 (23000): Cannot add or update a child row: a foreign
# key constraint fails (`CS143`.`Review`, CONSTRAINT `Review_ibfk_1` FOREIGN
# KEY (`mid`) REFERENCES `Movie` (`id`))





# CHECK constraints
# mySQL ignores CHECK constraints, so these queries work successfully in mySQL

# Actors and Directors must have a birth date before their death date
INSERT INTO Actor SELECT id, NULL, NULL, NULL, '2000-01-01', '1970-01-01' FROM MaxPersonID;
# mysql output: Query OK, 1 row affected (0.01 sec)
# Records: 1  Duplicates: 0  Warnings: 0

UPDATE Director SET dod = dob - 1; # sets dod to one day before dob
# mysql output: Query OK, 4311 rows affected (0.09 sec)
# Rows matched: 4311  Changed: 4311  Warnings: 0

# The number of tickets sold must be nonnegative
INSERT INTO Sales SELECT id, -1, 0 FROM Movie LIMIT 1;
# mysql output: Query OK, 1 row affected (0.01 sec)
# Records: 1  Duplicates: 0  Warnings: 0

# Ratings must be on a 0 to 100 scale
INSERT INTO MovieRating SELECT id, 200, NULL FROM Movie LIMIT 1;
# mysql output: Query OK, 1 row affected (0.00 sec)
# Records: 1  Duplicates: 0  Warnings: 0

INSERT INTO MovieRating SELECT id, NULL, -40 FROM Movie LIMIT 1;
# mysql output: Query OK, 1 row affected (0.01 sec)
# Records: 1  Duplicates: 0  Warnings: 0

UPDATE Review SET rating = rating + 1000;
# mysql output: Query OK, 1 row affected (0.00 sec)
# Records: 1  Duplicates: 0  Warnings: 0
