USE schemers;

CREATE TABLE IF NOT EXISTS Education(
    EducationID INT(5) NOT NULL UNIQUE,
    Title VARCHAR(255) NOT NULL,
    Time_Stamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (EducationID)
);

INSERT INTO Education(EducationID,Title,Time_Stamp) 
VALUES 
    (0, "Highschool", NOW()),
    (1, "Associates", NOW()),
    (2, "Bachelors", NOW()),
    (3, "Graduate", NOW());
