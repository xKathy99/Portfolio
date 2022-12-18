#IF CODE DOES NOT WORK, DECLARE FOREIGN KEY FIRST THEN PRIMARY KEY
#CHECKED 01/06/20121-- declare FK before PK
#CHECKED when referencing 2 FK from the same table, do FOREIGN KEY(attribute1, attribute2) REFERENCES(attribute1, attribute2)
#01 DTaskCreateTables.SQL


#DROP DATABASE DTaskWalmart;
CREATE DATABASE DTaskWalmart;

use DTaskWalmart;

CREATE TABLE WalmartIncSegment (
	sgID CHAR(3) NOT NULL PRIMARY KEY ,
	sgName VARCHAR(25)   
);

CREATE TABLE GovernanceGroups (
	gpID CHAR(3) NOT NULL PRIMARY KEY,
	gpName VARCHAR(20)  
);

CREATE TABLE GovenorDetails (
	ldIC CHAR(7) NOT NULL PRIMARY KEY,
	ldName VARCHAR(30),
	ldGend CHAR(1) CHECK(ldGend IN('M','F','U')), 
	ldCountry CHAR(3)
);
	
CREATE TABLE CorporateGovernance (
	sgID CHAR(3) NOT NULL, 
	gpID CHAR(3) NOT NULL,
	ldPos VARCHAR(3) NOT NULL,
	ldRole VARCHAR(20),
	ldIC CHAR(7),
	PRIMARY KEY(sgID, gpID, ldPos),
	FOREIGN KEY(sgID) REFERENCES WalmartIncSegment(sgID),
	FOREIGN KEY(ldIC) REFERENCES GovenorDetails(ldIC)
);

CREATE TABLE SegmentBranches (
	sgID CHAR(3) NOT NULL,
	brID CHAR(4) NOT NULL,
	brCountry CHAR(3),
	brZIP VARCHAR(10),
	brAdd VARCHAR(40),
	PRIMARY KEY(sgID, brID),
	FOREIGN KEY(sgID) REFERENCES WalmartIncSegment(sgID)
);

CREATE TABLE StaffWorkerDetails (
	wIC CHAR(7) NOT NULL PRIMARY KEY, 
	wName VARCHAR(30), 
	wGend CHAR(1) CHECK(wGend IN('M','F','U')),
	wCountry CHAR(3),
	wIns VARCHAR(35)
);

CREATE TABLE StaffWorker (
	wIC CHAR(7) NOT NULL, 
	sgID CHAR(3) NOT NULL,
	brID CHAR(4) NOT NULL,
	wPos VARCHAR(3),
	wType CHAR(2),
	wSalPerHour DOUBLE(4,2), #Total 4 digits, 2 of them is after the decimal
	FOREIGN KEY(wIC) REFERENCES StaffWorkerDetails(wIC),
	FOREIGN KEY(sgID, brID) REFERENCES SegmentBranches(sgID, brID),
	PRIMARY KEY(wIC, sgID, brID)
);

CREATE TABLE SupplierDetails (
	sID CHAR(8) NOT NULL PRIMARY KEY,
	sName VARCHAR(30), 
	sCountry CHAR(3),
	sZIP VARCHAR(10)
);

CREATE TABLE ProductDetails (
	pEAN CHAR(13) NOT NULL PRIMARY KEY,
	pName VARCHAR(20),
	halal CHAR(1) CHECK(attribute IN('Y','N','X'))
);

CREATE TABLE Products (
	pEAN CHAR(13) NOT NULL,
	pCat CHAR(3) CHECK(pCat IN('GRO','HNW','GEN')),
	sID CHAR(8) NOT NULL,
	FOREIGN KEY(pEAN) REFERENCES ProductDetails(pEAN),
	FOREIGN KEY(sID) REFERENCES SupplierDetails(sID),
	PRIMARY KEY(pEAN, sID)
);

CREATE TABLE BranchProductDetails (
	sgID CHAR(3) NOT NULL,
	brID CHAR(4) NOT NULL,
	pEAN CHAR(13) NOT NULL,
	brPrice DOUBLE(6,2),
	brReorder INT(3),
	FOREIGN KEY(sgID, brID) REFERENCES SegmentBranches(sgID, brID),
	FOREIGN KEY(pEAN) REFERENCES Products(pEAN),
	PRIMARY KEY(sgID, brID, pEAN)
);
