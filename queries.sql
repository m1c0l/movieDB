SELECT CONCAT(first, ' ', last) FROM Actor as A, Movie as M, MovieActor as MA WHERE title='Die Another Day' AND M.id = MA.mid AND A.id = MA.aid;

SELECT COUNT(*) FROM (SELECT aid FROM MovieActor GROUP BY aid HAVING COUNT(mid) > 1) as A;

SELECT title FROM Movie as M, Sales as S WHERE ticketsSold > 1000000 AND M.id=S.mid;
