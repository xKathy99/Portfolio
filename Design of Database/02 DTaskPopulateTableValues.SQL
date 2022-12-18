#Double check values
#02 DTaskPopulateTableValues.SQL

USE DTaskWalmart;


#=====================================================
#WalmartIncSegment #If have error check Sams Club Entry

INSERT INTO WalmartIncSegment(sgID, sgName)
VALUES ('WUS', 'Walmart US');

INSERT INTO WalmartIncSegment(sgID, sgName)
VALUES ('WIN', 'Walmart International');

INSERT INTO WalmartIncSegment(sgID, sgName)
VALUES ('SCB', "Sam's Club");


#=====================================================
#GovernanceGroups 

INSERT INTO GovernanceGroups(gpID, gpName)
VALUES ('EXM', 'Executive Management');

INSERT INTO GovernanceGroups(gpID, gpName)
VALUES ('BOD', 'Board of Directors');

INSERT INTO GovernanceGroups(gpID, gpName)
VALUES ('INV', 'Investors');

#=====================================================
#GovenorDetails

INSERT INTO GovenorDetails(ldIC, ldName, ldGend, ldCountry)
VALUES ('1000001', 'Jon Furner', 'M', 'USA');

INSERT INTO GovenorDetails(ldIC, ldName, ldGend, ldCountry)
VALUES ('2000002', 'Judith McKenna', 'F', 'USA');

INSERT INTO GovenorDetails(ldIC, ldName, ldGend, ldCountry)
VALUES ('3000003', 'Kathryn McLay', 'F', 'USA');

INSERT INTO GovenorDetails(ldIC, ldName, ldGend, ldCountry)
VALUES ('4000004', 'Meng Chee', 'M', 'USA');

INSERT INTO GovenorDetails(ldIC, ldName, ldGend, ldCountry)
VALUES ('5000005', 'Amanda Whalen', 'F', 'USA');

INSERT INTO GovenorDetails(ldIC, ldName, ldGend, ldCountry)
VALUES ('6000006', 'Lance de la Rosa', 'M', 'USA');

INSERT INTO GovenorDetails(ldIC, ldName, ldGend, ldCountry)
VALUES ('7000007', 'Tom Horton', 'M', 'USA');

INSERT INTO GovenorDetails(ldIC, ldName, ldGend, ldCountry)
VALUES ('8000008', 'Steuart Walton ', 'M', 'USA');

INSERT INTO GovenorDetails(ldIC, ldName, ldGend, ldCountry)
VALUES ('9000009', 'Carla A. Harris ', 'F', 'USA');

INSERT INTO GovenorDetails(ldIC, ldName, ldGend, ldCountry)
VALUES ('1010010', 'Marc E. Lore ', 'M', 'USA');


#=====================================================
#CorporateGovernance

INSERT INTO CorporateGovernance(sgID, gpID, ldPos, ldRole, ldIC)
VALUES ('WUS', 'EXM', 'PD', 'CEO', '1000001');

INSERT INTO CorporateGovernance(sgID, gpID, ldPos, ldRole, ldIC)
VALUES ('WIN', 'EXM', 'PD', 'CEO', '2000002');

INSERT INTO CorporateGovernance(sgID, gpID, ldPos, ldRole, ldIC)
VALUES ('SCB', 'EXM', 'PD', 'CEO', '3000003');

INSERT INTO CorporateGovernance(sgID, gpID, ldPos, ldRole, ldIC)
VALUES ('WUS', 'EXM', 'VP', 'Product Officer', '4000004');

INSERT INTO CorporateGovernance(sgID, gpID, ldPos, ldRole, ldIC)
VALUES ('WIN', 'EXM', 'VP', 'Financial Officer', '5000005');

INSERT INTO CorporateGovernance(sgID, gpID, ldPos, ldRole, ldIC)
VALUES ('SCB', 'EXM', 'VP', 'Operating Officer', '6000006');

INSERT INTO CorporateGovernance(sgID, gpID, ldPos, ldRole, ldIC)
VALUES ('WUS', 'BOD', 'DIR', 'Independent Director', '7000007');

