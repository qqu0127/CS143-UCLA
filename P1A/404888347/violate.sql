insert into Movie values(900, 'test', 2010, 'PG', 'test');
	-- movie id = 900 already exists
	-- ERROR 1062 (23000): Duplicate entry '900' for key 'PRIMARY'
insert into Actor values(1000, 'Joe', 'Bruin', 'Male', '1995-01-27', '');
	-- actor id = 1000 already exists
	-- ERROR 1062 (23000): Duplicate entry '1000' for key 'PRIMARY'
insert into Director values(800, 'Joe', 'Bruin', '1995-01-27', '');
	-- director id = 800 already exists
	-- ERROR 1062 (23000): Duplicate entry '800' for key 'PRIMARY'
insert into Director values(900, 'Joe', 'Bruin', null, null);
	-- date of birth cannot be null
	-- ERROR 1048 (23000): Column 'dob' cannot be null
insert into MovieGenre values(900, 'Action');
	-- there is no id = 900 in Movie table
	-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
insert into MovieDirector values(994, 974);
	-- there is no id = 994 in Movie table
	-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

insert into MovieDirector values(995, 973);
	-- there is no director with id = 973
	-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

insert into MovieActor values(994, 999, 'test');
	-- there is no id = 994 in Movie table
	-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

insert into MovieActor values(995, 998, 'test');
	-- there is no actor with id = 998
	-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))

insert into Review values('Aaron', '2017-01-01 08:32:15', 994, 5, 'Good movie');
	-- there is no id = 994 in Movie table
	-- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`TEST`.`Review`, CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))


-- CONSTRAINTS
insert into Movie values (1, 'Title', 20015, 'PG', 'test');
-- year out of range

insert into Actor values (2, 'Last', 'First', 'test', 1993-05-26, NULL);
-- sex is invalid, neither 'Male' nor 'Female'

insert into MovieRating values ('test', '2017-01-01 08:32:15', 971, 666, 'This movie is 666!');
-- rating our of range