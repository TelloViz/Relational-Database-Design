/*This file creates all of the empty tables 
    involved in the Schemers database. */

USE schemers;

DROP VIEW IF EXISTS EmployerDetailView;

CREATE VIEW EmployerDetailView AS
SELECT E.EmployerName, E.Email, E.Phone, Z.City, Z.StateID, E.employerID
FROM employers AS E 
INNER JOIN Addresses AS A ON E.AddressID = A.AddressID
INNER JOIN ZipCodes AS Z ON A.ZipCodeID = Z.ZipCodeID;