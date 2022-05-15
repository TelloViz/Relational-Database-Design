/*This file creates all of the empty tables 
    involved in the Schemers database. */

USE schemers;

DROP VIEW IF EXISTS EmployerDetailView;

CREATE VIEW EmployerDetailView AS
SELECT E.EmployerName, E.Email, E.Phone, Z.City, Z.StateID, E.employerID
FROM employers AS E 
INNER JOIN Addresses AS A ON E.AddressID = A.AddressID
INNER JOIN ZipCodes AS Z ON A.ZipCodeID = Z.ZipCodeID;


DROP VIEW IF EXISTS PostDetailView;

CREATE VIEW PostPreviewView AS
SELECT J.JobPostID, J.Title, J.JobDesc, J.DeadLine,
        E.EmployerID, E.EmployerName,
        A.ZipCodeID,
        Z.City, Z.StateID
        FROM JobPosts AS J
INNER JOIN  Employers AS E ON J.JobPostID = E.EmployerID
INNER JOIN Addresses AS A ON E.AddressID = A.AddressID
INNER JOIN ZipCodes AS Z ON A.ZipCodeID = Z.ZipCodeID;


CREATE VIEW PostDetailView AS
SELECT J.JobPostID, J.Title, J.JobDesc, J.JobResp, J.JobQual, J.ContactEmail, J.DeadLine,
        E.EmployerID, E.EmployerName,
        A.StreetAddress, A.ZipCodeID,
        Z.City, Z.StateID
        FROM JobPosts AS J
INNER JOIN  Employers AS E ON J.JobPostID = E.EmployerID
INNER JOIN Addresses AS A ON E.AddressID = A.AddressID
INNER JOIN ZipCodes AS Z ON A.ZipCodeID = Z.ZipCodeID;