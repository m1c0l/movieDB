Page I1: "add-actor.php" and "add-director.php" lets a user add actors and
directors, respectively. We sanitize user input so that special characters
behave well with mySQL. The length of strings in the database are enforced with
the maxlength attribute on text input elements. Dates are validated on the
backend with PHP.

Page I2: "add-movie.php" supports the same input checking as Page I1. This page
also has fields for assigning genres to the new movie. It supports all of the
ratings and genres that are in the preloaded data.

Page I3: "add-review.php", which can be accessed by finding a movie using the
search feature, lets users add comments to a movie.

Page I4: "movie-actor.php" has select tags where a user can choose a movie and
an actor, and a text input for the role. The dropdowns have all of the actors
and movies listed, as well as their birth date or year for clarity.

Page I5: "movie-director.php" has the same function as Page I4, but for
directors.


Page B1: "actor-info.php" shows an actor's name, sex, date of birth, and date
of death (if not still alive). It also shows the actor's roles in all of his or
her movies. These movies have a link to their browsing page.

Page B2: "movie-info.php" shows a movie's title, directors, company, genres,
rating, and cast. Each cast member shows the actor name and role, and has a
link to the actor's browsing page. It also shows the reviews (comments and
score) for this movie, the average rating, and total ratings. There is a "Add
your own review!" link that takes the user to Page I3.


Page S1: "search.php" lets users search for actors and movies. The search is
case insensitive and searches each word separately to support multi-word
search. This page searches actors' first and last names and movies' titles. The
results are sorted alphabetically, by first name for the actors and by title
for the movies. The results are shown on "search-submit.php".



Collaboration

Richard Sun: Page I1, Page I2, Page I4, Page I5, Selenium tests, readme.txt
Zi Ming Li: Page I3, Page B1, Page B2, Page S1, website design

The VM is not set up for version control or collaboration. It may be helpful to
initially have the files in a git repository so that we can easily share our
changes.
