USE schemers;

CREATE TABLE IF NOT EXISTS Benefits (
    BenefitID INT(5) NOT NULL,
    Title VARCHAR(255) NOT NULL,
    Time_Stamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (BenefitID)
);

INSERT INTO Benefits(BenefitID,Title,Time_Stamp) 
VALUES 
    (0, "Health Insurance", NOW()),
    (1, "Vision Insurance", NOW()),
    (2, "Dental Insurance", NOW()),
    (3, "Life Insurance", NOW()),
    (4, "Pension", NOW()),
    (5, "401k", NOW());