INSERT INTO CorporateGovernance(sgID, gpID, ldPos, ldRole, ldIC)
VALUES ('WUS', 'BOD', 'CM', 'Investments', '8000008');

INSERT INTO CorporateGovernance(sgID, gpID, ldPos, ldRole, ldIC)
VALUES ('WUS', 'BOD', 'VCM', 'Wealth Management', '9000009');

INSERT INTO CorporateGovernance(sgID, gpID, ldPos, ldRole, ldIC)
VALUES ('WUS', 'INV', 'SH', 'Pref. Shareholder', '1010010');


#=====================================================
#SegmentBranches

INSERT INTO SegmentBranches(sgID, brID, brCountry, brZIP, brAdd)
VALUES ('WUS', '0001', 'USA', '72756', '719 W Walnut Street');

INSERT INTO SegmentBranches(sgID, brID, brCountry, brZIP, brAdd)
VALUES ('WUS', '0002', 'USA', '75001', '15220 Montford Rd');

INSERT INTO SegmentBranches(sgID, brID, brCountry, brZIP, brAdd)
VALUES ('WUS', '0003', 'USA', '94204', '4675 Watt Ave');

INSERT INTO SegmentBranches(sgID, brID, brCountry, brZIP, brAdd)
VALUES ('WIN', '0001', 'CHN', '510810', 'Shihai Gas Station Right');

INSERT INTO SegmentBranches(sgID, brID, brCountry, brZIP, brAdd)
VALUES ('WIN', '0002', 'IND', '492008', 'Ring Road No 2 Bhilai-Bilaspur Bypass');

INSERT INTO SegmentBranches(sgID, brID, brCountry, brZIP, brAdd)
VALUES ('WIN', '0003', 'MEX', '21511', 'Canyon of Goats 22226');

INSERT INTO SegmentBranches(sgID, brID, brCountry, brZIP, brAdd)
VALUES ('WIN', '0004', 'CAN', 'R2V  4J6', '2370 McPhillips St');

INSERT INTO SegmentBranches(sgID, brID, brCountry, brZIP, brAdd)
VALUES ('SCB', '0001', 'USA', '82006', '1948 Dell Range Blvd');

INSERT INTO SegmentBranches(sgID, brID, brCountry, brZIP, brAdd)
VALUES ('SCB', '0002', 'USA', '32004', '3921 SW College Rd');

INSERT INTO SegmentBranches(sgID, brID, brCountry, brZIP, brAdd)
VALUES ('SCB', '0003', 'USA',  '15202', '6211 Route 30 Greensburg');


#=====================================================
#StaffWorkerDetails

INSERT INTO StaffWorkerDetails(wIC, wName, wGend, wCountry, wIns)
VALUES ('1110001', 'Brian Neil', 'M', 'USA', 'Walmart Ins.');

INSERT INTO StaffWorkerDetails(wIC, wName, wGend, wCountry, wIns)
VALUES ('2220002', 'Brittaney Fae', 'F', 'USA', 'Prudential Ins.');

INSERT INTO StaffWorkerDetails(wIC, wName, wGend, wCountry, wIns)
VALUES ('3330003', 'Nick Morris', 'M', 'USA', 'Walmart Ins.');

INSERT INTO StaffWorkerDetails(wIC, wName, wGend, wCountry, wIns)
VALUES ('4440004', 'Wee Li Ting', 'F', 'CHN', 'BOCOM Ins.');

INSERT INTO StaffWorkerDetails(wIC, wName, wGend, wCountry, wIns)
VALUES ('5550005', 'Aarav Prasboth', 'M', 'IND', 'United India Ins.');

INSERT INTO StaffWorkerDetails(wIC, wName, wGend, wCountry, wIns)
VALUES ('6660006', 'Jose Luis', 'M', 'MEX', 'Oscar Padilla Ins.');

INSERT INTO StaffWorkerDetails(wIC, wName, wGend, wCountry, wIns)
VALUES ('7770007', 'Lisa Barnes', 'F', 'CAN', 'Sun Life Assurance Ins.');

