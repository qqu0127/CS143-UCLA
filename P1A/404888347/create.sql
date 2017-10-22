CREATE TABLE Movie(
	id int not null,
	title varchar(100) not null,
	year int not null,
	rating varchar(10),
	company varchar(50),
	primary key (id),
	check (year <= 3000 and year >= 1800)
)ENGINE = INNODB;

CREATE TABLE Actor(
	id INT,
	last varchar(20) not null,
	first varchar(20) not null,
	sex varchar(20),
	dob date not null,
	dod date,
	primary key (id),
	check (sex = 'Male' or sex = 'Female')
)ENGINE = INNODB;

CREATE TABLE Sales(
	mid INT not null,
	ticketsSold INT,
	totalIncome INT,
	primary key (mid)
)ENGINE = INNODB;

CREATE TABLE Director(
	id INT not null,
	last varchar(20) not null,
	first varchar(20) not null,
	dob date not null,
	dod date,
	primary key (id, dob)
)ENGINE = INNODB;

CREATE TABLE MovieGenre(
	mid INT not null,
	genre varchar(20) not null,
	foreign key (mid) references Movie(id)
)ENGINE = INNODB;

CREATE TABLE MovieDirector(
	mid INT not null,
	did INT not null,
	foreign key(did) references Director(id),
	foreign key(mid) references Movie(id)
)ENGINE = INNODB;

CREATE TABLE MovieActor(
	mid INT not null,
	aid INT not null,
	role varchar(50) not null,
	foreign key (aid) references Actor(id),
	foreign key (mid) references Movie(id)
)ENGINE = INNODB;

CREATE TABLE MovieRating(
	mid INT not null,
	imdb INT not null,
	rot INT not null,
	primary key (mid),
	foreign key (mid) references Movie(id),
	check (imdb >= 0 and imdb <= 100),
	check (rot >= 0 and rot <= 100)
)ENGINE = INNODB;

CREATE TABLE Review(
	name varchar(20),
	time TIMESTAMP not null,
	mid INT not null,
	rating INT not null,
	comment varchar(500),
	primary key (mid),
	foreign key (mid) references Movie(id),
	check (rating >= 0 and rating <= 100)
)ENGINE = INNODB;

CREATE TABLE MaxPersonID(
	id INT not null
)ENGINE = INNODB;

CREATE TABLE MaxMovieID(
	id INT not null
)ENGINE = INNODB;

