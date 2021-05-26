DELIMITER //
CREATE TRIGGER NEW_CASE
AFTER UPDATE ON PERSON
FOR EACH ROW
BEGIN
	/* If the person is updated to be infected, start marking*/
	IF(new.infected = TRUE) THEN
		/* Update infected status of that user in CHECKIN table */
		UPDATE CHECKIN
		SET infected = TRUE
		WHERE new.username = CHECKIN.p_username;
		
		/* Update postive contact for people who when to the same
		address in the same day with the positive case 			*/
		UPDATE CHECKIN
		SET POS_CONTACT = TRUE
		WHERE P_USERNAME IN
		(
			/* Create view A */
			SELECT A.P_USERNAME
			FROM 
			(
				/* Find username of people who had close contact*/
				SELECT P_USERNAME
				FROM CHECKIN CI
				WHERE CI.ADDRESS IN 
				(
					/* Find people who was in the same address with
					the infected person							*/
					SELECT ADDRESS
					FROM CHECKIN
					WHERE INFECTED = TRUE
				) 
				AND
				(
					/* Find people who checked in or out at the same
					address with the infected person			*/
					DATE(CI.CHECK_IN) IN 
					(
						SELECT DATE(CHECK_IN)
						FROM CHECKIN
						WHERE INFECTED = TRUE
					)
					OR DATE(CI.CHECK_OUT) IN 
					(
						SELECT DATE(CHECK_OUT)
						FROM CHECKIN
						WHERE INFECTED = TRUE
					) 
				) 
			) A 
		);
    END IF;
END //

DELIMITER //
CREATE TRIGGER ADD_VACCINE_RECORD
AFTER INSERT ON VACCINE_CERT
FOR EACH ROW
BEGIN
	IF (NEW.vaccine_type = 'Pfizer') THEN
		INSERT INTO PFIZER VALUES (NEW.USERNAME);
	ELSEIF (NEW.vaccine_type = 'AstraZeneca') THEN
		INSERT INTO ASTRAZENECA VALUES (NEW.USERNAME);
	END IF;
END//





DELIMITER //
CREATE TRIGGER NEW_USER_INSERT
AFTER insert ON USERS
FOR EACH ROW
BEGIN

update STATISTIC set total_user = (select COUNT(*) FROM USERS);
END//


DELIMITER //
CREATE TRIGGER NEW_USER_UPDATE
AFTER DELETE ON USERS
FOR EACH ROW
BEGIN

update STATISTIC set total_user = (select COUNT(*) FROM USERS);
END//



DELIMITER //
CREATE TRIGGER NEW_CASE_CERT_INSERT
AFTER insert ON vaccine_cert
FOR EACH ROW
BEGIN
update STATISTIC set vaccinated_user= (SELECT COUNT(*) from vaccine_cert where vaccine_type != NULL);
END//

DELIMITER //
CREATE TRIGGER NEW_CASE_CERT_UPDATE
AFTER UPDATE ON vaccine_cert
FOR EACH ROW
BEGIN

update STATISTIC set vaccinated_user= (SELECT COUNT(*) from vaccine_cert where vaccine_type != NULL);

END//

DELIMITER //
CREATE TRIGGER NEW_CASE_CERT_DELETE
AFTER delete ON vaccine_cert
FOR EACH ROW
BEGIN

update STATISTIC set vaccinated_user= (SELECT COUNT(*) from vaccine_cert where vaccine_type != NULL);

END//


DELIMITER //
CREATE TRIGGER NEW_CONTACT_CHECKIN_INSERT
AFTER insert on checkin
FOR EACH ROW
BEGIN
update STATISTIC set positive_contact = (SELECT COUNT(*) from checkin where pos_contact = TRUE);
END//

DELIMITER //
CREATE TRIGGER NEW_CONTACT_CHECKIN_UPDATE
AFTER update on checkin
FOR EACH ROW
BEGIN
update STATISTIC set positive_contact = (SELECT COUNT(*) from checkin where pos_contact = TRUE);
END//

DELIMITER //
CREATE TRIGGER NEW_CONTACT_CHECKIN_DELETE
AFTER DELETE on checkin
FOR EACH ROW
BEGIN
update STATISTIC set positive_contact = (SELECT COUNT(*) from checkin where pos_contact = TRUE);
END//



DELIMITER //
CREATE TRIGGER NEW_CASE_VACCINATED_INSERT
AFTER insert on person
FOR EACH ROW
BEGIN
update STATISTIC set positive_cases = (SELECT COUNT(*) WHERE infected = TRUE);
END//

DELIMITER //
CREATE TRIGGER NEW_CASE_VACCINATED_UPDATE
AFTER UPDATE on person
FOR EACH ROW
BEGIN
update STATISTIC set positive_cases = (SELECT COUNT(*) WHERE infected = TRUE);
END//

DELIMITER //
CREATE TRIGGER NEW_CASE_VACCINATED_DELETE
AFTER DELETE on person
FOR EACH ROW
BEGIN
update STATISTIC set positive_cases = (SELECT COUNT(*) WHERE infected = TRUE);
END//

/*Update one new case of user 'person8' */
UPDATE person
SET INFECTED= TRUE
WHERE username = 'person8';

/*Find people who had close contact with positive case */
SELECT DISTINCT *
FROM CHECKIN
WHERE POS_CONTACT = TRUE;