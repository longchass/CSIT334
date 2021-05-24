CREATE TABLE USERS (
	username	VARCHAR(50)		NOT NULL UNIQUE,
	privs	CHAR(2)		NOT NULL,
	
	CONSTRAINT USER_PKEY PRIMARY KEY (username)
);
#user account table
CREATE TABLE person (
	username	VARCHAR(50)		NOT NULL UNIQUE,
    password	VARCHAR(50) NOT NULL,
	fname VARCHAR(25) NOT NULL, 		
	lname VARCHAR(25) NOT NULL,
	infected	BOOLEAN	DEFAULT FALSE,

	FOREIGN KEY (username) REFERENCES USERS(username)
);

CREATE TABLE business (
	username	VARCHAR(50)		NOT NULL UNIQUE,
	password	VARCHAR(50) NOT NULL,
    bname	VARCHAR(30)	NOT NULL,
	address	VARCHAR(150)	NOT NULL,

	FOREIGN KEY (username) REFERENCES USERS(username)
);

#table for all vaccine certificate
CREATE TABLE VACCINE_CERT (
	username	VARCHAR(50)		NOT NULL,
	name 		VARCHAR(50) NOT NULL,		/*the user vaccinated*/
    vac_date 	DATE	 NOT NULL,			/*date/time user vaccinated - change to just date?*/
	
	CONSTRAINT VACCINE_FKEY FOREIGN KEY (username) REFERENCES person (username)
);

#table for admin health staff
CREATE TABLE STAFF (
	username	VARCHAR(50)	NOT NULL UNIQUE,
    password	VARCHAR(50) NOT NULL,
	fname	VARCHAR(25) NOT NULL,
	lname	VARCHAR(25) NOT NULL,
	infected BOOLEAN	DEFAULT FALSE,
	
	CONSTRAINT STAFF_FKEY FOREIGN KEY (username) REFERENCES USERS(username)
);

CREATE TABLE ADMIN (
	username	VARCHAR(50)	NOT NULL UNIQUE,
    password	VARCHAR(50) NOT NULL,
	fname	VARCHAR(25) NOT NULL,
	lname	VARCHAR(25) NOT NULL,
	department	VARCHAR(40)		NOT NULL,
	
	CONSTRAINT ADMIN_PKEY PRIMARY KEY (username)
);

#table for check-in logs
CREATE TABLE CHECKIN (
	p_username	VARCHAR(50)		NOT NULL,		/*Personal ID*/
    name	VARCHAR(50) NOT NULL,		
	b_username	VARCHAR(50)		NOT NULL,		/*Business ID*/
	address VARCHAR(50) NOT NULL,	
	check_in	DATETIME DEFAULT CURRENT_TIMESTAMP,	/*Current time used to sign in*/
	check_out	DATETIME,							/*Time signed out*/
	infected	BOOLEAN	DEFAULT FALSE,	/*This user is a positive test case*/
	pos_contact	BOOLEAN	DEFAULT FALSE,	/*This user had close contact with infected person in the past*/
	
	CONSTRAINT P_FK FOREIGN KEY (p_username) REFERENCES person (username), 		/*field has to exist in person table*/
	CONSTRAINT B_FK FOREIGN KEY (b_username) REFERENCES business (username)		/*field has to exist in business table*/
);
