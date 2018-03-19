-- deleting all the table if they exits

DROP TABLE IF EXISTS mail;
DROP TABLE IF EXISTS schedule;
DROP TABLE IF EXISTS surveillance;
DROP TABLE IF EXISTS devices;
DROP TABLE IF EXISTS exam_schedule;
DROP TABLE IF EXISTS saved_notification;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS assignment;
DROP TABLE IF EXISTS marks;
DROP TABLE IF EXISTS subject;
DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS professor;

-- creating the tables

CREATE TABLE student(
    _id_student INTEGER PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(20) NOT NULL, 
    last_name VARCHAR(20) NOT NULL,
    date_of_birth DATE NOT NULL,
  --  first_name_ar  VARCHAR(20) NOT NULL, 
  --  last_name_ar VARCHAR(20) NOT NULL,
    bac_average FLOAT NOT NULL,
    email VARCHAR(100),
    password VARCHAR(100) ,
    `level` INTEGER NOT NULL,
    `group` INTEGER NOT NULL,
    section INTEGER NOT NULL,
    student_active INTEGER NOT NULL,
    isConfirmed BOOLEAN NOT NULL DEFAULT 0,
    token VARCHAR(128) 
);

CREATE TABLE devices(
    _id_person INTEGER NOT NULL,
    _id_device VARCHAR (200),
    PRIMARY KEY (_id_person,_id_device)
);

CREATE TABLE professor (
    _id_professor INTEGER PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(20) NOT NULL, 
    last_name VARCHAR(20) NOT NULL,
    degree VARCHAR(10),
   -- first_name_ar VARCHAR(20) NOT NULL, 
   -- last_name_ar VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    password VARCHAR(100)
);

CREATE TABLE mail(
    _id_mail INTEGER PRIMARY KEY AUTO_INCREMENT,
    _id_professor INTEGER NOT NULL,
    _id_student INTEGER NOT NULL,
    message VARCHAR(500) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,  
    sender BOOLEAN NOT NULL,
    FOREIGN KEY (_id_professor) REFERENCES professor(_id_professor),
    FOREIGN KEY (_id_student) REFERENCES student(_id_student)
);

-- todo add the trace table

-- add the subject utility and the content of the subject
CREATE TABLE subject(
    _id_subject INTEGER PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    coefficient FLOAT NOT NULL,
    credit FLOAT NOT NULL,
    td BOOLEAN NOT NULL,
    tp BOOLEAN NOT NULL,
    course BOOLEAN NOT NULL,
    summary VARCHAR(500) NOT NULL,
    table_of_content VARCHAR(500) NOT NULL,
    unity_type INTEGER NOT NULL,
    short_title VARCHAR(10) NOT NULL,
    level INTEGER NOT NULL
);



CREATE TABLE assignment(
  _id_assign    INTEGER PRIMARY KEY AUTO_INCREMENT,
  _id_subject   INTEGER NOT NULL,
  _id_professor INTEGER NOT NULL,
  `group`       INTEGER NOT NULL,
  section       INTEGER NOT NULL,
  type          INTEGER NOT NULL,
  FOREIGN KEY (_id_professor) REFERENCES professor(_id_professor),
  FOREIGN KEY (_id_subject) REFERENCES subject(_id_subject)
);

CREATE TABLE marks(
    _id_subject INTEGER NOT NULL ,
    _id_student INTEGER NOT NULL ,
    td_mark FLOAT NOT NULL , 
    tp_mark FLOAT NOT NULL , 
    course_mark FLOAT NOT NULL ,
    FOREIGN KEY (_id_subject) REFERENCES subject(_id_subject),
    FOREIGN KEY (_id_student) REFERENCES student(_id_student)
);

CREATE TABLE post(
    _id_post INTEGER PRIMARY KEY AUTO_INCREMENT,
    _id_professor INTEGER NOT NULL ,
    type INTEGER NOT NULL,
    destination INTEGER NOT NULL,
    text_post VARCHAR(500) NOT NULL,
    path_file VARCHAR(100),
    date_post DATETIME,
    FOREIGN KEY (_id_professor) REFERENCES professor(_id_professor)
);

CREATE TABLE saved_notification(
    _id_post INTEGER NOT NULL ,
    _id_student INTEGER NOT NULL,
    seen BOOLEAN NOT NULL,
    saved BOOLEAN NOT NULL,
    FOREIGN KEY (_id_post) REFERENCES post(_id_post),
    FOREIGN KEY (_id_student) REFERENCES student(_id_student),
    PRIMARY KEY (_id_post,_id_student)
);

CREATE TABLE comments(
    _id_post INTEGER NOT NULL ,
    _id_person INTEGER NOT NULL,
    date_comment DATETIME NOT NULL ,
    text_comment VARCHAR(150) NOT NULL,
    FOREIGN KEY (_id_post) REFERENCES post(_id_post)
);

