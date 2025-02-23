background company
    -- logo
    -- company details

Upload Photos
    -- Title, Detail, multi photo

Contact
    -- Official Email/ Phone

Address
    -- Exact address

Social Media Links
    -- Facebook
    -- Instgram

Admin Panel
 -- Upload photos
 -- Address CRUD
 -- Socail Media Link CRUD
 -- Background Text
 -- Change Logo

 CREATE DATABASE MHA;

CREATE TABLE users(
   Id int auto_increment primary key,
   email VARCHAR(128) not null,
   pass VARCHAR(255) not null,
   CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
   UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Company Details
 CREATE TABLE companyDetails(
    Id int auto_increment primary key,
    background VARCHAR(1024) not null,
    CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
 );

-- Company Contact
 CREATE TABLE companyContact(
    Id int auto_increment primary key,
    contact VARCHAR(255) not null,
    type VARCHAR(16) not null,
    CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
 );

-- Company Addresses
CREATE TABLE companyAddresses (
    Id INT auto_increment PRIMARY KEY,
    Street VARCHAR(255) NOT NULL,
    City VARCHAR(100) NOT NULL,
    State VARCHAR(100) NULL,
    PostalCode VARCHAR(20) NULL,
    Country VARCHAR(100) NOT NULL,
    CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- SocialMediaLinks 
CREATE TABLE SocialMediaLinks (
    Id INT auto_increment PRIMARY KEY,
    Platform VARCHAR(50) NOT NULL,  -- e.g., Facebook, Twitter, LinkedIn
    ProfileLink VARCHAR(255) NOT NULL,
    CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Posts
CREATE TABLE Posts (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255) NOT NULL,
    Description TEXT NOT NULL,
    catagory VARCHAR(255) NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Posts Images
CREATE TABLE PostImages (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    PostId INT NOT NULL,
    ImagePath VARCHAR(255) NOT NULL,
    FOREIGN KEY (PostId) REFERENCES Posts(Id) ON DELETE CASCADE
);

CREATE TABLE ContactMessages (
    MessageID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Subject VARCHAR(255) NOT NULL,
    Message TEXT NOT NULL,
    Status ENUM('New', 'Read', 'Replied') DEFAULT 'New',
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE CustomerFeedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Rating INT CHECK (Rating BETWEEN 1 AND 5) NOT NULL,
    Feedback TEXT NOT NULL,
    Status ENUM('New', 'Read', 'Replied') DEFAULT 'New',
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);




