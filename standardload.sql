INSERT INTO USERS VALUES('baolam', '#A');
INSERT INTO ADMIN VALUES('baolam', 'admin', 'bao', 'lam', 'Australia Health Department');

INSERT INTO USERS VALUES('staff1', '#S');
INSERT INTO STAFF (username, password, fname, lname)
VALUES('staff1', 'password', 'fname', 'lname');

INSERT INTO USERS VALUES('staff2', '#S');
INSERT INTO STAFF (username, password, fname, lname)
VALUES('staff2', 'password', 'fname', 'lname');

INSERT INTO USERS VALUES('staff3', '#S');
INSERT INTO STAFF (username, password, fname, lname)
VALUES('staff3', 'password', 'fname', 'lname');

INSERT INTO USERS VALUES('person1', '#P');
INSERT INTO PERSON (username, password, fname, lname, infected)
VALUES('person1', 'password', 'fname', 'lname', FALSE);

INSERT INTO USERS VALUES('person2', '#P');
INSERT INTO PERSON (username, password, fname, lname, infected)
VALUES('person2', 'password', 'fname', 'lname', FALSE);

INSERT INTO USERS VALUES('person3', '#P');
INSERT INTO PERSON (username, password, fname, lname, infected)
VALUES('person3', 'password', 'fname', 'lname', FALSE);

INSERT INTO USERS VALUES('person4', '#P');
INSERT INTO PERSON (username, password, fname, lname, infected)
VALUES('person4', 'password', 'fname', 'lname', FALSE);

INSERT INTO USERS VALUES('person5', '#P');
INSERT INTO PERSON (username, password, fname, lname, infected)
VALUES('person5', 'password', 'fname', 'lname', FALSE);

INSERT INTO USERS VALUES('person6', '#P');
INSERT INTO PERSON (username, password, fname, lname, infected)
VALUES('person6', 'password', 'fname', 'lname', FALSE);

INSERT INTO USERS VALUES('person7', '#P');
INSERT INTO PERSON (username, password, fname, lname, infected)
VALUES('person7', 'password', 'fname', 'lname', FALSE);

INSERT INTO USERS VALUES('person8', '#P');
INSERT INTO PERSON (username, password, fname, lname, infected)
VALUES('person8', 'password', 'fname', 'lname', FALSE);

INSERT INTO USERS VALUES('person9', '#P');
INSERT INTO PERSON (username, password, fname, lname, infected)
VALUES('person9', 'password', 'fname', 'lname', FALSE);

INSERT INTO USERS VALUES('person10', '#P');
INSERT INTO PERSON (username, password, fname, lname, infected)
VALUES('person10', 'password', 'fname', 'lname', FALSE);

INSERT INTO USERS VALUES('business1', '#B');
INSERT INTO BUSINESS VALUES('business1', 'password', 'bname', 'address1',0, 20);

INSERT INTO USERS VALUES('business2', '#B');
INSERT INTO BUSINESS VALUES('business2', 'password', 'bname', 'address2',0, 25);

INSERT INTO USERS VALUES('business3', '#B');
INSERT INTO BUSINESS VALUES('business3', 'password', 'bname', 'address3',0, 30);

INSERT INTO USERS VALUES('business4', '#B');
INSERT INTO BUSINESS VALUES('business4', 'password', 'bname', 'address4',0 , 100);

INSERT INTO USERS VALUES('business5', '#B');
INSERT INTO BUSINESS VALUES('business5', 'password', 'bname', 'address5', 0, 50);

INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person1', 'fname lname', 'business1', 'address1',TIMESTAMP('2021-04-02 10:35:12'),TIMESTAMP('2021-04-02 11:35:12'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person2', 'fname lname', 'business3', 'address3',TIMESTAMP('2021-04-02 10:30:12'),TIMESTAMP('2021-04-02 14:35:12'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person3', 'fname lname', 'business2', 'address2',TIMESTAMP('2021-04-02 11:20:12'),TIMESTAMP('2021-04-02 12:00:12'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person3', 'fname lname', 'business4', 'address4',TIMESTAMP('2021-04-02 15:35:12'),TIMESTAMP('2021-04-02 15:45:12'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person6', 'fname lname', 'business4', 'address4',TIMESTAMP('2021-04-02 18:35:12'),TIMESTAMP('2021-04-02 18:55:10'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person4', 'fname lname', 'business3', 'address3',TIMESTAMP('2021-04-02 18:45:12'),TIMESTAMP('2021-04-02 18:55:01'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person6', 'fname lname', 'business4', 'address4',TIMESTAMP('2021-04-02 18:51:13'),TIMESTAMP('2021-04-02 18:56:32'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person5', 'fname lname', 'business1', 'address1',TIMESTAMP('2021-04-02 18:53:01'),TIMESTAMP('2021-04-02 18:59:14'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person7', 'fname lname', 'business2', 'address2',TIMESTAMP('2021-04-02 19:05:12'),TIMESTAMP('2021-04-02 19:35:12'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person8', 'fname lname', 'business2', 'address2',TIMESTAMP('2021-04-03 19:45:10'),TIMESTAMP('2021-04-03 20:40:11'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person4', 'fname lname', 'business3', 'address3',TIMESTAMP('2021-04-03 18:45:12'),TIMESTAMP('2021-04-03 18:55:01'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person3', 'fname lname', 'business4', 'address4',TIMESTAMP('2021-04-03 18:51:13'),TIMESTAMP('2021-04-03 18:56:32'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person5', 'fname lname', 'business1', 'address1',TIMESTAMP('2021-04-03 18:53:01'),TIMESTAMP('2021-04-03 18:59:14'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person9', 'fname lname', 'business5', 'address5',TIMESTAMP('2021-04-03 19:05:12'),TIMESTAMP('2021-04-03 19:35:12'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person8', 'fname lname', 'business2', 'address2',TIMESTAMP('2021-04-03 19:45:10'),TIMESTAMP('2021-04-03 19:35:12'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person1', 'fname lname', 'business2', 'address2',TIMESTAMP('2021-04-03 19:45:10'),TIMESTAMP('2021-04-03 20:40:11'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person4', 'fname lname', 'business3', 'address3',TIMESTAMP('2021-04-04 18:45:12'),TIMESTAMP('2021-04-04 18:55:01'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person3', 'fname lname', 'business4', 'address4',TIMESTAMP('2021-04-04 18:51:13'),TIMESTAMP('2021-04-04 18:56:32'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person5', 'fname lname', 'business1', 'address1',TIMESTAMP('2021-04-04 18:53:01'),TIMESTAMP('2021-04-04 18:59:14'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person2', 'fname lname', 'business5', 'address5',TIMESTAMP('2021-04-04 19:05:12'),TIMESTAMP('2021-04-04 19:35:12'),false,false);
INSERT INTO CHECKIN (p_username, name, b_username, address, check_in, check_out, infected, pos_contact)
VALUES('person1', 'fname lname', 'business2', 'address2',TIMESTAMP('2021-04-04 19:45:10'),TIMESTAMP('2021-04-04 19:35:12'),false,false);

INSERT INTO VACCINE_CERT VALUES('person10', 'Pfizer', DATE('2021-04-01'), 'staff1');
INSERT INTO VACCINE_CERT VALUES('person5', 'AstraZeneca', DATE('2021-04-10'), 'staff3' );

INSERT INTO Pfizer VALUES('person10');
INSERT INTO AstraZeneca VALUES('person5');