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
    _id_student INTEGER PRIMARY KEY,
    first_name VARCHAR(20) NOT NULL, 
    last_name VARCHAR(20) NOT NULL,
    date_of_birth DATE NOT NULL,
  --  first_name_ar  VARCHAR(20) NOT NULL, 
  --  last_name_ar VARCHAR(20) NOT NULL,
    bac_average FLOAT NOT NULL,
    email VARCHAR(100),
    `password` VARCHAR(100) ,
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
    `level` INTEGER NOT NULL
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
    _id_subject INTEGER NOT NULL ,
    type INTEGER NOT NULL,
    destination VARCHAR(20) NOT NULL,
    text_post VARCHAR(500) NOT NULL,
    path_file VARCHAR(100),
    date_post INTEGER(11) NOT NULL,
    FOREIGN KEY (_id_professor) REFERENCES professor(_id_professor),
    FOREIGN KEY (_id_subject) REFERENCES subject(_id_subject)
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
    date_comment INTEGER(11) NOT NULL,
    text_comment VARCHAR(150) NOT NULL,
    FOREIGN KEY (_id_post) REFERENCES post(_id_post)
);

CREATE TABLE schedule(
    _id_schedule INTEGER PRIMARY KEY AUTO_INCREMENT,
    _id_assign INTEGER NOT NULL,
    place VARCHAR(100) NOT NULL,
    day_schedule INTEGER NOT NULL,
    hour_start_schedule INTEGER(1) NOT NULL ,
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
INSERT INTO student VALUE (10101010,'Charfaoui', 'Younes', '1997-04-16', 13.85, NULL, NULL, 6, 2, 0, 0,0,NULL);
INSERT INTO student VALUE (10101012,'Bourbie', 'Ismail', '1995-02-16', 13.85, NULL, NULL, 6, 2, 0, 0,0,NULL);
INSERT INTO student VALUE (10101013,'Bouras', 'Mohamed el amine', '1996-08-15', 13.85, NULL, NULL, 6, 1, 0, 0,0,NULL);
INSERT INTO student VALUE (10101014,'Zidane', 'Souhila', '1998-09-20', 13.85, NULL, NULL, 6, 3, 0, 0,0,NULL);
INSERT INTO student VALUE (10101015,'Zegai', 'Houari', '1996-11-17', 13.85, NULL, NULL, 6, 3, 0, 0,0,NULL);
INSERT INTO student VALUE (10101016,'Maden', 'Malika', '1998-10-17', 13.85, NULL, NULL, 6, 3, 0, 0,0,NULL);
INSERT INTO student VALUE (10101017,'Taif', 'Mohamed Amine', '1994-11-07', 13.85, NULL, NULL, 6, 3, 0, 0,0,NULL);
INSERT INTO student VALUE (10101018,'Asoune', 'Ismail', '1997-04-08', 13.85, NULL, NULL, 6, 1, 0, 0,0,NULL);
INSERT INTO student VALUE (10101019,'Azazen', 'Khaled walid', '1995-06-12', 13.85, NULL, NULL, 6, 1, 0, 0,0,NULL);
INSERT INTO student VALUE (10101020,'Baya', 'Redouane', '1997-04-08', 13.85, NULL, NULL, 6, 1, 0, 0,0,NULL);
INSERT INTO student VALUE (10101021,'Doulami', 'Mohamed tawfiq', '1995-06-21', 13.85, NULL, NULL, 6, 2, 0, 0,0,NULL);


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
INSERT INTO professor VALUES (NULL ,'Bekar','Khaled','Dr','bekar@khaled.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'chenine','aek','Dr','chenine@aek.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'alem','aek','Dr','alem@aek.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'mokhtari','mokhtari','Dr','mokhtari@mokhtari.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'hatab','nourdine','Dr','hatab@nourdine.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'lakhdari','aicha','Dr','lakdari@aicha.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'mostfaoui','sidahmed','Dr','mostfaoui@sidahmed.com','ouaredaek');
INSERT INTO professor VALUES (NULL ,'djabar','abdelmajid','Dr','djabar@abdelmajid.com','ouaredaek');


-- inserting the licence subject

INSERT INTO subject VALUES (NULL, 'Analyse 1', 4, 6, 1, 1, 0, 'this subject will teach the student how to handle some basic math analysis', 'Function,basic derevation ', 1, 'AN1', 1);
INSERT INTO subject VALUES (NULL, 'Algebra 1', 2, 5, 1, 1, 0, 'in this subject the student will learn the basics of algebra', 'Table of truth, basic corps', 1, 'ALG1', 1);
INSERT INTO subject VALUES (NULL, 'Algorithm 1', 4, 6, 1, 1, 1, 'subject in which the student will take the basic of algorithm and how the programs are built.', 'Analyse1', 1, 'AGM1', 1);
INSERT INTO subject VALUES (NULL, 'Electronic', 2, 2, 1, 1, 0, 'Basic Electronic', 'Basic Electronic', 4, 'ELE', 1);
INSERT INTO subject VALUES (NULL, 'Physics', 2, 2, 1, 1, 0, 'Physics', 'Physics', 4, 'PHY', 1);
INSERT INTO subject VALUES (NULL, 'Expression technique', 4,1,1, 0, 0, 'Expression technique', 'Expression technique', 2, 'ET1', 1);
INSERT INTO subject VALUES (NULL, 'Desktop Management', 3, 1, 0, 0, 1, 'Desktop Management', 'Desktop Management', 2, 'DM1', 1);
INSERT INTO subject VALUES (NULL, 'English 1', 2, 1, 1, 0, 0, 'English 1', 'English 1', 3, 'EN1', 1);

INSERT INTO subject VALUES (NULL, 'Analyse 2', 2, 4, 1, 1, 0, 'Analyse 2', 'Analyse 2', 1, 'AN2', 2);
INSERT INTO subject VALUES (NULL, 'Algebra 2', 2, 4, 1, 1, 0, 'Algebra 2', 'Algebra 2', 1, 'ALG2', 2);
INSERT INTO subject VALUES (NULL, 'Algorithm 2', 2, 4, 1, 1, 1, 'Algorithm 2', 'Algorithm 2', 1, 'AGM2', 2);
INSERT INTO subject
VALUES (NULL, 'Intro to object oriented programming', 2, 4, 1, 0, 1, 'Intro to object oriented programming', 'Intro to object oriented programming', 1, 'OOP', 2);
INSERT INTO subject VALUES (NULL, 'English 2', 2, 4, 1, 0, 0, 'English 2', 'English 2', 1, 'ENG2', 2);
INSERT INTO subject VALUES (NULL, 'Story of science', 2, 4, 1, 0, 1, 'Story of science', 'Story of science', 1, 'SOF', 2);
INSERT INTO subject VALUES (NULL, 'Machine Structure', 2, 4, 1, 1, 0, 'Machine Structure', 'Machine Structure', 1, 'MST', 2);
INSERT INTO subject
VALUES (NULL, 'Intro to probability and statistics', 1, 3, 1, 1, 0, 'Probability and Statistics or also called Statistics and Probability are two related but separate academic disciplines. Statistical analysis often uses probability distributions, and the two topics are often studied together. However, probability theory contains much that is mostly of mathematical interest and not directly relevant to statistics. Moreover, many topics in statistics are independent of probability theory.', 'Intro to probability and statistics', 1, 'PBS', 2);

INSERT INTO subject VALUES (NULL, 'Algorithm and data structure', 2, 4, 1, 1, 1, 'In mathematics and computer science, an algorithm (/ˈælɡərɪðəm/ (About this sound listen) AL-gə-ridh-əm) is an unambiguous specification of how to solve a class of problems. Algorithms can perform calculation, data processing and automated reasoning tasks.
An algorithm is an effective method that can be expressed within a finite amount of space and time[1] and in a well-defined formal language[2] for calculating a function.[3] Starting from an initial state and initial input (perhaps empty),[4] the instructions describe a computation that, when executed, proceeds through a finite[5] number of well-defined successive states, eventually producing "output"[6] and terminating at a final ending state. The transition from one state to the next is not necessarily deterministic; some algorithms, known as randomized algorithms, incorporate random input.', 'Algorithm and data structure', 1, 'ADS', 3);
INSERT INTO subject VALUES (NULL, 'Language theory', 2, 4, 1, 1, 0, 'In mathematics, computer science, and linguistics, a formal language is a set of strings of symbols together with a set of rules that are specific to it.
The alphabet of a formal language is the set of symbols, letters, or tokens from which the strings of the language may be formed.[1] The strings formed from this alphabet are called words, and the words that belong to a particular formal language are sometimes called well-formed words or well-formed formulas. A formal language is often defined by means of a formal grammar such as a regular grammar or context-free grammar, also called its formation rule.', 'Language theory', 1, 'SR', 3);
INSERT INTO subject VALUES (NULL, 'Computer Architecture', 2, 4, 1, 0, 1, 'n computer engineering, computer architecture is a set of rules and methods that describe the functionality, organization, and implementation of computer systems. Some definitions of architecture define it as describing the capabilities and programming model of a computer but not a particular implementation.[1] In other definitions computer architecture involves instruction set architecture design, microarchitecture design, logic design, and implementation', 'Computer Architecture', 1, 'CP', 3);
INSERT INTO subject VALUES (NULL, 'Mathematical Logic', 2, 4, 1, 1, 0, 'Mathematical logic is a subfield of mathematics exploring the applications of formal logic to mathematics. It bears close connections to metamathematics, the foundations of mathematics, and theoretical computer science.[1] The unifying themes in mathematical logic include the study of the expressive power of formal systems and the deductive power of formal proof systems.
Mathematical logic is often divided into the fields of set theory, model theory, recursion theory, and proof theory. These areas share basic results on logic, particularly first-order logic, and definability. In computer science (particularly in the ACM Classification) mathematical logic encompasses additional topics not detailed in this article; see Logic in computer science for those.', 'Mathematical Logic', 1, 'MT', 3);
INSERT INTO subject VALUES (NULL, 'Object oriented programming', 2, 4, 1, 1, 1, 'Object-oriented programming (OOP) is a programming paradigm based on the concept of "objects", which may contain data, in the form of fields, often known as attributes; and code, in the form of procedures, often known as methods. A feature of objects is that an objects procedures can access and often modify the data fields of the object with which they are associated (objects have a notion of "this" or "self"). In OOP, computer programs are designed by making them out of objects that interact with one another.[1][2] There is significant diversity of OOP languages, but the most popular ones are class-based, meaning that objects are instances of classes, which typically also determine their type.', 'Object oriented programming', 1, 'OOP', 3);
INSERT INTO subject VALUES (NULL, 'Information System', 2, 4, 1, 1, 0, 'An information system (IS) is an organized system for the collection, organization, storage and communication of information. More specifically, it is the study of complementary networks that people and organizations use to collect, filter, process, create and distribute data.
"An information system (IS) is a group of components that interact to produce information. It focuses on the internal rather than the external."', 'Information System', 1, 'IS', 3);
INSERT INTO subject VALUES (NULL, 'English 3', 2, 4, 1, 0, 0, 'English is a West Germanic language that was first spoken in early medieval England and is now a global lingua franca.Named after the Angles, one of the Germanic tribes that migrated to England, it ultimately derives its name from the Anglia (Angeln) peninsula in the Baltic Sea. It is closely related to the Frisian languages, but its vocabulary has been significantly influenced by other Germanic languages, particularly Norse (a North Germanic language), as well as by Latin and Romance languages, especially French.', 'English 3', 1, 'EN3', 2);

INSERT INTO subject VALUES (NULL, 'Data base', 2, 4, 1, 1, 1, 'A database is an organized collection of data.[1] A relational database, more restrictively, is a collection of schemas, tables, queries, reports, views, and other elements. Database designers typically organize the data to model aspects of reality in a way that supports processes requiring information, such as (for example) modelling the availability of rooms in hotels in a way that supports finding a hotel with vacancies.', 'Data base', 1, 'DB', 4);
INSERT INTO subject VALUES (NULL, 'Networking', 3, 4, 1, 1, 1, 'A computer network, or data network, is a digital telecommunications network which allows nodes to share resources. In computer networks, computing devices exchange data with each other using connections between nodes (data links.) These data links are established over cable media such as wires or optic cables, or wireless media such as WiFi.', 'Networking', 1, 'NT', 4);
INSERT INTO subject VALUES (NULL, 'Operating System I', 3, 4, 1, 1, 1, 'An operating system (OS) is system software that manages computer hardware and software resources and provides common services for computer programs.
Time-sharing operating systems schedule tasks for efficient use of the system and may also include accounting software for cost allocation of processor time, mass storage, printing, and other resources.
For hardware functions such as input and output and memory allocation, the operating system acts as an intermediary between programs and the computer hardware,[1][2] although the application code is usually executed directly by the hardware and frequently makes system calls to an OS function or is interrupted by it. Operating systems are found on many devices that contain a computer – from cellular phones and video game consoles to web servers and supercomputers.', 'Operating System I', 1, 'OS1', 4);
INSERT INTO subject VALUES (NULL, 'Graph Theory', 2, 4, 1, 1, 0, 'In mathematics, graph theory is the study of graphs, which are mathematical structures used to model pairwise relations between objects. A graph in this context is made up of vertices, nodes, or points which are connected by edges, arcs, or lines. A graph may be undirected, meaning that there is no distinction between the two vertices associated with each edge, or its edges may be directed from one vertex to another; see Graph (discrete mathematics) for more detailed definitions and for other variations in the types of graph that are commonly considered. Graphs are one of the prime objects of study in discrete mathematics.', 'Graph Theory', 1, 'GT', 4);
INSERT INTO subject VALUES (NULL, 'Web Developments', 2, 4, 1, 0, 1, 'Web development is a broad term for the work involved in developing a web site for the Internet (World Wide Web) or an intranet (a private network). Web development can range from developing the simplest static single page of plain text to the most complex web-based internet applications (or just web apps) electronic businesses, and social network services. A more comprehensive list of tasks to which web development commonly refers, may include web engineering, web design, web content development, client liaison, client-side/server-side scripting, web server and network security configuration, and e-commerce development. Among web professionals, "web development" usually refers to the main non-design aspects of building web sites: writing markup and coding. Most recently Web development has come to mean the creation of content management systems or CMS. These CMS can be made from scratch, proprietary or open source. In broad terms the CMS acts as middleware between the database and the user through the browser. A principle benefit of a CMS is that it allows non-technical people to make changes to their web site without having technical knowledge.', 'Web Developments', 1, 'WD', 4);
INSERT INTO subject VALUES (NULL, 'English 4', 2, 4, 1, 0, 0, 'English is a West Germanic language that was first spoken in early medieval England and is now a global lingua franca.Named after the Angles, one of the Germanic tribes that migrated to England, it ultimately derives its name from the Anglia (Angeln) peninsula in the Baltic Sea. It is closely related to the Frisian languages, but its vocabulary has been significantly influenced by other Germanic languages, particularly Norse (a North Germanic language), as well as by Latin and Romance languages, especially French.', 'English 4', 2, 'ENG4', 4);
INSERT INTO subject VALUES (NULL, 'Juridic aspects', 2, 4, 1, 0, 0, 'Software law refers to the legal remedies available to protect software-based assets. Software may, under various circumstances and in various countries, be restricted by patent or copyright or both. Most commercial software is sold under some kind of software license agreement.', 'Juridic aspects', 2, 'JA', 4);
INSERT INTO subject VALUES (NULL, 'Software Engineering 1', 1, 2,1, 1, 0, 'Software Engineering is the application of engineering to the development of software in a systematic method.', 'Software Engineering 1',  1, 'SE1', 4);

INSERT INTO subject VALUES (NULL, 'Compilation', 2, 4, 1, 1, 1, 'A compiler is computer software that transforms computer code written in one programming language (the source language) into another programming language (the target language). Compilers are a type of translator that support digital devices, primarily computers. The name compiler is primarily used for programs that translate source code from a high-level programming language to a lower level language (e.g., assembly language, object code, or machine code) to create an executable program.[1]', 'Compilation', 1, 'CP', 5);
INSERT INTO subject VALUES (NULL, 'Operating System 2', 2, 4, 1, 1, 1, 'An operating system (OS) is system software that manages computer hardware and software resources and provides common services for computer programs.
Time-sharing operating systems schedule tasks for efficient use of the system and may also include accounting software for cost allocation of processor time, mass storage, printing, and other resources.
For hardware functions such as input and output and memory allocation, the operating system acts as an intermediary between programs and the computer hardware,[1][2] although the application code is usually executed directly by the hardware and frequently makes system calls to an OS function or is interrupted by it. Operating systems are found on many devices that contain a computer – from cellular phones and video game consoles to web servers and supercomputers.', 'Operating System 2', 1, 'OS2', 5);
INSERT INTO subject VALUES (NULL, 'Human Computer Interaction', 2, 4, 1, 0, 1, 'Human–Computer Interaction (commonly referred to as HCI) researches the design and use of computer technology, focused on the interfaces between people (users) and computers. Researchers in the field of HCI both observe the ways in which humans interact with computers and design technologies that let humans interact with computers in novel ways. As a field of research, human-computer interaction is situated at the intersection of computer science, behavioral sciences, design, media studies, and several other fields of study. The term was popularized by Stuart K. Card, Allen Newell, and Thomas P. Moran in their seminal 1983 book, The Psychology of Human-Computer Interaction, although the authors first used the term in 1980[1] and the first known use was in 1975.[2] The term connotes that, unlike other tools with only limited uses (such as a hammer, useful for driving nails but not much else), a computer has many uses and this takes place as an open-ended dialog between the user and the computer. The notion of dialog likens human-computer interaction to human-to-human interaction, an analogy which is crucial to theoretical considerations in the field.[3][4]', 'Human Computer Interaction', 1, 'IMH', 5);
INSERT INTO subject VALUES (NULL, 'Linear Programming', 2, 4, 1, 1, 0, 'Linear programming (LP, also called linear optimization) is a method to achieve the best outcome (such as maximum profit or lowest cost) in a mathematical model whose requirements are represented by linear relationships. Linear programming is a special case of mathematical programming (mathematical optimization).
More formally, linear programming is a technique for the optimization of a linear objective function, subject to linear equality and linear inequality constraints. Its feasible region is a convex polytope, which is a set defined as the intersection of finitely many half spaces, each of which is defined by a linear inequality. Its objective function is a real-valued affine (linear) function defined on this polyhedron. A linear programming algorithm finds a point in the polyhedron where this function has the smallest (or largest) value if such a point exists.', 'Linear Programming', 1, 'LNP', 5);
INSERT INTO subject VALUES (NULL, 'Logical Programming', 2, 4, 1, 0, 1, 'Logic programming is a type of programming paradigm which is largely based on formal logic. Any program written in a logic programming language is a set of sentences in logical form, expressing facts and rules about some problem domain. Major logic programming language families include Prolog, Answer set programming (ASP) and Datalog.', 'Logical Programming', 1, 'LGP', 5);
INSERT INTO subject VALUES (NULL, 'Software Engineering', 2, 4, 1, 1, 1, 'Software Engineering is the application of engineering to the development of software in a systematic method.', 'Software Engineering', 1, 'SE', 5);
INSERT INTO subject VALUES (NULL, 'Probability', 2, 4, 1, 1, 0, 'Probability is the measure of the likelihood that an event will occur.[1] See glossary of probability and statistics. Probability is quantified as a number between 0 and 1, where, loosely speaking,[2] 0 indicates impossibility and 1 indicates certainty.[3][4] The higher the probability of an event, the more likely it is that the event will occur. A simple example is the tossing of a fair (unbiased) coin. Since the coin is fair, the two outcomes ("heads" and "tails") are both equally probable; the probability of "heads" equals the probability of "tails"; and since no other outcomes are possible, the probability of either "heads" or "tails" is 1/2 (which could also be written as 0.5 or 50%).', 'Probability', 1, 'PB', 5);
INSERT INTO subject VALUES (NULL, 'English', 2, 4, 1, 0, 0, 'English is a West Germanic language that was first spoken in early medieval England and is now a global lingua franca.Named after the Angles, one of the Germanic tribes that migrated to England, it ultimately derives its name from the Anglia (Angeln) peninsula in the Baltic Sea. It is closely related to the Frisian languages, but its vocabulary has been significantly influenced by other Germanic languages, particularly Norse (a North Germanic language), as well as by Latin and Romance languages, especially French.', 'English', 1, 'EN', 5);

INSERT INTO subject VALUES (NULL, 'Developing Android Apps', 3, 4, 1, 1, 1, 'Android software development is the process by which new applications are created for devices running the Android operating system. Officially[3], apps can be written using Java, C++ or Kotlin using the Android software development kit (SDK). Third party tools, development environments and language support have also continued to evolve and expand since the initial SDK was released in 2008.', 'Introducing the Android Platform$Leveraging Application Fundamentals$Creating User Interfaces$Processing User Input$Persisting Application Data$Maintaining System Responsiveness$Exchanging Data over the Internet$Enhancing the User Experience', 1, 'DAA', 6);
INSERT INTO subject VALUES (NULL, 'Scientific Redaction', 2, 4, 1, 0, 0, 'Scientific Redaction', 'Scientific Redaction', 3, 'SR', 6);
INSERT INTO subject VALUES (NULL, 'Information Security', 3, 4, 1, 1, 0, 'Information security, sometimes shortened to InfoSec, is the practice of preventing unauthorized access, use, disclosure, disruption, modification, inspection, recording or destruction of information. It is a general term that can be used regardless of the form the data may take (e.g., electronic, physical).[1] Information security''s primary focus is the balanced protection of the confidentiality, integrity and availability of data (also known as the CIA triad) while maintaining a focus on efficient policy implementation, all without hampering organization productivity.[2] This is largely achieved through a multi-step risk management process that identifies assets, threat sources, vulnerabilities, potential impacts, and possible controls, followed by assessment of the effectiveness of the risk management plan.', '- Attacks and threats to information systems$Risk assessment$Hardening operating systems and networks$Malicious software$Securing and protecting data and storage$Cryptography$Authentication and access control$Network and internet security$Firewalls, VPNs, and intrusion detection systems$Security testing, logging, and auditing$Incident investigation and management', 1, 'IS', 6);
INSERT INTO subject VALUES (NULL, 'Cryptography', 2, 4, 1, 1, 0, 'Cryptography or cryptology is the practice and study of techniques for secure communication in the presence of third parties called adversaries. More generally, cryptography is about constructing and analyzing protocols that prevent third parties or the public from reading private messages, various aspects in information security such as data confidentiality, data integrity, authentication, and non-repudiation[4] are central to modern cryptography. Modern cryptography exists at the intersection of the disciplines of mathematics, computer science, electrical engineering, communication science, and physics. Applications of cryptography include electronic commerce, chip-based payment cards, digital currencies, computer passwords, and military communications.', 'Cryptographer$Encryption/decryption$Cryptographic key$Cipher$Ciphertext$Plaintext$Code$Tabula recta$Alice and Bob', 1, 'CPT', 6);
INSERT INTO subject VALUES (NULL, 'Database Administration', 2, 4, 1, 1, 0, 'Database administration is the function of managing and maintaining database management systems (DBMS) software. Mainstream DBMS software such as Oracle, IBM DB2 and Microsoft SQL Server need ongoing management. As such, corporations that use DBMS software often hire specialized information technology personnel called Database Administrators or DBAs.', 'SQL Program$Systems Concepts$Programming$Web Development$Systems Development$Database Management and File Structure$Database Backup and Recovery$Database Performance and Tuning$Data Modeling and Design$Systems Development Project$Information Systems Technology$Microcomputer Operating Systems$Communication Skills', 1, 'DBA', 6);


-- compiler 
INSERT INTO assignment VALUES (NULL, 32, 7, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 32, 7, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 32, 7, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 32, 7, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 32, 20, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 32, 20, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 32, 20, 3, 0, 3);

-- the operating system.
INSERT INTO assignment VALUES (NULL, 33, 2, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 33, 2, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 33, 2, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 33, 2, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 33, 6, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 33, 6, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 33, 6, 3, 0, 3);

-- IHM.
INSERT INTO assignment VALUES (NULL, 34, 11, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 34, 11, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 34, 11, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 34, 11, 3, 0, 3);

-- linear programming
INSERT INTO assignment VALUES (NULL, 35, 3, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 35, 3, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 35, 3, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 35, 3, 3, 0, 2);

-- logical programming
INSERT INTO assignment VALUES (NULL, 36, 6, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 36, 6, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 36, 6, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 36, 6, 3, 0, 3);

-- software engineering
INSERT INTO assignment VALUES (NULL, 37, 14, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 37, 14, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 37, 14, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 37, 14, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 37, 14, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 37, 14, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 37, 14, 3, 0, 3);

-- probability
INSERT INTO assignment VALUES (NULL, 38, 15, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 38, 15, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 38, 15, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 38, 15, 3, 0, 2);

-- english
INSERT INTO assignment VALUES (NULL, 39, 16, 0, 0, 1);

-- android
INSERT INTO assignment VALUES (NULL, 40, 17, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 40, 17, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 40, 17, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 40, 17, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 40, 17, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 40, 17, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 40, 17, 3, 0, 3);

-- english
INSERT INTO assignment VALUES (NULL, 41, 19, 0, 0, 1);

-- security
INSERT INTO assignment VALUES (NULL, 42, 4, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 42, 4, 0, 0, 2);


-- crypto
INSERT INTO assignment VALUES (NULL, 43, 5, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 43, 5, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 43, 5, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 43, 5, 3, 0, 2);

-- database administration
INSERT INTO assignment VALUES (NULL, 44, 18, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 44, 18, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 44, 18, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 44, 18, 3, 0, 2);

-- the 2lmd

-- algorithm
INSERT INTO assignment VALUES (NULL, 17, 12, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 17, 12, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 17, 12, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 17, 12, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 17, 21, 4, 0, 2);
INSERT INTO assignment VALUES (NULL, 17, 21, 5, 0, 2);
INSERT INTO assignment VALUES (NULL, 17, 12, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 17, 12, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 17, 12, 3, 0, 3);
INSERT INTO assignment VALUES (NULL, 17, 1, 4, 0, 3);
INSERT INTO assignment VALUES (NULL, 17, 1, 5, 0, 3);

-- theory language
INSERT INTO assignment VALUES (NULL, 18, 8, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 18, 8, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 18, 8, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 18, 8, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 18, 8, 4, 0, 2);
INSERT INTO assignment VALUES (NULL, 18, 8, 5, 0, 2);

-- computer architecture
INSERT INTO assignment VALUES (NULL, 19, 22, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 19, 22, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 19, 22, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 19, 22, 3, 0, 3);
INSERT INTO assignment VALUES (NULL, 19, 22, 4, 0, 3);
INSERT INTO assignment VALUES (NULL, 19, 22, 5, 0, 3);

-- mathematical logic
INSERT INTO assignment VALUES (NULL, 20, 17, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 20, 17, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 20, 17, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 20, 17, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 20, 17, 4, 0, 2);
INSERT INTO assignment VALUES (NULL, 20, 17, 5, 0, 2);

-- oop
INSERT INTO assignment VALUES (NULL, 21, 23, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 21, 23, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 21, 23, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 21, 23, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 21, 23, 4, 0, 2);
INSERT INTO assignment VALUES (NULL, 21, 23, 5, 0, 2);
INSERT INTO assignment VALUES (NULL, 21, 24, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 21, 24, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 21, 24, 3, 0, 3);
INSERT INTO assignment VALUES (NULL, 21, 24, 4, 0, 3);
INSERT INTO assignment VALUES (NULL, 21, 24, 5, 0, 3);

-- information system
INSERT INTO assignment VALUES (NULL, 22, 9, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 22, 9, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 22, 9, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 22, 9, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 22, 25, 4, 0, 2);
INSERT INTO assignment VALUES (NULL, 22, 25, 5, 0, 2);

-- english
INSERT INTO assignment VALUES (NULL, 23, 16, 0, 0, 1);

-- database
INSERT INTO assignment VALUES (NULL, 24, 26, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 24, 26, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 24, 26, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 24, 26, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 24, 26, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 24, 26, 4, 0, 2);
INSERT INTO assignment VALUES (NULL, 24, 26, 5, 0, 2);
INSERT INTO assignment VALUES (NULL, 24, 22, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 24, 22, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 24, 22, 3, 0, 3);
INSERT INTO assignment VALUES (NULL, 24, 22, 4, 0, 3);
INSERT INTO assignment VALUES (NULL, 24, 22, 5, 0, 3);

-- networking
INSERT INTO assignment VALUES (NULL, 25, 27, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 25, 27, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 25, 27, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 25, 27, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 25, 27, 4, 0, 2);
INSERT INTO assignment VALUES (NULL, 25, 27, 5, 0, 2);
INSERT INTO assignment VALUES (NULL, 25, 27, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 25, 27, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 25, 27, 3, 0, 3);
INSERT INTO assignment VALUES (NULL, 25, 27, 4, 0, 3);
INSERT INTO assignment VALUES (NULL, 25, 27, 5, 0, 3);

-- operating system
INSERT INTO assignment VALUES (NULL, 26, 1, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 26, 1, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 26, 1, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 26, 1, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 26, 1, 4, 0, 2);
INSERT INTO assignment VALUES (NULL, 26, 1, 5, 0, 2);
INSERT INTO assignment VALUES (NULL, 26, 25, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 26, 25, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 26, 25, 3, 0, 3);
INSERT INTO assignment VALUES (NULL, 26, 25, 4, 0, 3);
INSERT INTO assignment VALUES (NULL, 26, 25, 5, 0, 3);

-- graph theory
INSERT INTO assignment VALUES (NULL, 27, 13, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 27, 13, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 27, 13, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 27, 13, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 27, 13, 4, 0, 2);
INSERT INTO assignment VALUES (NULL, 27, 13, 5, 0, 2);

-- web developments
INSERT INTO assignment VALUES (NULL, 28, 13, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 28, 13, 1, 0, 3);
INSERT INTO assignment VALUES (NULL, 28, 13, 2, 0, 3);
INSERT INTO assignment VALUES (NULL, 28, 13, 3, 0, 3);
INSERT INTO assignment VALUES (NULL, 28, 13, 4, 0, 3);
INSERT INTO assignment VALUES (NULL, 28, 13, 5, 0, 3);

-- english
INSERT INTO assignment VALUES (NULL, 29, 16, 0, 0, 1);

-- juridic aspects
INSERT INTO assignment VALUES (NULL, 30, 16, 0, 0, 1);

-- software engineering
INSERT INTO assignment VALUES (NULL, 31, 21, 0, 0, 1);
INSERT INTO assignment VALUES (NULL, 31, 21, 1, 0, 2);
INSERT INTO assignment VALUES (NULL, 31, 21, 2, 0, 2);
INSERT INTO assignment VALUES (NULL, 31, 21, 3, 0, 2);
INSERT INTO assignment VALUES (NULL, 31, 21, 4, 0, 2);
INSERT INTO assignment VALUES (NULL, 31, 21, 5, 0, 2);

-- schedule of 3LMD
INSERT INTO schedule VALUES (NULL, 39, 'Amphi C', 3, 6);
INSERT INTO schedule VALUES (NULL, 40, 'Salle 14', 5, 1);
INSERT INTO schedule VALUES (NULL, 41, 'Salle 6', 4, 5);
INSERT INTO schedule VALUES (NULL, 42, 'Salle 14', 4, 2);
INSERT INTO schedule VALUES (NULL, 43, 'Labo 3', 4, 1);
INSERT INTO schedule VALUES (NULL, 44, 'Labo 3', 3, 5);
INSERT INTO schedule VALUES (NULL, 45, 'Labo 3', 4, 6);

INSERT INTO schedule VALUES (NULL, 46, 'Amphi C', 3, 3);

INSERT INTO schedule VALUES (NULL, 47, 'Amphi A', 2, 3);
INSERT INTO schedule VALUES (NULL, 48, 'Amphi A', 2, 4);

INSERT INTO schedule VALUES (NULL, 49, 'Amphi A', 3, 1);
INSERT INTO schedule VALUES (NULL, 50, 'Salle 7', 3, 2);
INSERT INTO schedule VALUES (NULL, 51, 'Salle 7', 4, 2);
INSERT INTO schedule VALUES (NULL, 52, 'Salle 7', 4, 1);

INSERT INTO schedule VALUES (NULL, 53, 'Amphi B', 4, 3);
INSERT INTO schedule VALUES (NULL, 54, 'Salle 11', 3, 5);
INSERT INTO schedule VALUES (NULL, 55, 'Salle 7', 4, 1);
INSERT INTO schedule VALUES (NULL, 56, 'Salle 13', 4, 5);

-- 2lmd

INSERT INTO schedule VALUES (NULL, 104, 'Amphi A', 2, 1);
INSERT INTO schedule VALUES (NULL, 105, 'Amphi A', 4, 2);
INSERT INTO schedule VALUES (NULL, 106, 'Salle 11', 4, 1);
INSERT INTO schedule VALUES (NULL, 107, 'Salle 7', 2, 2);
INSERT INTO schedule VALUES (NULL, 108, 'Salle 7', 2, 3);
INSERT INTO schedule VALUES (NULL, 109, 'Salle 7', 4, 3);
INSERT INTO schedule VALUES (NULL, 110, 'Salle 11', 4, 5);
INSERT INTO schedule VALUES (NULL, 111, 'Labo 1', 4, 3);
INSERT INTO schedule VALUES (NULL, 112, 'Labo 4', 3, 6);
INSERT INTO schedule VALUES (NULL, 113, 'Labo 1', 4, 1);
INSERT INTO schedule VALUES (NULL, 114, 'Labo 1', 4, 5);
INSERT INTO schedule VALUES (NULL, 115, 'Labo 1', 5, 1);


INSERT INTO schedule VALUES (NULL, 116, 'Amphi A', 3, 2);
INSERT INTO schedule VALUES (NULL, 117, 'Salle 6', 3, 1);
INSERT INTO schedule VALUES (NULL, 118, 'Salle 6', 1, 2);
INSERT INTO schedule VALUES (NULL, 119, 'Salle 5', 2, 2);
INSERT INTO schedule VALUES (NULL, 120, 'Salle 13', 2, 3);
INSERT INTO schedule VALUES (NULL, 121, 'Salle 6', 3, 3);
INSERT INTO schedule VALUES (NULL, 122, 'Labo 4', 4, 5);
INSERT INTO schedule VALUES (NULL, 123, 'Labo 4', 5, 1);
INSERT INTO schedule VALUES (NULL, 124, 'Labo 2', 3, 6);
INSERT INTO schedule VALUES (NULL, 125, 'Labo 4', 4, 6);
INSERT INTO schedule VALUES (NULL, 126, 'Labo 4', 4, 1);


INSERT INTO schedule VALUES (NULL, 127, 'Amphi A', 1, 1);
INSERT INTO schedule VALUES (NULL, 128, 'Salle 11', 2, 2);
INSERT INTO schedule VALUES (NULL, 129, 'Salle 13', 3, 1);
INSERT INTO schedule VALUES (NULL, 130, 'Salle 14', 3, 3);
INSERT INTO schedule VALUES (NULL, 131, 'Salle 11', 1, 2);
INSERT INTO schedule VALUES (NULL, 132, 'Salle 6', 2, 3);
INSERT INTO schedule VALUES (NULL, 133, 'Labo 3', 3, 3);
INSERT INTO schedule VALUES (NULL, 134, 'Labo 3', 4, 3);
INSERT INTO schedule VALUES (NULL, 135, 'Labo 3', 4, 5);
INSERT INTO schedule VALUES (NULL, 136, 'Labo 3', 5, 1);
INSERT INTO schedule VALUES (NULL, 137, 'Labo 3', 4, 6);

INSERT INTO schedule VALUES (NULL, 138, 'Amphi A', 5, 2);
INSERT INTO schedule VALUES (NULL, 139, 'Salle 11', 5, 1);
INSERT INTO schedule VALUES (NULL, 140, 'Salle 13', 4, 1);
INSERT INTO schedule VALUES (NULL, 141, 'Salle 11', 4, 3);
INSERT INTO schedule VALUES (NULL, 142, 'Salle 14', 3, 1);
INSERT INTO schedule VALUES (NULL, 143, 'Salle 14', 4, 3);


INSERT INTO schedule VALUES (NULL, 144, 'Amphi A', 2, 5);
INSERT INTO schedule VALUES (NULL, 145, 'Labo 3', 5, 3);
INSERT INTO schedule VALUES (NULL, 146, 'Labo 1', 2, 3);
INSERT INTO schedule VALUES (NULL, 147, 'Labo 3', 2, 6);
INSERT INTO schedule VALUES (NULL, 148, 'Labo 3', 4, 1);
INSERT INTO schedule VALUES (NULL, 149, 'Labo 1', 2, 2);

INSERT INTO schedule VALUES (NULL, 150, 'Amphi B', 3, 5);
INSERT INTO schedule VALUES (NULL, 151, 'Amphi A', 1, 5);

INSERT INTO schedule VALUES (NULL, 152, 'Amphi B', 1, 3);
INSERT INTO schedule VALUES (NULL, 153, 'Salle 5', 2, 3);
INSERT INTO schedule VALUES (NULL, 154, 'Salle 13', 3, 3);
INSERT INTO schedule VALUES (NULL, 155, 'Salle 13', 1, 2);
INSERT INTO schedule VALUES (NULL, 156, 'Salle 13', 3, 2);
INSERT INTO schedule VALUES (NULL, 157, 'Salle 7', 3, 1);


insert into post VALUES (null,1,44,1,'6.0.3','The bung hole hails with faith, taste the lighthouse until it sings.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,2,43,2,'6.0.3','Animaliss sunt torquiss de altus tata. Persuadere hic ducunt ad alter historia.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,3,42,3,'6.0.2','Detrius, urbs, et diatria. Emeritis, varius assimilatios satis demitto de fatalis, gratis armarium.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,4,41,4,'6.0.2','Bursas favere in alta muta! Planeta de rusticus genetrix, anhelare extum.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,5,40,5,'6.0.0','Lumens sunt cursuss de placidus resistentia. Regius adelphis superbe talems triticum est.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,6,24,6,'4.0.1','When one remembers intuition and joy, one is able to handle dimension.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,7,25,7,'4.0.2','Try covering the emeri\'s essence bok choys with clammy iced tea and gold tequila, roasted.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,8,26,8,'4.0.3','The biscuit eater fears with courage, fire the pacific ocean until it sings.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,9,27,9,'4.0.4','Cum orexis favere, omnes ollaes imitari fortis, velox poetaes. Est placidus barcas, cesaris.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,10,28,10,'4.0.5','The plank crushes with treasure, endure the seychelles before it laughs.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,11,29,11,'4.0.1','Modification at the solar system was the sensor of nuclear flux, experienced to a lunar vogon.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,12,30,12,'4.0.1','Future at the center was the ionic cannon of devastation, fighted to a colorful admiral.',null,UNIX_TIMESTAMP());
insert into post VALUES (null,13,31,13,'4.0.2','Steak can be seasoned with squeezed quinoa, also try soaking the chili with ice water.',null,UNIX_TIMESTAMP());

INSERT saved_notification VALUES (1, 10101010, 1, 0);
INSERT saved_notification VALUES (2, 10101010, 1, 1);
INSERT saved_notification VALUES (3, 10101010, 1, 0);
INSERT saved_notification VALUES (4, 10101010, 1, 1);
INSERT saved_notification VALUES (5, 10101010, 1, 1);
INSERT saved_notification VALUES (6, 10101010, 1, 0);
INSERT saved_notification VALUES (7, 10101010, 1, 1);

