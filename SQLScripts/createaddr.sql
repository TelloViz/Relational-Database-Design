USE schemers;

CREATE TABLE IF NOT EXISTS Addresses (
    AddressID VARCHAR(255) NOT NULL,
    ZipCodeID INT(5) UNSIGNED NOT NULL,
    Time_Stamp DATETIME NOT NULL DEFAULT NOW(),
    StreetAddress VARCHAR(255) NOT NULL,

    FOREIGN KEY (ZipCodeID) REFERENCES ZipCodes (ZipCodeID),
    PRIMARY KEY (AddressID)
);

INSERT INTO Addresses(AddressID,ZipCodeID,Time_Stamp,StreetAddress) VALUES
 ('H9GYP6RL',93242,'NOW()','7783 Vine Street')
,('99jL32w6',93611,'NOW()','12367 Adams St')
,('U7bNwtID',93309,'NOW()','1237 W Eymann Ave')
,('jjSwnj9T',91340,'NOW()','1238 Lonestar Dr')
,('9rQCnJiz',91750,'NOW()','1239 Ashby Ave')
,('R6YJS6Po',91016,'NOW()','12388 Loraine Ave')
,('XGLam0dZ',93901,'NOW()','12373 Windchime Pl')
,('Aad9BPEx',93907,'NOW()','1237 E 24th St')
,('Ir9hq0KU',93926,'NOW()','1237 N Lowery St')
,('088qGXhH',92704,'NOW()','12376 5th St')
,('5QQ13378',92806,'NOW()','1239 Ashby Ave');
