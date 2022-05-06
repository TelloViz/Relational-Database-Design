

USE schemers;

DROP TABLE IF EXISTS
    ZipCodes;
DROP TABLE IF EXISTS
    states;


CREATE TABLE states(
    StateID VARCHAR(2) NOT NULL,
    StateName VARCHAR(20) NOT NULL,
    PRIMARY KEY(StateID)
); 

CREATE TABLE ZipCodes(
        StateID VARCHAR(2) NOT NULL,
        Time_Stamp DATETIME NOT NULL DEFAULT NOW(),
        ZipCodeID INT(5) UNSIGNED NOT NULL,
        City VARCHAR(255) NOT NULL, 
    FOREIGN KEY
    	(StateID) 
    	REFERENCES 
    		States(StateID), 
    PRIMARY KEY
    	(ZipCodeID)); 

INSERT INTO states
    VALUES
        ('AL', 'Alabama'),
        ('AK', 'Alaska'),
        ('AZ', 'Arizona'),
        ('AR', 'Arkansas'),
        ('CA', 'California'),
        ('CO', 'Colorado'),
        ('CT', 'Connecticut'),
        ('DE', 'Delaware'),
        ('DC', 'District of Columbia'),
        ('FL', 'Florida'),
        ('GA', 'Georgia'),
        ('HI', 'Hawaii'),
        ('ID', 'Idaho'),
        ('IL', 'Illinois'),
        ('IN', 'Indiana'),
        ('IA', 'Iowa'),
        ('KS', 'Kansas'),
        ('KY', 'Kentucky'),
        ('LA', 'Louisiana'),
        ('ME', 'Maine'),
        ('MD', 'Maryland'),
        ('MA', 'Massachusetts'),
        ('MI', 'Michigan'),
        ('MN', 'Minnesota'),
        ('MS', 'Mississippi'),
        ('MO', 'Missouri'),
        ('MT', 'Montana'),
        ('NE', 'Nebraska'),
        ('NV', 'Nevada'),
        ('NH', 'New Hampshire'),
        ('NJ', 'New Jersey'),
        ('NM', 'New Mexico'),
        ('NY', 'New York'),
        ('NC', 'North Carolina'),
        ('ND', 'North Dakota'),
        ('OH', 'Ohio'),
        ('OK', 'Oklahoma'),
        ('OR', 'Oregon'),
        ('PA', 'Pennsylvania'),
        ('PR', 'Puerto Rico'),
        ('RI', 'Rhode Island'),
        ('SC', 'South Carolina'),
        ('SD', 'South Dakota'),
        ('TN', 'Tennessee'),
        ('TX', 'Texas'),
        ('UT', 'Utah'),
        ('VT', 'Vermont'),
        ('VA', 'Virginia'),
        ('WA', 'Washington'),
        ('WV', 'West Virginia'),
        ('WI', 'Wisconsin'),
        ('WY', 'Wyoming');


