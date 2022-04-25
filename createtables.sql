CREATE SCHEMA schemers;
USE schemers;

-- Address Stuff
CREATE TABLE IF NOT EXISTS States (
    StateID VARCHAR(2) NOT NULL,
    StateName VARCHAR(30) NOT NULL,
    
    PRIMARY KEY (StateID)
);

CREATE TABLE IF NOT EXISTS ZipCodes (
    ZipCodeID INT(5) UNSIGNED NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW() NOT NULL,
    StateID VARCHAR(2) NOT NULL,
    City VARCHAR(255) NOT NULL,
    
    FOREIGN KEY (StateID) REFERENCES States (StateID),
    PRIMARY KEY (ZipCodeID)
);

CREATE TABLE IF NOT EXISTS Addresses (
    AddressID VARCHAR(255) NOT NULL,
    ZipCodeID INT(5) UNSIGNED NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    StreetAddress VARCHAR(255) NOT NULL,

    FOREIGN KEY (ZipCodeID) REFERENCES ZipCodes (ZipCodeID),
    PRIMARY KEY (AddressID)
);


-- Base data tables with no foreign keys
CREATE TABLE IF NOT EXISTS AppStatus (
    AppStatusID INT(2) NOT NULL UNIQUE,
    Title VARCHAR(255) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (AppStatusID)
);

CREATE TABLE IF NOT EXISTS Education(
    EducationID INT(5) NOT NULL UNIQUE,
    Title VARCHAR(255) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (EducationID)
);

CREATE TABLE IF NOT EXISTS Roles (
    RoleID INT(5) NOT NULL UNIQUE,
    Title VARCHAR(255) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (RoleID)
);


CREATE TABLE IF NOT EXISTS Benefits (
    BenefitID INT(5) NOT NULL,
    Title VARCHAR(255) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (BenefitID)
);

CREATE TABLE IF NOT EXISTS ExpReq (
    ExpReqID INT(2) NOT NULL,
    Title VARCHAR(255) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (ExpReqID)
);

CREATE TABLE IF NOT EXISTS JobTypes (
    JobTypeID INT(10) UNSIGNED NOT NULL,
    Title VARCHAR(255) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (JobTypeID)
);


-- foreign key tables

CREATE TABLE IF NOT EXISTS Employee (
    EmployeeID INT(10) NOT NULL UNIQUE,
    EducationID INT(5) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (EmployeeID),
    FOREIGN KEY (EducationID) REFERENCES Education(EducationID)
);


CREATE TABLE IF NOT EXISTS UserAccount (
    UserID INT(10) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    EmployeeID INT(10) UNIQUE,
    FirstName VARCHAR(30) NOT NULL,
    LastName VARCHAR(30) NOT NULL,
    Phone  VARCHAR(15),
    Password VARCHAR(255) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),

    PRIMARY KEY (UserID),
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID)
);

CREATE TABLE IF NOT EXISTS Employers (
    EmployerID INT(10) NOT NULL,
    AddressID VARCHAR(255) NOT NULL,
    EmployerName VARCHAR(30) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Phone  VARCHAR(15),
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),

    PRIMARY KEY (EmployerID),
    FOREIGN KEY (AddressID) REFERENCES Addresses(AddressID)
);

CREATE TABLE IF NOT EXISTS EmployerAdmin (
    UserID INT(10) NOT NULL,
    EmployerID INT(10) NOT NULL,
    RoleID INT(5) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY (UserID, EmployerID),
    FOREIGN KEY (UserID) REFERENCES UserAccount(UserID),
    FOREIGN KEY (EmployerID) REFERENCES Employers(EmployerID)
);

CREATE TABLE IF NOT EXISTS JobPosts (
    JobPostID INT(5) NOT NULL,
    EmployerID INT(10) NOT NULL,
    EducationID INT(5) NOT NULL,
    JobTypeID INT(10) UNSIGNED NOT NULL,
    ExpReqID  INT(2) NOT NULL,
    AddressID VARCHAR(255) NOT NULL,
    SalaryMin INT(10) UNSIGNED NOT NULL,
    SalaryMax INT(10) UNSIGNED,
    CONSTRAINT SMaxAboveSMin CHECK( SalaryMax >= SalaryMin ),

    Title VARCHAR(255) NOT NULL,
    JobDesc TEXT,
    JobResp TEXT,
    JobQual TEXT,
    ContactEmail VARCHAR(255) NOT NULL,
    ContactPhone  VARCHAR(15),
    ContactMessage TEXT,

    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    DatePosted DATETIME,
    DeadLine DATETIME,

    PRIMARY KEY (JobPostID),
    FOREIGN KEY (EmployerID) REFERENCES Employers(EmployerID),
    FOREIGN KEY (EducationID) REFERENCES Education(EducationID),
    FOREIGN KEY (JobTypeID) REFERENCES JobTypes(JobTypeID),
    FOREIGN KEY (ExpReqID) REFERENCES ExpReq(ExpReqID),
    FOREIGN KEY (AddressID) REFERENCES Addresses(AddressID)
);


-- require job foreign key
CREATE TABLE IF NOT EXISTS JobBenefits (
    BenefitID INT(5) NOT NULL,
    JobPostID INT(5) NOT NULL,
    Title VARCHAR(255) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),

    PRIMARY KEY (BenefitID, JobPostID),
    FOREIGN KEY (JobPostID) REFERENCES JobPosts(JobPostID),
    FOREIGN KEY (BenefitID) REFERENCES Benefits(BenefitID)
);

CREATE TABLE IF NOT EXISTS SavedPosts (
    EmployeeID INT(10) NOT NULL,
    JobPostID INT(5) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID),
    FOREIGN KEY (JobPostID) REFERENCES JobPosts(JobPostID),
    PRIMARY KEY (EmployeeID, JobPostID)
);

CREATE TABLE IF NOT EXISTS AppliedPosts (
    EmployeeID INT(10) NOT NULL,
    JobPostID INT(5) NOT NULL,
    AppStatusID INT(2) NOT NULL,
    TimeStamp DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID),
    FOREIGN KEY (JobPostID) REFERENCES JobPosts(JobPostID),
    FOREIGN KEY (AppStatusID) REFERENCES AppStatus(AppStatusID),
    PRIMARY KEY (EmployeeID, JobPostID)
);
