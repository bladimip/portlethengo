/*scrip for creating DB and tables
-clubgenre must be created BEFORE clubs because of reference
*/

/*
DROP DATABASE webdev5;
CREATE DATABASE webdev5;
*/
USE webdev5;

CREATE TABLE Users (
	user_id 		INTEGER 		AUTO_INCREMENT,
	clubAdmin 		BOOLEAN			DEFAULT FALSE,
	nkpag 			BOOLEAN			DEFAULT FALSE,
	siteAdmin 		BOOLEAN			DEFAULT FALSE,
	username 		VARCHAR(100) 	NOT NULL UNIQUE,
	email 			VARCHAR(200) 	NOT NULL UNIQUE,
	password 		VARCHAR(50) 	NOT NULL,
	blocked			BOOLEAN			DEFAULT FALSE,
	PRIMARY KEY (user_id)
);

CREATE TABLE ClubGenre (
	code			VARCHAR(2)		UNIQUE,
	category		VARCHAR(100)	NOT NULL,
	PRIMARY KEY (code)
);

CREATE TABLE Clubs (
	club_id 		INTEGER 		AUTO_INCREMENT,
	name			VARCHAR(200) 	NOT NULL,
	genreCode 		VARCHAR(2) 	 	NOT NULL,
	description		VARCHAR(5000),
	phone			VARCHAR(100),
	email 			VARCHAR(200),
	address 		VARCHAR(200) 	NOT NULL,
	approved		BOOLEAN			DEFAULT FALSE,
	PRIMARY KEY (club_id),
	CONSTRAINT fk_Clubs_clubGenre FOREIGN KEY (genreCode) REFERENCES ClubGenre (code) ON DELETE CASCADE
);

CREATE TABLE ClubAdmins (
	user_id			INTEGER 		NOT NULL,
	club_id			INTEGER 		NOT NULL,
	CONSTRAINT fk_ClubAdmins_users FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE,
	CONSTRAINT fk_ClubAdmins_clubs FOREIGN KEY (club_id) REFERENCES Clubs (club_id) ON DELETE CASCADE
);

CREATE TABLE ClubEvents (
	event_id 		INTEGER			AUTO_INCREMENT,
	club_id			INTEGER 		NOT NULL,
	user_id			INTEGER 		NOT NULL,
	approvedBy		INTEGER,
	name			VARCHAR(200) 	NOT NULL,
	description		VARCHAR(5000)	NOT NULL,
	eventDate		DATETIME		NOT NULL,
	approved		BOOLEAN			DEFAULT FALSE,
	PRIMARY KEY (event_id),
	CONSTRAINT fk_ClubEvents_Clubs FOREIGN KEY (club_id) REFERENCES Clubs (club_id) ON DELETE CASCADE,
	CONSTRAINT fk_ClubEvents_Users FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE,
	CONSTRAINT fk_ClubEvents_UsersApprovedBy FOREIGN KEY (approvedBy) REFERENCES Users (user_id) ON DELETE CASCADE
);

CREATE TABLE ClubImages (
	image_id 		INTEGER			AUTO_INCREMENT,
	club_id			INTEGER			NOT NULL,
	imagePath		VARCHAR(200) 	NOT NULL,
	altName			VARCHAR(100)	NOT NULL,
	PRIMARY KEY (image_id),
	CONSTRAINT fk_ClubImages_Clubs FOREIGN KEY (club_id) REFERENCES Clubs (club_id) ON DELETE CASCADE
);

CREATE TABLE HealthNews (
	news_id			INTEGER			AUTO_INCREMENT,
	user_id			INTEGER			NOT NULL,
	approvedBy		INTEGER,
	title			VARCHAR(200)	NOT NULL,
	description		VARCHAR(5000)	NOT NULL,
	newsDate		DATETIME		NOT NULL,
	approved		BOOLEAN			DEFAULT FALSE,
	PRIMARY KEY (news_id),
	CONSTRAINT fk_HealthNews_Users FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE,
	CONSTRAINT fk_HealthNews_UsersApprovedBy FOREIGN KEY (approvedBy) REFERENCES Users (user_id) ON DELETE CASCADE
);

CREATE TABLE HealthMedia (
	media_id		INTEGER			AUTO_INCREMENT,
	news_id			INTEGER			NOT NULL,
	mediaType		VARCHAR(100)	NOT NULL,
	altName			VARCHAR(100),
	mediaPath		VARCHAR(200) 	NOT NULL,
	PRIMARY KEY (media_id),
	CONSTRAINT fk_HealthMedia_HealthNews FOREIGN KEY (media_id) REFERENCES HealthNews (news_id) ON DELETE CASCADE
);

CREATE TABLE Locations (
	loc_id			INTEGER			AUTO_INCREMENT,
	user_id			INTEGER			NOT NULL,
	approvedBy		INTEGER,
	name			VARCHAR(200)	NOT NULL,
	description		VARCHAR(5000),
	longitude		FLOAT(10,6)		NOT NULL,
	latitude		FLOAT(10,6)		NOT NULL,
	address			VARCHAR(200),
	approved		BOOLEAN			DEFAULT FALSE,
	PRIMARY KEY (loc_id),
	CONSTRAINT fk_Locations_Users FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE,
	CONSTRAINT fk_Locations_UsersApprovedBy FOREIGN KEY (approvedBy) REFERENCES Users (user_id) ON DELETE CASCADE
);

CREATE TABLE LocationImages (
	image_id 		INTEGER			AUTO_INCREMENT,
	loc_id			INTEGER			NOT NULL,
	imagePath		VARCHAR(200)	NOT NULL,
	altName			VARCHAR(100)	NOT NULL,
	PRIMARY KEY (image_id),
	CONSTRAINT fk_LocationImages_Locations FOREIGN KEY (loc_id) REFERENCES Locations (loc_id) ON DELETE CASCADE
);

CREATE TABLE Routes (
	route_id 		INTEGER			AUTO_INCREMENT,
	user_id			INTEGER			NOT NULL,
	approvedBy		INTEGER,
	name			VARCHAR(100)	NOT NULL,
	description		VARCHAR(5000),
	coordinates		VARCHAR(5000)	NOT NULL,
	approved		BOOLEAN			DEFAULT FALSE,
	PRIMARY KEY (route_id),
	CONSTRAINT fk_Routes_Users FOREIGN KEY (user_id) REFERENCES Users (user_id) ON DELETE CASCADE,
	CONSTRAINT fk_Routes_UsersApprovedBy FOREIGN KEY (approvedBy) REFERENCES Users (user_id) ON DELETE CASCADE
);
