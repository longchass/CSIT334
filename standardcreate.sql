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
	infected	BOOLEAN,

	FOREIGN KEY (username) REFERENCES USERS(username) ON UPDATE CASCADE ON DELETE CASCADE
);

#table for admin health staff
CREATE TABLE STAFF (
	username	VARCHAR(50)	NOT NULL UNIQUE,
    password	VARCHAR(50) NOT NULL,
	fname	VARCHAR(25) NOT NULL,
	lname	VARCHAR(25) NOT NULL,
	
	CONSTRAINT STAFF_FKEY FOREIGN KEY (username) REFERENCES USERS(username) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE business (
	username	VARCHAR(50)		NOT NULL UNIQUE,
	password	VARCHAR(50) NOT NULL,
    bname	VARCHAR(30)	NOT NULL,
	address	VARCHAR(150)	NOT NULL,
	guest_num	INT(3)		NOT NULL,
	guest_lim	INT(3)		NOT NULL,

	FOREIGN KEY (username) REFERENCES USERS(username) ON UPDATE CASCADE ON DELETE CASCADE
);

#table for all vaccine certificate
CREATE TABLE VACCINE_CERT (
	username	VARCHAR(50)		NOT NULL,
	vaccine_type  ENUM('Pfizer', 'AstraZeneca'),
	vac_date 	DATE	 NOT NULL,
	health_staff	VARCHAR(50)		NOT NULL,
	
	CONSTRAINT VACCINE_FOR FOREIGN KEY (username) REFERENCES person (username),
	CONSTRAINT VACCINATED_BY FOREIGN KEY (health_staff) REFERENCES staff (username)
);

CREATE TABLE Pfizer (
	username	VARCHAR(50)		NOT NULL,
	
	CONSTRAINT PFIZER_FKEY FOREIGN KEY (username) REFERENCES VACCINE_CERT (username) 
);

CREATE TABLE AstraZeneca  (
	username	VARCHAR(50)		NOT NULL,	
	CONSTRAINT ASTRAZENECA_FKEY FOREIGN KEY (username) REFERENCES VACCINE_CERT (username) 
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
	infected	BOOLEAN,	/*This user is a positive test case*/
	pos_contact	BOOLEAN,	/*This user had close contact with infected person in the past*/
	
	CONSTRAINT P_FK FOREIGN KEY (p_username) REFERENCES person (username), 		/*field has to exist in person table*/
	CONSTRAINT B_FK FOREIGN KEY (b_username) REFERENCES business (username)		/*field has to exist in business table*/
);
CREATE TABLE STATISTIC (
	total_population BIGINT (20) NOT NULL,
	total_user	BIGINT (20)		NOT NULL,		/*Personal ID*/
	vaccinated_user BIGINT (20)		NOT NULL,
	positive_cases BIGINT (20) NOT NULL,
	positive_contact BIGINT (20) NOT NULL
);
insert into STATISTIC values (25770964, 0, 0, 0, 0);
