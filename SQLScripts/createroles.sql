USE schemers;

CREATE TABLE IF NOT EXISTS Roles (
    RoleID INT(5) NOT NULL UNIQUE,
    Title VARCHAR(255) NOT NULL,
    Time_Stamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (RoleID)
);

INSERT INTO Roles(RoleID,Title,Time_Stamp) 
VALUES 
    (0, "Owner", NOW()),
    (1, "CEO", NOW()),
    (2, "Assistant/Manager", NOW()),
    (3, "Human Resources Generalist", NOW()),
    (4, "Hiring Manager", NOW()),
    (5, "Recruiter", NOW()),
    (6, "Other", NOW());