CREATE TABLE schedule(
    _id_schedule INTEGER PRIMARY KEY AUTO_INCREMENT,
    _id_assign INTEGER NOT NULL,
    place VARCHAR(100) NOT NULL,
    day_schedule INTEGER NOT NULL,
    hour_start_schedule VARCHAR(4),
    hour_finish_schedule VARCHAR(4),
    FOREIGN KEY (_id_assign) REFERENCES assignment(_id_assign)
);

CREATE TABLE exam_schedule(
    _id_exam INTEGER PRIMARY KEY AUTO_INCREMENT,
    level INTEGER NOT NULL ,
    place VARCHAR(100) NOT NULL,
    type ENUM('EXAM','RATTRAPAGE'),
    _id_subject INTEGER NOT NULL,
    FOREIGN KEY (_id_subject)  REFERENCES subject(_id_subject)
);

CREATE TABLE surveillance(
    _id_exam INTEGER NOT NULL ,
    _id_professor INTEGER NOT NULL,
    FOREIGN KEY (_id_exam) REFERENCES exam_schedule(_id_exam),
    FOREIGN KEY (_id_professor) REFERENCES professor(_id_professor),
    PRIMARY KEY (_id_exam,_id_professor)
);

-- start inserting the tuples
INSERT INTO student VALUE (NULL,'Charfaoui', 'Younes', '1997-04-16', 13.85, NULL, NULL, 6, 2, 0, 0,0,NULL);
INSERT INTO student VALUE (NULL,'Bourbie', 'Ismail', '1995-02-16', 13.85, NULL, NULL, 6, 2, 0, 0,0,NULL);
INSERT INTO student VALUE (NULL,'Bouras', 'Mohamed el amine', '1996-08-15', 13.85, NULL, NULL, 6, 1, 0, 0,0,NULL);
INSERT INTO student VALUE (NULL,'Zidane', 'Souhila', '1998-09-20', 13.85, NULL, NULL, 6, 3, 0, 0,0,NULL);
INSERT INTO student VALUE (NULL,'Zegai', 'Houari', '1996-11-17', 13.85, NULL, NULL, 6, 3, 0, 0,0,NULL);
INSERT INTO student VALUE (NULL,'Maden', 'Malika', '1998-10-17', 13.85, NULL, NULL, 6, 3, 0, 0,0,NULL);
INSERT INTO student VALUE (NULL,'Taif', 'Mohamed Amine', '1994-11-07', 13.85, NULL, NULL, 6, 3, 0, 0,0,NULL);
INSERT INTO student VALUE (NULL,'Asoune', 'Ismail', '1997-04-08', 13.85, NULL, NULL, 6, 1, 0, 0,0,NULL);
INSERT INTO student VALUE (NULL,'Azazen', 'Khaled walid', '1995-06-12', 13.85, NULL, NULL, 6, 1, 0, 0,0,NULL);
INSERT INTO student VALUE (NULL,'Baya', 'Redouane', '1997-04-08', 13.85, NULL, NULL, 6, 1, 0, 0,0,NULL);
INSERT INTO student VALUE (NULL,'Doulami', 'Mohamed tawfiq', '1995-06-21', 13.85, NULL, NULL, 6, 2, 0, 0,0,NULL);


