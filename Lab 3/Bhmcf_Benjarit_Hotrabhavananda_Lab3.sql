DROP TABLE IF EXISTS building;
CREATE TABLE building(
		name varchar(50),
		address varchar(50),
		city varchar(50),
		state_of_building varchar(2),
		zipcode integer,
		PRIMARY KEY (address,zipcode)
)ENGINE = InnoDB;

INSERT INTO building
		VALUES("EBW",'A', 'Columbia', 'MO', 65205);
INSERT INTO building
		VALUES("SteWart", 'B', 'Columbia','MO', 65205);
INSERT INTO building
		VALUES("Different", 'C', 'Columbia','MO', 65205);

DROP TABLE IF EXISTS office;
CREATE TABLE office(
		room_number integer,
		waiting_room_capacity integer,
		address varchar(50),
		PRIMARY KEY (room_number),
		FOREIGN KEY (address) REFERENCES building(address)
)ENGINE = InnoDB;

INSERT INTO office
		VALUES(51, 20, 'A');
INSERT INTO office
		VALUES(52, 20, 'B');
INSERT INTO office
		VALUES(53, 20, 'B');

DROP TABLE IF EXISTS doctor;
CREATE TABLE doctor(
		medical_license_num integer AUTO_INCREMENT,
		first_name varchar(50),
		last_name varchar(50),
		office_number integer,
		PRIMARY KEY(medical_license_num),
		FOREIGN KEY (office_number) REFERENCES office(room_number)
)ENGINE = InnoDB;

INSERT INTO doctor (first_name,last_name,office_number)
		VALUES("JOHN", "HOPKIN", 51);
INSERT INTO doctor (first_name,last_name,office_number)
		VALUES("Luke", "HOPKIN", 52);
INSERT INTO doctor (first_name,last_name,office_number)
		VALUES("Kyle", "HOPKIN", 53);		
		
DROP TABLE IF EXISTS patient;
CREATE TABLE patient(
		ssn integer AUTO_INCREMENT,
		first_name varchar(50),
		last_name varchar(50),
		PRIMARY KEY(ssn)
)ENGINE = InnoDB;

INSERT INTO patient (first_name,last_name)
		VALUES('Philip','Lin');
INSERT INTO patient (first_name,last_name)
		VALUES('Kelly','Sun');
INSERT INTO patient (first_name,last_name)
		VALUES('Johnatan','Shu');	
		
DROP TABLE IF EXISTS insurance;
CREATE TABLE insurance(
		ssn integer,
		policy_num integer,
		insurer varchar(50),
		PRIMARY KEY(ssn),
		FOREIGN KEY (ssn) REFERENCES patient(ssn) ON DELETE CASCADE
)ENGINE = InnoDB;

INSERT INTO insurance
		VALUES(1, 1, 'ben');
INSERT INTO insurance
		VALUES(2, 2, 'Jen');
INSERT INTO insurance
		VALUES(3, 3, 'Hen');
		
DROP TABLE IF EXISTS conditions;
CREATE TABLE conditions(
		icd10 integer,
		description varchar(50),
		PRIMARY KEY (icd10)
)ENGINE = InnoDB;

INSERT INTO conditions
		VALUES(21,'headache');
INSERT INTO conditions
		VALUES(22,'buttache');
INSERT INTO conditions
		VALUES(23,'toothache');		

DROP TABLE IF EXISTS labwork;
CREATE TABLE labwork(
		ssn integer, 
		test_name varchar(50),
		test_timestamp integer,
		test_value integer,
		PRIMARY KEY(ssn, test_name, test_timestamp),
		FOREIGN KEY (ssn) REFERENCES patient(ssn) ON DELETE CASCADE
)ENGINE = InnoDB;

INSERT INTO labwork
		VALUES(1,'abc',31,41);
INSERT INTO labwork
		VALUES(2,'bbc',32,42);
INSERT INTO labwork
		VALUES(3,'cbc',33,43);
		
DROP TABLE IF EXISTS doctor_has_appointment;
CREATE TABLE doctor_has_appointment(
		ssn integer,
		medical_license_num integer,
		appointmentDate date,
		apptTime time,
		PRIMARY KEY(ssn, medical_license_num),
		FOREIGN KEY (ssn) REFERENCES patient(ssn) ON DELETE CASCADE,
		FOREIGN KEY (medical_license_num) REFERENCES doctor(medical_license_num) ON DELETE CASCADE
)ENGINE = InnoDB;

INSERT INTO doctor_has_appointment
		VALUES(1, 1,'1897/02/04','03:00:01');
INSERT INTO doctor_has_appointment
		VALUES(2, 2,'1897/02/04','03:00:01');
INSERT INTO doctor_has_appointment
		VALUES(3, 3,'1897/02/04','03:00:01');
		
		
DROP TABLE IF EXISTS patient_has_conditions;
CREATE TABLE patient_has_conditions(
		ssn integer,
		icd10 integer,
		PRIMARY KEY(ssn,icd10),
		FOREIGN KEY (ssn) REFERENCES patient(ssn) ON DELETE CASCADE,
		FOREIGN KEY (icd10) REFERENCES conditions (icd10) ON DELETE CASCADE
)ENGINE = InnoDB;

INSERT INTO patient_has_conditions
		VALUES(1,21);
INSERT INTO patient_has_conditions
		VALUES(2,22);
INSERT INTO patient_has_conditions
		VALUES(3,23);