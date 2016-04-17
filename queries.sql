SELECT CONCAT(first, ' ', last) FROM Actor as A, Movie as M, MovieActor as MA WHERE title='Die Another Day' AND M.id = MA.mid AND A.id = MA.aid;

SELECT COUNT(*) FROM (SELECT aid FROM MovieActor GROUP BY aid HAVING COUNT(DISTINCT mid) > 1) as A;

SELECT title FROM Movie as M, Sales as S WHERE ticketsSold > 1000000 AND M.id=S.mid;

# Find names of actors born in 2000 or afterwards and the names of the movies the played in, sort by actor name
SELECT CONCAT(A.first, ' ', A.last), title FROM Actor as A, MovieActor as MA, Movie as M WHERE A.id=MA.aid AND MA.mid=M.id AND A.dod >= '2000-01-01' ORDER BY A.first, A.last;

# Find top 100 best-selling movies that also have an IMDB and RottenTomatoes rating over 50
SELECT title, totalIncome, imdb, rot FROM Movie as M, Sales as S, MovieRating as MR WHERE  M.id=S.mid AND M.id=MR.mid AND  imdb > 50 AND rot > 50 ORDER BY totalIncome DESC LIMIT 100;
