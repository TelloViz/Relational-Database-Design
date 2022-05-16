/*This file creates all of the empty tables 
    involved in the Schemers database. */

USE schemers;

DROP VIEW IF EXISTS EmployerDetailView;
CREATE VIEW EmployerDetailView AS
SELECT E.EmployerName, E.Email, E.Phone, Z.City, Z.StateID, E.employerID
FROM employers AS E 
INNER JOIN Addresses AS A ON E.AddressID = A.AddressID
INNER JOIN ZipCodes AS Z ON A.ZipCodeID = Z.ZipCodeID
ORDER BY E.Time_Stamp DESC;


DROP VIEW IF EXISTS PostPreviewView;
CREATE VIEW PostPreviewView AS
SELECT J.JobPostID, J.Title, J.JobDesc, J.DeadLine,
        E.EmployerID, E.EmployerName,
        A.ZipCodeID,
        Z.City, Z.StateID
FROM JobPosts AS J
INNER JOIN  Employers AS E ON J.EmployerID = E.EmployerID
INNER JOIN Addresses AS A ON E.AddressID = A.AddressID
INNER JOIN ZipCodes AS Z ON A.ZipCodeID = Z.ZipCodeID
ORDER BY J.Time_Stamp DESC;


DROP VIEW IF EXISTS PostDetailView;
CREATE VIEW PostDetailView AS
SELECT J.JobPostID, J.Title, J.JobDesc, J.JobResp, J.JobQual, J.ContactEmail, J.DeadLine,
        E.EmployerID, E.EmployerName,
        A.StreetAddress, A.ZipCodeID,
        Z.City, Z.StateID
FROM JobPosts AS J
INNER JOIN  Employers AS E ON J.EmployerID = E.EmployerID
INNER JOIN Addresses AS A ON E.AddressID = A.AddressID
INNER JOIN ZipCodes AS Z ON A.ZipCodeID = Z.ZipCodeID
ORDER BY J.Time_Stamp DESC;


DROP VIEW IF EXISTS EmployerGT3PostsView;
CREATE VIEW EmployerGT3PostsView AS
SELECT E.EmployerID, E.EmployerName, E.Email AS EmployerEmail,
        U.FirstName, U.LastName, U.Email AS UserEmail,
        COUNT(J.JobPostID) AS JobsPosted
FROM Employers AS E 
INNER JOIN EmployerAdmin AS EA ON EA.EmployerID = E.EmployerID
INNER JOIN UserAccount AS U ON EA.UserID = U.UserID
INNER JOIN JobPosts AS J ON E.EmployerID = J.EmployerID
GROUP BY E.EmployerID
HAVING COUNT(J.JobPostID) >= 3 
ORDER BY E.Time_Stamp DESC;

DROP VIEW IF EXISTS EmployeesWhoApplied;
CREATE VIEW EmployeesWhoApplied AS
SELECT U.FirstName, U.LastName, U.Email AS UserEmail,
        COUNT(AP.JobPostID) AS JobsAppliedTo
FROM UserAccount AS U
INNER JOIN Employee AS EE ON U.EmployeeID = EE.EmployeeID
INNER JOIN AppliedPosts AS AP ON EE.EmployeeID = AP.EmployeeID
GROUP BY U.UserID
HAVING COUNT(AP.JobPostID) >= 1 
ORDER BY U.Time_Stamp DESC;

DROP VIEW IF EXISTS EmployeesAndEmployers;
CREATE VIEW EmployeesAndEmployers AS
SELECT useraccount.FirstName, useraccount.LastName, useraccount.EmployeeID, employeradmin.EmployerID 
FROM useraccount, employeradmin WHERE useraccount.EmployeeID IS NOT NULL 
AND useraccount.UserID = employeradmin.UserID
ORDER BY employeradmin.Time_Stamp DESC;