INSERT INTO professor VALUES (NULL ,'Ouared','Abdelkader','Phd','ouared@aek.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Bekki','Khathir','Dr','bekki@khathir.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Chikhaoui','Ahmed','Pr','chikhaoui@ahmed.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Dahmani','Youcef','Dr','dahmani@youcef.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Aid','Lahcen','Dr','aid@lahcen.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Boudaa','Boudjmaa','Dr','boudaa@boudjmaa.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Beghani','Abdelmalk','Dr','beghani@abdelmalk.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Mezoug','Karim','Dr','mezzoug@karim.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Siabdelhadi','ahmed','Dr.','siabdelhadi@ahmed.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Douad','Bachir','Dr','douad@bachir.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'benoudaa','habib','Dr','ouared@aek.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'berber','mahdi','Dr','berber@mahdi.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Belarbi','mustafa','Dr','belarbi@mustafa.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Laradj','Zohra','Dr','Laradj@zohra.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Memmeri','mebarka','Dr','mammeri@mebarka.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Lakmeche','Zaouai','Dr','lakmeche@zaouai.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Boulaam','Adda','Dr','Boulaam@adda.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Zioual','Tahar','Dr','zioual@tahar.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Chadli','Abdelhafid','Dr','chadli@hafid.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'Douad','Amine','Dr','douad@amine.com','ouaredaek');

-- inserting the licence subject

INSERT INTO subject VALUES (NULL, 'Analyse 1', 2, 4, 1, 1, 0, 'Analyse1', 'Analyse1', 1, 'AN1', 1);
INSERT INTO subject VALUES (NULL, 'Algebra 1', 2, 4, 1, 1, 0, 'Analyse1', 'Analyse1', 1, 'ALG1', 1);
INSERT INTO subject VALUES (NULL, 'Algorithm 1', 2, 4, 1, 1, 1, 'Analyse1', 'Analyse1', 1, 'AGM1', 1);
INSERT INTO subject VALUES (NULL, 'Electronic', 2, 4, 1, 1, 0, 'Analyse1', 'Analyse1', 1, 'ELE', 1);
INSERT INTO subject VALUES (NULL, 'Physics', 2, 4, 1, 1, 0, 'Analyse1', 'Analyse1', 1, 'PHY', 1);
INSERT INTO subject VALUES (NULL, 'Expression technique', 1, 0, 0, 'Analyse1', 'Analyse1', 1, 2, 4, 'ET1', 1);
INSERT INTO subject VALUES (NULL, 'Desktop Management', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'DM1', 1);
INSERT INTO subject VALUES (NULL, 'English 1', 2, 4, 1, 0, 0, 'Analyse1', 'Analyse1', 1, 'EN1', 1);

INSERT INTO subject VALUES (NULL, 'Analyse 2', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'AN2', 2);
INSERT INTO subject VALUES (NULL, 'Algebra 2', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'ALG2', 2);
INSERT INTO subject VALUES (NULL, 'Algorithm 2', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'AGM2', 2);
INSERT INTO subject
VALUES (NULL, 'Intro to object oriented programming 2', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'OOP', 2);
INSERT INTO subject VALUES (NULL, 'English 2', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'ENG2', 2);
INSERT INTO subject VALUES (NULL, 'Story of science', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'SOF', 2);
INSERT INTO subject VALUES (NULL, 'Machine Structure', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'MST', 2);
INSERT INTO subject
VALUES (NULL, 'Intro to probability and statistics', 1, 3, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'PBS', 2);

INSERT INTO subject VALUES (NULL, 'Algorithm and data structure', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'ADS', 3);
INSERT INTO subject VALUES (NULL, 'Language theory', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'SR', 3);
INSERT INTO subject VALUES (NULL, 'Computer Architecture', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'CP', 3);
INSERT INTO subject VALUES (NULL, 'Mathematical Logic', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'MT', 3);
INSERT INTO subject VALUES (NULL, 'Object oriented programming', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'OOP', 3);
INSERT INTO subject VALUES (NULL, 'Information System', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'IS', 3);
INSERT INTO subject VALUES (NULL, 'English 3', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'EN3', 3);

INSERT INTO subject VALUES (NULL, 'Data base', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'DB', 4);
INSERT INTO subject VALUES (NULL, 'Networking', 3, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'NT', 4);
INSERT INTO subject VALUES (NULL, 'Operating System I', 3, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'OS1', 4);
INSERT INTO subject VALUES (NULL, 'Graph Theory', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'GT', 4);
INSERT INTO subject VALUES (NULL, 'Web Developments', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'WD', 4);
INSERT INTO subject VALUES (NULL, 'English 4', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'ENG4', 4);
INSERT INTO subject VALUES (NULL, 'Juridic aspects', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'JA', 4);
INSERT INTO subject VALUES (NULL, 'Software Engineering 1', 0, 1, 1, 'Analyse1', 'Analyse1', 1, 2, 4, 'SE1', 4);

INSERT INTO subject VALUES (NULL, 'Compilation', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'CP', 5);
INSERT INTO subject VALUES (NULL, 'Operating System 2', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'OS2', 5);
INSERT INTO subject VALUES (NULL, 'Interface Machine Human', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'IMH', 5);
INSERT INTO subject VALUES (NULL, 'Linear Programming', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'LNP', 5);
INSERT INTO subject VALUES (NULL, 'Logical Programming', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'LGP', 5);
INSERT INTO subject VALUES (NULL, 'Software Engineering', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'SE', 5);
INSERT INTO subject VALUES (NULL, 'Probability', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'PB', 5);
INSERT INTO subject VALUES (NULL, 'English', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'EN', 5);

INSERT INTO subject VALUES (NULL, 'Developing Android Apps', 3, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'DAA', 6);
INSERT INTO subject VALUES (NULL, 'Scientific Redaction', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'SR', 6);
INSERT INTO subject VALUES (NULL, 'Information Security', 3, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'IS', 6);
INSERT INTO subject VALUES (NULL, 'Cryptography', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'CPT', 6);
INSERT INTO subject VALUES (NULL, 'Database Administration', 2, 4, 0, 1, 1, 'Analyse1', 'Analyse1', 1, 'DBA', 5);

