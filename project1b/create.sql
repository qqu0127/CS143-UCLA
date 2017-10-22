create table Movie (
             id int, 
			 title varchar(100), 
			 year int, 
			 rating varchar(10), 
			 company varchar(50),
			 primary key(id), -- All movie should have valid and unique id; 
			 check (length(title) > 0) -- All movie should have a none empty title;
)ENGINE = INNODB;

create table Actor (
             id int, 
			 last varchar(20), 
			 first varchar(20), 
			 sex varchar(6),
			 dob date, 
			 dod date,
			 primary key(id)-- All actors should have valid and unique id;
)ENGINE = INNODB;
			 
create table Sales (
             mid int, 
			 ticketSold int, 
			 totalIncome int,
			 primary key(mid), -- The movie id should be unique and valid;
			 foreign key(mid) references Movie(id), -- The sales must be associated with a valid movie;
			 check ((ticketSold > 0) and (totalIncome > 0)) -- You can't sell minus number of tickets and get minus income;
)ENGINE = INNODB;

create table Director (
             id int, 
			 last varchar(20), 
			 first varchar(20), 
			 dob date,  
			 dod date,
			 primary key(id)  -- All directors should have unique id;
)ENGINE = INNODB;
			 
create table MovieGenre (
             mid int, 
			 genre varchar(20),
			 foreign key(mid) references Movie(id) -- The movie id in this table must represent a real movie; 
)ENGINE = INNODB;

create table MovieDirector (
             mid int, 
			 did int,
			 foreign key(mid) references Movie(id), -- The movie id in this table must represent a real movie;
			 foreign key(did) references Director(id) -- The director id in this table must represent a real director;
)ENGINE = INNODB;
			 
create table MovieActor (
             mid int, 
			 aid int, 
			 role varchar(20),
			 foreign key(mid) references Movie(id), -- The movie id in this table must represent a real movie;
			 foreign key(aid) references Actor(id)-- The actor id in this table must represent a real actor;
)ENGINE = INNODB;
			 
create table MovieRating (
             mid int, 
			 imdb int, 
			 rot int,
			 primary key(mid), -- One movie should have only one rating;
			 foreign key(mid) references Movie(id), -- You can only rate a real movie;
			 check ((imdb > 0) and (rot > 0))-- The rating of a movie should be valid;
)ENGINE = INNODB;
			 
create table Review (
             name varchar(20), 
			 time timestamp, 
			 mid int, 
			 rating int, 
			 comment varchar(500),
			 foreign key(mid) references Movie(id), -- You can only write review for a real movie;
			 check (rating > 0) -- You can't give a movie minus rating.(Even if it's really bad)
)ENGINE  = INNODB;

create table MaxPersonID (id int)ENGINE = INNODB;
create table MaxMovieID (id int)ENGINE = INNODB;

