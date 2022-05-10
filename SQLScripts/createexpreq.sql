USE schemers;


CREATE TABLE IF NOT EXISTS ExpReq (
    ExpReqID INT(2) NOT NULL,
    Title VARCHAR(255) NOT NULL,
    Time_Stamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (ExpReqID)
);

INSERT INTO ExpReq(ExpReqID,Title,Time_Stamp) 
VALUES 
    (0, "Entry level", NOW()),
    (1, "Mid-Level", NOW()),
    (2, "Senior Level", NOW());