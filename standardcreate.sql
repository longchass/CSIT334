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
	PRIMARY KEY (username), 
	FOREIGN KEY (username) REFERENCES USERS(username)
);

CREATE TABLE business (
	username	VARCHAR(50)		NOT NULL UNIQUE,
    name	VARCHAR(30)	NOT NULL,
	password	VARCHAR(50) NOT NULL,
	address	VARCHAR(150)	NOT NULL,
	PRIMARY KEY (username), 
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
	
	CONSTRAINT STAFF_FKEY FOREIGN KEY (username) REFERENCES USERS(username)
);

CREATE TABLE ADMIN (
	privs	CHAR(2)		NOT NULL,
	username	VARCHAR(50)	NOT NULL UNIQUE,
    password	VARCHAR(50) NOT NULL,
	fname	VARCHAR(25) NOT NULL,
	lname	VARCHAR(25) NOT NULL,
	department	VARCHAR(40)		NOT NULL,
	
	CONSTRAINT ADMIN_PKEY PRIMARY KEY (username)
);
INSERT INTO USERS VALUES('baolam', '#A');
INSERT INTO ADMIN VALUES('#A','baolam', 'admin', 'bao', 'lam', 'Australia Health Department');

#table for check-in logs
CREATE TABLE CHECKIN (
	p_username	VARCHAR(50)		NOT NULL,		/*Personal ID*/
    name	VARCHAR(50) NOT NULL,		
	b_username	VARCHAR(50)		NOT NULL,		/*Business ID*/
	address VARCHAR(50) NOT NULL,	
	check_in_time	DATETIME DEFAULT CURRENT_TIMESTAMP,	/*Current time used to sign in*/
	check_out_time	DATETIME,							/*Time signed out*/
	
	CONSTRAINT P_FK FOREIGN KEY (p_username) REFERENCES person (username), 		/*field has to exist in person table*/
	CONSTRAINT B_FK FOREIGN KEY (b_username) REFERENCES business (username)		/*field has to exist in business table*/
);

INSERT INTO USERS VALUES('staff1', '#S');
INSERT INTO STAFF VALUES('#S','staff', 'password', 'fname', 'lname');

INSERT INTO USERS VALUES('person1', '#P');
INSERT INTO PERSON VALUES('person1', 'password', 'fname', 'lname');
