CREATE TABLE USERS (
	ID		INT(8)		NOT NULL AUTO_INCREMENT,
	username	VARCHAR(50)		NOT NULL UNIQUE,
	privs	CHAR(2)		NOT NULL,
	
	CONSTRAINT USER_PKEY PRIMARY KEY (ID, username)
);
#user account table
CREATE TABLE person (
	ID		INT(8)		NOT NULL AUTO_INCREMENT,
	username	VARCHAR(50)		NOT NULL UNIQUE,
    password	VARCHAR(50) NOT NULL,
	fname VARCHAR(25) NOT NULL, 		
	lname VARCHAR(25) NOT NULL, 		
	email VARCHAR(150) NOT NULL,
	phone CHAR(10) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (ID, username), 
	FOREIGN KEY (ID, username) REFERENCES USERS(ID, username)
);

CREATE TABLE business (
	ID		INT(8)		NOT NULL AUTO_INCREMENT,
	username	VARCHAR(50)		NOT NULL UNIQUE,
    name	VARCHAR(30)	NOT NULL,
	password	VARCHAR(50) NOT NULL,
	email	VARCHAR(50)	NOT NULL,
	address	VARCHAR(150)	NOT NULL,
	phone	CHAR(10)	NOT NULL,
	PRIMARY KEY (ID, username), 
	FOREIGN KEY (ID, username) REFERENCES USERS(ID, username)
);

#table for all vaccine certificate
CREATE TABLE VACCINE_CERT (
    ID			INT(8) 	NOT NULL,		/*unique user ID*/
	P_ID		INT(8)		NOT NULL,
	name 		VARCHAR(50) NOT NULL,		/*the user vaccinated*/
    vac_date 	DATE	 NOT NULL,			/*date/time user vaccinated - change to just date?*/
	
	CONSTRAINT PERSON_FKEY FOREIGN KEY (P_ID) REFERENCES person (ID)
);

#table for admin health staff
CREATE TABLE STAFF (
	ID		INT(8)		NOT NULL,		/*unique user ID*/
	privs	CHAR(2)		NOT NULL,
	username	VARCHAR(50)	NOT NULL UNIQUE,
    password	VARCHAR(50) NOT NULL,
	fname	VARCHAR(25) NOT NULL,
	lname	VARCHAR(25) NOT NULL,
	department	VARCHAR(40)		NOT NULL,
	
	CONSTRAINT STAFF_FKEY FOREIGN KEY (ID, username) REFERENCES USERS(ID, username)
);

CREATE TABLE ADMIN (
	ID		INT(8)		NOT NULL,		/*unique admin ID for government*/
	privs	CHAR(2)		NOT NULL,
	username	VARCHAR(50)	NOT NULL UNIQUE,
    password	VARCHAR(50) NOT NULL,
	fname	VARCHAR(25) NOT NULL,
	lname	VARCHAR(25) NOT NULL,
	department	VARCHAR(40)		NOT NULL,
	
	CONSTRAINT ADMIN_PKEY PRIMARY KEY (ID)
);

INSERT INTO ADMIN VALUES(0, '#A','baolam', 'admin', 'bao', 'lam', 'Australia Health Department')
INSERT INTO USERS VALUES(0,'baolam','#A')

#table for check-in logs
CREATE TABLE CHECKIN (
	ID		INT(12)	NOT NULL AUTO_INCREMENT,		/*unique ID*/
	P_ID	INT(8)		NOT NULL,		/*Personal ID*/
    name	VARCHAR(50) NOT NULL,		
	B_ID	INT(8)		NOT NULL,		/*Business ID*/
	address VARCHAR(50) NOT NULL,	
	check_in_time	DATETIME DEFAULT CURRENT_TIMESTAMP,	/*Current time used to sign in*/
	check_out_time	DATETIME,							/*Time signed out*/
	
	CONSTRAINT CHECKIN_PKEY PRIMARY KEY(ID),
	CONSTRAINT P_FK FOREIGN KEY (P_ID) REFERENCES person (ID), 		/*field has to exist in person table*/
	CONSTRAINT B_FK FOREIGN KEY (B_ID) REFERENCES business (ID)		/*field has to exist in business table*/
);

