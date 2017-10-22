select concat(first, ' ', last) as ActorsInDearthToSmoochy
from Actor, MovieActor
where Actor.id = MovieActor.aid 
and MovieActor.mid = 
(select id from Movie
where title = 'Death to Smoochy');
-- join table Actor and MovieActor and match movie ID to get the queried movie

select count(*)
from
(select did from MovieDirector
group by did
having count(mid) >= 4) as directorCount;
-- group up director ID and select the transactions that have more than 4

select year, title, imdb, rot
from Movie, MovieRating
where Movie.id = MovieRating.mid and year = 1995 and imdb > 90 and rot > 90;
-- the best rated movie in year 1995 that have scored 9+ on imdb and rot

select title, year
from Movie, Sales
where year = 1995 and Movie.id = Sales.mid and ticketsSold > 1100000;
-- the best selling movie in year 1995 that have more than 1100000 tickets sold