INSERT INTO ZipCodes VALUES(69742,'5126-05-25 14:10:28Z','NY','Sacramento');
INSERT INTO ZipCodes VALUES(80732,'6816-02-21 01:41:30Z','NE','Moreno Valley');
INSERT INTO ZipCodes VALUES(25717,'9751-05-09 16:15:35Z','KY','Dallas');
INSERT INTO ZipCodes VALUES(62247,'4024-05-19 17:03:50Z','NH','Lisbon');
INSERT INTO ZipCodes VALUES(61836,'9959-01-05 07:41:04Z','WA','Denver');
INSERT INTO ZipCodes VALUES(63405,'4233-12-04 02:46:07Z','ME','Chicago');
INSERT INTO ZipCodes VALUES(62677,'1117-08-15 20:34:49Z','WV','Omaha');
INSERT INTO ZipCodes VALUES(35842,'3224-11-05 17:19:36Z','UT','Ontario');
INSERT INTO ZipCodes VALUES(19918,'9015-05-19 02:37:07Z','TN','Boston');
INSERT INTO ZipCodes VALUES(71710,'7493-04-26 00:25:35Z','WV','Scottsdale');
INSERT INTO ZipCodes VALUES(59661,'6168-03-31 10:28:24Z','CA','Bucharest');
INSERT INTO ZipCodes VALUES(36163,'8512-02-07 11:01:44Z','FL','Escondido');
INSERT INTO ZipCodes VALUES(70612,'5688-04-16 08:27:01Z','OR','Chicago');
INSERT INTO ZipCodes VALUES(56962,'0073-10-10 03:00:40Z','AZ','New York');
INSERT INTO ZipCodes VALUES(42612,'8869-01-18 03:13:00Z','NC','Los Angeles');
INSERT INTO ZipCodes VALUES(73506,'2906-02-01 19:11:03Z','AR','Hayward');
INSERT INTO ZipCodes VALUES(14529,'6253-01-05 14:22:09Z','HI','Lyon');
INSERT INTO ZipCodes VALUES(26246,'6446-10-01 22:34:32Z','AR','Milwaukee');
INSERT INTO ZipCodes VALUES(64855,'3044-02-03 10:43:52Z','AR','Huntsville');
INSERT INTO ZipCodes VALUES(96786,'3395-03-21 18:43:28Z','MI','Las Vegas');
INSERT INTO ZipCodes VALUES(35042,'5012-04-06 05:56:57Z','SD','Madison');
INSERT INTO ZipCodes VALUES(44380,'5538-06-30 14:30:20Z','OK','Paris');
INSERT INTO ZipCodes VALUES(31802,'1793-05-31 14:27:52Z','SC','Bakersfield');
INSERT INTO ZipCodes VALUES(98756,'3875-01-20 10:10:58Z','OK','Toledo');
INSERT INTO ZipCodes VALUES(35722,'8243-07-17 14:40:21Z','OR','New York');
INSERT INTO ZipCodes VALUES(22911,'7091-02-11 14:34:25Z','MI','Salem');
INSERT INTO ZipCodes VALUES(77547,'8479-05-23 04:31:12Z','TX','Cincinnati');
INSERT INTO ZipCodes VALUES(24417,'1431-08-26 06:34:50Z','AL','Garland');
INSERT INTO ZipCodes VALUES(20235,'7968-03-20 18:57:45Z','IL','Bakersfield');
INSERT INTO ZipCodes VALUES(75651,'9871-08-26 19:58:49Z','AZ','Bakersfield');
INSERT INTO ZipCodes VALUES(52315,'0214-09-08 20:26:08Z','AL','Innsbruck');
INSERT INTO ZipCodes VALUES(58556,'2503-03-12 14:46:08Z','NH','Henderson');
INSERT INTO ZipCodes VALUES(71312,'3582-01-12 02:30:10Z','WV','Milwaukee');
INSERT INTO ZipCodes VALUES(92104,'8365-06-20 13:39:10Z','MN','Lisbon');
INSERT INTO ZipCodes VALUES(87467,'3793-09-07 12:21:27Z','TN','Pittsburgh');
INSERT INTO ZipCodes VALUES(20953,'3953-08-11 03:41:00Z','OR','Worcester');
INSERT INTO ZipCodes VALUES(59189,'1457-10-07 04:37:01Z','OH','Lincoln');
INSERT INTO ZipCodes VALUES(66611,'7396-12-04 10:39:39Z','ND','San Diego');
INSERT INTO ZipCodes VALUES(26635,'2851-03-05 18:57:43Z','UT','Phoenix');
INSERT INTO ZipCodes VALUES(88383,'0925-07-20 09:39:43Z','IN','San Diego');
INSERT INTO ZipCodes VALUES(96654,'9531-07-27 18:10:32Z','NM','Seattle');
INSERT INTO ZipCodes VALUES(72174,'4055-05-30 00:08:09Z','OH','Salem');
INSERT INTO ZipCodes VALUES(67566,'0845-09-26 15:47:32Z','MN','Amarillo');
INSERT INTO ZipCodes VALUES(19922,'3522-09-13 16:15:49Z','OK','Phoenix');
INSERT INTO ZipCodes VALUES(14790,'7744-04-18 21:16:31Z','NY','Irving');
INSERT INTO ZipCodes VALUES(80785,'6462-06-30 11:06:36Z','KS','Milano');
INSERT INTO ZipCodes VALUES(89159,'7553-06-09 18:34:14Z','NM','Salem');
INSERT INTO ZipCodes VALUES(10718,'7247-08-09 20:11:17Z','TN','San Bernardino');
INSERT INTO ZipCodes VALUES(64084,'0907-04-09 20:42:33Z','NJ','Dallas');
INSERT INTO ZipCodes VALUES(66796,'0840-03-18 20:36:28Z','ID','San Bernardino');
INSERT INTO ZipCodes VALUES(49443,'1936-09-23 15:55:55Z','NM','Salem');
INSERT INTO ZipCodes VALUES(63719,'9054-02-18 15:35:26Z','NM','Tokyo');
INSERT INTO ZipCodes VALUES(14470,'0699-12-07 02:13:51Z','MS','Paris');
INSERT INTO ZipCodes VALUES(60001,'5972-08-22 09:03:29Z','AK','Jersey City');
INSERT INTO ZipCodes VALUES(70424,'9512-08-30 21:44:52Z','NH','Omaha');
INSERT INTO ZipCodes VALUES(57802,'1982-02-13 05:21:10Z','TN','Quebec');
INSERT INTO ZipCodes VALUES(26670,'2147-02-17 02:06:14Z','MT','Scottsdale');
INSERT INTO ZipCodes VALUES(11262,'7767-01-20 09:36:44Z','SD','El Paso');
INSERT INTO ZipCodes VALUES(63672,'2786-07-19 20:25:34Z','NC','Huntsville');
INSERT INTO ZipCodes VALUES(95871,'7381-10-29 19:33:03Z','FL','Murfreesboro');
INSERT INTO ZipCodes VALUES(88458,'8483-05-15 19:40:11Z','KS','Seattle');
INSERT INTO ZipCodes VALUES(44432,'2915-06-18 21:15:15Z','SD','Sacramento');
INSERT INTO ZipCodes VALUES(25711,'5568-06-12 03:07:41Z','NJ','Amarillo');
INSERT INTO ZipCodes VALUES(92758,'3587-08-22 21:35:37Z','ND','Salem');
INSERT INTO ZipCodes VALUES(52882,'2695-08-31 12:10:06Z','ND','Denver');
INSERT INTO ZipCodes VALUES(93551,'5261-11-27 21:33:28Z','WI','Boston');
INSERT INTO ZipCodes VALUES(98838,'9453-06-23 04:19:18Z','AZ','Colorado Springs');
INSERT INTO ZipCodes VALUES(26321,'7031-12-17 10:20:46Z','MT','Venice');
INSERT INTO ZipCodes VALUES(54065,'9423-10-27 02:32:06Z','MN','New York');
INSERT INTO ZipCodes VALUES(11978,'3972-01-31 01:08:35Z','WI','Jersey City');
INSERT INTO ZipCodes VALUES(12759,'2073-09-30 13:13:10Z','KY','Huntsville');
INSERT INTO ZipCodes VALUES(47201,'7440-09-04 06:19:47Z','NM','Garland');
INSERT INTO ZipCodes VALUES(60968,'1073-07-27 18:19:28Z','KS','Indianapolis');
INSERT INTO ZipCodes VALUES(62538,'8392-03-03 00:22:22Z','ME','Las Vegas');
INSERT INTO ZipCodes VALUES(59336,'1050-05-10 04:41:44Z','GA','Richmond');
INSERT INTO ZipCodes VALUES(54627,'8681-05-31 03:36:50Z','RI','Ontario');
INSERT INTO ZipCodes VALUES(27849,'8219-11-11 05:17:40Z','WV','Miami');
INSERT INTO ZipCodes VALUES(36088,'2526-03-17 18:07:19Z','MS','Berna');
INSERT INTO ZipCodes VALUES(43128,'5611-02-16 19:47:24Z','OH','Philadelphia');
INSERT INTO ZipCodes VALUES(67518,'0956-11-11 14:03:54Z','CA','Fayetteville');
INSERT INTO ZipCodes VALUES(31522,'6931-09-09 16:36:10Z','NH','Madrid');
INSERT INTO ZipCodes VALUES(11550,'7808-02-23 02:40:41Z','WI','Memphis');
INSERT INTO ZipCodes VALUES(86715,'3564-11-06 13:25:42Z','SC','Henderson');
INSERT INTO ZipCodes VALUES(37635,'2895-10-23 18:26:03Z','UT','San Diego');
INSERT INTO ZipCodes VALUES(75372,'6137-10-03 05:45:27Z','IL','Lincoln');
INSERT INTO ZipCodes VALUES(60346,'1044-05-29 11:09:26Z','ND','Zurich');
INSERT INTO ZipCodes VALUES(80224,'7508-11-03 02:42:27Z','WV','Santa Ana');
INSERT INTO ZipCodes VALUES(76525,'0280-03-02 14:11:25Z','MA','Huntsville');
INSERT INTO ZipCodes VALUES(46326,'9022-11-01 03:06:08Z','NE','Garland');
INSERT INTO ZipCodes VALUES(25034,'8554-12-03 21:13:07Z','UT','Garland');
INSERT INTO ZipCodes VALUES(32685,'0770-12-10 06:16:37Z','MD','Rome');
INSERT INTO ZipCodes VALUES(58478,'6960-03-14 16:35:35Z','MD','Hollywood');
INSERT INTO ZipCodes VALUES(62722,'6057-06-07 13:01:26Z','MO','Richmond');
INSERT INTO ZipCodes VALUES(28186,'3419-05-19 00:17:13Z','ND','Lancaster');
INSERT INTO ZipCodes VALUES(90583,'2005-03-09 11:19:23Z','NY','Milano');
INSERT INTO ZipCodes VALUES(95581,'3562-12-23 20:47:09Z','VT','Philadelphia');
INSERT INTO ZipCodes VALUES(28565,'4341-08-31 12:32:03Z','ME','Scottsdale');
INSERT INTO ZipCodes VALUES(32479,'3386-03-29 04:40:05Z','MN','Lincoln');
INSERT INTO ZipCodes VALUES(76160,'2362-08-27 22:24:42Z','NV','Dallas');
INSERT INTO ZipCodes VALUES(54599,'2463-04-12 06:12:16Z','WI','Fremont');