INSERT INTO StaffWorkerDetails(wIC, wName, wGend, wCountry, wIns)
VALUES ('8880008', 'Sam Meyers', 'U', 'USA', 'Prudential Ins.');

INSERT INTO StaffWorkerDetails(wIC, wName, wGend, wCountry, wIns)
VALUES ('9990009', 'Tania Grace', 'F', 'MEX', 'Prudential Ins.');

INSERT INTO StaffWorkerDetails(wIC, wName, wGend, wCountry, wIns)
VALUES ('1011110', 'Aaron Daniels', 'M', 'MEX', 'Walmart Ins.');


#=====================================================
#StaffWorker

INSERT INTO StaffWorker(wIC, sgID, brID, wPos, wType, wSalPerHour)
VALUES ('1110001', 'WUS', '0001', 'MAN', 'FT', '30.00');

INSERT INTO StaffWorker(wIC, sgID, brID, wPos, wType, wSalPerHour)
VALUES ('2220002', 'WUS', '0001', 'SPV', 'FT', '25.00');

INSERT INTO StaffWorker(wIC, sgID, brID, wPos, wType, wSalPerHour)
VALUES ('3330003', 'WUS', '0001', 'CLK', 'PT', '12.00');

INSERT INTO StaffWorker(wIC, sgID, brID, wPos, wType, wSalPerHour)
VALUES ('4440004', 'WIN', '0001', 'SPV', 'FT', '25.00');

INSERT INTO StaffWorker(wIC, sgID, brID, wPos, wType, wSalPerHour)
VALUES ('5550005', 'WIN', '0002', 'SPV', 'FT', '25.00');

INSERT INTO StaffWorker(wIC, sgID, brID, wPos, wType, wSalPerHour)
VALUES ('6660006', 'WIN', '0003', 'MAN', 'FT', '30.00');

INSERT INTO StaffWorker(wIC, sgID, brID, wPos, wType, wSalPerHour)
VALUES ('7770007', 'WIN', '0004', 'MAN', 'FT', '30.00');

INSERT INTO StaffWorker(wIC, sgID, brID, wPos, wType, wSalPerHour)
VALUES ('8880008', 'SCB', '0001', 'SPV', 'FT', '25.00');

INSERT INTO StaffWorker(wIC, sgID, brID, wPos, wType, wSalPerHour)
VALUES ('9990009', 'SCB', '0002', 'CSH', 'PT', '12.00');

INSERT INTO StaffWorker(wIC, sgID, brID, wPos, wType, wSalPerHour)
VALUES ('1011110', 'SCB', '0003', 'JAN', 'PT', '15.00');


#=====================================================
#SupplierDetails

INSERT INTO SupplierDetails(sID, sName, sCountry, sZIP)
VALUES ('S0000001', 'Sunshine Health Co', 'USA', '72756');

INSERT INTO SupplierDetails(sID, sName, sCountry, sZIP)
VALUES ('S0000002', 'Corns Pte Ltd', 'USA', '75001');

INSERT INTO SupplierDetails(sID, sName, sCountry, sZIP)
VALUES ('S0000003', 'Household Goods Ltd', 'USA', '94204');

INSERT INTO SupplierDetails(sID, sName, sCountry, sZIP)
VALUES ('S0000004', 'Xiang Xiang Co', 'CHN', '510810');

INSERT INTO SupplierDetails(sID, sName, sCountry, sZIP)
VALUES ('S0000005', 'GenGood Goods Pte Ltd', 'IND', '492008');

INSERT INTO SupplierDetails(sID, sName, sCountry, sZIP)
VALUES ('S0000006', 'Salud Wellness Co', 'MEX', '21511');

INSERT INTO SupplierDetails(sID, sName, sCountry, sZIP)
VALUES ('S0000007', 'Kistchener Pte Ltd', 'CAN', 'R2V  4J6');

INSERT INTO SupplierDetails(sID, sName, sCountry, sZIP)
VALUES ('S0000008', 'Homegrown Foods Ltd', 'USA', '82006');

INSERT INTO SupplierDetails(sID, sName, sCountry, sZIP)
VALUES ('S0000009', 'FoodGroPro Co', 'USA', '32004');

