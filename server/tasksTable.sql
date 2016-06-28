create table tasks ( 
	id int(12) unsigned auto_increment primary key,
	board varchar(50),
	category varchar(50),
	title varchar(200),
	description longtext,
	labels varchar(200),
	users varchar(200),
	clients varchar(200),
	createdAt int(12),
	open int(1)
)

