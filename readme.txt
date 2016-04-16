Constraints

Primary key constraints:
Movie.id
Actor.id
Director.id


Referential integrity constraints:
Sales.mid references Movie.id
MovieGenre.mid references Movie.id
MovieDirector.mid references Movie.id
MovieDirector.did references Director.id
MovieActor.mid references Movie.id
MovieActor.aid references Actor.id
MovieRating.mid references Movie.id
Review.mid references Movie.id


CHECK constraints:
Actor.dob < Actor.dod, or Actor.dod is null
Sales.ticketsSold >= 0
Director.dob < Director.dod, or Director.dod is null
0 <= MovieRating.imdb <= 100
0 <= MovieRating.rot <= 100
0 <= Review.rating <= 100
