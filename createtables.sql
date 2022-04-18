CREATE DOMAIN TYPE_timestamp AS DATETIME NOT NULL DEFAULT GETTIME();
CREATE DOMAIN TYPE_shortname AS VARCHAR(30);
CREATE DOMAIN TYPE_email AS VARCHAR(255);
CREATE DOMAIN TYPE_phone AS VARCHAR(15);
CREATE DOMAIN TYPE_address AS VARCHAR(255);
CREATE DOMAIN TYPE_title AS VARCHAR(255);
CREATE DOMAIN TYPE_description AS VARCHAR(255);

CREATE DOMAIN TYPE_userid AS INT(10);
CREATE DOMAIN TYPE_employeeid AS INT(10);
CREATE DOMAIN TYPE_employerid AS INT(10);
CREATE DOMAIN TYPE_educationid AS INT(5);
CREATE DOMAIN TYPE_benefitid AS INT(5);
CREATE DOMAIN TYPE_roleid AS INT(5);
CREATE DOMAIN TYPE_jobpostid AS INT(15);
CREATE DOMAIN TYPE_addressid AS INT(15);
CREATE DOMAIN TYPE_appstatusid AS INT(2);
CREATE DOMAIN TYPE_expreqid AS INT(2);
CREATE DOMAIN TYPE_salaryid AS INT(2);

CREATE TABLE IF NOT EXISTS UserAccount (
    UserID TYPE_userid NOT NULL;
    Email TYPE_Email NOT NULL,
    EmployeeID TYPE_employeeid;
    FirstName TYPE_shortname NOT NULL,
    LastName TYPE_shortname NOT NULL,
    Phone TYPE_phone,
    Password VARCHAR(255) NOT NULL,
    TimeStamp TYPE_timestamp;

    PRIMARY KEY (UserID),
    PRIMARY KEY (AcctEmail),
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID);
);

CREATE TABLE IF NOT EXISTS Employee (
    EmployeeID TYPE_employeeid NOT NULL;
    EducationLevel TYPE_edulevel NOT NULL;
    TimeStamp TYPE_timestamp;
    FOREIGN KEY (EducationID) REFERENCES Education(EducationID)
);

CREATE TABLE IF NOT EXISTS Education(
    EducationID TYPE_educationid NOT NULL;
    Title TYPE_title NOT NULL;
    TimeStamp TYPE_timestamp;
    PRIMARY KEY (EducationID);
);

CREATE TABLE IF NOT EXISTS SavedPosts (
    EmployeeID TYPE_employeeid NOT NULL;
    JobPostID TYPE_jobpostid NOT NULL;
    TimeStamp TYPE_timestamp;
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID);
    FOREIGN KEY (JobPostID) REFERENCES JobPost(JobPostID);
    PRIMARY KEY (EmployeeID, JobPostID)
);

CREATE TABLE IF NOT EXISTS AppliedPosts (
    EmployeeID TYPE_employeeid NOT NULL;
    JobPostID TYPE_jobpostid NOT NULL;
    AppStatusID TYPE_appstatusid NOT NULL;
    TimeStamp TYPE_timestamp;
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID);
    FOREIGN KEY (JobPostID) REFERENCES JobPost(JobPostID);
    FOREIGN KEY (AppStatusID) REFERENCES AppStatus(AppStatusID);
    PRIMARY KEY (EmployeeID, JobPostID)
);

CREATE TABLE IF NOT EXISTS AppStatus (
    AppStatusID TYPE_appstatusid NOT NULL;
    Title TYPE_title NOT NULL;
    TimeStamp TYPE_timestamp;
    PRIMARY KEY (AppStatusID)
);

CREATE TABLE IF NOT EXISTS EmployerAdmin (
    UserID TYPE_userid NOT NULL;
    EmployerID TYPE_employerid NOT NULL;
    RoleID TYPE_roleid NOT NULL;
    TimeStamp TYPE_timestamp;
    PRIMARY KEY (UserID, EmployerID)
);

CREATE TABLE IF NOT EXISTS Roles (
    RoleID TYPE_roleid NOT NULL;
    Title TYPE_title NOT NULL;
    TimeStamp TYPE_timestamp;
    PRIMARY KEY (RoleID);
);

CREATE TABLE IF NOT EXISTS Employer (
    EmployerID TYPE_employerid NOT NULL;
    AddressID TYPE_addressid NOT NULL;
    EmployerName TYPE_shortname NOT NULL;
    Email TYPE_email NOT NULL;
    Phone TYPE_phone;
    TimeStamp TYPE_timestamp;

    PRIMARY KEY (EmployerID);
    FOREIGN KEY (AddressID) REFERENCES Address(AddressID);
);

CREATE TABLE IF NOT EXISTS JobPosts (
    JobPostID TYPE_jobpostid NOT NULL;
    EmployerID TYPE_employerid NOT NULL;
    EducationID TYPE_educationid NOT NULL;
    JobTypeID TYPE_jobtypeid NOT NULL;
    ExpReqID TYPE_expreqid NOT NULL;
    SalaryID TYPE_salaryid NOT NULL;
    AddressID TYPE_addressid NOT NULL;

    Title TYPE_title NOT NULL;
    JobDesc TYPE_longtext;
    JobResp TYPE_longtext;
    JobQual TYPE_longtext;
    ContactEmail TYPE_email NOT NULL;
    ContactPhone TYPE_phone;
    ContactMessage TYPE_longtext;

    TimeStamp TYPE_timestamp;
    DatePosted DATETIME
    DeadLine DATETIME;

    PRIMARY KEY (JobPostID);
    FOREIGN KEY (EmployerID) REFERENCES Empolyer(EmployerID);
    FOREIGN KEY (EducationID) REFERENCES Education(EducationID);
    FOREIGN KEY (JobTypeID) REFERENCES JobTypes(JobTypeID);
    FOREIGN KEY (ExpReqID) REFERENCES ExpReq(ExpReqID);
    FOREIGN KEY (SalaryID) REFERENCES SalaryID(SalaryID);
    FOREIGN KEY (AddressID) REFERENCES Addresses(AddressID);
);


CREATE TABLE IF NOT EXISTS JobBenefits (
    BenefitID TYPE_benefitid NOT NULL;
    JobPostID TYPE_jobpostid NOT NULL;
    Title TYPE_title NOT NULL;
    TimeStamp TYPE_timestamp;

    PRIMARY KEY (BenefitID, JobPostID);
    FOREIGN KEY (JobPostID) REFERENCES JobPosts(JobPostID);
    FOREIGN KEY (BenefitIDe REFERENCES Benefits(BenefitID);
);

CREATE TABLE IF NOT EXISTS Benefits (
    BenefitID TYPE_benefitid NOT NULL;
    Title TYPE_title NOT NULL;
    TimeStamp TYPE_timestamp;

    PRIMARY KEY (BenefitID);
);

CREATE TABLE IF NOT EXISTS JobTypes (
    JobTypeID TYPE_jobtypeid NOT NULL;
    Title TYPE_title NOT NULL;
    TimeStamp TYPE_timestamp;
    PRIMARY KEY (JobTypeID);
);

CREATE TABLE IF NOT EXISTS ExpReq (
    ExpReqID TYPE_expreqid NOT NULL;
    Title TYPE_title NOT NULL;
    TimeStamp TYPE_timestamp;
    PRIMARY KEY (ExpReqID);
);

