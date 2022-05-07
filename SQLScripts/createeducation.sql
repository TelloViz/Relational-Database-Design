USE schemers;

CREATE TABLE IF NOT EXISTS Education(
    EducationID INT(5) NOT NULL UNIQUE,
    Title VARCHAR(255) NOT NULL,
    Time_Stamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (EducationID)
);

INSERT INTO Education(EducationID,Title,Time_Stamp) 
VALUES 
    (0, "No Education Required", NOW()),
    (1, "High School Degree", NOW()),
    (2, "Associate's Degree", NOW()),
    (3, "Bachelor's Degree", NOW()),
    (4, "Master's Degree", NOW()),
    (5, "Doctoral Degree", NOW());
