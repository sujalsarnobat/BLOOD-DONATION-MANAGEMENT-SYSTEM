-- ========================================
-- BLOOD DONATION MANAGEMENT DATABASE
-- ========================================

CREATE DATABASE IF NOT EXISTS blood_donation;
USE blood_donation;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- =========================
-- TABLES
-- =========================

CREATE TABLE IF NOT EXISTS admin (
  id INT(11) NOT NULL AUTO_INCREMENT,
  UserName VARCHAR(100) NOT NULL UNIQUE,
  Password VARCHAR(100) NOT NULL,
  updationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tblbloodgroup (
  id INT(11) NOT NULL AUTO_INCREMENT,
  BloodGroup VARCHAR(20) NOT NULL UNIQUE,
  PostingDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tblblooddonars (
  id INT(11) NOT NULL AUTO_INCREMENT,
  FullName VARCHAR(100) NOT NULL,
  MobileNumber CHAR(11) NOT NULL,
  EmailId VARCHAR(100) NOT NULL,
  Gender VARCHAR(20),
  Age INT(11),
  BloodGroup VARCHAR(20),
  Address VARCHAR(255),
  Message MEDIUMTEXT,
  PostingDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status INT(1) DEFAULT 1,
  PRIMARY KEY (id),
  CONSTRAINT fk_blood_group FOREIGN KEY (BloodGroup) REFERENCES tblbloodgroup(BloodGroup) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tbldependents (
  id INT(11) NOT NULL AUTO_INCREMENT,
  DonorID INT(11) NOT NULL,
  DependentName VARCHAR(100),
  Relationship VARCHAR(50),
  Age INT(11),
  PRIMARY KEY (id),
  CONSTRAINT fk_donor_id FOREIGN KEY (DonorID) REFERENCES tblblooddonars(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tblcontactusinfo (
  id INT(11) NOT NULL AUTO_INCREMENT,
  Address TINYTEXT,
  EmailId VARCHAR(255),
  ContactNo CHAR(11),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tblcontactusquery (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100),
  EmailId VARCHAR(120),
  ContactNumber CHAR(11),
  Message LONGTEXT,
  PostingDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status INT(11),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tblpages (
  id INT(11) NOT NULL AUTO_INCREMENT,
  PageName VARCHAR(255),
  type VARCHAR(255) NOT NULL DEFAULT '',
  detail LONGTEXT NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- LOG TABLE FOR TRIGGERS
CREATE TABLE IF NOT EXISTS donor_logs (
  log_id INT AUTO_INCREMENT PRIMARY KEY,
  donor_id INT,
  action VARCHAR(50),
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- SAMPLE DATA
-- =========================

INSERT INTO admin (UserName, Password) VALUES ('nandini', 'nandini1012');

INSERT INTO tblbloodgroup (BloodGroup) VALUES
('A+'), ('A-'), ('O+'), ('O-'), ('B+'), ('B-'), ('AB+'), ('AB-');

INSERT INTO tblblooddonars (FullName, MobileNumber, EmailId, Gender, Age, BloodGroup, Address, Message)
VALUES
('Mark', '9999857868', 'markd@gmail.com', 'Male', 27, 'O+', 'Bangalore', 'Proud to be part of this cause'),
('Stef', '41241241241', 'stef@dfdsf.com', 'Male', 34, 'AB-', 'Mysore', 'Good cause'),
('Ankitha', '42352352352', 'anki@gmail.com', 'Female', 23, 'B+', 'Bangalore', 'Great job'),
('Zayn', '35345435345', 'onedirection@asd.com', 'Male', 26, 'AB-', 'Bangalore', 'Available anytime to donate'),
('Namratha', '8569855244', 'namu@yahoo.com', 'Female', 22, 'A+', 'Raichur', 'Done'),
('Ravi', '8561234244', 'ravi@yahoo.com', 'Male', 38, 'A+', 'Raichur', 'Hoo'),
('Apeksha', '8565678244', 'appu@yahoo.com', 'Female', 42, 'O-', 'Raichur', 'Nice');

INSERT INTO tbldependents (DonorID, DependentName, Relationship, Age)
VALUES
(1, 'Dependent1', 'Child', 5),
(3, 'Dependent2', 'Spouse', 28);

INSERT INTO tblcontactusinfo (Address, EmailId, ContactNo)
VALUES ('Bangalore', 'nandu@gmail.com', '8585233222');

INSERT INTO tblpages (PageName, type, detail) VALUES
('About Us', 'aboutus', 'Online blood donation system for emergency blood requirements.'),
('Why Become a Donor', 'donor', 'Blood donation saves lives.');

-- =========================
-- FUNCTIONS
-- =========================

DELIMITER $$

-- Function to get donor full name
CREATE FUNCTION GetDonorName(donorId INT)
RETURNS VARCHAR(100)
DETERMINISTIC
BEGIN
  DECLARE donorName VARCHAR(100);
  SELECT FullName INTO donorName FROM tblblooddonars WHERE id = donorId;
  RETURN donorName;
END $$

-- Function to count donors by blood group
CREATE FUNCTION CountByBloodGroup(bloodGroupName VARCHAR(20))
RETURNS INT
DETERMINISTIC
BEGIN
  DECLARE countDonors INT;
  SELECT COUNT(*) INTO countDonors FROM tblblooddonars WHERE BloodGroup = bloodGroupName;
  RETURN countDonors;
END $$

DELIMITER ;

-- =========================
-- STORED PROCEDURES
-- =========================

DELIMITER $$

-- Add new donor
CREATE PROCEDURE AddDonor(
  IN fullName VARCHAR(100),
  IN mobile CHAR(11),
  IN email VARCHAR(100),
  IN gender VARCHAR(20),
  IN age INT,
  IN bloodGroup VARCHAR(20),
  IN address VARCHAR(255),
  IN message TEXT
)
BEGIN
  INSERT INTO tblblooddonars (FullName, MobileNumber, EmailId, Gender, Age, BloodGroup, Address, Message, status)
  VALUES (fullName, mobile, email, gender, age, bloodGroup, address, message, 1);
END $$

-- Update donor status
CREATE PROCEDURE UpdateDonorStatus(
  IN donorId INT,
  IN newStatus INT
)
BEGIN
  UPDATE tblblooddonars
  SET status = newStatus
  WHERE id = donorId;
END $$

-- Search donors by blood group and location
CREATE PROCEDURE SearchDonors(
  IN bg VARCHAR(20),
  IN city VARCHAR(255)
)
BEGIN
  SELECT * FROM tblblooddonars
  WHERE BloodGroup = bg AND Address LIKE CONCAT('%', city, '%') AND status = 1;
END $$

DELIMITER ;

-- =========================
-- TRIGGERS
-- =========================

DELIMITER $$

-- Log donor insertions
CREATE TRIGGER after_donor_insert
AFTER INSERT ON tblblooddonars
FOR EACH ROW
BEGIN
  INSERT INTO donor_logs (donor_id, action)
  VALUES (NEW.id, 'Donor Added');
END $$

-- Log donor deletions
CREATE TRIGGER after_donor_delete
AFTER DELETE ON tblblooddonars
FOR EACH ROW
BEGIN
  INSERT INTO donor_logs (donor_id, action)
  VALUES (OLD.id, 'Donor Deleted');
END $$

-- Log donor updates
CREATE TRIGGER after_donor_update
AFTER UPDATE ON tblblooddonars
FOR EACH ROW
BEGIN
  INSERT INTO donor_logs (donor_id, action)
  VALUES (NEW.id, 'Donor Updated');
END $$

DELIMITER ;

-- ========================================
-- END OF SCRIPT
-- ========================================
