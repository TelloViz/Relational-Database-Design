USE schemers;

-- Base data tables with no foreign keys
CREATE TABLE IF NOT EXISTS AppStatus (
    AppStatusID INT(2) NOT NULL UNIQUE,
    Title VARCHAR(255) NOT NULL,
    Time_Stamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (AppStatusID)
);

INSERT INTO AppStatus(AppStatusID,Title,Time_Stamp) 
VALUES 
(
    0, "Processing", NOW()),
    (1, "Approved", NOW()),
    (2, "Rejected", NOW()),
    (3, "Final Review", NOW());
