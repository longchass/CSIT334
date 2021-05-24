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

/*Update one new case of user 'person8' */
UPDATE person
SET INFECTED= TRUE
WHERE username = 'person8';

/*Find people who had close contact with positive case */
SELECT DISTINCT *
FROM CHECKIN
WHERE POS_CONTACT = TRUE;