INSERT INTO SupplierDetails(sID, sName, sCountry, sZIP)
VALUES ('S0000010', 'Motley Suppliers Pte Ltd', 'USA', '15202');


#=====================================================
#ProductDetails

INSERT INTO ProductDetails(pEAN, pName, halal)
VALUES ('1002801880019', 'Calcium Tablets', 'Y');

INSERT INTO ProductDetails(pEAN, pName, halal)
VALUES ('2222803820019', 'Baby Corns Chips', 'N');

INSERT INTO ProductDetails(pEAN, pName, halal)
VALUES ('3998781145393', 'Lawn Chair', 'X');

INSERT INTO ProductDetails(pEAN, pName, halal)
VALUES ('4712758087283', 'Smoked Bacon', 'N');

INSERT INTO ProductDetails(pEAN, pName, halal)
VALUES ('5907785024212', 'Wholemeal Biscuits', 'Y');

INSERT INTO ProductDetails(pEAN, pName, halal)
VALUES ('6785215678902', 'Facial Mask', 'X');

INSERT INTO ProductDetails(pEAN, pName, halal)
VALUES ('7700012893943', 'Induction Cooker', 'X');

INSERT INTO ProductDetails(pEAN, pName, halal)
VALUES ('8263999974260', 'Cooking Oats', 'Y');

INSERT INTO ProductDetails(pEAN, pName, halal)
VALUES ('9000002155632', 'Fresh Tomatoes', 'Y');

INSERT INTO ProductDetails(pEAN, pName, halal)
VALUES ('0999999001375', 'Samsung Fridge', 'X');


#=====================================================
#Products

INSERT INTO Products(pEAN, pCat, sID)
VALUES ('1002801880019', 'HNW', 'S0000001');

INSERT INTO Products(pEAN, pCat, sID)
VALUES ('2222803820019', 'GRO', 'S0000002');

INSERT INTO Products(pEAN, pCat, sID)
VALUES ('3998781145393', 'GEN', 'S0000003');

INSERT INTO Products(pEAN, pCat, sID)
VALUES ('4712758087283', 'GRO', 'S0000004');

INSERT INTO Products(pEAN, pCat, sID)
VALUES ('5907785024212', 'GRO', 'S0000005');

INSERT INTO Products(pEAN, pCat, sID)
VALUES ('6785215678902', 'HNW', 'S0000006');

INSERT INTO Products(pEAN, pCat, sID)
VALUES ('7700012893943', 'GEN', 'S0000007');

INSERT INTO Products(pEAN, pCat, sID)
VALUES ('8263999974260', 'GRO', 'S0000008');

INSERT INTO Products(pEAN, pCat, sID)
VALUES ('9000002155632', 'GRO', 'S0000009');

INSERT INTO Products(pEAN, pCat, sID)
VALUES ('0999999001375', 'GEN', 'S0000010');


#=====================================================
#BranchProductDetails

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0001', '1002801880019', '50.00', '280');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0001', '2222803820019', '7.00', '500');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0001', '3998781145393', '25.00', '300');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0001', '4712758087283', '18.00', '500');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0001', '5907785024212', '12.00', '250');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0002', '6785215678902', '16.00', '600');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0002', '7700012893943', '450.00', '200');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0002', '8263999974260', '28.00', '500');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0002', '9000002155632', '7.00', '600');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0002', '0999999001375', '1258.00', '200');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WUS', '0003', '1002801880019', '60.00', '300');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WIN', '0001', '2222803820019', '10.00', '400');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WIN', '0002', '3998781145393', '35.00', '200');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WIN', '0003', '4712758087283', '16.00', '400');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('WIN', '0004', '5907785024212', '10.00', '300');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('SCB', '0001', '6785215678902', '12.00', '550');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('SCB', '0002', '7700012893943', '300.00', '200');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('SCB', '0003', '8263999974260', '28.00', '300');

INSERT INTO BranchProductDetails(sgID, brID, pEAN, brPrice, brReorder)
VALUES ('SCB', '0001', '1002801880019', '75.00', '200');

