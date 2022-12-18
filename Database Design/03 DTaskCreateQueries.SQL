#03 DTaskCreateQueries.SQL

use DTaskWalmart;


#=====================================================
#Create view for CorGovDemographics

#DROP VIEW CorGovDemographics;
CREATE VIEW CorGovDemographics AS
SELECT g.*, c.sgID, c.gpID, c.ldPos, c.ldRole
FROM GovenorDetails g
RIGHT JOIN CorporateGovernance c
ON g.ldIC = c.ldIC;


#=====================================================
#Create view for StaffWorkerDemographics

#DROP VIEW StaffWorkerDemographics;
CREATE VIEW StaffWorkerDemographics AS
SELECT d.wName, d.wGend, d.wCountry, d.wIns, s.*
FROM StaffWorkerDetails d
LEFT JOIN StaffWorker s
ON d.wIC = s.wIC;


#=====================================================
#Create view for SuppliersAndProducts

#DROP VIEW SuppliersAndProducts;
CREATE VIEW SuppliersAndProducts AS
SELECT sd.*, p.pCat, pd.*, bpd.sgID, bpd.brID, bpd.brPrice, bpd.brReorder, sb.brCountry, sb.brZIP, sb.brAdd
FROM SupplierDetails sd
LEFT JOIN Products p
ON sd.sID = p.sID
LEFT JOIN ProductDetails pd
ON pd.pEAN = p.pEAN
LEFT JOIN BranchProductDetails bpd
ON p.pEAN = bpd.pEAN
LEFT JOIN SegmentBranches sb
ON bpd.sgID = sb.sgID AND bpd.brID = sb.brID;


#=====================================================
#Create view for Branches 

#DROP VIEW Branches;
CREATE VIEW Branches AS
SELECT sb.*, wsg.sgName
FROM SegmentBranches sb 
JOIN WalmartIncSegment wsg
ON sb.sgID = wsg.sgID;


#=====================================================
#UseCase 01 Query

SELECT COUNT(gpID) AS TotalInvestors
FROM CorGovDemographics
WHERE gpID = 'INV';


#=====================================================
#UseCase 02 Query

SELECT ldGend AS GenderType,
CONCAT(COUNT(ldGend)/(SELECT COUNT(*) FROM CorGovDemographics)*100, "%") AS Percentage
FROM CorGovDemographics
GROUP BY ldGend;


#=====================================================
#UseCase 03 Query

SELECT 
CONCAT(sgID, brID) AS SegmentBranch,
wCountry AS Country,
CONCAT(COUNT(wCountry)/(SELECT COUNT(*) FROM StaffWorkerDemographics)*100, "%") AS PercentageDistribution
FROM StaffWorkerDemographics
GROUP BY SegmentBranch;


#=====================================================
#UseCase 04 Query

SELECT CONCAT(sgID, brID) AS Branch,
(SELECT COUNT(*) FROM StaffWorkerDemographics WHERE sgID = 'WUS' AND brID = 0001) AS TotalStaffWorkersAtBranch,
COUNT(wType) AS TotalFullTime,
CONCAT( (COUNT(wType)/(SELECT COUNT(*) FROM StaffWorkerDemographics WHERE sgID = 'WUS' AND brID = 0001))*100, '%')
AS PercentageFullTime
FROM StaffWorkerDemographics
WHERE wType = 'FT' AND sgID = 'WUS' AND brID = 0001;


#=====================================================
#UseCase 05 Query

SELECT brCountry AS LocatedCountry,
CONCAT(sgID, brID) AS Branch,
SUM(wSalPerHour) AS TotalSalaryPerHour
FROM BranchFinancials
GROUP BY Branch
ORDER BY TotalSalaryPerHour ASC;


#=====================================================
#UseCase 06 Query

SELECT sName AS SupplierName,
COUNT(*) as NumberBranchesSupplied
FROM SuppliersAndProducts
GROUP BY sName
ORDER BY NumberBranchesSupplied DESC;


#=====================================================
#UseCase 07 Query

SELECT sCountry AS SupplierCountry,
CONCAT((COUNT(distinct sID)/(SELECT COUNT(distinct sID) FROM SuppliersAndProducts) )*100, "%") AS Percentage
FROM SuppliersAndProducts
GROUP BY sCountry;


#=====================================================
#UseCase 08 Query

SELECT pName AS HalalProducts,
CONCAT(sgID, brID) AS AvailableAtWhichBranch,
CONCAT(brCountry, ", ", brZIP) AS BranchLocation
FROM SuppliersAndProducts
WHERE halal = 'Y'
ORDER BY HalalProducts;


#=====================================================
#UseCase 09 Query

SELECT pName AS ProductName,
CONCAT(sgID, brID) AS AvailableAtWhichBranch, brPrice, brReorder
FROM SuppliersAndProducts
WHERE pEAN = '1002801880019'
ORDER BY brReorder DESC;


#=====================================================
#UseCase 10 Query

SELECT sgName AS StoreName,
CONCAT(sgID, brID) AS SegmentBranch,
CONCAT(brAdd, ", ", brZIP) AS Location
FROM Branches
WHERE brCountry = 'USA'
ORDER BY brZIP ASC;

